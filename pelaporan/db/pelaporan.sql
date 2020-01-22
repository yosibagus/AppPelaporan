-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2019 at 08:58 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_adm` int(11) NOT NULL,
  `nm_adm` varchar(50) NOT NULL,
  `email_adm` varchar(100) NOT NULL,
  `username_adm` varchar(20) NOT NULL,
  `password_adm` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_adm`, `nm_adm`, `email_adm`, `username_adm`, `password_adm`) VALUES
(1, 'Khairul Umam', 'umam.khairul2323@gmail.com', 'u', 'u');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `kd_kat` int(11) NOT NULL,
  `nm_kat` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kat`, `nm_kat`) VALUES
(1, 'Kerusakan'),
(2, 'Penambahan'),
(4, 'Contoh'),
(5, 'Contoh 2'),
(6, 'Contoh 3'),
(7, 'Contoh 4'),
(8, 'Contoh 5'),
(9, 'contoh 6'),
(11, 'contoh 77');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE IF NOT EXISTS `tb_laporan` (
  `kd_lap` int(11) NOT NULL,
  `kd_kat` int(11) NOT NULL,
  `foto_lap` varchar(100) NOT NULL,
  `lokasi_lap` varchar(100) NOT NULL,
  `ket_lap` text NOT NULL,
  `ktp_lap` varchar(30) NOT NULL,
  `nm_lap` varchar(50) NOT NULL,
  `notelp_lap` varchar(12) NOT NULL,
  `tgl_lap` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`kd_lap`, `kd_kat`, `foto_lap`, `lokasi_lap`, `ket_lap`, `ktp_lap`, `nm_lap`, `notelp_lap`, `tgl_lap`) VALUES
(1, 4, 'logo.jpg', 'Bangselok', 'Rusak', '098773888', 'Imron', '085222345882', '2019-11-24'),
(3, 2, 'gambar1573106682.png', 'Pajagalan', 'Tambah', '873839939', 'Umam', '082333456882', '2019-11-05'),
(4, 4, 'gambar1573108049.png', 'Pangarangan', 'Contohhh', '878793990', 'Indi', '0927872787', '2019-11-28');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `kd_lap` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
