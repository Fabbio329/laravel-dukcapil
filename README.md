# 🏛️ Website Pelayanan Administrasi Dukcapil Mandiri

Website ini adalah platform pelayanan publik digital untuk mempermudah warga dalam mengurus dokumen kependudukan secara mandiri (seperti KTP, KK, dan Akta Kelahiran). Proyek ini dibangun sebagai tugas kelompok untuk mata kuliah **[Nama Mata Kuliah, contoh: Pemrograman Web / Rekayasa Perangkat Lunak]**.

---

## 👥 Anggota Kelompok & Pembagian Tugas

Berikut adalah anggota Kelompok **[Nama/Nomor Kelompok]** beserta tanggung jawab utama dalam pengembangan proyek:

| Nama Anggota | NIM | Peran Utama | Tanggung Jawab / Fitur yang Dikerjakan |
| :--- | :--- | :--- | :--- |
| **[Nama Ketua]** | `[NIM]` | Project Manager & Backend | - Setup database & autentikasi (JWT)<br>- API CRUD Data Kependudukan<br>- Integrasi enkripsi file |
| **[Nama Anggota 2]** | `[NIM]` | Frontend Developer | - Slicing UI Dashboard Warga & Admin<br>- Integrasi API Pengajuan Dokumen<br>- Validasi form sisi klien |
| **[Nama Anggota 3]** | `[NIM]` | UI/UX Designer & QA | - Desain Figma & User Flow<br>- Testing fitur (Blackbox Testing)<br>- Penyusunan dokumentasi & README |
| **[Nama Anggota 4]** | `[NIM]` | Fullstack Helper | - Fitur Tracking Status Pengajuan<br>- Sistem Notifikasi WhatsApp/Email Berbasis Trigger |

---

## 🛠️ Tech Stack (Teknologi yang Digunakan)

Kolaborasi kami menggunakan ekosistem teknologi berikut:
* **Frontend:** [Contoh: React.js + Tailwind CSS / Vue.js]
* **Backend:** [Contoh: Node.js + Express / Laravel]
* **Database:** [Contoh: PostgreSQL / MySQL]
* **Tools Kolaborasi:** Figma (Desain), Trello/Notion (Manajemen Tugas), Git & GitHub (Version Control).

---

## 📌 Alur Kerja Git Kelompok (Git Workflow)

Untuk menghindari konflik kode (*merge conflicts*), kelompok kami menerapkan aturan Branching Git sebagai berikut:

1. **`main` / `master`**: Branch produksi yang siap dinilai. Tidak ada yang boleh push langsung ke sini.
2. **`development`**: Branch utama untuk menggabungkan semua fitur yang sudah selesai diuji.
3. **`feature/[nama-fitur]`**: Branch masing-masing anggota untuk ngoding fitur spesifik (contoh: `feature/login-page`, `feature/api-kk`).

**Cara Berkontribusi di Project Ini:**
```bash
# 1. Clone repositori ini
git clone [https://github.com/](https://github.com/)[username]/[repo-name].git

# 2. Pindah ke branch development dan pastikan up-to-date
git checkout development
git pull origin development

# 3. Buat branch fitur baru sesuai tugas Anda
git checkout -b feature/fitur-saya

# 4. Setelah selesai, push ke GitHub dan buat Pull Request (PR) ke branch development
git add .
git commit -m "feat: menyelesaikan halaman pengajuan KTP"
git push origin feature/fitur-saya