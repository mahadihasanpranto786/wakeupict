-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 10:53 AM
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
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_who` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `designation`, `image`, `image_alt`, `active_who`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Md Riasath Arif Prodhan (Shuvro)', 'Lead Software Engineer', 'public/uploads/who_we_are/images/1711426634451931.jpg', 'Md Riasath Arif Prodhan (Shuvro)', 1, 1, '2021-09-20 07:13:45', NULL),
(7, 'Md. Murad Hasan Khan', 'Full Stack Developer', 'public/uploads/who_we_are/images/1711426661447819.jpg', 'Md. Murad Hasan Khan', 1, 1, '2021-09-20 07:14:11', NULL),
(8, 'Sajib Sarker', 'Jr. Full Stack Developer', 'public/uploads/who_we_are/images/1711426686221952.jpg', 'Sajib Sarker', 1, 1, '2021-09-20 07:14:35', NULL),
(9, 'Abu Bakar Siddique', 'Jr. Full Stack Developer', 'public/uploads/who_we_are/images/1711426715436295.jpg', 'Abu Bakar Siddique', 1, 1, '2021-09-20 07:15:03', NULL),
(10, 'Mahadi Hasan Pranto', 'Junior Web Developer', 'public/uploads/who_we_are/images/1711426735365893.jpg', 'Mahadi Hasan Pranto', 1, 1, '2021-09-20 07:15:22', NULL),
(11, 'Rimon Hoshen', 'Junior Web Developer', 'public/uploads/who_we_are/images/1711426766527192.jpg', 'Rimon Hoshen', 1, 1, '2021-09-20 07:15:51', NULL),
(12, 'Shaharima Afroj Sraboni', 'Graphic Designer', 'public/uploads/who_we_are/images/1711426787081755.jpg', 'Shaharima Afroj Sraboni', 1, 1, '2021-09-20 07:16:11', NULL),
(13, 'Asma Aktar Urmi', 'Graphic Designer', 'public/uploads/who_we_are/images/1711426808654966.jpg', 'Asma Aktar Urmi', 1, 1, '2021-09-20 07:16:31', NULL),
(14, 'Sharna Islam', 'Digital Influencer', 'public/uploads/who_we_are/images/1711426827400916.jpg', 'Sharna Islam', 1, 1, '2021-09-20 07:16:49', NULL),
(15, 'Rezaul Karim', 'Junior Frontend Developer', 'public/uploads/who_we_are/images/1711426847209786.jpg', 'Rezaul Karim', 1, 1, '2021-09-20 07:17:08', NULL),
(16, 'Pritom Das', 'Junior MERN Stack Developer', 'public/uploads/who_we_are/images/1711426894406394.jpg', 'Pritom Das', 1, 1, '2021-09-20 07:17:53', NULL),
(17, 'Md Sohan', 'Junior Backend Developer', 'public/uploads/who_we_are/images/1711426919497888.jpg', 'Md Sohan', 1, 1, '2021-09-20 07:18:17', NULL),
(18, 'Antora Tabassum', 'Junior Frontend Developer', 'public/uploads/who_we_are/images/1711426961275113.jpg', 'Antora Tabassum', 1, 1, '2021-09-20 07:18:57', NULL),
(19, 'Ariful Sikder', 'Junior Laravel Developer', 'public/uploads/who_we_are/images/1711427006826563.jpg', 'Ariful Sikder', 1, 1, '2021-09-20 07:19:40', NULL),
(20, 'MD. Lotiful Azad (Kajol)', 'Digital Influencer', 'public/uploads/who_we_are/images/1711427038987018.jpg', 'MD. Lotiful Azad (Kajol)', 1, 1, '2021-09-20 07:20:11', NULL),
(21, 'Reyazaul Islam Rifat', 'Junior WordPress Developer', 'public/uploads/who_we_are/images/1711427066958118.jpg', 'Reyazaul Islam Rifat', 1, 1, '2021-09-20 07:20:38', '2021-10-12 05:35:42');

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
(1, 'Employee Salary', 'Expense', 'Static', 1, NULL, NULL),
(5, 'Computer Parts', 'Expense', 'Global', 1, '2021-10-04 03:59:12', NULL),
(6, 'Hart Cups', 'Income', 'Global', 1, '2021-10-04 03:59:34', NULL),
(7, 'Rent', 'Expense', 'Global', 1, '2021-10-04 06:55:45', NULL),
(8, 'Stationary', 'Expense', 'Global', 1, '2021-10-04 06:56:37', NULL),
(9, 'Coffee', 'Expense', 'Global', 1, '2021-10-04 06:57:21', NULL),
(11, 'dfsd', 'Expense', 'Local', 1, '2021-11-02 04:09:36', NULL),
(12, 'sfdsd', 'Expense', 'Global', 1, '2021-11-02 04:10:34', NULL),
(13, 'sdfsd', 'Expense', 'Global', 1, '2021-11-02 04:10:40', NULL),
(14, 'sdfsd', 'Income', 'Global', 1, '2021-11-02 04:10:47', NULL),
(15, 'dfsd', 'Income', 'Local', 1, '2021-11-02 04:10:53', NULL),
(16, 'sdfsd', 'Income', 'Local', 1, '2021-11-02 04:10:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admited_students`
--

CREATE TABLE `admited_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
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

INSERT INTO `admited_students` (`id`, `course_id`, `batch_id`, `student_name`, `gander`, `fathers_name`, `mothers_name`, `nationality`, `national_id_no`, `present_address`, `permanent_address`, `personal_call_no`, `email`, `religion`, `occupation`, `age`, `educational_qualification`, `result`, `passing_year`, `student_photo`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', '<p>Present Address</p>', '<p>Permanent Address</p>', '01784700000', 'rimon@gmail.com', 'Religion', 'Occupation', '2000-01-02', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/1712789307026735.jpg', 1, '2021-10-05 08:12:51', NULL),
(3, 2, 2, 'Sharna', 'female', 'Fathars name', 'Mothars name', 'Bangladesh', 'sdf', '<p><span style=\"background-color:rgb(241,245,248);color:rgb(45,55,72);\">Present Address</span></p>', '<p><span style=\"background-color:rgb(241,245,248);color:rgb(45,55,72);\">Permanent Address</span></p>', '017847000000', 'rimon@gmail.com', 'Religion', 'Occupation', '2021-10-14', 'Honers', 'Result 5.00', '2021', 'public/uploads/student/images/1712789917646079.jpg', 1, '2021-10-05 08:22:33', '2021-10-05 08:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_batch` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `batch_number`, `title`, `active_batch`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First', 'This is First Batch', 1, 1, '2021-10-04 03:50:24', '2021-10-04 04:42:08'),
(2, 'Second', 'This is Second Batch', 1, 1, '2021-10-05 07:31:31', NULL);

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
  `active_blog` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `blog_title`, `creator_name`, `update_time`, `short_description`, `footer_title`, `templete_name`, `blog_image`, `image_alt`, `active_blog`, `status`, `created_at`, `updated_at`, `slug_title`) VALUES
