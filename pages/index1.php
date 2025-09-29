<?php

include 'koneksi.php';
$result = $koneksi->query("SELECT u.*, r.role_name, k.nama_kecamatan
                           FROM users u
                           LEFT JOIN roles r ON u.role_id=r.role_id
                           LEFT JOIN kecamatan k ON u.kecamatan_id=k.kecamatan_id
                           ORDER BY u.user_id DESC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        a.btn {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        .add {
            background: #28a745;
            color: #fff;
        }

        .edit {
            background: #ffc107;
            color: #000;
        }

        .hapus {
            background: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <h2>Daftar User</h2>
    <a href="tambah_user.php" class="btn add"><i class="fa fa-plus"></i> Tambah User</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Kode User</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Kecamatan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['kode_user'] ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['role_name'] ?></td>
                <td><?= $row['nama_kecamatan'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $row['user_id'] ?>" class="btn edit"><i class="fa fa-pencil"></i></a>
                    <a href="hapus_user.php?id=<?= $row['user_id'] ?>" class="btn hapus" onclick="return confirm('Yakin hapus?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>