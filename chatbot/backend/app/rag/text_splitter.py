from langchain_text_splitters import RecursiveCharacterTextSplitter

def split_text(text: str, chunk_size: int = 600, chunk_overlap: int = 80):
    splitter = RecursiveCharacterTextSplitter(
        chunk_size=chunk_size,
        chunk_overlap=chunk_overlap,
        separators=["\n\n##", "\n\n###", "\n\n", "\n", ". ", " ", ""],
        length_function=len,
    )
    return splitter.split_text(text)
