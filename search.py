# Search.py
import vosk

# Function to search and initialize language model
def initialize_model(language):
    model = vosk.Model(lang=language)
    return model
