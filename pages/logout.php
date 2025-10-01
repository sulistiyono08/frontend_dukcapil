<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logout - SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Main Content */
    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    .logout-box {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      max-width: 400px;
    }

    .logout-box i {
      font-size: 60px;
      color: #dc3545;
      margin-bottom: 20px;
    }

    .logout-box h2 {
      color: #1a3a8f;
      margin-bottom: 15px;
    }

    .logout-box p {
      margin-bottom: 30px;
      color: #555;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .btn {
      padding: 12px 25px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      border: none;
      font-size: 14px;
      text-decoration: none;
      display: inline-block;
    }

    .btn-logout {
      background: #dc3545;
      color: #fff;
    }

    .btn-logout:hover {
      background: #b02a37;
    }

    .btn-cancel {
      background: #6c757d;
      color: #fff;
    }

    .btn-cancel:hover {
      background: #565e64;
    }
  </style>
</head>

<body>

  <!-- Main Content -->
  <main class="main-content">
    <div class="logout-box">
      <i class="fas fa-sign-out-alt"></i>
      <h2>Konfirmasi Logout</h2>
      <p>Apakah Anda yakin ingin keluar dari sistem?</p>
      <div class="btn-group">
        <a href="index.php?page=cek_logout" class="btn btn-logout">Ya, Logout</a>
        <a href="admin-dashboard.html" class="btn btn-cancel">Batal</a>
      </div>
    </div>
  </main>

</body>

</html>