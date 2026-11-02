# Personal Landing Page (PHP Native + MySQL)

Landing page personal yang dibuat menggunakan **PHP Native** dan terhubung ke database **MySQL**, dengan tampilan visual yang minimalis, modern, dan interaktif.

---

## 📁 Struktur File
- **[`index.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/index.php)**: Halaman utama landing page yang mengambil data dari database MySQL dan menyediakan form kirim pesan.
- **[`db.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/db.php)**: File konfigurasi koneksi database MySQL menggunakan PDO.
- **[`database.sql`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/database.sql)**: Skrip SQL untuk membuat database `db_landing_page`, tabel-tabel, dan data awal (*seeding*).
- **[`setup.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/setup.php)**: Skrip inisialisasi / migrasi otomatis database via browser atau terminal.

---

## 🗄️ Skema Database (`db_landing_page`)

1. **`profiles`**: Menyimpan identitas, bio, judul, status ketersediaan, email, dan inisial avatar.
2. **`skills`**: Menyimpan daftar keahlian & teknologi (PHP, MySQL, Cloud Computing, Linux, Docker, dll).
3. **`socials`**: Menyimpan tautan media sosial dan ikon SVG (GitHub, LinkedIn, Instagram, Email).
4. **`contact_messages`**: Menyimpan pesan masuk dari pengunjung yang mengisi formulir *"Kirim Pesan Cepat"*.

---

## ⚙️ Konfigurasi Koneksi Database

Buka file [`db.php`](file:///c:/Users/Asus/Documents/College/Semester%205/Komputasi%20Awan/Project-PHP/db.php) jika ingin menyesuaikan kredensial MySQL Anda (misal username/password XAMPP / Laragon):

```php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'db_landing_page');
define('DB_USER', 'root');
define('DB_PASS', ''); // default di XAMPP kosong
```

---

## 🚀 Cara Menjalankan Projek & Database

### 1. Nyalakan Layanan MySQL
Pastikan **MySQL / MariaDB** sudah aktif di sistem Anda (misalnya melalui panel **XAMPP Control Panel** atau **Laragon**).

### 2. Inisialisasi Database (Pilih salah satu cara)

- **Cara A (Otomatis via browser - Paling Mudah):**
  Akses URL:
  ```
  http://localhost:8000/setup.php
  ```
  *(Database dan seluruh tabel akan otomatis dibuat dan diisi data awal)*

- **Cara B (Manual via phpMyAdmin):**
  Buka phpMyAdmin (`http://localhost/phpmyadmin`), klik menu **Import**, dan pilih file `database.sql`.

### 3. Jalankan Server Web
Jika menggunakan PHP Built-in Server:
```bash
php -S localhost:8000
```
Buka browser dan buka:
👉 **`http://localhost:8000`**

---

## ✨ Fitur Integrasi MySQL & Visual
- **Indikator Status Koneksi Realtime:** Menampilkan badge status koneksi database di bagian atas (*"MySQL Connected"* atau *"MySQL Offline (Fallback)"*).
- **Graceful Fallback:** Jika database belum siap, website tidak akan error *blank screen*, melainkan tetap menampilkan landing page menggunakan data bawaan secara mulus.
- **Formulir Interaktif (Insert ke MySQL):** Pengunjung dapat mengirim pesan sapaan yang langsung disimpan ke tabel `contact_messages` dengan proteksi PDO Prepared Statement (mencegah SQL Injection).
- **Dark & Light Mode:** Toggle tema yang responsif dan tersimpan di browser `localStorage`.
- **Salam Dinamis:** Otomatis menyesuaikan salam pagi/siang/sore/malam berdasarkan jam lokal WIB.
