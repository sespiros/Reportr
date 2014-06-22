-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2014 at 11:15 PM
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
-- Table structure for table `web_categories`
--

CREATE TABLE IF NOT EXISTS `web_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `web_categories`
--

INSERT INTO `web_categories` (`id`, `name`) VALUES
(1, 'Uncategorized'),
(2, 'Γενικά'),
(3, 'Κατοικία'),
(4, 'Skaees');

-- --------------------------------------------------------

--
-- Table structure for table `web_reports`
--

CREATE TABLE IF NOT EXISTS `web_reports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time_submitted` datetime NOT NULL,
  `time_closed` datetime NOT NULL,
  `status` enum('Closed','Open','','') NOT NULL,
  `submitter_id` int(11) NOT NULL,
  `closer_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submitted_id` (`submitter_id`),
  KEY `closer_id` (`closer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `web_reports`
--

INSERT INTO `web_reports` (`id`, `time_submitted`, `time_closed`, `status`, `submitter_id`, `closer_id`, `comment`) VALUES
(1, '2014-04-19 07:28:00', '2014-04-19 07:32:00', 'Open', 3, 0, ''),
(2, '2014-04-09 00:00:00', '2014-04-09 00:20:00', 'Open', 3, 0, ''),
(3, '2014-06-17 18:34:15', '0000-00-00 00:00:00', 'Open', 3, 0, '');

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

-- --------------------------------------------------------

--
-- Table structure for table `web_report_images`
--

CREATE TABLE IF NOT EXISTS `web_report_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `report_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_report_image` (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `web_report_images`
--

INSERT INTO `web_report_images` (`id`, `path`, `report_id`) VALUES
(4, 'views/images/ab4350d80d1598d94a61af78e356eb34.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

CREATE TABLE IF NOT EXISTS `web_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  `user_password_hash` varchar(255) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_rememberme_token` varchar(64) DEFAULT NULL,
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0',
  `user_last_failed_login` int(10) DEFAULT NULL,
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) NOT NULL DEFAULT '0.0.0.0',
  `user_type` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_type`) VALUES
(3, 'sespiros', '$2y$10$nbyi3yodQ240KoxVJYCqEepC4SNLGljv1wa6/Ikb9LqMP99V8NLm2', 'sespiros@gmail.com', NULL, 0, NULL, '2014-04-15 23:49:57', '127.0.0.1', 1),
(4, 'joe', '$2y$10$nbyi3yodQ240KoxVJYCqEepC4SNLGljv1wa6/Ikb9LqMP99V8NLm2', 'joe@example.com', NULL, 0, NULL, '2014-04-15 23:49:57', '127.0.0.1', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `web_reports`
--
ALTER TABLE `web_reports`
  ADD CONSTRAINT `FK_report_users` FOREIGN KEY (`submitter_id`) REFERENCES `web_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `web_report_details`
--
ALTER TABLE `web_report_details`
  ADD CONSTRAINT `FK_report_detail` FOREIGN KEY (`report_id`) REFERENCES `web_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `web_report_images`
--
ALTER TABLE `web_report_images`
  ADD CONSTRAINT `FK_report_image` FOREIGN KEY (`report_id`) REFERENCES `web_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
