<?php
include 'cek_session.php';
include 'koneksi.php';
$id = $_GET['id'];
$user = $koneksi->query("SELECT u.*,r.role_name,k.nama_kecamatan
FROM users u
LEFT JOIN roles r ON u.role_id=r.role_id
LEFT JOIN kecamatan k ON u.kecamatan_id=k.kecamatan_id
WHERE u.user_id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hapus User</title>
</head>

<body>
    <h2>Hapus User</h2>
    <p>Anda yakin ingin menghapus user berikut?</p>
    <ul>
        <li>Kode: <?= $user['kode_user'] ?></li>
        <li>Nama: <?= $user['nama_lengkap'] ?></li>
        <li>Role: <?= $user['role_name'] ?></li>
        <li>Kecamatan: <?= $user['nama_kecamatan'] ?></li>
    </ul>
    <form action="" method="post">
        <button type="submit" name="hapus">Hapus</button>
        <a href="index.php">Batal</a>
    </form>
</body>

</html>

<?php
if (isset($_POST['hapus'])) {
    $koneksi->query("DELETE FROM users WHERE user_id=$id");
    header("Location: index.php");
}
?>