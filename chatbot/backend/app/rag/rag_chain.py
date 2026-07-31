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
        self.similarity_threshold = 0.65  # ¡MÁS PERMISIVO!
        self.history = {}
        self.max_history = getattr(settings, 'MAX_HISTORY_LENGTH', 10)

    # ---------- UTILIDADES ----------
    def _is_greeting(self, text: str) -> bool:
        greetings = re.compile(
            r"^(hola|buenos días|buenas tardes|buenas noches|qué tal|hey|saludos|gracias|adiós|chao|bye|hello|hi|ey|ola|buenas)$",
            re.IGNORECASE
        )
        return bool(greetings.match(text.strip()))

    def _is_employability_question(self, question: str) -> bool:
        """Detecta preguntas sobre CV, entrevistas, habilidades, empleabilidad"""
        patterns = re.compile(
            r"(cv|currículum|curriculum|entrevista|habilidades|competencias|"
            r"como (hacer|mejorar|crear|elaborar|hago) (mi |el |un )?(cv|currículum)|"
            r"qué (es|son) (el |los )?(cv|currículum|habilidades))",
            re.IGNORECASE
        )
        return bool(patterns.search(question))

    # ---------- REFORMULACIÓN CON GEMINI ----------
    async def _reformulate_question(self, question: str) -> str:
        """Usa Gemini para corregir, expandir y normalizar preguntas"""
        prompt = f"""
Eres un asistente de normalización de texto. Reescribe la siguiente pregunta:

REGLAS:
- Corrige errores ortográficos y gramaticales.
- Normaliza mayúsculas/minúsculas.
- Si contiene siglas (SOVIO, RETCC, TUPA, REMYPE, etc.), escríbelas en mayúsculas.
- Expande abreviaturas si es necesario (ej: "cv" → "currículum vitae").
- Si la pregunta es ambigua, aclárala manteniendo el significado.
- Devuelve SOLO la pregunta corregida, sin explicaciones.

Pregunta original: "{question}"
Pregunta corregida:
"""
        try:
            response = await self.llm.generate_response(prompt)
            return response.strip() if len(response.strip()) > 3 else question
        except:
            return question

    # ---------- KEYWORD SEARCH MEJORADA ----------
    def _keyword_search(self, question: str, docs: list, min_shared: int = 2) -> list:
        """Búsqueda por palabras clave con ponderación y sinónimos"""
        stopwords = {
            "el", "la", "los", "las", "un", "una", "unos", "unas", "de", "del", "al",
            "y", "o", "pero", "si", "no", "en", "por", "para", "con", "sin", "sobre",
            "entre", "hasta", "desde", "durante", "mediante", "que", "como", "cual",
            "quien", "donde", "más", "menos", "muy", "tan", "tanto", "cuando",
            "cómo", "cuál", "porque", "aunque", "sino", "también", "ya", "se", "lo"
        }

        # Extraer palabras clave (incluyendo siglas y palabras de 2 letras)
        all_words = re.findall(r'\b\w+\b', question.lower())
        question_words = {w for w in all_words if len(w) >= 2 and w not in stopwords}

        # Añadir siglas (palabras en mayúsculas)
        siglas = re.findall(r'\b[A-ZÁÉÍÓÚÑ]{2,6}\b', question)
        question_words.update([s.lower() for s in siglas])

        # Sinónimos básicos para palabras clave comunes
        synonyms = {
            "cv": ["currículum", "curriculum", "curriculum vitae", "hoja de vida"],
            "bolsa": ["empleo", "trabajo", "vacante", "oferta"],
            "inscribir": ["registrar", "apuntar", "anotar"],
            "requisito": ["documento", "papel", "necesario", "obligatorio"],
            "sovio": ["orientación vocacional", "vocacional", "carrera", "profesión"],
            "remype": ["micro", "pequeña", "empresa", "registro"],
            "retcc": ["construcción", "civil", "trabajador"],
            "cul": ["certificado", "laboral", "único"],
            "ruc": ["registro", "único", "contribuyente", "sunat"],
            "formaliza": ["formalización", "formalizar", "formal", "empresa", "negocio"]
        }

        # Expandir con sinónimos
        expanded_words = set(question_words)
        for word in question_words:
            for key, syns in synonyms.items():
                if word in syns or word == key:
                    expanded_words.update(syns)
                    expanded_words.add(key)

        if not expanded_words:
            return docs[:3]

        # Puntuar documentos
        scored_docs = []
        for doc in docs:
            doc_lower = doc.lower()
            doc_words = {w.lower() for w in re.findall(r'\b\w+\b', doc_lower) if len(w) >= 2}
            common = expanded_words.intersection(doc_words)

            # Ponderar: siglas y palabras clave largas tienen más peso
            weighted_score = 0
            for w in common:
                if w in siglas or len(w) >= 6:
                    weighted_score += 2
                else:
                    weighted_score += 1

            # Bonus si la pregunta aparece literalmente en el documento
            if question.lower() in doc_lower[:200]:
                weighted_score += 3

            if weighted_score >= min_shared:
                scored_docs.append((doc, weighted_score))

        scored_docs.sort(key=lambda x: x[1], reverse=True)
        return [doc for doc, _ in scored_docs[:5]]

    # ---------- RESPUESTA CON CONOCIMIENTO GENERAL ----------
    async def _respond_with_general_knowledge(self, question: str) -> tuple[str, list]:
        """Usa el conocimiento del modelo para preguntas de empleabilidad"""
        prompt = f"""
Eres BotDRTPE, un asistente virtual de la Dirección Regional de Trabajo y Promoción del Empleo.

INSTRUCCIONES:
- Responde a la siguiente pregunta usando TU CONOCIMIENTO GENERAL sobre empleo, trámites laborales y servicios de la DRTPE.
- SIEMPRE relaciona la respuesta con el ámbito laboral y los servicios de la DRTPE.
- Si la pregunta NO está relacionada con empleo o servicios de la DRTPE, deriva amablemente a un asesor.
- Sé claro, conciso y profesional (máximo 3 párrafos).
- No inventes información sobre trámites específicos que no conozcas.

Pregunta: {question}

Respuesta (conocimiento general):
"""
        answer = await self.llm.generate_response(prompt)
        return answer, []

    # ---------- FALLBACK ELEGANTE (NUEVO) ----------
    def _fallback_response(self, question: str) -> tuple[str, list]:
        """
        Genera una respuesta de fallback para preguntas relacionadas con la base de conocimientos
        pero que no tienen información específica.
        """
        fallback_msg = (
            "Lamento no poder ayudarte con esa consulta específica en este momento. "
            "Sin embargo, te invito a visitarnos en nuestra oficina principal, ubicada en "
            "el **Jr. Ayacucho N° 658, Puno**, de lunes a viernes de 8:00 a.m. a 4:00 p.m., "
            "donde un asesor especializado podrá brindarte atención personalizada sobre este tema."
        )
        return fallback_msg, []

    # ---------- MÉTODO PRINCIPAL ----------
    async def ask(self, question: str, session_id: str = None) -> tuple[str, list[str]]:
        # 1. SALUDOS
        if self._is_greeting(question):
            return "¡Hola! Soy BotDRTPE, tu asistente virtual. ¿En qué puedo ayudarte hoy?", []

        # 2. REFORMULAR CON GEMINI
        reformulated = await self._reformulate_question(question)
        logger.info(f"📝 Original: {question} → Reformulada: {reformulated}")

        # 3. BÚSQUEDA HÍBRIDA (SIEMPRE COMBINADA)
        # 3a. Búsqueda vectorial
        query_emb = self.vector_store.embeddings.embed_query(reformulated)
        results = self.vector_store.collection.query(
            query_embeddings=[query_emb],
            n_results=self.k * 2,
            include=["documents", "distances"]
        )
        vector_docs = results['documents'][0] if results['documents'] else []
        distances = results['distances'][0] if results['distances'] else []

        # 3b. Filtrar vectoriales por umbral
        vector_filtered = []
        for doc, dist in zip(vector_docs, distances):
            if dist < self.similarity_threshold:
                vector_filtered.append(doc)

        logger.info(f"🔍 Vectoriales recuperados: {len(vector_docs)}, filtrados: {len(vector_filtered)}")

        # 3c. Keyword search sobre TODOS los documentos (siempre)
        all_docs = self.vector_store.collection.get(limit=500)['documents']
        keyword_docs = self._keyword_search(reformulated, all_docs, min_shared=2)

        # 3d. Combinar (priorizar vectoriales)
        combined = vector_filtered + keyword_docs
        seen = set()
        final_docs = []
        for doc in combined:
            if doc not in seen:
                seen.add(doc)
                final_docs.append(doc)

        context_docs = final_docs[:3]
        logger.info(f"📄 Documentos finales: {len(context_docs)}")

        # 4. DETECTAR PREGUNTAS DE EMPLEABILIDAD (CV, entrevistas, etc.)
        es_empleabilidad = self._is_employability_question(question)

        # 5. Si es empleabilidad y NO hay contexto, usar conocimiento general
        if es_empleabilidad and not context_docs:
            logger.info("🧠 Usando conocimiento general para pregunta de empleabilidad")
            return await self._respond_with_general_knowledge(question)

        # 6. Si no hay contexto y NO es empleabilidad, usar fallback elegante
        if not context_docs:
            logger.info("ℹ️ Sin contexto, usando fallback elegante")
            return self._fallback_response(question)

        # 7. CONSTRUIR CONTEXTO
        context = "\n\n---\n\n".join(context_docs)

        # 8. HISTORIAL
        history_text = ""
        if session_id and session_id in self.history:
            last_msgs = self.history[session_id][-3:]
            history_text = "\n".join([
                f"Usuario: {m['user']}\nAsistente: {m['assistant']}"
                for m in last_msgs
            ])

        # 9. DETERMINAR SI ES PRIMERA INTERACCIÓN
        is_new_session = False
        if session_id:
            if session_id not in self.history or len(self.history.get(session_id, [])) == 0:
                is_new_session = True
        else:
            # Si no hay session_id, asumimos que es nueva cada vez
            is_new_session = True

        # 10. PROMPT INTELIGENTE CON INSTRUCCIÓN CONDICIONAL
        saludo_instruccion = ""
        if is_new_session:
            saludo_instruccion = "PRESÉNTATE brevemente al inicio (ej: 'Hola, soy BotDRTPE, tu asistente virtual...'), pero solo en esta primera respuesta."
        else:
            saludo_instruccion = "NO te presentes ni saludes. Continúa la conversación de forma natural, respondiendo directamente a la pregunta del usuario."

        prompt = f"""
Eres BotDRTPE, un asistente virtual de la Dirección Regional de Trabajo y Promoción del Empleo (DRTPE).

{saludo_instruccion}

CONTEXTO OFICIAL (información extraída de documentos):
{context}

HISTORIAL RECIENTE:
{history_text}

PREGUNTA DEL CIUDADANO:
{question}

INSTRUCCIONES:
1. Usa el CONTEXTO OFICIAL como fuente principal de información.
2. Si el CONTEXTO contiene la respuesta, responde con esa información de forma clara y completa.
3. Si el CONTEXTO contiene información PARCIAL, puedes COMPLEMENTAR con tu conocimiento general sobre el tema (siempre relacionado con empleo y servicios de la DRTPE).
4. Si el CONTEXTO NO contiene información relevante, di: "No tengo esa información en mi base de datos. ¿Te gustaría que te derive a un asesor?"
5. NO inventes información sobre trámites específicos que no estén en el contexto.
6. Responde en español, de forma clara, concisa y profesional.
7. Mantén un tono amable y cercano, pero sin repetir saludos si ya hay historial.

RESPUESTA:
"""
        answer = await self.llm.generate_response(prompt)

        # 11. GUARDAR HISTORIAL
        if session_id:
            if session_id not in self.history:
                self.history[session_id] = []
            self.history[session_id].append({"user": question, "assistant": answer})
            if len(self.history[session_id]) > self.max_history:
                self.history[session_id] = self.history[session_id][-self.max_history:]

        # 12. DETERMINAR SI MOSTRAR FUENTES (usar fallback si no hay info)
        if "no tengo esa información" in answer.lower() or "derivar" in answer.lower():
            logger.info("ℹ️ El modelo indica que no tiene información, usando fallback elegante")
            return self._fallback_response(question)

        return answer, context_docs