<?php
// Set timezone ke Waktu Indonesia Barat (WIB)
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/db.php';

// Logika salam dinamis berdasarkan jam
$hour = (int) date('H');
if ($hour >= 5 && $hour < 11) {
    $greeting = "Selamat pagi 🌅";
} elseif ($hour >= 11 && $hour < 15) {
    $greeting = "Selamat siang ☀️";
} elseif ($hour >= 15 && $hour < 18) {
    $greeting = "Selamat sore 🌇";
} else {
    $greeting = "Selamat malam 🌙";
}

// Cek koneksi ke Database MySQL
$db = getDBConnection();
$dbConnected = ($db !== null);

// Data Profil Default (Sebagai fallback jika database belum di-setup)
$profile = [
    'name'            => 'Muhammad Yaumil Aditya Warman',
    'nickname'        => 'Yaumil',
    'title'           => 'Cloud & Web Development Enthusiast',
    'location'        => 'Indonesia',
    'status'          => 'Tersedia untuk kolaborasi & projek',
    'bio'             => 'Mahasiswa yang tertarik pada arsitektur Cloud Computing, pengembangan web modern, dan integrasi database MySQL. Senang membangun sistem yang efisien, handal, dan scalable.',
    'email'           => 'adityawarman@example.com',
    'avatar_initials' => 'YA'
];

$skills = [
    'PHP Native', 'MySQL Database', 'Cloud Computing', 'Linux Server', 'Docker', 'Git & GitHub', 'REST API', 'HTML5 & CSS3'
];

$socials = [
    [
        'platform' => 'GitHub',
        'url'      => 'https://github.com',
        'icon_svg' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>'
    ],
    [
        'platform' => 'LinkedIn',
        'url'      => 'https://linkedin.com',
        'icon_svg' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>'
    ],
    [
        'platform' => 'Instagram',
        'url'      => 'https://instagram.com',
        'icon_svg' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>'
    ],
    [
        'platform' => 'Email',
        'url'      => 'mailto:adityawarman@example.com',
        'icon_svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'
    ]
];

// Jika terhubung ke MySQL, ambil data dinamis dari tabel
if ($dbConnected) {
    try {
        // Ambil Data Profil
        $stmtProfile = $db->query("SELECT * FROM profiles LIMIT 1");
        $dbProfile = $stmtProfile->fetch();
        if ($dbProfile) {
            $profile = array_merge($profile, $dbProfile);
        }

        // Ambil Data Skills
        $stmtSkills = $db->query("SELECT skill_name FROM skills ORDER BY order_num ASC");
        $dbSkills = $stmtSkills->fetchAll(PDO::FETCH_COLUMN);
        if (!empty($dbSkills)) {
            $skills = $dbSkills;
        }

        // Ambil Data Socials
        $stmtSocials = $db->query("SELECT platform, url, icon_svg FROM socials");
        $dbSocials = $stmtSocials->fetchAll();
        if (!empty($dbSocials)) {
            $socials = $dbSocials;
        }
    } catch (PDOException $e) {
        // Tabel mungkin belum dibuat, biarkan menggunakan data fallback
    }
}

