import os
from app.llm.base import LLMProvider
from app.llm.ollama_provider import OllamaProvider
from app.llm.groq_provider import GroqProvider

def get_llm_provider() -> LLMProvider:
    provider = os.getenv("LLM_PROVIDER", "ollama")
    if provider == "ollama":
        return OllamaProvider()
    elif provider == "groq":
        return GroqProvider()
    else:
        raise ValueError(f"Proveedor no soportado: {provider}")