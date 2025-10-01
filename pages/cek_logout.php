<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

// Catat logout jika user login
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $now = date('Y-m-d H:i:s');
    mysqli_query($koneksi, "UPDATE users SET last_logout='$now' WHERE user_id='$user_id'");
    mysqli_query($koneksi, "INSERT INTO user_log (user_id, aktivitas) VALUES ('$user_id', 'logout')");
}

// Hapus session
$_SESSION = [];           // kosongkan semua session
session_unset();          // bersihkan session
session_destroy();        // destroy session

// Hapus cookie session (opsional tapi lebih aman)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirect
header("Location: index.php?page=login");
ob_end_flush();
exit();
