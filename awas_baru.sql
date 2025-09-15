-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               9.1.0 - MySQL Community Server - GPL
-- Server OS:                    Linux
-- HeidiSQL Version:             12.11.1.167
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table awas.tbl_antisipasi
CREATE TABLE IF NOT EXISTS `tbl_antisipasi` (
  `id_antisipasi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_antisipasi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `warna_antisipasi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_instrument` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_antisipasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_antisipasi: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_faktor
CREATE TABLE IF NOT EXISTS `tbl_faktor` (
  `id_faktor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `indikator_faktor` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_faktor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_instrument` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id_faktor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_faktor: ~14 rows (approximately)
INSERT INTO `tbl_faktor` (`id_faktor`, `indikator_faktor`, `jenis_faktor`, `id_instrument`, `created_at`) VALUES
	('16a8828f-7439-4ff6-9ec7-543c1cd420f1', 'Pegawai terlibat memfasilitasi kebutuhan teroris', 'Kerentanan', 'ed689f05-8d48-11f0-808b-54e1ad047dec', 2025),
	('16ce855e-6656-476b-b749-dda8b743897f', 'Tidak dipisah/ditempatkan terduga berpengaruh/bahaya', 'Kerentanan', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('2eda37dc-5a6c-4eb7-af5c-508e6f9e2ea1', 'Lapas/Rutan/LPKA terdapat idiolog  1 (satu) orang/lebih', 'Bahaya', 'ed689f05-8d48-11f0-808b-54e1ad047dec', 2025),
	('41a19ec1-c6e4-4b85-97ea-89cf3449b84e', 'Pegawai terlibat dalam peredaran dan pengendalian', 'Kerentanan', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('5ce2874b-f773-4ece-9f33-b8a6ec668d50', 'Lapas/Rutan/LPKA terdapat pengendali', 'Bahaya', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('7b1de438-7c64-42ac-8ba9-e13e7ec09976', 'Terdapat kelompok berpengaruh/berbahaya', 'Kerentanan', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('7dca2dd6-ac16-4709-891b-c11f7fbf27bf', 'Lapas/Rutan/LPKA terdapat pengedar', 'Bahaya', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('9788a308-aa7b-4558-8003-3cc722e3247d', 'Jumlah petugas tidak sebanding dengan hunian', 'Kerentanan', 'ed689f05-8d48-11f0-808b-54e1ad047dec', 2025),
	('984751c8-590b-49c7-a509-7fa8bcef2c1f', 'Lapas/Rutan/LPKA terdapat pengguna lebih dari 1 (satu) orang', 'Bahaya', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('a6375dc2-0dd8-4cd8-a617-d56f7c623bf1', 'Jumlah petugas tidak sebanding dengan hunian', 'Kerentanan', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025),
	('d91bd271-ef8a-46a6-afa6-ec8530cb76dc', 'Sarana CCTV dan monitor tidak tersedia dan merata', 'Kerentanan', 'ed689f05-8d48-11f0-808b-54e1ad047dec', 2025),
	('e76bd7c2-65c2-4ba6-8983-160c6497392d', 'Kelompok Teroris tidak dipisah/ditempatkan terpisah', 'Kerentanan', 'ed689f05-8d48-11f0-808b-54e1ad047dec', 2025),
	('ec4d2e58-efde-4065-82c3-bc84f46f50b6', 'Lapas/Rutan/LPKA terdapat pengikut 1 (satu) orang/lebih', 'Bahaya', 'ed689f05-8d48-11f0-808b-54e1ad047dec', 2025),
	('f6775b03-9f9a-468b-baa2-957f7702c80b', 'Sarana CCTV dan monitor tidak tersedia dan merata', 'Kerentanan', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', 2025);

-- Dumping structure for table awas.tbl_hasil
CREATE TABLE IF NOT EXISTS `tbl_hasil` (
  `id_hasil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_wbp` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_skrining` int NOT NULL,
  `nilai_bahaya` int NOT NULL,
  `nilai_kerentanan` int NOT NULL,
  `nilai_akhir` int NOT NULL,
  `id_antisipasi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_object` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_hasil: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_hasil_indikator
CREATE TABLE IF NOT EXISTS `tbl_hasil_indikator` (
  `id_hasil_indikator` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_hasil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_skrining` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_faktor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_hasil_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_hasil_indikator: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_instrument
CREATE TABLE IF NOT EXISTS `tbl_instrument` (
  `id_instrument` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_instrument` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_instrument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_instrument: ~2 rows (approximately)
INSERT INTO `tbl_instrument` (`id_instrument`, `nama_instrument`, `created_at`) VALUES
	('e0eba92c-8d48-11f0-808b-54e1ad047dec', 'Narkotika', '2025-09-09 06:47:39'),
	('ed689f05-8d48-11f0-808b-54e1ad047dec', 'Teroris', '2025-09-09 06:48:00');

-- Dumping structure for table awas.tbl_kanwil
CREATE TABLE IF NOT EXISTS `tbl_kanwil` (
  `id_kanwil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_kanwil` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kanwil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_kanwil: ~5 rows (approximately)
INSERT INTO `tbl_kanwil` (`id_kanwil`, `nama_kanwil`, `created_at`) VALUES
	('49985e4d-8d2f-11f0-808b-54e1ad047dec', 'DK Jakarta', '2025-09-09 03:44:28'),
	('9d1d2034-8d2f-11f0-808b-54e1ad047dec', 'Jawa Barat', '2025-09-09 03:46:48'),
	('c2051828-8d2f-11f0-808b-54e1ad047dec', 'Sumatera Selatan', '2025-09-09 03:47:50'),
	('dc2a9099-8d2f-11f0-808b-54e1ad047dec', 'Maluku', '2025-09-09 03:48:34'),
	('e6b55220-8d2f-11f0-808b-54e1ad047dec', 'Aceh', '2025-09-09 03:48:52');

-- Dumping structure for table awas.tbl_narapidana
CREATE TABLE IF NOT EXISTS `tbl_narapidana` (
  `no_register` CHAR(20) NOT NULL,
  `nama_narapidana` VARCHAR(250) DEFAULT NULL,
  `perkara` VARCHAR(250) DEFAULT NULL,
  `lama_pidana` VARCHAR(250) DEFAULT NULL,
  `alamat` TEXT,
  PRIMARY KEY (`no_register`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_narapidana: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_notifikasi
CREATE TABLE IF NOT EXISTS `tbl_notifikasi` (
  `id_notifikasi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_hasil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_notifikasi` enum('id_skrining_kosong','id_faktor_kosong') COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('baru','dibaca','ditindaklanjuti') COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_notifikasi: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_pegawai
CREATE TABLE IF NOT EXISTS `tbl_pegawai` (
  `nip` CHAR(20) NOT NULL,
  `nama_pegawai` VARCHAR(250) DEFAULT NULL,
  `golongan` CHAR(20) DEFAULT NULL,
  `pangkat` VARCHAR(250) DEFAULT NULL,
  `jabatan` VARCHAR(250) DEFAULT NULL,
  `id_upt` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_pegawai: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_penggeledahan
CREATE TABLE IF NOT EXISTS `tbl_penggeledahan` (
  `id_penggeledahan` varchar(100) NOT NULL,
  `jumlah_penggeledahan` int DEFAULT NULL,
  `lokasi_penggeledahan` varchar(250) DEFAULT NULL,
  `target` varchar(250) DEFAULT NULL,
  `temuan` int DEFAULT NULL,
  PRIMARY KEY (`id_penggeledahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_penggeledahan: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_pustaka
CREATE TABLE IF NOT EXISTS `tbl_pustaka` (
  `id_pustaka` varchar(100) NOT NULL,
  `nama_file` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_pustaka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_pustaka: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_skrining
CREATE TABLE IF NOT EXISTS `tbl_skrining` (
  `id_skrining` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `indikator_skrining` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_skrining` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_instrument` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_skrining`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_skrining: ~47 rows (approximately)
INSERT INTO `tbl_skrining` (`id_skrining`, `indikator_skrining`, `jenis_skrining`, `id_instrument`, `created_at`) VALUES
	('000003eb-22eb-4fb3-8d77-4f854c0b82bc', 'Menerapkan struktur perintah puncak', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 03:22:49'),
	('0d6a2693-2d88-4eb8-a323-9178c2c6e3da', 'Terduga terlihat suka menyendiri', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:59'),
	('14800371-6ecb-46ef-9f60-aa81493131ff', 'Terduga patuh dengan pimpinan', 'Pengikut', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:31'),
	('1882a39a-bb3e-43e5-ae61-42df7d6c6f7b', 'Terduga memiliki pembantu', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:14:45'),
	('1900d304-a2bb-44a9-a2a7-802a3843f8f0', 'Tidak banyak bicara', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:16:09'),
	('19991893-f060-4253-8adf-ba6293b9b41f', 'Terduga memiliki jaringan', 'Ideolog', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:00'),
	('1aa7b289-f7de-4336-9be4-8762c4d0a5ed', 'Berpakaian sederhana', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:16:15'),
	('1bc6f687-ebb5-4838-b601-54a9b7d39333', 'Eksploitasi perempuan sebagai kurir', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:17:46'),
	('21f8c858-e61b-4e5b-9809-252a1d33696c', 'Komunikasi tersembunyi', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:16:19'),
	('2859e0b5-4f8d-4912-9e62-51a2f993c607', 'Terduga masih keras karena pengaruh pimpinan', 'Pengikut', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:25'),
	('2c4517d0-fc22-4224-af5b-d06b1584c6d6', 'Terduga berpenghasilan tanpa bekerja', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:05'),
	('2cb6d67a-766f-45be-a78e-1bd44e6711ea', 'Terduga menghabiskan uang banyak', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:14:06'),
	('2e40c083-6ff0-4428-9171-8929077375cc', 'Terduga berpakaian sesuai kelompoknya', 'Pengikut', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:38'),
	('314d591c-455e-4df0-a3a2-e32161dbe8a1', 'Terduga terlihat selalu lelah', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:12:16'),
	('3576bd83-d32b-47da-ab1d-9c374be4a0d1', 'Paham takfiri (mengkafirkan pihak lain)', 'Ideolog', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:05'),
	('362d8be0-0639-4abc-bb33-896aba729178', 'Terduga sering membahayakan diri dan orang lain', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:46:17'),
	('44df33b5-3ac3-4b20-b8a0-285755ee8a1f', 'Mempengaruhi', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:16:51'),
	('4b7a8dc0-cb3d-4a02-bce3-45a26be5c562', 'Terduga mengalami perubahan kepribadian', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:39'),
	('558fe4fa-4614-4a30-a32e-47b272fac129', 'Terduga memiliki pengikut di dalam', 'Ideolog', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:18:01'),
	('6f8090b7-e69c-4d3a-b4c4-026b1f4f650a', 'Terduga menolak fasilitas negara', 'Pengikut', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:46'),
	('7405602f-4d48-4dc7-a07a-08978dac2503', 'Terduga mengalami depresi', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:53'),
	('745270d6-01aa-40f2-93cb-5a0042b855fe', 'Berpura-pura miskin', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:16:41'),
	('751fba6b-c5e4-42a9-88a6-791bc5a6daab', 'Terduga menyedot idung terus menerus', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:12:51'),
	('76945e28-f121-4506-9103-ef45a1caf54d', 'Terduga memiliki hp', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:27'),
	('7976f42d-25ec-4c44-a008-38bc219b308f', 'Terduga kelompok takfiri', 'Pengikut', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:10:41'),
	('7dd8dd11-54c9-41ae-8e4f-d0bbbc0dcfe0', 'Komunikasi menggunakan sandi', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:17:20'),
	('838f844c-baa2-4973-b71a-c8268ff4f31e', 'Terhubung dengan pihak luar selain dari narapidana', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:17:33'),
	('8721af22-7a61-45ab-9682-3e74fd7bbd4d', 'Terduga memiliki posisi penting di jaringan', 'Ideolog', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:19:12'),
	('890cd0fe-71ba-4d63-aceb-ec28e4af0287', 'Sering dikunjungi orang yang berbeda', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:17:27'),
	('926d20fc-fba6-4953-99d3-43cd04267222', 'Terduga selalu "royal"', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:21'),
	('9349e2c1-ed0e-41ba-91af-b3d915ebdd36', 'Terduga mengalami radang paru-paru', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:28'),
	('a18966f3-609e-453b-bbca-a77a8fdc458c', 'Terduga berpenampilan kotor', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:14:11'),
	('a73f0669-7bbb-4f18-9890-a9da9f75903b', 'Terduga mengalami mata merah', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:09:42'),
	('b0331018-05d7-45c3-9975-d39deb7ddf58', 'Terduga sering flu', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:22'),
	('b0a76bb2-7cbf-41f4-b965-3a35d4c43d2b', 'Terduga menyebarkan informasi melalui berbagai media', 'Ideolog', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:18:52'),
	('c4ce7ee9-401a-4c7e-b2f4-5abb14f5ed4d', 'Terduga mengalami penurunan berat badan', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:12:25'),
	('c5a4aab8-9bd2-4c48-b092-e355f1cf5acb', 'Terduga sering mendapatkan kiriman barang', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:45'),
	('c8a243d3-8cf6-40fb-9bdf-ab7a81fc390d', 'Terduga sering dikunjungi oleh orang yang berbeda', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:38'),
	('d4ec3816-94cd-4e5c-9ad0-fdb1cb23945d', 'Terduga emosional', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:46'),
	('deee553e-8158-4027-9778-3c224a273623', 'Terduga sering mengalami infeksi bakteri', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:13:33'),
	('df20c8df-5731-4b44-9428-34b79134e7a5', 'Terduga menjadi pusat pergaulan', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:14:40'),
	('e0d9eafe-6f74-470b-a576-3437d51aec79', 'Terduga memiliki  lebih dari satu hp', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:33'),
	('eadcd755-cf80-4727-9572-cd11d90bff6e', 'Terduga terlihat kulit pucat', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:12:32'),
	('ed1e1e4b-4ea0-4f18-a6df-d4f25483e2bc', 'Sangat santun', 'Pengendali', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:16:04'),
	('f1bb55d1-e80b-45f2-b087-7c807556ccc5', 'Terduga sering melanggar tata tertib', 'Pengguna', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:14:35'),
	('f4869fe6-4a78-4d0e-b753-b5f7ab4fec87', 'Terduga memiliki pengaruh di lingkungan', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:15'),
	('f7b835a1-d3cf-4a31-943f-3fb18e043e62', 'Terduga masih sangat keras', 'Ideolog', 'ed689f05-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:17:55');

-- Dumping structure for table awas.tbl_sop
CREATE TABLE IF NOT EXISTS `tbl_sop` (
  `id_sop` varchar(100) NOT NULL,
  `nama_file` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_sop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_sop: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_test_urin
CREATE TABLE IF NOT EXISTS `tbl_test_urin` (
  `id_test_urin` varchar(100) NOT NULL,
  `jumlah_sampel_wbp` int DEFAULT NULL,
  `jumlah_sampel_pegawai` int DEFAULT NULL,
  `positif_narkoba` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_test_urin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_test_urin: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_upload
CREATE TABLE IF NOT EXISTS `tbl_upload` (
  `id_upload` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_hasil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_upload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_upload: ~0 rows (approximately)

-- Dumping structure for table awas.tbl_upt
CREATE TABLE IF NOT EXISTS `tbl_upt` (
  `id_upt` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_upt` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_kanwil` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_upt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_upt: ~2 rows (approximately)
INSERT INTO `tbl_upt` (`id_upt`, `nama_upt`, `id_kanwil`, `created_at`) VALUES
	('0e74ad4a-8d30-11f0-808b-54e1ad047dec', 'Lapas Jakarta 1', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '2025-09-09 03:49:58'),
	('30112907-8d30-11f0-808b-54e1ad047dec', 'Lapas Jakarta 2', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '2025-09-09 03:50:55');

-- Dumping structure for table awas.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_kanwil` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_upt` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('super','admin','kanwil','upt') COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('aktif','tidak aktif') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table awas.tbl_user: ~4 rows (approximately)
INSERT INTO `tbl_user` (`id_user`, `id_kanwil`, `id_upt`, `username`, `password`, `role`, `status`, `created_at`) VALUES
	('4bfdd547-9184-44dc-8fca-bd2397bab8ef', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '0e74ad4a-8d30-11f0-808b-54e1ad047dec', 'jakarta1', '202cb962ac59075b964b07152d234b70', 'upt', 'aktif', '2025-09-09 01:42:16'),
	('6b10aac2-8d30-11f0-808b-54e1ad047dec', NULL, NULL, 'pamintel', '202cb962ac59075b964b07152d234b70', 'admin', 'aktif', '2025-09-09 03:52:34'),
	('89baa26c-8d30-11f0-808b-54e1ad047dec', '49985e4d-8d2f-11f0-808b-54e1ad047dec', NULL, 'jakarta', '202cb962ac59075b964b07152d234b70', 'kanwil', 'aktif', '2025-09-09 03:53:25'),
	('b5fd68e3-cddf-41e0-ab5b-72bbb37d2971', '9d1d2034-8d2f-11f0-808b-54e1ad047dec', NULL, 'jabar', '202cb962ac59075b964b07152d234b70', 'kanwil', 'aktif', '2025-09-09 01:41:35');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
