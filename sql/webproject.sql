-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2014 at 04:21 PM
-- Server version: 5.5.36-MariaDB-log
-- PHP Version: 5.5.11

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `web_categories`
--

INSERT INTO `web_categories` (`id`, `name`) VALUES
(1, 'Uncategorized');

-- --------------------------------------------------------

--
-- Table structure for table `web_event`
--

CREATE TABLE IF NOT EXISTS `web_event` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time_submitted` datetime NOT NULL,
  `status` enum('Closed','Open','','') NOT NULL,
  `submitted_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submitted_id` (`submitted_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `web_event`
--

INSERT INTO `web_event` (`id`, `time_submitted`, `status`, `submitted_id`) VALUES
(1, '2014-04-15 15:30:38', 'Open', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_event_details`
--

CREATE TABLE IF NOT EXISTS `web_event_details` (
  `event_id` int(10) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(17,14) NOT NULL,
  `longitude` decimal(17,14) NOT NULL,
  `category_id` int(10) NOT NULL,
  UNIQUE KEY `event_id` (`event_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_event_details`
--

INSERT INTO `web_event_details` (`event_id`, `title`, `description`, `latitude`, `longitude`, `category_id`) VALUES
(1, 'Sample Report', 'This report it to test a sample entry in the database.', '39.55000000000000', '21.76670000000000', 1);

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

  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`user_id`, `user_name`, `user_password_hash`, `user_email`) VALUES
(1, 'petros', 'd0ff2d67d042926d1db7e428c35f9bea8713866250cab36f', 'petros@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `web_user_details`
--

CREATE TABLE IF NOT EXISTS `web_user_details` (
  `id` int(11) NOT NULL,
  `role` enum('Admin','Regular','','') NOT NULL DEFAULT 'Regular',
  `phone` varchar(15) NOT NULL,
  `name` varchar(60) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_user_details`
--

INSERT INTO `web_user_details` (`id`, `role`, `phone`, `name`) VALUES
(1, 'Regular', '6974569825', 'Petros Jojomas');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `web_event`
--
ALTER TABLE `web_event`
  ADD CONSTRAINT `FK_event_users` FOREIGN KEY (`submitted_id`) REFERENCES `web_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `web_event_details`
--
ALTER TABLE `web_event_details`
  ADD CONSTRAINT `FK_event_detail` FOREIGN KEY (`event_id`) REFERENCES `web_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `web_user_details`
--
ALTER TABLE `web_user_details`
  ADD CONSTRAINT `FK_user_detail` FOREIGN KEY (`id`) REFERENCES `web_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
