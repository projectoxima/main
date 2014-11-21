-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2014 at 04:22 AM
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
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `position` varchar(10) NOT NULL,
  `groups` varchar(10) NOT NULL DEFAULT '*',
  `label` varchar(70) NOT NULL,
  `module_id` int(11) NOT NULL,
  `param` varchar(30) NOT NULL,
  `custom_url` varchar(200) NOT NULL,
  `show` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `position`, `groups`, `label`, `module_id`, `param`, `custom_url`, `show`) VALUES
(1, 0, 'top', '*', 'Home', 1, '', '', 1),
(2, 0, 'top', '*', 'Tentang Kami', 0, '', '', 1),
(3, 0, 'top', '*', 'Members', 0, '', '', 1),
(4, 0, 'top', '*', 'Register', 0, '', '', 1),
(5, 0, 'top', '*', 'News', 0, '', '', 1),
(6, 0, 'top', '*', 'Promo', 0, '', '', 1),
(7, 0, 'top', '*', 'Login', 3, '', '', 1),
(8, 2, 'top', '*', 'Profil Perusahaan', 0, '', '', 1),
(9, 2, 'top', '*', 'Profil Produk', 0, '', '', 1),
(10, 3, 'top', '*', 'Profil Member', 0, '', '', 1),
(11, 0, 'top', '1', 'Logout', 4, '', '', 1),
(12, 0, 'top', '2', 'Logout', 4, '', '', 1),
(13, 0, 'top', '3', 'Logout', 4, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `routes` text NOT NULL,
  `params` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `controller`, `action`, `routes`, `params`) VALUES
(1, 'welcome', 'index', 'beranda', ''),
(2, 'welcome', 'test', 'ambil-angka/(:any)', '$1'),
(3, 'auth', 'login', 'user-login', ''),
(4, 'auth', 'logout', 'user-logout', ''),
(5, 'member', 'index', 'register', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setupkey` varchar(30) NOT NULL,
  `setupvalue` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setupkey` (`setupkey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setupkey`, `setupvalue`) VALUES
(1, 'LAYOUT', 'oxima'),
(2, 'APPTITLE', 'Oxima');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE IF NOT EXISTS `tbl_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_id` bigint(20) NOT NULL,
  `no_sponsor` bigint(20) NOT NULL,
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
  `ktp` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_rekening` int(11) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `nama_rekening` varchar(128) NOT NULL,
  `nama_ahli_waris` varchar(128) NOT NULL,
  `hubungan_keluarga` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset`
--

CREATE TABLE IF NOT EXISTS `tbl_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_member` bigint(20) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `id_member`, `username`, `password`, `user_type`, `email`, `phone`) VALUES
(1, 99, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Melangbong@yahoo.com', '85759979248');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE IF NOT EXISTS `tbl_user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Administrator'),
(2, 'Operator', 'User operator'),
(3, 'Member', 'User member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
