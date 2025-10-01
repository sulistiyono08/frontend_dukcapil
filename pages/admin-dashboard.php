<?php 
include 'cek_session.php';
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin | SIDOKU Tuban</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
      /* Reset */
      
      /* Main Content */
      .main-content {
        padding: 40px 0;
        flex: 1;
      }
      .page-title {
        color: #1a3a8f;
        font-size: 26px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
      }
      .page-title i {
        margin-right: 10px;
      }

      /* Cards Layout: Horizontal 2 baris */
      .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 40px;
      }
      .card {
        flex: 1 1 calc(50% - 20px); /* 2 card per baris */
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-width: 250px;
      }
      .card h3 {
        font-size: 18px;
        color: #444;
      }
      .card p {
        font-size: 24px;
        font-weight: bold;
        color: #1a3a8f;
      }
      .card i {
        font-size: 40px;
        color: #2d5bbd;
      }

      /* Chart Section */
      .chart-container {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
      }
      .chart-container h3 {
        margin-bottom: 20px;
        color: #1a3a8f;
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

     
    </style>
  </head>
  <body>
   

    <!-- Main Content -->
    <main class="container main-content">
      <h2 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h2>

      <!-- Cards (2 baris horizontal) -->
      <div class="card-container">
        <div class="card">
          <div>
            <h3>Total Pengajuan</h3>
            <p>1,245</p>
          </div>
          <i class="fas fa-folder-open"></i>
        </div>
        <div class="card">
          <div>
            <h3>Proses</h3>
            <p>320</p>
          </div>
          <i class="fas fa-spinner"></i>
        </div>
        <div class="card">
          <div>
            <h3>Selesai</h3>
            <p>890</p>
          </div>
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="card">
          <div>
            <h3>Ditolak</h3>
            <p>35</p>
          </div>
          <i class="fas fa-times-circle"></i>
        </div>
      </div>

      <!-- Chart -->
      <div class="chart-container">
        <h3><i class="fas fa-chart-bar"></i> Statistik Pengajuan</h3>
        <canvas id="chartPengajuan"></canvas>
      </div>

      <!-- Table -->
      <h3 style="color: #1a3a8f; margin-bottom: 15px"><i class="fas fa-history"></i> Aktivitas Terbaru</h3>
      <table>
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama Pemohon</th>
            <th>Layanan</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-09-04</td>
            <td>Budi Santoso</td>
            <td>Akta Kelahiran</td>
            <td>Selesai</td>
          </tr>
          <tr>
            <td>2025-09-03</td>
            <td>Siti Aminah</td>
            <td>Akta Kematian</td>
            <td>Proses</td>
          </tr>
          <tr>
            <td>2025-09-02</td>
            <td>Agus Salim</td>
            <td>KIA</td>
            <td>Ditolak</td>
          </tr>
        </tbody>
      </table>
    </main>

    <!-- Chart Script -->
    <script>
      const ctx = document.getElementById("chartPengajuan").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Akta Kelahiran", "Akta Kematian", "KIA", "KK", "Pindah", "Kedatangan"],
          datasets: [
            {
              label: "Jumlah Pengajuan",
              data: [320, 120, 210, 180, 90, 70],
              backgroundColor: "#2d5bbd",
            },
          ],
        },
        options: {
          responsive: true,
          plugins: { legend: { display: false } },
        },
      });
    </script>
  </body>
</html>
