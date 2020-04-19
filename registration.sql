-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2020 at 08:59 PM
-- Server version: 5.7.25
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` longtext NOT NULL,
  `uid` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `image`, `uid`) VALUES
(11, 'Thank you for making Payment on your RBL Bank Credit Card - deepakaryan1988 gmail com - Gmail.png', 'upload/Thank you for making Payment on your RBL Bank Credit Card - deepakaryan1988 gmail com - Gmail.png', '21'),
(12, 'DIVYA.jpg', 'upload/DIVYA.jpg', '22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  `mobile` varchar(256) NOT NULL,
  `user_address` varchar(256) NOT NULL,
  `user_city` varchar(256) NOT NULL,
  `user_dob` varchar(256) NOT NULL,
  `user_gender` varchar(256) NOT NULL,
  `user_degree` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `trn_date`, `mobile`, `user_address`, `user_city`, `user_dob`, `user_gender`, `user_degree`) VALUES
(21, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2020-04-18 20:51:06', '9898778899', 'Moshi', 'Pune', '04/05/2020', 'Female', 'Post_Graduate'),
(22, 'Divya', 'divya@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2020-04-18 20:51:47', '8899778877', 'moshi', 'Mumbai', '12/09/2019', 'Female', 'Post_Graduate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
