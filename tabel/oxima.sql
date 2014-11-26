-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2014 at 02:12 AM
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
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `key`, `text`) VALUES
(1, 'HOME_TEXT_HEADER', 'Produk ini dapat membantu menyembuhkan berbagai macam penyakit yang disebabkan oleh faktor pola makan, cara hidup dan lingkungan. Diantara penyakit tersebut adalah: Kanker, Diabetes, Stroke, Asam Urat, Jantung, Paru-paru, Hepatitis A-B-C, Tumor, Penuaan Dini dan lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Administrator'),
(2, 'Operator', 'User operator'),
(3, 'Member', 'User member');

-- --------------------------------------------------------

--
-- Table structure for table `idbarangs`
--

CREATE TABLE IF NOT EXISTS `idbarangs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idbarang` varchar(12) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idbarang` (`idbarang`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `idbarangs`
--

INSERT INTO `idbarangs` (`id`, `idbarang`, `status`, `create_time`, `user_id`) VALUES
(1, '0001', 0, '2014-11-23 11:14:55', 0),
(2, '0002', 0, '2014-11-23 11:14:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `position` varchar(10) NOT NULL,
  `groups` varchar(10) NOT NULL DEFAULT '*',
  `label` varchar(70) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `param` varchar(30) NOT NULL,
  `custom_url` varchar(200) NOT NULL,
  `show` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=301 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `position`, `groups`, `label`, `module_id`, `param`, `custom_url`, `show`) VALUES
(1, NULL, 'top', '*', 'Home', 1, '', '', 1),
(2, NULL, 'top', '*', 'Tentang Kami', NULL, '', '', 1),
(3, NULL, 'top', '*', 'Members', NULL, '', '', 1),
(4, NULL, 'top', '*', 'Register', 0, '', '', 1),
(5, NULL, 'top', '*', 'News', NULL, '', '', 1),
(6, NULL, 'top', '*', 'Promo', NULL, '', '', 1),
(7, NULL, 'top', '*', 'Login', 3, '', '', 1),
(8, 2, 'top', '*', 'Profil Perusahaan', 6, '', '', 1),
(9, 2, 'top', '*', 'Profil Produk', 7, '', '', 1),
(10, 3, 'top', '*', 'Profil Member', NULL, '', '', 1),
(50, NULL, 'top', '1', 'Generate', NULL, '', '', 1),
(51, 50, 'top', '1', 'PIN', NULL, '', '', 1),
(52, 50, 'top', '1', 'ID Barang', NULL, '', '', 1),
(100, NULL, 'top', '1', 'Logout', 4, '', '', 1),
(200, NULL, 'top', '2', 'Logout', 4, '', '', 1),
(300, NULL, 'top', '3', 'Logout', 4, '', '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `controller`, `action`, `routes`, `params`) VALUES
(1, 'welcome', 'index', 'beranda', ''),
(2, 'welcome', 'test', 'ambil-angka/(:any)', '$1'),
(3, 'auth', 'login', 'user-login', ''),
(4, 'auth', 'logout', 'user-logout', ''),
(5, 'member', 'index', 'register', ''),
(6, 'company', 'profile', 'company-profile', ''),
(7, 'company', 'product', 'company-product', '');

-- --------------------------------------------------------

--
-- Table structure for table `parent_childs`
--

CREATE TABLE IF NOT EXISTS `parent_childs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titik_id` bigint(20) DEFAULT NULL,
  `parent_child_id` bigint(20) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_child_id` (`parent_child_id`),
  KEY `titik_id` (`titik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE IF NOT EXISTS `pins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pin` varchar(12) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pin` (`pin`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `no_id` bigint(20) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `no_id` (`no_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `no_id`, `no_sponsor`, `tgl_pengajuan`, `nama_lengkap`, `alamat`, `kota`, `propinsi`, `kodepos`, `tempat_lahir`, `tgl_lahir`, `agama`, `jenis_kelamin`, `phone`, `ktp`, `email`, `no_rekening`, `bank`, `nama_rekening`, `nama_ahli_waris`, `hubungan_keluarga`) VALUES
(1, 4, NULL, 0, '0000-00-00', 'asep', 'asep', 'asep', 'asep', 'asep', 'asep', '0000-00-00', 'Lainnya', 'Perempuan', 123, 123, 'AsepSulanjana@gmail.com', 123, 'asep', 'asep', 'asep', 'asep');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_pins`
--

CREATE TABLE IF NOT EXISTS `reserved_pins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pin_id` bigint(20) DEFAULT NULL,
  `idbarang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pin_id` (`pin_id`),
  KEY `idbarang_id` (`idbarang_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reserved_pins`
--

INSERT INTO `reserved_pins` (`id`, `pin_id`, `idbarang_id`, `user_id`, `create_time`) VALUES
(1, 1, 1, 1, '2014-11-24 00:52:02'),
(2, 1, 2, 0, '2014-11-26 01:02:09'),
(3, 2, 3, 3, '2014-11-26 01:00:15'),
(4, 2, 4, 4, '2014-11-26 01:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE IF NOT EXISTS `resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(128) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `titiks`
--

CREATE TABLE IF NOT EXISTS `titiks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idbarang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idbarang_id` (`idbarang_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `pin_id` varchar(256) DEFAULT NULL,
  `group_id` tinyint(4) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`),
  KEY `pin_id` (`pin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `pin_id`, `group_id`, `email`, `phone`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, 'Melangbong@yahoo.com', '85759979248', 0),
(2, 'operator', '4b583376b2767b923c3e1da60d10de59', NULL, 2, NULL, '1', 0),
(3, 'member', 'aa08769cdcb26674c6706093503ff0a3', '3', 3, NULL, '1', 0),
(4, 'asep', 'dc855efb0dc7476760afaa1b281665f1', '0', 3, 'AsepSulanjana@gmail.com', '123', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
