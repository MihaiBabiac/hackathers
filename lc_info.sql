-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2016 at 08:47 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lc_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_change`
--

CREATE TABLE `board_change` (
  `board_change_id` int(11) NOT NULL,
  `board_change_date` date NOT NULL,
  `lc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_change`
--

INSERT INTO `board_change` (`board_change_id`, `board_change_date`, `lc_id`) VALUES
(1, '2015-07-30', 1),
(2, '2014-06-20', 1),
(3, '2013-11-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `lc`
--

CREATE TABLE `lc` (
  `lc_id` int(11) NOT NULL,
  `lc_internal_name` varchar(30) NOT NULL,
  `lc_reg_name` varchar(100) NOT NULL,
  `lc_connection` varchar(500) NOT NULL,
  `lc_address` varchar(50) NOT NULL,
  `lc_post_code` varchar(32) NOT NULL,
  `lc_city` varchar(40) NOT NULL,
  `lc_email` varchar(60) NOT NULL,
  `lc_site` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lc`
--

INSERT INTO `lc` (`lc_id`, `lc_internal_name`, `lc_reg_name`, `lc_connection`, `lc_address`, `lc_post_code`, `lc_city`, `lc_email`, `lc_site`) VALUES
(1, 'LC Zagreb', 'UDRUGA STUDENATA ELEKTROTEHNIKE EUROPE - ZAGREB', 'Local group in Zagreb at university of FER', 'Unska 3', '10000', 'Zagreb', 'zagreb@eestec.net', 'www.eestec-zg.hr'),
(2, 'LC Zurich', 'AMIV', 'At the ETH we have AMIV, the student organisation for all mechanical and electrical engineering students. It has about 2600 members. EESTEC LC Zurich is a small part of it and mainly represents the international stuff. Making it possible to participate on workshops of other EESTEC LC, organising a workshop to welcome international students to Zurich and so on.', 'Universitätsstraße 19', '8092', 'Zurich', 'board@eestec.ethz.ch', 'www.amiv.ethz.ch');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `position_mail` varchar(50) NOT NULL,
  `position_phone` varchar(20) NOT NULL,
  `position_title` varchar(50) NOT NULL,
  `board_change_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `position_mail`, `position_phone`, `position_title`, `board_change_id`) VALUES
(1, 'Till Scholz', 'till.scholz@tuhh.de', '+4915758838484', 'Chairman', 1),
(2, 'Jeffrey Remien', 'Jeffrey.remien@gmail.com', '+4917645796164', 'CP', 1),
(3, 'Felix Dietz', 'felix.dietz@haw-hamburg.de', '4917648275413', 'Internal Affairs', 1),
(4, 'Stefanie Hinck', 'stefanie.hinck@haw-hamburg.de', '', 'Treasurer', 1),
(5, 'Vadim Nagomov', '', '', 'Oversight Committee', 1),
(6, 'Liisa Vaht', '', '', 'Oversight Committee', 1),
(7, 'Michael Eckard', 'chairperson[at]eestec-hamburg[dot]de', '', 'Chairman', 2),
(8, 'Lissa Vaht', 'cp[at]eestec-hamburg[dot]de', '', 'CP', 2),
(9, 'Dennis Suwolto', 'till.schultz[at]haw-hamburg[dot]de', '', 'Vice Chair and Publication&Administration', 2),
(10, 'Florian Heiwig', 'ia@eestec-hamburg.de', '', 'Internal Affairs', 2),
(11, 'Vadim Vagomov', 'treasurer[at]eestec-hamburg[dot]de', '', 'Treasurer', 2),
(12, '', '', '', 'Oversight Committee', 2),
(13, 'Natalia Duske', 'chairperson[at]eestec-hamburg[dot]de', '', 'Chairwoman', 3),
(14, 'Liisa Vaht', 'cp[at]eestec-hamburg[dot]de', '', 'CP', 3),
(15, 'Till Schultz', 'till.schultz[at]haw-hamburg[dot]de', '', 'Vice Chair and Publication&Administration', 3),
(16, 'Moritz Knuppel', 'ia@eestec-hamburg.de', '', 'Internal Affairs', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1458934509, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_change`
--
ALTER TABLE `board_change`
  ADD PRIMARY KEY (`board_change_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lc`
--
ALTER TABLE `lc`
  ADD PRIMARY KEY (`lc_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_change`
--
ALTER TABLE `board_change`
  MODIFY `board_change_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lc`
--
ALTER TABLE `lc`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
