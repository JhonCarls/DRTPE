import os
from google import genai

# Leer la clave desde .env o directamente
GOOGLE_API_KEY = os.getenv("GOOGLE_API_KEY", "AQ.Ab8RN6LyZ7D66-B7eXN_Dvwir5jswow95nO5D-ZqqGMDzHtdIw")

print(f"🔑 API Key: {GOOGLE_API_KEY[:15]}...")

# Inicializar cliente
client = genai.Client(api_key=GOOGLE_API_KEY)

# Probar modelo
model = "gemini-3.5-flash-lite"
print(f"🤖 Modelo: {model}")

try:
    response = client.models.generate_content(
        model=model,
        contents="Responde solo 'OK' si estás funcionando"
    )
    print(f"✅ Respuesta: {response.text}")
except Exception as e:
    print(f"❌ Error: {e}")