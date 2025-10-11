<?php
// ===============================
// HAPUS USER PAGE
// ===============================
include 'cek_session.php';
include 'koneksi.php';

// Tangkap ID dari parameter GET (pastikan aman)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Jika tombol hapus ditekan (POST)
if (isset($_POST['hapus'])) {
  // Hapus user berdasarkan ID
  $stmt = $koneksi->prepare("DELETE FROM users WHERE user_id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();

  // Redirect kembali ke dashboard admin
  header("Location: /coba/index.php?page=adminutama&deleted=success");
  exit;
}

// Ambil data user berdasarkan ID untuk konfirmasi
$stmt = $koneksi->prepare("
    SELECT u.*, r.role_name, k.nama_kecamatan 
    FROM users u
    LEFT JOIN roles r ON u.role_id = r.role_id
    LEFT JOIN kecamatan k ON u.kecamatan_id = k.kecamatan_id
    WHERE u.user_id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hapus User - Admin | SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background-color: #f5f7fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      width: 90%;
      max-width: 700px;
      margin: 60px auto;
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

    .form-card {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      border: 1px solid #e1e5ee;
      animation: fadeIn 0.5s ease-out;
    }

    .form-card h3 {
      margin-bottom: 20px;
      color: #d32f2f;
      font-size: 22px;
      padding-bottom: 10px;
      border-bottom: 2px solid #f9dada;
      display: flex;
      align-items: center;
    }

    .form-card h3 i {
      margin-right: 10px;
      color: #d32f2f;
    }

    .user-info {
      background: #f9fafb;
      border-radius: 8px;
      border: 1px solid #e1e5ee;
      padding: 15px 20px;
      margin-bottom: 25px;
      font-size: 15px;
    }

    .user-info li {
      margin-bottom: 8px;
      list-style: none;
      padding-left: 5px;
    }

    .user-info strong {
      color: #1a3a8f;
    }

    .warning-text {
      color: #721c24;
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: 500;
      text-align: center;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 10px;
    }

    .btn-danger {
      background: linear-gradient(135deg, #d32f2f, #b71c1c);
      color: white;
      padding: 12px 28px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #b71c1c, #8b0000);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(179, 0, 0, 0.3);
    }

    .btn-cancel {
      background: #e0e0e0;
      color: #333;
      padding: 12px 28px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      font-size: 16px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }

    .btn-cancel:hover {
      background: #cfcfcf;
      transform: translateY(-2px);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <main class="container">
    <h2 class="page-title"><i class="fas fa-user-times"></i> Hapus User</h2>

    <div class="form-card">
      <h3><i class="fas fa-exclamation-triangle"></i> Konfirmasi Penghapusan</h3>

      <div class="warning-text">
        Apakah Anda yakin ingin menghapus user berikut? Tindakan ini tidak dapat dibatalkan.
      </div>

      <ul class="user-info">
        <li><strong>ID User:</strong> <?= htmlspecialchars($user['user_id'] ?? '-') ?></li>
        <li><strong>Nama Lengkap:</strong> <?= htmlspecialchars($user['nama_lengkap'] ?? '-') ?></li>
        <li><strong>Role:</strong> <?= htmlspecialchars($user['role_name'] ?? '-') ?></li>
        <li><strong>Kecamatan:</strong> <?= htmlspecialchars($user['nama_kecamatan'] ?? '-') ?></li>
      </ul>

      <form method="post">
        <div class="btn-group">
          <button type="submit" name="hapus" class="btn-danger">
            <i class="fas fa-trash"></i> Hapus User
          </button>
          <a href="/coba/index.php?page=adminutama" class="btn-cancel">
            <i class="fas fa-times"></i> Batal
          </a>
        </div>
      </form>
    </div>
  </main>
</body>

</html>