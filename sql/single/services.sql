-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 08:57 PM
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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_service` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `logo`, `title`, `description`, `order_service`, `status`, `created_at`, `updated_at`) VALUES
(2, 'fa fa-desktop', 'Website Design And Development', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or many other uses. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.&nbsp;</p>', 2, 1, '2021-09-28 02:58:08', '2021-09-30 12:51:40'),
(14, 'fa fa-desktop', 'Software Development', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or many other uses. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.</p>', 1, 1, '2021-09-30 12:49:55', '2021-09-30 12:51:14'),
(15, 'fa fa-desktop', 'Graphic Design', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or many other uses. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.</p>', 4, 1, '2021-09-30 12:52:16', NULL),
(16, 'fa fa-desktop', 'Digital Marketing', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or many other uses. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.</p>', 5, 1, '2021-09-30 12:54:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
