-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2020 at 01:07 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkvk`
--

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `user_id` int(10) NOT NULL COMMENT 'This is an auto-increment field to uniquely identify the user.',
  `user_name` varchar(50) NOT NULL COMMENT 'This is the full name of the user.',
  `user_email` varchar(100) NOT NULL COMMENT 'This field is for user name selected by the user. It will be an email id.',
  `user_password` varchar(50) NOT NULL COMMENT 'Password field entered by the user.',
  `user_mobile` bigint(12) NOT NULL COMMENT 'used to store mobile no of user',
  `user_bdate` date NOT NULL COMMENT 'Used to store the birthdate of the user. ',
  `user_gender` int(2) NOT NULL COMMENT 'This field is used to store the gender of the user. 1 – male, 2-female, 3-others',
  `user_address` text NOT NULL COMMENT 'This field is used to store the address of the user.',
  `user_type` int(1) NOT NULL DEFAULT 1 COMMENT 'This field is used to differentiate between admin and normal user. \r\n0 – Admin, non-zero – normal user.',
  `user_sa` varchar(20) NOT NULL COMMENT 'Used to store the security answer of the user.',
  `user_dac` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'This field is used to store the date and time of account creation.',
  `user_laa` datetime NOT NULL COMMENT 'This field is used to store the last date and time of account access.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'This is an auto-increment field to uniquely identify the user.', AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
