-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 03:16 PM
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2021_08_15_052148_create_pages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_canonical` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msvalidate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_modified_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image_height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_label1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_data1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_site_verification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `title`, `link_canonical`, `og_locale`, `og_type`, `og_url`, `og_site_name`, `msvalidate`, `description`, `article_publisher`, `article_modified_time`, `image`, `og_image_width`, `og_image_height`, `twitter_card`, `twitter_label1`, `twitter_data1`, `google_site_verification`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home Page', 'LInk canonical 2', 'OG Locale 2', 'OG Type 2', 'www.wakeupict.com', 'wakeupict', 'MG Validate', '<p>wakeup ict is the prominent</p>', 'Article publisher', '1 Jan, 2021', 'public/uploads/SEO/images/1708518845873600.png', '411', '411', 'twitter Card', 'Twitter Label 1', 'Twitter Data 1', '1234567890', '1', '2021-08-19 06:58:41', '2021-08-19 06:58:41'),
(2, 'About', 'About page', 'www.google.come', 'og locale about', 'og type about', 'og url about', 'og side name about', 'ms validate about', '<p>about description. about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;</p>', 'article publisher about', '19 Aug, 2021', 'public/uploads/SEO/images/1708522539636513.png', '324', '3423', 'twitter card about', 'twitter label 1 about', 'twitter data 1 about', 'google side varification about', '1', '2021-08-19 05:54:25', '2021-08-19 05:54:25'),
(3, 'Academic', 'Academic Trainings', NULL, NULL, NULL, NULL, NULL, NULL, '<p>academic trainings. academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;</p>', NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-19 07:14:55', '2021-08-19 07:14:55'),
(4, 'Services', 'Services', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-19 07:15:50', '2021-08-19 07:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'Admin', NULL, '$2y$10$3Y5vFhDrx9dcRI1F/ygjy.EjHQveVmFFaPqGxXPQ1vhS.cthgfj7C', NULL, '2021-08-12 09:00:04', '2021-08-12 09:00:04'),
(2, 'moderator', 'moderator@moderator.com', 'moderator', NULL, '$2y$10$wH9zBNza9ARqQ1rDVRZ3xOwiqiot0nftqMnF3CFUQM7fGTLUWPBMm', NULL, '2021-08-18 09:22:34', '2021-08-18 09:22:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
