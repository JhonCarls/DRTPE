from fastapi import APIRouter
from app.models import ContactRequest
import logging

router = APIRouter(prefix="/contact", tags=["contact"])
logger = logging.getLogger(__name__)

@router.post("/")
async def contact_endpoint(contact: ContactRequest):
    # Aquí guardar en BD o enviar correo
    logger.info(f"Contacto recibido: {contact.dict()}")
    return {"message": "Datos enviados correctamente. Un asesor se comunicará pronto."}