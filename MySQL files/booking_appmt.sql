-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 08:25 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_appmt`
--

CREATE TABLE `booking_appmt` (
  `booking_appmt_id` int(15) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_full_name` varchar(250) DEFAULT NULL,
  `customer_tel_no` varchar(15) DEFAULT NULL,
  `customer_emailaddress` varchar(200) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `staff_full_name` varchar(250) DEFAULT NULL,
  `staff_tel_no` int(11) DEFAULT NULL,
  `staff_emailaddress` int(11) DEFAULT NULL,
  `appmt_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `appmt_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `remarks` text,
  `mdate` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_appmt`
--
ALTER TABLE `booking_appmt`
  ADD PRIMARY KEY (`booking_appmt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_appmt`
--
ALTER TABLE `booking_appmt`
  MODIFY `booking_appmt_id` int(15) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
