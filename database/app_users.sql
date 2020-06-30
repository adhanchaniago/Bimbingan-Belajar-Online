-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2019 at 09:43 PM
-- Server version: 5.7.27-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appsbili_igni473`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `userid` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `tb_pengguna_penggunaid` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`userid`, `username`, `password`, `tb_pengguna_penggunaid`) VALUES
('u1', 'Rian', 'cb2b28afc2cc836b33eb7ed86f99e65a', '002'),
('u2', 'Andi', 'ce0e5bf55e4f71749eade7a8b95c4e46', '001'),
('u3', 'suadmin', '02764b025f2d7f90b8d7bc51c6904d2a', '005'),
('u4', 'Winda', 'aed2aec41bfd7ddb55b21f3ce206c66b', '003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `IDCABANG` (`tb_pengguna_penggunaid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_users`
--
ALTER TABLE `app_users`
  ADD CONSTRAINT `app_users_ibfk_1` FOREIGN KEY (`tb_pengguna_penggunaid`) REFERENCES `tb_pengguna` (`penggunaId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
