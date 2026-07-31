import os
from dotenv import load_dotenv

load_dotenv()

class Settings:
    # ChromaDB
    CHROMA_PERSIST_DIR = os.getenv("CHROMA_PERSIST_DIR", "./chroma_db")
    MAX_CONTEXT_CHUNKS = int(os.getenv("MAX_CONTEXT_CHUNKS", "4"))
    SIMILARITY_THRESHOLD = float(os.getenv("SIMILARITY_THRESHOLD", "0.65"))
    
    # Gemini - Usamos GOOGLE_API_KEY (nombre estándar)
    GOOGLE_API_KEY = os.getenv("GOOGLE_API_KEY", "")
    GEMINI_MODEL = os.getenv("GEMINI_MODEL", "gemini-3.5-flash-lite")
    
    # Historial
    MAX_HISTORY_LENGTH = int(os.getenv("MAX_HISTORY_LENGTH", "10"))

settings = Settings()