(5, 3, 'ফ্রী Microsoft Office Program course', '', '2 Sep, 2021', '<p>যার ইনভাইট কার্যক্রম আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তাকে প্রথম বিজয়ী হিসেবে নির্ধারণ করা হবে। এবং দ্বিতীয় বিজয়ী কে লটারির মাধ্যমে নির্ধারণ করা হবে। আপনার সকল কার্যক্রম আমাদের IT Expert টিম দ্বারা মনিটরিং করা হবে সুতরাং উপরিউক্ত কোন একটি শর্তাবলী ও যদি কেউ বাদ রাখে তাহলে সে প্রতিযোগী হিসেবে গন্য হবে না।</p>', 'প্রতিযোগিতায় অংশগ্রহণের সময়সীমা ২৫ শে সেপ্টেম্বর পর্যন্ত।', '1', 'public/uploads/blog/images/1709785732805480.jpg', '', 1, 1, '2021-09-01 22:32:20', '2021-09-22 08:04:04', 'free-microsoft-office-program-course'),
(6, 4, 'Digital Influencers', '', '2 Sep, 2021', '<p><a href=\"https://www.facebook.com/sharnaislam.zenia?__cft__%5b0%5d=AZWGB8XGattP-prmDXhd8punrujJHl_NrMXx3zZ1Qy6R9QXZwpzBIFByqv_dxz52-L0gVKEGWmnHMn61B7iusOgjTSDPIFzzCbaGaJ12ZYcyaWRxKWAae7VlYQQ9J-kl2lddPdgjU1t4IKWEhfgIWtA4&amp;__tn__=-%5dK-R\">Sharna Islam Zenia</a> , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool.</p>', 'Digital Influencers', '1', 'public/uploads/blog/images/1711423893204072.jpg', '', 1, 1, '2021-09-01 22:43:23', '2021-09-22 08:04:07', 'digital-influencers'),
(7, 5, 'How To Improve Graphic design', '', '2 Sep, 2021', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709786782107086.png', '', 1, 1, '2021-09-01 22:49:00', '2021-09-22 08:04:12', 'how-to-improve-graphic-design'),
(9, 6, '______বিশেষ ঘোষণা______', '', '4 Sep, 2021', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে। আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১। লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে। আমাদের ওয়েবসাইটের ঠিকানা : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0t8aQBIW2uiaU-e99ghHGbEJ1bzjMjWApeVO0aWzT5gf675BqhemBZrdA\">www.wakeupict.com</a></p>', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', '1', 'public/uploads/blog/images/1709972456887809.jpg', '', 1, 1, '2021-09-04 00:00:14', '2021-09-22 08:07:50', 'free-software-development-internship'),
(10, 4, 'Nazmul Kadir', 'আরিফ', '2021-10-13', '<p><a href=\"https://www.facebook.com/nazmulkadir.pabna?__cft__%5b0%5d=AZUr7t2bqwds_6j7z2zFSY5CBwHQqH5nnqGbz-JnxOoF4F-Z_gjEX9BnJK9YTrxfVsM4Ta9A_dOq5HttjxrJGtYSdjGIaq-LyiScRiHfv_lwuCEF-Ytm07LCbJVQX_md6abeJmCeJZAD4xxLuknXV38Y&amp;__tn__=-%5dK-R\">Nazmul Kadir</a> , one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', 'Nazmul Kadir', '1', 'public/uploads/blog/images/1711435640839282.jpg', 'nazmul kadir', 1, 1, '2021-09-20 09:36:54', '2021-10-13 09:40:06', 'nazmul-kadir'),
(11, 4, 'Md.Lotiful Azad', '', '4 Sep, 2021', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate. For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', 'Certificate', '1', 'public/uploads/blog/images/1709975349465187.jpg', '', 1, 1, '2021-09-04 00:46:12', '2021-09-22 08:07:41', 'md.lotiful-azad'),
(12, 3, 'Microsoft Office', '', '4 Sep, 2021', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', 'Basic Computer', '1', 'public/uploads/blog/images/1709977970062088.png', '', 1, 1, '2021-09-04 01:27:51', '2021-09-22 08:07:47', 'microsoft-office'),
(13, 5, 'Graphic design', '', '4 Sep, 2021', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709981392457096.jpg', '', 1, 1, '2021-09-04 02:22:16', '2021-09-22 08:07:38', 'graphic-design'),
(14, 7, 'Jute Mills Project', '', '4 Sep, 2021', '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.&nbsp;</p>', 'Jute Mills Project', '1', 'public/uploads/blog/images/1709981632078271.png', '', 1, 1, '2021-09-04 02:26:04', '2021-09-22 08:07:31', 'jute-mills-project'),
(15, 7, 'Car Management Project', '', '4 Sep, 2021', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p>', 'Car Management Project', '1', 'public/uploads/blog/images/1709981828528950.jpg', '', 1, 1, '2021-09-04 02:29:11', '2021-09-22 08:07:29', 'car-management-project'),
(16, 5, 'Logo Design', '', '4 Sep, 2021', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p>', 'Logo Design', '1', 'public/uploads/blog/images/1709981997906463.jpg', '', 1, 1, '2021-09-04 02:31:53', '2021-09-22 08:07:36', 'logo-design'),
(17, 8, 'Our Location', 'আরিফ', '4 Sep, 2021', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 'Our New Location', '1', 'public/uploads/blog/images/1709982203715550.png', 'Our Location', 1, 1, '2021-09-04 02:35:09', '2021-10-04 05:29:48', 'our-location'),
(32, 9, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', 'HR Sharna', '20 Sep, 2021', '<p>ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</p>', 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'public/uploads/blog/images/1711428499363215.jpg', 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', 1, 1, '2021-09-20 07:43:24', '2021-09-22 08:13:09', 'web-development-career'),
(36, 9, 'বেকারত্ব অভিশাপ দূর করুন ফ্রিল্যান্সিং শিখে।', 'Sharna Islam Zenia', '2021-11-07', '<p><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বর্তমান</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যুগে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বেকারত্বের</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">জাঁকাকলে পরে থাকা</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">তরুণদের</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">জন্য</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আশার</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আলো</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হয়ে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এসেছে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">&nbsp;বা মুক্তপেশা । শুধুমাত্র\r\n</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\">&nbsp;</span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং\r\nএই </span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\">&nbsp;</span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সম্ভব</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নিজের</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃজনশীলতাকে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কাজে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">&nbsp;লাগিয়ে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">উপার্জনের</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ক্ষেত্রে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃষ্টি</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করা। ফ্রিল্যান্সিং</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বর্তমান</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সময়ে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যথেষ্ট</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আগ্রহের</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বিষয়</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কারণ</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> ,</span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">একটি</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সম্মানজনক</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">মুক্তি পেশা</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এবং</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নিজের</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃজনশীলতা</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফুটিয়ে</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">তোলা</span><span style=\"font-size: 11pt; line-height: 115%; font-family: Calibri, &quot;sans-serif&quot;;\"> </span><span style=\"font-size: 11pt; line-height: 115%; font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সম্ভব।</span><br></p>', 'বেকারত্ব অভিশাপ দূর করুন ফ্রিল্যান্সিং শিখে।', '1', 'public/uploads/blog/images/1715759795471207.png', 'carrier', 1, 1, '2021-11-07 03:07:30', '2021-11-07 03:15:05', 'freelancing-carrier');

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
(5, 'Graphic design', 'Graphic design', 1, '2021-09-01 22:47:38', NULL),
(6, 'Free Development Course', 'Free Development Course', 1, '2021-09-03 23:57:46', NULL),
(7, 'Our project', '<p>Our project</p>', 1, '2021-09-04 02:23:53', '2021-09-09 00:53:36'),
(8, 'Our Location', 'Our Location', 1, '2021-09-04 02:34:11', NULL),
(9, 'ক্যারিয়ার', 'ক্যারিয়ার', 1, '2021-09-09 00:53:51', NULL);

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
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_contents`
--

INSERT INTO `blog_contents` (`id`, `blog_id`, `title`, `templete_name`, `content_design`, `file_type`, `image_alt`, `file`, `short_description`, `order`, `status`, `created_at`, `updated_at`) VALUES
(5, 5, 'Microsoft Office Program course', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709786100069671.jpg', '<p>1. আমাদের ফেসবুক+লিংকডিন পেজ টি লাইক এবং ফলো করুন।</p><p>2. আমাদের ফেসবুক পেজ এ কমপক্ষে ১০০ জনকে ইনভাইট করুন।</p><p>3. আমাদের অফার পোস্ট এর কমেন্টে কমপক্ষে ২০ জন কে মেনশন করুন।</p><p>4. আমাদের ফেসবুকের অফার পোস্ট টি আপনার ফেসবুক প্রোফাইলে শেয়ার করুন ।</p><p>5. ইনভাইট করার সময় কমপক্ষে ১০০ জনকে সিলেক্ট করে স্ক্রীনশট সহ আপনার ফেসবুক</p><p>6. প্রোফাইল লিংক টি আমাদের পেজ এ ম্যাসেজ করুন।</p><p>7. যার ইনভাইট এর মাধ্যমে আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তার বিজয়ী হওয়ার সম্ভাবনা বেশী থাকবে।</p>', '1', 1, '2021-09-01 22:38:10', NULL),
(6, 6, 'Sharna Islam Zenia', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709786634527725.jpg', '<p><a href=\"https://www.facebook.com/sharnaislam.zenia?__cft__%5b0%5d=AZWGB8XGattP-prmDXhd8punrujJHl_NrMXx3zZ1Qy6R9QXZwpzBIFByqv_dxz52-L0gVKEGWmnHMn61B7iusOgjTSDPIFzzCbaGaJ12ZYcyaWRxKWAae7VlYQQ9J-kl2lddPdgjU1t4IKWEhfgIWtA4&amp;__tn__=-%5dK-R\">Sharna Islam Zenia</a> , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool.</p><p>Communication also plays an essential role in human life and professional life. Employee communication is vital to a company’s health and strength. Without it, managers will not be able to manage their managed staff properly. The success of a business depends on the effective implementation of an employee communication strategy.</p>', '2', 1, '2021-09-01 22:46:40', NULL),
(7, 7, 'Graphic design', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709786875072225.png', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', '1', 1, '2021-09-01 22:50:29', NULL),
(8, 9, 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709972494163392.jpg', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে।</p><p>আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১।</p><p>লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে।</p><p>আমাদের ওয়েবসাইটের ঠিকানা : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0t8aQBIW2uiaU-e99ghHGbEJ1bzjMjWApeVO0aWzT5gf675BqhemBZrdA\">www.wakeupict.com</a></p>', '1', 1, '2021-09-04 00:00:49', '2021-09-04 00:32:15'),
(9, 10, 'Nazmul Kodir', '1', 'Left side', 'Image', 'najmul\'\'s certificate', 'public/uploads/blog/images/1711435668102488.jpg', '<p><a href=\"https://www.facebook.com/nazmulkadir.pabna?__cft__%5b0%5d=AZUr7t2bqwds_6j7z2zFSY5CBwHQqH5nnqGbz-JnxOoF4F-Z_gjEX9BnJK9YTrxfVsM4Ta9A_dOq5HttjxrJGtYSdjGIaq-LyiScRiHfv_lwuCEF-Ytm07LCbJVQX_md6abeJmCeJZAD4xxLuknXV38Y&amp;__tn__=-%5dK-R\">Nazmul Kadir</a> , one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', '1', 1, '2021-09-04 00:46:48', '2021-09-26 09:11:16'),
(10, 11, 'Md.Lotiful Azad', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709975382529591.jpg', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google.</p><p>He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate.</p><p>For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', '1', 1, '2021-09-04 00:46:44', NULL),
(11, 12, 'Microsoft Office', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709978052985640.png', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', '2', 1, '2021-09-04 01:29:11', NULL),
(12, 13, 'WakeUpIct', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709981450447830.jpg', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', '2', 1, '2021-09-04 02:23:11', NULL),
(13, 14, 'Rajbari Jute Mills Projects', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709981683648684.png', '<p>&nbsp;</p><p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software. Recently they visit the Rajbari Jute Mill for collecting their Requirements and understand the environment of the Rajbari Jute mill. According to the Team Lead, They are playing to launch their first version of this Software end of this year. We are so thrilled about the journey ahead.</p>', '1', 1, '2021-09-04 02:26:53', NULL),
(14, 15, 'Car Management Project', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709981851934164.jpg', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p><p>Special thanks go to Folly Edem the Co-Organizer of GDG LOME for his interest in WAKEUPICT for build this project with modern technology.</p><p>Finally, we complete the project and deploy it on the server.</p>', '1', 1, '2021-09-04 02:29:33', NULL),
(15, 16, 'Cloud80', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1709982062615369.jpg', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p><p>They desire a logo for their company. Our Two Graphic Designers <a href=\"https://www.facebook.com/shaharimaafroj.sraboni.5?__cft__%5b0%5d=AZVXBESv4fiXNLd9HWK0-e3KO3gBEo8R0NWW04Tm8OtiL0CmtyRlsRcvLjcZ-hYgWJazoEbnsEsNnM2yOctsSSw1PPyGh8RzaA9QF8_JSn9TcyFi6zGrhjpa4Vs6JBAYyM4IblmSDRn0MvcNCqLd9S_R&amp;__tn__=-%5dK-R\">Shaharima Afroj Sraboni</a> and Asma Urmi do magnificent work on this project and develop very quality content based on client desire.</p>', '1', 1, '2021-09-04 02:32:55', NULL),
(16, 17, 'স্থান পরিবর্তন:', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1709982248715676.png', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', '1', 1, '2021-09-04 02:35:52', NULL),
(23, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711428755387645.jpg', '<p><span style=\"background-color:gray;color:black;\"><i><mark class=\"marker-yellow\"><strong>ওয়েব ডেভেলপমেন্ট ক্যারিয়ারঃ</strong></mark></i></span></p><p>&nbsp;</p><p><span style=\"color:black;\">ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</span></p><p><span style=\"color:rgb(112,48,160);\">&nbsp;</span></p><p><span style=\"background-color:gray;\"><i><mark class=\"marker-yellow\"><strong>ওয়েব ডেভেলপমেন্ট কি?</strong></mark></i></span></p><p>একটি ওয়েবসাইটের জন্য সাধারণত অ্যাপ্লিকেশন তৈরি করা&nbsp; হচ্ছে ওয়েব ডেভেলপমেন্ট । যেখানে সাধারণত একজন ওয়েব ডেভেলপার একটি ওয়েবসাইটের জন্য এপ্লিকেশন তৈরি করে থাকেন। আর একজন ওয়েব ডিজাইনার যে ডিজাইন করে থাকুক না কেন তার প্রতিটা উপকরণকে সাধারণত ফাংশনাল করার জন্য পরিচালিত কর্মকাণ্ডই হলো ওয়েব ডেভেলপমেন্ট।</p>', '1', 1, '2021-09-20 07:47:28', NULL),
(24, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1711428821673177.jpg', '<p>ওয়েব ডেভেলপমেন্টের কাজ শিখতে যা যা লাগবেঃ</p><p>&nbsp;</p><p>১. সাধারণত প্রথমে আপনাকে ওয়েব ডেভেলপমেন্ট কি এবং ডিজাইন কি এই সম্পর্কে ভাল করে জানতে হবে এবং ধারণা রাখতে হবে।অর্থাৎ এক কথায় আপনাকে ব্যাপারটা ভালোভাবে বুঝতে হবে।</p><p>&nbsp;</p><p>২.সাধারণত মার্কেটপ্লেসগুলোতে এই কাজ করে&nbsp; আপনাকে সফল হতে হলে অনেক ধৈর্য শক্তি থাকতে হবে এবং রিসার্চ করার মানসিকতা থাকতে হবে। ।অনেকে আছেন যারা অনেক ভালো কাজ পারেন কিন্তু তাদের ধৈর্য শক্তি কম তারা অনলাইনে ক্যারিয়ার গড়তে ব্যর্থ হয়েছেন। তাই অবশ্যই ধৈর্য ধরে কাজ করতে হবে।কোন কিছূ না বুঝতে পারলে সেটা রিসার্চ করার করার মানসিকতা তৈরি করতে হবে।</p><p>&nbsp;</p><p>&nbsp;</p><p>৩. আপনার সৃজনশীল চিন্তা করার যোগ্যতা থাকতে হবে। তার জন্য&nbsp; আপনাকে প্রচুর পরিমাণে চর্চা করতে হবে। প্রায়&nbsp; সবক্ষেত্রে&nbsp; অবশ্যই এক্ষেত্রে বায়ার বা যে প্রতিষ্ঠানে কাজ করতে চাইবেন তারা আপনার আগের কাজ দেখতে চাইবে। ফলে আপনি যে কাজ গুলো চর্চা করবেন সেগুলোকে তাদের কে দেখাতে পারবেন। এছাড়াও আপনি যখন মার্কেটপ্লেস গুলোতে কাজ করতে থাকবেন আস্তে আস্তে আপনার এই বিষয়গুলো নিয়ে সৃজনশীল চিন্তা&nbsp; তৈরি হয়ে যাবে।</p><p>&nbsp;</p><p>৪.&nbsp; আপনাকে ইংরেজি জানতে হবে তবে এটা মোটামুটি জানলেও চলবে কেননা আপনি যখন বায়ারের সাথে ডিল করবেন তখন এটি আপনাকে সাহায্য করবো। তাদের ভাষা বুঝতে আপনার পক্ষে অনেক সহজ হবে।</p><p>&nbsp;</p><p>&nbsp;</p><p>৫. ওয়েব ডেভেলপমেন্ট এর কাজের জন্য আপনাকে পর্যাপ্ত পরিমানে সময় দিতে হবে। আপনি যদি এখানে সময় দিতে না পারেন তাহলে আপনি কোনদিনও এই কাজ ভালোভাবে করতে পারবেন না বা আপনি সফল হতে পারবেন না। আর সব চেয়ে গুরুত্বপূর্ণ হচ্ছে মাইন্ড সেট করা । আপনাকে এমনভাবে মাইন্ড সেট করতে হবে যে, আপনি প্রতিদিন নিদির্ষ্ট পরিমাণ সময় এখনে দিতে পারেন। আপনাকে প্রতিদিনের লক্ষ্যমাত্রা রাখতে হবে আপনি যেন মিনিমাম ৪-৫ ঘন্টা সময় ব্যয় করতে পারেন । কথায় আছে কষ্ট করলে কেষ্ট মিলে। তাই, সময় দিয়ে শিখুন।</p><p>৬. আপনাকে প্রচুর পরিমাণে পরিশ্রম করতে হবে এখানে। আর ধৈর্যের সাথে কাজ করতে হবে। প্রথম দিকে হয়তো কাজ পেতে কিছৃট বেগ পেতে হতে পারে তখন হতাশ না হয়ে বরং ধৈয্য ধরে আপনার স্কিলগুলোকে ঝালাই করে নিতে হবে।</p><p>&nbsp;</p><p># ওয়েব ডেভেলপার এর ধরণঃ</p><p>১. ফ্রন্টএন্ড ডেভেলপার</p><p>২.&nbsp; ব্যাকএন্ড ডেভেলপার</p><p>৩.&nbsp; ফুলস্ট্যাক ওয়েব ডেভেলপার</p>', '2', 1, '2021-09-20 07:48:31', NULL),
(25, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711428951735719.jpg', '<p><span style=\"background-color:gray;\"><mark class=\"marker-yellow\">ফ্রন্টএন্ড ডেভেলপার বা ওয়েব ডিজাইনার এর কাজ কি?</mark></span></p><p>ওয়েব ডিজাইন হচ্ছে একটা ওয়েবসাইটের জন্য বাহ্যিক গঠন তৈরী করা। ওয়েব ডিজাইনারের মুল কাজ একটা সাইটের জন্য টেমপ্লেট (ওয়েবপেজ) বানানো, এখানে কোন এপ্লিকেশন থাকবেনা। যেমন লগিন সিস্টেম, নিউজলেটার সাইনআপ, পেজিনেশন, ফাইল আপলোড করে ডেটাবেসে সেভ করা, ইমেজ ম্যানিপুলেশন, যদি সাইটে বিজ্ঞাপণ থাকে তাহলে প্রতিবার পেজ লোড হওয়ার সময় বিজ্ঞাপণের পরিবর্তন এগুলি এপ্লিকেশন, ওয়েব এপ্লিকেশন। এসব তৈরী করতে হয় প্রোগ্রামিং ল্যাংগুয়েজ দিয়ে। কোন প্রকার এপ্লিকেশন ছাড়া একটা সাইট তৈরী করা এটাই ওয়েব ডিজাইন, এধরনের ডিজাইনকে বলা যায় স্টাটিক ডিজাইন। ওয়েব ডিজাইনের জন্য এই ধারনাটি সাধারনত ব্যবহৃত হচ্ছে।</p><p>কে শিখতে পারবে ওয়েব ডিজাইন?</p><p>&nbsp;</p><p>যে কেউ&nbsp;&nbsp; শিখতে পারবে যে নূনতম শিক্ষিত, যার কম্পিটার এর বেসিক নলেজটুকু জানা আছে । এর জন্য এমনটি নয় যে অনেক ইংলিশ ভালো জানতে হবে কিংবা অনেক সফটওয়্যার জানতে হবে।</p><p>ওয়েব ডিজাইন শেখার জন্য যা প্রয়োজন তা হলো:</p><p>&nbsp;</p><p>১.ফটোশপ / ইলাস্ট্রেটর.</p><p>২.এইচ টি এম এল (HTML).</p><p>৩.সি এস এস (CSS)</p><p>&nbsp;</p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ফ্রন্ট-এন্ড ওয়েব ডেভেলপার হিসেবে কাজের সুযোগঃ</mark></span></p><p>ফ্রন্ট-এন্ড ডেভেলপাররা একটি ওয়েবসাইটের লে-আউট, তার ইন্টারেক্টিভ এবং নেভিগেশনাল এলিমেন্ট যেমন বাটনস, স্ক্রলবার, ইমেজ, অভ্যন্তরীণ বিভিন্ন লিংক— এসবকিছু বাস্তবায়িত করেন। বিভিন্ন ব্রাউজার এবং ডিভাইসে ওয়েবসাইট বা অ্যাপ্লিকেশনের যথাযথ প্রদর্শনও নিশ্চিত করেন ফ্রন্ট-এন্ড ডেভেলপার।</p><p>&nbsp;তারা ওয়েবসাইটগুলো এমনভাবে কোড করেন যাতে বিভিন্ন স্ক্রিন সাইজ ও ডিভাইসের ধরনের সাথে সেগুলো এডাপ্টেবল হয়। ফলে ইউজাররাও সবখানে সন্তোষজনক এক্সপেরিয়েন্স পান। এছাড়াও ফ্রন্ট-এন্ড ডেভেলপাররা নিয়মিত ইউজেবিলিটি টেস্ট করা, ফ্রন্ট-এন্ডে কোনো বাগ দেখা দিলে তারা&nbsp; তা ফিক্স করার জন্য&nbsp; কাজ করেন। এই সব কাজ করতে তারা এসইও (সার্চ ইঞ্জিন অপ্টিমাইজেশন),সফটওয়্যার ওয়ার্কফ্লো ম্যানেজমেন্ট — এগুলোও মাথায় রাখেন।</p><p>তবে এক্ষেত্রে বাংলাদেশের প্রেক্ষাপটে&nbsp; থেকে উল্লেখ্য হচ্ছে, এখন পর্যন্ত শুধুমাত্র ফ্রন্ট-এন্ড ডেভেলপার হিসেবে জবের সংখ্যা তুলনা মূলকভাবে বেশ কম লক্ষ্য করা যায়। বিভিন্ন প্রতিষ্ঠানগুলো সাধারণত ফুল-স্ট্যাক ডেভেলপারই নিয়োগ করে থাকেন এবং তাদের মাঝে মাঝে ব্যাক-এন্ড ডেভেলপারও প্রয়োজন হয়। তাই শুধুমাত্র ফ্রন্ট-এন্ড ডেভেলপার হিসেবে বাংলাদেশের বাজারে প্রতিষ্ঠিত হওয়া কিছুটা দুরূহই বলতে হয় এই দিকগুলো&nbsp; পর্যবেক্ষণ করে।</p><p>এর সম্ভাবনাময় দিক গুলো :</p><p>&nbsp;</p><p>একজন ভালো ওয়েব ডিজাইনার এর চাহিদা অনেক বেশি হয়ে থাকে। ওয়েব ডিজাইনার হয়ে কখনো চাকরির জন্য মাসের পর মাস বেকার বসে থাকতে হয় না। আসলে বসে থাকার প্রয়োজন’ও পরে না কারণ এটা আন্তর্জাতিক মানের একটি পেশা। অনলাইন এ ফ্রিলান্সিং কিংবা অফসাইট এ কন্ট্রাকচুয়াল কাজের অনেক সুযোগ এখানে আছে। বছর বছর প্রমোশন না থাকলেও, বেতনের বৃদ্ধির হারটা অনেক উর্ধগতি। এই পেশায় অভিজ্ঞতা দিয়ে আপনার মুল্য বিচার করা হয়। এই পেশায় যার যত বেশি কাজের অভিজ্ঞতা বাড়তে থাকে তার যোগ্যতাও তত বেশি হতে থাকে।</p><p>&nbsp;</p>', '3', 1, '2021-09-20 07:50:35', '2021-09-20 07:54:23'),
(26, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1711429026846589.jpg', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ব্যাকএন্ড&nbsp; ডেভেলপার বা ওয়েব ডেভেলপার এর কাজ কি?</mark></span><mark class=\"marker-yellow\">&nbsp;</mark></p><p>একজন ফ্রন্টএন্ড ডেভেলপারের ডেভেলপ করা স্ট্যাটিক ওয়েবসাইটে প্রাণসঞ্চার করার কাজটি যিনি ,করেন তিনিই হলেন&nbsp; ব্যাকএন্ড&nbsp; ডেভেলপার। ফ্রন্টএন্ড ডেভেলপারের কাজের উপর ব্যাসেস করে ব্যাকএন্ড&nbsp; ডেভেলপার ওয়েবসাইটকে ডেভেলপ করে থাকেন। এজন্য ফ্রন্টএন্ড&nbsp; ডেভেলপারকে ব্যাকএন্ড&nbsp; সম্পর্কে ধারণা না রাখলেও চলে কিন্তু ব্যাকএন্ড&nbsp; ডেভেলপারকে ফ্রন্টএন্ড সম্পর্কে ধারণা রাখতে হয়। নরমালি একজন ব্যাকএন্ড&nbsp; ডেভেলপার ফ্রন্টএন্ড&nbsp; ডেভেলপা্রের কাছ থেকে একটি ওয়েবসাইট ডিজাইনের কোডগুলো নিয়ে সেটির একটি এডমিন প্যানেল তৈরি করেন। এডমিন প্যানেল তৈরি করার পর সেই ওয়েবসাইটের ডিজাইন পরিবর্তন করার জন্য বা নতুন পোস্ট লেখার জন্য কোডিং করতে হয়না। অর্থাৎ একজন ব্যাকএন্ড&nbsp; ডেভেলপার একটি ওয়েবসাইটকে স্ট্যাটিক ওয়েবসাইটে রূপান্তর করে দেয়। এখানে আপনাকে প্রোগ্রামিং শিখতে হবে। এটাই মুল জিনিস ডেভেলপমেন্টে। মূলত ওয়েব প্রোগ্রামিং যেমন ASP.NET, PHP, Java বা অন্য কোন ল্যাংগুয়েজ। তবে পিএইচপির কাজ বর্তমানে সবচেয়ে বেশি।ওয়েব ডেভেলপমেন্টে প্রোগ্রামিং শেখার পাশাপাশি আপনাকে সংশ্লিষ্ট অনেক কিছু শিখতে হবে। অন্যথায় আপনি আর উপরে উঠতে পারবেন না। যে বিষয়গুলো ভালোভাবে শিখতে হবে:</p><p>১. যে কোন একটি প্রোগ্রামিং ল্যাঙ্গুয়েজ মূলত PHP শিখতে হবে।</p><p>২. মাইসিক্যুয়েল-এর মতো একটি ডাটাবেস ডিজাইনের মাধ্যমে, আপনাকে মধ্যম স্তরের অন্তত একটি পূর্ণাঙ্গ রিলেশনাল ডাটাবেস তৈরি করতে সক্ষম হতে হবে।</p><p>৩. খুবই ভাল কোয়েরি শিখতে হবে। যাতে SQL দিয়ে জটিল কোয়েরি করতে পারতে হবে।</p><p>৪. ফেসবুক / গুগল / টুইটার / আমাজন প্রভৃতি বিখ্যাত সাইটের ওয়েব সার্ভিস / API কীভাবে ব্যবহার করতে হয় তা আপনার জানা উচিত (এক্সএমএল)</p><p>৫. হোস্টিং সম্পর্কে স্পষ্ট ধারণা থাকতে হবে বিশেষ করে সার্ভার ম্যানেজমেন্ট সম্পর্কে ধারনা।</p><p>৬.কিভাবে একাধিক ডেভেলপার একই প্রজেক্টে সোর্স কন্ট্রোল যেমন git, tortoise svn ইত্যাদি দিয়ে কাজ করতে পারে এসব জানতে হবে ।</p><p>৭. এজাক্স, জেকোয়েরি এবং ডেভেলপমেন্ট সংক্রান্ত বিভিন্ন টুলস সম্পর্কে প্রচুর জানতে হবে। যেমন নেটবিনস (কোড লেখার IDE), HeidiSQL, MySQL WorkBench (ডেটাবেস ডিজাইন টুল) এসব জানতে হবে।</p><p>&nbsp;</p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ব্যাক-এন্ড ওয়েব ডেভেলপার হিসেবে কাজের সুযোগঃ</mark></span></p><p>ব্যাক-এন্ড ডেভেলপার ফ্রন্ট-এন্ডকে সচল রাখার জন্য যে ইনফাস্ট্রাকচার দরকার তা তৈরি ও রক্ষণাবেক্ষণ করেন। এর মূলত তিনটি অংশ বলা যায়— সার্ভার, অ্যাপ্লিকেশন, ডেটাবেজ। ব্যাক-এন্ড ডেভেলপারদের দেওয়া কোড সার্ভার অ্যাপ্লিকেশন এবং ডাটাবেসের মধ্যে মসৃণ যোগাযোগ নিশ্চিত করে। তারপর বিভিন্ন ডাটাবেস ম্যানেজমেন্ট টুলস সার্চ, এডিট এবং ডেটা সেভ করে এবং ফ্রন্ট-এন্ডে পাঠায়।ফ্রন্ট-এন্ড ডেভেলপারদের মতো, ব্যাক-এন্ড ডেভেলপাররা তাদের চাহিদা মেটাতে ক্লায়েন্টদের সাথে কাজ করে। ব্যাক-এন্ড ডেভেলপমেন্ট টাস্কগুলি সাধারণত ডেটাবেস তৈরি, সংহত এবং রক্ষণাবেক্ষণ, ব্যাক-এন্ড ফ্রেমওয়ার্ক ব্যবহার করে সার্ভার-সাইড সফটওয়্যার তৈরি, কন্টেন্ট ম্যানেজমেন্ট সিস্টেম তৈরি এবং বাস্তবায়ন এবং ওয়েব সার্ভার প্রযুক্তি এবং অপারেটিং সিস্টেমগুলির সাথে কাজ করে।</p><p>&nbsp;</p><p>বাংলাদেশে ব্যাক-এন্ড ডেভেলপারদের সুযোগ তুলনামূলকভাবে বেশি হলেও নিজেকে ফুল-স্ট্যাক ডেভেলপার হিসেবে তৈরি করতে পারলেই সুযোগ সবচেয়ে বেশি থাকে। যেকোনো প্রতিষ্ঠানের জন্যই ফ্রন্ট-এন্ডের তুলনায় ব্যাক-এন্ড ডেভেলপার বেশি প্রয়োজন হয়। কারণ সেখানে কাজের ক্ষেত্র অনেক বেশি। সেক্ষেত্রে প্রতিষ্ঠানগুলোর জন্য ফুল-স্ট্যাক ডেভেলপার হায়ার করাই বেশি লাভজনক, যেহেতু সেই ডেভেলপার প্রয়োজনমত যেকোনো রোলেই কাজ করতে পারেন।</p>', '4', 1, '2021-09-20 07:51:47', NULL),
(27, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711429087053497.jpg', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ফুলস্ট্যাক ওয়েব ডেভেলপার এর কাজ কি?</mark></span></p><p>কোন ওয়েবসাইট তৈরি করতে গেলে ওয়েবসাইট ডিজাইন করার পাশাপাশি ওয়েবসাইটের আরও কিছু কাজ করা লাগে। ওয়েবসাইট ডিজাইন করাই ওয়েবসাইট বানানোর ক্ষেত্রে একমাত্র কাজ নয় বরং <span style=\"color:black;\">ওয়েবসাইটের সার্ভারসহ ওয়েবসাইটের কাঠামো তৈরি ওয়েবসাইট তৈরির ক্ষেত্রে অনেক বড় একটি অংশ বহন করে। তাই একটি ওয়েব ডেভেলপারের প্রয়োজন হয় একটি ওয়েবসাইটের কাজের জন্য এবং সেই সাথে একজন ওয়েব ডিজাইনার এবং একজন ফুল-স্ট্যাক ডেভেলপারের কাজ হল ওয়েব ডিজাইন এবং ওয়েব ডেভেলপমেন্টের দুটোর কাজ সম্পূর্ণ করা এবং সমন্বয় করা।</span></p><p><span style=\"color:red;\">&nbsp;</span></p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">একজন ফুল স্ট্যাক ডেভেলপার কোথায় কাজ করেন?</mark></span></p><p>ফুল স্ট্যাক ডেভেলপার হলে আপনার কাজের ক্ষেত্র শুধুমাত্র ওয়েবসাইটের কাজের মধ্যেই সীমাবদ্ধ। বর্তমানে ইন্টারনেটের যুগে সবধরনের প্রতিষ্ঠানেরই ওয়েবসাইট প্রয়োজন হয়। তাই ফুল স্ট্যাক ডেভেলপারের কাজের ক্ষেত্র একটি নির্দিষ্ট জায়গায় সীমাবদ্ধ হলেও কাজের ধরনে বেশ বৈচিত্র্য থাকে এবং এক্ষেত্রে সৃষ্টিশীলতা দেখানোর বেশ সুযোগ থাকে। বৈচিত্র্যের সাথে কাজ করতে চান এবং সৃষ্টিশীল কাজের প্রতি আগ্রহী হলে ফুল স্ট্যাক ডেভেলপার হিসেবে আপনি কাজ করতে পারেন।</p><p><span style=\"color:black;\">&nbsp;</span></p><p><span style=\"color:black;\">একটি পূর্ণ স্ট্যাক ওয়েব ডেভেলপার কি উপার্জন করতে পারে?</span></p><p><span style=\"color:black;\">একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কত উপার্জন করবে তা তার কাজের দক্ষতা এবং অভিজ্ঞতার উপর নির্ভর করবে। যাইহোক, দক্ষতার উপর নির্ভর করে, কিছু কোম্পানির ২০,০০০টাকা থেকে ১ লক্ষ টাকা পর্যন্ত সেলারি রয়েছে।</span></p><p>&nbsp;</p><p>একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কি পরিমান উপার্জন করতে পারে?</p><p>একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কত উপার্জন করবে তা তার কাজের দক্ষতা এবং অভিজ্ঞতার উপর নির্ভর করবে। যাইহোক, তবে দক্ষতা ভেদে কিছু কিছু কোম্পানিতে ২০ হাজার টাকা থেকে ১ লাখ টাকা পর্যন্ত সেলারি রয়েছে।</p>', '5', 1, '2021-09-20 07:52:44', NULL),
(28, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711429270146527.jpg', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ওয়েব ডেভেলপমেন্ট এর ভবিষ্যৎ চাহিদা :</mark></span></p><p>বর্তমানে ওয়েব ডিজাইন ও ডেভেলপমেন্ট-এর চাহিদা মার্কেট প্লেস গুলোতে অনেক বেশি, সেই সাথে প্রতিনিয়ত বেড়েই চলেছ এবং ভবিষ্যতে আরও বাড়বে এবং বাড়তেই থাকবে।</p><p>ওয়েব ডিজাইন এবং ডেভেলপমেন্টের কাজ শিখেছেন এমন অনেকেই আপওয়ার্ক, ফাইবার, ফ্রিল্যান্সার,&nbsp; পিপলপারআওয়ার সহ আরো অনেক জনপ্রিয় মার্কেটপ্লেসে কাজ করছেন।</p><p>&nbsp;</p><p>&nbsp;</p><p>সাধারণত যতদিন ওয়েবসাইট থাকবে ততদিন ওয়েব ডেভেলপমেন্ট এর চাহিদাও থাকবে। দিনদিন ওয়েবসাইটের সংখ্যা বেড়েই চলেছে। যেমন ধরুন, ২০১৫ হিসাব মতে বিশ্বে মোট ওয়েবসাইট ছিল তখন ৮৬ কোটি তারপরে ২০১৭ সাল নাগাদ এর সংখ্যা বেড়েছে ১১৫ কোটিরও বেশি। দুই বছরের এর পরিমাণ বেড়েছে ৪৩ কোটিরও বেশি। আর বুঝতে বাকি নেই যে বর্তমান বিশ্বে ওয়েব সাইট ডেভলপার বা ওয়েবসাইট ডিজাইনার মূল্য বা চাহিদা কতটা। যেকোনো মার্কেটপ্লেসে একজন ওয়েব ডেভেলপার তার কাজের ধারা অনুযায়ী ঘন্টায় ২০&nbsp; ডলার&nbsp; থেকে একশ ডলার পর্যন্ত ইনকাম করে থাকে। বাংলাদেশে এমন অনেক ফ্রিল্যান্সার রয়েছেন যারা সাধারণত কাজের ধারণা দিয়ে প্রতি ঘণ্টায়&nbsp; কমপক্ষে ১০০ ডলার পর্যন্ত আয় করে থাকে।</p><p>সাধারণত, ওয়েব ডেভেলপমেন্ট বা ওয়েব ডিজাইন কাজের ক্ষেত্রে ফ্রিল্যান্সিংকে সর্বোচ্চ চাকরি বা আয় হিসেবে বিবেচনা করা হয়।</p>', '6', 1, '2021-09-20 07:55:39', NULL),
(35, 36, 'বেকারত্ব অভিশাপ দূর করুন ফ্রিল্যান্সিং শিখে।', '1', 'Left side', 'Image', 'বেকারত্ব অভিশাপ দূর করুন ফ্রিল্যান্সিং শিখে।', 'public/uploads/blog/images/1715760130002030.png', '<p class=\"MsoNormal\"><span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বর্তমান</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যুগে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বেকারত্বের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">জাঁকাকলে পরে থাকা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">তরুণদের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">জন্য</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আশার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আলো</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হয়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এসেছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">&nbsp;বা মুক্তপেশা\r\n। শুধুমাত্র </span>&nbsp;<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং এই </span>&nbsp;<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সম্ভব</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নিজের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃজনশীলতাকে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কাজে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">&nbsp;লাগিয়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">উপার্জনের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ক্ষেত্রে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃষ্টি</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করা। ফ্রিল্যান্সিং</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বর্তমান</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সময়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যথেষ্ট</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আগ্রহের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বিষয়</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কারণ</span> ,<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">একটি</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সম্মানজনক</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">মুক্তি পেশা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এবং</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নিজের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃজনশীলতা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফুটিয়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">তোলা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সম্ভব।বাংলাদেশ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বিশ্ব</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বাজারের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অর্থনৈতিক</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">দৌড়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এখনো</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অনেক</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পিছিয়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আছে।</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">তার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অন্যতম</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কারণ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হচ্ছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বেকারত্বের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">&nbsp;করুন অবস্থা\r\n। বেকারত্ব</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সমস্যা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এমনিতেও</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">শোচনীয়</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অবস্থায়</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এর</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">মধ্যে</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আরও</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">জটিল</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করে</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">তুলেছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করোনার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ভয়াবহ থবা। করোনাকালীন</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আরও</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">প্রকট</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">রূপ</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নিয়েছে। ।অনেকে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করোনার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কারণে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কর্মসংস্থান</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পাচ্ছে না</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সদ্য</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পাস</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">শিক্ষার্থীরা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">।করোনার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কারণে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সরকারি</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">চাকরির</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নিয়োগ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অনেক</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কমে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">গেছে।</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">আজকাল</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">শুধু</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যোগ্যতা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">দিয়ে চাকরি</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হচ্ছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">না</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">।প্রচুর</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পরিমাণ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">মোটা</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অঙ্কের</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ঘুষ</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ছাড়া</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">চাকরি</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যেন আজকাল</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সোনার</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হরিণ।পাল্লা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ভারী</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হয়েছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করোনার </span>&nbsp;<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ভয়াবহ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পরিস্থিতির</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কারণে</span> ,<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যা গত</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">দুই</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বছর</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ধরে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">চলছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">। লকডাউন</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">&nbsp;শিথিল হলেও\r\nবেশীরভাগ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">কোম্পানি</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এখনোও</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পুরোদমে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">শুরু</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হয়নি। এর ফলে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">নির্বিচারে</span>&nbsp; <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">চলছে\r\nকর্মী</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ছাঁটাই।ফলপ্রসুত,\r\nচাকরি আর কর্মক্ষেত্র</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হারিয়ে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বেকার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হচ্ছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হাজার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হাজার</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">জনবল।&nbsp; ফলে\r\nআর্থিক</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">টানাপোড়েন</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সঙ্গে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">লড়াই</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">করতে হচ্ছে অনেকে।</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">এর</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফলে</span>\r\n,<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হতাশায়</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ডুবে</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">যাচ্ছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">গেছে</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">অনেকে। অর্থনৈতিক</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সমৃদ্ধির</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ক্ষেত্রে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">সৃষ্টি</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">হচ্ছে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বড়</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বাধা। এই বাধা নিরসনে গুরুত্বপূর্ণ</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ভূমিকা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">রাখতে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পারে</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">ফ্রিল্যান্সিং</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">বা</span> <span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">মুক্ত</span>\r\n<span style=\"font-family: &quot;Nirmala UI&quot;, &quot;sans-serif&quot;;\">পেশা।<o:p></o:p></span></p>', '1', 1, '2021-11-07 03:12:49', NULL);

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
  `course_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `price`, `short_description`, `course_content`, `long_description`, `importents`, `future_of_this_course`, `possibilities_of_this_course`, `time_line`, `student_quantity`, `image`, `status`, `created_at`, `updated_at`, `course_slug`) VALUES
(1, 'গ্রাফিক ডিজাইন', '৫,০০০/-', '<p>এই কোর্সে আমরা গ্রাফিক ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>Photoshop Tools and Uses and Shortcuts. &nbsp;File Management. &nbsp;Layer and History. &nbsp;Smart Object. &nbsp;Pattern. &nbsp;Custom Shape. &nbsp;Action Basic. &nbsp;Clipping Mask.</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যেখানে নিজের দক্ষতা (Skill) ও শিল্প (Art) ব্যবহার করে কোন ছবি, লেখা অথবা শব্দের সমন্বয়ে একটি অর্থবোধক শব্দ ছবি তৈরি করা। এই ছবি বিভিন্ন এডভেটাইজ, ম্যাগাজিন, বই, ওয়েবসাইট, লোগো &amp; টি শার্ট সাজানোর জন্য বিভিন্নভাবে ব্যবহার করা যেতে পারে। এই ছবিটা বানানোর জন্য আমাদের কিছু বিষয় সম্পর্কিত জ্ঞান এবং টুলস সম্পর্কিত জ্ঞান থাকা আবশ্যক।&nbsp;</p><p>&nbsp;</p><p>গ্রাফিক্স ডিজাইন জন্য দুইটি সফটওইয়ার ব্যবহার করা হয়। যেমনঃ Adobe Photoshop এবং Adobe Illustrator. এই সফটওয়ার দুইটি সম্পর্কে প্রাথমিক ধারণাসহ এর বিভিন্ন টুলস সম্পর্কে আলোচনা করব। যে টুলস গুলো রয়েছে, Photoshop Tools and Uses and shortcuts, File Management, Layer add History, Smart object, Pattern, Custom Shapes, Action Basic and এবং Cliping Mask ইত্যাদি। বেসিক গ্রাফিক্স ডিজাইন কোর্সে আমরা গ্রাফিক্স ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব।</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যার মাধ্যমে নিজের সৃজনশীলতা ব্যবহার করে ছবি বা নকশার মাধ্যমে নিজের প্রতিভাকে প্রকাশ করা যায়। বেসিক শিখলে আমরা ছবি এডিটিং,ব্যানার তৈরি , PSD ডিজাইন, Website Template Design করতে পারব। তাই আমরা যদি Graphics Design বেসিক কোর্সটি সম্পূর্ন করতে পারি তাহলে আমরা উল্লেখিত কাজগুলো করতে পারব।</p>', '<p>যেহেতু Adobe Photoshop এবং Adobe Illustrator ব্যতিক্রম Software। উল্লেখিত বেসিক গ্রাফিক্স ডিজাইন কোর্স অর্থাৎ Adobe Photoshop ও Adobe Illastrator শিখে আমরা যে সকল কাজের মাধ্যমে উপার্জন করতে পারব তার মধ্যে অন্যতম হলোঃ ১। স্টডিওতে ছবি এডিটিং ২। ছবির ব্যাকগ্রাউন্ড রিমুভ ইত্যাদি Graphics Design বেসিক কোর্সটি একজন Professional Graphics Designer হওয়ার পথটি সংকচন করে দেয়। এবং ভবিষ্যতে আমরা ফটোগ্রাফি ভিডিও এডিটিং , Animation, ভিজুয়্যাল ইফেক্টস সহ অনেক কিছু পেষা হিসাবে নিতে পারব। এবং একজন বেসিক গ্রাফিক্স ডিজাইন কোর্স হিসাবে Online জগতে বিভিন্ন মার্কেটপ্লেসে কাজ করে অর্থ উপার্জন করতে পারব। অবশ্যই Graphics Designer হতে হলে আমাদের অ্যাডভান্স গ্রাফিক্স ডিজাইন কোর্স শিকতে হবে।</p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">Graphic Design শিখে আমরা লোগো ডিজাইন, ব্যানার তৈরি, ভিডিও এডিটং এর কাজ বিভিন্ন national ও maltinational কোম্পানি, চলোচিত্র নির্মান কোম্পানি ইত্যাদিতে কাজ চাকরি করে অনেক টাকা উপার্জনের সুজগ আছে।</span></p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513690566200.jpg', 1, '2021-09-21 07:58:09', '2021-09-21 07:58:09', 'graphic-design'),
(2, 'ডিজিটাল মার্কেটিং', '৬,০০০/-', '<p>মার্কেটিং এর কনসেপ্টগুলো ডিজিটাল প্ল্যাটফর্মে এক্সিকিউট করাই ডিজিটাল মার্কেটিং। আমাদের এই কোর্সের ডিজিটাল মার্কেটিং এর বিস্তারিত বিষয়গুলো নিয়ে আলোচনা করা হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;Market Research<br>&nbsp;Data Analytics<br>&nbsp;Organic Marketing<br>&nbsp;Paid Marketing<br>&nbsp;CPA Marketing<br>&nbsp;Blog Marketing<br>&nbsp;1. Google Add Ward<br>&nbsp;2. Added Different<br>&nbsp;Marketplace Add Management</p>', '<p>বর্তমান সময়ে বিজ্ঞাপনের সকল মাধ্যমগুলোর মধ্যে বর্তমান সময়ের বহুল পরিচিত এবং সবথেকে জনপ্রিয় মাধ্যম হচ্ছে&nbsp; ডিজিটাল মার্কেটিং । যেখানে অডিয়েন্স আছে কোন পণ্য বা সেবার বিজ্ঞাপন সাধারণত সাধারণভাবে সেখানেই হয়। আমরা প্রতিনিয়ত যে সব ওয়েবসাইট ব্যবহার করছি সেখানে আমরা কোন পণ্য বা সেবার বিজ্ঞাপন দিয়ে খুব সহজেই কাস্টমার দিতে পারি। মার্কেটিং এর যাবতীয় কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগ করার জন্য যা জরুরী তা এখানে দেখানো হবে।</p>', '<p>পেশা বা ফ্রিল্যান্সার হিসেবে বর্তমান সময়ে ডিজিটাল মার্কেটিং এর প্রচুর চাহিদা রয়েছে। এছাড়া নিজের ব্যবসা সম্প্রসারণ করার জন্য ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা অপরিসীম। ব্যক্তিগত অথবা ব্যবসা যে প্রয়োজনে হোক ডিজিটাল মার্কেটিং এর পরিধি ক্রমশ বর্ধমান।</p>', '<p>যুগের সাথে তাল মিলিয়ে ব্যবসায়ের সমপ্রসারণ এর ক্ষেত্রে ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা আকাশচুম্বী। ডিজিটাল মার্কেটিং এর বাজার প্রতিনিয়ত পরিবর্তন হচ্ছে। ট্রেডিশনাল মার্কেটিং এর কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগের মাধ্যমে দ্রুত সময়ে বেশি সংখ্যক অডিয়েন্সের কাছে পৌঁছানো সম্ভব হচ্ছে । সুদূর ভবিষ্যতে ডিজিটাল মার্কেটিং এর চাহিদা আরো বেশি হবে।</p>', '<p>বর্তমান সময়ে দেশের মার্কেটিং এর প্রচুর চাহিদা রয়েছে। মার্কেটিং এর যাবতীয় টেকনিক ডিজিটাল উপায় প্রয়োগ করে সহজেই সম্ভব অডিয়েন্সের কাছে পৌঁছানো। এই কোর্স&nbsp;মার্কেট রিসার্চ, ডাটা এনালাইসিস, অর্গানিক মার্কেটিং, সিপিএ মার্কেটিং, গুগল এডওয়ার্ড, মার্কেটপ্লেস এবং ব্যবস্থাপনা নিয়ে আলোচনা করা হয়েছে । এই কোর্সটি সম্পন্ন করার পর বিভিন্ন মার্কেটপ্লেসে ফ্রিল্যান্সিং সহ চাকরির ক্ষেত্রে সহায়ক হবে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513801587092.jpg', 1, '2021-09-21 07:57:25', '2021-09-21 07:57:25', 'digital-marketing'),
(3, 'ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', '৫,০০০/-', '<p>আমাদের এই কোর্সে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে দুইটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>HTML<br>CSS<br>PSD To HTML<br>Responsive Design<br>Bootstrap<br>2 Live Projects</p>', '<p>ওয়েব&nbsp;ডিজাইন হল একটি ওয়েবসাইটের ব্যাহিক রুপ যা আমরা দেখতে পাই বা দৃশ্য মান হয় । আর ওয়েব ডেভেলপমেন্ট হল ভেতরের সাইট যা আমরা দেখতে পাইনা । যেমন উদাহরণ সরুপ একটি গাড়ীর কথা চিন্তা করি । গাড়ির দরজা, জানালা, সিট ব্যাহিক সবকিছুই ওয়েব ডিজাইন এর মধ্যে পরে । আর গাড়ীর ভেতরের যেই মেকানিজম কাজ করে অর্থাৎ গাড়ীর ইঞ্জিন যে ভবে কাজ করে সেটা ওয়েব ডেভেলপমেন্টের মধ্যে পরে । মূল কথা এই যে, ওয়েব ডেভে লপমেন্ট একটি ওয়েবসাইটের প্রান সঞ্চারন করে। অনেকে মনে করে ওয়েব ডিজাইনে HTML, CSS নিয়ে কাজ করতে হয়, ধারনাটি ভুল। ওয়েব ডিজাই রা মূলত ফটোশপ, ইলাস্টেটর বিভিন্ন ওয়েব ফ্রেম দিয়ে ইউজার ইন্টারফেস একটি স্কেচ তৈরি করেন। একজন ওয়েব ডেভেলপার তিন ধরনের হতে পারে ফন্টইন্ড ওয়েব ডেভেলপার, ব্যকইন্ড ওয়েব ডেভেলপার এবং ফুলস্টাক ওয়েব ডেভেলপার। ফন্টইন্ড ডেভেলপার ওয়েবসাইটের ব্যহিক অংশ তৌরি করেন। ব্যকইন্ড ডেভেলপার ওয়েবসাইটের ভেতরের সারভার সাইটে কাজ করেন আর&nbsp; ফুলস্টাক ডেভেলপার ওয়েবসাইটের ফন্টইন্ড এবং ব্যকইন্ড&nbsp; দুই অংশেই কাজ করেন। এই সকল কাজই ডেভেলপমেন্টের পরিচিতি। ওয়েব ডেভেলপার যখন ওয়েব ডিজাইনার থেকে ইউজার ইন্টারফেস এর স্কেচ পাবে তখন ডেভেলপার কোড ইডিটর যেমন-নোটপ্যাড, সাবলাইম, ভিজুয়্যাল স্টডিও কোড এর মাধ্যমে কোডিং করে&nbsp; সেই ওয়েবসাইটের রুপ, প্রান প্রদান করবে। এইভাবেই একটি ওয়েব সাইট তার পূরনতা পাবে।</p>', '<p>যদি আমার চিন্তা এমন থাকে যে আমি ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখে&nbsp;কিভাবে&nbsp;সহজে&nbsp;আয়&nbsp;করবো’&nbsp; বা&nbsp;‘এটা&nbsp;শিখে&nbsp;কত&nbsp;টাকা&nbsp;আয়&nbsp;করবো&nbsp;’&nbsp;বা কীভাবে রাতা রাত্রি টাকা আয় করবো এই সকল চিন্তা যদি আমার থাকে তাহলে আমার জন্য় ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট নয় । আমার চিন্তা এমন থাকতে হবে যে,&nbsp;কোন&nbsp;কাজটা&nbsp;আমি&nbsp;শিখবো,&nbsp;&nbsp;‘আমি&nbsp;কোন&nbsp;কাজটা&nbsp;পারবো’।&nbsp;ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট সাধারনত শেখার জন্য়ে দরকার প্রচুর ধর্য এবং ডেডিকেশন ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ করে টাকা ইনকাম করার কোন লিমিট নেই আপনি যত বেশি কাজ&nbsp; করবেন যত বেশি দক্ষ্য হবেন আপনার&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট মাধমে টাকা ইনকা্মের পরিমান ততো বেশি বারবে ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ আপনার জানা থাকলে আপনি যেকোন যায়গায় বসে আপনি ক্লায়েন্ট এর কাজ করে দিতে পারবেন এর জন্য আপনার শুধু দরকার একটি লেপটপ আর নেট কানেকশন তাহলে আপনি খুব সহজেই কাজ সম্পাদন করতে পারবেন।&nbsp;ওয়েব&nbsp;ডেভেলপমেন্ট শিখে আপনি যদি HTML, CSS, PHP এর মধেই সিমাবদ্ধ থেকেন তাহলে আপনার কাজ করতে অসুবিধা হবে&nbsp; । আসলে প্রগ্রামিং এর কাজ এমন যে প্রতিনিয়ত আপডেট হতে থাকে তাই আপনাকে নতুনত্ব শিখতে হবে । সর্বশেষ বলতে চাই যে আপনি কাজ &nbsp;শিখে যাওয়ার পর আপনি অন্য যেকোনো পেশা থেকে এখানেই ভালো আয় করতে পারবেন আপনার কাজের অভাব হবে না।</p>', '<p>আজকাল বিভিন্ন ধরনের কাজ অনলাইন নির্ভর হয়ে পরেছে, যেই কারনে সারা বিশে প্রতিনিয়ত তৈরি হচ্ছে লক্ষ্য লক্ষ্য ওয়েবসাইট। কিন্তু সেই ওয়েবসাইট বানানোর জন্য তেমন দক্ষ্য ওয়েব ডেভেলপার নেই। এই জন্যে একজন দক্ষ্য ওয়েব ডেভেলপারে চাহিদা বাপ্যক। যার কারনে একজন দক্ষ্য ওয়েব ডেভেলপার এর ভবিষ্যৎ উজ্জ্বল । এই কাজ শিখা থাকলে ঘরে বসেই বিভিন্ন ওয়েবসাইট কাজ করতে পারবে যেমন-&nbsp; Upwork, Fiver, Freelancer, Theme-forest এ কাজ করে অনেক টাকাইন কাম করতে পারবে।</p>', '<p>বর্তমান সময়ে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর ব্যাপক চাহিদা রয়েছে। বাংলাদেশের অনেক প্রতিষ্ঠান রয়েছে যারা দক্ষতার ওপর ভিত্তি করে ওয়েব ডিজাইনার অথবা ডেভেলপার নিয়োগ দিয়ে থাকে। ওয়েব ডিজাইন এবং ডেভেলপমেন্ট কোর্স শেষ করার পর বিভিন্ন মার্কেটপ্লেসে কাজ করা সহ বিভিন্ন প্রতিষ্ঠান ডিজাইনার অথবা অথবা ডেভেলপার হিসেবে চাকরি করার সুযোগ রয়েছে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513742369298.jpg', 1, '2021-09-21 07:57:07', '2021-09-21 07:57:07', 'web-design-and-development'),
(4, 'অ্যাডভান্স গ্রাফিক ডিজাইন', '৫,০০০/-', '<p>এই করছে আমরা গ্রাফিক ডিজাইনের অ্যাডভান্স ফিচার এবং কাজ সম্পর্কে জানব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য অবশ্যই বেসিক গ্রাফিক ডিজাইন সম্পর্কে ধারণা থাকতে হবে।</p>', '<p>এখানে আপনারা যা শিখবেন:</p><p>&nbsp;Business Card Design<br>&nbsp;Logo Concept Realization<br>&nbsp;Web Banner Design<br>&nbsp;Flyer Design<br>&nbsp;Book Cover Design<br>&nbsp;Facebook Cover Design<br>&nbsp;T-shirt Design</p>', '<p>অ্যাডভান্সড গ্রাফিক ডিজাইন কোর্স এমন লোকদের জন্য ডিজাইন করা হয়েছে যারা গ্রাফিক ডিজাইনের সাথে পরিচিত এবং সরঞ্জাম এবং এর ব্যবহার সম্পর্কে জানেন। গ্রাফিক ডিজাইনারগণ মিডিয়া এবং ওয়েব ডিজাইন, প্যাকেজিং, চিত্রণ, অ্যানিমেশন এবং অন্যান্য ক্ষেত্রে তাদের নকশা দক্ষতা কাজে লাগান। ধারণাটি তৈরিতে সহায়ক এবং দক্ষতার সাথে প্রকল্পের সংখ্যা অন্তর্ভুক্ত করার দক্ষতাগুলি হাইলাইট করার জন্য স্তরটি উন্নত।</p>', '<p>ক্যারিয়ারের সম্ভাবনা, ফ্রিল্যান্সের সুযোগ, আর্থিক লাভ, শিল্প ও নকশার প্রতি ভালবাসা বা পয়েন্ট তৈরির জন্য অ্যাডভান্স গ্রাফিক ডিজাইন| লোগো, ব্র্যান্ডিং, ওয়েবসাইটগুলি, মুদ্রণ ইত্যাদিতে শিল্পীদের নিজের কাজ করার জন্য প্রচুর জায়গা রয়েছে যা অ্যাডভান্স গ্রাফিক ডিজাইন এর মাধ্যমে জানতে ও শিখতে পারবে। অনেকগুলি সুযোগের সাথে সম্ভাবনাগুলি ভাল, যে কোনও গ্রাফিক ডিজাইনারের সর্বদা কাজ থাকে। নিজেকে এমনভাবে প্রকাশ করা যা সত্যই আপনার নিজস্ব- গ্রাফিক ডিজাইন দিয়ে আপনাকে আপনার ক্লায়েন্টের প্রয়োজনের সাথে কাজ করার সময় আপনাকে নিজের স্থান তৈরি করতে দেয়। একজন গ্রাফিক ডিজাইনার হিসাবে আপনি নিজের রাউন্ডগুলিকে আলাদা আলাদা আর্ট স্টুডিওগুলি তৈরি করবেন এবং অনেকগুলি সৃজনশীল সাদৃশ্যযুক্ত লোকের সাথে সাক্ষাত করতে পারবেন।</p>', '<p>দিন দিন বিশ্ব আরও ডিজিটাল হয়ে উঠছে। একটি ভাল দৃষ্টিভঙ্গি দ্বারা তৈরি বিজ্ঞাপনটি এমন কোনও ধারণাগুলি প্রকাশ করতে পারে যা কখনই শব্দ দিয়ে প্রকাশ করা যায় না গ্রাফিক ডিজাইনে ক্যারিয়ারের সুযোগটি সারা বিশ্ব জুড়ে দাবি করছে। গ্রাফিক ডিজাইনের দুটি দুর্দান্ত সুযোগ হল ফ্রিল্যান্সিং এবং আউটসোর্সিং। গ্রাফিক ডিজাইনের কোর্সটি বিভিন্ন ক্রিয়েটিভ ক্যারিয়ারের বিভিন্ন প্যালেটকে অন্তর্ভুক্ত করার জন্য আপনার বিকল্পগুলি প্রসারিত করে যা বিজ্ঞাপন সংস্থাগুলি এবং শিল্প নকশা সংস্থাগুলির মতো উচ্চ সৃজনশীল সংস্থায় নেতৃত্বের অবস্থানগুলিতে প্রসারিত করতে পারে। পাশাপাশি আমরা প্রশিক্ষণের জন্য সাহায্য করি। আপনি Google বা Naukri, shine, Glassdoor প্রকৃতপক্ষে ইত্যাদির মতো কোনও ওয়েবসাইটের পরামর্শের মাধ্যমে অনুসন্ধান করে গ্রাফিক ডিজাইনার কাজগুলি সম্পর্কে জানতে পারেন। বিগ এমএনসি সংস্থাগুলি থেকে স্টার্টআপসে অভিজ্ঞ কর্মরত পেশাদারদের জন্য রয়েছে প্রচুর পরিমাণে জব ওপেনিং।</p>', '<p>১. ফ্রিল্যান্সিংঃ ফ্রিল্যান্সার হিসাবে পরিচালনা করা, আপনার নিজের ব্যবসায়ের মালিকানা সৃজনশীল আত্মার জন্য বিশেষত স্বাধীনতা এর অনেক<br>সুবিধা রয়েছে তবে আপনি আরও অর্থোপার্জন করতে পারেন।</p><p>&nbsp;</p><p>২. নিয়োগঃ যদি আপনার ব্যক্তিত্বের ধরণ (অনুশাসিত?) – বা পরিস্থিতি অবিচ্ছিন্ন আয়ের প্রয়োজন হয় তবে আপনাকে কোথাও কোথাও চাকরি নিতে হতে পারে।<br>বিজ্ঞাপন সংস্থাগুলি আপনাকে কাজে নিবে যদি আপনি প্রকৃতপক্ষে ভাল হন এবং দ্রুত এবং অবিরত সময়সীমার পরে সময়সীমা পরিচালনা করতে সক্ষম হন।<br>সংবাদপত্র এবং ছোট মুদ্রণের দোকানগুলিতেও নিয়মিতভাবে গ্রাফিক শিল্পী প্রয়োজন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513706337465.jpg', 1, '2021-09-21 07:57:52', '2021-09-21 07:57:52', 'advanced-graphic-design'),
(6, 'অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', '৭,৫০০/-', '<p>আমাদের এই কোর্সে অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে তিনটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর প্রাথমিক ধারণা থাকতে হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;CSS Framework (Bootstrap)<br>&nbsp;PSD To HTML<br>&nbsp;JavaScript Library (jQuery)<br>&nbsp;PHP Framework (Laravel)<br>&nbsp;3 Live Projects<br>&nbsp;Freelancing</p>', '<p>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো কোনো টেমপ্লেটকে আরও সুন্দর ভাবে সাজানো। এক্ষেত্রে HTML, CSS , CSS এর ফ্রেমওয়ার্ক Bootstrap,JavaScript এর ফ্রেমওয়ার্ক jQuery ব্যবহার করে টেমপ্লেট ডিজাইন করা হয়। ডিজাইন এর ফ্রেমওয়ার্কগুলো ব্যবহার করে টেমপ্লেট এর কোথায়, কীভাবে তথ্যগুলো দেখানো হবে সেটা নির্ধারণ করাই হলো এডভান্স ওয়েব ডিজাইনারের কাজ।<br>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো সমৃদ্ধ-বৈশিষ্টযুক্ত ওয়েবসাইট এবং ওয়েব পোর্টাল তৈরি করা। সাধারণত এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্টে জাভাস্ক্রিপ্ট, পিএইসপি, সিএমএস এবং তাদের ফ্রেমওয়ার্কগুলি ব্যবহার করা হয়। বিভিন্ন ধরনের ম্যানেজমেন্ট সফটওয়ার তৈরি করা হয়। এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখতে হলে অবশ্যই HTML, CSS, JavaScript, jQuery, PHP বেসিক জ্ঞান থাকতে হবে। এরপর ডেভেলপমেন্ট করতে হলে PHP ফ্রেমওয়ার্ক Laravel শিখতে হবে। একজন ওয়েব ডিজাইনারের ডিজাইনকৃত ওয়েব টেমপ্লেট এর প্রতিটি স্ট্যাটিক উপকরণকে PHP ফ্রেমওয়ার্ক (Laravel) দিয়ে ফাংশনাল এবং ডাইনামিক করাকেই এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট বলে। একজন ভালো ওয়েব ডেভেলপার হতে হলে অবশ্যই আপনাকে HTML, CSS, JavaScript,jQuery, Bootstrap, PHP(Laravel), MySQL সম্পর্কে অনেক জ্ঞান থাকতে হবে।</p>', '<p>বর্তমানে বেকারত্ব দূর করার সহজ উপায় হলো ফ্রিল্যান্সিং করা এবং ফ্রিল্যান্সিং করে বাংলাদেশসহ বিশ্বের অনেক দেশ আজ অনেকটাই বেকারত্ব দূর করতে পারছে। এক্ষেত্রে আমাদের দেশ ও পিছিয়ে নেই। আমাদের এই কোর্স এ এডভান্স ওয়েব পেজ ডিজাইন এন্ড ডেভেলপমেন্ট সম্পর্কে বিশদ শেখানো হবে। এই কোর্সে আমরা CSS Framework(Bootstrap), PSD To HTML, JavaScript Library(jQuery), PHP Framework(Laravel), 3 Live Projects and Freelancing সম্পর্কে বিস্তারিত শেখাবো। আপনি কোডিং এর এডভান্স ফ্রেমওয়ার্কগুলো শেখার পর ৩ টি লাইভ প্রোজেক্ট পাচ্ছেন যার মাধ্যমে আপনি জানতে পারবেন কীভাবে লাইভ প্রোজেক্ট বা ক্লাইন্টের কাজ করতে হয়। আপনাকে শেখানো হবে ফ্রিল্যান্সিং যাকে মুক্ত পেশাও বলে। এই পার্ট থেকে আপনাকে শেখানো হবে কীভাবে ক্লাইন্ট এর কাজ করা যায় এবং ফ্রিল্যান্সিং করে অর্থ উপার্জন করা যায়।</p>', '<p>বর্তমান যুগ হলো টেকনোলজির যুগ। দিন দিন অনেক অনেক কোম্পানী প্রতিষ্ঠিত হচ্ছে এবং বর্তমানে প্রায় সব কোম্পানী বা বড় বড় দোকানের তাদের মার্কেটিং এর জন্য ওয়েবসাইট দরকার হয়। এবং দিন দিন এটা বেড়েই চলেছে এবং অনেকেই অর্থ উপার্জন করছে। ভবিষ্যতে এর চাহিদা বেড়েই যাবে। এই পেশায় প্রাথমিক পর্যায়ে ১০ থেকে ২০ হাজার টাকা বেতনে কোম্পানীর কাজ করা যায় এবং ৩ থেকে ৫ বছর পরে আপনি একজন ইঞ্জিনিয়ার না হয়েও একজন ইঞ্জিনিয়ারের সমতুল্য বেতনে অর্থাৎ ৮০ হাজার থেকে এক লাখ টাকা পর্যন্ত বেতনে চাকরি করতে পারবেন। বাইরের ক্লাইন্টের কাজ করেও নিজের ভবিষ্যত উজ্জ্বল করতে পারবেন।</p>', '<p>কোর্স শেষে আপনি বিভিন্ন মার্কেট প্লেসে কাজ করে অর্থ উপার্জন করতে পারবেন। পাশাপাশি বিভিন্ন কোম্পানির কাজও করে দিতে পারেন। অনলাইন মার্কেটপ্লেসগুলোর মধ্যে রয়েছ, upwork.com, freelancer.com, fiverr.com ইত্যাদি। এসব মার্কেটপ্লেসে ওয়েব পেইজ ডিজাইনার এন্ড ওয়েব ডেভেলপারদের ব্যাপক চাহিদা রয়েছে। কাজ অনুযায়ী আপনি প্রতি ঘন্টায় ২ থেকে ১০০ ডলার ইনকাম বা আয় করতে পারবেন। এছাড়াও আপনি আপনার তৈরি করা ওয়েবসাইট বিভিন্ন কোম্পানির কাছে বিক্রি করতে পারবেন। তাছাড়া themeforest.net এবং codecanyon.net এই দুই মার্কেটপ্লেসেও বিক্রি করে আয় করতে পারেন। বিদেশী কোম্পানীসহ আমাদের দেশে বিভিন্ন সফটওয়ার কোম্পানীতে Web Designer and Web Developer হিসেবে জব করতে পারবেন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1711513200931914.jpg', 1, '2021-09-21 06:20:35', '2021-09-21 06:20:35', 'advance-web-design-and-development');

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
(14, 1, 'কোর্স শেষে সার্টিফিকেট', 1, 1, '2021-09-06 05:57:44', '2021-10-13 08:29:14'),
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
(11, '1', 'অ্যাডোব ইলাস্ট্রেটর', 1, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">অ্যাডোব ইলাস্ট্রেটর একটি সফটওয়ার যা কম্পিউটারে ব্যবহার করে অঙ্কন, চিত্র এবং শিল্পকর্ম তৈরি করা হয়। তবে ইলাস্ট্রেটর উচ্চ মানের শিল্পকর্ম তৈরিতে ব্যবহার করা হয়।</span></p>', '1', '2021-09-06 00:09:33', '2021-10-13 08:18:10'),
(12, '1', 'এডোবি ফটোশপ', 2, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">অ্যাডোব ফটোশপ হলো এমন একটি সফটওয়ার যার মাধ্যমে নিজের সৃজনশীলতাকে কাজে লাগিয়ে কোনো ইমেজ এডিটিং করে নতুন রূপ দেয়া হয়। সাধারণত ফটোশপ বেসিক এ তার বেসিক টুলস গুলো ব্যবহার করে কাজ করা হয়।</span></p>', '1', '2021-09-06 00:10:22', NULL),
(13, '2', 'Chapter One ( The Beginning)', 1, '<p><span class=\"text-huge\"><strong>o</strong> What is digital Marketing&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> What is the important of Digital Marketing&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> Why Digital Marketing is Currently the trend&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> Classification of Digital Marketing&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (i) Branding&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ii) Product Promotion&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iii) Advertising&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iv) Growth Sales&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (v) Gain More Traffic&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (vi) Public Relations&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> Area of War &nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (i) Facebook&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ii) Google&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iii) Website&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iv) Youtube&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (v) Email&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (vi) SMS&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (vii) Twitter&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (viii) Instagram&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ix) Quora&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (x)Affiliate Marketing&nbsp;</span></p><p><span class=\"text-huge\"><strong>o</strong> War Elements&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (i) Text Content&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (ii) Info Graphic&nbsp;</span></p><p><span class=\"text-huge\">&nbsp; &nbsp; (iii) Video</span></p>', '1', '2021-09-10 21:32:56', '2021-10-13 07:04:06'),
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
(24, '2', 'Chapter Twelve ( The conclusions )', 12, '<p><strong>o</strong> Summer up everything</p>', '1', '2021-09-10 22:07:34', NULL);

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
(1, 14, 'Human Resource Management System', 'public/uploads/development_project/images/1710959364204846.png', 'Human Resource Management System', 'fa fa-users', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Human resources management system is a suite of software applications used to manage human resources and related processes throughout the employee lifecycle. An HRMS enables a company to fully understand its workforce while staying compliant with changing tax laws and labor regulations.</span></p>', 1, 1, '2021-09-13 03:55:13', '2021-09-22 04:32:47'),
(2, 32, 'Heart Failure Management System', 'public/uploads/development_project/images/1711427467550799.png', 'Heart Failure Management System', 'fa fa-medkit', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">HeartCop (Heart Failure Management System) is developed to help clinicians improve outcomes and reduce hospitalizations for heart failure patients with fluid management problems. It is an integrated information system for managing heart failure patients. Patients data is highly secure and responsive.</span></p>', 1, 1, '2021-09-15 03:22:59', '2021-09-22 04:32:25'),
(3, 32, 'Jute Industry Management System', 'public/uploads/development_project/images/1711427392818331.png', 'HEART FAILURE MANAGEMENT SYSTEM', 'fa fa-industry', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Enterprise management systems are large-scale software packages that track and control the complex operations of a business. The jute management system is an application that you can use to maintain your Supply Chain Management, jute industry employees, jute gradings, accounts, profits, and everything.</span></p>', 1, 1, '2021-09-15 03:25:45', '2021-10-17 04:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title_id`, `title`, `date`, `remark`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(9, 9, '3 times', '2021-10-15', '<p>Remark</p>', '1000', 1, '2021-10-11 05:03:55', '2021-10-11 05:27:43'),
(11, 1, 'Salary Paid From Payroll', '2021-10-17', '<p>remark</p>', '1000', 1, '2021-10-17 05:00:25', NULL),
(12, 8, 'Title', '2021-10-23', '<p>Remark</p>', '1000', 1, '2021-10-23 04:05:51', NULL);

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
(4, 'public/uploads/slider_image/images/1711427230687901.png', 'Home slider Two', 1, 1, '2021-09-12 06:09:35', '2021-10-12 07:13:45'),
(5, 'public/uploads/slider_image/images/1711427280812137.png', 'Home slider 3', 1, 1, '2021-09-12 01:21:03', '2021-09-20 07:24:02'),
(6, 'public/uploads/slider_image/images/1711427261430306.png', 'Home slider', 1, 1, '2021-09-12 06:07:31', '2021-10-04 05:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` int(11) NOT NULL,
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

INSERT INTO `incomes` (`id`, `title_id`, `title`, `date`, `remark`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(5, 6, 'United hospital One Time', '4 Oct, 2021', '<p>Sold for forever</p>', 10000, '1', '2021-10-04 07:11:51', NULL),
(6, 6, 'hart cccc', '2021-09-30', '<p>123</p>', 123, '1', '2021-10-11 05:40:11', '2021-10-11 05:45:37'),
(8, 6, 'From Somewhere', '2021-10-23', '<p><span style=\"color: rgb(33, 37, 41); font-weight: 700;\">Remark</span><br></p>', 2000, '1', '2021-10-23 03:56:38', NULL);

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
(7, 32, 'public/uploads/international_work/images/1711427735844022.png', 'wict livest', 1, 1, '2021-09-14 23:56:49', '2021-10-18 05:19:09');

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
(8, 17, 'public/uploads/localProject/images/1711428044441612.png', 'wict-wustock-wusoft', 1, 1, '2021-09-15 07:30:33', '2021-10-12 04:17:41');

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
(44, '2021_11_06_164341_create_sorting_tests_table', 25);

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
(1, 'Home', 'A Prominent Software Farm in Bangladesh - Wake up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p><strong>Wake Up ICT</strong> is a <strong>Prominent Software Farm</strong> in Bangladesh. It is a complete <strong>Software Development</strong> &amp; <strong>IT Service</strong> providing Company that gives high-quality services to our customer.</p>', NULL, '24 Aug, 2021', 'public/uploads/SEO/images/1711429977439517.png', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-20 08:06:53', '2021-09-20 08:06:53'),
(2, 'About', 'About page - Wake Up ICT', NULL, 'og locale about', 'og type about', 'og url about', 'og side name about', 'ms validate about', '<p><strong>Wake Up ICT</strong> Academy is one of the leading IT Training Institute in Bangladesh and provides all kinds of <strong>IT-Related Solutions</strong>. Wake UP ICT has been playing a vital role in Rajbari eradicate the unemployment problem since 2015...</p>', 'article publisher about', '19 Aug, 2021', 'public/uploads/SEO/images/1708522539636513.png', '324', '3423', 'twitter card about', 'twitter label 1 about', 'twitter data 1 about', 'google side varification about', '1', '2021-09-17 18:32:24', '2021-09-17 18:32:24'),
(3, 'Academic', 'Academic Training - Wake UP ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p>OUR ACADEMIC TRAINING MODULE IS THE BEST CITY &amp; WE HAVE SOME QUALIFIED TRAINERS AND A DIGITALIZED COMPUTER LAB. WE CAN ENSURE YOU THAT OUR COURSES WILL SERVE YOUR PURPOSE...</p>', NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-17 18:43:38', '2021-09-17 18:43:38'),
(4, 'Services', 'Services - Wake up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p>The best service you can get from Wake up ICT. It is IT Training Institute in Bangladesh and provides all kinds of IT-Related Solutions.</p>', NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-20 08:11:39', '2021-09-20 08:11:39'),
(5, 'Blog', 'Our Blogs - Wake up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Blogs Page Wake up ICT.</p>', NULL, '2 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-19 18:40:38', '2021-09-19 18:40:38'),
(6, 'Contact', 'Contact Us - Wake up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p>To get a free quote, <strong>Contact us</strong> anytime with Wake up ICT.</p>', NULL, '2 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-19 18:49:40', '2021-09-19 18:49:40'),
(14, 'গ্রাফিক ডিজাইন', 'Graphic design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-20 08:40:06', '2021-09-20 08:40:06'),
(15, 'ডিজিটাল মার্কেটিং', 'ডিজিটাল মার্কেটিং', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Description</p>', NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-21 02:25:28', '2021-09-21 02:25:28'),
(16, 'ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', 'Web design and development course', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-21 02:26:29', '2021-09-21 02:26:29'),
(17, 'অ্যাডভান্স গ্রাফিক ডিজাইন', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(19, 'অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(45, 'ফ্রী Microsoft Office Program course', 'ফ্রী Microsoft Office Program course', NULL, NULL, NULL, NULL, NULL, NULL, '<p>যার ইনভাইট কার্যক্রম আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তাকে প্রথম বিজয়ী হিসেবে নির্ধারণ করা হবে। এবং দ্বিতীয় বিজয়ী কে লটারির মাধ্যমে নির্ধারণ করা হবে। আপনার সকল কার্যক্রম আমাদের IT Expert টিম দ্বারা মনিটরিং করা হবে সুতরাং উপরিউক্ত কোন একটি শর্তাবলী ও যদি কেউ বাদ রাখে তাহলে সে প্রতিযোগী হিসেবে গন্য হবে না।</p>', NULL, '20 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-19 19:29:10', '2021-09-19 19:29:10'),
(46, 'Microsoft Office Program course', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(47, 'Digital Influencers', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(48, 'Sharna Islam Zenia', 'Sharna Islam Zenia Digital Influencers - Wake Up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(33,37,41);\">Sharna Islam Zenia, one of our Digital Influencers, has <strong>successfully Communication Secrets</strong> certification from 10minuteschool.</span></p>', NULL, '18 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-17 16:21:52', '2021-09-17 16:21:52'),
(49, 'How To Improve Graphic design', 'Graphic design', NULL, NULL, NULL, NULL, NULL, NULL, '<h4>Graphic design</h4><p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', NULL, '19 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-18 16:34:21', '2021-09-20 09:57:17'),
(52, '______বিশেষ ঘোষণা______', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', NULL, NULL, NULL, NULL, NULL, NULL, '<p><br>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে। আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১। লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে</p>', NULL, '19 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-18 16:26:24', '2021-09-18 16:26:24'),
(54, 'Nazmul Kadir', 'Nazmul Kadir Digital Influencers - Wake Up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Nazmul Kadir, one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. Now he is more capable of optimizing a website to perform well in search engines.</p>', NULL, '9 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-20 09:40:57', '2021-09-21 02:28:12'),
(56, 'Md.Lotiful Azad', 'Lotiful Azad Digital Influencers - Wake Up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<h2>Md.Lotiful Azad, one of our Digital Influencers, he <strong>Successfully achieved</strong> The <strong>Fundamentals of Digital Marketin</strong>g Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate</h2>', NULL, '9 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-17 16:16:04', '2021-09-17 16:16:04'),
(58, 'Microsoft Office', 'Microsoft Office', NULL, NULL, NULL, NULL, NULL, NULL, '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', NULL, '19 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-18 21:02:30', '2021-09-18 21:02:30'),
(60, 'How to improve your graphic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2021-09-11 02:25:23'),
(62, 'Jute Mills Project', 'Jute Mills Project Rajbari', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.</p>', NULL, '19 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-18 21:01:31', '2021-09-18 21:01:31'),
(64, 'Car Management Project', 'car management', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(66, 'Logo Design', 'Cloud80 tech company Logo Design - Wake up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p><strong>Cloud80</strong> is a <strong>tech company</strong> based in the <strong>United States</strong>, they provide Salesforce development and implementation services.</p>', NULL, '20 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-19 19:37:53', '2021-09-19 19:37:53'),
(68, 'Our Location', 'Our Location - Wake up ICT', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Wake Up ICT Academy location Nannu Tower, 3rd Floor, Panna Chattar, Rajbari.</p>', NULL, '20 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-19 18:56:56', '2021-09-19 18:56:56'),
(70, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ারঃ', 'কিভাবে ওয়েব ডেভেলপমেন্ট ক্যারিয়ার গড়তে পাড়ি? বিস্তারিত', NULL, NULL, NULL, NULL, NULL, NULL, '<p>ওয়েব ডেভেলপমেন্ট ক্যারিয়ার বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। ওয়েব ডেভেলপমেন্ট কি?এবং ক্যারিয়ার গড়তে হলে কি কি দরকার বিস্তারিত পাবেন এখানে। &nbsp;</p>', NULL, '20 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-20 08:41:54', '2021-09-20 08:41:54'),
(91, 'Student Registration page', 'Student Registration form', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-20 08:47:55', '2021-09-20 08:47:55'),
(96, 'বেকারত্ব অভিশাপ দূর করুন ফ্রিল্যান্সিং শিখে।', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL);

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
  `expense_id` int(20) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `user_id`, `expense_id`, `date`, `amount`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(11, 33, 11, '2021-10-17', 1000, '<p>remark</p>', 1, '2021-10-17 05:00:25', NULL);

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
(1, 'One', '2021-11-06', 1, 1, NULL, '2021-11-07 07:00:09'),
(2, 'Two', '2021-11-06', 2, 1, NULL, '2021-11-07 07:00:09'),
(3, 'threee', '2021-11-06', 3, 1, NULL, '2021-11-07 07:00:09'),
(4, 'four', '2021-11-06', 4, 1, NULL, '2021-11-07 07:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
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

INSERT INTO `students` (`id`, `course_id`, `batch_id`, `student_name`, `gander`, `fathers_name`, `mothers_name`, `nationality`, `national_id_no`, `present_address`, `permanent_address`, `personal_call_no`, `email`, `religion`, `occupation`, `age`, `educational_qualification`, `result`, `passing_year`, `student_photo`, `status`, `created_at`, `updated_at`) VALUES
(12, 1, NULL, 'Rimon Khan update', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', 'Present Address', 'Permanent Address', '01784700000', 'rimon@gmail.com', 'Religion', 'Occupation', '2000-01-02', 'Masters', 'Result 5.00', '2021', NULL, 1, '2021-10-05 02:53:02', '2021-10-14 08:38:59'),
(23, 1, NULL, 'Sharna update', 'female', 'sdfsdf', 'sdfsd', 'sdfsd', '1313213213', 'dsfsdfsd', 'sdfsdf', '017847000000', 'moderator@moderator.com', 'sdfds', 'dsfds', '4545', 'S.S.C', 'Result 5.00', '2021', NULL, 1, '2021-11-07 04:34:03', NULL),
(24, 1, NULL, 'Sharna update', 'female', 'sdfsdf', 'sdfsd', 'sdfsd', '1313213213', 'dsfsdfsd', 'sdfsdf', '017847000000', 'moderator@moderator.com', 'sdfds', 'dsfds', '4545', 'S.S.C', 'Result 5.00', '2021', NULL, 1, '2021-11-07 04:58:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid_number` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `nid_number`, `employee_type`, `type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '', '', 'Admin', NULL, '$2y$10$3Y5vFhDrx9dcRI1F/ygjy.EjHQveVmFFaPqGxXPQ1vhS.cthgfj7C', NULL, '2021-08-12 09:00:04', '2021-08-12 09:00:04'),
(2, 'moderator', 'moderator@moderator.com', '', '', 'moderator', NULL, '$2y$10$wH9zBNza9ARqQ1rDVRZ3xOwiqiot0nftqMnF3CFUQM7fGTLUWPBMm', NULL, '2021-08-18 09:22:34', '2021-08-18 09:22:34'),
(33, 'Rimon Khan', 'rimon@gmail.com', '12312312312', 'Paid', 'Employee', NULL, '$2y$10$JBh4Jhag.tYMPTWwhfWH6urQpTC554UEciEgVYnz.2Z6N2ul2ceMy', NULL, '2021-10-04 03:54:54', '2021-10-31 04:17:41'),
(35, 'Ariful Sikder', 'arif@wakeupict.com', '1111', '', 'Moderator', NULL, '$2y$10$WS45d/5q3ZJt8w2/Z56MdegnUSDKA5ocpiIgbgEfVhV5NC0cvuIja', NULL, '2021-10-21 03:45:59', '2021-10-31 03:36:22'),
(36, 'Ariful Sikder1', 'mod1@gmail.com', '1545645646', 'Paid', 'Employee', NULL, '$2y$10$DrFGFdlhQL9g.4US6kcEgOF4gDrLRt.H9OfSfLXeIzFwsF8cD6wHK', NULL, '2021-10-31 03:38:25', '2021-10-31 03:45:41'),
(37, 'some thing12', 'something12@gmail.com', '1234567811112', 'Paid', 'Employee', NULL, '$2y$10$VcBmqWJkgQMAF3KKpbxOz.03CadloOkxerwxhk1pDfZ.1/8sCEB9G', NULL, '2021-10-31 03:47:00', '2021-10-31 04:18:49'),
(38, 'Name', 'Email', 'NID', 'Employee', 'Type', NULL, '$2y$10$GlqViormLTLCzRB3Pitm/O08EbzfVLUC7HwAtM3q5Dw81F60hkFey', NULL, '2021-11-10 03:38:08', '2021-11-10 03:38:08'),
(39, 'Admin inport', 'admin1111@admin.com', '1234545676', 'Paid', 'Admin', NULL, '$2y$10$tWE/hMWTu/NrcDQrDZeKluZQsLa5F5hW48OJjhJWOlx3IJV6BZg66', NULL, '2021-11-10 03:38:08', '2021-11-10 03:38:08');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `development_projects`
--
ALTER TABLE `development_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fontawesomes`
--
ALTER TABLE `fontawesomes`
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
-- Indexes for table `international_works`
--
ALTER TABLE `international_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_projects`
--
ALTER TABLE `local_projects`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admited_students`
--
ALTER TABLE `admited_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blog_contents`
--
ALTER TABLE `blog_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_fassilities`
--
ALTER TABLE `course_fassilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `course_items`
--
ALTER TABLE `course_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_members`
--
ALTER TABLE `course_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `development_projects`
--
ALTER TABLE `development_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fontawesomes`
--
ALTER TABLE `fontawesomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `international_works`
--
ALTER TABLE `international_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `local_projects`
--
ALTER TABLE `local_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sorting_tests`
--
ALTER TABLE `sorting_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
