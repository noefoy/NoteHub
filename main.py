# main.py

import vosk
import pyaudio
import json
from search import initialize_model
from write import write_text

import subprocess

def main():
    # Initialize Vosk model
    model = initialize_model("de")

    # Initialize PyAudio
    p = pyaudio.PyAudio()
    stream = p.open(format=pyaudio.paInt16,
                    channels=1,
                    rate=16000,
                    input=True,
                    frames_per_buffer=8192)

    # Listen to microphone in an infinite loop and write the recognized text to text file and JSON file
    recognized_texts = []
    with open("recognized_text.json", "w") as json_file:
        print("Listening for speech. Say 'Terminate' to stop.")
        rec = vosk.KaldiRecognizer(model, 16000)
        while True:
            data = stream.read(4096)
            if rec.AcceptWaveform(data):
                result = json.loads(rec.Result())
                recognized_text = result['text']
                recognized_texts.append(recognized_text)
                # Write recognized text to text file
                write_text(recognized_text, "recognized_text.txt")
                # Save recognized text as JSON
                json.dump({"recognized_text": recognized_texts}, json_file)
                print(recognized_text)
                if "terminate" in recognized_text.lower():
                    print("Termination keyword detected. Stopping...")
                    break

    # Close streams and terminate PyAudio object
    stream.stop_stream()
    stream.close()
    p.terminate()

if __name__ == "__main__":
    main()
