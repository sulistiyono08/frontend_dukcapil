<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Dokumen On-line Kependudukan Kabupaten Tuban</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* Reset dan Base Styles */
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
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
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 70px;
            height: 70px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
            color: #1a3a8f;
            font-size: 12px;
            text-align: center;
        }

        .title-container h1 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .title-container h2 {
            font-size: 16px;
            font-weight: normal;
        }

        /* Navigation */
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

        /* Main Content */
        .main-content {
            padding: 40px 0;
        }

        .info-banner {
            background-color: #e8f4ff;
            border-left: 5px solid #1a3a8f;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 0 5px 5px 0;
            display: flex;
            align-items: center;
        }

        .info-banner i {
            color: #1a3a8f;
            margin-right: 10px;
            font-size: 20px;
        }

        .services-section {
            margin-bottom: 40px;
        }

        .section-title {
            color: #1a3a8f;
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .service-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .service-header {
            background: linear-gradient(135deg, #1a3a8f 0%, #2d5bbd 100%);
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-header i {
            margin-right: 10px;
        }

        .service-list {
            padding: 20px;
        }

        .service-list ul {
            list-style: none;
        }

        .service-list li {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
        }

        .service-list li:last-child {
            border-bottom: none;
        }

        .service-list li::before {
            content: "•";
            color: #1a3a8f;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-right: 5px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .logo-container {
                margin-bottom: 15px;
                justify-content: center;
            }

            .nav-menu {
                flex-direction: column;
                align-items: center;
            }

            .nav-menu li {
                width: 100%;
                text-align: center;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <main class="container main-content">
        <div class="info-banner">
            <i class="fas fa-info-circle"></i>
            <p><strong>Informasi:</strong> Permohonan Akan Diproses Pada Hari dan Jam Kerja</p>
        </div>

        <section class="services-section">
            <h2 class="section-title"><i class="fas fa-concierge-bell"></i> Pelayanan</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-header"><i class="fas fa-baby"></i> AKTA KELAHIRAN</div>
                    <div class="service-list">
                        <ul>
                            <li><a href="../form.html">Pengajuan Akta Kelahiran</a></li>
                            <li><a href="../form.html">Cetak Ulang Akta Kelahiran</a></li>
                            <li><a href="../form.html">Perbaikan Data Akta Kelahiran</a></li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header"><i class="fas fa-cross"></i> AKTA KEMATIAN</div>
                    <div class="service-list">
                        <ul>
                            <li><a href="../kematian/form kematian.php">Pengajuan Akta Kematian</a></li>
                            <li><a href="../form.html">Cetak Ulang Akta Kematian</a></li>
                            <li><a href="../form.html">Perbaikan Data Akta Kematian</a></li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header"><i class="fas fa-id-card"></i> KARTU IDENTITAS ANAK</div>
                    <div class="service-list">
                        <ul>
                            <li>Pembuatan KIA</li>
                            <li>Perpanjangan Masa Berlaku</li>
                            <li>Penggantian KIA Hilang/Rusak</li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header"><i class="fas fa-house-user"></i> PERUBAHAN DATA KARTU KELUARGA</div>
                    <div class="service-list">
                        <ul>
                            <li>Perubahan Alamat</li>
                            <li>Perubahan Status</li>
                            <li>Pembaruan Data Penduduk</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="services-section">
            <h2 class="section-title"><i class="fas fa-list-alt"></i> LAYANAN LAINNYA</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-header"><i class="fas fa-truck-moving"></i> PERPINDAHAN KELUAR</div>
                    <div class="service-list">
                        <ul>
                            <li>Pindah Dalam Kabupaten</li>
                            <li>Pindah Luar Kabupaten</li>
                            <li>Pindah Luar Negeri</li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header"><i class="fas fa-people-carry"></i> KEDATANGAN</div>
                    <div class="service-list">
                        <ul>
                            <li>Pendatang Baru</li>
                            <li>Pendatang Kembali</li>
                            <li>Pencatatan Kedatangan</li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header"><i class="fas fa-heart"></i> AKTA CERAI DAN AKTA KAWIN</div>
                    <div class="service-list">
                        <ul>
                            <li>Pencatatan Perkawinan</li>
                            <li>Pencatatan Perceraian</li>
                            <li>Cetak Ulang Akta</li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-header"><i class="fas fa-laptop"></i> e-PAKEM</div>
                    <div class="service-list">
                        <ul>
                            <li>Pelayanan Administrasi</li>
                            <li>Kependudukan Elektronik</li>
                            <li>Informasi lebih lanjut</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>


</body>

</html>