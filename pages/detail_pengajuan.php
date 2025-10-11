<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan - SIDOKU Kabupaten Tuban</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Layout Landscape */
        .landscape-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 20px;
            align-items: start;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .detail-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-title {
            font-size: 20px;
            color: #1e3c72;
            font-weight: 600;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-proses {
            background: #cce7ff;
            color: #004085;
            border: 1px solid #b3d7ff;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Grid informasi dalam 3 kolom untuk landscape */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #333;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #2a5298;
        }

        /* Dokumen lampiran dengan grid */
        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .document-item {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #2a5298;
        }

        /* Section Verifikasi */
        .verification-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .verification-title {
            font-size: 18px;
            color: #1e3c72;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .status-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .status-option input[type="radio"] {
            display: none;
        }

        .status-option label {
            display: block;
            padding: 12px 15px;
            background: white;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .status-option input[type="radio"]:checked+label {
            border-color: #2a5298;
            background: #2a5298;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(42, 82, 152, 0.3);
        }

        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-primary {
            background: #2a5298;
            color: white;
        }

        .btn-primary:hover {
            background: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(42, 82, 152, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        /* Timeline horizontal */
        .timeline-horizontal {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-top: 20px;
            padding: 20px 0;
        }

        .timeline-horizontal::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #2a5298;
            transform: translateY(-50%);
        }

        .timeline-item-horizontal {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .timeline-marker-horizontal {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 3px solid #2a5298;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .timeline-content-horizontal {
            background: white;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 200px;
        }

        /* Responsive untuk landscape */
        @media (max-width: 1200px) {
            .landscape-layout {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .status-options {
                grid-template-columns: 1fr;
            }

            .btn-group {
                grid-template-columns: 1fr;
            }

            .timeline-horizontal {
                flex-direction: column;
                gap: 15px;
            }

            .timeline-horizontal::before {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="landscape-layout">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Detail Pengajuan -->
                <div class="detail-card">
                    <div class="card-header">
                        <div class="card-title">Detail Pengajuan - REG-001</div>
                        <div class="status-badge status-pending" id="currentStatus">PENDING</div>
                    </div>

                    <!-- Informasi Pengajuan dalam 3 kolom -->
                    <div class="info-grid">
                        <div>
                            <div class="info-group">
                                <div class="info-label">Nomor Registrasi</div>
                                <div class="info-value">REG-001</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Nama Penduduk</div>
                                <div class="info-value">Bud Santoro</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">NIK</div>
                                <div class="info-value">3514123456780001</div>
                            </div>
                        </div>
                        <div>
                            <div class="info-group">
                                <div class="info-label">Jenis Layanan</div>
                                <div class="info-value">Akta Kelahiran</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Tanggal Pengajuan</div>
                                <div class="info-value">2025-09-01</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Email</div>
                                <div class="info-value">bud.santoro@email.com</div>
                            </div>
                        </div>
                        <div>
                            <div class="info-group">
                                <div class="info-label">No. Telepon</div>
                                <div class="info-value">081234567890</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Alamat</div>
                                <div class="info-value">Jl. Raya Tuban No. 123</div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Kecamatan</div>
                                <div class="info-value">Tuban</div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Lampiran -->
                    <div class="info-group">
                        <div class="info-label">Dokumen Lampiran</div>
                        <div class="documents-grid">
                            <div class="document-item">
                                <strong>Scan KTP</strong>
                                <div><a href="#" style="color: #2a5298;">Download</a></div>
                            </div>
                            <div class="document-item">
                                <strong>Scan KK</strong>
                                <div><a href="#" style="color: #2a5298;">Download</a></div>
                            </div>
                            <div class="document-item">
                                <strong>Surat Keterangan Lahir</strong>
                                <div><a href="#" style="color: #2a5298;">Download</a></div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Horizontal -->
                    <div class="timeline-horizontal">
                        <div class="timeline-item-horizontal">
                            <div class="timeline-marker-horizontal">1</div>
                            <div class="timeline-content-horizontal">
                                <strong>Pengajuan Diterima</strong>
                                <p>Sistem menerima pengajuan</p>
                                <small>2025-09-01 10:30</small>
                            </div>
                        </div>
                        <div class="timeline-item-horizontal">
                            <div class="timeline-marker-horizontal">2</div>
                            <div class="timeline-content-horizontal">
                                <strong>Verifikasi Dokumen</strong>
                                <p>Menunggu verifikasi admin</p>
                                <small>Status: Pending</small>
                            </div>
                        </div>
                        <div class="timeline-item-horizontal">
                            <div class="timeline-marker-horizontal">3</div>
                            <div class="timeline-content-horizontal">
                                <strong>Proses Selesai</strong>
                                <p>Dokumen siap diambil</p>
                                <small>-</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar untuk Verifikasi -->
            <div class="sidebar">
                <!-- Section Verifikasi -->
                <div class="detail-card">
                    <div class="verification-section">
                        <div class="verification-title">Verifikasi Pengajuan</div>

                        <div class="status-options">
                            <div class="status-option">
                                <input type="radio" id="statusPending" name="status" value="pending">
                                <label for="statusPending">🟡 Pending</label>
                            </div>
                            <div class="status-option">
                                <input type="radio" id="statusProses" name="status" value="proses">
                                <label for="statusProses">🔵 Prosses</label>
                            </div>
                            <div class="status-option">
                                <input type="radio" id="statusSelesai" name="status" value="selesai">
                                <label for="statusSelesai">🟢 Selesai</label>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Catatan Verifikasi</div>
                            <textarea id="verificationNotes" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; resize: vertical;" placeholder="Tambahkan catatan verifikasi jika diperlukan..."></textarea>
                        </div>

                        <div class="btn-group">
                            <button class="btn btn-secondary" onclick="kembaliKeDaftar()">Kembali</button>
                            <button class="btn btn-primary" onclick="simpanVerifikasi()">Simpan Verifikasi</button>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="detail-card">
                    <div class="info-group">
                        <div class="info-label">Petugas Verifikasi</div>
                        <div class="info-value">Admin SIDOKU</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Tanggal Verifikasi</div>
                        <div class="info-value" id="verificationDate">-</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Lama Proses</div>
                        <div class="info-value" id="processDuration">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi status berdasarkan data saat ini
        document.addEventListener('DOMContentLoaded', function() {
            const currentStatus = document.getElementById('currentStatus').textContent.toLowerCase();
            document.getElementById(`status${currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1)}`).checked = true;
            updateVerificationDate();
        });

        // Fungsi simpan verifikasi
        function simpanVerifikasi() {
            const selectedStatus = document.querySelector('input[name="status"]:checked');
            const notes = document.getElementById('verificationNotes').value;

            if (!selectedStatus) {
                alert('Pilih status verifikasi terlebih dahulu!');
                return;
            }

            // Update status badge
            const statusBadge = document.getElementById('currentStatus');
            statusBadge.textContent = selectedStatus.value.toUpperCase();
            statusBadge.className = 'status-badge status-' + selectedStatus.value;

            // Update timeline
            updateTimeline(selectedStatus.value, notes);

            // Update info tambahan
            updateVerificationDate();
            updateProcessDuration();

            // Simulasi penyimpanan
            alert(`Status berhasil diupdate menjadi: ${selectedStatus.value.toUpperCase()}\nCatatan: ${notes || 'Tidak ada catatan'}`);
        }

        // Fungsi update timeline
        function updateTimeline(status, notes) {
            const timelineItems = document.querySelectorAll('.timeline-item-horizontal');

            // Update step 2
            if (timelineItems[1]) {
                timelineItems[1].querySelector('.timeline-content-horizontal').innerHTML = `
                    <strong>Verifikasi Dokumen</strong>
                    <p>${notes || 'Dokumen sedang diverifikasi'}</p>
                    <small>${new Date().toLocaleString('id-ID')} • Status: ${status.toUpperCase()}</small>
                `;
            }

            // Update step 3 jika status selesai
            if (status === 'selesai' && timelineItems[2]) {
                timelineItems[2].querySelector('.timeline-content-horizontal').innerHTML = `
                    <strong>Proses Selesai</strong>
                    <p>Dokumen telah selesai diverifikasi</p>
                    <small>${new Date().toLocaleString('id-ID')}</small>
                `;
            }
        }

        // Update tanggal verifikasi
        function updateVerificationDate() {
            document.getElementById('verificationDate').textContent = new Date().toLocaleDateString('id-ID');
        }

        // Update lama proses
        function updateProcessDuration() {
            const startDate = new Date('2025-09-01');
            const endDate = new Date();
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            document.getElementById('processDuration').textContent = `${diffDays} hari`;
        }

        // Fungsi kembali ke daftar
        function kembaliKeDaftar() {
            if (confirm('Apakah Anda yakin ingin kembali? Perubahan yang belum disimpan akan hilang.')) {
                window.location.href = 'daftar-pengajuan.html';
            }
        }

        // Event listener untuk real-time preview
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const statusBadge = document.getElementById('currentStatus');
                statusBadge.textContent = this.value.toUpperCase();
                statusBadge.className = 'status-badge status-' + this.value;
            });
        });
    </script>
</body>

</html>