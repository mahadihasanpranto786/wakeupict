-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 12:43 PM
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
-- Table structure for table `development_projects`
--

CREATE TABLE `development_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_project` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `development_projects`
--

INSERT INTO `development_projects` (`id`, `blog_id`, `title`, `image`, `image_alt`, `logo`, `description`, `active_project`, `status`, `created_at`, `updated_at`) VALUES
(1, 14, 'Human Resource Management System', 'public/uploads/development_project/images/1710959364204846.png', 'Human Resource Management System', 'fa fa-users', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Human resources management system is a suite of software applications used to manage human resources and related processes throughout the employee lifecycle. An HRMS enables a company to fully understand its workforce while staying compliant with changing tax laws and labor regulations.</span></p>', 1, 1, '2021-09-13 03:55:13', '2021-09-22 04:32:47'),
(2, 32, 'Heart Failure Management System', 'public/uploads/development_project/images/1711427467550799.png', 'Heart Failure Management System', 'fa fa-medkit', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">HeartCop (Heart Failure Management System) is developed to help clinicians improve outcomes and reduce hospitalizations for heart failure patients with fluid management problems. It is an integrated information system for managing heart failure patients. Patients data is highly secure and responsive.</span></p>', 1, 1, '2021-09-15 03:22:59', '2021-09-22 04:32:25'),
(3, 32, 'Jute Industry Management System', 'public/uploads/development_project/images/1711427392818331.png', 'HEART FAILURE MANAGEMENT SYSTEM', 'fa fa-industry', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Enterprise management systems are large-scale software packages that track and control the complex operations of a business. The jute management system is an application that you can use to maintain your Supply Chain Management, jute industry employees, jute gradings, accounts, profits, and everything.</span></p>', 1, 1, '2021-09-15 03:25:45', '2021-09-22 04:32:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `development_projects`
--
ALTER TABLE `development_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `development_projects`
--
ALTER TABLE `development_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
