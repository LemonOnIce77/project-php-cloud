<?php
/**
 * Konfigurasi Koneksi Database MySQL
 * -------------------------------------------------------------
 * Sesuaikan nilai di bawah ini dengan database Anda:
 * - Jika menggunakan XAMPP lokal: default host '127.0.0.1', user 'root', pass ''
 * - Jika menggunakan Cloud Database (Aiven/Clever Cloud/dll): masukkan kredensial dari dashboard cloud Anda
 */
define('DB_HOST', 'db-tugas-emil.mysql.database.azure.com');       // Host database (misal: localhost, 127.0.0.1, atau host cloud)
define('DB_PORT', '3306');            // Port MySQL (default: 3306)
define('DB_NAME', 'db_landing_page'); // Nama database
define('DB_USER', 'muhammadyaumiladitya');            // Username MySQL
define('DB_PASS', 'Emiladitya2!');                // Password MySQL (default XAMPP kosong)

// Variabel global untuk menyimpan pesan error koneksi jika gagal
$db_error = null;

/**
 * Fungsi untuk mendapatkan koneksi PDO ke MySQL
 * Dilengkapi auto-create database & table jika belum ada di server MySQL.
 * 
 * @return PDO|null
 */
function getDBConnection() {
    global $db_error;
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Jika database belum dibuat (error code 1049), buat otomatis dari database.sql
        if ($e->getCode() == 1049 || stripos($e->getMessage(), 'Unknown database') !== false) {
            try {
                $initPdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8mb4", DB_USER, DB_PASS, $options);
                $sqlFile = __DIR__ . '/database.sql';
                if (file_exists($sqlFile)) {
                    $initPdo->exec(file_get_contents($sqlFile));
                    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
                    return $pdo;
                }
            } catch (PDOException $ex) {
                $db_error = $ex->getMessage();
                return null;
            }
        }

        $db_error = $e->getMessage();
        return null;
    }
}
