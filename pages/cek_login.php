<?php
// cek_login.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

// Ambil input user
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

// Ambil data user
$sql = "SELECT u.*, r.role_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.role_id
        WHERE u.username='$username' LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    //Cek status akun
    if ($user['status'] !== 'aktif') {  // asumsi kolom status: 'aktif' / 'nonaktif'
        echo "<script>alert('Akun Anda nonaktif, tidak dapat login'); window.location='index.php?page=login';</script>";
        exit();
    }

    // Verifikasi password
    if (password_verify($password, $user['password'])) {

        // Set session
        $_SESSION['user_id']        = $user['user_id'];
        $_SESSION['username']       = $user['username'];
        $_SESSION['nama']           = $user['nama_lengkap'];
        $_SESSION['role_id']        = $user['role_id'];   
        $_SESSION['role_name']      = $user['role_name'];
        $_SESSION['last_activity']  = time();

        // Catat waktu login terakhir
        $now = date('Y-m-d H:i:s');
        mysqli_query($koneksi, "UPDATE users SET last_login='$now' WHERE user_id='" . $user['user_id'] . "'");

        // Catat log login
        $user_id = $user['user_id'];
        $log_sql = "INSERT INTO user_log (user_id, aktivitas) VALUES ('$user_id', 'login')";
        mysqli_query($koneksi, $log_sql);

        // Redirect sesuai role_id
        if ($user['role_id'] == 'admin') {
            header('Location: index.php?page=dashboard_admin');
            exit();
        } elseif ($user['role_id'] == 'operator') {
            header('Location: index.php?page=dashboard_operator');
            exit();
        } else {
            header('Location: index.php?page=dashboard_pemohon');
            exit();
        }
    } else {
        echo "<script>alert('Password salah'); window.location='index.php?page=login';</script>";
        exit();
    }
} else {
    echo "<script>alert('Username tidak ditemukan'); window.location='index.php?page=login';</script>";
    exit();
}
