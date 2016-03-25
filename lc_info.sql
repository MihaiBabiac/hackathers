-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2016 at 11:39 AM
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
(2, '2014-06-20', 1);

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
(2, 'LC Zurich', 'AMIV', 'Sed et voluptatem quas et. Alias minima vel corrupti. Minus maiores laudantium laboriosam dolor. Aliquam et soluta ut assumenda reprehenderit neque. Corporis maxime velit labore aliquid voluptas totam autem illo. Sed aperiam eius omnis doloremque.', 'Universitätsstraße 19', '8092', 'Zurich', 'board@eestec.ethz.ch', 'www.amiv.ethz.ch');

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
(2, 'Jim Doe', 'a@a.a', '0351408529', 'CP', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_change`
--
ALTER TABLE `board_change`
  ADD PRIMARY KEY (`board_change_id`);

--
-- Indexes for table `lc`
--
ALTER TABLE `lc`
  ADD PRIMARY KEY (`lc_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_change`
--
ALTER TABLE `board_change`
  MODIFY `board_change_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lc`
--
ALTER TABLE `lc`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
