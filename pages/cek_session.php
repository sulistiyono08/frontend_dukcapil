<?php
// Memulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

// Timeout dalam detik (misalnya 5 menit = 300 detik)
$timeout = 300; // Timeout 5 menit

// Mengecek apakah waktu aktivitas terakhir ada dan sudah melebihi timeout
if (isset($_SESSION['last_activity'])) {
    // Jika sudah melewati batas timeout, logout dan arahkan ke login
    if (time() - $_SESSION['last_activity'] > $timeout) {
        // Menghapus semua data sesi
        session_unset();
        session_destroy();

        // Arahkan ke halaman login dengan parameter timeout
        header("Location: index.php?page=login&timeout=1");
        exit();
    }
}

// Update waktu aktivitas terakhir setiap kali halaman diakses
$_SESSION['last_activity'] = time();

// Jika perlu, Anda dapat menggunakan session_regenerate_id() untuk meningkatkan keamanan
// Regenerasi ID sesi untuk mencegah serangan session fixation
session_regenerate_id(true);
