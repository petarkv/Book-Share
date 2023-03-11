-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 10:13 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_share`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_abord` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `send_abord`) VALUES
(31, 'proba1', '827ccb0eea8a706c4c34a16891f84e7b', 'Yes'),
(32, 'proba2', '202cb962ac59075b964b07152d234b70', 'Yes'),
(34, 'proba3', '827ccb0eea8a706c4c34a16891f84e7b', 'Yes'),
(35, 'proba4', '202cb962ac59075b964b07152d234b70', 'Yes'),
(38, 'proba5', '827ccb0eea8a706c4c34a16891f84e7b', 'Yes'),
(39, 'proba6', '827ccb0eea8a706c4c34a16891f84e7b', 'Yes'),
(41, 'proba7', '202cb962ac59075b964b07152d234b70', 'Yes'),
(42, 'proba111', '9e9fb3b8d52a5d7e9ae82898d5eac2fc', 'Yes'),
(43, 'proba11', 'b59c67bf196a4758191e42f76670ceba', 'Yes'),
(44, 'Peki', '81dc9bdb52d04dc20036dbd8313ed055', 'Yes'),
(45, 'petar', '827ccb0eea8a706c4c34a16891f84e7b', 'No'),
(46, 'ps', '11', ''),
(47, 'nm', '22', ''),
(48, 'peca', '698d51a19d8a121ce581499d7b701668', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id_user` int(10) NOT NULL,
  `first_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `e_mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gander` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id_user`, `first_name`, `last_name`, `date_of_birth`, `e_mail`, `phone_number`, `gander`) VALUES
(17, 'proba1', 'proba1', '2019-12-02', 'proba1@gmail.com', '1234567', 'Male'),
(18, 'proba2', 'proba2', '0000-00-00', 'proba2@gmail.com', '123', 'Male'),
(19, 'proba3', 'proba3', '0000-00-00', 'proba3@gmail.com', '12345', 'Male'),
(20, 'proba4', 'proba4', '0000-00-00', 'proba4@gmail.com', '12345', 'Male'),
(21, 'proba5', 'proba5', '0000-00-00', 'proba5@gmail.com', '12345', 'Male'),
(22, 'proba7', 'proba7', '0000-00-00', 'proba5@gmail.com', '12345', 'Male'),
(23, 'proba111', 'proba111', '0000-00-00', 'proba111@gmail.com', '066555666', 'Male'),
(24, 'proba11', 'proba11', '0000-00-00', 'proba11@gmail.com', '123456', 'Male'),
(25, 'Pera', 'Peric', '0000-00-00', 'pera@gmail.com', '1234567', 'Male'),
(26, 'Petar', 'Petrovic', '0000-00-00', 'petar@gmail.com', '1234567', 'Male'),
(27, 'Petar', 'Stankovic', '0000-00-00', 'peca@gmail.com', '066555666', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `id_location` int(10) NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atittude` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`id_location`, `address`, `town`, `post_code`, `country`, `longitude`, `atittude`) VALUES
(14, 'proba1', 'proba1', '1', 'proba1', '', ''),
(15, 'proba2', 'proba2', '2', 'proba2', '', ''),
(16, 'proba3', 'proba3', '3', 'proba3', '', ''),
(17, 'proba4', 'proba4', '4', 'proba4', '', ''),
(18, 'proba5', 'proba5', '5', 'proba5', '', ''),
(19, 'proba7', 'proba7', '7', 'proba7', '', ''),
(20, 'proba111', 'proba111', '3111', 'proba111', '', ''),
(21, 'proba11', 'proba11', '111111', 'proba11', '', ''),
(22, 'Zelegora bb', 'Kraljevo', '36000', 'Srbija', '', ''),
(23, 'Kraljevo bb', 'Kraljevo', '36000', 'Srbija', '', ''),
(24, 'BB', 'BB', '311', 'BBRR', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_location`
--
ALTER TABLE `user_location`
  ADD PRIMARY KEY (`id_location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_location`
--
ALTER TABLE `user_location`
  MODIFY `id_location` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
