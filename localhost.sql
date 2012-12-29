-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2012 at 11:42 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `localhost`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL,
  `user 1` varchar(255) NOT NULL,
  `request id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `duration` decimal(10,0) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `user 2` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`request id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user 1`, `request id`, `name`, `duration`, `start_time`, `end_time`, `start_date`, `end_date`, `description`, `user 2`, `status`) VALUES
(14, 'xlindadu@gmail.com', 84, '', '0', '00:00:00', '00:00:00', '2012-12-08', '2012-12-15', '            \r\n            ', '', 0),
(34, 'ds@ds.com', 85, '', '0', '00:00:00', '00:00:00', '2012-12-08', '2012-12-15', '            \r\n            ', '', 0),
(14, 'xlindadu@gmail.com', 86, 'name sent', '2', '14:59:00', '21:59:00', '2012-12-08', '2012-12-15', '            \r\n            ', 'le@gmail.com', 0),
(30, 'le@gmail.com', 92, 'sorry x32', '1', '15:00:00', '20:00:00', '2012-12-09', '2012-12-11', '            \r\n            ', 'xlindadu@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `busy_start_time` time NOT NULL,
  `busy_end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `request_id` int(255) unsigned NOT NULL,
  `id` int(255) unsigned NOT NULL,
  PRIMARY KEY (`busy_start_time`,`busy_end_time`,`start_date`,`end_date`,`request_id`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`busy_start_time`, `busy_end_time`, `start_date`, `end_date`, `request_id`, `id`) VALUES
