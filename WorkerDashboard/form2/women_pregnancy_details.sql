-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 01:28 PM
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
-- Table structure for table `women_pregnancy_details`
--

CREATE TABLE `women_pregnancy_details` (
  `woman_id` int(11) NOT NULL,
  `expectedDeliveryDate` date DEFAULT NULL,
  `lmp` date DEFAULT NULL,
  `numberOfPregnancies` int(11) DEFAULT NULL,
  `NumberOfLiveBirths` int(11) DEFAULT NULL,
  `numberOfMiscarriages` int(11) DEFAULT NULL,
  `numberOfAbortions` int(11) DEFAULT NULL,
  `currentWeight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `women_pregnancy_details`
--
ALTER TABLE `women_pregnancy_details`
  ADD KEY `woman_id` (`woman_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `women_pregnancy_details`
--
ALTER TABLE `women_pregnancy_details`
  MODIFY `woman_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `women_pregnancy_details`
--
ALTER TABLE `women_pregnancy_details`
  ADD CONSTRAINT `women_pregnancy_details_ibfk_1` FOREIGN KEY (`woman_id`) REFERENCES `women_personal_details` (`woman_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
