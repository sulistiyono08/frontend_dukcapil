<?php
session_start();

// jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// cek timeout (3 detik)
$timeout = 30; // dalam detik

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // session kadaluarsa → hapus session
    session_unset();
    session_destroy();
    header("Location:pages/login.php?timeout=1");
    exit();
}

// update last activity
$_SESSION['last_activity'] = time();
