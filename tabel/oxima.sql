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
-- Table structure for table `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bonus` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buyback`
--

CREATE TABLE IF NOT EXISTS `buyback` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `contents`
--

INSERT INTO `contents` (`id`, `key`, `text`) VALUES
(1, 'HOME_TEXT_HEADER', 'Produk ini dapat membantu menyembuhkan berbagai macam penyakit yang disebabkan oleh faktor pola makan, cara hidup dan lingkungan. Diantara penyakit tersebut adalah: Kanker, Diabetes, Stroke, Asam Urat, Jantung, Paru-paru, Hepatitis A-B-C, Tumor, Penuaan Dini dan lain-lain'),
(2, 'OXIMA_COMPANY_PROFILE', 'ini deskripsi dari company profile'),
(3, 'OXIMA_COMPANY_PRODUCT', 'ini deskripsi oxima company product');

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
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` bigint(20) DEFAULT NULL,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
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
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `position`, `groups`, `label`, `module_id`, `param`, `custom_url`, `show`) VALUES
(1, NULL, 'top', '*', 'Home', 1, '', '', 1),
(2, NULL, 'top', '*', 'Tentang Kami', NULL, '', '', 1),
(3, NULL, 'top', '*', 'Members', NULL, '', '', 1),
(4, NULL, 'top', '*', 'Register', NULL, '', '', 1),
(5, NULL, 'top', '*', 'News', 8, '', '', 1),
(6, NULL, 'top', '*', 'Promo', 10, '', '', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `modules`
--

INSERT INTO `modules` (`id`, `controller`, `action`, `routes`, `params`) VALUES
(1, 'welcome', 'index', 'beranda', ''),
(2, 'welcome', 'test', 'ambil-angka/(:any)', '$1'),
(3, 'auth', 'login', 'user-login', ''),
(4, 'auth', 'logout', 'user-logout', ''),
(5, 'member', 'index', 'register', ''),
(6, 'company', 'profile', 'company-profile', ''),
(7, 'company', 'product', 'company-product', ''),
(8, 'news', 'news_list', 'news', ''),
(9, 'news', 'news_detail', 'news_detail/(:any)', '$1'),
(10, 'promo', 'promo_list', 'promo', ''),
(11, 'promo', 'promo_detail', 'promo_detail/(:any)', '$1');


-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `news_title`, `news_description`, `create_date`) VALUES
(1, 'News 1', 'isi news 1', '2014-11-26 14:12:50'),
(2, 'News 2', 'isi news 2', '2014-11-26 14:12:50');


-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_title` varchar(255) NOT NULL,
  `promo_description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id`, `promo_title`, `promo_description`, `create_date`) VALUES
(1, 'Promo 1', 'isi promo 1', '2014-11-26 14:12:50'),
(2, 'Promo 2', 'isi promo 2', '2014-11-26 14:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `parent_childs`
--

CREATE TABLE IF NOT EXISTS `parent_childs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titik_id` bigint(20) DEFAULT NULL,
  `parent_child_id` bigint(20) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_child_id` (`parent_child_id`),
  KEY `titik_id` (`titik_id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE IF NOT EXISTS `pins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pin` varchar(12) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` bigint(20) DEFAULT NULL,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pin` (`pin`),
  KEY `user_id` (`user_id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
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
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ref_id` bigint(20) DEFAULT NULL,
  `description` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ref_id` (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_pins`
--

CREATE TABLE IF NOT EXISTS `reserved_pins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pin_id` bigint(20) DEFAULT NULL,
  `idbarang_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pin_id` (`pin_id`),
  KEY `idbarang_id` (`idbarang_id`),
  KEY `user_id` (`user_id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
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
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idbarang_id` (`idbarang_id`),
  KEY `user_id` (`user_id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
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
  `stokis` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` bigint(20) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`),
  KEY `user_type` (`group_id`),
  KEY `pin_id` (`pin_id`),
  KEY `create_by` (`create_by`),
  KEY `update_by` (`update_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `pin_id`, `group_id`, `email`, `phone`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, 'Melangbong@yahoo.com', '85759979248', 0),
(2, 'operator', '4b583376b2767b923c3e1da60d10de59', NULL, 2, NULL, '1', 0),
(3, 'member', 'aa08769cdcb26674c6706093503ff0a3', '3', 3, NULL, '1', 0),
(4, 'asep', 'dc855efb0dc7476760afaa1b281665f1', '0', 3, 'AsepSulanjana@gmail.com', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_bonus`
--

CREATE TABLE IF NOT EXISTS `user_bonus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `bonus_id` int(11) NOT NULL,
  `bonus` bigint(20) NOT NULL,
  `bonus_cut` bigint(20) NOT NULL,
  `newmember_id` bigint(20) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `bonus_id` (`bonus_id`),
  KEY `newmember_id` (`newmember_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_sponsor`
--

CREATE TABLE IF NOT EXISTS `user_sponsor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `titik_id` bigint(20) NOT NULL,
  `sponsor_id` bigint(20) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `titik_id` (`titik_id`),
  KEY `sponsor_id` (`sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `amount` bigint(20) NOT NULL,
  `charge` bigint(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `transfer_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonus`
--
ALTER TABLE `bonus`
  ADD CONSTRAINT `bonus_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bonus_ibfk_2` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `buyback`
--
ALTER TABLE `buyback`
  ADD CONSTRAINT `buyback_ibfk_3` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `buyback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `buyback_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `idbarangs`
--
ALTER TABLE `idbarangs`
  ADD CONSTRAINT `idbarangs_ibfk_3` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idbarangs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idbarangs_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `parent_childs`
--
ALTER TABLE `parent_childs`
  ADD CONSTRAINT `parent_childs_ibfk_5` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `parent_childs_ibfk_2` FOREIGN KEY (`titik_id`) REFERENCES `titiks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `parent_childs_ibfk_3` FOREIGN KEY (`parent_child_id`) REFERENCES `titiks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `parent_childs_ibfk_4` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pins`
--
ALTER TABLE `pins`
  ADD CONSTRAINT `pins_ibfk_3` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pins_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`sponsor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`ref_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reserved_pins`
--
ALTER TABLE `reserved_pins`
  ADD CONSTRAINT `reserved_pins_ibfk_5` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserved_pins_ibfk_1` FOREIGN KEY (`pin_id`) REFERENCES `pins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserved_pins_ibfk_2` FOREIGN KEY (`idbarang_id`) REFERENCES `idbarangs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserved_pins_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserved_pins_ibfk_4` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resets`
--
ALTER TABLE `resets`
  ADD CONSTRAINT `resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `titiks`
--
ALTER TABLE `titiks`
  ADD CONSTRAINT `titiks_ibfk_4` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titiks_ibfk_1` FOREIGN KEY (`idbarang_id`) REFERENCES `idbarangs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titiks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titiks_ibfk_3` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_6` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`pin_id`) REFERENCES `pins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_5` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_bonus`
--
ALTER TABLE `user_bonus`
  ADD CONSTRAINT `user_bonus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_bonus_ibfk_2` FOREIGN KEY (`bonus_id`) REFERENCES `bonus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_bonus_ibfk_3` FOREIGN KEY (`newmember_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_sponsor`
--
ALTER TABLE `user_sponsor`
  ADD CONSTRAINT `user_sponsor_ibfk_3` FOREIGN KEY (`sponsor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_sponsor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_sponsor_ibfk_2` FOREIGN KEY (`titik_id`) REFERENCES `titiks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `withdraw_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;