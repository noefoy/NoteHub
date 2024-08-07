# Write.py
import json

# Function to write recognized text to a text file
def write_text(recognized_text, output_file_path):
    with open(output_file_path, "a") as output_file:
        output_file.write(recognized_text + "\n")
