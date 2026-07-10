from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from app.routes import chat, contact
import logging

logging.basicConfig(level=logging.INFO)

app = FastAPI(title="DRTPE Chatbot API", version="1.0")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost",
        "http://localhost:8000",
        "http://localhost:8080",
        "http://127.0.0.1",
        "http://127.0.0.1:8000",
        "http://localhost/DRTPE/DRTPE/public",  # Si usas esta URL
        "*","*"],  # Restringe en producción
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

app.include_router(chat.router)
app.include_router(contact.router)

@app.get("/health")
async def health():
    return {"status": "ok"}