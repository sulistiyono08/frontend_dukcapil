<?php
// index.php
include '../cek_session.php';
include '../koneksi.php';
// Ambil parameter page dari URL, default = home
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f5f7fa;
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* ========== HEADER ========== */
    header {
      background: linear-gradient(135deg, #1a3a8f 0%, #2d5bbd 100%);
      color: white;
      padding: 25px 0;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
    }

    .logo-img img {
      width: 70px;
      margin-right: 15px;
    }

    .title-container {
      text-align: left;
      flex: 1;
    }

    .title-container h1 {
      font-size: 22px;
      margin-bottom: 5px;
    }

    .title-container h2 {
      font-size: 16px;
      font-weight: normal;
    }

    /* Ikon profil di pojok kanan */
    .account-icon {
      font-size: 32px;
      /* ukuran ikon */
      color: white;
      /* warna putih agar kontras */
      margin-left: auto;
      /* dorong ke kanan */
      padding-right: 5px;
      /* jarak dari tepi kanan (ubah sesuai selera) */
    }

    .account-icon a {
      color: inherit;
      text-decoration: none;
    }

    .account-icon a:hover {
      color: #1a3a8f;
      /* warna saat hover */
    }

    /* ========== NAVBAR ========== */
    nav {
      background-color: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .nav-container {
      display: flex;
      justify-content: center;
    }

    .nav-menu {
      display: flex;
      list-style: none;
    }

    .nav-menu li {
      padding: 15px 25px;
      position: relative;
    }

    .nav-menu li a {
      text-decoration: none;
      color: #444;
      font-weight: 500;
      transition: color 0.3s;
      display: flex;
      align-items: center;
    }

    .nav-menu li a:hover {
      color: #1a3a8f;
    }

    .nav-menu li a::before {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 3px;
      background-color: #1a3a8f;
      transition: width 0.3s;
    }

    .nav-menu li a:hover::before {
      width: 100%;
    }

    /* ========== FOOTER ========== */
    footer {
      background-color: #1a3a8f;
      color: white;
      padding: 30px 0;
      text-align: center;
      margin-top: auto;
    }

    .footer-logo {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .footer-logo i {
      margin-right: 10px;
    }

    .footer-info {
      max-width: 600px;
      margin: 10px auto;
    }

    .footer-contact p {
      margin: 5px 0;
    }

    .copyright {
      margin-top: 15px;
      font-size: 14px;
      opacity: 0.8;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <?php include 'nav.php'; ?>

  <div class="container">
    <?php
    // === switch case di sini ===
    switch ($page) {
      case 'home':
        include '../index1.php';
        break;
      case 'about':
        include 'pages/about.php';
        break;
      case 'contact':
        include 'pages/contact.php';
        break;
      default:
        echo "<h1>404 - Halaman tidak ditemukan</h1>";
        break;
    }
    ?>
  </div>

  <?php include 'footer.php'; ?>
</body>


</html>