<?php
/**
 * Script Setup Otomatis Database MySQL
 * Jalankan file ini melalui browser (http://localhost:8000/setup.php)
 * atau melalui terminal: php setup.php
 */

require_once __DIR__ . '/db.php';

$message = '';
$status = 'info';

try {
    // Koneksi awal tanpa nama database untuk membuat database terlebih dahulu
    $pdoInit = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Baca isi file database.sql
    $sqlFile = __DIR__ . '/database.sql';
    if (!file_exists($sqlFile)) {
        throw new Exception("File database.sql tidak ditemukan!");
    }

    $sqlContent = file_get_contents($sqlFile);

    // Jalankan query SQL
    $pdoInit->exec($sqlContent);

    $status = 'success';
    $message = "Database '<b>" . DB_NAME . "</b>' dan seluruh tabel berhasil dibuat serta diisi data awal!";
} catch (Exception $e) {
    $status = 'error';
    $message = "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Database MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0d1117;
            color: #f0f6fc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 16px;
            padding: 32px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }
        h1 { margin-bottom: 16px; font-size: 1.5rem; }
        .alert {
            padding: 16px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 0.95rem;
            line-height: 1.5;
            text-align: left;
        }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #34d399; }
        .alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; }
        .btn {
            display: inline-block;
            background: #6366f1;
            color: #fff;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .btn:hover { background: #4f46e5; }
    </style>
</head>
<body>
    <div class="card">
        <h1>⚙️ Setup Database MySQL</h1>
        <div class="alert alert-<?= $status; ?>">
            <?= $message; ?>
        </div>
        <?php if ($status === 'success'): ?>
            <a href="index.php" class="btn">Kembali ke Landing Page &rarr;</a>
        <?php else: ?>
            <p style="font-size:0.85rem; color:#8b949e; margin-bottom:16px;">
                Pastikan service MySQL Anda (misalnya di XAMPP / Laragon) sudah berjalan dan kredensial di <code>db.php</code> sudah sesuai.
            </p>
            <a href="setup.php" class="btn">Coba Lagi</a>
        <?php endif; ?>
    </div>
</body>
</html>

