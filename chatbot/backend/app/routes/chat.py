from fastapi import APIRouter, HTTPException
from app.models import ChatRequest, ChatResponse
from app.rag.rag_chain import RAGChain
import logging

router = APIRouter(prefix="/chat", tags=["chat"])
logger = logging.getLogger(__name__)
rag = RAGChain()

@router.post("/", response_model=ChatResponse)
async def chat_endpoint(request: ChatRequest):
    try:
        answer, sources = await rag.ask(request.message)
        needs_derivation = False
        if "no tengo información" in answer.lower() or "contactarnos" in answer.lower():
            needs_derivation = True
        return ChatResponse(answer=answer, sources=sources, needs_derivation=needs_derivation)
    except Exception as e:
        logger.error(f"Error en chat: {e}")
        raise HTTPException(status_code=500, detail="Error interno del servidor")