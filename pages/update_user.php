<?php
include 'cek_session.php';
include 'koneksi.php';

// cek session di paling atas


$id           = $_POST['user_id'];
$nama_lengkap = $_POST['nama_lengkap'];
$username     = $_POST['username'];
$nik          = $_POST['nik'];
$email        = $_POST['email'];
$role_id      = $_POST['role_id'];
$kecamatan_id = $_POST['kecamatan_id'] != '' ? $_POST['kecamatan_id'] : NULL;
$status       = $_POST['status'];

$stmt = $koneksi->prepare("UPDATE users SET nama_lengkap=?,username=?,nik=?,email=?,role_id=?,kecamatan_id=?,status=? WHERE user_id=?");
$stmt->bind_param("sssssisi", $nama_lengkap, $username, $nik, $email, $role_id, $kecamatan_id, $status, $id);

if ($stmt->execute()) {
    header("Location:../index.php?page=adminutama");
} else {
    echo "Gagal update: " . $stmt->error;
}
