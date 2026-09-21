-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 09:04 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wakeupict`
--

-- --------------------------------------------------------

--
-- Table structure for table `fontawesomes`
--

CREATE TABLE `fontawesomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fontawesomes`
--

INSERT INTO `fontawesomes` (`id`, `icon_name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(16, 'Book', 'fas fa-address-book', 1, '2021-09-14 08:58:03', NULL),
(18, 'AD', 'fas fa-ad', 1, '2021-09-14 09:26:33', NULL),
(19, 'ADN', 'fab fa-adn', 1, '2021-09-14 09:33:06', NULL),
(20, 'Medkit', 'fa fa-medkit', 1, '2021-09-15 03:55:26', NULL),
(21, 'Users', 'fa fa-users', 1, '2021-09-15 03:55:48', NULL),
(22, 'Industry', 'fa fa-industry', 1, '2021-09-20 07:28:51', NULL),
(23, 'Desktop', 'fa fa-desktop', 1, '2021-09-28 03:17:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fontawesomes`
--
ALTER TABLE `fontawesomes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fontawesomes`
--
ALTER TABLE `fontawesomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
