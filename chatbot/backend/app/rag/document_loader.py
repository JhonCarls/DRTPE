import PyPDF2
import docx
from pathlib import Path

def load_pdf(file_path: str) -> str:
    """Extrae texto de un archivo PDF"""
    with open(file_path, 'rb') as f:
        reader = PyPDF2.PdfReader(f)
        text = ""
        for page in reader.pages:
            text += page.extract_text() or ""
    return text

def load_docx(file_path: str) -> str:
    """Extrae texto de un archivo Word (.docx)"""
    doc = docx.Document(file_path)
    return "\n".join([para.text for para in doc.paragraphs])

def load_md(file_path: str) -> str:
    """Lee un archivo Markdown como texto plano"""
    with open(file_path, 'r', encoding='utf-8') as f:
        return f.read()

def load_txt(file_path: str) -> str:
    """Lee un archivo de texto plano"""
    with open(file_path, 'r', encoding='utf-8') as f:
        return f.read()

def load_document(file_path: str) -> str:
    """
    Carga un documento según su extensión.
    Soporta: .pdf, .docx, .md, .txt
    """
    ext = Path(file_path).suffix.lower()
    if ext == '.pdf':
        return load_pdf(file_path)
    elif ext == '.docx':
        return load_docx(file_path)
    elif ext == '.md':
        return load_md(file_path)
    elif ext == '.txt':
        return load_txt(file_path)
    else:
        raise ValueError(f"Formato no soportado: {ext}")