<?php

include 'koneksi.php';

$nama_lengkap = $_POST['nama_lengkap'];
$username     = $_POST['username'];
$nik          = $_POST['nik'];
$email        = $_POST['email'];
$password     = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role_id      = $_POST['role_id'];
$kecamatan_id = $_POST['kecamatan_id'] != '' ? $_POST['kecamatan_id'] : NULL;
$status       = $_POST['status'];

$stmt = $koneksi->prepare("INSERT INTO users (nama_lengkap,username,nik,email,password,role_id,kecamatan_id,status)
VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssis", $nama_lengkap, $username, $nik, $email, $password, $role_id, $kecamatan_id, $status);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Gagal simpan data: " . $stmt->error;
}
