-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2020 at 10:14 PM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `tanswer`
--

DROP TABLE IF EXISTS `tanswer`;
CREATE TABLE IF NOT EXISTS `tanswer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `descriptionId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `companyId` varchar(50) NOT NULL,
  `jawaban` varchar(1) NOT NULL,
  `jawabanA` int(11) NOT NULL,
  `jawabanB` int(11) NOT NULL,
  `jawabanC` int(11) NOT NULL,
  `jawabanD` int(11) NOT NULL,
  `jawabanE` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `descriptionId` (`descriptionId`),
  KEY `groupId` (`groupId`),
  KEY `groupId_2` (`groupId`),
  KEY `companyId` (`companyId`),
  KEY `groupId_3` (`groupId`),
  KEY `companyId_2` (`companyId`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanswer`
--

INSERT INTO `tanswer` (`Id`, `descriptionId`, `groupId`, `companyId`, `jawaban`, `jawabanA`, `jawabanB`, `jawabanC`, `jawabanD`, `jawabanE`) VALUES
(166, 23, 7, '20161126 065414', 'B', 0, 1, 0, 0, 0),
(167, 24, 7, '20161126 065414', 'B', 0, 1, 0, 0, 0),
(168, 25, 7, '20161126 065414', 'B', 0, 1, 0, 0, 0),
(185, 23, 7, '20201213 041654', 'A', 1, 0, 0, 0, 0),
(186, 24, 7, '20201213 041654', 'B', 0, 1, 0, 0, 0),
(187, 25, 7, '20201213 041654', 'A', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tcompany`
--

DROP TABLE IF EXISTS `tcompany`;
CREATE TABLE IF NOT EXISTS `tcompany` (
  `companyId` varchar(50) NOT NULL,
  `companyName` varchar(30) NOT NULL,
  `companyAddress` text NOT NULL,
  `companyPhoneHp` varchar(30) NOT NULL,
  `dateSurvey` varchar(30) NOT NULL,
  `suggestion` text NOT NULL,
  `product` varchar(40) NOT NULL,
  PRIMARY KEY (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tcompany`
--

INSERT INTO `tcompany` (`companyId`, `companyName`, `companyAddress`, `companyPhoneHp`, `dateSurvey`, `suggestion`, `product`) VALUES
('20161126 065414', 'badu', 'jambi', ' / 0088888', '2016-11-26', 'sudah baik', 'Kartu Simpati'),
('20201213 041654', 'Badru', 'Bekasi', ' / 0812312', '2020-12-13', 'lumayan', 'Kartu Halo');

-- --------------------------------------------------------

--
-- Table structure for table `tdescription`
--

DROP TABLE IF EXISTS `tdescription`;
CREATE TABLE IF NOT EXISTS `tdescription` (
  `descriptionId` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `groupId` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `ModifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ModifiedUser` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`descriptionId`),
  KEY `groupId` (`groupId`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tdescription`
--

INSERT INTO `tdescription` (`descriptionId`, `description`, `groupId`, `CreatedDate`, `CreatedUser`, `ModifiedDate`, `ModifiedUser`) VALUES
(23, 'Keramahan Customer ervice												', 7, '2016-05-02 03:15:43', 1, '2020-12-13 13:07:12', 1),
(24, 'Kecepatan Respon Customer Service', 7, '2016-05-02 03:16:02', 1, '0000-00-00 00:00:00', 0),
(25, 'Solusi yang Diberikan', 7, '2016-05-02 03:16:25', 1, '0000-00-00 00:00:00', 0),
(43, 'oke', 8, '2020-12-13 21:43:36', 1, '2020-12-14 04:43:36', 0),
(44, 'oke', 10, '2020-12-13 21:43:43', 1, '2020-12-14 04:43:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tgroup`
--

DROP TABLE IF EXISTS `tgroup`;
CREATE TABLE IF NOT EXISTS `tgroup` (
  `groupId` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(255) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `ModifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ModifiedUser` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupId`),
  KEY `CreatedUser` (`CreatedUser`,`ModifiedUser`),
  KEY `CreatedUser_2` (`CreatedUser`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgroup`
--

INSERT INTO `tgroup` (`groupId`, `groupName`, `CreatedDate`, `CreatedUser`, `ModifiedDate`, `ModifiedUser`) VALUES
(7, 'Kecepatan waktu memberikan pelayanan', '2016-05-02 03:11:42', 1, '2020-12-13 13:43:18', 1),
(8, 'Tarif Untuk Pelayanan', '2016-05-02 03:12:03', 1, '2020-12-13 13:41:57', 1),
(10, 'Kualitas Pelayanan', '2016-05-02 03:12:38', 1, '2020-12-13 13:40:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

DROP TABLE IF EXISTS `tuser`;
CREATE TABLE IF NOT EXISTS `tuser` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`userId`, `username`, `password`, `fullname`, `email`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'dela', 'dela@gmail.com', 'Super'),
(2, 'admin2nd', '8b342e1ffc39b0943351612229f7e8e3', 'admin 2nd', 'admin2nd@gmail.com', 'Biasa');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tanswer`
--
ALTER TABLE `tanswer`
  ADD CONSTRAINT `tanswer_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `tcompany` (`companyId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanswer_ibfk_3` FOREIGN KEY (`groupId`) REFERENCES `tgroup` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanswer_ibfk_4` FOREIGN KEY (`descriptionId`) REFERENCES `tdescription` (`descriptionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tdescription`
--
ALTER TABLE `tdescription`
  ADD CONSTRAINT `tdescription_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `tgroup` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
