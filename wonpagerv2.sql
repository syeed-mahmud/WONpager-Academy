-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 05:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wonpagerv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mod1` tinyint(1) NOT NULL,
  `mod2` tinyint(1) NOT NULL,
  `mod3` tinyint(1) NOT NULL,
  `mod4` tinyint(1) NOT NULL,
  `mod5` tinyint(1) NOT NULL,
  `mod6` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`username`, `password`, `mod1`, `mod2`, `mod3`, `mod4`, `mod5`, `mod6`) VALUES
('jacques', 'jcwopager', 1, 0, 1, 0, 1, 0),
('dider', '123456', 1, 1, 1, 1, 1, 1),
('syeed', 'sywon', 0, 0, 0, 1, 1, 1),
('russel', '123123', 1, 1, 1, 0, 0, 0),
('tasin', 'tasin1', 0, 0, 0, 0, 1, 1),
('jacques', 'jw123', 0, 0, 1, 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
