-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 02:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skripsi_obe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpl`
--

CREATE TABLE `cpl` (
  `id_cpl` varchar(8) NOT NULL,
  `nama_cpl` varchar(255) NOT NULL,
  `bobot_cpl` decimal(3,2) NOT NULL,
  `id_pl` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpl`
--

INSERT INTO `cpl` (`id_cpl`, `nama_cpl`, `bobot_cpl`, `id_pl`) VALUES
('01', 'Mahasiswa dapat menguasai data science', '0.20', '01'),
('02', 'TestCPL', '0.30', '03'),
('03', 'Mahasiswa dapat berfikir secara kritis dalam setiap pembelajaran', '0.10', '04'),
('04', 'Mahasiswa dapat mengimplementasikan terkait persatuan di dalam organisasi teknologi', '0.25', '06'),
('05', 'TestCPL', '0.10', '07');

-- --------------------------------------------------------

--
-- Table structure for table `cpmk`
--

CREATE TABLE `cpmk` (
  `id_cpmk` varchar(12) NOT NULL,
  `nama_cpmk` varchar(255) NOT NULL,
  `bobot_cpmk` decimal(3,3) NOT NULL,
  `id_cpl` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpmk`
--

INSERT INTO `cpmk` (`id_cpmk`, `nama_cpmk`, `bobot_cpmk`, `id_cpl`) VALUES
('00101', 'Mahasiswa dapat menguasai mathlab untuk membantu penyelesaian solusi dari bidang data', '0.100', '01'),
('00102', 'testCPMK', '0.200', '02'),
('00103', 'Mahasiswa dapat memahami mata kuliah terkait critical thinking', '0.050', '03'),
('00104', 'Mahasiswa dapat menerapkan terkait mata kuliah yang terkait', '0.125', '04'),
('020.1', '0.1', '0.100', '02'),
('03112', 'Mahasiswa informatika jaya', '0.040', '05');

-- --------------------------------------------------------

--
-- Table structure for table `cpmk_mk`
--

CREATE TABLE `cpmk_mk` (
  `id_cpmk_mk` varchar(15) NOT NULL,
  `id_cpmk` varchar(12) NOT NULL,
  `id_mk` varchar(10) NOT NULL,
  `bobot_mk` decimal(4,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpmk_mk`
--

INSERT INTO `cpmk_mk` (`id_cpmk_mk`, `id_cpmk`, `id_mk`, `bobot_mk`) VALUES
('00101001', '00101', '001', '0.0050'),
('00101003', '00101', '003', '0.0000'),
('00102002', '00102', '002', '0.0060'),
('00102006', '00102', '006', '0.0040'),
('00103003', '00103', '003', '0.0070'),
('00103009', '00103', '009', '0.0400'),
('00103011', '00103', '011', '0.0001'),
('00103014', '00103', '014', '0.0020'),
('00104005', '00104', '005', '0.0080');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `kode_wali` varchar(20) NOT NULL,
  `NIP` varchar(20) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`kode_wali`, `NIP`, `nama_dosen`, `email`) VALUES
