from app.llm.base import LLMProvider
from app.llm.gemini_direct import GeminiDirectProvider

def get_llm_provider() -> LLMProvider:
    """Retorna el proveedor de Gemini configurado (Direct)"""
    return GeminiDirectProvider()