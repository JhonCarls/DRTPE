import os
import sys
from pathlib import Path
from app.rag.document_loader import load_document
from app.rag.text_splitter import split_text
from app.rag.vector_store import VectorStore
sys.path.insert(0, str(Path(__file__).parent.parent))
DATA_DIR = "./data"

def main():
    store = VectorStore()
    all_texts = []
    all_metadatas = []
    for filename in os.listdir(DATA_DIR):
        if filename.endswith(('.pdf', '.docx')):
            filepath = os.path.join(DATA_DIR, filename)
            text = load_document(filepath)
            chunks = split_text(text)
            all_texts.extend(chunks)
            all_metadatas.extend([{"source": filename} for _ in chunks])
    if all_texts:
        store.add_documents(all_texts, all_metadatas)
        print(f"Indexados {len(all_texts)} fragmentos.")
    else:
        print("No se encontraron documentos.")

if __name__ == "__main__":
    main()