<?php
session_start();
include "koneksi.php";

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$sql = "SELECT u.*, r.role_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.role_id
        WHERE u.username='$username' LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // verifikasi password_hash
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['nama']      = $user['nama_lengkap'];
        $_SESSION['role_name'] = $user['role_name'];
        $_SESSION['last_activity'] = time(); // untuk timeout

        // redirect otomatis sesuai role
        if ($user['role_id'] == 'admin') {
            header('Location: admin-dashboard.php');
        } elseif ($user['role_id'] == 'operator') {
            header('Location:tampilan/index.php');
        } else {
            header('Location: pemohon-dashboard.php');
        }
        exit;
    } else {
        echo "<script>alert('Password salah'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan'); window.location='login.php';</script>";
}
