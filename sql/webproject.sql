-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2014 at 10:43 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `web_report_details`
--

CREATE TABLE IF NOT EXISTS `web_report_details` (
  `report_id` int(10) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(17,14) NOT NULL,
  `longitude` decimal(17,14) NOT NULL,
  `category_id` int(10) NOT NULL,
  UNIQUE KEY `report_id` (`report_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_report_details`
--

INSERT INTO `web_report_details` (`report_id`, `title`, `description`, `latitude`, `longitude`, `category_id`) VALUES
(1, 'Κατούρησε στο πηγάδι', '23χρονος φοιτητής κατούρησε στο πηγάδι και μολύνθηκε ολόκληρη η περιοχή του.', '38.25006000000000', '21.73737600000000', 1),
(2, 'Βγήκε από το σπίτι', '22χρονος φοιτητής βγήκε από το σπίτι του μετά από 2 μήνες! Φίλοι και συγγενείς να σπεύσουν να επικοινωνήσουν μαζί του.', '38.23658700000000', '21.73395800000000', 1),
(3, 'Βρώμικα νερά', 'στο πασαλιμάνι', '39.00000000000000', '22.00000000000000', 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `web_report_details`
--
ALTER TABLE `web_report_details`
  ADD CONSTRAINT `FK_report_detail` FOREIGN KEY (`report_id`) REFERENCES `web_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
