-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2016 at 12:38 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `bobot` int(11) NOT NULL,
  `bobot_akhir` double NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `bobot_akhir`, `jenis`) VALUES
(1, 'Harga', 5, 0, 'cost'),
(2, 'Kwalitas', 4, 0, 'benefit'),
(3, 'Fitur', 5, 0, 'benefit'),
(4, 'Populer', 3, 0, 'benefit'),
(5, 'Purna Jual', 2, 0, 'benefit'),
(6, 'Keawetan', 1, 0, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_warung` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_kriteria`, `id_warung`, `nilai`) VALUES
(16, 1, 1, 3500),
(17, 1, 2, 4500),
(18, 1, 3, 4000),
(19, 1, 4, 4000),
(20, 2, 1, 70),
(21, 2, 2, 90),
(22, 2, 3, 80),
(23, 2, 4, 70),
(24, 3, 1, 10),
(25, 3, 2, 10),
(26, 3, 3, 9),
(27, 3, 4, 8),
(28, 4, 1, 80),
(29, 4, 2, 60),
(30, 4, 3, 90),
(31, 4, 4, 50),
(32, 5, 1, 3000),
(33, 5, 2, 2500),
(34, 5, 3, 2000),
(35, 5, 4, 1500),
(36, 6, 1, 36),
(37, 6, 2, 48),
(38, 6, 3, 48),
(39, 6, 4, 60);

-- --------------------------------------------------------

--
-- Table structure for table `warung`
--

CREATE TABLE `warung` (
  `id_warung` int(11) NOT NULL,
  `nama_warung` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warung`
--

INSERT INTO `warung` (`id_warung`, `nama_warung`) VALUES
(1, 'Galaxy'),
(2, 'Iphone'),
(3, 'BB'),
(4, 'Lumia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `warung`
--
ALTER TABLE `warung`
  ADD PRIMARY KEY (`id_warung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `warung`
--
ALTER TABLE `warung`
  MODIFY `id_warung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
