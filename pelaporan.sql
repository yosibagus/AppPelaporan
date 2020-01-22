-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 12:33 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelaporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_adm` int(11) NOT NULL,
  `nm_adm` varchar(50) NOT NULL,
  `email_adm` varchar(100) NOT NULL,
  `username_adm` varchar(20) NOT NULL,
  `password_adm` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_adm`, `nm_adm`, `email_adm`, `username_adm`, `password_adm`) VALUES
(1, 'Khairul Umam', 'umam.khairul2323@gmail.com', 'u', 'u'),
(2, 'Yani Nur Hasanah', 'yaninurhasanah12@gmail.com', 'ana', 'ana'),
(3, 'ana', 'ana@gmail.com', 'ana', 'ana'),
(4, 'faruq betang alas', 'betang@gmai.com', 'far', 'uq');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kat` int(11) NOT NULL,
  `nm_kat` varchar(50) NOT NULL,
  `img_kat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kat`, `nm_kat`, `img_kat`) VALUES
(1, 'Jembatan', 'jembatan1.png'),
(2, 'Gorong-gorong', 'gorong.png'),
(9, 'Jalan', 'jalan1.png'),
(10, 'Sungai', 'sungai.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `kd_lap` int(11) NOT NULL,
  `kd_kat` int(11) NOT NULL,
  `foto_lap` varchar(255) NOT NULL,
  `lokasi_lap` varchar(100) NOT NULL,
  `ket_lap` varchar(200) NOT NULL,
  `tgl_lap` varchar(50) NOT NULL,
  `status_lap` varchar(20) NOT NULL,
  `ktp_lap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`kd_lap`, `kd_kat`, `foto_lap`, `lokasi_lap`, `ket_lap`, `tgl_lap`, `status_lap`, `ktp_lap`) VALUES
(34, 1, '../assets/uploads/210319712042832.jpg', 'Jl. Raya Batuan no.54 Gang Melati', 'Direfisi Bos ...', '22-01-2020 07:15:59', 'Ditolak', '2103197120'),
(35, 2, '../assets/uploads/21031971209356.jpg', 'Jl. Batuan Raya Sebeleh Akns ', 'Banjir ', '22-01-2020 08:27:04', 'Selesai', '2103197120'),
(36, 10, '../assets/uploads/2103197120220.jpg', 'Babbalan Jembatan Cinta Kita ', 'Banyak Sampah Sehingga Terjadi Gejolak Asmara Cinta', '22-01-2020 08:48:47', 'Dalam Proses', '2103197120'),
(38, 1, '../assets/uploads/210319712042627.jpg', 'Jl Mulawarman Sumenep Kalianget', 'Hampir Roboh Karena Terlalu Sesak Atas Rindu Dan Kenangan', '22-01-2020 09:37:59', 'Diterima', '2103197120'),
(39, 2, '../assets/uploads/210319712075583.jpg', 'SDN Kalianget Timur 10 Mulawarman', 'Di Banjiri Oleh Kenangan', '22-01-2020 09:44:08', 'Diterima', '2103197120');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `ktp_lap` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `scan_ktp` varchar(255) NOT NULL,
  `nm_lap` varchar(100) NOT NULL,
  `notelp_lap` varchar(15) NOT NULL,
  `status_akun` varchar(15) NOT NULL,
  `tgl_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`ktp_lap`, `password`, `scan_ktp`, `nm_lap`, `notelp_lap`, `status_akun`, `tgl_created`) VALUES
('2102197555', 'bagus123', '../assets/uploads/ktp/210120-114417.jpg', 'Bagus Sadar', '082330723223', 'Active', '22-01-2020 18:18:00'),
('2103197120', 'naruto', '../assets/uploads/ktp/210120-124508.jpg', 'Naruto', '0823546454645', 'Active', '22-01-2020 18:18:01'),
('2103197121', 'yosi123', 'uploads/ktpku.jpg', 'Yosi Bagus Sadar Rasuli', '082330723223', 'Blocked', '22-01-2020 18:18:02'),
('21031971250', 'yosi123', '../assets/uploads/ktp/220120-034702.jpg', 'Agus', '0823378787878', 'Pending', '22-01-2020 18:18:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kat`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`kd_lap`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`ktp_lap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `kd_lap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
