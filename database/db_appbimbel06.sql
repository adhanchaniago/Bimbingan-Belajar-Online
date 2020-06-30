-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2019 at 06:08 PM
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
-- Table structure for table `app_kritiksaran`
--

CREATE TABLE `app_kritiksaran` (
  `id_kritiksaran` int(10) UNSIGNED NOT NULL,
  `tb_pengguna_penggunaId` varchar(11) NOT NULL,
  `isikritiksaran` varchar(400) DEFAULT NULL,
  `setatus` text NOT NULL,
  `tglinsert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_kritiksaran`
--

INSERT INTO `app_kritiksaran` (`id_kritiksaran`, `tb_pengguna_penggunaId`, `isikritiksaran`, `setatus`, `tglinsert`) VALUES
(1, 'RG19000002', 'tes 1', 'Arsip', '2019-09-17 06:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `app_kursus`
--

CREATE TABLE `app_kursus` (
  `idapp_kursus` varchar(11) NOT NULL,
  `noInv` varchar(11) NOT NULL,
  `tb_kategori_kategoriId` int(10) UNSIGNED NOT NULL,
  `tb_jumPertemuan_idjumPertemuan` int(10) UNSIGNED NOT NULL,
  `app_users_userid` varchar(10) NOT NULL,
  `idSiswa` varchar(30) DEFAULT NULL,
  `tglDaftarKursus` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tempatKursus` varchar(70) DEFAULT NULL,
  `keterangan` varchar(40) DEFAULT NULL,
  `TOTAL_ALL` float NOT NULL,
  `jumlahTelahBayar` float NOT NULL,
  `tglBayar` date NOT NULL,
  `metodebayar` varchar(10) NOT NULL,
  `ratings` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_kursus`
--

INSERT INTO `app_kursus` (`idapp_kursus`, `noInv`, `tb_kategori_kategoriId`, `tb_jumPertemuan_idjumPertemuan`, `app_users_userid`, `idSiswa`, `tglDaftarKursus`, `tempatKursus`, `keterangan`, `TOTAL_ALL`, `jumlahTelahBayar`, `tglBayar`, `metodebayar`, `ratings`) VALUES
('0001', '', 2, 1, '', '001', '2019-09-26 05:34:47', 'ponorogo', 'kursus matematika dasar ', 360000, 0, '0000-00-00', '', 0),
('0002', '', 1, 2, '', '001', '2019-09-26 05:34:47', 'ponorogo', 'Kursus Fisika Dasar', 240000, 0, '0000-00-00', '', 0),
('KB19000009', '', 0, 0, '', 'RG19000001', '2019-09-25 14:02:48', 'PONOROGO', '-', 220000, 0, '0000-00-00', '', 0),
('KB19000010', '', 0, 0, '', 'RG19000001', '2019-09-25 14:21:58', 'PONOROGO', NULL, 330000, 0, '0000-00-00', '', 0),
('KB19000011', '', 0, 0, '', '003', '2019-09-25 14:26:06', 'PONOROGO', NULL, 560000, 0, '0000-00-00', '', 0),
('KB19000012', '', 0, 0, '', '004', '2019-09-28 09:19:45', 'pacitan', NULL, 540000, 0, '0000-00-00', '', 5),
('KB19000013', 'IN19000001', 0, 0, '', '003', '2019-09-28 09:19:45', 'madiun', NULL, 350000, 0, '0000-00-00', '', 4),
('KB19000015', '', 1, 0, '', '004', '2019-09-22 18:38:32', 'pacitan', 'tes keterangan', 0, 0, '0000-00-00', '', 0),
('KB19000016', '', 1, 0, '', '003', '2019-09-28 09:19:45', NULL, NULL, 0, 0, '0000-00-00', '', 3),
('KB19000017', 'in0001', 1, 0, '', '004', '2019-09-28 13:28:40', 'jl usong 5', NULL, 0, 0, '0000-00-00', '', 4),
('KB19000019', '', 1, 0, '', '006', '2019-09-24 03:29:55', NULL, NULL, 0, 0, '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_rate`
--

CREATE TABLE `app_rate` (
  `idapp_rate` varchar(7) NOT NULL,
  `ratting` int(10) UNSIGNED DEFAULT NULL,
  `pemberiRate` varchar(15) DEFAULT NULL,
  `penerimaRate` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('u3', 'admin', '21232f297a57a5a743894a0e4a801fc3', '005'),
('u4', 'Winda', 'aed2aec41bfd7ddb55b21f3ce206c66b', '003');

-- --------------------------------------------------------

--
-- Table structure for table `detailcarier`
--

CREATE TABLE `detailcarier` (
  `idUnix` varchar(20) NOT NULL,
  `pengguna_idPengguna` varchar(11) NOT NULL,
  `namaBidangStudi` varchar(225) NOT NULL,
  `kategoriStudi` varchar(50) NOT NULL,
  `jenjang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailcarier`
--

INSERT INTO `detailcarier` (`idUnix`, `pengguna_idPengguna`, `namaBidangStudi`, `kategoriStudi`, `jenjang`) VALUES
('5d77da0c6c744', 'RC19000002', 'matematika (SMA - IPA)', 'IPA', '10-11'),
('5d77da0c6deb4', 'RC19000002', 'matematika (SD)', 'SD', '4-6'),
('5d77dec6c6991', 'RC19000004', 'matematika (SD)', 'SD', '1-3'),
('5d77dec6c7549', 'RC19000004', 'matematika (SMP)', 'SMP', '7-8'),
('5d77e1ae12ca9', 'RC19000005', 'matematika (SMA - IPA)', 'IPA', '10-11'),
('5d77e1ae14801', 'RC19000005', 'matematika (SD)', 'SD', '4-6'),
('5d77e2c17b77b', 'RC19000006', 'matematika (SMA - IPA)', 'IPA', '10-11'),
('5d77e2c17c71b', 'RC19000006', 'matematika (SD)', 'SD', '4-6'),
('5d787b5f1adaf', 'RC19000007', 'matematika (SMA - IPA)', 'IPA', '10-11'),
('5d787b5f1c907', 'RC19000007', 'matematika (SD)', 'SD', '4-6');

-- --------------------------------------------------------

--
-- Table structure for table `detailjadwal`
--

CREATE TABLE `detailjadwal` (
  `idUnix` varchar(20) NOT NULL,
  `kodeKursus` varchar(11) NOT NULL,
  `idBidangStudi_bidangStudi` int(10) NOT NULL,
  `idTentor_detailKursus` varchar(11) NOT NULL,
  `idSiswa_appKursus` varchar(11) NOT NULL,
  `hari` varchar(7) NOT NULL,
  `jam` time NOT NULL,
  `tglKursus` date NOT NULL,
  `tglinsert` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailjadwal`
--

INSERT INTO `detailjadwal` (`idUnix`, `kodeKursus`, `idBidangStudi_bidangStudi`, `idTentor_detailKursus`, `idSiswa_appKursus`, `hari`, `jam`, `tglKursus`, `tglinsert`) VALUES
('5d715b66', 'KB19000017', 1, '001', '004', 'rabu', '06:11:04', '0000-00-00', '2019-09-28 03:10:20'),
('jhsd78687', 'KB19000012', 2, '002', '004', 'kamis', '07:00:00', '0000-00-00', '2019-09-19 11:00:00'),
('jshd765sdhj', 'KB19000013', 1, '001', '003', 'senin', '09:00:00', '0000-00-00', '2019-04-27 17:07:34'),
('uisye76867', 'KB19000016', 6, '001', '003', 'selasa', '07:04:07', '0000-00-00', '2019-09-28 11:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `detailkursus`
--

CREATE TABLE `detailkursus` (
  `idUnix` varchar(20) NOT NULL,
  `subTotal` float NOT NULL,
  `kodeKursus` varchar(10) NOT NULL,
  `idBidangStudi` int(10) NOT NULL,
  `jumlahSesi` int(2) NOT NULL,
  `perSesi` float NOT NULL,
  `idTentor` varchar(30) NOT NULL,
  `tglKursus` date NOT NULL,
  `waktuKursus` varchar(5) NOT NULL,
  `durasiKursus` float NOT NULL,
  `statusKursus` varchar(50) NOT NULL,
  `pertemuanKe` float NOT NULL,
  `tglSelesai` date NOT NULL,
  `KETERANGANTRANSAKSI` varchar(15) NOT NULL,
  `keteranganKursus` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailkursus`
--

INSERT INTO `detailkursus` (`idUnix`, `subTotal`, `kodeKursus`, `idBidangStudi`, `jumlahSesi`, `perSesi`, `idTentor`, `tglKursus`, `waktuKursus`, `durasiKursus`, `statusKursus`, `pertemuanKe`, `tglSelesai`, `KETERANGANTRANSAKSI`, `keteranganKursus`) VALUES
('5d715b6', 240000, 'KB19000015', 2, 4, 60000, '002', '0000-00-00', '', 90, 'tidak aktif', 0, '0000-00-00', '', ''),
('5d715cd1ea3a8', 275000, 'KB19000016', 4, 5, 55000, '002', '0000-00-00', '', 90, 'aktif', 0, '0000-00-00', '', ''),
('5d715cd208664', 385000, 'KB19000016', 6, 7, 55000, '001', '0000-00-00', '', 0, 'aktif', 0, '0000-00-00', '', ''),
('5d715ddc3bb96', 420000, 'KB19000017', 5, 7, 60000, '001', '0000-00-00', '', 0, 'aktif', 0, '0000-00-00', '', ''),
('5d715ddc3cb37', 360000, 'KB19000017', 2, 6, 60000, '002', '0000-00-00', '', 0, '', 0, '0000-00-00', '', ''),
('5d715e76f0d71', 420000, 'KB19000019', 2, 7, 60000, '001', '0000-00-00', '', 90, 'aktif', 0, '0000-00-00', '', ''),
('5d7160bc6d8e3', 250000, 'KB19000020', 1, 5, 50000, '', '0000-00-00', '', 0, 'mendaftar', 0, '0000-00-00', '', ''),
('5d71611062c3d', 420000, 'KB19000021', 3, 6, 70000, '', '0000-00-00', '', 0, '', 0, '0000-00-00', '', ''),
('5d716551acd05', 360000, '0002', 2, 6, 60000, '', '0000-00-00', '', 90, 'aktif', 0, '0000-00-00', '', ''),
('5d75d25987551', 240000, '0001', 2, 4, 60000, '', '0000-00-00', '', 90, 'aktif', 0, '0000-00-00', '', ''),
('5d75d48a437a9', 300000, 'KB19000028', 1, 6, 50000, '-', '0000-00-00', '-', 90, 'mendaftar', 0, '0000-00-00', '', ''),
('5d8b7388d7ee9', 220000, 'KB19000009', 6, 4, 55000, '-', '0000-00-00', '-', 90, 'mendaftar', 0, '0000-00-00', '', ''),
('5d8b780661b4e', 330000, 'KB19000010', 4, 6, 55000, '-', '0000-00-00', '-', 90, 'tuntas', 0, '0000-00-00', '-', '-'),
('5d8b78fe63f2f', 560000, 'KB19000011', 3, 8, 70000, '-', '0000-00-00', '-', 90, 'mendaftar', 0, '0000-00-00', 'Belum ', '-'),
('5d8b795d78906', 540000, 'KB19000012', 2, 9, 60000, '002', '0000-00-00', '-', 90, 'aktif', 0, '0000-00-00', 'Belum Dibayar', '-'),
('5d8b82411f00c', 350000, 'KB19000013', 1, 7, 50000, '001', '0000-00-00', '-', 90, 'aktif', 0, '0000-00-00', 'Belum Dibayar', '-');

-- --------------------------------------------------------

--
-- Table structure for table `detaillombaartikel`
--

CREATE TABLE `detaillombaartikel` (
  `idUnix` varchar(5) NOT NULL,
  `kodePengguna` varchar(11) NOT NULL,
  `idLomba_tb_lomba` int(6) NOT NULL,
  `file` varchar(150) NOT NULL,
  `tglUpload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detaillombaartikel`
--

INSERT INTO `detaillombaartikel` (`idUnix`, `kodePengguna`, `idLomba_tb_lomba`, `file`, `tglUpload`) VALUES
('has7s', '002', 1, '-', '2019-09-24 10:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `detailpembayaran`
--

CREATE TABLE `detailpembayaran` (
  `idUnixs` varchar(7) NOT NULL,
  `kodeKursus_app_kursus` varchar(11) NOT NULL,
  `namaSiswa` varchar(50) NOT NULL,
  `jumlahBayar` float NOT NULL,
  `metodebayar` varchar(7) NOT NULL,
  `noRek` varchar(20) NOT NULL,
  `tglBayar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailpembayaran`
--

INSERT INTO `detailpembayaran` (`idUnixs`, `kodeKursus_app_kursus`, `namaSiswa`, `jumlahBayar`, `metodebayar`, `noRek`, `tglBayar`) VALUES
('5d8c958', 'KB19000016', '', 6500000, 'CASH', '0', '2019-09-26 10:40:01'),
('5d8c95b', 'KB19000019', '', 530000, 'CASH', '0', '2019-09-27 10:41:02'),
('5d8c963', 'KB19000016', '', 955000, 'CASH', '0', '2019-09-28 10:43:05'),
('5d8c975', '0001', '', 870000, 'TF', '654651321654', '2019-09-26 10:47:55'),
('5d8caa1', '0001', 'Andi', 256000, 'TF', '2316546465', '2019-09-26 12:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `detailperkembangan`
--

CREATE TABLE `detailperkembangan` (
  `idDperkembangan` varchar(4) NOT NULL,
  `kodeKursus_detailKursus` varchar(10) NOT NULL,
  `bidangStudi` int(2) NOT NULL,
  `indikator` int(2) NOT NULL,
  `nilai` int(2) NOT NULL,
  `tglinserts` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailperkembangan`
--

INSERT INTO `detailperkembangan` (`idDperkembangan`, `kodeKursus_detailKursus`, `bidangStudi`, `indikator`, `nilai`, `tglinserts`) VALUES
('hjj4', 'KB19000015', 0, 1, 70, '2019-09-22'),
('hjk6', 'KB19000016', 4, 2, 75, '2019-09-22'),
('hjk7', 'KB19000016', 6, 2, 68, '2019-09-25'),
('hjk9', 'KB19000016', 6, 1, 79, '2019-09-25'),
('jUi3', 'KB19000016', 4, 1, 65, '2019-09-23'),
('nnu1', 'KB19000015', 0, 2, 77, '2019-09-23'),
('uj2', 'KB19000019', 0, 1, 80, '2019-09-24'),
('uki3', 'KB19000019', 0, 2, 70, '2019-09-24');

-- --------------------------------------------------------

--
-- Table structure for table `detailriwayatabsen`
--

CREATE TABLE `detailriwayatabsen` (
  `idUnixRiwayat` varchar(3) NOT NULL,
  `kodeKursus` varchar(10) NOT NULL,
  `idBidangstudi` varchar(10) NOT NULL,
  `tgldanWaktuKursus` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailriwayatabsen`
--

INSERT INTO `detailriwayatabsen` (`idUnixRiwayat`, `kodeKursus`, `idBidangstudi`, `tgldanWaktuKursus`) VALUES
('1ha', 'KB19000016', '6', '2019-09-22 00:30:19'),
('1hf', 'KB19000015', '2', '2019-09-24 03:12:18'),
('1hj', 'KB19000016', '4', '2019-09-21 19:11:06'),
('e56', 'KB19000019', '2', '2019-09-24 03:12:18'),
('u2j', 'KB19000016', '6', '2019-09-21 22:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `num_unallowed`
--

CREATE TABLE `num_unallowed` (
  `id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_unallowed`
--

INSERT INTO `num_unallowed` (`id`, `nomor`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pages`
--

CREATE TABLE `tabel_pages` (
  `pages_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(120) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_pages`
--

INSERT INTO `tabel_pages` (`pages_id`, `judul`, `judul_seo`, `content`) VALUES
(4, 'konfirmasi pembayaran', 'konfirmasi-pembayaran', '<p>setelah anda melakukan transfer sejumlah yang telah kami sampaikan maka silahkan konfirmasi pembayaran anda</p>\r\n\r\n<ul>\r\n	<li>via sms ke no 082121473036</li>\r\n	<li>via BBM&nbsp;</li>\r\n	<li>via email nuris.akbar@gmail.com</li>\r\n</ul>\r\n'),
(5, 'cara pemesanan', 'cara-pemesanan', '<p><strong>anda bisa memesan kepada kami melalui 2 cara :</strong></p>\r\n\r\n<ul>\r\n	<li>dari website<br />\r\n	silahkan pilih product yang ingin anda beli dan ikuti panduan transaksinya</li>\r\n	<li>via sms/ telpon<br />\r\n	silahkan pilih dan sms kan nama product yang anda pilih, kami akan menginformasikan biaya yang harus anda transafer</li>\r\n</ul>\r\n'),
(6, 'testimoni pelanggan', 'testimoni-pelanggan', '<p>testimoni&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n'),
(7, 'hubungi kami', 'hubungi-kami', '<p>hubungi kami text&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n'),
(8, 'Konfirmasi Pembayaran', 'konfirmasi-pembayaran', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_abouts`
--

CREATE TABLE `tb_abouts` (
  `id` int(3) NOT NULL,
  `pendahuluan` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_abouts`
--

INSERT INTO `tb_abouts` (`id`, `pendahuluan`, `visi`, `misi`, `video`) VALUES
(5, 'tess', 'tes visi', 'tes misi', 'tes url');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidangstudi`
--

CREATE TABLE `tb_bidangstudi` (
  `id_bidangStudi` int(10) UNSIGNED NOT NULL,
  `namaBidangStudi` varchar(225) DEFAULT NULL,
  `kategoriStudi` varchar(50) NOT NULL,
  `jenjang` varchar(200) NOT NULL,
  `hargaperSesi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bidangstudi`
--

INSERT INTO `tb_bidangstudi` (`id_bidangStudi`, `namaBidangStudi`, `kategoriStudi`, `jenjang`, `hargaperSesi`) VALUES
(1, 'matematika (SD)', 'SD', '1-3', 50000),
(2, 'matematika (SMP)', 'SMP', '7-8', 60000),
(3, 'matematika (SMA - IPA)', 'IPA', '10-11', 70000),
(4, 'matematika (SD)', 'SD', '4-6', 55000),
(5, 'iqra', 'QURAN', '<9', 60000),
(6, 'Tahsin Al Qur\'an', 'QURAN', '>10', 55000),
(7, 'Matematika (SMA - IPS)', 'IPS', '10-11', 70000),
(15, 'tess', '-', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gokuis`
--

CREATE TABLE `tb_gokuis` (
  `id_gokuis` int(10) UNSIGNED NOT NULL,
  `tb_kuis_id_kuis` int(10) UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `jawab_a` varchar(20) DEFAULT NULL,
  `jawab_b` varchar(20) DEFAULT NULL,
  `jawab_c` varchar(20) DEFAULT NULL,
  `jawab_d` varchar(20) DEFAULT NULL,
  `jawabanBenar` varchar(5) DEFAULT NULL,
  `Nomor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_gokuis`
--

INSERT INTO `tb_gokuis` (`id_gokuis`, `tb_kuis_id_kuis`, `pertanyaan`, `jawab_a`, `jawab_b`, `jawab_c`, `jawab_d`, `jawabanBenar`, `Nomor`) VALUES
(1, 1, 'Apa yang Anda buka pertama kali ketika makan?', 'Mata', 'Mulut', 'Pintu', 'Jendela', 'a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_icons`
--

CREATE TABLE `tb_icons` (
  `idIcons` int(4) NOT NULL,
  `namaIcon` varchar(200) NOT NULL,
  `src` varchar(255) NOT NULL,
  `folProjekId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_icons`
--

INSERT INTO `tb_icons` (`idIcons`, `namaIcon`, `src`, `folProjekId`) VALUES
(1, '1 agreement', '1-agreement.png', 1),
(2, '2 certificate', '2-certificate.png', 1),
(3, '3 contract', '3-contract.png', 1),
(4, '4 elementary', '4-elementary.png', 1),
(5, '5 list star', '5-list-star.png', 1),
(6, '6 list view', '6-list-view.png', 1),
(7, '7 success', '7-success.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_indikator`
--

CREATE TABLE `tb_indikator` (
  `idIndikator` int(2) NOT NULL,
  `namaIndikator` varchar(150) NOT NULL,
  `kategoriIndikator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_indikator`
--

INSERT INTO `tb_indikator` (`idIndikator`, `namaIndikator`, `kategoriIndikator`) VALUES
(1, 'Akhlak terhadap ilmu', 'Akhlak'),
(2, 'Kepribadian di kelas', 'Akhlak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jumpertemuan`
--

CREATE TABLE `tb_jumpertemuan` (
  `idjumPertemuan` int(10) UNSIGNED NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `jumlah` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jumpertemuan`
--

INSERT INTO `tb_jumpertemuan` (`idjumPertemuan`, `nama`, `jumlah`) VALUES
(1, 'Dasar', 15),
(2, 'Lanjutan', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kabupaten`
--

CREATE TABLE `tb_kabupaten` (
  `IDKOTA` int(4) NOT NULL,
  `NAMAKOTA` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_kabupaten`
--

INSERT INTO `tb_kabupaten` (`IDKOTA`, `NAMAKOTA`) VALUES
(1101, 'KAB. SIMEULUE'),
(1102, 'KAB. ACEH SINGKIL'),
(1103, 'KAB. ACEH SELATAN'),
(1104, 'KAB. ACEH TENGGARA'),
(1105, 'KAB. ACEH TIMUR'),
(1106, 'KAB. ACEH TENGAH'),
(1107, 'KAB. ACEH BARAT'),
(1108, 'KAB. ACEH BESAR'),
(1109, 'KAB. PIDIE'),
(1110, 'KAB. BIREUEN'),
(1111, 'KAB. ACEH UTARA'),
(1112, 'KAB. ACEH BARAT DAYA'),
(1113, 'KAB. GAYO LUES'),
(1114, 'KAB. ACEH TAMIANG'),
(1115, 'KAB. NAGAN RAYA'),
(1116, 'KAB. ACEH JAYA'),
(1117, 'KAB. BENER MERIAH'),
(1118, 'KAB. PIDIE JAYA'),
(1171, 'KOTA BANDA ACEH'),
(1172, 'KOTA SABANG'),
(1173, 'KOTA LANGSA'),
(1174, 'KOTA LHOKSEUMAWE'),
(1175, 'KOTA SUBULUSSALAM'),
(1201, 'KAB. NIAS'),
(1202, 'KAB. MANDAILING NATAL'),
(1203, 'KAB. TAPANULI SELATAN'),
(1204, 'KAB. TAPANULI TENGAH'),
(1205, 'KAB. TAPANULI UTARA'),
(1206, 'KAB. TOBA SAMOSIR'),
(1207, 'KAB. LABUHAN BATU'),
(1208, 'KAB. ASAHAN'),
(1209, 'KAB. SIMALUNGUN'),
(1210, 'KAB. DAIRI'),
(1211, 'KAB. KARO'),
(1212, 'KAB. DELI SERDANG'),
(1213, 'KAB. LANGKAT'),
(1214, 'KAB. NIAS SELATAN'),
(1215, 'KAB. HUMBANG HASUNDUTAN'),
(1216, 'KAB. PAKPAK BHARAT'),
(1217, 'KAB. SAMOSIR'),
(1218, 'KAB. SERDANG BEDAGAI'),
(1219, 'KAB. BATU BARA'),
(1220, 'KAB. PADANG LAWAS UTARA'),
(1221, 'KAB. PADANG LAWAS'),
(1222, 'KAB. LABUHAN BATU SELATAN'),
(1223, 'KAB. LABUHAN BATU UTARA'),
(1224, 'KAB. NIAS UTARA'),
(1225, 'KAB. NIAS BARAT'),
(1271, 'KOTA SIBOLGA'),
(1272, 'KOTA TANJUNG BALAI'),
(1273, 'KOTA PEMATANG SIANTAR'),
(1274, 'KOTA TEBING TINGGI'),
(1275, 'KOTA MEDAN'),
(1276, 'KOTA BINJAI'),
(1277, 'KOTA PADANGSIDIMPUAN'),
(1278, 'KOTA GUNUNGSITOLI'),
(1301, 'KAB. KEPULAUAN MENTAWAI'),
(1302, 'KAB. PESISIR SELATAN'),
(1303, 'KAB. SOLOK'),
(1304, 'KAB. SIJUNJUNG'),
(1305, 'KAB. TANAH DATAR'),
(1306, 'KAB. PADANG PARIAMAN'),
(1307, 'KAB. AGAM'),
(1308, 'KAB. LIMA PULUH KOTA'),
(1309, 'KAB. PASAMAN'),
(1310, 'KAB. SOLOK SELATAN'),
(1311, 'KAB. DHARMASRAYA'),
(1312, 'KAB. PASAMAN BARAT'),
(1371, 'KOTA PADANG'),
(1372, 'KOTA SOLOK'),
(1373, 'KOTA SAWAH LUNTO'),
(1374, 'KOTA PADANG PANJANG'),
(1375, 'KOTA BUKITTINGGI'),
(1376, 'KOTA PAYAKUMBUH'),
(1377, 'KOTA PARIAMAN'),
(1401, 'KAB. KUANTAN SINGINGI'),
(1402, 'KAB. INDRAGIRI HULU'),
(1403, 'KAB. INDRAGIRI HILIR'),
(1404, 'KAB. PELALAWAN'),
(1405, 'KAB. S I A K'),
(1406, 'KAB. KAMPAR'),
(1407, 'KAB. ROKAN HULU'),
(1408, 'KAB. BENGKALIS'),
(1409, 'KAB. ROKAN HILIR'),
(1410, 'KAB. KEPULAUAN MERANTI'),
(1471, 'KOTA PEKANBARU'),
(1473, 'KOTA D U M A I'),
(1501, 'KAB. KERINCI'),
(1502, 'KAB. MERANGIN'),
(1503, 'KAB. SAROLANGUN'),
(1504, 'KAB. BATANG HARI'),
(1505, 'KAB. MUARO JAMBI'),
(1506, 'KAB. TANJUNG JABUNG TIMUR'),
(1507, 'KAB. TANJUNG JABUNG BARAT'),
(1508, 'KAB. TEBO'),
(1509, 'KAB. BUNGO'),
(1571, 'KOTA JAMBI'),
(1572, 'KOTA SUNGAI PENUH'),
(1601, 'KAB. OGAN KOMERING ULU'),
(1602, 'KAB. OGAN KOMERING ILIR'),
(1603, 'KAB. MUARA ENIM'),
(1604, 'KAB. LAHAT'),
(1605, 'KAB. MUSI RAWAS'),
(1606, 'KAB. MUSI BANYUASIN'),
(1607, 'KAB. BANYU ASIN'),
(1608, 'KAB. OGAN KOMERING ULU SELATAN'),
(1609, 'KAB. OGAN KOMERING ULU TIMUR'),
(1610, 'KAB. OGAN ILIR'),
(1611, 'KAB. EMPAT LAWANG'),
(1612, 'KAB. PENUKAL ABAB LEMATANG ILIR'),
(1613, 'KAB. MUSI RAWAS UTARA'),
(1671, 'KOTA PALEMBANG'),
(1672, 'KOTA PRABUMULIH'),
(1673, 'KOTA PAGAR ALAM'),
(1674, 'KOTA LUBUKLINGGAU'),
(1701, 'KAB. BENGKULU SELATAN'),
(1702, 'KAB. REJANG LEBONG'),
(1703, 'KAB. BENGKULU UTARA'),
(1704, 'KAB. KAUR'),
(1705, 'KAB. SELUMA'),
(1706, 'KAB. MUKOMUKO'),
(1707, 'KAB. LEBONG'),
(1708, 'KAB. KEPAHIANG'),
(1709, 'KAB. BENGKULU TENGAH'),
(1771, 'KOTA BENGKULU'),
(1801, 'KAB. LAMPUNG BARAT'),
(1802, 'KAB. TANGGAMUS'),
(1803, 'KAB. LAMPUNG SELATAN'),
(1804, 'KAB. LAMPUNG TIMUR'),
(1805, 'KAB. LAMPUNG TENGAH'),
(1806, 'KAB. LAMPUNG UTARA'),
(1807, 'KAB. WAY KANAN'),
(1808, 'KAB. TULANGBAWANG'),
(1809, 'KAB. PESAWARAN'),
(1810, 'KAB. PRINGSEWU'),
(1811, 'KAB. MESUJI'),
(1812, 'KAB. TULANG BAWANG BARAT'),
(1813, 'KAB. PESISIR BARAT'),
(1871, 'KOTA BANDAR LAMPUNG'),
(1872, 'KOTA METRO'),
(1901, 'KAB. BANGKA'),
(1902, 'KAB. BELITUNG'),
(1903, 'KAB. BANGKA BARAT'),
(1904, 'KAB. BANGKA TENGAH'),
(1905, 'KAB. BANGKA SELATAN'),
(1906, 'KAB. BELITUNG TIMUR'),
(1971, 'KOTA PANGKAL PINANG'),
(2101, 'KAB. KARIMUN'),
(2102, 'KAB. BINTAN'),
(2103, 'KAB. NATUNA'),
(2104, 'KAB. LINGGA'),
(2105, 'KAB. KEPULAUAN ANAMBAS'),
(2171, 'KOTA B A T A M'),
(2172, 'KOTA TANJUNG PINANG'),
(3101, 'KAB. KEPULAUAN SERIBU'),
(3171, 'KOTA JAKARTA SELATAN'),
(3172, 'KOTA JAKARTA TIMUR'),
(3173, 'KOTA JAKARTA PUSAT'),
(3174, 'KOTA JAKARTA BARAT'),
(3175, 'KOTA JAKARTA UTARA'),
(3201, 'KAB. BOGOR'),
(3202, 'KAB. SUKABUMI'),
(3203, 'KAB. CIANJUR'),
(3204, 'KAB. BANDUNG'),
(3205, 'KAB. GARUT'),
(3206, 'KAB. TASIKMALAYA'),
(3207, 'KAB. CIAMIS'),
(3208, 'KAB. KUNINGAN'),
(3209, 'KAB. CIREBON'),
(3210, 'KAB. MAJALENGKA'),
(3211, 'KAB. SUMEDANG'),
(3212, 'KAB. INDRAMAYU'),
(3213, 'KAB. SUBANG'),
(3214, 'KAB. PURWAKARTA'),
(3215, 'KAB. KARAWANG'),
(3216, 'KAB. BEKASI'),
(3217, 'KAB. BANDUNG BARAT'),
(3218, 'KAB. PANGANDARAN'),
(3271, 'KOTA BOGOR'),
(3272, 'KOTA SUKABUMI'),
(3273, 'KOTA BANDUNG'),
(3274, 'KOTA CIREBON'),
(3275, 'KOTA BEKASI'),
(3276, 'KOTA DEPOK'),
(3277, 'KOTA CIMAHI'),
(3278, 'KOTA TASIKMALAYA'),
(3279, 'KOTA BANJAR'),
(3301, 'KAB. CILACAP'),
(3302, 'KAB. BANYUMAS'),
(3303, 'KAB. PURBALINGGA'),
(3304, 'KAB. BANJARNEGARA'),
(3305, 'KAB. KEBUMEN'),
(3306, 'KAB. PURWOREJO'),
(3307, 'KAB. WONOSOBO'),
(3308, 'KAB. MAGELANG'),
(3309, 'KAB. BOYOLALI'),
(3310, 'KAB. KLATEN'),
(3311, 'KAB. SUKOHARJO'),
(3312, 'KAB. WONOGIRI'),
(3313, 'KAB. KARANGANYAR'),
(3314, 'KAB. SRAGEN'),
(3315, 'KAB. GROBOGAN'),
(3316, 'KAB. BLORA'),
(3317, 'KAB. REMBANG'),
(3318, 'KAB. PATI'),
(3319, 'KAB. KUDUS'),
(3320, 'KAB. JEPARA'),
(3321, 'KAB. DEMAK'),
(3322, 'KAB. SEMARANG'),
(3323, 'KAB. TEMANGGUNG'),
(3324, 'KAB. KENDAL'),
(3325, 'KAB. BATANG'),
(3326, 'KAB. PEKALONGAN'),
(3327, 'KAB. PEMALANG'),
(3328, 'KAB. TEGAL'),
(3329, 'KAB. BREBES'),
(3371, 'KOTA MAGELANG'),
(3372, 'KOTA SURAKARTA'),
(3373, 'KOTA SALATIGA'),
(3374, 'KOTA SEMARANG'),
(3375, 'KOTA PEKALONGAN'),
(3376, 'KOTA TEGAL'),
(3401, 'KAB. KULON PROGO'),
(3402, 'KAB. BANTUL'),
(3403, 'KAB. GUNUNG KIDUL'),
(3404, 'KAB. SLEMAN'),
(3471, 'KOTA YOGYAKARTA'),
(3501, 'KAB. PACITAN'),
(3502, 'KAB. PONOROGO'),
(3503, 'KAB. TRENGGALEK'),
(3504, 'KAB. TULUNGAGUNG'),
(3505, 'KAB. BLITAR'),
(3506, 'KAB. KEDIRI'),
(3507, 'KAB. MALANG'),
(3508, 'KAB. LUMAJANG'),
(3509, 'KAB. JEMBER'),
(3510, 'KAB. BANYUWANGI'),
(3511, 'KAB. BONDOWOSO'),
(3512, 'KAB. SITUBONDO'),
(3513, 'KAB. PROBOLINGGO'),
(3514, 'KAB. PASURUAN'),
(3515, 'KAB. SIDOARJO'),
(3516, 'KAB. MOJOKERTO'),
(3517, 'KAB. JOMBANG'),
(3518, 'KAB. NGANJUK'),
(3519, 'KAB. MADIUN'),
(3520, 'KAB. MAGETAN'),
(3521, 'KAB. NGAWI'),
(3522, 'KAB. BOJONEGORO'),
(3523, 'KAB. TUBAN'),
(3524, 'KAB. LAMONGAN'),
(3525, 'KAB. GRESIK'),
(3526, 'KAB. BANGKALAN'),
(3527, 'KAB. SAMPANG'),
(3528, 'KAB. PAMEKASAN'),
(3529, 'KAB. SUMENEP'),
(3571, 'KOTA KEDIRI'),
(3572, 'KOTA BLITAR'),
(3573, 'KOTA MALANG'),
(3574, 'KOTA PROBOLINGGO'),
(3575, 'KOTA PASURUAN'),
(3576, 'KOTA MOJOKERTO'),
(3577, 'KOTA MADIUN'),
(3578, 'KOTA SURABAYA'),
(3579, 'KOTA BATU'),
(3601, 'KAB. PANDEGLANG'),
(3602, 'KAB. LEBAK'),
(3603, 'KAB. TANGERANG'),
(3604, 'KAB. SERANG'),
(3671, 'KOTA TANGERANG'),
(3672, 'KOTA CILEGON'),
(3673, 'KOTA SERANG'),
(3674, 'KOTA TANGERANG SELATAN'),
(5101, 'KAB. JEMBRANA'),
(5102, 'KAB. TABANAN'),
(5103, 'KAB. BADUNG'),
(5104, 'KAB. GIANYAR'),
(5105, 'KAB. KLUNGKUNG'),
(5106, 'KAB. BANGLI'),
(5107, 'KAB. KARANG ASEM'),
(5108, 'KAB. BULELENG'),
(5171, 'KOTA DENPASAR'),
(5201, 'KAB. LOMBOK BARAT'),
(5202, 'KAB. LOMBOK TENGAH'),
(5203, 'KAB. LOMBOK TIMUR'),
(5204, 'KAB. SUMBAWA'),
(5205, 'KAB. DOMPU'),
(5206, 'KAB. BIMA'),
(5207, 'KAB. SUMBAWA BARAT'),
(5208, 'KAB. LOMBOK UTARA'),
(5271, 'KOTA MATARAM'),
(5272, 'KOTA BIMA'),
(5301, 'KAB. SUMBA BARAT'),
(5302, 'KAB. SUMBA TIMUR'),
(5303, 'KAB. KUPANG'),
(5304, 'KAB. TIMOR TENGAH SELATAN'),
(5305, 'KAB. TIMOR TENGAH UTARA'),
(5306, 'KAB. BELU'),
(5307, 'KAB. ALOR'),
(5308, 'KAB. LEMBATA'),
(5309, 'KAB. FLORES TIMUR'),
(5310, 'KAB. SIKKA'),
(5311, 'KAB. ENDE'),
(5312, 'KAB. NGADA'),
(5313, 'KAB. MANGGARAI'),
(5314, 'KAB. ROTE NDAO'),
(5315, 'KAB. MANGGARAI BARAT'),
(5316, 'KAB. SUMBA TENGAH'),
(5317, 'KAB. SUMBA BARAT DAYA'),
(5318, 'KAB. NAGEKEO'),
(5319, 'KAB. MANGGARAI TIMUR'),
(5320, 'KAB. SABU RAIJUA'),
(5321, 'KAB. MALAKA'),
(5371, 'KOTA KUPANG'),
(6101, 'KAB. SAMBAS'),
(6102, 'KAB. BENGKAYANG'),
(6103, 'KAB. LANDAK'),
(6104, 'KAB. MEMPAWAH'),
(6105, 'KAB. SANGGAU'),
(6106, 'KAB. KETAPANG'),
(6107, 'KAB. SINTANG'),
(6108, 'KAB. KAPUAS HULU'),
(6109, 'KAB. SEKADAU'),
(6110, 'KAB. MELAWI'),
(6111, 'KAB. KAYONG UTARA'),
(6112, 'KAB. KUBU RAYA'),
(6171, 'KOTA PONTIANAK'),
(6172, 'KOTA SINGKAWANG'),
(6201, 'KAB. KOTAWARINGIN BARAT'),
(6202, 'KAB. KOTAWARINGIN TIMUR'),
(6203, 'KAB. KAPUAS'),
(6204, 'KAB. BARITO SELATAN'),
(6205, 'KAB. BARITO UTARA'),
(6206, 'KAB. SUKAMARA'),
(6207, 'KAB. LAMANDAU'),
(6208, 'KAB. SERUYAN'),
(6209, 'KAB. KATINGAN'),
(6210, 'KAB. PULANG PISAU'),
(6211, 'KAB. GUNUNG MAS'),
(6212, 'KAB. BARITO TIMUR'),
(6213, 'KAB. MURUNG RAYA'),
(6271, 'KOTA PALANGKA RAYA'),
(6301, 'KAB. TANAH LAUT'),
(6302, 'KAB. KOTA BARU'),
(6303, 'KAB. BANJAR'),
(6304, 'KAB. BARITO KUALA'),
(6305, 'KAB. TAPIN'),
(6306, 'KAB. HULU SUNGAI SELATAN'),
(6307, 'KAB. HULU SUNGAI TENGAH'),
(6308, 'KAB. HULU SUNGAI UTARA'),
(6309, 'KAB. TABALONG'),
(6310, 'KAB. TANAH BUMBU'),
(6311, 'KAB. BALANGAN'),
(6371, 'KOTA BANJARMASIN'),
(6372, 'KOTA BANJAR BARU'),
(6401, 'KAB. PASER'),
(6402, 'KAB. KUTAI BARAT'),
(6403, 'KAB. KUTAI KARTANEGARA'),
(6404, 'KAB. KUTAI TIMUR'),
(6405, 'KAB. BERAU'),
(6409, 'KAB. PENAJAM PASER UTARA'),
(6411, 'KAB. MAHAKAM HULU'),
(6471, 'KOTA BALIKPAPAN'),
(6472, 'KOTA SAMARINDA'),
(6474, 'KOTA BONTANG'),
(6501, 'KAB. MALINAU'),
(6502, 'KAB. BULUNGAN'),
(6503, 'KAB. TANA TIDUNG'),
(6504, 'KAB. NUNUKAN'),
(6571, 'KOTA TARAKAN'),
(7101, 'KAB. BOLAANG MONGONDOW'),
(7102, 'KAB. MINAHASA'),
(7103, 'KAB. KEPULAUAN SANGIHE'),
(7104, 'KAB. KEPULAUAN TALAUD'),
(7105, 'KAB. MINAHASA SELATAN'),
(7106, 'KAB. MINAHASA UTARA'),
(7107, 'KAB. BOLAANG MONGONDOW UTARA'),
(7108, 'KAB. SIAU TAGULANDANG BIARO'),
(7109, 'KAB. MINAHASA TENGGARA'),
(7110, 'KAB. BOLAANG MONGONDOW SELATAN'),
(7111, 'KAB. BOLAANG MONGONDOW TIMUR'),
(7171, 'KOTA MANADO'),
(7172, 'KOTA BITUNG'),
(7173, 'KOTA TOMOHON'),
(7174, 'KOTA KOTAMOBAGU'),
(7201, 'KAB. BANGGAI KEPULAUAN'),
(7202, 'KAB. BANGGAI'),
(7203, 'KAB. MOROWALI'),
(7204, 'KAB. POSO'),
(7205, 'KAB. DONGGALA'),
(7206, 'KAB. TOLI-TOLI'),
(7207, 'KAB. BUOL'),
(7208, 'KAB. PARIGI MOUTONG'),
(7209, 'KAB. TOJO UNA-UNA'),
(7210, 'KAB. SIGI'),
(7211, 'KAB. BANGGAI LAUT'),
(7212, 'KAB. MOROWALI UTARA'),
(7271, 'KOTA PALU'),
(7301, 'KAB. KEPULAUAN SELAYAR'),
(7302, 'KAB. BULUKUMBA'),
(7303, 'KAB. BANTAENG'),
(7304, 'KAB. JENEPONTO'),
(7305, 'KAB. TAKALAR'),
(7306, 'KAB. GOWA'),
(7307, 'KAB. SINJAI'),
(7308, 'KAB. MAROS'),
(7309, 'KAB. PANGKAJENE DAN KEPULAUAN'),
(7310, 'KAB. BARRU'),
(7311, 'KAB. BONE'),
(7312, 'KAB. SOPPENG'),
(7313, 'KAB. WAJO'),
(7314, 'KAB. SIDENRENG RAPPANG'),
(7315, 'KAB. PINRANG'),
(7316, 'KAB. ENREKANG'),
(7317, 'KAB. LUWU'),
(7318, 'KAB. TANA TORAJA'),
(7322, 'KAB. LUWU UTARA'),
(7325, 'KAB. LUWU TIMUR'),
(7326, 'KAB. TORAJA UTARA'),
(7371, 'KOTA MAKASSAR'),
(7372, 'KOTA PAREPARE'),
(7373, 'KOTA PALOPO'),
(7401, 'KAB. BUTON'),
(7402, 'KAB. MUNA'),
(7403, 'KAB. KONAWE'),
(7404, 'KAB. KOLAKA'),
(7405, 'KAB. KONAWE SELATAN'),
(7406, 'KAB. BOMBANA'),
(7407, 'KAB. WAKATOBI'),
(7408, 'KAB. KOLAKA UTARA'),
(7409, 'KAB. BUTON UTARA'),
(7410, 'KAB. KONAWE UTARA'),
(7411, 'KAB. KOLAKA TIMUR'),
(7412, 'KAB. KONAWE KEPULAUAN'),
(7413, 'KAB. MUNA BARAT'),
(7414, 'KAB. BUTON TENGAH'),
(7415, 'KAB. BUTON SELATAN'),
(7471, 'KOTA KENDARI'),
(7472, 'KOTA BAUBAU'),
(7501, 'KAB. BOALEMO'),
(7502, 'KAB. GORONTALO'),
(7503, 'KAB. POHUWATO'),
(7504, 'KAB. BONE BOLANGO'),
(7505, 'KAB. GORONTALO UTARA'),
(7571, 'KOTA GORONTALO'),
(7601, 'KAB. MAJENE'),
(7602, 'KAB. POLEWALI MANDAR'),
(7603, 'KAB. MAMASA'),
(7604, 'KAB. MAMUJU'),
(7605, 'KAB. MAMUJU UTARA'),
(7606, 'KAB. MAMUJU TENGAH'),
(8101, 'KAB. MALUKU TENGGARA BARAT'),
(8102, 'KAB. MALUKU TENGGARA'),
(8103, 'KAB. MALUKU TENGAH'),
(8104, 'KAB. BURU'),
(8105, 'KAB. KEPULAUAN ARU'),
(8106, 'KAB. SERAM BAGIAN BARAT'),
(8107, 'KAB. SERAM BAGIAN TIMUR'),
(8108, 'KAB. MALUKU BARAT DAYA'),
(8109, 'KAB. BURU SELATAN'),
(8171, 'KOTA AMBON'),
(8172, 'KOTA TUAL'),
(8201, 'KAB. HALMAHERA BARAT'),
(8202, 'KAB. HALMAHERA TENGAH'),
(8203, 'KAB. KEPULAUAN SULA'),
(8204, 'KAB. HALMAHERA SELATAN'),
(8205, 'KAB. HALMAHERA UTARA'),
(8206, 'KAB. HALMAHERA TIMUR'),
(8207, 'KAB. PULAU MOROTAI'),
(8208, 'KAB. PULAU TALIABU'),
(8271, 'KOTA TERNATE'),
(8272, 'KOTA TIDORE KEPULAUAN'),
(9101, 'KAB. FAKFAK'),
(9102, 'KAB. KAIMANA'),
(9103, 'KAB. TELUK WONDAMA'),
(9104, 'KAB. TELUK BINTUNI'),
(9105, 'KAB. MANOKWARI'),
(9106, 'KAB. SORONG SELATAN'),
(9107, 'KAB. SORONG'),
(9108, 'KAB. RAJA AMPAT'),
(9109, 'KAB. TAMBRAUW'),
(9110, 'KAB. MAYBRAT'),
(9111, 'KAB. MANOKWARI SELATAN'),
(9112, 'KAB. PEGUNUNGAN ARFAK'),
(9171, 'KOTA SORONG'),
(9401, 'KAB. MERAUKE'),
(9402, 'KAB. JAYAWIJAYA'),
(9403, 'KAB. JAYAPURA'),
(9404, 'KAB. NABIRE'),
(9408, 'KAB. KEPULAUAN YAPEN'),
(9409, 'KAB. BIAK NUMFOR'),
(9410, 'KAB. PANIAI'),
(9411, 'KAB. PUNCAK JAYA'),
(9412, 'KAB. MIMIKA'),
(9413, 'KAB. BOVEN DIGOEL'),
(9414, 'KAB. MAPPI'),
(9415, 'KAB. ASMAT'),
(9416, 'KAB. YAHUKIMO'),
(9417, 'KAB. PEGUNUNGAN BINTANG'),
(9418, 'KAB. TOLIKARA'),
(9419, 'KAB. SARMI'),
(9420, 'KAB. KEEROM'),
(9426, 'KAB. WAROPEN'),
(9427, 'KAB. SUPIORI'),
(9428, 'KAB. MAMBERAMO RAYA'),
(9429, 'KAB. NDUGA'),
(9430, 'KAB. LANNY JAYA'),
(9431, 'KAB. MAMBERAMO TENGAH'),
(9432, 'KAB. YALIMO'),
(9433, 'KAB. PUNCAK'),
(9434, 'KAB. DOGIYAI'),
(9435, 'KAB. INTAN JAYA'),
(9436, 'KAB. DEIYAI'),
(9471, 'KOTA JAYAPURA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kategoriId` int(10) UNSIGNED NOT NULL,
  `kategoriName` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kategoriId`, `kategoriName`) VALUES
(1, 'Umum'),
(2, 'Quran'),
(3, 'Pengelola');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_kuis`
--

CREATE TABLE `tb_kategori_kuis` (
  `id_kategori_kuis` int(10) UNSIGNED NOT NULL,
  `kategoriKuis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_kuis`
--

INSERT INTO `tb_kategori_kuis` (`id_kategori_kuis`, `kategoriKuis`) VALUES
(1, 'Tanya Jawab');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuis`
--

CREATE TABLE `tb_kuis` (
  `id_kuis` int(10) UNSIGNED NOT NULL,
  `tb_kategori_kuis_id_kategori_kuis` int(10) UNSIGNED NOT NULL,
  `namaKuis` varchar(50) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kuis`
--

INSERT INTO `tb_kuis` (`id_kuis`, `tb_kategori_kuis_id_kategori_kuis`, `namaKuis`, `keterangan`, `icon`) VALUES
(1, 1, 'Teka Teki Bertingkat', 'Keterangan dari teka teki bertingkat ini sebuah teka teki umum.', '1'),
(11, 1, 'tess', 'tesss data', '2'),
(13, 1, 'MERDEKA', 'KETERANGAN MERDEKA', '4');

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
(2, 'Faktor yang mempengaruhi penurunan emas', '+ 550 kata', '2019-10-04', '2019-09-24 12:14:21'),
(5, 'tesss', '400 kata', '2019-09-30', '2019-09-24 17:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `menuid` int(11) NOT NULL,
  `menuparentid` int(11) NOT NULL,
  `menuname` varchar(30) NOT NULL,
  `menuicon` varchar(30) NOT NULL,
  `menulink` varchar(100) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `menusort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`menuid`, `menuparentid`, `menuname`, `menuicon`, `menulink`, `alias`, `menusort`) VALUES
(3, 33, 'Data Pengguna', '', 'master/Con_pengguna', 'data-pengguna', 0),
(8, 0, 'TRANSAKSI', 'mdi mdi-grease-pencil', '', '', 5),
(9, 31, 'Lomba Kuis', '', 'master/Con_kuis', 'data-kuis', 0),
(10, 31, 'Lomba Karya Tulis', '', 'master/Con_karyaTulis', 'data-karya-tulis', 0),
(11, 32, 'Perkembangan Siswa', '', 'master/Con_riwayatBelajarSiswa', 'data-riwayat-perkembangan-siswa', 0),
(13, 8, 'Transaksi Siswa', '', 'master/Con_transaksiSiswa', 'data-transaksi-siswa', 0),
(14, 8, 'Profit Tentor', '', 'master/Con_profitTentor', 'data-profit-tentor', 0),
(15, 31, 'Pesan Kritik & Saran', '', 'master/Con_kritikSaran', 'data-pesan-kritik-saran', 0),
(17, 0, 'SETTINGS', 'mdi mdi-grease-pencil', '#', '', 4),
(19, 17, 'abouts', '', 'master/Con_abouts', 'data-update-fitur-tentang-perusahaan', 0),
(20, 17, 'Support info', '', 'master/Con_supports', 'data-update-fitur-supports', 0),
(21, 31, 'Data Kursus', '', 'master/Con_dataKursus', 'data-kursus', 0),
(22, 33, 'Data User Login', '', 'master/Con_dataUsersLogin', 'data-user-login', 0),
(23, 32, 'Riwayat Kursus', '', 'master/Con_riwayatKursus', 'data-riwayat-kursus-by-tuntas', 0),
(24, 17, 'Set Kuis', '', 'master/Con_setKuis', 'data-setup-judul-kuis', 0),
(25, 32, 'Riwayat Kuis', '', 'master/Con_Rkuis', 'data-riwayat-kuis', 0),
(26, 32, 'Riwayat Karya tulis', '', 'master/Con_RkaryaTulis', 'data-riwayat-karya-tulis', 0),
(27, 17, 'Bidang studi', '', 'settings/Con_BidangStudi', 'data-bidang-studi', 0),
(29, 32, 'Riwayat Absensi', '', 'master/Con_riwayatAbsensi', 'data-riwayat-absensi', 0),
(30, 32, 'Riwayat Pembayaran', '', 'master/Con_riwayatPembayaran', 'data-riwayat-pembayaran', 0),
(31, 0, 'MASTER', 'mdi mdi-grease-pencil', '#', '', 2),
(32, 0, 'RIWAYAT', 'mdi mdi-grease-pencil', '#', '', 3),
(33, 0, 'PENGGUNA', 'mdi mdi-grease-pencil', '#', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pathprojek`
--

CREATE TABLE `tb_pathprojek` (
  `id` int(11) NOT NULL,
  `folProjek` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pathprojek`
--

INSERT INTO `tb_pathprojek` (`id`, `folProjek`) VALUES
(1, 'cm-bilikilmu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `penggunaId` varchar(11) NOT NULL DEFAULT '10',
  `tb_role_roleId` int(5) UNSIGNED NOT NULL,
  `app_rate_idapp_rate` varchar(7) NOT NULL,
  `tb_kategori_kategoriId` int(10) UNSIGNED NOT NULL,
  `namaDepan` char(15) DEFAULT NULL,
  `nomorKtp` varchar(16) NOT NULL,
  `namaBelakang` char(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `tempatTinggal` varchar(200) DEFAULT NULL,
  `tempatLahir` char(30) DEFAULT NULL,
  `tglLahir` date DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `noWa` varchar(14) DEFAULT NULL,
  `foto` varchar(30) DEFAULT NULL,
  `pendidikanTerakir` varchar(50) DEFAULT NULL,
  `pengalamanMengjar` varchar(50) DEFAULT NULL,
  `guruMapel` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `pendidikanSekarang` varchar(100) NOT NULL,
  `rattings` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`penggunaId`, `tb_role_roleId`, `app_rate_idapp_rate`, `tb_kategori_kategoriId`, `namaDepan`, `nomorKtp`, `namaBelakang`, `alamat`, `tempatTinggal`, `tempatLahir`, `tglLahir`, `umur`, `email`, `noWa`, `foto`, `pendidikanTerakir`, `pengalamanMengjar`, `guruMapel`, `status`, `pendidikanSekarang`, `rattings`) VALUES
('001', 2, '', 1, 'Andi', '123', 'wicaksono', 'Turi-001/001-Jetis-Ponorogo', 'Ponorogo', 'Madiun', '1999-08-07', 20, 'andi@gmail.com', '023105640987', NULL, 'S1 kairo', 'Guru Tafsir hadis, 2th', 'Quran', 'aktif', '', 0),
('002', 2, '', 1, 'Rian', '12345', 'wijaya', NULL, NULL, NULL, '2001-08-07', NULL, 'rian@gmail.com', '023344456868', NULL, NULL, NULL, 'Matematika', 'aktif', '', 0),
('003', 3, '', 2, 'Winda', '123456', 'Astuti', NULL, NULL, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 'Aktif', '', 0),
('004', 3, '', 1, 'Wilda', '1234567', 'Setiawan', 'Karanggebang', NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, 'Aktif', '', 0),
('005', 1, '', 3, 'Arif', '3502092703920001', 'efendi', 'Tempel 001/001, Jetis, Ponorogo', 'Ponorogo', 'Ponorogo', '1992-03-27', 27, 'arifefendi304@gmail.com', '6283845478148', NULL, 'd2', '3', 'Web Programming ', 'Aktif', '', 0),
('006', 3, '', 1, 'Aprillia', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 0),
('RG19000001', 3, '', 1, 'arif', '646546216', '', NULL, '', '', '0000-00-00', 0, '', '', NULL, '', NULL, NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_profit`
--

CREATE TABLE `tb_profit` (
  `profitId` varchar(10) NOT NULL,
  `app_users_tb_pengguna_tb_kategori_kategoriId` int(10) UNSIGNED NOT NULL,
  `app_users_tb_pengguna_app_rate_idapp_rate` varchar(7) NOT NULL,
  `app_users_tb_pengguna_tb_role_roleId` int(5) UNSIGNED NOT NULL,
  `app_users_tb_kategori_kategoriId` int(10) UNSIGNED NOT NULL,
  `app_users_tb_pengguna_penggunaId` varchar(7) NOT NULL,
  `app_users_tb_role_roleId` int(5) UNSIGNED NOT NULL,
  `app_users_idapp_users` int(10) UNSIGNED NOT NULL,
  `namaSiswa` varchar(30) DEFAULT NULL,
  `namaTentor` varchar(30) DEFAULT NULL,
  `bonusSiswa` float DEFAULT NULL,
  `bonusTentor` float DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `statusPembayaran` varchar(7) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `roleId` int(5) UNSIGNED NOT NULL,
  `nama` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`roleId`, `nama`) VALUES
(1, 'admin'),
(2, 'guru'),
(3, 'siswa'),
(4, 'superuser');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supports_info`
--

CREATE TABLE `tb_supports_info` (
  `id` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wa1` varchar(14) NOT NULL,
  `wa2` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supports_info`
--

INSERT INTO `tb_supports_info` (`id`, `email`, `wa1`, `wa2`) VALUES
(1, 'info@bilikilmu.com', '6287845478148', '6287845478148');

-- --------------------------------------------------------

--
-- Table structure for table `tb_urut`
--

CREATE TABLE `tb_urut` (
  `idurut` int(11) NOT NULL,
  `namaForm` varchar(5) NOT NULL,
  `noUrut` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_urut`
--

INSERT INTO `tb_urut` (`idurut`, `namaForm`, `noUrut`) VALUES
(1, 'KB', '13'),
(2, 'RG', '1'),
(3, 'RC', '22'),
(5, 'IN', '1'),
(6, 'BL', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_kritiksaran`
--
ALTER TABLE `app_kritiksaran`
  ADD PRIMARY KEY (`id_kritiksaran`),
  ADD KEY `tb_kritiksaran_FKIndex1` (`tb_pengguna_penggunaId`);

--
-- Indexes for table `app_kursus`
--
ALTER TABLE `app_kursus`
  ADD PRIMARY KEY (`idapp_kursus`),
  ADD KEY `app_kursus_FKIndex1` (`tb_kategori_kategoriId`),
  ADD KEY `app_kursus_FKIndex3` (`tb_jumPertemuan_idjumPertemuan`),
  ADD KEY `app_users_userid` (`app_users_userid`);

--
-- Indexes for table `app_rate`
--
ALTER TABLE `app_rate`
  ADD PRIMARY KEY (`idapp_rate`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `IDCABANG` (`tb_pengguna_penggunaid`);

--
-- Indexes for table `detailcarier`
--
ALTER TABLE `detailcarier`
  ADD PRIMARY KEY (`idUnix`) USING BTREE;

--
-- Indexes for table `detailjadwal`
--
ALTER TABLE `detailjadwal`
  ADD PRIMARY KEY (`idUnix`);

--
-- Indexes for table `detailkursus`
--
ALTER TABLE `detailkursus`
  ADD PRIMARY KEY (`idUnix`);

--
-- Indexes for table `detaillombaartikel`
--
ALTER TABLE `detaillombaartikel`
  ADD PRIMARY KEY (`idUnix`);

--
-- Indexes for table `detailpembayaran`
--
ALTER TABLE `detailpembayaran`
  ADD PRIMARY KEY (`idUnixs`);

--
-- Indexes for table `detailperkembangan`
--
ALTER TABLE `detailperkembangan`
  ADD PRIMARY KEY (`idDperkembangan`);

--
-- Indexes for table `detailriwayatabsen`
--
ALTER TABLE `detailriwayatabsen`
  ADD PRIMARY KEY (`idUnixRiwayat`);

--
-- Indexes for table `num_unallowed`
--
ALTER TABLE `num_unallowed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_pages`
--
ALTER TABLE `tabel_pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `tb_abouts`
--
ALTER TABLE `tb_abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bidangstudi`
--
ALTER TABLE `tb_bidangstudi`
  ADD PRIMARY KEY (`id_bidangStudi`);

--
-- Indexes for table `tb_gokuis`
--
ALTER TABLE `tb_gokuis`
  ADD PRIMARY KEY (`id_gokuis`),
  ADD KEY `tb_gokuis_FKIndex1` (`tb_kuis_id_kuis`);

--
-- Indexes for table `tb_icons`
--
ALTER TABLE `tb_icons`
  ADD PRIMARY KEY (`idIcons`);

--
-- Indexes for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  ADD PRIMARY KEY (`idIndikator`);

--
-- Indexes for table `tb_jumpertemuan`
--
ALTER TABLE `tb_jumpertemuan`
  ADD PRIMARY KEY (`idjumPertemuan`);

--
-- Indexes for table `tb_kabupaten`
--
ALTER TABLE `tb_kabupaten`
  ADD PRIMARY KEY (`IDKOTA`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kategoriId`);

--
-- Indexes for table `tb_kategori_kuis`
--
ALTER TABLE `tb_kategori_kuis`
  ADD PRIMARY KEY (`id_kategori_kuis`);

--
-- Indexes for table `tb_kuis`
--
ALTER TABLE `tb_kuis`
  ADD PRIMARY KEY (`id_kuis`),
  ADD KEY `tb_kuis_FKIndex1` (`tb_kategori_kuis_id_kategori_kuis`);

--
-- Indexes for table `tb_lombaartikel`
--
ALTER TABLE `tb_lombaartikel`
  ADD PRIMARY KEY (`idLomba`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`menuid`);

--
-- Indexes for table `tb_pathprojek`
--
ALTER TABLE `tb_pathprojek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`penggunaId`),
  ADD KEY `tb_pengguna_FKIndex1` (`tb_role_roleId`),
  ADD KEY `tb_pengguna_FKIndex2` (`app_rate_idapp_rate`),
  ADD KEY `tb_pengguna_FKIndex3` (`tb_kategori_kategoriId`);

--
-- Indexes for table `tb_profit`
--
ALTER TABLE `tb_profit`
  ADD PRIMARY KEY (`profitId`),
  ADD KEY `tb_profit_FKIndex1` (`app_users_idapp_users`,`app_users_tb_role_roleId`,`app_users_tb_pengguna_penggunaId`,`app_users_tb_kategori_kategoriId`,`app_users_tb_pengguna_tb_role_roleId`,`app_users_tb_pengguna_app_rate_idapp_rate`,`app_users_tb_pengguna_tb_kategori_kategoriId`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tb_supports_info`
--
ALTER TABLE `tb_supports_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_urut`
--
ALTER TABLE `tb_urut`
  ADD PRIMARY KEY (`idurut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `num_unallowed`
--
ALTER TABLE `num_unallowed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabel_pages`
--
ALTER TABLE `tabel_pages`
  MODIFY `pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_abouts`
--
ALTER TABLE `tb_abouts`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_bidangstudi`
--
ALTER TABLE `tb_bidangstudi`
  MODIFY `id_bidangStudi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_gokuis`
--
ALTER TABLE `tb_gokuis`
  MODIFY `id_gokuis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_icons`
--
ALTER TABLE `tb_icons`
  MODIFY `idIcons` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_indikator`
--
ALTER TABLE `tb_indikator`
  MODIFY `idIndikator` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jumpertemuan`
--
ALTER TABLE `tb_jumpertemuan`
  MODIFY `idjumPertemuan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kategoriId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kategori_kuis`
--
ALTER TABLE `tb_kategori_kuis`
  MODIFY `id_kategori_kuis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kuis`
--
ALTER TABLE `tb_kuis`
  MODIFY `id_kuis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_lombaartikel`
--
ALTER TABLE `tb_lombaartikel`
  MODIFY `idLomba` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pathprojek`
--
ALTER TABLE `tb_pathprojek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `roleId` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_supports_info`
--
ALTER TABLE `tb_supports_info`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
