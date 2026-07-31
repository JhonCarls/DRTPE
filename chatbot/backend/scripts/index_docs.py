import os
import re
import logging
from pathlib import Path

# Configurar logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    datefmt='%H:%M:%S'
)
logger = logging.getLogger(__name__)

from app.rag.document_loader import load_document
from app.rag.text_splitter import split_text
from app.rag.vector_store import VectorStore
from app.config import settings

DATA_DIR = "./data"


def clean_text(text: str) -> str:
    """
    Limpia el texto eliminando diálogos y patrones no informativos,
    pero PRESERVANDO la estructura Markdown (títulos ##, listas, etc.)
    """
    lines = text.split("\n")
    cleaned = []
    
    # Patrones a eliminar (solo diálogos y basura, NO títulos Markdown)
    patterns = [
        r"^(BOT|Usuario|Asistente|Sistema|INICIO|FIN|Pregunta|Respuesta|Selecciona|Elige)\s*[:：]",
        r"^(Sí|No|Tal vez|Si|NO)\s*[.,;:]?$",
        r"^[0-9]+\.\s*(Sí|No|Tal vez|Si|NO)",
        r"^[▸►•‣▪➢]",
        r"^\[.*\]$",
        r"^[¿?].*[¿?]$",  # Líneas que son preguntas sueltas (sin contexto)
    ]
    
    for line in lines:
        line = line.strip()
        if not line:
            continue
        
        # Saltar líneas que son puramente opciones (pero no títulos)
        if len(line.split()) <= 3 and line.lower() in ["sí", "no", "tal vez", "si", "no", "tal vez", "ok", "okay"]:
            continue
        
        # Si la línea coincide con algún patrón de diálogo, la omitimos
        if any(re.match(p, line, re.IGNORECASE) for p in patterns):
            continue
        
        cleaned.append(line)
    
    return "\n".join(cleaned)


def extract_question_from_chunk(chunk: str) -> str:
    """
    Extrae la pregunta de un fragmento Q&A (si existe)
    Busca líneas que comiencen con ## o ### y contengan "¿"
    """
    lines = chunk.split("\n")
    for line in lines:
        line = line.strip()
        if re.match(r"^#+\s+¿", line):
            return line.replace("##", "").replace("###", "").strip()
        if re.match(r"^¿", line):
            return line.strip()
    return ""


def main():
    logger.info("=" * 60)
    logger.info("🚀 INICIANDO INDEXACIÓN DE DOCUMENTOS DRTPE")
    logger.info("=" * 60)
    
    # Verificar que existe la carpeta data
    if not os.path.exists(DATA_DIR):
        logger.error(f"❌ La carpeta '{DATA_DIR}' no existe. Créala y coloca tus documentos allí.")
        return
    
    # Verificar que hay archivos (soportamos .md, .pdf, .docx, .txt)
    files = [f for f in os.listdir(DATA_DIR) if f.endswith(('.pdf', '.docx', '.md', '.txt'))]
    if not files:
        logger.error(f"❌ No se encontraron archivos .pdf, .docx, .md o .txt en '{DATA_DIR}'")
        logger.info("📌 Coloca tus documentos en la carpeta 'data/' y vuelve a ejecutar.")
        return
    
    logger.info(f"📁 Encontrados {len(files)} archivos: {', '.join(files)}")
    
    # Inicializar VectorStore
    store = VectorStore(persist_dir=settings.CHROMA_PERSIST_DIR)
    logger.info(f"📊 Conectado a ChromaDB en: {settings.CHROMA_PERSIST_DIR}")
    
    all_texts = []
    all_metadatas = []
    stats = {"total_chunks": 0, "archivos_procesados": 0, "errores": 0}
    
    for filename in files:
        filepath = os.path.join(DATA_DIR, filename)
        logger.info(f"\n📄 Procesando: {filename}")
        
        try:
            # 1. Cargar documento (soporta PDF, DOCX, MD, TXT ahora)
            raw_text = load_document(filepath)
            logger.info(f"   📝 Texto extraído: {len(raw_text)} caracteres")
            
            # 2. Limpiar texto (elimina diálogos, preserva Markdown)
            clean_text_content = clean_text(raw_text)
            logger.info(f"   🧹 Texto limpio: {len(clean_text_content)} caracteres")
            
            # 3. Dividir en fragmentos (chunks)
            chunks = split_text(clean_text_content)
            logger.info(f"   ✂️ Generados {len(chunks)} fragmentos")
            
            # 4. Preparar metadatos para cada fragmento
            for i, chunk in enumerate(chunks):
                pregunta = extract_question_from_chunk(chunk)
                
                # 🔥 CORRECCIÓN: Convertir None a string vacío y asegurar tipos
                metadata = {
                    "source": str(filename),
                    "chunk_index": i,
                    "total_chunks": len(chunks),
                    "pregunta": str(pregunta) if pregunta else "",
                    "tema": str(filename.replace(".md", "").replace(".pdf", "").replace(".docx", "").replace("_", " ").title()),
                    "tipo": "qna" if pregunta else "general"
                }
                all_metadatas.append(metadata)
                all_texts.append(chunk)
            
            stats["archivos_procesados"] += 1
            stats["total_chunks"] += len(chunks)
            
        except Exception as e:
            logger.error(f"   ❌ Error procesando {filename}: {e}")
            stats["errores"] += 1
            continue
    
    # 5. Indexar en ChromaDB
    if all_texts:
        logger.info("\n" + "=" * 60)
        logger.info(f"💾 Indexando {len(all_texts)} fragmentos en ChromaDB...")
        logger.info("=" * 60)
        
        try:
            store.add_documents(all_texts, all_metadatas)
            
            collection_count = store.collection.count()
            logger.info("\n✅ ¡INDEXACIÓN COMPLETADA EXITOSAMENTE!")
            logger.info(f"   📊 Total fragmentos indexados: {collection_count}")
            logger.info(f"   📁 Archivos procesados: {stats['archivos_procesados']}/{len(files)}")
            logger.info(f"   📄 Fragmentos generados: {stats['total_chunks']}")
            
            if stats["errores"] > 0:
                logger.warning(f"   ⚠️ Errores en {stats['errores']} archivos")
            
            # Mostrar distribución por tema
            temas = {}
            for metadata in all_metadatas:
                tema = metadata.get("tema", "Desconocido")
                temas[tema] = temas.get(tema, 0) + 1
            
            logger.info("\n📊 Distribución por tema:")
            for tema, count in sorted(temas.items(), key=lambda x: x[1], reverse=True):
                logger.info(f"   - {tema}: {count} fragmentos")
            
            # Mostrar ejemplos
            logger.info("\n📌 Ejemplos de fragmentos indexados (primeros 3):")
            sample = store.collection.get(limit=3)
            for i, doc in enumerate(sample.get('documents', [])):
                preview = doc[:150] + "..." if len(doc) > 150 else doc
                logger.info(f"   {i+1}. {preview}")
            
        except Exception as e:
            logger.error(f"❌ Error durante la indexación en ChromaDB: {e}")
            import traceback
            traceback.print_exc()
            return
    else:
        logger.error("❌ No se pudo indexar ningún fragmento. Verifica que los documentos tengan contenido válido.")
        return
    
    logger.info("\n" + "=" * 60)
    logger.info("🎉 ¡LISTO! El chatbot ahora puede usar esta información.")
    logger.info("=" * 60)


if __name__ == "__main__":
    main()