<?php
$host = "localhost";
$user = "root"; // sesuaikan
$pass = "";     // sesuaikan
$db   = "db_dukcapil";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
