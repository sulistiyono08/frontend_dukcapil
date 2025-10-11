<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Berkas Pengajuan - Admin | SIDOKU Tuban</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Reset dan Base Styles */


    /* Main Content */
    .main-content {
      padding: 40px 0;
      flex: 1;
    }

    .page-title {
      color: #1a3a8f;
      font-size: 26px;
      margin-bottom: 25px;
      border-bottom: 2px solid #e0e0e0;
      padding-bottom: 10px;
      display: flex;
      align-items: center;
    }

    .page-title i {
      margin-right: 10px;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
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

    /* Status Colors */
    .status {
      font-weight: bold;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 13px;
    }

    .status-success {
      background: #e6f9f0;
      color: #155724;
      border: 1px solid #28a745;
    }

    .status-pending {
      background: #fff8e6;
      color: #856404;
      border: 1px solid #ffc107;
    }

    .status-rejected {
      background: #fdeaea;
      color: #721c24;
      border: 1px solid #dc3545;
    }
  </style>
</head>

<body>
  <!-- Main Content -->
  <main class="container main-content">
    <h2 class="page-title"><i class="fas fa-folder-open"></i> Daftar Berkas Pengajuan</h2>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor Registrasi</th>
          <th>Nama Pemohon</th>
          <th>NIK</th>
          <th>Jenis Layanan</th>
          <th>Tanggal Pengajuan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>REG-001</td>
          <td>Budi Santoso</td>
          <td>3514123456780001</td>
          <td>Akta Kelahiran</td>
          <td>2025-09-01</td>
          <td><span class="status status-pending">Proses</span></td>
          <td>
            <a href="index.php?page=detail_pengajuan" class="btn-detail"><i class="fas fa-eye"></i> Detail</a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>REG-002</td>
          <td>Siti Aminah</td>
          <td>3514123456780002</td>
          <td>Akta Kematian</td>
          <td>2025-08-28</td>
          <td><span class="status status-success">Selesai</span></td>
          <td>
            <a href="index.php?page=detail_pengajuan" class="btn-detail"><i class="fas fa-eye"></i> Detail</a>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>REG-003</td>
          <td>Agus Salim</td>
          <td>3514123456780003</td>
          <td>Kartu Identitas Anak</td>
          <td>2025-08-25</td>
          <td><span class="status status-rejected">Ditolak</span></td>
          <td>
            <a href="index.php?page=detail_pengajuan" class="btn-detail"><i class="fas fa-eye"></i> Detail</a>
          </td>
        </tr>
      </tbody>
    </table>
  </main>

</body>

</html>