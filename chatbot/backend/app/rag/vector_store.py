import chromadb
from chromadb.config import Settings
from app.rag.embeddings import LocalEmbeddings

class VectorStore:
    def __init__(self, persist_dir: str = "./chroma_db", collection_name: str = "drta_docs"):
        self.client = chromadb.PersistentClient(path=persist_dir, settings=Settings(anonymized_telemetry=False))
        self.collection = self.client.get_or_create_collection(name=collection_name)
        self.embeddings = LocalEmbeddings()
    
    def add_documents(self, texts: list[str], metadatas: list[dict] = None):
        ids = [f"doc_{i}" for i in range(len(texts))]
        embeddings = self.embeddings.embed_documents(texts)
        self.collection.add(
            documents=texts,
            embeddings=embeddings,
            metadatas=metadatas or [{} for _ in texts],
            ids=ids
        )
    
    def similarity_search(self, query: str, k: int = 3) -> list[str]:
        query_emb = self.embeddings.embed_query(query)
        results = self.collection.query(query_embeddings=[query_emb], n_results=k)
        return results['documents'][0] if results['documents'] else []