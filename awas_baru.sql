-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 11:10 AM
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
-- Database: `awas_baru`
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
('12321158-f96f-478e-926f-b7edf02a67c9', '02896b2b-8424-4a77-aad2-6ae5b5bd48f0', 94, 67, 100, 87, '1', '99999', '2025-09-22 03:27:51'),
('37035f2b-2457-40eb-9d91-91e5cac24675', '02896b2b-8424-4a77-aad2-6ae5b5bd48f0', 100, 0, 75, 58, '5', '111112222', '2025-09-22 03:29:26'),
('6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 78, 100, 40, 73, '1', '20202200202202', '2025-09-22 02:47:07'),
('986bc4b5-2500-4bec-9642-8b7444eacde9', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 100, 100, 100, 100, '1', 'A1234567', '2025-09-18 22:38:38'),
('a129e8a3-0402-40b9-831f-82dc62697ee7', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 100, 100, 100, 100, '4', '199309222025061001', '2025-09-18 22:43:42'),
('aebe3f55-f77e-4cba-a473-60893ccd019a', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 60, 100, 50, 70, '5', '199309222025061002', '2025-09-18 22:41:08'),
('fa74251b-3b6e-4433-a5de-e63ca073b978', '4bfdd547-9184-44dc-8fca-bd2397bab8ef', 20, 0, 25, 15, '6', '11111111111', '2025-09-22 02:48:13');

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
('0121e06d-4ac1-48ff-9213-e864ed42513c', '12321158-f96f-478e-926f-b7edf02a67c9', '', '984751c8-590b-49c7-a509-7fa8bcef2c1f', 1),
('014afb92-acd1-4845-b6ec-a2cd4108dffd', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '', 'ec4d2e58-efde-4065-82c3-bc84f46f50b6', 1),
('066a4656-fb0a-4820-a201-aa5bd45f0461', '12321158-f96f-478e-926f-b7edf02a67c9', 'eadcd755-cf80-4727-9572-cd11d90bff6e', '', 1),
('0841cfcd-ceb9-431a-b156-a952229db522', '986bc4b5-2500-4bec-9642-8b7444eacde9', 'c8a243d3-8cf6-40fb-9bdf-ab7a81fc390d', '', 1),
('09c90e7b-2025-4906-9a00-a02fbb65573b', '12321158-f96f-478e-926f-b7edf02a67c9', 'a18966f3-609e-453b-bbca-a77a8fdc458c', '', 1),
('0c8559c4-9846-496d-b581-681e39ed4057', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '', 'ec4d2e58-efde-4065-82c3-bc84f46f50b6', 0),
('0d001885-b7a8-42fc-b61c-92680c0e2aeb', '12321158-f96f-478e-926f-b7edf02a67c9', 'c4ce7ee9-401a-4c7e-b2f4-5abb14f5ed4d', '', 1),
('0d636c38-85a1-4562-82a0-7a2b9ed5e995', '986bc4b5-2500-4bec-9642-8b7444eacde9', 'f4869fe6-4a78-4d0e-b753-b5f7ab4fec87', '', 1),
('0dfc2bff-d7bd-4310-b06f-65ec2df2abb4', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '', '16a8828f-7439-4ff6-9ec7-543c1cd420f1', 1),
('10fc8867-e107-4365-b07d-51599cb5438b', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '76945e28-f121-4506-9103-ef45a1caf54d', '', 1),
('12c3bd8f-97c7-44e0-a115-5bc5384c1b1b', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '', 'd91bd271-ef8a-46a6-afa6-ec8530cb76dc', 1),
('1621fbd4-f5ad-42b0-849b-289871754c05', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '7976f42d-25ec-4c44-a008-38bc219b308f', '', 0),
('182b22e5-0fb0-45d1-873e-e05ac7608356', '37035f2b-2457-40eb-9d91-91e5cac24675', '', '9788a308-aa7b-4558-8003-3cc722e3247d', 1),
('1b28d3ac-0e9a-4e22-8417-23255b115ac0', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '19991893-f060-4253-8adf-ba6293b9b41f', '', 1),
('1cf88974-8a2c-44f5-9508-4209bb90b509', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '2859e0b5-4f8d-4912-9e62-51a2f993c607', '', 0),
('1da71701-f851-4996-ab07-8ee59563aab7', '12321158-f96f-478e-926f-b7edf02a67c9', '', '7b1de438-7c64-42ac-8ba9-e13e7ec09976', 1),
('1f738eda-7061-42fb-ab3d-0fc77413ca8f', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '', '16a8828f-7439-4ff6-9ec7-543c1cd420f1', 1),
('21d91026-f470-4013-8be0-9b304483f1e8', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '', '9788a308-aa7b-4558-8003-3cc722e3247d', 1),
('2564baf3-6066-4c7b-a0ea-f3a9ae497a57', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '', '2eda37dc-5a6c-4eb7-af5c-508e6f9e2ea1', 1),
('25bcac6c-d01a-4260-be42-3e9e1563a29b', '12321158-f96f-478e-926f-b7edf02a67c9', '314d591c-455e-4df0-a3a2-e32161dbe8a1', '', 1),
('2b8b5627-db21-4c48-83b5-ccbe3f832f08', '12321158-f96f-478e-926f-b7edf02a67c9', '362d8be0-0639-4abc-bb33-896aba729178', '', 1),
('30974645-05bf-4f4b-a148-926de569ce31', '37035f2b-2457-40eb-9d91-91e5cac24675', '7976f42d-25ec-4c44-a008-38bc219b308f', '', 1),
('317b0115-78cd-4216-a6fd-7ed7f3e59906', '12321158-f96f-478e-926f-b7edf02a67c9', '', '5ce2874b-f773-4ece-9f33-b8a6ec668d50', 0),
('33bb638a-4569-42e2-977a-8d6f13ec0401', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '14800371-6ecb-46ef-9f60-aa81493131ff', '', 1),
('35f0fd1b-532b-4ada-946a-b9ae9352fddd', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', '7dca2dd6-ac16-4709-891b-c11f7fbf27bf', 1),
('3778638c-2456-4be9-87fb-d8bd4b259ff2', 'a129e8a3-0402-40b9-831f-82dc62697ee7', 'f7b835a1-d3cf-4a31-943f-3fb18e043e62', '', 1),
('383b05c6-d100-4995-a893-de2207939a5c', '12321158-f96f-478e-926f-b7edf02a67c9', '0d6a2693-2d88-4eb8-a323-9178c2c6e3da', '', 1),
('38908e6c-ec2c-4f45-8429-8129b66322d2', '12321158-f96f-478e-926f-b7edf02a67c9', 'f1bb55d1-e80b-45f2-b087-7c807556ccc5', '', 0),
('3b8f1e8b-c0f9-4e97-b101-4becfad1fc35', '12321158-f96f-478e-926f-b7edf02a67c9', 'a73f0669-7bbb-4f18-9890-a9da9f75903b', '', 1),
('3b8fc293-47ac-49a1-831f-7a45b085ba55', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '', 'e76bd7c2-65c2-4ba6-8983-160c6497392d', 0),
('3d619ee2-074a-4d5e-ae68-a4eae7d644af', '37035f2b-2457-40eb-9d91-91e5cac24675', '2e40c083-6ff0-4428-9171-8929077375cc', '', 1),
('3e5da969-c922-4370-b52e-eb736f6f2500', '12321158-f96f-478e-926f-b7edf02a67c9', '', 'a6375dc2-0dd8-4cd8-a617-d56f7c623bf1', 1),
('40c9cbeb-eda2-4ab3-b7fc-87a29cd448bd', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', 'c5a4aab8-9bd2-4c48-b092-e355f1cf5acb', '', 1),
('419ed390-7461-444f-a51a-1367a7683407', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', '41a19ec1-c6e4-4b85-97ea-89cf3449b84e', 0),
('467be332-e097-4c0f-adaa-7df01c6ed1ce', '12321158-f96f-478e-926f-b7edf02a67c9', '', '16ce855e-6656-476b-b749-dda8b743897f', 1),
('4ab1928d-c158-4250-ba73-739569f6ce24', '12321158-f96f-478e-926f-b7edf02a67c9', '751fba6b-c5e4-42a9-88a6-791bc5a6daab', '', 1),
('4e7ff6ee-4509-434b-b65d-023faae9132f', '986bc4b5-2500-4bec-9642-8b7444eacde9', '76945e28-f121-4506-9103-ef45a1caf54d', '', 1),
('4f647513-2e87-40a1-961e-10a56a51aa37', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '558fe4fa-4614-4a30-a32e-47b272fac129', '', 1),
('578663f8-dea8-429d-8da1-0b36efc8bb21', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', '7b1de438-7c64-42ac-8ba9-e13e7ec09976', 1),
('59385c69-e2de-48a6-abcb-cbcf8e526384', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', 'df20c8df-5731-4b44-9428-34b79134e7a5', '', 1),
('5a5bcfef-6439-414f-aee9-8bb4bd5e6ca8', '12321158-f96f-478e-926f-b7edf02a67c9', 'b0331018-05d7-45c3-9975-d39deb7ddf58', '', 1),
('5ebf1408-d6e2-4d1a-908d-99dbc3b57723', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', '5ce2874b-f773-4ece-9f33-b8a6ec668d50', 1),
('5fcb0d54-cbeb-43bf-b62c-10b3268b3b17', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '', '16a8828f-7439-4ff6-9ec7-543c1cd420f1', 1),
('60e5856f-f3d1-453a-959e-134c06a02128', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', 'f4869fe6-4a78-4d0e-b753-b5f7ab4fec87', '', 0),
('62e6d82c-f26d-4ae4-b4f8-0c8884b61069', '12321158-f96f-478e-926f-b7edf02a67c9', 'deee553e-8158-4027-9778-3c224a273623', '', 1),
('6a3d5a34-3d0d-4129-b748-e1140dd660f2', '12321158-f96f-478e-926f-b7edf02a67c9', '7405602f-4d48-4dc7-a07a-08978dac2503', '', 1),
('6ab77719-ea0f-406f-80f9-779dee67067f', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', '7b1de438-7c64-42ac-8ba9-e13e7ec09976', 1),
('6ae16265-1879-4d89-8efe-45b4e871756d', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '2e40c083-6ff0-4428-9171-8929077375cc', '', 0),
('6bae46fd-ad75-4b83-b035-229b0c9a91db', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '14800371-6ecb-46ef-9f60-aa81493131ff', '', 1),
('6d5f7fde-14e5-4254-9426-a51e8d4d095f', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', 'a6375dc2-0dd8-4cd8-a617-d56f7c623bf1', 0),
('6f287e1e-eef2-44d2-b5bd-d5d9867e77f0', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', 'c8a243d3-8cf6-40fb-9bdf-ab7a81fc390d', '', 1),
('6f7df9eb-dabe-4ab8-a803-e477d09226f5', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', 'e0d9eafe-6f74-470b-a576-3437d51aec79', '', 1),
('72ae21c7-5ac9-4b9a-95f2-7decaabaf66a', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '', 'e76bd7c2-65c2-4ba6-8983-160c6497392d', 1),
('7477c1a9-d4b8-443c-912b-6ce77afe7904', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '1882a39a-bb3e-43e5-ae61-42df7d6c6f7b', '', 1),
('75501b0d-01a8-4100-9a18-9223acaf05c7', '986bc4b5-2500-4bec-9642-8b7444eacde9', 'c5a4aab8-9bd2-4c48-b092-e355f1cf5acb', '', 1),
('7b769df9-c137-477b-b4e3-da3c4f064d2f', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', '5ce2874b-f773-4ece-9f33-b8a6ec668d50', 1),
('7dcc31a3-b203-419c-a082-d0240a794b14', '12321158-f96f-478e-926f-b7edf02a67c9', '4b7a8dc0-cb3d-4a02-bce3-45a26be5c562', '', 1),
('7dda127c-ccb8-4f50-8b8e-b574d6a8be0f', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '', 'ec4d2e58-efde-4065-82c3-bc84f46f50b6', 1),
('7e582fae-4f94-46de-9677-457af4c54a17', '12321158-f96f-478e-926f-b7edf02a67c9', '', '41a19ec1-c6e4-4b85-97ea-89cf3449b84e', 1),
('80828b2f-bf43-4937-ab0d-8ca059a50fba', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '', '9788a308-aa7b-4558-8003-3cc722e3247d', 0),
('80ecb951-6c41-411b-bcf9-de0d355ae5b6', '12321158-f96f-478e-926f-b7edf02a67c9', '2cb6d67a-766f-45be-a78e-1bd44e6711ea', '', 1),
('85ec8322-94ba-4534-b244-a8ee620c5d3b', '986bc4b5-2500-4bec-9642-8b7444eacde9', '1882a39a-bb3e-43e5-ae61-42df7d6c6f7b', '', 1),
('87810dba-3691-4104-a200-e9db18c5e33c', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '926d20fc-fba6-4953-99d3-43cd04267222', '', 1),
('8bbf7eb4-1473-412f-be56-d48ec492937f', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', '16ce855e-6656-476b-b749-dda8b743897f', 0),
('903daa8e-a43b-40e2-8a28-2535d689d52c', '12321158-f96f-478e-926f-b7edf02a67c9', '9349e2c1-ed0e-41ba-91af-b3d915ebdd36', '', 1),
('904e433b-fb8d-4c58-b0c5-1ab256b66bcd', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '', 'd91bd271-ef8a-46a6-afa6-ec8530cb76dc', 0),
('91b66443-0ac5-4ab1-bc84-63da98a672af', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '3576bd83-d32b-47da-ab1d-9c374be4a0d1', '', 1),
('94ee880b-4304-4a8d-b1f5-811b7a9af46f', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', 'f6775b03-9f9a-468b-baa2-957f7702c80b', 1),
('95690f12-b0dd-455a-afcb-517c12846282', '37035f2b-2457-40eb-9d91-91e5cac24675', '', '2eda37dc-5a6c-4eb7-af5c-508e6f9e2ea1', 0),
('9c3af62f-21a0-47f3-b898-8f241c9e231e', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', '984751c8-590b-49c7-a509-7fa8bcef2c1f', 1),
('9f1a1bab-2d1c-4b9b-bedd-e75a892785d2', '12321158-f96f-478e-926f-b7edf02a67c9', 'd4ec3816-94cd-4e5c-9ad0-fdb1cb23945d', '', 1),
('a11567b0-2b62-4ee9-a0fd-d69f63871b06', '37035f2b-2457-40eb-9d91-91e5cac24675', '', 'd91bd271-ef8a-46a6-afa6-ec8530cb76dc', 1),
('a49d2023-d6c6-4f83-81db-5cf8be5473ad', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', '7dca2dd6-ac16-4709-891b-c11f7fbf27bf', 1),
('a59d15d3-656b-4e64-9fb8-72b08588d5af', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '6f8090b7-e69c-4d3a-b4c4-026b1f4f650a', '', 0),
('a748a5a7-f437-4397-859d-cf3b07a3bd3d', '37035f2b-2457-40eb-9d91-91e5cac24675', '', 'e76bd7c2-65c2-4ba6-8983-160c6497392d', 0),
('a83c8385-827b-4372-84f6-6dcca7ced209', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', 'a6375dc2-0dd8-4cd8-a617-d56f7c623bf1', 1),
('ab5dc356-202c-47dc-b406-ab27a13c3259', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '6f8090b7-e69c-4d3a-b4c4-026b1f4f650a', '', 0),
('ae6c2207-92d6-44e2-a8c0-816bd021a0a8', 'a129e8a3-0402-40b9-831f-82dc62697ee7', 'b0a76bb2-7cbf-41f4-b965-3a35d4c43d2b', '', 1),
('af3ac464-5c1e-455b-af37-0d7acb48f58d', '12321158-f96f-478e-926f-b7edf02a67c9', '', 'f6775b03-9f9a-468b-baa2-957f7702c80b', 1),
('b51232c8-444c-4dbf-9402-7c77371c1a08', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', '16ce855e-6656-476b-b749-dda8b743897f', 1),
('b7522266-68f1-49fe-b262-3716507ddf65', '986bc4b5-2500-4bec-9642-8b7444eacde9', 'df20c8df-5731-4b44-9428-34b79134e7a5', '', 1),
('bbf23eef-f388-4c8a-83c8-5aba905ecc79', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '7976f42d-25ec-4c44-a008-38bc219b308f', '', 0),
('c077cf7b-143b-47ac-983a-d7c7e588ceca', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '8721af22-7a61-45ab-9682-3e74fd7bbd4d', '', 1),
('c3bdd0a0-c8d9-4ca9-a4c0-1775ed0e7a5f', '37035f2b-2457-40eb-9d91-91e5cac24675', '14800371-6ecb-46ef-9f60-aa81493131ff', '', 1),
('c4e1bf8f-80fb-4189-baec-ca9247d0aae6', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '2e40c083-6ff0-4428-9171-8929077375cc', '', 1),
('c7c0fe9e-56af-4139-b4f0-b91194aa46fa', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '2859e0b5-4f8d-4912-9e62-51a2f993c607', '', 1),
('cd9f1f1b-6518-414c-a578-d2710badf490', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '', '2eda37dc-5a6c-4eb7-af5c-508e6f9e2ea1', 0),
('d2db7a94-0e98-4f6a-99b1-408f2c80d3fc', '37035f2b-2457-40eb-9d91-91e5cac24675', '', 'ec4d2e58-efde-4065-82c3-bc84f46f50b6', 0),
('d31c0d20-893b-4a88-8d41-af40553debb6', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '', 'f6775b03-9f9a-468b-baa2-957f7702c80b', 1),
('d32b9dd9-f1fa-49b6-9e05-97f7d6b5bb1b', '986bc4b5-2500-4bec-9642-8b7444eacde9', 'e0d9eafe-6f74-470b-a576-3437d51aec79', '', 1),
('df5e9f08-8d45-46f2-9779-e6eef58d5f42', '37035f2b-2457-40eb-9d91-91e5cac24675', '6f8090b7-e69c-4d3a-b4c4-026b1f4f650a', '', 1),
('e07743e0-1ad5-4d6a-babf-a402c77f4441', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', '984751c8-590b-49c7-a509-7fa8bcef2c1f', 1),
('e1b0b981-d482-4e2f-9121-bce81fbd580f', '986bc4b5-2500-4bec-9642-8b7444eacde9', '', '41a19ec1-c6e4-4b85-97ea-89cf3449b84e', 1),
('e72697b5-8c70-4b4d-8121-a0e87238eca2', '986bc4b5-2500-4bec-9642-8b7444eacde9', '2c4517d0-fc22-4224-af5b-d06b1584c6d6', '', 1),
('e95687ba-e091-4e4f-989f-e9bcf9ae0237', 'a129e8a3-0402-40b9-831f-82dc62697ee7', '', '2eda37dc-5a6c-4eb7-af5c-508e6f9e2ea1', 1),
('eb97a6d2-fc3c-49c2-b4a9-8077ee89f653', 'fa74251b-3b6e-4433-a5de-e63ca073b978', '', 'e76bd7c2-65c2-4ba6-8983-160c6497392d', 0),
('ed923243-889c-495f-ba93-d6ba687ad94a', '12321158-f96f-478e-926f-b7edf02a67c9', '', '7dca2dd6-ac16-4709-891b-c11f7fbf27bf', 1),
('f588b1a9-da67-494e-be35-2c03b5430d85', '37035f2b-2457-40eb-9d91-91e5cac24675', '2859e0b5-4f8d-4912-9e62-51a2f993c607', '', 1),
('f665ad39-e64c-4df9-b7af-1a37f66845cc', '6bc062c1-eec1-4cf9-a6fc-b9e9e96ecd9d', '2c4517d0-fc22-4224-af5b-d06b1584c6d6', '', 0),
('fc6d02d8-cad4-42d2-b3c8-c49b17fedb57', '986bc4b5-2500-4bec-9642-8b7444eacde9', '926d20fc-fba6-4953-99d3-43cd04267222', '', 1),
('fc95d4c8-fb68-471a-b014-8f74e0544fff', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '', '9788a308-aa7b-4558-8003-3cc722e3247d', 1),
('fdd7f1a0-4da9-4405-927d-41454078179b', '37035f2b-2457-40eb-9d91-91e5cac24675', '', '16a8828f-7439-4ff6-9ec7-543c1cd420f1', 1),
('fe34d79c-26d3-4763-8947-378e67c08619', 'aebe3f55-f77e-4cba-a473-60893ccd019a', '', 'd91bd271-ef8a-46a6-afa6-ec8530cb76dc', 0);

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
('11111111111', 'Guiness', 'Mabok', '2 Tahun 3 Bulan', 'Sragen', 'Lapas Jakarta 1'),
('111112222', 'Degano', 'Gay', '2 Tahun 5 Bulan', 'Sragentina', 'Lapas 1 Jabar'),
('A1234567', 'Degan', 'Mesum', '2', 'Jl. Pacenongan No.54', 'Lapas Jakarta 1');

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
('199309222025061001', 'Antony', 'Penata Tingkat I (II', 'Analis Sistem', 'Lapas Jakarta 1'),
('199309222025061002', 'Silvano', 'Penata Muda Tingkat', 'Analis Sistem Pemasyarakatan', 'Lapas Jakarta 1'),
('20202200202202', 'Tomat', 'Penata Muda (III/a)', 'Bansur', 'Lapas Jakarta 1'),
('99999', 'Koding', 'Juru Muda (I/a)', 'Koding', 'Lapas 1 Jabar');

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
