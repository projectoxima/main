-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2014 at 02:30 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `titiks`
--

INSERT INTO `titiks` (`id`, `idbarang_id`, `user_id`, `create_time`, `create_by`, `update_time`, `update_by`) VALUES
(1, 1, 3, '2014-11-29 15:23:11', 1, '0000-00-00 00:00:00', 1),
(2, 2, 3, '2014-11-29 15:23:11', 1, '0000-00-00 00:00:00', 1),
(3, 3, 5, '2014-12-01 07:24:30', 3, '0000-00-00 00:00:00', NULL),
(4, 4, 3, '2014-12-01 07:24:30', 3, '0000-00-00 00:00:00', NULL),
(5, 5, 5, '2014-12-09 04:49:26', 3, '0000-00-00 00:00:00', NULL),
(6, 6, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(7, 7, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(8, 8, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(9, 9, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(10, 10, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(11, 11, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(12, 12, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL),
(13, 13, 3, '2014-12-09 04:50:04', 3, '0000-00-00 00:00:00', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `titiks`
--
ALTER TABLE `titiks`
  ADD CONSTRAINT `titiks_ibfk_1` FOREIGN KEY (`idbarang_id`) REFERENCES `idbarangs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titiks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titiks_ibfk_3` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titiks_ibfk_4` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
