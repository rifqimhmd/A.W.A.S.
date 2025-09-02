-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2025 at 10:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awas`
--

-- --------------------------------------------------------

--
-- Table structure for table `antisipasi`
--

CREATE TABLE `antisipasi` (
  `id_antisipasi` int(11) NOT NULL,
  `nama_antisipasi` varchar(255) NOT NULL,
  `warna_antisipasi` varchar(255) NOT NULL,
  `id_instrument` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antisipasi`
--

INSERT INTO `antisipasi` (`id_antisipasi`, `nama_antisipasi`, `warna_antisipasi`, `id_instrument`) VALUES
(1, 'Terjadi peredaran, dan pengendalian', 'Merah', 1),
(2, 'Terjadi peyelundupan dari dalam', 'Kuning', 1),
(3, 'Terjadi penyelundupan dari luar', 'Hijau', 1),
(4, 'Telah terjadi penyebaran faham', 'Merah', 2),
(5, 'Berpotensi terjadi penyebaran faham', 'Kuning', 2),
(6, 'Tidak terjadi penyebaran faham', 'Hijau', 2);

-- --------------------------------------------------------

--
-- Table structure for table `faktor`
--

CREATE TABLE `faktor` (
  `id_faktor` int(11) NOT NULL,
  `nama_faktor` varchar(255) NOT NULL,
  `jenis_faktor` enum('Bahaya','Kerentanan') NOT NULL,
  `id_instrument` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faktor`
--

INSERT INTO `faktor` (`id_faktor`, `nama_faktor`, `jenis_faktor`, `id_instrument`) VALUES
(1, 'Lapas/Rutan/LPKA terdapat pengguna lebih dari 1 (satu) orang', 'Bahaya', 1),
(2, 'Lapas/Rutan/LPKA terdapat pengedar', 'Bahaya', 1),
(3, 'Lapas/Rutan/LPKA terdapat pengendali', 'Bahaya', 1),
(4, 'Pegawai terlibat dalam peredaran dan pengendalian', 'Kerentanan', 1),
(5, 'Jumlah petugas tidak sebanding dengan hunian', 'Kerentanan', 1),
(6, 'Sarana CCTV dan monitor tidak tersedia dan merata', 'Kerentanan', 1),
(7, 'Terdapat kelompok berpengaruh/berbahaya', 'Kerentanan', 1),
(8, 'Tidak dipisah/ditempatkan terduga berpengaruh/bahaya', 'Kerentanan', 1),
(9, 'Lapas/Rutan/LPKA terdapat idiolog  1 (satu) orang/lebih', 'Bahaya', 2),
(10, 'Lapas/Rutan/LPKA terdapat pengikut 1 (satu) orang/lebih', 'Bahaya', 2),
(11, 'Pegawai terlibat memfasilitasi kebutuhan teroris', 'Kerentanan', 2),
(12, 'Jumlah petugas tidak sebanding dengan hunian', 'Kerentanan', 2),
(13, 'Sarana CCTV dan monitor tidak tersedia dan merata', 'Kerentanan', 2),
(14, 'Kelompok Teroris tidak dipisah/ditempatkan terpisah', 'Kerentanan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `nama_wbp` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_antisipasi` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `nilai_skrining` int(11) NOT NULL,
  `nilai_bahaya` int(11) NOT NULL,
  `nilai_kerentanan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `nama_wbp`, `id_user`, `id_antisipasi`, `nilai_akhir`, `nilai_skrining`, `nilai_bahaya`, `nilai_kerentanan`, `id_kategori`, `created_at`) VALUES
(1, 'Test 1', 14, 1, 100, 100, 100, 100, 2, '2025-09-02 04:42:38'),
(11, 'Test 2', 14, 4, 100, 100, 100, 100, 4, '2025-09-01 23:43:07'),
(12, 'Test Cibinong 1', 16, 6, 17, 0, 0, 50, 5, '2025-09-02 01:53:08'),
(13, 'Test Cibinong 2', 16, 1, 100, 100, 100, 100, 2, '2025-09-02 02:55:40'),
(14, 'Test Cibinong 3', 16, 2, 52, 55, 100, 0, 3, '2025-09-02 02:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `instrument`
--

CREATE TABLE `instrument` (
  `id_instrument` int(11) NOT NULL,
  `nama_instrument` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instrument`
--

INSERT INTO `instrument` (`id_instrument`, `nama_instrument`) VALUES
(1, 'Narkotika'),
(2, 'Teroris');

-- --------------------------------------------------------

--
-- Table structure for table `kanwil`
--

CREATE TABLE `kanwil` (
  `id_kanwil` int(11) NOT NULL,
  `nama_kanwil` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kanwil`
--

INSERT INTO `kanwil` (`id_kanwil`, `nama_kanwil`, `created_at`, `updated_at`) VALUES
(1, 'DK Jakarta', '2025-09-02 03:36:55', '2025-09-02'),
(2, 'Jawa Barat', '2025-09-02 03:37:00', '2025-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `id_instrument` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `id_instrument`) VALUES
(1, 'Pengguna', 1),
(2, 'Pengedar', 1),
(3, 'Pengendali', 1),
(4, 'Ideolog', 2),
(5, 'Pengikut', 2);

-- --------------------------------------------------------

--
-- Table structure for table `skrining`
--

CREATE TABLE `skrining` (
  `id_skrining` int(11) NOT NULL,
  `nama_skrining` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skrining`
--

INSERT INTO `skrining` (`id_skrining`, `nama_skrining`, `id_kategori`) VALUES
(1, 'Terduga mengalami mata merah', 1),
(2, 'Terduga terlihat selalu lelah', 1),
(3, 'Terduga mengalami penurunan berat badan', 1),
(4, 'Terduga terlihat kulit pucat', 1),
(5, 'Terduga menyedot idung terus menerus', 1),
(6, 'Terduga sering flu', 1),
(7, 'Terduga mengalami radang paru-paru', 1),
(8, 'Terduga sering mengalami infeksi bakteri', 1),
(9, 'Terduga mengalami perubahan kepribadian', 1),
(10, 'Terduga emosional', 1),
(11, 'Terduga mengalami depresi', 1),
(12, 'Terduga terlihat suka menyendiri', 1),
(13, 'Terduga menghabiskan uang banyak', 1),
(14, 'Terduga berpenampilan kotor', 1),
(15, 'Terduga sering membahayakan diri dan orang lain', 1),
(16, 'Terduga sering melanggar tata tertib', 1),
(17, 'Menjadi pusat pergaulan', 2),
(18, 'Memiliki pembantu', 2),
(19, 'Berpenghasilan tanpa bekerja', 2),
(20, 'Berpengaruh', 2),
(21, 'Royal', 2),
(22, 'Memegang HP', 2),
(23, 'Tidak menggunakan identitas asli', 2),
(24, 'Penggunaan sandi atau kode dalam berkomunikasi', 2),
(25, 'Terdapat pola kunjungan yang berbeda', 2),
(26, 'Sangat santun', 3),
(27, 'Tidak banyak bicara', 3),
(28, 'Berpakaian sederhana', 3),
(29, 'Komunikasi tersembunyi', 3),
(30, 'Berpura-pura miskin', 3),
(31, 'Mempengaruhi', 3),
(32, 'Komunikasi menggunakan sandi', 3),
(33, 'Sering dikunjungi orang yang berbeda', 3),
(34, 'Terhubung dengan pihak luar selain dari narapidana', 3),
(35, 'Menerapkan struktur perintah puncak', 3),
(36, 'Eksploitasi perempuan sebagai kurir', 3),
(37, 'Anti-Pancasila dan pro ideologi khilafah transnasional', 4),
(38, 'Tidak mengakui negara NKRI', 4),
(39, 'Aktif menyebar propaganda lewat internet/spacesiber', 4),
(40, 'Target generasi muda lewat medsos', 4),
(41, 'Paham takfiri (mengkafirkan pihak lain)', 4),
(42, 'Menyebarkan ide intoleran', 4),
(43, 'Terduga masih keras karena pengaruh pimpinan', 5),
(44, 'Terduga patuh dengan pimpinan', 5),
(45, 'Terduga berpakaian sesuai kelompoknya', 5),
(46, 'Terduga menolak fasilitas negara', 5),
(47, 'Terduga kelompok takfiri', 5);

-- --------------------------------------------------------

--
-- Table structure for table `upt`
--

CREATE TABLE `upt` (
  `id_upt` int(11) NOT NULL,
  `id_kanwil` int(11) NOT NULL,
  `nama_upt` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upt`
--

INSERT INTO `upt` (`id_upt`, `id_kanwil`, `nama_upt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lapas I Cipinang', '2025-09-02 03:38:16', '2025-09-02'),
(2, 2, 'Lapas Kelas IIA Cibinong', '2025-09-02 03:39:36', '2025-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(36) NOT NULL,
  `id_kanwil` int(11) DEFAULT NULL,
  `id_upt` int(11) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super','admin','kanwil','upt') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_kanwil`, `id_upt`, `username`, `password`, `role`) VALUES
(1, NULL, NULL, 'pamintel', '202cb962ac59075b964b07152d234b70', 'admin'),
(14, 1, 1, 'cipinang', '202cb962ac59075b964b07152d234b70', 'upt'),
(15, 1, NULL, 'jakarta', '202cb962ac59075b964b07152d234b70', 'kanwil'),
(16, 2, 2, 'cibinong', '202cb962ac59075b964b07152d234b70', 'upt'),
(17, 2, NULL, 'jabar', '202cb962ac59075b964b07152d234b70', 'kanwil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antisipasi`
--
ALTER TABLE `antisipasi`
  ADD PRIMARY KEY (`id_antisipasi`);

--
-- Indexes for table `faktor`
--
ALTER TABLE `faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id_instrument`);

--
-- Indexes for table `kanwil`
--
ALTER TABLE `kanwil`
  ADD PRIMARY KEY (`id_kanwil`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `skrining`
--
ALTER TABLE `skrining`
  ADD PRIMARY KEY (`id_skrining`);

--
-- Indexes for table `upt`
--
ALTER TABLE `upt`
  ADD PRIMARY KEY (`id_upt`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antisipasi`
--
ALTER TABLE `antisipasi`
  MODIFY `id_antisipasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faktor`
--
ALTER TABLE `faktor`
  MODIFY `id_faktor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kanwil`
--
ALTER TABLE `kanwil`
  MODIFY `id_kanwil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skrining`
--
ALTER TABLE `skrining`
  MODIFY `id_skrining` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `upt`
--
ALTER TABLE `upt`
  MODIFY `id_upt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
