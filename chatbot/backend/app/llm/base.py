from abc import ABC, abstractmethod

class LLMProvider(ABC):
    @abstractmethod
    async def generate_response(self, prompt: str) -> str:
        """Genera una respuesta a partir del prompt"""
        pass