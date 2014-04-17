-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 17 Απρ 2014 στις 19:00:48
-- Έκδοση διακομιστή: 5.6.16
-- Έκδοση PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση δεδομένων: `webproject`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_categories`
--

CREATE TABLE IF NOT EXISTS `web_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Άδειασμα δεδομένων του πίνακα `web_categories`
--

INSERT INTO `web_categories` (`id`, `name`) VALUES
(1, 'Uncategorized');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_event`
--

CREATE TABLE IF NOT EXISTS `web_event` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time_submitted` datetime NOT NULL,
  `status` enum('Closed','Open','','') NOT NULL,
  `submitted_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submitted_id` (`submitted_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_event_details`
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

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_users`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Άδειασμα δεδομένων του πίνακα `web_users`
--

INSERT INTO `web_users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_type`) VALUES
(3, 'sespiros', '$2y$10$nbyi3yodQ240KoxVJYCqEepC4SNLGljv1wa6/Ikb9LqMP99V8NLm2', 'sespiros@gmail.com', NULL, 0, NULL, '2014-04-15 23:49:57', '127.0.0.1', 1),
(4, 'joe', '$2y$10$nbyi3yodQ240KoxVJYCqEepC4SNLGljv1wa6/Ikb9LqMP99V8NLm2', 'joe@example.com', NULL, 0, NULL, '2014-04-15 23:49:57', '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_user_details`
--

CREATE TABLE IF NOT EXISTS `web_user_details` (
  `id` int(11) NOT NULL,
  `role` enum('Admin','Regular','','') NOT NULL DEFAULT 'Regular',
  `phone` varchar(15) NOT NULL,
  `name` varchar(60) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `web_event`
--
ALTER TABLE `web_event`
  ADD CONSTRAINT `FK_event_users` FOREIGN KEY (`submitted_id`) REFERENCES `web_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `web_event_details`
--
ALTER TABLE `web_event_details`
  ADD CONSTRAINT `FK_event_detail` FOREIGN KEY (`event_id`) REFERENCES `web_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `web_user_details`
--
ALTER TABLE `web_user_details`
  ADD CONSTRAINT `FK_user_detail` FOREIGN KEY (`id`) REFERENCES `web_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
