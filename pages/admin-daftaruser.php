<?php
include 'koneksi.php';

// Ambil data user + nama role
$sql = "SELECT u.user_id, u.kode_user, u.nama_lengkap, u.nik, u.email, r.role_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.role_id
        ORDER BY u.user_id ASC";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola User - Admin | SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    
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

    .main-content {
      padding: 40px 0;
      flex: 1;
    }

    .page-title {
      color: #1a3a8f;
      font-size: 26px;
      margin-bottom: 20px;
      border-bottom: 2px solid #e0e0e0;
      padding-bottom: 10px;
      display: flex;
      align-items: center;
    }

    .page-title i {
      margin-right: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    th,
    td {
      padding: 14px 16px;
      border-bottom: 1px solid #eaeaea;
      text-align: left;
      font-size: 14px;
    }

    th {
      background: #1a3a8f;
      color: white;
      text-transform: uppercase;
      font-size: 13px;
    }

    tr:hover {
      background: #f9f9f9;
    }

    .btn-action {
      background: #1a3a8f;
      color: white;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 13px;
      margin-right: 5px;
      display: inline-block;
    }

    .btn-action:hover {
      background: #14307a;
    }

   
    /* Tombol Edit */
    .btn-edit {
      display: inline-block;
      padding: 6px 14px;
      font-size: 13px;
      font-weight: 600;
      color: #fff;
      background: #28a745;
      /* hijau */
      border-radius: 4px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-edit:hover {
      background: #218838;
      /* hijau lebih gelap */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Tombol Hapus */
    .btn-delete {
      display: inline-block;
      padding: 6px 14px;
      font-size: 13px;
      font-weight: 600;
      color: #fff;
      background: #dc3545;
      /* merah */
      border-radius: 4px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-delete:hover {
      background: #c82333;
      /* merah lebih gelap */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Jika ingin jarak antar tombol lebih rapi */
    td .btn-edit,
    td .btn-delete {
      margin-right: 6px;
    }
  </style>
</head>

<body>
  
  <!-- Main -->
  <main class="container main-content">
    <h2 class="page-title"><i class="fas fa-users"></i> Kelola User</h2>

    <!-- Sub Navbar -->
    <div class="sub-nav">
      <a href="index.php?page=admin-users" class="a"><i class="fas fa-user-plus"></i> Tambah User</a>
      <a href="index.php?page=adminutama"><i class="fas fa-list"></i> Daftar User</a>
    </div>

    <!-- Tabel User -->
    <div id="daftar-user">
      <h3 style="margin-bottom: 15px; color: #1a3a8f"><i class="fas fa-list"></i> Daftar User</h3>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Kode User</th>
            <th>Nama Lengkap</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['kode_user']); ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                <td><?= htmlspecialchars($row['nik']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['role_name']); ?></td>
                <td>
                  <a href="edit/edit-user.php?id=<?= $row['user_id']; ?>" class="btn-edit">Edit</a>
                  <a href="hapus/delete-user.php?id=<?= $row['user_id']; ?>" class="btn-delete">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" style="text-align:center;">Belum ada user</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

</body>

</html>