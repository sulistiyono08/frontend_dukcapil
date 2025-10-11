<?php
include __DIR__ . "/koneksi.php"; // pastikan koneksi dipanggil

$sql = "SELECT * FROM kecamatan ORDER BY nama_kecamatan ASC";
$result = mysqli_query($koneksi, $sql);
?>
<style>.nav-menu li ul {
  display: none;
  position: absolute;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  list-style: none;
  padding: 0;
  margin: 0;
  min-width: 200px;
  z-index: 999;
}

.nav-menu li ul li {
  padding: 10px;
}

.nav-menu li ul li a {
  color: #444;
  text-decoration: none;
  display: block;
}

.nav-menu li ul li a:hover {
  background: #f1f1f1;
  color: #1a3a8f;
}

.nav-menu li.dropdown:hover > ul {
  display: block;
}
</style>
<nav>
  <div class="container nav-container">
    <ul class="nav-menu">
      <li>
        <a href="index.php?page=admin-dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      </li>
      <li>
        <a href="index.php?page=admin-berkas"><i class="fas fa-folder-open"></i> Berkas Pengajuan</a>
      </li>
      <li>
        <a href="index.php?page=adminutama"><i class="fas fa-users"></i> Kelola User</a>
      </li>

      <!-- Dropdown Kecamatan -->
      <li class="dropdown">
        <a href="#"><i class="fas fa-map-marker-alt"></i> Kecamatan <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-menu">
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <li>
              <a href="index.php?page=kecamatan&kode=<?= $row['kode_kecamatan'] ?>">
                <?= htmlspecialchars($row['nama_kecamatan']) ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </li>

      <li>
        <a href="index.php?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>
