from sentence_transformers import SentenceTransformer

class LocalEmbeddings:
    def __init__(self, model_name: str = "distiluse-base-multilingual-cased-v2"):
        self.model = SentenceTransformer(model_name)
    
    def embed_documents(self, texts: list[str]) -> list[list[float]]:
        return self.model.encode(texts, convert_to_numpy=True).tolist()
    
    def embed_query(self, query: str) -> list[float]:
        return self.model.encode(query, convert_to_numpy=True).tolist()