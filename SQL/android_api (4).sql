-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2014 at 06:49 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `android_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
  `train_id` decimal(3,0) NOT NULL,
  `destination_id` decimal(3,0) NOT NULL,
  `arrival` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`train_id`, `destination_id`, `arrival`) VALUES
(1, 102, '06:13:00'),
(2, 101, '06:13:00'),
(3, 105, '06:09:00'),
(4, 105, '06:10:00'),
(5, 103, '06:22:00'),
(6, 103, '06:12:00'),
(7, 106, '06:15:00'),
(8, 106, '06:15:00'),
(3, 107, '06:20:00'),
(4, 104, '06:20:00'),
(5, 104, '06:25:00'),
(6, 102, '06:17:00'),
(7, 105, '06:21:00'),
(8, 102, '06:21:00'),
(3, 107, '06:22:00'),
(4, 104, '06:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `routemain`
--

CREATE TABLE IF NOT EXISTS `routemain` (
  `RouteName` varchar(3) NOT NULL,
  `RouteNo` int(2) NOT NULL,
  PRIMARY KEY (`RouteNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routemain`
--

INSERT INTO `routemain` (`RouteName`, `RouteNo`) VALUES
('red', 1),
('blu', 2),
('gre', 3),
('yel', 4);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `Route Name` varchar(3) NOT NULL,
  `StationNo` int(3) NOT NULL,
  `RouteStation` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`Route Name`, `StationNo`, `RouteStation`) VALUES
('red', 1, 101),
('red', 2, 102),
('blu', 1, 104),
('blu', 2, 105),
('blu', 3, 107),
('yel', 1, 102),
('yel', 2, 106),
('yel', 3, 105),
('gre', 1, 102),
('gre', 2, 103),
('gre', 3, 104);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `user_name` decimal(10,0) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `train_id` decimal(3,0) DEFAULT NULL,
  `source_id` decimal(3,0) DEFAULT NULL,
  `departure` time DEFAULT NULL,
  KEY `train_id` (`train_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`train_id`, `source_id`, `departure`) VALUES
(1, 101, '06:00:00'),
(2, 102, '06:00:00'),
(3, 104, '06:00:00'),
(4, 107, '06:00:00'),
(5, 102, '06:10:00'),
(6, 104, '06:10:00'),
(7, 102, '06:10:00'),
(8, 105, '06:10:00'),
(3, 105, '06:10:00'),
(4, 105, '06:11:00'),
(5, 103, '06:23:00'),
(6, 103, '06:13:00'),
(7, 106, '06:16:00'),
(8, 106, '06:16:00'),
(4, 102, '06:20:00'),
(3, 104, '06:30:00'),
(3, 105, '06:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE IF NOT EXISTS `station` (
  `station_id` decimal(3,0) NOT NULL,
  `station_name` varchar(10) NOT NULL,
  PRIMARY KEY (`station_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`) VALUES
(101, 'Camp'),
(102, 'LullaNagar'),
(103, 'Kondhwa'),
(104, 'Katraj'),
(105, 'FC'),
(106, 'Hadapsar'),
(107, 'Kothrud');

-- --------------------------------------------------------

--
-- Table structure for table `switch`
--

CREATE TABLE IF NOT EXISTS `switch` (
  `StationNo` int(3) NOT NULL,
  `Routeto` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `switch`
--

INSERT INTO `switch` (`StationNo`, `Routeto`) VALUES
(102, 3),
(102, 4),
(104, 3),
(104, 2),
(105, 2),
(105, 4),
(102, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketno` int(3) NOT NULL,
  `uni_id` varchar(23) NOT NULL,
  `src` int(3) NOT NULL,
  `dest` int(3) NOT NULL,
  `depttime` time NOT NULL,
  `arrtime` time NOT NULL,
  `route_no` int(3) NOT NULL,
  `cost` int(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `checked` int(11) NOT NULL,
  `bits` double NOT NULL,
  `paid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timecost`
--

CREATE TABLE IF NOT EXISTS `timecost` (
  `from` int(3) NOT NULL,
  `to` int(3) NOT NULL,
  `cost` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timecost`
--

INSERT INTO `timecost` (`from`, `to`, `cost`) VALUES
(101, 102, 13),
(102, 103, 12),
(102, 106, 5),
(103, 104, 2),
(104, 105, 9),
(105, 106, 5),
(105, 107, 10);

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE IF NOT EXISTS `train` (
  `trainid` decimal(3,0) NOT NULL,
  `train_name` varchar(10) NOT NULL,
  PRIMARY KEY (`trainid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`trainid`, `train_name`) VALUES
(1, 'T1A'),
(2, 'T1B'),
(3, 'T2A'),
(4, 'T2B'),
(5, 'T3A'),
(6, 'T3B'),
(7, 'T4A'),
(8, 'T4B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(23) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobileno` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthd` varchar(30) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(30) NOT NULL,
  `cntry` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `encrypted_password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `unique_id` (`unique_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `unique_id`, `name`, `mobileno`, `gender`, `birthd`, `addr`, `city`, `state`, `cntry`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(1, '538430411a4015.26510894', 'Nishi', '9921899779', 'male', '5-27-2014 ', 'Hadapsar', 'Pune', 'Maharashtra', 'India ', 'Mokashi', 'lE/mUb+9Cr2E+wPCOI9O1RDKiXljZGVlY2YxMWMz', 'cdeecf11c3', '2014-05-27 11:57:13', NULL);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `validity` ON SCHEDULE EVERY 2 MINUTE STARTS '2014-05-29 00:00:00' ENDS '2014-06-30 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `ticket` WHERE DATE_FORMAT(arrtime,'%H:%i:%s') < NOW()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
