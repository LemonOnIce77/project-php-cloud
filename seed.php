<?php
/**
 * Script Seeder Database MySQL
 * Menjalankan pengisian data dummy ke dalam tabel-tabel MySQL
 * Akses via browser: http://localhost:8000/seed.php
 * Atau via terminal: php seed.php
 */

require_once __DIR__ . '/db.php';

$pdo = getDBConnection();
$message = '';
$status = 'info';
$stats = [];

if ($pdo === null) {
    $status = 'error';
    $message = "Gagal terhubung ke MySQL: " . ($GLOBALS['db_error'] ?? 'Server MySQL belum aktif.');
} else {
    try {
        $sqlFile = __DIR__ . '/database.sql';
        if (!file_exists($sqlFile)) {
            throw new Exception("File database.sql tidak ditemukan!");
        }

        $sql = file_get_contents($sqlFile);
        $pdo->exec($sql);

        // Ambil statistik data dummy yang baru dimasukkan
        $stats['profiles'] = $pdo->query("SELECT COUNT(*) FROM profiles")->fetchColumn();
        $stats['skills'] = $pdo->query("SELECT COUNT(*) FROM skills")->fetchColumn();
        $stats['socials'] = $pdo->query("SELECT COUNT(*) FROM socials")->fetchColumn();
        $stats['projects'] = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
        $stats['contact_messages'] = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();

        $status = 'success';
        $message = "Berhasil mengisi database '<b>" . DB_NAME . "</b>' dengan data dummy lengkap!";
    } catch (Exception $e) {
        $status = 'error';
        $message = "Terjadi kesalahan saat seeding: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeder Data Dummy MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0d1117;
            color: #f0f6fc;
            padding: 30px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 18px;
            max-width: 540px;
            width: 100%;
            padding: 36px 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            text-align: center;
        }
        h1 { font-size: 1.45rem; font-weight: 800; margin-bottom: 14px; }
        .alert {
            padding: 16px;
            border-radius: 12px;
            margin: 20px 0;
            font-size: 0.95rem;
            text-align: left;
            line-height: 1.5;
        }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #34d399; }
        .alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 24px 0;
            text-align: left;
        }
        .stat-item {
            background: #0d1117;
            border: 1px solid #30363d;
            border-radius: 10px;
            padding: 12px 14px;
        }
        .stat-label { font-size: 0.8rem; color: #8b949e; }
        .stat-val { font-size: 1.2rem; font-weight: 700; color: #6366f1; margin-top: 4px; }
        .btn {
            display: inline-block;
            background: #6366f1;
            color: #fff;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: 0.2s;
        }
        .btn:hover { background: #4f46e5; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🌱 Pengisian Data Dummy MySQL</h1>
        <div class="alert alert-<?= $status; ?>">
            <?= $message; ?>
        </div>

        <?php if ($status === 'success'): ?>
            <p style="font-size: 0.88rem; color: #8b949e; text-align: left; margin-bottom: 8px;">
                Ringkasan data yang tersimpan di MySQL:
            </p>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-label">Tabel Profil</div>
                    <div class="stat-val"><?= $stats['profiles']; ?> Data</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Tabel Skills</div>
                    <div class="stat-val"><?= $stats['skills']; ?> Keahlian</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Tabel Proyek</div>
                    <div class="stat-val"><?= $stats['projects']; ?> Proyek</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Pesan Masuk</div>
                    <div class="stat-val"><?= $stats['contact_messages']; ?> Pesan Dummy</div>
                </div>
            </div>
            <a href="index.php" class="btn">Lihat Landing Page &rarr;</a>
        <?php else: ?>
            <p style="font-size: 0.88rem; color: #8b949e; margin-bottom: 20px;">
                Pastikan service MySQL di XAMPP sudah running, lalu klik tombol di bawah untuk mencoba kembali.
            </p>
            <a href="seed.php" class="btn">Ulangi Seeding 🔄</a>
        <?php endif; ?>
    </div>
</body>
</html>

