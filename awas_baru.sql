-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql109.infinityfree.com
-- Generation Time: Sep 24, 2025 at 06:45 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39852325_awas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antisipasi`
--

CREATE TABLE `tbl_antisipasi` (
  `id_antisipasi` int(11) NOT NULL,
  `nama_antisipasi` varchar(255) NOT NULL,
  `warna_antisipasi` varchar(100) NOT NULL,
  `id_instrument` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_antisipasi`
--

INSERT INTO `tbl_antisipasi` (`id_antisipasi`, `nama_antisipasi`, `warna_antisipasi`, `id_instrument`) VALUES
(1, 'Berpotensi terjadi peredaran, dan pengendalian	', 'Merah', 'e0eba92c-8d48-11f0-808b-54e1ad047dec'),
(2, 'Berpotensi terjadi penyelundupan', 'Kuning', 'e0eba92c-8d48-11f0-808b-54e1ad047dec'),
(3, 'Tidak berpotensi terjadi penyelundupan', 'Hijau', 'e0eba92c-8d48-11f0-808b-54e1ad047dec'),
(4, 'Telah terjadi penyebaran faham', 'Merah', 'ed689f05-8d48-11f0-808b-54e1ad047dec'),
(5, 'Berpotensi terjadi penyebaran faham', 'Kuning', 'ed689f05-8d48-11f0-808b-54e1ad047dec'),
(6, 'Tidak terjadi penyebaran faham ', 'Hijau', 'ed689f05-8d48-11f0-808b-54e1ad047dec');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faktor`
--

CREATE TABLE `tbl_faktor` (
  `id_faktor` varchar(100) NOT NULL,
  `indikator_faktor` varchar(255) NOT NULL,
  `jenis_faktor` varchar(100) NOT NULL,
  `id_instrument` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faktor`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `nilai_skrining` int(11) NOT NULL,
  `nilai_bahaya` int(11) NOT NULL,
  `nilai_kerentanan` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL,
  `id_antisipasi` varchar(100) NOT NULL,
  `id_object` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_user`, `nilai_skrining`, `nilai_bahaya`, `nilai_kerentanan`, `nilai_akhir`, `id_antisipasi`, `id_object`, `created_at`) VALUES
('20f2c636-1e25-42f1-a18f-62330cb4954e', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 100, 50, 100, 83, '4', '111112222', '2025-09-24 11:01:27'),
('48e05c32-da98-4ce0-8878-6ad1198f0a0a', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 63, 100, 100, 88, '1', '123', '2025-09-24 10:57:09'),
('ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 89, 100, 100, 96, '1', '3333', '2025-09-24 10:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil_indikator`
--

