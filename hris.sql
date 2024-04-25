-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 08:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied_leave`
--

CREATE TABLE `applied_leave` (
  `id` int(200) NOT NULL,
  `employee_number` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_role` varchar(40) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `date_time_from` datetime NOT NULL,
  `date_time_to` datetime NOT NULL,
  `description` varchar(400) NOT NULL,
  `date_applied` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_leave`
--

INSERT INTO `applied_leave` (`id`, `employee_number`, `last_name`, `first_name`, `department`, `branch`, `designation`, `email`, `user_role`, `leave_type`, `date_time_from`, `date_time_to`, `description`, `date_applied`, `status`, `update_date`) VALUES
(28, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'User', 'Unpaid Leave', '2024-03-11 08:00:00', '2024-03-11 18:00:00', 'Test', '2024-03-13 02:34:57', 'Approved', '2024-03-13 02:41:59'),
(29, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', '', 'Emergency Leave', '2024-03-18 09:51:00', '2024-03-22 09:51:00', 'asdfghjk', '2024-03-15 02:51:32', 'Pending', '0000-00-00 00:00:00'),
(30, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', '', 'Paternity Leave', '2024-03-18 09:52:00', '2024-03-22 09:52:00', 'hssdfg', '2024-03-15 02:52:27', 'Pending', '0000-00-00 00:00:00'),
(31, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'User', 'Emergency Leave', '2024-03-18 09:55:00', '2024-03-22 09:55:00', 'sdafsfs', '2024-03-15 03:11:24', 'Pending', '0000-00-00 00:00:00'),
(32, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'User', 'Emergency Leave', '2024-03-18 10:33:00', '2024-03-22 10:33:00', 'asdfgh', '2024-03-15 03:34:45', 'Pending', '0000-00-00 00:00:00'),
(33, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', 'Emergency Leave', '2024-03-18 10:35:00', '2024-03-22 10:35:00', 'asdasd', '2024-03-15 03:35:38', 'Pending', '0000-00-00 00:00:00'),
(34, '01199072', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'Admin', 'Emergency Leave', '2024-03-14 15:45:00', '2024-03-15 15:45:00', 'asdasd', '2024-03-15 15:45:26', 'Approved', '2024-03-15 08:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `applied_official_business`
--

CREATE TABLE `applied_official_business` (
  `id` int(200) NOT NULL,
  `employee_number` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_role` varchar(40) NOT NULL,
  `date_time_from` datetime NOT NULL,
  `date_time_to` datetime NOT NULL,
  `contact_person` varchar(200) NOT NULL,
  `contact_number` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `date_applied` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(200) NOT NULL DEFAULT 'Pending',
  `update_date` datetime NOT NULL,
  `pdf_upload` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_official_business`
--

INSERT INTO `applied_official_business` (`id`, `employee_number`, `last_name`, `first_name`, `department`, `branch`, `designation`, `email`, `user_role`, `date_time_from`, `date_time_to`, `contact_person`, `contact_number`, `description`, `date_applied`, `status`, `update_date`, `pdf_upload`) VALUES
(1, '011990723', 'Pore', 'John Dexter', 'MIS', '', 'Programmer', '', '', '2024-03-05 07:28:13', '2024-03-05 07:28:13', 'Michael Oriarte', '', 'Test', '2024-03-05 14:28:57', 'Pending', '0000-00-00 00:00:00', ''),
(2, '011990723', 'Pore', 'John Dexter', 'MIS', '', 'Programmer', '', '', '2024-03-05 07:28:13', '2024-03-05 07:28:13', 'Michael Oriarte', '', 'Test', '2024-03-05 14:28:57', 'Approved', '0000-00-00 00:00:00', ''),
(3, '011990723', 'Pore', 'John Dexter', 'MIS', '', 'Programmer', '', '', '2024-03-05 07:28:13', '2024-03-05 07:28:13', 'Michael Oriarte', '', 'Test', '2024-03-05 14:28:57', 'Disapproved', '0000-00-00 00:00:00', ''),
(4, '011990723', 'Pore', 'John Dexter', 'MIS', '', 'Programmer', '', '', '2024-03-12 09:50:00', '2024-03-13 09:50:00', 'John Dexter S. Pore', '09334560216', 'test', '2024-03-12 02:50:42', 'Pending', '0000-00-00 00:00:00', ''),
(5, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', '', '2024-03-12 14:28:00', '2024-03-13 14:28:00', 'John Dexter S. Pore', '09334560216', 'asdfghjkl;', '2024-03-12 07:29:25', 'Pending', '0000-00-00 00:00:00', ''),
(6, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', '', '2024-03-12 14:31:00', '2024-03-13 14:31:00', 'John Dexter S. Pore', '09334560216', 'asdfghjkl', '2024-03-12 07:31:14', 'Pending', '0000-00-00 00:00:00', ''),
(7, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'User', '2024-03-11 13:00:00', '2024-03-11 18:00:00', 'John Dexter S. Pore', '09334560216', 'Test', '2024-03-13 02:40:54', 'Pending', '0000-00-00 00:00:00', ''),
(8, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 10:37:00', '2024-03-22 10:37:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 03:57:27', 'Pending', '0000-00-00 00:00:00', ''),
(9, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-15 10:58:00', '2024-03-19 10:58:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 03:58:59', 'Pending', '0000-00-00 00:00:00', ''),
(10, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:04:00', '2024-03-22 11:04:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 11:04:32', 'Pending', '0000-00-00 00:00:00', ''),
(11, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:07:00', '2024-03-22 11:07:00', 'John Dexter S. Pore', '09334560216', 'asdasdasd', '2024-03-15 11:07:25', 'Pending', '0000-00-00 00:00:00', ''),
(12, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:10:00', '2024-03-22 11:10:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 11:24:15', 'Pending', '0000-00-00 00:00:00', 'branches.pdf'),
(13, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:25:00', '2024-03-20 11:25:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 11:25:54', 'Pending', '0000-00-00 00:00:00', ''),
(14, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:35:00', '2024-03-22 11:35:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 11:43:41', 'Pending', '0000-00-00 00:00:00', 'carrers.pdf'),
(15, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:44:00', '2024-03-22 11:44:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 11:44:26', 'Pending', '0000-00-00 00:00:00', 'branches.pdf'),
(16, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:46:00', '2024-03-22 11:46:00', 'John Dexter S. Pore', '09334560216', 'asdasdasd', '2024-03-15 11:46:18', 'Pending', '0000-00-00 00:00:00', 'carrers.pdf'),
(17, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'AVP', '2024-03-18 11:48:00', '2024-03-22 11:48:00', 'John Dexter S. Pore', '09334560216', 'asdasd', '2024-03-15 11:48:26', 'Approved', '2024-03-15 07:29:42', 'branches.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `applied_over_time`
--

CREATE TABLE `applied_over_time` (
  `id` int(200) NOT NULL,
  `employee_number` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `over_time_type` varchar(200) NOT NULL,
  `over_time_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_applied` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(200) NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_over_time`
