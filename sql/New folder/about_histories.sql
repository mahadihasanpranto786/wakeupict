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
-- Table structure for table `about_histories`
--

CREATE TABLE `about_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_histories`
--

INSERT INTO `about_histories` (`id`, `title`, `description`, `image`, `image_alt`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(3, 'The History Behind Wake Up ICT', 'Wake Up ICT Academy is a well-developed IT-based company and committed to creating highly skilled IT professionals. Wake Up ICT Academy is one of the leading IT Training Institute in Bangladesh and provides all kinds of IT-related solutions. Wake Up ICT has been playing a vital role in Rajbari eradicate the unemployment problem since 2015.  The Best IT-based learning center in this region. We provide a promising environment for those students who are eager to learn IT-based education. We are professional in our works and will nurture our students through the best possible methods. We took this step as a challenge and by the grace of Almighty Allah, we are hoping to change this region as an example in Bangladesh.', 'public/uploads/who_we_are/images/wakeupict-work.png', 'history wakeupict', 0, 1, '2022-01-25 03:18:06', '2022-01-25 05:55:32'),
(4, 'The History Behind Wake Up ICT', '<p><span style=\"color: rgb(108, 117, 125); font-family: Poppins, sans-serif; text-align: justify;\"><b>Wake Up ICT</b> Academy is a well-developed IT-based company and committed to creating highly skilled IT professionals. Wake Up ICT Academy is one of the leading IT Training Institute in Bangladesh and provides all kinds of IT-related solutions. Wake Up ICT has been playing a vital role in Rajbari eradicate the unemployment problem since <b>2015.</b></span></p><p><span style=\"color: rgb(108, 117, 125); font-family: Poppins, sans-serif; text-align: justify;\">The Best IT-based learning center in this region. We provide a promising environment for those students who are eager to learn IT-based education. We are professional in our works and will nurture our students through the best possible methods. We took this step as a challenge and by the grace of Almighty Allah, we are hoping to change this region as an example in Bangladesh.</span><span style=\"color: rgb(108, 117, 125); font-family: Poppins, sans-serif; text-align: justify;\"><br></span><br></p>', 'public/uploads/who_we_are/history/wakeupict-work.png', 'wakeupict history', 1, 1, '2022-01-25 03:53:02', '2022-01-25 04:50:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_histories`
--
ALTER TABLE `about_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_histories`
--
ALTER TABLE `about_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
