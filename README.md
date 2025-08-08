# 📌 UAS – Proyek Manajemen Tugas

## 📖 Deskripsi Proyek
Aplikasi ini adalah sebuah platform web untuk manajemen tugas pribadi dan delegasi.  
Dibangun menggunakan framework **Laravel**, aplikasi ini memungkinkan pengguna untuk membuat, melacak, dan mengelola tugas mereka dengan fitur-fitur seperti **prioritas, kategori, pengingat, dan lampiran file**.

---

## 🚀 Fitur-Fitur Utama
- 🔐 **Autentikasi Pengguna** – Login dan Register.
- 📝 **CRUD Tugas** – Buat, baca, perbarui, dan hapus tugas pribadi.
- 📂 **CRUD Kategori** – Mengatur kategori untuk pengorganisasian tugas.
- 👥 **Delegasi Tugas** – Menugaskan tugas kepada pengguna lain.
- 📎 **Unggah Lampiran** – Melampirkan dokumen atau gambar pada tugas.
- 🔍 **Pencarian & Filter** – Menyaring tugas berdasarkan kata kunci atau kategori.
- ⏰ **Notifikasi Pengingat** – Pengingat otomatis untuk tugas yang mendekati tenggat.
- 📄 **Ekspor ke PDF** – Mengunduh daftar tugas dalam format PDF.
- 📱 **Antarmuka Responsif** – Tampilan optimal untuk desktop & mobile.

---

## 🛠️ Teknologi yang Digunakan
- **Backend:** Laravel
- **Frontend:** Tailwind CSS
- **Database:** MySQL  
- **Library Tambahan:**
  - `barryvdh/laravel-dompdf` – untuk ekspor PDF

---

## ⚙️ Cara Instalasi
1. **Clone repositori**
   
   git clone https://github.com/BGSPBO/UAS-PBW.git
   
   cd UAS-PBW
   
3. **Instal dependensi Composer**
   
   composer install

4. **Konfigurasi environment**
   
   cp .env.example .env
   
6. Edit file .env dan sesuaikan konfigurasi database:
   
   DB_DATABASE=nama_database
   
   DB_USERNAME=root
   
   DB_PASSWORD=

7.**buat key**

   php artisan key:generate

8. **Migrasi database**
   
   php artisan migrate

9. **Buat symbolic link untuk storage**
    
    php artisan storage:link

10. **Jalankan server pengembangan**
    
    php artisan serve
