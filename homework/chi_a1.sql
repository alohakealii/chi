-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2015 at 11:46 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chi`
--
CREATE DATABASE IF NOT EXISTS `chi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chi`;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `username` varchar(16) NOT NULL,
  `first` varchar(16) NOT NULL,
  `last` varchar(16) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`username`, `first`, `last`, `age`, `gender`) VALUES
('Anne', 'Anne', 'Beltran', 21, 'Female'),
('Anne2', 'Anne', 'Lopez', 28, 'Female'),
('Frank', 'Frank', 'Williams', 50, 'Male'),
('John', 'John', 'Smith', 24, 'Male'),
('Michael', 'Michael', 'Brown', 62, 'Male'),
('Summer', 'Summer', 'Hart', 27, 'Female'),
('Susan', 'Susan', 'Grey', 30, 'Female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