CREATE TABLE `tbl_hasil_indikator` (
  `id_hasil_indikator` varchar(100) NOT NULL,
  `id_hasil` varchar(100) NOT NULL,
  `id_skrining` varchar(100) NOT NULL,
  `id_faktor` varchar(100) NOT NULL,
  `jawaban` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hasil_indikator`
--

INSERT INTO `tbl_hasil_indikator` (`id_hasil_indikator`, `id_hasil`, `id_skrining`, `id_faktor`, `jawaban`) VALUES
('09519222-dd5f-405b-990a-e13417ca2d06', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '9349e2c1-ed0e-41ba-91af-b3d915ebdd36', '', 1),
('0e706baf-83a9-4726-8475-4fcb7eaa5094', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', 'e0d9eafe-6f74-470b-a576-3437d51aec79', '', 1),
('0ecb99ac-c68d-4db2-8cd8-9ea1ee9c379d', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', 'f4869fe6-4a78-4d0e-b753-b5f7ab4fec87', '', 1),
('13eddefd-59e1-48dd-8fb9-ad3813516122', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '7405602f-4d48-4dc7-a07a-08978dac2503', '', 1),
('169e0afb-c6b8-40ed-af99-2a91b9476a08', '20f2c636-1e25-42f1-a18f-62330cb4954e', '7976f42d-25ec-4c44-a008-38bc219b308f', '', 1),
('1d4f6bf2-4333-44bb-825c-2cce1618d90c', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '76945e28-f121-4506-9103-ef45a1caf54d', '', 1),
('29cce3d8-e146-4701-9ffc-6e16d29890e5', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', '984751c8-590b-49c7-a509-7fa8bcef2c1f', 1),
('34ef8ec3-e473-48b2-8c06-c56b6f1cadf4', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '926d20fc-fba6-4953-99d3-43cd04267222', '', 1),
('3724bce4-9c3a-407e-a65f-883c625c4554', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '2cb6d67a-766f-45be-a78e-1bd44e6711ea', '', 1),
('3a9597ee-12f5-4b6f-afb7-3fd93d6fdf6f', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '362d8be0-0639-4abc-bb33-896aba729178', '', 0),
('3cb3ff97-a002-45d4-b2e5-8fc6ad722e29', '20f2c636-1e25-42f1-a18f-62330cb4954e', '', 'e76bd7c2-65c2-4ba6-8983-160c6497392d', 1),
('3e416045-145d-4d8a-975f-668b7023b0e4', '20f2c636-1e25-42f1-a18f-62330cb4954e', '', '16a8828f-7439-4ff6-9ec7-543c1cd420f1', 1),
('416fa1ba-a8ce-4b65-b1a3-5b5133dd9e8b', '20f2c636-1e25-42f1-a18f-62330cb4954e', '2859e0b5-4f8d-4912-9e62-51a2f993c607', '', 1),
('43aaca02-202a-4bf4-878f-d8669b8ef649', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', '41a19ec1-c6e4-4b85-97ea-89cf3449b84e', 1),
('48d5ca4d-a48f-4447-9d21-5d2a41abe5a6', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', '7dca2dd6-ac16-4709-891b-c11f7fbf27bf', 1),
('4f77ee92-a20c-4108-ab8a-58d273747c21', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', '5ce2874b-f773-4ece-9f33-b8a6ec668d50', 1),
('5394e47d-6785-4f89-99d1-855380f71370', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', '7b1de438-7c64-42ac-8ba9-e13e7ec09976', 1),
('54f03637-9889-4267-a0d0-25ed6a805209', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', '16ce855e-6656-476b-b749-dda8b743897f', 1),
('55a867f7-ff3f-4ff6-bd13-6d5b9dfbbfd2', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '2c4517d0-fc22-4224-af5b-d06b1584c6d6', '', 1),
('6557cc5e-8251-4c01-8c9a-5239f39f72ff', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', '7b1de438-7c64-42ac-8ba9-e13e7ec09976', 1),
('6aeca1ac-0e2b-4f5f-8038-dd29ab62d9be', '20f2c636-1e25-42f1-a18f-62330cb4954e', '', '9788a308-aa7b-4558-8003-3cc722e3247d', 1),
('70c0f8e9-5360-4e2c-bc0e-5e61240eba25', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', '16ce855e-6656-476b-b749-dda8b743897f', 1),
('73043221-572e-4c79-a5af-72e88f852941', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', '984751c8-590b-49c7-a509-7fa8bcef2c1f', 1),
('79700ee1-8f9e-4e68-96f1-acd665bc2c47', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', 'df20c8df-5731-4b44-9428-34b79134e7a5', '', 1),
('7b0b1da7-a796-4804-8745-46690daa8d03', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', '41a19ec1-c6e4-4b85-97ea-89cf3449b84e', 1),
('8adee4b5-a649-478f-b4cb-0074b728fd12', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'a18966f3-609e-453b-bbca-a77a8fdc458c', '', 1),
('961ddb77-0c9e-463d-8590-0ae2b96c60d4', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', 'a6375dc2-0dd8-4cd8-a617-d56f7c623bf1', 1),
('9721cc39-5095-476b-95d0-139abd5ec033', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'd4ec3816-94cd-4e5c-9ad0-fdb1cb23945d', '', 0),
('9c65be8e-397d-46ab-beae-e9a159289175', '20f2c636-1e25-42f1-a18f-62330cb4954e', '14800371-6ecb-46ef-9f60-aa81493131ff', '', 1),
('b4e09960-7a3e-40cf-beb9-d3dff819343a', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'a73f0669-7bbb-4f18-9890-a9da9f75903b', '', 1),
('b8c69991-db8d-4fc4-9610-5969764b4ef9', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', 'f6775b03-9f9a-468b-baa2-957f7702c80b', 1),
('bba164b4-a814-4020-95b1-540f5c57a72e', '20f2c636-1e25-42f1-a18f-62330cb4954e', '', 'd91bd271-ef8a-46a6-afa6-ec8530cb76dc', 1),
('bc4a5f49-cdea-4dfc-957b-71fa0812ecf4', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', 'a6375dc2-0dd8-4cd8-a617-d56f7c623bf1', 1),
('bf514e9c-3310-4f4d-ab6d-be803e08ae18', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '751fba6b-c5e4-42a9-88a6-791bc5a6daab', '', 0),
('c28606fb-422f-4c80-9636-dc2fb4ed0ba6', '20f2c636-1e25-42f1-a18f-62330cb4954e', '', 'ec4d2e58-efde-4065-82c3-bc84f46f50b6', 0),
('c673d379-9ab4-4d47-b97f-5e363758822f', '20f2c636-1e25-42f1-a18f-62330cb4954e', '', '2eda37dc-5a6c-4eb7-af5c-508e6f9e2ea1', 1),
('c7950a58-bad2-4b4a-bd80-0f66e6d52564', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', '7dca2dd6-ac16-4709-891b-c11f7fbf27bf', 1),
('ca1eba92-e281-4c4f-bf02-9f13d7070eb7', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '0d6a2693-2d88-4eb8-a323-9178c2c6e3da', '', 1),
('cd5623b5-8718-4680-9cb2-04f1e095dea1', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '1882a39a-bb3e-43e5-ae61-42df7d6c6f7b', '', 0),
('d7903dfe-a354-45e3-8a3a-d08728fe308f', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'deee553e-8158-4027-9778-3c224a273623', '', 0),
('e0f7bb3b-911a-4887-9ceb-cc47f87d06a2', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'b0331018-05d7-45c3-9975-d39deb7ddf58', '', 1),
('e1efbca7-ffa8-4832-bd71-94ce62072811', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '314d591c-455e-4df0-a3a2-e32161dbe8a1', '', 0),
('e2972259-316e-4fea-82e5-e3526eeae226', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '4b7a8dc0-cb3d-4a02-bce3-45a26be5c562', '', 1),
('e3cd982f-0822-4f18-bbfe-d95451d93de9', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', 'c5a4aab8-9bd2-4c48-b092-e355f1cf5acb', '', 1),
('ea1ab43c-cba1-4c68-b62f-1fefebe43b98', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'eadcd755-cf80-4727-9572-cd11d90bff6e', '', 1),
('ed5b9a4e-866b-42f3-beb8-3953c8e0c60c', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'f1bb55d1-e80b-45f2-b087-7c807556ccc5', '', 1),
('f3809d8e-6b15-435a-a832-c846a1136a11', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', 'c4ce7ee9-401a-4c7e-b2f4-5abb14f5ed4d', '', 0),
('f413ce52-dddc-4e5a-8706-f84372eff262', '20f2c636-1e25-42f1-a18f-62330cb4954e', '6f8090b7-e69c-4d3a-b4c4-026b1f4f650a', '', 1),
('f47ae662-9933-49c3-84d5-52af2921c6cf', '48e05c32-da98-4ce0-8878-6ad1198f0a0a', '', '5ce2874b-f773-4ece-9f33-b8a6ec668d50', 1),
('f9699d1e-77d9-47d6-a4d4-dd81b8ce5370', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', '', 'f6775b03-9f9a-468b-baa2-957f7702c80b', 1),
('fd0eafa9-96ba-4630-a06a-7e08721b4db4', '20f2c636-1e25-42f1-a18f-62330cb4954e', '2e40c083-6ff0-4428-9171-8929077375cc', '', 1),
('ff22c165-bfd8-44f0-b7d9-157ac05b5444', 'ab5cdae6-76e0-4cc3-aa95-efc8d0b019b4', 'c8a243d3-8cf6-40fb-9bdf-ab7a81fc390d', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instrument`
--

CREATE TABLE `tbl_instrument` (
  `id_instrument` varchar(100) NOT NULL,
  `nama_instrument` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_instrument`
--

INSERT INTO `tbl_instrument` (`id_instrument`, `nama_instrument`, `created_at`) VALUES
('e0eba92c-8d48-11f0-808b-54e1ad047dec', 'Narkotika', '2025-09-09 06:47:39'),
('ed689f05-8d48-11f0-808b-54e1ad047dec', 'Teroris', '2025-09-09 06:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kanwil`
--

CREATE TABLE `tbl_kanwil` (
  `id_kanwil` varchar(100) NOT NULL,
  `nama_kanwil` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kanwil`
--

INSERT INTO `tbl_kanwil` (`id_kanwil`, `nama_kanwil`, `created_at`) VALUES
('49985e4d-8d2f-11f0-808b-54e1ad047dec', 'DK Jakarta', '2025-09-09 03:44:28'),
('9d1d2034-8d2f-11f0-808b-54e1ad047dec', 'Jawa Barat', '2025-09-09 03:46:48'),
('c2051828-8d2f-11f0-808b-54e1ad047dec', 'Sumatera Selatan', '2025-09-09 03:47:50'),
('dc2a9099-8d2f-11f0-808b-54e1ad047dec', 'Maluku', '2025-09-09 03:48:34'),
('e6b55220-8d2f-11f0-808b-54e1ad047dec', 'Aceh', '2025-09-09 03:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_narapidana`
--

CREATE TABLE `tbl_narapidana` (
  `no_register` char(20) NOT NULL,
  `nama_narapidana` varchar(250) DEFAULT NULL,
  `perkara` varchar(250) DEFAULT NULL,
  `lama_pidana` varchar(250) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_penahanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_narapidana`
--

INSERT INTO `tbl_narapidana` (`no_register`, `nama_narapidana`, `perkara`, `lama_pidana`, `alamat`, `tempat_penahanan`) VALUES
('11111111111111111111', 'Degasss', 'Cabul', '5 Tahun 3 Bulan', 'Sragentina', 'Lapas Jakarta 2'),
('111112222', 'Julian', 'Pemboman', '10 Tahun 3 Bulan', 'Jakarta', 'Lapas Jakarta 1'),
('3333', 'Yanto', 'Pencurian', '5 Tahun 3 Bulan', 'Jakarta', 'Lapas Jakarta 1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `id_notifikasi` varchar(100) NOT NULL,
  `id_hasil` varchar(100) NOT NULL,
  `jenis_notifikasi` enum('id_skrining_kosong','id_faktor_kosong') NOT NULL,
  `status` enum('baru','dibaca','ditindaklanjuti') NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `nip` char(20) NOT NULL,
  `nama_pegawai` varchar(250) DEFAULT NULL,
  `golongan_pangkat` char(20) DEFAULT NULL,
  `jabatan` varchar(250) DEFAULT NULL,
  `nama_upt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`nip`, `nama_pegawai`, `golongan_pangkat`, `jabatan`, `nama_upt`) VALUES
('123', 'Jono', 'Penata (III/c)', 'Penjaga Tahanan', 'Lapas Jakarta 1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penggeledahan`
--

CREATE TABLE `tbl_penggeledahan` (
  `id_penggeledahan` varchar(100) NOT NULL,
  `jumlah_penggeledahan` int(11) DEFAULT NULL,
  `lokasi_penggeledahan` varchar(250) DEFAULT NULL,
  `target` varchar(250) DEFAULT NULL,
  `temuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pustaka`
--

CREATE TABLE `tbl_pustaka` (
  `id_pustaka` varchar(100) NOT NULL,
  `nama_file` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_skrining`
--

CREATE TABLE `tbl_skrining` (
  `id_skrining` varchar(100) NOT NULL,
  `indikator_skrining` varchar(255) NOT NULL,
  `jenis_skrining` varchar(100) NOT NULL,
  `id_instrument` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_skrining`
--

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
('926d20fc-fba6-4953-99d3-43cd04267222', 'Terduga selalu \"royal\"', 'Pengedar', 'e0eba92c-8d48-11f0-808b-54e1ad047dec', '2025-09-09 02:15:21'),
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sop`
--

CREATE TABLE `tbl_sop` (
  `id_sop` varchar(100) NOT NULL,
  `nama_file` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test_urin`
--

CREATE TABLE `tbl_test_urin` (
  `id_test_urin` varchar(100) NOT NULL,
  `jumlah_sampel_wbp` int(11) DEFAULT NULL,
  `jumlah_sampel_pegawai` int(11) DEFAULT NULL,
  `positif_narkoba` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upload`
--

CREATE TABLE `tbl_upload` (
  `id_upload` varchar(100) NOT NULL,
  `id_hasil` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upt`
--

CREATE TABLE `tbl_upt` (
  `id_upt` varchar(100) NOT NULL,
  `nama_upt` varchar(255) NOT NULL,
  `id_kanwil` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_upt`
--

INSERT INTO `tbl_upt` (`id_upt`, `nama_upt`, `id_kanwil`, `created_at`) VALUES
('0e74ad4a-8d30-11f0-808b-54e1ad047dec', 'Lapas Jakarta 1', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '2025-09-09 03:49:58'),
('30112907-8d30-11f0-808b-54e1ad047dec', 'Lapas Jakarta 2', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '2025-09-09 03:50:55'),
('a82da46b-978d-11f0-b49c-54e1ad047dec', 'Lapas 1 Jabar', '9d1d2034-8d2f-11f0-808b-54e1ad047dec', '2025-09-22 08:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(100) NOT NULL,
  `id_kanwil` varchar(100) DEFAULT NULL,
  `id_upt` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('super','admin','kanwil','upt') NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_kanwil`, `id_upt`, `username`, `password`, `role`, `status`, `created_at`) VALUES
('02896b2b-8424-4a77-aad2-6ae5b5bd48f0', '9d1d2034-8d2f-11f0-808b-54e1ad047dec', 'a82da46b-978d-11f0-b49c-54e1ad047dec', 'jabar1', '202cb962ac59075b964b07152d234b70', 'upt', 'aktif', '2025-09-22 03:25:56'),
('4bfdd547-9184-44dc-8fca-bd2397bab8ef', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '0e74ad4a-8d30-11f0-808b-54e1ad047dec', 'jakarta1', '202cb962ac59075b964b07152d234b70', 'upt', 'aktif', '2025-09-09 01:42:16'),
('5ebe58ee-4ad4-4c82-a80f-ae992f8d6cef', '49985e4d-8d2f-11f0-808b-54e1ad047dec', '30112907-8d30-11f0-808b-54e1ad047dec', 'jakarta2', '202cb962ac59075b964b07152d234b70', 'upt', 'tidak aktif', '2025-09-22 22:50:48'),
('6b10aac2-8d30-11f0-808b-54e1ad047dec', NULL, NULL, 'pamintel', '202cb962ac59075b964b07152d234b70', 'admin', 'aktif', '2025-09-09 03:52:34'),
('89baa26c-8d30-11f0-808b-54e1ad047dec', '49985e4d-8d2f-11f0-808b-54e1ad047dec', NULL, 'jakarta', '202cb962ac59075b964b07152d234b70', 'kanwil', 'aktif', '2025-09-09 03:53:25'),
('b5fd68e3-cddf-41e0-ab5b-72bbb37d2971', '9d1d2034-8d2f-11f0-808b-54e1ad047dec', NULL, 'jabar', '202cb962ac59075b964b07152d234b70', 'kanwil', 'aktif', '2025-09-09 01:41:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_antisipasi`
--
ALTER TABLE `tbl_antisipasi`
  ADD PRIMARY KEY (`id_antisipasi`);

--
-- Indexes for table `tbl_faktor`
--
ALTER TABLE `tbl_faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tbl_hasil_indikator`
--
ALTER TABLE `tbl_hasil_indikator`
  ADD PRIMARY KEY (`id_hasil_indikator`);

--
-- Indexes for table `tbl_instrument`
--
ALTER TABLE `tbl_instrument`
  ADD PRIMARY KEY (`id_instrument`);

--
-- Indexes for table `tbl_kanwil`
--
ALTER TABLE `tbl_kanwil`
  ADD PRIMARY KEY (`id_kanwil`);

--
-- Indexes for table `tbl_narapidana`
--
ALTER TABLE `tbl_narapidana`
  ADD PRIMARY KEY (`no_register`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_penggeledahan`
--
ALTER TABLE `tbl_penggeledahan`
  ADD PRIMARY KEY (`id_penggeledahan`);

--
-- Indexes for table `tbl_pustaka`
--
ALTER TABLE `tbl_pustaka`
  ADD PRIMARY KEY (`id_pustaka`);

--
-- Indexes for table `tbl_skrining`
--
ALTER TABLE `tbl_skrining`
  ADD PRIMARY KEY (`id_skrining`);

--
-- Indexes for table `tbl_sop`
--
ALTER TABLE `tbl_sop`
  ADD PRIMARY KEY (`id_sop`);

--
-- Indexes for table `tbl_test_urin`
--
ALTER TABLE `tbl_test_urin`
  ADD PRIMARY KEY (`id_test_urin`);

--
-- Indexes for table `tbl_upload`
--
ALTER TABLE `tbl_upload`
  ADD PRIMARY KEY (`id_upload`);

--
-- Indexes for table `tbl_upt`
--
ALTER TABLE `tbl_upt`
  ADD PRIMARY KEY (`id_upt`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_antisipasi`
--
ALTER TABLE `tbl_antisipasi`
  MODIFY `id_antisipasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
