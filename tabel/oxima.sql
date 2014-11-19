-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2014 at 07:19 AM
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
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'Member');

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
  `show` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `position`, `groups`, `label`, `module_id`, `param`, `show`) VALUES
(1, 0, 'topleft', '*', 'Beranda', 1, '', 1),
(2, 0, 'topleft', '*', 'Profil', 0, '', 1),
(3, 2, 'topleft', '*', 'Profil Perusahaan', 0, '', 1),
(4, 2, 'topleft', '*', 'Profil Produk', 0, '', 1),
(5, 0, 'topright', '*', 'Settings', 0, '', 1),
(6, 0, 'topright', '*', 'Logout', 0, '', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `controller`, `action`, `routes`, `params`) VALUES
(1, 'welcome', 'index', 'beranda', ''),
(2, 'welcome', 'test', 'ambil-angka/(:any)', '$1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setupkey`, `setupvalue`) VALUES
(1, 'LAYOUT', 'default');

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

INSERT INTO `tbl_users` (`id`, `username`, `password`, `user_type`, `email`, `phone`) VALUES
(1, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'Melangbong@yahoo.com', '85759979248');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE IF NOT EXISTS `tbl_user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
