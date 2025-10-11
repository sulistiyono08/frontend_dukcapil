<?php
include 'cek_session.php';
include 'koneksi.php';
$id = $_GET['id'];
$user = $koneksi->query("SELECT * FROM users WHERE user_id=$id")->fetch_assoc();
$roles = $koneksi->query("SELECT * FROM roles");
$kec   = $koneksi->query("SELECT * FROM kecamatan");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit User - Admin | SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="style.css">
  <style>
    /* Gunakan style form dari halaman tambah user */
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
      max-width: 1100px;
      margin: 40px auto;
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
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      flex: 1;
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

    .info-text {
      font-size: 13px;
      color: #6c757d;
      margin-top: 6px;
      font-style: italic;
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

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 15px;
      }

      .btn-submit {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>

<body>
  <main class="container">
    <h2 class="page-title"><i class="fas fa-user-edit"></i> Edit User</h2>

    <div class="form-card">
      <h3><i class="fas fa-user-cog"></i> Perbarui Data User</h3>

      <form action="update_user.php" method="post">
        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

        <div class="form-row">
          <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" id="nik" name="nik" class="form-control" maxlength="16" pattern="\d{16}"
              oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,16)"
              value="<?= htmlspecialchars($user['nik']) ?>" required>
            <div class="info-text">*Masukkan 16 digit angka</div>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="role_id">Role User</label>
            <select id="role_id" name="role_id" class="form-control" required>
              <?php while ($r = $roles->fetch_assoc()): ?>
                <option value="<?= $r['role_id'] ?>" <?= $r['role_id'] == $user['role_id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($r['role_name']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="kecamatan_id">Kecamatan</label>
            <select id="kecamatan_id" name="kecamatan_id" class="form-control">
              <option value="">(Hanya untuk Operator)</option>
              <?php while ($k = $kec->fetch_assoc()): ?>
                <option value="<?= $k['kecamatan_id'] ?>" <?= $k['kecamatan_id'] == $user['kecamatan_id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($k['nama_kecamatan']) ?>
                </option>
              <?php endwhile; ?>
            </select>
            <div class="info-text">Pilihan ini hanya untuk user dengan role Operator</div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
              <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
              <option value="nonaktif" <?= $user['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fas fa-save"></i> Perbarui User
        </button>
      </form>
    </div>
  </main>
</body>

</html>
