<?php
include 'cek_session.php';
include 'koneksi.php';

// ambil data role untuk dropdown
$roles = $koneksi->query("SELECT * FROM roles");
$kec   = $koneksi->query("SELECT * FROM kecamatan");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola User - Admin | SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="style.css">
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
    /* Main */
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

    /* Form Styling yang Diperbarui */
    .form-card {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
      border: 1px solid #e1e5ee;
    }

    .form-card h3 {
      margin-bottom: 25px;
      color: #1a3a8f;
      font-size: 22px;
      padding-bottom: 10px;
      border-bottom: 2px solid #e9eef9;
      display: flex;
      align-items: center;
    }

    .form-card h3 i {
      margin-right: 10px;
      color: #1a3a8f;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      flex: 1;
      margin-bottom: 0;
    }

    .form-group label {
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
      color: #2c3e50;
      font-size: 14px;
    }

    .form-control {
      width: 100%;
      padding: 14px 16px;
      border-radius: 8px;
      border: 2px solid #e1e5ee;
      font-size: 15px;
      transition: all 0.3s ease;
      background-color: #f9fafb;
    }

    .form-control:focus {
      outline: none;
      border-color: #1a3a8f;
      box-shadow: 0 0 0 3px rgba(26, 58, 143, 0.1);
      background-color: white;
    }

    .btn-submit {
      background: linear-gradient(135deg, #1a3a8f, #2d5bbd);
      color: white;
      padding: 14px 30px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-top: 10px;
    }

    .btn-submit:hover {
      background: linear-gradient(135deg, #14307a, #244b9b);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(26, 58, 143, 0.3);
    }

    /* Table */
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

    /* Info text untuk form */
    .info-text {
      font-size: 13px;
      color: #6c757d;
      margin-top: 6px;
      font-style: italic;
    }

    /* Required field indicator */
    .required::after {
      content: " *";
      color: #e74c3c;
    }

    /* Responsif untuk mobile */
    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 15px;
      }
      
      .form-card {
        padding: 20px;
      }
      
      .btn-submit {
        width: 100%;
        justify-content: center;
      }
    }

    /* Animasi untuk form */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .form-card {
      animation: fadeIn 0.5s ease-out;
    }

    /* Pesan sukses/error */
    .alert {
      padding: 12px 16px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-weight: 500;
    }
    
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>

<body>
  
  <!-- Main -->
  <main class="container main-content">
    <h2 class="page-title"><i class="fas fa-users"></i> Kelola User</h2>

    <!-- Sub Navbar -->
    <div class="sub-nav">
      <a href="index.php?page=admin-users" class="active"><i class="fas fa-user-plus"></i> Tambah User</a>
      <a href="index.php?page=adminutama"><i class="fas fa-list"></i> Daftar User</a>
    </div>

    <!-- Form Tambah User -->
    <div class="form-card" id="form-user">
      <h3><i class="fas fa-user-plus"></i> Tambah User Baru</h3>
      
      <!-- Menampilkan pesan sukses/error jika ada -->
      <?php
      if (isset($_GET['success'])) {
          echo '<div class="alert alert-success">User berhasil ditambahkan!</div>';
      }
      if (isset($_GET['error'])) {
          echo '<div class="alert alert-error">Gagal menambahkan user: ' . htmlspecialchars($_GET['error']) . '</div>';
      }
      ?>
      
      <form action="index.php?page=simpan_user" method="POST">
        <div class="form-row">
          <div class="form-group">
            <label for="nama_lengkap" class="required">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required />
          </div>
          <div class="form-group">
            <label for="username" class="required">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" required />
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="nik" class="required">NIK</label>
            <input
              type="text"
              id="nik"
              name="nik"
              class="form-control"
              placeholder="Masukkan NIK"
              required
              pattern="\d{16}"
              maxlength="16"
              oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)" />
            <div class="info-text">*Masukkan 16 digit angka</div>
          </div>
          <div class="form-group">
            <label for="email" class="required">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email" required />
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="password" class="required">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required />
          </div>
          <div class="form-group">
            <label for="role_id" class="required">Role User</label>
            <select id="role_id" name="role_id" class="form-control" required>
              <option value="">--Pilih Role--</option>
              <?php while ($r = $roles->fetch_assoc()): ?>
                <option value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="kecamatan_id">Kecamatan</label>
            <select id="kecamatan_id" name="kecamatan_id" class="form-control">
              <option value="">(Hanya untuk Operator)</option>
              <?php while ($k = $kec->fetch_assoc()): ?>
                <option value="<?= $k['kecamatan_id'] ?>"><?= $k['nama_kecamatan'] ?></option>
              <?php endwhile; ?>
            </select>
            <div class="info-text">Pilihan ini hanya untuk user dengan role Operator</div>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
        </div>
        
        <button type="submit" class="btn-submit">
          <i class="fas fa-save"></i> Simpan User
        </button>
      </form>
    </div>
  </main>

</body>

</html>