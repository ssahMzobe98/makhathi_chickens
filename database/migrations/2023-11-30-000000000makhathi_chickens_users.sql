-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 04:16 PM
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
-- Database: `makhathi_chickens`
--

-- --------------------------------------------------------

--
-- Table structure for table `makhathi_chickens_users`
--

CREATE TABLE `makhathi_chickens_users` (
  `id` int(60) NOT NULL,
  `name-surname` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `delivery_address_id` text DEFAULT NULL,
  `card_number` text DEFAULT NULL,
  `card_csv` text DEFAULT NULL,
  `card_type` text DEFAULT NULL,
  `card_expiry_date` text DEFAULT NULL,
  `is_activated` enum('Y','N') DEFAULT 'N',
  `time_added` datetime DEFAULT NULL,
  `time_activated` datetime DEFAULT NULL,
  `device_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`device_details`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makhathi_chickens_users`
--
ALTER TABLE `makhathi_chickens_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makhathi_chickens_users`
--
ALTER TABLE `makhathi_chickens_users`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
