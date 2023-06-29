-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 07:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anganwadi`
--

CREATE TABLE `anganwadi` (
  `aw_number` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `panchayat_name` varchar(255) DEFAULT NULL,
  `aww_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anganwadi`
--

INSERT INTO `anganwadi` (`aw_number`, `worker_id`, `panchayat_name`, `aww_name`) VALUES
(1, 1, 'Kadanadu', 'juna'),
(2, 2, 'Mutholy', 'priya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anganwadi`
--
ALTER TABLE `anganwadi`
  ADD PRIMARY KEY (`aw_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anganwadi`
--
ALTER TABLE `anganwadi`
  MODIFY `aw_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
