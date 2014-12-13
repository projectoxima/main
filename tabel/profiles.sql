-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2014 at 02:31 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oxima`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `sponsor_id` bigint(20) DEFAULT NULL,
  `tgl_pengajuan` date NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `alamat` varchar(512) NOT NULL,
  `kota` varchar(64) NOT NULL,
  `propinsi` varchar(64) NOT NULL,
  `kodepos` varchar(16) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(16) NOT NULL,
  `phone` int(11) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `nama_rekening` varchar(128) NOT NULL,
  `nama_ahli_waris` varchar(128) NOT NULL,
  `hubungan_keluarga` varchar(64) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_id` (`user_id`),
  KEY `sponsor_id` (`sponsor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `sponsor_id`, `tgl_pengajuan`, `nama_lengkap`, `alamat`, `kota`, `propinsi`, `kodepos`, `tempat_lahir`, `tgl_lahir`, `agama`, `jenis_kelamin`, `phone`, `ktp`, `email`, `no_rekening`, `bank`, `nama_rekening`, `nama_ahli_waris`, `hubungan_keluarga`, `photo`) VALUES
(1, 1, NULL, '0000-00-00', 'Mas Admin', 'Bandung', '', '', '', '', '0000-00-00', '', '', 0, '0', '', '0', '', '', '', '', ''),
(2, 2, NULL, '0000-00-00', 'Mas Operator', 'Bandung', 'Bandung', 'Jawa Barat', '', '', '0000-00-00', '', '', 0, '0', 'yoviesmanda@gmail.com', '0', '', '', '', '', ''),
(3, 3, NULL, '2014-12-01', 'Mas Member', 'Bandung', 'Bandung', 'Jawa Barat', '', '', '0000-00-00', '', '', 0, '0', 'melangbong@yahoo.com', '0', '', '', '', '', ''),
(4, 4, NULL, '2014-12-01', 'Asep Irama', 'Bandung', 'Bandung', 'Jawa Barat', '40283', 'Bandung', '0000-00-00', 'Islam', 'Laki-Laki', 2147483647, '089655091296', 'melangbong@yahoo.com', '089655091296', 'BRI Syariah', 'asep', 'asep', 'asep', ''),
(6, 5, 3, '2014-12-01', 'Jaka Sembung', 'Kiaracondong', 'Bandung', 'Jawa Barat', '40283', 'Bandung', '0000-00-00', 'Islam', 'Laki-Laki', 2147483647, '089655091296', 'melangbong@yahoo.com', '089655091296', 'BRI Syariah', 'Jaka', 'Jaka', 'Jaka', ''),
(7, 8, 7, '2014-12-01', 'Surti Sutisna', 'Kiaracondong', 'Bandung', 'Jawa Barat', '40283', 'Bandung', '0000-00-00', 'Kristen', 'Perempuan', 2147483647, '089655091296', 'melangbong@yahoo.com', '089655091296', 'BRI Syariah', 'Surti', 'Surti', 'Surti', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`sponsor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