--

INSERT INTO `applied_over_time` (`id`, `employee_number`, `last_name`, `first_name`, `department`, `branch`, `designation`, `email`, `user_role`, `over_time_type`, `over_time_date`, `start_time`, `end_time`, `description`, `date_applied`, `status`, `update_date`) VALUES
(2, '011990723', 'Pore', 'John Dexter', 'MIS', 'Head Office', 'Programmer', 'johndexter.pore@ubix.com.ph', 'Admin', 'Regular', '2024-03-19', '18:00:00', '20:00:00', 'test', '2024-03-19 09:25:23', 'Pending', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(200) NOT NULL,
  `transaction` varchar(200) NOT NULL,
  `person_incharge` varchar(200) NOT NULL,
  `data_time_transaction` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `transaction`, `person_incharge`, `data_time_transaction`) VALUES
(15, 'Added Employee: 2', '011990723', '2024-03-07 16:47:05'),
(17, 'Added Employee: 2', '011990723', '2024-03-07 17:02:54'),
(18, 'Deleted Employee: 1', '2', '2024-03-07 17:03:09'),
(19, 'Added Employee: 2', '011990723', '2024-03-07 17:04:14'),
(20, 'Deleted Employee: 2', '011990723', '2024-03-07 17:04:36'),
(21, 'Added Employee: 2', '011990723', '2024-03-12 10:51:35'),
(22, 'Added Employee: 1', '011990723', '2024-03-12 11:20:35'),
(23, 'Added Employee: 3', '011990723', '2024-03-12 13:44:19'),
(24, 'Applied for leave', '011990723', '2024-03-15 15:45:26'),
(25, 'Leave Application Approved', '011990723', '2024-03-15 15:51:35'),
(26, 'Application 34, Leave Application Approved', '011990723', '2024-03-15 15:56:22'),
(27, 'Applied for over time', '011990723', '2024-03-19 09:17:29'),
(28, 'Applied for over time', '011990723', '2024-03-19 09:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `employee_number` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `activity` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `underDepartments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `employee_number`, `last_name`, `first_name`, `email`, `password`, `department`, `designation`, `branch`, `user_role`, `activity`, `status`, `underDepartments`) VALUES
(159, '011990723', 'Pore', 'John Dexter', 'johndexter.pore@ubix.com.ph', '031801', 'MIS', 'Programmer', 'Head Office', 'Admin', '2024-04-25 05:18:14', 'Offline', '[\"MIS\",\"UIC\",\"Sales Consumables\"]'),
(167, '2', 'Pore', 'John Dexter', 'dexterpore45@gmail.com', '031801', 'MIS', 'Programmer', 'Head Office', 'AVP', '2024-04-01 03:00:47', 'Offline', '[\"MIS\",\"UIC\",\"Sales Consumables\"]'),
(168, '1', 'Oriarte', 'Michael', 'michael.oriarte@ubix.com.ph', '031801', 'MIS', 'IT Manager', 'Head Office', 'User', '0000-00-00 00:00:00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied_leave`
--
ALTER TABLE `applied_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_official_business`
--
ALTER TABLE `applied_official_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_over_time`
--
ALTER TABLE `applied_over_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applied_leave`
--
ALTER TABLE `applied_leave`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `applied_official_business`
--
ALTER TABLE `applied_official_business`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `applied_over_time`
--
ALTER TABLE `applied_over_time`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
