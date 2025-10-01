<?php
// cek_session.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika belum login → redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

// Timeout dalam detik
$timeout = 300; // contoh 5 detik

// Cek apakah sudah melebihi timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Session kadaluarsa → hapus semua session
    session_unset();
    session_destroy();
    header("Location: index.php?page=login&timeout=1");
    exit();
}

// Update last activity setiap request
$_SESSION['last_activity'] = time();
