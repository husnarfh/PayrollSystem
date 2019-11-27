-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2019 at 11:18 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `namalengkap` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `namalengkap`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Nadiem Makarim');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kode_golongan` varchar(3) NOT NULL,
  `nama_golongan` varchar(10) NOT NULL,
  `tunjangan_suami_istri` int(10) NOT NULL,
  `tunjangan_anak` int(10) NOT NULL,
  `uang_makan` int(10) NOT NULL,
  `uang_lembur` int(10) NOT NULL,
  `askes` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kode_golongan`, `nama_golongan`, `tunjangan_suami_istri`, `tunjangan_anak`, `uang_makan`, `uang_lembur`, `askes`) VALUES
('G01', 'Atas', 7000000, 2000000, 500000, 250000, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `kode_jabatan` varchar(3) NOT NULL,
  `nama_jabatan` varchar(40) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `tunjangan_jabatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`, `gaji_pokok`, `tunjangan_jabatan`) VALUES
('01', 'Direktur', 5000000, 7000000),
('02', 'Manager', 4000000, 5000000),
('04', 'Staff', 3000000, 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `master_gaji`
--

CREATE TABLE `master_gaji` (
  `bulan` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `masuk` int(5) NOT NULL,
  `sakit` int(5) NOT NULL,
  `izin` int(5) NOT NULL,
  `alpha` int(5) NOT NULL,
  `lembur` int(5) NOT NULL,
  `potongan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_gaji`
--

INSERT INTO `master_gaji` (`bulan`, `nip`, `masuk`, `sakit`, `izin`, `alpha`, `lembur`, `potongan`) VALUES
('112019', '14045', 1, 0, 0, 0, 1, 0),
('112019', '982000', 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pegawai` varchar(40) NOT NULL,
  `kode_jabatan` varchar(3) NOT NULL,
  `kode_golongan` varchar(3) NOT NULL,
  `status` varchar(15) NOT NULL,
  `jumlah_anak` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `password`, `nama_pegawai`, `kode_jabatan`, `kode_golongan`, `status`, `jumlah_anak`) VALUES
('14045', '312f91285e048e09bb4aefef23627994', 'Riana', '01', 'G01', 'belum menikah', 0),
('982000', 'fa23517aa1adfaab707494340009a330', 'Husna Nurarifah', '02', 'G01', 'Menikah', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kode_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `master_gaji`
--
ALTER TABLE `master_gaji`
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kode_jabatan` (`kode_jabatan`),
  ADD KEY `kode_golongan` (`kode_golongan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_gaji`
--
ALTER TABLE `master_gaji`
  ADD CONSTRAINT `master_gaji_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `jabatan` (`kode_jabatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`kode_golongan`) REFERENCES `golongan` (`kode_golongan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
