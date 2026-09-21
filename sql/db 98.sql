-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2022 at 10:55 AM
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
-- Table structure for table `about_banners`
--

CREATE TABLE `about_banners` (
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
-- Dumping data for table `about_banners`
--

INSERT INTO `about_banners` (`id`, `title`, `description`, `image`, `image_alt`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'df update', '<p>dsfds update</p>', 'public/uploads/who_we_are/banner/wict-logo.png', 'Reyazaul Islam Rifat update', 0, 1, '2022-01-25 04:49:33', '2022-01-25 06:28:30'),
(2, 'WAKE UP ICT', '<p class=\"MsoNormal\">WAKE UP ICT ACADEMY IS ONE OF THE LEADING IT TRAINING\r\nINSTITUTE IN BANGLADESH AND PROVIDES ALL KINDS OF IT-RELATED SOLUTIONS. WAKE UP\r\nICT HAS BEEN PLAYING A VITAL ROLE IN RAJBARI ERADICATE THE UNEMPLOYMENT PROBLEM\r\nSINCE 2015...<o:p></o:p></p>', 'public/uploads/who_we_are/banner/dz 1900 x 600.png', 'about page banner', 1, 1, '2022-01-25 06:16:14', '2022-01-25 08:50:50');

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

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `active_who` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `designation`, `image`, `image_alt`, `type`, `active_who`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Md Riasath Arif Prodhan (Shuvro)', 'Lead Software Engineer', 'public/uploads/who_we_are/images/1711426634451931.jpg', 'Md Riasath Arif Prodhan (Shuvro)', 'employee', 1, 1, '2021-09-20 07:13:45', NULL),
(7, 'Md. Murad Hasan Khan', 'Full Stack Developer', 'public/uploads/who_we_are/images/1711426661447819.jpg', 'Md. Murad Hasan Khan', 'employee', 1, 1, '2021-09-20 07:14:11', NULL),
(8, 'Sajib Sarker', 'Jr. Full Stack Developer', 'public/uploads/who_we_are/images/1711426686221952.jpg', 'Sajib Sarker', 'employee', 1, 1, '2021-09-20 07:14:35', NULL),
(9, 'Abu Bakar Siddique', 'Jr. Full Stack Developer', 'public/uploads/who_we_are/images/1711426715436295.jpg', 'Abu Bakar Siddique', 'employee', 1, 1, '2021-09-20 07:15:03', NULL),
(10, 'Mahadi Hasan Pranto', 'Junior Web Developer', 'public/uploads/who_we_are/images/1711426735365893.jpg', 'Mahadi Hasan Pranto', 'employee', 1, 1, '2021-09-20 07:15:22', NULL),
(11, 'Rimon Hoshen', 'Junior Web Developer', 'public/uploads/who_we_are/images/1711426766527192.jpg', 'Rimon Hoshen', 'employee', 1, 1, '2021-09-20 07:15:51', NULL),
(12, 'Shaharima Afroj Sraboni', 'Graphic Designer', 'public/uploads/who_we_are/images/1711426787081755.jpg', 'Shaharima Afroj Sraboni', 'employee', 1, 1, '2021-09-20 07:16:11', NULL),
(13, 'Asma Aktar Urmi', 'Graphic Designer', 'public/uploads/who_we_are/images/1711426808654966.jpg', 'Asma Aktar Urmi', 'employee', 1, 1, '2021-09-20 07:16:31', NULL),
(14, 'Sharna Islam', 'Digital Influencer', 'public/uploads/who_we_are/images/1711426827400916.jpg', 'Sharna Islam', 'employee', 1, 1, '2021-09-20 07:16:49', NULL),
(15, 'Rezaul Karim', 'Junior Frontend Developer', 'public/uploads/who_we_are/images/1711426847209786.jpg', 'Rezaul Karim', 'employee', 1, 1, '2021-09-20 07:17:08', NULL),
(16, 'Pritom Das', 'Junior MERN Stack Developer', 'public/uploads/who_we_are/images/1711426894406394.jpg', 'Pritom Das', 'employee', 1, 1, '2021-09-20 07:17:53', NULL),
(17, 'Md Sohan', 'Junior Backend Developer', 'public/uploads/who_we_are/images/1711426919497888.jpg', 'Md Sohan', 'employee', 1, 1, '2021-09-20 07:18:17', NULL),
(18, 'Antora Tabassum', 'Junior Frontend Developer', 'public/uploads/who_we_are/images/1711426961275113.jpg', 'Antora Tabassum', 'employee', 1, 1, '2021-09-20 07:18:57', NULL),
(19, 'Ariful Sikder', 'Junior Laravel Developer', 'public/uploads/who_we_are/images/1711427006826563.jpg', 'Ariful Sikder', 'employee', 1, 1, '2021-09-20 07:19:40', NULL),
(20, 'MD. Lotiful Azad (Kajol)', 'Digital Influencer', 'public/uploads/who_we_are/images/1711427038987018.jpg', 'MD. Lotiful Azad (Kajol)', 'employee', 1, 1, '2021-09-20 07:20:11', NULL),
(21, 'Reyazaul Islam Rifat', 'Junior WordPress Developer', 'public/uploads/who_we_are/images/1711427066958118.jpg', 'Reyazaul Islam Rifat', 'employee', 1, 1, '2021-09-20 07:20:38', '2021-09-21 03:58:26'),
(22, 'DR. N A M MOMENUZZAMAN', 'Chairman', 'public/uploads/who_we_are/images/chairman-sir.jpg', 'Chairman of wakeupic', 'chairman', 1, 1, '2022-02-07 08:27:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_categories`
--

CREATE TABLE `account_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_categories`
--

INSERT INTO `account_categories` (`id`, `title`, `account_type`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Student Fee', 'Income', 'Global', 1, '2022-03-27 22:46:37', NULL),
(2, 'Student Fee', 'Income', 'Local', 1, '2022-03-27 23:19:58', NULL),
(3, 'Rent', 'Expense', 'Local', 1, '2022-03-27 23:44:10', NULL),
(4, 'Utilities', 'Expense', 'Local', 1, '2022-03-27 23:44:34', NULL),
(5, 'Employee Salary', 'Expense', 'Global', 1, '2022-03-28 04:11:34', NULL),
(6, 'Current Expense', 'Expense', 'Global', 1, '2022-03-28 04:14:55', NULL),
(7, 'Heart Cups', 'Income', 'Global', 1, '2022-03-28 04:16:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admited_students`
--

CREATE TABLE `admited_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `student_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_after_discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT 1,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gander` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_call_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `educational_qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passing_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admited_students`
--

INSERT INTO `admited_students` (`id`, `course_id`, `batch_id`, `student_type`, `course_fee`, `course_after_discount`, `discount_amount`, `active_status`, `student_name`, `gander`, `fathers_name`, `mothers_name`, `nationality`, `national_id_no`, `present_address`, `permanent_address`, `personal_call_no`, `email`, `religion`, `occupation`, `age`, `educational_qualification`, `result`, `passing_year`, `student_photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(2, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(3, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(4, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(5, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(6, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(7, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(8, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(9, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(10, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(11, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(12, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(13, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(14, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(15, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', '0000-00-00 00:00:00'),
(16, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(17, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(18, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(19, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(20, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', NULL),
(21, 6, 1, 'Global', '7500', '6000', '1500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 05:03:28', NULL),
(22, 6, 1, 'Global', '7500', '7000', '500', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 04:29:22', '0000-00-00 00:00:00'),
(23, 6, 3, 'Local', '7500', '5000', '2499', 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-28 07:11:33', NULL),
(24, 6, 3, 'Local', '7500', '5000', '2500', 1, 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-28 07:14:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_type_id`, `type`, `asset_name`, `date`, `quantity`, `unit_price`, `total_price`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(5, '2', 'Global', 'Computer', '2022-01-31', '10', '10', '100', 'dgfbfdxv', 1, '2022-03-27 07:22:03', '2022-03-27 07:22:03'),
(6, '3', 'Global', 'Wake up ict 3rd floor', '2022-03-28', '1', '5000000', '5000000', 'Remark Remark', 1, '2022-03-28 03:18:24', '2022-03-28 03:18:24'),
(7, '2', 'Global', 'Chair', '2022-03-28', '10', '500', '5000', 'Remark Bought Chair', 1, '2022-03-28 03:19:02', '2022-03-28 03:19:02'),
(8, '1', 'Global', 'Computer', '2022-03-28', '10', '1000', '10000', 'Remark computer bought', 1, '2022-03-28 03:20:02', '2022-03-28 03:20:02'),
(9, '3', 'Global', 'PC Mother Board', '2022-03-28', '11', '5500', '60500', 'efdsfd', 1, '2022-03-28 04:05:15', '2022-03-28 04:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `asset_types`
--

CREATE TABLE `asset_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_types`
--

INSERT INTO `asset_types` (`id`, `asset_type_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electronic', 1, '2022-03-17 07:41:04', '2022-03-28 02:18:58'),
(2, 'Furniture', 1, '2022-03-18 04:34:13', '2022-03-18 04:34:13'),
(3, 'Building', 1, '2022-03-18 04:34:27', '2022-03-18 04:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_batch` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `batch_number`, `course_id`, `title_id`, `batch_type`, `active_batch`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First', '6', '1', 'Global', 1, 1, '2022-03-27 22:51:56', NULL),
(2, 'First', '3', '1', 'Global', 1, 1, '2022-03-27 22:52:26', NULL),
(3, 'First', '6', '2', 'Local', 1, 1, '2022-03-27 23:26:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `templete_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_blog` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `blog_title`, `creator_name`, `update_time`, `short_description`, `footer_title`, `templete_name`, `blog_image`, `image_alt`, `header_image`, `active_blog`, `status`, `created_at`, `updated_at`, `slug_title`) VALUES
(5, 3, 'ফ্রী Microsoft Office Program course', 'Wake Up ICT Teams', '2022-01-16', '<p>যার ইনভাইট কার্যক্রম আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তাকে প্রথম বিজয়ী হিসেবে নির্ধারণ করা হবে। এবং দ্বিতীয় বিজয়ী কে লটারির মাধ্যমে নির্ধারণ করা হবে। আপনার সকল কার্যক্রম আমাদের IT Expert টিম দ্বারা মনিটরিং করা হবে সুতরাং উপরিউক্ত কোন একটি শর্তাবলী ও যদি কেউ বাদ রাখে তাহলে সে প্রতিযোগী হিসেবে গন্য হবে না।</p>', 'প্রতিযোগিতায় অংশগ্রহণের সময়সীমা ২৫ শে সেপ্টেম্বর পর্যন্ত।', '1', 'public/uploads/blog/images/1709785732805480.jpg', 'ফ্রী Microsoft Office Program course', '', 1, 1, '2021-09-01 22:32:20', '2022-01-16 01:08:02', 'free-microsoft-office-program-course'),
(6, 4, 'Sharna Islam Zenia', 'Wake Up ICT Teams', '2022-01-16', '<p><a href=\"https://www.facebook.com/sharnaislam.zenia?__cft__%5b0%5d=AZWGB8XGattP-prmDXhd8punrujJHl_NrMXx3zZ1Qy6R9QXZwpzBIFByqv_dxz52-L0gVKEGWmnHMn61B7iusOgjTSDPIFzzCbaGaJ12ZYcyaWRxKWAae7VlYQQ9J-kl2lddPdgjU1t4IKWEhfgIWtA4&amp;__tn__=-%5dK-R\">Sharna Islam Zenia</a> , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool.</p>', 'Sharna Islam Achieved Communication Certificate', '1', 'public/uploads/blog/images/1711423893204072.jpg', 'Sharna Islam Achieved Communication Certificate', '', 1, 1, '2021-09-01 22:43:23', '2022-01-16 01:04:04', 'sharna-achieved-communication-certificate'),
(7, 5, 'Improve Graphic design!', 'Wake Up ICT Teams', '2022-01-16', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', 'How To Improve Graphic design?', '1', 'public/uploads/blog/images/1709786782107086.png', 'How To Improve Graphic design', '', 1, 1, '2021-09-01 22:49:00', '2022-01-16 01:01:48', 'how-to-improve-graphic-design'),
(9, 6, 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', 'Wake Up ICT Teams', '2022-01-16', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে। আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১। লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে।</p>', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ রাজবাড়ী', '1', 'public/uploads/blog/images/1709972456887809.jpg', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ রাজবাড়ী', '', 1, 1, '2021-09-04 00:00:14', '2022-01-16 00:58:47', 'free-software-development-internship-rajbari'),
(10, 4, 'Nazmul Kadir', 'Wake Up ICT Teams', '0202-01-16', '<p><a href=\"https://www.facebook.com/nazmulkadir.pabna?__cft__%5b0%5d=AZUr7t2bqwds_6j7z2zFSY5CBwHQqH5nnqGbz-JnxOoF4F-Z_gjEX9BnJK9YTrxfVsM4Ta9A_dOq5HttjxrJGtYSdjGIaq-LyiScRiHfv_lwuCEF-Ytm07LCbJVQX_md6abeJmCeJZAD4xxLuknXV38Y&amp;__tn__=-%5dK-R\">Nazmul Kadir</a> , one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', 'Nazmul Kadir Achieved SEO Certificate', '1', 'public/uploads/blog/images/1711435640839282.jpg', 'Nazmul Kadir Achieved SEO Certificate', '', 1, 1, '2021-09-20 09:36:54', '2022-01-16 01:06:00', 'nazmul-kadir-achieved-seo-certificate'),
(11, 4, 'Md.Lotiful Azad Kajol', 'Wake Up ICT Teams', '2022-01-16', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate. For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', 'Lotiful Kajol Achived Marketing Certificate', '1', 'public/uploads/blog/images/1709975349465187.jpg', 'Lotiful Kajol Achived Marketing Certificate', '', 1, 1, '2021-09-04 00:46:12', '2022-01-16 00:56:41', 'kajol-achieved-marketing-certificate'),
(12, 3, 'Microsoft Office', 'Wake Up ICT Teams', '2022-01-16', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', 'Basic Computer', '1', 'public/uploads/blog/images/1709977970062088.png', 'Microsoft Office', '', 1, 1, '2021-09-04 01:27:51', '2022-01-16 02:23:54', 'microsoft-office'),
(13, 5, 'Graphic design', 'Wake Up ICT Teams', '2022-01-16', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709981392457096.jpg', 'Graphic design', '', 1, 1, '2021-09-04 02:22:16', '2022-01-16 01:11:28', 'graphic-design'),
(14, 7, 'Rajbari Jute Mills Visit', 'Wake Up ICT Teams', '2022-01-13', '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.&nbsp;</p>', 'Rajbari Jute Mills Visit For Project', '1', 'public/uploads/blog/images/1709981632078271.png', 'Rajbari Jute Mills Visit', '', 1, 1, '2021-09-04 02:26:04', '2022-01-16 00:53:41', 'rajbari-jute-mills-visit-for-project'),
(15, 7, 'Car Management Project', 'Wake Up ICT Teams', '2022-01-16', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p>', 'Online Rent A Car Management Project', '1', 'public/uploads/blog/images/1709981828528950.jpg', 'Car Management Project', '', 1, 1, '2021-09-04 02:29:11', '2022-01-16 00:49:29', 'car-management-project'),
(16, 5, 'Cloud80 Logo Design', 'Wake Up ICT Teams', '0202-01-16', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p>', 'Cloud80 tech company Logo Design', '1', 'public/uploads/blog/images/1709981997906463.jpg', 'Cloud80 tech company Logo Design', '', 1, 1, '2021-09-04 02:31:53', '2022-01-16 00:43:36', 'cloud80-company-logo-design'),
(17, 8, 'Wake Up ICT Location', 'Wake Up ICT Teams', '2022-01-16', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 'Wake Up ICT New Location Nannu Tower', '1', 'public/uploads/blog/images/1709982203715550.png', 'Wake Up ICT Location Nannu Tower  Rajbari', '', 1, 1, '2021-09-04 02:35:09', '2022-01-16 00:39:12', 'location-nannu-tower'),
(32, 9, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', 'HR Sharna', '2022-01-16', '<p>ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</p>', 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'public/uploads/blog/images/1711428499363215.jpg', 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '', 1, 1, '2021-09-20 07:43:24', '2022-01-16 01:10:51', 'web-development-career'),
(43, 7, 'দেশেসেরা হসপিটাল ইউনাইটেডে চলছে ওয়েক আপ এর সফটওয়্যার _\"হার্ট কপ\"', 'Sharna  islam', '2022-01-16', '<p><span style=\"font-weight: bolder; color: rgb(33, 37, 41); font-family: Poppins, sans-serif;\">মানব দেহের একটি অত্যন্ত গুরুত্বপূর্ন অর্গান সিস্টেম হার্ট ।হার্টজনিত সমস্যা গুলোর মধ্যে জটিলতর একটি অন্যতম শাখার নাম হার্ট ফেইলার । মানব শরীরের হার্ট ফেইলার জটিলতার এনালাইসিস এবং রিসার্স কাজের সুবিধার্থে তৈরীকৃত সফটওয়্যার টির নাম হার্টকপ।</span><br></p>', '______________', '1', 'public/uploads/blog/images/h.png', 'Heard Cop Login - Heard Failure', 'public/uploads/blog/images/h.png', 1, 1, '2022-01-16 02:34:59', '2022-01-18 03:13:38', 'heart-cop'),
(44, 10, 'বান্দরবন To কক্সবাজার', 'Sharna  islam', '2022-02-02', '<p style=\"text-align: center; \">এই বছরে আমাদের&nbsp; &nbsp;ট্যুর এর&nbsp; আয়োজন করা হয়েছিল বান্দরবন এবং কক্সবাজার সমুদ্র সৈকতে।</p><p style=\"text-align: center; \">অফিসের কাজের জাকাতলের মধ্যে কর্মকর্তাদের অবস্থা খুবই খারাপ হয়ে গিয়েসিলো। তাদের মানসিক এবং শারীরিক অবস্থা&nbsp; দুটোই&nbsp; ক্ষতিগ্রস্ত হয় তাই&nbsp; কর্মকর্তাদের কাজের চাপ মুক্ত করতে এবং মানসিক সুস্থতার জন্য খুবই প্রয়োজন ছিল।এবং তাদের জন্যই এই লং&nbsp; রিফ্রেশমেন্ট এর ব্যবস্থা করা হয়।</p>', '______________', '1', 'public/uploads/blog/images/Tour picture(Cox\'s Vs Bandorban)4.jpg', 'Tour picture(Cox\'s Vs Bandorban)4.jpg', 'public/uploads/blog/images/Tour picture(Cox\'s Vs Bandorban)4.jpg', 0, 1, '2022-02-01 23:52:50', '2022-02-01 23:53:35', 'bandorban-to-cox-bazar');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_name`, `short_description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Basic Computer', 'Basic Computer', 1, '2021-09-01 22:26:25', NULL),
(4, 'Certificate', '<p>Certification</p>', 1, '2021-09-01 22:39:51', '2021-09-01 22:44:46'),
(5, 'Graphic design_', 'Graphic design', 1, '2021-09-01 22:47:38', '2021-12-18 07:59:36'),
(6, 'Free Development Course', 'Free Development Course', 1, '2021-09-03 23:57:46', NULL),
(7, 'Our project', '<p>Our project</p>', 1, '2021-09-04 02:23:53', '2021-09-09 00:53:36'),
(8, 'Our Location_', 'Our Location', 1, '2021-09-04 02:34:11', '2021-12-18 07:59:30'),
(9, 'ক্যারিয়ার', 'ক্যারিয়ার', 1, '2021-09-09 00:53:51', NULL),
(10, 'Tour blog', 'এই বছরে আমাদের   ট্যুর এর  আয়োজন করা হয়েছিল বান্দরবন এবং কক্সবাজার সমুদ্র সৈকতে।\r\nঅফিসের কাজের জাকাতলের মধ্যে কর্মকর্তাদের অবস্থা খুবই খারাপ হয়ে গিয়েসিলো।  তাদের মানসিক এবং শারীরিক অবস্থা  দুটোই  ক্ষতিগ্রস্ত হয় তাই  কর্মকর্তাদের কাজের চাপ মুক্ত করতে এবং মানসিক সুস্থতার জন্য খুবই প্রয়োজন ছিল ।এবং তাদের জন্যই এই লং  রিফ্রেশমেন্ট এর ব্যবস্থা করা  হয়।', 1, '2021-11-14 03:19:21', '2021-11-15 05:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `blog_contents`
--

CREATE TABLE `blog_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `templete_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_design` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_contents`
--

INSERT INTO `blog_contents` (`id`, `blog_id`, `title`, `templete_name`, `content_design`, `file_type`, `image_alt`, `file`, `file_1`, `file_2`, `short_description`, `order`, `status`, `created_at`, `updated_at`) VALUES
(5, 5, 'Microsoft Office Program course', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709786100069671.jpg', '', '', '<p>1. আমাদের ফেসবুক+লিংকডিন পেজ টি লাইক এবং ফলো করুন।</p><p>2. আমাদের ফেসবুক পেজ এ কমপক্ষে ১০০ জনকে ইনভাইট করুন।</p><p>3. আমাদের অফার পোস্ট এর কমেন্টে কমপক্ষে ২০ জন কে মেনশন করুন।</p><p>4. আমাদের ফেসবুকের অফার পোস্ট টি আপনার ফেসবুক প্রোফাইলে শেয়ার করুন ।</p><p>5. ইনভাইট করার সময় কমপক্ষে ১০০ জনকে সিলেক্ট করে স্ক্রীনশট সহ আপনার ফেসবুক</p><p>6. প্রোফাইল লিংক টি আমাদের পেজ এ ম্যাসেজ করুন।</p><p>7. যার ইনভাইট এর মাধ্যমে আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তার বিজয়ী হওয়ার সম্ভাবনা বেশী থাকবে।</p>', 1, 1, '2021-09-01 22:38:10', NULL),
(6, 6, 'Sharna Islam Zenia', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709786634527725.jpg', '', '', '<p><a href=\"https://www.facebook.com/sharnaislam.zenia?__cft__%5b0%5d=AZWGB8XGattP-prmDXhd8punrujJHl_NrMXx3zZ1Qy6R9QXZwpzBIFByqv_dxz52-L0gVKEGWmnHMn61B7iusOgjTSDPIFzzCbaGaJ12ZYcyaWRxKWAae7VlYQQ9J-kl2lddPdgjU1t4IKWEhfgIWtA4&amp;__tn__=-%5dK-R\">Sharna Islam Zenia</a> , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool.</p><p>Communication also plays an essential role in human life and professional life. Employee communication is vital to a company’s health and strength. Without it, managers will not be able to manage their managed staff properly. The success of a business depends on the effective implementation of an employee communication strategy.</p>', 2, 1, '2021-09-01 22:46:40', NULL),
(7, 7, 'Graphic design', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709786875072225.png', '', '', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', 1, 1, '2021-09-01 22:50:29', NULL),
(8, 9, 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709972494163392.jpg', '', '', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে।</p><p>আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১।</p><p>লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে।</p><p>আমাদের ওয়েবসাইটের ঠিকানা : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0t8aQBIW2uiaU-e99ghHGbEJ1bzjMjWApeVO0aWzT5gf675BqhemBZrdA\">www.wakeupict.com</a></p>', 1, 1, '2021-09-04 00:00:49', '2021-09-04 00:32:15'),
(9, 10, 'Nazmul Kodir', '1', 'Left side', 'Image', 'najmul\'\'s certificate', 'public/uploads/blog/images/1711435668102488.jpg', '', '', '<p><a href=\"https://www.facebook.com/nazmulkadir.pabna?__cft__%5b0%5d=AZUr7t2bqwds_6j7z2zFSY5CBwHQqH5nnqGbz-JnxOoF4F-Z_gjEX9BnJK9YTrxfVsM4Ta9A_dOq5HttjxrJGtYSdjGIaq-LyiScRiHfv_lwuCEF-Ytm07LCbJVQX_md6abeJmCeJZAD4xxLuknXV38Y&amp;__tn__=-%5dK-R\">Nazmul Kadir</a> , one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', 1, 1, '2021-09-04 00:46:48', '2021-09-26 09:11:16'),
(10, 11, 'Md.Lotiful Azad', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709975382529591.jpg', '', '', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google.</p><p>He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate.</p><p>For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', 1, 1, '2021-09-04 00:46:44', NULL),
(11, 12, 'Microsoft Office', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709978052985640.png', '', '', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', 2, 1, '2021-09-04 01:29:11', NULL),
(12, 13, 'WakeUpIct', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709981450447830.jpg', '', '', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', 2, 1, '2021-09-04 02:23:11', NULL),
(13, 14, 'Rajbari Jute Mills Projects', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709981683648684.png', '', '', '<p>&nbsp;</p><p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software. Recently they visit the Rajbari Jute Mill for collecting their Requirements and understand the environment of the Rajbari Jute mill. According to the Team Lead, They are playing to launch their first version of this Software end of this year. We are so thrilled about the journey ahead.</p>', 1, 1, '2021-09-04 02:26:53', NULL),
(14, 15, 'Car Management Project', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709981851934164.jpg', '', '', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p><p>Special thanks go to Folly Edem the Co-Organizer of GDG LOME for his interest in WAKEUPICT for build this project with modern technology.</p><p>Finally, we complete the project and deploy it on the server.</p>', 1, 1, '2021-09-04 02:29:33', NULL),
(15, 16, 'Cloud80', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709982062615369.jpg', '', '', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p><p>They desire a logo for their company. Our Two Graphic Designers <a href=\"https://www.facebook.com/shaharimaafroj.sraboni.5?__cft__%5b0%5d=AZVXBESv4fiXNLd9HWK0-e3KO3gBEo8R0NWW04Tm8OtiL0CmtyRlsRcvLjcZ-hYgWJazoEbnsEsNnM2yOctsSSw1PPyGh8RzaA9QF8_JSn9TcyFi6zGrhjpa4Vs6JBAYyM4IblmSDRn0MvcNCqLd9S_R&amp;__tn__=-%5dK-R\">Shaharima Afroj Sraboni</a> and Asma Urmi do magnificent work on this project and develop very quality content based on client desire.</p>', 1, 1, '2021-09-04 02:32:55', NULL),
(16, 17, 'স্থান পরিবর্তন:', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709982248715676.png', '', '', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 1, 1, '2021-09-04 02:35:52', NULL),
(23, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711428755387645.jpg', '', '', '<p><span style=\"background-color:gray;color:black;\"><i><mark class=\"marker-yellow\"><strong>ওয়েব ডেভেলপমেন্ট ক্যারিয়ারঃ</strong></mark></i></span></p><p>&nbsp;</p><p><span style=\"color:black;\">ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</span></p><p><span style=\"color:rgb(112,48,160);\">&nbsp;</span></p><p><span style=\"background-color:gray;\"><i><mark class=\"marker-yellow\"><strong>ওয়েব ডেভেলপমেন্ট কি?</strong></mark></i></span></p><p>একটি ওয়েবসাইটের জন্য সাধারণত অ্যাপ্লিকেশন তৈরি করা&nbsp; হচ্ছে ওয়েব ডেভেলপমেন্ট । যেখানে সাধারণত একজন ওয়েব ডেভেলপার একটি ওয়েবসাইটের জন্য এপ্লিকেশন তৈরি করে থাকেন। আর একজন ওয়েব ডিজাইনার যে ডিজাইন করে থাকুক না কেন তার প্রতিটা উপকরণকে সাধারণত ফাংশনাল করার জন্য পরিচালিত কর্মকাণ্ডই হলো ওয়েব ডেভেলপমেন্ট।</p>', 1, 1, '2021-09-20 07:47:28', NULL),
(24, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1711428821673177.jpg', '', '', '<p>ওয়েব ডেভেলপমেন্টের কাজ শিখতে যা যা লাগবেঃ</p><p>&nbsp;</p><p>১. সাধারণত প্রথমে আপনাকে ওয়েব ডেভেলপমেন্ট কি এবং ডিজাইন কি এই সম্পর্কে ভাল করে জানতে হবে এবং ধারণা রাখতে হবে।অর্থাৎ এক কথায় আপনাকে ব্যাপারটা ভালোভাবে বুঝতে হবে।</p><p>&nbsp;</p><p>২.সাধারণত মার্কেটপ্লেসগুলোতে এই কাজ করে&nbsp; আপনাকে সফল হতে হলে অনেক ধৈর্য শক্তি থাকতে হবে এবং রিসার্চ করার মানসিকতা থাকতে হবে। ।অনেকে আছেন যারা অনেক ভালো কাজ পারেন কিন্তু তাদের ধৈর্য শক্তি কম তারা অনলাইনে ক্যারিয়ার গড়তে ব্যর্থ হয়েছেন। তাই অবশ্যই ধৈর্য ধরে কাজ করতে হবে।কোন কিছূ না বুঝতে পারলে সেটা রিসার্চ করার করার মানসিকতা তৈরি করতে হবে।</p><p>&nbsp;</p><p>&nbsp;</p><p>৩. আপনার সৃজনশীল চিন্তা করার যোগ্যতা থাকতে হবে। তার জন্য&nbsp; আপনাকে প্রচুর পরিমাণে চর্চা করতে হবে। প্রায়&nbsp; সবক্ষেত্রে&nbsp; অবশ্যই এক্ষেত্রে বায়ার বা যে প্রতিষ্ঠানে কাজ করতে চাইবেন তারা আপনার আগের কাজ দেখতে চাইবে। ফলে আপনি যে কাজ গুলো চর্চা করবেন সেগুলোকে তাদের কে দেখাতে পারবেন। এছাড়াও আপনি যখন মার্কেটপ্লেস গুলোতে কাজ করতে থাকবেন আস্তে আস্তে আপনার এই বিষয়গুলো নিয়ে সৃজনশীল চিন্তা&nbsp; তৈরি হয়ে যাবে।</p><p>&nbsp;</p><p>৪.&nbsp; আপনাকে ইংরেজি জানতে হবে তবে এটা মোটামুটি জানলেও চলবে কেননা আপনি যখন বায়ারের সাথে ডিল করবেন তখন এটি আপনাকে সাহায্য করবো। তাদের ভাষা বুঝতে আপনার পক্ষে অনেক সহজ হবে।</p><p>&nbsp;</p><p>&nbsp;</p><p>৫. ওয়েব ডেভেলপমেন্ট এর কাজের জন্য আপনাকে পর্যাপ্ত পরিমানে সময় দিতে হবে। আপনি যদি এখানে সময় দিতে না পারেন তাহলে আপনি কোনদিনও এই কাজ ভালোভাবে করতে পারবেন না বা আপনি সফল হতে পারবেন না। আর সব চেয়ে গুরুত্বপূর্ণ হচ্ছে মাইন্ড সেট করা । আপনাকে এমনভাবে মাইন্ড সেট করতে হবে যে, আপনি প্রতিদিন নিদির্ষ্ট পরিমাণ সময় এখনে দিতে পারেন। আপনাকে প্রতিদিনের লক্ষ্যমাত্রা রাখতে হবে আপনি যেন মিনিমাম ৪-৫ ঘন্টা সময় ব্যয় করতে পারেন । কথায় আছে কষ্ট করলে কেষ্ট মিলে। তাই, সময় দিয়ে শিখুন।</p><p>৬. আপনাকে প্রচুর পরিমাণে পরিশ্রম করতে হবে এখানে। আর ধৈর্যের সাথে কাজ করতে হবে। প্রথম দিকে হয়তো কাজ পেতে কিছৃট বেগ পেতে হতে পারে তখন হতাশ না হয়ে বরং ধৈয্য ধরে আপনার স্কিলগুলোকে ঝালাই করে নিতে হবে।</p><p>&nbsp;</p><p># ওয়েব ডেভেলপার এর ধরণঃ</p><p>১. ফ্রন্টএন্ড ডেভেলপার</p><p>২.&nbsp; ব্যাকএন্ড ডেভেলপার</p><p>৩.&nbsp; ফুলস্ট্যাক ওয়েব ডেভেলপার</p>', 2, 1, '2021-09-20 07:48:31', NULL),
(25, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711428951735719.jpg', '', '', '<p><span style=\"background-color:gray;\"><mark class=\"marker-yellow\">ফ্রন্টএন্ড ডেভেলপার বা ওয়েব ডিজাইনার এর কাজ কি?</mark></span></p><p>ওয়েব ডিজাইন হচ্ছে একটা ওয়েবসাইটের জন্য বাহ্যিক গঠন তৈরী করা। ওয়েব ডিজাইনারের মুল কাজ একটা সাইটের জন্য টেমপ্লেট (ওয়েবপেজ) বানানো, এখানে কোন এপ্লিকেশন থাকবেনা। যেমন লগিন সিস্টেম, নিউজলেটার সাইনআপ, পেজিনেশন, ফাইল আপলোড করে ডেটাবেসে সেভ করা, ইমেজ ম্যানিপুলেশন, যদি সাইটে বিজ্ঞাপণ থাকে তাহলে প্রতিবার পেজ লোড হওয়ার সময় বিজ্ঞাপণের পরিবর্তন এগুলি এপ্লিকেশন, ওয়েব এপ্লিকেশন। এসব তৈরী করতে হয় প্রোগ্রামিং ল্যাংগুয়েজ দিয়ে। কোন প্রকার এপ্লিকেশন ছাড়া একটা সাইট তৈরী করা এটাই ওয়েব ডিজাইন, এধরনের ডিজাইনকে বলা যায় স্টাটিক ডিজাইন। ওয়েব ডিজাইনের জন্য এই ধারনাটি সাধারনত ব্যবহৃত হচ্ছে।</p><p>কে শিখতে পারবে ওয়েব ডিজাইন?</p><p>&nbsp;</p><p>যে কেউ&nbsp;&nbsp; শিখতে পারবে যে নূনতম শিক্ষিত, যার কম্পিটার এর বেসিক নলেজটুকু জানা আছে । এর জন্য এমনটি নয় যে অনেক ইংলিশ ভালো জানতে হবে কিংবা অনেক সফটওয়্যার জানতে হবে।</p><p>ওয়েব ডিজাইন শেখার জন্য যা প্রয়োজন তা হলো:</p><p>&nbsp;</p><p>১.ফটোশপ / ইলাস্ট্রেটর.</p><p>২.এইচ টি এম এল (HTML).</p><p>৩.সি এস এস (CSS)</p><p>&nbsp;</p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ফ্রন্ট-এন্ড ওয়েব ডেভেলপার হিসেবে কাজের সুযোগঃ</mark></span></p><p>ফ্রন্ট-এন্ড ডেভেলপাররা একটি ওয়েবসাইটের লে-আউট, তার ইন্টারেক্টিভ এবং নেভিগেশনাল এলিমেন্ট যেমন বাটনস, স্ক্রলবার, ইমেজ, অভ্যন্তরীণ বিভিন্ন লিংক— এসবকিছু বাস্তবায়িত করেন। বিভিন্ন ব্রাউজার এবং ডিভাইসে ওয়েবসাইট বা অ্যাপ্লিকেশনের যথাযথ প্রদর্শনও নিশ্চিত করেন ফ্রন্ট-এন্ড ডেভেলপার।</p><p>&nbsp;তারা ওয়েবসাইটগুলো এমনভাবে কোড করেন যাতে বিভিন্ন স্ক্রিন সাইজ ও ডিভাইসের ধরনের সাথে সেগুলো এডাপ্টেবল হয়। ফলে ইউজাররাও সবখানে সন্তোষজনক এক্সপেরিয়েন্স পান। এছাড়াও ফ্রন্ট-এন্ড ডেভেলপাররা নিয়মিত ইউজেবিলিটি টেস্ট করা, ফ্রন্ট-এন্ডে কোনো বাগ দেখা দিলে তারা&nbsp; তা ফিক্স করার জন্য&nbsp; কাজ করেন। এই সব কাজ করতে তারা এসইও (সার্চ ইঞ্জিন অপ্টিমাইজেশন),সফটওয়্যার ওয়ার্কফ্লো ম্যানেজমেন্ট — এগুলোও মাথায় রাখেন।</p><p>তবে এক্ষেত্রে বাংলাদেশের প্রেক্ষাপটে&nbsp; থেকে উল্লেখ্য হচ্ছে, এখন পর্যন্ত শুধুমাত্র ফ্রন্ট-এন্ড ডেভেলপার হিসেবে জবের সংখ্যা তুলনা মূলকভাবে বেশ কম লক্ষ্য করা যায়। বিভিন্ন প্রতিষ্ঠানগুলো সাধারণত ফুল-স্ট্যাক ডেভেলপারই নিয়োগ করে থাকেন এবং তাদের মাঝে মাঝে ব্যাক-এন্ড ডেভেলপারও প্রয়োজন হয়। তাই শুধুমাত্র ফ্রন্ট-এন্ড ডেভেলপার হিসেবে বাংলাদেশের বাজারে প্রতিষ্ঠিত হওয়া কিছুটা দুরূহই বলতে হয় এই দিকগুলো&nbsp; পর্যবেক্ষণ করে।</p><p>এর সম্ভাবনাময় দিক গুলো :</p><p>&nbsp;</p><p>একজন ভালো ওয়েব ডিজাইনার এর চাহিদা অনেক বেশি হয়ে থাকে। ওয়েব ডিজাইনার হয়ে কখনো চাকরির জন্য মাসের পর মাস বেকার বসে থাকতে হয় না। আসলে বসে থাকার প্রয়োজন’ও পরে না কারণ এটা আন্তর্জাতিক মানের একটি পেশা। অনলাইন এ ফ্রিলান্সিং কিংবা অফসাইট এ কন্ট্রাকচুয়াল কাজের অনেক সুযোগ এখানে আছে। বছর বছর প্রমোশন না থাকলেও, বেতনের বৃদ্ধির হারটা অনেক উর্ধগতি। এই পেশায় অভিজ্ঞতা দিয়ে আপনার মুল্য বিচার করা হয়। এই পেশায় যার যত বেশি কাজের অভিজ্ঞতা বাড়তে থাকে তার যোগ্যতাও তত বেশি হতে থাকে।</p><p>&nbsp;</p>', 3, 1, '2021-09-20 07:50:35', '2021-09-20 07:54:23'),
(26, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1711429026846589.jpg', '', '', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ব্যাকএন্ড&nbsp; ডেভেলপার বা ওয়েব ডেভেলপার এর কাজ কি?</mark></span><mark class=\"marker-yellow\">&nbsp;</mark></p><p>একজন ফ্রন্টএন্ড ডেভেলপারের ডেভেলপ করা স্ট্যাটিক ওয়েবসাইটে প্রাণসঞ্চার করার কাজটি যিনি ,করেন তিনিই হলেন&nbsp; ব্যাকএন্ড&nbsp; ডেভেলপার। ফ্রন্টএন্ড ডেভেলপারের কাজের উপর ব্যাসেস করে ব্যাকএন্ড&nbsp; ডেভেলপার ওয়েবসাইটকে ডেভেলপ করে থাকেন। এজন্য ফ্রন্টএন্ড&nbsp; ডেভেলপারকে ব্যাকএন্ড&nbsp; সম্পর্কে ধারণা না রাখলেও চলে কিন্তু ব্যাকএন্ড&nbsp; ডেভেলপারকে ফ্রন্টএন্ড সম্পর্কে ধারণা রাখতে হয়। নরমালি একজন ব্যাকএন্ড&nbsp; ডেভেলপার ফ্রন্টএন্ড&nbsp; ডেভেলপা্রের কাছ থেকে একটি ওয়েবসাইট ডিজাইনের কোডগুলো নিয়ে সেটির একটি এডমিন প্যানেল তৈরি করেন। এডমিন প্যানেল তৈরি করার পর সেই ওয়েবসাইটের ডিজাইন পরিবর্তন করার জন্য বা নতুন পোস্ট লেখার জন্য কোডিং করতে হয়না। অর্থাৎ একজন ব্যাকএন্ড&nbsp; ডেভেলপার একটি ওয়েবসাইটকে স্ট্যাটিক ওয়েবসাইটে রূপান্তর করে দেয়। এখানে আপনাকে প্রোগ্রামিং শিখতে হবে। এটাই মুল জিনিস ডেভেলপমেন্টে। মূলত ওয়েব প্রোগ্রামিং যেমন ASP.NET, PHP, Java বা অন্য কোন ল্যাংগুয়েজ। তবে পিএইচপির কাজ বর্তমানে সবচেয়ে বেশি।ওয়েব ডেভেলপমেন্টে প্রোগ্রামিং শেখার পাশাপাশি আপনাকে সংশ্লিষ্ট অনেক কিছু শিখতে হবে। অন্যথায় আপনি আর উপরে উঠতে পারবেন না। যে বিষয়গুলো ভালোভাবে শিখতে হবে:</p><p>১. যে কোন একটি প্রোগ্রামিং ল্যাঙ্গুয়েজ মূলত PHP শিখতে হবে।</p><p>২. মাইসিক্যুয়েল-এর মতো একটি ডাটাবেস ডিজাইনের মাধ্যমে, আপনাকে মধ্যম স্তরের অন্তত একটি পূর্ণাঙ্গ রিলেশনাল ডাটাবেস তৈরি করতে সক্ষম হতে হবে।</p><p>৩. খুবই ভাল কোয়েরি শিখতে হবে। যাতে SQL দিয়ে জটিল কোয়েরি করতে পারতে হবে।</p><p>৪. ফেসবুক / গুগল / টুইটার / আমাজন প্রভৃতি বিখ্যাত সাইটের ওয়েব সার্ভিস / API কীভাবে ব্যবহার করতে হয় তা আপনার জানা উচিত (এক্সএমএল)</p><p>৫. হোস্টিং সম্পর্কে স্পষ্ট ধারণা থাকতে হবে বিশেষ করে সার্ভার ম্যানেজমেন্ট সম্পর্কে ধারনা।</p><p>৬.কিভাবে একাধিক ডেভেলপার একই প্রজেক্টে সোর্স কন্ট্রোল যেমন git, tortoise svn ইত্যাদি দিয়ে কাজ করতে পারে এসব জানতে হবে ।</p><p>৭. এজাক্স, জেকোয়েরি এবং ডেভেলপমেন্ট সংক্রান্ত বিভিন্ন টুলস সম্পর্কে প্রচুর জানতে হবে। যেমন নেটবিনস (কোড লেখার IDE), HeidiSQL, MySQL WorkBench (ডেটাবেস ডিজাইন টুল) এসব জানতে হবে।</p><p>&nbsp;</p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ব্যাক-এন্ড ওয়েব ডেভেলপার হিসেবে কাজের সুযোগঃ</mark></span></p><p>ব্যাক-এন্ড ডেভেলপার ফ্রন্ট-এন্ডকে সচল রাখার জন্য যে ইনফাস্ট্রাকচার দরকার তা তৈরি ও রক্ষণাবেক্ষণ করেন। এর মূলত তিনটি অংশ বলা যায়— সার্ভার, অ্যাপ্লিকেশন, ডেটাবেজ। ব্যাক-এন্ড ডেভেলপারদের দেওয়া কোড সার্ভার অ্যাপ্লিকেশন এবং ডাটাবেসের মধ্যে মসৃণ যোগাযোগ নিশ্চিত করে। তারপর বিভিন্ন ডাটাবেস ম্যানেজমেন্ট টুলস সার্চ, এডিট এবং ডেটা সেভ করে এবং ফ্রন্ট-এন্ডে পাঠায়।ফ্রন্ট-এন্ড ডেভেলপারদের মতো, ব্যাক-এন্ড ডেভেলপাররা তাদের চাহিদা মেটাতে ক্লায়েন্টদের সাথে কাজ করে। ব্যাক-এন্ড ডেভেলপমেন্ট টাস্কগুলি সাধারণত ডেটাবেস তৈরি, সংহত এবং রক্ষণাবেক্ষণ, ব্যাক-এন্ড ফ্রেমওয়ার্ক ব্যবহার করে সার্ভার-সাইড সফটওয়্যার তৈরি, কন্টেন্ট ম্যানেজমেন্ট সিস্টেম তৈরি এবং বাস্তবায়ন এবং ওয়েব সার্ভার প্রযুক্তি এবং অপারেটিং সিস্টেমগুলির সাথে কাজ করে।</p><p>&nbsp;</p><p>বাংলাদেশে ব্যাক-এন্ড ডেভেলপারদের সুযোগ তুলনামূলকভাবে বেশি হলেও নিজেকে ফুল-স্ট্যাক ডেভেলপার হিসেবে তৈরি করতে পারলেই সুযোগ সবচেয়ে বেশি থাকে। যেকোনো প্রতিষ্ঠানের জন্যই ফ্রন্ট-এন্ডের তুলনায় ব্যাক-এন্ড ডেভেলপার বেশি প্রয়োজন হয়। কারণ সেখানে কাজের ক্ষেত্র অনেক বেশি। সেক্ষেত্রে প্রতিষ্ঠানগুলোর জন্য ফুল-স্ট্যাক ডেভেলপার হায়ার করাই বেশি লাভজনক, যেহেতু সেই ডেভেলপার প্রয়োজনমত যেকোনো রোলেই কাজ করতে পারেন।</p>', 4, 1, '2021-09-20 07:51:47', NULL),
(27, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711429087053497.jpg', '', '', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ফুলস্ট্যাক ওয়েব ডেভেলপার এর কাজ কি?</mark></span></p><p>কোন ওয়েবসাইট তৈরি করতে গেলে ওয়েবসাইট ডিজাইন করার পাশাপাশি ওয়েবসাইটের আরও কিছু কাজ করা লাগে। ওয়েবসাইট ডিজাইন করাই ওয়েবসাইট বানানোর ক্ষেত্রে একমাত্র কাজ নয় বরং <span style=\"color:black;\">ওয়েবসাইটের সার্ভারসহ ওয়েবসাইটের কাঠামো তৈরি ওয়েবসাইট তৈরির ক্ষেত্রে অনেক বড় একটি অংশ বহন করে। তাই একটি ওয়েব ডেভেলপারের প্রয়োজন হয় একটি ওয়েবসাইটের কাজের জন্য এবং সেই সাথে একজন ওয়েব ডিজাইনার এবং একজন ফুল-স্ট্যাক ডেভেলপারের কাজ হল ওয়েব ডিজাইন এবং ওয়েব ডেভেলপমেন্টের দুটোর কাজ সম্পূর্ণ করা এবং সমন্বয় করা।</span></p><p><span style=\"color:red;\">&nbsp;</span></p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">একজন ফুল স্ট্যাক ডেভেলপার কোথায় কাজ করেন?</mark></span></p><p>ফুল স্ট্যাক ডেভেলপার হলে আপনার কাজের ক্ষেত্র শুধুমাত্র ওয়েবসাইটের কাজের মধ্যেই সীমাবদ্ধ। বর্তমানে ইন্টারনেটের যুগে সবধরনের প্রতিষ্ঠানেরই ওয়েবসাইট প্রয়োজন হয়। তাই ফুল স্ট্যাক ডেভেলপারের কাজের ক্ষেত্র একটি নির্দিষ্ট জায়গায় সীমাবদ্ধ হলেও কাজের ধরনে বেশ বৈচিত্র্য থাকে এবং এক্ষেত্রে সৃষ্টিশীলতা দেখানোর বেশ সুযোগ থাকে। বৈচিত্র্যের সাথে কাজ করতে চান এবং সৃষ্টিশীল কাজের প্রতি আগ্রহী হলে ফুল স্ট্যাক ডেভেলপার হিসেবে আপনি কাজ করতে পারেন।</p><p><span style=\"color:black;\">&nbsp;</span></p><p><span style=\"color:black;\">একটি পূর্ণ স্ট্যাক ওয়েব ডেভেলপার কি উপার্জন করতে পারে?</span></p><p><span style=\"color:black;\">একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কত উপার্জন করবে তা তার কাজের দক্ষতা এবং অভিজ্ঞতার উপর নির্ভর করবে। যাইহোক, দক্ষতার উপর নির্ভর করে, কিছু কোম্পানির ২০,০০০টাকা থেকে ১ লক্ষ টাকা পর্যন্ত সেলারি রয়েছে।</span></p><p>&nbsp;</p><p>একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কি পরিমান উপার্জন করতে পারে?</p><p>একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কত উপার্জন করবে তা তার কাজের দক্ষতা এবং অভিজ্ঞতার উপর নির্ভর করবে। যাইহোক, তবে দক্ষতা ভেদে কিছু কিছু কোম্পানিতে ২০ হাজার টাকা থেকে ১ লাখ টাকা পর্যন্ত সেলারি রয়েছে।</p>', 5, 1, '2021-09-20 07:52:44', NULL),
(28, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711429270146527.jpg', '', '', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ওয়েব ডেভেলপমেন্ট এর ভবিষ্যৎ চাহিদা :</mark></span></p><p>বর্তমানে ওয়েব ডিজাইন ও ডেভেলপমেন্ট-এর চাহিদা মার্কেট প্লেস গুলোতে অনেক বেশি, সেই সাথে প্রতিনিয়ত বেড়েই চলেছ এবং ভবিষ্যতে আরও বাড়বে এবং বাড়তেই থাকবে।</p><p>ওয়েব ডিজাইন এবং ডেভেলপমেন্টের কাজ শিখেছেন এমন অনেকেই আপওয়ার্ক, ফাইবার, ফ্রিল্যান্সার,&nbsp; পিপলপারআওয়ার সহ আরো অনেক জনপ্রিয় মার্কেটপ্লেসে কাজ করছেন।</p><p>&nbsp;</p><p>&nbsp;</p><p>সাধারণত যতদিন ওয়েবসাইট থাকবে ততদিন ওয়েব ডেভেলপমেন্ট এর চাহিদাও থাকবে। দিনদিন ওয়েবসাইটের সংখ্যা বেড়েই চলেছে। যেমন ধরুন, ২০১৫ হিসাব মতে বিশ্বে মোট ওয়েবসাইট ছিল তখন ৮৬ কোটি তারপরে ২০১৭ সাল নাগাদ এর সংখ্যা বেড়েছে ১১৫ কোটিরও বেশি। দুই বছরের এর পরিমাণ বেড়েছে ৪৩ কোটিরও বেশি। আর বুঝতে বাকি নেই যে বর্তমান বিশ্বে ওয়েব সাইট ডেভলপার বা ওয়েবসাইট ডিজাইনার মূল্য বা চাহিদা কতটা। যেকোনো মার্কেটপ্লেসে একজন ওয়েব ডেভেলপার তার কাজের ধারা অনুযায়ী ঘন্টায় ২০&nbsp; ডলার&nbsp; থেকে একশ ডলার পর্যন্ত ইনকাম করে থাকে। বাংলাদেশে এমন অনেক ফ্রিল্যান্সার রয়েছেন যারা সাধারণত কাজের ধারণা দিয়ে প্রতি ঘণ্টায়&nbsp; কমপক্ষে ১০০ ডলার পর্যন্ত আয় করে থাকে।</p><p>সাধারণত, ওয়েব ডেভেলপমেন্ট বা ওয়েব ডিজাইন কাজের ক্ষেত্রে ফ্রিল্যান্সিংকে সর্বোচ্চ চাকরি বা আয় হিসেবে বিবেচনা করা হয়।</p>', 6, 1, '2021-09-20 07:55:39', NULL),
(81, 43, '\"হার্ট কপ\"', '1', 'Only Text', NULL, NULL, NULL, NULL, NULL, '<p>মানব দেহের একটি অত্যন্ত গুরুত্বপূর্ন অর্গান সিস্টেম হার্ট ।হার্টজনিত সমস্যা গুলোর মধ্যে জটিলতর একটি অন্যতম শাখার নাম হার্ট ফেইলার । মানব শরীরের হার্ট ফেইলার জটিলতার এনালাইসিস এবং রিসার্স কাজের সুবিধার্থে তৈরীকৃত সফটওয়্যার টির নাম <b>হার্টকপ</b>।</p><p>এই সফটওয়্যার এ রোগীর যাবতীয় প্রয়োজনীয় তথ্য সংরক্ষণ থাকে। প্রত্যেক সাক্ষাৎকারে&nbsp; রোগীর ইনফরমেশনগুলো আপডেট করে।যার ফলাফল সরূপ সিস্টেম প্রত্যেক রোগীর বর্তমান অবস্থার সুস্পষ্ট&nbsp; ধারণা রাখে। রোগীর&nbsp; বর্তমান শারীরিক অবস্থা অনুযায়ী&nbsp; সিস্টেম ডাক্তারদেরকে রোগীর প্রয়োজন অনুযায়ী ডাক্তারের সাথে রোগীর অন ফোন বা ভার্চুয়াল সাক্ষাৎ করার নোটিফিকেশন ডাক্তারকে দিয়ে থাকে।</p><p>এর ফলে রোগী প্রতিনিয়ত সিস্টেম এর টেক কেয়ার এ থাকে। এই সিস্টেম ডাক্তার এর প্রেসক্রিপশন সহজ করার জন্য ডাক্তারকে রোগীর পূর্বের অবস্থা এবং বর্তমান অবস্থার তারতম্য সুনির্দিষ্ট করে উপস্থাপন করে। ডাক্তার প্রয়োজনে&nbsp;<b> ONE CLICK</b> এ রোগীর সকল প্রকার তথ্যের এনালাইসিস দেখতে পারবে । এছাড়াও সিস্টেমটি&nbsp; একটি প্রেসক্রিপশন কয়েক ধাপে যাচাই বাছাই করার মাধ্যমে ফাইনাল&nbsp; প্রেসক্রিপশন প্রস্তুত করার কাজ গুলো অনেক সহজেই সম্পন্য করে।</p><p>রোগীর প্রেসক্রিপশনের ভিত্তিতে মেডিসিন বা ড্রাগ রিপোর্ট&nbsp; দৈনিক , মাসিক বা বাৎসরিক ভিত্তিতে&nbsp; রোগীর যাবতীয় তথ্যের এনালাইসিসের আলোকে বিভিন্ন রিপোর্ট পর্যবেক্ষন করার ব্যাবস্থাও রয়েছে এই সফটওয়্যার টিতে ।সফটওয়্যার ম্যনেজমেন্ট করার জন্য রয়েছে ডায়নামিক এডমিন প্যানেল যেখান থেকে মোডিফাই করা যাবে সফটওয়্যার এর বিভিন্ন তথ্য অতি সহজেই ।<br><br><br><br></p><h1 class=\"___class_+?10___\" style=\"font-family: Arvo, serif; color: rgb(33, 37, 41); text-align: center;\">______________</h1><p><br></p>', 1, 1, '2022-01-16 02:36:08', '2022-01-18 03:19:14'),
(82, 43, 'ওয়েক আপ আই সি টি এবং ইউনাইটেড হাসপাতাল', '1', 'Top Three', 'Image', 'Heard Cop Login - Heard Failure', 'public/uploads/blog/images/united hospital management - heart cop.jpg', 'public/uploads/blog/images/DR. N A M MOMENUZZAMAN - Wake Up ICT.jpg', 'public/uploads/blog/images/united hospital entry - heart cop.jpg', '<p>হার্ট ফেইলার&nbsp; জটিলতাকে আরো&nbsp; সূক্ষ্মভাবে এনালাইসিস এবং রিসার্স করার উদ্দেশ্য থেকেই আমাদের এই হার্টকপ সফটওয়্যারটি তৈরীর পরিকল্পনা শুরু।&nbsp;</p><p>হার্টকপ এপলিকেশন টি তৈরীতে হার্ট বিশেষজ্ঞ এবং <b>ইউনাইটেড&nbsp;</b><font color=\"#050505\" face=\"Segoe UI Historic, Segoe UI, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15px; white-space: pre-wrap;\"><b>হসপিটালের</b></span></font><b>&nbsp;চীফ কনসালটেন্ট&nbsp;&nbsp;ডাঃ মোমেনুজ্জামান</b> যিনি দীর্ঘদিন ধরে হৃদজনিত রোগের চিকিৎসা করে আসছেন তার অবদান অপরিহার্য ।&nbsp;</p><p>তার দীর্ঘদিনের অভিজ্ঞতার বর্নণা বিশ্লেষনের মাধ্যেমে হার্টকপ সফটওয়্যারটির ডিজাইন করা হয় ।এই সফটওয়্যার টির ডিজাইন এবং ডেভেলোপমেন্ট পরিকল্পনা করার জন্য প্রথমত ডেভেলোপার দের সাথে হার্ট বিশেষজ্ঞ এবং ইউনাইটেড&nbsp; হসপিটালের<b> চীফ কনসালটেন্ট&nbsp; ডাঃ মোমেনুজ্জামান</b> এর বেশ কয়েকবার দিনব্যাপি সাক্ষাৎকার করতে হয়। ডিজাইন এবং ডেভেলোপমেন্ট পরিকল্পনা করতে প্রায় ২ মাস সময় লাগে । এরপর সফটওয়্যারটির বিভিন্ন উপাদানের রিকুয়ারমেন্ট এর জন্য আরো বেশ কয়েকবার ইউনাইটেড হসপিটালের&nbsp;<b>চীফ কনসালটেন্ট&nbsp;ডাঃ মোমেনুজ্জামান</b> এর সাথে দিনব্যাপি আলোচনা করে এর প্রথম ভার্সন স্টাবল করতে আরো তিন থেকে চার মাসের মত সময় লেগে যায় ।মাঠ পর্যায়ে সফটওয়্যারটি ব্যাবহার করার আগে টেস্ট ডাটা এন্ট্রি এবং বাগ ফিক্সড সহ ব্যাবহার সুবিধা আরো উন্নত করার লক্ষে ডেভেলোপার টিম কয়েকদিন ব্যাপি ইউনাইটেড হাসপাতালে সশরীরে অবস্থান করে এবং সফটওয়্যার টিকে আরো উন্নত করার জন্য রিসার্স করে নতুন করে রিসার্স ফলাফল সহ আরো কিছু নতুন পরিকল্পনা এবং কিছু ত্রুটি ফিক্সিং এর রিকুয়ারমেন্ট পায় ।যেগুলো&nbsp; সফটওয়্যারটির দ্বিতীয় ভার্সনে ফিক্সড করা&nbsp; হয় । সফটওয়্যারটির দ্বিতীয় ভার্সন প্রস্তুত করতে আরো প্রায় দুই থেকে তিন মাসের মত সময় লেগে যায় । বর্তমানে&nbsp; সফটওয়্যার টির<b>&nbsp; heartCop 3.0.0</b>&nbsp;&nbsp;ভার্সন চলছে ।<br><br><br><br></p><h1 class=\"___class_+?10___\" style=\"font-family: Arvo, serif; color: rgb(33, 37, 41); text-align: center;\">______________</h1><p><br></p>', 2, 1, '2022-01-16 02:39:07', '2022-01-18 03:45:38'),
(84, 43, 'বাস্তব সুবিধা', '1', 'Top Three', 'Image', 'Heard Cop Login - Heard Failure', 'public/uploads/blog/images/Best part of our Application - heart cop.jpg', 'public/uploads/blog/images/Digital Call Management System - heart cop.jpg', 'public/uploads/blog/images/Digital Reports Heart Failure- heart cop.jpg', '<p>হার্টকপ সফটওয়্যার টি রোগীর ডাটা সংরক্ষন করে রাখে ।ফলে ডাটা হারিয়ে বা পুড়ে যাওয়ার সম্ভাবনা নেই । রোগীর অবস্থা অনুযায়ী তারিখ ঠিক করে টেলিফোন কল এবং সাক্ষাৎকারে জন্য এলার্ট দিয়ে থাকে&nbsp; ফলে রোগীর অবস্থার আপডেট ডায়নামিকলি জানা যায় । তথ্যের ইনপুট অনুযায়ী খুব সহজেই দিন , মাস বা বছর এর ভিত্তিতে এনালাইসিস করার সুবিধা পাওয়া যায় ।রোগী নিজের তথ্য বা&nbsp; প্রেসক্রিপশন ডাউনলোড করতে পারে ফলে রোগীকেও প্রেসক্রিপশন হারিয়ে যাওয়ার ভয় করতে হয় না । রোগীর টেস্ট রিপোর্ট গুলো ডাটাবাজে সংরক্ষিত থাকে সেহেতু রোগীকে বারবার একই টেস্ট রিপোর্ট নিয়ে হাসপাতালে উপস্থিত হতে হয়না ।হাসপাতালে চাইলে রোগীকে সহজেই ভার্চুয়াল সেবা প্রদান করতে পারে ফরে রোগীর অনেকটাই কষ্ট লাঘব হয় ।স্পেশালিস্ট দের পুরাতন ডাটা খুজে বের করে মাসিক বা বাৎসরিক রিপোর্ট তৈরী করার ঝামেলা থাকেনা কারন সফটওয়্যার নিজেই এ সুবিধা দিয়ে থাকে ।<br><br><br></p><h1 class=\"___class_+?10___\" style=\"font-family: Arvo, serif; color: rgb(33, 37, 41); text-align: center;\">______________</h1><p><br></p>', 4, 1, '2022-01-16 02:41:31', '2022-01-18 03:17:09'),
(86, 43, 'সফটওয়্যার', '1', 'Top Three', 'Image', 'Heard Cop Login - Heard Failure', 'public/uploads/blog/images/Digital Medical Records - Heard Failure.jpg', 'public/uploads/blog/images/Heart cop dashboard - Heart Failure.jpg', 'public/uploads/blog/images/Management System Chart - Heard Failure.jpg', '<p>হার্টকপ সফটওয়্যারটিতে কয়েকটি ক্যটেগরিতে ব্যাবহারকারীকে বিভক্ত করা হয়েছে । এডমিনিস্ট্রেটর ,প্যারামেডিক্স , স্পেশালিস্ট , কনসালটেন্ট এবং রোগীদের আলাদা আলাদা প্যানেলে লগ-ইন করার সিস্টেম রয়েছে । যেকোনো রোলের ব্যাবহারকারী তার ইউজারনেম এবং পাসওয়ার্ড প্রদানের মাধ্যমে তার প্যানেল এক্সেস করতে পারবে । এডমিনিস্ট্রেটর এপলিকেশনের যাবতীয় সেটিংস , ব্যাসিক ইনফরমেশন, মেডিসিন নাম ইত্যাদি এন্ট্রি অথবা পরিবর্তন করতে পারে ।প্যারামেডিক্স নতুন প্যাশেন্ট এন্ট্রি , আপডেট এবং ফলো আপ সহ পুরাতন রোগীর&nbsp; ফলো আপ , আপডেট অথবা ফোন কল এবং ফিজিক্যাল কল করতে পারে ।প্যারামেডিক্স কোনো রোগীকে ফলো আপ করার পর তার ইনফরমেশন গুলো স্পেশালিস্ট প্যানেলে প্রদর্শিত হয় ।&nbsp;</p><p>স্পেশালিস্ট ডাক্তার ফলো আপ ইনফরমেশন এর ভিত্তিতে রোগীর একটি প্রাথমিক প্রেসক্রিপশন করে দেয় । স্পেশালিস্ট চাইলে প্রাথমিক প্রেসক্রিপশন এডিট করেও দিতে পারে। স্পেশালিস্ট এর মাধ্যমে তৈরীকৃত প্রাথমিক প্রেসক্রিপশনটি বিশেষভাবে পর্যালোচলার জন্য কনসালটেন্ট&nbsp;প্যানেলে প্রদর্শিত হয়। কনসালটেন্ট&nbsp;চাইলে প্রাথমিক প্রেসক্রিপশন আপডেট করে অথবা আপডেট ছাড়াই এপ্রোভ করে দিতে পারে । কনসালটেন্ট দ্বারা এপ্রোভকৃত প্রেসক্রিপশনটিই ফাইনাল প্রেসক্রিপশন ।</p><p>রোগীর টেলিফোন কল অথবা পরবর্তী সাক্ষাতকার এর তারিখ প্যারামেডিক্স ড্যাশবোর্ড এ প্রতিদিন আপডেট হতে থাকে । এমনকি মিসড কল ডাটাও প্যারামেডিক্স প্যনেলে ক্যাটেগরী&nbsp; অনুযায়ী প্রদর্শিত হতে থাকে । প্যারামেডিক্স চাইলে রোগীর কল তথ্য গুলো কল দেয়ার মাধ্যমে সফটওয়্যার এ সংরক্ষন করে রাখতে পারে ।</p><p>স্পেশালিস্ট এবং কনসালটেন্ট&nbsp;প্যানেলে পুরো সিস্টেমে ইনপুট হওয়ার তথ্যের ভিত্তিতে তৈরীকৃত অত্যাধুনিক ডায়নামিক চার্টসহ রিপোর্ট পর্যবেক্ষন করার জন্য লগিন করার পর প্যানেল থেকে রিপোর্ট মেনুতে ক্লিক করতে হবে ।ক্লিক করলে রিপোর্ট এর সাবমেনু ওপেন হবে । সেখান থেকে সবগুলো রিপোর্ট দিন মাস কিংবা বছর অনুযায়ী পর্যবেক্ষন করা যাবে।সফটওয়্যারটির বিভিন্ন তথ্য যেমন নতুন মেডিসিন এন্ট্রি, রিস্ক ফ্যাক্টর , কমোরবিডিটিস কিংবা সাইন এন্ড সিন্টোম এবং ফিজিক্যাল ইনফরমেশন এন্ট্রি কিংবা আপডেট করার জন্য এডমিন প্যানেল লগিন করে কার্যক্রম পরিচালনা&nbsp; করতে পারবে ব্যাবহারকারী ।</p><p>রোগী চাইলে তার ফোন নাম্বার এবং পাসওয়ার্ড প্রদানের মাধ্যেমে তার নিজের প্যানেল থেকেও তার ইনফরমেশন সহ তার প্রেসক্রিপশন&nbsp; প্রদর্শন এবং ডাউনলোড করতে পারবে ।</p><div><br><h1 class=\"___class_+?10___\" style=\"font-family: Arvo, serif; color: rgb(33, 37, 41); text-align: center;\">______________</h1><br><br><br></div>', 3, 1, '2022-01-16 02:47:38', '2022-01-18 03:19:53'),
(87, 43, 'ওয়েক আপ আই সি টি', '1', 'Middle', 'Image', 'Heard Cop Login - Heard Failure', 'public/uploads/blog/images/Shohan Sir - Wake Up ICT.jpg', NULL, NULL, '<p>সঠিক সময়ে এবং সঠিক ভাবে সফটওয়্যারটি মালিকানা পেয়ে ইউনাইটেড হসপিটাল কার্ডিওলোজি বিভাগের টিম ওয়েক আপ আইসিটি কে বিষেশভাবে শুভেচ্ছা জানায়।একিসাথে ওয়েক আপ আইসিটি এর <b>CEO মাহমুদুজ্জামান</b> সফটওয়ার টি ডেলিভারী দিতে পারায় বেশ আনন্দিত অনুভূতি&nbsp;এবং&nbsp;<span style=\"font-size: 1rem;\">\"হার্টকপ\"&nbsp;টিম এর প্রতি কৃতজ্ঞতা প্রকাশ করা সহ পরবর্তীতে আরো উন্নত কাজের ইন্সপারেশন দেয়ার ইচ্ছা অভিব্যাক্ত করেন ।দেশ বিদেশের বিভিন্ন ধরনের সফটওয়্যার সেবা প্রদানে ওয়েক আপ টিম সর্বদা একটিভ থেকে সর্বোচ্চ চেস্টা করবে<b> ইনশা\'আল্লাহ</b>।</span><span style=\"font-size: 1rem; font-family: Arial;\">﻿</span></p>', 5, 1, '2022-01-16 03:04:56', '2022-01-18 03:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `phone`, `email`, `image`, `message`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Rimon Khan', '01777777777', 'rimon@gmail.com', 'public/uploads/contact_us/images/1711597337581352.jpg', 'Get photo for Bangladesh passport application 45x35 mm (4.5x3.5 cm) in 2 seconds. Take an image with a smartphone or camera against any background,', 1, '2021-09-22 04:27:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `importents` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `future_of_this_course` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `possibilities_of_this_course` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_line` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_quantity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `course_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `price`, `short_description`, `course_content`, `long_description`, `importents`, `future_of_this_course`, `possibilities_of_this_course`, `time_line`, `student_quantity`, `image`, `status`, `created_at`, `updated_at`, `course_slug`, `image_alt`) VALUES
(1, 'গ্রাফিক্স ডিজাইন কোর্স', '6000', '<p>এই কোর্সে আমরা গ্রাফিক ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>Photoshop Tools and Uses and Shortcuts. &nbsp;File Management. &nbsp;Layer and History. &nbsp;Smart Object. &nbsp;Pattern. &nbsp;Custom Shape. &nbsp;Action Basic. &nbsp;Clipping Mask.</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যেখানে নিজের দক্ষতা (Skill) ও শিল্প (Art) ব্যবহার করে কোন ছবি, লেখা অথবা শব্দের সমন্বয়ে একটি অর্থবোধক শব্দ ছবি তৈরি করা। এই ছবি বিভিন্ন এডভেটাইজ, ম্যাগাজিন, বই, ওয়েবসাইট, লোগো &amp; টি শার্ট সাজানোর জন্য বিভিন্নভাবে ব্যবহার করা যেতে পারে। এই ছবিটা বানানোর জন্য আমাদের কিছু বিষয় সম্পর্কিত জ্ঞান এবং টুলস সম্পর্কিত জ্ঞান থাকা আবশ্যক।&nbsp;</p><p>&nbsp;</p><p>গ্রাফিক্স ডিজাইন জন্য দুইটি সফটওইয়ার ব্যবহার করা হয়। যেমনঃ Adobe Photoshop এবং Adobe Illustrator. এই সফটওয়ার দুইটি সম্পর্কে প্রাথমিক ধারণাসহ এর বিভিন্ন টুলস সম্পর্কে আলোচনা করব। যে টুলস গুলো রয়েছে, Photoshop Tools and Uses and shortcuts, File Management, Layer add History, Smart object, Pattern, Custom Shapes, Action Basic and এবং Cliping Mask ইত্যাদি। বেসিক গ্রাফিক্স ডিজাইন কোর্সে আমরা গ্রাফিক্স ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব।</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যার মাধ্যমে নিজের সৃজনশীলতা ব্যবহার করে ছবি বা নকশার মাধ্যমে নিজের প্রতিভাকে প্রকাশ করা যায়। বেসিক শিখলে আমরা ছবি এডিটিং,ব্যানার তৈরি , PSD ডিজাইন, Website Template Design করতে পারব। তাই আমরা যদি Graphics Design বেসিক কোর্সটি সম্পূর্ন করতে পারি তাহলে আমরা উল্লেখিত কাজগুলো করতে পারব।</p>', '<p>যেহেতু Adobe Photoshop এবং Adobe Illustrator ব্যতিক্রম Software। উল্লেখিত বেসিক গ্রাফিক্স ডিজাইন কোর্স অর্থাৎ Adobe Photoshop ও Adobe Illastrator শিখে আমরা যে সকল কাজের মাধ্যমে উপার্জন করতে পারব তার মধ্যে অন্যতম হলোঃ ১। স্টডিওতে ছবি এডিটিং ২। ছবির ব্যাকগ্রাউন্ড রিমুভ ইত্যাদি Graphics Design বেসিক কোর্সটি একজন Professional Graphics Designer হওয়ার পথটি সংকচন করে দেয়। এবং ভবিষ্যতে আমরা ফটোগ্রাফি ভিডিও এডিটিং , Animation, ভিজুয়্যাল ইফেক্টস সহ অনেক কিছু পেষা হিসাবে নিতে পারব। এবং একজন বেসিক গ্রাফিক্স ডিজাইন কোর্স হিসাবে Online জগতে বিভিন্ন মার্কেটপ্লেসে কাজ করে অর্থ উপার্জন করতে পারব। অবশ্যই Graphics Designer হতে হলে আমাদের অ্যাডভান্স গ্রাফিক্স ডিজাইন কোর্স শিকতে হবে।</p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">Graphic Design শিখে আমরা লোগো ডিজাইন, ব্যানার তৈরি, ভিডিও এডিটং এর কাজ বিভিন্ন national ও maltinational কোম্পানি, চলোচিত্র নির্মান কোম্পানি ইত্যাদিতে কাজ চাকরি করে অনেক টাকা উপার্জনের সুজগ আছে।</span></p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513690566200.jpg', 1, '2022-01-13 01:43:33', '2022-01-13 01:43:33', 'graphics-design-course-rajbari', 'গ্রাফিক্স ডিজাইন কোর্স'),
(2, 'ডিজিটাল মার্কেটিং কোর্স', '6000', '<p>মার্কেটিং এর কনসেপ্টগুলো ডিজিটাল প্ল্যাটফর্মে এক্সিকিউট করাই ডিজিটাল মার্কেটিং। আমাদের এই কোর্সের ডিজিটাল মার্কেটিং এর বিস্তারিত বিষয়গুলো নিয়ে আলোচনা করা হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;Market Research<br>&nbsp;Data Analytics<br>&nbsp;Organic Marketing<br>&nbsp;Paid Marketing<br>&nbsp;CPA Marketing<br>&nbsp;Blog Marketing<br>&nbsp;1. Google Add Ward<br>&nbsp;2. Added Different<br>&nbsp;Marketplace Add Management</p>', '<p>বর্তমান সময়ে বিজ্ঞাপনের সকল মাধ্যমগুলোর মধ্যে বর্তমান সময়ের বহুল পরিচিত এবং সবথেকে জনপ্রিয় মাধ্যম হচ্ছে&nbsp; ডিজিটাল মার্কেটিং । যেখানে অডিয়েন্স আছে কোন পণ্য বা সেবার বিজ্ঞাপন সাধারণত সাধারণভাবে সেখানেই হয়। আমরা প্রতিনিয়ত যে সব ওয়েবসাইট ব্যবহার করছি সেখানে আমরা কোন পণ্য বা সেবার বিজ্ঞাপন দিয়ে খুব সহজেই কাস্টমার দিতে পারি। মার্কেটিং এর যাবতীয় কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগ করার জন্য যা জরুরী তা এখানে দেখানো হবে।</p>', '<p>পেশা বা ফ্রিল্যান্সার হিসেবে বর্তমান সময়ে ডিজিটাল মার্কেটিং এর প্রচুর চাহিদা রয়েছে। এছাড়া নিজের ব্যবসা সম্প্রসারণ করার জন্য ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা অপরিসীম। ব্যক্তিগত অথবা ব্যবসা যে প্রয়োজনে হোক ডিজিটাল মার্কেটিং এর পরিধি ক্রমশ বর্ধমান।</p>', '<p>যুগের সাথে তাল মিলিয়ে ব্যবসায়ের সমপ্রসারণ এর ক্ষেত্রে ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা আকাশচুম্বী। ডিজিটাল মার্কেটিং এর বাজার প্রতিনিয়ত পরিবর্তন হচ্ছে। ট্রেডিশনাল মার্কেটিং এর কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগের মাধ্যমে দ্রুত সময়ে বেশি সংখ্যক অডিয়েন্সের কাছে পৌঁছানো সম্ভব হচ্ছে । সুদূর ভবিষ্যতে ডিজিটাল মার্কেটিং এর চাহিদা আরো বেশি হবে।</p>', '<p>বর্তমান সময়ে দেশের মার্কেটিং এর প্রচুর চাহিদা রয়েছে। মার্কেটিং এর যাবতীয় টেকনিক ডিজিটাল উপায় প্রয়োগ করে সহজেই সম্ভব অডিয়েন্সের কাছে পৌঁছানো। এই কোর্স&nbsp;মার্কেট রিসার্চ, ডাটা এনালাইসিস, অর্গানিক মার্কেটিং, সিপিএ মার্কেটিং, গুগল এডওয়ার্ড, মার্কেটপ্লেস এবং ব্যবস্থাপনা নিয়ে আলোচনা করা হয়েছে । এই কোর্সটি সম্পন্ন করার পর বিভিন্ন মার্কেটপ্লেসে ফ্রিল্যান্সিং সহ চাকরির ক্ষেত্রে সহায়ক হবে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513801587092.jpg', 1, '2022-01-13 01:56:04', '2022-01-13 01:56:04', 'digital-marketing-course-rajbari', 'ডিজিটাল মার্কেটিং কোর্স'),
(3, 'ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স', '6000', '<p>আমাদের এই কোর্সে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে দুইটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>HTML<br>CSS<br>PSD To HTML<br>Responsive Design<br>Bootstrap<br>2 Live Projects</p>', '<p>ওয়েব&nbsp;ডিজাইন হল একটি ওয়েবসাইটের ব্যাহিক রুপ যা আমরা দেখতে পাই বা দৃশ্য মান হয় । আর ওয়েব ডেভেলপমেন্ট হল ভেতরের সাইট যা আমরা দেখতে পাইনা । যেমন উদাহরণ সরুপ একটি গাড়ীর কথা চিন্তা করি । গাড়ির দরজা, জানালা, সিট ব্যাহিক সবকিছুই ওয়েব ডিজাইন এর মধ্যে পরে । আর গাড়ীর ভেতরের যেই মেকানিজম কাজ করে অর্থাৎ গাড়ীর ইঞ্জিন যে ভবে কাজ করে সেটা ওয়েব ডেভেলপমেন্টের মধ্যে পরে । মূল কথা এই যে, ওয়েব ডেভে লপমেন্ট একটি ওয়েবসাইটের প্রান সঞ্চারন করে। অনেকে মনে করে ওয়েব ডিজাইনে HTML, CSS নিয়ে কাজ করতে হয়, ধারনাটি ভুল। ওয়েব ডিজাই রা মূলত ফটোশপ, ইলাস্টেটর বিভিন্ন ওয়েব ফ্রেম দিয়ে ইউজার ইন্টারফেস একটি স্কেচ তৈরি করেন। একজন ওয়েব ডেভেলপার তিন ধরনের হতে পারে ফন্টইন্ড ওয়েব ডেভেলপার, ব্যকইন্ড ওয়েব ডেভেলপার এবং ফুলস্টাক ওয়েব ডেভেলপার। ফন্টইন্ড ডেভেলপার ওয়েবসাইটের ব্যহিক অংশ তৌরি করেন। ব্যকইন্ড ডেভেলপার ওয়েবসাইটের ভেতরের সারভার সাইটে কাজ করেন আর&nbsp; ফুলস্টাক ডেভেলপার ওয়েবসাইটের ফন্টইন্ড এবং ব্যকইন্ড&nbsp; দুই অংশেই কাজ করেন। এই সকল কাজই ডেভেলপমেন্টের পরিচিতি। ওয়েব ডেভেলপার যখন ওয়েব ডিজাইনার থেকে ইউজার ইন্টারফেস এর স্কেচ পাবে তখন ডেভেলপার কোড ইডিটর যেমন-নোটপ্যাড, সাবলাইম, ভিজুয়্যাল স্টডিও কোড এর মাধ্যমে কোডিং করে&nbsp; সেই ওয়েবসাইটের রুপ, প্রান প্রদান করবে। এইভাবেই একটি ওয়েব সাইট তার পূরনতা পাবে।</p>', '<p>যদি আমার চিন্তা এমন থাকে যে আমি ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখে&nbsp;কিভাবে&nbsp;সহজে&nbsp;আয়&nbsp;করবো’&nbsp; বা&nbsp;‘এটা&nbsp;শিখে&nbsp;কত&nbsp;টাকা&nbsp;আয়&nbsp;করবো&nbsp;’&nbsp;বা কীভাবে রাতা রাত্রি টাকা আয় করবো এই সকল চিন্তা যদি আমার থাকে তাহলে আমার জন্য় ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট নয় । আমার চিন্তা এমন থাকতে হবে যে,&nbsp;কোন&nbsp;কাজটা&nbsp;আমি&nbsp;শিখবো,&nbsp;&nbsp;‘আমি&nbsp;কোন&nbsp;কাজটা&nbsp;পারবো’।&nbsp;ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট সাধারনত শেখার জন্য়ে দরকার প্রচুর ধর্য এবং ডেডিকেশন ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ করে টাকা ইনকাম করার কোন লিমিট নেই আপনি যত বেশি কাজ&nbsp; করবেন যত বেশি দক্ষ্য হবেন আপনার&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট মাধমে টাকা ইনকা্মের পরিমান ততো বেশি বারবে ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ আপনার জানা থাকলে আপনি যেকোন যায়গায় বসে আপনি ক্লায়েন্ট এর কাজ করে দিতে পারবেন এর জন্য আপনার শুধু দরকার একটি লেপটপ আর নেট কানেকশন তাহলে আপনি খুব সহজেই কাজ সম্পাদন করতে পারবেন।&nbsp;ওয়েব&nbsp;ডেভেলপমেন্ট শিখে আপনি যদি HTML, CSS, PHP এর মধেই সিমাবদ্ধ থেকেন তাহলে আপনার কাজ করতে অসুবিধা হবে&nbsp; । আসলে প্রগ্রামিং এর কাজ এমন যে প্রতিনিয়ত আপডেট হতে থাকে তাই আপনাকে নতুনত্ব শিখতে হবে । সর্বশেষ বলতে চাই যে আপনি কাজ &nbsp;শিখে যাওয়ার পর আপনি অন্য যেকোনো পেশা থেকে এখানেই ভালো আয় করতে পারবেন আপনার কাজের অভাব হবে না।</p>', '<p>আজকাল বিভিন্ন ধরনের কাজ অনলাইন নির্ভর হয়ে পরেছে, যেই কারনে সারা বিশে প্রতিনিয়ত তৈরি হচ্ছে লক্ষ্য লক্ষ্য ওয়েবসাইট। কিন্তু সেই ওয়েবসাইট বানানোর জন্য তেমন দক্ষ্য ওয়েব ডেভেলপার নেই। এই জন্যে একজন দক্ষ্য ওয়েব ডেভেলপারে চাহিদা বাপ্যক। যার কারনে একজন দক্ষ্য ওয়েব ডেভেলপার এর ভবিষ্যৎ উজ্জ্বল । এই কাজ শিখা থাকলে ঘরে বসেই বিভিন্ন ওয়েবসাইট কাজ করতে পারবে যেমন-&nbsp; Upwork, Fiver, Freelancer, Theme-forest এ কাজ করে অনেক টাকাইন কাম করতে পারবে।</p>', '<p>বর্তমান সময়ে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর ব্যাপক চাহিদা রয়েছে। বাংলাদেশের অনেক প্রতিষ্ঠান রয়েছে যারা দক্ষতার ওপর ভিত্তি করে ওয়েব ডিজাইনার অথবা ডেভেলপার নিয়োগ দিয়ে থাকে। ওয়েব ডিজাইন এবং ডেভেলপমেন্ট কোর্স শেষ করার পর বিভিন্ন মার্কেটপ্লেসে কাজ করা সহ বিভিন্ন প্রতিষ্ঠান ডিজাইনার অথবা অথবা ডেভেলপার হিসেবে চাকরি করার সুযোগ রয়েছে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513742369298.jpg', 1, '2022-01-13 01:59:45', '2022-01-13 01:59:45', 'web-design-and-development-course-rajbari', 'ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স'),
(4, 'অ্যাডভান্স গ্রাফিক ডিজাইন কোর্স', '7500', '<p>এই করছে আমরা গ্রাফিক ডিজাইনের অ্যাডভান্স ফিচার এবং কাজ সম্পর্কে জানব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য অবশ্যই বেসিক গ্রাফিক ডিজাইন সম্পর্কে ধারণা থাকতে হবে।</p>', '<p>এখানে আপনারা যা শিখবেন:</p><p>&nbsp;Business Card Design<br>&nbsp;Logo Concept Realization<br>&nbsp;Web Banner Design<br>&nbsp;Flyer Design<br>&nbsp;Book Cover Design<br>&nbsp;Facebook Cover Design<br>&nbsp;T-shirt Design</p>', '<p>অ্যাডভান্সড গ্রাফিক ডিজাইন কোর্স এমন লোকদের জন্য ডিজাইন করা হয়েছে যারা গ্রাফিক ডিজাইনের সাথে পরিচিত এবং সরঞ্জাম এবং এর ব্যবহার সম্পর্কে জানেন। গ্রাফিক ডিজাইনারগণ মিডিয়া এবং ওয়েব ডিজাইন, প্যাকেজিং, চিত্রণ, অ্যানিমেশন এবং অন্যান্য ক্ষেত্রে তাদের নকশা দক্ষতা কাজে লাগান। ধারণাটি তৈরিতে সহায়ক এবং দক্ষতার সাথে প্রকল্পের সংখ্যা অন্তর্ভুক্ত করার দক্ষতাগুলি হাইলাইট করার জন্য স্তরটি উন্নত।</p>', '<p>ক্যারিয়ারের সম্ভাবনা, ফ্রিল্যান্সের সুযোগ, আর্থিক লাভ, শিল্প ও নকশার প্রতি ভালবাসা বা পয়েন্ট তৈরির জন্য অ্যাডভান্স গ্রাফিক ডিজাইন| লোগো, ব্র্যান্ডিং, ওয়েবসাইটগুলি, মুদ্রণ ইত্যাদিতে শিল্পীদের নিজের কাজ করার জন্য প্রচুর জায়গা রয়েছে যা অ্যাডভান্স গ্রাফিক ডিজাইন এর মাধ্যমে জানতে ও শিখতে পারবে। অনেকগুলি সুযোগের সাথে সম্ভাবনাগুলি ভাল, যে কোনও গ্রাফিক ডিজাইনারের সর্বদা কাজ থাকে। নিজেকে এমনভাবে প্রকাশ করা যা সত্যই আপনার নিজস্ব- গ্রাফিক ডিজাইন দিয়ে আপনাকে আপনার ক্লায়েন্টের প্রয়োজনের সাথে কাজ করার সময় আপনাকে নিজের স্থান তৈরি করতে দেয়। একজন গ্রাফিক ডিজাইনার হিসাবে আপনি নিজের রাউন্ডগুলিকে আলাদা আলাদা আর্ট স্টুডিওগুলি তৈরি করবেন এবং অনেকগুলি সৃজনশীল সাদৃশ্যযুক্ত লোকের সাথে সাক্ষাত করতে পারবেন।</p>', '<p>দিন দিন বিশ্ব আরও ডিজিটাল হয়ে উঠছে। একটি ভাল দৃষ্টিভঙ্গি দ্বারা তৈরি বিজ্ঞাপনটি এমন কোনও ধারণাগুলি প্রকাশ করতে পারে যা কখনই শব্দ দিয়ে প্রকাশ করা যায় না গ্রাফিক ডিজাইনে ক্যারিয়ারের সুযোগটি সারা বিশ্ব জুড়ে দাবি করছে। গ্রাফিক ডিজাইনের দুটি দুর্দান্ত সুযোগ হল ফ্রিল্যান্সিং এবং আউটসোর্সিং। গ্রাফিক ডিজাইনের কোর্সটি বিভিন্ন ক্রিয়েটিভ ক্যারিয়ারের বিভিন্ন প্যালেটকে অন্তর্ভুক্ত করার জন্য আপনার বিকল্পগুলি প্রসারিত করে যা বিজ্ঞাপন সংস্থাগুলি এবং শিল্প নকশা সংস্থাগুলির মতো উচ্চ সৃজনশীল সংস্থায় নেতৃত্বের অবস্থানগুলিতে প্রসারিত করতে পারে। পাশাপাশি আমরা প্রশিক্ষণের জন্য সাহায্য করি। আপনি Google বা Naukri, shine, Glassdoor প্রকৃতপক্ষে ইত্যাদির মতো কোনও ওয়েবসাইটের পরামর্শের মাধ্যমে অনুসন্ধান করে গ্রাফিক ডিজাইনার কাজগুলি সম্পর্কে জানতে পারেন। বিগ এমএনসি সংস্থাগুলি থেকে স্টার্টআপসে অভিজ্ঞ কর্মরত পেশাদারদের জন্য রয়েছে প্রচুর পরিমাণে জব ওপেনিং।</p>', '<p>১. ফ্রিল্যান্সিংঃ ফ্রিল্যান্সার হিসাবে পরিচালনা করা, আপনার নিজের ব্যবসায়ের মালিকানা সৃজনশীল আত্মার জন্য বিশেষত স্বাধীনতা এর অনেক<br>সুবিধা রয়েছে তবে আপনি আরও অর্থোপার্জন করতে পারেন।</p><p>&nbsp;</p><p>২. নিয়োগঃ যদি আপনার ব্যক্তিত্বের ধরণ (অনুশাসিত?) – বা পরিস্থিতি অবিচ্ছিন্ন আয়ের প্রয়োজন হয় তবে আপনাকে কোথাও কোথাও চাকরি নিতে হতে পারে।<br>বিজ্ঞাপন সংস্থাগুলি আপনাকে কাজে নিবে যদি আপনি প্রকৃতপক্ষে ভাল হন এবং দ্রুত এবং অবিরত সময়সীমার পরে সময়সীমা পরিচালনা করতে সক্ষম হন।<br>সংবাদপত্র এবং ছোট মুদ্রণের দোকানগুলিতেও নিয়মিতভাবে গ্রাফিক শিল্পী প্রয়োজন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513706337465.jpg', 1, '2022-01-13 01:52:48', '2022-01-13 01:52:48', 'advanced-graphic-design-course-rajbari', 'অ্যাডভান্স গ্রাফিক ডিজাইন কোর্স'),
(6, 'এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট  কোর্স', '7500', '<p>আমাদের এই কোর্সে অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে তিনটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর প্রাথমিক ধারণা থাকতে হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;CSS Framework (Bootstrap)<br>&nbsp;PSD To HTML<br>&nbsp;JavaScript Library (jQuery)<br>&nbsp;PHP Framework (Laravel)<br>&nbsp;3 Live Projects<br>&nbsp;Freelancing</p>', '<p>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো কোনো টেমপ্লেটকে আরও সুন্দর ভাবে সাজানো। এক্ষেত্রে HTML, CSS , CSS এর ফ্রেমওয়ার্ক Bootstrap,JavaScript এর ফ্রেমওয়ার্ক jQuery ব্যবহার করে টেমপ্লেট ডিজাইন করা হয়। ডিজাইন এর ফ্রেমওয়ার্কগুলো ব্যবহার করে টেমপ্লেট এর কোথায়, কীভাবে তথ্যগুলো দেখানো হবে সেটা নির্ধারণ করাই হলো এডভান্স ওয়েব ডিজাইনারের কাজ।<br>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো সমৃদ্ধ-বৈশিষ্টযুক্ত ওয়েবসাইট এবং ওয়েব পোর্টাল তৈরি করা। সাধারণত এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্টে জাভাস্ক্রিপ্ট, পিএইসপি, সিএমএস এবং তাদের ফ্রেমওয়ার্কগুলি ব্যবহার করা হয়। বিভিন্ন ধরনের ম্যানেজমেন্ট সফটওয়ার তৈরি করা হয়। এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখতে হলে অবশ্যই HTML, CSS, JavaScript, jQuery, PHP বেসিক জ্ঞান থাকতে হবে। এরপর ডেভেলপমেন্ট করতে হলে PHP ফ্রেমওয়ার্ক Laravel শিখতে হবে। একজন ওয়েব ডিজাইনারের ডিজাইনকৃত ওয়েব টেমপ্লেট এর প্রতিটি স্ট্যাটিক উপকরণকে PHP ফ্রেমওয়ার্ক (Laravel) দিয়ে ফাংশনাল এবং ডাইনামিক করাকেই এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট বলে। একজন ভালো ওয়েব ডেভেলপার হতে হলে অবশ্যই আপনাকে HTML, CSS, JavaScript,jQuery, Bootstrap, PHP(Laravel), MySQL সম্পর্কে অনেক জ্ঞান থাকতে হবে।</p>', '<p>বর্তমানে বেকারত্ব দূর করার সহজ উপায় হলো ফ্রিল্যান্সিং করা এবং ফ্রিল্যান্সিং করে বাংলাদেশসহ বিশ্বের অনেক দেশ আজ অনেকটাই বেকারত্ব দূর করতে পারছে। এক্ষেত্রে আমাদের দেশ ও পিছিয়ে নেই। আমাদের এই কোর্স এ এডভান্স ওয়েব পেজ ডিজাইন এন্ড ডেভেলপমেন্ট সম্পর্কে বিশদ শেখানো হবে। এই কোর্সে আমরা CSS Framework(Bootstrap), PSD To HTML, JavaScript Library(jQuery), PHP Framework(Laravel), 3 Live Projects and Freelancing সম্পর্কে বিস্তারিত শেখাবো। আপনি কোডিং এর এডভান্স ফ্রেমওয়ার্কগুলো শেখার পর ৩ টি লাইভ প্রোজেক্ট পাচ্ছেন যার মাধ্যমে আপনি জানতে পারবেন কীভাবে লাইভ প্রোজেক্ট বা ক্লাইন্টের কাজ করতে হয়। আপনাকে শেখানো হবে ফ্রিল্যান্সিং যাকে মুক্ত পেশাও বলে। এই পার্ট থেকে আপনাকে শেখানো হবে কীভাবে ক্লাইন্ট এর কাজ করা যায় এবং ফ্রিল্যান্সিং করে অর্থ উপার্জন করা যায়।</p>', '<p>বর্তমান যুগ হলো টেকনোলজির যুগ। দিন দিন অনেক অনেক কোম্পানী প্রতিষ্ঠিত হচ্ছে এবং বর্তমানে প্রায় সব কোম্পানী বা বড় বড় দোকানের তাদের মার্কেটিং এর জন্য ওয়েবসাইট দরকার হয়। এবং দিন দিন এটা বেড়েই চলেছে এবং অনেকেই অর্থ উপার্জন করছে। ভবিষ্যতে এর চাহিদা বেড়েই যাবে। এই পেশায় প্রাথমিক পর্যায়ে ১০ থেকে ২০ হাজার টাকা বেতনে কোম্পানীর কাজ করা যায় এবং ৩ থেকে ৫ বছর পরে আপনি একজন ইঞ্জিনিয়ার না হয়েও একজন ইঞ্জিনিয়ারের সমতুল্য বেতনে অর্থাৎ ৮০ হাজার থেকে এক লাখ টাকা পর্যন্ত বেতনে চাকরি করতে পারবেন। বাইরের ক্লাইন্টের কাজ করেও নিজের ভবিষ্যত উজ্জ্বল করতে পারবেন।</p>', '<p>কোর্স শেষে আপনি বিভিন্ন মার্কেট প্লেসে কাজ করে অর্থ উপার্জন করতে পারবেন। পাশাপাশি বিভিন্ন কোম্পানির কাজও করে দিতে পারেন। অনলাইন মার্কেটপ্লেসগুলোর মধ্যে রয়েছ, upwork.com, freelancer.com, fiverr.com ইত্যাদি। এসব মার্কেটপ্লেসে ওয়েব পেইজ ডিজাইনার এন্ড ওয়েব ডেভেলপারদের ব্যাপক চাহিদা রয়েছে। কাজ অনুযায়ী আপনি প্রতি ঘন্টায় ২ থেকে ১০০ ডলার ইনকাম বা আয় করতে পারবেন। এছাড়াও আপনি আপনার তৈরি করা ওয়েবসাইট বিভিন্ন কোম্পানির কাছে বিক্রি করতে পারবেন। তাছাড়া themeforest.net এবং codecanyon.net এই দুই মার্কেটপ্লেসেও বিক্রি করে আয় করতে পারেন। বিদেশী কোম্পানীসহ আমাদের দেশে বিভিন্ন সফটওয়ার কোম্পানীতে Web Designer and Web Developer হিসেবে জব করতে পারবেন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513200931914.jpg', 1, '2022-03-22 06:56:23', '2022-03-22 06:56:23', 'advanced-web-design-and-development-course-rajbari', 'এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট  কোর্স'),
(10, 'Microsoft Office Course', '2500', '<p>Microsoft Office হলো একটি কমপ্লিট প্যাকেজ প্রোগ্রাম যার মাধ্যমে প্রায় সব ধরনের অফিসিয়াল বা দৈনন্দিন কাজ করা যায়। প্রয়োজনীয় সব ধরনের ফর্ম তৈরি করা যায়, যে কোনো ধরনের Report তৈরি করা যায় যেখানে ইচ্ছামতো Chart, Graphics ইত্যাদি সংযোজন ছাড়াও Logo, Poster, Banner, Visiting Card design করা যায়।<span style=\"font-size: 1rem;\">মাইক্রোসফট অফিস প্রোগ্রামে প্রধান ৩টি প্রোগ্রাম রয়েছে।&nbsp;</span></p>', '<p>1.<span style=\"white-space:pre\">	</span>Microsoft Office Word</p><p>2.<span style=\"white-space:pre\">	</span>Microsoft Office Excel</p><p>3.<span style=\"white-space:pre\">	</span>Microsoft Office PowerPoint</p>', '<p>Microsoft Office হলো একটি কমপ্লিট প্যাকেজ প্রোগ্রাম যার মাধ্যমে প্রায় সব ধরনের অফিসিয়াল বা দৈনন্দিন কাজ করা যায়। প্রয়োজনীয় সব ধরনের ফর্ম তৈরি করা যায়, যে কোনো ধরনের Report তৈরি করা যায় যেখানে ইচ্ছামতো Chart, Graphics ইত্যাদি সংযোজন ছাড়াও Logo, Poster, Banner, Visiting Card design করা যায়।</p><p>এছাড়া অফিস, ব্যবসা প্রতিষ্ঠান, ব্যাংক-বীমা, স্কুল-কলেজের বিভিন্ন গাণিতিক হিসাব, স্যালারি শিট, রেজাল্ট শিট তৈরি করা সহ বিভিন্ন প্রেজেন্টেশন তৈরি করা যায়।</p><p>মাইক্রোসফট অফিস প্রোগ্রামে প্রধান ৩টি প্রোগ্রাম রয়েছে।&nbsp;</p><p>1.<span style=\"white-space: pre;\">	</span>Microsoft Office Word</p><p>2.<span style=\"white-space: pre;\">	</span>Microsoft Office Excel</p><p>3.<span style=\"white-space: pre;\">	</span>Microsoft Office PowerPoint</p>', '<p>এই কোর্সে কম্পিউটার বেসিক, মাইক্রসফট ওয়ার্ড, এক্সেল, পাওয়ারপইন্ট সহ ইংরেজি, বাংলা টাইপিং সেখানো হবে। তাই আপনি যদি স্টুডেন্ট বা চাকরি প্রার্থী হয়ে থাকেন এবং আপনার যদি মাইক্রসফট অফিস কোর্সটি শেখা না থাকে তাহলে এই কোর্সটি আপনার জন্যই।&nbsp;<br></p>', '<p>অফিস, ব্যবসা প্রতিষ্ঠান, ব্যাংক-বীমা, স্কুল-কলেজের বিভিন্ন গাণিতিক হিসাব, স্যালারি শিট, রেজাল্ট শিট তৈরি করা সহ বিভিন্ন প্রেজেন্টেশন তৈরি করতে পারবেন।<br></p>', '<p>প্রয়োজনীয় সব ধরনের ফর্ম তৈরি করা যায়, যে কোনো ধরনের Report তৈরি করা যায় যেখানে ইচ্ছামতো Chart, Graphics ইত্যাদি সংযোজন ছাড়াও Logo, Poster, Banner, Visiting Card design&nbsp;<span style=\"font-size: 1rem;\">করতে পারব।</span><br></p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1714236781170485.png', 1, '2022-01-13 01:49:42', '2022-01-13 01:49:42', 'microsoft-office-course-rajbari', 'Microsoft Office Course');

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

-- --------------------------------------------------------

--
-- Table structure for table `course_fassilities`
--

CREATE TABLE `course_fassilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fassility_order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_fassilities`
--

INSERT INTO `course_fassilities` (`id`, `course_id`, `title`, `fassility_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'কোর্স চলাকালীন সময়ে এবং পরবর্তী যে কোনো সময় যে কোনো সহযোগিতা', 1, 1, '2021-08-28 02:20:26', '2021-08-28 04:37:53'),
(3, 6, 'আমাদের সাথে সরাসরি কাজ করার সুযোগ (শর্তাবলী প্রযোজ্য)', 2, 1, '2021-08-28 03:34:53', NULL),
(8, 3, 'কোর্স চলাকালীন সময়ে এবং পরবর্তী যে কোনো সময় যে কোনো সহযোগিতা', 1, 1, '2021-09-06 05:48:24', NULL),
(9, 3, 'আমাদের সাথে সরাসরি কাজ করার সুযোগ (শর্তাবলী প্রযোজ্য)', 2, 1, '2021-09-06 05:48:38', NULL),
(10, 5, 'কোর্স শেষে সার্টিফিকেট', 1, 1, '2021-09-06 05:49:28', NULL),
(11, 6, 'কোর্স শেষে সার্টিফিকেট', 3, 1, '2021-09-06 05:49:46', NULL),
(12, 5, 'কোর্স চলাকালীন সময়ে এবং পরবর্তী যে কোনো সময় যে কোনো সহযোগিতা', 2, 1, '2021-09-06 05:50:07', NULL),
(13, 5, 'আমাদের সাথে সরাসরি কাজ করার সুযোগ (শর্তাবলী প্রযোজ্য)', 3, 1, '2021-09-06 05:56:26', NULL),
(14, 1, 'কোর্স শেষে সার্টিফিকেট', 1, 1, '2021-09-06 05:57:44', NULL),
(15, 1, 'কোর্স চলাকালীন সময়ে এবং পরবর্তী যে কোনো সময় যে কোনো সহযোগিতা', 2, 1, '2021-09-06 05:57:51', NULL),
(16, 1, 'আমাদের সাথে সরাসরি কাজ করার সুযোগ (শর্তাবলী প্রযোজ্য)', 3, 1, '2021-09-06 05:58:00', NULL),
(17, 4, 'কোর্স শেষে সার্টিফিকেট', 1, 1, '2021-09-06 05:58:53', NULL),
(18, 4, 'কোর্স চলাকালীন সময়ে এবং পরবর্তী যে কোনো সময় যে কোনো সহযোগিতা', 2, 1, '2021-09-06 05:59:04', NULL),
(19, 4, 'আমাদের সাথে সরাসরি কাজ করার সুযোগ (শর্তাবলী প্রযোজ্য)', 3, 1, '2021-09-06 05:59:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_items`
--

CREATE TABLE `course_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_order` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_items`
--

INSERT INTO `course_items` (`id`, `course_id`, `item_title`, `course_order`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '6', 'সিএসএস ফ্রেমওয়ার্ক (বুটস্ট্রাপ)', 1, '<p>বুটস্ট্রাপ (Bootstrap) হলো একটি ফ্রি এবং ওপেন সোর্স CSS ফ্রেমওয়ার্ক যার মাধ্যমে খুব সহজেই ওয়েবসাইটে রেস্পোন্সিভ, মোবাইল ফ্রেন্ডলি করা যায়। এতে কিছু জাভাস্ক্রিপ্ট মিশ্রিত রয়েছে যা খুব সহজে ডিজাইনটিকে চমৎকার করে দেয়। বর্তমানে কাস্টম সিএসএস ব্যবহার না করে প্রায় সব ওয়েব পেইজকে Bootstrap এর সাহায্যে ডিজাইন করা যায়।</p>', '1', '2021-08-25 02:03:03', '2021-08-28 21:55:51'),
(3, '6', 'সিএসএস', 2, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">পূর্বে বলা হয়েছে html একটি Document এর গঠন বা স্ট্রাকচার। এই গঠনের Style বা রঙ করার জন্য যে ভাষা ব্যবহার করা হয় তাকে CSS বলে। CSS এর পূর্নরুপ হলো Cascading Style Sheets</span></p>', '1', '2021-08-25 21:19:35', '2021-09-06 00:03:47'),
(5, '6', 'রেস্পন্সিভ ডিজাইন', 4, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">ওয়েব সাইডের বিভিন্ন সাইজ বা মাপ আছে ।যেমন আপনার মোবাইল আর কম্পিউটাররের পরিমাপ কখনোই এক নয়। তাই একটি ওয়েব সাইডকে ডেক্সটপ, ট্যাব, ট্যাবলেট, স্মার্টফোনের ব্রাউজারের জন্য আলাদা আলাদা পরিমাপে ব্যবহার উপযোগি করে গঠন করাই হলো Responsive Design।</span></p>', '1', '2021-08-26 00:01:12', '2021-09-06 00:04:37'),
(7, '4', 'এইচটিএমএল (ক্লাস সংখ্যা: ৫)', 1, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">HTML হচ্ছে একটি Document এর গঠন বা স্ট্রাকচার। HTML এর পূর্নরুপ হলো Hyper Text Markup Language। এটি দিয়ে ব্রাউজারে তথ্য প্রদর্শন করা হয়। html ল্যাংগুয়েজটি ওয়েব পেজে লেখা, অডিও, ভিডিও, স্থির চিত্র ইত্যাদি ব্যবহারের জন্য কাজে আসে। ওয়েব পেজে সবচে বেশি html ব্যবহার করা হয়ে থাকে। Programming শেখার প্রাথমিক ধাপ হচ্ছে html ল্যাংগুয়েজ।</span></p>', '1', '2021-09-06 00:02:04', NULL),
(8, '6', 'জাভাস্ক্রিপ্ট', 5, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">জাভাস্ক্রিপ্ট হলো একটি ক্লাইন্ট সাইড ভাষা বা ল্যাংগুয়েজ। এবং এটি একটি ব্রাউজার স্ক্রিপ্টিং ল্যাঙ্গুয়েজ । ব্রাউজার স্ক্রিপ্টিং ল্যাংগুয়েজ হল প্রোগ্রামিং ল্যাঙ্গুয়েজের সংক্ষিপ্ত ও সহজ ফর্ম বা রুপ। জাভাস্ক্রিপ্টে দিয়ে অনেক ছোট প্রোগ্রাম বা অল্প কিছু প্রোগ্রাম দিয়ে অনেক বড় বড় কাজ করা যায়।</span></p>', '1', '2021-09-06 00:05:21', NULL),
(9, '6', 'পিএইচপি', 6, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">PHP দিয়ে ওয়েব Application করা হয়। মনে ক্রুন আপনার এমন একটি ওয়েবসাইড প্রয়োজন যেটি দিয়ে আপনি আপনার অনলাইন শিক্ষার্থীদের তথ্য আপনার ওয়েবসাইডের মাধ্যমে আপনার কাছে পেতে চাচ্ছেন। যে ল্যাঙ্গুয়েজে আপনার প্রয়োজন সেটি হচ্ছে PHP। পূর্বে PHP এর পূর্নরুপ ছিল Personal Home Page. এটি একটি Server Based Programming Language।</span></p>', '1', '2021-09-06 00:06:36', NULL),
(10, '6', '২টি লাইভ প্রজেক্ট', 7, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">এই কোর্স সে আপনারা দুইটি লাইভ প্রজেক্ট করবেন, কোথাও আটকে গেলে আমরা সমাধান করব।</span></p>', '1', '2021-09-06 00:07:22', NULL),
(11, '1', 'অ্যাডোব ইলাস্ট্রেটর', 1, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">অ্যাডোব ইলাস্ট্রেটর একটি সফটওয়ার যা কম্পিউটারে ব্যবহার করে অঙ্কন, চিত্র এবং শিল্পকর্ম তৈরি করা হয়। তবে ইলাস্ট্রেটর উচ্চ মানের শিল্পকর্ম তৈরিতে ব্যবহার করা হয়।</span></p>', '1', '2021-09-06 00:09:33', NULL),
(12, '1', 'এডোবি ফটোশপ', 2, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">অ্যাডোব ফটোশপ হলো এমন একটি সফটওয়ার যার মাধ্যমে নিজের সৃজনশীলতাকে কাজে লাগিয়ে কোনো ইমেজ এডিটিং করে নতুন রূপ দেয়া হয়। সাধারণত ফটোশপ বেসিক এ তার বেসিক টুলস গুলো ব্যবহার করে কাজ করা হয়।</span></p>', '1', '2021-09-06 00:10:22', NULL),
(13, '2', 'Chapter One ( The Beginning)', 1, '<p><span class=\"text-huge\"><strong>o</strong> What is digital Marketing&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> What is the important of Digital Marketing&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> Why Digital Marketing is Currently the trend&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> Classification of Digital Marketing&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (i) Branding&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ii) Product Promotion&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iii) Advertising&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iv) Growth Sales&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (v) Gain More Traffic&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (vi) Public Relations&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> Area of War &nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (i) Facebook&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ii) Google&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iii) Website&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iv) Youtube&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (v) Email&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (vi) SMS&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (vii) Twitter&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (viii) Instagram&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ix) Quora&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (x)Affiliate Marketing&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> War Elements&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (i) Text Content&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ii) Info Graphic&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iii) Video</span></p>', '1', '2021-09-10 21:32:56', '2021-09-10 21:53:33'),
(14, '2', 'Chapter Two ( Generate the idea)', 2, '<p><strong>o</strong> Create your own object for digital marketing.</p>', '1', '2021-09-10 21:54:50', NULL),
(15, '2', 'Chapter Three ( Lets Implement the theory )', 3, '<p><strong>o</strong> Organic Traffic</p><p><strong>o</strong> Paid Traffic&nbsp;</p><p><strong>o</strong> Page&nbsp;</p><p>&nbsp; &nbsp; (i) Create a page for a demo company.&nbsp;</p><p>&nbsp; &nbsp; (ii) Setup the page. o Group&nbsp;</p><p>&nbsp; &nbsp; (iii) Create a group for a demo company.</p><p>&nbsp; &nbsp; (iv) Setup the group.&nbsp;</p><p><strong>o</strong> Google&nbsp;</p><p>&nbsp; &nbsp; &nbsp;(i)Create Google accounts</p><p>&nbsp; &nbsp; &nbsp;(ii)Setup accounts</p><p>&nbsp; &nbsp; &nbsp;(iii) Setup Emails&nbsp;</p><p>&nbsp; &nbsp; &nbsp;(iv) Setup my business&nbsp;</p><p><strong>o</strong> YouTube&nbsp;</p><p>&nbsp; &nbsp; &nbsp;(i) Create a YouTube channel</p><p>&nbsp; &nbsp; &nbsp;(ii) Setup YouTube channel</p>', '1', '2021-09-10 21:58:41', NULL),
(16, '2', 'Chapter Four ( Strategy of marketing)', 4, '<p>Strategy of marketing</p>', '1', '2021-09-10 22:00:48', NULL),
(17, '2', 'Chapter Five ( Build your online Identity )', 5, '<p><strong>o</strong> Domain&nbsp;</p><p><strong>o</strong> Hosting&nbsp;</p><p><strong>o</strong> Website</p>', '1', '2021-09-10 22:01:37', NULL),
(18, '2', 'Chapter Six ( Let’s talk about content )', 6, '<p><strong>o</strong> Creative Content&nbsp;</p><p><strong>o</strong> Image Content&nbsp;</p><p><strong>o</strong> Video Content</p>', '1', '2021-09-10 22:02:40', NULL),
(19, '2', 'Chapter Seven (Edition is an art)', 7, '<p><strong>o</strong> Photo Editing&nbsp;</p><p><strong>o</strong> Use of Template</p><p><strong>o</strong> Video Editing.</p>', '1', '2021-09-10 22:03:43', NULL),
(20, '2', 'Chapter Eight ( Hard work )', 8, '<p><strong>o</strong> Work with Facebook page&nbsp;</p><p><strong>o</strong> Work with Facebook Group&nbsp;</p><p><strong>o</strong> Work with Google&nbsp;</p><p><strong>o</strong> Work with YouTube channel</p>', '1', '2021-09-10 22:04:28', NULL),
(21, '2', 'Chapter Nine (More hard work)', 9, '<p><strong>o </strong>Introducing Quora&nbsp;</p><p><strong>o</strong> Affiliate Marketing&nbsp;</p>', '1', '2021-09-10 22:05:05', NULL),
(22, '2', 'Chapter Ten ( Reach more get more)', 10, '<p><strong>o</strong> Email Marketing&nbsp;</p><p><strong>o</strong> SMS Marketing</p>', '1', '2021-09-10 22:05:38', NULL),
(23, '2', 'Chapter Eleven ( Learn about SEO)', 11, '<p><strong>o </strong>SEO Audit&nbsp;</p><p><strong>o</strong> Keyword Research&nbsp;</p><p><strong>o</strong> Image SEO&nbsp;</p><p><strong>o</strong> Google Search Console&nbsp;</p><p><strong>o </strong>Word press SEO</p>', '1', '2021-09-10 22:06:38', NULL),
(24, '2', 'Chapter Twelve ( The conclusions )', 12, '<p><strong>o</strong> Summer up everything</p>', '1', '2021-09-10 22:07:34', NULL),
(25, '10', '১. মাইক্রসফট ওয়ার্ড', 1, '<p>Microsoft Word হলো Microsoft Office এর একটি ওয়ার্ড প্রসেসিং সফটওয়ার। যার সাহায্যে রিপোর্ট, দলিল, প্রশ্ন, চিঠিপত্র, টেবিল ও ডায়াগ্রাম, ব্যক্তিগত নোট তৈরি করা ও টাইপ করা এবং প্রিন্ট করা যায়।&nbsp;<br></p>', '1', '2021-10-21 07:46:40', NULL),
(26, '10', '২. মাইক্রসফট এক্সেল', 2, '<p><span style=\"font-size: 1rem;\">Microsoft Excel হলো হিসাব বা গাণিতিক কাজ খুব সহজে সমাধান করে সংরক্ষণ করার একটি সফটওয়ার। এর মাধ্যমে রেজাল্ট, স্যালারি ও অন্যান্য শিট, বিভিন্ন সরল ও জটিল গাণিতিক হিসাব, বেতনবিল ও অন্যান্য হিসাব, চার্ট ও গ্রাফ, ডাটা সংরক্ষন ও ব্যবস্থাপনার যাবতীয় কাজ ইত্যাদি করা যায়।</span><br></p>', '1', '2021-10-21 07:47:06', NULL),
(27, '10', '৩. মাইক্রসফট পাওয়ারপইন্ট', 3, '<p>মাইক্রসফট পাওয়ারপইন্ট হলো একটি প্রেজেন্টেশন বা প্রদর্শনী সফটওয়ার। যার মাধ্যমে Projector এর সাহায্যে Slide Show বানিয়ে উপস্থাপন করা যায়, স্লাইডে চ্যাট, গ্রাফ, ছবি, সাউন্ড ব্যবহার করা যায়, স্লাইড গুলো একত্রে একটি ফাইলে (File) এ Store করা যায়, স্লাইড গুলো প্রয়োজনে প্রিন্ট দেওয়া যায়। স্লাইড থেকে ফোটো তৈরি করা যায়, এনিমেশন দিয়ে ভিডিও তৈরি করা যায়।<br></p>', '1', '2021-10-21 07:47:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_members`
--

CREATE TABLE `course_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_members`
--

INSERT INTO `course_members` (`id`, `course_id`, `member_id`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '<p>Description updated</p>', 1, NULL, '2021-09-04 02:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CI Developer', 1, '2022-03-21 05:27:23', '2022-03-21 05:43:38'),
(2, 'Jr Laravel Developer', 1, '2022-03-21 05:35:05', '2022-03-21 05:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `development_projects`
--

CREATE TABLE `development_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
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
(1, 14, 'Human Resource Management System', 'public/uploads/development_project/images/HRM-Basics-Featured.png', 'Human Resource Management System', 'fa fa-users', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Human resources management system is a suite of software applications used to manage human resources and related processes throughout the employee lifecycle. An HRMS enables a company to fully understand its workforce while staying compliant with changing tax laws and labor regulations.</span></p>', 1, 1, '2021-09-13 03:55:13', '2022-01-26 04:08:20'),
(3, 32, 'Jute Industry Management System', 'public/uploads/development_project/images/1711427392818331.png', 'HEART FAILURE MANAGEMENT SYSTEM', 'fa fa-industry', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Enterprise management systems are large-scale software packages that track and control the complex operations of a business. The jute management system is an application that you can use to maintain your Supply Chain Management, jute industry employees, jute gradings, accounts, profits, and everything.</span></p>', 1, 1, '2021-09-15 03:25:45', '2021-09-22 04:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `development_project_headers`
--

CREATE TABLE `development_project_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `development_project_headers`
--

INSERT INTO `development_project_headers` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Our Ongoing Developments', '<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; text-align: center;\">We develop custom websites, design graphics, and provide software development services.</span>', 1, NULL, '2022-01-27 04:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `employee_monthly_salaries`
--

CREATE TABLE `employee_monthly_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_monthly_salaries`
--

INSERT INTO `employee_monthly_salaries` (`id`, `employee_id`, `monthly_salary`, `status`, `created_at`, `updated_at`) VALUES
(1, '37', '40000', 1, '2022-02-07 08:49:07', '2022-02-07 08:49:07'),
(2, '38', '15000', 1, '2022-02-07 08:49:33', '2022-02-07 08:49:33'),
(3, '39', '8000', 1, '2022-02-07 08:49:49', '2022-02-07 08:49:49'),
(4, '40', '12000', 1, '2022-02-07 08:50:00', '2022-02-07 08:50:00'),
(5, '41', '5000', 1, '2022-02-07 08:50:17', '2022-02-07 08:50:17'),
(6, '42', '5000', 1, '2022-02-07 08:50:31', '2022-02-07 08:50:31'),
(7, '43', '5000', 1, '2022-02-07 08:50:50', '2022-02-07 08:50:50'),
(8, '44', '2500', 1, '2022-02-07 08:53:42', '2022-02-07 08:53:42'),
(9, '45', '800', 1, '2022-02-07 08:54:00', '2022-02-07 08:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `multiple_expense_id` int(20) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title_id`, `title`, `expense_type`, `date`, `remark`, `amount`, `multiple_expense_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Electricity bills', 'Local', '2022-03-28', 'Remark Remark', '2000', 0, 1, '2022-03-27 23:45:16', '2022-03-28 01:53:42'),
(2, 3, 'Rickshaw Rent For office', 'Local', '2022-03-28', 'Rickshaw Rent For office', '500', 0, 1, '2022-03-27 23:46:10', NULL),
(3, 4, 'Rent For office', 'Local', '2022-03-28', 'sf Rent For office', '2000', 0, 1, '2022-03-27 23:46:52', NULL),
(4, 4, 'Water bills', 'Local', '2022-03-28', 'water bill for office', '1500', 0, 1, '2022-03-27 23:48:07', NULL),
(5, 4, 'Gesh bill', 'Local', '2022-03-28', 'sdf', '5000', 0, 1, '2022-03-27 23:48:37', NULL),
(6, 5, 'Salary Paid From Payroll', 'Global', '2022-03-28', 'Remark Remark', '40000', 0, 1, '2022-03-28 04:12:19', NULL),
(7, 5, 'Salary Paid From Payroll', 'Global', '2022-03-28', 'Ramark', '15000', 0, 1, '2022-03-28 04:12:45', NULL),
(8, 5, 'Salary Paid From Payroll', 'Global', '2022-03-28', 'dsfds', '8000', 0, 1, '2022-03-28 04:12:56', NULL),
(9, 5, 'Salary Paid From Payroll', 'Global', '2022-03-28', 'Remark', '12000', 0, 1, '2022-03-28 04:13:11', NULL),
(10, 5, 'Salary Paid From Payroll', 'Global', '2022-03-28', 'Remark', '5000', 0, 1, '2022-03-28 04:13:43', NULL),
(11, 6, 'Official Expense Multiple 1', 'Global', '2022-03-28', 'df', '1000', 1, 1, '2022-03-28 04:16:05', NULL),
(12, 6, 'Official Expense Multiple 2', 'Global', '2022-03-28', 'Remark', '2000', 1, 1, '2022-03-28 04:16:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_paybacks`
--

CREATE TABLE `expense_paybacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payback_money` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `footer_contents`
--

CREATE TABLE `footer_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `footer_header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_backgroud` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_contents`
--

INSERT INTO `footer_contents` (`id`, `footer_header`, `footer_content`, `footer_backgroud`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Get In Touch', 'To get a free quote, Contact us anytime', 'public/uploads/footer/library 1920 x 500 ns.png', 1, 1, '2022-01-24 07:14:39', '2022-01-24 07:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `slider_image`, `slider_alt`, `slider_active`, `status`, `created_at`, `updated_at`) VALUES
(4, 'public/uploads/slider_image/images/wakeupict-brought-ideas-to-life-with-text.png', 'Home slider 2', 1, 1, '2021-09-12 06:09:35', '2022-01-26 04:06:50'),
(5, 'public/uploads/slider_image/images/wakeupict-creative-in-affordable-price-with-text.png', 'Home slider 3', 1, 1, '2021-09-12 01:21:03', '2022-01-26 04:07:22'),
(6, 'public/uploads/slider_image/images/wakeupict-360-marketing-solution-with-text.png', 'Home slider', 1, 1, '2021-09-12 06:07:31', '2022-01-26 04:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` int(11) NOT NULL,
  `income_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `title_id`, `income_type`, `title`, `date`, `remark`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark', 2000, '1', '2022-03-27 22:59:22', NULL),
(2, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark Remark', 5000, '1', '2022-03-27 22:59:56', NULL),
(3, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', '3000', 1000, '1', '2022-03-27 23:03:02', NULL),
(4, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark Remark', 1000, '1', '2022-03-27 23:03:48', NULL),
(5, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark', 1000, '1', '2022-03-27 23:04:14', NULL),
(6, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', '2000', 2000, '1', '2022-03-27 23:13:31', NULL),
(7, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark', 4000, '1', '2022-03-27 23:32:18', NULL),
(8, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark', 1000, '1', '2022-03-27 23:32:42', NULL),
(9, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'Remark', 1000, '1', '2022-03-27 23:33:05', NULL),
(10, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'This is a required field', 3000, '1', '2022-03-27 23:34:44', NULL),
(11, 2, 'Tocal', 'Student Admission Fee', '2022-03-28', 'hfh', 6500, '1', '2022-03-27 23:39:55', NULL),
(12, 7, 'Global', 'First time sells', '2022-03-28', 'Remark Remark', 1000, '1', '2022-03-28 04:17:33', NULL),
(13, 7, 'Global', 'Second Times sells', '2022-03-28', 'Remark Remark Remark', 500000, '1', '2022-03-28 04:19:12', NULL),
(14, 7, 'Global', 'Third Time Sells', '2022-03-28', 'Remark Remark', 15000, '1', '2022-03-28 04:19:38', '2022-03-28 04:23:40'),
(15, 7, 'Global', 'Forth Time Sells', '2022-03-28', 'Remark', 60000, '1', '2022-03-28 04:22:21', NULL),
(16, 7, 'Global', 'Fifth Times', '2022-03-28', 'Remark', 100000, '1', '2022-03-28 04:23:06', '2022-03-28 05:02:04'),
(17, 2, 'Global', 'Student Admission Fee', '2022-03-28', 'Remark', 2000, '1', '2022-03-28 04:29:38', '2022-03-28 04:38:12'),
(18, 1, 'Global', 'Student Admission Fee', '2022-03-28', 'Remark', 2000, '1', '2022-03-28 04:36:45', NULL),
(19, 1, 'Global', 'Student Admission Fee', '2022-03-28', 'Remark', 3000, '1', '2022-03-28 05:03:45', NULL),
(20, 1, 'Global', 'Student Admission Fee', '2022-03-28', 'Remark', 2000, '1', '2022-03-28 05:04:03', NULL),
(21, 2, 'Local', 'Student Admission Fee', '2022-03-28', 'Remark', 1500, '1', '2022-03-28 07:12:00', NULL),
(22, 2, 'Local', 'Student Admission Fee', '2022-03-28', 'Remark', 1500, '1', '2022-03-28 07:13:36', NULL),
(23, 2, 'Local', 'Student Admission Fee', '2022-03-28', 'NID: 1313213213\r\nPayment\r\nDate\r\nRemark', 1000, '1', '2022-03-28 07:14:06', NULL),
(24, 2, 'Local', 'Student Admission Fee', '2022-03-28', 'Remark', 1600, '1', '2022-03-28 07:14:56', NULL),
(25, 2, 'Local', 'Student Admission Fee', '2022-03-28', 'Remark', 3400, '1', '2022-03-28 07:15:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `international_project_headers`
--

CREATE TABLE `international_project_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `international_project_headers`
--

INSERT INTO `international_project_headers` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Our International Works', '<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; text-align: center;\">Some of our international projects on market.</span>', 1, NULL, '2022-01-27 04:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `international_works`
--

CREATE TABLE `international_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_work` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `international_works`
--

INSERT INTO `international_works` (`id`, `blog_id`, `image`, `image_alt`, `active_work`, `status`, `created_at`, `updated_at`) VALUES
(5, 14, 'public/uploads/international_work/images/1711427828777134.png', 'wict-rent-a-car-wusoft', 1, 1, '2021-09-14 23:54:41', '2021-09-22 05:46:19'),
(6, 15, 'public/uploads/international_work/images/1711427779376622.png', 'wict-wustock-wusoft', 1, 1, '2021-09-14 23:55:21', '2021-09-22 05:46:12'),
(7, 32, 'public/uploads/international_work/images/1711427735844022.png', 'wict livest', 1, 1, '2021-09-14 23:56:49', '2021-09-22 05:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invest_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investment_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `investor_id`, `invest_type`, `investment_type_id`, `date`, `amount`, `rate`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Global', '1', '2022-03-28', '2222', '11', 'Remark Remark', 1, '2022-03-28 01:53:32', '2022-03-28 01:53:32'),
(2, '1', 'Global', '1', '2022-03-29', '1000', '11', 'Remark Remark update', 1, '2022-03-28 02:14:53', '2022-03-28 02:14:53'),
(3, '2', 'Global', '1', '2022-03-28', '100000', '10', 'Remark', 1, '2022-03-28 03:14:49', '2022-03-28 03:14:49'),
(4, '2', 'Global', '1', '2022-03-28', '500000', '10', 'Remark', 1, '2022-03-28 03:15:24', '2022-03-28 03:15:24'),
(5, '2', 'Global', '1', '2022-03-28', '50000', '10', 'Remark invest 50 k tk', 1, '2022-03-28 03:16:02', '2022-03-28 03:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `name`, `type`, `address`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DR. N A M MOMENUZZAMAN', 'Global', 'Matipara, Rajbari, Dhaka', '01784703000', 1, '2022-03-28 01:14:52', '2022-03-28 01:42:25'),
(2, 'Mahmudur Rohman', 'Global', 'Matipara, Rajbari', '01784703000', 1, '2022-03-28 03:13:47', '2022-03-28 03:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `investor_types`
--

CREATE TABLE `investor_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investor_types`
--

INSERT INTO `investor_types` (`id`, `investor_type_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Doctor', 1, '2022-03-28 01:42:49', '2022-03-28 01:42:49'),
(2, 'Accountant', 1, '2022-03-28 01:49:47', '2022-03-28 03:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `approve_status` int(20) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `start_date`, `end_date`, `phone`, `application`, `created_by`, `approve_status`, `status`, `created_at`, `updated_at`) VALUES
(21, '2022-02-10', '2022-02-20', '01777777777', '<p><span style=\"color: rgb(33, 37, 41); font-weight: 700;\">Application</span><br></p>', 1, 0, 1, '2022-02-10 07:54:47', '2022-02-10 07:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `leave_categories`
--

CREATE TABLE `leave_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_days` int(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_categories`
--

INSERT INTO `leave_categories` (`id`, `category_name`, `leave_days`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Unpaid Leave', 30, 1, '2022-02-07 00:44:16', '2022-02-07 01:25:08'),
(2, 'Sabbatical leave', 40, 1, '2022-02-07 01:18:15', '2022-02-07 01:32:24'),
(3, 'Compensatory leave', 10, 1, '2022-02-07 01:20:33', '2022-02-07 01:20:33'),
(4, 'Public holiday', 50, 1, '2022-02-07 06:02:45', '2022-02-07 06:02:45'),
(5, 'Basic Computer', 25, 1, '2022-02-09 06:00:14', '2022-02-09 06:00:14'),
(6, 'Our Location_', 10, 1, '2022-02-09 23:46:37', '2022-02-09 23:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `leave_takens`
--

CREATE TABLE `leave_takens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_application_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_taken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_takens`
--

INSERT INTO `leave_takens` (`id`, `leave_application_id`, `leave_category_id`, `leave_taken`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(35, '21', '3', '10', 1, 1, '2022-02-10 07:54:48', '2022-02-10 07:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalcial_institute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `date`, `finalcial_institute`, `loan_holder_name`, `loan_amount`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022-03-19', 'Islami Bank Limited', 'Ariful islam noyon', '1000', 'dfdsfds', 1, '2022-03-18 23:40:55', '2022-03-18 23:40:55'),
(2, '2022-01-31', 'Islami Bank Limited update', 'Ariful islam noyon update', '1001', 'joi update', 1, '2022-03-18 23:45:22', '2022-03-19 00:00:58'),
(3, '2022-03-28', 'Sonali Bank Limited', 'Ariful islam noyon', '1000', 'Ramark of Sonali Bank', 1, '2022-03-28 04:08:12', '2022-03-28 04:08:12'),
(4, '2022-03-28', 'UCB Bank', 'Murad Hasan Khan', '50000', 'Remark', 1, '2022-03-28 04:09:00', '2022-03-28 04:09:00'),
(5, '2022-03-28', 'Brack Bank Limited', 'MD Prothan ( Suvro )', '50000', 'Remark Remark', 1, '2022-03-28 04:10:16', '2022-03-28 04:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `local_projects`
--

CREATE TABLE `local_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_local` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_projects`
--

INSERT INTO `local_projects` (`id`, `blog_id`, `image`, `image_alt`, `active_local`, `status`, `created_at`, `updated_at`) VALUES
(8, 17, 'public/uploads/localProject/images/1711428044441612.png', 'wict-wustock-wusoft', 1, 1, '2021-09-15 07:30:33', '2021-09-24 07:38:57'),
(11, 43, 'public/uploads/localProject/images/Heart Failure Management System - HeartCop.jpg', 'Heard Cop Login - Heard Failure', 1, 1, '2022-02-05 03:27:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `local_project_headers`
--

CREATE TABLE `local_project_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_project_headers`
--

INSERT INTO `local_project_headers` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Our Local Projects', '<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; text-align: center;\">Some of our local projects on local market.</span>', 1, NULL, '2022-01-27 05:06:20');

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
(5, '2021_08_15_052148_create_pages_table', 2),
(7, '2021_08_19_135312_create_courses_table', 3),
(8, '2021_08_22_125342_create_course_members_table', 3),
(12, '2021_08_25_134640_create_course_items_table', 4),
(15, '2021_08_26_135505_create_course_fassilities_table', 5),
(21, '2021_08_29_152434_create_blog_contents_table', 7),
(22, '2021_08_31_110903_create_blog_categories_table', 7),
(23, '2021_08_25_090807_create_blogs_table', 8),
(24, '2021_09_07_105545_modify_blog_table', 9),
(25, '2021_09_08_094018_create_students_table', 10),
(26, '2021_09_12_093218_create_home_sliders_table', 11),
(27, '2021_09_12_154118_create_development_projects_table', 12),
(28, '2021_09_14_093309_create_fontawesomes_table', 13),
(32, '2021_09_15_100437_create_international_works_table', 14),
(34, '2021_09_15_130503_create_local_projects_table', 15),
(35, '2021_09_15_135052_create_contact_us_table', 16),
(36, '2021_09_16_035453_create_about_us_table', 17),
(37, '2021_09_27_163227_create_services_table', 18),
(38, '2021_09_30_093951_create_account_categories_table', 19),
(39, '2021_09_30_123732_create_expenses_table', 20),
(40, '2021_10_02_133255_create_payrolls_table', 21),
(41, '2021_10_03_123059_create_incomes_table', 22),
(42, '2021_10_03_141252_create_batches_table', 23),
(43, '2021_10_05_122350_create_admited_students_table', 24),
(44, '2021_11_06_164341_create_sorting_tests_table', 43),
(50, '2022_01_04_092701_create_investors_table', 44),
(51, '2022_01_04_104238_create_investor_types_table', 45),
(53, '2022_01_04_123231_create_investments_table', 46),
(56, '2022_01_08_113338_create_student_payments_table', 47),
(57, '2022_01_12_114123_create_visitors_table', 48),
(59, '2022_01_24_110413_create_footer_contents_table', 49),
(60, '2022_01_24_191058_create_about_histories_table', 50),
(61, '2022_01_25_101541_create_about_banners_table', 51),
(62, '2022_01_25_123813_create_course_banners_table', 52),
(63, '2022_01_26_092153_create_service_banners_table', 53),
(64, '2022_01_27_100712_create_development_project_headers_table', 54),
(65, '2022_01_27_103311_create_international_project_headers_table', 55),
(66, '2022_01_27_110228_create_local_project_headers_table', 56),
(67, '2022_01_29_110710_create_employee_monthly_salaries_table', 57),
(68, '2022_01_29_145045_create_expense_paybacks_table', 58),
(69, '2022_02_05_114806_create_multiple_expenses_table', 59),
(70, '2022_02_07_055714_create_leave_categories_table', 60),
(73, '2022_02_08_062206_create_leave_applications_table', 62),
(75, '2022_02_08_064823_create_leave_takens_table', 63),
(77, '2022_03_17_133322_create_asset_types_table', 64),
(78, '2022_03_18_064143_create_assets_table', 65),
(80, '2022_03_19_051443_create_loans_table', 66),
(81, '2022_03_21_102808_create_designations_table', 67),
(82, '2021_11_14_182635_create_modules_table', 68),
(83, '2021_11_28_183017_create_user_rolls_table', 69);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parents` int(11) NOT NULL,
  `orgine` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `parents`, `orgine`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 0, 0, 1, '2022-03-23 07:01:16', NULL),
(2, 'Accounts', 0, 0, 1, '2022-03-23 22:39:35', NULL),
(3, 'Invest', 2, 2, 1, '2022-03-23 22:40:04', NULL),
(4, 'Investor', 3, 2, 1, '2022-03-23 22:40:30', NULL),
(5, 'Investor Type', 3, 2, 1, '2022-03-23 22:45:21', NULL),
(6, 'Investment', 3, 2, 1, '2022-03-24 01:23:26', NULL),
(7, 'Assets', 2, 2, 1, '2022-03-24 01:23:56', NULL),
(8, 'Asset Type', 7, 2, 1, '2022-03-24 01:25:54', NULL),
(9, 'Add Asset', 7, 2, 1, '2022-03-24 01:26:10', NULL),
(10, 'Assets List', 7, 2, 1, '2022-03-24 01:26:39', NULL),
(11, 'Loan', 2, 2, 1, '2022-03-24 01:27:03', NULL),
(12, 'Add Loan', 11, 2, 1, '2022-03-24 01:27:18', NULL),
(13, 'Loans List', 11, 2, 1, '2022-03-24 01:27:41', NULL),
(14, 'Accounts Categories', 2, 2, 1, '2022-03-24 01:28:41', NULL),
(15, 'Payroll', 2, 2, 1, '2022-03-24 01:28:54', NULL),
(16, 'Employee Salaries', 15, 2, 1, '2022-03-24 01:29:43', NULL),
(17, 'Payrolls List', 15, 2, 1, '2022-03-24 01:30:13', NULL),
(18, 'Add Payroll', 15, 2, 1, '2022-03-24 01:48:43', NULL),
(19, 'Expense', 2, 2, 1, '2022-03-24 01:49:28', NULL),
(20, 'Expenses List', 19, 2, 1, '2022-03-24 01:50:10', NULL),
(21, 'Add Expense', 19, 2, 1, '2022-03-24 01:52:24', NULL),
(22, 'Multiple Expenses List', 19, 2, 1, '2022-03-24 01:52:49', NULL),
(23, 'Add Multiple Expense', 19, 2, 1, '2022-03-24 01:53:46', NULL),
(24, 'Income', 2, 2, 1, '2022-03-24 01:54:01', NULL),
(25, 'Incomes List', 24, 2, 1, '2022-03-24 01:54:33', NULL),
(26, 'Add Income', 24, 2, 1, '2022-03-24 01:54:49', NULL),
(27, 'Monthly Sheet', 2, 2, 1, '2022-03-24 01:55:10', NULL),
(28, 'Cash In Hand', 2, 2, 1, '2022-03-24 01:55:24', NULL),
(29, 'Appearance', 0, 0, 1, '2022-03-24 01:56:11', NULL),
(30, 'Font awesome', 29, 29, 1, '2022-03-24 01:56:48', NULL),
(31, 'Home Page', 29, 29, 1, '2022-03-24 01:57:01', NULL),
(32, 'Sliders List', 31, 29, 1, '2022-03-24 01:57:26', NULL),
(33, 'Development Project List', 31, 29, 1, '2022-03-24 01:57:50', NULL),
(34, 'International Work', 31, 29, 1, '2022-03-24 01:58:09', NULL),
(35, 'Local Projects', 31, 29, 1, '2022-03-24 01:58:38', NULL),
(36, 'Footer', 31, 29, 1, '2022-03-24 01:58:52', NULL),
(37, 'About Us Page', 29, 29, 1, '2022-03-24 01:59:08', NULL),
(38, 'About Page Banner', 37, 29, 1, '2022-03-24 01:59:40', NULL),
(39, 'About Page History', 37, 29, 1, '2022-03-24 01:59:56', NULL),
(40, 'About Hr Cards', 37, 29, 1, '2022-03-24 02:00:13', NULL),
(41, 'Service Page', 29, 29, 1, '2022-03-24 02:00:33', NULL),
(42, 'Service Banner', 41, 29, 1, '2022-03-24 02:00:54', NULL),
(43, 'Add Service', 41, 29, 1, '2022-03-24 02:01:14', NULL),
(44, 'Service List', 41, 29, 1, '2022-03-24 02:01:27', NULL),
(45, 'User Contact', 29, 29, 1, '2022-03-24 02:01:41', NULL),
(46, 'SEO Pages', 29, 29, 1, '2022-03-24 02:02:22', NULL),
(47, 'Course', 29, 29, 1, '2022-03-24 02:02:38', NULL),
(48, 'Course Banner', 47, 29, 1, '2022-03-24 02:02:53', NULL),
(49, 'Create Course', 47, 29, 1, '2022-03-24 02:03:07', NULL),
(50, 'Courses List', 47, 29, 1, '2022-03-24 02:03:22', NULL),
(51, 'Blog', 29, 29, 1, '2022-03-24 02:03:32', NULL),
(52, 'Blog Categories', 51, 29, 1, '2022-03-24 02:03:50', NULL),
(53, 'Create Blog', 51, 29, 1, '2022-03-24 02:04:32', NULL),
(54, 'Blog List', 51, 29, 1, '2022-03-24 02:04:44', NULL),
(55, 'Students', 0, 0, 1, '2022-03-24 02:05:05', NULL),
(56, 'Batch Number', 55, 55, 1, '2022-03-24 02:05:25', NULL),
(57, 'Students List', 55, 55, 1, '2022-03-24 02:05:41', NULL),
(58, 'Admitted Students List', 55, 55, 1, '2022-03-24 02:06:03', NULL),
(59, 'Users Or Employees', 0, 0, 1, '2022-03-24 02:06:25', NULL),
(60, 'Designation', 59, 59, 1, '2022-03-24 02:06:42', NULL),
(61, 'Users Or Employees List', 59, 59, 1, '2022-03-24 02:07:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `multiple_expenses`
--

CREATE TABLE `multiple_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multiple_expenses`
--

INSERT INTO `multiple_expenses` (`id`, `category_id`, `date`, `expense_type`, `status`, `created_at`, `updated_at`) VALUES
(1, '6,6,', '2022-03-28', 'Global', 1, '2022-03-28 04:16:05', '2022-03-28 04:16:05');

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
(1, 'Home', 'A Prominent Software Farm in Rajbari | Wake up ICT', 'https://wakeupict.com/', NULL, NULL, 'https://wakeupict.com/', NULL, NULL, '<p><strong>Wake Up ICT</strong> is a <strong>Prominent Software Farm</strong> in Rajbari. It is a complete <strong>Software Development</strong> &amp; <strong>IT Service</strong> providing Company that gives high-quality services to our customer.</p>', NULL, NULL, 'public/uploads/SEO/images/1717019285436071.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-13 01:07:24', '2022-01-13 01:07:24'),
(2, 'About', 'IT Company Rajbari Bangladesh | Wake Up ICT', 'https://wakeupict.com/about-us', NULL, NULL, 'https://wakeupict.com/about-us', NULL, NULL, '<p><strong>Wake Up ICT</strong> Academy is one of the leading IT Training Institute in Bangladesh and provides all kinds of <strong>IT-Related Solutions</strong>. Wake UP ICT has been playing a vital role in Rajbari eradicate the unemployment problem since 2015...</p>', NULL, NULL, 'public/uploads/SEO/images/1708522539636513.png', '324', '3423', NULL, NULL, NULL, NULL, '1', '2022-01-16 01:19:54', '2022-01-16 01:19:54'),
(3, 'Academic', 'Academic Training - Wake UP ICT', 'https://wakeupict.com/training', NULL, NULL, 'https://wakeupict.com/training', NULL, NULL, '<p>OUR ACADEMIC TRAINING MODULE IS THE BEST CITY &amp; WE HAVE SOME QUALIFIED TRAINERS AND A DIGITALIZED COMPUTER LAB. WE CAN ENSURE YOU THAT OUR COURSES WILL SERVE YOUR PURPOSE...</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:20:28', '2022-01-16 01:20:28'),
(4, 'Services', 'Services - Wake up ICT', 'https://wakeupict.com/what-we-do', NULL, NULL, 'https://wakeupict.com/what-we-do', NULL, NULL, '<p>The best service you can get from Wake up ICT. It is IT Training Institute in Bangladesh and provides all kinds of IT-Related Solutions.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:20:58', '2022-01-16 01:20:58'),
(5, 'Blog', 'Our Blogs - Wake up ICT', 'https://wakeupict.com/our-blogs', NULL, NULL, 'https://wakeupict.com/our-blogs', NULL, NULL, '<p>Blogs Page Wake up ICT.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:21:36', '2022-01-16 01:21:36'),
(6, 'Contact', 'Contact Us - Wake up ICT', 'https://wakeupict.com/contact', NULL, NULL, 'https://wakeupict.com/contact', NULL, NULL, '<p>To get a free quote, <strong>Contact us</strong> anytime with Wake up ICT.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-11-21 23:27:42', '2021-11-21 23:27:42'),
(14, 'গ্রাফিক্স ডিজাইন কোর্স', 'গ্রাফিক্স ডিজাইন কোর্স রাজবাড়ী | Wake Up ICT', 'https://wakeupict.com/training/graphics-design-course-rajbari', NULL, NULL, 'https://wakeupict.com/training/graphics-design-course-rajbari', NULL, NULL, '<p>Graphic Design Course&nbsp;হলো এমন একটি প্রক্রিয়া যার মাধ্যমে নিজের সৃজনশীলতা ব্যবহার করে ছবি বা নকশার মাধ্যমে নিজের প্রতিভাকে প্রকাশ করা যায়। বেসিক শিখলে আমরা ছবি এডিটিং,ব্যানার তৈরি , PSD ডিজাইন, Website Template Design করতে পারব। তাই আমরা যদি Graphics Design বেসিক কোর্সটি সম্পূর্ন করতে পারি তাহলে আমরা উল্লেখিত কাজগুলো করতে পারব।<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717114146469307.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:24:56', '2022-01-16 01:24:56'),
(15, 'ডিজিটাল মার্কেটিং কোর্স', 'ডিজিটাল মার্কেটিং কোর্স রাজবাড়ী | Wake Up ICT', 'https://wakeupict.com/training/digital-marketing-course-rajbari', NULL, NULL, 'https://wakeupict.com/training/digital-marketing-course-rajbari', NULL, NULL, '<p>বর্তমান সময়ে বিজ্ঞাপনের সকল মাধ্যমগুলোর মধ্যে বর্তমান সময়ের বহুল পরিচিত এবং সবথেকে জনপ্রিয় মাধ্যম হচ্ছে&nbsp; ডিজিটাল মার্কেটিং । যেখানে অডিয়েন্স আছে কোন পণ্য বা সেবার বিজ্ঞাপন সাধারণত সাধারণভাবে সেখানেই হয়। আমরা প্রতিনিয়ত যে সব ওয়েবসাইট ব্যবহার করছি সেখানে আমরা কোন পণ্য বা সেবার বিজ্ঞাপন দিয়ে খুব সহজেই কাস্টমার দিতে পারি। মার্কেটিং এর যাবতীয় কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগ করার জন্য যা জরুরী তা এখানে দেখানো হবে।<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717018599812896.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:27:00', '2022-01-16 01:27:00'),
(16, 'ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স', 'ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স রাজবাড়ী | Wake Up ICT', 'https://wakeupict.com/training/web-design-and-development-course-rajbari', NULL, NULL, 'https://wakeupict.com/training/web-design-and-development-course-rajbari', NULL, NULL, 'ওয়েব ডিজাইন হল একটি ওয়েবসাইটের ব্যাহিক রুপ যা আমরা দেখতে পাই বা দৃশ্য মান হয় । আর ওয়েব ডেভেলপমেন্ট হল ভেতরের সাইট যা আমরা দেখতে পাইনা । যেমন উদাহরণ সরুপ একটি গাড়ীর কথা চিন্তা করি । গাড়ির দরজা, জানালা, সিট ব্যাহিক সবকিছুই ওয়েব ডিজাইন এর মধ্যে পরে ।', NULL, NULL, 'public/uploads/SEO/images/1717115145644108.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:31:02', '2022-01-16 01:31:02'),
(17, 'অ্যাডভান্স গ্রাফিক ডিজাইন কোর্স', 'অ্যাডভান্স গ্রাফিক ডিজাইন কোর্স রাজবাড়ী | Wake Up ICT', 'https://wakeupict.com/training/advanced-graphic-design-course-rajbari', NULL, NULL, 'https://wakeupict.com/training/advanced-graphic-design-course-rajbari', NULL, NULL, '<p>অ্যাডভান্সড গ্রাফিক ডিজাইন কোর্স এমন লোকদের জন্য ডিজাইন করা হয়েছে যারা গ্রাফিক ডিজাইনের সাথে পরিচিত এবং সরঞ্জাম এবং এর ব্যবহার সম্পর্কে জানেন। গ্রাফিক ডিজাইনারগণ মিডিয়া এবং ওয়েব ডিজাইন, প্যাকেজিং, চিত্রণ, অ্যানিমেশন এবং অন্যান্য ক্ষেত্রে তাদের নকশা দক্ষতা কাজে লাগান। ধারণাটি তৈরিতে সহায়ক এবং দক্ষতার সাথে প্রকল্পের সংখ্যা অন্তর্ভুক্ত করার দক্ষতাগুলি হাইলাইট করার জন্য স্তরটি উন্নত।<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717115496863690.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:28:47', '2022-01-16 01:28:47'),
(19, 'এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট  কোর্স', 'এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স রাজবাড়ী | Wake Up ICT', 'https://wakeupict.com/training/advanced-web-design-and-development-course-rajbari', NULL, NULL, 'https://wakeupict.com/training/advanced-web-design-and-development-course-rajbari', NULL, NULL, '<p>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো কোনো টেমপ্লেটকে আরও সুন্দর ভাবে সাজানো। এক্ষেত্রে HTML, CSS , CSS এর ফ্রেমওয়ার্ক Bootstrap, JavaScript এর ফ্রেমওয়ার্ক jQuery ব্যবহার করে টেমপ্লেট ডিজাইন করা হয়। ডিজাইন এর ফ্রেমওয়ার্কগুলো ব্যবহার করে টেমপ্লেট এর কোথায়, কীভাবে তথ্যগুলো দেখানো হবে সেটা নির্ধারণ করাই হলো এডভান্স ওয়েব ডিজাইনারের কাজ।<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717202359256063.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:33:06', '2022-01-16 01:33:06'),
(45, 'ফ্রী Microsoft Office Program course', 'ফ্রী Microsoft Office Program course | Wake Up ICT', 'https://wakeupict.com/our-blogs/free-microsoft-office-program-course', NULL, NULL, 'https://wakeupict.com/our-blogs/free-microsoft-office-program-course', NULL, NULL, '<p>যার ইনভাইট কার্যক্রম আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তাকে প্রথম বিজয়ী হিসেবে নির্ধারণ করা হবে। এবং দ্বিতীয় বিজয়ী কে লটারির মাধ্যমে নির্ধারণ করা হবে। আপনার সকল কার্যক্রম আমাদের IT Expert টিম দ্বারা মনিটরিং করা হবে সুতরাং উপরিউক্ত কোন একটি শর্তাবলী ও যদি কেউ বাদ রাখে তাহলে সে প্রতিযোগী হিসেবে গন্য হবে না।</p>', NULL, NULL, 'public/uploads/SEO/images/1717204830093531.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:38:39', '2022-01-16 01:38:39'),
(46, 'Microsoft Office Program course', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:41:17', '2022-01-16 01:41:17'),
(47, 'Sharna Islam Zenia', 'Sharna Islam Achieved Communication Certificate from 10minuteschool', 'https://wakeupict.com/our-blogs/sharna-achieved-communication-certificate', NULL, NULL, 'https://wakeupict.com/our-blogs/sharna-achieved-communication-certificate', NULL, NULL, '<p>Sharna Islam Zenia , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool. Communication also plays an essential role in human life and professional life.<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717206536605035.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:45:55', '2022-01-16 01:45:55'),
(48, 'Sharna Islam Zenia', 'Sharna Islam Zenia Digital Influencers - Wake Up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(33,37,41);\">Sharna Islam Zenia, one of our Digital Influencers, has <strong>successfully Communication Secrets</strong> certification from 10minuteschool.</span></p>', NULL, '18 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-17 16:21:52', '2021-09-17 16:21:52'),
(49, 'Improve Graphic design!', 'How To Improve Graphic design | Wake Up ICT', 'https://wakeupict.com/our-blogs/how-to-improve-graphic-design', NULL, NULL, 'https://wakeupict.com/our-blogs/how-to-improve-graphic-design', NULL, NULL, '<h4>Graphic design-How to improve your graphic design skills! Here are ten practical and achievable ways to help you improve your graphic design skills:<br></h4>', NULL, NULL, 'public/uploads/SEO/images/1717204275376019.png', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:47:48', '2022-01-16 01:47:48'),
(52, 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ রাজবাড়ী | Wake Up ICT', 'https://wakeupict.com/our-blogs/free-software-development-internship-rajbari', NULL, NULL, 'https://wakeupict.com/our-blogs/free-software-development-internship-rajbari', NULL, NULL, '<p><br>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে। আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১। লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে</p>', NULL, NULL, 'public/uploads/SEO/images/1717207240722975.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:50:15', '2022-01-16 01:50:15'),
(54, 'Nazmul Kadir', 'Nazmul Kadir Achieved SEO Certificate from HubSpot Academy.', 'https://wakeupict.com/our-blogs/nazmul-kadir-achieved-seo-certificate', NULL, NULL, 'https://wakeupict.com/our-blogs/nazmul-kadir-achieved-seo-certificate', NULL, NULL, '<p>Nazmul Kadir, one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. Now he is more capable of optimizing a website to perform well in search engines.</p>', NULL, NULL, 'public/uploads/SEO/images/1717206227210351.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:53:13', '2022-01-16 01:53:13'),
(56, 'Md.Lotiful Azad Kajol', 'Lotiful Azad Kajol Achived Marketing Certificate from Google.', 'https://wakeupict.com/our-blogs/kajol-achieved-marketing-certificate', NULL, NULL, 'https://wakeupict.com/our-blogs/kajol-achieved-marketing-certificate', NULL, NULL, '<h2>Md.Lotiful Azad, one of our Digital Influencers, he <strong>Successfully achieved</strong> The <strong>Fundamentals of Digital Marketin</strong>g Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate</h2>', NULL, NULL, 'public/uploads/SEO/images/1717206084560603.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:55:09', '2022-01-16 01:55:09'),
(58, 'Microsoft Office Courses Rajbari | Wake Up ICT', 'Microsoft Office - Wake UP ICT', 'https://wakeupict.com/blog-details/microsoft-office', NULL, NULL, 'https://wakeupict.com/blog-details/microsoft-office', NULL, NULL, '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office Specialist Training Course in Rajbari- Wake UP ICT(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', NULL, NULL, 'public/uploads/SEO/images/1717205906646734.png', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-11-23 02:12:49', '2022-01-13 01:48:42'),
(60, 'How to improve your graphic', 'Graphic design', 'https://wakeupict.com/blog-details/graphic-design', NULL, NULL, NULL, NULL, NULL, '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717203651231683.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-11-23 02:44:29', '2021-11-23 02:44:29'),
(62, 'Rajbari Jute Mills Visit', 'Rajbari Jute Mills Visit For Project | Wake Up ICT', 'https://wakeupict.com/our-blogs/rajbari-jute-mills-visit-for-project', NULL, NULL, 'https://wakeupict.com/our-blogs/rajbari-jute-mills-visit-for-project', NULL, NULL, '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.</p>', NULL, NULL, 'public/uploads/SEO/images/1717203292818608.png', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:57:15', '2022-01-16 01:57:15'),
(64, 'Car Management Project', 'Car Management Project | Wake Up ICT', 'https://wakeupict.com/our-blogs/car-management-project', NULL, NULL, 'https://wakeupict.com/our-blogs/car-management-project', NULL, NULL, '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch. Special thanks go to Folly Edem the Co-Organizer of GDG LOME for his interest in WAKEUPICT for build this project with modern technology. Finally, we complete the project and deploy it on the server.<br></p>', NULL, NULL, 'public/uploads/SEO/images/1717203183361329.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:58:20', '2022-01-16 01:58:20'),
(66, 'Cloud80 Logo Design', 'Cloud80 Tech company Logo Design | Wake up ICT', 'https://wakeupict.com/our-blogs/cloud80-company-logo-design', NULL, NULL, 'https://wakeupict.com/our-blogs/cloud80-company-logo-design', NULL, NULL, '<p><strong>Cloud80</strong> is a <strong>tech company</strong> based in the <strong>United States</strong>, they provide Salesforce development and implementation services.</p>', NULL, NULL, 'public/uploads/SEO/images/1717202972896365.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 01:59:33', '2022-01-16 01:59:33'),
(68, 'Wake Up ICT Location', 'Wake Up ICT Location Nannu Tower Rajbari.', 'https://wakeupict.com/our-blogs/location-nannu-tower', NULL, NULL, 'https://wakeupict.com/our-blogs/location-nannu-tower', NULL, NULL, '<p>Wake Up ICT location Nannu Tower, 3rd Floor, Panna Chattar, Rajbari.</p>', NULL, NULL, 'public/uploads/SEO/images/1717202768412209.png', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 02:01:28', '2022-01-16 02:01:28'),
(70, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', 'কিভাবে ওয়েব ডেভেলপমেন্ট ক্যারিয়ার গড়তে পাড়ি? বিস্তারিত', 'https://wakeupict.com/our-blogs/web-development-career', NULL, NULL, 'https://wakeupict.com/our-blogs/web-development-career', NULL, NULL, '<p>ওয়েব ডেভেলপমেন্ট ক্যারিয়ার বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। ওয়েব ডেভেলপমেন্ট কি?এবং ক্যারিয়ার গড়তে হলে কি কি দরকার বিস্তারিত পাবেন এখানে। &nbsp;</p>', NULL, NULL, 'public/uploads/SEO/images/1717202598437461.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 02:02:18', '2022-01-16 02:02:18'),
(91, 'Student Registration page', 'Student Registration form | Wake Up ICT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-16 02:03:19', '2022-01-16 02:03:19'),
(93, 'Microsoft Office Course', 'Graphic design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-11-23 02:45:47', '2022-01-13 01:49:34'),
(102, 'দেশেসেরা হসপিটাল ইউনাইটেডে চলছে ওয়েক আপ এর সফটওয়্যার _\"হার্ট কপ\"', 'হার্ট কপ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-01-18 09:55:49', '2022-01-18 09:55:49'),
(103, 'বান্দরবন To কক্সবাজার', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL);

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
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `title_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payroll_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `user_id`, `expense_id`, `title_id`, `employee_type`, `date`, `salary_month`, `amount`, `remark`, `type`, `payroll_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 37, 6, '5', 'Paid', '2022-03-28', '2022-02-01', 40000, 'Remark Remark', 'Salary', 'Global', 1, '2022-03-28 04:12:19', NULL),
(2, 38, 7, '5', 'Paid', '2022-03-28', '2022-02-01', 15000, 'Ramark', 'Salary', 'Global', 1, '2022-03-28 04:12:45', NULL),
(3, 39, 8, '5', 'Paid', '2022-03-28', '2022-02-01', 8000, 'dsfds', 'Salary', 'Global', 1, '2022-03-28 04:12:56', NULL),
(4, 40, 9, '5', 'Paid', '2022-03-28', '2022-02-01', 12000, 'Remark', 'Salary', 'Global', 1, '2022-03-28 04:13:11', NULL),
(5, 41, 10, '5', 'Paid', '2022-03-28', '2022-02-01', 5000, 'Remark', 'Salary', 'Global', 1, '2022-03-28 04:13:43', NULL);

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
(2, 'fa fa-desktop', 'Website Design And Development', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or any other user. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.&nbsp;</p>', 2, 1, '2021-09-28 02:58:08', '2022-02-05 03:31:33'),
(14, 'fa fa-desktop', 'Software Development', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or any other user. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.</p>', 1, 1, '2021-09-30 12:49:55', '2022-02-05 03:31:59'),
(15, 'fa fa-desktop', 'Graphic Design', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.</p><p>CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or any other user. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.</p>', 4, 1, '2021-09-30 12:52:16', '2022-02-05 03:32:28'),
(16, 'fa fa-desktop', 'Digital Marketing', '<p>Let’s start right from the beginning by outlining the core model of your business, and any pain points.<span style=\"font-size: 1rem;\">CRM is self-hosted Customer Relationship Management software that is a great fit for almost any company, freelancer, or any other user. With its clean and modern design, Our CRM can help you look more professional to your customers and help improve business performance at the same time.</span></p>', 5, 1, '2021-09-30 12:54:03', '2022-02-05 03:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `service_banners`
--

CREATE TABLE `service_banners` (
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
-- Dumping data for table `service_banners`
--

INSERT INTO `service_banners` (`id`, `banner_title`, `banner_description`, `body_title`, `body_description`, `image`, `image_alt`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(2, 'YOUR TRUSTED BACK-OFFICE SUPPORT SERVICES PROVIDER', '<p class=\"MsoNormal\">WE PROVIDE BACK-OFFICE SUPPORT SERVICES TO SMALL AND MEDIUM\r\nBUSINESSES...<o:p></o:p></p>', 'Our Services', '<p><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; text-align: center;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia incidunt minima tenetur vel culpa in aliquid dolorem ratione alias rem distinctio, voluptas quidem omnis fugit temporibus eos, deserunt facere quo.</span><br></p>', 'public/uploads/service/banner/dz 1900 x 600.png', 'Service Page Banner', 1, 1, '2022-01-26 03:54:19', '2022-01-26 03:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `sorting_tests`
--

CREATE TABLE `sorting_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sorting_tests`
--

INSERT INTO `sorting_tests` (`id`, `name`, `date`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'One', '2021-11-06', 4, 1, NULL, '2021-12-19 03:47:25'),
(2, 'Two', '2021-11-06', 2, 1, NULL, '2021-12-19 03:47:27'),
(3, 'threee', '2021-11-06', 3, 1, NULL, '2021-12-19 03:47:27'),
(4, 'four', '2021-11-06', 1, 1, NULL, '2021-12-19 03:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `course_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gander` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_call_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `educational_qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passing_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `course_id`, `batch_id`, `course_fee`, `student_name`, `gander`, `fathers_name`, `mothers_name`, `nationality`, `national_id_no`, `present_address`, `permanent_address`, `personal_call_no`, `email`, `religion`, `occupation`, `age`, `educational_qualification`, `result`, `passing_year`, `student_photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '7500', 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784703000', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-27 22:58:31', NULL),
(2, 6, 3, '7500', 'Jeff Bezos', 'male', 'Father\'s Name', 'Mother\'s Name', 'Markini', '1446546456', 'Present Address', 'Permanent Address', '01712345678', 'jeb@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', '3.80', '1999', 'public/uploads/student/images/Offer-Post-gifts.jpg', 1, '2022-03-27 23:30:02', NULL),
(3, 6, 3, '7500', 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01789012345', 'rimon@gmail.com', 'Religion', 'Occupation', '2022-03-28', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/NationalFlag.jpg', 1, '2022-03-27 23:31:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_payments`
--

CREATE TABLE `student_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `income_id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_money` int(255) NOT NULL DEFAULT 0,
  `return_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_payments`
--

INSERT INTO `student_payments` (`id`, `income_id`, `student_id`, `course_id`, `batch_id`, `date`, `mobile`, `remark`, `paid`, `return_money`, `return_date`, `return_reason`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 17, '1', '6', '1', '2022-03-28', '01784703000', 'Remark', '2000', 0, NULL, NULL, 1, '2022-03-28 04:29:38', '2022-03-28 04:29:38', '1'),
(2, 18, '1', '6', '1', '2022-03-28', '01784703000', 'Remark', '2000', 0, NULL, NULL, 1, '2022-03-28 04:36:45', '2022-03-28 04:36:45', '1'),
(3, 19, '2', '6', '1', '2022-03-28', '01712345678', 'Remark', '3000', 0, NULL, NULL, 1, '2022-03-28 05:03:45', '2022-03-28 05:03:45', '1'),
(4, 20, '2', '6', '1', '2022-03-28', '01712345678', 'Remark', '2000', 0, NULL, NULL, 1, '2022-03-28 05:04:03', '2022-03-28 05:04:03', '1'),
(5, 21, '23', '6', '3', '2022-03-28', '01784703000', 'Remark', '1500', 0, NULL, NULL, 1, '2022-03-28 07:12:00', '2022-03-28 07:12:00', '37'),
(6, 22, '23', '6', '3', '2022-03-28', '01784703000', 'Remark', '1500', 0, NULL, NULL, 1, '2022-03-28 07:13:36', '2022-03-28 07:13:36', '37'),
(7, 23, '23', '6', '3', '2022-03-28', '01784703000', 'NID: 1313213213\r\nPayment\r\nDate\r\nRemark', '1000', 0, NULL, NULL, 1, '2022-03-28 07:14:06', '2022-03-28 07:14:06', '37'),
(8, 24, '24', '6', '3', '2022-03-28', '01712345678', 'Remark', '1600', 0, NULL, NULL, 1, '2022-03-28 07:14:56', '2022-03-28 07:14:56', '37'),
(9, 25, '24', '6', '3', '2022-03-28', '01712345678', 'Remark', '3400', 0, NULL, NULL, 1, '2022-03-28 07:15:11', '2022-03-28 07:15:11', '37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excess_type` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `type`, `excess_type`, `employee_type`, `nid_number`, `designation_id`, `photo`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@wakeupict.com', 'Admin', '3', 'Paid', '1234568542', '2', 'public/uploads/profile/1713412671473182.jpeg', 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2021-08-12 09:00:04', '2022-01-15 04:28:42'),
(37, 'Md Riasath Arif Prodhan (shuvro)', 'type2prodhan@gmail.com', 'Employee', '1', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:37:30', NULL),
(38, 'Md. Murad Hasan Khan', 'mdmuradhasankhan@gmail.com', 'Employee', '', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:38:30', NULL),
(39, 'Sajib Sarkar', 'sojibsarkar@gmail.com', 'Employee', '2', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:39:38', NULL),
(40, 'Md Abu Bakar Siddique', 'absiddique@gmail.com', 'Employee', '', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:45:06', NULL),
(41, 'Rimon Hoshen', 'mdrimonhasan@gmail.com', 'Employee', '', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:46:19', NULL),
(42, 'Mahadi Hasan Pranto', 'mpranto394@gmail.com', 'Employee', '', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:47:23', NULL),
(43, 'Shaharima Afroj Sraboni', 'saharima@gmail.com', 'Employee', '', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:48:10', NULL),
(44, 'Antor Kumar Dash', 'antor@gmail.com', 'Employee', '', 'Paid', '1234568542', '1', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:52:47', '2022-03-21 06:48:03'),
(45, 'Munnu', 'munnu@gmail.com', 'Employee', '', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-02-07 08:53:29', '2022-03-21 06:47:12'),
(46, 'Rejaul', 'ariful@wdakeupict.com', 'Employee', '2', 'Paid', '1234568542', '2', NULL, 1, NULL, '$2y$10$FwPlSSyGpji5X.Lk5ePAV.WIYttFGVnhDNQsi1/sUd1h.Itf7g/sa', NULL, '2022-03-21 06:16:10', '2022-03-23 04:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_rolls`
--

CREATE TABLE `user_rolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_rolls`
--

INSERT INTO `user_rolls` (`id`, `user_id`, `module_id`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 46, 0, 0, 1, '2022-03-23 07:30:30', '2022-03-23 07:30:30'),
(2, 37, 1, 0, 1, '2022-03-24 04:30:15', '2022-03-24 04:30:15'),
(3, 37, 2, 0, 1, '2022-03-24 04:30:15', '2022-03-27 23:49:26'),
(4, 37, 29, 0, 1, '2022-03-24 04:30:15', '2022-03-24 23:13:34'),
(5, 37, 55, 0, 1, '2022-03-24 04:30:15', '2022-03-24 23:17:58'),
(6, 37, 59, 0, 1, '2022-03-24 04:30:15', '2022-03-24 23:22:07'),
(7, 37, 3, 0, 1, '2022-03-24 04:46:14', '2022-03-24 04:48:12'),
(8, 37, 4, 0, 1, '2022-03-24 04:47:57', '2022-03-24 04:47:57'),
(9, 37, 5, 0, 1, '2022-03-24 04:48:12', '2022-03-24 04:48:12'),
(10, 37, 6, 0, 1, '2022-03-24 04:48:12', '2022-03-24 04:48:12'),
(11, 37, 7, 0, 1, '2022-03-24 04:56:52', '2022-03-24 04:57:03'),
(12, 37, 8, 0, 1, '2022-03-24 04:57:03', '2022-03-24 04:57:03'),
(13, 37, 9, 0, 1, '2022-03-24 04:57:03', '2022-03-24 04:57:03'),
(14, 37, 10, 0, 1, '2022-03-24 04:57:03', '2022-03-24 04:57:03'),
(15, 37, 11, 0, 1, '2022-03-24 05:03:58', '2022-03-24 05:04:10'),
(16, 37, 12, 0, 1, '2022-03-24 05:04:10', '2022-03-24 05:04:10'),
(17, 37, 13, 0, 1, '2022-03-24 05:04:10', '2022-03-24 05:04:10'),
(18, 37, 14, 0, 1, '2022-03-24 05:07:35', '2022-03-24 05:07:35'),
(19, 37, 15, 0, 1, '2022-03-24 05:29:35', '2022-03-24 05:29:47'),
(20, 37, 16, 0, 1, '2022-03-24 05:29:47', '2022-03-24 05:29:47'),
(21, 37, 17, 0, 1, '2022-03-24 05:29:47', '2022-03-24 05:29:47'),
(22, 37, 18, 0, 1, '2022-03-24 05:29:47', '2022-03-24 05:29:47'),
(23, 37, 19, 0, 1, '2022-03-24 05:39:09', '2022-03-24 05:39:27'),
(24, 37, 20, 0, 1, '2022-03-24 05:39:27', '2022-03-24 05:39:27'),
(25, 37, 21, 0, 1, '2022-03-24 05:39:27', '2022-03-24 05:39:27'),
(26, 37, 22, 0, 1, '2022-03-24 05:39:27', '2022-03-24 05:39:27'),
(27, 37, 23, 0, 1, '2022-03-24 05:39:27', '2022-03-24 05:39:27'),
(28, 37, 24, 0, 1, '2022-03-24 05:46:45', '2022-03-24 05:46:57'),
(29, 37, 25, 0, 1, '2022-03-24 05:46:57', '2022-03-24 05:46:57'),
(30, 37, 26, 0, 1, '2022-03-24 05:46:57', '2022-03-24 05:46:57'),
(31, 37, 28, 0, 1, '2022-03-24 05:56:16', '2022-03-24 05:56:16'),
(32, 37, 30, 0, 1, '2022-03-24 07:02:01', '2022-03-24 07:02:01'),
(33, 37, 31, 0, 1, '2022-03-24 07:02:21', '2022-03-24 07:02:39'),
(34, 37, 32, 0, 1, '2022-03-24 07:02:39', '2022-03-24 07:02:39'),
(35, 37, 33, 0, 1, '2022-03-24 07:02:39', '2022-03-24 07:02:39'),
(36, 37, 34, 0, 1, '2022-03-24 07:02:39', '2022-03-24 07:02:39'),
(37, 37, 35, 0, 1, '2022-03-24 07:02:39', '2022-03-24 07:02:39'),
(38, 37, 36, 0, 1, '2022-03-24 07:02:39', '2022-03-24 07:02:39'),
(39, 37, 37, 0, 1, '2022-03-24 07:11:50', '2022-03-24 07:12:11'),
(40, 37, 38, 0, 1, '2022-03-24 07:12:11', '2022-03-24 07:12:11'),
(41, 37, 39, 0, 1, '2022-03-24 07:12:11', '2022-03-24 07:12:11'),
(42, 37, 40, 0, 1, '2022-03-24 07:12:11', '2022-03-24 07:12:11'),
(43, 37, 41, 0, 1, '2022-03-24 07:41:13', '2022-03-24 07:41:25'),
(44, 37, 42, 0, 1, '2022-03-24 07:41:25', '2022-03-24 07:41:25'),
(45, 37, 43, 0, 1, '2022-03-24 07:41:25', '2022-03-24 07:41:25'),
(46, 37, 44, 0, 1, '2022-03-24 07:41:25', '2022-03-24 07:41:25'),
(47, 37, 46, 0, 1, '2022-03-24 22:52:19', '2022-03-24 22:52:19'),
(48, 37, 47, 0, 1, '2022-03-24 23:00:03', '2022-03-24 23:00:14'),
(49, 37, 48, 0, 1, '2022-03-24 23:00:14', '2022-03-24 23:00:14'),
(50, 37, 49, 0, 1, '2022-03-24 23:00:14', '2022-03-24 23:00:14'),
(51, 37, 50, 0, 1, '2022-03-24 23:00:14', '2022-03-24 23:00:14'),
(52, 37, 51, 0, 1, '2022-03-24 23:13:23', '2022-03-24 23:13:34'),
(53, 37, 52, 0, 1, '2022-03-24 23:13:34', '2022-03-24 23:13:34'),
(54, 37, 53, 0, 1, '2022-03-24 23:13:34', '2022-03-24 23:13:34'),
(55, 37, 54, 0, 1, '2022-03-24 23:13:34', '2022-03-24 23:13:34'),
(56, 37, 56, 0, 1, '2022-03-24 23:17:58', '2022-03-24 23:17:58'),
(57, 37, 57, 0, 1, '2022-03-24 23:17:58', '2022-03-24 23:17:58'),
(58, 37, 58, 0, 1, '2022-03-24 23:17:58', '2022-03-24 23:17:58'),
(59, 37, 60, 0, 1, '2022-03-24 23:22:07', '2022-03-24 23:22:07'),
(60, 37, 61, 0, 1, '2022-03-24 23:22:07', '2022-03-24 23:22:07'),
(61, 37, 27, 0, 1, '2022-03-27 23:49:26', '2022-03-27 23:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`, `status`, `created_at`, `updated_at`) VALUES
(1, '118.179.97.39', '2022-01-15 04:40:27pm', 1, '2022-01-15 10:40:27', '2022-01-15 10:40:27'),
(2, '118.179.97.39', '2022-01-15 04:41:28pm', 1, '2022-01-15 10:41:28', '2022-01-15 10:41:28'),
(3, '118.179.97.39', '2022-01-15 04:41:43pm', 1, '2022-01-15 10:41:43', '2022-01-15 10:41:43'),
(4, '118.179.97.39', '2022-01-15 04:42:45pm', 1, '2022-01-15 10:42:45', '2022-01-15 10:42:45'),
(5, '118.179.97.39', '2022-01-15 04:44:51pm', 1, '2022-01-15 10:44:51', '2022-01-15 10:44:51'),
(6, '118.179.97.39', '2022-01-15 04:45:00pm', 1, '2022-01-15 10:45:00', '2022-01-15 10:45:00'),
(7, '118.184.177.112', '2022-01-15 05:49:21pm', 1, '2022-01-15 11:49:21', '2022-01-15 11:49:21'),
(8, '51.159.23.22', '2022-01-15 06:53:54pm', 1, '2022-01-15 12:53:54', '2022-01-15 12:53:54'),
(9, '51.159.23.22', '2022-01-15 06:53:57pm', 1, '2022-01-15 12:53:57', '2022-01-15 12:53:57'),
(10, '114.119.138.140', '2022-01-15 06:55:38pm', 1, '2022-01-15 12:55:38', '2022-01-15 12:55:38'),
(11, '92.118.160.13', '2022-01-15 07:15:22pm', 1, '2022-01-15 13:15:22', '2022-01-15 13:15:22'),
(12, '103.135.252.95', '2022-01-15 08:29:11pm', 1, '2022-01-15 14:29:11', '2022-01-15 14:29:11'),
(13, '103.135.252.95', '2022-01-15 08:31:25pm', 1, '2022-01-15 14:31:25', '2022-01-15 14:31:25'),
(14, '103.199.87.206', '2022-01-15 10:11:58pm', 1, '2022-01-15 16:11:58', '2022-01-15 16:11:58'),
(15, '173.252.83.118', '2022-01-15 10:23:12pm', 1, '2022-01-15 16:23:12', '2022-01-15 16:23:12'),
(16, '173.252.83.13', '2022-01-15 10:23:12pm', 1, '2022-01-15 16:23:12', '2022-01-15 16:23:12'),
(17, '173.252.83.17', '2022-01-15 10:23:12pm', 1, '2022-01-15 16:23:12', '2022-01-15 16:23:12'),
(18, '173.252.83.118', '2022-01-15 10:23:12pm', 1, '2022-01-15 16:23:12', '2022-01-15 16:23:12'),
(19, '173.252.107.22', '2022-01-15 10:38:57pm', 1, '2022-01-15 16:38:57', '2022-01-15 16:38:57'),
(20, '185.5.251.114', '2022-01-15 10:40:59pm', 1, '2022-01-15 16:41:00', '2022-01-15 16:41:00'),
(21, '185.5.251.114', '2022-01-15 10:41:07pm', 1, '2022-01-15 16:41:07', '2022-01-15 16:41:07'),
(22, '163.53.209.7', '2022-01-16 12:06:51am', 1, '2022-01-15 18:06:51', '2022-01-15 18:06:51'),
(23, '107.173.222.196', '2022-01-16 12:07:56am', 1, '2022-01-15 18:07:56', '2022-01-15 18:07:56'),
(24, '64.62.252.174', '2022-01-16 12:52:47am', 1, '2022-01-15 18:52:47', '2022-01-15 18:52:47'),
(25, '209.99.16.231', '2022-01-16 01:31:24am', 1, '2022-01-15 19:31:24', '2022-01-15 19:31:24'),
(26, '66.249.68.35', '2022-01-16 01:50:44am', 1, '2022-01-15 19:50:44', '2022-01-15 19:50:44'),
(27, '66.249.68.51', '2022-01-16 01:57:48am', 1, '2022-01-15 19:57:48', '2022-01-15 19:57:48'),
(28, '173.231.60.195', '2022-01-16 02:10:33am', 1, '2022-01-15 20:10:33', '2022-01-15 20:10:33'),
(29, '157.55.39.146', '2022-01-16 02:19:14am', 1, '2022-01-15 20:19:14', '2022-01-15 20:19:14'),
(30, '69.171.251.6', '2022-01-16 02:35:21am', 1, '2022-01-15 20:35:21', '2022-01-15 20:35:21'),
(31, '217.138.206.217', '2022-01-16 04:18:09am', 1, '2022-01-15 22:18:09', '2022-01-15 22:18:09'),
(32, '217.138.206.217', '2022-01-16 04:18:19am', 1, '2022-01-15 22:18:19', '2022-01-15 22:18:19'),
(33, '217.138.206.217', '2022-01-16 04:18:23am', 1, '2022-01-15 22:18:23', '2022-01-15 22:18:23'),
(34, '23.224.42.11', '2022-01-16 05:57:14am', 1, '2022-01-15 23:57:14', '2022-01-15 23:57:14'),
(35, '66.249.68.35', '2022-01-16 06:01:52am', 1, '2022-01-16 00:01:52', '2022-01-16 00:01:52'),
(36, '104.223.93.133', '2022-01-16 06:32:28am', 1, '2022-01-16 00:32:28', '2022-01-16 00:32:28'),
(37, '195.154.177.197', '2022-01-16 07:13:25am', 1, '2022-01-16 01:13:25', '2022-01-16 01:13:25'),
(38, '54.252.215.123', '2022-01-16 07:14:56am', 1, '2022-01-16 01:14:56', '2022-01-16 01:14:56'),
(39, '143.198.172.181', '2022-01-16 07:28:02am', 1, '2022-01-16 01:28:02', '2022-01-16 01:28:02'),
(40, '143.198.172.181', '2022-01-16 07:28:03am', 1, '2022-01-16 01:28:03', '2022-01-16 01:28:03'),
(41, '143.198.172.181', '2022-01-16 07:28:04am', 1, '2022-01-16 01:28:04', '2022-01-16 01:28:04'),
(42, '62.210.80.33', '2022-01-16 07:49:51am', 1, '2022-01-16 01:49:51', '2022-01-16 01:49:51'),
(43, '62.210.80.33', '2022-01-16 07:49:53am', 1, '2022-01-16 01:49:53', '2022-01-16 01:49:53'),
(44, '66.220.149.17', '2022-01-16 08:04:21am', 1, '2022-01-16 02:04:21', '2022-01-16 02:04:21'),
(45, '103.152.147.56', '2022-01-16 08:24:00am', 1, '2022-01-16 02:24:00', '2022-01-16 02:24:00'),
(46, '103.152.147.56', '2022-01-16 08:24:20am', 1, '2022-01-16 02:24:20', '2022-01-16 02:24:20'),
(47, '123.125.109.43', '2022-01-16 08:34:14am', 1, '2022-01-16 02:34:14', '2022-01-16 02:34:14'),
(48, '37.192.177.23', '2022-01-16 09:09:34am', 1, '2022-01-16 03:09:34', '2022-01-16 03:09:34'),
(49, '5.188.211.45', '2022-01-16 09:57:44am', 1, '2022-01-16 03:57:44', '2022-01-16 03:57:44'),
(50, '118.179.97.39', '2022-01-16 10:28:24am', 1, '2022-01-16 04:28:24', '2022-01-16 04:28:24'),
(51, '118.179.97.39', '2022-01-16 10:28:24am', 1, '2022-01-16 04:28:24', '2022-01-16 04:28:24'),
(52, '118.179.97.39', '2022-01-16 10:28:33am', 1, '2022-01-16 04:28:33', '2022-01-16 04:28:33'),
(53, '118.179.97.39', '2022-01-16 10:30:15am', 1, '2022-01-16 04:30:15', '2022-01-16 04:30:15'),
(54, '45.151.29.60', '2022-01-16 10:35:54am', 1, '2022-01-16 04:35:54', '2022-01-16 04:35:54'),
(55, '45.151.29.60', '2022-01-16 10:35:57am', 1, '2022-01-16 04:35:57', '2022-01-16 04:35:57'),
(56, '118.179.97.39', '2022-01-16 10:42:03am', 1, '2022-01-16 04:42:03', '2022-01-16 04:42:03'),
(57, '109.70.100.84', '2022-01-16 10:42:09am', 1, '2022-01-16 04:42:09', '2022-01-16 04:42:09'),
(58, '118.179.97.39', '2022-01-16 10:42:19am', 1, '2022-01-16 04:42:19', '2022-01-16 04:42:19'),
(59, '118.179.97.39', '2022-01-16 10:43:13am', 1, '2022-01-16 04:43:13', '2022-01-16 04:43:13'),
(60, '118.179.97.39', '2022-01-16 10:47:04am', 1, '2022-01-16 04:47:04', '2022-01-16 04:47:04'),
(61, '118.179.97.39', '2022-01-16 10:48:28am', 1, '2022-01-16 04:48:28', '2022-01-16 04:48:28'),
(62, '118.179.97.39', '2022-01-16 10:49:23am', 1, '2022-01-16 04:49:23', '2022-01-16 04:49:23'),
(63, '35.231.41.165', '2022-01-16 10:57:41am', 1, '2022-01-16 04:57:41', '2022-01-16 04:57:41'),
(64, '35.231.41.165', '2022-01-16 10:58:50am', 1, '2022-01-16 04:58:50', '2022-01-16 04:58:50'),
(65, '131.220.6.152', '2022-01-16 10:59:49am', 1, '2022-01-16 04:59:49', '2022-01-16 04:59:49'),
(66, '118.179.97.39', '2022-01-16 11:09:51am', 1, '2022-01-16 05:09:51', '2022-01-16 05:09:51'),
(67, '118.179.97.39', '2022-01-16 11:11:22am', 1, '2022-01-16 05:11:22', '2022-01-16 05:11:22'),
(68, '118.179.97.39', '2022-01-16 11:11:41am', 1, '2022-01-16 05:11:41', '2022-01-16 05:11:41'),
(69, '118.179.97.39', '2022-01-16 11:14:09am', 1, '2022-01-16 05:14:09', '2022-01-16 05:14:09'),
(70, '118.179.97.39', '2022-01-16 11:15:40am', 1, '2022-01-16 05:15:40', '2022-01-16 05:15:40'),
(71, '118.179.97.39', '2022-01-16 11:17:12am', 1, '2022-01-16 05:17:12', '2022-01-16 05:17:12'),
(72, '118.179.97.39', '2022-01-16 11:19:33am', 1, '2022-01-16 05:19:33', '2022-01-16 05:19:33'),
(73, '118.179.97.39', '2022-01-16 11:20:31am', 1, '2022-01-16 05:20:31', '2022-01-16 05:20:31'),
(74, '118.179.97.39', '2022-01-16 11:21:16am', 1, '2022-01-16 05:21:16', '2022-01-16 05:21:16'),
(75, '118.179.97.39', '2022-01-16 11:23:49am', 1, '2022-01-16 05:23:49', '2022-01-16 05:23:49'),
(76, '118.179.97.39', '2022-01-16 11:24:28am', 1, '2022-01-16 05:24:28', '2022-01-16 05:24:28'),
(77, '118.179.97.39', '2022-01-16 11:26:05am', 1, '2022-01-16 05:26:05', '2022-01-16 05:26:05'),
(78, '118.179.97.39', '2022-01-16 11:26:27am', 1, '2022-01-16 05:26:27', '2022-01-16 05:26:27'),
(79, '118.179.97.39', '2022-01-16 11:27:39am', 1, '2022-01-16 05:27:39', '2022-01-16 05:27:39'),
(80, '118.179.97.39', '2022-01-16 11:28:23am', 1, '2022-01-16 05:28:23', '2022-01-16 05:28:23'),
(81, '118.179.97.39', '2022-01-16 11:28:39am', 1, '2022-01-16 05:28:39', '2022-01-16 05:28:39'),
(82, '118.179.97.39', '2022-01-16 11:29:03am', 1, '2022-01-16 05:29:03', '2022-01-16 05:29:03'),
(83, '118.179.97.39', '2022-01-16 11:29:19am', 1, '2022-01-16 05:29:19', '2022-01-16 05:29:19'),
(84, '118.179.97.39', '2022-01-16 11:29:42am', 1, '2022-01-16 05:29:42', '2022-01-16 05:29:42'),
(85, '118.179.97.39', '2022-01-16 11:29:55am', 1, '2022-01-16 05:29:56', '2022-01-16 05:29:56'),
(86, '118.179.97.39', '2022-01-16 11:30:05am', 1, '2022-01-16 05:30:05', '2022-01-16 05:30:05'),
(87, '118.179.97.39', '2022-01-16 11:30:21am', 1, '2022-01-16 05:30:21', '2022-01-16 05:30:21'),
(88, '80.73.242.161', '2022-01-16 11:30:59am', 1, '2022-01-16 05:30:59', '2022-01-16 05:30:59'),
(89, '80.73.242.161', '2022-01-16 11:31:05am', 1, '2022-01-16 05:31:05', '2022-01-16 05:31:05'),
(90, '178.159.37.24', '2022-01-16 11:36:53am', 1, '2022-01-16 05:36:53', '2022-01-16 05:36:53'),
(91, '118.179.97.39', '2022-01-16 11:38:45am', 1, '2022-01-16 05:38:45', '2022-01-16 05:38:45'),
(92, '118.179.97.39', '2022-01-16 12:12:25pm', 1, '2022-01-16 06:12:25', '2022-01-16 06:12:25'),
(93, '118.179.97.39', '2022-01-16 12:12:57pm', 1, '2022-01-16 06:12:57', '2022-01-16 06:12:57'),
(94, '118.179.97.39', '2022-01-16 12:15:46pm', 1, '2022-01-16 06:15:46', '2022-01-16 06:15:46'),
(95, '118.179.97.39', '2022-01-16 12:20:16pm', 1, '2022-01-16 06:20:16', '2022-01-16 06:20:16'),
(96, '118.179.97.39', '2022-01-16 12:20:23pm', 1, '2022-01-16 06:20:23', '2022-01-16 06:20:23'),
(97, '118.179.97.39', '2022-01-16 12:20:27pm', 1, '2022-01-16 06:20:27', '2022-01-16 06:20:27'),
(98, '35.237.174.108', '2022-01-16 12:22:03pm', 1, '2022-01-16 06:22:03', '2022-01-16 06:22:03'),
(99, '118.179.97.39', '2022-01-16 12:33:25pm', 1, '2022-01-16 06:33:25', '2022-01-16 06:33:25'),
(100, '118.179.97.39', '2022-01-16 12:34:08pm', 1, '2022-01-16 06:34:08', '2022-01-16 06:34:08'),
(101, '118.179.97.39', '2022-01-16 12:35:29pm', 1, '2022-01-16 06:35:29', '2022-01-16 06:35:29'),
(102, '118.179.97.39', '2022-01-16 12:36:49pm', 1, '2022-01-16 06:36:49', '2022-01-16 06:36:49'),
(103, '118.179.97.39', '2022-01-16 12:39:15pm', 1, '2022-01-16 06:39:15', '2022-01-16 06:39:15'),
(104, '118.179.97.39', '2022-01-16 12:40:05pm', 1, '2022-01-16 06:40:05', '2022-01-16 06:40:05'),
(105, '118.179.97.39', '2022-01-16 12:41:03pm', 1, '2022-01-16 06:41:03', '2022-01-16 06:41:03'),
(106, '118.179.97.39', '2022-01-16 12:41:28pm', 1, '2022-01-16 06:41:28', '2022-01-16 06:41:28'),
(107, '118.179.97.39', '2022-01-16 12:43:44pm', 1, '2022-01-16 06:43:44', '2022-01-16 06:43:44'),
(108, '118.179.97.39', '2022-01-16 12:44:01pm', 1, '2022-01-16 06:44:01', '2022-01-16 06:44:01'),
(109, '118.179.97.39', '2022-01-16 12:44:12pm', 1, '2022-01-16 06:44:12', '2022-01-16 06:44:12'),
(110, '118.179.97.39', '2022-01-16 12:45:32pm', 1, '2022-01-16 06:45:32', '2022-01-16 06:45:32'),
(111, '118.179.97.39', '2022-01-16 12:46:23pm', 1, '2022-01-16 06:46:23', '2022-01-16 06:46:23'),
(112, '118.179.97.39', '2022-01-16 12:49:36pm', 1, '2022-01-16 06:49:36', '2022-01-16 06:49:36'),
(113, '118.179.97.39', '2022-01-16 12:50:10pm', 1, '2022-01-16 06:50:10', '2022-01-16 06:50:10'),
(114, '118.179.97.39', '2022-01-16 12:50:36pm', 1, '2022-01-16 06:50:36', '2022-01-16 06:50:36'),
(115, '118.179.97.39', '2022-01-16 12:51:51pm', 1, '2022-01-16 06:51:51', '2022-01-16 06:51:51'),
(116, '118.179.97.39', '2022-01-16 12:52:14pm', 1, '2022-01-16 06:52:14', '2022-01-16 06:52:14'),
(117, '118.179.97.39', '2022-01-16 12:53:47pm', 1, '2022-01-16 06:53:47', '2022-01-16 06:53:47'),
(118, '118.179.97.39', '2022-01-16 12:54:31pm', 1, '2022-01-16 06:54:31', '2022-01-16 06:54:31'),
(119, '118.179.97.39', '2022-01-16 12:54:43pm', 1, '2022-01-16 06:54:43', '2022-01-16 06:54:43'),
(120, '118.179.97.39', '2022-01-16 12:56:45pm', 1, '2022-01-16 06:56:46', '2022-01-16 06:56:46'),
(121, '118.179.97.39', '2022-01-16 12:57:04pm', 1, '2022-01-16 06:57:04', '2022-01-16 06:57:04'),
(122, '118.179.97.39', '2022-01-16 12:57:43pm', 1, '2022-01-16 06:57:43', '2022-01-16 06:57:43'),
(123, '118.179.97.39', '2022-01-16 12:58:52pm', 1, '2022-01-16 06:58:52', '2022-01-16 06:58:52'),
(124, '118.179.97.39', '2022-01-16 12:59:17pm', 1, '2022-01-16 06:59:17', '2022-01-16 06:59:17'),
(125, '118.179.97.39', '2022-01-16 01:00:18pm', 1, '2022-01-16 07:00:18', '2022-01-16 07:00:18'),
(126, '118.179.97.39', '2022-01-16 01:01:53pm', 1, '2022-01-16 07:01:53', '2022-01-16 07:01:53'),
(127, '118.179.97.39', '2022-01-16 01:02:28pm', 1, '2022-01-16 07:02:28', '2022-01-16 07:02:28'),
(128, '118.179.97.39', '2022-01-16 01:03:07pm', 1, '2022-01-16 07:03:07', '2022-01-16 07:03:07'),
(129, '118.179.97.39', '2022-01-16 01:04:10pm', 1, '2022-01-16 07:04:10', '2022-01-16 07:04:10'),
(130, '118.179.97.39', '2022-01-16 01:04:49pm', 1, '2022-01-16 07:04:49', '2022-01-16 07:04:49'),
(131, '118.179.97.39', '2022-01-16 01:06:20pm', 1, '2022-01-16 07:06:20', '2022-01-16 07:06:20'),
(132, '118.179.97.39', '2022-01-16 01:06:52pm', 1, '2022-01-16 07:06:52', '2022-01-16 07:06:52'),
(133, '118.179.97.39', '2022-01-16 01:07:40pm', 1, '2022-01-16 07:07:40', '2022-01-16 07:07:40'),
(134, '118.179.97.39', '2022-01-16 01:08:07pm', 1, '2022-01-16 07:08:07', '2022-01-16 07:08:07'),
(135, '118.179.97.39', '2022-01-16 01:08:25pm', 1, '2022-01-16 07:08:25', '2022-01-16 07:08:25'),
(136, '118.179.97.39', '2022-01-16 01:09:24pm', 1, '2022-01-16 07:09:24', '2022-01-16 07:09:24'),
(137, '118.179.97.39', '2022-01-16 01:10:01pm', 1, '2022-01-16 07:10:02', '2022-01-16 07:10:02'),
(138, '118.179.97.39', '2022-01-16 01:10:18pm', 1, '2022-01-16 07:10:18', '2022-01-16 07:10:18'),
(139, '118.179.97.39', '2022-01-16 01:11:05pm', 1, '2022-01-16 07:11:05', '2022-01-16 07:11:05'),
(140, '118.179.97.39', '2022-01-16 01:11:14pm', 1, '2022-01-16 07:11:14', '2022-01-16 07:11:14'),
(141, '118.179.97.39', '2022-01-16 01:13:22pm', 1, '2022-01-16 07:13:22', '2022-01-16 07:13:22'),
(142, '118.179.97.39', '2022-01-16 01:14:55pm', 1, '2022-01-16 07:14:55', '2022-01-16 07:14:55'),
(143, '118.179.97.39', '2022-01-16 01:16:57pm', 1, '2022-01-16 07:16:57', '2022-01-16 07:16:57'),
(144, '118.179.97.39', '2022-01-16 01:20:03pm', 1, '2022-01-16 07:20:03', '2022-01-16 07:20:03'),
(145, '118.179.97.39', '2022-01-16 01:20:28pm', 1, '2022-01-16 07:20:28', '2022-01-16 07:20:28'),
(146, '118.179.97.39', '2022-01-16 01:20:43pm', 1, '2022-01-16 07:20:43', '2022-01-16 07:20:43'),
(147, '118.179.97.39', '2022-01-16 01:20:59pm', 1, '2022-01-16 07:20:59', '2022-01-16 07:20:59'),
(148, '118.179.97.39', '2022-01-16 01:21:15pm', 1, '2022-01-16 07:21:15', '2022-01-16 07:21:15'),
(149, '118.179.97.39', '2022-01-16 01:21:37pm', 1, '2022-01-16 07:21:37', '2022-01-16 07:21:37'),
(150, '81.6.43.9', '2022-01-16 01:31:08pm', 1, '2022-01-16 07:31:08', '2022-01-16 07:31:08'),
(151, '118.179.97.39', '2022-01-16 01:37:00pm', 1, '2022-01-16 07:37:00', '2022-01-16 07:37:00'),
(152, '118.179.97.39', '2022-01-16 01:37:10pm', 1, '2022-01-16 07:37:10', '2022-01-16 07:37:10'),
(153, '118.179.97.39', '2022-01-16 01:37:27pm', 1, '2022-01-16 07:37:27', '2022-01-16 07:37:27'),
(154, '118.179.97.39', '2022-01-16 01:38:44pm', 1, '2022-01-16 07:38:44', '2022-01-16 07:38:44'),
(155, '118.179.97.39', '2022-01-16 01:40:43pm', 1, '2022-01-16 07:40:43', '2022-01-16 07:40:43'),
(156, '118.179.97.39', '2022-01-16 01:41:11pm', 1, '2022-01-16 07:41:11', '2022-01-16 07:41:11'),
(157, '118.179.97.39', '2022-01-16 01:41:33pm', 1, '2022-01-16 07:41:33', '2022-01-16 07:41:33'),
(158, '118.179.97.39', '2022-01-16 01:46:00pm', 1, '2022-01-16 07:46:00', '2022-01-16 07:46:00'),
(159, '118.179.97.39', '2022-01-16 01:46:22pm', 1, '2022-01-16 07:46:22', '2022-01-16 07:46:22'),
(160, '118.179.97.39', '2022-01-16 01:46:53pm', 1, '2022-01-16 07:46:53', '2022-01-16 07:46:53'),
(161, '118.179.97.39', '2022-01-16 01:47:16pm', 1, '2022-01-16 07:47:16', '2022-01-16 07:47:16'),
(162, '195.246.120.176', '2022-01-16 01:47:49pm', 1, '2022-01-16 07:47:49', '2022-01-16 07:47:49'),
(163, '118.179.97.39', '2022-01-16 01:47:51pm', 1, '2022-01-16 07:47:51', '2022-01-16 07:47:51'),
(164, '118.184.177.112', '2022-01-16 01:48:51pm', 1, '2022-01-16 07:48:51', '2022-01-16 07:48:51'),
(165, '118.179.97.39', '2022-01-16 01:49:16pm', 1, '2022-01-16 07:49:16', '2022-01-16 07:49:16'),
(166, '118.179.97.39', '2022-01-16 01:50:24pm', 1, '2022-01-16 07:50:24', '2022-01-16 07:50:24'),
(167, '118.179.97.39', '2022-01-16 01:51:02pm', 1, '2022-01-16 07:51:02', '2022-01-16 07:51:02'),
(168, '118.179.97.39', '2022-01-16 01:52:29pm', 1, '2022-01-16 07:52:29', '2022-01-16 07:52:29'),
(169, '118.179.97.39', '2022-01-16 01:53:34pm', 1, '2022-01-16 07:53:34', '2022-01-16 07:53:34'),
(170, '118.179.97.39', '2022-01-16 01:55:13pm', 1, '2022-01-16 07:55:13', '2022-01-16 07:55:13'),
(171, '118.179.97.39', '2022-01-16 01:56:12pm', 1, '2022-01-16 07:56:12', '2022-01-16 07:56:12'),
(172, '118.179.97.39', '2022-01-16 01:57:19pm', 1, '2022-01-16 07:57:19', '2022-01-16 07:57:19'),
(173, '118.179.97.39', '2022-01-16 01:58:06pm', 1, '2022-01-16 07:58:06', '2022-01-16 07:58:06'),
(174, '118.179.97.39', '2022-01-16 01:58:24pm', 1, '2022-01-16 07:58:24', '2022-01-16 07:58:24'),
(175, '118.179.97.39', '2022-01-16 01:59:13pm', 1, '2022-01-16 07:59:14', '2022-01-16 07:59:14'),
(176, '118.179.97.39', '2022-01-16 01:59:38pm', 1, '2022-01-16 07:59:38', '2022-01-16 07:59:38'),
(177, '118.179.97.39', '2022-01-16 02:01:02pm', 1, '2022-01-16 08:01:02', '2022-01-16 08:01:02'),
(178, '118.179.97.39', '2022-01-16 02:01:34pm', 1, '2022-01-16 08:01:34', '2022-01-16 08:01:34'),
(179, '118.179.97.39', '2022-01-16 02:02:04pm', 1, '2022-01-16 08:02:04', '2022-01-16 08:02:04'),
(180, '118.179.97.39', '2022-01-16 02:02:23pm', 1, '2022-01-16 08:02:23', '2022-01-16 08:02:23'),
(181, '118.179.97.39', '2022-01-16 02:02:45pm', 1, '2022-01-16 08:02:45', '2022-01-16 08:02:45'),
(182, '118.179.97.39', '2022-01-16 02:03:20pm', 1, '2022-01-16 08:03:20', '2022-01-16 08:03:20'),
(183, '118.179.97.39', '2022-01-16 02:22:27pm', 1, '2022-01-16 08:22:27', '2022-01-16 08:22:27'),
(184, '118.179.97.39', '2022-01-16 02:22:38pm', 1, '2022-01-16 08:22:38', '2022-01-16 08:22:38'),
(185, '118.179.97.39', '2022-01-16 02:23:50pm', 1, '2022-01-16 08:23:50', '2022-01-16 08:23:50'),
(186, '118.179.97.39', '2022-01-16 02:23:51pm', 1, '2022-01-16 08:23:51', '2022-01-16 08:23:51'),
(187, '118.179.97.39', '2022-01-16 02:25:03pm', 1, '2022-01-16 08:25:03', '2022-01-16 08:25:03'),
(188, '118.179.97.39', '2022-01-16 02:25:04pm', 1, '2022-01-16 08:25:04', '2022-01-16 08:25:04'),
(189, '118.179.97.39', '2022-01-16 02:25:04pm', 1, '2022-01-16 08:25:04', '2022-01-16 08:25:04'),
(190, '188.214.122.36', '2022-01-16 02:29:45pm', 1, '2022-01-16 08:29:45', '2022-01-16 08:29:45'),
(191, '118.179.97.39', '2022-01-16 02:36:09pm', 1, '2022-01-16 08:36:09', '2022-01-16 08:36:09'),
(192, '118.179.97.39', '2022-01-16 02:39:07pm', 1, '2022-01-16 08:39:08', '2022-01-16 08:39:08'),
(193, '118.179.97.39', '2022-01-16 02:39:31pm', 1, '2022-01-16 08:39:31', '2022-01-16 08:39:31'),
(194, '118.179.97.39', '2022-01-16 02:40:27pm', 1, '2022-01-16 08:40:27', '2022-01-16 08:40:27'),
(195, '118.179.97.39', '2022-01-16 02:41:32pm', 1, '2022-01-16 08:41:32', '2022-01-16 08:41:32'),
(196, '118.179.97.39', '2022-01-16 02:42:37pm', 1, '2022-01-16 08:42:37', '2022-01-16 08:42:37'),
(197, '118.179.97.39', '2022-01-16 02:44:27pm', 1, '2022-01-16 08:44:27', '2022-01-16 08:44:27'),
(198, '118.179.97.39', '2022-01-16 02:45:00pm', 1, '2022-01-16 08:45:00', '2022-01-16 08:45:00'),
(199, '118.179.97.39', '2022-01-16 02:45:39pm', 1, '2022-01-16 08:45:39', '2022-01-16 08:45:39'),
(200, '118.179.97.39', '2022-01-16 02:45:56pm', 1, '2022-01-16 08:45:56', '2022-01-16 08:45:56'),
(201, '118.179.97.39', '2022-01-16 02:47:39pm', 1, '2022-01-16 08:47:39', '2022-01-16 08:47:39'),
(202, '118.179.97.39', '2022-01-16 02:52:43pm', 1, '2022-01-16 08:52:43', '2022-01-16 08:52:43'),
(203, '118.179.97.39', '2022-01-16 02:53:32pm', 1, '2022-01-16 08:53:32', '2022-01-16 08:53:32'),
(204, '118.179.97.39', '2022-01-16 02:53:57pm', 1, '2022-01-16 08:53:57', '2022-01-16 08:53:57'),
(205, '118.179.97.39', '2022-01-16 02:54:06pm', 1, '2022-01-16 08:54:06', '2022-01-16 08:54:06'),
(206, '118.179.97.39', '2022-01-16 02:54:14pm', 1, '2022-01-16 08:54:14', '2022-01-16 08:54:14'),
(207, '118.179.97.39', '2022-01-16 02:54:21pm', 1, '2022-01-16 08:54:21', '2022-01-16 08:54:21'),
(208, '118.179.97.39', '2022-01-16 02:54:39pm', 1, '2022-01-16 08:54:39', '2022-01-16 08:54:39'),
(209, '118.179.97.39', '2022-01-16 02:54:42pm', 1, '2022-01-16 08:54:42', '2022-01-16 08:54:42'),
(210, '118.179.97.39', '2022-01-16 02:54:55pm', 1, '2022-01-16 08:54:55', '2022-01-16 08:54:55'),
(211, '118.179.97.39', '2022-01-16 02:55:30pm', 1, '2022-01-16 08:55:30', '2022-01-16 08:55:30'),
(212, '118.179.97.39', '2022-01-16 02:55:46pm', 1, '2022-01-16 08:55:46', '2022-01-16 08:55:46'),
(213, '118.179.97.39', '2022-01-16 02:56:02pm', 1, '2022-01-16 08:56:02', '2022-01-16 08:56:02'),
(214, '118.179.97.39', '2022-01-16 02:56:15pm', 1, '2022-01-16 08:56:15', '2022-01-16 08:56:15'),
(215, '118.179.97.39', '2022-01-16 02:56:39pm', 1, '2022-01-16 08:56:39', '2022-01-16 08:56:39'),
(216, '118.179.97.39', '2022-01-16 02:56:51pm', 1, '2022-01-16 08:56:51', '2022-01-16 08:56:51'),
(217, '118.179.97.39', '2022-01-16 02:56:56pm', 1, '2022-01-16 08:56:56', '2022-01-16 08:56:56'),
(218, '118.179.97.39', '2022-01-16 02:57:01pm', 1, '2022-01-16 08:57:01', '2022-01-16 08:57:01'),
(219, '118.179.97.39', '2022-01-16 02:57:38pm', 1, '2022-01-16 08:57:38', '2022-01-16 08:57:38'),
(220, '118.179.97.39', '2022-01-16 02:57:44pm', 1, '2022-01-16 08:57:44', '2022-01-16 08:57:44'),
(221, '118.179.97.39', '2022-01-16 02:58:07pm', 1, '2022-01-16 08:58:07', '2022-01-16 08:58:07'),
(222, '118.179.97.39', '2022-01-16 02:58:26pm', 1, '2022-01-16 08:58:26', '2022-01-16 08:58:26'),
(223, '118.179.97.39', '2022-01-16 02:58:47pm', 1, '2022-01-16 08:58:47', '2022-01-16 08:58:47'),
(224, '118.179.97.39', '2022-01-16 03:01:27pm', 1, '2022-01-16 09:01:27', '2022-01-16 09:01:27'),
(225, '118.179.97.39', '2022-01-16 03:01:35pm', 1, '2022-01-16 09:01:35', '2022-01-16 09:01:35'),
(226, '118.179.97.39', '2022-01-16 03:01:44pm', 1, '2022-01-16 09:01:44', '2022-01-16 09:01:44'),
(227, '118.179.97.39', '2022-01-16 03:02:00pm', 1, '2022-01-16 09:02:00', '2022-01-16 09:02:00'),
(228, '118.179.97.39', '2022-01-16 03:02:30pm', 1, '2022-01-16 09:02:30', '2022-01-16 09:02:30'),
(229, '118.179.97.39', '2022-01-16 03:02:53pm', 1, '2022-01-16 09:02:53', '2022-01-16 09:02:53'),
(230, '118.179.97.39', '2022-01-16 03:02:57pm', 1, '2022-01-16 09:02:57', '2022-01-16 09:02:57'),
(231, '118.179.97.39', '2022-01-16 03:04:57pm', 1, '2022-01-16 09:04:57', '2022-01-16 09:04:57'),
(232, '118.179.97.39', '2022-01-16 03:05:18pm', 1, '2022-01-16 09:05:18', '2022-01-16 09:05:18'),
(233, '118.179.97.39', '2022-01-16 03:05:28pm', 1, '2022-01-16 09:05:28', '2022-01-16 09:05:28'),
(234, '118.179.97.39', '2022-01-16 03:05:36pm', 1, '2022-01-16 09:05:36', '2022-01-16 09:05:36'),
(235, '118.179.97.39', '2022-01-16 03:06:18pm', 1, '2022-01-16 09:06:18', '2022-01-16 09:06:18'),
(236, '118.179.97.39', '2022-01-16 03:06:36pm', 1, '2022-01-16 09:06:36', '2022-01-16 09:06:36'),
(237, '118.179.97.39', '2022-01-16 03:07:08pm', 1, '2022-01-16 09:07:08', '2022-01-16 09:07:08'),
(238, '118.179.97.39', '2022-01-16 03:08:22pm', 1, '2022-01-16 09:08:22', '2022-01-16 09:08:22'),
(239, '118.179.97.39', '2022-01-16 03:47:33pm', 1, '2022-01-16 09:47:33', '2022-01-16 09:47:33'),
(240, '80.73.242.161', '2022-01-16 03:49:43pm', 1, '2022-01-16 09:49:43', '2022-01-16 09:49:43'),
(241, '80.73.242.161', '2022-01-16 03:49:46pm', 1, '2022-01-16 09:49:46', '2022-01-16 09:49:46'),
(242, '118.179.97.39', '2022-01-16 03:59:53pm', 1, '2022-01-16 09:59:53', '2022-01-16 09:59:53'),
(243, '212.193.142.193', '2022-01-16 04:09:14pm', 1, '2022-01-16 10:09:14', '2022-01-16 10:09:14'),
(244, '212.193.142.193', '2022-01-16 04:09:17pm', 1, '2022-01-16 10:09:17', '2022-01-16 10:09:17'),
(245, '66.249.68.35', '2022-01-16 04:11:22pm', 1, '2022-01-16 10:11:22', '2022-01-16 10:11:22'),
(246, '95.152.50.222', '2022-01-16 04:16:54pm', 1, '2022-01-16 10:16:54', '2022-01-16 10:16:54'),
(247, '95.152.50.222', '2022-01-16 04:17:06pm', 1, '2022-01-16 10:17:06', '2022-01-16 10:17:06'),
(248, '95.152.50.222', '2022-01-16 04:17:07pm', 1, '2022-01-16 10:17:07', '2022-01-16 10:17:07'),
(249, '46.116.186.50', '2022-01-16 04:32:07pm', 1, '2022-01-16 10:32:07', '2022-01-16 10:32:07'),
(250, '46.116.186.50', '2022-01-16 04:32:11pm', 1, '2022-01-16 10:32:11', '2022-01-16 10:32:11'),
(251, '118.179.97.39', '2022-01-16 04:38:00pm', 1, '2022-01-16 10:38:00', '2022-01-16 10:38:00'),
(252, '118.179.97.39', '2022-01-16 04:38:47pm', 1, '2022-01-16 10:38:47', '2022-01-16 10:38:47'),
(253, '118.179.97.39', '2022-01-16 04:39:15pm', 1, '2022-01-16 10:39:15', '2022-01-16 10:39:15'),
(254, '118.179.97.39', '2022-01-16 04:39:49pm', 1, '2022-01-16 10:39:49', '2022-01-16 10:39:49'),
(255, '118.179.97.39', '2022-01-16 04:40:06pm', 1, '2022-01-16 10:40:06', '2022-01-16 10:40:06'),
(256, '52.114.32.212', '2022-01-16 04:40:22pm', 1, '2022-01-16 10:40:22', '2022-01-16 10:40:22'),
(257, '66.249.68.35', '2022-01-16 04:53:24pm', 1, '2022-01-16 10:53:24', '2022-01-16 10:53:24'),
(258, '66.249.68.39', '2022-01-16 05:07:28pm', 1, '2022-01-16 11:07:28', '2022-01-16 11:07:28'),
(259, '185.190.42.200', '2022-01-16 05:24:53pm', 1, '2022-01-16 11:24:53', '2022-01-16 11:24:53'),
(260, '92.118.160.37', '2022-01-16 05:29:02pm', 1, '2022-01-16 11:29:02', '2022-01-16 11:29:02'),
(261, '123.125.109.43', '2022-01-16 05:32:29pm', 1, '2022-01-16 11:32:29', '2022-01-16 11:32:29'),
(262, '212.193.142.193', '2022-01-16 05:54:30pm', 1, '2022-01-16 11:54:30', '2022-01-16 11:54:30'),
(263, '212.193.142.193', '2022-01-16 05:54:33pm', 1, '2022-01-16 11:54:33', '2022-01-16 11:54:33'),
(264, '92.118.160.5', '2022-01-16 05:59:08pm', 1, '2022-01-16 11:59:08', '2022-01-16 11:59:08'),
(265, '116.206.228.70', '2022-01-16 06:14:18pm', 1, '2022-01-16 12:14:18', '2022-01-16 12:14:18'),
(266, '116.206.228.70', '2022-01-16 06:14:18pm', 1, '2022-01-16 12:14:18', '2022-01-16 12:14:18'),
(267, '116.206.228.70', '2022-01-16 06:14:19pm', 1, '2022-01-16 12:14:19', '2022-01-16 12:14:19'),
(268, '68.183.225.134', '2022-01-16 06:17:25pm', 1, '2022-01-16 12:17:25', '2022-01-16 12:17:25'),
(269, '68.183.225.134', '2022-01-16 06:17:25pm', 1, '2022-01-16 12:17:25', '2022-01-16 12:17:25'),
(270, '68.183.225.134', '2022-01-16 06:17:26pm', 1, '2022-01-16 12:17:26', '2022-01-16 12:17:26'),
(271, '80.73.242.161', '2022-01-16 06:28:10pm', 1, '2022-01-16 12:28:10', '2022-01-16 12:28:10'),
(272, '80.73.242.161', '2022-01-16 06:28:13pm', 1, '2022-01-16 12:28:13', '2022-01-16 12:28:13'),
(273, '60.190.52.6', '2022-01-16 07:06:51pm', 1, '2022-01-16 13:06:51', '2022-01-16 13:06:51'),
(274, '60.190.52.6', '2022-01-16 07:08:10pm', 1, '2022-01-16 13:08:10', '2022-01-16 13:08:10'),
(275, '60.190.52.6', '2022-01-16 07:10:19pm', 1, '2022-01-16 13:10:19', '2022-01-16 13:10:19'),
(276, '60.190.52.6', '2022-01-16 07:11:16pm', 1, '2022-01-16 13:11:16', '2022-01-16 13:11:16'),
(277, '178.184.31.23', '2022-01-16 07:27:11pm', 1, '2022-01-16 13:27:11', '2022-01-16 13:27:11'),
(278, '103.25.251.238', '2022-01-16 07:45:28pm', 1, '2022-01-16 13:45:28', '2022-01-16 13:45:28'),
(279, '103.25.251.238', '2022-01-16 07:48:08pm', 1, '2022-01-16 13:48:08', '2022-01-16 13:48:08'),
(280, '103.25.251.238', '2022-01-16 07:49:52pm', 1, '2022-01-16 13:49:52', '2022-01-16 13:49:52'),
(281, '178.34.163.208', '2022-01-16 08:17:26pm', 1, '2022-01-16 14:17:26', '2022-01-16 14:17:26'),
(282, '103.199.87.206', '2022-01-16 08:20:49pm', 1, '2022-01-16 14:20:49', '2022-01-16 14:20:49'),
(283, '103.199.87.206', '2022-01-16 08:22:31pm', 1, '2022-01-16 14:22:31', '2022-01-16 14:22:31'),
(284, '92.118.160.61', '2022-01-16 08:27:49pm', 1, '2022-01-16 14:27:49', '2022-01-16 14:27:49'),
(285, '60.190.52.6', '2022-01-16 08:50:07pm', 1, '2022-01-16 14:50:07', '2022-01-16 14:50:07'),
(286, '178.128.25.106', '2022-01-16 09:20:11pm', 1, '2022-01-16 15:20:11', '2022-01-16 15:20:11'),
(287, '178.128.25.106', '2022-01-16 09:20:11pm', 1, '2022-01-16 15:20:11', '2022-01-16 15:20:11'),
(288, '178.128.25.106', '2022-01-16 09:20:12pm', 1, '2022-01-16 15:20:12', '2022-01-16 15:20:12'),
(289, '193.169.253.97', '2022-01-16 09:44:58pm', 1, '2022-01-16 15:44:58', '2022-01-16 15:44:58'),
(290, '103.135.252.95', '2022-01-16 10:32:31pm', 1, '2022-01-16 16:32:31', '2022-01-16 16:32:31'),
(291, '69.171.231.118', '2022-01-16 10:37:26pm', 1, '2022-01-16 16:37:26', '2022-01-16 16:37:26'),
(292, '69.171.231.117', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(293, '69.171.231.4', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(294, '69.171.231.5', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(295, '69.171.231.118', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(296, '69.171.231.120', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(297, '69.171.231.119', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(298, '69.171.231.116', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:27', '2022-01-16 16:37:27'),
(299, '69.171.231.118', '2022-01-16 10:37:27pm', 1, '2022-01-16 16:37:28', '2022-01-16 16:37:28'),
(300, '91.108.177.18', '2022-01-16 11:02:13pm', 1, '2022-01-16 17:02:13', '2022-01-16 17:02:13'),
(301, '83.138.48.225', '2022-01-16 11:53:55pm', 1, '2022-01-16 17:53:55', '2022-01-16 17:53:55'),
(302, '83.138.48.225', '2022-01-16 11:54:01pm', 1, '2022-01-16 17:54:01', '2022-01-16 17:54:01'),
(303, '185.119.81.109', '2022-01-17 12:43:25am', 1, '2022-01-16 18:43:25', '2022-01-16 18:43:25'),
(304, '185.119.81.109', '2022-01-17 12:43:34am', 1, '2022-01-16 18:43:34', '2022-01-16 18:43:34'),
(305, '185.119.81.109', '2022-01-17 12:44:13am', 1, '2022-01-16 18:44:13', '2022-01-16 18:44:13'),
(306, '185.119.81.109', '2022-01-17 12:44:22am', 1, '2022-01-16 18:44:22', '2022-01-16 18:44:22'),
(307, '185.119.81.109', '2022-01-17 12:44:31am', 1, '2022-01-16 18:44:31', '2022-01-16 18:44:31'),
(308, '66.249.68.41', '2022-01-17 01:17:10am', 1, '2022-01-16 19:17:10', '2022-01-16 19:17:10'),
(309, '66.249.68.39', '2022-01-17 02:14:14am', 1, '2022-01-16 20:14:14', '2022-01-16 20:14:14'),
(310, '185.220.101.190', '2022-01-17 02:40:29am', 1, '2022-01-16 20:40:29', '2022-01-16 20:40:29'),
(311, '173.231.60.195', '2022-01-17 04:02:33am', 1, '2022-01-16 22:02:33', '2022-01-16 22:02:33'),
(312, '137.184.55.166', '2022-01-17 04:32:36am', 1, '2022-01-16 22:32:36', '2022-01-16 22:32:36'),
(313, '137.184.55.166', '2022-01-17 04:32:36am', 1, '2022-01-16 22:32:36', '2022-01-16 22:32:36'),
(314, '137.184.55.166', '2022-01-17 04:32:37am', 1, '2022-01-16 22:32:37', '2022-01-16 22:32:37'),
(315, '89.113.98.251', '2022-01-17 05:09:32am', 1, '2022-01-16 23:09:32', '2022-01-16 23:09:32'),
(316, '89.113.98.251', '2022-01-17 05:09:51am', 1, '2022-01-16 23:09:51', '2022-01-16 23:09:51'),
(317, '176.48.86.189', '2022-01-17 05:33:21am', 1, '2022-01-16 23:33:21', '2022-01-16 23:33:21'),
(318, '167.94.138.113', '2022-01-17 06:05:28am', 1, '2022-01-17 00:05:28', '2022-01-17 00:05:28'),
(319, '167.94.138.113', '2022-01-17 06:05:28am', 1, '2022-01-17 00:05:28', '2022-01-17 00:05:28'),
(320, '87.250.224.11', '2022-01-17 06:28:46am', 1, '2022-01-17 00:28:46', '2022-01-17 00:28:46'),
(321, '66.249.79.11', '2022-01-17 06:34:58am', 1, '2022-01-17 00:34:58', '2022-01-17 00:34:58'),
(322, '200.12.37.170', '2022-01-17 07:13:33am', 1, '2022-01-17 01:13:33', '2022-01-17 01:13:33'),
(323, '103.135.252.95', '2022-01-17 07:56:04am', 1, '2022-01-17 01:56:04', '2022-01-17 01:56:04'),
(324, '195.123.209.118', '2022-01-17 08:20:39am', 1, '2022-01-17 02:20:39', '2022-01-17 02:20:39'),
(325, '195.123.209.118', '2022-01-17 08:20:39am', 1, '2022-01-17 02:20:39', '2022-01-17 02:20:39'),
(326, '195.123.209.118', '2022-01-17 08:20:40am', 1, '2022-01-17 02:20:40', '2022-01-17 02:20:40'),
(327, '49.7.20.105', '2022-01-17 08:58:54am', 1, '2022-01-17 02:58:54', '2022-01-17 02:58:54'),
(328, '83.138.48.225', '2022-01-17 08:59:40am', 1, '2022-01-17 02:59:40', '2022-01-17 02:59:40'),
(329, '83.138.48.225', '2022-01-17 08:59:43am', 1, '2022-01-17 02:59:43', '2022-01-17 02:59:43'),
(330, '84.17.48.186', '2022-01-17 09:08:39am', 1, '2022-01-17 03:08:39', '2022-01-17 03:08:39'),
(331, '37.192.177.23', '2022-01-17 10:25:14am', 1, '2022-01-17 04:25:14', '2022-01-17 04:25:14'),
(332, '131.220.6.152', '2022-01-17 10:58:17am', 1, '2022-01-17 04:58:17', '2022-01-17 04:58:17'),
(333, '103.148.176.150', '2022-01-17 10:58:25am', 1, '2022-01-17 04:58:25', '2022-01-17 04:58:25'),
(334, '66.249.68.41', '2022-01-17 11:05:38am', 1, '2022-01-17 05:05:38', '2022-01-17 05:05:38'),
(335, '118.179.97.39', '2022-01-17 11:25:45am', 1, '2022-01-17 05:25:45', '2022-01-17 05:25:45'),
(336, '150.129.44.156', '2022-01-17 11:46:24am', 1, '2022-01-17 05:46:24', '2022-01-17 05:46:24'),
(337, '58.250.125.134', '2022-01-17 12:42:16pm', 1, '2022-01-17 06:42:16', '2022-01-17 06:42:16'),
(338, '118.179.97.39', '2022-01-17 12:45:00pm', 1, '2022-01-17 06:45:00', '2022-01-17 06:45:00'),
(339, '154.51.131.142', '2022-01-17 12:48:07pm', 1, '2022-01-17 06:48:07', '2022-01-17 06:48:07'),
(340, '118.179.97.39', '2022-01-17 12:50:26pm', 1, '2022-01-17 06:50:26', '2022-01-17 06:50:26'),
(341, '118.179.97.39', '2022-01-17 12:55:18pm', 1, '2022-01-17 06:55:18', '2022-01-17 06:55:18'),
(342, '118.179.97.39', '2022-01-17 12:57:47pm', 1, '2022-01-17 06:57:47', '2022-01-17 06:57:47'),
(343, '118.179.97.39', '2022-01-17 12:59:13pm', 1, '2022-01-17 06:59:13', '2022-01-17 06:59:13'),
(344, '118.179.97.39', '2022-01-17 01:00:09pm', 1, '2022-01-17 07:00:09', '2022-01-17 07:00:09'),
(345, '118.179.97.39', '2022-01-17 01:01:05pm', 1, '2022-01-17 07:01:05', '2022-01-17 07:01:05'),
(346, '35.217.23.45', '2022-01-17 01:09:17pm', 1, '2022-01-17 07:09:17', '2022-01-17 07:09:17'),
(347, '18.237.246.222', '2022-01-17 01:09:20pm', 1, '2022-01-17 07:09:20', '2022-01-17 07:09:20'),
(348, '18.237.246.222', '2022-01-17 01:09:22pm', 1, '2022-01-17 07:09:22', '2022-01-17 07:09:22'),
(349, '52.114.32.212', '2022-01-17 01:20:22pm', 1, '2022-01-17 07:20:22', '2022-01-17 07:20:22'),
(350, '3.26.94.228', '2022-01-17 01:22:30pm', 1, '2022-01-17 07:22:30', '2022-01-17 07:22:30'),
(351, '49.7.20.105', '2022-01-17 01:48:49pm', 1, '2022-01-17 07:48:49', '2022-01-17 07:48:49'),
(352, '54.69.5.153', '2022-01-17 02:01:48pm', 1, '2022-01-17 08:01:48', '2022-01-17 08:01:48'),
(353, '60.190.52.6', '2022-01-17 02:02:48pm', 1, '2022-01-17 08:02:48', '2022-01-17 08:02:48'),
(354, '60.190.52.6', '2022-01-17 02:03:08pm', 1, '2022-01-17 08:03:08', '2022-01-17 08:03:08'),
(355, '49.7.20.105', '2022-01-17 02:21:27pm', 1, '2022-01-17 08:21:27', '2022-01-17 08:21:27'),
(356, '220.152.113.22', '2022-01-17 02:40:30pm', 1, '2022-01-17 08:40:30', '2022-01-17 08:40:30'),
(357, '220.152.113.22', '2022-01-17 02:41:08pm', 1, '2022-01-17 08:41:08', '2022-01-17 08:41:08'),
(358, '49.7.20.105', '2022-01-17 02:53:53pm', 1, '2022-01-17 08:53:53', '2022-01-17 08:53:53'),
(359, '118.179.97.39', '2022-01-17 03:13:55pm', 1, '2022-01-17 09:13:55', '2022-01-17 09:13:55'),
(360, '118.179.97.39', '2022-01-17 03:15:40pm', 1, '2022-01-17 09:15:40', '2022-01-17 09:15:40'),
(361, '49.7.20.105', '2022-01-17 03:29:32pm', 1, '2022-01-17 09:29:32', '2022-01-17 09:29:32'),
(362, '205.134.241.74', '2022-01-17 03:30:24pm', 1, '2022-01-17 09:30:24', '2022-01-17 09:30:24'),
(363, '178.184.11.20', '2022-01-17 03:36:40pm', 1, '2022-01-17 09:36:40', '2022-01-17 09:36:40'),
(364, '46.185.7.250', '2022-01-17 03:42:16pm', 1, '2022-01-17 09:42:16', '2022-01-17 09:42:16'),
(365, '46.185.7.250', '2022-01-17 03:42:17pm', 1, '2022-01-17 09:42:17', '2022-01-17 09:42:17'),
(366, '46.185.7.250', '2022-01-17 03:42:18pm', 1, '2022-01-17 09:42:18', '2022-01-17 09:42:18'),
(367, '52.91.229.109', '2022-01-17 03:44:24pm', 1, '2022-01-17 09:44:24', '2022-01-17 09:44:24'),
(368, '49.7.20.105', '2022-01-17 04:00:19pm', 1, '2022-01-17 10:00:19', '2022-01-17 10:00:19'),
(369, '45.129.18.143', '2022-01-17 04:04:53pm', 1, '2022-01-17 10:04:53', '2022-01-17 10:04:53'),
(370, '192.29.97.49', '2022-01-17 04:27:04pm', 1, '2022-01-17 10:27:04', '2022-01-17 10:27:04'),
(371, '37.115.112.150', '2022-01-17 04:31:04pm', 1, '2022-01-17 10:31:04', '2022-01-17 10:31:04'),
(372, '220.152.113.19', '2022-01-17 04:43:46pm', 1, '2022-01-17 10:43:46', '2022-01-17 10:43:46'),
(373, '114.119.128.202', '2022-01-17 05:23:16pm', 1, '2022-01-17 11:23:16', '2022-01-17 11:23:16'),
(374, '49.7.20.105', '2022-01-17 06:12:32pm', 1, '2022-01-17 12:12:32', '2022-01-17 12:12:32'),
(375, '49.7.20.105', '2022-01-17 06:52:29pm', 1, '2022-01-17 12:52:29', '2022-01-17 12:52:29'),
(376, '66.249.79.15', '2022-01-17 07:02:42pm', 1, '2022-01-17 13:02:42', '2022-01-17 13:02:42'),
(377, '49.7.20.105', '2022-01-17 07:28:14pm', 1, '2022-01-17 13:28:14', '2022-01-17 13:28:14'),
(378, '49.7.20.105', '2022-01-17 08:00:14pm', 1, '2022-01-17 14:00:14', '2022-01-17 14:00:14'),
(379, '198.27.103.177', '2022-01-17 08:17:11pm', 1, '2022-01-17 14:17:11', '2022-01-17 14:17:11'),
(380, '138.246.253.5', '2022-01-17 08:17:31pm', 1, '2022-01-17 14:17:31', '2022-01-17 14:17:31'),
(381, '49.7.20.105', '2022-01-17 08:32:03pm', 1, '2022-01-17 14:32:03', '2022-01-17 14:32:03'),
(382, '49.7.20.105', '2022-01-17 09:01:16pm', 1, '2022-01-17 15:01:16', '2022-01-17 15:01:16'),
(383, '185.158.115.77', '2022-01-17 09:32:56pm', 1, '2022-01-17 15:32:56', '2022-01-17 15:32:56'),
(384, '66.249.68.39', '2022-01-17 10:09:15pm', 1, '2022-01-17 16:09:15', '2022-01-17 16:09:15'),
(385, '5.248.227.205', '2022-01-17 10:16:25pm', 1, '2022-01-17 16:16:25', '2022-01-17 16:16:25'),
(386, '5.248.227.205', '2022-01-17 10:16:26pm', 1, '2022-01-17 16:16:26', '2022-01-17 16:16:26'),
(387, '5.248.227.205', '2022-01-17 10:16:27pm', 1, '2022-01-17 16:16:27', '2022-01-17 16:16:27'),
(388, '66.249.68.39', '2022-01-17 10:34:59pm', 1, '2022-01-17 16:34:59', '2022-01-17 16:34:59'),
(389, '173.252.127.43', '2022-01-17 11:24:26pm', 1, '2022-01-17 17:24:26', '2022-01-17 17:24:26'),
(390, '31.13.115.1', '2022-01-17 11:24:26pm', 1, '2022-01-17 17:24:26', '2022-01-17 17:24:26'),
(391, '173.252.95.3', '2022-01-17 11:24:26pm', 1, '2022-01-17 17:24:26', '2022-01-17 17:24:26'),
(392, '195.246.120.176', '2022-01-17 11:24:51pm', 1, '2022-01-17 17:24:51', '2022-01-17 17:24:51'),
(393, '69.63.184.4', '2022-01-17 11:25:02pm', 1, '2022-01-17 17:25:02', '2022-01-17 17:25:02'),
(394, '69.63.184.11', '2022-01-17 11:25:02pm', 1, '2022-01-17 17:25:02', '2022-01-17 17:25:02'),
(395, '69.171.251.5', '2022-01-17 11:25:04pm', 1, '2022-01-17 17:25:05', '2022-01-17 17:25:05'),
(396, '216.107.129.109', '2022-01-17 11:26:49pm', 1, '2022-01-17 17:26:49', '2022-01-17 17:26:49'),
(397, '118.179.40.209', '2022-01-17 11:27:32pm', 1, '2022-01-17 17:27:32', '2022-01-17 17:27:32'),
(398, '118.179.40.209', '2022-01-17 11:27:39pm', 1, '2022-01-17 17:27:39', '2022-01-17 17:27:39'),
(399, '118.179.40.209', '2022-01-17 11:35:45pm', 1, '2022-01-17 17:35:45', '2022-01-17 17:35:45'),
(400, '118.179.40.209', '2022-01-17 11:35:50pm', 1, '2022-01-17 17:35:50', '2022-01-17 17:35:50'),
(401, '118.179.40.209', '2022-01-17 11:37:34pm', 1, '2022-01-17 17:37:34', '2022-01-17 17:37:34'),
(402, '118.179.40.209', '2022-01-17 11:40:26pm', 1, '2022-01-17 17:40:26', '2022-01-17 17:40:26'),
(403, '143.92.56.239', '2022-01-17 11:42:53pm', 1, '2022-01-17 17:42:53', '2022-01-17 17:42:53'),
(404, '68.183.176.231', '2022-01-17 11:46:51pm', 1, '2022-01-17 17:46:51', '2022-01-17 17:46:51'),
(405, '68.183.176.231', '2022-01-17 11:46:51pm', 1, '2022-01-17 17:46:51', '2022-01-17 17:46:51'),
(406, '68.183.176.231', '2022-01-17 11:46:52pm', 1, '2022-01-17 17:46:52', '2022-01-17 17:46:52'),
(407, '176.48.12.114', '2022-01-17 11:50:22pm', 1, '2022-01-17 17:50:22', '2022-01-17 17:50:22'),
(408, '185.191.171.43', '2022-01-17 11:55:21pm', 1, '2022-01-17 17:55:21', '2022-01-17 17:55:21'),
(409, '128.199.210.247', '2022-01-18 12:18:12am', 1, '2022-01-17 18:18:12', '2022-01-17 18:18:12'),
(410, '128.199.210.247', '2022-01-18 12:18:12am', 1, '2022-01-17 18:18:12', '2022-01-17 18:18:12'),
(411, '128.199.210.247', '2022-01-18 12:18:13am', 1, '2022-01-17 18:18:13', '2022-01-17 18:18:13'),
(412, '34.86.35.21', '2022-01-18 01:21:37am', 1, '2022-01-17 19:21:37', '2022-01-17 19:21:37'),
(413, '77.75.79.119', '2022-01-18 01:42:25am', 1, '2022-01-17 19:42:25', '2022-01-17 19:42:25'),
(414, '138.246.253.5', '2022-01-18 02:19:19am', 1, '2022-01-17 20:19:19', '2022-01-17 20:19:19'),
(415, '173.252.87.117', '2022-01-18 02:42:44am', 1, '2022-01-17 20:42:44', '2022-01-17 20:42:44'),
(416, '173.252.87.23', '2022-01-18 02:42:44am', 1, '2022-01-17 20:42:44', '2022-01-17 20:42:44'),
(417, '5.135.137.50', '2022-01-18 03:41:12am', 1, '2022-01-17 21:41:12', '2022-01-17 21:41:12'),
(418, '138.201.60.47', '2022-01-18 03:51:57am', 1, '2022-01-17 21:51:57', '2022-01-17 21:51:57'),
(419, '5.135.137.50', '2022-01-18 04:05:24am', 1, '2022-01-17 22:05:24', '2022-01-17 22:05:24'),
(420, '137.220.56.78', '2022-01-18 04:07:03am', 1, '2022-01-17 22:07:03', '2022-01-17 22:07:03'),
(421, '104.198.67.206', '2022-01-18 04:07:56am', 1, '2022-01-17 22:07:56', '2022-01-17 22:07:56'),
(422, '83.138.48.225', '2022-01-18 05:06:02am', 1, '2022-01-17 23:06:02', '2022-01-17 23:06:02'),
(423, '83.138.48.225', '2022-01-18 05:06:05am', 1, '2022-01-17 23:06:05', '2022-01-17 23:06:05'),
(424, '178.128.86.237', '2022-01-18 05:10:47am', 1, '2022-01-17 23:10:48', '2022-01-17 23:10:48'),
(425, '178.128.86.237', '2022-01-18 05:10:48am', 1, '2022-01-17 23:10:48', '2022-01-17 23:10:48'),
(426, '178.128.86.237', '2022-01-18 05:10:48am', 1, '2022-01-17 23:10:48', '2022-01-17 23:10:48'),
(427, '138.246.253.5', '2022-01-18 05:36:29am', 1, '2022-01-17 23:36:29', '2022-01-17 23:36:29'),
(428, '15.204.21.72', '2022-01-18 07:51:10am', 1, '2022-01-18 01:51:10', '2022-01-18 01:51:10'),
(429, '51.91.193.178', '2022-01-18 08:19:31am', 1, '2022-01-18 02:19:31', '2022-01-18 02:19:31'),
(430, '138.246.253.5', '2022-01-18 08:21:19am', 1, '2022-01-18 02:21:19', '2022-01-18 02:21:19'),
(431, '123.183.224.115', '2022-01-18 08:37:32am', 1, '2022-01-18 02:37:32', '2022-01-18 02:37:32'),
(432, '37.20.174.198', '2022-01-18 09:45:37am', 1, '2022-01-18 03:45:37', '2022-01-18 03:45:37'),
(433, '179.61.179.197', '2022-01-18 10:14:28am', 1, '2022-01-18 04:14:28', '2022-01-18 04:14:28'),
(434, '138.246.253.5', '2022-01-18 10:34:33am', 1, '2022-01-18 04:34:33', '2022-01-18 04:34:33'),
(435, '118.179.97.39', '2022-01-18 10:51:17am', 1, '2022-01-18 04:51:17', '2022-01-18 04:51:17'),
(436, '60.190.52.6', '2022-01-18 10:57:10am', 1, '2022-01-18 04:57:10', '2022-01-18 04:57:10'),
(437, '60.190.52.6', '2022-01-18 10:57:31am', 1, '2022-01-18 04:57:31', '2022-01-18 04:57:31'),
(438, '131.220.6.152', '2022-01-18 10:59:39am', 1, '2022-01-18 04:59:39', '2022-01-18 04:59:39'),
(439, '66.249.79.14', '2022-01-18 11:06:24am', 1, '2022-01-18 05:06:24', '2022-01-18 05:06:24'),
(440, '103.152.147.60', '2022-01-18 11:18:24am', 1, '2022-01-18 05:18:24', '2022-01-18 05:18:24'),
(441, '87.250.224.11', '2022-01-18 11:19:00am', 1, '2022-01-18 05:19:00', '2022-01-18 05:19:00'),
(442, '118.179.97.39', '2022-01-18 11:19:48am', 1, '2022-01-18 05:19:48', '2022-01-18 05:19:48'),
(443, '109.86.217.24', '2022-01-18 12:02:05pm', 1, '2022-01-18 06:02:05', '2022-01-18 06:02:05'),
(444, '118.179.97.39', '2022-01-18 12:14:56pm', 1, '2022-01-18 06:14:56', '2022-01-18 06:14:56'),
(445, '138.246.253.5', '2022-01-18 12:15:31pm', 1, '2022-01-18 06:15:31', '2022-01-18 06:15:31'),
(446, '66.249.79.10', '2022-01-18 12:49:49pm', 1, '2022-01-18 06:49:49', '2022-01-18 06:49:49'),
(447, '138.246.253.5', '2022-01-18 12:52:05pm', 1, '2022-01-18 06:52:05', '2022-01-18 06:52:05'),
(448, '178.159.37.66', '2022-01-18 01:04:11pm', 1, '2022-01-18 07:04:11', '2022-01-18 07:04:11'),
(449, '31.134.125.80', '2022-01-18 01:53:43pm', 1, '2022-01-18 07:53:43', '2022-01-18 07:53:43'),
(450, '123.125.109.138', '2022-01-18 02:08:13pm', 1, '2022-01-18 08:08:13', '2022-01-18 08:08:13'),
(451, '45.74.35.63', '2022-01-18 02:24:12pm', 1, '2022-01-18 08:24:12', '2022-01-18 08:24:12'),
(452, '45.74.35.63', '2022-01-18 02:24:18pm', 1, '2022-01-18 08:24:18', '2022-01-18 08:24:18'),
(453, '138.246.253.5', '2022-01-18 02:46:33pm', 1, '2022-01-18 08:46:33', '2022-01-18 08:46:33'),
(454, '190.11.16.46', '2022-01-18 03:13:08pm', 1, '2022-01-18 09:13:08', '2022-01-18 09:13:08'),
(455, '173.252.111.26', '2022-01-18 03:14:30pm', 1, '2022-01-18 09:14:30', '2022-01-18 09:14:30'),
(456, '173.252.111.25', '2022-01-18 03:14:31pm', 1, '2022-01-18 09:14:31', '2022-01-18 09:14:31'),
(457, '173.252.111.18', '2022-01-18 03:15:17pm', 1, '2022-01-18 09:15:17', '2022-01-18 09:15:17'),
(458, '118.179.97.39', '2022-01-18 03:16:20pm', 1, '2022-01-18 09:16:20', '2022-01-18 09:16:20'),
(459, '118.179.97.39', '2022-01-18 03:16:46pm', 1, '2022-01-18 09:16:46', '2022-01-18 09:16:46'),
(460, '118.179.97.39', '2022-01-18 03:16:55pm', 1, '2022-01-18 09:16:55', '2022-01-18 09:16:55'),
(461, '118.179.97.39', '2022-01-18 03:17:03pm', 1, '2022-01-18 09:17:03', '2022-01-18 09:17:03'),
(462, '118.179.97.39', '2022-01-18 03:17:09pm', 1, '2022-01-18 09:17:09', '2022-01-18 09:17:09'),
(463, '118.179.97.39', '2022-01-18 03:17:19pm', 1, '2022-01-18 09:17:19', '2022-01-18 09:17:19'),
(464, '118.179.97.39', '2022-01-18 03:17:50pm', 1, '2022-01-18 09:17:50', '2022-01-18 09:17:50'),
(465, '118.179.97.39', '2022-01-18 03:18:04pm', 1, '2022-01-18 09:18:04', '2022-01-18 09:18:04'),
(466, '118.179.97.39', '2022-01-18 03:18:36pm', 1, '2022-01-18 09:18:37', '2022-01-18 09:18:37'),
(467, '118.179.97.39', '2022-01-18 03:19:15pm', 1, '2022-01-18 09:19:15', '2022-01-18 09:19:15'),
(468, '118.179.97.39', '2022-01-18 03:19:39pm', 1, '2022-01-18 09:19:39', '2022-01-18 09:19:39'),
(469, '118.179.97.39', '2022-01-18 03:19:54pm', 1, '2022-01-18 09:19:54', '2022-01-18 09:19:54'),
(470, '118.179.97.39', '2022-01-18 03:20:54pm', 1, '2022-01-18 09:20:54', '2022-01-18 09:20:54'),
(471, '103.135.252.94', '2022-01-18 03:28:56pm', 1, '2022-01-18 09:28:56', '2022-01-18 09:28:56'),
(472, '103.135.252.94', '2022-01-18 03:29:06pm', 1, '2022-01-18 09:29:06', '2022-01-18 09:29:06'),
(473, '157.55.39.48', '2022-01-18 03:30:53pm', 1, '2022-01-18 09:30:53', '2022-01-18 09:30:53'),
(474, '159.65.132.146', '2022-01-18 03:31:17pm', 1, '2022-01-18 09:31:17', '2022-01-18 09:31:17'),
(475, '159.65.132.146', '2022-01-18 03:31:17pm', 1, '2022-01-18 09:31:17', '2022-01-18 09:31:17'),
(476, '159.65.132.146', '2022-01-18 03:31:17pm', 1, '2022-01-18 09:31:17', '2022-01-18 09:31:17'),
(477, '52.114.32.212', '2022-01-18 03:31:35pm', 1, '2022-01-18 09:31:35', '2022-01-18 09:31:35'),
(478, '118.179.97.39', '2022-01-18 03:43:07pm', 1, '2022-01-18 09:43:07', '2022-01-18 09:43:07'),
(479, '118.179.97.39', '2022-01-18 03:44:14pm', 1, '2022-01-18 09:44:14', '2022-01-18 09:44:14'),
(480, '118.179.97.39', '2022-01-18 03:44:43pm', 1, '2022-01-18 09:44:43', '2022-01-18 09:44:43'),
(481, '118.179.97.39', '2022-01-18 03:45:39pm', 1, '2022-01-18 09:45:39', '2022-01-18 09:45:39'),
(482, '178.128.55.52', '2022-01-18 04:44:11pm', 1, '2022-01-18 10:44:11', '2022-01-18 10:44:11'),
(483, '178.128.55.52', '2022-01-18 04:44:11pm', 1, '2022-01-18 10:44:11', '2022-01-18 10:44:11'),
(484, '178.128.55.52', '2022-01-18 04:44:12pm', 1, '2022-01-18 10:44:12', '2022-01-18 10:44:12'),
(485, '35.231.141.141', '2022-01-18 04:57:49pm', 1, '2022-01-18 10:57:49', '2022-01-18 10:57:49'),
(486, '35.231.141.141', '2022-01-18 04:58:58pm', 1, '2022-01-18 10:58:58', '2022-01-18 10:58:58'),
(487, '95.0.200.66', '2022-01-18 05:00:27pm', 1, '2022-01-18 11:00:27', '2022-01-18 11:00:27'),
(488, '103.230.106.41', '2022-01-18 05:20:31pm', 1, '2022-01-18 11:20:31', '2022-01-18 11:20:31'),
(489, '130.255.166.98', '2022-01-18 05:22:07pm', 1, '2022-01-18 11:22:07', '2022-01-18 11:22:07'),
(490, '103.230.106.41', '2022-01-18 05:24:22pm', 1, '2022-01-18 11:24:22', '2022-01-18 11:24:22'),
(491, '45.129.18.155', '2022-01-18 05:24:51pm', 1, '2022-01-18 11:24:51', '2022-01-18 11:24:51'),
(492, '138.246.253.5', '2022-01-18 05:26:47pm', 1, '2022-01-18 11:26:47', '2022-01-18 11:26:47'),
(493, '35.214.130.87', '2022-01-18 05:31:56pm', 1, '2022-01-18 11:31:56', '2022-01-18 11:31:56'),
(494, '35.214.130.87', '2022-01-18 05:32:10pm', 1, '2022-01-18 11:32:10', '2022-01-18 11:32:10'),
(495, '192.0.91.199', '2022-01-18 05:32:36pm', 1, '2022-01-18 11:32:36', '2022-01-18 11:32:36'),
(496, '104.236.44.95', '2022-01-18 05:32:58pm', 1, '2022-01-18 11:32:58', '2022-01-18 11:32:58'),
(497, '103.230.106.41', '2022-01-18 05:34:21pm', 1, '2022-01-18 11:34:21', '2022-01-18 11:34:21'),
(498, '103.230.106.41', '2022-01-18 05:35:16pm', 1, '2022-01-18 11:35:16', '2022-01-18 11:35:16'),
(499, '162.55.85.228', '2022-01-18 05:58:47pm', 1, '2022-01-18 11:58:47', '2022-01-18 11:58:47'),
(500, '195.246.120.176', '2022-01-18 06:09:39pm', 1, '2022-01-18 12:09:39', '2022-01-18 12:09:39'),
(501, '123.183.224.119', '2022-01-18 06:11:06pm', 1, '2022-01-18 12:11:06', '2022-01-18 12:11:06'),
(502, '34.75.161.78', '2022-01-18 06:28:16pm', 1, '2022-01-18 12:28:16', '2022-01-18 12:28:16'),
(503, '46.138.223.63', '2022-01-18 06:48:32pm', 1, '2022-01-18 12:48:32', '2022-01-18 12:48:32'),
(504, '178.159.37.159', '2022-01-18 06:58:36pm', 1, '2022-01-18 12:58:36', '2022-01-18 12:58:36'),
(505, '103.152.147.60', '2022-01-18 07:15:13pm', 1, '2022-01-18 13:15:13', '2022-01-18 13:15:13'),
(506, '103.152.147.60', '2022-01-18 07:15:34pm', 1, '2022-01-18 13:15:34', '2022-01-18 13:15:34'),
(507, '23.94.5.76', '2022-01-18 07:41:44pm', 1, '2022-01-18 13:41:44', '2022-01-18 13:41:44'),
(508, '178.184.134.12', '2022-01-18 07:42:04pm', 1, '2022-01-18 13:42:04', '2022-01-18 13:42:04'),
(509, '188.234.13.127', '2022-01-18 07:58:52pm', 1, '2022-01-18 13:58:52', '2022-01-18 13:58:52'),
(510, '188.234.13.127', '2022-01-18 07:58:57pm', 1, '2022-01-18 13:58:57', '2022-01-18 13:58:57'),
(511, '188.234.13.127', '2022-01-18 07:59:00pm', 1, '2022-01-18 13:59:00', '2022-01-18 13:59:00'),
(512, '162.55.85.228', '2022-01-18 08:02:12pm', 1, '2022-01-18 14:02:12', '2022-01-18 14:02:12'),
(513, '138.246.253.5', '2022-01-18 08:16:20pm', 1, '2022-01-18 14:16:20', '2022-01-18 14:16:20'),
(514, '103.135.252.95', '2022-01-18 08:19:22pm', 1, '2022-01-18 14:19:22', '2022-01-18 14:19:22'),
(515, '138.246.253.5', '2022-01-18 08:42:13pm', 1, '2022-01-18 14:42:13', '2022-01-18 14:42:13'),
(516, '213.178.40.153', '2022-01-18 09:32:08pm', 1, '2022-01-18 15:32:08', '2022-01-18 15:32:08'),
(517, '213.178.40.153', '2022-01-18 09:32:12pm', 1, '2022-01-18 15:32:12', '2022-01-18 15:32:12'),
(518, '66.249.68.51', '2022-01-18 09:50:25pm', 1, '2022-01-18 15:50:25', '2022-01-18 15:50:25'),
(519, '103.135.252.95', '2022-01-18 09:55:50pm', 1, '2022-01-18 15:55:50', '2022-01-18 15:55:50'),
(520, '195.246.120.161', '2022-01-18 09:56:44pm', 1, '2022-01-18 15:56:44', '2022-01-18 15:56:44');
INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`, `status`, `created_at`, `updated_at`) VALUES
(521, '5.45.100.222', '2022-01-18 10:14:11pm', 1, '2022-01-18 16:14:11', '2022-01-18 16:14:11'),
(522, '178.17.182.102', '2022-01-18 10:36:04pm', 1, '2022-01-18 16:36:05', '2022-01-18 16:36:05'),
(523, '178.17.182.102', '2022-01-18 10:36:08pm', 1, '2022-01-18 16:36:08', '2022-01-18 16:36:08'),
(524, '66.249.68.55', '2022-01-18 11:08:14pm', 1, '2022-01-18 17:08:14', '2022-01-18 17:08:14'),
(525, '138.246.253.5', '2022-01-19 12:11:48am', 1, '2022-01-18 18:11:48', '2022-01-18 18:11:48'),
(526, '138.246.253.5', '2022-01-19 12:39:57am', 1, '2022-01-18 18:39:57', '2022-01-18 18:39:57'),
(527, '54.36.148.39', '2022-01-19 01:21:27am', 1, '2022-01-18 19:21:27', '2022-01-18 19:21:27'),
(528, '185.220.101.48', '2022-01-19 01:25:07am', 1, '2022-01-18 19:25:07', '2022-01-18 19:25:07'),
(529, '58.145.184.237', '2022-01-19 01:27:32am', 1, '2022-01-18 19:27:32', '2022-01-18 19:27:32'),
(530, '178.17.182.102', '2022-01-19 01:36:44am', 1, '2022-01-18 19:36:44', '2022-01-18 19:36:44'),
(531, '178.17.182.102', '2022-01-19 01:36:47am', 1, '2022-01-18 19:36:47', '2022-01-18 19:36:47'),
(532, '157.90.206.35', '2022-01-19 03:03:41am', 1, '2022-01-18 21:03:41', '2022-01-18 21:03:41'),
(533, '195.123.209.118', '2022-01-19 04:27:33am', 1, '2022-01-18 22:27:33', '2022-01-18 22:27:33'),
(534, '195.123.209.118', '2022-01-19 04:27:33am', 1, '2022-01-18 22:27:33', '2022-01-18 22:27:33'),
(535, '195.123.209.118', '2022-01-19 04:27:34am', 1, '2022-01-18 22:27:34', '2022-01-18 22:27:34'),
(536, '188.163.73.203', '2022-01-19 04:52:36am', 1, '2022-01-18 22:52:36', '2022-01-18 22:52:36'),
(537, '188.163.73.203', '2022-01-19 04:52:39am', 1, '2022-01-18 22:52:39', '2022-01-18 22:52:39'),
(538, '51.222.253.20', '2022-01-19 05:19:40am', 1, '2022-01-18 23:19:40', '2022-01-18 23:19:40'),
(539, '82.165.86.177', '2022-01-19 05:39:52am', 1, '2022-01-18 23:39:52', '2022-01-18 23:39:52'),
(540, '138.246.253.5', '2022-01-19 05:46:03am', 1, '2022-01-18 23:46:03', '2022-01-18 23:46:03'),
(541, '159.196.16.67', '2022-01-19 06:25:04am', 1, '2022-01-19 00:25:04', '2022-01-19 00:25:04'),
(542, '87.250.224.11', '2022-01-19 06:52:05am', 1, '2022-01-19 00:52:05', '2022-01-19 00:52:05'),
(543, '87.250.224.11', '2022-01-19 07:31:12am', 1, '2022-01-19 01:31:12', '2022-01-19 01:31:12'),
(544, '87.250.224.11', '2022-01-19 07:32:31am', 1, '2022-01-19 01:32:31', '2022-01-19 01:32:31'),
(545, '66.249.68.35', '2022-01-19 07:48:34am', 1, '2022-01-19 01:48:34', '2022-01-19 01:48:34'),
(546, '66.249.68.41', '2022-01-19 07:59:20am', 1, '2022-01-19 01:59:20', '2022-01-19 01:59:20'),
(547, '49.7.20.102', '2022-01-19 08:33:29am', 1, '2022-01-19 02:33:29', '2022-01-19 02:33:29'),
(548, '185.220.102.240', '2022-01-19 08:47:08am', 1, '2022-01-19 02:47:08', '2022-01-19 02:47:08'),
(549, '45.129.136.32', '2022-01-19 08:52:48am', 1, '2022-01-19 02:52:48', '2022-01-19 02:52:48'),
(550, '45.129.136.32', '2022-01-19 08:53:03am', 1, '2022-01-19 02:53:03', '2022-01-19 02:53:03'),
(551, '45.129.136.32', '2022-01-19 08:53:19am', 1, '2022-01-19 02:53:19', '2022-01-19 02:53:19'),
(552, '45.129.136.32', '2022-01-19 08:53:26am', 1, '2022-01-19 02:53:26', '2022-01-19 02:53:26'),
(553, '45.129.136.32', '2022-01-19 08:53:27am', 1, '2022-01-19 02:53:27', '2022-01-19 02:53:27'),
(554, '42.83.147.34', '2022-01-19 08:58:27am', 1, '2022-01-19 02:58:27', '2022-01-19 02:58:27'),
(555, '66.249.68.39', '2022-01-19 09:50:34am', 1, '2022-01-19 03:50:34', '2022-01-19 03:50:34'),
(556, '109.194.255.225', '2022-01-19 09:51:20am', 1, '2022-01-19 03:51:20', '2022-01-19 03:51:20'),
(557, '109.194.255.225', '2022-01-19 09:51:23am', 1, '2022-01-19 03:51:23', '2022-01-19 03:51:23'),
(558, '109.194.255.225', '2022-01-19 09:51:24am', 1, '2022-01-19 03:51:24', '2022-01-19 03:51:24'),
(559, '49.12.126.16', '2022-01-19 10:02:58am', 1, '2022-01-19 04:02:58', '2022-01-19 04:02:58'),
(560, '34.86.35.1', '2022-01-19 10:43:13am', 1, '2022-01-19 04:43:13', '2022-01-19 04:43:13'),
(561, '34.96.130.17', '2022-01-19 10:46:06am', 1, '2022-01-19 04:46:06', '2022-01-19 04:46:06'),
(562, '131.220.6.152', '2022-01-19 11:00:29am', 1, '2022-01-19 05:00:29', '2022-01-19 05:00:29'),
(563, '195.246.120.161', '2022-01-19 11:01:26am', 1, '2022-01-19 05:01:27', '2022-01-19 05:01:27'),
(564, '118.179.97.39', '2022-01-19 11:07:33am', 1, '2022-01-19 05:07:33', '2022-01-19 05:07:33'),
(565, '60.190.52.6', '2022-01-19 11:10:37am', 1, '2022-01-19 05:10:37', '2022-01-19 05:10:37'),
(566, '60.190.52.6', '2022-01-19 11:11:46am', 1, '2022-01-19 05:11:46', '2022-01-19 05:11:46'),
(567, '59.35.57.62', '2022-01-19 11:24:54am', 1, '2022-01-19 05:24:54', '2022-01-19 05:24:54'),
(568, '202.107.195.162', '2022-01-19 11:25:27am', 1, '2022-01-19 05:25:27', '2022-01-19 05:25:27'),
(569, '113.24.224.47', '2022-01-19 11:27:27am', 1, '2022-01-19 05:27:27', '2022-01-19 05:27:27'),
(570, '176.226.155.141', '2022-01-19 11:30:02am', 1, '2022-01-19 05:30:02', '2022-01-19 05:30:02'),
(571, '103.135.252.89', '2022-01-19 11:51:45am', 1, '2022-01-19 05:51:45', '2022-01-19 05:51:45'),
(572, '103.135.252.89', '2022-01-19 11:51:46am', 1, '2022-01-19 05:51:46', '2022-01-19 05:51:46'),
(573, '118.179.97.39', '2022-01-19 12:08:08pm', 1, '2022-01-19 06:08:08', '2022-01-19 06:08:08'),
(574, '118.179.97.39', '2022-01-19 12:08:15pm', 1, '2022-01-19 06:08:15', '2022-01-19 06:08:15'),
(575, '46.32.70.78', '2022-01-19 12:33:24pm', 1, '2022-01-19 06:33:24', '2022-01-19 06:33:24'),
(576, '123.125.109.43', '2022-01-19 01:33:55pm', 1, '2022-01-19 07:33:55', '2022-01-19 07:33:55'),
(577, '220.152.113.20', '2022-01-19 02:26:54pm', 1, '2022-01-19 08:26:54', '2022-01-19 08:26:54'),
(578, '103.217.77.118', '2022-01-19 03:29:16pm', 1, '2022-01-19 09:29:16', '2022-01-19 09:29:16'),
(579, '103.135.203.79', '2022-01-19 03:29:16pm', 1, '2022-01-19 09:29:16', '2022-01-19 09:29:16'),
(580, '31.13.115.24', '2022-01-19 03:38:14pm', 1, '2022-01-19 09:38:14', '2022-01-19 09:38:14'),
(581, '162.55.85.228', '2022-01-19 04:03:59pm', 1, '2022-01-19 10:03:59', '2022-01-19 10:03:59'),
(582, '185.220.102.252', '2022-01-19 04:12:22pm', 1, '2022-01-19 10:12:22', '2022-01-19 10:12:22'),
(583, '31.200.18.253', '2022-01-19 04:52:06pm', 1, '2022-01-19 10:52:06', '2022-01-19 10:52:06'),
(584, '161.117.9.99', '2022-01-19 05:18:48pm', 1, '2022-01-19 11:18:48', '2022-01-19 11:18:48'),
(585, '161.117.9.99', '2022-01-19 05:36:30pm', 1, '2022-01-19 11:36:30', '2022-01-19 11:36:30'),
(586, '161.117.9.99', '2022-01-19 05:39:09pm', 1, '2022-01-19 11:39:09', '2022-01-19 11:39:09'),
(587, '161.117.9.99', '2022-01-19 05:43:47pm', 1, '2022-01-19 11:43:47', '2022-01-19 11:43:47'),
(588, '176.67.86.164', '2022-01-19 05:55:55pm', 1, '2022-01-19 11:55:55', '2022-01-19 11:55:55'),
(589, '195.246.120.161', '2022-01-19 06:14:57pm', 1, '2022-01-19 12:14:57', '2022-01-19 12:14:57'),
(590, '161.117.9.99', '2022-01-19 06:21:57pm', 1, '2022-01-19 12:21:57', '2022-01-19 12:21:57'),
(591, '178.159.37.159', '2022-01-19 06:23:50pm', 1, '2022-01-19 12:23:50', '2022-01-19 12:23:50'),
(592, '62.113.118.20', '2022-01-19 06:33:39pm', 1, '2022-01-19 12:33:39', '2022-01-19 12:33:39'),
(593, '49.7.20.105', '2022-01-19 06:35:28pm', 1, '2022-01-19 12:35:28', '2022-01-19 12:35:28'),
(594, '49.7.20.105', '2022-01-19 06:38:37pm', 1, '2022-01-19 12:38:37', '2022-01-19 12:38:37'),
(595, '49.7.20.105', '2022-01-19 06:42:00pm', 1, '2022-01-19 12:42:00', '2022-01-19 12:42:00'),
(596, '49.7.20.105', '2022-01-19 06:46:27pm', 1, '2022-01-19 12:46:27', '2022-01-19 12:46:27'),
(597, '49.7.20.105', '2022-01-19 06:51:32pm', 1, '2022-01-19 12:51:32', '2022-01-19 12:51:32'),
(598, '49.7.20.105', '2022-01-19 06:58:09pm', 1, '2022-01-19 12:58:09', '2022-01-19 12:58:09'),
(599, '161.117.9.99', '2022-01-19 07:00:21pm', 1, '2022-01-19 13:00:21', '2022-01-19 13:00:21'),
(600, '49.7.20.105', '2022-01-19 07:04:40pm', 1, '2022-01-19 13:04:40', '2022-01-19 13:04:40'),
(601, '159.223.87.166', '2022-01-19 07:05:12pm', 1, '2022-01-19 13:05:12', '2022-01-19 13:05:12'),
(602, '159.223.87.166', '2022-01-19 07:05:12pm', 1, '2022-01-19 13:05:12', '2022-01-19 13:05:12'),
(603, '159.223.87.166', '2022-01-19 07:05:13pm', 1, '2022-01-19 13:05:13', '2022-01-19 13:05:13'),
(604, '66.249.68.55', '2022-01-19 07:25:03pm', 1, '2022-01-19 13:25:03', '2022-01-19 13:25:03'),
(605, '159.223.87.166', '2022-01-19 07:46:29pm', 1, '2022-01-19 13:46:29', '2022-01-19 13:46:29'),
(606, '159.223.87.166', '2022-01-19 07:46:29pm', 1, '2022-01-19 13:46:29', '2022-01-19 13:46:29'),
(607, '159.223.87.166', '2022-01-19 07:46:29pm', 1, '2022-01-19 13:46:29', '2022-01-19 13:46:29'),
(608, '138.128.9.187', '2022-01-19 08:20:18pm', 1, '2022-01-19 14:20:18', '2022-01-19 14:20:18'),
(609, '54.36.149.94', '2022-01-19 08:36:10pm', 1, '2022-01-19 14:36:10', '2022-01-19 14:36:10'),
(610, '103.135.252.89', '2022-01-19 08:39:58pm', 1, '2022-01-19 14:39:58', '2022-01-19 14:39:58'),
(611, '66.249.79.29', '2022-01-19 08:51:16pm', 1, '2022-01-19 14:51:16', '2022-01-19 14:51:16'),
(612, '66.249.79.169', '2022-01-19 09:06:27pm', 1, '2022-01-19 15:06:27', '2022-01-19 15:06:27'),
(613, '161.117.10.46', '2022-01-19 09:19:07pm', 1, '2022-01-19 15:19:07', '2022-01-19 15:19:07'),
(614, '66.249.79.234', '2022-01-19 09:38:13pm', 1, '2022-01-19 15:38:13', '2022-01-19 15:38:13'),
(615, '185.220.100.250', '2022-01-19 09:42:18pm', 1, '2022-01-19 15:42:18', '2022-01-19 15:42:18'),
(616, '185.119.81.109', '2022-01-19 11:00:58pm', 1, '2022-01-19 17:00:58', '2022-01-19 17:00:58'),
(617, '185.119.81.109', '2022-01-19 11:01:07pm', 1, '2022-01-19 17:01:07', '2022-01-19 17:01:07'),
(618, '185.119.81.109', '2022-01-19 11:02:08pm', 1, '2022-01-19 17:02:08', '2022-01-19 17:02:08'),
(619, '185.119.81.109', '2022-01-19 11:02:31pm', 1, '2022-01-19 17:02:31', '2022-01-19 17:02:31'),
(620, '185.119.81.109', '2022-01-19 11:02:49pm', 1, '2022-01-19 17:02:49', '2022-01-19 17:02:49'),
(621, '66.249.79.195', '2022-01-19 11:14:29pm', 1, '2022-01-19 17:14:29', '2022-01-19 17:14:29'),
(622, '66.249.79.195', '2022-01-20 12:05:13am', 1, '2022-01-19 18:05:13', '2022-01-19 18:05:13'),
(623, '51.222.253.13', '2022-01-20 12:26:00am', 1, '2022-01-19 18:26:00', '2022-01-19 18:26:00'),
(624, '66.249.68.55', '2022-01-20 01:03:33am', 1, '2022-01-19 19:03:33', '2022-01-19 19:03:33'),
(625, '91.187.119.56', '2022-01-20 01:31:32am', 1, '2022-01-19 19:31:32', '2022-01-19 19:31:32'),
(626, '157.55.39.129', '2022-01-20 02:11:25am', 1, '2022-01-19 20:11:25', '2022-01-19 20:11:25'),
(627, '45.132.194.34', '2022-01-20 04:10:18am', 1, '2022-01-19 22:10:18', '2022-01-19 22:10:18'),
(628, '54.174.55.98', '2022-01-20 05:59:35am', 1, '2022-01-19 23:59:35', '2022-01-19 23:59:35'),
(629, '87.250.224.11', '2022-01-20 06:58:16am', 1, '2022-01-20 00:58:16', '2022-01-20 00:58:16'),
(630, '87.250.224.167', '2022-01-20 06:58:25am', 1, '2022-01-20 00:58:25', '2022-01-20 00:58:25'),
(631, '87.250.224.33', '2022-01-20 06:59:02am', 1, '2022-01-20 00:59:02', '2022-01-20 00:59:02'),
(632, '87.250.224.11', '2022-01-20 06:59:15am', 1, '2022-01-20 00:59:15', '2022-01-20 00:59:15'),
(633, '87.250.224.11', '2022-01-20 06:59:23am', 1, '2022-01-20 00:59:23', '2022-01-20 00:59:23'),
(634, '195.209.102.61', '2022-01-20 07:25:28am', 1, '2022-01-20 01:25:28', '2022-01-20 01:25:28'),
(635, '195.209.102.61', '2022-01-20 07:25:32am', 1, '2022-01-20 01:25:32', '2022-01-20 01:25:32'),
(636, '123.125.109.112', '2022-01-20 08:37:12am', 1, '2022-01-20 02:37:12', '2022-01-20 02:37:12'),
(637, '94.154.188.146', '2022-01-20 08:57:48am', 1, '2022-01-20 02:57:48', '2022-01-20 02:57:48'),
(638, '94.154.188.146', '2022-01-20 08:57:51am', 1, '2022-01-20 02:57:51', '2022-01-20 02:57:51'),
(639, '188.212.136.5', '2022-01-20 09:01:59am', 1, '2022-01-20 03:01:59', '2022-01-20 03:01:59'),
(640, '77.35.205.116', '2022-01-20 09:19:16am', 1, '2022-01-20 03:19:16', '2022-01-20 03:19:16'),
(641, '77.35.205.116', '2022-01-20 09:19:19am', 1, '2022-01-20 03:19:19', '2022-01-20 03:19:19'),
(642, '87.250.224.11', '2022-01-20 09:36:17am', 1, '2022-01-20 03:36:17', '2022-01-20 03:36:17'),
(643, '87.250.224.11', '2022-01-20 09:36:28am', 1, '2022-01-20 03:36:28', '2022-01-20 03:36:28'),
(644, '64.71.131.244', '2022-01-20 09:40:50am', 1, '2022-01-20 03:40:50', '2022-01-20 03:40:50'),
(645, '197.232.61.224', '2022-01-20 10:08:13am', 1, '2022-01-20 04:08:13', '2022-01-20 04:08:13'),
(646, '197.232.61.224', '2022-01-20 10:08:28am', 1, '2022-01-20 04:08:28', '2022-01-20 04:08:28'),
(647, '206.204.58.146', '2022-01-20 10:17:21am', 1, '2022-01-20 04:17:21', '2022-01-20 04:17:21'),
(648, '139.28.137.182', '2022-01-20 10:17:23am', 1, '2022-01-20 04:17:23', '2022-01-20 04:17:23'),
(649, '154.16.35.82', '2022-01-20 10:18:20am', 1, '2022-01-20 04:18:20', '2022-01-20 04:18:20'),
(650, '198.240.89.144', '2022-01-20 10:18:22am', 1, '2022-01-20 04:18:22', '2022-01-20 04:18:22'),
(651, '5.157.43.121', '2022-01-20 10:35:20am', 1, '2022-01-20 04:35:20', '2022-01-20 04:35:20'),
(652, '192.140.255.252', '2022-01-20 10:43:06am', 1, '2022-01-20 04:43:06', '2022-01-20 04:43:06'),
(653, '45.153.160.2', '2022-01-20 10:43:30am', 1, '2022-01-20 04:43:30', '2022-01-20 04:43:30'),
(654, '131.220.6.152', '2022-01-20 10:58:07am', 1, '2022-01-20 04:58:07', '2022-01-20 04:58:07'),
(655, '54.36.148.180', '2022-01-20 11:45:35am', 1, '2022-01-20 05:45:35', '2022-01-20 05:45:35'),
(656, '185.255.96.99', '2022-01-20 11:56:33am', 1, '2022-01-20 05:56:33', '2022-01-20 05:56:33'),
(657, '66.249.79.14', '2022-01-20 12:16:13pm', 1, '2022-01-20 06:16:13', '2022-01-20 06:16:13'),
(658, '192.241.73.249', '2022-01-20 12:20:10pm', 1, '2022-01-20 06:20:10', '2022-01-20 06:20:10'),
(659, '192.241.73.249', '2022-01-20 12:20:23pm', 1, '2022-01-20 06:20:23', '2022-01-20 06:20:23'),
(660, '125.90.88.86', '2022-01-20 12:29:38pm', 1, '2022-01-20 06:29:38', '2022-01-20 06:29:38'),
(661, '117.25.139.73', '2022-01-20 12:30:49pm', 1, '2022-01-20 06:30:49', '2022-01-20 06:30:49'),
(662, '117.25.139.73', '2022-01-20 12:30:55pm', 1, '2022-01-20 06:30:55', '2022-01-20 06:30:55'),
(663, '117.25.139.73', '2022-01-20 12:31:02pm', 1, '2022-01-20 06:31:02', '2022-01-20 06:31:02'),
(664, '5.9.51.240', '2022-01-20 12:33:26pm', 1, '2022-01-20 06:33:26', '2022-01-20 06:33:26'),
(665, '36.110.211.3', '2022-01-20 12:34:14pm', 1, '2022-01-20 06:34:14', '2022-01-20 06:34:14'),
(666, '180.163.220.67', '2022-01-20 12:34:42pm', 1, '2022-01-20 06:34:42', '2022-01-20 06:34:42'),
(667, '180.163.220.67', '2022-01-20 12:36:48pm', 1, '2022-01-20 06:36:49', '2022-01-20 06:36:49'),
(668, '171.13.14.44', '2022-01-20 12:37:39pm', 1, '2022-01-20 06:37:39', '2022-01-20 06:37:39'),
(669, '171.13.14.49', '2022-01-20 12:37:54pm', 1, '2022-01-20 06:37:54', '2022-01-20 06:37:54'),
(670, '66.249.79.14', '2022-01-20 01:02:12pm', 1, '2022-01-20 07:02:12', '2022-01-20 07:02:12'),
(671, '178.159.37.159', '2022-01-20 01:21:12pm', 1, '2022-01-20 07:21:12', '2022-01-20 07:21:12'),
(672, '118.26.38.159', '2022-01-20 01:33:45pm', 1, '2022-01-20 07:33:46', '2022-01-20 07:33:46'),
(673, '49.7.20.108', '2022-01-20 01:41:12pm', 1, '2022-01-20 07:41:12', '2022-01-20 07:41:12'),
(674, '220.152.113.20', '2022-01-20 02:11:18pm', 1, '2022-01-20 08:11:18', '2022-01-20 08:11:18'),
(675, '178.159.37.159', '2022-01-20 03:43:12pm', 1, '2022-01-20 09:43:12', '2022-01-20 09:43:12'),
(676, '178.159.37.159', '2022-01-20 03:43:21pm', 1, '2022-01-20 09:43:21', '2022-01-20 09:43:21'),
(677, '45.129.18.169', '2022-01-20 04:07:52pm', 1, '2022-01-20 10:07:52', '2022-01-20 10:07:52'),
(678, '178.159.37.66', '2022-01-20 05:09:43pm', 1, '2022-01-20 11:09:43', '2022-01-20 11:09:43'),
(679, '178.159.37.66', '2022-01-20 05:09:46pm', 1, '2022-01-20 11:09:46', '2022-01-20 11:09:46'),
(680, '118.179.97.39', '2022-01-20 05:32:47pm', 1, '2022-01-20 11:32:47', '2022-01-20 11:32:47'),
(681, '118.184.177.112', '2022-01-20 05:48:56pm', 1, '2022-01-20 11:48:56', '2022-01-20 11:48:56'),
(682, '80.73.242.161', '2022-01-20 05:56:22pm', 1, '2022-01-20 11:56:22', '2022-01-20 11:56:22'),
(683, '80.73.242.161', '2022-01-20 05:56:26pm', 1, '2022-01-20 11:56:26', '2022-01-20 11:56:26'),
(684, '51.222.253.9', '2022-01-20 05:56:36pm', 1, '2022-01-20 11:56:37', '2022-01-20 11:56:37'),
(685, '34.75.100.57', '2022-01-20 05:57:45pm', 1, '2022-01-20 11:57:45', '2022-01-20 11:57:45'),
(686, '178.159.37.66', '2022-01-20 06:07:43pm', 1, '2022-01-20 12:07:43', '2022-01-20 12:07:43'),
(687, '34.75.100.57', '2022-01-20 06:13:30pm', 1, '2022-01-20 12:13:30', '2022-01-20 12:13:30'),
(688, '45.115.115.206', '2022-01-20 06:43:43pm', 1, '2022-01-20 12:43:43', '2022-01-20 12:43:43'),
(689, '45.115.115.206', '2022-01-20 06:44:08pm', 1, '2022-01-20 12:44:08', '2022-01-20 12:44:08'),
(690, '45.115.115.206', '2022-01-20 06:44:16pm', 1, '2022-01-20 12:44:16', '2022-01-20 12:44:16'),
(691, '45.115.115.206', '2022-01-20 06:44:21pm', 1, '2022-01-20 12:44:21', '2022-01-20 12:44:21'),
(692, '104.196.141.167', '2022-01-20 06:46:47pm', 1, '2022-01-20 12:46:47', '2022-01-20 12:46:47'),
(693, '167.71.198.17', '2022-01-20 07:27:34pm', 1, '2022-01-20 13:27:34', '2022-01-20 13:27:34'),
(694, '167.71.198.17', '2022-01-20 07:27:35pm', 1, '2022-01-20 13:27:35', '2022-01-20 13:27:35'),
(695, '167.71.198.17', '2022-01-20 07:27:35pm', 1, '2022-01-20 13:27:35', '2022-01-20 13:27:35'),
(696, '143.198.172.181', '2022-01-20 07:27:51pm', 1, '2022-01-20 13:27:51', '2022-01-20 13:27:51'),
(697, '143.198.172.181', '2022-01-20 07:27:51pm', 1, '2022-01-20 13:27:51', '2022-01-20 13:27:51'),
(698, '143.198.172.181', '2022-01-20 07:27:53pm', 1, '2022-01-20 13:27:53', '2022-01-20 13:27:53'),
(699, '198.57.247.205', '2022-01-20 07:39:36pm', 1, '2022-01-20 13:39:36', '2022-01-20 13:39:36'),
(700, '5.135.137.50', '2022-01-20 08:23:34pm', 1, '2022-01-20 14:23:34', '2022-01-20 14:23:34'),
(701, '178.128.92.53', '2022-01-20 08:26:11pm', 1, '2022-01-20 14:26:11', '2022-01-20 14:26:11'),
(702, '178.128.92.53', '2022-01-20 08:26:11pm', 1, '2022-01-20 14:26:11', '2022-01-20 14:26:11'),
(703, '5.135.137.50', '2022-01-20 08:42:38pm', 1, '2022-01-20 14:42:38', '2022-01-20 14:42:38'),
(704, '209.126.9.207', '2022-01-20 09:11:59pm', 1, '2022-01-20 15:11:59', '2022-01-20 15:11:59'),
(705, '198.89.124.28', '2022-01-20 09:13:22pm', 1, '2022-01-20 15:13:22', '2022-01-20 15:13:22'),
(706, '118.179.97.39', '2022-01-20 09:13:25pm', 1, '2022-01-20 15:13:25', '2022-01-20 15:13:25'),
(707, '118.179.97.39', '2022-01-20 09:13:30pm', 1, '2022-01-20 15:13:30', '2022-01-20 15:13:30'),
(708, '103.165.155.35', '2022-01-20 09:47:44pm', 1, '2022-01-20 15:47:44', '2022-01-20 15:47:44'),
(709, '66.249.79.10', '2022-01-20 10:11:59pm', 1, '2022-01-20 16:11:59', '2022-01-20 16:11:59'),
(710, '65.52.177.173', '2022-01-20 10:28:08pm', 1, '2022-01-20 16:28:08', '2022-01-20 16:28:08'),
(711, '65.52.177.173', '2022-01-20 10:28:11pm', 1, '2022-01-20 16:28:11', '2022-01-20 16:28:11'),
(712, '66.249.68.51', '2022-01-20 10:40:38pm', 1, '2022-01-20 16:40:38', '2022-01-20 16:40:38'),
(713, '116.58.205.24', '2022-01-20 10:43:44pm', 1, '2022-01-20 16:43:44', '2022-01-20 16:43:44'),
(714, '66.249.79.29', '2022-01-20 10:44:51pm', 1, '2022-01-20 16:44:51', '2022-01-20 16:44:51'),
(715, '69.171.251.18', '2022-01-20 11:55:31pm', 1, '2022-01-20 17:55:31', '2022-01-20 17:55:31'),
(716, '35.227.89.148', '2022-01-21 12:09:46am', 1, '2022-01-20 18:09:46', '2022-01-20 18:09:46'),
(717, '35.227.89.148', '2022-01-21 12:10:50am', 1, '2022-01-20 18:10:50', '2022-01-20 18:10:50'),
(718, '103.135.252.94', '2022-01-21 01:42:41am', 1, '2022-01-20 19:42:41', '2022-01-20 19:42:41'),
(719, '103.135.252.94', '2022-01-21 01:42:43am', 1, '2022-01-20 19:42:43', '2022-01-20 19:42:43'),
(720, '103.135.252.94', '2022-01-21 01:47:07am', 1, '2022-01-20 19:47:07', '2022-01-20 19:47:07'),
(721, '35.196.68.181', '2022-01-21 01:50:06am', 1, '2022-01-20 19:50:06', '2022-01-20 19:50:06'),
(722, '88.99.10.249', '2022-01-21 01:55:33am', 1, '2022-01-20 19:55:33', '2022-01-20 19:55:33'),
(723, '88.99.10.249', '2022-01-21 01:57:03am', 1, '2022-01-20 19:57:03', '2022-01-20 19:57:03'),
(724, '54.225.48.56', '2022-01-21 02:17:35am', 1, '2022-01-20 20:17:35', '2022-01-20 20:17:35'),
(725, '176.122.116.214', '2022-01-21 02:44:41am', 1, '2022-01-20 20:44:41', '2022-01-20 20:44:41'),
(726, '66.249.79.14', '2022-01-21 02:44:42am', 1, '2022-01-20 20:44:42', '2022-01-20 20:44:42'),
(727, '54.36.148.247', '2022-01-21 02:55:17am', 1, '2022-01-20 20:55:17', '2022-01-20 20:55:17'),
(728, '156.146.38.144', '2022-01-21 03:01:37am', 1, '2022-01-20 21:01:37', '2022-01-20 21:01:37'),
(729, '81.169.136.222', '2022-01-21 03:03:41am', 1, '2022-01-20 21:03:41', '2022-01-20 21:03:41'),
(730, '66.249.68.55', '2022-01-21 03:26:36am', 1, '2022-01-20 21:26:36', '2022-01-20 21:26:36'),
(731, '66.249.79.31', '2022-01-21 03:38:36am', 1, '2022-01-20 21:38:36', '2022-01-20 21:38:36'),
(732, '137.184.55.166', '2022-01-21 04:27:11am', 1, '2022-01-20 22:27:11', '2022-01-20 22:27:11'),
(733, '137.184.55.166', '2022-01-21 04:27:12am', 1, '2022-01-20 22:27:12', '2022-01-20 22:27:12'),
(734, '137.184.55.166', '2022-01-21 04:27:13am', 1, '2022-01-20 22:27:13', '2022-01-20 22:27:13'),
(735, '45.91.33.24', '2022-01-21 04:48:46am', 1, '2022-01-20 22:48:46', '2022-01-20 22:48:46'),
(736, '45.91.33.24', '2022-01-21 04:48:47am', 1, '2022-01-20 22:48:47', '2022-01-20 22:48:47'),
(737, '5.248.227.205', '2022-01-21 05:40:48am', 1, '2022-01-20 23:40:48', '2022-01-20 23:40:48'),
(738, '5.248.227.205', '2022-01-21 05:40:49am', 1, '2022-01-20 23:40:49', '2022-01-20 23:40:49'),
(739, '5.248.227.205', '2022-01-21 05:40:50am', 1, '2022-01-20 23:40:50', '2022-01-20 23:40:50'),
(740, '195.181.172.72', '2022-01-21 06:01:12am', 1, '2022-01-21 00:01:12', '2022-01-21 00:01:12'),
(741, '157.55.39.48', '2022-01-21 06:25:48am', 1, '2022-01-21 00:25:48', '2022-01-21 00:25:48'),
(742, '185.253.160.139', '2022-01-21 07:26:33am', 1, '2022-01-21 01:26:33', '2022-01-21 01:26:33'),
(743, '137.184.124.38', '2022-01-21 07:56:50am', 1, '2022-01-21 01:56:50', '2022-01-21 01:56:50'),
(744, '137.184.124.38', '2022-01-21 07:56:51am', 1, '2022-01-21 01:56:51', '2022-01-21 01:56:51'),
(745, '121.243.48.43', '2022-01-21 08:28:09am', 1, '2022-01-21 02:28:09', '2022-01-21 02:28:09'),
(746, '123.125.109.138', '2022-01-21 08:34:29am', 1, '2022-01-21 02:34:29', '2022-01-21 02:34:29'),
(747, '77.245.215.131', '2022-01-21 08:39:33am', 1, '2022-01-21 02:39:33', '2022-01-21 02:39:33'),
(748, '185.5.251.166', '2022-01-21 08:47:06am', 1, '2022-01-21 02:47:06', '2022-01-21 02:47:06'),
(749, '50.3.192.88', '2022-01-21 08:47:40am', 1, '2022-01-21 02:47:40', '2022-01-21 02:47:40'),
(750, '103.147.166.159', '2022-01-21 09:12:00am', 1, '2022-01-21 03:12:00', '2022-01-21 03:12:00'),
(751, '103.147.166.159', '2022-01-21 09:12:21am', 1, '2022-01-21 03:12:21', '2022-01-21 03:12:21'),
(752, '178.159.37.84', '2022-01-21 09:53:30am', 1, '2022-01-21 03:53:30', '2022-01-21 03:53:30'),
(753, '34.219.94.21', '2022-01-21 09:53:59am', 1, '2022-01-21 03:53:59', '2022-01-21 03:53:59'),
(754, '131.220.6.152', '2022-01-21 10:56:30am', 1, '2022-01-21 04:56:30', '2022-01-21 04:56:30'),
(755, '163.172.148.199', '2022-01-21 10:59:18am', 1, '2022-01-21 04:59:18', '2022-01-21 04:59:18'),
(756, '178.159.37.24', '2022-01-21 12:07:16pm', 1, '2022-01-21 06:07:16', '2022-01-21 06:07:16'),
(757, '69.171.249.12', '2022-01-21 12:18:41pm', 1, '2022-01-21 06:18:41', '2022-01-21 06:18:41'),
(758, '5.248.227.205', '2022-01-21 12:55:43pm', 1, '2022-01-21 06:55:43', '2022-01-21 06:55:43'),
(759, '5.248.227.205', '2022-01-21 12:55:43pm', 1, '2022-01-21 06:55:43', '2022-01-21 06:55:43'),
(760, '5.248.227.205', '2022-01-21 12:55:44pm', 1, '2022-01-21 06:55:44', '2022-01-21 06:55:44'),
(761, '137.226.113.44', '2022-01-21 01:00:33pm', 1, '2022-01-21 07:00:33', '2022-01-21 07:00:33'),
(762, '137.226.113.44', '2022-01-21 01:00:34pm', 1, '2022-01-21 07:00:34', '2022-01-21 07:00:34'),
(763, '95.161.223.81', '2022-01-21 01:15:25pm', 1, '2022-01-21 07:15:25', '2022-01-21 07:15:25'),
(764, '45.93.80.116', '2022-01-21 01:17:10pm', 1, '2022-01-21 07:17:10', '2022-01-21 07:17:10'),
(765, '66.249.79.14', '2022-01-21 01:29:00pm', 1, '2022-01-21 07:29:00', '2022-01-21 07:29:00'),
(766, '123.125.109.138', '2022-01-21 01:40:31pm', 1, '2022-01-21 07:40:31', '2022-01-21 07:40:31'),
(767, '66.249.68.55', '2022-01-21 02:03:27pm', 1, '2022-01-21 08:03:27', '2022-01-21 08:03:27'),
(768, '66.249.79.29', '2022-01-21 02:13:08pm', 1, '2022-01-21 08:13:08', '2022-01-21 08:13:08'),
(769, '188.93.67.194', '2022-01-21 03:24:15pm', 1, '2022-01-21 09:24:15', '2022-01-21 09:24:15'),
(770, '66.249.79.10', '2022-01-21 04:17:40pm', 1, '2022-01-21 10:17:40', '2022-01-21 10:17:40'),
(771, '195.246.120.176', '2022-01-21 04:33:24pm', 1, '2022-01-21 10:33:24', '2022-01-21 10:33:24'),
(772, '37.111.248.72', '2022-01-21 04:47:53pm', 1, '2022-01-21 10:47:53', '2022-01-21 10:47:53'),
(773, '37.111.248.72', '2022-01-21 04:47:54pm', 1, '2022-01-21 10:47:54', '2022-01-21 10:47:54'),
(774, '20.119.48.19', '2022-01-21 05:00:34pm', 1, '2022-01-21 11:00:34', '2022-01-21 11:00:34'),
(775, '66.249.68.55', '2022-01-21 05:03:36pm', 1, '2022-01-21 11:03:36', '2022-01-21 11:03:36'),
(776, '66.249.79.29', '2022-01-21 05:11:49pm', 1, '2022-01-21 11:11:49', '2022-01-21 11:11:49'),
(777, '118.184.177.109', '2022-01-21 05:45:02pm', 1, '2022-01-21 11:45:02', '2022-01-21 11:45:02'),
(778, '20.119.48.19', '2022-01-21 06:16:20pm', 1, '2022-01-21 12:16:20', '2022-01-21 12:16:20'),
(779, '192.99.110.137', '2022-01-21 06:43:45pm', 1, '2022-01-21 12:43:45', '2022-01-21 12:43:45'),
(780, '185.220.101.158', '2022-01-21 07:06:16pm', 1, '2022-01-21 13:06:16', '2022-01-21 13:06:16'),
(781, '162.55.85.228', '2022-01-21 07:16:11pm', 1, '2022-01-21 13:16:11', '2022-01-21 13:16:11'),
(782, '193.169.253.35', '2022-01-21 09:04:43pm', 1, '2022-01-21 15:04:43', '2022-01-21 15:04:43'),
(783, '128.199.183.114', '2022-01-21 09:52:05pm', 1, '2022-01-21 15:52:06', '2022-01-21 15:52:06'),
(784, '128.199.183.114', '2022-01-21 09:52:08pm', 1, '2022-01-21 15:52:08', '2022-01-21 15:52:08'),
(785, '128.199.183.114', '2022-01-21 09:52:13pm', 1, '2022-01-21 15:52:14', '2022-01-21 15:52:14'),
(786, '51.13.100.245', '2022-01-21 09:54:28pm', 1, '2022-01-21 15:54:28', '2022-01-21 15:54:28'),
(787, '93.75.49.56', '2022-01-21 09:57:57pm', 1, '2022-01-21 15:57:57', '2022-01-21 15:57:57'),
(788, '34.77.162.10', '2022-01-21 10:28:12pm', 1, '2022-01-21 16:28:12', '2022-01-21 16:28:12'),
(789, '185.190.42.200', '2022-01-21 10:36:54pm', 1, '2022-01-21 16:36:54', '2022-01-21 16:36:54'),
(790, '34.77.162.28', '2022-01-21 10:41:56pm', 1, '2022-01-21 16:41:56', '2022-01-21 16:41:56'),
(791, '66.249.79.5', '2022-01-21 11:17:09pm', 1, '2022-01-21 17:17:09', '2022-01-21 17:17:09'),
(792, '66.249.79.11', '2022-01-21 11:51:45pm', 1, '2022-01-21 17:51:45', '2022-01-21 17:51:45'),
(793, '66.249.79.5', '2022-01-22 12:00:23am', 1, '2022-01-21 18:00:23', '2022-01-21 18:00:23'),
(794, '66.249.79.7', '2022-01-22 12:34:55am', 1, '2022-01-21 18:34:55', '2022-01-21 18:34:55'),
(795, '122.193.18.144', '2022-01-22 12:46:04am', 1, '2022-01-21 18:46:04', '2022-01-21 18:46:04'),
(796, '13.56.213.141', '2022-01-22 12:49:02am', 1, '2022-01-21 18:49:02', '2022-01-21 18:49:02'),
(797, '66.249.68.14', '2022-01-22 01:39:17am', 1, '2022-01-21 19:39:17', '2022-01-21 19:39:17'),
(798, '195.2.75.13', '2022-01-22 01:52:09am', 1, '2022-01-21 19:52:09', '2022-01-21 19:52:09'),
(799, '66.249.79.13', '2022-01-22 01:56:10am', 1, '2022-01-21 19:56:10', '2022-01-21 19:56:10'),
(800, '35.237.241.31', '2022-01-22 02:46:57am', 1, '2022-01-21 20:46:57', '2022-01-21 20:46:57'),
(801, '35.237.241.31', '2022-01-22 02:48:01am', 1, '2022-01-21 20:48:01', '2022-01-21 20:48:01'),
(802, '66.249.68.31', '2022-01-22 03:02:39am', 1, '2022-01-21 21:02:39', '2022-01-21 21:02:39'),
(803, '5.253.19.41', '2022-01-22 03:06:45am', 1, '2022-01-21 21:06:45', '2022-01-21 21:06:45'),
(804, '5.253.19.41', '2022-01-22 03:06:48am', 1, '2022-01-21 21:06:48', '2022-01-21 21:06:48'),
(805, '34.77.162.24', '2022-01-22 04:57:28am', 1, '2022-01-21 22:57:28', '2022-01-21 22:57:28'),
(806, '177.234.143.145', '2022-01-22 05:31:18am', 1, '2022-01-21 23:31:18', '2022-01-21 23:31:18'),
(807, '103.148.140.205', '2022-01-22 07:04:37am', 1, '2022-01-22 01:04:37', '2022-01-22 01:04:37'),
(808, '103.148.140.205', '2022-01-22 07:04:41am', 1, '2022-01-22 01:04:41', '2022-01-22 01:04:41'),
(809, '35.231.187.8', '2022-01-22 07:07:24am', 1, '2022-01-22 01:07:24', '2022-01-22 01:07:24'),
(810, '118.184.177.109', '2022-01-22 08:53:56am', 1, '2022-01-22 02:53:56', '2022-01-22 02:53:56'),
(811, '66.249.68.14', '2022-01-22 09:20:00am', 1, '2022-01-22 03:20:00', '2022-01-22 03:20:00'),
(812, '66.249.79.7', '2022-01-22 09:50:33am', 1, '2022-01-22 03:50:33', '2022-01-22 03:50:33'),
(813, '195.123.209.118', '2022-01-22 09:51:46am', 1, '2022-01-22 03:51:46', '2022-01-22 03:51:46'),
(814, '195.123.209.118', '2022-01-22 09:51:47am', 1, '2022-01-22 03:51:47', '2022-01-22 03:51:47'),
(815, '195.123.209.118', '2022-01-22 09:51:48am', 1, '2022-01-22 03:51:48', '2022-01-22 03:51:48'),
(816, '45.248.151.134', '2022-01-22 09:56:37am', 1, '2022-01-22 03:56:37', '2022-01-22 03:56:37'),
(817, '192.185.4.118', '2022-01-22 10:09:50am', 1, '2022-01-22 04:09:50', '2022-01-22 04:09:50'),
(818, '218.95.73.31', '2022-01-22 10:50:18am', 1, '2022-01-22 04:50:18', '2022-01-22 04:50:18'),
(819, '131.220.6.152', '2022-01-22 10:56:36am', 1, '2022-01-22 04:56:36', '2022-01-22 04:56:36'),
(820, '66.249.68.31', '2022-01-22 11:11:40am', 1, '2022-01-22 05:11:40', '2022-01-22 05:11:40'),
(821, '157.55.39.48', '2022-01-22 11:23:41am', 1, '2022-01-22 05:23:41', '2022-01-22 05:23:41'),
(822, '66.249.79.7', '2022-01-22 11:35:51am', 1, '2022-01-22 05:35:51', '2022-01-22 05:35:51'),
(823, '66.249.79.7', '2022-01-22 11:46:29am', 1, '2022-01-22 05:46:29', '2022-01-22 05:46:29'),
(824, '107.173.178.155', '2022-01-22 12:17:56pm', 1, '2022-01-22 06:17:56', '2022-01-22 06:17:56'),
(825, '188.75.186.162', '2022-01-22 12:28:32pm', 1, '2022-01-22 06:28:32', '2022-01-22 06:28:32'),
(826, '123.125.109.131', '2022-01-22 12:31:12pm', 1, '2022-01-22 06:31:12', '2022-01-22 06:31:12'),
(827, '195.181.161.9', '2022-01-22 12:37:35pm', 1, '2022-01-22 06:37:35', '2022-01-22 06:37:35'),
(828, '82.135.136.132', '2022-01-22 01:03:59pm', 1, '2022-01-22 07:03:59', '2022-01-22 07:03:59'),
(829, '49.7.20.108', '2022-01-22 01:33:44pm', 1, '2022-01-22 07:33:44', '2022-01-22 07:33:44'),
(830, '54.36.148.92', '2022-01-22 02:06:44pm', 1, '2022-01-22 08:06:44', '2022-01-22 08:06:44'),
(831, '220.152.113.20', '2022-01-22 03:02:23pm', 1, '2022-01-22 09:02:23', '2022-01-22 09:02:23'),
(832, '137.184.88.248', '2022-01-22 03:37:02pm', 1, '2022-01-22 09:37:02', '2022-01-22 09:37:02'),
(833, '137.184.88.248', '2022-01-22 03:37:03pm', 1, '2022-01-22 09:37:03', '2022-01-22 09:37:03'),
(834, '137.184.88.248', '2022-01-22 03:37:04pm', 1, '2022-01-22 09:37:04', '2022-01-22 09:37:04'),
(835, '195.246.120.176', '2022-01-22 03:38:51pm', 1, '2022-01-22 09:38:51', '2022-01-22 09:38:51'),
(836, '51.158.109.3', '2022-01-22 03:58:09pm', 1, '2022-01-22 09:58:09', '2022-01-22 09:58:09'),
(837, '103.168.207.31', '2022-01-22 03:59:40pm', 1, '2022-01-22 09:59:40', '2022-01-22 09:59:40'),
(838, '83.130.61.110', '2022-01-22 05:09:23pm', 1, '2022-01-22 11:09:23', '2022-01-22 11:09:23'),
(839, '83.130.61.110', '2022-01-22 05:09:26pm', 1, '2022-01-22 11:09:26', '2022-01-22 11:09:26'),
(840, '92.118.160.57', '2022-01-22 05:34:59pm', 1, '2022-01-22 11:34:59', '2022-01-22 11:34:59'),
(841, '49.7.20.108', '2022-01-22 05:40:33pm', 1, '2022-01-22 11:40:33', '2022-01-22 11:40:33'),
(842, '188.234.13.127', '2022-01-22 05:56:55pm', 1, '2022-01-22 11:56:55', '2022-01-22 11:56:55'),
(843, '185.191.34.215', '2022-01-22 06:16:41pm', 1, '2022-01-22 12:16:41', '2022-01-22 12:16:41'),
(844, '66.249.68.14', '2022-01-22 07:36:09pm', 1, '2022-01-22 13:36:09', '2022-01-22 13:36:09'),
(845, '66.249.79.11', '2022-01-22 07:45:15pm', 1, '2022-01-22 13:45:15', '2022-01-22 13:45:15'),
(846, '66.249.68.12', '2022-01-22 08:44:58pm', 1, '2022-01-22 14:44:58', '2022-01-22 14:44:58'),
(847, '51.15.247.214', '2022-01-22 08:49:58pm', 1, '2022-01-22 14:49:58', '2022-01-22 14:49:58'),
(848, '95.114.12.136', '2022-01-22 08:54:07pm', 1, '2022-01-22 14:54:07', '2022-01-22 14:54:07'),
(849, '66.249.79.7', '2022-01-22 09:43:33pm', 1, '2022-01-22 15:43:33', '2022-01-22 15:43:33'),
(850, '173.252.83.2', '2022-01-22 09:52:44pm', 1, '2022-01-22 15:52:44', '2022-01-22 15:52:44'),
(851, '173.252.83.116', '2022-01-22 09:52:44pm', 1, '2022-01-22 15:52:44', '2022-01-22 15:52:44'),
(852, '173.252.83.8', '2022-01-22 09:52:44pm', 1, '2022-01-22 15:52:44', '2022-01-22 15:52:44'),
(853, '5.135.137.50', '2022-01-22 10:01:19pm', 1, '2022-01-22 16:01:19', '2022-01-22 16:01:19'),
(854, '66.249.79.7', '2022-01-22 10:14:02pm', 1, '2022-01-22 16:14:02', '2022-01-22 16:14:02'),
(855, '5.135.137.50', '2022-01-22 10:15:59pm', 1, '2022-01-22 16:15:59', '2022-01-22 16:15:59'),
(856, '51.91.193.178', '2022-01-22 10:35:15pm', 1, '2022-01-22 16:35:15', '2022-01-22 16:35:15'),
(857, '104.200.151.128', '2022-01-22 11:29:18pm', 1, '2022-01-22 17:29:18', '2022-01-22 17:29:18'),
(858, '193.169.255.43', '2022-01-22 11:41:44pm', 1, '2022-01-22 17:41:44', '2022-01-22 17:41:44'),
(859, '193.169.255.43', '2022-01-22 11:41:47pm', 1, '2022-01-22 17:41:47', '2022-01-22 17:41:47'),
(860, '51.222.253.4', '2022-01-23 01:13:30am', 1, '2022-01-22 19:13:30', '2022-01-22 19:13:30'),
(861, '112.134.88.172', '2022-01-23 01:34:37am', 1, '2022-01-22 19:34:37', '2022-01-22 19:34:37'),
(862, '112.134.88.172', '2022-01-23 01:35:03am', 1, '2022-01-22 19:35:03', '2022-01-22 19:35:03'),
(863, '35.241.146.73', '2022-01-23 01:53:25am', 1, '2022-01-22 19:53:25', '2022-01-22 19:53:25'),
(864, '35.241.146.73', '2022-01-23 01:53:25am', 1, '2022-01-22 19:53:25', '2022-01-22 19:53:25'),
(865, '35.241.146.73', '2022-01-23 01:53:26am', 1, '2022-01-22 19:53:26', '2022-01-22 19:53:26'),
(866, '35.241.146.73', '2022-01-23 01:54:28am', 1, '2022-01-22 19:54:28', '2022-01-22 19:54:28'),
(867, '35.241.146.73', '2022-01-23 01:57:05am', 1, '2022-01-22 19:57:05', '2022-01-22 19:57:05'),
(868, '35.241.146.73', '2022-01-23 01:57:06am', 1, '2022-01-22 19:57:06', '2022-01-22 19:57:06'),
(869, '35.241.146.73', '2022-01-23 01:57:06am', 1, '2022-01-22 19:57:06', '2022-01-22 19:57:06'),
(870, '35.241.146.73', '2022-01-23 01:57:09am', 1, '2022-01-22 19:57:09', '2022-01-22 19:57:09'),
(871, '157.55.39.171', '2022-01-23 02:02:20am', 1, '2022-01-22 20:02:20', '2022-01-22 20:02:20'),
(872, '3.15.21.128', '2022-01-23 02:49:44am', 1, '2022-01-22 20:49:44', '2022-01-22 20:49:44'),
(873, '178.159.37.172', '2022-01-23 03:20:57am', 1, '2022-01-22 21:20:57', '2022-01-22 21:20:57'),
(874, '5.2.188.23', '2022-01-23 04:12:12am', 1, '2022-01-22 22:12:12', '2022-01-22 22:12:12'),
(875, '173.231.60.195', '2022-01-23 05:20:57am', 1, '2022-01-22 23:20:57', '2022-01-22 23:20:57'),
(876, '173.231.60.195', '2022-01-23 05:31:11am', 1, '2022-01-22 23:31:11', '2022-01-22 23:31:11'),
(877, '66.249.68.14', '2022-01-23 05:43:29am', 1, '2022-01-22 23:43:29', '2022-01-22 23:43:29'),
(878, '66.249.79.9', '2022-01-23 05:56:15am', 1, '2022-01-22 23:56:15', '2022-01-22 23:56:15'),
(879, '185.220.101.58', '2022-01-23 06:33:01am', 1, '2022-01-23 00:33:02', '2022-01-23 00:33:02'),
(880, '185.220.101.58', '2022-01-23 06:33:05am', 1, '2022-01-23 00:33:05', '2022-01-23 00:33:05'),
(881, '159.224.255.154', '2022-01-23 07:02:20am', 1, '2022-01-23 01:02:20', '2022-01-23 01:02:20'),
(882, '159.224.255.154', '2022-01-23 07:02:25am', 1, '2022-01-23 01:02:25', '2022-01-23 01:02:25'),
(883, '157.90.206.35', '2022-01-23 08:00:52am', 1, '2022-01-23 02:00:52', '2022-01-23 02:00:52'),
(884, '83.138.48.225', '2022-01-23 08:07:49am', 1, '2022-01-23 02:07:49', '2022-01-23 02:07:49'),
(885, '83.138.48.225', '2022-01-23 08:07:52am', 1, '2022-01-23 02:07:52', '2022-01-23 02:07:52'),
(886, '123.125.109.138', '2022-01-23 08:34:18am', 1, '2022-01-23 02:34:18', '2022-01-23 02:34:18'),
(887, '3.143.218.172', '2022-01-23 10:03:24am', 1, '2022-01-23 04:03:24', '2022-01-23 04:03:24'),
(888, '131.220.6.152', '2022-01-23 10:59:56am', 1, '2022-01-23 04:59:56', '2022-01-23 04:59:56'),
(889, '195.246.120.176', '2022-01-23 11:09:16am', 1, '2022-01-23 05:09:16', '2022-01-23 05:09:16'),
(890, '198.71.228.67', '2022-01-23 11:22:41am', 1, '2022-01-23 05:22:41', '2022-01-23 05:22:41'),
(891, '198.71.228.67', '2022-01-23 11:22:43am', 1, '2022-01-23 05:22:43', '2022-01-23 05:22:43'),
(892, '103.250.157.39', '2022-01-23 11:24:34am', 1, '2022-01-23 05:24:34', '2022-01-23 05:24:34'),
(893, '118.179.97.39', '2022-01-23 11:48:15am', 1, '2022-01-23 05:48:15', '2022-01-23 05:48:15'),
(894, '58.250.125.131', '2022-01-23 12:33:56pm', 1, '2022-01-23 06:33:56', '2022-01-23 06:33:56'),
(895, '143.92.56.239', '2022-01-23 12:46:35pm', 1, '2022-01-23 06:46:35', '2022-01-23 06:46:35'),
(896, '220.152.113.20', '2022-01-23 12:58:51pm', 1, '2022-01-23 06:58:51', '2022-01-23 06:58:51'),
(897, '123.183.224.117', '2022-01-23 01:39:43pm', 1, '2022-01-23 07:39:43', '2022-01-23 07:39:43'),
(898, '162.243.4.24', '2022-01-23 01:41:28pm', 1, '2022-01-23 07:41:28', '2022-01-23 07:41:28'),
(899, '78.110.76.8', '2022-01-23 01:41:31pm', 1, '2022-01-23 07:41:31', '2022-01-23 07:41:31'),
(900, '78.110.76.8', '2022-01-23 01:41:40pm', 1, '2022-01-23 07:41:40', '2022-01-23 07:41:40'),
(901, '78.110.76.8', '2022-01-23 01:41:49pm', 1, '2022-01-23 07:41:49', '2022-01-23 07:41:49'),
(902, '45.129.18.193', '2022-01-23 03:10:57pm', 1, '2022-01-23 09:10:57', '2022-01-23 09:10:57'),
(903, '114.130.84.10', '2022-01-23 03:46:57pm', 1, '2022-01-23 09:46:57', '2022-01-23 09:46:57'),
(904, '44.202.154.77', '2022-01-23 03:49:21pm', 1, '2022-01-23 09:49:21', '2022-01-23 09:49:21'),
(905, '103.152.103.50', '2022-01-23 04:53:01pm', 1, '2022-01-23 10:53:02', '2022-01-23 10:53:02'),
(906, '103.152.103.50', '2022-01-23 04:53:19pm', 1, '2022-01-23 10:53:19', '2022-01-23 10:53:19'),
(907, '103.152.103.50', '2022-01-23 04:53:23pm', 1, '2022-01-23 10:53:23', '2022-01-23 10:53:23'),
(908, '103.152.103.50', '2022-01-23 04:54:42pm', 1, '2022-01-23 10:54:42', '2022-01-23 10:54:42'),
(909, '192.29.97.49', '2022-01-23 04:56:26pm', 1, '2022-01-23 10:56:26', '2022-01-23 10:56:26'),
(910, '88.147.179.243', '2022-01-23 05:04:22pm', 1, '2022-01-23 11:04:22', '2022-01-23 11:04:22'),
(911, '46.183.220.228', '2022-01-23 05:05:11pm', 1, '2022-01-23 11:05:11', '2022-01-23 11:05:11'),
(912, '46.183.220.228', '2022-01-23 05:05:18pm', 1, '2022-01-23 11:05:18', '2022-01-23 11:05:18'),
(913, '20.212.80.91', '2022-01-23 05:12:03pm', 1, '2022-01-23 11:12:03', '2022-01-23 11:12:03'),
(914, '123.183.224.119', '2022-01-23 05:37:28pm', 1, '2022-01-23 11:37:28', '2022-01-23 11:37:28'),
(915, '157.245.148.208', '2022-01-23 06:05:10pm', 1, '2022-01-23 12:05:10', '2022-01-23 12:05:10'),
(916, '157.245.148.208', '2022-01-23 06:05:11pm', 1, '2022-01-23 12:05:11', '2022-01-23 12:05:11'),
(917, '157.245.148.208', '2022-01-23 06:05:11pm', 1, '2022-01-23 12:05:11', '2022-01-23 12:05:11'),
(918, '92.118.160.1', '2022-01-23 07:04:28pm', 1, '2022-01-23 13:04:28', '2022-01-23 13:04:28'),
(919, '191.101.132.35', '2022-01-23 07:41:04pm', 1, '2022-01-23 13:41:04', '2022-01-23 13:41:04'),
(920, '191.101.132.35', '2022-01-23 07:41:08pm', 1, '2022-01-23 13:41:08', '2022-01-23 13:41:08'),
(921, '66.249.79.7', '2022-01-23 08:01:32pm', 1, '2022-01-23 14:01:32', '2022-01-23 14:01:32'),
(922, '20.210.211.110', '2022-01-23 08:13:29pm', 1, '2022-01-23 14:13:29', '2022-01-23 14:13:29'),
(923, '31.13.127.8', '2022-01-23 08:22:24pm', 1, '2022-01-23 14:22:24', '2022-01-23 14:22:24'),
(924, '103.135.252.94', '2022-01-23 08:30:04pm', 1, '2022-01-23 14:30:04', '2022-01-23 14:30:04'),
(925, '103.135.252.94', '2022-01-23 08:30:17pm', 1, '2022-01-23 14:30:17', '2022-01-23 14:30:17'),
(926, '65.52.177.173', '2022-01-23 08:31:03pm', 1, '2022-01-23 14:31:03', '2022-01-23 14:31:03'),
(927, '65.52.177.173', '2022-01-23 08:31:04pm', 1, '2022-01-23 14:31:04', '2022-01-23 14:31:04'),
(928, '45.154.255.147', '2022-01-23 08:49:16pm', 1, '2022-01-23 14:49:16', '2022-01-23 14:49:16'),
(929, '173.252.87.18', '2022-01-23 09:56:25pm', 1, '2022-01-23 15:56:25', '2022-01-23 15:56:25'),
(930, '66.249.79.9', '2022-01-23 10:06:35pm', 1, '2022-01-23 16:06:35', '2022-01-23 16:06:35'),
(931, '66.249.68.10', '2022-01-23 10:07:52pm', 1, '2022-01-23 16:07:52', '2022-01-23 16:07:52'),
(932, '45.72.67.57', '2022-01-23 10:47:42pm', 1, '2022-01-23 16:47:43', '2022-01-23 16:47:43'),
(933, '66.249.68.31', '2022-01-23 10:51:43pm', 1, '2022-01-23 16:51:44', '2022-01-23 16:51:44'),
(934, '178.213.2.153', '2022-01-23 11:09:36pm', 1, '2022-01-23 17:09:36', '2022-01-23 17:09:36'),
(935, '178.213.2.153', '2022-01-23 11:09:39pm', 1, '2022-01-23 17:09:39', '2022-01-23 17:09:39'),
(936, '69.171.249.7', '2022-01-23 11:22:37pm', 1, '2022-01-23 17:22:37', '2022-01-23 17:22:37'),
(937, '69.171.249.9', '2022-01-23 11:22:37pm', 1, '2022-01-23 17:22:37', '2022-01-23 17:22:37'),
(938, '69.171.249.12', '2022-01-23 11:22:37pm', 1, '2022-01-23 17:22:37', '2022-01-23 17:22:37'),
(939, '66.249.68.14', '2022-01-23 11:49:40pm', 1, '2022-01-23 17:49:40', '2022-01-23 17:49:40'),
(940, '51.222.253.16', '2022-01-23 11:55:43pm', 1, '2022-01-23 17:55:43', '2022-01-23 17:55:43'),
(941, '66.249.79.7', '2022-01-24 12:03:12am', 1, '2022-01-23 18:03:12', '2022-01-23 18:03:12'),
(942, '192.169.139.161', '2022-01-24 12:22:39am', 1, '2022-01-23 18:22:40', '2022-01-23 18:22:40'),
(943, '198.27.67.187', '2022-01-24 12:24:40am', 1, '2022-01-23 18:24:40', '2022-01-23 18:24:40'),
(944, '66.249.68.29', '2022-01-24 12:29:00am', 1, '2022-01-23 18:29:00', '2022-01-23 18:29:00'),
(945, '165.22.53.92', '2022-01-24 12:35:46am', 1, '2022-01-23 18:35:46', '2022-01-23 18:35:46'),
(946, '165.22.53.92', '2022-01-24 12:35:46am', 1, '2022-01-23 18:35:46', '2022-01-23 18:35:46'),
(947, '165.22.53.92', '2022-01-24 12:35:47am', 1, '2022-01-23 18:35:47', '2022-01-23 18:35:47'),
(948, '209.97.166.240', '2022-01-24 12:37:30am', 1, '2022-01-23 18:37:30', '2022-01-23 18:37:30'),
(949, '209.97.166.240', '2022-01-24 12:37:31am', 1, '2022-01-23 18:37:31', '2022-01-23 18:37:31'),
(950, '209.97.166.240', '2022-01-24 12:37:31am', 1, '2022-01-23 18:37:31', '2022-01-23 18:37:31'),
(951, '103.216.82.153', '2022-01-24 01:18:11am', 1, '2022-01-23 19:18:11', '2022-01-23 19:18:11'),
(952, '20.212.80.91', '2022-01-24 01:20:20am', 1, '2022-01-23 19:20:20', '2022-01-23 19:20:20'),
(953, '185.119.81.109', '2022-01-24 02:27:15am', 1, '2022-01-23 20:27:15', '2022-01-23 20:27:15'),
(954, '185.119.81.109', '2022-01-24 02:27:23am', 1, '2022-01-23 20:27:23', '2022-01-23 20:27:23'),
(955, '185.119.81.109', '2022-01-24 02:28:09am', 1, '2022-01-23 20:28:09', '2022-01-23 20:28:09'),
(956, '185.119.81.109', '2022-01-24 02:28:19am', 1, '2022-01-23 20:28:19', '2022-01-23 20:28:19'),
(957, '185.119.81.109', '2022-01-24 02:28:30am', 1, '2022-01-23 20:28:30', '2022-01-23 20:28:30'),
(958, '185.220.101.15', '2022-01-24 02:46:23am', 1, '2022-01-23 20:46:23', '2022-01-23 20:46:23'),
(959, '103.216.82.19', '2022-01-24 02:48:58am', 1, '2022-01-23 20:48:58', '2022-01-23 20:48:58'),
(960, '51.222.82.224', '2022-01-24 04:25:46am', 1, '2022-01-23 22:25:46', '2022-01-23 22:25:46'),
(961, '195.123.209.118', '2022-01-24 05:53:23am', 1, '2022-01-23 23:53:23', '2022-01-23 23:53:23'),
(962, '195.123.209.118', '2022-01-24 05:53:24am', 1, '2022-01-23 23:53:24', '2022-01-23 23:53:24'),
(963, '195.123.209.118', '2022-01-24 05:53:25am', 1, '2022-01-23 23:53:25', '2022-01-23 23:53:25'),
(964, '217.25.228.35', '2022-01-24 07:12:43am', 1, '2022-01-24 01:12:43', '2022-01-24 01:12:43'),
(965, '54.36.148.106', '2022-01-24 07:53:29am', 1, '2022-01-24 01:53:29', '2022-01-24 01:53:29'),
(966, '123.183.224.115', '2022-01-24 08:33:25am', 1, '2022-01-24 02:33:25', '2022-01-24 02:33:25'),
(967, '23.129.64.214', '2022-01-24 08:52:35am', 1, '2022-01-24 02:52:35', '2022-01-24 02:52:35'),
(968, '199.195.250.77', '2022-01-24 09:19:35am', 1, '2022-01-24 03:19:35', '2022-01-24 03:19:35'),
(969, '103.21.163.76', '2022-01-24 10:34:56am', 1, '2022-01-24 04:34:56', '2022-01-24 04:34:56'),
(970, '54.167.54.126', '2022-01-24 10:44:48am', 1, '2022-01-24 04:44:48', '2022-01-24 04:44:48'),
(971, '131.220.6.152', '2022-01-24 10:57:16am', 1, '2022-01-24 04:57:16', '2022-01-24 04:57:16'),
(972, '92.118.160.9', '2022-01-24 11:26:44am', 1, '2022-01-24 05:26:44', '2022-01-24 05:26:44'),
(973, '118.179.97.39', '2022-01-24 11:45:00am', 1, '2022-01-24 05:45:00', '2022-01-24 05:45:00'),
(974, '118.179.97.39', '2022-01-24 11:46:10am', 1, '2022-01-24 05:46:10', '2022-01-24 05:46:10'),
(975, '118.179.97.39', '2022-01-24 11:49:47am', 1, '2022-01-24 05:49:47', '2022-01-24 05:49:47'),
(976, '178.159.37.159', '2022-01-24 11:53:49am', 1, '2022-01-24 05:53:49', '2022-01-24 05:53:49'),
(977, '66.249.79.7', '2022-01-24 12:05:52pm', 1, '2022-01-24 06:05:52', '2022-01-24 06:05:52'),
(978, '69.171.251.16', '2022-01-24 12:23:43pm', 1, '2022-01-24 06:23:43', '2022-01-24 06:23:43'),
(979, '66.249.79.9', '2022-01-24 12:33:38pm', 1, '2022-01-24 06:33:38', '2022-01-24 06:33:38'),
(980, '124.6.237.205', '2022-01-24 01:09:31pm', 1, '2022-01-24 07:09:31', '2022-01-24 07:09:31'),
(981, '124.6.237.205', '2022-01-24 01:12:31pm', 1, '2022-01-24 07:12:31', '2022-01-24 07:12:31'),
(982, '52.36.218.92', '2022-01-24 01:15:25pm', 1, '2022-01-24 07:15:25', '2022-01-24 07:15:25'),
(983, '52.36.218.92', '2022-01-24 01:15:25pm', 1, '2022-01-24 07:15:25', '2022-01-24 07:15:25'),
(984, '118.184.177.109', '2022-01-24 01:46:35pm', 1, '2022-01-24 07:46:35', '2022-01-24 07:46:35'),
(985, '195.181.172.151', '2022-01-24 02:06:50pm', 1, '2022-01-24 08:06:50', '2022-01-24 08:06:50'),
(986, '95.105.124.60', '2022-01-24 02:21:47pm', 1, '2022-01-24 08:21:47', '2022-01-24 08:21:47'),
(987, '95.105.124.60', '2022-01-24 02:21:51pm', 1, '2022-01-24 08:21:51', '2022-01-24 08:21:51'),
(988, '188.126.73.205', '2022-01-24 02:22:29pm', 1, '2022-01-24 08:22:29', '2022-01-24 08:22:29'),
(989, '220.152.113.20', '2022-01-24 02:55:09pm', 1, '2022-01-24 08:55:09', '2022-01-24 08:55:09'),
(990, '220.152.113.20', '2022-01-24 02:59:50pm', 1, '2022-01-24 08:59:50', '2022-01-24 08:59:50'),
(991, '220.152.113.20', '2022-01-24 03:01:07pm', 1, '2022-01-24 09:01:07', '2022-01-24 09:01:07'),
(992, '220.152.113.20', '2022-01-24 03:02:03pm', 1, '2022-01-24 09:02:03', '2022-01-24 09:02:03'),
(993, '220.152.113.20', '2022-01-24 03:02:16pm', 1, '2022-01-24 09:02:16', '2022-01-24 09:02:16'),
(994, '220.152.113.20', '2022-01-24 03:02:37pm', 1, '2022-01-24 09:02:37', '2022-01-24 09:02:37'),
(995, '92.118.160.9', '2022-01-24 03:04:44pm', 1, '2022-01-24 09:04:44', '2022-01-24 09:04:44'),
(996, '220.152.113.20', '2022-01-24 03:06:12pm', 1, '2022-01-24 09:06:12', '2022-01-24 09:06:12'),
(997, '3.236.223.57', '2022-01-24 03:06:23pm', 1, '2022-01-24 09:06:23', '2022-01-24 09:06:23'),
(998, '118.179.97.39', '2022-01-24 03:14:41pm', 1, '2022-01-24 09:14:41', '2022-01-24 09:14:41'),
(999, '220.152.113.20', '2022-01-24 03:21:23pm', 1, '2022-01-24 09:21:23', '2022-01-24 09:21:23'),
(1000, '220.152.113.20', '2022-01-24 03:21:24pm', 1, '2022-01-24 09:21:24', '2022-01-24 09:21:24'),
(1001, '220.152.113.20', '2022-01-24 03:21:25pm', 1, '2022-01-24 09:21:25', '2022-01-24 09:21:25'),
(1002, '118.179.97.39', '2022-01-24 03:25:26pm', 1, '2022-01-24 09:25:26', '2022-01-24 09:25:26'),
(1003, '118.179.97.39', '2022-01-24 03:41:30pm', 1, '2022-01-24 09:41:30', '2022-01-24 09:41:30'),
(1004, '46.183.218.131', '2022-01-24 03:45:34pm', 1, '2022-01-24 09:45:34', '2022-01-24 09:45:34'),
(1005, '118.179.97.39', '2022-01-24 03:46:06pm', 1, '2022-01-24 09:46:06', '2022-01-24 09:46:06'),
(1006, '64.233.173.245', '2022-01-24 03:46:26pm', 1, '2022-01-24 09:46:26', '2022-01-24 09:46:26'),
(1007, '66.249.82.106', '2022-01-24 03:46:31pm', 1, '2022-01-24 09:46:31', '2022-01-24 09:46:31'),
(1008, '66.249.82.108', '2022-01-24 03:46:31pm', 1, '2022-01-24 09:46:31', '2022-01-24 09:46:31'),
(1009, '66.249.82.106', '2022-01-24 03:46:35pm', 1, '2022-01-24 09:46:35', '2022-01-24 09:46:35'),
(1010, '66.249.82.106', '2022-01-24 03:46:36pm', 1, '2022-01-24 09:46:36', '2022-01-24 09:46:36'),
(1011, '66.249.82.124', '2022-01-24 03:46:40pm', 1, '2022-01-24 09:46:40', '2022-01-24 09:46:40'),
(1012, '66.249.82.120', '2022-01-24 03:46:41pm', 1, '2022-01-24 09:46:41', '2022-01-24 09:46:41'),
(1013, '220.152.113.20', '2022-01-24 03:48:48pm', 1, '2022-01-24 09:48:48', '2022-01-24 09:48:48'),
(1014, '118.179.97.39', '2022-01-24 03:51:29pm', 1, '2022-01-24 09:51:29', '2022-01-24 09:51:29'),
(1015, '220.152.113.20', '2022-01-24 04:01:35pm', 1, '2022-01-24 10:01:35', '2022-01-24 10:01:35'),
(1016, '118.179.97.39', '2022-01-24 04:21:52pm', 1, '2022-01-24 10:21:52', '2022-01-24 10:21:52'),
(1017, '118.179.97.39', '2022-01-24 04:22:31pm', 1, '2022-01-24 10:22:32', '2022-01-24 10:22:32'),
(1018, '118.179.97.39', '2022-01-24 04:22:42pm', 1, '2022-01-24 10:22:42', '2022-01-24 10:22:42'),
(1019, '118.179.97.39', '2022-01-24 04:23:00pm', 1, '2022-01-24 10:23:00', '2022-01-24 10:23:00'),
(1020, '95.163.255.73', '2022-01-24 04:24:36pm', 1, '2022-01-24 10:24:36', '2022-01-24 10:24:36'),
(1021, '220.152.113.20', '2022-01-24 04:41:52pm', 1, '2022-01-24 10:41:52', '2022-01-24 10:41:52'),
(1022, '220.152.113.20', '2022-01-24 04:41:55pm', 1, '2022-01-24 10:41:55', '2022-01-24 10:41:55'),
(1023, '220.152.113.20', '2022-01-24 04:50:36pm', 1, '2022-01-24 10:50:36', '2022-01-24 10:50:36'),
(1024, '51.222.253.1', '2022-01-24 05:09:39pm', 1, '2022-01-24 11:09:39', '2022-01-24 11:09:39'),
(1025, '188.163.73.203', '2022-01-24 05:28:26pm', 1, '2022-01-24 11:28:26', '2022-01-24 11:28:26'),
(1026, '188.163.73.203', '2022-01-24 05:28:29pm', 1, '2022-01-24 11:28:29', '2022-01-24 11:28:29'),
(1027, '118.184.177.112', '2022-01-24 05:45:47pm', 1, '2022-01-24 11:45:47', '2022-01-24 11:45:47'),
(1028, '220.152.113.20', '2022-01-24 05:53:49pm', 1, '2022-01-24 11:53:49', '2022-01-24 11:53:49'),
(1029, '188.234.13.127', '2022-01-24 06:11:15pm', 1, '2022-01-24 12:11:15', '2022-01-24 12:11:15'),
(1030, '52.114.32.212', '2022-01-24 06:18:22pm', 1, '2022-01-24 12:18:22', '2022-01-24 12:18:22'),
(1031, '69.171.231.120', '2022-01-24 06:25:39pm', 1, '2022-01-24 12:25:40', '2022-01-24 12:25:40'),
(1032, '69.171.231.1', '2022-01-24 06:25:41pm', 1, '2022-01-24 12:25:41', '2022-01-24 12:25:41'),
(1033, '45.132.207.213', '2022-01-24 06:56:07pm', 1, '2022-01-24 12:56:07', '2022-01-24 12:56:07'),
(1034, '37.190.215.99', '2022-01-24 07:14:31pm', 1, '2022-01-24 13:14:31', '2022-01-24 13:14:31'),
(1035, '37.190.215.99', '2022-01-24 07:14:34pm', 1, '2022-01-24 13:14:34', '2022-01-24 13:14:34'),
(1036, '167.114.156.50', '2022-01-24 07:28:09pm', 1, '2022-01-24 13:28:09', '2022-01-24 13:28:09'),
(1037, '167.114.156.50', '2022-01-24 07:28:11pm', 1, '2022-01-24 13:28:11', '2022-01-24 13:28:11'),
(1038, '167.114.156.50', '2022-01-24 07:28:11pm', 1, '2022-01-24 13:28:11', '2022-01-24 13:28:11');
INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`, `status`, `created_at`, `updated_at`) VALUES
(1039, '167.114.156.50', '2022-01-24 07:28:12pm', 1, '2022-01-24 13:28:12', '2022-01-24 13:28:12'),
(1040, '167.114.156.50', '2022-01-24 07:28:15pm', 1, '2022-01-24 13:28:15', '2022-01-24 13:28:15'),
(1041, '88.230.168.101', '2022-01-24 08:31:10pm', 1, '2022-01-24 14:31:10', '2022-01-24 14:31:10'),
(1042, '103.199.87.206', '2022-01-24 08:37:37pm', 1, '2022-01-24 14:37:37', '2022-01-24 14:37:37'),
(1043, '77.111.247.45', '2022-01-24 08:56:28pm', 1, '2022-01-24 14:56:28', '2022-01-24 14:56:28'),
(1044, '103.240.160.21', '2022-01-24 09:13:35pm', 1, '2022-01-24 15:13:35', '2022-01-24 15:13:35'),
(1045, '157.55.39.48', '2022-01-24 09:30:10pm', 1, '2022-01-24 15:30:10', '2022-01-24 15:30:10'),
(1046, '87.250.224.11', '2022-01-24 09:54:46pm', 1, '2022-01-24 15:54:46', '2022-01-24 15:54:46'),
(1047, '27.131.13.66', '2022-01-24 09:55:13pm', 1, '2022-01-24 15:55:13', '2022-01-24 15:55:13'),
(1048, '103.152.147.130', '2022-01-24 10:24:50pm', 1, '2022-01-24 16:24:50', '2022-01-24 16:24:50'),
(1049, '103.199.87.206', '2022-01-24 10:26:52pm', 1, '2022-01-24 16:26:52', '2022-01-24 16:26:52'),
(1050, '103.147.166.152', '2022-01-24 10:39:43pm', 1, '2022-01-24 16:39:43', '2022-01-24 16:39:43'),
(1051, '103.147.166.152', '2022-01-24 10:40:21pm', 1, '2022-01-24 16:40:21', '2022-01-24 16:40:21'),
(1052, '103.147.166.152', '2022-01-24 10:40:29pm', 1, '2022-01-24 16:40:29', '2022-01-24 16:40:29'),
(1053, '103.147.166.152', '2022-01-24 10:40:33pm', 1, '2022-01-24 16:40:33', '2022-01-24 16:40:33'),
(1054, '5.248.227.205', '2022-01-24 11:17:20pm', 1, '2022-01-24 17:17:20', '2022-01-24 17:17:20'),
(1055, '5.248.227.205', '2022-01-24 11:17:20pm', 1, '2022-01-24 17:17:20', '2022-01-24 17:17:20'),
(1056, '5.248.227.205', '2022-01-24 11:17:21pm', 1, '2022-01-24 17:17:21', '2022-01-24 17:17:21'),
(1057, '5.2.205.186', '2022-01-24 11:38:19pm', 1, '2022-01-24 17:38:19', '2022-01-24 17:38:19'),
(1058, '185.51.66.150', '2022-01-24 11:41:28pm', 1, '2022-01-24 17:41:28', '2022-01-24 17:41:28'),
(1059, '138.199.59.157', '2022-01-24 11:46:35pm', 1, '2022-01-24 17:46:35', '2022-01-24 17:46:35'),
(1060, '31.13.115.22', '2022-01-24 11:52:34pm', 1, '2022-01-24 17:52:34', '2022-01-24 17:52:34'),
(1061, '5.135.137.50', '2022-01-25 12:01:26am', 1, '2022-01-24 18:01:26', '2022-01-24 18:01:26'),
(1062, '177.41.94.97', '2022-01-25 12:11:17am', 1, '2022-01-24 18:11:17', '2022-01-24 18:11:17'),
(1063, '5.135.137.50', '2022-01-25 12:25:35am', 1, '2022-01-24 18:25:35', '2022-01-24 18:25:35'),
(1064, '201.120.27.15', '2022-01-25 12:36:00am', 1, '2022-01-24 18:36:00', '2022-01-24 18:36:00'),
(1065, '54.36.148.32', '2022-01-25 12:58:49am', 1, '2022-01-24 18:58:49', '2022-01-24 18:58:49'),
(1066, '66.220.149.30', '2022-01-25 01:11:54am', 1, '2022-01-24 19:11:54', '2022-01-24 19:11:54'),
(1067, '171.25.193.77', '2022-01-25 02:06:51am', 1, '2022-01-24 20:06:51', '2022-01-24 20:06:51'),
(1068, '216.244.66.236', '2022-01-25 02:11:13am', 1, '2022-01-24 20:11:13', '2022-01-24 20:11:13'),
(1069, '104.36.16.200', '2022-01-25 02:49:53am', 1, '2022-01-24 20:49:53', '2022-01-24 20:49:53'),
(1070, '130.255.166.158', '2022-01-25 04:13:32am', 1, '2022-01-24 22:13:32', '2022-01-24 22:13:32'),
(1071, '31.134.125.80', '2022-01-25 04:31:11am', 1, '2022-01-24 22:31:11', '2022-01-24 22:31:11'),
(1072, '176.31.106.179', '2022-01-25 04:58:55am', 1, '2022-01-24 22:58:55', '2022-01-24 22:58:55'),
(1073, '178.159.37.159', '2022-01-25 05:02:32am', 1, '2022-01-24 23:02:32', '2022-01-24 23:02:32'),
(1074, '34.96.130.20', '2022-01-25 05:03:01am', 1, '2022-01-24 23:03:01', '2022-01-24 23:03:01'),
(1075, '103.216.82.22', '2022-01-25 06:27:52am', 1, '2022-01-25 00:27:52', '2022-01-25 00:27:52'),
(1076, '173.252.95.6', '2022-01-25 06:41:09am', 1, '2022-01-25 00:41:09', '2022-01-25 00:41:09'),
(1077, '83.138.48.225', '2022-01-25 07:01:43am', 1, '2022-01-25 01:01:43', '2022-01-25 01:01:43'),
(1078, '83.138.48.225', '2022-01-25 07:01:46am', 1, '2022-01-25 01:01:46', '2022-01-25 01:01:46'),
(1079, '188.163.73.203', '2022-01-25 07:21:44am', 1, '2022-01-25 01:21:44', '2022-01-25 01:21:44'),
(1080, '188.163.46.154', '2022-01-25 07:23:10am', 1, '2022-01-25 01:23:10', '2022-01-25 01:23:10'),
(1081, '188.163.46.154', '2022-01-25 07:23:14am', 1, '2022-01-25 01:23:14', '2022-01-25 01:23:14'),
(1082, '188.163.46.154', '2022-01-25 07:23:14am', 1, '2022-01-25 01:23:14', '2022-01-25 01:23:14'),
(1083, '192.99.18.136', '2022-01-25 07:59:02am', 1, '2022-01-25 01:59:02', '2022-01-25 01:59:02'),
(1084, '192.99.18.136', '2022-01-25 07:59:24am', 1, '2022-01-25 01:59:24', '2022-01-25 01:59:24'),
(1085, '192.99.18.136', '2022-01-25 07:59:25am', 1, '2022-01-25 01:59:25', '2022-01-25 01:59:25'),
(1086, '188.126.73.205', '2022-01-25 08:16:07am', 1, '2022-01-25 02:16:07', '2022-01-25 02:16:07'),
(1087, '116.58.201.6', '2022-01-25 08:24:29am', 1, '2022-01-25 02:24:29', '2022-01-25 02:24:29'),
(1088, '123.125.109.43', '2022-01-25 08:34:40am', 1, '2022-01-25 02:34:40', '2022-01-25 02:34:40'),
(1089, '34.219.94.21', '2022-01-25 09:02:15am', 1, '2022-01-25 03:02:15', '2022-01-25 03:02:15'),
(1090, '35.196.156.174', '2022-01-25 09:59:49am', 1, '2022-01-25 03:59:49', '2022-01-25 03:59:49'),
(1091, '35.196.156.174', '2022-01-25 10:01:09am', 1, '2022-01-25 04:01:09', '2022-01-25 04:01:09'),
(1092, '83.130.61.110', '2022-01-25 10:04:38am', 1, '2022-01-25 04:04:38', '2022-01-25 04:04:38'),
(1093, '83.130.61.110', '2022-01-25 10:04:42am', 1, '2022-01-25 04:04:42', '2022-01-25 04:04:42'),
(1094, '216.244.66.236', '2022-01-25 10:08:16am', 1, '2022-01-25 04:08:16', '2022-01-25 04:08:16'),
(1095, '212.193.142.193', '2022-01-25 10:09:50am', 1, '2022-01-25 04:09:50', '2022-01-25 04:09:50'),
(1096, '212.193.142.193', '2022-01-25 10:09:53am', 1, '2022-01-25 04:09:53', '2022-01-25 04:09:53'),
(1097, '188.234.13.127', '2022-01-25 10:26:09am', 1, '2022-01-25 04:26:09', '2022-01-25 04:26:09'),
(1098, '148.251.121.91', '2022-01-25 10:27:38am', 1, '2022-01-25 04:27:38', '2022-01-25 04:27:38'),
(1099, '148.251.121.91', '2022-01-25 10:27:39am', 1, '2022-01-25 04:27:39', '2022-01-25 04:27:39'),
(1100, '51.222.253.4', '2022-01-25 10:42:07am', 1, '2022-01-25 04:42:07', '2022-01-25 04:42:07'),
(1101, '154.51.131.142', '2022-01-25 10:48:36am', 1, '2022-01-25 04:48:36', '2022-01-25 04:48:36'),
(1102, '131.220.6.152', '2022-01-25 10:52:10am', 1, '2022-01-25 04:52:10', '2022-01-25 04:52:10'),
(1103, '156.146.50.89', '2022-01-25 11:34:42am', 1, '2022-01-25 05:34:42', '2022-01-25 05:34:42'),
(1104, '156.146.50.89', '2022-01-25 11:34:46am', 1, '2022-01-25 05:34:46', '2022-01-25 05:34:46'),
(1105, '146.70.52.72', '2022-01-25 12:06:33pm', 1, '2022-01-25 06:06:33', '2022-01-25 06:06:33'),
(1106, '37.111.203.79', '2022-01-25 12:32:59pm', 1, '2022-01-25 06:33:00', '2022-01-25 06:33:00'),
(1107, '78.101.70.157', '2022-01-25 12:58:59pm', 1, '2022-01-25 06:58:59', '2022-01-25 06:58:59'),
(1108, '78.101.70.157', '2022-01-25 01:02:37pm', 1, '2022-01-25 07:02:37', '2022-01-25 07:02:37'),
(1109, '78.101.70.157', '2022-01-25 01:02:57pm', 1, '2022-01-25 07:02:57', '2022-01-25 07:02:57'),
(1110, '78.101.70.157', '2022-01-25 01:03:26pm', 1, '2022-01-25 07:03:26', '2022-01-25 07:03:26'),
(1111, '78.101.70.157', '2022-01-25 01:04:18pm', 1, '2022-01-25 07:04:18', '2022-01-25 07:04:18'),
(1112, '78.101.70.157', '2022-01-25 01:04:37pm', 1, '2022-01-25 07:04:37', '2022-01-25 07:04:37'),
(1113, '78.101.70.157', '2022-01-25 01:04:44pm', 1, '2022-01-25 07:04:44', '2022-01-25 07:04:44'),
(1114, '165.22.50.85', '2022-01-25 01:27:50pm', 1, '2022-01-25 07:27:50', '2022-01-25 07:27:50'),
(1115, '165.22.50.85', '2022-01-25 01:27:50pm', 1, '2022-01-25 07:27:50', '2022-01-25 07:27:50'),
(1116, '165.22.50.85', '2022-01-25 01:27:51pm', 1, '2022-01-25 07:27:51', '2022-01-25 07:27:51'),
(1117, '34.138.102.122', '2022-01-25 01:41:48pm', 1, '2022-01-25 07:41:48', '2022-01-25 07:41:48'),
(1118, '54.36.149.33', '2022-01-25 01:42:12pm', 1, '2022-01-25 07:42:12', '2022-01-25 07:42:12'),
(1119, '118.184.177.112', '2022-01-25 02:08:06pm', 1, '2022-01-25 08:08:06', '2022-01-25 08:08:06'),
(1120, '209.141.51.222', '2022-01-25 02:25:57pm', 1, '2022-01-25 08:25:57', '2022-01-25 08:25:57'),
(1121, '8.45.145.16', '2022-01-25 02:25:58pm', 1, '2022-01-25 08:25:58', '2022-01-25 08:25:58'),
(1122, '66.249.79.5', '2022-01-25 02:37:12pm', 1, '2022-01-25 08:37:12', '2022-01-25 08:37:12'),
(1123, '170.155.100.128', '2022-01-25 03:08:19pm', 1, '2022-01-25 09:08:19', '2022-01-25 09:08:19'),
(1124, '176.219.47.232', '2022-01-25 03:10:29pm', 1, '2022-01-25 09:10:29', '2022-01-25 09:10:29'),
(1125, '54.36.148.255', '2022-01-25 03:20:28pm', 1, '2022-01-25 09:20:28', '2022-01-25 09:20:28'),
(1126, '118.179.97.39', '2022-01-25 03:48:49pm', 1, '2022-01-25 09:48:49', '2022-01-25 09:48:49'),
(1127, '220.152.113.20', '2022-01-25 03:55:43pm', 1, '2022-01-25 09:55:43', '2022-01-25 09:55:43'),
(1128, '118.179.97.39', '2022-01-25 04:20:27pm', 1, '2022-01-25 10:20:27', '2022-01-25 10:20:27'),
(1129, '66.249.79.9', '2022-01-25 04:44:22pm', 1, '2022-01-25 10:44:22', '2022-01-25 10:44:22'),
(1130, '95.128.165.89', '2022-01-25 05:16:30pm', 1, '2022-01-25 11:16:30', '2022-01-25 11:16:30'),
(1131, '118.184.177.112', '2022-01-25 05:43:41pm', 1, '2022-01-25 11:43:41', '2022-01-25 11:43:41'),
(1132, '220.152.113.20', '2022-01-25 05:44:41pm', 1, '2022-01-25 11:44:41', '2022-01-25 11:44:41'),
(1133, '220.152.113.20', '2022-01-25 05:44:48pm', 1, '2022-01-25 11:44:48', '2022-01-25 11:44:48'),
(1134, '220.152.113.20', '2022-01-25 05:56:48pm', 1, '2022-01-25 11:56:48', '2022-01-25 11:56:48'),
(1135, '220.152.113.20', '2022-01-25 05:56:51pm', 1, '2022-01-25 11:56:51', '2022-01-25 11:56:51'),
(1136, '212.108.150.219', '2022-01-25 06:20:12pm', 1, '2022-01-25 12:20:12', '2022-01-25 12:20:12'),
(1137, '212.108.150.219', '2022-01-25 06:22:28pm', 1, '2022-01-25 12:22:28', '2022-01-25 12:22:28'),
(1138, '162.241.253.114', '2022-01-25 06:28:48pm', 1, '2022-01-25 12:28:48', '2022-01-25 12:28:48'),
(1139, '118.179.97.39', '2022-01-25 06:32:38pm', 1, '2022-01-25 12:32:38', '2022-01-25 12:32:38'),
(1140, '118.179.97.39', '2022-01-25 06:32:56pm', 1, '2022-01-25 12:32:56', '2022-01-25 12:32:56'),
(1141, '212.108.150.219', '2022-01-25 06:34:31pm', 1, '2022-01-25 12:34:31', '2022-01-25 12:34:31'),
(1142, '68.118.220.117', '2022-01-25 06:57:30pm', 1, '2022-01-25 12:57:30', '2022-01-25 12:57:30'),
(1143, '51.91.193.178', '2022-01-25 07:31:05pm', 1, '2022-01-25 13:31:05', '2022-01-25 13:31:05'),
(1144, '66.249.68.14', '2022-01-25 08:34:18pm', 1, '2022-01-25 14:34:18', '2022-01-25 14:34:18'),
(1145, '178.159.37.159', '2022-01-25 08:35:12pm', 1, '2022-01-25 14:35:12', '2022-01-25 14:35:12'),
(1146, '178.159.37.66', '2022-01-25 08:41:55pm', 1, '2022-01-25 14:41:55', '2022-01-25 14:41:55'),
(1147, '86.108.32.234', '2022-01-25 09:07:24pm', 1, '2022-01-25 15:07:24', '2022-01-25 15:07:24'),
(1148, '39.103.144.93', '2022-01-25 09:48:25pm', 1, '2022-01-25 15:48:25', '2022-01-25 15:48:25'),
(1149, '202.206.209.235', '2022-01-25 09:49:57pm', 1, '2022-01-25 15:49:57', '2022-01-25 15:49:57'),
(1150, '114.99.223.223', '2022-01-25 09:50:12pm', 1, '2022-01-25 15:50:12', '2022-01-25 15:50:12'),
(1151, '1.57.21.59', '2022-01-25 09:50:18pm', 1, '2022-01-25 15:50:18', '2022-01-25 15:50:18'),
(1152, '119.236.146.2', '2022-01-25 09:50:24pm', 1, '2022-01-25 15:50:24', '2022-01-25 15:50:24'),
(1153, '45.146.171.192', '2022-01-25 09:51:12pm', 1, '2022-01-25 15:51:13', '2022-01-25 15:51:13'),
(1154, '45.146.171.192', '2022-01-25 09:51:16pm', 1, '2022-01-25 15:51:16', '2022-01-25 15:51:16'),
(1155, '149.200.255.109', '2022-01-25 10:23:11pm', 1, '2022-01-25 16:23:11', '2022-01-25 16:23:11'),
(1156, '189.10.252.116', '2022-01-25 10:23:11pm', 1, '2022-01-25 16:23:11', '2022-01-25 16:23:11'),
(1157, '66.249.79.7', '2022-01-25 10:26:04pm', 1, '2022-01-25 16:26:04', '2022-01-25 16:26:04'),
(1158, '66.249.68.29', '2022-01-25 10:49:28pm', 1, '2022-01-25 16:49:28', '2022-01-25 16:49:28'),
(1159, '103.135.252.94', '2022-01-25 11:37:53pm', 1, '2022-01-25 17:37:54', '2022-01-25 17:37:54'),
(1160, '103.251.225.16', '2022-01-25 11:49:41pm', 1, '2022-01-25 17:49:41', '2022-01-25 17:49:41'),
(1161, '178.153.51.52', '2022-01-26 12:53:11am', 1, '2022-01-25 18:53:11', '2022-01-25 18:53:11'),
(1162, '1.169.121.205', '2022-01-26 01:00:11am', 1, '2022-01-25 19:00:11', '2022-01-25 19:00:11'),
(1163, '173.252.111.111', '2022-01-26 01:17:11am', 1, '2022-01-25 19:17:11', '2022-01-25 19:17:11'),
(1164, '173.252.111.116', '2022-01-26 01:17:11am', 1, '2022-01-25 19:17:11', '2022-01-25 19:17:11'),
(1165, '64.246.165.140', '2022-01-26 01:20:12am', 1, '2022-01-25 19:20:12', '2022-01-25 19:20:12'),
(1166, '1.169.121.205', '2022-01-26 01:25:21am', 1, '2022-01-25 19:25:21', '2022-01-25 19:25:21'),
(1167, '81.163.105.69', '2022-01-26 01:25:44am', 1, '2022-01-25 19:25:44', '2022-01-25 19:25:44'),
(1168, '1.169.121.205', '2022-01-26 01:28:50am', 1, '2022-01-25 19:28:50', '2022-01-25 19:28:50'),
(1169, '46.148.234.229', '2022-01-26 01:31:50am', 1, '2022-01-25 19:31:50', '2022-01-25 19:31:50'),
(1170, '46.148.234.229', '2022-01-26 01:31:53am', 1, '2022-01-25 19:31:53', '2022-01-25 19:31:53'),
(1171, '1.169.121.205', '2022-01-26 01:34:36am', 1, '2022-01-25 19:34:36', '2022-01-25 19:34:36'),
(1172, '37.20.242.211', '2022-01-26 01:35:15am', 1, '2022-01-25 19:35:15', '2022-01-25 19:35:15'),
(1173, '192.99.18.122', '2022-01-26 02:06:00am', 1, '2022-01-25 20:06:00', '2022-01-25 20:06:00'),
(1174, '192.99.18.122', '2022-01-26 02:06:08am', 1, '2022-01-25 20:06:08', '2022-01-25 20:06:08'),
(1175, '192.99.18.122', '2022-01-26 02:06:09am', 1, '2022-01-25 20:06:09', '2022-01-25 20:06:09'),
(1176, '185.220.101.142', '2022-01-26 02:28:54am', 1, '2022-01-25 20:28:55', '2022-01-25 20:28:55'),
(1177, '1.169.121.205', '2022-01-26 02:31:15am', 1, '2022-01-25 20:31:15', '2022-01-25 20:31:15'),
(1178, '95.216.15.49', '2022-01-26 02:44:37am', 1, '2022-01-25 20:44:37', '2022-01-25 20:44:37'),
(1179, '178.214.244.68', '2022-01-26 02:50:11am', 1, '2022-01-25 20:50:11', '2022-01-25 20:50:11'),
(1180, '176.9.137.17', '2022-01-26 03:01:13am', 1, '2022-01-25 21:01:13', '2022-01-25 21:01:13'),
(1181, '176.9.137.17', '2022-01-26 03:05:48am', 1, '2022-01-25 21:05:48', '2022-01-25 21:05:48'),
(1182, '176.9.137.17', '2022-01-26 03:06:30am', 1, '2022-01-25 21:06:30', '2022-01-25 21:06:30'),
(1183, '1.169.121.205', '2022-01-26 03:27:49am', 1, '2022-01-25 21:27:49', '2022-01-25 21:27:49'),
(1184, '46.193.0.47', '2022-01-26 03:49:24am', 1, '2022-01-25 21:49:24', '2022-01-25 21:49:24'),
(1185, '64.71.131.244', '2022-01-26 03:57:17am', 1, '2022-01-25 21:57:17', '2022-01-25 21:57:17'),
(1186, '34.96.130.15', '2022-01-26 04:18:31am', 1, '2022-01-25 22:18:31', '2022-01-25 22:18:31'),
(1187, '51.222.253.12', '2022-01-26 04:23:50am', 1, '2022-01-25 22:23:50', '2022-01-25 22:23:50'),
(1188, '172.94.122.2', '2022-01-26 04:40:04am', 1, '2022-01-25 22:40:04', '2022-01-25 22:40:04'),
(1189, '172.94.122.2', '2022-01-26 04:40:10am', 1, '2022-01-25 22:40:10', '2022-01-25 22:40:10'),
(1190, '164.132.44.97', '2022-01-26 05:18:50am', 1, '2022-01-25 23:18:50', '2022-01-25 23:18:50'),
(1191, '45.227.162.53', '2022-01-26 05:19:57am', 1, '2022-01-25 23:19:57', '2022-01-25 23:19:57'),
(1192, '103.97.100.154', '2022-01-26 05:23:26am', 1, '2022-01-25 23:23:26', '2022-01-25 23:23:26'),
(1193, '104.244.73.169', '2022-01-26 06:08:31am', 1, '2022-01-26 00:08:31', '2022-01-26 00:08:31'),
(1194, '54.149.212.17', '2022-01-26 06:42:19am', 1, '2022-01-26 00:42:19', '2022-01-26 00:42:19'),
(1195, '34.219.253.224', '2022-01-26 06:42:27am', 1, '2022-01-26 00:42:27', '2022-01-26 00:42:27'),
(1196, '34.220.10.35', '2022-01-26 06:42:51am', 1, '2022-01-26 00:42:51', '2022-01-26 00:42:51'),
(1197, '173.252.127.25', '2022-01-26 07:11:09am', 1, '2022-01-26 01:11:09', '2022-01-26 01:11:09'),
(1198, '81.163.105.69', '2022-01-26 07:26:35am', 1, '2022-01-26 01:26:35', '2022-01-26 01:26:35'),
(1199, '138.199.59.163', '2022-01-26 08:12:40am', 1, '2022-01-26 02:12:40', '2022-01-26 02:12:40'),
(1200, '54.36.148.58', '2022-01-26 08:12:41am', 1, '2022-01-26 02:12:41', '2022-01-26 02:12:41'),
(1201, '103.152.147.130', '2022-01-26 08:31:48am', 1, '2022-01-26 02:31:48', '2022-01-26 02:31:48'),
(1202, '37.20.242.211', '2022-01-26 08:35:33am', 1, '2022-01-26 02:35:33', '2022-01-26 02:35:33'),
(1203, '171.25.193.20', '2022-01-26 08:52:22am', 1, '2022-01-26 02:52:22', '2022-01-26 02:52:22'),
(1204, '216.244.66.236', '2022-01-26 09:06:58am', 1, '2022-01-26 03:06:58', '2022-01-26 03:06:58'),
(1205, '118.184.177.112', '2022-01-26 09:15:30am', 1, '2022-01-26 03:15:30', '2022-01-26 03:15:30'),
(1206, '92.124.77.33', '2022-01-26 09:20:20am', 1, '2022-01-26 03:20:20', '2022-01-26 03:20:20'),
(1207, '95.163.255.79', '2022-01-26 09:38:43am', 1, '2022-01-26 03:38:43', '2022-01-26 03:38:43'),
(1208, '66.231.185.132', '2022-01-26 10:02:05am', 1, '2022-01-26 04:02:05', '2022-01-26 04:02:05'),
(1209, '66.231.185.132', '2022-01-26 10:02:12am', 1, '2022-01-26 04:02:12', '2022-01-26 04:02:12'),
(1210, '209.94.58.160', '2022-01-26 10:21:05am', 1, '2022-01-26 04:21:05', '2022-01-26 04:21:05'),
(1211, '142.132.139.44', '2022-01-26 10:44:49am', 1, '2022-01-26 04:44:49', '2022-01-26 04:44:49'),
(1212, '162.142.125.41', '2022-01-26 10:51:43am', 1, '2022-01-26 04:51:43', '2022-01-26 04:51:43'),
(1213, '162.142.125.41', '2022-01-26 10:51:43am', 1, '2022-01-26 04:51:44', '2022-01-26 04:51:44'),
(1214, '131.220.6.152', '2022-01-26 10:53:03am', 1, '2022-01-26 04:53:03', '2022-01-26 04:53:03'),
(1215, '173.231.60.195', '2022-01-26 11:20:53am', 1, '2022-01-26 05:20:53', '2022-01-26 05:20:53'),
(1216, '173.231.60.195', '2022-01-26 11:21:00am', 1, '2022-01-26 05:21:00', '2022-01-26 05:21:00'),
(1217, '173.231.60.195', '2022-01-26 11:26:48am', 1, '2022-01-26 05:26:48', '2022-01-26 05:26:48'),
(1218, '173.231.60.195', '2022-01-26 11:27:27am', 1, '2022-01-26 05:27:27', '2022-01-26 05:27:27'),
(1219, '34.86.35.18', '2022-01-26 11:31:47am', 1, '2022-01-26 05:31:47', '2022-01-26 05:31:47'),
(1220, '34.96.130.7', '2022-01-26 11:44:40am', 1, '2022-01-26 05:44:40', '2022-01-26 05:44:40'),
(1221, '216.244.66.236', '2022-01-26 12:59:22pm', 1, '2022-01-26 06:59:22', '2022-01-26 06:59:22'),
(1222, '5.248.226.73', '2022-01-26 01:04:42pm', 1, '2022-01-26 07:04:42', '2022-01-26 07:04:42'),
(1223, '5.248.226.73', '2022-01-26 01:04:43pm', 1, '2022-01-26 07:04:43', '2022-01-26 07:04:43'),
(1224, '195.246.120.176', '2022-01-26 01:43:53pm', 1, '2022-01-26 07:43:53', '2022-01-26 07:43:53'),
(1225, '118.184.177.112', '2022-01-26 01:49:03pm', 1, '2022-01-26 07:49:03', '2022-01-26 07:49:03'),
(1226, '220.152.113.20', '2022-01-26 02:08:56pm', 1, '2022-01-26 08:08:56', '2022-01-26 08:08:56'),
(1227, '220.152.113.20', '2022-01-26 02:17:15pm', 1, '2022-01-26 08:17:15', '2022-01-26 08:17:15'),
(1228, '220.152.113.20', '2022-01-26 02:21:01pm', 1, '2022-01-26 08:21:01', '2022-01-26 08:21:01'),
(1229, '220.152.113.20', '2022-01-26 02:22:05pm', 1, '2022-01-26 08:22:05', '2022-01-26 08:22:05'),
(1230, '41.221.83.18', '2022-01-26 02:26:34pm', 1, '2022-01-26 08:26:34', '2022-01-26 08:26:34'),
(1231, '220.152.113.20', '2022-01-26 02:39:31pm', 1, '2022-01-26 08:39:31', '2022-01-26 08:39:31'),
(1232, '220.152.113.20', '2022-01-26 02:39:47pm', 1, '2022-01-26 08:39:47', '2022-01-26 08:39:47'),
(1233, '220.152.113.20', '2022-01-26 02:42:13pm', 1, '2022-01-26 08:42:13', '2022-01-26 08:42:13'),
(1234, '220.152.113.20', '2022-01-26 02:42:23pm', 1, '2022-01-26 08:42:23', '2022-01-26 08:42:23'),
(1235, '118.179.97.39', '2022-01-26 02:43:19pm', 1, '2022-01-26 08:43:19', '2022-01-26 08:43:19'),
(1236, '220.152.113.20', '2022-01-26 02:43:46pm', 1, '2022-01-26 08:43:46', '2022-01-26 08:43:46'),
(1237, '220.152.113.20', '2022-01-26 02:52:37pm', 1, '2022-01-26 08:52:37', '2022-01-26 08:52:37'),
(1238, '216.244.66.236', '2022-01-26 03:14:01pm', 1, '2022-01-26 09:14:01', '2022-01-26 09:14:01'),
(1239, '118.179.97.39', '2022-01-26 03:21:46pm', 1, '2022-01-26 09:21:47', '2022-01-26 09:21:47'),
(1240, '220.152.113.20', '2022-01-26 03:21:48pm', 1, '2022-01-26 09:21:48', '2022-01-26 09:21:48'),
(1241, '220.152.113.20', '2022-01-26 03:22:15pm', 1, '2022-01-26 09:22:15', '2022-01-26 09:22:15'),
(1242, '220.152.113.20', '2022-01-26 03:22:17pm', 1, '2022-01-26 09:22:17', '2022-01-26 09:22:17'),
(1243, '118.179.97.39', '2022-01-26 03:22:56pm', 1, '2022-01-26 09:22:56', '2022-01-26 09:22:56'),
(1244, '37.20.242.211', '2022-01-26 03:34:24pm', 1, '2022-01-26 09:34:24', '2022-01-26 09:34:24'),
(1245, '220.152.113.20', '2022-01-26 03:44:41pm', 1, '2022-01-26 09:44:41', '2022-01-26 09:44:41'),
(1246, '216.244.66.236', '2022-01-26 03:54:53pm', 1, '2022-01-26 09:54:53', '2022-01-26 09:54:53'),
(1247, '118.179.97.39', '2022-01-26 03:59:08pm', 1, '2022-01-26 09:59:08', '2022-01-26 09:59:08'),
(1248, '220.152.113.20', '2022-01-26 03:59:10pm', 1, '2022-01-26 09:59:10', '2022-01-26 09:59:10'),
(1249, '118.179.97.39', '2022-01-26 04:04:13pm', 1, '2022-01-26 10:04:13', '2022-01-26 10:04:13'),
(1250, '118.179.97.39', '2022-01-26 04:07:27pm', 1, '2022-01-26 10:07:27', '2022-01-26 10:07:27'),
(1251, '118.179.97.39', '2022-01-26 04:08:25pm', 1, '2022-01-26 10:08:25', '2022-01-26 10:08:25'),
(1252, '220.152.113.20', '2022-01-26 04:13:24pm', 1, '2022-01-26 10:13:24', '2022-01-26 10:13:24'),
(1253, '34.121.26.164', '2022-01-26 04:18:36pm', 1, '2022-01-26 10:18:36', '2022-01-26 10:18:36'),
(1254, '45.132.227.229', '2022-01-26 04:18:37pm', 1, '2022-01-26 10:18:37', '2022-01-26 10:18:37'),
(1255, '87.250.224.11', '2022-01-26 04:26:31pm', 1, '2022-01-26 10:26:31', '2022-01-26 10:26:31'),
(1256, '173.252.79.112', '2022-01-26 04:34:16pm', 1, '2022-01-26 10:34:16', '2022-01-26 10:34:16'),
(1257, '31.13.127.17', '2022-01-26 04:34:17pm', 1, '2022-01-26 10:34:17', '2022-01-26 10:34:17'),
(1258, '54.90.86.170', '2022-01-26 04:47:17pm', 1, '2022-01-26 10:47:17', '2022-01-26 10:47:17'),
(1259, '138.128.118.130', '2022-01-26 04:54:42pm', 1, '2022-01-26 10:54:42', '2022-01-26 10:54:42'),
(1260, '138.128.118.130', '2022-01-26 04:54:51pm', 1, '2022-01-26 10:54:51', '2022-01-26 10:54:51'),
(1261, '220.152.113.20', '2022-01-26 05:01:58pm', 1, '2022-01-26 11:01:58', '2022-01-26 11:01:58'),
(1262, '220.152.113.20', '2022-01-26 05:05:29pm', 1, '2022-01-26 11:05:29', '2022-01-26 11:05:29'),
(1263, '220.152.113.20', '2022-01-26 05:09:17pm', 1, '2022-01-26 11:09:17', '2022-01-26 11:09:17'),
(1264, '45.129.18.184', '2022-01-26 05:30:57pm', 1, '2022-01-26 11:30:57', '2022-01-26 11:30:57'),
(1265, '123.125.109.43', '2022-01-26 05:38:50pm', 1, '2022-01-26 11:38:50', '2022-01-26 11:38:50'),
(1266, '46.161.11.11', '2022-01-26 05:44:42pm', 1, '2022-01-26 11:44:42', '2022-01-26 11:44:42'),
(1267, '109.70.100.24', '2022-01-26 05:55:17pm', 1, '2022-01-26 11:55:17', '2022-01-26 11:55:17'),
(1268, '51.15.127.227', '2022-01-26 05:55:21pm', 1, '2022-01-26 11:55:21', '2022-01-26 11:55:21'),
(1269, '185.220.102.246', '2022-01-26 05:55:24pm', 1, '2022-01-26 11:55:24', '2022-01-26 11:55:24'),
(1270, '51.195.250.11', '2022-01-26 05:55:28pm', 1, '2022-01-26 11:55:28', '2022-01-26 11:55:28'),
(1271, '51.195.250.11', '2022-01-26 05:55:32pm', 1, '2022-01-26 11:55:32', '2022-01-26 11:55:32'),
(1272, '51.195.250.11', '2022-01-26 05:55:36pm', 1, '2022-01-26 11:55:36', '2022-01-26 11:55:36'),
(1273, '220.152.113.20', '2022-01-26 06:25:39pm', 1, '2022-01-26 12:25:39', '2022-01-26 12:25:39'),
(1274, '66.249.68.27', '2022-01-26 06:25:54pm', 1, '2022-01-26 12:25:54', '2022-01-26 12:25:54'),
(1275, '220.152.113.20', '2022-01-26 06:29:10pm', 1, '2022-01-26 12:29:10', '2022-01-26 12:29:10'),
(1276, '197.237.122.154', '2022-01-26 06:38:37pm', 1, '2022-01-26 12:38:37', '2022-01-26 12:38:37'),
(1277, '197.237.122.154', '2022-01-26 06:39:50pm', 1, '2022-01-26 12:39:50', '2022-01-26 12:39:50'),
(1278, '197.237.122.154', '2022-01-26 06:39:54pm', 1, '2022-01-26 12:39:54', '2022-01-26 12:39:54'),
(1279, '197.237.122.154', '2022-01-26 06:40:10pm', 1, '2022-01-26 12:40:10', '2022-01-26 12:40:10'),
(1280, '197.237.122.154', '2022-01-26 06:40:16pm', 1, '2022-01-26 12:40:16', '2022-01-26 12:40:16'),
(1281, '103.120.160.173', '2022-01-26 06:42:12pm', 1, '2022-01-26 12:42:12', '2022-01-26 12:42:12'),
(1282, '51.222.253.4', '2022-01-26 07:25:00pm', 1, '2022-01-26 13:25:00', '2022-01-26 13:25:00'),
(1283, '103.117.193.236', '2022-01-26 08:03:26pm', 1, '2022-01-26 14:03:26', '2022-01-26 14:03:26'),
(1284, '103.174.23.222', '2022-01-26 08:08:53pm', 1, '2022-01-26 14:08:53', '2022-01-26 14:08:53'),
(1285, '20.204.76.163', '2022-01-26 08:52:33pm', 1, '2022-01-26 14:52:33', '2022-01-26 14:52:33'),
(1286, '178.159.37.159', '2022-01-26 08:54:20pm', 1, '2022-01-26 14:54:20', '2022-01-26 14:54:20'),
(1287, '194.32.122.39', '2022-01-26 09:27:01pm', 1, '2022-01-26 15:27:01', '2022-01-26 15:27:01'),
(1288, '197.252.201.157', '2022-01-26 09:51:47pm', 1, '2022-01-26 15:51:47', '2022-01-26 15:51:47'),
(1289, '37.20.242.211', '2022-01-26 10:31:08pm', 1, '2022-01-26 16:31:08', '2022-01-26 16:31:08'),
(1290, '217.25.228.35', '2022-01-26 11:17:29pm', 1, '2022-01-26 17:17:29', '2022-01-26 17:17:29'),
(1291, '54.36.148.134', '2022-01-26 11:38:21pm', 1, '2022-01-26 17:38:21', '2022-01-26 17:38:21'),
(1292, '114.119.155.10', '2022-01-26 11:41:01pm', 1, '2022-01-26 17:41:01', '2022-01-26 17:41:01'),
(1293, '191.101.217.169', '2022-01-26 11:43:35pm', 1, '2022-01-26 17:43:35', '2022-01-26 17:43:35'),
(1294, '216.244.66.236', '2022-01-26 11:54:03pm', 1, '2022-01-26 17:54:03', '2022-01-26 17:54:03'),
(1295, '45.220.2.116', '2022-01-27 12:16:18am', 1, '2022-01-26 18:16:18', '2022-01-26 18:16:18'),
(1296, '114.119.155.111', '2022-01-27 12:30:14am', 1, '2022-01-26 18:30:14', '2022-01-26 18:30:14'),
(1297, '51.222.253.5', '2022-01-27 01:18:43am', 1, '2022-01-26 19:18:43', '2022-01-26 19:18:43'),
(1298, '66.249.79.9', '2022-01-27 01:34:15am', 1, '2022-01-26 19:34:15', '2022-01-26 19:34:15'),
(1299, '95.163.255.75', '2022-01-27 01:57:56am', 1, '2022-01-26 19:57:56', '2022-01-26 19:57:56'),
(1300, '66.249.79.5', '2022-01-27 02:16:14am', 1, '2022-01-26 20:16:14', '2022-01-26 20:16:14'),
(1301, '173.252.127.22', '2022-01-27 02:34:42am', 1, '2022-01-26 20:34:42', '2022-01-26 20:34:42'),
(1302, '66.249.79.9', '2022-01-27 02:34:59am', 1, '2022-01-26 20:34:59', '2022-01-26 20:34:59'),
(1303, '178.159.37.66', '2022-01-27 04:00:48am', 1, '2022-01-26 22:00:48', '2022-01-26 22:00:48'),
(1304, '128.90.61.8', '2022-01-27 04:44:24am', 1, '2022-01-26 22:44:24', '2022-01-26 22:44:24'),
(1305, '37.20.242.211', '2022-01-27 05:32:50am', 1, '2022-01-26 23:32:50', '2022-01-26 23:32:50'),
(1306, '54.174.54.24', '2022-01-27 05:59:49am', 1, '2022-01-26 23:59:49', '2022-01-26 23:59:49'),
(1307, '173.252.83.12', '2022-01-27 07:52:19am', 1, '2022-01-27 01:52:20', '2022-01-27 01:52:20'),
(1308, '173.252.83.21', '2022-01-27 07:52:20am', 1, '2022-01-27 01:52:20', '2022-01-27 01:52:20'),
(1309, '146.0.35.52', '2022-01-27 07:57:24am', 1, '2022-01-27 01:57:24', '2022-01-27 01:57:24'),
(1310, '216.244.66.236', '2022-01-27 08:22:39am', 1, '2022-01-27 02:22:40', '2022-01-27 02:22:40'),
(1311, '123.125.109.43', '2022-01-27 08:34:39am', 1, '2022-01-27 02:34:39', '2022-01-27 02:34:39'),
(1312, '103.240.160.21', '2022-01-27 09:14:01am', 1, '2022-01-27 03:14:01', '2022-01-27 03:14:01'),
(1313, '104.131.65.115', '2022-01-27 09:14:40am', 1, '2022-01-27 03:14:40', '2022-01-27 03:14:40'),
(1314, '104.131.65.115', '2022-01-27 09:14:42am', 1, '2022-01-27 03:14:42', '2022-01-27 03:14:42'),
(1315, '81.163.105.69', '2022-01-27 09:56:54am', 1, '2022-01-27 03:56:54', '2022-01-27 03:56:54'),
(1316, '118.179.97.39', '2022-01-27 10:32:37am', 1, '2022-01-27 04:32:37', '2022-01-27 04:32:37'),
(1317, '195.246.120.176', '2022-01-27 10:33:55am', 1, '2022-01-27 04:33:55', '2022-01-27 04:33:55'),
(1318, '118.179.97.39', '2022-01-27 10:34:22am', 1, '2022-01-27 04:34:22', '2022-01-27 04:34:22'),
(1319, '54.191.65.207', '2022-01-27 10:39:00am', 1, '2022-01-27 04:39:00', '2022-01-27 04:39:00'),
(1320, '131.220.6.152', '2022-01-27 10:56:05am', 1, '2022-01-27 04:56:05', '2022-01-27 04:56:05'),
(1321, '192.99.14.130', '2022-01-27 11:01:13am', 1, '2022-01-27 05:01:13', '2022-01-27 05:01:13'),
(1322, '162.241.252.209', '2022-01-27 11:12:28am', 1, '2022-01-27 05:12:28', '2022-01-27 05:12:28'),
(1323, '51.91.193.178', '2022-01-27 11:23:04am', 1, '2022-01-27 05:23:05', '2022-01-27 05:23:05'),
(1324, '216.244.66.236', '2022-01-27 11:43:27am', 1, '2022-01-27 05:43:27', '2022-01-27 05:43:27'),
(1325, '128.199.68.88', '2022-01-27 12:11:46pm', 1, '2022-01-27 06:11:46', '2022-01-27 06:11:46'),
(1326, '128.199.68.88', '2022-01-27 12:11:46pm', 1, '2022-01-27 06:11:46', '2022-01-27 06:11:46'),
(1327, '128.199.68.88', '2022-01-27 12:11:46pm', 1, '2022-01-27 06:11:46', '2022-01-27 06:11:46'),
(1328, '58.250.125.153', '2022-01-27 12:30:48pm', 1, '2022-01-27 06:30:48', '2022-01-27 06:30:48'),
(1329, '34.229.232.159', '2022-01-27 12:37:52pm', 1, '2022-01-27 06:37:52', '2022-01-27 06:37:52'),
(1330, '128.199.68.88', '2022-01-27 12:40:56pm', 1, '2022-01-27 06:40:56', '2022-01-27 06:40:56'),
(1331, '128.199.68.88', '2022-01-27 12:40:56pm', 1, '2022-01-27 06:40:56', '2022-01-27 06:40:56'),
(1332, '128.199.68.88', '2022-01-27 12:40:57pm', 1, '2022-01-27 06:40:57', '2022-01-27 06:40:57'),
(1333, '37.20.242.211', '2022-01-27 12:42:26pm', 1, '2022-01-27 06:42:26', '2022-01-27 06:42:26'),
(1334, '135.181.78.101', '2022-01-27 12:47:38pm', 1, '2022-01-27 06:47:38', '2022-01-27 06:47:38'),
(1335, '195.123.209.118', '2022-01-27 12:52:16pm', 1, '2022-01-27 06:52:16', '2022-01-27 06:52:16'),
(1336, '195.123.209.118', '2022-01-27 12:52:17pm', 1, '2022-01-27 06:52:17', '2022-01-27 06:52:17'),
(1337, '195.123.209.118', '2022-01-27 12:52:18pm', 1, '2022-01-27 06:52:18', '2022-01-27 06:52:18'),
(1338, '118.184.177.112', '2022-01-27 01:46:17pm', 1, '2022-01-27 07:46:17', '2022-01-27 07:46:17'),
(1339, '114.119.150.149', '2022-01-27 02:04:34pm', 1, '2022-01-27 08:04:34', '2022-01-27 08:04:34'),
(1340, '220.152.113.20', '2022-01-27 02:24:35pm', 1, '2022-01-27 08:24:35', '2022-01-27 08:24:35'),
(1341, '66.249.79.7', '2022-01-27 02:33:15pm', 1, '2022-01-27 08:33:15', '2022-01-27 08:33:15'),
(1342, '188.234.13.127', '2022-01-27 02:36:18pm', 1, '2022-01-27 08:36:18', '2022-01-27 08:36:18'),
(1343, '188.234.13.127', '2022-01-27 02:36:18pm', 1, '2022-01-27 08:36:18', '2022-01-27 08:36:18'),
(1344, '188.234.13.127', '2022-01-27 02:36:21pm', 1, '2022-01-27 08:36:21', '2022-01-27 08:36:21'),
(1345, '3.142.174.97', '2022-01-27 02:40:44pm', 1, '2022-01-27 08:40:44', '2022-01-27 08:40:44'),
(1346, '34.222.177.14', '2022-01-27 02:41:27pm', 1, '2022-01-27 08:41:27', '2022-01-27 08:41:27'),
(1347, '220.152.113.20', '2022-01-27 02:51:29pm', 1, '2022-01-27 08:51:29', '2022-01-27 08:51:29'),
(1348, '220.152.113.20', '2022-01-27 02:56:21pm', 1, '2022-01-27 08:56:21', '2022-01-27 08:56:21'),
(1349, '220.152.113.20', '2022-01-27 03:01:30pm', 1, '2022-01-27 09:01:30', '2022-01-27 09:01:30'),
(1350, '34.215.150.156', '2022-01-27 03:10:21pm', 1, '2022-01-27 09:10:21', '2022-01-27 09:10:21'),
(1351, '51.222.253.15', '2022-01-27 03:16:22pm', 1, '2022-01-27 09:16:22', '2022-01-27 09:16:22'),
(1352, '89.22.255.100', '2022-01-27 03:20:10pm', 1, '2022-01-27 09:20:10', '2022-01-27 09:20:10'),
(1353, '118.179.97.39', '2022-01-27 03:21:01pm', 1, '2022-01-27 09:21:01', '2022-01-27 09:21:01'),
(1354, '118.179.97.39', '2022-01-27 03:26:33pm', 1, '2022-01-27 09:26:33', '2022-01-27 09:26:33'),
(1355, '34.73.79.115', '2022-01-27 03:28:50pm', 1, '2022-01-27 09:28:50', '2022-01-27 09:28:50'),
(1356, '220.152.113.20', '2022-01-27 03:28:59pm', 1, '2022-01-27 09:28:59', '2022-01-27 09:28:59'),
(1357, '118.179.97.39', '2022-01-27 03:29:35pm', 1, '2022-01-27 09:29:35', '2022-01-27 09:29:35'),
(1358, '220.152.113.20', '2022-01-27 03:29:39pm', 1, '2022-01-27 09:29:39', '2022-01-27 09:29:39'),
(1359, '34.73.79.115', '2022-01-27 03:30:00pm', 1, '2022-01-27 09:30:00', '2022-01-27 09:30:00'),
(1360, '45.91.33.24', '2022-01-27 03:40:12pm', 1, '2022-01-27 09:40:12', '2022-01-27 09:40:12'),
(1361, '220.152.113.20', '2022-01-27 03:41:12pm', 1, '2022-01-27 09:41:12', '2022-01-27 09:41:12'),
(1362, '118.179.97.39', '2022-01-27 03:46:26pm', 1, '2022-01-27 09:46:26', '2022-01-27 09:46:26'),
(1363, '118.179.97.39', '2022-01-27 03:47:20pm', 1, '2022-01-27 09:47:20', '2022-01-27 09:47:20'),
(1364, '118.179.97.39', '2022-01-27 03:47:40pm', 1, '2022-01-27 09:47:40', '2022-01-27 09:47:40'),
(1365, '118.179.97.39', '2022-01-27 03:47:47pm', 1, '2022-01-27 09:47:47', '2022-01-27 09:47:47'),
(1366, '220.152.113.20', '2022-01-27 03:50:22pm', 1, '2022-01-27 09:50:22', '2022-01-27 09:50:22'),
(1367, '220.152.113.20', '2022-01-27 03:50:24pm', 1, '2022-01-27 09:50:24', '2022-01-27 09:50:24'),
(1368, '118.179.97.39', '2022-01-27 03:52:50pm', 1, '2022-01-27 09:52:50', '2022-01-27 09:52:50'),
(1369, '220.152.113.20', '2022-01-27 04:02:40pm', 1, '2022-01-27 10:02:40', '2022-01-27 10:02:40'),
(1370, '220.152.113.20', '2022-01-27 04:02:44pm', 1, '2022-01-27 10:02:44', '2022-01-27 10:02:44'),
(1371, '118.179.97.39', '2022-01-27 04:33:10pm', 1, '2022-01-27 10:33:10', '2022-01-27 10:33:10'),
(1372, '220.152.113.20', '2022-01-27 04:46:03pm', 1, '2022-01-27 10:46:03', '2022-01-27 10:46:03'),
(1373, '107.175.85.72', '2022-01-27 04:58:58pm', 1, '2022-01-27 10:58:58', '2022-01-27 10:58:58'),
(1374, '216.244.66.236', '2022-01-27 05:02:00pm', 1, '2022-01-27 11:02:00', '2022-01-27 11:02:00'),
(1375, '220.152.113.20', '2022-01-27 05:08:27pm', 1, '2022-01-27 11:08:27', '2022-01-27 11:08:27'),
(1376, '118.179.97.39', '2022-01-27 05:26:42pm', 1, '2022-01-27 11:26:42', '2022-01-27 11:26:42'),
(1377, '220.152.113.20', '2022-01-27 05:27:06pm', 1, '2022-01-27 11:27:06', '2022-01-27 11:27:06'),
(1378, '220.152.113.20', '2022-01-27 05:27:16pm', 1, '2022-01-27 11:27:16', '2022-01-27 11:27:16'),
(1379, '220.152.113.20', '2022-01-27 05:28:38pm', 1, '2022-01-27 11:28:38', '2022-01-27 11:28:38'),
(1380, '220.152.113.20', '2022-01-27 05:28:49pm', 1, '2022-01-27 11:28:49', '2022-01-27 11:28:49'),
(1381, '220.152.113.20', '2022-01-27 05:28:50pm', 1, '2022-01-27 11:28:50', '2022-01-27 11:28:50'),
(1382, '220.152.113.20', '2022-01-27 05:29:15pm', 1, '2022-01-27 11:29:15', '2022-01-27 11:29:15'),
(1383, '220.152.113.20', '2022-01-27 05:29:30pm', 1, '2022-01-27 11:29:31', '2022-01-27 11:29:31'),
(1384, '220.152.113.20', '2022-01-27 05:31:23pm', 1, '2022-01-27 11:31:23', '2022-01-27 11:31:23'),
(1385, '220.152.113.20', '2022-01-27 05:31:50pm', 1, '2022-01-27 11:31:50', '2022-01-27 11:31:50'),
(1386, '220.152.113.20', '2022-01-27 05:31:58pm', 1, '2022-01-27 11:31:59', '2022-01-27 11:31:59'),
(1387, '220.152.113.20', '2022-01-27 05:32:04pm', 1, '2022-01-27 11:32:04', '2022-01-27 11:32:04'),
(1388, '220.152.113.20', '2022-01-27 05:32:14pm', 1, '2022-01-27 11:32:14', '2022-01-27 11:32:14'),
(1389, '118.179.97.39', '2022-01-27 05:37:27pm', 1, '2022-01-27 11:37:27', '2022-01-27 11:37:27'),
(1390, '118.179.97.39', '2022-01-27 05:38:37pm', 1, '2022-01-27 11:38:37', '2022-01-27 11:38:37'),
(1391, '35.196.68.181', '2022-01-27 05:44:13pm', 1, '2022-01-27 11:44:13', '2022-01-27 11:44:13'),
(1392, '103.118.78.236', '2022-01-27 05:46:36pm', 1, '2022-01-27 11:46:36', '2022-01-27 11:46:36'),
(1393, '103.118.78.236', '2022-01-27 05:48:34pm', 1, '2022-01-27 11:48:34', '2022-01-27 11:48:34'),
(1394, '103.118.78.236', '2022-01-27 05:58:51pm', 1, '2022-01-27 11:58:51', '2022-01-27 11:58:51'),
(1395, '220.152.113.20', '2022-01-27 05:59:51pm', 1, '2022-01-27 11:59:51', '2022-01-27 11:59:51'),
(1396, '103.118.78.236', '2022-01-27 05:59:53pm', 1, '2022-01-27 11:59:53', '2022-01-27 11:59:53'),
(1397, '220.152.113.20', '2022-01-27 06:01:16pm', 1, '2022-01-27 12:01:16', '2022-01-27 12:01:16'),
(1398, '118.184.177.112', '2022-01-27 06:03:27pm', 1, '2022-01-27 12:03:27', '2022-01-27 12:03:27'),
(1399, '220.152.113.20', '2022-01-27 06:04:43pm', 1, '2022-01-27 12:04:43', '2022-01-27 12:04:43'),
(1400, '220.152.113.20', '2022-01-27 06:11:31pm', 1, '2022-01-27 12:11:31', '2022-01-27 12:11:31'),
(1401, '220.152.113.20', '2022-01-27 06:11:48pm', 1, '2022-01-27 12:11:48', '2022-01-27 12:11:48'),
(1402, '220.152.113.20', '2022-01-27 06:11:53pm', 1, '2022-01-27 12:11:53', '2022-01-27 12:11:53'),
(1403, '173.252.95.21', '2022-01-27 06:12:43pm', 1, '2022-01-27 12:12:43', '2022-01-27 12:12:43'),
(1404, '220.152.113.20', '2022-01-27 06:13:08pm', 1, '2022-01-27 12:13:08', '2022-01-27 12:13:08'),
(1405, '220.152.113.20', '2022-01-27 06:13:08pm', 1, '2022-01-27 12:13:08', '2022-01-27 12:13:08'),
(1406, '220.152.113.20', '2022-01-27 06:14:49pm', 1, '2022-01-27 12:14:49', '2022-01-27 12:14:49'),
(1407, '194.32.107.161', '2022-01-27 06:25:36pm', 1, '2022-01-27 12:25:36', '2022-01-27 12:25:36'),
(1408, '220.152.113.20', '2022-01-27 06:26:16pm', 1, '2022-01-27 12:26:16', '2022-01-27 12:26:16'),
(1409, '220.152.113.20', '2022-01-27 06:48:42pm', 1, '2022-01-27 12:48:42', '2022-01-27 12:48:42'),
(1410, '220.152.113.20', '2022-01-27 07:22:52pm', 1, '2022-01-27 13:22:52', '2022-01-27 13:22:52'),
(1411, '77.245.215.131', '2022-01-27 07:26:53pm', 1, '2022-01-27 13:26:53', '2022-01-27 13:26:53'),
(1412, '77.245.215.131', '2022-01-27 07:26:56pm', 1, '2022-01-27 13:26:56', '2022-01-27 13:26:56'),
(1413, '220.152.113.20', '2022-01-27 07:36:55pm', 1, '2022-01-27 13:36:55', '2022-01-27 13:36:55'),
(1414, '220.152.113.20', '2022-01-27 07:37:07pm', 1, '2022-01-27 13:37:07', '2022-01-27 13:37:07'),
(1415, '51.222.253.13', '2022-01-27 07:46:55pm', 1, '2022-01-27 13:46:55', '2022-01-27 13:46:55'),
(1416, '37.20.242.211', '2022-01-27 07:49:17pm', 1, '2022-01-27 13:49:17', '2022-01-27 13:49:17'),
(1417, '45.248.151.9', '2022-01-27 08:18:07pm', 1, '2022-01-27 14:18:07', '2022-01-27 14:18:07'),
(1418, '45.248.151.9', '2022-01-27 08:18:14pm', 1, '2022-01-27 14:18:14', '2022-01-27 14:18:14'),
(1419, '45.248.151.9', '2022-01-27 08:18:16pm', 1, '2022-01-27 14:18:16', '2022-01-27 14:18:16'),
(1420, '45.248.151.9', '2022-01-27 08:18:17pm', 1, '2022-01-27 14:18:17', '2022-01-27 14:18:17'),
(1421, '45.248.151.9', '2022-01-27 08:18:18pm', 1, '2022-01-27 14:18:18', '2022-01-27 14:18:18'),
(1422, '146.0.35.52', '2022-01-27 08:49:27pm', 1, '2022-01-27 14:49:27', '2022-01-27 14:49:27'),
(1423, '84.39.245.2', '2022-01-27 08:59:09pm', 1, '2022-01-27 14:59:09', '2022-01-27 14:59:09'),
(1424, '95.163.255.202', '2022-01-27 10:19:42pm', 1, '2022-01-27 16:19:42', '2022-01-27 16:19:42'),
(1425, '45.129.18.19', '2022-01-27 10:41:39pm', 1, '2022-01-27 16:41:39', '2022-01-27 16:41:39'),
(1426, '178.80.4.108', '2022-01-27 10:59:39pm', 1, '2022-01-27 16:59:39', '2022-01-27 16:59:39'),
(1427, '178.80.4.108', '2022-01-27 10:59:48pm', 1, '2022-01-27 16:59:48', '2022-01-27 16:59:48'),
(1428, '178.80.4.108', '2022-01-27 11:00:08pm', 1, '2022-01-27 17:00:08', '2022-01-27 17:00:08'),
(1429, '103.135.252.94', '2022-01-27 11:08:12pm', 1, '2022-01-27 17:08:12', '2022-01-27 17:08:12'),
(1430, '138.201.142.113', '2022-01-27 11:37:33pm', 1, '2022-01-27 17:37:33', '2022-01-27 17:37:33'),
(1431, '46.45.221.147', '2022-01-27 11:44:54pm', 1, '2022-01-27 17:44:54', '2022-01-27 17:44:54'),
(1432, '37.120.235.157', '2022-01-27 11:49:13pm', 1, '2022-01-27 17:49:13', '2022-01-27 17:49:13'),
(1433, '68.183.226.92', '2022-01-28 12:08:31am', 1, '2022-01-27 18:08:31', '2022-01-27 18:08:31'),
(1434, '68.183.226.92', '2022-01-28 12:08:31am', 1, '2022-01-27 18:08:31', '2022-01-27 18:08:31'),
(1435, '68.183.226.92', '2022-01-28 12:08:32am', 1, '2022-01-27 18:08:32', '2022-01-27 18:08:32'),
(1436, '178.159.37.24', '2022-01-28 01:33:12am', 1, '2022-01-27 19:33:12', '2022-01-27 19:33:12'),
(1437, '185.220.101.83', '2022-01-28 01:44:50am', 1, '2022-01-27 19:44:50', '2022-01-27 19:44:50'),
(1438, '185.181.60.189', '2022-01-28 02:17:14am', 1, '2022-01-27 20:17:14', '2022-01-27 20:17:14'),
(1439, '129.146.18.152', '2022-01-28 02:35:32am', 1, '2022-01-27 20:35:32', '2022-01-27 20:35:32'),
(1440, '129.146.18.152', '2022-01-28 02:50:34am', 1, '2022-01-27 20:50:34', '2022-01-27 20:50:34'),
(1441, '129.146.18.152', '2022-01-28 02:50:56am', 1, '2022-01-27 20:50:56', '2022-01-27 20:50:56'),
(1442, '37.20.242.211', '2022-01-28 03:07:41am', 1, '2022-01-27 21:07:41', '2022-01-27 21:07:41'),
(1443, '111.65.36.56', '2022-01-28 04:04:17am', 1, '2022-01-27 22:04:17', '2022-01-27 22:04:17'),
(1444, '161.35.226.254', '2022-01-28 04:04:59am', 1, '2022-01-27 22:04:59', '2022-01-27 22:04:59'),
(1445, '5.255.97.176', '2022-01-28 04:05:41am', 1, '2022-01-27 22:05:41', '2022-01-27 22:05:41'),
(1446, '138.201.60.47', '2022-01-28 04:21:30am', 1, '2022-01-27 22:21:30', '2022-01-27 22:21:30'),
(1447, '88.147.152.206', '2022-01-28 04:28:36am', 1, '2022-01-27 22:28:36', '2022-01-27 22:28:36'),
(1448, '195.242.103.128', '2022-01-28 04:46:29am', 1, '2022-01-27 22:46:29', '2022-01-27 22:46:29'),
(1449, '195.242.103.128', '2022-01-28 04:46:31am', 1, '2022-01-27 22:46:31', '2022-01-27 22:46:31'),
(1450, '195.242.103.128', '2022-01-28 04:46:31am', 1, '2022-01-27 22:46:31', '2022-01-27 22:46:31'),
(1451, '173.231.60.195', '2022-01-28 05:07:54am', 1, '2022-01-27 23:07:54', '2022-01-27 23:07:54'),
(1452, '105.72.4.96', '2022-01-28 05:08:43am', 1, '2022-01-27 23:08:43', '2022-01-27 23:08:43'),
(1453, '105.72.4.96', '2022-01-28 05:08:55am', 1, '2022-01-27 23:08:55', '2022-01-27 23:08:55'),
(1454, '209.141.32.70', '2022-01-28 05:10:29am', 1, '2022-01-27 23:10:29', '2022-01-27 23:10:29'),
(1455, '34.75.156.240', '2022-01-28 05:29:04am', 1, '2022-01-27 23:29:04', '2022-01-27 23:29:04'),
(1456, '34.75.156.240', '2022-01-28 05:34:58am', 1, '2022-01-27 23:34:58', '2022-01-27 23:34:58'),
(1457, '188.126.73.210', '2022-01-28 05:39:49am', 1, '2022-01-27 23:39:49', '2022-01-27 23:39:49'),
(1458, '66.249.68.29', '2022-01-28 05:43:03am', 1, '2022-01-27 23:43:03', '2022-01-27 23:43:03'),
(1459, '66.249.68.14', '2022-01-28 05:55:09am', 1, '2022-01-27 23:55:09', '2022-01-27 23:55:09'),
(1460, '138.201.142.113', '2022-01-28 06:29:57am', 1, '2022-01-28 00:29:57', '2022-01-28 00:29:57'),
(1461, '34.212.176.121', '2022-01-28 06:43:13am', 1, '2022-01-28 00:43:13', '2022-01-28 00:43:13'),
(1462, '129.146.18.152', '2022-01-28 06:50:51am', 1, '2022-01-28 00:50:51', '2022-01-28 00:50:51'),
(1463, '34.73.234.143', '2022-01-28 06:52:40am', 1, '2022-01-28 00:52:40', '2022-01-28 00:52:40'),
(1464, '137.226.113.44', '2022-01-28 06:53:13am', 1, '2022-01-28 00:53:13', '2022-01-28 00:53:13'),
(1465, '137.226.113.44', '2022-01-28 06:53:14am', 1, '2022-01-28 00:53:14', '2022-01-28 00:53:14'),
(1466, '157.55.39.171', '2022-01-28 07:28:50am', 1, '2022-01-28 01:28:50', '2022-01-28 01:28:50'),
(1467, '138.201.142.113', '2022-01-28 07:45:14am', 1, '2022-01-28 01:45:14', '2022-01-28 01:45:14'),
(1468, '81.163.105.69', '2022-01-28 08:34:26am', 1, '2022-01-28 02:34:26', '2022-01-28 02:34:26'),
(1469, '123.183.224.115', '2022-01-28 08:48:51am', 1, '2022-01-28 02:48:51', '2022-01-28 02:48:51'),
(1470, '178.159.37.66', '2022-01-28 08:58:46am', 1, '2022-01-28 02:58:46', '2022-01-28 02:58:46'),
(1471, '46.161.11.8', '2022-01-28 09:08:27am', 1, '2022-01-28 03:08:27', '2022-01-28 03:08:27'),
(1472, '178.159.37.159', '2022-01-28 09:16:23am', 1, '2022-01-28 03:16:23', '2022-01-28 03:16:23'),
(1473, '87.118.122.51', '2022-01-28 09:59:26am', 1, '2022-01-28 03:59:26', '2022-01-28 03:59:26'),
(1474, '185.220.102.250', '2022-01-28 10:03:28am', 1, '2022-01-28 04:03:28', '2022-01-28 04:03:28'),
(1475, '194.32.107.187', '2022-01-28 10:03:38am', 1, '2022-01-28 04:03:38', '2022-01-28 04:03:38'),
(1476, '92.124.19.172', '2022-01-28 10:05:43am', 1, '2022-01-28 04:05:43', '2022-01-28 04:05:43'),
(1477, '176.214.159.75', '2022-01-28 10:11:40am', 1, '2022-01-28 04:11:40', '2022-01-28 04:11:40'),
(1478, '131.220.6.152', '2022-01-28 10:52:14am', 1, '2022-01-28 04:52:14', '2022-01-28 04:52:14'),
(1479, '173.252.107.3', '2022-01-28 11:01:56am', 1, '2022-01-28 05:01:56', '2022-01-28 05:01:56'),
(1480, '173.252.107.18', '2022-01-28 11:01:56am', 1, '2022-01-28 05:01:56', '2022-01-28 05:01:56'),
(1481, '173.252.107.15', '2022-01-28 11:01:56am', 1, '2022-01-28 05:01:56', '2022-01-28 05:01:56'),
(1482, '111.65.36.56', '2022-01-28 11:03:23am', 1, '2022-01-28 05:03:23', '2022-01-28 05:03:23'),
(1483, '178.165.34.162', '2022-01-28 12:39:51pm', 1, '2022-01-28 06:39:51', '2022-01-28 06:39:51'),
(1484, '178.165.34.162', '2022-01-28 12:39:56pm', 1, '2022-01-28 06:39:56', '2022-01-28 06:39:56'),
(1485, '103.135.252.92', '2022-01-28 01:14:05pm', 1, '2022-01-28 07:14:05', '2022-01-28 07:14:05'),
(1486, '103.135.252.92', '2022-01-28 01:15:47pm', 1, '2022-01-28 07:15:47', '2022-01-28 07:15:47'),
(1487, '49.7.20.111', '2022-01-28 01:32:47pm', 1, '2022-01-28 07:32:48', '2022-01-28 07:32:48'),
(1488, '8.21.110.42', '2022-01-28 02:01:34pm', 1, '2022-01-28 08:01:34', '2022-01-28 08:01:34'),
(1489, '81.163.105.69', '2022-01-28 03:18:04pm', 1, '2022-01-28 09:18:04', '2022-01-28 09:18:04'),
(1490, '77.75.79.109', '2022-01-28 03:31:56pm', 1, '2022-01-28 09:31:56', '2022-01-28 09:31:56'),
(1491, '161.117.9.99', '2022-01-28 04:10:05pm', 1, '2022-01-28 10:10:05', '2022-01-28 10:10:05'),
(1492, '92.124.19.172', '2022-01-28 05:09:36pm', 1, '2022-01-28 11:09:36', '2022-01-28 11:09:36'),
(1493, '65.108.54.128', '2022-01-28 05:25:38pm', 1, '2022-01-28 11:25:38', '2022-01-28 11:25:38'),
(1494, '123.125.109.43', '2022-01-28 05:33:53pm', 1, '2022-01-28 11:33:53', '2022-01-28 11:33:53'),
(1495, '46.161.50.142', '2022-01-28 05:44:08pm', 1, '2022-01-28 11:44:08', '2022-01-28 11:44:08'),
(1496, '46.161.50.142', '2022-01-28 05:44:11pm', 1, '2022-01-28 11:44:11', '2022-01-28 11:44:11'),
(1497, '95.163.255.79', '2022-01-28 06:29:39pm', 1, '2022-01-28 12:29:39', '2022-01-28 12:29:39'),
(1498, '41.142.125.9', '2022-01-28 06:40:31pm', 1, '2022-01-28 12:40:31', '2022-01-28 12:40:31'),
(1499, '114.119.155.217', '2022-01-28 07:16:54pm', 1, '2022-01-28 13:16:54', '2022-01-28 13:16:54'),
(1500, '46.161.11.18', '2022-01-28 08:48:58pm', 1, '2022-01-28 14:48:58', '2022-01-28 14:48:58'),
(1501, '95.163.255.210', '2022-01-28 09:14:23pm', 1, '2022-01-28 15:14:23', '2022-01-28 15:14:23'),
(1502, '46.161.11.113', '2022-01-28 09:27:57pm', 1, '2022-01-28 15:27:57', '2022-01-28 15:27:57'),
(1503, '51.222.253.15', '2022-01-28 09:46:26pm', 1, '2022-01-28 15:46:26', '2022-01-28 15:46:26'),
(1504, '46.161.11.43', '2022-01-28 09:49:09pm', 1, '2022-01-28 15:49:09', '2022-01-28 15:49:09'),
(1505, '217.25.228.35', '2022-01-28 10:01:59pm', 1, '2022-01-28 16:01:59', '2022-01-28 16:01:59'),
(1506, '46.161.11.63', '2022-01-28 10:05:37pm', 1, '2022-01-28 16:05:37', '2022-01-28 16:05:37'),
(1507, '46.161.11.133', '2022-01-28 10:13:21pm', 1, '2022-01-28 16:13:21', '2022-01-28 16:13:21'),
(1508, '46.161.11.93', '2022-01-28 10:16:02pm', 1, '2022-01-28 16:16:02', '2022-01-28 16:16:02'),
(1509, '46.161.11.103', '2022-01-28 10:16:37pm', 1, '2022-01-28 16:16:37', '2022-01-28 16:16:37'),
(1510, '46.161.11.123', '2022-01-28 10:35:54pm', 1, '2022-01-28 16:35:54', '2022-01-28 16:35:54'),
(1511, '46.161.11.53', '2022-01-28 10:41:30pm', 1, '2022-01-28 16:41:30', '2022-01-28 16:41:30'),
(1512, '91.219.236.228', '2022-01-28 10:45:15pm', 1, '2022-01-28 16:45:15', '2022-01-28 16:45:15'),
(1513, '46.161.11.73', '2022-01-28 10:47:44pm', 1, '2022-01-28 16:47:44', '2022-01-28 16:47:44'),
(1514, '45.145.91.88', '2022-01-28 10:59:13pm', 1, '2022-01-28 16:59:13', '2022-01-28 16:59:13'),
(1515, '54.193.147.150', '2022-01-28 11:46:50pm', 1, '2022-01-28 17:46:50', '2022-01-28 17:46:50'),
(1516, '41.215.51.54', '2022-01-29 02:55:58am', 1, '2022-01-28 20:55:58', '2022-01-28 20:55:58'),
(1517, '178.159.37.159', '2022-01-29 03:26:17am', 1, '2022-01-28 21:26:17', '2022-01-28 21:26:17'),
(1518, '108.179.252.65', '2022-01-29 05:52:42am', 1, '2022-01-28 23:52:42', '2022-01-28 23:52:42'),
(1519, '192.0.88.95', '2022-01-29 06:15:35am', 1, '2022-01-29 00:15:35', '2022-01-29 00:15:35'),
(1520, '103.165.155.35', '2022-01-29 07:33:46am', 1, '2022-01-29 01:33:46', '2022-01-29 01:33:46'),
(1521, '66.249.79.11', '2022-01-29 07:47:42am', 1, '2022-01-29 01:47:42', '2022-01-29 01:47:42'),
(1522, '66.249.79.11', '2022-01-29 08:06:28am', 1, '2022-01-29 02:06:28', '2022-01-29 02:06:28'),
(1523, '195.123.209.118', '2022-01-29 08:14:15am', 1, '2022-01-29 02:14:15', '2022-01-29 02:14:15'),
(1524, '195.123.209.118', '2022-01-29 08:14:15am', 1, '2022-01-29 02:14:15', '2022-01-29 02:14:15'),
(1525, '195.123.209.118', '2022-01-29 08:14:16am', 1, '2022-01-29 02:14:16', '2022-01-29 02:14:16'),
(1526, '170.155.100.128', '2022-01-29 08:28:31am', 1, '2022-01-29 02:28:31', '2022-01-29 02:28:31'),
(1527, '66.249.68.14', '2022-01-29 08:33:55am', 1, '2022-01-29 02:33:55', '2022-01-29 02:33:55'),
(1528, '66.249.79.13', '2022-01-29 08:36:18am', 1, '2022-01-29 02:36:18', '2022-01-29 02:36:18'),
(1529, '66.249.79.4', '2022-01-29 08:44:06am', 1, '2022-01-29 02:44:06', '2022-01-29 02:44:06'),
(1530, '89.109.47.213', '2022-01-29 09:11:14am', 1, '2022-01-29 03:11:14', '2022-01-29 03:11:14'),
(1531, '43.224.8.116', '2022-01-29 09:17:42am', 1, '2022-01-29 03:17:42', '2022-01-29 03:17:42'),
(1532, '118.184.177.111', '2022-01-29 09:17:58am', 1, '2022-01-29 03:17:58', '2022-01-29 03:17:58'),
(1533, '192.163.252.85', '2022-01-29 09:18:33am', 1, '2022-01-29 03:18:33', '2022-01-29 03:18:33'),
(1534, '77.75.79.101', '2022-01-29 09:21:07am', 1, '2022-01-29 03:21:07', '2022-01-29 03:21:07'),
(1535, '51.222.253.18', '2022-01-29 09:30:03am', 1, '2022-01-29 03:30:03', '2022-01-29 03:30:03'),
(1536, '66.249.79.7', '2022-01-29 09:48:44am', 1, '2022-01-29 03:48:44', '2022-01-29 03:48:44'),
(1537, '103.9.112.133', '2022-01-29 10:38:57am', 1, '2022-01-29 04:38:57', '2022-01-29 04:38:57'),
(1538, '66.249.79.4', '2022-01-29 10:43:16am', 1, '2022-01-29 04:43:16', '2022-01-29 04:43:16'),
(1539, '131.220.6.152', '2022-01-29 11:00:18am', 1, '2022-01-29 05:00:18', '2022-01-29 05:00:18'),
(1540, '92.124.19.172', '2022-01-29 11:13:23am', 1, '2022-01-29 05:13:23', '2022-01-29 05:13:23'),
(1541, '220.152.113.21', '2022-01-29 11:27:54am', 1, '2022-01-29 05:27:54', '2022-01-29 05:27:54'),
(1542, '81.163.105.69', '2022-01-29 11:43:06am', 1, '2022-01-29 05:43:06', '2022-01-29 05:43:06'),
(1543, '62.182.157.250', '2022-01-29 12:10:11pm', 1, '2022-01-29 06:10:11', '2022-01-29 06:10:11'),
(1544, '123.125.109.43', '2022-01-29 01:33:37pm', 1, '2022-01-29 07:33:37', '2022-01-29 07:33:37'),
(1545, '159.223.76.132', '2022-01-29 01:34:43pm', 1, '2022-01-29 07:34:43', '2022-01-29 07:34:43'),
(1546, '159.223.76.132', '2022-01-29 01:34:44pm', 1, '2022-01-29 07:34:44', '2022-01-29 07:34:44'),
(1547, '159.223.76.132', '2022-01-29 01:34:44pm', 1, '2022-01-29 07:34:44', '2022-01-29 07:34:44'),
(1548, '173.231.60.195', '2022-01-29 01:58:05pm', 1, '2022-01-29 07:58:05', '2022-01-29 07:58:05'),
(1549, '51.222.253.18', '2022-01-29 02:14:48pm', 1, '2022-01-29 08:14:48', '2022-01-29 08:14:48'),
(1550, '178.159.37.66', '2022-01-29 02:23:25pm', 1, '2022-01-29 08:23:25', '2022-01-29 08:23:25');
INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`, `status`, `created_at`, `updated_at`) VALUES
(1551, '178.159.37.66', '2022-01-29 02:23:31pm', 1, '2022-01-29 08:23:31', '2022-01-29 08:23:31'),
(1552, '178.159.37.66', '2022-01-29 02:23:34pm', 1, '2022-01-29 08:23:34', '2022-01-29 08:23:34'),
(1553, '103.120.203.104', '2022-01-29 02:24:32pm', 1, '2022-01-29 08:24:32', '2022-01-29 08:24:32'),
(1554, '103.135.252.91', '2022-01-29 02:33:45pm', 1, '2022-01-29 08:33:45', '2022-01-29 08:33:45'),
(1555, '49.206.119.118', '2022-01-29 02:40:47pm', 1, '2022-01-29 08:40:47', '2022-01-29 08:40:47'),
(1556, '220.152.113.20', '2022-01-29 03:00:55pm', 1, '2022-01-29 09:00:55', '2022-01-29 09:00:55'),
(1557, '220.152.113.20', '2022-01-29 03:07:53pm', 1, '2022-01-29 09:07:53', '2022-01-29 09:07:53'),
(1558, '220.152.113.20', '2022-01-29 03:08:52pm', 1, '2022-01-29 09:08:52', '2022-01-29 09:08:52'),
(1559, '69.171.231.1', '2022-01-29 03:14:33pm', 1, '2022-01-29 09:14:33', '2022-01-29 09:14:33'),
(1560, '69.171.231.116', '2022-01-29 03:14:33pm', 1, '2022-01-29 09:14:33', '2022-01-29 09:14:33'),
(1561, '220.152.113.20', '2022-01-29 03:23:38pm', 1, '2022-01-29 09:23:38', '2022-01-29 09:23:38'),
(1562, '220.152.113.20', '2022-01-29 03:25:11pm', 1, '2022-01-29 09:25:11', '2022-01-29 09:25:11'),
(1563, '118.179.97.39', '2022-01-29 03:27:09pm', 1, '2022-01-29 09:27:09', '2022-01-29 09:27:09'),
(1564, '118.179.97.39', '2022-01-29 03:27:11pm', 1, '2022-01-29 09:27:11', '2022-01-29 09:27:11'),
(1565, '81.163.105.69', '2022-01-29 03:30:14pm', 1, '2022-01-29 09:30:14', '2022-01-29 09:30:14'),
(1566, '220.152.113.20', '2022-01-29 03:33:57pm', 1, '2022-01-29 09:33:57', '2022-01-29 09:33:57'),
(1567, '188.163.46.154', '2022-01-29 03:34:37pm', 1, '2022-01-29 09:34:37', '2022-01-29 09:34:37'),
(1568, '188.163.46.154', '2022-01-29 03:34:40pm', 1, '2022-01-29 09:34:40', '2022-01-29 09:34:40'),
(1569, '220.152.113.20', '2022-01-29 03:40:12pm', 1, '2022-01-29 09:40:12', '2022-01-29 09:40:12'),
(1570, '34.96.130.18', '2022-01-29 04:02:37pm', 1, '2022-01-29 10:02:37', '2022-01-29 10:02:37'),
(1571, '220.152.113.20', '2022-01-29 04:05:27pm', 1, '2022-01-29 10:05:27', '2022-01-29 10:05:27'),
(1572, '92.118.160.37', '2022-01-29 04:36:49pm', 1, '2022-01-29 10:36:49', '2022-01-29 10:36:49'),
(1573, '220.152.113.20', '2022-01-29 05:01:36pm', 1, '2022-01-29 11:01:36', '2022-01-29 11:01:36'),
(1574, '178.159.37.159', '2022-01-29 05:15:14pm', 1, '2022-01-29 11:15:14', '2022-01-29 11:15:14'),
(1575, '92.118.160.17', '2022-01-29 05:21:57pm', 1, '2022-01-29 11:21:57', '2022-01-29 11:21:57'),
(1576, '123.183.224.115', '2022-01-29 05:48:13pm', 1, '2022-01-29 11:48:13', '2022-01-29 11:48:13'),
(1577, '118.179.97.39', '2022-01-29 05:54:23pm', 1, '2022-01-29 11:54:23', '2022-01-29 11:54:23'),
(1578, '92.118.160.61', '2022-01-29 06:01:54pm', 1, '2022-01-29 12:01:54', '2022-01-29 12:01:54'),
(1579, '52.43.36.73', '2022-01-29 07:25:52pm', 1, '2022-01-29 13:25:52', '2022-01-29 13:25:52'),
(1580, '35.86.116.129', '2022-01-29 07:43:55pm', 1, '2022-01-29 13:43:55', '2022-01-29 13:43:55'),
(1581, '191.101.132.4', '2022-01-29 08:02:28pm', 1, '2022-01-29 14:02:28', '2022-01-29 14:02:28'),
(1582, '191.101.132.4', '2022-01-29 08:02:32pm', 1, '2022-01-29 14:02:32', '2022-01-29 14:02:32'),
(1583, '35.86.81.178', '2022-01-29 08:07:45pm', 1, '2022-01-29 14:07:45', '2022-01-29 14:07:45'),
(1584, '114.119.155.118', '2022-01-29 08:14:51pm', 1, '2022-01-29 14:14:51', '2022-01-29 14:14:51'),
(1585, '81.163.105.69', '2022-01-29 08:17:26pm', 1, '2022-01-29 14:17:26', '2022-01-29 14:17:26'),
(1586, '81.163.105.69', '2022-01-29 08:17:28pm', 1, '2022-01-29 14:17:28', '2022-01-29 14:17:28'),
(1587, '185.220.101.18', '2022-01-29 09:36:07pm', 1, '2022-01-29 15:36:07', '2022-01-29 15:36:07'),
(1588, '114.119.138.170', '2022-01-29 09:47:57pm', 1, '2022-01-29 15:47:57', '2022-01-29 15:47:57'),
(1589, '79.142.77.59', '2022-01-29 10:06:31pm', 1, '2022-01-29 16:06:31', '2022-01-29 16:06:31'),
(1590, '92.253.28.219', '2022-01-29 10:22:50pm', 1, '2022-01-29 16:22:50', '2022-01-29 16:22:50'),
(1591, '92.253.28.219', '2022-01-29 10:23:24pm', 1, '2022-01-29 16:23:24', '2022-01-29 16:23:24'),
(1592, '34.86.35.14', '2022-01-29 11:52:01pm', 1, '2022-01-29 17:52:01', '2022-01-29 17:52:01'),
(1593, '45.220.2.116', '2022-01-30 12:03:34am', 1, '2022-01-29 18:03:34', '2022-01-29 18:03:34'),
(1594, '66.249.68.27', '2022-01-30 12:44:07am', 1, '2022-01-29 18:44:07', '2022-01-29 18:44:07'),
(1595, '51.222.253.7', '2022-01-30 12:46:41am', 1, '2022-01-29 18:46:41', '2022-01-29 18:46:41'),
(1596, '5.188.211.45', '2022-01-30 01:18:58am', 1, '2022-01-29 19:18:58', '2022-01-29 19:18:58'),
(1597, '195.246.120.176', '2022-01-30 01:36:31am', 1, '2022-01-29 19:36:31', '2022-01-29 19:36:31'),
(1598, '185.189.114.118', '2022-01-30 02:32:10am', 1, '2022-01-29 20:32:10', '2022-01-29 20:32:10'),
(1599, '185.189.114.118', '2022-01-30 02:32:14am', 1, '2022-01-29 20:32:14', '2022-01-29 20:32:14'),
(1600, '64.227.3.157', '2022-01-30 02:38:21am', 1, '2022-01-29 20:38:21', '2022-01-29 20:38:21'),
(1601, '84.39.245.2', '2022-01-30 02:46:00am', 1, '2022-01-29 20:46:00', '2022-01-29 20:46:00'),
(1602, '5.248.226.73', '2022-01-30 02:57:51am', 1, '2022-01-29 20:57:51', '2022-01-29 20:57:51'),
(1603, '5.248.226.73', '2022-01-30 02:57:52am', 1, '2022-01-29 20:57:52', '2022-01-29 20:57:52'),
(1604, '5.248.226.73', '2022-01-30 02:57:53am', 1, '2022-01-29 20:57:53', '2022-01-29 20:57:53'),
(1605, '51.222.253.19', '2022-01-30 03:29:11am', 1, '2022-01-29 21:29:11', '2022-01-29 21:29:11'),
(1606, '136.243.155.105', '2022-01-30 04:28:37am', 1, '2022-01-29 22:28:37', '2022-01-29 22:28:37'),
(1607, '136.243.155.105', '2022-01-30 04:28:47am', 1, '2022-01-29 22:28:47', '2022-01-29 22:28:47'),
(1608, '35.196.68.181', '2022-01-30 04:28:51am', 1, '2022-01-29 22:28:51', '2022-01-29 22:28:51'),
(1609, '35.196.68.181', '2022-01-30 04:30:03am', 1, '2022-01-29 22:30:03', '2022-01-29 22:30:03'),
(1610, '136.243.155.105', '2022-01-30 05:05:22am', 1, '2022-01-29 23:05:22', '2022-01-29 23:05:22'),
(1611, '105.68.196.159', '2022-01-30 05:05:23am', 1, '2022-01-29 23:05:23', '2022-01-29 23:05:23'),
(1612, '1.192.192.6', '2022-01-30 05:12:52am', 1, '2022-01-29 23:12:52', '2022-01-29 23:12:52'),
(1613, '36.110.211.69', '2022-01-30 05:13:02am', 1, '2022-01-29 23:13:02', '2022-01-29 23:13:02'),
(1614, '36.110.211.67', '2022-01-30 05:13:03am', 1, '2022-01-29 23:13:03', '2022-01-29 23:13:03'),
(1615, '36.110.211.3', '2022-01-30 05:13:03am', 1, '2022-01-29 23:13:03', '2022-01-29 23:13:03'),
(1616, '136.243.155.105', '2022-01-30 05:25:10am', 1, '2022-01-29 23:25:10', '2022-01-29 23:25:10'),
(1617, '136.243.155.105', '2022-01-30 05:25:49am', 1, '2022-01-29 23:25:49', '2022-01-29 23:25:49'),
(1618, '36.110.211.3', '2022-01-30 05:31:58am', 1, '2022-01-29 23:31:58', '2022-01-29 23:31:58'),
(1619, '1.192.192.6', '2022-01-30 05:31:59am', 1, '2022-01-29 23:31:59', '2022-01-29 23:31:59'),
(1620, '36.110.211.67', '2022-01-30 05:31:59am', 1, '2022-01-29 23:31:59', '2022-01-29 23:31:59'),
(1621, '1.192.195.8', '2022-01-30 05:31:59am', 1, '2022-01-29 23:31:59', '2022-01-29 23:31:59'),
(1622, '87.250.224.11', '2022-01-30 06:18:05am', 1, '2022-01-30 00:18:05', '2022-01-30 00:18:05'),
(1623, '87.250.224.11', '2022-01-30 06:18:12am', 1, '2022-01-30 00:18:12', '2022-01-30 00:18:12'),
(1624, '87.250.224.11', '2022-01-30 06:19:47am', 1, '2022-01-30 00:19:47', '2022-01-30 00:19:47'),
(1625, '87.250.224.11', '2022-01-30 06:19:57am', 1, '2022-01-30 00:19:57', '2022-01-30 00:19:57'),
(1626, '195.246.120.176', '2022-01-30 06:30:51am', 1, '2022-01-30 00:30:51', '2022-01-30 00:30:51'),
(1627, '5.164.204.23', '2022-01-30 06:45:46am', 1, '2022-01-30 00:45:46', '2022-01-30 00:45:46'),
(1628, '35.237.195.184', '2022-01-30 06:58:29am', 1, '2022-01-30 00:58:29', '2022-01-30 00:58:29'),
(1629, '87.250.224.11', '2022-01-30 07:52:48am', 1, '2022-01-30 01:52:48', '2022-01-30 01:52:48'),
(1630, '87.250.224.11', '2022-01-30 07:53:10am', 1, '2022-01-30 01:53:10', '2022-01-30 01:53:10'),
(1631, '87.250.224.11', '2022-01-30 07:53:12am', 1, '2022-01-30 01:53:12', '2022-01-30 01:53:12'),
(1632, '180.76.146.169', '2022-01-30 08:11:50am', 1, '2022-01-30 02:11:50', '2022-01-30 02:11:50'),
(1633, '195.246.120.176', '2022-01-30 08:32:48am', 1, '2022-01-30 02:32:48', '2022-01-30 02:32:48'),
(1634, '123.125.109.43', '2022-01-30 08:34:46am', 1, '2022-01-30 02:34:46', '2022-01-30 02:34:46'),
(1635, '185.220.100.253', '2022-01-30 09:27:17am', 1, '2022-01-30 03:27:17', '2022-01-30 03:27:17'),
(1636, '188.163.18.30', '2022-01-30 10:10:34am', 1, '2022-01-30 04:10:34', '2022-01-30 04:10:34'),
(1637, '188.163.18.30', '2022-01-30 10:10:37am', 1, '2022-01-30 04:10:37', '2022-01-30 04:10:37'),
(1638, '217.217.175.32', '2022-01-30 10:22:50am', 1, '2022-01-30 04:22:51', '2022-01-30 04:22:51'),
(1639, '167.71.94.132', '2022-01-30 10:32:39am', 1, '2022-01-30 04:32:39', '2022-01-30 04:32:39'),
(1640, '131.220.6.152', '2022-01-30 10:59:17am', 1, '2022-01-30 04:59:17', '2022-01-30 04:59:17'),
(1641, '31.13.127.27', '2022-01-30 11:29:59am', 1, '2022-01-30 05:29:59', '2022-01-30 05:29:59'),
(1642, '118.179.97.39', '2022-01-30 11:41:36am', 1, '2022-01-30 05:41:36', '2022-01-30 05:41:36'),
(1643, '220.152.113.20', '2022-01-30 12:03:31pm', 1, '2022-01-30 06:03:31', '2022-01-30 06:03:31'),
(1644, '34.96.130.7', '2022-01-30 12:40:17pm', 1, '2022-01-30 06:40:17', '2022-01-30 06:40:17'),
(1645, '117.223.181.90', '2022-01-30 12:48:03pm', 1, '2022-01-30 06:48:03', '2022-01-30 06:48:03'),
(1646, '143.92.56.239', '2022-01-30 01:00:26pm', 1, '2022-01-30 07:00:26', '2022-01-30 07:00:26'),
(1647, '123.125.109.43', '2022-01-30 01:40:47pm', 1, '2022-01-30 07:40:47', '2022-01-30 07:40:47'),
(1648, '110.76.129.137', '2022-01-30 01:58:36pm', 1, '2022-01-30 07:58:36', '2022-01-30 07:58:36'),
(1649, '220.152.113.20', '2022-01-30 02:30:20pm', 1, '2022-01-30 08:30:20', '2022-01-30 08:30:20'),
(1650, '220.152.113.20', '2022-01-30 03:10:04pm', 1, '2022-01-30 09:10:04', '2022-01-30 09:10:04'),
(1651, '103.135.252.92', '2022-01-30 03:14:49pm', 1, '2022-01-30 09:14:49', '2022-01-30 09:14:49'),
(1652, '103.135.252.92', '2022-01-30 03:19:59pm', 1, '2022-01-30 09:19:59', '2022-01-30 09:19:59'),
(1653, '220.152.113.20', '2022-01-30 03:46:05pm', 1, '2022-01-30 09:46:05', '2022-01-30 09:46:05'),
(1654, '220.152.113.20', '2022-01-30 03:46:11pm', 1, '2022-01-30 09:46:11', '2022-01-30 09:46:11'),
(1655, '220.152.113.20', '2022-01-30 03:51:03pm', 1, '2022-01-30 09:51:03', '2022-01-30 09:51:03'),
(1656, '118.179.97.39', '2022-01-30 04:01:44pm', 1, '2022-01-30 10:01:44', '2022-01-30 10:01:44'),
(1657, '118.179.97.39', '2022-01-30 04:01:59pm', 1, '2022-01-30 10:01:59', '2022-01-30 10:01:59'),
(1658, '118.179.97.39', '2022-01-30 04:03:09pm', 1, '2022-01-30 10:03:09', '2022-01-30 10:03:09'),
(1659, '118.179.97.39', '2022-01-30 04:03:41pm', 1, '2022-01-30 10:03:41', '2022-01-30 10:03:41'),
(1660, '118.179.97.39', '2022-01-30 04:10:11pm', 1, '2022-01-30 10:10:11', '2022-01-30 10:10:11'),
(1661, '220.152.113.20', '2022-01-30 04:10:35pm', 1, '2022-01-30 10:10:35', '2022-01-30 10:10:35'),
(1662, '220.152.113.20', '2022-01-30 04:10:41pm', 1, '2022-01-30 10:10:41', '2022-01-30 10:10:41'),
(1663, '220.152.113.20', '2022-01-30 04:12:55pm', 1, '2022-01-30 10:12:55', '2022-01-30 10:12:55'),
(1664, '220.152.113.20', '2022-01-30 04:15:04pm', 1, '2022-01-30 10:15:04', '2022-01-30 10:15:04'),
(1665, '220.152.113.20', '2022-01-30 04:26:43pm', 1, '2022-01-30 10:26:43', '2022-01-30 10:26:43'),
(1666, '220.152.113.20', '2022-01-30 04:33:10pm', 1, '2022-01-30 10:33:10', '2022-01-30 10:33:10'),
(1667, '220.152.113.20', '2022-01-30 04:44:22pm', 1, '2022-01-30 10:44:22', '2022-01-30 10:44:22'),
(1668, '220.152.113.20', '2022-01-30 04:45:02pm', 1, '2022-01-30 10:45:02', '2022-01-30 10:45:02'),
(1669, '157.55.39.48', '2022-01-30 05:03:18pm', 1, '2022-01-30 11:03:19', '2022-01-30 11:03:19'),
(1670, '66.220.149.9', '2022-01-30 05:06:51pm', 1, '2022-01-30 11:06:51', '2022-01-30 11:06:51'),
(1671, '66.220.149.30', '2022-01-30 05:06:51pm', 1, '2022-01-30 11:06:51', '2022-01-30 11:06:51'),
(1672, '66.220.149.17', '2022-01-30 05:06:51pm', 1, '2022-01-30 11:06:51', '2022-01-30 11:06:51'),
(1673, '81.163.105.69', '2022-01-30 05:35:09pm', 1, '2022-01-30 11:35:09', '2022-01-30 11:35:09'),
(1674, '81.163.105.69', '2022-01-30 05:35:10pm', 1, '2022-01-30 11:35:10', '2022-01-30 11:35:10'),
(1675, '49.7.20.108', '2022-01-30 05:38:57pm', 1, '2022-01-30 11:38:57', '2022-01-30 11:38:57'),
(1676, '192.29.97.49', '2022-01-30 05:44:47pm', 1, '2022-01-30 11:44:47', '2022-01-30 11:44:47'),
(1677, '173.231.60.195', '2022-01-30 05:56:31pm', 1, '2022-01-30 11:56:31', '2022-01-30 11:56:31'),
(1678, '220.152.113.20', '2022-01-30 06:05:48pm', 1, '2022-01-30 12:05:48', '2022-01-30 12:05:48'),
(1679, '220.152.113.20', '2022-01-30 06:14:59pm', 1, '2022-01-30 12:14:59', '2022-01-30 12:14:59'),
(1680, '220.152.113.20', '2022-01-30 06:42:25pm', 1, '2022-01-30 12:42:25', '2022-01-30 12:42:25'),
(1681, '34.77.162.22', '2022-01-30 06:50:22pm', 1, '2022-01-30 12:50:22', '2022-01-30 12:50:22'),
(1682, '220.152.113.20', '2022-01-30 06:50:34pm', 1, '2022-01-30 12:50:34', '2022-01-30 12:50:34'),
(1683, '5.188.62.76', '2022-01-30 07:15:15pm', 1, '2022-01-30 13:15:15', '2022-01-30 13:15:15'),
(1684, '220.152.113.20', '2022-01-30 07:19:51pm', 1, '2022-01-30 13:19:51', '2022-01-30 13:19:51'),
(1685, '220.152.113.20', '2022-01-30 07:25:31pm', 1, '2022-01-30 13:25:31', '2022-01-30 13:25:31'),
(1686, '35.87.83.3', '2022-01-30 07:26:26pm', 1, '2022-01-30 13:26:26', '2022-01-30 13:26:26'),
(1687, '34.222.88.110', '2022-01-30 07:26:46pm', 1, '2022-01-30 13:26:46', '2022-01-30 13:26:46'),
(1688, '109.248.106.82', '2022-01-30 07:53:56pm', 1, '2022-01-30 13:53:56', '2022-01-30 13:53:56'),
(1689, '62.113.118.20', '2022-01-30 09:03:03pm', 1, '2022-01-30 15:03:03', '2022-01-30 15:03:03'),
(1690, '216.244.66.236', '2022-01-30 09:13:24pm', 1, '2022-01-30 15:13:24', '2022-01-30 15:13:24'),
(1691, '192.99.18.136', '2022-01-30 09:19:34pm', 1, '2022-01-30 15:19:34', '2022-01-30 15:19:34'),
(1692, '192.99.18.136', '2022-01-30 09:19:52pm', 1, '2022-01-30 15:19:52', '2022-01-30 15:19:52'),
(1693, '192.99.18.136', '2022-01-30 09:19:54pm', 1, '2022-01-30 15:19:54', '2022-01-30 15:19:54'),
(1694, '103.135.252.92', '2022-01-30 09:23:46pm', 1, '2022-01-30 15:23:46', '2022-01-30 15:23:46'),
(1695, '103.135.252.92', '2022-01-30 10:37:10pm', 1, '2022-01-30 16:37:10', '2022-01-30 16:37:10'),
(1696, '192.185.176.178', '2022-01-30 11:36:25pm', 1, '2022-01-30 17:36:25', '2022-01-30 17:36:25'),
(1697, '45.153.185.224', '2022-01-30 11:52:22pm', 1, '2022-01-30 17:52:22', '2022-01-30 17:52:22'),
(1698, '186.7.73.115', '2022-01-31 12:12:40am', 1, '2022-01-30 18:12:40', '2022-01-30 18:12:40'),
(1699, '186.7.73.115', '2022-01-31 12:12:59am', 1, '2022-01-30 18:12:59', '2022-01-30 18:12:59'),
(1700, '185.220.102.4', '2022-01-31 12:30:17am', 1, '2022-01-30 18:30:17', '2022-01-30 18:30:17'),
(1701, '103.135.252.94', '2022-01-31 12:37:19am', 1, '2022-01-30 18:37:19', '2022-01-30 18:37:19'),
(1702, '5.135.137.50', '2022-01-31 12:52:57am', 1, '2022-01-30 18:52:57', '2022-01-30 18:52:57'),
(1703, '216.244.66.236', '2022-01-31 12:53:16am', 1, '2022-01-30 18:53:16', '2022-01-30 18:53:16'),
(1704, '103.25.251.252', '2022-01-31 12:53:29am', 1, '2022-01-30 18:53:29', '2022-01-30 18:53:29'),
(1705, '103.25.251.252', '2022-01-31 12:53:30am', 1, '2022-01-30 18:53:30', '2022-01-30 18:53:30'),
(1706, '103.25.251.252', '2022-01-31 12:53:30am', 1, '2022-01-30 18:53:30', '2022-01-30 18:53:30'),
(1707, '103.25.251.252', '2022-01-31 12:53:46am', 1, '2022-01-30 18:53:46', '2022-01-30 18:53:46'),
(1708, '5.135.137.50', '2022-01-31 01:11:28am', 1, '2022-01-30 19:11:28', '2022-01-30 19:11:28'),
(1709, '66.249.68.14', '2022-01-31 02:10:27am', 1, '2022-01-30 20:10:27', '2022-01-30 20:10:27'),
(1710, '178.159.37.172', '2022-01-31 02:57:14am', 1, '2022-01-30 20:57:14', '2022-01-30 20:57:14'),
(1711, '66.249.79.11', '2022-01-31 03:06:47am', 1, '2022-01-30 21:06:47', '2022-01-30 21:06:47'),
(1712, '217.25.228.35', '2022-01-31 03:31:21am', 1, '2022-01-30 21:31:21', '2022-01-30 21:31:21'),
(1713, '65.255.56.76', '2022-01-31 03:33:57am', 1, '2022-01-30 21:33:57', '2022-01-30 21:33:57'),
(1714, '188.126.73.217', '2022-01-31 03:34:36am', 1, '2022-01-30 21:34:36', '2022-01-30 21:34:36'),
(1715, '185.107.57.89', '2022-01-31 03:57:57am', 1, '2022-01-30 21:57:57', '2022-01-30 21:57:57'),
(1716, '31.13.127.33', '2022-01-31 03:59:17am', 1, '2022-01-30 21:59:17', '2022-01-30 21:59:17'),
(1717, '66.249.79.11', '2022-01-31 04:31:48am', 1, '2022-01-30 22:31:48', '2022-01-30 22:31:48'),
(1718, '94.66.221.241', '2022-01-31 04:56:32am', 1, '2022-01-30 22:56:32', '2022-01-30 22:56:32'),
(1719, '94.66.221.241', '2022-01-31 04:56:41am', 1, '2022-01-30 22:56:41', '2022-01-30 22:56:41'),
(1720, '216.244.66.236', '2022-01-31 06:11:44am', 1, '2022-01-31 00:11:44', '2022-01-31 00:11:44'),
(1721, '167.94.138.62', '2022-01-31 06:39:03am', 1, '2022-01-31 00:39:03', '2022-01-31 00:39:03'),
(1722, '167.94.138.62', '2022-01-31 06:39:03am', 1, '2022-01-31 00:39:03', '2022-01-31 00:39:03'),
(1723, '142.44.167.43', '2022-01-31 08:11:39am', 1, '2022-01-31 02:11:39', '2022-01-31 02:11:39'),
(1724, '123.125.109.43', '2022-01-31 08:44:51am', 1, '2022-01-31 02:44:52', '2022-01-31 02:44:52'),
(1725, '66.249.79.11', '2022-01-31 08:50:13am', 1, '2022-01-31 02:50:13', '2022-01-31 02:50:13'),
(1726, '195.246.120.152', '2022-01-31 09:20:56am', 1, '2022-01-31 03:20:56', '2022-01-31 03:20:56'),
(1727, '188.234.13.127', '2022-01-31 10:10:30am', 1, '2022-01-31 04:10:30', '2022-01-31 04:10:30'),
(1728, '131.220.6.152', '2022-01-31 10:59:48am', 1, '2022-01-31 04:59:48', '2022-01-31 04:59:48'),
(1729, '129.146.18.152', '2022-01-31 11:39:28am', 1, '2022-01-31 05:39:28', '2022-01-31 05:39:28'),
(1730, '118.179.97.39', '2022-01-31 12:24:10pm', 1, '2022-01-31 06:24:10', '2022-01-31 06:24:10'),
(1731, '118.179.97.39', '2022-01-31 12:24:25pm', 1, '2022-01-31 06:24:26', '2022-01-31 06:24:26'),
(1732, '66.249.79.11', '2022-01-31 12:44:46pm', 1, '2022-01-31 06:44:46', '2022-01-31 06:44:46'),
(1733, '34.208.217.55', '2022-01-31 01:04:14pm', 1, '2022-01-31 07:04:14', '2022-01-31 07:04:14'),
(1734, '34.208.217.55', '2022-01-31 01:04:14pm', 1, '2022-01-31 07:04:14', '2022-01-31 07:04:14'),
(1735, '66.249.68.10', '2022-01-31 01:14:57pm', 1, '2022-01-31 07:14:57', '2022-01-31 07:14:57'),
(1736, '123.125.109.43', '2022-01-31 01:33:59pm', 1, '2022-01-31 07:33:59', '2022-01-31 07:33:59'),
(1737, '54.69.5.153', '2022-01-31 01:50:36pm', 1, '2022-01-31 07:50:36', '2022-01-31 07:50:36'),
(1738, '162.55.85.228', '2022-01-31 02:33:11pm', 1, '2022-01-31 08:33:11', '2022-01-31 08:33:11'),
(1739, '118.179.97.39', '2022-01-31 03:29:23pm', 1, '2022-01-31 09:29:23', '2022-01-31 09:29:23'),
(1740, '20.115.31.131', '2022-01-31 03:34:08pm', 1, '2022-01-31 09:34:08', '2022-01-31 09:34:08'),
(1741, '81.163.105.69', '2022-01-31 03:37:56pm', 1, '2022-01-31 09:37:56', '2022-01-31 09:37:56'),
(1742, '81.163.105.69', '2022-01-31 03:37:57pm', 1, '2022-01-31 09:37:57', '2022-01-31 09:37:57'),
(1743, '51.159.23.22', '2022-01-31 04:09:46pm', 1, '2022-01-31 10:09:46', '2022-01-31 10:09:46'),
(1744, '220.152.113.20', '2022-01-31 04:21:19pm', 1, '2022-01-31 10:21:19', '2022-01-31 10:21:19'),
(1745, '62.113.112.169', '2022-01-31 04:34:46pm', 1, '2022-01-31 10:34:46', '2022-01-31 10:34:46'),
(1746, '62.113.116.197', '2022-01-31 04:35:35pm', 1, '2022-01-31 10:35:35', '2022-01-31 10:35:35'),
(1747, '220.152.113.20', '2022-01-31 04:43:04pm', 1, '2022-01-31 10:43:04', '2022-01-31 10:43:04'),
(1748, '162.55.85.228', '2022-01-31 04:44:37pm', 1, '2022-01-31 10:44:37', '2022-01-31 10:44:37'),
(1749, '167.99.102.248', '2022-01-31 05:01:17pm', 1, '2022-01-31 11:01:17', '2022-01-31 11:01:17'),
(1750, '95.37.31.212', '2022-01-31 05:21:21pm', 1, '2022-01-31 11:21:21', '2022-01-31 11:21:21'),
(1751, '176.226.155.141', '2022-01-31 05:27:46pm', 1, '2022-01-31 11:27:46', '2022-01-31 11:27:46'),
(1752, '123.183.224.115', '2022-01-31 05:34:40pm', 1, '2022-01-31 11:34:40', '2022-01-31 11:34:40'),
(1753, '2.57.122.31', '2022-01-31 05:52:52pm', 1, '2022-01-31 11:52:52', '2022-01-31 11:52:52'),
(1754, '13.72.106.129', '2022-01-31 06:03:15pm', 1, '2022-01-31 12:03:15', '2022-01-31 12:03:15'),
(1755, '192.71.225.127', '2022-01-31 06:08:27pm', 1, '2022-01-31 12:08:27', '2022-01-31 12:08:27'),
(1756, '51.81.167.146', '2022-01-31 06:16:32pm', 1, '2022-01-31 12:16:32', '2022-01-31 12:16:32'),
(1757, '91.73.94.105', '2022-01-31 06:45:40pm', 1, '2022-01-31 12:45:40', '2022-01-31 12:45:40'),
(1758, '35.161.199.201', '2022-01-31 07:24:03pm', 1, '2022-01-31 13:24:03', '2022-01-31 13:24:03'),
(1759, '68.183.226.92', '2022-01-31 07:34:09pm', 1, '2022-01-31 13:34:09', '2022-01-31 13:34:09'),
(1760, '68.183.226.92', '2022-01-31 07:34:09pm', 1, '2022-01-31 13:34:09', '2022-01-31 13:34:09'),
(1761, '68.183.226.92', '2022-01-31 07:34:10pm', 1, '2022-01-31 13:34:10', '2022-01-31 13:34:10'),
(1762, '66.249.68.29', '2022-01-31 08:10:10pm', 1, '2022-01-31 14:10:10', '2022-01-31 14:10:10'),
(1763, '23.94.10.43', '2022-01-31 08:17:25pm', 1, '2022-01-31 14:17:25', '2022-01-31 14:17:25'),
(1764, '185.220.101.81', '2022-01-31 08:28:55pm', 1, '2022-01-31 14:28:55', '2022-01-31 14:28:55'),
(1765, '185.220.101.81', '2022-01-31 08:29:02pm', 1, '2022-01-31 14:29:02', '2022-01-31 14:29:02'),
(1766, '3.237.96.54', '2022-01-31 09:00:08pm', 1, '2022-01-31 15:00:08', '2022-01-31 15:00:08'),
(1767, '156.146.50.50', '2022-01-31 09:44:37pm', 1, '2022-01-31 15:44:37', '2022-01-31 15:44:37'),
(1768, '173.213.85.7', '2022-01-31 11:59:45pm', 1, '2022-01-31 17:59:45', '2022-01-31 17:59:45'),
(1769, '173.213.85.7', '2022-01-31 11:59:48pm', 1, '2022-01-31 17:59:48', '2022-01-31 17:59:48'),
(1770, '107.189.14.182', '2022-02-01 01:23:48am', 1, '2022-01-31 19:23:48', '2022-01-31 19:23:48'),
(1771, '138.199.59.133', '2022-02-01 01:54:37am', 1, '2022-01-31 19:54:37', '2022-01-31 19:54:37'),
(1772, '173.231.60.195', '2022-02-01 02:29:10am', 1, '2022-01-31 20:29:10', '2022-01-31 20:29:10'),
(1773, '34.77.162.6', '2022-02-01 03:04:01am', 1, '2022-01-31 21:04:01', '2022-01-31 21:04:01'),
(1774, '37.192.177.23', '2022-02-01 03:19:08am', 1, '2022-01-31 21:19:08', '2022-01-31 21:19:08'),
(1775, '129.146.18.152', '2022-02-01 03:25:08am', 1, '2022-01-31 21:25:08', '2022-01-31 21:25:08'),
(1776, '188.234.13.127', '2022-02-01 04:03:20am', 1, '2022-01-31 22:03:20', '2022-01-31 22:03:20'),
(1777, '138.201.60.47', '2022-02-01 04:06:46am', 1, '2022-01-31 22:06:46', '2022-01-31 22:06:46'),
(1778, '34.77.162.15', '2022-02-01 04:19:01am', 1, '2022-01-31 22:19:01', '2022-01-31 22:19:01'),
(1779, '185.176.27.3', '2022-02-01 05:25:35am', 1, '2022-01-31 23:25:35', '2022-01-31 23:25:35'),
(1780, '84.39.245.2', '2022-02-01 07:14:34am', 1, '2022-02-01 01:14:34', '2022-02-01 01:14:34'),
(1781, '194.32.239.121', '2022-02-01 08:09:16am', 1, '2022-02-01 02:09:16', '2022-02-01 02:09:16'),
(1782, '194.32.239.121', '2022-02-01 08:09:19am', 1, '2022-02-01 02:09:19', '2022-02-01 02:09:19'),
(1783, '138.246.253.5', '2022-02-01 08:14:16am', 1, '2022-02-01 02:14:16', '2022-02-01 02:14:16'),
(1784, '49.7.20.108', '2022-02-01 08:35:34am', 1, '2022-02-01 02:35:34', '2022-02-01 02:35:34'),
(1785, '20.124.11.167', '2022-02-01 09:32:55am', 1, '2022-02-01 03:32:55', '2022-02-01 03:32:55'),
(1786, '20.124.11.167', '2022-02-01 09:32:56am', 1, '2022-02-01 03:32:56', '2022-02-01 03:32:56'),
(1787, '20.124.11.167', '2022-02-01 09:32:57am', 1, '2022-02-01 03:32:57', '2022-02-01 03:32:57'),
(1788, '220.152.113.20', '2022-02-01 09:55:01am', 1, '2022-02-01 03:55:01', '2022-02-01 03:55:01'),
(1789, '185.5.251.166', '2022-02-01 10:25:52am', 1, '2022-02-01 04:25:52', '2022-02-01 04:25:52'),
(1790, '131.220.6.152', '2022-02-01 10:58:50am', 1, '2022-02-01 04:58:50', '2022-02-01 04:58:50'),
(1791, '118.179.97.39', '2022-02-01 11:05:34am', 1, '2022-02-01 05:05:34', '2022-02-01 05:05:34'),
(1792, '118.179.97.39', '2022-02-01 11:09:54am', 1, '2022-02-01 05:09:54', '2022-02-01 05:09:54'),
(1793, '138.246.253.5', '2022-02-01 11:29:25am', 1, '2022-02-01 05:29:25', '2022-02-01 05:29:25'),
(1794, '107.178.207.28', '2022-02-01 11:52:43am', 1, '2022-02-01 05:52:43', '2022-02-01 05:52:43'),
(1795, '109.107.188.36', '2022-02-01 12:35:31pm', 1, '2022-02-01 06:35:31', '2022-02-01 06:35:31'),
(1796, '107.150.31.10', '2022-02-01 12:43:00pm', 1, '2022-02-01 06:43:00', '2022-02-01 06:43:00'),
(1797, '138.246.253.5', '2022-02-01 12:53:56pm', 1, '2022-02-01 06:53:56', '2022-02-01 06:53:56'),
(1798, '138.246.253.5', '2022-02-01 12:59:47pm', 1, '2022-02-01 06:59:47', '2022-02-01 06:59:47'),
(1799, '66.249.68.29', '2022-02-01 01:35:05pm', 1, '2022-02-01 07:35:05', '2022-02-01 07:35:05'),
(1800, '178.47.95.54', '2022-02-01 01:40:00pm', 1, '2022-02-01 07:40:00', '2022-02-01 07:40:00'),
(1801, '118.179.97.39', '2022-02-01 02:06:26pm', 1, '2022-02-01 08:06:26', '2022-02-01 08:06:26'),
(1802, '118.179.97.39', '2022-02-01 02:06:35pm', 1, '2022-02-01 08:06:35', '2022-02-01 08:06:35'),
(1803, '91.134.13.237', '2022-02-01 02:45:22pm', 1, '2022-02-01 08:45:22', '2022-02-01 08:45:22'),
(1804, '161.117.10.46', '2022-02-01 02:47:54pm', 1, '2022-02-01 08:47:54', '2022-02-01 08:47:54'),
(1805, '195.123.209.118', '2022-02-01 02:51:09pm', 1, '2022-02-01 08:51:09', '2022-02-01 08:51:09'),
(1806, '195.123.209.118', '2022-02-01 02:51:10pm', 1, '2022-02-01 08:51:10', '2022-02-01 08:51:10'),
(1807, '195.123.209.118', '2022-02-01 02:51:10pm', 1, '2022-02-01 08:51:10', '2022-02-01 08:51:10'),
(1808, '138.246.253.5', '2022-02-01 02:56:45pm', 1, '2022-02-01 08:56:45', '2022-02-01 08:56:45'),
(1809, '138.246.253.5', '2022-02-01 02:57:43pm', 1, '2022-02-01 08:57:43', '2022-02-01 08:57:43'),
(1810, '87.250.224.11', '2022-02-01 03:16:45pm', 1, '2022-02-01 09:16:45', '2022-02-01 09:16:45'),
(1811, '118.184.177.110', '2022-02-01 03:43:57pm', 1, '2022-02-01 09:43:57', '2022-02-01 09:43:57'),
(1812, '185.220.101.55', '2022-02-01 03:50:12pm', 1, '2022-02-01 09:50:12', '2022-02-01 09:50:12'),
(1813, '66.220.149.15', '2022-02-01 04:14:27pm', 1, '2022-02-01 10:14:27', '2022-02-01 10:14:27'),
(1814, '45.159.75.73', '2022-02-01 04:39:18pm', 1, '2022-02-01 10:39:18', '2022-02-01 10:39:18'),
(1815, '37.115.153.184', '2022-02-01 05:01:24pm', 1, '2022-02-01 11:01:24', '2022-02-01 11:01:24'),
(1816, '37.115.153.184', '2022-02-01 05:01:25pm', 1, '2022-02-01 11:01:25', '2022-02-01 11:01:25'),
(1817, '37.115.153.184', '2022-02-01 05:01:25pm', 1, '2022-02-01 11:01:25', '2022-02-01 11:01:25'),
(1818, '77.68.64.29', '2022-02-01 05:02:38pm', 1, '2022-02-01 11:02:38', '2022-02-01 11:02:38'),
(1819, '138.246.253.5', '2022-02-01 05:20:51pm', 1, '2022-02-01 11:20:51', '2022-02-01 11:20:51'),
(1820, '185.220.101.67', '2022-02-01 05:25:34pm', 1, '2022-02-01 11:25:34', '2022-02-01 11:25:34'),
(1821, '138.246.253.5', '2022-02-01 05:27:51pm', 1, '2022-02-01 11:27:51', '2022-02-01 11:27:51'),
(1822, '123.125.109.43', '2022-02-01 05:35:40pm', 1, '2022-02-01 11:35:40', '2022-02-01 11:35:40'),
(1823, '138.246.253.5', '2022-02-01 05:39:48pm', 1, '2022-02-01 11:39:48', '2022-02-01 11:39:48'),
(1824, '209.141.51.222', '2022-02-01 05:46:40pm', 1, '2022-02-01 11:46:40', '2022-02-01 11:46:40'),
(1825, '8.31.2.109', '2022-02-01 05:46:41pm', 1, '2022-02-01 11:46:41', '2022-02-01 11:46:41'),
(1826, '81.163.105.69', '2022-02-01 05:56:49pm', 1, '2022-02-01 11:56:49', '2022-02-01 11:56:49'),
(1827, '81.163.105.69', '2022-02-01 05:56:49pm', 1, '2022-02-01 11:56:49', '2022-02-01 11:56:49'),
(1828, '138.246.253.5', '2022-02-01 05:58:24pm', 1, '2022-02-01 11:58:24', '2022-02-01 11:58:24'),
(1829, '104.196.22.115', '2022-02-01 06:09:13pm', 1, '2022-02-01 12:09:13', '2022-02-01 12:09:13'),
(1830, '104.196.22.115', '2022-02-01 06:10:25pm', 1, '2022-02-01 12:10:25', '2022-02-01 12:10:25'),
(1831, '138.128.9.187', '2022-02-01 06:59:04pm', 1, '2022-02-01 12:59:04', '2022-02-01 12:59:04'),
(1832, '18.220.47.43', '2022-02-01 07:16:04pm', 1, '2022-02-01 13:16:04', '2022-02-01 13:16:04'),
(1833, '18.220.47.43', '2022-02-01 07:16:04pm', 1, '2022-02-01 13:16:04', '2022-02-01 13:16:04'),
(1834, '18.220.47.43', '2022-02-01 07:16:04pm', 1, '2022-02-01 13:16:04', '2022-02-01 13:16:04'),
(1835, '18.220.47.43', '2022-02-01 07:16:04pm', 1, '2022-02-01 13:16:04', '2022-02-01 13:16:04'),
(1836, '18.220.47.43', '2022-02-01 07:16:05pm', 1, '2022-02-01 13:16:05', '2022-02-01 13:16:05'),
(1837, '34.220.223.52', '2022-02-01 07:31:13pm', 1, '2022-02-01 13:31:13', '2022-02-01 13:31:13'),
(1838, '34.219.7.164', '2022-02-01 07:31:17pm', 1, '2022-02-01 13:31:17', '2022-02-01 13:31:17'),
(1839, '173.252.127.28', '2022-02-01 07:34:04pm', 1, '2022-02-01 13:34:04', '2022-02-01 13:34:04'),
(1840, '191.101.207.136', '2022-02-01 07:45:29pm', 1, '2022-02-01 13:45:29', '2022-02-01 13:45:29'),
(1841, '138.246.253.5', '2022-02-01 07:49:45pm', 1, '2022-02-01 13:49:45', '2022-02-01 13:49:45'),
(1842, '31.134.125.80', '2022-02-01 08:07:19pm', 1, '2022-02-01 14:07:19', '2022-02-01 14:07:19'),
(1843, '34.74.250.71', '2022-02-01 08:36:49pm', 1, '2022-02-01 14:36:49', '2022-02-01 14:36:49'),
(1844, '5.140.65.238', '2022-02-01 08:43:48pm', 1, '2022-02-01 14:43:48', '2022-02-01 14:43:48'),
(1845, '128.199.185.176', '2022-02-01 09:40:50pm', 1, '2022-02-01 15:40:50', '2022-02-01 15:40:50'),
(1846, '128.199.185.176', '2022-02-01 09:40:50pm', 1, '2022-02-01 15:40:50', '2022-02-01 15:40:50'),
(1847, '128.199.185.176', '2022-02-01 09:40:51pm', 1, '2022-02-01 15:40:51', '2022-02-01 15:40:51'),
(1848, '198.54.114.190', '2022-02-01 09:46:53pm', 1, '2022-02-01 15:46:53', '2022-02-01 15:46:53'),
(1849, '198.54.114.190', '2022-02-01 09:46:53pm', 1, '2022-02-01 15:46:53', '2022-02-01 15:46:53'),
(1850, '162.55.85.228', '2022-02-01 10:05:21pm', 1, '2022-02-01 16:05:21', '2022-02-01 16:05:21'),
(1851, '66.249.79.11', '2022-02-01 10:09:13pm', 1, '2022-02-01 16:09:13', '2022-02-01 16:09:13'),
(1852, '1.14.96.114', '2022-02-01 10:15:31pm', 1, '2022-02-01 16:15:31', '2022-02-01 16:15:31'),
(1853, '1.14.96.114', '2022-02-01 10:15:31pm', 1, '2022-02-01 16:15:31', '2022-02-01 16:15:31'),
(1854, '1.14.96.114', '2022-02-01 10:15:32pm', 1, '2022-02-01 16:15:32', '2022-02-01 16:15:32'),
(1855, '1.14.96.114', '2022-02-01 10:15:32pm', 1, '2022-02-01 16:15:32', '2022-02-01 16:15:32'),
(1856, '1.14.96.114', '2022-02-01 10:15:34pm', 1, '2022-02-01 16:15:34', '2022-02-01 16:15:34'),
(1857, '1.14.96.114', '2022-02-01 10:15:35pm', 1, '2022-02-01 16:15:35', '2022-02-01 16:15:35'),
(1858, '1.14.96.114', '2022-02-01 10:15:35pm', 1, '2022-02-01 16:15:35', '2022-02-01 16:15:35'),
(1859, '1.14.96.114', '2022-02-01 10:15:36pm', 1, '2022-02-01 16:15:36', '2022-02-01 16:15:36'),
(1860, '1.14.96.114', '2022-02-01 10:15:37pm', 1, '2022-02-01 16:15:37', '2022-02-01 16:15:37'),
(1861, '1.14.96.114', '2022-02-01 10:15:37pm', 1, '2022-02-01 16:15:37', '2022-02-01 16:15:37'),
(1862, '1.14.96.114', '2022-02-01 10:15:38pm', 1, '2022-02-01 16:15:38', '2022-02-01 16:15:38'),
(1863, '1.14.96.114', '2022-02-01 10:15:38pm', 1, '2022-02-01 16:15:38', '2022-02-01 16:15:38'),
(1864, '1.14.96.114', '2022-02-01 10:15:39pm', 1, '2022-02-01 16:15:39', '2022-02-01 16:15:39'),
(1865, '1.14.96.114', '2022-02-01 10:15:40pm', 1, '2022-02-01 16:15:40', '2022-02-01 16:15:40'),
(1866, '1.14.96.114', '2022-02-01 10:15:42pm', 1, '2022-02-01 16:15:42', '2022-02-01 16:15:42'),
(1867, '1.14.96.114', '2022-02-01 10:15:42pm', 1, '2022-02-01 16:15:42', '2022-02-01 16:15:42'),
(1868, '1.14.96.114', '2022-02-01 10:15:43pm', 1, '2022-02-01 16:15:43', '2022-02-01 16:15:43'),
(1869, '1.14.96.114', '2022-02-01 10:15:44pm', 1, '2022-02-01 16:15:44', '2022-02-01 16:15:44'),
(1870, '1.14.96.114', '2022-02-01 10:15:45pm', 1, '2022-02-01 16:15:45', '2022-02-01 16:15:45'),
(1871, '1.14.96.114', '2022-02-01 10:15:46pm', 1, '2022-02-01 16:15:46', '2022-02-01 16:15:46'),
(1872, '66.220.149.32', '2022-02-01 10:25:40pm', 1, '2022-02-01 16:25:40', '2022-02-01 16:25:40'),
(1873, '185.119.81.109', '2022-02-01 11:07:55pm', 1, '2022-02-01 17:07:55', '2022-02-01 17:07:55'),
(1874, '185.119.81.109', '2022-02-01 11:08:04pm', 1, '2022-02-01 17:08:04', '2022-02-01 17:08:04'),
(1875, '185.119.81.109', '2022-02-01 11:09:04pm', 1, '2022-02-01 17:09:04', '2022-02-01 17:09:04'),
(1876, '185.119.81.109', '2022-02-01 11:09:36pm', 1, '2022-02-01 17:09:36', '2022-02-01 17:09:36'),
(1877, '185.119.81.109', '2022-02-01 11:09:44pm', 1, '2022-02-01 17:09:44', '2022-02-01 17:09:44'),
(1878, '188.235.156.84', '2022-02-01 11:13:11pm', 1, '2022-02-01 17:13:11', '2022-02-01 17:13:11'),
(1879, '176.31.115.13', '2022-02-02 01:37:34am', 1, '2022-02-01 19:37:34', '2022-02-01 19:37:34'),
(1880, '92.118.160.13', '2022-02-02 01:56:30am', 1, '2022-02-01 19:56:30', '2022-02-01 19:56:30'),
(1881, '188.234.30.54', '2022-02-02 02:05:41am', 1, '2022-02-01 20:05:41', '2022-02-01 20:05:41'),
(1882, '176.31.106.179', '2022-02-02 02:19:35am', 1, '2022-02-01 20:19:35', '2022-02-01 20:19:35'),
(1883, '80.211.183.221', '2022-02-02 02:30:16am', 1, '2022-02-01 20:30:16', '2022-02-01 20:30:16'),
(1884, '91.192.135.215', '2022-02-02 03:18:20am', 1, '2022-02-01 21:18:20', '2022-02-01 21:18:20'),
(1885, '31.13.115.18', '2022-02-02 03:21:51am', 1, '2022-02-01 21:21:51', '2022-02-01 21:21:51'),
(1886, '157.245.148.208', '2022-02-02 04:00:00am', 1, '2022-02-01 22:00:00', '2022-02-01 22:00:00'),
(1887, '157.245.148.208', '2022-02-02 04:00:00am', 1, '2022-02-01 22:00:00', '2022-02-01 22:00:00'),
(1888, '157.245.148.208', '2022-02-02 04:00:00am', 1, '2022-02-01 22:00:00', '2022-02-01 22:00:00'),
(1889, '46.148.234.229', '2022-02-02 04:05:06am', 1, '2022-02-01 22:05:06', '2022-02-01 22:05:06'),
(1890, '46.148.234.229', '2022-02-02 04:05:09am', 1, '2022-02-01 22:05:09', '2022-02-01 22:05:09'),
(1891, '117.98.40.46', '2022-02-02 04:13:55am', 1, '2022-02-01 22:13:55', '2022-02-01 22:13:55'),
(1892, '117.98.40.46', '2022-02-02 04:14:16am', 1, '2022-02-01 22:14:16', '2022-02-01 22:14:16'),
(1893, '66.249.79.7', '2022-02-02 04:22:53am', 1, '2022-02-01 22:22:53', '2022-02-01 22:22:53'),
(1894, '35.247.14.240', '2022-02-02 04:29:50am', 1, '2022-02-01 22:29:50', '2022-02-01 22:29:50'),
(1895, '34.121.26.164', '2022-02-02 04:29:51am', 1, '2022-02-01 22:29:51', '2022-02-01 22:29:51'),
(1896, '66.249.79.7', '2022-02-02 04:36:31am', 1, '2022-02-01 22:36:31', '2022-02-01 22:36:31'),
(1897, '138.246.253.5', '2022-02-02 04:49:41am', 1, '2022-02-01 22:49:41', '2022-02-01 22:49:41'),
(1898, '154.51.131.142', '2022-02-02 05:49:07am', 1, '2022-02-01 23:49:07', '2022-02-01 23:49:07'),
(1899, '165.227.19.192', '2022-02-02 05:54:48am', 1, '2022-02-01 23:54:48', '2022-02-01 23:54:48'),
(1900, '165.227.19.192', '2022-02-02 05:54:49am', 1, '2022-02-01 23:54:49', '2022-02-01 23:54:49'),
(1901, '165.227.19.192', '2022-02-02 05:54:49am', 1, '2022-02-01 23:54:49', '2022-02-01 23:54:49'),
(1902, '165.227.19.192', '2022-02-02 05:54:55am', 1, '2022-02-01 23:54:56', '2022-02-01 23:54:56'),
(1903, '165.227.19.192', '2022-02-02 05:54:56am', 1, '2022-02-01 23:54:56', '2022-02-01 23:54:56'),
(1904, '165.227.19.192', '2022-02-02 05:54:57am', 1, '2022-02-01 23:54:57', '2022-02-01 23:54:57'),
(1905, '165.227.19.192', '2022-02-02 05:54:59am', 1, '2022-02-01 23:54:59', '2022-02-01 23:54:59'),
(1906, '165.227.19.192', '2022-02-02 05:54:59am', 1, '2022-02-01 23:54:59', '2022-02-01 23:54:59'),
(1907, '193.187.104.178', '2022-02-02 06:15:32am', 1, '2022-02-02 00:15:32', '2022-02-02 00:15:32'),
(1908, '176.88.75.194', '2022-02-02 06:38:17am', 1, '2022-02-02 00:38:17', '2022-02-02 00:38:17'),
(1909, '176.88.75.194', '2022-02-02 06:38:35am', 1, '2022-02-02 00:38:35', '2022-02-02 00:38:35'),
(1910, '194.163.134.34', '2022-02-02 06:40:20am', 1, '2022-02-02 00:40:20', '2022-02-02 00:40:20'),
(1911, '194.163.134.34', '2022-02-02 06:40:20am', 1, '2022-02-02 00:40:20', '2022-02-02 00:40:20'),
(1912, '138.246.253.5', '2022-02-02 06:51:56am', 1, '2022-02-02 00:51:56', '2022-02-02 00:51:56'),
(1913, '146.70.8.5', '2022-02-02 06:55:40am', 1, '2022-02-02 00:55:40', '2022-02-02 00:55:40'),
(1914, '173.252.127.35', '2022-02-02 07:31:27am', 1, '2022-02-02 01:31:27', '2022-02-02 01:31:27'),
(1915, '173.252.127.4', '2022-02-02 07:31:27am', 1, '2022-02-02 01:31:27', '2022-02-02 01:31:27'),
(1916, '173.252.127.119', '2022-02-02 07:31:27am', 1, '2022-02-02 01:31:27', '2022-02-02 01:31:27'),
(1917, '66.249.68.12', '2022-02-02 08:19:09am', 1, '2022-02-02 02:19:09', '2022-02-02 02:19:09'),
(1918, '123.183.224.115', '2022-02-02 08:38:34am', 1, '2022-02-02 02:38:34', '2022-02-02 02:38:34'),
(1919, '193.169.253.35', '2022-02-02 10:04:25am', 1, '2022-02-02 04:04:25', '2022-02-02 04:04:25'),
(1920, '34.86.35.4', '2022-02-02 10:15:37am', 1, '2022-02-02 04:15:37', '2022-02-02 04:15:37'),
(1921, '185.76.11.23', '2022-02-02 10:22:21am', 1, '2022-02-02 04:22:22', '2022-02-02 04:22:22'),
(1922, '131.220.6.152', '2022-02-02 10:54:04am', 1, '2022-02-02 04:54:04', '2022-02-02 04:54:04'),
(1923, '93.95.230.253', '2022-02-02 10:58:39am', 1, '2022-02-02 04:58:39', '2022-02-02 04:58:39'),
(1924, '138.246.253.5', '2022-02-02 11:18:26am', 1, '2022-02-02 05:18:26', '2022-02-02 05:18:26'),
(1925, '118.179.97.39', '2022-02-02 11:43:49am', 1, '2022-02-02 05:43:49', '2022-02-02 05:43:49'),
(1926, '118.179.97.39', '2022-02-02 11:44:35am', 1, '2022-02-02 05:44:35', '2022-02-02 05:44:35'),
(1927, '88.99.136.18', '2022-02-02 11:45:14am', 1, '2022-02-02 05:45:14', '2022-02-02 05:45:14'),
(1928, '118.179.97.39', '2022-02-02 11:48:41am', 1, '2022-02-02 05:48:41', '2022-02-02 05:48:41'),
(1929, '40.77.167.79', '2022-02-02 12:45:05pm', 1, '2022-02-02 06:45:05', '2022-02-02 06:45:05'),
(1930, '87.250.224.149', '2022-02-02 01:02:57pm', 1, '2022-02-02 07:02:57', '2022-02-02 07:02:57'),
(1931, '191.101.132.141', '2022-02-02 01:06:44pm', 1, '2022-02-02 07:06:44', '2022-02-02 07:06:44'),
(1932, '185.191.34.215', '2022-02-02 01:30:57pm', 1, '2022-02-02 07:30:57', '2022-02-02 07:30:57'),
(1933, '66.249.79.7', '2022-02-02 01:43:05pm', 1, '2022-02-02 07:43:05', '2022-02-02 07:43:05'),
(1934, '40.125.67.32', '2022-02-02 01:54:25pm', 1, '2022-02-02 07:54:25', '2022-02-02 07:54:25'),
(1935, '40.125.67.32', '2022-02-02 01:54:25pm', 1, '2022-02-02 07:54:25', '2022-02-02 07:54:25'),
(1936, '84.244.23.251', '2022-02-02 02:03:27pm', 1, '2022-02-02 08:03:27', '2022-02-02 08:03:27'),
(1937, '84.244.23.251', '2022-02-02 02:03:27pm', 1, '2022-02-02 08:03:27', '2022-02-02 08:03:27'),
(1938, '118.184.177.110', '2022-02-02 03:06:58pm', 1, '2022-02-02 09:06:58', '2022-02-02 09:06:58'),
(1939, '5.140.65.238', '2022-02-02 03:23:42pm', 1, '2022-02-02 09:23:42', '2022-02-02 09:23:42'),
(1940, '155.94.166.183', '2022-02-02 05:01:43pm', 1, '2022-02-02 11:01:43', '2022-02-02 11:01:43'),
(1941, '114.119.138.151', '2022-02-02 05:45:01pm', 1, '2022-02-02 11:45:01', '2022-02-02 11:45:01'),
(1942, '118.184.177.109', '2022-02-02 06:00:22pm', 1, '2022-02-02 12:00:22', '2022-02-02 12:00:22'),
(1943, '188.126.73.217', '2022-02-02 06:09:39pm', 1, '2022-02-02 12:09:39', '2022-02-02 12:09:39'),
(1944, '103.62.48.229', '2022-02-02 06:18:24pm', 1, '2022-02-02 12:18:24', '2022-02-02 12:18:24'),
(1945, '103.62.48.229', '2022-02-02 06:18:24pm', 1, '2022-02-02 12:18:24', '2022-02-02 12:18:24'),
(1946, '103.62.48.229', '2022-02-02 06:18:25pm', 1, '2022-02-02 12:18:25', '2022-02-02 12:18:25'),
(1947, '5.135.137.50', '2022-02-02 06:28:28pm', 1, '2022-02-02 12:28:28', '2022-02-02 12:28:28'),
(1948, '5.135.137.50', '2022-02-02 06:44:06pm', 1, '2022-02-02 12:44:06', '2022-02-02 12:44:06'),
(1949, '124.206.180.139', '2022-02-02 06:55:12pm', 1, '2022-02-02 12:55:12', '2022-02-02 12:55:12'),
(1950, '188.234.30.54', '2022-02-02 08:41:09pm', 1, '2022-02-02 14:41:09', '2022-02-02 14:41:09'),
(1951, '103.241.227.106', '2022-02-02 09:11:01pm', 1, '2022-02-02 15:11:02', '2022-02-02 15:11:02'),
(1952, '91.219.236.197', '2022-02-02 09:43:22pm', 1, '2022-02-02 15:43:22', '2022-02-02 15:43:22'),
(1953, '91.219.236.197', '2022-02-02 09:43:25pm', 1, '2022-02-02 15:43:25', '2022-02-02 15:43:25'),
(1954, '66.249.68.27', '2022-02-02 10:11:03pm', 1, '2022-02-02 16:11:03', '2022-02-02 16:11:03'),
(1955, '180.75.241.138', '2022-02-02 10:37:17pm', 1, '2022-02-02 16:37:17', '2022-02-02 16:37:17'),
(1956, '3.238.201.135', '2022-02-02 11:47:20pm', 1, '2022-02-02 17:47:20', '2022-02-02 17:47:20'),
(1957, '3.238.201.135', '2022-02-02 11:56:43pm', 1, '2022-02-02 17:56:43', '2022-02-02 17:56:43'),
(1958, '45.72.73.77', '2022-02-03 12:35:16am', 1, '2022-02-02 18:35:16', '2022-02-02 18:35:16'),
(1959, '96.9.77.71', '2022-02-03 01:07:12am', 1, '2022-02-02 19:07:12', '2022-02-02 19:07:12'),
(1960, '143.198.222.240', '2022-02-03 01:13:28am', 1, '2022-02-02 19:13:28', '2022-02-02 19:13:28'),
(1961, '143.198.222.240', '2022-02-03 01:13:28am', 1, '2022-02-02 19:13:28', '2022-02-02 19:13:28'),
(1962, '143.198.222.240', '2022-02-03 01:13:28am', 1, '2022-02-02 19:13:28', '2022-02-02 19:13:28'),
(1963, '194.110.115.8', '2022-02-03 01:32:30am', 1, '2022-02-02 19:32:30', '2022-02-02 19:32:30'),
(1964, '194.110.115.8', '2022-02-03 01:32:32am', 1, '2022-02-02 19:32:32', '2022-02-02 19:32:32'),
(1965, '66.249.68.29', '2022-02-03 01:43:37am', 1, '2022-02-02 19:43:37', '2022-02-02 19:43:37'),
(1966, '161.117.10.233', '2022-02-03 02:16:18am', 1, '2022-02-02 20:16:18', '2022-02-02 20:16:18'),
(1967, '95.37.108.132', '2022-02-03 02:37:48am', 1, '2022-02-02 20:37:48', '2022-02-02 20:37:48'),
(1968, '34.139.141.102', '2022-02-03 03:50:21am', 1, '2022-02-02 21:50:21', '2022-02-02 21:50:21'),
(1969, '34.139.141.102', '2022-02-03 03:51:33am', 1, '2022-02-02 21:51:33', '2022-02-02 21:51:33'),
(1970, '188.126.79.25', '2022-02-03 03:57:08am', 1, '2022-02-02 21:57:08', '2022-02-02 21:57:08'),
(1971, '51.159.23.22', '2022-02-03 03:57:09am', 1, '2022-02-02 21:57:09', '2022-02-02 21:57:09'),
(1972, '51.159.23.22', '2022-02-03 03:57:18am', 1, '2022-02-02 21:57:19', '2022-02-02 21:57:19'),
(1973, '72.255.9.84', '2022-02-03 04:50:23am', 1, '2022-02-02 22:50:23', '2022-02-02 22:50:23'),
(1974, '91.223.89.107', '2022-02-03 05:08:35am', 1, '2022-02-02 23:08:35', '2022-02-02 23:08:35'),
(1975, '109.248.149.3', '2022-02-03 05:33:00am', 1, '2022-02-02 23:33:00', '2022-02-02 23:33:00'),
(1976, '109.248.149.3', '2022-02-03 05:33:03am', 1, '2022-02-02 23:33:03', '2022-02-02 23:33:03'),
(1977, '54.174.54.251', '2022-02-03 05:59:58am', 1, '2022-02-02 23:59:58', '2022-02-02 23:59:58'),
(1978, '142.44.166.135', '2022-02-03 06:18:16am', 1, '2022-02-03 00:18:16', '2022-02-03 00:18:16'),
(1979, '66.249.79.11', '2022-02-03 06:18:49am', 1, '2022-02-03 00:18:49', '2022-02-03 00:18:49'),
(1980, '35.243.246.223', '2022-02-03 06:27:59am', 1, '2022-02-03 00:27:59', '2022-02-03 00:27:59'),
(1981, '1.169.128.236', '2022-02-03 07:42:51am', 1, '2022-02-03 01:42:51', '2022-02-03 01:42:51'),
(1982, '188.130.142.195', '2022-02-03 08:08:41am', 1, '2022-02-03 02:08:41', '2022-02-03 02:08:41'),
(1983, '188.130.142.195', '2022-02-03 08:08:46am', 1, '2022-02-03 02:08:46', '2022-02-03 02:08:46'),
(1984, '123.125.109.43', '2022-02-03 08:33:03am', 1, '2022-02-03 02:33:03', '2022-02-03 02:33:03'),
(1985, '95.163.255.17', '2022-02-03 08:42:18am', 1, '2022-02-03 02:42:18', '2022-02-03 02:42:18'),
(1986, '66.220.149.10', '2022-02-03 09:33:10am', 1, '2022-02-03 03:33:10', '2022-02-03 03:33:10'),
(1987, '162.241.219.161', '2022-02-03 10:04:15am', 1, '2022-02-03 04:04:15', '2022-02-03 04:04:15'),
(1988, '66.249.79.4', '2022-02-03 10:28:52am', 1, '2022-02-03 04:28:52', '2022-02-03 04:28:52'),
(1989, '2.92.192.121', '2022-02-03 10:43:37am', 1, '2022-02-03 04:43:37', '2022-02-03 04:43:37'),
(1990, '131.220.6.152', '2022-02-03 10:59:19am', 1, '2022-02-03 04:59:19', '2022-02-03 04:59:19'),
(1991, '194.163.134.34', '2022-02-03 12:00:26pm', 1, '2022-02-03 06:00:26', '2022-02-03 06:00:26'),
(1992, '194.163.134.34', '2022-02-03 12:00:27pm', 1, '2022-02-03 06:00:27', '2022-02-03 06:00:27'),
(1993, '69.160.160.51', '2022-02-03 12:21:08pm', 1, '2022-02-03 06:21:08', '2022-02-03 06:21:08'),
(1994, '69.160.160.51', '2022-02-03 12:21:10pm', 1, '2022-02-03 06:21:10', '2022-02-03 06:21:10'),
(1995, '69.160.160.51', '2022-02-03 12:21:21pm', 1, '2022-02-03 06:21:21', '2022-02-03 06:21:21'),
(1996, '69.160.160.51', '2022-02-03 12:21:25pm', 1, '2022-02-03 06:21:25', '2022-02-03 06:21:25'),
(1997, '185.191.171.45', '2022-02-03 12:48:39pm', 1, '2022-02-03 06:48:39', '2022-02-03 06:48:39'),
(1998, '220.152.113.20', '2022-02-03 12:48:55pm', 1, '2022-02-03 06:48:55', '2022-02-03 06:48:55'),
(1999, '3.68.50.38', '2022-02-03 12:52:05pm', 1, '2022-02-03 06:52:05', '2022-02-03 06:52:05'),
(2000, '75.15.244.98', '2022-02-03 01:12:00pm', 1, '2022-02-03 07:12:00', '2022-02-03 07:12:00'),
(2001, '220.152.113.20', '2022-02-03 01:16:11pm', 1, '2022-02-03 07:16:11', '2022-02-03 07:16:11'),
(2002, '188.126.79.25', '2022-02-03 02:06:27pm', 1, '2022-02-03 08:06:27', '2022-02-03 08:06:27'),
(2003, '123.125.109.43', '2022-02-03 02:14:43pm', 1, '2022-02-03 08:14:43', '2022-02-03 08:14:43'),
(2004, '188.234.30.54', '2022-02-03 02:38:57pm', 1, '2022-02-03 08:38:57', '2022-02-03 08:38:57'),
(2005, '170.155.100.128', '2022-02-03 02:52:00pm', 1, '2022-02-03 08:52:00', '2022-02-03 08:52:00'),
(2006, '185.220.102.243', '2022-02-03 04:07:14pm', 1, '2022-02-03 10:07:14', '2022-02-03 10:07:14'),
(2007, '66.249.79.7', '2022-02-03 05:13:52pm', 1, '2022-02-03 11:13:52', '2022-02-03 11:13:52'),
(2008, '123.125.109.43', '2022-02-03 05:35:52pm', 1, '2022-02-03 11:35:52', '2022-02-03 11:35:52'),
(2009, '102.46.146.43', '2022-02-03 05:40:32pm', 1, '2022-02-03 11:40:32', '2022-02-03 11:40:32'),
(2010, '66.249.79.13', '2022-02-03 05:54:17pm', 1, '2022-02-03 11:54:17', '2022-02-03 11:54:17'),
(2011, '1.202.249.94', '2022-02-03 06:04:09pm', 1, '2022-02-03 12:04:09', '2022-02-03 12:04:09'),
(2012, '40.77.167.79', '2022-02-03 06:49:57pm', 1, '2022-02-03 12:49:57', '2022-02-03 12:49:57'),
(2013, '54.36.149.82', '2022-02-03 07:41:59pm', 1, '2022-02-03 13:42:00', '2022-02-03 13:42:00'),
(2014, '95.163.255.233', '2022-02-03 07:45:17pm', 1, '2022-02-03 13:45:17', '2022-02-03 13:45:17'),
(2015, '103.147.166.204', '2022-02-03 07:57:12pm', 1, '2022-02-03 13:57:12', '2022-02-03 13:57:12'),
(2016, '154.6.26.6', '2022-02-03 08:07:53pm', 1, '2022-02-03 14:07:53', '2022-02-03 14:07:53'),
(2017, '162.142.125.221', '2022-02-03 08:36:35pm', 1, '2022-02-03 14:36:35', '2022-02-03 14:36:35'),
(2018, '162.142.125.221', '2022-02-03 08:36:40pm', 1, '2022-02-03 14:36:40', '2022-02-03 14:36:40'),
(2019, '66.249.79.4', '2022-02-03 10:20:06pm', 1, '2022-02-03 16:20:06', '2022-02-03 16:20:06'),
(2020, '66.249.79.11', '2022-02-03 10:47:21pm', 1, '2022-02-03 16:47:21', '2022-02-03 16:47:21'),
(2021, '191.101.31.46', '2022-02-03 11:58:41pm', 1, '2022-02-03 17:58:41', '2022-02-03 17:58:41'),
(2022, '191.101.31.46', '2022-02-03 11:58:45pm', 1, '2022-02-03 17:58:45', '2022-02-03 17:58:45'),
(2023, '184.72.110.131', '2022-02-04 12:05:04am', 1, '2022-02-03 18:05:04', '2022-02-03 18:05:04'),
(2024, '89.248.68.147', '2022-02-04 12:07:30am', 1, '2022-02-03 18:07:30', '2022-02-03 18:07:30'),
(2025, '89.248.68.147', '2022-02-04 12:07:33am', 1, '2022-02-03 18:07:33', '2022-02-03 18:07:33'),
(2026, '23.229.104.2', '2022-02-04 12:34:48am', 1, '2022-02-03 18:34:48', '2022-02-03 18:34:48'),
(2027, '66.249.68.10', '2022-02-04 12:35:04am', 1, '2022-02-03 18:35:04', '2022-02-03 18:35:04'),
(2028, '191.101.132.35', '2022-02-04 01:32:23am', 1, '2022-02-03 19:32:23', '2022-02-03 19:32:23'),
(2029, '212.193.142.193', '2022-02-04 01:49:40am', 1, '2022-02-03 19:49:40', '2022-02-03 19:49:40'),
(2030, '212.193.142.193', '2022-02-04 01:49:43am', 1, '2022-02-03 19:49:43', '2022-02-03 19:49:43'),
(2031, '91.134.13.237', '2022-02-04 02:06:31am', 1, '2022-02-03 20:06:31', '2022-02-03 20:06:31'),
(2032, '91.134.13.237', '2022-02-04 02:06:35am', 1, '2022-02-03 20:06:35', '2022-02-03 20:06:35'),
(2033, '91.134.13.237', '2022-02-04 02:06:35am', 1, '2022-02-03 20:06:35', '2022-02-03 20:06:35'),
(2034, '54.86.30.235', '2022-02-04 02:30:36am', 1, '2022-02-03 20:30:36', '2022-02-03 20:30:36'),
(2035, '54.86.30.235', '2022-02-04 02:30:37am', 1, '2022-02-03 20:30:37', '2022-02-03 20:30:37'),
(2036, '51.222.253.8', '2022-02-04 03:12:51am', 1, '2022-02-03 21:12:51', '2022-02-03 21:12:51'),
(2037, '46.39.88.72', '2022-02-04 04:07:20am', 1, '2022-02-03 22:07:20', '2022-02-03 22:07:20'),
(2038, '46.39.88.72', '2022-02-04 04:07:23am', 1, '2022-02-03 22:07:23', '2022-02-03 22:07:23'),
(2039, '192.186.145.59', '2022-02-04 04:26:26am', 1, '2022-02-03 22:26:26', '2022-02-03 22:26:26'),
(2040, '188.234.30.54', '2022-02-04 04:53:27am', 1, '2022-02-03 22:53:27', '2022-02-03 22:53:27'),
(2041, '34.77.162.11', '2022-02-04 06:28:40am', 1, '2022-02-04 00:28:40', '2022-02-04 00:28:40'),
(2042, '52.36.134.250', '2022-02-04 07:06:48am', 1, '2022-02-04 01:06:48', '2022-02-04 01:06:48'),
(2043, '137.226.113.44', '2022-02-04 07:58:52am', 1, '2022-02-04 01:58:52', '2022-02-04 01:58:52'),
(2044, '137.226.113.44', '2022-02-04 07:58:53am', 1, '2022-02-04 01:58:53', '2022-02-04 01:58:53'),
(2045, '188.126.73.217', '2022-02-04 08:04:51am', 1, '2022-02-04 02:04:51', '2022-02-04 02:04:51'),
(2046, '123.125.109.43', '2022-02-04 08:35:10am', 1, '2022-02-04 02:35:10', '2022-02-04 02:35:10'),
(2047, '154.54.249.194', '2022-02-04 08:39:42am', 1, '2022-02-04 02:39:43', '2022-02-04 02:39:43'),
(2048, '154.54.249.194', '2022-02-04 08:39:55am', 1, '2022-02-04 02:39:55', '2022-02-04 02:39:55'),
(2049, '66.249.68.27', '2022-02-04 08:40:13am', 1, '2022-02-04 02:40:13', '2022-02-04 02:40:13'),
(2050, '154.54.249.194', '2022-02-04 08:42:17am', 1, '2022-02-04 02:42:17', '2022-02-04 02:42:17'),
(2051, '154.54.249.194', '2022-02-04 08:43:21am', 1, '2022-02-04 02:43:21', '2022-02-04 02:43:21'),
(2052, '188.163.73.203', '2022-02-04 08:45:24am', 1, '2022-02-04 02:45:24', '2022-02-04 02:45:24'),
(2053, '188.163.73.203', '2022-02-04 08:45:27am', 1, '2022-02-04 02:45:27', '2022-02-04 02:45:27'),
(2054, '66.249.68.14', '2022-02-04 08:57:45am', 1, '2022-02-04 02:57:45', '2022-02-04 02:57:45'),
(2055, '66.249.79.11', '2022-02-04 09:24:37am', 1, '2022-02-04 03:24:37', '2022-02-04 03:24:37'),
(2056, '217.114.148.111', '2022-02-04 10:05:55am', 1, '2022-02-04 04:05:55', '2022-02-04 04:05:55'),
(2057, '217.114.148.111', '2022-02-04 10:05:59am', 1, '2022-02-04 04:05:59', '2022-02-04 04:05:59'),
(2058, '217.114.148.111', '2022-02-04 10:06:02am', 1, '2022-02-04 04:06:02', '2022-02-04 04:06:02'),
(2059, '131.220.6.152', '2022-02-04 10:51:58am', 1, '2022-02-04 04:51:58', '2022-02-04 04:51:58'),
(2060, '5.165.129.139', '2022-02-04 11:12:22am', 1, '2022-02-04 05:12:22', '2022-02-04 05:12:22'),
(2061, '46.3.180.39', '2022-02-04 12:56:47pm', 1, '2022-02-04 06:56:47', '2022-02-04 06:56:47'),
(2062, '46.3.180.39', '2022-02-04 12:57:09pm', 1, '2022-02-04 06:57:09', '2022-02-04 06:57:09'),
(2063, '84.39.245.2', '2022-02-04 12:58:46pm', 1, '2022-02-04 06:58:46', '2022-02-04 06:58:46');
INSERT INTO `visitors` (`id`, `ip_address`, `visit_time`, `status`, `created_at`, `updated_at`) VALUES
(2064, '84.244.23.251', '2022-02-04 02:01:23pm', 1, '2022-02-04 08:01:23', '2022-02-04 08:01:23'),
(2065, '84.244.23.251', '2022-02-04 02:01:23pm', 1, '2022-02-04 08:01:23', '2022-02-04 08:01:23'),
(2066, '62.113.116.197', '2022-02-04 02:03:28pm', 1, '2022-02-04 08:03:29', '2022-02-04 08:03:29'),
(2067, '93.89.199.150', '2022-02-04 02:11:26pm', 1, '2022-02-04 08:11:26', '2022-02-04 08:11:26'),
(2068, '167.179.84.108', '2022-02-04 02:33:20pm', 1, '2022-02-04 08:33:20', '2022-02-04 08:33:20'),
(2069, '167.179.84.108', '2022-02-04 02:33:21pm', 1, '2022-02-04 08:33:21', '2022-02-04 08:33:21'),
(2070, '186.179.100.228', '2022-02-04 02:55:18pm', 1, '2022-02-04 08:55:18', '2022-02-04 08:55:18'),
(2071, '178.159.37.66', '2022-02-04 02:58:46pm', 1, '2022-02-04 08:58:46', '2022-02-04 08:58:46'),
(2072, '173.252.107.13', '2022-02-04 03:05:45pm', 1, '2022-02-04 09:05:45', '2022-02-04 09:05:45'),
(2073, '5.62.62.26', '2022-02-04 04:14:22pm', 1, '2022-02-04 10:14:22', '2022-02-04 10:14:22'),
(2074, '91.238.249.131', '2022-02-04 04:57:20pm', 1, '2022-02-04 10:57:20', '2022-02-04 10:57:20'),
(2075, '51.222.133.36', '2022-02-04 05:05:57pm', 1, '2022-02-04 11:05:57', '2022-02-04 11:05:57'),
(2076, '85.154.217.70', '2022-02-04 05:46:08pm', 1, '2022-02-04 11:46:09', '2022-02-04 11:46:09'),
(2077, '31.13.115.18', '2022-02-04 06:05:00pm', 1, '2022-02-04 12:05:00', '2022-02-04 12:05:00'),
(2078, '118.184.177.109', '2022-02-04 06:05:21pm', 1, '2022-02-04 12:05:21', '2022-02-04 12:05:21'),
(2079, '103.135.252.95', '2022-02-04 06:39:28pm', 1, '2022-02-04 12:39:28', '2022-02-04 12:39:28'),
(2080, '188.163.64.206', '2022-02-04 06:39:39pm', 1, '2022-02-04 12:39:39', '2022-02-04 12:39:39'),
(2081, '195.176.3.20', '2022-02-04 07:01:48pm', 1, '2022-02-04 13:01:48', '2022-02-04 13:01:48'),
(2082, '188.234.30.54', '2022-02-04 07:15:22pm', 1, '2022-02-04 13:15:22', '2022-02-04 13:15:22'),
(2083, '34.96.130.8', '2022-02-04 07:26:59pm', 1, '2022-02-04 13:26:59', '2022-02-04 13:26:59'),
(2084, '157.245.153.6', '2022-02-04 07:49:05pm', 1, '2022-02-04 13:49:05', '2022-02-04 13:49:05'),
(2085, '157.245.153.6', '2022-02-04 07:49:06pm', 1, '2022-02-04 13:49:06', '2022-02-04 13:49:06'),
(2086, '157.245.153.6', '2022-02-04 07:49:06pm', 1, '2022-02-04 13:49:06', '2022-02-04 13:49:06'),
(2087, '91.238.249.131', '2022-02-04 08:30:16pm', 1, '2022-02-04 14:30:17', '2022-02-04 14:30:17'),
(2088, '46.3.180.167', '2022-02-04 09:54:14pm', 1, '2022-02-04 15:54:14', '2022-02-04 15:54:14'),
(2089, '46.3.180.167', '2022-02-04 09:54:35pm', 1, '2022-02-04 15:54:35', '2022-02-04 15:54:35'),
(2090, '5.135.137.50', '2022-02-04 10:24:07pm', 1, '2022-02-04 16:24:07', '2022-02-04 16:24:07'),
(2091, '66.249.79.7', '2022-02-04 10:26:46pm', 1, '2022-02-04 16:26:46', '2022-02-04 16:26:46'),
(2092, '5.135.137.50', '2022-02-04 10:29:27pm', 1, '2022-02-04 16:29:27', '2022-02-04 16:29:27'),
(2093, '172.94.122.132', '2022-02-04 10:33:51pm', 1, '2022-02-04 16:33:51', '2022-02-04 16:33:51'),
(2094, '172.94.122.132', '2022-02-04 10:33:58pm', 1, '2022-02-04 16:33:58', '2022-02-04 16:33:58'),
(2095, '185.191.171.4', '2022-02-04 10:50:47pm', 1, '2022-02-04 16:50:47', '2022-02-04 16:50:47'),
(2096, '185.191.171.39', '2022-02-04 10:50:49pm', 1, '2022-02-04 16:50:49', '2022-02-04 16:50:49'),
(2097, '13.52.179.52', '2022-02-04 10:55:05pm', 1, '2022-02-04 16:55:05', '2022-02-04 16:55:05'),
(2098, '84.17.42.24', '2022-02-04 11:00:19pm', 1, '2022-02-04 17:00:19', '2022-02-04 17:00:19'),
(2099, '34.223.54.43', '2022-02-04 11:35:15pm', 1, '2022-02-04 17:35:15', '2022-02-04 17:35:15'),
(2100, '69.171.251.9', '2022-02-04 11:36:11pm', 1, '2022-02-04 17:36:11', '2022-02-04 17:36:11'),
(2101, '194.60.69.218', '2022-02-05 12:51:57am', 1, '2022-02-04 18:51:57', '2022-02-04 18:51:57'),
(2102, '95.181.233.132', '2022-02-05 01:27:40am', 1, '2022-02-04 19:27:40', '2022-02-04 19:27:40'),
(2103, '20.126.75.194', '2022-02-05 02:25:14am', 1, '2022-02-04 20:25:14', '2022-02-04 20:25:14'),
(2104, '45.129.18.30', '2022-02-05 03:55:51am', 1, '2022-02-04 21:55:51', '2022-02-04 21:55:51'),
(2105, '37.115.207.220', '2022-02-05 04:02:58am', 1, '2022-02-04 22:02:58', '2022-02-04 22:02:58'),
(2106, '37.115.207.220', '2022-02-05 04:02:59am', 1, '2022-02-04 22:02:59', '2022-02-04 22:02:59'),
(2107, '77.65.215.1', '2022-02-05 04:33:21am', 1, '2022-02-04 22:33:21', '2022-02-04 22:33:21'),
(2108, '159.223.93.59', '2022-02-05 04:53:36am', 1, '2022-02-04 22:53:36', '2022-02-04 22:53:36'),
(2109, '159.223.93.59', '2022-02-05 04:53:36am', 1, '2022-02-04 22:53:36', '2022-02-04 22:53:36'),
(2110, '159.223.93.59', '2022-02-05 04:53:37am', 1, '2022-02-04 22:53:37', '2022-02-04 22:53:37'),
(2111, '95.163.255.122', '2022-02-05 05:45:00am', 1, '2022-02-04 23:45:00', '2022-02-04 23:45:00'),
(2112, '92.118.160.17', '2022-02-05 06:14:58am', 1, '2022-02-05 00:14:58', '2022-02-05 00:14:58'),
(2113, '66.249.79.7', '2022-02-05 07:02:46am', 1, '2022-02-05 01:02:46', '2022-02-05 01:02:46'),
(2114, '159.65.39.111', '2022-02-05 07:32:07am', 1, '2022-02-05 01:32:07', '2022-02-05 01:32:07'),
(2115, '54.36.148.144', '2022-02-05 07:36:53am', 1, '2022-02-05 01:36:53', '2022-02-05 01:36:53'),
(2116, '154.6.26.6', '2022-02-05 07:52:42am', 1, '2022-02-05 01:52:42', '2022-02-05 01:52:42'),
(2117, '66.249.79.7', '2022-02-05 08:20:51am', 1, '2022-02-05 02:20:51', '2022-02-05 02:20:51'),
(2118, '74.134.17.177', '2022-02-05 08:27:01am', 1, '2022-02-05 02:27:01', '2022-02-05 02:27:01'),
(2119, '123.125.109.43', '2022-02-05 08:34:05am', 1, '2022-02-05 02:34:05', '2022-02-05 02:34:05'),
(2120, '66.249.79.13', '2022-02-05 08:50:08am', 1, '2022-02-05 02:50:08', '2022-02-05 02:50:08'),
(2121, '178.159.37.24', '2022-02-05 10:10:17am', 1, '2022-02-05 04:10:17', '2022-02-05 04:10:17'),
(2122, '34.77.162.2', '2022-02-05 10:44:57am', 1, '2022-02-05 04:44:57', '2022-02-05 04:44:57'),
(2123, '131.220.6.152', '2022-02-05 10:51:34am', 1, '2022-02-05 04:51:34', '2022-02-05 04:51:34'),
(2124, '66.249.68.14', '2022-02-05 10:54:17am', 1, '2022-02-05 04:54:17', '2022-02-05 04:54:17'),
(2125, '104.144.7.98', '2022-02-05 10:59:01am', 1, '2022-02-05 04:59:01', '2022-02-05 04:59:01'),
(2126, '66.249.68.31', '2022-02-05 11:00:20am', 1, '2022-02-05 05:00:20', '2022-02-05 05:00:20'),
(2127, '34.244.73.230', '2022-02-05 11:02:42am', 1, '2022-02-05 05:02:42', '2022-02-05 05:02:42'),
(2128, '104.236.217.60', '2022-02-05 11:09:45am', 1, '2022-02-05 05:09:45', '2022-02-05 05:09:45'),
(2129, '31.13.127.10', '2022-02-05 11:27:21am', 1, '2022-02-05 05:27:21', '2022-02-05 05:27:21'),
(2130, '5.255.98.156', '2022-02-05 11:52:00am', 1, '2022-02-05 05:52:00', '2022-02-05 05:52:00'),
(2131, '209.145.61.249', '2022-02-05 01:14:06pm', 1, '2022-02-05 07:14:06', '2022-02-05 07:14:06'),
(2132, '207.244.241.132', '2022-02-05 01:18:02pm', 1, '2022-02-05 07:18:02', '2022-02-05 07:18:02'),
(2133, '128.0.63.180', '2022-02-05 01:37:41pm', 1, '2022-02-05 07:37:41', '2022-02-05 07:37:41'),
(2134, '66.249.79.4', '2022-02-05 02:18:29pm', 1, '2022-02-05 08:18:29', '2022-02-05 08:18:29'),
(2135, '14.29.238.135', '2022-02-05 02:24:16pm', 1, '2022-02-05 08:24:16', '2022-02-05 08:24:16'),
(2136, '14.29.238.135', '2022-02-05 02:24:17pm', 1, '2022-02-05 08:24:17', '2022-02-05 08:24:17'),
(2137, '14.29.238.135', '2022-02-05 02:24:17pm', 1, '2022-02-05 08:24:17', '2022-02-05 08:24:17'),
(2138, '14.29.238.135', '2022-02-05 02:24:18pm', 1, '2022-02-05 08:24:18', '2022-02-05 08:24:18'),
(2139, '14.29.238.135', '2022-02-05 02:24:19pm', 1, '2022-02-05 08:24:19', '2022-02-05 08:24:19'),
(2140, '14.29.238.135', '2022-02-05 02:24:19pm', 1, '2022-02-05 08:24:19', '2022-02-05 08:24:19'),
(2141, '14.29.238.135', '2022-02-05 02:24:20pm', 1, '2022-02-05 08:24:20', '2022-02-05 08:24:20'),
(2142, '14.29.238.135', '2022-02-05 02:24:21pm', 1, '2022-02-05 08:24:21', '2022-02-05 08:24:21'),
(2143, '14.29.238.135', '2022-02-05 02:24:22pm', 1, '2022-02-05 08:24:22', '2022-02-05 08:24:22'),
(2144, '14.29.238.135', '2022-02-05 02:24:22pm', 1, '2022-02-05 08:24:22', '2022-02-05 08:24:22'),
(2145, '14.29.238.135', '2022-02-05 02:24:23pm', 1, '2022-02-05 08:24:23', '2022-02-05 08:24:23'),
(2146, '14.29.238.135', '2022-02-05 02:24:24pm', 1, '2022-02-05 08:24:24', '2022-02-05 08:24:24'),
(2147, '14.29.238.135', '2022-02-05 02:24:24pm', 1, '2022-02-05 08:24:24', '2022-02-05 08:24:24'),
(2148, '14.29.238.135', '2022-02-05 02:24:25pm', 1, '2022-02-05 08:24:25', '2022-02-05 08:24:25'),
(2149, '14.29.238.135', '2022-02-05 02:24:26pm', 1, '2022-02-05 08:24:26', '2022-02-05 08:24:26'),
(2150, '14.29.238.135', '2022-02-05 02:24:26pm', 1, '2022-02-05 08:24:26', '2022-02-05 08:24:26'),
(2151, '14.29.238.135', '2022-02-05 02:24:27pm', 1, '2022-02-05 08:24:27', '2022-02-05 08:24:27'),
(2152, '14.29.238.135', '2022-02-05 02:24:28pm', 1, '2022-02-05 08:24:28', '2022-02-05 08:24:28'),
(2153, '14.29.238.135', '2022-02-05 02:24:28pm', 1, '2022-02-05 08:24:28', '2022-02-05 08:24:28'),
(2154, '14.29.238.135', '2022-02-05 02:24:29pm', 1, '2022-02-05 08:24:29', '2022-02-05 08:24:29'),
(2155, '118.184.177.109', '2022-02-05 02:27:28pm', 1, '2022-02-05 08:27:28', '2022-02-05 08:27:28'),
(2156, '220.152.113.20', '2022-02-05 02:52:24pm', 1, '2022-02-05 08:52:24', '2022-02-05 08:52:24'),
(2157, '157.55.39.48', '2022-02-05 02:55:50pm', 1, '2022-02-05 08:55:50', '2022-02-05 08:55:50'),
(2158, '54.36.149.52', '2022-02-05 02:58:53pm', 1, '2022-02-05 08:58:53', '2022-02-05 08:58:53'),
(2159, '220.152.113.20', '2022-02-05 02:59:52pm', 1, '2022-02-05 08:59:52', '2022-02-05 08:59:52'),
(2160, '188.126.73.217', '2022-02-05 03:23:28pm', 1, '2022-02-05 09:23:28', '2022-02-05 09:23:28'),
(2161, '118.179.97.39', '2022-02-05 03:23:42pm', 1, '2022-02-05 09:23:43', '2022-02-05 09:23:43'),
(2162, '118.179.97.39', '2022-02-05 03:24:05pm', 1, '2022-02-05 09:24:05', '2022-02-05 09:24:05'),
(2163, '118.179.97.39', '2022-02-05 03:24:08pm', 1, '2022-02-05 09:24:08', '2022-02-05 09:24:08'),
(2164, '118.179.97.39', '2022-02-05 03:24:10pm', 1, '2022-02-05 09:24:10', '2022-02-05 09:24:10'),
(2165, '118.179.97.39', '2022-02-05 03:24:13pm', 1, '2022-02-05 09:24:13', '2022-02-05 09:24:13'),
(2166, '118.179.97.39', '2022-02-05 03:24:18pm', 1, '2022-02-05 09:24:18', '2022-02-05 09:24:18'),
(2167, '118.179.97.39', '2022-02-05 03:24:32pm', 1, '2022-02-05 09:24:32', '2022-02-05 09:24:32'),
(2168, '118.179.97.39', '2022-02-05 03:24:37pm', 1, '2022-02-05 09:24:37', '2022-02-05 09:24:37'),
(2169, '118.179.97.39', '2022-02-05 03:24:41pm', 1, '2022-02-05 09:24:41', '2022-02-05 09:24:41'),
(2170, '118.179.97.39', '2022-02-05 03:24:53pm', 1, '2022-02-05 09:24:53', '2022-02-05 09:24:53'),
(2171, '118.179.97.39', '2022-02-05 03:27:54pm', 1, '2022-02-05 09:27:54', '2022-02-05 09:27:54'),
(2172, '118.179.97.39', '2022-02-05 03:28:41pm', 1, '2022-02-05 09:28:41', '2022-02-05 09:28:41'),
(2173, '118.179.97.39', '2022-02-05 03:28:55pm', 1, '2022-02-05 09:28:55', '2022-02-05 09:28:55'),
(2174, '118.179.97.39', '2022-02-05 03:30:06pm', 1, '2022-02-05 09:30:06', '2022-02-05 09:30:06'),
(2175, '118.179.97.39', '2022-02-05 03:35:18pm', 1, '2022-02-05 09:35:18', '2022-02-05 09:35:18'),
(2176, '37.115.207.220', '2022-02-05 03:53:26pm', 1, '2022-02-05 09:53:26', '2022-02-05 09:53:26'),
(2177, '37.115.207.220', '2022-02-05 03:53:27pm', 1, '2022-02-05 09:53:27', '2022-02-05 09:53:27'),
(2178, '118.179.97.39', '2022-02-05 04:04:15pm', 1, '2022-02-05 10:04:15', '2022-02-05 10:04:15'),
(2179, '116.179.32.222', '2022-02-05 04:38:56pm', 1, '2022-02-05 10:38:56', '2022-02-05 10:38:56'),
(2180, '116.179.32.165', '2022-02-05 04:38:56pm', 1, '2022-02-05 10:38:56', '2022-02-05 10:38:56'),
(2181, '104.196.65.82', '2022-02-05 04:56:13pm', 1, '2022-02-05 10:56:13', '2022-02-05 10:56:13'),
(2182, '104.196.65.82', '2022-02-05 04:57:15pm', 1, '2022-02-05 10:57:15', '2022-02-05 10:57:15'),
(2183, '46.99.5.240', '2022-02-05 05:07:43pm', 1, '2022-02-05 11:07:43', '2022-02-05 11:07:43'),
(2184, '5.253.19.41', '2022-02-05 05:36:06pm', 1, '2022-02-05 11:36:06', '2022-02-05 11:36:06'),
(2185, '5.253.19.41', '2022-02-05 05:36:12pm', 1, '2022-02-05 11:36:12', '2022-02-05 11:36:12'),
(2186, '178.159.37.66', '2022-02-05 05:40:23pm', 1, '2022-02-05 11:40:23', '2022-02-05 11:40:23'),
(2187, '35.227.111.209', '2022-02-05 06:07:08pm', 1, '2022-02-05 12:07:08', '2022-02-05 12:07:08'),
(2188, '194.110.150.202', '2022-02-05 06:09:59pm', 1, '2022-02-05 12:09:59', '2022-02-05 12:09:59'),
(2189, '118.184.177.109', '2022-02-05 06:35:25pm', 1, '2022-02-05 12:35:25', '2022-02-05 12:35:25'),
(2190, '141.95.81.90', '2022-02-05 07:02:29pm', 1, '2022-02-05 13:02:29', '2022-02-05 13:02:29'),
(2191, '95.142.121.32', '2022-02-05 07:03:52pm', 1, '2022-02-05 13:03:52', '2022-02-05 13:03:52'),
(2192, '95.142.121.32', '2022-02-05 07:03:53pm', 1, '2022-02-05 13:03:53', '2022-02-05 13:03:53'),
(2193, '95.142.121.32', '2022-02-05 07:03:53pm', 1, '2022-02-05 13:03:53', '2022-02-05 13:03:53'),
(2194, '95.142.121.32', '2022-02-05 07:03:53pm', 1, '2022-02-05 13:03:53', '2022-02-05 13:03:53'),
(2195, '95.142.121.32', '2022-02-05 07:03:55pm', 1, '2022-02-05 13:03:55', '2022-02-05 13:03:55'),
(2196, '95.142.121.32', '2022-02-05 07:03:55pm', 1, '2022-02-05 13:03:55', '2022-02-05 13:03:55'),
(2197, '95.142.121.32', '2022-02-05 07:03:56pm', 1, '2022-02-05 13:03:56', '2022-02-05 13:03:56'),
(2198, '95.142.121.32', '2022-02-05 07:03:56pm', 1, '2022-02-05 13:03:56', '2022-02-05 13:03:56'),
(2199, '95.142.121.32', '2022-02-05 07:03:57pm', 1, '2022-02-05 13:03:57', '2022-02-05 13:03:57'),
(2200, '95.142.121.32', '2022-02-05 07:03:58pm', 1, '2022-02-05 13:03:58', '2022-02-05 13:03:58'),
(2201, '95.142.121.32', '2022-02-05 07:03:58pm', 1, '2022-02-05 13:03:58', '2022-02-05 13:03:58'),
(2202, '95.142.121.32', '2022-02-05 07:03:59pm', 1, '2022-02-05 13:03:59', '2022-02-05 13:03:59'),
(2203, '103.78.254.169', '2022-02-05 07:26:49pm', 1, '2022-02-05 13:26:49', '2022-02-05 13:26:49'),
(2204, '103.78.254.169', '2022-02-05 07:27:31pm', 1, '2022-02-05 13:27:31', '2022-02-05 13:27:31'),
(2205, '103.78.254.169', '2022-02-05 07:27:33pm', 1, '2022-02-05 13:27:33', '2022-02-05 13:27:33'),
(2206, '103.78.254.169', '2022-02-05 07:27:33pm', 1, '2022-02-05 13:27:33', '2022-02-05 13:27:33'),
(2207, '103.78.254.169', '2022-02-05 07:27:36pm', 1, '2022-02-05 13:27:36', '2022-02-05 13:27:36'),
(2208, '65.21.206.46', '2022-02-05 07:48:27pm', 1, '2022-02-05 13:48:27', '2022-02-05 13:48:27'),
(2209, '178.128.126.187', '2022-02-05 08:36:37pm', 1, '2022-02-05 14:36:37', '2022-02-05 14:36:37'),
(2210, '51.222.253.10', '2022-02-05 08:43:50pm', 1, '2022-02-05 14:43:50', '2022-02-05 14:43:50'),
(2211, '89.163.143.8', '2022-02-05 09:11:13pm', 1, '2022-02-05 15:11:13', '2022-02-05 15:11:13'),
(2212, '196.196.216.177', '2022-02-05 09:11:56pm', 1, '2022-02-05 15:11:56', '2022-02-05 15:11:56'),
(2213, '198.1.119.72', '2022-02-05 11:15:52pm', 1, '2022-02-05 17:15:52', '2022-02-05 17:15:52'),
(2214, '83.130.61.110', '2022-02-06 12:50:43am', 1, '2022-02-05 18:50:43', '2022-02-05 18:50:43'),
(2215, '83.130.61.110', '2022-02-06 12:50:49am', 1, '2022-02-05 18:50:49', '2022-02-05 18:50:49'),
(2216, '46.3.180.182', '2022-02-06 03:36:58am', 1, '2022-02-05 21:36:58', '2022-02-05 21:36:58'),
(2217, '196.196.216.135', '2022-02-06 03:37:07am', 1, '2022-02-05 21:37:07', '2022-02-05 21:37:07'),
(2218, '167.99.61.138', '2022-02-06 03:40:59am', 1, '2022-02-05 21:40:59', '2022-02-05 21:40:59'),
(2219, '212.66.42.154', '2022-02-06 03:47:33am', 1, '2022-02-05 21:47:33', '2022-02-05 21:47:33'),
(2220, '212.66.42.154', '2022-02-06 03:47:36am', 1, '2022-02-05 21:47:36', '2022-02-05 21:47:36'),
(2221, '172.255.80.171', '2022-02-06 04:29:26am', 1, '2022-02-05 22:29:26', '2022-02-05 22:29:26'),
(2222, '167.99.117.142', '2022-02-06 04:36:59am', 1, '2022-02-05 22:36:59', '2022-02-05 22:36:59'),
(2223, '37.192.177.23', '2022-02-06 04:50:47am', 1, '2022-02-05 22:50:47', '2022-02-05 22:50:47'),
(2224, '195.246.120.154', '2022-02-06 04:59:08am', 1, '2022-02-05 22:59:08', '2022-02-05 22:59:08'),
(2225, '64.71.131.244', '2022-02-06 05:12:09am', 1, '2022-02-05 23:12:09', '2022-02-05 23:12:09'),
(2226, '159.65.250.106', '2022-02-06 05:21:44am', 1, '2022-02-05 23:21:44', '2022-02-05 23:21:44'),
(2227, '66.249.68.14', '2022-02-06 06:37:39am', 1, '2022-02-06 00:37:39', '2022-02-06 00:37:39'),
(2228, '66.249.68.14', '2022-02-06 06:58:48am', 1, '2022-02-06 00:58:48', '2022-02-06 00:58:48'),
(2229, '89.46.105.183', '2022-02-06 07:35:53am', 1, '2022-02-06 01:35:53', '2022-02-06 01:35:53'),
(2230, '54.39.190.168', '2022-02-06 07:40:49am', 1, '2022-02-06 01:40:49', '2022-02-06 01:40:49'),
(2231, '20.122.174.21', '2022-02-06 07:55:28am', 1, '2022-02-06 01:55:28', '2022-02-06 01:55:28'),
(2232, '20.122.174.21', '2022-02-06 07:55:28am', 1, '2022-02-06 01:55:28', '2022-02-06 01:55:28'),
(2233, '20.122.174.21', '2022-02-06 07:55:29am', 1, '2022-02-06 01:55:29', '2022-02-06 01:55:29'),
(2234, '123.183.224.115', '2022-02-06 08:40:36am', 1, '2022-02-06 02:40:36', '2022-02-06 02:40:36'),
(2235, '83.130.61.110', '2022-02-06 09:01:39am', 1, '2022-02-06 03:01:39', '2022-02-06 03:01:39'),
(2236, '83.130.61.110', '2022-02-06 09:01:50am', 1, '2022-02-06 03:01:50', '2022-02-06 03:01:50'),
(2237, '84.244.23.251', '2022-02-06 10:35:10am', 1, '2022-02-06 04:35:10', '2022-02-06 04:35:10'),
(2238, '84.244.23.251', '2022-02-06 10:35:10am', 1, '2022-02-06 04:35:10', '2022-02-06 04:35:10'),
(2239, '66.249.68.31', '2022-02-06 10:50:55am', 1, '2022-02-06 04:50:55', '2022-02-06 04:50:55'),
(2240, '131.220.6.152', '2022-02-06 10:52:54am', 1, '2022-02-06 04:52:54', '2022-02-06 04:52:54'),
(2241, '66.249.79.7', '2022-02-06 11:13:09am', 1, '2022-02-06 05:13:09', '2022-02-06 05:13:09'),
(2242, '194.163.134.34', '2022-02-06 11:43:19am', 1, '2022-02-06 05:43:19', '2022-02-06 05:43:19'),
(2243, '194.163.134.34', '2022-02-06 11:43:20am', 1, '2022-02-06 05:43:20', '2022-02-06 05:43:20'),
(2244, '220.152.113.20', '2022-02-06 12:24:42pm', 1, '2022-02-06 06:24:42', '2022-02-06 06:24:42'),
(2245, '84.39.245.2', '2022-02-06 12:29:11pm', 1, '2022-02-06 06:29:11', '2022-02-06 06:29:11'),
(2246, '51.222.253.10', '2022-02-06 12:53:58pm', 1, '2022-02-06 06:53:58', '2022-02-06 06:53:58'),
(2247, '123.125.109.43', '2022-02-06 01:35:08pm', 1, '2022-02-06 07:35:08', '2022-02-06 07:35:08'),
(2248, '185.220.101.179', '2022-02-06 02:29:18pm', 1, '2022-02-06 08:29:18', '2022-02-06 08:29:18'),
(2249, '92.118.160.5', '2022-02-06 03:08:06pm', 1, '2022-02-06 09:08:06', '2022-02-06 09:08:06'),
(2250, '192.29.97.49', '2022-02-06 03:19:47pm', 1, '2022-02-06 09:19:47', '2022-02-06 09:19:47'),
(2251, '66.249.79.7', '2022-02-06 03:34:34pm', 1, '2022-02-06 09:34:34', '2022-02-06 09:34:34'),
(2252, '54.36.149.37', '2022-02-06 03:57:30pm', 1, '2022-02-06 09:57:30', '2022-02-06 09:57:30'),
(2253, '178.159.37.66', '2022-02-06 04:50:15pm', 1, '2022-02-06 10:50:15', '2022-02-06 10:50:15'),
(2254, '220.152.113.20', '2022-02-06 05:40:08pm', 1, '2022-02-06 11:40:08', '2022-02-06 11:40:08'),
(2255, '89.191.228.134', '2022-02-06 05:52:09pm', 1, '2022-02-06 11:52:09', '2022-02-06 11:52:09'),
(2256, '185.5.251.166', '2022-02-06 05:59:23pm', 1, '2022-02-06 11:59:23', '2022-02-06 11:59:23'),
(2257, '118.184.177.109', '2022-02-06 06:07:12pm', 1, '2022-02-06 12:07:12', '2022-02-06 12:07:12'),
(2258, '93.93.206.33', '2022-02-06 06:53:39pm', 1, '2022-02-06 12:53:39', '2022-02-06 12:53:39'),
(2259, '93.93.206.33', '2022-02-06 06:53:43pm', 1, '2022-02-06 12:53:43', '2022-02-06 12:53:43'),
(2260, '220.152.113.20', '2022-02-06 07:11:53pm', 1, '2022-02-06 13:11:53', '2022-02-06 13:11:53'),
(2261, '34.209.64.3', '2022-02-06 07:15:04pm', 1, '2022-02-06 13:15:04', '2022-02-06 13:15:04'),
(2262, '209.145.61.251', '2022-02-06 07:38:48pm', 1, '2022-02-06 13:38:48', '2022-02-06 13:38:48'),
(2263, '207.244.241.132', '2022-02-06 07:39:10pm', 1, '2022-02-06 13:39:10', '2022-02-06 13:39:10'),
(2264, '209.145.61.248', '2022-02-06 07:41:53pm', 1, '2022-02-06 13:41:53', '2022-02-06 13:41:53'),
(2265, '193.233.138.122', '2022-02-06 07:59:14pm', 1, '2022-02-06 13:59:14', '2022-02-06 13:59:14'),
(2266, '46.3.180.251', '2022-02-06 08:28:56pm', 1, '2022-02-06 14:28:56', '2022-02-06 14:28:56'),
(2267, '46.3.180.251', '2022-02-06 08:30:14pm', 1, '2022-02-06 14:30:14', '2022-02-06 14:30:14'),
(2268, '195.123.209.118', '2022-02-06 08:31:29pm', 1, '2022-02-06 14:31:29', '2022-02-06 14:31:29'),
(2269, '195.123.209.118', '2022-02-06 08:31:31pm', 1, '2022-02-06 14:31:31', '2022-02-06 14:31:31'),
(2270, '195.123.209.118', '2022-02-06 08:31:31pm', 1, '2022-02-06 14:31:31', '2022-02-06 14:31:31'),
(2271, '162.241.203.22', '2022-02-06 08:39:20pm', 1, '2022-02-06 14:39:20', '2022-02-06 14:39:20'),
(2272, '35.231.10.247', '2022-02-06 08:50:53pm', 1, '2022-02-06 14:50:53', '2022-02-06 14:50:53'),
(2273, '35.231.10.247', '2022-02-06 08:52:05pm', 1, '2022-02-06 14:52:05', '2022-02-06 14:52:05'),
(2274, '51.81.219.117', '2022-02-06 09:00:09pm', 1, '2022-02-06 15:00:09', '2022-02-06 15:00:09'),
(2275, '51.81.219.117', '2022-02-06 09:00:13pm', 1, '2022-02-06 15:00:13', '2022-02-06 15:00:13'),
(2276, '185.220.101.139', '2022-02-06 10:14:37pm', 1, '2022-02-06 16:14:37', '2022-02-06 16:14:37'),
(2277, '157.55.39.48', '2022-02-06 10:27:37pm', 1, '2022-02-06 16:27:37', '2022-02-06 16:27:37'),
(2278, '176.212.135.223', '2022-02-06 10:38:45pm', 1, '2022-02-06 16:38:45', '2022-02-06 16:38:45'),
(2279, '195.123.209.118', '2022-02-06 10:41:59pm', 1, '2022-02-06 16:41:59', '2022-02-06 16:41:59'),
(2280, '195.123.209.118', '2022-02-06 10:42:00pm', 1, '2022-02-06 16:42:00', '2022-02-06 16:42:00'),
(2281, '195.123.209.118', '2022-02-06 10:42:02pm', 1, '2022-02-06 16:42:02', '2022-02-06 16:42:02'),
(2282, '142.132.143.106', '2022-02-06 10:57:09pm', 1, '2022-02-06 16:57:10', '2022-02-06 16:57:10'),
(2283, '92.118.160.61', '2022-02-06 11:18:21pm', 1, '2022-02-06 17:18:21', '2022-02-06 17:18:21'),
(2284, '23.94.176.112', '2022-02-07 12:16:13am', 1, '2022-02-06 18:16:13', '2022-02-06 18:16:13'),
(2285, '45.142.252.249', '2022-02-07 12:38:25am', 1, '2022-02-06 18:38:26', '2022-02-06 18:38:26'),
(2286, '193.58.168.17', '2022-02-07 12:38:27am', 1, '2022-02-06 18:38:27', '2022-02-06 18:38:27'),
(2287, '66.249.68.27', '2022-02-07 01:50:08am', 1, '2022-02-06 19:50:08', '2022-02-06 19:50:08'),
(2288, '66.249.79.4', '2022-02-07 01:52:18am', 1, '2022-02-06 19:52:18', '2022-02-06 19:52:18'),
(2289, '62.251.161.88', '2022-02-07 02:08:44am', 1, '2022-02-06 20:08:44', '2022-02-06 20:08:44'),
(2290, '5.135.137.50', '2022-02-07 02:30:14am', 1, '2022-02-06 20:30:14', '2022-02-06 20:30:14'),
(2291, '5.135.137.50', '2022-02-07 02:35:28am', 1, '2022-02-06 20:35:28', '2022-02-06 20:35:28'),
(2292, '66.249.79.11', '2022-02-07 02:42:18am', 1, '2022-02-06 20:42:18', '2022-02-06 20:42:18'),
(2293, '84.39.245.2', '2022-02-07 02:58:36am', 1, '2022-02-06 20:58:36', '2022-02-06 20:58:36'),
(2294, '170.51.76.106', '2022-02-07 03:02:37am', 1, '2022-02-06 21:02:37', '2022-02-06 21:02:37'),
(2295, '89.238.178.130', '2022-02-07 03:07:42am', 1, '2022-02-06 21:07:42', '2022-02-06 21:07:42'),
(2296, '192.0.88.95', '2022-02-07 04:13:28am', 1, '2022-02-06 22:13:28', '2022-02-06 22:13:28'),
(2297, '154.54.249.18', '2022-02-07 04:31:25am', 1, '2022-02-06 22:31:25', '2022-02-06 22:31:25'),
(2298, '154.54.249.18', '2022-02-07 04:31:52am', 1, '2022-02-06 22:31:52', '2022-02-06 22:31:52'),
(2299, '154.54.249.18', '2022-02-07 04:33:16am', 1, '2022-02-06 22:33:16', '2022-02-06 22:33:16'),
(2300, '154.54.249.18', '2022-02-07 04:33:46am', 1, '2022-02-06 22:33:46', '2022-02-06 22:33:46'),
(2301, '154.54.249.18', '2022-02-07 04:34:15am', 1, '2022-02-06 22:34:15', '2022-02-06 22:34:15'),
(2302, '51.15.230.233', '2022-02-07 05:12:06am', 1, '2022-02-06 23:12:06', '2022-02-06 23:12:06'),
(2303, '51.15.230.233', '2022-02-07 05:12:06am', 1, '2022-02-06 23:12:06', '2022-02-06 23:12:06'),
(2304, '51.15.230.233', '2022-02-07 05:12:06am', 1, '2022-02-06 23:12:06', '2022-02-06 23:12:06'),
(2305, '51.15.230.233', '2022-02-07 05:12:06am', 1, '2022-02-06 23:12:06', '2022-02-06 23:12:06'),
(2306, '51.158.100.125', '2022-02-07 05:16:35am', 1, '2022-02-06 23:16:35', '2022-02-06 23:16:35'),
(2307, '41.82.82.79', '2022-02-07 05:52:47am', 1, '2022-02-06 23:52:47', '2022-02-06 23:52:47'),
(2308, '93.158.92.206', '2022-02-07 05:55:14am', 1, '2022-02-06 23:55:14', '2022-02-06 23:55:14'),
(2309, '72.255.9.84', '2022-02-07 07:18:20am', 1, '2022-02-07 01:18:21', '2022-02-07 01:18:21'),
(2310, '66.249.68.41', '2022-02-07 07:22:19am', 1, '2022-02-07 01:22:19', '2022-02-07 01:22:19'),
(2311, '178.151.179.34', '2022-02-07 08:20:13am', 1, '2022-02-07 02:20:13', '2022-02-07 02:20:13'),
(2312, '66.249.79.96', '2022-02-07 09:15:19am', 1, '2022-02-07 03:15:19', '2022-02-07 03:15:19'),
(2313, '185.88.37.155', '2022-02-07 09:24:34am', 1, '2022-02-07 03:24:34', '2022-02-07 03:24:34'),
(2314, '51.222.253.18', '2022-02-07 09:55:37am', 1, '2022-02-07 03:55:37', '2022-02-07 03:55:37'),
(2315, '66.249.68.35', '2022-02-07 10:18:34am', 1, '2022-02-07 04:18:34', '2022-02-07 04:18:34'),
(2316, '131.220.6.152', '2022-02-07 10:49:47am', 1, '2022-02-07 04:49:47', '2022-02-07 04:49:47'),
(2317, '196.196.216.204', '2022-02-07 11:00:17am', 1, '2022-02-07 05:00:17', '2022-02-07 05:00:17'),
(2318, '68.183.226.92', '2022-02-07 11:07:31am', 1, '2022-02-07 05:07:31', '2022-02-07 05:07:31'),
(2319, '68.183.226.92', '2022-02-07 11:07:31am', 1, '2022-02-07 05:07:31', '2022-02-07 05:07:31'),
(2320, '68.183.226.92', '2022-02-07 11:07:32am', 1, '2022-02-07 05:07:32', '2022-02-07 05:07:32'),
(2321, '176.114.190.126', '2022-02-07 11:10:14am', 1, '2022-02-07 05:10:14', '2022-02-07 05:10:14'),
(2322, '176.114.190.126', '2022-02-07 11:10:22am', 1, '2022-02-07 05:10:22', '2022-02-07 05:10:22'),
(2323, '66.249.68.53', '2022-02-07 11:47:45am', 1, '2022-02-07 05:47:45', '2022-02-07 05:47:45'),
(2324, '46.183.218.132', '2022-02-07 12:04:19pm', 1, '2022-02-07 06:04:19', '2022-02-07 06:04:19'),
(2325, '46.183.218.132', '2022-02-07 12:04:20pm', 1, '2022-02-07 06:04:20', '2022-02-07 06:04:20'),
(2326, '185.220.100.254', '2022-02-07 12:05:26pm', 1, '2022-02-07 06:05:26', '2022-02-07 06:05:26'),
(2327, '51.140.68.179', '2022-02-07 12:47:11pm', 1, '2022-02-07 06:47:11', '2022-02-07 06:47:11'),
(2328, '51.140.68.179', '2022-02-07 12:47:11pm', 1, '2022-02-07 06:47:11', '2022-02-07 06:47:11'),
(2329, '51.140.68.179', '2022-02-07 12:47:12pm', 1, '2022-02-07 06:47:12', '2022-02-07 06:47:12'),
(2330, '34.217.123.29', '2022-02-07 01:05:08pm', 1, '2022-02-07 07:05:08', '2022-02-07 07:05:08'),
(2331, '34.217.123.29', '2022-02-07 01:05:11pm', 1, '2022-02-07 07:05:11', '2022-02-07 07:05:11'),
(2332, '213.21.201.6', '2022-02-07 01:21:43pm', 1, '2022-02-07 07:21:43', '2022-02-07 07:21:43'),
(2333, '54.36.148.63', '2022-02-07 01:21:49pm', 1, '2022-02-07 07:21:49', '2022-02-07 07:21:49'),
(2334, '123.125.109.43', '2022-02-07 01:33:39pm', 1, '2022-02-07 07:33:39', '2022-02-07 07:33:39'),
(2335, '185.100.87.133', '2022-02-07 02:09:05pm', 1, '2022-02-07 08:09:05', '2022-02-07 08:09:05'),
(2336, '66.249.68.53', '2022-02-07 02:29:37pm', 1, '2022-02-07 08:29:37', '2022-02-07 08:29:37'),
(2337, '91.247.165.102', '2022-02-07 02:56:20pm', 1, '2022-02-07 08:56:20', '2022-02-07 08:56:20'),
(2338, '188.239.93.65', '2022-02-07 02:56:38pm', 1, '2022-02-07 08:56:38', '2022-02-07 08:56:38'),
(2339, '188.239.93.65', '2022-02-07 02:56:45pm', 1, '2022-02-07 08:56:45', '2022-02-07 08:56:45'),
(2340, '118.179.97.39', '2022-02-07 03:07:37pm', 1, '2022-02-07 09:07:38', '2022-02-07 09:07:38'),
(2341, '118.179.97.39', '2022-02-07 03:33:13pm', 1, '2022-02-07 09:33:13', '2022-02-07 09:33:13'),
(2342, '54.175.46.34', '2022-02-07 04:15:08pm', 1, '2022-02-07 10:15:08', '2022-02-07 10:15:08'),
(2343, '54.175.46.34', '2022-02-07 04:15:09pm', 1, '2022-02-07 10:15:09', '2022-02-07 10:15:09'),
(2344, '37.188.26.255', '2022-02-07 04:33:01pm', 1, '2022-02-07 10:33:02', '2022-02-07 10:33:02'),
(2345, '107.174.236.223', '2022-02-07 04:53:08pm', 1, '2022-02-07 10:53:08', '2022-02-07 10:53:08'),
(2346, '118.179.97.39', '2022-02-07 05:01:07pm', 1, '2022-02-07 11:01:07', '2022-02-07 11:01:07'),
(2347, '118.179.97.39', '2022-02-07 05:01:45pm', 1, '2022-02-07 11:01:45', '2022-02-07 11:01:45'),
(2348, '118.179.97.39', '2022-02-07 05:07:28pm', 1, '2022-02-07 11:07:28', '2022-02-07 11:07:28'),
(2349, '118.179.97.39', '2022-02-07 05:08:07pm', 1, '2022-02-07 11:08:07', '2022-02-07 11:08:07'),
(2350, '194.60.69.218', '2022-02-07 05:15:40pm', 1, '2022-02-07 11:15:40', '2022-02-07 11:15:40'),
(2351, '54.206.106.174', '2022-02-07 05:16:33pm', 1, '2022-02-07 11:16:33', '2022-02-07 11:16:33'),
(2352, '84.39.245.2', '2022-02-07 05:23:03pm', 1, '2022-02-07 11:23:04', '2022-02-07 11:23:04'),
(2353, '123.125.109.43', '2022-02-07 05:32:51pm', 1, '2022-02-07 11:32:51', '2022-02-07 11:32:51'),
(2354, '188.126.73.217', '2022-02-07 05:39:38pm', 1, '2022-02-07 11:39:38', '2022-02-07 11:39:38'),
(2355, '103.6.156.103', '2022-02-07 05:41:47pm', 1, '2022-02-07 11:41:47', '2022-02-07 11:41:47'),
(2356, '103.6.156.103', '2022-02-07 05:42:03pm', 1, '2022-02-07 11:42:03', '2022-02-07 11:42:03'),
(2357, '136.144.41.75', '2022-02-07 06:05:50pm', 1, '2022-02-07 12:05:51', '2022-02-07 12:05:51'),
(2358, '51.140.68.179', '2022-02-07 06:13:54pm', 1, '2022-02-07 12:13:54', '2022-02-07 12:13:54'),
(2359, '51.140.68.179', '2022-02-07 06:13:54pm', 1, '2022-02-07 12:13:54', '2022-02-07 12:13:54'),
(2360, '51.140.68.179', '2022-02-07 06:13:55pm', 1, '2022-02-07 12:13:55', '2022-02-07 12:13:55'),
(2361, '5.248.226.105', '2022-02-07 06:17:14pm', 1, '2022-02-07 12:17:14', '2022-02-07 12:17:14'),
(2362, '178.159.37.66', '2022-02-07 06:52:10pm', 1, '2022-02-07 12:52:10', '2022-02-07 12:52:10'),
(2363, '188.234.30.54', '2022-02-07 06:52:55pm', 1, '2022-02-07 12:52:55', '2022-02-07 12:52:55'),
(2364, '::1', '2022-02-07 07:30:21pm', 1, '2022-02-07 13:30:21', '2022-02-07 13:30:21'),
(2365, '::1', '2022-02-07 07:54:11pm', 1, '2022-02-07 13:54:11', '2022-02-07 13:54:11'),
(2366, '::1', '2022-02-07 07:55:30pm', 1, '2022-02-07 13:55:30', '2022-02-07 13:55:30'),
(2367, '::1', '2022-02-07 07:55:39pm', 1, '2022-02-07 13:55:39', '2022-02-07 13:55:39'),
(2368, '::1', '2022-02-07 07:55:51pm', 1, '2022-02-07 13:55:51', '2022-02-07 13:55:51'),
(2369, '::1', '2022-02-07 07:56:02pm', 1, '2022-02-07 13:56:02', '2022-02-07 13:56:02'),
(2370, '::1', '2022-02-07 07:56:16pm', 1, '2022-02-07 13:56:16', '2022-02-07 13:56:16'),
(2371, '::1', '2022-02-07 07:56:26pm', 1, '2022-02-07 13:56:26', '2022-02-07 13:56:26'),
(2372, '::1', '2022-02-07 08:37:30pm', 1, '2022-02-07 14:37:30', '2022-02-07 14:37:30'),
(2373, '::1', '2022-02-07 08:38:31pm', 1, '2022-02-07 14:38:31', '2022-02-07 14:38:31'),
(2374, '::1', '2022-02-07 08:38:53pm', 1, '2022-02-07 14:38:53', '2022-02-07 14:38:53'),
(2375, '::1', '2022-02-07 08:39:38pm', 1, '2022-02-07 14:39:39', '2022-02-07 14:39:39'),
(2376, '::1', '2022-02-07 08:45:07pm', 1, '2022-02-07 14:45:07', '2022-02-07 14:45:07'),
(2377, '::1', '2022-02-07 08:46:19pm', 1, '2022-02-07 14:46:19', '2022-02-07 14:46:19'),
(2378, '::1', '2022-02-07 08:47:24pm', 1, '2022-02-07 14:47:24', '2022-02-07 14:47:24'),
(2379, '::1', '2022-02-07 08:48:11pm', 1, '2022-02-07 14:48:11', '2022-02-07 14:48:11'),
(2380, '::1', '2022-02-07 08:52:12pm', 1, '2022-02-07 14:52:12', '2022-02-07 14:52:12'),
(2381, '::1', '2022-02-07 08:52:47pm', 1, '2022-02-07 14:52:48', '2022-02-07 14:52:48'),
(2382, '::1', '2022-02-07 08:53:29pm', 1, '2022-02-07 14:53:29', '2022-02-07 14:53:29'),
(2383, '::1', '2022-02-08 10:41:04am', 1, '2022-02-08 04:41:04', '2022-02-08 04:41:04'),
(2384, '::1', '2022-02-08 10:43:36am', 1, '2022-02-08 04:43:36', '2022-02-08 04:43:36'),
(2385, '::1', '2022-02-08 11:52:17am', 1, '2022-02-08 05:52:17', '2022-02-08 05:52:17'),
(2386, '::1', '2022-02-10 12:41:17pm', 1, '2022-02-10 06:41:17', '2022-02-10 06:41:17'),
(2387, '127.0.0.1', '2022-02-10 12:42:09pm', 1, '2022-02-10 06:42:09', '2022-02-10 06:42:09'),
(2388, '127.0.0.1', '2022-02-10 12:42:25pm', 1, '2022-02-10 06:42:25', '2022-02-10 06:42:25'),
(2389, '::1', '2022-02-13 08:01:22pm', 1, '2022-02-13 14:01:22', '2022-02-13 14:01:22'),
(2390, '::1', '2022-02-13 08:16:48pm', 1, '2022-02-13 14:16:48', '2022-02-13 14:16:48'),
(2391, '::1', '2022-03-15 05:49:36pm', 1, '2022-03-15 11:49:37', '2022-03-15 11:49:37'),
(2392, '::1', '2022-03-15 05:49:47pm', 1, '2022-03-15 11:49:47', '2022-03-15 11:49:47'),
(2393, '::1', '2022-03-15 08:05:49pm', 1, '2022-03-15 14:05:49', '2022-03-15 14:05:49'),
(2394, '::1', '2022-03-16 09:57:39am', 1, '2022-03-16 03:57:39', '2022-03-16 03:57:39'),
(2395, '::1', '2022-03-17 09:55:27am', 1, '2022-03-17 03:55:27', '2022-03-17 03:55:27'),
(2396, '::1', '2022-03-18 11:00:51am', 1, '2022-03-18 05:00:51', '2022-03-18 05:00:51'),
(2397, '::1', '2022-03-19 10:52:19am', 1, '2022-03-19 04:52:19', '2022-03-19 04:52:19'),
(2398, '::1', '2022-03-20 04:26:38pm', 1, '2022-03-20 10:26:38', '2022-03-20 10:26:38'),
(2399, '::1', '2022-03-21 10:45:54am', 1, '2022-03-21 04:45:54', '2022-03-21 04:45:54'),
(2400, '::1', '2022-03-21 03:36:23pm', 1, '2022-03-21 09:36:23', '2022-03-21 09:36:23'),
(2401, '::1', '2022-03-21 03:49:20pm', 1, '2022-03-21 09:49:20', '2022-03-21 09:49:20'),
(2402, '::1', '2022-03-21 03:50:37pm', 1, '2022-03-21 09:50:37', '2022-03-21 09:50:37'),
(2403, '::1', '2022-03-21 03:50:39pm', 1, '2022-03-21 09:50:39', '2022-03-21 09:50:39'),
(2404, '::1', '2022-03-21 03:51:12pm', 1, '2022-03-21 09:51:12', '2022-03-21 09:51:12'),
(2405, '::1', '2022-03-21 05:58:40pm', 1, '2022-03-21 11:58:40', '2022-03-21 11:58:40'),
(2406, '::1', '2022-03-21 06:14:30pm', 1, '2022-03-21 12:14:30', '2022-03-21 12:14:30'),
(2407, '::1', '2022-03-21 06:15:12pm', 1, '2022-03-21 12:15:12', '2022-03-21 12:15:12'),
(2408, '::1', '2022-03-21 06:16:10pm', 1, '2022-03-21 12:16:10', '2022-03-21 12:16:10'),
(2409, '::1', '2022-03-21 06:23:29pm', 1, '2022-03-21 12:23:29', '2022-03-21 12:23:29'),
(2410, '::1', '2022-03-21 06:41:25pm', 1, '2022-03-21 12:41:25', '2022-03-21 12:41:25'),
(2411, '::1', '2022-03-21 06:42:40pm', 1, '2022-03-21 12:42:40', '2022-03-21 12:42:40'),
(2412, '::1', '2022-03-21 06:42:56pm', 1, '2022-03-21 12:42:56', '2022-03-21 12:42:56'),
(2413, '::1', '2022-03-21 06:45:17pm', 1, '2022-03-21 12:45:17', '2022-03-21 12:45:17'),
(2414, '::1', '2022-03-21 06:45:24pm', 1, '2022-03-21 12:45:24', '2022-03-21 12:45:24'),
(2415, '::1', '2022-03-21 06:45:28pm', 1, '2022-03-21 12:45:28', '2022-03-21 12:45:28'),
(2416, '::1', '2022-03-21 06:45:32pm', 1, '2022-03-21 12:45:32', '2022-03-21 12:45:32'),
(2417, '::1', '2022-03-21 06:47:06pm', 1, '2022-03-21 12:47:06', '2022-03-21 12:47:06'),
(2418, '::1', '2022-03-21 06:47:08pm', 1, '2022-03-21 12:47:08', '2022-03-21 12:47:08'),
(2419, '::1', '2022-03-21 06:47:12pm', 1, '2022-03-21 12:47:12', '2022-03-21 12:47:12'),
(2420, '::1', '2022-03-21 06:47:15pm', 1, '2022-03-21 12:47:15', '2022-03-21 12:47:15'),
(2421, '::1', '2022-03-21 06:47:33pm', 1, '2022-03-21 12:47:33', '2022-03-21 12:47:33'),
(2422, '::1', '2022-03-21 06:47:57pm', 1, '2022-03-21 12:47:57', '2022-03-21 12:47:57'),
(2423, '::1', '2022-03-21 06:48:00pm', 1, '2022-03-21 12:48:00', '2022-03-21 12:48:00'),
(2424, '::1', '2022-03-21 06:48:03pm', 1, '2022-03-21 12:48:03', '2022-03-21 12:48:03'),
(2425, '::1', '2022-03-21 06:49:30pm', 1, '2022-03-21 12:49:30', '2022-03-21 12:49:30'),
(2426, '::1', '2022-03-21 06:50:51pm', 1, '2022-03-21 12:50:51', '2022-03-21 12:50:51'),
(2427, '::1', '2022-03-21 07:02:53pm', 1, '2022-03-21 13:02:53', '2022-03-21 13:02:53'),
(2428, '::1', '2022-03-21 07:03:27pm', 1, '2022-03-21 13:03:27', '2022-03-21 13:03:27'),
(2429, '::1', '2022-03-21 07:05:11pm', 1, '2022-03-21 13:05:11', '2022-03-21 13:05:11'),
(2430, '::1', '2022-03-21 07:06:39pm', 1, '2022-03-21 13:06:39', '2022-03-21 13:06:39'),
(2431, '::1', '2022-03-21 07:27:01pm', 1, '2022-03-21 13:27:01', '2022-03-21 13:27:01'),
(2432, '::1', '2022-03-21 07:29:01pm', 1, '2022-03-21 13:29:01', '2022-03-21 13:29:01'),
(2433, '::1', '2022-03-21 07:29:11pm', 1, '2022-03-21 13:29:11', '2022-03-21 13:29:11'),
(2434, '::1', '2022-03-21 07:30:36pm', 1, '2022-03-21 13:30:36', '2022-03-21 13:30:36'),
(2435, '::1', '2022-03-21 07:30:44pm', 1, '2022-03-21 13:30:44', '2022-03-21 13:30:44'),
(2436, '::1', '2022-03-21 07:31:09pm', 1, '2022-03-21 13:31:09', '2022-03-21 13:31:09'),
(2437, '::1', '2022-03-21 07:32:35pm', 1, '2022-03-21 13:32:35', '2022-03-21 13:32:35'),
(2438, '::1', '2022-03-21 07:32:55pm', 1, '2022-03-21 13:32:55', '2022-03-21 13:32:55'),
(2439, '::1', '2022-03-21 07:33:07pm', 1, '2022-03-21 13:33:07', '2022-03-21 13:33:07'),
(2440, '::1', '2022-03-21 07:33:51pm', 1, '2022-03-21 13:33:51', '2022-03-21 13:33:51'),
(2441, '::1', '2022-03-21 07:35:08pm', 1, '2022-03-21 13:35:08', '2022-03-21 13:35:08'),
(2442, '::1', '2022-03-21 07:36:04pm', 1, '2022-03-21 13:36:04', '2022-03-21 13:36:04'),
(2443, '::1', '2022-03-21 07:36:16pm', 1, '2022-03-21 13:36:16', '2022-03-21 13:36:16'),
(2444, '::1', '2022-03-21 07:37:20pm', 1, '2022-03-21 13:37:20', '2022-03-21 13:37:20'),
(2445, '::1', '2022-03-21 07:39:28pm', 1, '2022-03-21 13:39:28', '2022-03-21 13:39:28'),
(2446, '::1', '2022-03-22 06:19:27pm', 1, '2022-03-22 12:19:27', '2022-03-22 12:19:27'),
(2447, '::1', '2022-03-22 06:19:37pm', 1, '2022-03-22 12:19:37', '2022-03-22 12:19:37'),
(2448, '::1', '2022-03-23 04:28:49pm', 1, '2022-03-23 10:28:49', '2022-03-23 10:28:49'),
(2449, '::1', '2022-03-23 04:29:36pm', 1, '2022-03-23 10:29:36', '2022-03-23 10:29:36'),
(2450, '::1', '2022-03-23 04:29:45pm', 1, '2022-03-23 10:29:45', '2022-03-23 10:29:45'),
(2451, '::1', '2022-03-23 04:29:53pm', 1, '2022-03-23 10:29:53', '2022-03-23 10:29:53'),
(2452, '::1', '2022-03-23 04:30:30pm', 1, '2022-03-23 10:30:30', '2022-03-23 10:30:30'),
(2453, '::1', '2022-03-23 04:30:40pm', 1, '2022-03-23 10:30:40', '2022-03-23 10:30:40'),
(2454, '::1', '2022-03-23 04:43:37pm', 1, '2022-03-23 10:43:37', '2022-03-23 10:43:37'),
(2455, '::1', '2022-03-23 04:43:43pm', 1, '2022-03-23 10:43:43', '2022-03-23 10:43:43'),
(2456, '::1', '2022-03-23 04:44:26pm', 1, '2022-03-23 10:44:26', '2022-03-23 10:44:26'),
(2457, '::1', '2022-03-23 04:45:34pm', 1, '2022-03-23 10:45:34', '2022-03-23 10:45:34'),
(2458, '::1', '2022-03-23 04:45:39pm', 1, '2022-03-23 10:45:39', '2022-03-23 10:45:39'),
(2459, '::1', '2022-03-23 04:45:53pm', 1, '2022-03-23 10:45:53', '2022-03-23 10:45:53'),
(2460, '::1', '2022-03-23 04:45:57pm', 1, '2022-03-23 10:45:57', '2022-03-23 10:45:57'),
(2461, '::1', '2022-03-23 04:51:25pm', 1, '2022-03-23 10:51:25', '2022-03-23 10:51:25'),
(2462, '::1', '2022-03-23 04:51:37pm', 1, '2022-03-23 10:51:37', '2022-03-23 10:51:37'),
(2463, '::1', '2022-03-23 04:52:23pm', 1, '2022-03-23 10:52:23', '2022-03-23 10:52:23'),
(2464, '::1', '2022-03-23 07:18:44pm', 1, '2022-03-23 13:18:44', '2022-03-23 13:18:44'),
(2465, '::1', '2022-03-23 07:18:51pm', 1, '2022-03-23 13:18:51', '2022-03-23 13:18:51'),
(2466, '::1', '2022-03-23 07:21:40pm', 1, '2022-03-23 13:21:40', '2022-03-23 13:21:40'),
(2467, '::1', '2022-03-23 07:23:34pm', 1, '2022-03-23 13:23:34', '2022-03-23 13:23:34'),
(2468, '::1', '2022-03-23 07:23:51pm', 1, '2022-03-23 13:23:51', '2022-03-23 13:23:51'),
(2469, '::1', '2022-03-23 07:24:08pm', 1, '2022-03-23 13:24:08', '2022-03-23 13:24:08'),
(2470, '::1', '2022-03-23 07:24:21pm', 1, '2022-03-23 13:24:21', '2022-03-23 13:24:21'),
(2471, '::1', '2022-03-23 07:24:34pm', 1, '2022-03-23 13:24:34', '2022-03-23 13:24:34'),
(2472, '::1', '2022-03-23 07:25:11pm', 1, '2022-03-23 13:25:11', '2022-03-23 13:25:11'),
(2473, '::1', '2022-03-24 10:31:36am', 1, '2022-03-24 04:31:36', '2022-03-24 04:31:36'),
(2474, '::1', '2022-03-24 10:31:57am', 1, '2022-03-24 04:31:57', '2022-03-24 04:31:57'),
(2475, '::1', '2022-03-24 10:32:09am', 1, '2022-03-24 04:32:09', '2022-03-24 04:32:09'),
(2476, '::1', '2022-03-24 10:32:12am', 1, '2022-03-24 04:32:12', '2022-03-24 04:32:12'),
(2477, '::1', '2022-03-24 10:32:14am', 1, '2022-03-24 04:32:14', '2022-03-24 04:32:14'),
(2478, '::1', '2022-03-24 10:32:16am', 1, '2022-03-24 04:32:16', '2022-03-24 04:32:16'),
(2479, '::1', '2022-03-24 10:36:29am', 1, '2022-03-24 04:36:29', '2022-03-24 04:36:29'),
(2480, '::1', '2022-03-24 10:36:33am', 1, '2022-03-24 04:36:33', '2022-03-24 04:36:33'),
(2481, '::1', '2022-03-24 11:10:23am', 1, '2022-03-24 05:10:23', '2022-03-24 05:10:23'),
(2482, '::1', '2022-03-24 03:09:44pm', 1, '2022-03-24 09:09:44', '2022-03-24 09:09:44'),
(2483, '::1', '2022-03-24 03:25:24pm', 1, '2022-03-24 09:25:24', '2022-03-24 09:25:24'),
(2484, '::1', '2022-03-24 03:26:04pm', 1, '2022-03-24 09:26:04', '2022-03-24 09:26:04'),
(2485, '::1', '2022-03-24 03:27:26pm', 1, '2022-03-24 09:27:26', '2022-03-24 09:27:26'),
(2486, '::1', '2022-03-24 03:28:33pm', 1, '2022-03-24 09:28:33', '2022-03-24 09:28:33'),
(2487, '::1', '2022-03-24 03:28:49pm', 1, '2022-03-24 09:28:49', '2022-03-24 09:28:49'),
(2488, '::1', '2022-03-24 03:29:33pm', 1, '2022-03-24 09:29:33', '2022-03-24 09:29:33'),
(2489, '::1', '2022-03-24 03:30:51pm', 1, '2022-03-24 09:30:51', '2022-03-24 09:30:51'),
(2490, '::1', '2022-03-24 03:30:53pm', 1, '2022-03-24 09:30:53', '2022-03-24 09:30:53'),
(2491, '::1', '2022-03-24 03:30:58pm', 1, '2022-03-24 09:30:58', '2022-03-24 09:30:58'),
(2492, '::1', '2022-03-24 03:31:12pm', 1, '2022-03-24 09:31:12', '2022-03-24 09:31:12'),
(2493, '::1', '2022-03-24 03:34:21pm', 1, '2022-03-24 09:34:21', '2022-03-24 09:34:21'),
(2494, '::1', '2022-03-24 03:37:43pm', 1, '2022-03-24 09:37:43', '2022-03-24 09:37:43'),
(2495, '127.0.0.1', '2022-03-24 03:38:22pm', 1, '2022-03-24 09:38:22', '2022-03-24 09:38:22'),
(2496, '::1', '2022-03-24 03:42:49pm', 1, '2022-03-24 09:42:49', '2022-03-24 09:42:49'),
(2497, '::1', '2022-03-24 03:42:56pm', 1, '2022-03-24 09:42:56', '2022-03-24 09:42:56'),
(2498, '::1', '2022-03-24 04:33:13pm', 1, '2022-03-24 10:33:13', '2022-03-24 10:33:13'),
(2499, '::1', '2022-03-24 04:33:15pm', 1, '2022-03-24 10:33:15', '2022-03-24 10:33:15'),
(2500, '127.0.0.1', '2022-03-24 04:33:20pm', 1, '2022-03-24 10:33:20', '2022-03-24 10:33:20'),
(2501, '127.0.0.1', '2022-03-24 04:33:22pm', 1, '2022-03-24 10:33:22', '2022-03-24 10:33:22'),
(2502, '127.0.0.1', '2022-03-24 04:33:33pm', 1, '2022-03-24 10:33:34', '2022-03-24 10:33:34'),
(2503, '127.0.0.1', '2022-03-24 04:33:38pm', 1, '2022-03-24 10:33:38', '2022-03-24 10:33:38'),
(2504, '127.0.0.1', '2022-03-24 04:33:45pm', 1, '2022-03-24 10:33:45', '2022-03-24 10:33:45'),
(2505, '127.0.0.1', '2022-03-24 04:38:57pm', 1, '2022-03-24 10:38:57', '2022-03-24 10:38:57'),
(2506, '127.0.0.1', '2022-03-24 04:38:59pm', 1, '2022-03-24 10:38:59', '2022-03-24 10:38:59'),
(2507, '127.0.0.1', '2022-03-24 04:39:03pm', 1, '2022-03-24 10:39:03', '2022-03-24 10:39:03'),
(2508, '127.0.0.1', '2022-03-24 04:39:06pm', 1, '2022-03-24 10:39:06', '2022-03-24 10:39:06'),
(2509, '::1', '2022-03-24 04:45:58pm', 1, '2022-03-24 10:45:58', '2022-03-24 10:45:58'),
(2510, '::1', '2022-03-24 04:46:06pm', 1, '2022-03-24 10:46:06', '2022-03-24 10:46:06'),
(2511, '::1', '2022-03-25 10:50:02am', 1, '2022-03-25 04:50:02', '2022-03-25 04:50:02'),
(2512, '127.0.0.1', '2022-03-25 10:51:45am', 1, '2022-03-25 04:51:45', '2022-03-25 04:51:45'),
(2513, '::1', '2022-03-25 10:52:03am', 1, '2022-03-25 04:52:03', '2022-03-25 04:52:03'),
(2514, '::1', '2022-03-25 11:47:08am', 1, '2022-03-25 05:47:08', '2022-03-25 05:47:08'),
(2515, '::1', '2022-03-25 11:57:24am', 1, '2022-03-25 05:57:24', '2022-03-25 05:57:24'),
(2516, '::1', '2022-03-25 07:21:13pm', 1, '2022-03-25 13:21:13', '2022-03-25 13:21:13'),
(2517, '::1', '2022-03-25 08:04:36pm', 1, '2022-03-25 14:04:36', '2022-03-25 14:04:36'),
(2518, '::1', '2022-03-25 08:04:41pm', 1, '2022-03-25 14:04:41', '2022-03-25 14:04:41'),
(2519, '::1', '2022-03-25 08:06:31pm', 1, '2022-03-25 14:06:31', '2022-03-25 14:06:31'),
(2520, '::1', '2022-03-25 08:07:13pm', 1, '2022-03-25 14:07:13', '2022-03-25 14:07:13'),
(2521, '::1', '2022-03-25 08:07:16pm', 1, '2022-03-25 14:07:16', '2022-03-25 14:07:16'),
(2522, '127.0.0.1', '2022-03-27 02:03:54pm', 1, '2022-03-27 08:03:54', '2022-03-27 08:03:54'),
(2523, '127.0.0.1', '2022-03-27 02:36:31pm', 1, '2022-03-27 08:36:31', '2022-03-27 08:36:31'),
(2524, '::1', '2022-03-27 05:03:48pm', 1, '2022-03-27 11:03:48', '2022-03-27 11:03:48'),
(2525, '::1', '2022-03-27 05:08:18pm', 1, '2022-03-27 11:08:18', '2022-03-27 11:08:18'),
(2526, '::1', '2022-03-27 05:08:59pm', 1, '2022-03-27 11:08:59', '2022-03-27 11:08:59'),
(2527, '::1', '2022-03-28 10:40:54am', 1, '2022-03-28 04:40:54', '2022-03-28 04:40:54'),
(2528, '127.0.0.1', '2022-03-28 11:18:33am', 1, '2022-03-28 05:18:33', '2022-03-28 05:18:33'),
(2529, '::1', '2022-03-28 11:49:14am', 1, '2022-03-28 05:49:14', '2022-03-28 05:49:14'),
(2530, '::1', '2022-03-28 05:48:17pm', 1, '2022-03-28 11:48:17', '2022-03-28 11:48:17'),
(2531, '::1', '2022-03-28 05:48:23pm', 1, '2022-03-28 11:48:23', '2022-03-28 11:48:23'),
(2532, '127.0.0.1', '2022-03-28 07:18:43pm', 1, '2022-03-28 13:18:43', '2022-03-28 13:18:43'),
(2533, '127.0.0.1', '2022-03-28 07:18:50pm', 1, '2022-03-28 13:18:50', '2022-03-28 13:18:50'),
(2534, '::1', '2022-03-29 10:42:55am', 1, '2022-03-29 04:42:55', '2022-03-29 04:42:55'),
(2535, '::1', '2022-03-29 10:42:58am', 1, '2022-03-29 04:42:58', '2022-03-29 04:42:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_banners`
--
ALTER TABLE `about_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_histories`
--
ALTER TABLE `about_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_categories`
--
ALTER TABLE `account_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admited_students`
--
ALTER TABLE `admited_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_types`
--
ALTER TABLE `asset_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_contents`
--
ALTER TABLE `blog_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_banners`
--
ALTER TABLE `course_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_fassilities`
--
ALTER TABLE `course_fassilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_items`
--
ALTER TABLE `course_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_members`
--
ALTER TABLE `course_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `development_projects`
--
ALTER TABLE `development_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `development_project_headers`
--
ALTER TABLE `development_project_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_monthly_salaries`
--
ALTER TABLE `employee_monthly_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_paybacks`
--
ALTER TABLE `expense_paybacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fontawesomes`
--
ALTER TABLE `fontawesomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_contents`
--
ALTER TABLE `footer_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `international_project_headers`
--
ALTER TABLE `international_project_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `international_works`
--
ALTER TABLE `international_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investor_types`
--
ALTER TABLE `investor_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_categories`
--
ALTER TABLE `leave_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_takens`
--
ALTER TABLE `leave_takens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_projects`
--
ALTER TABLE `local_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_project_headers`
--
ALTER TABLE `local_project_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiple_expenses`
--
ALTER TABLE `multiple_expenses`
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
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_banners`
--
ALTER TABLE `service_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sorting_tests`
--
ALTER TABLE `sorting_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_payments`
--
ALTER TABLE `student_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_rolls`
--
ALTER TABLE `user_rolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_banners`
--
ALTER TABLE `about_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `about_histories`
--
ALTER TABLE `about_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admited_students`
--
ALTER TABLE `admited_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `asset_types`
--
ALTER TABLE `asset_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog_contents`
--
ALTER TABLE `blog_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_banners`
--
ALTER TABLE `course_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_fassilities`
--
ALTER TABLE `course_fassilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course_items`
--
ALTER TABLE `course_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `course_members`
--
ALTER TABLE `course_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `development_projects`
--
ALTER TABLE `development_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `development_project_headers`
--
ALTER TABLE `development_project_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_monthly_salaries`
--
ALTER TABLE `employee_monthly_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expense_paybacks`
--
ALTER TABLE `expense_paybacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fontawesomes`
--
ALTER TABLE `fontawesomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `footer_contents`
--
ALTER TABLE `footer_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `international_project_headers`
--
ALTER TABLE `international_project_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `international_works`
--
ALTER TABLE `international_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `investor_types`
--
ALTER TABLE `investor_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `leave_categories`
--
ALTER TABLE `leave_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_takens`
--
ALTER TABLE `leave_takens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `local_projects`
--
ALTER TABLE `local_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `local_project_headers`
--
ALTER TABLE `local_project_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `multiple_expenses`
--
ALTER TABLE `multiple_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service_banners`
--
ALTER TABLE `service_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sorting_tests`
--
ALTER TABLE `sorting_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_payments`
--
ALTER TABLE `student_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_rolls`
--
ALTER TABLE `user_rolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2536;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
