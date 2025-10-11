<?php
include 'koneksi.php';

// ambil parameter pencarian
$keyword = $_GET['keyword'] ?? '';
$role_id = $_GET['role_id'] ?? '';

// query dasar
$sql = "SELECT u.*, r.role_name, k.nama_kecamatan
        FROM users u
        LEFT JOIN roles r ON u.role_id = r.role_id
        LEFT JOIN kecamatan k ON u.kecamatan_id = k.kecamatan_id
        WHERE 1=1";

// filter keyword (cari di beberapa kolom)
if (!empty($keyword)) {
    $sql .= " AND (u.nama_lengkap LIKE ? 
              OR u.username LIKE ? 
              OR u.email LIKE ? 
              OR u.nik LIKE ?)";
}

// filter role
if (!empty($role_id)) {
    $sql .= " AND u.role_id = ?";
}

$sql .= " ORDER BY u.user_id DESC";

$stmt = $koneksi->prepare($sql);

// binding parameter dinamis
if (!empty($keyword) && !empty($role_id)) {
    $kw = "%$keyword%";
    $stmt->bind_param("sssss", $kw, $kw, $kw, $kw, $role_id);
} elseif (!empty($keyword)) {
    $kw = "%$keyword%";
    $stmt->bind_param("ssss", $kw, $kw, $kw, $kw);
} elseif (!empty($role_id)) {
    $stmt->bind_param("s", $role_id);
}

$stmt->execute();
$result = $stmt->get_result();

// ambil daftar role untuk filter
$roles = $koneksi->query("SELECT * FROM roles");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Navbar Sekunder (User) */
        .sub-nav {
            background-color: #e9eef9;
            border-radius: 8px;
            display: flex;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .sub-nav a {
            flex: 1;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            color: #1a3a8f;
            font-weight: 600;
            border-right: 1px solid #d0d7eb;
            transition: background 0.3s;
        }

        .sub-nav a:last-child {
            border-right: none;
        }

        .sub-nav a:hover,
        .sub-nav a.active {
            background: #1a3a8f;
            color: white;
        }

        /* ====== STYLE KHUSUS DAFTAR USER ====== */
        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .search-box input,
        .search-box select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            flex: 1;
        }

        .search-box button {
            padding: 8px 15px;
            background: #1a3a8f;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
        }

        .search-box button:hover {
            background: #16367a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #1a3a8f;
            color: white;
            text-align: left;
        }

        tr:hover {
            background: #f9f9f9;
        }

        a.btn {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }

        .edit {
            background: #ffc107;
            color: #000;
        }

        .hapus {
            background: #dc3545;
            color: #fff;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
        }
    </style>
</head>

<body>


    <!-- ====== KONTEN UTAMA ====== -->
    <!-- Main -->
    <main class="container main-content">
        <h2 class="page-title"><i class="fas fa-users"></i> Kelola User</h2>

        <!-- Sub Navbar -->
        <div class="sub-nav">
            <a href="index.php?page=admin-users" ><i class="fas fa-user-plus"></i> Tambah User</a>
            <a href="index.php?page=adminutama"><i class="fas fa-list"></i> Daftar User</a>
        </div>

        <form method="get" class="search-box">
            <input type="hidden" name="page" value="adminutama">
            <input type="text" name="keyword" placeholder="Cari nama, username, email, NIK..." value="<?= htmlspecialchars($keyword) ?>">
            <select name="role_id">
                <option value="">-- Semua Role --</option>
                <?php while ($r = $roles->fetch_assoc()): ?>
                    <option value="<?= $r['role_id'] ?>" <?= $role_id == $r['role_id'] ? 'selected' : '' ?>>
                        <?= $r['role_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit"><i class="fa fa-search"></i> Cari</button>
        </form>

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
                <th>Last Login</th>
                <th>Last Logout</th>
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
                    <td><?= $row['last_login'] ?: '-' ?></td>
                    <td><?= $row['last_logout'] ?: '-' ?></td>
                    <td>
                        <a href="pages/edit_user.php?id=<?= $row['user_id'] ?>" class="btn edit"><i class="fa fa-pencil"></i></a>
                        <a href="pages/hapus_user.php?id=<?= $row['user_id'] ?>" class="btn hapus" onclick="return confirm('Yakin hapus?')"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        </div>


</body>

</html>