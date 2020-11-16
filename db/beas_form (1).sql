-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2020 at 12:51 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beas_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `is_active`, `is_deleted`) VALUES
(1, 'Security', 1, 0),
(2, 'Langar', 1, 0),
(3, 'Langar Store', 1, 0),
(4, 'Sanitation', 1, 0),
(5, 'Engg. Dept.', 1, 0),
(6, 'Tile Store', 1, 0),
(7, 'Mechanical ', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jatha`
--

DROP TABLE IF EXISTS `jatha`;
CREATE TABLE IF NOT EXISTS `jatha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` bigint(20) NOT NULL,
  `centre` varchar(225) NOT NULL,
  `male` int(11) NOT NULL,
  `female` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jatha`
--

INSERT INTO `jatha` (`id`, `reg_no`, `centre`, `male`, `female`, `total`, `destination`, `from_date`, `to_date`, `status`, `created_on`, `created_by`) VALUES
(3, 14, 'Baltana', 23, 23, 46, 2, '2020-11-12', '2020-11-26', '2', '2020-11-12', 1),
(4, 15, 'LALRU', 10, 15, 25, 5, '2020-11-11', '2020-11-30', '1', '2020-11-12', 1),
(5, 16, 'mukatsar', 23, 15, 38, 1, '2020-11-11', '2020-11-24', '1', '2020-11-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1603971075),
('m130524_201442_init', 1603971076),
('m190124_110200_add_verification_token_column_to_user_table', 1603971076);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `f_h_name` varchar(512) NOT NULL,
  `age` varchar(512) NOT NULL,
  `gender` int(11) NOT NULL,
  `jatha` int(11) NOT NULL,
  `admitted_date` date NOT NULL,
  `discharge_date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `f_h_name`, `age`, `gender`, `jatha`, `admitted_date`, `discharge_date`, `status`) VALUES
(1, 'Varinder Kumaree', 'Prem singh', '34', 1, 3, '2020-12-01', '2020-12-04', 4),
(2, 'Varinder Kumar11', 'Prem singh11', '34', 1, 3, '1970-01-01', '1970-01-01', 5);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `position` tinyint(4) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `is_active`, `position`, `is_deleted`) VALUES
(1, 'Quarantine', 1, 1, 0),
(2, 'Detained', 1, 1, 0),
(3, 'Out for sewa', 1, 1, 0),
(4, 'Shed Isolated', 1, 2, 0),
(5, 'Dera Hospital', 1, 2, 0),
(6, 'Beas Hospital', 1, 2, 0),
(7, 'Discharge', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'LalRf9nZwo7kJI4aNV0-_lve-AdqEpQr', '$2y$13$XonvKdx4cQP/qXF3gvv57.e8j7BXIhZPAqCIczkR7JGUr.6Ocis1S', NULL, 'admin@gmail.com', 10, 1603971338, 1603971338, 'No2uMYgOhcRj5QV9fN-d_U5NM22f8dmq_1603971338');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
