# Personal Landing Page (PHP Native + MySQL)

Landing page personal yang dibuat menggunakan **PHP Native** dan terhubung ke database **MySQL**, dengan tampilan visual minimalis, modern, responsif, dan interaktif.

---

## 📁 Struktur File
- **[`index.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/index.php)**: Halaman utama landing page yang menampilkan data profil, keahlian, proyek showcase, dan formulir kirim pesan.
- **[`db.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/db.php)**: Konfigurasi koneksi MySQL menggunakan PDO (dilengkapi auto-create database & table).
- **[`seed.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/seed.php)**: Skrip 1-klik untuk mengisi database dengan **data dummy lengkap**.
- **[`test_db.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/test_db.php)**: Halaman diagnostik untuk mengecek status koneksi MySQL secara instan.
- **[`database.sql`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/database.sql)**: Skema tabel database beserta kumpulan data dummy.
- **[`setup.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/setup.php)**: Inisialisasi struktur database awal.

---

## 🗄️ Tabel & Data Dummy yang Tersedia (`db_landing_page`)

1. **`profiles`** (1 Data):
   - Nama: Muhammad Yaumil Aditya Warman
   - Title: Cloud Computing & Full-Stack Web Enthusiast
   - Bio: Mahasiswa Teknik Informatika Semester 5 dengan fokus Cloud & PHP
   - Status: Tersedia untuk kolaborasi & projek
2. **`skills`** (10 Data):
   - PHP Native 8.x, MySQL & Relational DB, Cloud Computing (AWS/GCP), Linux Server Administration, Docker Container, Git & GitHub, RESTful API, Nginx & Apache, HTML5 & CSS3, Virtualization.
3. **`projects`** (3 Data Proyek):
   - Sistem Informasi Cloud Monitoring (PHP & Linux)
   - Personal Landing Page Glassmorphism (PHP Native & MySQL)
   - RESTful API Microservice (Docker & API)
4. **`contact_messages`** (3 Pesan Dummy):
   - Komentar/sapaan simulasi dari rekan kampus, tech recruiter, dan cloud engineer.
5. **`socials`** (4 Tautan):
   - GitHub, LinkedIn, Instagram, Email dengan ikon SVG.

---

## 🚀 Cara Mengisi Data Dummy ke MySQL

Pastikan MySQL di **XAMPP** sudah running (tombol Start warna hijau).

### Cara 1: Akses Seeder via Browser (Paling Praktis)
Jalankan server PHP:
```bash
php -S localhost:8000
```
Lalu buka browser ke:
👉 **`http://localhost:8000/seed.php`**

*Semua tabel akan otomatis dibuat dan langsung diisi data dummy lengkap dalam 1 detik.*

### Cara 2: Jalankan via Terminal / CLI
```bash
php seed.php
```

### Cara 3: Impor Manual via phpMyAdmin
Buka `http://localhost/phpmyadmin`, pilih menu **Import**, lalu pilih file [`database.sql`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/database.sql).
