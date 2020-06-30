-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 02:25 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_appbimbel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_lombaartikel`
--

CREATE TABLE `tb_lombaartikel` (
  `idLomba` int(6) NOT NULL,
  `temaArtikel` varchar(150) NOT NULL,
  `minimalKata` varchar(15) NOT NULL,
  `batasPengumpulan` date NOT NULL,
  `tglDibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_lombaartikel`
--

INSERT INTO `tb_lombaartikel` (`idLomba`, `temaArtikel`, `minimalKata`, `batasPengumpulan`, `tglDibuat`) VALUES
(1, 'Kandungan penting dalam buah nangka', '>= 350 kata', '2019-09-30', '2019-09-24 10:31:31'),
(2, 'Faktor yang mempengaruhi penurunan emas', '+ 550 kata', '2019-10-04', '2019-09-24 12:14:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_lombaartikel`
--
ALTER TABLE `tb_lombaartikel`
  ADD PRIMARY KEY (`idLomba`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_lombaartikel`
--
ALTER TABLE `tb_lombaartikel`
  MODIFY `idLomba` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
