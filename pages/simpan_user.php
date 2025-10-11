<?php
// simpan_user.php
ob_start();
include 'koneksi.php';

// ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'] ?? '';
$username     = trim($_POST['username'] ?? ''); // pakai trim untuk hilangkan spasi
$nik          = $_POST['nik'] ?? '';
$email        = $_POST['email'] ?? '';
$password     = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
$role_id      = $_POST['role_id'] ?? '';
$kecamatan_id = !empty($_POST['kecamatan_id']) ? $_POST['kecamatan_id'] : NULL;
$status       = $_POST['status'] ?? '';

// cek apakah username sudah ada
$cek = $koneksi->prepare("SELECT username FROM users WHERE username = ?");
$cek->bind_param("s", $username);
$cek->execute();
$cek->store_result();

if ($cek->num_rows > 0) {
    // kalau username sudah ada, kasih pesan & jangan insert
    echo "<script>
            alert('Username \"$username\" sudah digunakan. Silakan pilih username lain.');
            window.location.href = 'index.php?page=admin-users';
          </script>";
    exit;
}
$cek->close();

// query insert pakai prepared statement
$stmt = $koneksi->prepare("
    INSERT INTO users 
    (nama_lengkap, username, nik, email, password, role_id, kecamatan_id, status)
    VALUES (?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "ssssssis",
    $nama_lengkap,
    $username,
    $nik,
    $email,
    $password,
    $role_id,
    $kecamatan_id,
    $status
);

// eksekusi query
if ($stmt->execute()) {
    header("Location: index.php?page=adminutama");
    ob_end_flush();
    exit;
} else {
    echo "Gagal simpan data: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