('001', '197404011999031002', 'Dr. Aris Puji Widodo, S.Si, M.T.', 'arispujiwidodo@lecturer.undip.ac.id'),
('002', '197308291998022001', 'Beta Noranita, S.Si., M.Kom.', 'betanoranita@lecturer.undip.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_mata_kuliah`
--

CREATE TABLE `dosen_mata_kuliah` (
  `id_dosen_mk` int(11) NOT NULL,
  `id_mk` varchar(10) NOT NULL,
  `kode_wali` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen_mata_kuliah`
--

INSERT INTO `dosen_mata_kuliah` (`id_dosen_mk`, `id_mk`, `kode_wali`) VALUES
(1, '001', '002'),
(2, '003', '002');

-- --------------------------------------------------------

--
-- Table structure for table `dpna`
--

CREATE TABLE `dpna` (
  `id_dpna` int(10) NOT NULL,
  `id_mk` varchar(10) DEFAULT NULL,
  `id_TA` int(11) DEFAULT NULL,
  `NIM` varchar(16) NOT NULL,
  `kelas` varchar(8) DEFAULT NULL,
  `tugas` decimal(6,2) NOT NULL,
  `praktikum` decimal(6,2) NOT NULL,
  `UTS` decimal(6,2) NOT NULL,
  `UAS` decimal(6,2) NOT NULL,
  `nilai_angka` decimal(6,2) NOT NULL,
  `nilai_huruf` varchar(4) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dpna`
--

INSERT INTO `dpna` (`id_dpna`, `id_mk`, `id_TA`, `NIM`, `kelas`, `tugas`, `praktikum`, `UTS`, `UAS`, `nilai_angka`, `nilai_huruf`, `status`, `waktu_upload`) VALUES
(473, '001', 8, '25000122410031', 'A', '90.00', '90.00', '85.00', '85.00', '88.00', 'A', 'Sudah', '2024-02-02 13:30:00'),
(474, '001', 8, '25000122410008', 'A', '90.00', '87.00', '80.00', '80.00', '85.40', 'A', 'Sudah', '2024-02-02 13:30:00'),
(475, '001', 8, '25000122410011', 'A', '90.00', '85.00', '85.00', '85.00', '87.00', 'A', 'Sudah', '2024-02-02 13:30:00'),
(476, '001', 8, '25000122410019', 'A', '90.00', '90.00', '85.00', '85.00', '88.00', 'A', 'Sudah', '2024-02-02 13:30:00'),
(477, '001', 8, '25000122410027', 'A', '85.00', '82.00', '80.00', '80.00', '82.40', 'A', 'Sudah', '2024-02-02 13:30:00'),
(478, '006', 7, '25000122410031', 'A', '90.00', '90.00', '85.00', '85.00', '88.00', 'A', 'Sudah', '2024-02-02 13:30:22'),
(479, '006', 7, '25000122410008', 'A', '90.00', '87.00', '80.00', '80.00', '85.40', 'A', 'Sudah', '2024-02-02 13:30:22'),
(480, '006', 7, '25000122410011', 'A', '90.00', '85.00', '85.00', '85.00', '87.00', 'A', 'Sudah', '2024-02-02 13:30:22'),
(481, '006', 7, '25000122410019', 'A', '90.00', '90.00', '85.00', '85.00', '88.00', 'A', 'Sudah', '2024-02-02 13:30:22'),
(482, '006', 7, '25000122410027', 'A', '85.00', '82.00', '80.00', '80.00', '82.40', 'A', 'Sudah', '2024-02-02 13:30:22'),
(483, '003', 8, '25000122410031', 'A', '90.00', '90.00', '85.00', '85.00', '88.00', 'A', 'Sudah', '2024-02-02 13:34:52'),
(484, '003', 8, '25000122410008', 'A', '90.00', '87.00', '80.00', '80.00', '85.40', 'A', 'Sudah', '2024-02-02 13:34:53'),
(485, '003', 8, '25000122410011', 'A', '90.00', '85.00', '85.00', '85.00', '87.00', 'A', 'Sudah', '2024-02-02 13:34:53'),
(486, '003', 8, '25000122410019', 'A', '90.00', '90.00', '85.00', '85.00', '88.00', 'A', 'Sudah', '2024-02-02 13:34:53'),
(487, '003', 8, '25000122410027', 'A', '85.00', '82.00', '80.00', '80.00', '82.40', 'A', 'Sudah', '2024-02-02 13:34:53');

--
-- Triggers `dpna`
--
DELIMITER $$
CREATE TRIGGER `AfterInsertDPNA` AFTER INSERT ON `dpna` FOR EACH ROW BEGIN
    DECLARE v_id_cpl VARCHAR(8);
    DECLARE v_id_cpmk VARCHAR(12);
    DECLARE v_id_pl VARCHAR(5);
    
    -- Get id_cpmk from the mata_kuliah table based on the id_mk from the newly inserted row in dpna
    SELECT id_cpmk INTO v_id_cpmk FROM mata_kuliah WHERE id_mk = NEW.id_mk LIMIT 1;
    
    -- Get id_cpl from the cpmk table based on the v_id_cpmk
    SELECT id_cpl INTO v_id_cpl FROM cpmk WHERE id_cpmk = v_id_cpmk LIMIT 1;

    -- Get id_pl from the cpl table based on the v_id_cpl
    SELECT id_pl INTO v_id_pl FROM cpl WHERE id_cpl = v_id_cpl LIMIT 1;

    -- Insert the new row in trxdpna with updated fields
    INSERT INTO trxdpna (id_dpna, id_mk, id_cpmk, id_cpl, id_pl)
    VALUES (NEW.id_dpna, NEW.id_mk, v_id_cpmk, v_id_cpl, v_id_pl);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `nama_kelas` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id_kurikulum` varchar(5) NOT NULL,
  `nama_kurikulum` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id_kurikulum`, `nama_kurikulum`) VALUES
('1', '2006'),
('2', '2009'),
('3', '2013'),
('4', 'Merdeka');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(16) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `tahun_masuk` int(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `kode_wali` varchar(20) NOT NULL,
  `id_TA` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `nama_mhs`, `tahun_masuk`, `email`, `no_hp`, `kode_wali`, `id_TA`) VALUES
('25000122410008', 'ADINDA CIPTA DEWI', 2021, 'ahmadipan@students.undip.ac.id', '08234111234', '002', 4),
('25000122410011', 'GHINANISSA AZZAHRA DUSTAR', 2019, 'dany@students.undip.ac.id', '085128391124', '001', 4),
('25000122410019', 'I PUTU OKTA DIWIAN JAYA PUTRA', 2020, 'zaidan@students.undip.ac.id', '085977458821', '002', 1),
('25000122410027', 'LUTFATILA MASITOH', 2018, 'rizalzerisubakti@students.undip.ac.id', '08151327885', '001', 6),
('25000122410031', 'RIVALDO ORYON PAPILAYA', 2020, 'zeri@students.undip.ac.id', '082344824412', '001', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_mata_kuliah`
--

CREATE TABLE `mahasiswa_mata_kuliah` (
  `id_mhs_mk` int(11) NOT NULL,
  `NIM` varchar(16) NOT NULL,
  `id_mk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa_mata_kuliah`
--

INSERT INTO `mahasiswa_mata_kuliah` (`id_mhs_mk`, `NIM`, `id_mk`) VALUES
(16, '25000122410011', '001'),
(17, '25000122410011', '002'),
(18, '25000122410011', '003'),
(19, '25000122410011', '005'),
(20, '25000122410011', '006'),
(21, '25000122410011', '009'),
(22, '25000122410011', '011');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` varchar(10) NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL,
  `semester_mk` int(2) NOT NULL,
  `id_kurikulum` varchar(5) NOT NULL,
  `id_cpmk` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `kode_mk`, `nama_mk`, `sks`, `semester_mk`, `id_kurikulum`, `id_cpmk`) VALUES
('001', 'PAIK001', 'Data Mining', 3, 2, '1', '00101'),
('002', 'PAIK6102', 'Dasar Pemrograman', 4, 2, '1', '00103'),
('003', 'PAIK6103', 'Dasar Sistem', 3, 2, '2', '00104'),
('005', 'PAIK2101', 'Struktur Data', 4, 3, '4', '00104'),
('006', 'PAIK6202', 'Matematika II', 2, 3, '3', '00103'),
('009', 'PAIK009', 'Pembelajaran Mesin', 3, 5, '4', '00103'),
('011', 'PAIK011', 'Komputasi Tersebar dan Pararel', 3, 5, '4', '00102'),
('012', 'PAIK012', 'Pengembangan Berbasis Platform', 4, 5, '1', '00104'),
('013', 'PAIK013', 'Proyek Perangkat Lunak', 3, 5, '1', '00102'),
('014', 'PAIK014', 'Metode Perangkat Lunak', 3, 5, '3', '00102');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pl`
--

CREATE TABLE `pl` (
  `id_pl` varchar(5) NOT NULL,
  `nama_pl` varchar(255) NOT NULL,
  `bobot_pl` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pl`
--

INSERT INTO `pl` (`id_pl`, `nama_pl`, `bobot_pl`) VALUES
('01', 'Menjadikan mahasiswa informatika unggul juara yes', '0.50'),
('03', 'TestPL', '0.50'),
('04', 'Mahasiswa yang berfikir kedepan dalam menjalankan peran global', '0.50'),
('06', 'Mahasiswa dapat menjunjung tinggi nilai persatuan', '0.75'),
('07', 'TestPL', '0.50');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(2) NOT NULL,
  `nama_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
(1, 'sudah'),
(2, 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_TA` int(5) NOT NULL,
  `periode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_TA`, `periode`) VALUES
