-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2016 at 03:00 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oldstuff`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `userid` int(50) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `regdno` varchar(20) NOT NULL,
  `classname` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `emailaddr` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL,
  `primage` varchar(200) NOT NULL,
  `regdate` datetime NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`userid`, `uname`, `place`, `regdno`, `classname`, `mobile`, `emailaddr`, `password`, `primage`, `regdate`) VALUES
(1, 'krian', 'password', '313131313131', '1/4 CSE II sem', '9958589898', 'address@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '14900363_123100091498506_8773629376705420931_n.jpg', '0000-00-00 00:00:00'),
(2, 'Thomas', 'Chennai', '312131313121', '2/4 CSE I sem', '1234567890', 'email@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'stock-vector-chick-flat-icon-vector-illustration-eps-212477986.jpg', '0000-00-00 00:00:00'),
(3, 'normal', 'lcoaiton', '313121213131', '2/4 CSE I sem', '1523545658', 'lovely@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1379176017-screenshot-www.vatikag.com.jpg', '2016-11-11 17:26:19'),
(4, 'ssdffffffffff', 'fffffffffffffffffffff', '1gggggggggggggg', '2/4 CSE I sem', '1111111111', 'fffffffffffffffffffffffffff', 'c557422ddf2d7294d2deee28336a4064a04c6e73', 'amyjackson6.jpg', '2016-11-12 20:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `userid`) VALUES
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `rowid` int(50) NOT NULL AUTO_INCREMENT,
  `placerid` varchar(50) NOT NULL,
  `matname` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `matfile` varchar(500) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`rowid`, `placerid`, `matname`, `category`, `matfile`, `datetime`) VALUES
(6, '2', 'Song of the day', 'sm', 'OnlineWebFonts_COM_5a0e62bf18538d2ffceab4fd6136b828 (1).zip', '2016-11-13 14:33:03'),
(7, '2', 'Song of the day', 'sm', '01_-_Asale_Pilla_-_Ghatikudu_(2009)_128Kbps.mp3', '2016-11-13 14:34:01'),
(8, '2', 'phpini', 'ot', 'php.ini', '2016-11-13 15:20:02'),
(9, '2', 'fffgfgdf', 'bo', 'Beginning Android Tablet Games Programming.pdf', '2016-11-13 16:14:36'),
(10, '2', 'gdffdgdfg', 'st', 'dead.wav', '2016-11-13 16:15:51'),
(11, '2', 'bcxb', 'bo', 'Beginning Android Tablet Games Programming.pdf', '2016-11-13 16:17:08'),
(12, '2', 'fdfdfdfdf', 'bo', 'Sell item.pdf', '2016-11-13 16:18:21'),
(13, '2', 'sfdsf', 'bo', 'download (1).png', '2016-11-13 16:30:12'),
(14, '2', 'something', 'tt', '20160630211918.jpg', '2016-11-15 07:49:57'),
(15, '2', 'ddfdf', 'bo', 'Mail-1.2.0.tgz', '2016-11-15 10:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `placedsales`
--

CREATE TABLE IF NOT EXISTS `placedsales` (
  `rowid` int(50) NOT NULL AUTO_INCREMENT,
  `placerid` int(50) NOT NULL,
  `itemname` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `emailaddr` varchar(50) NOT NULL,
  `primage` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `placedsales`
--

INSERT INTO `placedsales` (`rowid`, `placerid`, `itemname`, `price`, `mobile`, `emailaddr`, `primage`, `category`, `date`) VALUES
(6, 1, 'Eraser', '20', '9878987898', 'address@gmail.com', '01-Rashi_Khanna_Stills_At_From_Jil_Movie_Cute_Hot_Photos.jpg', 'Stationary', '2016-11-12 16:50:41'),
(7, 3, 'pencil', '10', '9878987898', 'lovely@gmail.com', 'amyjackson6.jpg', 'Stationary', '2016-11-12 16:51:35'),
(8, 3, 'sugar', '10', '', '', '1379176017-screenshot-www.vatikag.com.jpg', 'Others', '2016-11-12 18:27:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
