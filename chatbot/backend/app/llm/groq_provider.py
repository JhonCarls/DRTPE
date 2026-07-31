import httpx
from app.llm.base import LLMProvider
from app.config import settings

class GroqProvider(LLMProvider):
    def __init__(self, api_key: str = settings.GROQ_API_KEY, model: str = settings.GROQ_MODEL):
        self.api_key = api_key
        self.model = model
    
    async def generate_response(self, prompt: str) -> str:
        headers = {"Authorization": f"Bearer {self.api_key}", "Content-Type": "application/json"}
        payload = {
            "model": self.model,
            "messages": [{"role": "user", "content": prompt}],
            "temperature": 0.3,
        }
        async with httpx.AsyncClient(timeout=60.0) as client:
            response = await client.post(
                "https://api.groq.com/openai/v1/chat/completions",
                headers=headers,
                json=payload
            )
            response.raise_for_status()
            data = response.json()
            return data["choices"][0]["message"]["content"].strip()