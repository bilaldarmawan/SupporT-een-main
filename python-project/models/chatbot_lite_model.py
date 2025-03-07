import pandas as pd
import numpy as np
from transformers import AutoTokenizer, AutoModel
from sklearn.svm import SVC
from sklearn.metrics.pairwise import cosine_similarity
import joblib
import torch
import os

# Path ke file model
MODEL_PATH = "models/chatbot_lite_model.pkl"

# Load tokenizer dan model IndoBERT
model_name = "indobenchmark/indobert-base-p2"
tokenizer = AutoTokenizer.from_pretrained(model_name)
model = AutoModel.from_pretrained(model_name)

# Fungsi untuk menghasilkan embeddings
def get_embeddings(texts):
    inputs = tokenizer(texts, return_tensors="pt", padding=True, truncation=True, max_length=512)
    with torch.no_grad():
        outputs = model(**inputs)
        embeddings = outputs.last_hidden_state.mean(dim=1)  # Mean pooling
    return embeddings.numpy()

# Fungsi untuk melatih model dan menyimpan ke file
def train_and_save_model(dataset_path):
    print(f"Membaca dataset dari {dataset_path}...")
    data = pd.read_csv(dataset_path)

    # Pastikan dataset memiliki kolom yang dibutuhkan
    required_columns = {"Input", "Input_Intent"}
    if not required_columns.issubset(data.columns):
        raise ValueError(f"Dataset harus memiliki kolom: {required_columns}")

    # Generate embeddings untuk Input
    print("Menghasilkan embeddings...")
    input_intent_data = data[["Input", "Input_Intent"]].dropna().reset_index(drop=True)
    input_intent_data["Input_Embedding"] = list(get_embeddings(input_intent_data["Input"].tolist()))

    # Fitur (X) dan Label (y)
    X = np.stack(input_intent_data["Input_Embedding"].values)
    y = input_intent_data["Input_Intent"]

    # Latih model SVM
    print("Melatih model SVM...")
    svm_classifier = SVC(kernel="linear", probability=True)
    svm_classifier.fit(X, y)

    # Simpan model
    print(f"Menyimpan model ke {MODEL_PATH}...")
    joblib.dump(svm_classifier, MODEL_PATH)
    print("Model berhasil disimpan.")

    return {"message": "Model berhasil dilatih dan disimpan."}

# Fungsi untuk memuat model
def load_chatbot_model():
    if os.path.exists(MODEL_PATH):
        print(f"Memuat model dari {MODEL_PATH}")
        return joblib.load(MODEL_PATH)
    else:
        raise FileNotFoundError(f"Model file {MODEL_PATH} tidak ditemukan. Latih model terlebih dahulu.")

# Fungsi untuk menghasilkan respons dari chatbot lite
def chatbot_lite_response(user_input, dataset_path="datasets/dataset.csv"):
    print("Memuat model chatbot lite...")
    svm_classifier = load_chatbot_model()

    print(f"Membaca dataset respons dari {dataset_path}...")
    data = pd.read_csv(dataset_path)
    response_data = data[["Response", "Response_Intent"]].dropna().reset_index(drop=True)
    response_data["Response_Embedding"] = list(get_embeddings(response_data["Response"].tolist()))

    user_embedding = get_embeddings([user_input])
    predicted_probs = svm_classifier.predict_proba(user_embedding)
    predicted_intent = svm_classifier.classes_[np.argmax(predicted_probs)]
    confidence = np.max(predicted_probs)

    if confidence < 0.5:
        return "Maaf saya tidak memahami dengan maksud Anda."

    intent_responses = response_data[response_data["Response_Intent"] == predicted_intent]
    if intent_responses.empty:
        return "Maaf, tidak ada respons yang sesuai."

    response_embeddings = np.stack(intent_responses["Response_Embedding"].values)
    similarities = cosine_similarity(user_embedding, response_embeddings).flatten()
    best_match_idx = np.argmax(similarities)
    return intent_responses.iloc[best_match_idx]["Response"]
