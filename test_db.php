<?php
require_once __DIR__ . '/db.php';

header('Content-Type: text/html; charset=utf-8');

$pdo = getDBConnection();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Koneksi Database MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0d1117;
            color: #f0f6fc;
            padding: 30px 16px;
            display: flex;
            justify-content: center;
        }
        .box {
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 16px;
            max-width: 600px;
            width: 100%;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        h2 { margin-bottom: 20px; font-size: 1.4rem; }
        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 16px;
        }
        .badge-success { background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #34d399; }
        .badge-error { background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #f87171; }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 0.9rem;
        }
        .info-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #21262d;
        }
        .info-table td:first-child {
            color: #8b949e;
            width: 35%;
        }
        .code-snippet {
            background: #0d1117;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #30363d;
            font-family: monospace;
            font-size: 0.85rem;
            color: #ec4899;
            word-break: break-all;
        }
        .btn {
            display: inline-block;
            background: #6366f1;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
        }
        .btn:hover { background: #4f46e5; }
    </style>
</head>
<body>
    <div class="box">
        <h2>🔍 Hasil Tes Koneksi Database</h2>

        <?php if ($pdo !== null): ?>
            <div class="badge badge-success">✓ BERHASIL TERHUBUNG KE MYSQL!</div>
            <p>Database <code><?= DB_NAME; ?></code> siap digunakan untuk landing page.</p>

            <table class="info-table">
                <tr><td>Host</td><td><code><?= DB_HOST; ?>:<?= DB_PORT; ?></code></td></tr>
                <tr><td>Database</td><td><code><?= DB_NAME; ?></code></td></tr>
                <tr><td>User</td><td><code><?= DB_USER; ?></code></td></tr>
                <tr><td>Server Version</td><td><?= $pdo->getAttribute(PDO::ATTR_SERVER_VERSION); ?></td></tr>
            </table>

            <a href="index.php" class="btn">&larr; Buka Landing Page</a>
        <?php else: ?>
            <div class="badge badge-error">✗ BELUM TERHUBUNG KE MYSQL</div>
            <p style="color:#8b949e; margin-bottom:12px;">Berikut adalah detail kendala yang dialami:</p>
            <div class="code-snippet">
                <?= htmlspecialchars($db_error ?? 'Tidak ada respon dari server MySQL.'); ?>
            </div>

            <h3 style="font-size:1rem; margin-top:20px; margin-bottom:8px;">💡 Cara Mengatasi:</h3>
            <ol style="font-size:0.9rem; color:#8b949e; line-height:1.7; padding-left:20px;">
                <li><b>Jika menggunakan XAMPP di laptop:</b> Buka <b>XAMPP Control Panel</b>, lalu klik tombol <b>Start</b> pada baris <b>MySQL</b>.</li>
                <li><b>Jika menggunakan Cloud Database:</b> Buka file <code>db.php</code> dan ganti <code>DB_HOST</code>, <code>DB_USER</code>, <code>DB_PASS</code>, dan <code>DB_NAME</code> sesuai akun cloud Anda.</li>
                <li>Setelah itu, refresh halaman ini.</li>
            </ol>
            <a href="test_db.php" class="btn">Coba Tes Lagi 🔄</a>
        <?php endif; ?>
    </div>
</body>
</html>

