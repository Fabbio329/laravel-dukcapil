# 🏛️ Website Pelayanan Administrasi Dukcapil Mandiri

Website ini adalah platform pelayanan publik digital yang dirancang untuk mempermudah warga dalam melakukan pengurusan dokumen kependudukan secara mandiri (seperti KTP Baru, Kartu Keluarga, dan Akta Kelahiran)[cite: 1, 2]. Proyek ini dibangun secara kolaboratif sebagai tugas kelompok untuk memenuhi penilaian mata kuliah **Pemrograman Web Lanjut**[cite: 1, 2].

---

## 👥 Anggota Tim & Pembagian Modul

Sistem ini dibagi menjadi **4 modul utama** dengan tingkat kompleksitas yang setara untuk memastikan setiap anggota memberikan kontribusi kode yang seimbang pada repositori Git[cite: 1, 2]:

| Anggota Tim | Peran Utama | Tanggung Jawab & Fitur yang Dikerjakan |
| :--- | :--- | :--- |
| **Steffany**<br>NIM: `1062527` | **Backend Architect** | - Perancangan skema, relasi database, dan migrasi tabel[cite: 1, 2].<br>- Membuat RESTful API CRUD untuk seluruh data kependudukan & berkas[cite: 1, 2].<br>- Mengamankan sistem autentikasi pendaftaran berbasis NIK menggunakan hash enkripsi[cite: 1, 2]. |
| **Gibran Al Ghifari**<br>NIM: `1062508` | **Frontend: Citizen Portal** | - Implementasi UI Landing Page dan halaman informasi syarat layanan[cite: 1, 2].<br>- Membangun form pengajuan interaktif bagi warga (Input data + unggah berkas syarat)[cite: 1, 2].<br>- Validasi input sisi klien (Format 16 digit NIK, ukuran file, dan ekstensi berkas)[cite: 1, 2]. |
| **Fabio**<br>NIM: `1062507` | **Frontend: Admin Dashboard** | - Membuat panel Dashboard Petugas Dukcapil untuk proses verifikasi & approval berkas[cite: 1, 2].<br>- Mengembangkan sistem penyaringan (filter), pencarian, dan manajemen antrean status berkas[cite: 1, 2].<br>- Menyajikan visualisasi tren data atau grafik statistik kependudukan sederhana[cite: 1, 2]. |
| **Wilson Fernando**<br>NIM: `1062530` | **Fullstack Integration & QA** | - Sinkronisasi dan menghubungkan (slicing) API Backend ke dalam komponen UI Frontend[cite: 1, 2].<br>- Mengembangkan fitur *Real-Time Tracking Status* pengajuan dokumen untuk sisi akun warga[cite: 1, 2].<br>- Bertanggung jawab penuh atas pengujian fungsionalitas (End-to-End Testing) dan penyusunan dokumentasi[cite: 1, 2]. |

---

## 🛠️ Arsitektur Teknologi (Tech Stack)

Aplikasi ini dibangun menggunakan arsitektur modern yang memisahkan komponen sistem secara modular[cite: 2]:
- **Frontend Layer:** [Misal: React.js / Vue.js / HTML5 + Tailwind CSS][cite: 2]
- **Backend Layer:** [Misal: Node.js + Express / Laravel / PHP Native][cite: 2]
- **Database System:** [Misal: PostgreSQL / MySQL][cite: 2]
- **Alat Pendukung:** Figma (UI Design), Postman (API Testing), Git & GitHub (Version Control)[cite: 2].

---

## 📌 Alur Kolaborasi Repositori Git

Kami menggunakan model percabangan fitur (*Feature Branching Workflow*) untuk menjaga repositori tetap bersih dan meminimalkan terjadinya konflik kode (*merge conflicts*)[cite: 2]:

1. **`main`**: Berisi kode produksi yang stabil dan siap dinilai. Proteksi aktif diterapkan (tidak ada push langsung ke cabang ini)[cite: 2].
2. **`development`**: Cabang integrasi tempat menggabungkan seluruh fitur yang sudah selesai dikembangkan sebelum naik ke main[cite: 2].
3. **`feature/[nama-fitur]`**: Cabang kerja mandiri tiap anggota (contoh: `feature/api-autentikasi` atau `feature/ui-dashboard`)[cite: 2].

### Langkah Pengembangan Fitur Baru:
```bash
# 1. Pastikan Anda berada di cabang development terbaru
git checkout development
git pull origin development

# 2. Buat cabang baru khusus untuk fitur yang Anda kerjakan
git checkout -b feature/fitur-pilihan-anda

# 3. Selesaikan pengodean, lakukan commit secara berkala
git add .
git commit -m "feat: deskripsi singkat mengenai perubahan fitur"

# 4. Kirim cabang ke repositori GitHub dan ajukan Pull Request (PR)
git push origin feature/fitur-pilihan-anda
```[cite: 2]

---

## 🔒 Protokol Keamanan & Data Privasi

Mengingat aplikasi ini mengelola dokumen dan data kependudukan (NIK, Nama, Alamat) yang bersifat rahasia, proyek ini menerapkan simulasi perlindungan data[cite: 2]:
> ⚠️ **KEBIJAKAN PRIVASI:**
> 1. **Hashing Kredensial:** Seluruh kata sandi warga wajib di-hash menggunakan algoritma aman sebelum disimpan ke database[cite: 2].
> 2. **Proteksi Unggahan Syarat:** File dokumen warga (seperti scan KK/KTP lama) disimpan pada direktori privat. Akses langsung melalui URL publik ditutup menggunakan middleware validasi token[cite: 2].
> 3. **Variabel Lingkungan:** File konfigurasi database `.env` wajib dimasukkan ke dalam `.gitignore` dan dilarang keras diunggah ke repositori publik[cite: 2].

---

## 🚀 Panduan Menjalankan Proyek secara Lokal

### Prasyarat Sistem
Pastikan perangkat Anda telah terinstalasi oleh[cite: 2]:
- Runtime Environment: `Node.js (v18+)` / Paket Server: `XAMPP (PHP 8.x)`[cite: 2]
- Git Version Control[cite: 2]

### Langkah Penyiapan
1. **Kloning Repositori:**
   ```bash
   git clone [https://github.com/](https://github.com/)[username]/[nama-repo].git
   cd [nama-repo]
   ```[cite: 2]
2. **Instalasi Dependensi:**
   *(Sesuaikan dengan struktur direktori arsitektur proyek Anda)*
   ```bash
   # Contoh jika menggunakan Node/Express & React terpisah
   cd backend && npm install
   cd ../frontend && npm install
   ```[cite: 2]
3. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` pada folder backend/root yang sesuai, lalu sesuaikan kredensial koneksi database lokal Anda[cite: 2].
4. **Menjalankan Aplikasi:**
   ```bash
   # Jalankan sisi Backend
   npm run start
   
   # Jalankan sisi Frontend
   npm run dev
   ```[cite: 2]