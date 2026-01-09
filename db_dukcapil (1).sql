-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2025 pada 03.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dukcapil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `kecamatan_id` int(11) NOT NULL,
  `kode_kecamatan` varchar(10) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`kecamatan_id`, `kode_kecamatan`, `nama_kecamatan`) VALUES
(1, 'KCM01', 'Bancar'),
(2, 'KCM02', 'Bangilan'),
(3, 'KCM03', 'Grabagan'),
(4, 'KCM04', 'Jatirogo'),
(5, 'KCM05', 'Jenu'),
(6, 'KCM06', 'Kenduruan'),
(7, 'KCM07', 'Kerek'),
(8, 'KCM08', 'Merakurak'),
(9, 'KCM09', 'Montong'),
(10, 'KCM10', 'Palang'),
(11, 'KCM11', 'Parengan'),
(12, 'KCM12', 'Plumpang'),
(13, 'KCM13', 'Rengel'),
(14, 'KCM14', 'Semanding'),
(15, 'KCM15', 'Senori'),
(16, 'KCM16', 'Singgahan'),
(17, 'KCM17', 'Soko'),
(18, 'KCM18', 'Tambakboyo'),
(19, 'KCM19', 'Tuban'),
(20, 'KCM20', 'Widang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` varchar(20) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
('admin', 'Administrator'),
('operator', 'Operator'),
('pemohon', 'Pemohon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `kode_user` varchar(30) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(20) DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `kode_user`, `nama_lengkap`, `username`, `nik`, `email`, `password`, `role_id`, `kecamatan_id`, `status`, `last_login`, `last_logout`) VALUES
(1, 'OPR-KCM15-0001', 'SULISTIYONO22', 'sul83', '1234567890121344', 'sul@gmail.com', '$2y$10$ZVVbYrVMp0ALSqlYus9TXOWlB/l..Dudu/J2wHtJpCi/UJOW3U0Uq', 'operator', 15, 'aktif', '2025-11-01 03:00:24', '2025-11-01 03:00:48'),
(3, 'ADM-0001', 'dhea', 'dea', '7319827347136257', 'dhea@gmail.com', '$2y$10$HOfH0UDFS3Y05TwtRoDIVe9x/wsF2tcE/9U/P2wH3to2dIUU/rh1a', 'admin', NULL, 'aktif', '2025-10-21 08:50:25', '2025-10-15 08:00:22'),
(9, 'ADM-0003', 'jauhari', 'jo', '9438598359345348', 'jauhari@gmail.com', '$2y$10$QbiAPNkxUDoJIo7xQG8T4OptR6xH4FrR5G1nxqMKKLOMwk3obSDVy', 'admin', NULL, 'aktif', '2025-11-01 03:00:58', '2025-10-11 16:40:09'),
(16, 'OPR-KCM06-0001', 'johan firmansyah', 'johan', '3423945692375783', 'johan@gmail.com', '$2y$10$j6UNP8s36Mz8TYBIiW5LU.RIzEu6LgpbXzCNwUl9CSg4lT/t6QAlS', 'operator', 6, 'aktif', NULL, NULL),
(17, 'ADM-0004', 'wahyu firmansyah', 'wahyu2', '2333245446567587', 'wahyu@gmail.com', '$2y$10$.zuRb.R/qgcEqyMLyvQs7eHCmTWcfE3S5yCAPkcbLIOHZPJce.DBa', 'admin', NULL, 'nonaktif', NULL, NULL);

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `before_insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
  DECLARE newKode VARCHAR(30);
  DECLARE nextNum INT DEFAULT 1;
  DECLARE kodeKec VARCHAR(10);

  IF NEW.role_id = 'admin' THEN
    -- Ambil nomor terakhir admin
    SELECT COALESCE(MAX(CAST(SUBSTRING(kode_user,5) AS UNSIGNED)),0)+1
    INTO nextNum
    FROM users WHERE role_id='admin';
    SET newKode = CONCAT('ADM-', LPAD(nextNum,4,'0'));

  ELSEIF NEW.role_id = 'operator' THEN
    -- Ambil kode kecamatan
    SELECT kode_kecamatan INTO kodeKec FROM kecamatan WHERE kecamatan_id = NEW.kecamatan_id;

    -- Ambil nomor terakhir operator per kecamatan
    SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(kode_user,'-',-1) AS UNSIGNED)),0)+1
    INTO nextNum
    FROM users WHERE role_id='operator' AND kecamatan_id=NEW.kecamatan_id;

    SET newKode = CONCAT('OPR-', kodeKec, '-', LPAD(nextNum,4,'0'));

  ELSEIF NEW.role_id = 'pemohon' THEN
    -- contoh untuk pemohon: PMH-xxxx
    SELECT COALESCE(MAX(CAST(SUBSTRING(kode_user,5) AS UNSIGNED)),0)+1
    INTO nextNum
    FROM users WHERE role_id='pemohon';
    SET newKode = CONCAT('PMH-', LPAD(nextNum,4,'0'));
  END IF;

  SET NEW.kode_user = newKode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_log`
--

CREATE TABLE `user_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aktivitas` enum('login','logout') NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_log`
--

INSERT INTO `user_log` (`log_id`, `user_id`, `aktivitas`, `waktu`) VALUES
(1, 1, 'login', '2025-09-30 03:25:40'),
(2, 1, 'logout', '2025-09-30 03:32:05'),
(3, 1, 'login', '2025-09-30 03:36:34'),
(4, 1, 'logout', '2025-09-30 03:36:37'),
(5, 1, 'login', '2025-09-30 03:39:53'),
(6, 1, 'logout', '2025-09-30 03:39:56'),
(7, 1, 'login', '2025-09-30 03:41:06'),
(8, 1, 'logout', '2025-09-30 03:41:09'),
(9, 1, 'login', '2025-09-30 03:45:23'),
(10, 1, 'logout', '2025-09-30 03:45:26'),
(11, 1, 'login', '2025-09-30 03:48:27'),
(12, 1, 'logout', '2025-09-30 03:48:29'),
(13, 1, 'login', '2025-09-30 03:50:54'),
(14, 1, 'logout', '2025-09-30 03:50:59'),
(15, 1, 'login', '2025-09-30 03:55:18'),
(16, 1, 'logout', '2025-09-30 03:55:29'),
(17, 1, 'login', '2025-09-30 04:01:18'),
(18, 1, 'logout', '2025-09-30 04:02:12'),
(19, 1, 'login', '2025-09-30 04:03:10'),
(20, 1, 'logout', '2025-09-30 04:03:13'),
(21, 1, 'login', '2025-09-30 04:03:39'),
(22, 1, 'logout', '2025-09-30 04:03:41'),
(24, 1, 'login', '2025-09-30 04:18:07'),
(25, 1, 'login', '2025-10-01 01:31:55'),
(26, 1, 'login', '2025-10-01 03:38:24'),
(27, 1, 'login', '2025-10-01 04:14:49'),
(28, 1, 'login', '2025-10-01 06:29:31'),
(29, 1, 'login', '2025-10-04 12:18:24'),
(30, 1, 'logout', '2025-10-04 12:18:28'),
(31, 3, 'login', '2025-10-04 12:26:47'),
(32, 3, 'login', '2025-10-04 13:09:04'),
(33, 3, 'login', '2025-10-04 13:16:37'),
(34, 3, 'login', '2025-10-04 13:22:49'),
(35, 3, 'login', '2025-10-04 13:24:43'),
(36, 3, 'login', '2025-10-04 13:33:41'),
(37, 3, 'login', '2025-10-04 13:40:24'),
(38, 1, 'login', '2025-10-04 13:40:43'),
(39, 3, 'login', '2025-10-04 13:42:17'),
(40, 1, 'login', '2025-10-04 13:49:41'),
(41, 3, 'login', '2025-10-04 13:55:50'),
(42, 3, 'login', '2025-10-05 12:56:12'),
(43, 3, 'login', '2025-10-05 13:10:37'),
(44, 3, 'logout', '2025-10-05 13:15:47'),
(45, 3, 'login', '2025-10-05 13:15:54'),
(46, 3, 'login', '2025-10-05 13:19:50'),
(47, 3, 'login', '2025-10-05 13:20:20'),
(48, 1, 'login', '2025-10-05 13:21:43'),
(49, 1, 'logout', '2025-10-05 13:22:09'),
(50, 3, 'login', '2025-10-05 13:22:18'),
(51, 1, 'login', '2025-10-05 13:24:42'),
(52, 3, 'login', '2025-10-05 13:26:44'),
(53, 3, 'login', '2025-10-06 05:12:21'),
(54, 3, 'login', '2025-10-06 06:27:08'),
(55, 3, 'login', '2025-10-06 06:30:23'),
(56, 3, 'login', '2025-10-06 06:30:55'),
(57, 3, 'login', '2025-10-08 01:38:26'),
(58, 9, 'login', '2025-10-08 01:50:00'),
(59, 3, 'login', '2025-10-08 02:00:04'),
(60, 3, 'login', '2025-10-08 02:07:44'),
(61, 3, 'login', '2025-10-08 02:15:58'),
(62, 3, 'login', '2025-10-08 02:19:46'),
(63, 3, 'login', '2025-10-08 02:25:34'),
(64, 3, 'login', '2025-10-08 02:33:58'),
(65, 3, 'login', '2025-10-08 02:57:53'),
(66, 3, 'login', '2025-10-08 03:03:30'),
(67, 3, 'logout', '2025-10-08 03:08:13'),
(68, 1, 'login', '2025-10-08 03:08:25'),
(69, 1, 'logout', '2025-10-08 03:09:18'),
(70, 3, 'login', '2025-10-08 03:09:26'),
(71, 3, 'logout', '2025-10-08 03:09:30'),
(72, 1, 'login', '2025-10-08 03:10:25'),
(73, 3, 'login', '2025-10-11 13:05:47'),
(74, 3, 'login', '2025-10-11 13:41:05'),
(75, 3, 'logout', '2025-10-11 13:58:50'),
(76, 9, 'login', '2025-10-11 13:59:50'),
(77, 9, 'logout', '2025-10-11 14:00:29'),
(78, 9, 'login', '2025-10-11 14:09:56'),
(79, 9, 'login', '2025-10-11 14:20:17'),
(80, 9, 'login', '2025-10-11 14:37:59'),
(81, 9, 'logout', '2025-10-11 14:40:09'),
(82, 9, 'login', '2025-10-11 14:40:24'),
(83, 9, 'login', '2025-10-15 05:49:59'),
(84, 3, 'login', '2025-10-15 05:58:00'),
(85, 3, 'logout', '2025-10-15 06:00:22'),
(86, 1, 'login', '2025-10-15 06:00:48'),
(87, 1, 'login', '2025-10-21 06:49:17'),
(88, 3, 'login', '2025-10-21 06:50:25'),
(89, 9, 'login', '2025-11-01 01:59:25'),
(90, 1, 'login', '2025-11-01 02:00:24'),
(91, 1, 'logout', '2025-11-01 02:00:48'),
(92, 9, 'login', '2025-11-01 02:00:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`kecamatan_id`),
  ADD UNIQUE KEY `kode_kecamatan` (`kode_kecamatan`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `kode_user` (`kode_user`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indeks untuk tabel `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_log_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `kecamatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`kecamatan_id`);

--
-- Ketidakleluasaan untuk tabel `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
