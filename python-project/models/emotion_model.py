from transformers import pipeline
from deep_translator import GoogleTranslator

# Inisialisasi pipeline untuk deteksi emosi
emotion_classifier = pipeline("text-classification", model="j-hartmann/emotion-english-distilroberta-base", top_k=None)

def detect_emotions(text):
    if not text.strip():
        return {"error": "Input kosong. Harap masukkan teks yang valid."}

    # Terjemahkan teks dari Bahasa Indonesia ke Bahasa Inggris
    translated_text = GoogleTranslator(source='id', target='en').translate(text)

    # Lakukan deteksi emosi pada teks terjemahan
    emotion_result = emotion_classifier(translated_text)

    # Format hasil deteksi
    return [{"label": emotion["label"], "score": emotion["score"]} for emotion in emotion_result[0]]

if __name__ == "__main__":
    # Contoh teks untuk pengujian
    sample_text = input("Masukkan teks:")
    result = detect_emotions(sample_text)
    print("Hasil deteksi emosi:")
    for emotion in result:
        print(f"{emotion['label']}: {emotion['score']:.4f}")
