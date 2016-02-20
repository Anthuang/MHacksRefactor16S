-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2016 at 04:45 AM
-- Server version: 5.5.27
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `MHacksRefactor16s`
--

-- --------------------------------------------------------

--
-- Table structure for table `LongLat`
--

CREATE TABLE IF NOT EXISTS `LongLat` (
  `Idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User` varchar(16) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  PRIMARY KEY (`Idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `LongLat`
--

INSERT INTO `LongLat` (`Idx`, `User`, `lat`, `lng`) VALUES
(35, 'thomaseh', 42.294, -83.721),
(36, 'thomaseh', 42.294, -83.717),
(37, 'thomaseh', 42.294, -83.723),
(38, 'thomaseh', 42.294, -83.726),
(39, 'thomaseh', 42.295, -83.725);

-- --------------------------------------------------------

--
-- Table structure for table `LostAndFound`
--

CREATE TABLE IF NOT EXISTS `LostAndFound` (
  `MarkerIdx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User` varchar(16) NOT NULL,
  `Item` varchar(32) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `Date` varchar(10) NOT NULL,
  `Time` varchar(5) NOT NULL,
  `QuestionOne` varchar(128) NOT NULL,
  `QuestionTwo` varchar(128) NOT NULL,
  `QuestionThree` varchar(128) NOT NULL,
  `Found` tinyint(1) NOT NULL,
  PRIMARY KEY (`MarkerIdx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `LostAndFound`
--

INSERT INTO `LostAndFound` (`MarkerIdx`, `User`, `Item`, `Latitude`, `Longitude`, `Date`, `Time`, `QuestionOne`, `QuestionTwo`, `QuestionThree`, `Found`) VALUES
(1, 'thomaseh', '1', 2, 3, '4', '5', '6', '7', '8', 1),
(19, 'thomaseh', '1', 42.292, -83.724, '1', '1', '2', '3', '4', 1),
(39, 'thomaseh', '1', 42.295, -83.725, '1', '1', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(16) NOT NULL,
  `Password` varchar(32) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Username`, `Password`) VALUES
(5, 'thomaseh', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
