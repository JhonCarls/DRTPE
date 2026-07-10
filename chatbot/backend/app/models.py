from pydantic import BaseModel

class ChatRequest(BaseModel):
    message: str
    session_id: str | None = None

class ChatResponse(BaseModel):
    answer: str
    sources: list[str] | None = None
    needs_derivation: bool = False

class ContactRequest(BaseModel):
    name: str
    email: str
    phone: str
    message: str