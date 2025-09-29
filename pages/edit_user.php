<?php
include 'cek_session.php';
include 'koneksi.php';
$id = $_GET['id'];
$user = $koneksi->query("SELECT * FROM users WHERE user_id=$id")->fetch_assoc();
$roles = $koneksi->query("SELECT * FROM roles");
$kec   = $koneksi->query("SELECT * FROM kecamatan");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h2>Edit User</h2>
    <form action="update_user.php" method="post">
        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
        Nama Lengkap:<br>
        <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" required><br>
        Username:<br>
        <input type="text" name="username" value="<?= $user['username'] ?>" required><br>
        NIK:<br>
        <input type="text" name="nik" maxlength="16" pattern="\d{16}" value="<?= $user['nik'] ?>" required><br>
        Email:<br>
        <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
        Role:<br>
        <select name="role_id">
            <?php while ($r = $roles->fetch_assoc()): ?>
                <option value="<?= $r['role_id'] ?>" <?= $r['role_id'] == $user['role_id'] ? 'selected' : '' ?>><?= $r['role_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        Kecamatan:<br>
        <select name="kecamatan_id">
            <option value="">(Hanya Operator)</option>
            <?php while ($k = $kec->fetch_assoc()): ?>
                <option value="<?= $k['kecamatan_id'] ?>" <?= $k['kecamatan_id'] == $user['kecamatan_id'] ? 'selected' : '' ?>><?= $k['nama_kecamatan'] ?></option>
            <?php endwhile; ?>
        </select><br>
        Status:<br>
        <select name="status">
            <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="nonaktif" <?= $user['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
        </select><br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>