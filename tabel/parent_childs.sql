-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2014 at 02:28 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `parent_childs`
--

INSERT INTO `parent_childs` (`id`, `titik_id`, `parent_child_id`, `create_time`, `create_by`, `update_time`, `update_by`) VALUES
(1, 1, NULL, '2014-12-01 07:23:23', 3, '0000-00-00 00:00:00', NULL),
(2, 2, 1, '2014-12-01 07:23:47', 3, '0000-00-00 00:00:00', NULL),
(3, 3, 1, '2014-12-01 07:25:16', 3, '0000-00-00 00:00:00', NULL),
(4, 4, 1, '2014-12-01 07:25:16', 3, '0000-00-00 00:00:00', NULL),
(5, 5, 2, '2014-12-09 04:52:30', NULL, '0000-00-00 00:00:00', NULL),
(6, 6, 2, '2014-12-09 04:52:30', NULL, '0000-00-00 00:00:00', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parent_childs`
--
ALTER TABLE `parent_childs`
  ADD CONSTRAINT `parent_childs_ibfk_2` FOREIGN KEY (`titik_id`) REFERENCES `titiks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `parent_childs_ibfk_3` FOREIGN KEY (`parent_child_id`) REFERENCES `titiks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `parent_childs_ibfk_4` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `parent_childs_ibfk_5` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
