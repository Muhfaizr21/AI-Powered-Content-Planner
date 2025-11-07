# 🧠 AI-Powered Content Planner

**AI-Powered Content Planner** adalah aplikasi berbasis **Laravel + Inertia.js (React)** yang membantu kreator konten merencanakan ide, caption, dan jadwal posting media sosial secara otomatis menggunakan kecerdasan buatan (OpenAI API).

Proyek ini dirancang untuk **Full Stack Developer modern** yang ingin mempelajari:
- Integrasi Laravel + Inertia.js (SPA hybrid)
- Pemanggilan API eksternal (OpenAI)
- Manajemen data terstruktur (konten, jadwal, statistik)
- Desain UI/UX dinamis dan futuristik

---

## 🚀 Fitur Utama

### 🔹 1. AI Content Generator
Masukkan **tema**, dan sistem akan menghasilkan 3–5 ide konten:
- Judul posting
- Caption singkat
- Sudut pandang kreatif

> Dibangun dengan integrasi langsung ke OpenAI Chat Completion API.

---

### 🔹 2. Content Management
CRUD penuh untuk setiap ide konten:
- Simpan, edit, hapus ide
- Atur status: `draft`, `approved`, `scheduled`
- Tambahkan hashtag atau angle unik

---

### 🔹 3. Schedule Manager
Rencanakan jadwal posting lintas platform:
- Pilih platform: `TikTok`, `Instagram`, `X`, `YouTube`
- Kalender interaktif (React Calendar)
- Status update otomatis: `pending`, `posted`, `canceled`

---

### 🔹 4. Manual Performance Tracker
Catat hasil performa konten setelah diposting:
- Views, likes, comments
- Visualisasi data (Recharts / Chart.js)
- Insight tren performa mingguan

---

## 🧩 Tech Stack

| Layer | Teknologi |
|-------|------------|
| **Backend** | Laravel 11 |
| **Frontend** | Inertia.js + React |
| **Styling** | TailwindCSS |
| **Database** | MySQL |
| **AI Engine** | OpenAI API (gpt-4o-mini / gpt-4-turbo) |
| **Charts** | Recharts / Chart.js |
| **Auth** | Laravel Breeze (Inertia preset) |

---

## ⚙️ Instalasi

### 1. Clone Repositori
```bash
git clone https://github.com/username/ai-content-planner.git
cd ai-content-planner
