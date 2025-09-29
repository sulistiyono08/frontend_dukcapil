<?php
include 'cek_session.php';
include 'koneksi.php';
$roles = $koneksi->query("SELECT * FROM roles");
$kec   = $koneksi->query("SELECT * FROM kecamatan");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah User</title>
</head>

<body>
    <h2>Tambah User</h2>
    <form action="simpan_user.php" method="post">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" required><br>
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>NIK:</label><br>
        <input type="text" name="nik" maxlength="16" pattern="\d{16}" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Role:</label><br>
        <select name="role_id" required>
            <option value="">Pilih Role</option>
            <?php while ($r = $roles->fetch_assoc()): ?>
                <option value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <label>Kecamatan:</label><br>
        <select name="kecamatan_id">
            <option value="">(Hanya untuk Operator)</option>
            <?php while ($k = $kec->fetch_assoc()): ?>
                <option value="<?= $k['kecamatan_id'] ?>"><?= $k['nama_kecamatan'] ?></option>
            <?php endwhile; ?>
        </select><br>
        <label>Status:</label><br>
        <select name="status">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>