(1, 'Semester Gasal Tahun 2020/2021'),
(2, 'Semester Genap Tahun 2020/2021'),
(3, 'Semester Gasal Tahun 2021/2022'),
(4, 'Semester Genap Tahun 2021/2022'),
(5, 'Semester Gasal Tahun 2022/2023'),
(6, 'Semester Genap Tahun 2022/2023'),
(7, 'Semester Gasal Tahun 2023/2024'),
(8, 'Semester Genap Tahun 2023/2024');

-- --------------------------------------------------------

--
-- Table structure for table `trxdpna`
--

CREATE TABLE `trxdpna` (
  `id_trx` int(10) NOT NULL,
  `id_dpna` int(10) NOT NULL,
  `id_pl` varchar(5) DEFAULT NULL,
  `id_cpl` varchar(8) DEFAULT NULL,
  `id_cpmk` varchar(12) DEFAULT NULL,
  `id_mk` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trxdpna`
--

INSERT INTO `trxdpna` (`id_trx`, `id_dpna`, `id_pl`, `id_cpl`, `id_cpmk`, `id_mk`) VALUES
(468, 473, '01', '01', '00101', '001'),
(469, 474, '01', '01', '00101', '001'),
(470, 475, '01', '01', '00101', '001'),
(471, 476, '01', '01', '00101', '001'),
(472, 477, '01', '01', '00101', '001'),
(473, 478, '04', '03', '00103', '006'),
(474, 479, '04', '03', '00103', '006'),
(475, 480, '04', '03', '00103', '006'),
(476, 481, '04', '03', '00103', '006'),
(477, 482, '04', '03', '00103', '006'),
(478, 483, '06', '04', '00104', '003'),
(479, 484, '06', '04', '00104', '003'),
(480, 485, '06', '04', '00104', '003'),
(481, 486, '06', '04', '00104', '003'),
(482, 487, '06', '04', '00104', '003');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `peran`) VALUES
('admin@admin.undip.ac.id', '$2y$10$arL.V51hlnMwOyN/oVEVLOehi.ezU4GkTK3UAeB0r1KmewKZ4FMhS', 'admin'),
('ahmadipan@students.undip.ac.id', '$2y$10$K/5CvXfHrTV2NVdKB/e8ZO6v3EqpiArm.AdcyI1S3MD176eIio6t6', 'mahasiswa'),
('arispujiwidodo@lecturer.undip.ac.id', '$2y$10$PGV3L1FElsTXvZH9FllXvuPa0SGuLgdrhfyRY4TbXuDKnqiG98Yoa', 'dosen'),
('betanoranita@lecturer.undip.ac.id', '$2y$10$2IJOZ6nmNIlrVHQYNVbpmefU9okE/GRx8rcxDz1DN9KVda0Rj/Hky', 'dosen'),
('dany@students.undip.ac.id', '$2y$10$qhLdCTUsua6vQcOHGM9AVuhqHIW9YbeZctWvOJxWLK8XuqnakTQ3i', 'mahasiswa'),
('if_departemen@departemen.undip.ac.id', '$2y$10$xlJQwcyjmyix/SNbCixlqevNQaGNdPk7o9NyIsZV12vkjzcUv0dc.', 'departemen'),
('operator@operator.undip.ac.id', '$2y$10$rRSu9ZZQqtIAA/E.X7am4uHho65yYhy8cjTOJi2xYHTd2k.WpZ46C', 'operator'),
('rizalzerisubakti@students.undip.ac.id', 'rizal1234', 'mahasiswa'),
('zaidan@students.undip.ac.id', '$2y$10$W0oxAmQ/IHtMB39/NSQioOGU1e5FfmrlZvm5gLFSq0ZqWqcuFemou', 'mahasiswa'),
('zeri@students.undip.ac.id', '$2y$10$aQnTAapArxxnVNAcFHQpzeIsreqD5rCBsQwxbaRGtbKr8e8kgvZdS', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpl`
--
ALTER TABLE `cpl`
  ADD PRIMARY KEY (`id_cpl`),
  ADD KEY `id_pl` (`id_pl`);

--
-- Indexes for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD PRIMARY KEY (`id_cpmk`),
  ADD KEY `id_cpl` (`id_cpl`);

--
-- Indexes for table `cpmk_mk`
--
ALTER TABLE `cpmk_mk`
  ADD PRIMARY KEY (`id_cpmk_mk`),
  ADD KEY `id_cpmk` (`id_cpmk`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`kode_wali`),
  ADD KEY `dosen_users_01` (`email`);

--
-- Indexes for table `dosen_mata_kuliah`
--
ALTER TABLE `dosen_mata_kuliah`
  ADD PRIMARY KEY (`id_dosen_mk`),
  ADD KEY `mk_dosen` (`id_mk`),
  ADD KEY `dosen_mk` (`kode_wali`);

--
-- Indexes for table `dpna`
--
ALTER TABLE `dpna`
  ADD PRIMARY KEY (`id_dpna`),
  ADD KEY `dpna_mhs_01` (`NIM`),
  ADD KEY `dpna_mk_01` (`id_mk`),
  ADD KEY `fk_dpna_tahun_ajaran` (`id_TA`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `mhs_smstTa` (`id_TA`),
  ADD KEY `mhs_dosen` (`kode_wali`),
  ADD KEY `mhs_user` (`email`);

--
-- Indexes for table `mahasiswa_mata_kuliah`
--
ALTER TABLE `mahasiswa_mata_kuliah`
  ADD PRIMARY KEY (`id_mhs_mk`),
  ADD KEY `mhs_mk` (`id_mk`),
  ADD KEY `mhs_mk1` (`NIM`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD UNIQUE KEY `kode_mk` (`kode_mk`),
  ADD KEY `mk_kurikulum_01` (`id_kurikulum`),
  ADD KEY `mk_cpmk_01` (`id_cpmk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pl`
--
ALTER TABLE `pl`
  ADD PRIMARY KEY (`id_pl`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_TA`);

--
-- Indexes for table `trxdpna`
--
ALTER TABLE `trxdpna`
  ADD PRIMARY KEY (`id_trx`),
  ADD UNIQUE KEY `id_dpna` (`id_dpna`),
  ADD KEY `trxdpna_dpna3` (`id_dpna`),
  ADD KEY `fk_trxdpna_mata_kuliah` (`id_mk`),
  ADD KEY `fk_trxdpna_cpmk` (`id_cpmk`),
  ADD KEY `fk_trxdpna_cpl` (`id_cpl`),
  ADD KEY `fk_trxdpna_pl` (`id_pl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen_mata_kuliah`
--
ALTER TABLE `dosen_mata_kuliah`
  MODIFY `id_dosen_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dpna`
--
ALTER TABLE `dpna`
  MODIFY `id_dpna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=488;

--
-- AUTO_INCREMENT for table `mahasiswa_mata_kuliah`
--
ALTER TABLE `mahasiswa_mata_kuliah`
  MODIFY `id_mhs_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_TA` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `trxdpna`
--
ALTER TABLE `trxdpna`
  MODIFY `id_trx` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpl`
--
ALTER TABLE `cpl`
  ADD CONSTRAINT `id_pl` FOREIGN KEY (`id_pl`) REFERENCES `pl` (`id_pl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD CONSTRAINT `id_cpl` FOREIGN KEY (`id_cpl`) REFERENCES `cpl` (`id_cpl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cpmk_mk`
--
ALTER TABLE `cpmk_mk`
  ADD CONSTRAINT `id_cpmk` FOREIGN KEY (`id_cpmk`) REFERENCES `cpmk` (`id_cpmk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_mk` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_users_01` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosen_mata_kuliah`
--
ALTER TABLE `dosen_mata_kuliah`
  ADD CONSTRAINT `dosen_mk` FOREIGN KEY (`kode_wali`) REFERENCES `dosen` (`kode_wali`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mk_dosen` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dpna`
--
ALTER TABLE `dpna`
  ADD CONSTRAINT `dpna_mk_01` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dpna_tahun_ajaran` FOREIGN KEY (`id_TA`) REFERENCES `tahun_ajaran` (`id_TA`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mhs_dosen` FOREIGN KEY (`kode_wali`) REFERENCES `dosen` (`kode_wali`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_ta` FOREIGN KEY (`id_TA`) REFERENCES `tahun_ajaran` (`id_TA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_user` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa_mata_kuliah`
--
ALTER TABLE `mahasiswa_mata_kuliah`
  ADD CONSTRAINT `mhs_mk` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_mk1` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mk_cpmk_01` FOREIGN KEY (`id_cpmk`) REFERENCES `cpmk` (`id_cpmk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mk_kurikulum` FOREIGN KEY (`id_kurikulum`) REFERENCES `kurikulum` (`id_kurikulum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trxdpna`
--
ALTER TABLE `trxdpna`
  ADD CONSTRAINT `fk_trxdpna_cpl` FOREIGN KEY (`id_cpl`) REFERENCES `cpl` (`id_cpl`),
  ADD CONSTRAINT `fk_trxdpna_cpmk` FOREIGN KEY (`id_cpmk`) REFERENCES `cpmk` (`id_cpmk`),
  ADD CONSTRAINT `fk_trxdpna_mata_kuliah` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`),
  ADD CONSTRAINT `fk_trxdpna_pl` FOREIGN KEY (`id_pl`) REFERENCES `pl` (`id_pl`),
  ADD CONSTRAINT `trxdpna_dpna3` FOREIGN KEY (`id_dpna`) REFERENCES `dpna` (`id_dpna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
