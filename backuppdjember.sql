-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2021 at 05:12 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdjember`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tmp_lahir` text DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `kelamin` enum('L','P') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_tingkatan` int(11) DEFAULT NULL,
  `tb` int(3) DEFAULT NULL,
  `bb` int(3) DEFAULT NULL,
  `resmi` tinyint(1) DEFAULT NULL,
  `st_aktif` tinyint(1) DEFAULT 0,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `ukt` tinyint(4) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `tmp_lahir`, `tgl_lahir`, `kelamin`, `alamat`, `no_hp`, `email`, `id_unit`, `id_tingkatan`, `tb`, `bb`, `resmi`, `st_aktif`, `password`, `image`, `role_id`, `ukt`, `date_created`) VALUES
(7, 'Ahmad Affandi', 'Jember', '1990-01-09', 'L', 'Perum Kebonsari Indah Blok DD 22, Jember', '081353705343', 'afandi.0901@gmail.com', 8, 8, 165, 76, 1, 1, '$2y$10$SZtRtmQnoKbtdwOf8KksmO.AUnDD7QGUVEZH1jS.LIq6.wl6c49gS', '13.jpg', 8, 0, 1572248553),
(9, 'Sarah', 'Jember', '2000-03-07', 'P', 'Sukowono, Jember', '', 'sarbud@gmail.com', 11, 5, NULL, NULL, 1, 0, '$2y$10$d3IoncEfGS5mW9jUQqzszuvdhqxBPpI3lq7ZnjiBWZT/t0SY5RS2i', '852832985_1728131.jpg', 4, 0, 1572400525),
(10, 'Abdurrahman Saleh', 'Papua', '1999-12-22', 'L', 'Silo', '081223487', 'abdur.galer@gmail.com', 18, 4, 156, 40, 1, 1, '$2y$10$Vmo0j0ufQdeJSUyN8pt/Ler0hEhrDEx.aSgUwfhwdMDAHZlcloQTK', '852840951_1697261.jpg', 4, 0, 1572400562),
(13, 'Muhammad Maulana Fatahillah', 'Jember', '2000-03-03', 'L', 'Wirolegi, Jember', '08995400466', 'm.fatahillah@gmail.com', 8, 3, 165, 54, 1, 1, '$2y$10$d8WJt.kINRwwaSntVp26munbu5QwOJdEA0V11PouAWpFGxvkp1PxO', 'IMG-20191119-WA00032.jpg', 9, 0, 1572405181),
(14, 'Ertha Jessica', 'Jember', '2000-03-12', 'P', 'Kebonsari, Jember', '08995400466', 'erthajessicampret@gmail.com', 9, 6, NULL, NULL, 1, 1, '$2y$10$eT3wwGYmE.bg1v1eAuBuuuhSlYfZTPDVFQHl.G5JDxKZS1tXOtA4S', '852832985_172813.jpg', 4, 0, 1572497465),
(21, 'Adhien Noor', 'Jember', '2003-04-27', 'L', '', '', 'adhien.noor@gmail.com', 8, 2, NULL, NULL, 1, 0, '$2y$10$dbTvPytUk8bHwSxC0/oL/ew0Ci46s.N6915o.fNAjaEiaSuKD3x/u', '852832892_174197.jpg', 2, 0, 1572935866),
(22, 'Sadam', NULL, NULL, NULL, NULL, NULL, 'sadam@gmail.com', 8, 3, NULL, NULL, 1, 1, '$2y$10$7ukB43O6KXsv3cNPs/c6Eu/ot7SDBqrAjIMMFJ6sjITH7MnHEWAni', 'default.png', 2, 1, 1573018199),
(23, 'Arik', NULL, NULL, NULL, NULL, NULL, 'arik@gmail.com', 18, 2, NULL, NULL, 1, 0, '$2y$10$7mnQG50rb/ZNcT0FczPfaOSWwNPBW7J/eAIPH5iKhSwUoiF3d3dbu', 'default.png', 2, 1, 1573018376),
(24, 'Edi Purwanto', 'Sumenep', '1994-05-05', 'L', 'Ponpes Nuris 2 Jember', '', 'edipurwanto@gmail.com', 9, 8, NULL, NULL, 1, 1, '$2y$10$ZQfDwUqfHJGI2CWVKDjwm.Oo1qu0jMGj7uGMHh4uvZMCRCS9L8IVa', '852832892_1741971.jpg', 5, 0, 1573020834),
(25, 'Muhammad Alfin', 'Jember', '2021-04-06', 'L', '', '', 'alfinmuhammad@gmail.com', 8, 1, NULL, NULL, 1, 1, '$2y$10$RkulnvKD/gP75WWre.N5Qus708kILlir29EcTckqEYCpgYsnf0NCG', 'target_perdana.jpg', 4, 0, 1617075977),
(26, 'Isnan Hakim', NULL, NULL, NULL, NULL, NULL, 'hakimisnan@gmail.com', 8, 1, NULL, NULL, 1, 1, '$2y$10$rbkIS1iB.OpqoTQxj.K6Mu93Z3ErqKAHiDTWKRE67Drit6TgLuRwu', 'default.png', 2, 0, 1617076923),
(28, 'Intan Octavia', 'Jember', '2003-10-18', 'P', 'Jl. Letjen Suprapto', '', 'intanoctavia@gmail.com', 8, 3, 154, 45, 1, 1, '$2y$10$CNPZZpC8t5U.F3vsauygp.rwcXUYmZYdxA9TmcMDwSwVqv1veRBQy', 'default.png', 10, 1, 1617079479),
(29, 'Nelsa Jenny', NULL, NULL, NULL, NULL, NULL, 'nelsajenny@gmail.com', 9, 1, NULL, NULL, 1, 1, '$2y$10$6Gf/UdoWrlZxMD4jlmxNfeIJSWMRcps06wLlIH4TMYxMOuutrqwLm', 'default.png', 2, 0, 1617258612),
(30, 'Admin', 'Jember', '1990-03-03', 'L', 'Jember', '081353705343', 'admin@pdjember.org', 8, 8, 165, 74, 1, 1, '$2y$10$ocUcRzr5.j3dJUvWi27gmO6zaVkWWhxDaDTiFhqZVvLiHnjSpBZna', 'unnamed1.jpg', 1, 0, 1618977055);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `isi` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `date_posted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `judul`, `isi`, `image`, `id_operator`, `date_posted`) VALUES
(2, 'Coba Berita', 'jdalfjalfacnalndlfja', 'default.jpg', 14, 1572248553),
(4, 'UKT 2019', 'afaljlkdjafhdfajbdfiadhfh', '852830235_1737586.jpg', 7, 1573014965);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `from` varchar(256) NOT NULL,
  `to` varchar(256) NOT NULL,
  `subjek` text NOT NULL,
  `isi` text NOT NULL,
  `to_read` tinyint(1) NOT NULL DEFAULT 0,
  `fr_read` tinyint(1) DEFAULT 0,
  `fr_del` tinyint(4) DEFAULT 0,
  `to_del` tinyint(4) DEFAULT 0,
  `date_sent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `from`, `to`, `subjek`, `isi`, `to_read`, `fr_read`, `fr_del`, `to_del`, `date_sent`) VALUES
(1, 'admin@pdjember.org', 'afandi.0901@gmail.com', 'dHdEY1FncEIrUTZ0MmtxU3ZBZXRidz09', 'ZCs1MVF3eDM4WitkWmJjTlpzSXo0V29PaUVSWHM2WG5iU2tuRmJaRUhoeExPS1FqR1c3NlloS09UM0dkSW5zYTg1SDBnd1RmN0xMWjUvUmNmdHdzbWc9PQ==', 1, 1, 0, 0, 1619146914),
(2, 'afandi.0901@gmail.com', 'admin@pdjember.org', 'Qm9zamNEY2t0OHZ1S3JmZUVlczNVUT09', 'bnI4dVJuYlU3bnRyMkRhWm1mdDNjZE1pODM1aGFrK0JIM2ZtVDB5RFF6Yz0=', 1, 1, 0, 0, 1619147146),
(3, 'admin@pdjember.org', 'alfinmuhammad@gmail.com', 'YTdNSDhkUjB2bGx6Y3hSNzRaTXlQSTZZeEZidUxMclBiZHZNc3hlSU83ND0=', 'TjFmUmo2M3NBU01MbG5GajZWaStMNzBCMlJaa2c3WmlTb3hnRHlYNkxWRzhNNzFaOUY1UEpZVlRQKzljZTRYNQ==', 1, 1, 0, 0, 1619158071),
(6, 'admin@pdjember.org', 'sarbud@gmail.com', 'TEdYMkVhbWFTYWR6YldrWHpmNVRzdz09', 'TEdYMkVhbWFTYWR6YldrWHpmNVRzdz09', 0, 1, 0, 0, 1619422941);

-- --------------------------------------------------------

--
-- Table structure for table `tingkatan`
--

CREATE TABLE `tingkatan` (
  `id` int(11) NOT NULL,
  `tingkatan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tingkatan`
--

INSERT INTO `tingkatan` (`id`, `tingkatan`) VALUES
(1, 'Dasar 1'),
(2, 'Dasar 2'),
(3, 'Cakel'),
(4, 'Putih'),
(5, 'Putih Hijau'),
(6, 'Hijau'),
(7, 'Hijau Biru'),
(8, 'Biru'),
(9, 'Biru Merah'),
(10, 'Merah'),
(11, 'Merah Kuning'),
(12, 'Pendekar Muda'),
(13, 'Pendekar');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `id_ketua` int(11) NOT NULL,
  `jml_hari` int(2) NOT NULL,
  `st_aktif` tinyint(1) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `nama_unit`, `alamat`, `id_ketua`, `jml_hari`, `st_aktif`, `lat`, `long`) VALUES
(8, 'SMKN 2 Jember', 'Jl. Tawangmangu No. 59 Jember', 25, 42, 1, NULL, ''),
(9, 'UIN KHAS Jember', 'Jl. Jumat No 1, Jember', 14, 60, 1, NULL, ''),
(11, 'Politeknik Jember', 'Jl. Mastrip, Jember', 9, 0, 1, NULL, ''),
(12, 'SMPN 11 Jember', 'Jl. Letjen Suprapto', 0, 0, 1, NULL, ''),
(18, 'Silo', '', 10, 0, 1, NULL, ''),
(19, 'Taman Gading', 'Perumahan Taman Gading', 0, 0, 1, NULL, ''),
(20, 'SMP Negeri 1 Jenggawah', 'Jenggawah', 0, 0, 1, NULL, ''),
(21, 'Universitas Jember', 'Jl. Kalimantan Jember', 0, 0, 1, NULL, ''),
(22, 'Mumbulsari', 'Mumbulsari', 0, 0, 1, NULL, ''),
(24, 'SMP Negeri 13 Jember', 'Rembangan, Jember', 0, 0, 1, NULL, ''),
(25, 'Jumerto', 'Kelurahan Jumberto', 0, 0, 1, NULL, ''),
(26, 'Ajung', 'Sumuran, Ajung', 0, 0, 1, NULL, ''),
(27, 'Ambulu', 'Ambulu', 0, 0, 1, NULL, ''),
(28, 'Pakusari', 'Ds. Bunder, Pakusari, Jember', 0, 0, 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(22, 3, 5),
(23, 3, 2),
(24, 4, 2),
(25, 4, 6),
(26, 1, 7),
(27, 5, 2),
(28, 5, 7),
(31, 1, 3),
(32, 5, 3),
(33, 1, 8),
(34, 2, 8),
(35, 3, 8),
(36, 4, 8),
(37, 5, 8),
(38, 6, 2),
(39, 6, 6),
(40, 6, 8),
(43, 1, 5),
(44, 3, 6),
(46, 8, 2),
(47, 8, 14),
(48, 8, 8),
(49, 1, 4),
(50, 5, 4),
(52, 9, 16),
(53, 10, 17),
(54, 10, 2),
(55, 10, 8),
(56, 9, 2),
(57, 9, 8),
(58, 1, 16),
(59, 1, 17),
(60, 1, 14),
(61, 8, 18),
(62, 1, 18),
(63, 11, 19),
(64, 11, 2),
(65, 11, 8),
(66, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'personal'),
(3, 'data'),
(4, 'sekcab'),
(5, 'pelatih'),
(6, 'keanggotaan'),
(7, 'artikel'),
(8, 'pesan'),
(16, 'bendahara cabang'),
(17, 'bendahara unit'),
(18, 'UKT'),
(19, 'panitia');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Anggota'),
(3, 'Pelatih'),
(4, 'Ketua Unit'),
(5, 'Sekertaris Cabang'),
(6, 'Sekertaris Unit'),
(8, 'Penguji UKT'),
(9, 'Bendahara Cabang'),
(10, 'Bendahara Unit'),
(11, 'Panitia UKT');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(2, 2, 'My Profile', 'personal', 'fas fa-fw fa-user', 1),
(5, 1, 'Menu Management', 'admin/menu', 'fas fa-fw fa-tasks', 1),
(6, 1, 'Sub Menu Management', 'admin/submenu', 'fas fa-stream', 1),
(7, 3, 'Data Keseluruhan', 'data', 'fas fa-fw fa-database', 1),
(8, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(9, 3, 'Unit Latihan', 'data/unit', 'fas fa-map-marker-alt', 1),
(10, 3, 'Data Anggota', 'data/dataAnggota', 'fas fa-address-book', 1),
(12, 3, 'Data Calon Anggota', 'data/calonanggota', 'fas fa-fw fa-user-plus', 1),
(13, 6, 'Dashboard Unit', 'ketua', 'fas fa-fw fa-digital-tachograph	', 1),
(14, 6, 'Data Anggota Unit', 'ketua/dataAnggota', 'fas fa-users', 1),
(15, 6, 'Data Calon Anggota', 'ketua/calonanggota', 'fas fa-fw fa-user-plus', 1),
(16, 7, 'Berita', 'articles', 'fas fa-fw fa-newspaper', 1),
(18, 8, 'Kotak Masuk', 'pesan/inbox', 'fas fa-fw fa-inbox', 1),
(19, 8, 'Pesan Terkirim', 'pesan/outbox', 'fas fa-fw fa-paper-plane', 1),
(22, 5, 'Absensi Latihan', 'pelatih/absensi', 'fas fa-user-check', 1),
(23, 2, 'Rekap Nilai UKT', 'personal/nilai', 'fas fa-book-open', 1),
(24, 5, 'Data Fisik Siswa', 'pelatih/dataFisik', 'far fa-file-alt', 1),
(25, 4, 'Materi UKT', 'sekcab/materiUKT', 'fas fa-chalkboard-teacher', 1),
(32, 4, 'Penguji UKT', 'sekcab/pengujiUkt', 'fas fa-glasses', 1),
(33, 4, 'Surat', 'sekcab/surat', 'fas fa-mail-bulk', 1),
(35, 3, 'Prestasi', 'data/prestasi', 'fas fa-trophy', 1),
(36, 16, 'Pemasukan Cabang', 'bendahara/pemasukanCabang', 'fas fa-cash-register', 1),
(37, 17, 'Pemasukan Unit', 'bendahara/pemasukanUnit', 'fas fa-cash-register', 1),
(40, 1, 'Tahun Ajaran', 'admin/th_ajaran', 'fas fa-calendar-alt', 1),
(41, 16, 'Pengeluaran Cabang', 'bendahara/pengeluaranCabang', 'fas fa-money-bill-wave', 1),
(42, 17, 'Pengeluaran Unit', 'bendahara/pengeluaranUnit', 'fas fa-money-bill-wave', 1),
(43, 16, 'Laporan Keuangan', 'bendahara/lap_cabang', 'fas fa-book', 1),
(44, 17, 'Laporan Keuangan', 'bendahara/lap_unit', 'fas fa-book', 1),
(46, 18, 'Data Peserta', 'ukt/dataPeserta', 'fas fa-user', 1),
(47, 18, 'Penilaian UKT', 'ukt/penilaian', 'fas fa-pen-fancy', 1),
(48, 19, 'Data Peserta UKT', 'panitia/dataPeserta', 'fas fa-user', 1),
(49, 19, 'Kelengkapan Administrasi Peserta UKT', 'panitia/administrasi', 'fas fa-check-square', 1),
(50, 2, 'Profil Organisasi', 'personal/organisasi', 'fab fa-jedi-order', 1),
(51, 2, 'File Center', 'personal/file_center', 'far fa-file-pdf', 1),
(52, 4, 'Kenaikan Tingkat', 'ukt/kenaikanTingkat', 'fas fa-user-graduate', 1),
(53, 4, 'Nilai Ijazah', 'ukt/nilaiIjazah', 'fas fa-table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(3, 'afandi.guru.simdig@gmail.com', '07xfeQP9MVbbTbvWcPcNGXgYJYIy7YMDCnx6b9hCQ4M=', 1572327103);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`),
  ADD KEY `grade` (`id_tingkatan`),
  ADD KEY `unit` (`id_unit`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_ibfk_1` (`id_operator`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingkatan`
--
ALTER TABLE `tingkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `user_access_menu_ibfk_2` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tingkatan`
--
ALTER TABLE `tingkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `grade` FOREIGN KEY (`id_tingkatan`) REFERENCES `tingkatan` (`id`),
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`),
  ADD CONSTRAINT `unit` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_operator`) REFERENCES `anggota` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
