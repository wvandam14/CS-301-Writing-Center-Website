-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2015 at 06:51 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `writingcenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdetails`
--

CREATE TABLE IF NOT EXISTS `accountdetails` (
  `accountDetailId` int(11) NOT NULL AUTO_INCREMENT,
  `class_standing` varchar(50) NOT NULL,
  `graduation_year` int(10) unsigned DEFAULT NULL,
  `major` varchar(50) NOT NULL,
  `secondary_major` varchar(50) DEFAULT NULL,
  `minor` varchar(50) DEFAULT NULL,
  `bio` text,
  `missed_appointments` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`accountDetailId`),
  UNIQUE KEY `accountDetailId` (`accountDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountId` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `accountTypeId` int(11) NOT NULL,
  `accountDetails` int(11) DEFAULT NULL,
  PRIMARY KEY (`accountId`),
  UNIQUE KEY `accountId` (`accountId`),
  KEY `accountTypeId` (`accountTypeId`),
  KEY `accountDetails` (`accountDetails`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountId`, `fname`, `lname`, `email_address`, `password`, `accountTypeId`, `accountDetails`) VALUES
(1, 'Alpha', 'Admin', 'alpha@ex.com', '202cb962ac59075b964b07152d234b70', 1, NULL),
(2, 'Bravo', 'Consultant', 'bravo@ex.com', '202cb962ac59075b964b07152d234b70', 2, NULL),
(3, 'Charlie', 'User', 'charlie@ex.com', '202cb962ac59075b964b07152d234b70', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounttypes`
--

CREATE TABLE IF NOT EXISTS `accounttypes` (
  `accountTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`accountTypeId`),
  UNIQUE KEY `accountTypeId` (`accountTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accounttypes`
--

INSERT INTO `accounttypes` (`accountTypeId`, `type`) VALUES
(1, 'admin'),
(2, 'consultant'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_number` varchar(45) DEFAULT NULL,
  `course_name` varchar(45) DEFAULT NULL,
  `instructor` varchar(45) DEFAULT NULL,
  `assignment` varchar(200) DEFAULT NULL,
  `send_post_consultation_notes` tinyint(1) DEFAULT NULL,
  `appointment_missed` tinyint(1) DEFAULT NULL,
  `appointment_cancelled` tinyint(1) DEFAULT NULL,
  `description` text,
  `schedule_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_appointments_accounts1_idx` (`client_id`),
  KEY `fk_appointments_accounts2_idx` (`consultant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `course_number`, `course_name`, `instructor`, `assignment`, `send_post_consultation_notes`, `appointment_missed`, `appointment_cancelled`, `description`, `schedule_id`, `client_id`, `consultant_id`) VALUES
(1, 'CS472', 'Software Engineering', 'Pete Tucker', 'Ex03', 1, 0, 1, 'Update the writing center scheduling app', 1, 1, 2),
(2, 'CS355', 'Intro to Bioinformatics', 'Kent Jones', '3A', 0, 0, 1, 'Motiff finding ', 5, 1, 3),
(3, 'CS357', 'Computer Graphics', 'Kent Jones', 'HW7', 1, 0, 0, 'Transformations blah blah blah', 6, 1, 2),
(4, 'CS396', 'Network Security and Hacking', 'Edward Walker', 'Assignment 07', 1, 0, 1, 'Buffer Overflow attack', 4, 1, 3),
(5, 'CS355', 'Intro to Bioinformatics', 'Kent Jones', 'HW06', 0, 0, 1, 'Something', 3, 1, 2),
(6, 'CS472', 'Software Engineering', 'Pete Tucker', 'Ex03', 1, 0, 0, 'Something......', 5, 1, 3),
(7, 'CS355', 'Intro to Bioinformatics', 'Kent Jones', 'HW06', 1, 0, 0, 'asasasasasasasasas', 4, 1, 3),
(8, 'CS472', 'Software Engineering', 'Pete Tucker', 'Ex03', 1, 0, 0, 'sdsdsdsdsdsd', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `consultant_evaluation_form`
--

CREATE TABLE IF NOT EXISTS `consultant_evaluation_form` (
  `FormId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Consultant_ID` int(11) DEFAULT NULL,
  `Date_` date DEFAULT NULL,
  `Explained_Ideas` int(11) DEFAULT NULL,
  `Addressed_Concerns` int(11) DEFAULT NULL,
  `Comfortable` int(11) DEFAULT NULL,
  `Learned` text,
  `Additional_Feedback` text,
  PRIMARY KEY (`FormId`),
  UNIQUE KEY `FormId` (`FormId`),
  KEY `Consultant_ID` (`Consultant_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_options`
--

CREATE TABLE IF NOT EXISTS `email_options` (
  `Client_ID` int(11) DEFAULT NULL,
  `Make_appt` tinyint(1) DEFAULT NULL,
  `Modify_appt` tinyint(1) DEFAULT NULL,
  `Delete_appt` tinyint(1) DEFAULT NULL,
  `Announcement` tinyint(1) DEFAULT NULL,
  `Reminderof_appt` tinyint(1) DEFAULT NULL,
  `iCal_link` tinyint(1) DEFAULT NULL,
  KEY `Client_ID` (`Client_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageId` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pageId`),
  UNIQUE KEY `pageId` (`pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_consultation_notes`
--

CREATE TABLE IF NOT EXISTS `post_consultation_notes` (
  `FormID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Client_ID` int(11) NOT NULL,
  `Consultant_ID` int(11) NOT NULL,
  `Native_Language` varchar(50) DEFAULT NULL,
  `Copy_Sent` tinyint(1) DEFAULT NULL,
  `Class_` varchar(50) DEFAULT NULL,
  `Assignment` varchar(100) DEFAULT NULL,
  `Professor` varchar(50) DEFAULT NULL,
  `Date_` date DEFAULT NULL,
  `Understand_Assignment` tinyint(1) DEFAULT NULL,
  `Generate_Ideas` varchar(10) DEFAULT NULL,
  `Thesis` varchar(10) DEFAULT NULL,
  `Focusing_Subject` varchar(10) DEFAULT NULL,
  `Audience` varchar(10) DEFAULT NULL,
  `Organization` varchar(10) DEFAULT NULL,
  `Content_Development` varchar(10) DEFAULT NULL,
  `Introduction_Conclusion` varchar(10) DEFAULT NULL,
  `Sources_Research` varchar(10) DEFAULT NULL,
  `Citations` varchar(10) DEFAULT NULL,
  `Document_Design` varchar(10) DEFAULT NULL,
  `Sentence_Structure` varchar(10) DEFAULT NULL,
  `Grammar_Mechanics` varchar(10) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`FormID`),
  UNIQUE KEY `FormID` (`FormID`),
  KEY `Client_ID` (`Client_ID`),
  KEY `Consultant_ID` (`Consultant_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `scheduleID` int(11) NOT NULL AUTO_INCREMENT,
  `consultantID` int(11) NOT NULL,
  `date_` date DEFAULT NULL,
  `time_slot` varchar(5) DEFAULT NULL,
  `status_` varchar(20) DEFAULT NULL,
  `adminID` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`scheduleID`),
  UNIQUE KEY `scheduleID` (`scheduleID`),
  KEY `consultantID` (`consultantID`),
  KEY `adminID` (`adminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`scheduleID`, `consultantID`, `date_`, `time_slot`, `status_`, `adminID`, `date_created`) VALUES
(1, 2, '2015-05-14', '0800', 'occupied', 1, '2015-03-15 00:32:29'),
(2, 3, '2015-05-14', '0830', 'available', 1, '2015-03-14 00:11:49'),
(3, 2, '2015-05-14', '0830', 'available', 1, '2015-03-14 00:49:19'),
(4, 3, '2015-05-14', '0930', 'occupied', 1, '2015-03-14 00:54:36'),
(5, 3, '2015-05-14', '1000', 'occupied', 1, '2015-03-14 00:50:34'),
(6, 2, '2015-05-15', '0800', 'available', 1, '2015-03-14 00:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `viewpagepermissions`
--

CREATE TABLE IF NOT EXISTS `viewpagepermissions` (
  `permId` int(11) NOT NULL AUTO_INCREMENT,
  `accountTypeId` int(11) NOT NULL,
  `pageId` int(11) NOT NULL,
  PRIMARY KEY (`permId`),
  UNIQUE KEY `permId` (`permId`),
  KEY `accountTypeId` (`accountTypeId`),
  KEY `pageId` (`pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`accountTypeId`) REFERENCES `accounttypes` (`accountTypeId`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`accountDetails`) REFERENCES `accountdetails` (`accountDetailId`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointments_accounts1` FOREIGN KEY (`client_id`) REFERENCES `accounts` (`accountId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_appointments_accounts2` FOREIGN KEY (`consultant_id`) REFERENCES `accounts` (`accountId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `consultant_evaluation_form`
--
ALTER TABLE `consultant_evaluation_form`
  ADD CONSTRAINT `consultant_evaluation_form_ibfk_1` FOREIGN KEY (`Consultant_ID`) REFERENCES `accounts` (`accountId`);

--
-- Constraints for table `email_options`
--
ALTER TABLE `email_options`
  ADD CONSTRAINT `email_options_ibfk_1` FOREIGN KEY (`Client_ID`) REFERENCES `accounts` (`accountId`);

--
-- Constraints for table `post_consultation_notes`
--
ALTER TABLE `post_consultation_notes`
  ADD CONSTRAINT `post_consultation_notes_ibfk_1` FOREIGN KEY (`Client_ID`) REFERENCES `accounts` (`accountId`),
  ADD CONSTRAINT `post_consultation_notes_ibfk_2` FOREIGN KEY (`Consultant_ID`) REFERENCES `accounts` (`accountId`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`consultantID`) REFERENCES `accounts` (`accountId`),
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`adminID`) REFERENCES `accounts` (`accountId`);

--
-- Constraints for table `viewpagepermissions`
--
ALTER TABLE `viewpagepermissions`
  ADD CONSTRAINT `viewpagepermissions_ibfk_1` FOREIGN KEY (`accountTypeId`) REFERENCES `accounttypes` (`accountTypeId`),
  ADD CONSTRAINT `viewpagepermissions_ibfk_2` FOREIGN KEY (`pageId`) REFERENCES `pages` (`pageId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
