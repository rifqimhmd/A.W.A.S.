-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 02:29 AM
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
(1, 'Dega', 7, 1, 100, 100, 100, 100, 2, '2025-09-04 08:30:50'),
(2, 'Raka', 8, 1, 80, 80, 70, 90, 2, '2025-09-04 08:37:56'),
(3, 'Sita', 9, 5, 50, 60, 40, 50, 4, '2025-09-04 08:37:56'),
(4, 'Tono', 10, 3, 37, 30, 30, 50, 1, '2025-09-04 08:37:56'),
(5, 'Maya', 11, 4, 90, 90, 95, 85, 5, '2025-09-04 08:37:56'),
(6, 'Raka', 7, 1, 85, 80, 90, 85, 2, '2025-09-04 08:41:47'),
(7, 'Sita', 8, 5, 55, 60, 50, 55, 4, '2025-09-04 08:41:47'),
(8, 'Tono', 9, 2, 45, 45, 40, 50, 3, '2025-09-04 08:41:47'),
(9, 'Maya', 10, 4, 75, 75, 80, 70, 5, '2025-09-04 08:41:47'),
(10, 'Deni', 11, 3, 35, 35, 30, 40, 1, '2025-09-04 08:41:47'),
(11, 'Raka', 7, 1, 85, 80, 90, 85, 2, '2025-09-04 08:42:41'),
(12, 'Sita', 8, 5, 55, 60, 50, 55, 4, '2025-09-04 08:42:41'),
(13, 'Tono', 9, 2, 45, 45, 40, 50, 3, '2025-09-04 08:42:41'),
(14, 'Maya', 10, 4, 75, 75, 80, 70, 5, '2025-09-04 08:42:41'),
(15, 'Deni', 11, 3, 35, 35, 30, 40, 1, '2025-09-04 08:42:41'),
(16, 'Rini', 7, 1, 90, 90, 95, 85, 2, '2025-09-04 08:42:41'),
(17, 'Agus', 8, 5, 55, 55, 60, 50, 4, '2025-09-04 08:42:41'),
(18, 'Budi', 9, 2, 40, 40, 45, 35, 3, '2025-09-04 08:42:41'),
(19, 'Citra', 10, 4, 75, 80, 75, 70, 5, '2025-09-04 08:42:41'),
(20, 'Eko', 11, 3, 35, 30, 35, 40, 1, '2025-09-04 08:42:41'),
(21, 'Fajar', 7, 1, 85, 85, 80, 90, 2, '2025-09-04 08:42:41'),
(22, 'Gita', 8, 5, 55, 60, 55, 50, 4, '2025-09-04 08:42:41'),
(23, 'Hadi', 9, 2, 45, 45, 50, 40, 3, '2025-09-04 08:42:41'),
(24, 'Indah', 10, 4, 75, 75, 70, 80, 5, '2025-09-04 08:42:41'),
(25, 'Joko', 11, 3, 35, 35, 40, 30, 1, '2025-09-04 08:42:41'),
(26, 'Aldi', 12, 1, 85, 85, 80, 90, 2, '2025-09-04 08:47:22'),
(27, 'Bella', 13, 5, 55, 60, 55, 50, 4, '2025-09-04 08:47:22'),
(28, 'Candra', 14, 2, 45, 45, 50, 40, 3, '2025-09-04 08:47:22'),
(29, 'Dina', 15, 4, 75, 75, 80, 70, 5, '2025-09-04 08:47:22'),
(30, 'Evan', 16, 3, 35, 35, 40, 30, 1, '2025-09-04 08:47:22'),
(31, 'Fani', 12, 1, 90, 90, 85, 95, 2, '2025-09-04 08:47:22'),
(32, 'Gilang', 13, 5, 55, 55, 60, 50, 4, '2025-09-04 08:47:22'),
(33, 'Hana', 14, 2, 40, 40, 45, 35, 3, '2025-09-04 08:47:22'),
(34, 'Indra', 15, 4, 75, 80, 75, 70, 5, '2025-09-04 08:47:22'),
(35, 'Jihan', 16, 3, 35, 30, 35, 40, 1, '2025-09-04 08:47:22'),
(36, 'Kevin', 12, 1, 85, 85, 90, 80, 2, '2025-09-04 08:47:22'),
(37, 'Lina', 13, 5, 55, 60, 50, 55, 4, '2025-09-04 08:47:22'),
(38, 'Miko', 14, 2, 45, 45, 40, 50, 3, '2025-09-04 08:47:22'),
(39, 'Nina', 15, 4, 75, 75, 70, 80, 5, '2025-09-04 08:47:22'),
(40, 'Oscar', 16, 3, 35, 35, 30, 40, 1, '2025-09-04 08:47:22'),
(41, 'Putu', 12, 1, 90, 90, 95, 85, 2, '2025-09-04 08:47:22'),
(42, 'Qiana', 13, 5, 55, 55, 50, 60, 4, '2025-09-04 08:47:22'),
(43, 'Rudi', 14, 2, 40, 40, 35, 45, 3, '2025-09-04 08:47:22'),
(44, 'Sari', 15, 4, 80, 80, 85, 75, 5, '2025-09-04 08:47:22'),
(45, 'Tari', 16, 3, 35, 30, 40, 35, 1, '2025-09-04 08:47:22'),
(46, 'Udin', 12, 1, 85, 85, 80, 90, 2, '2025-09-04 08:47:22'),
(47, 'Vina', 13, 5, 55, 60, 55, 50, 4, '2025-09-04 08:47:22'),
(48, 'Wawan', 14, 2, 45, 45, 50, 40, 3, '2025-09-04 08:47:22'),
(49, 'Xena', 15, 4, 75, 75, 80, 70, 5, '2025-09-04 08:47:22'),
(50, 'Yoga', 16, 3, 35, 35, 40, 30, 1, '2025-09-04 08:47:22'),
(51, 'Aditya', 17, 1, 85, 85, 90, 80, 2, '2025-09-04 08:49:23'),
(52, 'Bunga', 18, 5, 55, 60, 55, 50, 4, '2025-09-04 08:49:23'),
(53, 'Cahya', 19, 2, 45, 45, 40, 50, 3, '2025-09-04 08:49:23'),
(54, 'Dewa', 20, 4, 75, 75, 80, 70, 5, '2025-09-04 08:49:23'),
(55, 'Eka', 21, 3, 35, 35, 30, 40, 1, '2025-09-04 08:49:23'),
(56, 'Fadli', 17, 1, 90, 90, 85, 95, 2, '2025-09-04 08:49:23'),
(57, 'Gita', 18, 5, 55, 55, 60, 50, 4, '2025-09-04 08:49:23'),
(58, 'Hadi', 19, 2, 40, 40, 45, 35, 3, '2025-09-04 08:49:23'),
(59, 'Intan', 20, 4, 75, 80, 75, 70, 5, '2025-09-04 08:49:23'),
(60, 'Joko', 21, 3, 35, 30, 35, 40, 1, '2025-09-04 08:49:23'),
(61, 'Kiki', 17, 1, 85, 85, 80, 90, 2, '2025-09-04 08:49:23'),
(62, 'Lani', 18, 5, 55, 60, 50, 55, 4, '2025-09-04 08:49:23'),
(63, 'Mira', 19, 2, 45, 45, 40, 50, 3, '2025-09-04 08:49:23'),
(64, 'Niko', 20, 4, 75, 75, 70, 80, 5, '2025-09-04 08:49:23'),
(65, 'Oka', 21, 3, 35, 35, 30, 40, 1, '2025-09-04 08:49:23'),
(66, 'Putra', 17, 1, 90, 90, 95, 85, 2, '2025-09-04 08:49:23'),
(67, 'Qori', 18, 5, 55, 55, 50, 60, 4, '2025-09-04 08:49:23'),
(68, 'Rizki', 19, 2, 40, 40, 35, 45, 3, '2025-09-04 08:49:23'),
(69, 'Santi', 20, 4, 80, 80, 85, 75, 5, '2025-09-04 08:49:23'),
(70, 'Tomi', 21, 3, 35, 30, 40, 35, 1, '2025-09-04 08:49:23'),
(71, 'Umar', 17, 1, 85, 85, 80, 90, 2, '2025-09-04 08:49:23'),
(72, 'Vita', 18, 5, 55, 60, 55, 50, 4, '2025-09-04 08:49:23'),
(73, 'Wulan', 19, 2, 45, 45, 50, 40, 3, '2025-09-04 08:49:23'),
(74, 'Xavier', 20, 4, 75, 75, 80, 70, 5, '2025-09-04 08:49:23'),
(75, 'Yudi', 21, 3, 35, 35, 40, 30, 1, '2025-09-04 08:49:23'),
(76, 'Adel', 22, 1, 85, 85, 80, 90, 2, '2025-09-04 08:50:20'),
(77, 'Bima', 23, 5, 55, 60, 55, 50, 4, '2025-09-04 08:50:20'),
(78, 'Citra', 24, 2, 45, 45, 40, 50, 3, '2025-09-04 08:50:20'),
(79, 'Deni', 25, 4, 75, 75, 80, 70, 5, '2025-09-04 08:50:20'),
(80, 'Eka', 26, 3, 35, 35, 30, 40, 1, '2025-09-04 08:50:20'),
(81, 'Fani', 22, 1, 90, 90, 85, 95, 2, '2025-09-04 08:50:20'),
(82, 'Gilang', 23, 5, 55, 55, 60, 50, 4, '2025-09-04 08:50:20'),
(83, 'Hana', 24, 2, 40, 40, 45, 35, 3, '2025-09-04 08:50:20'),
(84, 'Indra', 25, 4, 75, 80, 75, 70, 5, '2025-09-04 08:50:20'),
(85, 'Joko', 26, 3, 35, 30, 35, 40, 1, '2025-09-04 08:50:20'),
(86, 'Kevin', 22, 1, 85, 85, 90, 80, 2, '2025-09-04 08:50:20'),
(87, 'Lani', 23, 5, 55, 60, 50, 55, 4, '2025-09-04 08:50:20'),
(88, 'Mira', 24, 2, 45, 45, 40, 50, 3, '2025-09-04 08:50:20'),
(89, 'Niko', 25, 4, 75, 75, 70, 80, 5, '2025-09-04 08:50:20'),
(90, 'Oka', 26, 3, 35, 35, 30, 40, 1, '2025-09-04 08:50:20'),
(91, 'Putra', 22, 1, 90, 90, 95, 85, 2, '2025-09-04 08:50:20'),
(92, 'Qori', 23, 5, 55, 55, 50, 60, 4, '2025-09-04 08:50:20'),
(93, 'Rizki', 24, 2, 40, 40, 35, 45, 3, '2025-09-04 08:50:20'),
(94, 'Santi', 25, 4, 80, 80, 85, 75, 5, '2025-09-04 08:50:20'),
(95, 'Tomi', 26, 3, 35, 30, 40, 35, 1, '2025-09-04 08:50:20'),
(96, 'Umar', 22, 1, 85, 85, 80, 90, 2, '2025-09-04 08:50:20'),
(97, 'Vita', 23, 5, 55, 60, 55, 50, 4, '2025-09-04 08:50:20'),
(98, 'Wawan', 24, 2, 45, 45, 50, 40, 3, '2025-09-04 08:50:20'),
(99, 'Xena', 25, 4, 75, 75, 80, 70, 5, '2025-09-04 08:50:20'),
(100, 'Yoga', 26, 3, 35, 35, 40, 30, 1, '2025-09-04 08:50:20'),
(101, 'Agus', 27, 1, 85, 85, 80, 90, 2, '2025-09-04 08:51:04'),
(102, 'Bima', 28, 5, 55, 60, 55, 50, 4, '2025-09-04 08:51:04'),
(103, 'Citra', 29, 2, 45, 45, 40, 50, 3, '2025-09-04 08:51:04'),
(104, 'Deni', 30, 4, 75, 75, 80, 70, 5, '2025-09-04 08:51:04'),
(105, 'Eka', 31, 3, 35, 35, 30, 40, 1, '2025-09-04 08:51:04'),
(106, 'Fani', 27, 1, 90, 90, 85, 95, 2, '2025-09-04 08:51:04'),
(107, 'Gilang', 28, 5, 55, 55, 60, 50, 4, '2025-09-04 08:51:04'),
(108, 'Hana', 29, 2, 40, 40, 45, 35, 3, '2025-09-04 08:51:04'),
(109, 'Indra', 30, 4, 75, 80, 75, 70, 5, '2025-09-04 08:51:04'),
(110, 'Joko', 31, 3, 35, 30, 35, 40, 1, '2025-09-04 08:51:04'),
(111, 'Kevin', 27, 1, 85, 85, 90, 80, 2, '2025-09-04 08:51:04'),
(112, 'Lani', 28, 5, 55, 60, 50, 55, 4, '2025-09-04 08:51:04'),
(113, 'Mira', 29, 2, 45, 45, 40, 50, 3, '2025-09-04 08:51:04'),
(114, 'Niko', 30, 4, 75, 75, 70, 80, 5, '2025-09-04 08:51:04'),
(115, 'Oka', 31, 3, 35, 35, 30, 40, 1, '2025-09-04 08:51:04'),
(116, 'Putra', 27, 1, 90, 90, 95, 85, 2, '2025-09-04 08:51:04'),
(117, 'Qori', 28, 5, 55, 55, 50, 60, 4, '2025-09-04 08:51:04'),
(118, 'Rizki', 29, 2, 40, 40, 35, 45, 3, '2025-09-04 08:51:04'),
(119, 'Santi', 30, 4, 80, 80, 85, 75, 5, '2025-09-04 08:51:04'),
(120, 'Tomi', 31, 3, 35, 30, 40, 35, 1, '2025-09-04 08:51:04'),
(121, 'Umar', 27, 1, 85, 85, 80, 90, 2, '2025-09-04 08:51:04'),
(122, 'Vita', 28, 5, 55, 60, 55, 50, 4, '2025-09-04 08:51:04'),
(123, 'Wawan', 29, 2, 45, 45, 50, 40, 3, '2025-09-04 08:51:04'),
(124, 'Xena', 30, 4, 75, 75, 80, 70, 5, '2025-09-04 08:51:04'),
(125, 'Roy', 31, 3, 35, 35, 40, 30, 1, '2025-09-04 08:51:04'),
(126, 'Silvan', 17, 6, 33, 100, 0, 0, 5, '2025-09-04 04:28:45'),
(127, 'Guiness', 12, 4, 92, 100, 100, 75, 5, '2025-09-04 04:29:51'),
(128, 'Rahman', 23, 5, 53, 60, 50, 50, 5, '2025-09-04 04:31:20');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kanwil`
--

INSERT INTO `kanwil` (`id_kanwil`, `nama_kanwil`, `created_at`) VALUES
(1, 'DK Jakarta', '2025-09-02 03:36:55'),
(2, 'Jawa Barat', '2025-09-02 03:37:00'),
(3, 'Sumatera Selatan', '2025-09-04 07:53:08'),
(4, 'Maluku', '2025-09-04 07:53:15'),
(5, 'Aceh', '2025-09-04 07:52:52');

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
(17, 'Terduga menjadi pusat pergaulan', 2),
(18, 'Terduga memiliki pembantu', 2),
(19, 'Terduga berpenghasilan tanpa bekerja', 2),
(20, 'Terduga memiliki pengaruh di lingkungan', 2),
(21, 'Terduga selalu \"royal\"', 2),
(22, 'Terduga memiliki hp', 2),
(23, 'Terduga memiliki  lebih dari satu hp', 2),
(24, 'Terduga sering dikunjungi oleh orang yang berbeda', 2),
(25, 'Terduga sering mendapatkan kiriman barang', 2),
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
(37, 'Terduga masih sangat keras', 4),
(38, 'Terduga memiliki pengikut di dalam', 4),
(39, 'Terduga menyebarkan informasi melalui berbagai media', 4),
(40, 'Terduga memiliki jaringan', 4),
(41, 'Paham takfiri (mengkafirkan pihak lain)', 4),
(42, 'Terduga memiliki posisi penting di jaringan', 4),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upt`
--

