from flask import Flask, request, jsonify
from dotenv import load_dotenv
import os
from models.emotion_model import detect_emotions
from models.chatbot_model import get_response_from_gemini
from models.chatbot_lite_model import train_and_save_model, chatbot_lite_response

# Load environment variables
load_dotenv()

# Konfigurasi API
app = Flask(__name__)
DATASET_PATH = "datasets/dataset.csv"

@app.before_request
def verify_api_key():
    api_key = request.headers.get('Authorization')  # Ambil API key dari header Authorization
    if api_key != f"Bearer {os.getenv('FLASK_API_KEY')}":
        return jsonify({"error": "Unauthorized"}), 401

@app.route('/emotion', methods=['POST'])
def emotion_analysis():
    try:
        data = request.json
        text = data.get("text", "")
        if not text:
            return jsonify({"error": "Text is required"}), 400

        # Analisis Emosi
        result = detect_emotions(text)
        return jsonify({"emotion_results": result})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route('/chatbot', methods=['POST'])
def chatbot_response():
    try:
        data = request.json

        # Ambil riwayat percakapan dan pesan baru
        riwayat = data.get('riwayat', [])
        pesan_baru = data.get('pesan_baru', '')

        if not pesan_baru:
            return jsonify({"error": "Pesan baru diperlukan"}), 400

        # Gabungkan riwayat percakapan menjadi satu string
        context = "\n".join([f"{pesan['pengirim']}: {pesan['teks']}" for pesan in riwayat])

        # Buat prompt dengan konteks percakapan
        prompt = f"{context}\nPengguna: {pesan_baru}\nBot:"
        
        # Panggil model chatbot
        response = get_response_from_gemini(prompt)

        return jsonify({"chatbot_response": response})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route('/train-chatbot-lite', methods=['POST'])
def train_chatbot_lite():
    try:
        file = request.files.get('dataset')
        if not file:
            return jsonify({"error": "Dataset file diperlukan."}), 400

        file.save(DATASET_PATH)
        result = train_and_save_model(DATASET_PATH)
        return jsonify(result)
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route('/chatbot-lite', methods=['POST'])
def chatbot_lite():
    try:
        data = request.json
        user_input = data.get("pesan_baru", "")

        if not user_input:
            return jsonify({"error": "Pesan baru diperlukan."}), 400

        response = chatbot_lite_response(user_input, DATASET_PATH)
        return jsonify({"chatbot_response": response})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True, port=9999)  # Gunakan port 9999
