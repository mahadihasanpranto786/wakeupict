-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 02:46 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

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
-- Table structure for table `course_banners`
--

CREATE TABLE `course_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_banners`
--

INSERT INTO `course_banners` (`id`, `banner_title`, `banner_description`, `body_title`, `body_description`, `image`, `image_alt`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WAKE UP ICT\'S ACADEMIC TRAINING', '<p class=\"MsoNormal\">OUR TRAINING MODULE IS THE BEST CITY &amp; WE HAVE SOME\r\nQUALIFIED TRAINERS AND A DIGITALIZED COMPUTER LAB. WE CAN ENSURE YOU THAT OUR\r\nCOURSES WILL SERVE YOUR PURPOSE...<o:p></o:p></p>', 'View Our Training & Development Courses', '<p><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; text-align: center;\">Our training module is the best city &amp; we have some qualified trainers and a digitalized computer lab. We can ensure you that our courses will serve your purpose...</span><br></p>', 'public/uploads/course/banner/dz 1900 x 600.png', 'Training page banner', 1, 1, '2022-01-25 09:14:19', '2022-01-25 09:29:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_banners`
--
ALTER TABLE `course_banners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_banners`
--
ALTER TABLE `course_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
