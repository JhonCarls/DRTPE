import logging
import re
from app.rag.vector_store import VectorStore
from app.llm import get_llm_provider
from app.config import settings

logger = logging.getLogger(__name__)

class RAGChain:
    def __init__(self):
        self.vector_store = VectorStore(persist_dir=settings.CHROMA_PERSIST_DIR)
        self.llm = get_llm_provider()
        self.k = settings.MAX_CONTEXT_CHUNKS
        self.similarity_threshold = 0.55

    # 1. Detección de saludos (regex, más confiable)
    def _is_greeting(self, text: str) -> bool:
        greetings = re.compile(
            r"^(hola|buenos días|buenas tardes|buenas noches|qué tal|hey|saludos|gracias|adios|chao|ds|bye|hello|hi|ey|ola)$",
            re.IGNORECASE
        )
        return bool(greetings.match(text.strip()))

    # 2. Reformulación con énfasis en siglas
    async def _reformulate_question(self, question: str) -> str:
        prompt = f"""
Reescribe la siguiente pregunta corrigiendo errores ortográficos y haciéndola más clara.
Si la pregunta contiene siglas o acrónimos (como RETCC, SOVIO, TUPA, DRTPE, etc.), escríbelos CORRECTAMENTE en mayúsculas.
Si la pregunta no tiene sentido, responde "NO_COMPRENDIDO".

Pregunta original: "{question}"
Pregunta reformulada:
"""
        try:
            reformulada = await self.llm.generate_response(prompt)
            if "NO_COMPRENDIDO" in reformulada:
                return question
            return reformulada.strip()
        except:
            return question

    # 3. Búsqueda exacta de siglas (mejorada)
    def _exact_match_search(self, question: str) -> list:
        # Extraer posibles siglas (mayúsculas, 2-6 letras)
        siglas = re.findall(r'\b[A-ZÁÉÍÓÚÑ]{2,6}\b', question)
        if not siglas:
            return []
        try:
            # Obtener todos los documentos (limitado a 200)
            results = self.vector_store.collection.get(limit=200)
            docs = results.get('documents', [])
            matched = []
            for doc in docs:
                for sigla in siglas:
                    if sigla in doc:
                        matched.append(doc)
                        break
            return matched
        except:
            return []

    # 4. Búsqueda por palabras clave (con pesos)
    def _keyword_search(self, question: str, docs: list, min_shared: int = 1) -> list:
        stopwords = {"el", "la", "los", "las", "un", "una", "unos", "unas", "de", "del", "al", "y", "o", "pero", "si", "no", "en", "por", "para", "con", "sin", "sobre", "entre", "hasta", "desde", "durante", "mediante", "que", "como", "cual", "quien", "donde"}
        # Extraer palabras significativas (más de 3 letras y no stopwords)
        question_words = {w.lower() for w in re.findall(r'\b\w+\b', question) if len(w) > 3 and w.lower() not in stopwords}
        if not question_words:
            return docs
        scored_docs = []
        for doc in docs:
            doc_words = {w.lower() for w in re.findall(r'\b\w+\b', doc) if len(w) > 3}
            # Calcular intersección
            common = question_words.intersection(doc_words)
            score = len(common)
            if score >= min_shared:
                scored_docs.append((doc, score))
        # Ordenar por puntuación (mayor coincidencia primero)
        scored_docs.sort(key=lambda x: x[1], reverse=True)
        return [doc for doc, _ in scored_docs]

    # 5. Método principal
    async def ask(self, question: str, session_id: str = None) -> tuple[str, list[str]]:
        # --- Paso 1: Saludos ---
        if self._is_greeting(question):
            return "¡Hola! Soy BotDRTPE, tu asistente virtual de la Dirección Regional de Trabajo y Promoción del Empleo. ¿En qué puedo ayudarte hoy?", []

        # --- Paso 2: Reformulación ---
        reformulated = await self._reformulate_question(question)
        logger.info(f"Original: {question} → Reformulada: {reformulated}")

        # --- Paso 3: Búsqueda híbrida ---
        # 3a. Búsqueda exacta de siglas
        exact_docs = self._exact_match_search(reformulated)

        # 3b. Búsqueda vectorial
        query_emb = self.vector_store.embeddings.embed_query(reformulated)
        results = self.vector_store.collection.query(
            query_embeddings=[query_emb],
            n_results=self.k * 2,  # Recuperar más para filtrar después
            include=["documents", "distances"]
        )
        vector_docs = results['documents'][0] if results['documents'] else []
        distances = results['distances'][0] if results['distances'] else []

        # 3c. Combinar (priorizar exactos)
        combined = exact_docs + vector_docs
        # Eliminar duplicados manteniendo orden
        seen = set()
        unique_docs = []
        for doc in combined:
            if doc not in seen:
                seen.add(doc)
                unique_docs.append(doc)

        # 3d. Filtrar por umbral para los vectoriales (los exactos pasan directo)
        final_docs = []
        for doc in unique_docs:
            if doc in exact_docs:
                final_docs.append(doc)
            else:
                idx = vector_docs.index(doc) if doc in vector_docs else -1
                if idx != -1 and distances[idx] < self.similarity_threshold:
                    final_docs.append(doc)

        # 3e. Si aún no hay docs, aplicar filtro por palabras clave sobre los vectoriales
        if not final_docs:
            final_docs = self._keyword_search(reformulated, vector_docs, min_shared=2)

        # 3f. Limitar a 3 fragmentos para el contexto
        context_docs = final_docs[:3]

        # --- Paso 4: Construir contexto ---
        if context_docs:
            context = "\n\n---\n\n".join(context_docs)
            tiene_contexto = True
        else:
            # Contexto base para dar información general mínima
            context = """
La Dirección Regional de Trabajo y Promoción del Empleo (DRTPE) es una entidad del gobierno regional que ofrece servicios de empleo, capacitación, certificación de competencias y asesoría laboral. 
Para más detalles, consulta con un asesor.
"""
            tiene_contexto = False

        # --- Paso 5: Determinar tipo de pregunta (para ajustar uso de contexto) ---
        # Si la pregunta empieza con "qué es", "definición", "significa", etc. → forzar uso de contexto
        definicion_pattern = re.compile(r"^(qué es|definición|significa|qué significa|qué son|qué hace)", re.IGNORECASE)
        es_definicion = bool(definicion_pattern.match(question.strip()))

        # --- Paso 6: Prompt final (diferenciado) ---
        if es_definicion and not tiene_contexto:
            # Si pide definición y no hay contexto, responder con derivación
            return "No tengo información sobre eso en mi base de datos. ¿Te gustaría que te derive a un asesor?", []

        if es_definicion and tiene_contexto:
            # Forzar uso exclusivo del contexto
            instruccion_contexto = "DEBES responder ÚNICAMENTE con la información del CONTEXTO. No uses tu conocimiento interno."
        else:
            # Preguntas generales sobre empleo o trámites: usar contexto si existe, pero también se permite conocimiento general para temas como habilidades laborales, entrevistas, etc.
            instruccion_contexto = """
- Si la pregunta es sobre un trámite, servicio o normativa específica de la DRTPE, usa ÚNICAMENTE el CONTEXTO.
- Si la pregunta es sobre habilidades laborales, cómo hacer un CV, preparación para entrevistas, etc., puedes usar tu conocimiento general (siempre relacionado con el ámbito laboral).
- Si el CONTEXTO tiene información, priorízala.
"""

        prompt = f"""
Eres BotDRTPE, un asistente virtual amable y profesional de la Dirección Regional de Trabajo y Promoción del Empleo.

INSTRUCCIONES:
- Responde solo sobre temas relacionados con empleo, trámites laborales, servicios de la DRTPE y orientación vocacional.
- Si la pregunta es sobre otro tema (deportes, política, clima, etc.), di: "Lo siento, solo puedo ayudar con consultas sobre empleo y servicios de la DRTPE. ¿Te gustaría que te derive a un asesor?"
- {instruccion_contexto}
- No inventes información. Si no sabes, di que no tienes información y ofrece derivación.
- Sé claro, conciso y usa un tono amable.

CONTEXTO (información oficial disponible):
{context}

PREGUNTA DEL CIUDADANO: {question}
(Pregunta reformulada para búsqueda: {reformulated})

RESPUESTA DEL ASISTENTE (en español):
"""
        answer = await self.llm.generate_response(prompt)

        # --- Paso 7: Decidir si mostrar fuentes ---
        # Mostrar fuentes solo si hay contexto y la respuesta no es de derivación
        if tiene_contexto and "no tengo información" not in answer.lower() and "derivar" not in answer.lower():
            return answer, context_docs
        else:
            return answer, []