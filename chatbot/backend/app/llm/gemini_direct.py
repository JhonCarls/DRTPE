import logging
import asyncio
from google import genai
from app.config import settings
from app.llm.base import LLMProvider

logger = logging.getLogger(__name__)

class GeminiDirectProvider(LLMProvider):
    def __init__(self):
        api_key = settings.GOOGLE_API_KEY
        if not api_key:
            logger.error("❌ GOOGLE_API_KEY no configurada en .env")
            self.client = None
            self.model_name = None
            return

        try:
            # El cliente usa automáticamente GOOGLE_API_KEY
            self.client = genai.Client(api_key=api_key)
            self.model_name = settings.GEMINI_MODEL
            logger.info(f"✅ Gemini Direct inicializado con modelo: {self.model_name}")
        except Exception as e:
            logger.error(f"❌ Error inicializando Gemini: {e}")
            self.client = None
            self.model_name = None

    async def generate_response(self, prompt: str) -> str:
        if not self.client or not self.model_name:
            return "Lo siento, no pude conectar con Gemini. ¿Te gustaría que te derive a un asesor?"

        try:
            response = await asyncio.to_thread(
                self.client.models.generate_content,
                model=self.model_name,
                contents=prompt
            )
            return response.text if response.text else "No pude generar una respuesta."
        except Exception as e:
            logger.error(f"Error con Gemini: {e}")
            return "Lo siento, en este momento tengo problemas técnicos. ¿Te gustaría que te derive a un asesor?"