-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2022 at 07:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lentera`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `audio_id` int(11) NOT NULL,
  `audio_name` varchar(255) NOT NULL,
  `audio_filename` varchar(255) DEFAULT NULL,
  `audio_chapter` varchar(255) DEFAULT NULL,
  `audio_created_date` date DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `users_id_contribute` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`audio_id`, `audio_name`, `audio_filename`, `audio_chapter`, `audio_created_date`, `items_id`, `users_id_contribute`) VALUES
(1, 'Perang Dipo', NULL, '1', '2022-03-04', 1, 3),
(2, 'Perang diponegoro 2', NULL, '2', '2022-03-11', 1, 3),
(3, 'Perang Dipo 3', NULL, '3', '2022-03-11', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Sains'),
(2, 'Fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `history_time` int(255) NOT NULL,
  `history_date` date NOT NULL,
  `users_id_access` int(11) DEFAULT NULL,
  `audio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_time`, `history_date`, `users_id_access`, `audio_id`) VALUES
(1, 1, '2022-04-11', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `items_title` varchar(255) NOT NULL,
  `items_slug` varchar(255) NOT NULL,
  `items_publisher` varchar(255) NOT NULL,
  `items_published_date` date NOT NULL,
  `items_isbn` varchar(255) NOT NULL,
  `items_authors` varchar(255) NOT NULL,
  `items_page` int(255) NOT NULL,
  `items_chapter` varchar(255) DEFAULT NULL,
  `items_language` varchar(255) NOT NULL,
  `items_description` text NOT NULL,
  `items_access_count` int(255) DEFAULT NULL,
  `items_thumbnail` varchar(255) DEFAULT NULL,
  `items_pdf` varchar(255) DEFAULT NULL,
  `items_created_by` varchar(255) DEFAULT NULL,
  `items_created_date` date DEFAULT NULL,
  `items_updated_by` varchar(255) DEFAULT NULL,
  `items_updated_date` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_title`, `items_slug`, `items_publisher`, `items_published_date`, `items_isbn`, `items_authors`, `items_page`, `items_chapter`, `items_language`, `items_description`, `items_access_count`, `items_thumbnail`, `items_pdf`, `items_created_by`, `items_created_date`, `items_updated_by`, `items_updated_date`, `category_id`) VALUES
(1, 'Harry Potter ', 'harry-potter', 'coba', '2022-02-01', '111', 'coba', 4, '5', 'coba', 'coba', NULL, '1648540190_b2bad7fe51b52fd98e93.jpg', NULL, 'session(id)', '0000-00-00', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `users_username` varchar(255) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_name` varchar(255) NOT NULL,
  `users_role` enum('admin','member','contributor','') NOT NULL,
  `users_birth_place` varchar(255) DEFAULT NULL,
  `users_birth_date` date DEFAULT NULL,
  `users_address` text DEFAULT NULL,
  `users_phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_email`, `users_username`, `users_password`, `users_name`, `users_role`, `users_birth_place`, `users_birth_date`, `users_address`, `users_phone_number`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', 'admin', 'admin', 'Admin', '2022-02-15', 'admin', '628000000000'),
(2, 'users@gmail.com', 'users', 'users', 'users', 'member', 'users', '2022-02-16', 'users', '00900'),
(3, 'contributor@gmail.com', 'contributor', 'contributor', 'contributor', 'contributor', 'contributor', '2022-02-16', 'contributor', '0808000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`audio_id`),
  ADD KEY `items_id` (`items_id`),
  ADD KEY `users_id_contribute` (`users_id_contribute`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `fk_audio` (`audio_id`),
  ADD KEY `users_id_access` (`users_id_access`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`),
  ADD KEY `Foreign_Key_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `audio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `audio_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `audio_ibfk_2` FOREIGN KEY (`users_id_contribute`) REFERENCES `users` (`users_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_audio` FOREIGN KEY (`audio_id`) REFERENCES `audio` (`audio_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`users_id_access`) REFERENCES `users` (`users_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Foreign_Key_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
