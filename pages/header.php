<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<header>
  <div class="container header-content">
    <!-- Logo kiri -->
    <div class="logo-img">
      <img src="pages/Tubankab.png" alt="Logo Kabupaten Tuban" />
    </div>

    <!-- Judul tengah -->
    <div class="title-container">
      <h1>SISTEM INFORMASI DOKUMEN ON-LINE KEPENDUDUKAN</h1>
      <h2>KABUPATEN TUBAN</h2>
    </div>

    <!-- Ikon profil kanan -->
    <div class="account-icon" style="display:flex;flex-direction:column;align-items:center;gap:4px;">
      <a href="index.php?page=profile" style="text-decoration:none;color:#fff;display:flex;flex-direction:column;align-items:center;">
        <i class="fa-solid fa-user-circle" style="font-size:28px;"></i>
        <span style="font-size:14px;margin-top:2px;">
          <?= htmlspecialchars($_SESSION['nama'] ?? 'Profil') ?>
        </span>
      </a>
    </div>
  </div>
</header>