('03:00:00', '04:30:00', '2012-12-08', '2012-12-08', 86, 14),
('04:00:00', '06:00:00', '2012-12-10', '2012-12-10', 84, 14),
('04:00:00', '06:00:00', '2012-12-10', '2012-12-10', 92, 14),
('04:00:00', '06:00:00', '2012-12-10', '2012-12-10', 92, 30),
('09:00:00', '12:00:00', '2012-12-14', '2012-12-14', 84, 14),
('10:00:00', '12:00:00', '2012-12-10', '2012-12-10', 84, 14),
('12:00:00', '13:00:00', '2012-12-10', '2012-12-10', 84, 14),
('15:00:00', '17:00:00', '2012-12-08', '2012-12-08', 86, 14),
('15:00:00', '17:00:00', '2012-12-10', '2012-12-10', 92, 14),
('15:00:00', '17:00:00', '2012-12-10', '2012-12-10', 92, 30),
('15:00:00', '17:30:00', '2012-12-09', '2012-12-09', 92, 14),
('15:00:00', '17:30:00', '2012-12-09', '2012-12-09', 92, 30),
('15:00:00', '18:00:00', '2012-12-09', '2012-12-09', 92, 14),
('15:00:00', '18:00:00', '2012-12-09', '2012-12-09', 92, 30),
('15:00:00', '21:00:00', '2012-12-09', '2012-12-09', 86, 14),
('15:30:00', '16:30:00', '2012-12-10', '2012-12-10', 86, 14),
('15:30:00', '16:30:00', '2012-12-10', '2012-12-10', 92, 14),
('15:30:00', '16:30:00', '2012-12-10', '2012-12-10', 92, 30),
('15:30:00', '20:30:00', '2012-12-12', '2012-12-12', 84, 14),
('17:00:00', '19:00:00', '2012-12-08', '2012-12-08', 86, 14),
('17:00:00', '21:00:00', '2012-12-10', '2012-12-10', 92, 14),
('18:00:00', '19:00:00', '2012-12-09', '2012-12-09', 84, 14),
('18:00:00', '20:00:00', '2012-12-07', '2012-12-07', 84, 14),
('18:00:00', '21:00:00', '2012-12-09', '2012-12-09', 92, 14),
('18:00:00', '21:00:00', '2012-12-09', '2012-12-09', 92, 30),
('19:00:00', '23:00:00', '2012-12-08', '2012-12-08', 86, 14),
('19:00:00', '23:00:00', '2012-12-08', '2012-12-08', 92, 14),
('19:00:00', '23:00:00', '2012-12-08', '2012-12-08', 92, 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`) VALUES
(1, 'caesar', '$1$50$GHABNWBNE/o4VL7QjmQ6x0'),
(2, 'cs50', '$1$50$ceNa7BV5AoVQqilACNLuC1'),
(3, 'jharvard', '$1$50$RX3wnAMNrGIbgzbRYrxM1/'),
(4, 'malan', '$1$HA$azTGIMVlmPi9W9Y12cYSj/'),
(5, 'nate', '$1$50$sUyTaTbiSKVPZCpjJckan0'),
(6, 'rbowden', '$1$50$lJS9HiGK6sphej8c4bnbX.'),
(7, 'skroob', '$1$50$euBi4ugiJmbpIbvTTfmfI.'),
(8, 'tmacwilliam', '$1$50$91ya4AroFPepdLpiX.bdP1'),
(9, 'zamyla', '$1$50$Suq.MOtQj51maavfKvFsW1'),
(10, 'ldu', '$1$hBrGrjQj$CpTTkqqUdRTcyFZnIrVId1'),
(11, 'xlinders', '$1$rE6ELXbm$6yRWJZta1jh08I6W66o1U0'),
(12, 'kjiang', '$1$hv5f2/A3$eg3oydNUU0LeGrLBfxfzh.'),
(13, 'xlinders@gmail.com', '$1$RJ58cooY$QIHBX7.N2IrPT1nfBMe0i0'),
(14, 'xlindadu@gmail.com', '$1$YAHka8tt$1OrXqNZqWD6V66uWm0UB4.'),
(15, 'l@g.com', '$1$2Qyu.zMN$qqzM5askaYrIs/FaMOb6p1'),
(16, 'x@k.com', '$1$sNDuLjDG$UekvcJIcmtV15l3/vQoT9/'),
(19, 'dshu@gmail.com', '$1$5Ek9MKwK$0BK5msDYIXK/iSkjZGrTv1'),
(20, 'd@gmail.com', '$1$Gvgv14m6$O27ViRfgGdEXh9W7hvzNs.'),
(21, 'l@a.com', '$1$27CURYiF$LEFlMrGyHZdGaCbNMoHrz/'),
(22, 'l@b.com', '$1$rztUvoaC$ot1BvgGsE6fLPc8yxamej.'),
(23, 'max@j.com', '$1$ZT1aeXYd$9Bg3hIUQ0uvDAViiLAfUI0'),
(24, 'mas@s.com', '$1$DgW5E9Oy$MiME697nTM5n8lq4kapJ7.'),
(25, 'k@l.com', '$1$XQh4eSYC$htSvah27N8iwrXtf3upHq/'),
(26, 'wiggle@w.com', '$1$qLEUuKP.$SaPVrYnQBKnQkA4xwH0nI.'),
(27, 'dsh@s.com', '$1$L0dLrwC.$yDqHM7YHd8Q22rppgaHLH1'),
(28, 'd@m.com', '$1$3WyhuMG2$m30pfCpoSqMfNxPiiSeMZ/'),
(29, 'l@gmail.com', '$1$piATIou4$jMWnFeE3Bxbqye8rrCbZX0'),
(30, 'le@gmail.com', '$1$BHhoN/.o$3HQBHIxCgU6tRY0XZ3pJZ.'),
(31, 'ldu@k.com', '$1$u9/9dF0b$gTSFeGT9Lgn.nAvy9/84b0'),
(32, 'ldu@d.com', '$1$Z2h1StJo$iyg0hYM81HqNDd9eK5w7p.'),
(33, 'dean@y.com', '$1$MNvH4ZTJ$sKITCIPSC0.b7MLOMUbvu1'),
(34, 'ds@ds.com', '$1$R0T1EY6Y$48tSJvRxH1SMlq/ewDnA8/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