// Proses Form Kirim Pesan (Contact Form)
$alertMessage = '';
$alertType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $senderName  = trim($_POST['name'] ?? '');
    $senderEmail = trim($_POST['email'] ?? '');
    $userMessage = trim($_POST['message'] ?? '');

    if (empty($senderName) || empty($senderEmail) || empty($userMessage)) {
        $alertMessage = 'Mohon lengkapi semua bidang isian formulir.';
        $alertType = 'error';
    } elseif (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        $alertMessage = 'Format alamat email tidak valid.';
        $alertType = 'error';
    } elseif (!$dbConnected) {
        $alertMessage = 'Koneksi database MySQL belum aktif. Pesan belum dapat disimpan.';
        $alertType = 'error';
    } else {
        try {
            $insertStmt = $db->prepare("INSERT INTO contact_messages (sender_name, sender_email, message) VALUES (?, ?, ?)");
            $insertStmt->execute([$senderName, $senderEmail, $userMessage]);
            $alertMessage = "Terima kasih, <b>" . htmlspecialchars($senderName) . "</b>! Pesan Anda telah tersimpan di database MySQL.";
            $alertType = 'success';
        } catch (PDOException $e) {
            $alertMessage = "Gagal menyimpan pesan: " . $e->getMessage();
            $alertType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($profile['name']); ?> | Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #0d1117;
            --card-bg: rgba(22, 27, 34, 0.78);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-main: #f0f6fc;
            --text-muted: #8b949e;
            --accent-1: #6366f1;
            --accent-2: #a855f7;
            --accent-3: #ec4899;
            --chip-bg: rgba(99, 102, 241, 0.12);
            --chip-border: rgba(99, 102, 241, 0.3);
            --chip-text: #a5b4fc;
            --glow-color: rgba(99, 102, 241, 0.22);
            --input-bg: rgba(13, 17, 23, 0.7);
            --radius-lg: 24px;
            --radius-md: 14px;
            --radius-sm: 8px;
        }

        [data-theme="light"] {
            --bg-body: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.9);
            --card-border: rgba(0, 0, 0, 0.08);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --accent-1: #4f46e5;
            --accent-2: #9333ea;
            --accent-3: #db2777;
            --chip-bg: rgba(79, 70, 229, 0.08);
            --chip-border: rgba(79, 70, 229, 0.2);
            --chip-text: #4338ca;
            --glow-color: rgba(79, 70, 229, 0.15);
            --input-bg: rgba(241, 245, 249, 0.85);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 16px;
            position: relative;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Ambient Glow Background Effect */
        .ambient-glow {
            position: fixed;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
            animation: float 9s ease-in-out infinite alternate;
        }

        .ambient-glow.top-left {
            top: -100px;
            left: -100px;
            background: linear-gradient(135deg, var(--accent-1), var(--accent-2));
        }

        .ambient-glow.bottom-right {
            bottom: -100px;
            right: -100px;
            background: linear-gradient(135deg, var(--accent-2), var(--accent-3));
            animation-duration: 11s;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(30px) scale(1.08); }
        }

        /* Top Nav Bar (DB status & Theme Toggle) */
        .top-bar {
            position: fixed;
            top: 20px;
            right: 20px;
            left: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 50;
            pointer-events: none;
            max-width: 720px;
            margin: 0 auto;
        }

        .top-bar > * {
            pointer-events: auto;
        }

        .db-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .db-online {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #10b981;
        }

        .db-offline {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.35);
            color: #f59e0b;
        }

        .db-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .db-online .db-dot { background: #10b981; }
        .db-offline .db-dot { background: #f59e0b; }

        .theme-toggle {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            color: var(--text-main);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .theme-toggle:hover {
            transform: scale(1.08);
            border-color: var(--accent-1);
        }

        .theme-toggle svg {
            width: 19px;
            height: 19px;
        }

        /* Main Container Card */
        .container {
            position: relative;
            z-index: 10;
            max-width: 680px;
            width: 100%;
            margin-top: 40px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 44px 38px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px -15px var(--glow-color), 0 0 1px 1px var(--card-border);
            animation: cardAppear 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header / Avatar Section */
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .avatar-wrap {
            position: relative;
            display: inline-block;
        }

        .avatar {
            width: 84px;
            height: 84px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--accent-1), var(--accent-2), var(--accent-3));
            padding: 3px;
            box-shadow: 0 10px 25px var(--glow-color);
        }

        .avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 19px;
            background: var(--bg-body);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 500;
            color: #10b981;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            position: relative;
        }

        .status-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: #10b981;
            opacity: 0.6;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            70% { transform: scale(2.2); opacity: 0; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        /* Greeting & Headings */
        .greeting {
            display: inline-block;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--accent-1);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .main-title {
            font-size: clamp(1.8rem, 4.5vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.25;
            margin-bottom: 10px;
        }

        .name-gradient {
            background: linear-gradient(120deg, #60a5fa, var(--accent-1), var(--accent-2), var(--accent-3));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .subtitle {
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .bio {
            font-size: 0.98rem;
            color: var(--text-muted);
            margin-bottom: 28px;
            line-height: 1.7;
        }

        /* Skills Section */
        .skills-heading {
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 32px;
        }

        .skill-tag {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 6px 13px;
            background: var(--chip-bg);
            border: 1px solid var(--chip-border);
            color: var(--chip-text);
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .skill-tag:hover {
            transform: translateY(-2px);
            border-color: var(--accent-1);
            box-shadow: 0 4px 12px var(--glow-color);
        }

        /* Action Buttons */
        .action-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.25s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-1), var(--accent-2));
            color: #ffffff;
            box-shadow: 0 8px 20px var(--glow-color);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px var(--glow-color);
            filter: brightness(1.1);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.04);
            border-color: var(--card-border);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--text-muted);
            transform: translateY(-2px);
        }

        /* Contact / Guestbook Form Section */
        .contact-box {
            background: rgba(0, 0, 0, 0.15);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-md);
            padding: 24px;
            margin-bottom: 32px;
        }

        .contact-box h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .contact-box p {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        @media (max-width: 580px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            border-color: var(--accent-1);
            box-shadow: 0 0 0 3px var(--glow-color);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .alert-box {
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 0.88rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-box.success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid #10b981;
            color: #34d399;
        }

        .alert-box.error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #f87171;
        }

        /* Social Links */
        .socials-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid var(--card-border);
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--card-border);
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .social-link:hover {
            color: var(--text-main);
            border-color: var(--accent-1);
            background: var(--chip-bg);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px var(--glow-color);
        }

        .social-link svg {
            width: 20px;
            height: 20px;
        }

        /* Footer */
        .footer-note {
            margin-top: 28px;
            font-size: 0.8rem;
            color: var(--text-muted);
            text-align: center;
        }

        .footer-note span {
            color: var(--accent-1);
            font-weight: 600;
        }

        .footer-setup {
            margin-top: 6px;
            font-size: 0.75rem;
        }

        .footer-setup a {
            color: var(--text-muted);
            text-decoration: underline;
        }

        .footer-setup a:hover {
            color: var(--accent-1);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 32px 20px;
                margin-top: 48px;
            }
            .header-top {
                flex-direction: column;
                align-items: flex-start;
            }
            .action-row {
                flex-direction: column;
                width: 100%;
            }
            .btn {
                width: 100%;
            }
            .socials-row {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Glowing Orbs -->
    <div class="ambient-glow top-left"></div>
    <div class="ambient-glow bottom-right"></div>

    <!-- Top Status Bar -->
    <div class="top-bar">
        <div class="db-indicator <?= $dbConnected ? 'db-online' : 'db-offline'; ?>" title="<?= $dbConnected ? 'Terhubung ke Database MySQL' : 'Database belum terhubung (Menggunakan data fallback)'; ?>">
            <span class="db-dot"></span>
            <?= $dbConnected ? 'MySQL Connected' : 'MySQL Offline (Fallback)'; ?>
        </div>
        <button class="theme-toggle" id="themeToggle" aria-label="Ganti Tema">
            <svg id="themeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </button>
    </div>

    <!-- Main Profile Card -->
    <main class="container">
        
        <!-- Header / Avatar / Status -->
        <div class="header-top">
            <div class="avatar-wrap">
                <div class="avatar">
                    <div class="avatar-inner">
                        <?= htmlspecialchars($profile['avatar_initials'] ?? 'YA'); ?>
                    </div>
                </div>
            </div>
            <div class="status-badge">
                <span class="status-dot"></span>
                <?= htmlspecialchars($profile['status']); ?>
            </div>
        </div>

        <!-- Greeting & Name -->
        <span class="greeting"><?= $greeting; ?></span>
        <h1 class="main-title">
            halo, aku <span class="name-gradient"><?= htmlspecialchars($profile['name']); ?></span>
        </h1>
        <p class="subtitle"><?= htmlspecialchars($profile['title']); ?> • <?= htmlspecialchars($profile['location']); ?></p>

        <!-- Bio -->
        <p class="bio">
            <?= htmlspecialchars($profile['bio']); ?>
        </p>

        <!-- Tech Skills from MySQL -->
        <div class="skills-heading">Minat & Keahlian (MySQL Data)</div>
        <div class="skills-grid">
            <?php foreach ($skills as $skill): ?>
                <span class="skill-tag"><?= htmlspecialchars($skill); ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Action Buttons -->
        <div class="action-row">
            <a href="#form-pesan" class="btn btn-primary">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Tinggalkan Pesan
            </a>
            <button onclick="salinEmail()" class="btn btn-secondary" id="copyBtn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Salin Email
            </button>
        </div>

        <!-- Form Tinggalkan Pesan (Simpan ke MySQL) -->
        <section class="contact-box" id="form-pesan">
            <h3>💬 Kirim Pesan Cepat</h3>
            <p>Pesan Anda akan langsung tersimpan ke tabel <code>contact_messages</code> di database MySQL.</p>

            <?php if (!empty($alertMessage)): ?>
                <div class="alert-box <?= $alertType; ?>">
                    <?= $alertMessage; ?>
                </div>
            <?php endif; ?>

            <form action="#form-pesan" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Nama Anda</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="budi@example.com" required>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="message">Pesan Anda</label>
                    <textarea id="message" name="message" class="form-input form-textarea" placeholder="Tuliskan pesan atau sapaan untuk Yaumil..." required></textarea>
                </div>
                <button type="submit" name="send_message" class="btn btn-primary" style="width: 100%;">
                    Kirim Pesan ke Database
                </button>
            </form>
        </section>

        <!-- Social Media Links -->
        <div class="socials-row">
            <?php foreach ($socials as $social): ?>
                <a href="<?= htmlspecialchars($social['url']); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="social-link" 
                   title="<?= htmlspecialchars($social['platform']); ?>">
                    <?= $social['icon_svg']; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Footer -->
        <div class="footer-note">
            Dibuat dengan <span>PHP Native &amp; MySQL</span> &copy; <?= date('Y'); ?> <?= htmlspecialchars($profile['name']); ?>
            <div class="footer-setup">
                Setup database bermasalah? Jalankan <a href="setup.php">setup.php</a> untuk inisialisasi otomatis.
            </div>
        </div>

    </main>

    <!-- Script for Theme Toggle & Copy Functionality -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        
        const sunIcon = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />`;
        const moonIcon = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />`;

        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeIcon.innerHTML = savedTheme === 'dark' ? sunIcon : moonIcon;

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            themeIcon.innerHTML = newTheme === 'dark' ? sunIcon : moonIcon;
        });

        function salinEmail() {
            const email = "<?= addslashes(htmlspecialchars($profile['email'])); ?>";
            navigator.clipboard.writeText(email).then(() => {
                const copyBtn = document.getElementById('copyBtn');
                const originalHtml = copyBtn.innerHTML;
                copyBtn.innerHTML = `
                    <svg width="18" height="18" fill="none" stroke="#10b981" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Tersalin!
                `;
                setTimeout(() => {
                    copyBtn.innerHTML = originalHtml;
                }, 2000);
            });
        }
    </script>
</body>
</html>
