-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 06:32 PM
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
-- Table structure for table `child_details`
--

CREATE TABLE `child_details` (
  `child_id` int(11) NOT NULL,
  `child_name` varchar(250) NOT NULL,
  `child_age` int(11) NOT NULL,
  `child_dob` date NOT NULL,
  `child_mp` varchar(250) NOT NULL,
  `child_blockNumber` varchar(100) NOT NULL,
  `child_city` varchar(150) NOT NULL,
  `child_district` varchar(50) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `father_occupation` varchar(150) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `mother_occupation` varchar(150) NOT NULL,
  `no_of_family_members` int(11) NOT NULL,
  `annual_income` int(11) NOT NULL,
  `if_child_medical_issues` tinyint(4) NOT NULL,
  `medical_issue_details` varchar(500) NOT NULL,
  `child_guardian_phone_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_details`
--

INSERT INTO `child_details` (`child_id`, `child_name`, `child_age`, `child_dob`, `child_mp`, `child_blockNumber`, `child_city`, `child_district`, `father_name`, `father_occupation`, `mother_name`, `mother_occupation`, `no_of_family_members`, `annual_income`, `if_child_medical_issues`, `medical_issue_details`, `child_guardian_phone_no`) VALUES
(1, 'vbc', 4, '2023-06-09', 'fvbx', '4', 'xcbx', 'cxb', 'cxvx', 'cxvjnbkj', 'cvxvytutu', 'vcxvuib', 5, 2654, 0, 'kkkkkkkkkkkkkkkkkkkkkkkkk', 9087651234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child_details`
--
ALTER TABLE `child_details`
  ADD PRIMARY KEY (`child_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child_details`
--
ALTER TABLE `child_details`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
