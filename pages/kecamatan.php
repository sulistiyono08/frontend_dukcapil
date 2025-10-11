<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/koneksi.php";

// Ambil kode dari URL
if (isset($_GET['kode'])) {
    $kode = mysqli_real_escape_string($koneksi, $_GET['kode']);
    $sql = "SELECT * FROM kecamatan WHERE kode_kecamatan = '$kode'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $kec = mysqli_fetch_assoc($result);
?>
        <h2>Data Kecamatan: <?= htmlspecialchars($kec['nama_kecamatan']) ?></h2>
        <p><b>Kode Kecamatan:</b> <?= htmlspecialchars($kec['kode_kecamatan']) ?></p>
        <p><b>Nama Kecamatan:</b> <?= htmlspecialchars($kec['nama_kecamatan']) ?></p>
<?php
    } else {
        echo "<p>Kecamatan tidak ditemukan.</p>";
    }
} else {
    echo "<p>Kode kecamatan tidak diberikan.</p>";
}
?>