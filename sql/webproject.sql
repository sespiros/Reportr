-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 21 Ιουν 2014 στις 04:16:19
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Άδειασμα δεδομένων του πίνακα `web_categories`
--

INSERT INTO `web_categories` (`id`, `name`) VALUES
(1, 'Uncategorized'),
(2, 'Γενικά'),
(3, 'Κατοικία');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_reports`
--

CREATE TABLE IF NOT EXISTS `web_reports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time_submitted` datetime NOT NULL,
  `time_closed` datetime NOT NULL,
  `status` enum('Closed','Open','','') NOT NULL,
  `submitter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submitted_id` (`submitter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Άδειασμα δεδομένων του πίνακα `web_reports`
--

INSERT INTO `web_reports` (`id`, `time_submitted`, `time_closed`, `status`, `submitter_id`) VALUES
(1, '2014-04-19 07:28:00', '2014-04-19 07:32:00', 'Closed', 3),
(2, '2014-04-09 00:00:00', '2014-04-09 00:20:00', 'Closed', 3),
(12, '2014-05-25 20:08:12', '0000-00-00 00:00:00', 'Closed', 3),
(19, '2014-05-25 21:39:49', '0000-00-00 00:00:00', 'Open', 3),
(20, '2014-05-25 21:40:18', '0000-00-00 00:00:00', 'Open', 3),
(21, '2014-05-25 21:41:02', '0000-00-00 00:00:00', 'Open', 3);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_report_details`
--

CREATE TABLE IF NOT EXISTS `web_report_details` (
  `report_id` int(10) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(17,14) NOT NULL,
  `longitude` decimal(17,14) NOT NULL,
  `category_id` int(10) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  UNIQUE KEY `report_id` (`report_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `web_report_details`
--

INSERT INTO `web_report_details` (`report_id`, `title`, `description`, `latitude`, `longitude`, `category_id`, `comment`) VALUES
(1, 'Κατούρησε στο πηγάδι', '23χρονος φοιτητής κατούρησε στο πηγάδι και μολύνθηκε ολόκληρη η περιοχή του.', '38.25006000000000', '21.73737600000000', 1, 'BASIC FUNCTIONALITY ITHELES ALLA OLA EINAI SAN SKATA PARE TO BASIC FUNCTIONALITY SOU KAI SKASE '),
(2, 'Βγήκε από το σπίτι', '22χρονος φοιτητής βγήκε από το σπίτι του μετά από 2 μήνες! Φίλοι και συγγενείς να σπεύσουν να επικοινωνήσουν μαζί του.', '38.23658700000000', '21.73395800000000', 1, 'Τελικά βγήκε οπότε κομπλέ!'),
(12, 'Test1 ajax map', 'athina ajax map', '38.00914718717164', '23.69291778808588', 1, 'ασδφασδφασδφαδσφ ΕΛΛΗΝΙΚΑ ΡΕ ΣΥ ΕΛΛΗΝΙΚΑ'),
(19, 'asdfasdfasdf', 'adsfasdfasdfasdfasdfasdf', '38.06755368573605', '23.65721222167963', 3, NULL),
(20, 'asdasdfasdfasdfasdf', 'asdfasdfasdfasdfasdfasdfasdfasf', '38.06593191203527', '23.50615020996088', 1, NULL),
(21, 'TEst', 'THESSSSS', '40.54772099185495', '22.84697052246088', 1, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `web_report_images`
--

CREATE TABLE IF NOT EXISTS `web_report_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `path` varchar(30) NOT NULL,
  `report_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_report_image` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(3, 'sespiros', '$2y$10$nbyi3yodQ240KoxVJYCqEepC4SNLGljv1wa6/Ikb9LqMP99V8NLm2', 'sespiros@gmail.com', 'a347e5248aec927107cf9a15f18e1900ee4cd78336a5eea81930a5125d66d96a', 0, NULL, '2014-04-15 23:49:57', '127.0.0.1', 1),
(4, 'joe', '$2y$10$nbyi3yodQ240KoxVJYCqEepC4SNLGljv1wa6/Ikb9LqMP99V8NLm2', 'joe@example.com', NULL, 0, NULL, '2014-04-15 23:49:57', '127.0.0.1', 0);

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `web_reports`
--
ALTER TABLE `web_reports`
  ADD CONSTRAINT `FK_report_users` FOREIGN KEY (`submitter_id`) REFERENCES `web_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `web_report_details`
--
ALTER TABLE `web_report_details`
  ADD CONSTRAINT `FK_report_detail` FOREIGN KEY (`report_id`) REFERENCES `web_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `web_report_images`
--
ALTER TABLE `web_report_images`
  ADD CONSTRAINT `FK_report_image` FOREIGN KEY (`report_id`) REFERENCES `web_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