INSERT INTO `upt` (`id_upt`, `id_kanwil`, `nama_upt`, `created_at`) VALUES
(1, 1, 'Lapas Jakarta 1', '2025-09-04 07:59:21'),
(2, 1, 'Lapas Jakarta 2', '2025-09-04 07:59:21'),
(3, 1, 'Lapas Jakarta 3', '2025-09-04 07:59:21'),
(4, 1, 'Lapas Jakarta 4', '2025-09-04 07:59:21'),
(5, 1, 'Lapas Jakarta 5', '2025-09-04 07:59:21'),
(6, 2, 'Lapas Jawa Barat 1', '2025-09-04 08:00:24'),
(7, 2, 'Lapas Jawa Barat 2', '2025-09-04 08:00:24'),
(8, 2, 'Lapas Jawa Barat 3', '2025-09-04 08:00:24'),
(9, 2, 'Lapas Jawa Barat 4', '2025-09-04 08:00:24'),
(10, 2, 'Lapas Jawa Barat 5', '2025-09-04 08:00:24'),
(11, 3, 'Lapas Sumatera Selatan 1', '2025-09-04 08:01:19'),
(12, 3, 'Lapas Sumatera Selatan 2', '2025-09-04 08:01:19'),
(13, 3, 'Lapas Sumatera Selatan 3', '2025-09-04 08:01:19'),
(14, 3, 'Lapas Sumatera Selatan 4', '2025-09-04 08:01:19'),
(15, 3, 'Lapas Sumatera Selatan 5', '2025-09-04 08:01:19'),
(16, 4, 'Lapas Maluku 1', '2025-09-04 08:01:42'),
(17, 4, 'Lapas Maluku 2', '2025-09-04 08:01:42'),
(18, 4, 'Lapas Maluku 3', '2025-09-04 08:01:42'),
(19, 4, 'Lapas Maluku 4', '2025-09-04 08:01:42'),
(20, 4, 'Lapas Maluku 5', '2025-09-04 08:01:42'),
(21, 5, 'Lapas Aceh 1', '2025-09-04 08:02:46'),
(22, 5, 'Lapas Aceh 2', '2025-09-04 08:02:46'),
(23, 5, 'Lapas Aceh 3', '2025-09-04 08:02:46'),
(24, 5, 'Lapas Aceh 4', '2025-09-04 08:02:46'),
(25, 5, 'Lapas Aceh 5', '2025-09-04 08:02:46');

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
(2, 1, NULL, 'jakarta', '202cb962ac59075b964b07152d234b70', 'kanwil'),
(3, 2, NULL, 'jawabarat', '202cb962ac59075b964b07152d234b70', 'kanwil'),
(4, 3, NULL, 'sumsel', '202cb962ac59075b964b07152d234b70', 'kanwil'),
(5, 4, NULL, 'maluku', '202cb962ac59075b964b07152d234b70', 'kanwil'),
(6, 5, NULL, 'aceh', '202cb962ac59075b964b07152d234b70', 'kanwil'),
(7, 1, 1, 'jakarta1', '202cb962ac59075b964b07152d234b70', 'upt'),
(8, 1, 2, 'jakarta2', '202cb962ac59075b964b07152d234b70', 'upt'),
(9, 1, 3, 'jakarta3', '202cb962ac59075b964b07152d234b70', 'upt'),
(10, 1, 4, 'jakarta4', '202cb962ac59075b964b07152d234b70', 'upt'),
(11, 1, 5, 'jakarta5', '202cb962ac59075b964b07152d234b70', 'upt'),
(12, 2, 6, 'jabar1', '202cb962ac59075b964b07152d234b70', 'upt'),
(13, 2, 7, 'jabar2', '202cb962ac59075b964b07152d234b70', 'upt'),
(14, 2, 8, 'jabar3', '202cb962ac59075b964b07152d234b70', 'upt'),
(15, 2, 9, 'jabar4', '202cb962ac59075b964b07152d234b70', 'upt'),
(16, 2, 10, 'jabar5', '202cb962ac59075b964b07152d234b70', 'upt'),
(17, 3, 11, 'sumsel1', '202cb962ac59075b964b07152d234b70', 'upt'),
(18, 3, 12, 'sumsel2', '202cb962ac59075b964b07152d234b70', 'upt'),
(19, 3, 13, 'sumsel3', '202cb962ac59075b964b07152d234b70', 'upt'),
(20, 3, 14, 'sumsel4', '202cb962ac59075b964b07152d234b70', 'upt'),
(21, 3, 15, 'sumsel5', '202cb962ac59075b964b07152d234b70', 'upt'),
(22, 4, 16, 'maluku1', '202cb962ac59075b964b07152d234b70', 'upt'),
(23, 4, 17, 'maluku2', '202cb962ac59075b964b07152d234b70', 'upt'),
(24, 4, 18, 'maluku3', '202cb962ac59075b964b07152d234b70', 'upt'),
(25, 4, 19, 'maluku4', '202cb962ac59075b964b07152d234b70', 'upt'),
(26, 4, 20, 'maluku5', '202cb962ac59075b964b07152d234b70', 'upt'),
(27, 5, 21, 'aceh1', '202cb962ac59075b964b07152d234b70', 'upt'),
(28, 5, 22, 'aceh2', '202cb962ac59075b964b07152d234b70', 'upt'),
(29, 5, 23, 'aceh3', '202cb962ac59075b964b07152d234b70', 'upt'),
(30, 5, 24, 'aceh4', '202cb962ac59075b964b07152d234b70', 'upt'),
(31, 5, 25, 'aceh5', '202cb962ac59075b964b07152d234b70', 'upt');

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
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `kanwil`
--
ALTER TABLE `kanwil`
  MODIFY `id_kanwil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_upt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
