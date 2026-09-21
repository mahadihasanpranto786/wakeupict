-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 01:38 PM
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
  `file_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(255) NOT NULL,
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
(16, 17, 'স্থান পরিবর্তন:', '1', 'Left side', 'Image', 'Ariful Sikder', 'public/uploads/blog/images/1716767587579917.png', '', '', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 1, 1, '2021-09-04 02:35:52', '2021-11-18 06:05:55'),
(23, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711428755387645.jpg', '', '', '<p><span style=\"background-color:gray;color:black;\"><i><mark class=\"marker-yellow\"><strong>ওয়েব ডেভেলপমেন্ট ক্যারিয়ারঃ</strong></mark></i></span></p><p>&nbsp;</p><p><span style=\"color:black;\">ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</span></p><p><span style=\"color:rgb(112,48,160);\">&nbsp;</span></p><p><span style=\"background-color:gray;\"><i><mark class=\"marker-yellow\"><strong>ওয়েব ডেভেলপমেন্ট কি?</strong></mark></i></span></p><p>একটি ওয়েবসাইটের জন্য সাধারণত অ্যাপ্লিকেশন তৈরি করা&nbsp; হচ্ছে ওয়েব ডেভেলপমেন্ট । যেখানে সাধারণত একজন ওয়েব ডেভেলপার একটি ওয়েবসাইটের জন্য এপ্লিকেশন তৈরি করে থাকেন। আর একজন ওয়েব ডিজাইনার যে ডিজাইন করে থাকুক না কেন তার প্রতিটা উপকরণকে সাধারণত ফাংশনাল করার জন্য পরিচালিত কর্মকাণ্ডই হলো ওয়েব ডেভেলপমেন্ট।</p>', 1, 1, '2021-09-20 07:47:28', NULL),
(24, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1711428821673177.jpg', '', '', '<p>ওয়েব ডেভেলপমেন্টের কাজ শিখতে যা যা লাগবেঃ</p><p>&nbsp;</p><p>১. সাধারণত প্রথমে আপনাকে ওয়েব ডেভেলপমেন্ট কি এবং ডিজাইন কি এই সম্পর্কে ভাল করে জানতে হবে এবং ধারণা রাখতে হবে।অর্থাৎ এক কথায় আপনাকে ব্যাপারটা ভালোভাবে বুঝতে হবে।</p><p>&nbsp;</p><p>২.সাধারণত মার্কেটপ্লেসগুলোতে এই কাজ করে&nbsp; আপনাকে সফল হতে হলে অনেক ধৈর্য শক্তি থাকতে হবে এবং রিসার্চ করার মানসিকতা থাকতে হবে। ।অনেকে আছেন যারা অনেক ভালো কাজ পারেন কিন্তু তাদের ধৈর্য শক্তি কম তারা অনলাইনে ক্যারিয়ার গড়তে ব্যর্থ হয়েছেন। তাই অবশ্যই ধৈর্য ধরে কাজ করতে হবে।কোন কিছূ না বুঝতে পারলে সেটা রিসার্চ করার করার মানসিকতা তৈরি করতে হবে।</p><p>&nbsp;</p><p>&nbsp;</p><p>৩. আপনার সৃজনশীল চিন্তা করার যোগ্যতা থাকতে হবে। তার জন্য&nbsp; আপনাকে প্রচুর পরিমাণে চর্চা করতে হবে। প্রায়&nbsp; সবক্ষেত্রে&nbsp; অবশ্যই এক্ষেত্রে বায়ার বা যে প্রতিষ্ঠানে কাজ করতে চাইবেন তারা আপনার আগের কাজ দেখতে চাইবে। ফলে আপনি যে কাজ গুলো চর্চা করবেন সেগুলোকে তাদের কে দেখাতে পারবেন। এছাড়াও আপনি যখন মার্কেটপ্লেস গুলোতে কাজ করতে থাকবেন আস্তে আস্তে আপনার এই বিষয়গুলো নিয়ে সৃজনশীল চিন্তা&nbsp; তৈরি হয়ে যাবে।</p><p>&nbsp;</p><p>৪.&nbsp; আপনাকে ইংরেজি জানতে হবে তবে এটা মোটামুটি জানলেও চলবে কেননা আপনি যখন বায়ারের সাথে ডিল করবেন তখন এটি আপনাকে সাহায্য করবো। তাদের ভাষা বুঝতে আপনার পক্ষে অনেক সহজ হবে।</p><p>&nbsp;</p><p>&nbsp;</p><p>৫. ওয়েব ডেভেলপমেন্ট এর কাজের জন্য আপনাকে পর্যাপ্ত পরিমানে সময় দিতে হবে। আপনি যদি এখানে সময় দিতে না পারেন তাহলে আপনি কোনদিনও এই কাজ ভালোভাবে করতে পারবেন না বা আপনি সফল হতে পারবেন না। আর সব চেয়ে গুরুত্বপূর্ণ হচ্ছে মাইন্ড সেট করা । আপনাকে এমনভাবে মাইন্ড সেট করতে হবে যে, আপনি প্রতিদিন নিদির্ষ্ট পরিমাণ সময় এখনে দিতে পারেন। আপনাকে প্রতিদিনের লক্ষ্যমাত্রা রাখতে হবে আপনি যেন মিনিমাম ৪-৫ ঘন্টা সময় ব্যয় করতে পারেন । কথায় আছে কষ্ট করলে কেষ্ট মিলে। তাই, সময় দিয়ে শিখুন।</p><p>৬. আপনাকে প্রচুর পরিমাণে পরিশ্রম করতে হবে এখানে। আর ধৈর্যের সাথে কাজ করতে হবে। প্রথম দিকে হয়তো কাজ পেতে কিছৃট বেগ পেতে হতে পারে তখন হতাশ না হয়ে বরং ধৈয্য ধরে আপনার স্কিলগুলোকে ঝালাই করে নিতে হবে।</p><p>&nbsp;</p><p># ওয়েব ডেভেলপার এর ধরণঃ</p><p>১. ফ্রন্টএন্ড ডেভেলপার</p><p>২.&nbsp; ব্যাকএন্ড ডেভেলপার</p><p>৩.&nbsp; ফুলস্ট্যাক ওয়েব ডেভেলপার</p>', 2, 1, '2021-09-20 07:48:31', NULL),
(25, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711428951735719.jpg', '', '', '<p><span style=\"background-color:gray;\"><mark class=\"marker-yellow\">ফ্রন্টএন্ড ডেভেলপার বা ওয়েব ডিজাইনার এর কাজ কি?</mark></span></p><p>ওয়েব ডিজাইন হচ্ছে একটা ওয়েবসাইটের জন্য বাহ্যিক গঠন তৈরী করা। ওয়েব ডিজাইনারের মুল কাজ একটা সাইটের জন্য টেমপ্লেট (ওয়েবপেজ) বানানো, এখানে কোন এপ্লিকেশন থাকবেনা। যেমন লগিন সিস্টেম, নিউজলেটার সাইনআপ, পেজিনেশন, ফাইল আপলোড করে ডেটাবেসে সেভ করা, ইমেজ ম্যানিপুলেশন, যদি সাইটে বিজ্ঞাপণ থাকে তাহলে প্রতিবার পেজ লোড হওয়ার সময় বিজ্ঞাপণের পরিবর্তন এগুলি এপ্লিকেশন, ওয়েব এপ্লিকেশন। এসব তৈরী করতে হয় প্রোগ্রামিং ল্যাংগুয়েজ দিয়ে। কোন প্রকার এপ্লিকেশন ছাড়া একটা সাইট তৈরী করা এটাই ওয়েব ডিজাইন, এধরনের ডিজাইনকে বলা যায় স্টাটিক ডিজাইন। ওয়েব ডিজাইনের জন্য এই ধারনাটি সাধারনত ব্যবহৃত হচ্ছে।</p><p>কে শিখতে পারবে ওয়েব ডিজাইন?</p><p>&nbsp;</p><p>যে কেউ&nbsp;&nbsp; শিখতে পারবে যে নূনতম শিক্ষিত, যার কম্পিটার এর বেসিক নলেজটুকু জানা আছে । এর জন্য এমনটি নয় যে অনেক ইংলিশ ভালো জানতে হবে কিংবা অনেক সফটওয়্যার জানতে হবে।</p><p>ওয়েব ডিজাইন শেখার জন্য যা প্রয়োজন তা হলো:</p><p>&nbsp;</p><p>১.ফটোশপ / ইলাস্ট্রেটর.</p><p>২.এইচ টি এম এল (HTML).</p><p>৩.সি এস এস (CSS)</p><p>&nbsp;</p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ফ্রন্ট-এন্ড ওয়েব ডেভেলপার হিসেবে কাজের সুযোগঃ</mark></span></p><p>ফ্রন্ট-এন্ড ডেভেলপাররা একটি ওয়েবসাইটের লে-আউট, তার ইন্টারেক্টিভ এবং নেভিগেশনাল এলিমেন্ট যেমন বাটনস, স্ক্রলবার, ইমেজ, অভ্যন্তরীণ বিভিন্ন লিংক— এসবকিছু বাস্তবায়িত করেন। বিভিন্ন ব্রাউজার এবং ডিভাইসে ওয়েবসাইট বা অ্যাপ্লিকেশনের যথাযথ প্রদর্শনও নিশ্চিত করেন ফ্রন্ট-এন্ড ডেভেলপার।</p><p>&nbsp;তারা ওয়েবসাইটগুলো এমনভাবে কোড করেন যাতে বিভিন্ন স্ক্রিন সাইজ ও ডিভাইসের ধরনের সাথে সেগুলো এডাপ্টেবল হয়। ফলে ইউজাররাও সবখানে সন্তোষজনক এক্সপেরিয়েন্স পান। এছাড়াও ফ্রন্ট-এন্ড ডেভেলপাররা নিয়মিত ইউজেবিলিটি টেস্ট করা, ফ্রন্ট-এন্ডে কোনো বাগ দেখা দিলে তারা&nbsp; তা ফিক্স করার জন্য&nbsp; কাজ করেন। এই সব কাজ করতে তারা এসইও (সার্চ ইঞ্জিন অপ্টিমাইজেশন),সফটওয়্যার ওয়ার্কফ্লো ম্যানেজমেন্ট — এগুলোও মাথায় রাখেন।</p><p>তবে এক্ষেত্রে বাংলাদেশের প্রেক্ষাপটে&nbsp; থেকে উল্লেখ্য হচ্ছে, এখন পর্যন্ত শুধুমাত্র ফ্রন্ট-এন্ড ডেভেলপার হিসেবে জবের সংখ্যা তুলনা মূলকভাবে বেশ কম লক্ষ্য করা যায়। বিভিন্ন প্রতিষ্ঠানগুলো সাধারণত ফুল-স্ট্যাক ডেভেলপারই নিয়োগ করে থাকেন এবং তাদের মাঝে মাঝে ব্যাক-এন্ড ডেভেলপারও প্রয়োজন হয়। তাই শুধুমাত্র ফ্রন্ট-এন্ড ডেভেলপার হিসেবে বাংলাদেশের বাজারে প্রতিষ্ঠিত হওয়া কিছুটা দুরূহই বলতে হয় এই দিকগুলো&nbsp; পর্যবেক্ষণ করে।</p><p>এর সম্ভাবনাময় দিক গুলো :</p><p>&nbsp;</p><p>একজন ভালো ওয়েব ডিজাইনার এর চাহিদা অনেক বেশি হয়ে থাকে। ওয়েব ডিজাইনার হয়ে কখনো চাকরির জন্য মাসের পর মাস বেকার বসে থাকতে হয় না। আসলে বসে থাকার প্রয়োজন’ও পরে না কারণ এটা আন্তর্জাতিক মানের একটি পেশা। অনলাইন এ ফ্রিলান্সিং কিংবা অফসাইট এ কন্ট্রাকচুয়াল কাজের অনেক সুযোগ এখানে আছে। বছর বছর প্রমোশন না থাকলেও, বেতনের বৃদ্ধির হারটা অনেক উর্ধগতি। এই পেশায় অভিজ্ঞতা দিয়ে আপনার মুল্য বিচার করা হয়। এই পেশায় যার যত বেশি কাজের অভিজ্ঞতা বাড়তে থাকে তার যোগ্যতাও তত বেশি হতে থাকে।</p><p>&nbsp;</p>', 3, 1, '2021-09-20 07:50:35', '2021-09-20 07:54:23'),
(26, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Right side', 'Image', '', 'public/uploads/blog/images/1711429026846589.jpg', '', '', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ব্যাকএন্ড&nbsp; ডেভেলপার বা ওয়েব ডেভেলপার এর কাজ কি?</mark></span><mark class=\"marker-yellow\">&nbsp;</mark></p><p>একজন ফ্রন্টএন্ড ডেভেলপারের ডেভেলপ করা স্ট্যাটিক ওয়েবসাইটে প্রাণসঞ্চার করার কাজটি যিনি ,করেন তিনিই হলেন&nbsp; ব্যাকএন্ড&nbsp; ডেভেলপার। ফ্রন্টএন্ড ডেভেলপারের কাজের উপর ব্যাসেস করে ব্যাকএন্ড&nbsp; ডেভেলপার ওয়েবসাইটকে ডেভেলপ করে থাকেন। এজন্য ফ্রন্টএন্ড&nbsp; ডেভেলপারকে ব্যাকএন্ড&nbsp; সম্পর্কে ধারণা না রাখলেও চলে কিন্তু ব্যাকএন্ড&nbsp; ডেভেলপারকে ফ্রন্টএন্ড সম্পর্কে ধারণা রাখতে হয়। নরমালি একজন ব্যাকএন্ড&nbsp; ডেভেলপার ফ্রন্টএন্ড&nbsp; ডেভেলপা্রের কাছ থেকে একটি ওয়েবসাইট ডিজাইনের কোডগুলো নিয়ে সেটির একটি এডমিন প্যানেল তৈরি করেন। এডমিন প্যানেল তৈরি করার পর সেই ওয়েবসাইটের ডিজাইন পরিবর্তন করার জন্য বা নতুন পোস্ট লেখার জন্য কোডিং করতে হয়না। অর্থাৎ একজন ব্যাকএন্ড&nbsp; ডেভেলপার একটি ওয়েবসাইটকে স্ট্যাটিক ওয়েবসাইটে রূপান্তর করে দেয়। এখানে আপনাকে প্রোগ্রামিং শিখতে হবে। এটাই মুল জিনিস ডেভেলপমেন্টে। মূলত ওয়েব প্রোগ্রামিং যেমন ASP.NET, PHP, Java বা অন্য কোন ল্যাংগুয়েজ। তবে পিএইচপির কাজ বর্তমানে সবচেয়ে বেশি।ওয়েব ডেভেলপমেন্টে প্রোগ্রামিং শেখার পাশাপাশি আপনাকে সংশ্লিষ্ট অনেক কিছু শিখতে হবে। অন্যথায় আপনি আর উপরে উঠতে পারবেন না। যে বিষয়গুলো ভালোভাবে শিখতে হবে:</p><p>১. যে কোন একটি প্রোগ্রামিং ল্যাঙ্গুয়েজ মূলত PHP শিখতে হবে।</p><p>২. মাইসিক্যুয়েল-এর মতো একটি ডাটাবেস ডিজাইনের মাধ্যমে, আপনাকে মধ্যম স্তরের অন্তত একটি পূর্ণাঙ্গ রিলেশনাল ডাটাবেস তৈরি করতে সক্ষম হতে হবে।</p><p>৩. খুবই ভাল কোয়েরি শিখতে হবে। যাতে SQL দিয়ে জটিল কোয়েরি করতে পারতে হবে।</p><p>৪. ফেসবুক / গুগল / টুইটার / আমাজন প্রভৃতি বিখ্যাত সাইটের ওয়েব সার্ভিস / API কীভাবে ব্যবহার করতে হয় তা আপনার জানা উচিত (এক্সএমএল)</p><p>৫. হোস্টিং সম্পর্কে স্পষ্ট ধারণা থাকতে হবে বিশেষ করে সার্ভার ম্যানেজমেন্ট সম্পর্কে ধারনা।</p><p>৬.কিভাবে একাধিক ডেভেলপার একই প্রজেক্টে সোর্স কন্ট্রোল যেমন git, tortoise svn ইত্যাদি দিয়ে কাজ করতে পারে এসব জানতে হবে ।</p><p>৭. এজাক্স, জেকোয়েরি এবং ডেভেলপমেন্ট সংক্রান্ত বিভিন্ন টুলস সম্পর্কে প্রচুর জানতে হবে। যেমন নেটবিনস (কোড লেখার IDE), HeidiSQL, MySQL WorkBench (ডেটাবেস ডিজাইন টুল) এসব জানতে হবে।</p><p>&nbsp;</p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ব্যাক-এন্ড ওয়েব ডেভেলপার হিসেবে কাজের সুযোগঃ</mark></span></p><p>ব্যাক-এন্ড ডেভেলপার ফ্রন্ট-এন্ডকে সচল রাখার জন্য যে ইনফাস্ট্রাকচার দরকার তা তৈরি ও রক্ষণাবেক্ষণ করেন। এর মূলত তিনটি অংশ বলা যায়— সার্ভার, অ্যাপ্লিকেশন, ডেটাবেজ। ব্যাক-এন্ড ডেভেলপারদের দেওয়া কোড সার্ভার অ্যাপ্লিকেশন এবং ডাটাবেসের মধ্যে মসৃণ যোগাযোগ নিশ্চিত করে। তারপর বিভিন্ন ডাটাবেস ম্যানেজমেন্ট টুলস সার্চ, এডিট এবং ডেটা সেভ করে এবং ফ্রন্ট-এন্ডে পাঠায়।ফ্রন্ট-এন্ড ডেভেলপারদের মতো, ব্যাক-এন্ড ডেভেলপাররা তাদের চাহিদা মেটাতে ক্লায়েন্টদের সাথে কাজ করে। ব্যাক-এন্ড ডেভেলপমেন্ট টাস্কগুলি সাধারণত ডেটাবেস তৈরি, সংহত এবং রক্ষণাবেক্ষণ, ব্যাক-এন্ড ফ্রেমওয়ার্ক ব্যবহার করে সার্ভার-সাইড সফটওয়্যার তৈরি, কন্টেন্ট ম্যানেজমেন্ট সিস্টেম তৈরি এবং বাস্তবায়ন এবং ওয়েব সার্ভার প্রযুক্তি এবং অপারেটিং সিস্টেমগুলির সাথে কাজ করে।</p><p>&nbsp;</p><p>বাংলাদেশে ব্যাক-এন্ড ডেভেলপারদের সুযোগ তুলনামূলকভাবে বেশি হলেও নিজেকে ফুল-স্ট্যাক ডেভেলপার হিসেবে তৈরি করতে পারলেই সুযোগ সবচেয়ে বেশি থাকে। যেকোনো প্রতিষ্ঠানের জন্যই ফ্রন্ট-এন্ডের তুলনায় ব্যাক-এন্ড ডেভেলপার বেশি প্রয়োজন হয়। কারণ সেখানে কাজের ক্ষেত্র অনেক বেশি। সেক্ষেত্রে প্রতিষ্ঠানগুলোর জন্য ফুল-স্ট্যাক ডেভেলপার হায়ার করাই বেশি লাভজনক, যেহেতু সেই ডেভেলপার প্রয়োজনমত যেকোনো রোলেই কাজ করতে পারেন।</p>', 4, 1, '2021-09-20 07:51:47', NULL),
(27, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711429087053497.jpg', '', '', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ফুলস্ট্যাক ওয়েব ডেভেলপার এর কাজ কি?</mark></span></p><p>কোন ওয়েবসাইট তৈরি করতে গেলে ওয়েবসাইট ডিজাইন করার পাশাপাশি ওয়েবসাইটের আরও কিছু কাজ করা লাগে। ওয়েবসাইট ডিজাইন করাই ওয়েবসাইট বানানোর ক্ষেত্রে একমাত্র কাজ নয় বরং <span style=\"color:black;\">ওয়েবসাইটের সার্ভারসহ ওয়েবসাইটের কাঠামো তৈরি ওয়েবসাইট তৈরির ক্ষেত্রে অনেক বড় একটি অংশ বহন করে। তাই একটি ওয়েব ডেভেলপারের প্রয়োজন হয় একটি ওয়েবসাইটের কাজের জন্য এবং সেই সাথে একজন ওয়েব ডিজাইনার এবং একজন ফুল-স্ট্যাক ডেভেলপারের কাজ হল ওয়েব ডিজাইন এবং ওয়েব ডেভেলপমেন্টের দুটোর কাজ সম্পূর্ণ করা এবং সমন্বয় করা।</span></p><p><span style=\"color:red;\">&nbsp;</span></p><p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">একজন ফুল স্ট্যাক ডেভেলপার কোথায় কাজ করেন?</mark></span></p><p>ফুল স্ট্যাক ডেভেলপার হলে আপনার কাজের ক্ষেত্র শুধুমাত্র ওয়েবসাইটের কাজের মধ্যেই সীমাবদ্ধ। বর্তমানে ইন্টারনেটের যুগে সবধরনের প্রতিষ্ঠানেরই ওয়েবসাইট প্রয়োজন হয়। তাই ফুল স্ট্যাক ডেভেলপারের কাজের ক্ষেত্র একটি নির্দিষ্ট জায়গায় সীমাবদ্ধ হলেও কাজের ধরনে বেশ বৈচিত্র্য থাকে এবং এক্ষেত্রে সৃষ্টিশীলতা দেখানোর বেশ সুযোগ থাকে। বৈচিত্র্যের সাথে কাজ করতে চান এবং সৃষ্টিশীল কাজের প্রতি আগ্রহী হলে ফুল স্ট্যাক ডেভেলপার হিসেবে আপনি কাজ করতে পারেন।</p><p><span style=\"color:black;\">&nbsp;</span></p><p><span style=\"color:black;\">একটি পূর্ণ স্ট্যাক ওয়েব ডেভেলপার কি উপার্জন করতে পারে?</span></p><p><span style=\"color:black;\">একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কত উপার্জন করবে তা তার কাজের দক্ষতা এবং অভিজ্ঞতার উপর নির্ভর করবে। যাইহোক, দক্ষতার উপর নির্ভর করে, কিছু কোম্পানির ২০,০০০টাকা থেকে ১ লক্ষ টাকা পর্যন্ত সেলারি রয়েছে।</span></p><p>&nbsp;</p><p>একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কি পরিমান উপার্জন করতে পারে?</p><p>একটি ফুল স্ট্যাক ওয়েব ডেভেলপার কত উপার্জন করবে তা তার কাজের দক্ষতা এবং অভিজ্ঞতার উপর নির্ভর করবে। যাইহোক, তবে দক্ষতা ভেদে কিছু কিছু কোম্পানিতে ২০ হাজার টাকা থেকে ১ লাখ টাকা পর্যন্ত সেলারি রয়েছে।</p>', 5, 1, '2021-09-20 07:52:44', NULL),
(28, 32, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'Left side', 'Image', '', 'public/uploads/blog/images/1711429270146527.jpg', '', '', '<p><span style=\"background-color:darkgreen;\"><mark class=\"marker-yellow\">ওয়েব ডেভেলপমেন্ট এর ভবিষ্যৎ চাহিদা :</mark></span></p><p>বর্তমানে ওয়েব ডিজাইন ও ডেভেলপমেন্ট-এর চাহিদা মার্কেট প্লেস গুলোতে অনেক বেশি, সেই সাথে প্রতিনিয়ত বেড়েই চলেছ এবং ভবিষ্যতে আরও বাড়বে এবং বাড়তেই থাকবে।</p><p>ওয়েব ডিজাইন এবং ডেভেলপমেন্টের কাজ শিখেছেন এমন অনেকেই আপওয়ার্ক, ফাইবার, ফ্রিল্যান্সার,&nbsp; পিপলপারআওয়ার সহ আরো অনেক জনপ্রিয় মার্কেটপ্লেসে কাজ করছেন।</p><p>&nbsp;</p><p>&nbsp;</p><p>সাধারণত যতদিন ওয়েবসাইট থাকবে ততদিন ওয়েব ডেভেলপমেন্ট এর চাহিদাও থাকবে। দিনদিন ওয়েবসাইটের সংখ্যা বেড়েই চলেছে। যেমন ধরুন, ২০১৫ হিসাব মতে বিশ্বে মোট ওয়েবসাইট ছিল তখন ৮৬ কোটি তারপরে ২০১৭ সাল নাগাদ এর সংখ্যা বেড়েছে ১১৫ কোটিরও বেশি। দুই বছরের এর পরিমাণ বেড়েছে ৪৩ কোটিরও বেশি। আর বুঝতে বাকি নেই যে বর্তমান বিশ্বে ওয়েব সাইট ডেভলপার বা ওয়েবসাইট ডিজাইনার মূল্য বা চাহিদা কতটা। যেকোনো মার্কেটপ্লেসে একজন ওয়েব ডেভেলপার তার কাজের ধারা অনুযায়ী ঘন্টায় ২০&nbsp; ডলার&nbsp; থেকে একশ ডলার পর্যন্ত ইনকাম করে থাকে। বাংলাদেশে এমন অনেক ফ্রিল্যান্সার রয়েছেন যারা সাধারণত কাজের ধারণা দিয়ে প্রতি ঘণ্টায়&nbsp; কমপক্ষে ১০০ ডলার পর্যন্ত আয় করে থাকে।</p><p>সাধারণত, ওয়েব ডেভেলপমেন্ট বা ওয়েব ডিজাইন কাজের ক্ষেত্রে ফ্রিল্যান্সিংকে সর্বোচ্চ চাকরি বা আয় হিসেবে বিবেচনা করা হয়।</p>', 6, 1, '2021-09-20 07:55:39', NULL),
(37, 36, 'sd', '1', 'Top Three', 'Image', 'iamge alt', 'public/uploads/blog/images/1716766757628370.jpg', 'public/uploads/blog/images/1716673163469807.jpg', 'public/uploads/blog/images/1716766942669406.png', '<p><span style=\"font-family: Poppins, sans-serif;\">ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</span><span style=\"font-family: Poppins, sans-serif; font-size: 1rem;\">ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</span><br></p>', 1, 1, '2021-11-17 05:05:06', '2021-11-18 05:55:40'),
(39, 36, 'sdf', '1', 'Right Three', 'Image', 'Ariful Sikder', 'public/uploads/blog/images/1716768877260812.png', 'public/uploads/blog/images/1716768702304103.png', 'public/uploads/blog/images/1716768702412554.png', '<p><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif;\">ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</span><br></p>', 1, 1, '2021-11-18 06:23:38', '2021-11-18 06:28:22');

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
-- Table structure for table `excel_data`
--

CREATE TABLE `excel_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `excel_name_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash_tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volumn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difficult` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `excel_data`
--

INSERT INTO `excel_data` (`id`, `excel_name_id`, `hash_tag`, `keyword`, `position`, `position_history`, `volumn`, `url`, `difficult`, `cpc`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '6', 'hydrologic pump', '5', '4', '13000', 'https://growace.com/products/hydrologic-stealthro-100-200-booster-pump', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(2, '2', '14', 'sulfur burner', '4', '5', '3800', 'https://growace.com/products/gro1-greenhouse-sulfur-burner-vaporizer', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(3, '2', '36', 'spider farmer sf 4000', '6', '6', '2400', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(4, '2', '39', 'spider farmer 4000', '7', '6', '2600', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(5, '2', '43', 'hydrologic pump', '5', '5', '13000', 'https://growace.com/products/hydrologic-booster-pump', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(6, '2', '53', 'spider farmer', '11', '11', '11000', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '14', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(7, '2', '60', 'spider farmer sf4000', '4', '4', '700', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(8, '2', '61', 'growers choice roi-e720', '7', '8', '1700', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(9, '2', '87', 'growers choice led', '12', '13', '4000', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(10, '2', '92', 'growers choice roi e680', '7', '7', '1300', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(11, '2', '93', 'fox farms ocean forest potting soil', '9', '9', '2000', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(12, '2', '118', 'sf 4000', '9', '9', '1700', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(13, '2', '121', 'roi e680', '6', '8', '800', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(14, '2', '144', 'roi-e720', '7', '8', '900', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(15, '2', '169', 'monkey fan', '5', '7', '500', 'https://growace.com/products/monkey-fan-13w', '0', '0.15', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(16, '2', '176', 'green trees hydroponics', '3', '3', '300', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '8', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(17, '2', '200', '24 hour timers', '14', '17', '3200', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(18, '2', '205', 'greentrees hydroponic', '3', '3', '300', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '0', '1.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(19, '2', '209', 'spider farmer sf-4000 led grow light', '4', '4', '350', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(20, '2', '211', 'spider farmer sf 1000', '9', '6', '1000', 'https://growace.com/products/spider-farmer-sf1000-led-grow-light-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(21, '2', '212', 'fox farm potting soil', '11', '18', '2100', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '1', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(22, '2', '232', 'hlg scorpion diablo', '9', '11', '900', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(23, '2', '247', 'quantum board kits', '5', '5', '250', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(24, '2', '250', 'growers choice master controller', '3', '2', '200', 'https://growace.com/products/grower-s-choice-digital-lighting-master-controller', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(25, '2', '261', 'growers choice 720', '8', '7', '700', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(26, '2', '266', 'gold money counter', '10', '8', '1000', 'https://growace.com/products/dl-gold-bill-counter-limited', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(27, '2', '270', 'growers choice 680', '7', '7', '500', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(28, '2', '274', 'spider farmer sf-4000', '5', '5', '300', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(29, '2', '303', 'hlg 300l rspec', '4', '5', '250', 'https://growace.com/products/horticulture-lighting-group-hlg-300l-r-spec-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(30, '2', '319', 'foxfarm ocean forest potting soil stores', '9', '8', '700', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(31, '2', '326', '6500k led grow light', '5', '4', '300', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-4', '12', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(32, '2', '328', 'growers choice controller', '2', '2', '150', 'https://growace.com/products/grower-s-choice-digital-lighting-master-controller', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(33, '2', '335', 'dwc bucket', '7', '5', '600', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '3', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(34, '2', '353', 'plant cloning kit', '6', '5', '300', 'https://growace.com/products/pro-series-complete-clone-and-rooting-package', '1', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(35, '2', '359', '6 inline duct fans', '6', '12', '250', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '2', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(36, '2', '382', 'light movers', '12', '10', '1800', 'https://growace.com/products/gro1-light-mover', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(37, '2', '385', '6 inch fans', '6', '6', '300', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(38, '2', '391', '6500k grow light', '4', '8', '200', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-4', '14', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(39, '2', '392', 'roi-e420', '6', '10', '300', 'https://growace.com/products/grower-s-choice-roi-e420-horticulture-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(40, '2', '399', '6 inch carbon filter', '6', '8', '350', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '1', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(41, '2', '435', 'hyper logic', '6', '6', '200', 'https://growace.com/products/hydrologic-hyper-logic-commercial-reverse-osmosis-system-2', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(42, '2', '440', 'clone box', '3', '6', '150', 'https://growace.com/products/onedeal-mini-clone-box-2-x2', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(43, '2', '458', 'viparspectra 600w', '11', '13', '900', 'https://growace.com/products/viparspectra-600w-dimmable-series-va1200-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(44, '2', '466', 'inline duct fan 4 inch', '8', '8', '400', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '2', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(45, '2', '498', 'humboldt honey', '5', '3', '250', 'https://growace.com/products/humboldt-honey-es-humboldt-nutrients', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(46, '2', '516', 'grow kits', '2', '2', '3100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '26', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(47, '2', '517', 'grow kits', '2', '2', '3100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '26', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(48, '2', '521', '100 micron screen', '3', '4', '100', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(49, '2', '527', 'bubble magic machine', '7', '6', '500', 'https://growace.com/products/bubble-magic-5-gallon-washing-machine-new-version', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(50, '2', '528', 'tissue culture kit', '11', '11', '500', 'https://growace.com/products/tissue-culture-microclone-kit', '5', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(51, '2', '531', '6 carbon filter', '7', '8', '250', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(52, '2', '532', 'led grow light', '4', '4', '13000', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(53, '2', '533', 'led grow light', '4', '4', '13000', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(54, '2', '538', 'gorilla lighting', '9', '9', '400', 'https://growace.com/products/gorilla-1000w-de-pro-series-hps-cmh-compatible-commercial-grow-light-240v', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(55, '2', '545', 'roi-e680 led grow light', '7', '7', '200', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(56, '2', '548', 'raging kush led', '7', '7', '250', 'https://growace.com/products/scynceled-650w-raging-kush-2-0-led-grow-light-preorder', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(57, '2', '553', 'roi-e680', '8', '7', '300', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(58, '2', '567', 'roi 720', '8', '8', '300', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(59, '2', '578', 'inline duct fan 6 inch', '10', '8', '500', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(60, '2', '586', 'g8 led grow light', '6', '8', '200', 'https://growace.com/products/dorm-grow-680w-g8led-c3-enhanced-full-spectrum-grow-light', '2', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(61, '2', '602', 'autopilot co2 monitor', '5', '5', '150', 'https://growace.com/products/autopilot-desktop-co2-monitor-data-logger', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(62, '2', '603', '6 inch duct fans', '8', '10', '250', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '2', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(63, '2', '606', 'grow light led', '4', '4', '2400', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(64, '2', '607', 'grow light led', '4', '4', '2400', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(65, '2', '611', 'phat filters', '7', '9', '250', 'https://growace.com/products/phat-filter-6-x-20-450-cfm', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(66, '2', '618', 'grow naturally', '6', '6', '150', 'https://growace.com/products/grow-natural-humboldt-nutrients', '15', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(67, '2', '622', '6\" duct fan', '8', '9', '450', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(68, '2', '627', 'magic scissor', '8', '8', '1100', 'https://growace.com/products/scissor-magic-one-handed-scissor-cleaner', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(69, '2', '634', 'scorpion diablo light', '5', '5', '150', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(70, '2', '638', '48x24x60 grow tent', '5', '2', '150', 'https://growace.com/products/48x24x60-ga-reflective-grow-tent', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(71, '2', '640', '5 gallon fabric pots', '11', '10', '800', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '6', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(72, '2', '653', 'grow light hanging kit', '4', '4', '100', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(73, '2', '661', 'growers choice led 720', '10', '8', '400', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(74, '2', '667', 'spider farmer sf1000', '11', '6', '500', 'https://growace.com/products/spider-farmer-sf1000-led-grow-light-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(75, '2', '672', '10 x100', '18', '16', '2400', 'https://growace.com/products/10-x100-7mil-panda-film', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(76, '2', '679', 'fox farm ocean forest soil', '12', '9', '1000', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(77, '2', '683', 'foxfarm ocean forest soil', '8', '15', '200', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(78, '2', '685', '4 inch inline duct fan', '7', '6', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(79, '2', '688', 'viparspectra xs 4000', '6', '4', '150', 'https://growace.com/products/viparspectra-480w-xs-series-xs4000-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(80, '2', '694', '6 inch carbon filters', '9', '8', '250', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(81, '2', '708', 'cooling temperature controller', '6', '6', '150', 'https://growace.com/products/ltl-digital-temperature-controller-cooling', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(82, '2', '709', 'fox farm ocean', '7', '11', '200', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(83, '2', '716', 'active air humidifier', '6', '5', '150', 'https://growace.com/products/active-air-commercial-humidifier-75-pint', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(84, '2', '722', 'led grow lights for sale', '2', '1', '1300', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '35', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(85, '2', '723', 'led grow lights for sale', '2', '1', '1300', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '35', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(86, '2', '728', 'quantum board led grow light', '8', '13', '250', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(87, '2', '729', 'sulfur burners', '7', '6', '200', 'https://growace.com/products/gro1-greenhouse-sulfur-burner-vaporizer', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(88, '2', '733', 'bag trimmer', '20', '17', '3400', 'https://growace.com/products/trim-bag-dry-trimmer-camo', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(89, '2', '737', 'california lightworks uvb', '6', '4', '150', 'https://growace.com/products/california-light-works-solarsystemr-uvb', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(90, '2', '745', 'quantum board led kit', '6', '7', '150', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(91, '2', '748', '4 duct fans', '9', '16', '250', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(92, '2', '749', 'ocean forest potting soil', '9', '8', '600', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '3', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(93, '2', '752', 'active air carbon filter', '5', '5', '100', 'https://growace.com/products/active-air-carbon-filter-10-x-39-1400-cfm', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(94, '2', '762', 'trim bin', '17', '16', '3900', 'https://growace.com/products/trim-bin-complete-set', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(95, '2', '769', '6 inch duct connector', '6', '7', '150', 'https://growace.com/products/6-straight-duct-connector', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(96, '2', '773', 'inline fan 4 inch', '11', '13', '400', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(97, '2', '775', 'duct fan 4 inch', '6', '8', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(98, '2', '797', 'growers choice e720', '8', '8', '200', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '5', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(99, '2', '798', 'light mover', '9', '11', '250', 'https://growace.com/products/gro1-light-mover', '1', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(100, '2', '805', '6 in line duct fan', '10', '15', '250', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(101, '2', '806', '6 duct fans', '10', '14', '250', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '2', '1.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(102, '2', '808', 'bubble magic bags', '5', '4', '100', 'https://growace.com/products/5-gallon-bubble-magic-extraction-bags-set-of-5', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(103, '2', '813', '4 duct fan', '8', '10', '250', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(104, '2', '829', 'cordless grow light', '9', '10', '250', 'https://growace.com/products/cordless-green-led-wall-light-switch-pack-of-12', '13', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(105, '2', '831', 'g10 nutrient', '5', '7', '100', 'https://growace.com/products/gravitation-g10', '0', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(106, '2', '836', '4 inch in line duct fan', '7', '6', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(107, '2', '843', 'complete hydro system', '12', '26', '400', 'https://growace.com/products/4x5ft-complete-perpetual-hid-hydroponic-indoor-grow-tent-system', '8', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(108, '2', '846', 'growers choice 630w cmh', '5', '7', '100', 'https://growace.com/products/grower-s-choice-630w-ns-cmh-horticulture-lighting-fixture-no-bulb', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(109, '2', '847', 'ocean forest', '13', '14', '1400', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '8', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(110, '2', '851', 'spider farmer sf 4000 grow', '7', '7', '150', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(111, '2', '855', 'hlg 65 v2', '5', '5', '100', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(112, '2', '862', '1 gallon grow bags', '11', '11', '350', 'https://growace.com/products/1-gallon-pvc-grow-bags-10-pack', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(113, '2', '866', 'foxfarm potting soil', '12', '13', '900', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(114, '2', '870', 'fox farm ocean forest 1.5 cu ft', '8', '6', '200', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(115, '2', '874', 'root gel', '12', '12', '450', 'https://growace.com/products/dyna-gro-root-gel-2-oz', '1', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(116, '2', '876', '15 gallon grow bag', '9', '23', '250', 'https://growace.com/products/yield-lab-fabric-15-gallon-growing-pots-5-pack', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(117, '2', '879', 'led quantum board', '7', '9', '150', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(118, '2', '888', 'scynce led raging kush', '9', '10', '200', 'https://growace.com/products/scynceled-650w-raging-kush-2-0-led-grow-light-preorder', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(119, '2', '895', '600w ballast', '9', '11', '200', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(120, '2', '900', 'hlg 550 v2', '12', '12', '400', 'https://growace.com/products/horticulture-lighting-group-hlg-550-v2-eco', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(121, '2', '905', 'sulphur burner', '5', '5', '100', 'https://growace.com/products/gro1-greenhouse-sulfur-burner-vaporizer', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(122, '2', '907', 'fox farms ocean forest soil', '14', '10', '600', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(123, '2', '914', 'growers choice 420', '8', '5', '150', 'https://growace.com/products/grower-s-choice-roi-e420-horticulture-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(124, '2', '926', 'bubble washing machine', '9', '9', '200', 'https://growace.com/products/bubble-magic-5-gallon-washing-machine-new-version', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(125, '2', '928', '4 inch fan', '9', '6', '400', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(126, '2', '930', '8 carbon filter', '7', '9', '150', 'https://growace.com/products/active-air-carbon-filter-8-x-39-950-cfm', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(127, '2', '936', '4 inch duct fan', '8', '8', '300', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(128, '2', '938', 'black dog led phytomax-2 600', '6', '7', '100', 'https://growace.com/products/black-dog-phytomax-2-600-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(129, '2', '942', '5 gallon bucket dwc', '6', '5', '100', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '2', '0.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(130, '2', '954', 'killer tea', '8', '6', '150', 'https://growace.com/products/killer-tea', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(131, '2', '955', 'ratchet hangers', '8', '9', '150', 'https://growace.com/products/rope-ratchet-light-hangers-2-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(132, '2', '966', 'carbon filter 10 inch', '9', '9', '150', 'https://growace.com/products/10-x30-charcoal-filter-and-duct-fan-combo-kit', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(133, '2', '968', 'growers choice roi e720', '7', '9', '100', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(134, '2', '979', '2 gallon grow bags', '9', '9', '200', 'https://growace.com/products/2-gallon-pvc-grow-bags-10-pack', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(135, '2', '982', 'cool tube', '4', '5', '100', 'https://growace.com/products/ga-optimal-400w-hps-cool-tube-reflector-digital-grow-light-kit', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(136, '2', '995', 'roi-e720 led', '7', '7', '100', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(137, '2', '997', 'quantum board led', '14', '8', '700', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(138, '2', '1001', 'mixed denomination bill counter', '12', '19', '350', 'https://growace.com/products/mixed-denomination-value-bill-money-currency-counter', '7', '3.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(139, '2', '1002', 'general hydroponics flora series performance pack', '9', '16', '400', 'https://growace.com/products/gh-floraseries-performance-pack', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(140, '2', '1006', 'fan 6 inch', '8', '7', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(141, '2', '1008', 'timer powerstrip', '11', '13', '300', 'https://growace.com/products/120v-8-way-power-strip-w-timer', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(142, '2', '1010', 'g8 led grow lights', '8', '13', '150', 'https://growace.com/products/dorm-grow-680w-g8led-c3-enhanced-full-spectrum-grow-light', '2', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(143, '2', '1022', '220v to 110v adapter plug', '14', '14', '600', 'https://growace.com/products/110v-to-220v-plug-adapter-1', '9', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(144, '2', '1030', 'solar system 1100', '7', '7', '100', 'https://growace.com/products/california-light-works-solarsystemr-1100-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(145, '2', '1035', 'bubble magic pollen tumbler', '10', '10', '200', 'https://growace.com/products/bubble-magic-pollen-tumbler-500-gram', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(146, '2', '1036', '7 gallon fabric pot', '12', '12', '250', 'https://growace.com/products/7-gallon-prune-pots-fabric-grow-pots', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(147, '2', '1045', 'panda film grow tent', '7', '9', '100', 'https://growace.com/products/40-x100-5-5mil-panda-film', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(148, '2', '1050', '600w ballasts', '10', '27', '150', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(149, '2', '1053', 'mylar reflective film', '11', '13', '350', 'https://growace.com/products/sunbounce-reflective-2-mil-reflective-mylar-film-48-in-x-50-ft', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(150, '2', '1057', '8 inch backdraft damper', '8', '7', '100', 'https://growace.com/products/8-backdraft-damper', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(151, '2', '1062', 'ocean forest庐 potting soil', '7', '10', '100', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(152, '2', '1064', 'grow lights for sale', '6', '7', '1700', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '31', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(153, '2', '1065', 'grow lights for sale', '6', '7', '1700', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '31', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(154, '2', '1069', 'ppm testers', '13', '11', '300', 'https://growace.com/products/prestige-ppm-meter', '1', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(155, '2', '1075', 'grow tent complete kit', '5', '5', '1300', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '17', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(156, '2', '1076', 'grow tent complete kit', '5', '4', '1300', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '17', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(157, '2', '1078', 'active air fans', '8', '11', '150', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(158, '2', '1083', '3 gallon fabric pot', '14', '13', '450', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(159, '2', '1094', 'growers choice led 420', '7', '7', '100', 'https://growace.com/products/grower-s-choice-roi-e420-horticulture-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(160, '2', '1102', 'earth juice ph down', '8', '8', '100', 'https://growace.com/products/earth-juice-crystal-ph-down-7-8-lbs', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(161, '2', '1106', '2x4 grow tent yield', '8', '8', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(162, '2', '1109', 'inline duct fan 4\"', '8', '11', '100', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(163, '2', '1115', 'viparspectra p2000', '11', '11', '250', 'https://growace.com/products/viparspectra-200w-pro-series-p2000-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(164, '2', '1117', '4in inline fan', '12', '12', '300', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '2', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(165, '2', '1125', 'growers choice roi 720', '8', '9', '100', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(166, '2', '1126', 'active air fan', '9', '10', '150', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(167, '2', '1128', 'dutch lighting', '10', '10', '200', 'https://growace.com/products/dutch-lighting-innovations-joule-series-1000w-de-fixture-120-240v', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(168, '2', '1131', 'crystal burst', '11', '11', '400', 'https://growace.com/products/crystal-burst-0-15-15', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(169, '2', '1134', '12 inch carbon filter', '8', '8', '100', 'https://growace.com/products/12-x30-purifier-activated-charcoal-filter', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(170, '2', '1149', '6 inch fan', '10', '16', '300', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(171, '2', '1152', '4 inch inline fan quiet', '10', '15', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(172, '2', '1153', 'fox farm organic potting soil', '10', '15', '150', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '5', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(173, '2', '1155', '6 inch duct fan', '10', '7', '350', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(174, '2', '1159', 'top hat grommet', '9', '14', '150', 'https://growace.com/products/3-4-top-hat-rubber-grommet-25-pieces-per-pack', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(175, '2', '1164', 'bubble bags 5 gallon', '12', '20', '250', 'https://growace.com/products/yield-lab-5-gallon-bubble-extraction-bags-4-bag-set', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(176, '2', '1166', '6 inch inline duct fan', '8', '9', '200', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '2', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(177, '2', '1175', 'hydro logic small boy', '9', '12', '150', 'https://growace.com/products/hydrologic-small-boy-dechlorinator-and-sediment-filter', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(178, '2', '1180', 'quantum ballasts', '11', '14', '200', 'https://growace.com/products/quantum-600w-digital-ballast-120-240v-dimmable', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(179, '2', '1184', 'ppm meters', '21', '15', '1900', 'https://growace.com/products/prestige-ppm-meter', '2', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(180, '2', '1187', 'perlite #3', '10', '10', '150', 'https://growace.com/products/perlite-3-4-cu-ft-bags', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(181, '2', '1191', 'dwc buckets', '9', '9', '100', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(182, '2', '1194', 'sulfer burner', '6', '4', '100', 'https://growace.com/products/gro1-greenhouse-sulfur-burner-vaporizer', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(183, '2', '1196', 'ocean farm soil', '9', '12', '100', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '3', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(184, '2', '1197', 'viparspectra 1000w', '8', '8', '100', 'https://growace.com/products/viparspectra-230w-va1000-dimmable-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(185, '2', '1200', 'growers choice e420', '8', '5', '100', 'https://growace.com/products/grower-s-choice-roi-e420-horticulture-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(186, '2', '1214', 'dynagro kln', '9', '14', '100', 'https://growace.com/products/dyna-gro-k-l-n-concentrate', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(187, '2', '1218', '4 inch ducting', '15', '16', '450', 'https://growace.com/products/4-x16-5-39-insulated-foil-ducting-ventilation', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(188, '2', '1221', '220v plug', '20', '24', '4300', 'https://growace.com/products/110v-to-220v-plug-adapter', '6', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(189, '2', '1234', '4\" duct fan', '8', '10', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(190, '2', '1235', 'hps hood', '9', '12', '100', 'https://growace.com/products/yield-lab-professional-series-1000w-air-cool-hood-double-ended-complete-grow-light-kit', '2', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(191, '2', '1242', 'led grow tent kit', '2', '2', '300', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '4', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(192, '2', '1243', 'led grow tent kit', '2', '2', '300', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '4', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(193, '2', '1245', 'tissue culture cloning kit', '9', '10', '100', 'https://growace.com/products/tissue-culture-microclone-kit', '3', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(194, '2', '1246', 'magic dry', '9', '20', '150', 'https://growace.com/products/bubble-magic-dry-trimming-bag', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(195, '2', '1253', '6 inch inline fan', '12', '7', '300', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(196, '2', '1255', 'growers choice roi-e680 review', '9', '9', '100', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(197, '2', '1261', 'spider farmer sf 4000 yield', '11', '9', '150', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(198, '2', '1263', 'led flowering lights', '5', '5', '900', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '15', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(199, '2', '1264', 'led flowering lights', '5', '5', '900', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '15', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(200, '2', '1270', 'reflective tents', '12', '12', '200', 'https://growace.com/products/56x56x78-reflective-grow-tent', '4', '3.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(201, '2', '1277', 'quantum balast', '14', '12', '250', 'https://growace.com/products/quantum-600w-digital-ballast-120-240v-dimmable', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(202, '2', '1278', '6 inline duct fan', '10', '13', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(203, '2', '1280', 'root spa bucket system', '11', '9', '150', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(204, '2', '1281', '6in exhaust fan', '9', '11', '100', 'https://growace.com/products/yield-lab-6-inch-pro-series-fan-with-speed-controller-390-cfm', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(205, '2', '1288', '4 inch carbon filter kit', '9', '9', '100', 'https://growace.com/products/yield-lab-4-inch-190-cfm-charcoal-filter-and-duct-fan-combo-kit', '0', '0.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(206, '2', '1292', 'kind led xl750', '8', '11', '100', 'https://growace.com/products/k5-series-xl750-indoor-led-grow-light', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(207, '2', '1293', 'complete grow tent kit', '4', '4', '900', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(208, '2', '1294', 'complete grow tent kit', '4', '4', '900', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(209, '2', '1298', '600 hps bulb', '14', '13', '250', 'https://growace.com/products/yield-lab-hps-600w-lamp-hid-bulb', '0', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(210, '2', '1305', '1000w ballast', '13', '30', '300', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(211, '2', '1306', 'fox farm ocean forest ingredients', '12', '11', '200', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '3', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(212, '2', '1310', 'growing glasses', '10', '10', '100', 'https://growace.com/products/yield-lab-grow-room-glasses', '1', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(213, '2', '1313', 'grow light mover', '10', '13', '150', 'https://growace.com/products/gro1-light-mover', '1', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(214, '2', '1317', '220v plug adapter', '13', '13', '500', 'https://growace.com/products/110v-to-220v-plug-adapter', '6', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(215, '2', '1320', '600 watt ballasts', '15', '21', '300', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(216, '2', '1333', '400w led grow light', '13', '13', '200', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(217, '2', '1335', '5 gallon cloth pots', '11', '11', '150', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(218, '2', '1338', 'foxfarm ocean forest potting soil', '8', '9', '150', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(219, '2', '1340', 'hlg 260', '14', '20', '250', 'https://growace.com/products/horticulture-lighting-group-260-watt-v2-quantum-board-led-kit', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(220, '2', '1345', 'centurion trimmer', '16', '13', '600', 'https://growace.com/products/centurion-pro-mini-trimmer', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(221, '2', '1350', 'pollen tumbler', '17', '17', '450', 'https://growace.com/products/bubble-magic-pollen-tumbler-500-gram', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(222, '2', '1351', 'fabric pots 3 gallon', '13', '13', '200', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(223, '2', '1352', 'ocean forest soil', '22', '18', '2000', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(224, '2', '1353', '600 watt high pressure sodium lamp', '12', '15', '150', 'https://growace.com/products/yield-lab-hps-600w-lamp-hid-bulb', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(225, '2', '1356', 'cooling controller', '11', '11', '150', 'https://growace.com/products/ltl-digital-temperature-controller-cooling', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(226, '2', '1358', 'adjustable light hangers', '10', '10', '100', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(227, '2', '1362', 'hlg 300', '15', '16', '350', 'https://growace.com/products/horticulture-lighting-group-hlg-300-v2-rspec-full-spectrum-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(228, '2', '1365', 'active air dehumidifier', '10', '10', '100', 'https://growace.com/products/active-air-dehumidifier', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(229, '2', '1372', 'foxfarm ocean forest soil', '14', '14', '300', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '9', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(230, '2', '1374', 'sf1000 led', '13', '18', '150', 'https://growace.com/products/spider-farmer-sf1000-led-grow-light-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(231, '2', '1378', 'x nutrient', '13', '10', '200', 'https://growace.com/products/x-nutrients-mx-clone-gel-4-oz', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(232, '2', '1381', 'drop air', '16', '7', '400', 'https://growace.com/products/dropair-humidifier', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(233, '2', '1383', 'ufo growing lights', '16', '15', '300', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(234, '2', '1384', '4 inch exhaust fan', '12', '12', '400', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(235, '2', '1392', 'dimmable ballast', '9', '28', '150', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '1', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(236, '2', '1394', 'led grow lights for plants', '3', '3', '400', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '37', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(237, '2', '1395', 'led grow lights for plants', '3', '3', '400', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '37', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(238, '2', '1396', 'spider farmer sf-1000', '13', '13', '200', 'https://growace.com/products/spider-farmer-sf1000-led-grow-light-system', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(239, '2', '1398', 'quantum boards', '19', '20', '800', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '2', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(240, '2', '1399', 'scrog kit', '10', '7', '100', 'https://growace.com/products/scrog-kit-19-x25', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(241, '2', '1400', 'bloom natural', '19', '14', '700', 'https://growace.com/products/bloom-natural-humboldt-nutrients', '19', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(242, '2', '1402', 'led grow light viparspectra', '18', '15', '600', 'https://growace.com/products/viparspectra-600w-dimmable-series-va1200-led-grow-light', '22', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(243, '2', '1403', '15 gallon grow bags', '14', '26', '250', 'https://growace.com/products/yield-lab-fabric-15-gallon-growing-pots-5-pack', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(244, '2', '1405', 'carbon filter and fan combo', '10', '10', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-charcoal-filter-and-duct-fan-combo-kit', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(245, '2', '1406', 'micron screen', '10', '6', '150', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '1', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(246, '2', '1410', 'scissor cleaner', '11', '13', '100', 'https://growace.com/products/scissor-magic-one-handed-scissor-cleaner', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(247, '2', '1421', '600 w ballast', '11', '15', '100', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(248, '2', '1426', '4x8 grow tent kit', '11', '8', '100', 'https://growace.com/products/8x4-led-soil-complete-indoor-grow-tent-system', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(249, '2', '1429', '4 inch duct', '10', '10', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(250, '2', '1431', 'all red led grow light', '11', '10', '100', 'https://growace.com/products/50-watt-advance-spectrum-led-grow-light-panel', '3', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(251, '2', '1433', 'led grow light kits', '2', '2', '250', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '12', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(252, '2', '1434', 'led grow light kits', '2', '2', '250', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '12', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(253, '2', '1436', '600 watt hps bulb', '13', '13', '200', 'https://growace.com/products/yield-lab-hps-600w-lamp-hid-bulb', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18');
INSERT INTO `excel_data` (`id`, `excel_name_id`, `hash_tag`, `keyword`, `position`, `position_history`, `volumn`, `url`, `difficult`, `cpc`, `status`, `created_at`, `updated_at`) VALUES
(254, '2', '1438', '600 mh bulb', '13', '18', '150', 'https://growace.com/products/yield-lab-mh-600w-lamp-hid-bulb', '0', '1.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(255, '2', '1442', '110v plug adapter', '11', '11', '100', 'https://growace.com/products/110v-to-220v-plug-adapter-1', '6', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(256, '2', '1445', 'hlg 600 bspec', '18', '30', '500', 'https://growace.com/products/horticulture-lighting-group-600-v2-bspec-full-spectrum-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(257, '2', '1447', 'eva-dry 333', '18', '23', '900', 'https://growace.com/products/eva-dry-e-333-mini-dehumidifier', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(258, '2', '1450', '8 inline fan', '13', '14', '150', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(259, '2', '1466', '4 inch inline fan', '15', '12', '400', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(260, '2', '1467', 'collapsable water tanks', '16', '16', '250', 'https://growace.com/products/grow1-collapsible-reservoir-265-gallon', '1', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(261, '2', '1469', '4 inch inline exhaust fan', '12', '9', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(262, '2', '1470', 'phytomax 2', '12', '12', '150', 'https://growace.com/products/black-dog-phytomax-2-1000-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(263, '2', '1473', 'gorilla grow tent 10x10', '13', '13', '350', 'https://growace.com/products/10-x10-gorilla-grow-tent', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(264, '2', '1474', '4\" inline duct fan', '11', '11', '100', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(265, '2', '1476', '4x6 grow tent', '14', '10', '350', 'https://growace.com/products/lite-line-gorilla-grow-tent-2-x-4-no-extension-kit', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(266, '2', '1477', 'timer power strip', '16', '13', '600', 'https://growace.com/products/120v-8-way-power-strip-w-timer', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(267, '2', '1478', 'power strip with timer', '17', '13', '400', 'https://growace.com/products/120v-8-way-power-strip-w-timer', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(268, '2', '1479', 'hlg 650r led', '12', '12', '100', 'https://growace.com/products/horticulture-lighting-group-hlg-650-v2-rspec-full-spectrum-led-grow-light', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(269, '2', '1482', 'iponic 624', '10', '10', '100', 'https://growace.com/products/iponic-624-environmental-control', '0', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(270, '2', '1493', 'intake filter grow tent', '14', '14', '150', 'https://growace.com/products/phat-hepa-intake-filter-4', '1', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(271, '2', '1496', 'dechlorinator filter', '11', '16', '100', 'https://growace.com/products/hydrologic-small-boy-dechlorinator-and-sediment-filter', '0', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(272, '2', '1507', 'autopilot environmental controller', '12', '12', '100', 'https://growace.com/products/autopilot-eclipse-f90-master-environmental-controller', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(273, '2', '1509', '6\" carbon filter', '13', '11', '150', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(274, '2', '1512', 'complete grow tent kits for soil', '4', '4', '300', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '7', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(275, '2', '1513', 'complete grow tent kits for soil', '4', '4', '300', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '7', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(276, '2', '1515', 'quantum board', '7', '9', '900', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(277, '2', '1517', 'led grow light sale', '1', '1', '100', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '30', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(278, '2', '1518', 'led grow light sale', '1', '1', '100', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '30', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(279, '2', '1519', 'hlg 600', '21', '23', '800', 'https://growace.com/products/horticulture-lighting-group-hlg-600-v2-rspec-full-spectrum-qb-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(280, '2', '1537', 'hlg 135', '14', '16', '150', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(281, '2', '1538', '600w mh bulbs', '14', '19', '150', 'https://growace.com/products/yield-lab-mh-600w-lamp-hid-bulb', '0', '1.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(282, '2', '1542', '4 inch carbon filter', '15', '13', '400', 'https://growace.com/products/yield-lab-4-inch-190-cfm-charcoal-filter-and-duct-fan-combo-kit', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(283, '2', '1563', 'panda film grow room', '14', '17', '150', 'https://growace.com/products/40-x100-5-5mil-panda-film', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(284, '2', '1568', 'grow kit', '7', '2', '1400', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '39', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(285, '2', '1569', 'grow kit', '7', '2', '1400', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '39', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(286, '2', '1572', '8 backdraft damper', '12', '8', '100', 'https://growace.com/products/8-backdraft-damper', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(287, '2', '1574', 'hlg 65', '17', '11', '300', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(288, '2', '1582', 'ufo growing light', '18', '16', '300', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(289, '2', '1589', 'led grow tent kits', '3', '1', '250', 'https://growace.com/products/2x4ft-led-hydro-complete-indoor-grow-tent-system', '4', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(290, '2', '1590', 'led grow tent kits', '3', '1', '250', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '4', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(291, '2', '1595', '1000 watt digital ballasts', '19', '19', '400', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(292, '2', '1600', 'centurion pro mini', '14', '17', '150', 'https://growace.com/products/centurion-pro-mini-trimmer', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(293, '2', '1612', 'inline exhaust fan 4 inch', '12', '19', '100', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(294, '2', '1618', 'co2 monitor and controller', '14', '20', '150', 'https://growace.com/products/autopilot-co2-monitor-controller-w-15-remote-sensor', '1', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(295, '2', '1625', 'spider farmer sf 4000 review', '17', '16', '300', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '8', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(296, '2', '1631', 'gorilla grow tent 8x8', '13', '13', '100', 'https://growace.com/products/gorilla-grow-tent-lite-line-1-extension-kits-8x8', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(297, '2', '1635', '110v power cord', '15', '20', '200', 'https://growace.com/products/110v-power-chord', '2', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(298, '2', '1636', '8 inch carbon filter', '16', '15', '200', 'https://growace.com/products/active-air-carbon-filter-8-x-39-950-cfm', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(299, '2', '1637', 'spider farmer grow light', '23', '26', '1000', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '25', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(300, '2', '1646', 'fox farm ocean forest', '10', '33', '6900', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '4', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(301, '2', '1648', '6in fan', '13', '14', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(302, '2', '1653', 'full spectrum led grow light bar', '14', '14', '150', 'https://growace.com/products/yield-lab-24w-4-foot-2-bulb-t5-led-grow-light-kit-with-stand', '8', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(303, '2', '1656', 'complete led grow tent kits for soil', '3', '3', '250', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(304, '2', '1657', 'complete led grow tent kits for soil', '3', '3', '250', 'https://growace.com/products/2x4ft-led-hydro-complete-indoor-grow-tent-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(305, '2', '1658', 'growers choice led reviews', '13', '13', '100', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(306, '2', '1660', 'complete grow tent', '3', '3', '200', 'https://growace.com/products/pro-series-complete-clone-and-rooting-package', '13', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(307, '2', '1661', 'complete grow tent', '3', '3', '200', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '13', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(308, '2', '1664', '600 watt high pressure sodium lamps', '15', '13', '150', 'https://growace.com/products/yield-lab-hps-600w-lamp-hid-bulb', '0', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(309, '2', '1666', 'mesh pots', '13', '25', '200', 'https://growace.com/products/6-inch-mesh-pot-24-pk', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(310, '2', '1669', 'plug 220v', '14', '14', '150', 'https://growace.com/products/110v-to-220v-plug-adapter', '5', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(311, '2', '1671', 'programmable light timer', '18', '24', '500', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '9', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(312, '2', '1674', 'root spa', '18', '18', '450', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(313, '2', '1675', '600 watt digital ballasts', '16', '17', '150', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(314, '2', '1677', 'led cob grow light', '15', '29', '150', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '4', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(315, '2', '1680', 'dragon alpha', '11', '10', '900', 'https://growace.com/products/scynceled-dragon-alpha-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(316, '2', '1682', 'ufo led grow light', '17', '17', '250', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(317, '2', '1686', 'led growing lights', '4', '4', '400', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(318, '2', '1687', 'led growing lights', '4', '4', '400', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(319, '2', '1689', 'programmable light timer', '17', '16', '600', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '6', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(320, '2', '1690', 'complete grow tents', '4', '4', '400', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(321, '2', '1691', 'complete grow tents', '4', '4', '400', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(322, '2', '1695', 'timer electric', '19', '16', '400', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(323, '2', '1702', 'advance led light', '21', '21', '500', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '10', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(324, '2', '1703', '6 inch inline exhaust fan', '13', '10', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(325, '2', '1705', 'panda film near me', '14', '14', '100', 'https://growace.com/products/10ft-x-10ft-5-5-mil-panda-film', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(326, '2', '1707', '5 gallon hydroponic bucket', '20', '17', '450', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '2', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(327, '2', '1709', 'led grow light for sale', '3', '3', '200', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '31', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(328, '2', '1710', 'led grow light for sale', '3', '3', '200', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '31', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(329, '2', '1713', '48x24x60 grow tent', '5', '5', '150', 'https://growace.com/products/yield-lab-two-door-48x24x60-reflective-grow-tent', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(330, '2', '1718', 'led light grows', '4', '4', '200', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(331, '2', '1719', 'led light grows', '4', '4', '200', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(332, '2', '1720', 'led growlamps', '4', '4', '200', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(333, '2', '1721', 'led growlamps', '4', '4', '200', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(334, '2', '1722', 'led for growing', '9', '9', '800', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '39', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(335, '2', '1723', 'led for growing', '9', '9', '800', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '39', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(336, '2', '1724', '1000 watt ballast', '18', '19', '450', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(337, '2', '1729', '4 inline duct fan', '13', '13', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(338, '2', '1730', 'viparspectra grow light', '19', '19', '350', 'https://growace.com/products/viparspectra-600w-dimmable-series-va1200-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(339, '2', '1734', '1000w digital ballast', '11', '11', '100', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(340, '2', '1735', 'hydro tent', '15', '13', '150', 'https://growace.com/products/8x4-led-hydro-complete-indoor-grow-tent-system', '3', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(341, '2', '1736', 'grow tent packages', '6', '3', '350', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '14', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(342, '2', '1737', 'grow tent packages', '6', '3', '350', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(343, '2', '1738', 'inline fan 6 inch', '15', '9', '150', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(344, '2', '1745', 'mini grow lights', '21', '21', '500', 'https://growace.com/products/crecer-lighting-panthrx-mini-led-grow-light-system', '16', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(345, '2', '1748', 'grow light hangers', '17', '14', '350', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(346, '2', '1751', '1000 w ballast', '17', '15', '200', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(347, '2', '1753', '600 watt digital ballast', '15', '17', '150', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(348, '2', '1757', 'nitrile gloves 100 pack', '17', '17', '200', 'https://growace.com/products/industrial-blue-nitrile-gloves-100-pack', '11', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(349, '2', '1761', 'led grow light panel', '6', '6', '250', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '3', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(350, '2', '1762', 'led grow light panel', '6', '6', '250', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '3', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(351, '2', '1764', '110v to 220v', '18', '18', '400', 'https://growace.com/products/110v-to-220v-plug-adapter', '10', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(352, '2', '1768', 'led grow light glasses', '14', '15', '100', 'https://growace.com/products/yield-lab-grow-room-glasses', '1', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(353, '2', '1775', '8 inline fans', '18', '17', '200', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '1', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(354, '2', '1778', 'tall boy water filter', '15', '11', '150', 'https://growace.com/products/hydrologic-tall-boy-dechlorinator-sediment-filter', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(355, '2', '1785', '5 gallon grow bags', '21', '21', '400', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '4', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(356, '2', '1799', '4\" carbon filter', '14', '13', '100', 'https://growace.com/products/yield-lab-4-inch-purifier-activated-charcoal-filter', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(357, '2', '1803', 'complete indoor soil grow kits', '2', '2', '150', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(358, '2', '1804', 'complete indoor soil grow kits', '2', '2', '150', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(359, '2', '1805', 'fox farm ocean forest review', '15', '16', '100', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '1', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(360, '2', '1814', '2x4 grow tent setup', '18', '18', '250', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(361, '2', '1816', 'stealth ro 300', '17', '17', '200', 'https://growace.com/products/stealth-ro300-reverse-osmosis-filter-300-gpd', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(362, '2', '1822', 'gorilla tent 4x8', '15', '23', '100', 'https://growace.com/products/lite-line-gorilla-grow-tent-4-x-8-no-extension-kit', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(363, '2', '1825', 'grow light glasses', '18', '18', '200', 'https://growace.com/products/yield-lab-grow-room-glasses', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(364, '2', '1826', 'led lighting growing', '5', '5', '200', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(365, '2', '1827', 'led lighting growing', '5', '5', '200', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(366, '2', '1829', 'spider farmer grow tent', '21', '21', '400', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(367, '2', '1832', '6 inline fan', '16', '13', '150', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(368, '2', '1837', 'rosin tech big smash', '17', '17', '150', 'https://growace.com/products/rosin-tech-big-smash-hydraulic-heat-press', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(369, '2', '1839', '600w metal halide bulbs', '17', '20', '150', 'https://growace.com/products/yield-lab-mh-600w-lamp-hid-bulb', '0', '1.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(370, '2', '1845', 'black diamond led grow light', '16', '19', '150', 'https://growace.com/products/ltc-228w-double-black-diamond-v2-led-grow-light', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(371, '2', '1847', 'spider farmer sf 1000 review', '15', '15', '100', 'https://growace.com/products/spider-farmer-sf1000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(372, '2', '1852', 'grow lights timer', '18', '17', '200', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '2', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(373, '2', '1853', 'air carbon filter', '21', '17', '400', 'https://growace.com/products/active-air-carbon-filter-10-x-39-1400-cfm', '4', '1.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(374, '2', '1854', 'phytomax-2 1000', '15', '15', '100', 'https://growace.com/products/black-dog-phytomax-2-1000-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(375, '2', '1861', 'led grow lights panel', '3', '3', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '12', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(376, '2', '1862', 'led grow lights panel', '3', '3', '150', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '12', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(377, '2', '1868', '4 carbon filter', '16', '12', '150', 'https://growace.com/products/yield-lab-4-inch-purifier-activated-charcoal-filter', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(378, '2', '1869', '6 exhaust fan', '15', '15', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(379, '2', '1872', 'grow light systems', '9', '9', '450', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(380, '2', '1873', 'grow light systems', '9', '9', '450', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(381, '2', '1874', 'leds grow lights', '4', '4', '150', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(382, '2', '1875', 'led lights grow lights', '4', '4', '150', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(383, '2', '1876', 'led lights grow lights', '4', '4', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(384, '2', '1877', 'leds grow lights', '4', '4', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(385, '2', '1878', 'viparspectra p1000', '15', '15', '100', 'https://growace.com/products/viparspectra-100w-pro-series-p1000-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(386, '2', '1881', '600 watt ballast', '14', '18', '150', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(387, '2', '1884', '12 inch fan', '24', '24', '1000', 'https://growace.com/products/f5-industrial-12-inch-fan', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(388, '2', '1886', 'quantum board led grow lights', '15', '15', '100', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '5', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(389, '2', '1892', 'grow tent package deals', '4', '4', '150', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(390, '2', '1893', 'grow tent package deals', '4', '4', '150', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(391, '2', '1899', 'inline blower fan', '16', '16', '250', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '2', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(392, '2', '1901', 'complete grow tent kits', '3', '4', '250', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(393, '2', '1902', 'complete grow tent kits', '3', '3', '250', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(394, '2', '1909', 'spider farmer led', '29', '31', '4000', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '26', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(395, '2', '1915', '4x4 grow tent complete kit', '6', '6', '100', 'https://growace.com/products/4x4ft-led-hydro-complete-indoor-grow-tent-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(396, '2', '1926', 'led grow kits', '2', '2', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '7', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(397, '2', '1927', 'led grow kits', '2', '2', '100', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '7', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(398, '2', '1929', 'rosin press nugsmasher', '16', '16', '100', 'https://growace.com/products/nugsmasher-pro-rosin-press', '8', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(399, '2', '1930', 'red led grow light', '19', '12', '200', 'https://growace.com/products/50-watt-advance-spectrum-led-grow-light-panel', '9', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(400, '2', '1931', 'bubble hash kit', '27', '29', '1300', 'https://growace.com/products/32-gallon-bubble-bags-8-bag-set', '8', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(401, '2', '1932', 'dwc kits', '2', '2', '100', 'https://growace.com/products/root-spa-5-gal-4-dwc-bucket-system', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(402, '2', '1933', 'dwc kits', '2', '2', '100', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(403, '2', '1941', 'hlg 600 rspec', '23', '25', '500', 'https://growace.com/products/horticulture-lighting-group-hlg-600-v2-rspec-full-spectrum-qb-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(404, '2', '1947', 'boveda 2-way humidity 62%', '20', '20', '250', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(405, '2', '1957', 'mesh pot', '17', '16', '150', 'https://growace.com/products/6-inch-mesh-pot-24-pk', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(406, '2', '1962', 'complete led grow tent kits', '3', '3', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '5', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(407, '2', '1963', 'complete led grow tent kits', '3', '3', '100', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '5', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(408, '2', '1970', '6\" inline fan', '15', '10', '200', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(409, '2', '1976', '15 gallon fabric pots', '16', '34', '100', 'https://growace.com/products/yield-lab-fabric-15-gallon-growing-pots-5-pack', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(410, '2', '1980', '4ft t5 bulbs', '16', '16', '100', 'https://growace.com/products/lightech-4ft-4-bulb-t5-fluorescent-light-grow-bulbs', '3', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(411, '2', '1986', 'grow sunglasses', '19', '19', '200', 'https://growace.com/products/yield-lab-grow-room-glasses', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(412, '2', '1990', 'deep water culture kit', '6', '6', '200', 'https://growace.com/products/grow1-deep-water-culture-dwc-4-bucket-reservoir-complete-kit', '2', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(413, '2', '1991', 'deep water culture kit', '6', '6', '200', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '2', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(414, '2', '1992', 'scorpion lights', '20', '19', '250', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(415, '2', '1993', '6 inch backdraft damper', '17', '14', '100', 'https://growace.com/products/4-backdraft-damper', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(416, '2', '1994', 'nugsmasher pro', '21', '19', '500', 'https://growace.com/products/nugsmasher-pro-rosin-press', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(417, '2', '1998', 'trim bins', '18', '18', '300', 'https://growace.com/products/trim-bin-complete-set', '2', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(418, '2', '1999', 'sulfur burner powdery mildew', '17', '15', '100', 'https://growace.com/products/gro1-greenhouse-sulfur-burner-vaporizer', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(419, '2', '2006', '3x4 grow tent', '20', '20', '250', 'https://growace.com/products/yield-lab-48-x-36-x-80-2-in-1-full-cycle-reflective-grow-tent', '9', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(420, '2', '2009', 'hlg scorpion', '21', '21', '300', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(421, '2', '2010', 'dwc reservoir', '17', '12', '100', 'https://growace.com/products/grow1-deep-water-culture-dwc-4-bucket-reservoir-complete-kit', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(422, '2', '2015', '4in ducting', '24', '20', '500', 'https://growace.com/products/4-x16-5-39-insulated-foil-ducting-ventilation', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(423, '2', '2020', 'spider led grow light', '23', '23', '450', 'https://growace.com/products/spider-farmer-sf1000-led-grow-light-system', '14', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(424, '2', '2021', 'dwc bucket kit', '4', '4', '100', 'https://growace.com/products/root-spa-5-gal-4-dwc-bucket-system', '2', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(425, '2', '2022', 'dwc bucket kit', '4', '4', '100', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '2', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(426, '2', '2025', '3 gallon grow bags', '20', '20', '350', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(427, '2', '2033', 'led grow light system', '3', '3', '100', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '40', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(428, '2', '2034', 'led grow light system', '3', '3', '100', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '40', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(429, '2', '2039', 'grow kits with lights', '3', '3', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(430, '2', '2040', 'grow kits with lights', '3', '3', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(431, '2', '2048', 'centurion pro trimmer', '24', '22', '700', 'https://growace.com/products/centurion-pro-mini-trimmer', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(432, '2', '2049', 'steel duct clamp', '17', '17', '100', 'https://growace.com/products/12-stainless-steel-duct-clamp', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(433, '2', '2050', 'duct clamps', '22', '22', '500', 'https://growace.com/products/4-stainless-duct-clamps-2-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(434, '2', '2056', '4 light controller', '17', '17', '100', 'https://growace.com/products/yield-lab-4-outlet-120v-240v-grow-light-relay-controller', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(435, '2', '2060', 'rosinbomb m50', '19', '13', '150', 'https://growace.com/products/rosinbomb-m-50-electric-heat-press', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(436, '2', '2067', 'grow tent complete setup', '5', '5', '150', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(437, '2', '2068', 'grow tent complete setup', '5', '6', '150', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(438, '2', '2069', 'grow glasses', '20', '14', '200', 'https://growace.com/products/yield-lab-grow-room-glasses', '0', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(439, '2', '2070', 'complete indoor grow tent kits', '4', '4', '100', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(440, '2', '2071', 'complete indoor grow tent kits', '4', '3', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '14', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(441, '2', '2076', '8 inch duct fan', '20', '24', '200', 'https://growace.com/products/8-inch-720-cfm-high-output-in-line-duct-fan', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(442, '2', '2082', 'led grow tent', '6', '6', '300', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '5', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(443, '2', '2083', 'led grow tent', '6', '6', '300', 'https://growace.com/products/2x4ft-led-hydro-complete-indoor-grow-tent-system', '5', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(444, '2', '2087', 'quiet duct fan', '19', '18', '100', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '2', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(445, '2', '2096', 'hydrologic reverse osmosis', '17', '17', '100', 'https://growace.com/products/hydrologic-replacement-filter-for-stealthro-reverse-osmosis', '1', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(446, '2', '2099', '6in duct booster fan', '17', '17', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(447, '2', '2100', 'eva dry 333', '23', '24', '400', 'https://growace.com/products/eva-dry-e-333-mini-dehumidifier', '4', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(448, '2', '2103', '10 by 10 grow tent', '19', '17', '150', 'https://growace.com/products/onedeal-grow-tent-10-x-10-x-6-5', '3', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(449, '2', '2105', 'in-line duct booster fan', '18', '18', '100', 'https://growace.com/products/yield-lab-6-booster-in-line-duct-fan', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(450, '2', '2107', 'bubble magic 20 gallon', '20', '13', '200', 'https://growace.com/products/bubble-magic-all-mesh-extraction-bags-20-gallon-5-bag-kit', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(451, '2', '2109', 'tall humidity dome', '17', '22', '100', 'https://growace.com/products/yield-lab-7-inch-propagation-domes-5-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(452, '2', '2110', 'grow tent starter kit', '4', '4', '100', 'https://growace.com/products/2x4ft-hid-hydro-complete-indoor-grow-tent-system', '13', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(453, '2', '2111', 'grow tent starter kit', '4', '4', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '13', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(454, '2', '2112', 'stealth ro 150', '21', '17', '250', 'https://growace.com/products/hydro-logic-stealth-ro150-reverse-osmosis-filter', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(455, '2', '2115', 'rope light hangers', '26', '25', '700', 'https://growace.com/products/rope-ratchet-light-hangers-2-pack', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(456, '2', '2135', 'spectrum king closet case', '4', '7', '350', 'https://growace.com/products/spectrum-king-closet-case-140w-v2-led-grow-light-system', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(457, '2', '2139', '1000 led grow lights', '12', '12', '500', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '5', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(458, '2', '2140', '1000 led grow lights', '12', '12', '500', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '5', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(459, '2', '2144', 'glass extraction tube', '13', '13', '450', 'https://growace.com/products/glass-concentrate-extraction-tube-18-inches-l', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(460, '2', '2146', 'adjust a wing', '19', '19', '100', 'https://growace.com/products/adjust-a-wing-enforcer-large', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(461, '2', '2149', '10x10 grow tent', '24', '19', '1300', 'https://growace.com/products/onedeal-grow-tent-10-x-10-x-6-5', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(462, '2', '2158', 'centurion tabletop pro trimmer', '20', '20', '150', 'https://growace.com/products/centurion-pro-table-top-trimmer-wet-dry', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(463, '2', '2159', 'foxfarm ocean forest potting soil reviews', '23', '23', '300', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(464, '2', '2163', 'curved trimming scissors', '20', '20', '150', 'https://growace.com/products/piranha-pruner-trimming-scissors-curved-titanium-blade', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(465, '2', '2165', 'optic 8 led', '22', '22', '250', 'https://growace.com/products/optic-8-dimmable-cob-led-grow-light-500w-uv-ir-3500k-cobs-90-degree-lenses-4x4', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(466, '2', '2167', 'electric timer', '17', '14', '2300', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '15', '1.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(467, '2', '2169', 'ppm reader', '13', '13', '100', 'https://growace.com/products/prestige-ppm-meter', '2', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(468, '2', '2182', '10 x 10 grow tent', '22', '26', '250', 'https://growace.com/products/onedeal-grow-tent-10-x-10-x-6-5', '2', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(469, '2', '2184', 'duct clamp', '20', '20', '450', 'https://growace.com/products/4-stainless-duct-clamps-2-pack', '0', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(470, '2', '2185', '8\" inline duct fan', '16', '22', '100', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(471, '2', '2186', 'trim bag', '25', '25', '900', 'https://growace.com/products/trim-bag-dry-trimmer-camo', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(472, '2', '2188', '600w hps bulb', '17', '13', '150', 'https://growace.com/products/yield-lab-hps-600w-lamp-hid-bulb', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(473, '2', '2195', 'complete hydro grow kit', '6', '6', '150', 'https://growace.com/products/8x4-led-hydro-complete-indoor-grow-tent-system', '9', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(474, '2', '2196', 'complete hydro grow kit', '6', '6', '150', 'https://growace.com/products/2x4ft-led-hydro-complete-indoor-grow-tent-system', '9', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(475, '2', '2198', 'quiet inline duct fan', '18', '16', '150', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(476, '2', '2203', 'led flowering grow lights', '7', '7', '150', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '25', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(477, '2', '2204', 'led flowering grow lights', '7', '7', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '25', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(478, '2', '2206', 'inline booster fan', '16', '26', '200', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '6', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(479, '2', '2210', 'grow tent trellis', '20', '26', '150', 'https://growace.com/products/grow1-5-x60-trellis-netting-3-5-x3-5-squares', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(480, '2', '2211', 'air pots 5 gallon', '24', '25', '350', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(481, '2', '2212', '8 light controller', '22', '22', '200', 'https://growace.com/products/autopilot-8-light-high-power-hid-controller-8000w-120-240v-60a-x-plug', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(482, '2', '2214', '1000 watt digital ballast', '13', '41', '100', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(483, '2', '2220', 'led growing', '8', '8', '200', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(484, '2', '2221', 'led growing', '8', '8', '200', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(485, '2', '2225', '2x4 grow light', '20', '20', '150', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(486, '2', '2228', 'green led light bulb', '23', '23', '250', 'https://growace.com/products/gro1-green-led-light-bulb-w-remote', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(487, '2', '2233', '120v timer', '19', '19', '250', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '0', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(488, '2', '2240', 'ufo grow light', '18', '18', '150', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(489, '2', '2243', '6500k light', '26', '27', '1600', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-4', '7', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(490, '2', '2255', '600 digital ballast', '20', '24', '100', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(491, '2', '2256', 'grow kit with light', '7', '10', '150', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '15', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(492, '2', '2257', 'grow kit with light', '7', '10', '150', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '15', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(493, '2', '2263', 'hydrologic stealth ro', '22', '22', '200', 'https://growace.com/products/hydro-logic-stealth-ro150-reverse-osmosis-filter', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(494, '2', '2265', 'cob led grow lights', '19', '19', '100', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '4', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(495, '2', '2267', '12 inline fan', '20', '22', '150', 'https://growace.com/products/active-air-12-inline-duct-fan-969-cfm', '0', '1.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(496, '2', '2288', 'zipper tarp', '22', '62', '200', 'https://growace.com/products/6-5-39-tarp-zipper', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(497, '2', '2293', 'grow with leds', '9', '9', '150', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(498, '2', '2294', 'grow with leds', '9', '9', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(499, '2', '2296', '4\" inline fan', '25', '25', '400', 'https://growace.com/products/active-air-4-inline-duct-fan-165-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(500, '2', '2298', 'power strip timer', '15', '13', '100', 'https://growace.com/products/120v-8-way-power-strip-w-timer', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(501, '2', '2299', 'grow hm', '23', '23', '250', 'https://growace.com/products/hm-ph-pen-meter', '15', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(502, '2', '2306', 'complete grow tent kits cheap', '5', '5', '100', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '9', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18');
INSERT INTO `excel_data` (`id`, `excel_name_id`, `hash_tag`, `keyword`, `position`, `position_history`, `volumn`, `url`, `difficult`, `cpc`, `status`, `created_at`, `updated_at`) VALUES
(503, '2', '2307', 'complete grow tent kits cheap', '5', '5', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '9', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(504, '2', '2309', 'cheapest grow tent kit', '8', '8', '150', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '10', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(505, '2', '2310', 'cheapest grow tent kit', '8', '8', '150', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '10', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(506, '2', '2315', '220 micron bag', '21', '21', '150', 'https://growace.com/products/20-gallon-220-micron-zipper-washing-bag', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(507, '2', '2322', 'gorilla light', '26', '31', '400', 'https://growace.com/products/gorilla-1000w-de-pro-series-hps-cmh-compatible-commercial-grow-light-240v', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(508, '2', '2325', '8 inch duct fans', '22', '22', '150', 'https://growace.com/products/8-inch-720-cfm-high-output-in-line-duct-fan', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(509, '2', '2333', 'light hangers', '18', '19', '300', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '1', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(510, '2', '2335', 'coarse perlite', '27', '27', '450', 'https://growace.com/products/plant-t-super-coarse-perlite-100-l-3-53-cu-ft', '10', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(511, '2', '2341', '1000w mh bulb', '20', '25', '100', 'https://growace.com/products/yield-lab-double-ended-1000w-mh-grow-light-bulb', '0', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(512, '2', '2346', 'air duct fan', '26', '26', '450', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '3', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(513, '2', '2354', 'dyna gro kln', '19', '16', '100', 'https://growace.com/products/dyna-gro-k-l-n-concentrate', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(514, '2', '2355', '240v power cords', '20', '20', '100', 'https://growace.com/products/14-gauge-240v-power-cord-15', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(515, '2', '2356', 'hlg 650r', '36', '36', '3500', 'https://growace.com/products/horticulture-lighting-group-hlg-650-v2-rspec-full-spectrum-led-grow-light', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(516, '2', '2357', 'viparspectra led', '20', '20', '150', 'https://growace.com/products/viparspectra-600w-dimmable-series-va1200-led-grow-light', '3', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(517, '2', '2368', '3 gallon grow pots', '22', '21', '150', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '3', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(518, '2', '2370', 'co2 bags', '30', '31', '1500', 'https://growace.com/products/ez-co2-homegrown-co2', '4', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(519, '2', '2378', 'viparspectra v600', '22', '22', '150', 'https://growace.com/products/viparspectra-260w-vs600-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(520, '2', '2383', 'spider farmer 4000 review', '21', '21', '100', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(521, '2', '2395', 'inline duct booster fan', '28', '23', '700', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '3', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(522, '2', '2397', '220 adapter to 110', '29', '22', '700', 'https://growace.com/products/110v-to-220v-plug-adapter', '12', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(523, '2', '2400', 'grow tent packages deals', '7', '7', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '9', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(524, '2', '2401', 'grow tent packages deals', '7', '7', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '9', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(525, '2', '2403', 'outlet relay', '21', '21', '100', 'https://growace.com/products/yield-lab-4-outlet-120v-240v-grow-light-relay-controller', '8', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(526, '2', '2405', 'cob grow light', '29', '18', '700', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '4', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(527, '2', '2411', 'horticultural lighting group', '35', '35', '2600', 'https://growace.com/products/horticulture-lighting-group-hlg-30-uva-supplement-led-bar-light', '15', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(528, '2', '2414', 'hlg 260 xl', '22', '22', '100', 'https://growace.com/products/horticulture-lighting-group-260-watt-v2-quantum-board-led-kit', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(529, '2', '2431', 'grow king', '22', '22', '150', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(530, '2', '2433', '4x4 grow tent yield', '26', '26', '300', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(531, '2', '2436', '240v timer', '22', '27', '200', 'https://growace.com/products/240v-single-outlet-mechanical-timer', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(532, '2', '2439', 'hydro logic stealth ro 150', '21', '16', '100', 'https://growace.com/products/hydro-logic-stealth-ro150-reverse-osmosis-filter', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(533, '2', '2444', 'viparspectra led grow lights', '22', '22', '250', 'https://growace.com/products/viparspectra-600w-dimmable-series-va1200-led-grow-light', '21', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(534, '2', '2445', '6 inch exhaust fan', '28', '28', '400', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(535, '2', '2450', '120 micron screen', '21', '22', '100', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(536, '2', '2451', '8x8 gorilla grow tent', '22', '18', '100', 'https://growace.com/products/gorilla-grow-tent-lite-line-1-extension-kits-8x8', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(537, '2', '2467', 'hlg diablo', '26', '26', '300', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(538, '2', '2473', '5 gallon grow pot', '24', '19', '200', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(539, '2', '2475', 'dual outlet timer', '22', '21', '100', 'https://growace.com/products/120v-dual-outlet-digital-timer', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(540, '2', '2479', 'lab tray', '25', '31', '200', 'https://growace.com/products/yield-lab-10-x-20-inch-propagation-tray-5-pack', '0', '3.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(541, '2', '2481', 'large grow lights', '11', '11', '200', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '33', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(542, '2', '2482', 'large grow lights', '11', '11', '200', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '33', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(543, '2', '2483', '220 plug adapter', '27', '23', '800', 'https://growace.com/products/110v-to-220v-plug-adapter', '8', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(544, '2', '2490', '5 gallon bubble bags', '22', '22', '100', 'https://growace.com/products/yield-lab-5-gallon-bubble-extraction-bags-3-bag-set', '1', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(545, '2', '2492', 'dimmable balast', '28', '30', '350', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '1', '1.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(546, '2', '2493', 'how long does fox farm ocean forest last', '23', '23', '150', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(547, '2', '2494', 'led grow panel', '8', '8', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '9', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(548, '2', '2495', 'led grow panel', '8', '8', '150', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '9', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(549, '2', '2499', 'quantum led grow light', '24', '24', '150', 'https://growace.com/products/horticulture-lighting-group-100-v2-qb192-quantum-board-led-kit', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(550, '2', '2504', 'light-switch cordless light', '24', '34', '150', 'https://growace.com/products/cordless-green-led-wall-light-switch-pack-of-12', '0', '0.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(551, '2', '2513', '5 gallon grow bag', '29', '32', '600', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '3', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(552, '2', '2515', '8 duct fan', '26', '18', '250', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(553, '2', '2518', 'optic led', '33', '57', '2200', 'https://growace.com/products/optic-led-grow-light-optic-8p-120-degree-led-grow-light-system', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(554, '2', '2519', '10x10 grow tent yield', '22', '22', '100', 'https://growace.com/products/onedeal-grow-tent-10-x-10-x-6-5', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(555, '2', '2521', '5 gallon bucket hydroponic system', '20', '20', '100', 'https://growace.com/products/root-spa-5-gal-dwc-bucket-system', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(556, '2', '2523', '6500k led', '25', '35', '400', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-4', '5', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(557, '2', '2526', 'active aqua air pumps', '27', '41', '250', 'https://growace.com/products/active-aqua-dual-diaphragm-air-pump', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(558, '2', '2527', 'bubble washing', '27', '47', '250', 'https://growace.com/products/bubble-magic-5-gallon-washing-machine-new-version', '0', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(559, '2', '2528', 'ppm meter', '31', '21', '1800', 'https://growace.com/products/prestige-ppm-meter', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(560, '2', '2531', 'led protection glasses', '23', '42', '150', 'https://growace.com/products/yield-lab-grow-room-glasses', '1', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(561, '2', '2541', '600 watt mh bulbs', '24', '23', '150', 'https://growace.com/products/yield-lab-double-ended-600w-mh-grow-light-bulb', '0', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(562, '2', '2547', '3 gal grow bags', '22', '21', '100', 'https://growace.com/products/3-gallon-pvc-grow-bags-10-pack', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(563, '2', '2551', 'dynagro foliage pro', '28', '28', '350', 'https://growace.com/products/dyna-gro-foiliage-pro-9-3-6', '0', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(564, '2', '2568', 'mixed bill counter', '21', '31', '150', 'https://growace.com/products/mixed-denomination-value-bill-money-currency-counter', '11', '3.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(565, '2', '2570', 'oscillating grow tent fan', '25', '25', '150', 'https://growace.com/products/monkey-fan-oscillating-20w', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(566, '2', '2574', 'duct fan booster', '27', '19', '250', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '7', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(567, '2', '2580', '12 duct fan', '23', '23', '100', 'https://growace.com/products/active-air-12-inline-duct-fan-969-cfm', '0', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(568, '2', '2581', 'oscillating fan for grow tent', '30', '26', '500', 'https://growace.com/products/monkey-fan-oscillating-20w', '3', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(569, '2', '2584', 'optic led grow lights', '26', '26', '200', 'https://growace.com/products/optic-led-grow-light-optic-8p-120-degree-led-grow-light-system', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(570, '2', '2588', 'quick disconnect for water hose', '29', '29', '350', 'https://growace.com/products/hydrologic-quick-disconnect-1-2-x-garden-hose-adapter', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(571, '2', '2601', 'hm grow', '24', '26', '150', 'https://growace.com/products/hm-ec-tds-temp-combo-meter', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(572, '2', '2602', '150 micron screen', '27', '27', '250', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(573, '2', '2609', 'led phantom', '26', '26', '250', 'https://growace.com/products/phantom-440w-pheno-100-277v-mp-led-grow-light', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(574, '2', '2612', 'drying net', '27', '57', '250', 'https://growace.com/products/yield-lab-2ft-herbal-hanging-dry-net-without-clips', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(575, '2', '2620', 'best 2x4 led grow light', '23', '23', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '12', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(576, '2', '2622', 'quick disconnect for garden hose', '31', '22', '600', 'https://growace.com/products/hydrologic-quick-disconnect-1-2-x-garden-hose-adapter', '3', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(577, '2', '2626', 'clone x', '22', '22', '250', 'https://growace.com/products/x-nutrients-mx-clone-gel-4-oz', '7', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(578, '2', '2633', 'electrical tap', '27', '27', '450', 'https://growace.com/products/electrical-tap-1-300-mcm-6-2-sml', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(579, '2', '2634', 'photo bio led', '13', '13', '100', 'https://growace.com/products/photobio-330w-t-100-277v-s4-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(580, '2', '2636', 'fox farm ocean forest 3 cu ft', '25', '18', '150', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(581, '2', '2641', 't5 light fixtures 4ft', '25', '31', '150', 'https://growace.com/products/doublelux-4ft-12-bulb-t5-fluorescent-light', '5', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(582, '2', '2650', '220v adapter', '26', '29', '500', 'https://growace.com/products/110v-to-220v-plug-adapter', '9', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(583, '2', '2660', '3 gallon air pot', '27', '13', '200', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(584, '2', '2666', 'sulpher burners', '25', '18', '150', 'https://growace.com/products/gro1-greenhouse-sulfur-burner-vaporizer', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(585, '2', '2672', '6500k light led', '26', '26', '150', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-4', '7', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(586, '2', '2677', 'adapter 220v to 110v', '26', '33', '150', 'https://growace.com/products/110v-to-220v-plug-adapter', '4', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(587, '2', '2683', '4 inline fan', '24', '24', '100', 'https://growace.com/products/active-air-4-inline-duct-fan-165-cfm', '1', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(588, '2', '2685', '12 in inline fan', '24', '19', '100', 'https://growace.com/products/active-air-12-inline-duct-fan-969-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(589, '2', '2695', 'heavy duty greenhouse', '30', '27', '600', 'https://growace.com/products/grow1-heavy-duty-greenhouse-hoop-house', '30', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(590, '2', '2702', 'drip system hydroponics', '29', '30', '250', 'https://growace.com/products/10-pot-hydroponic-versagrow-system', '3', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(591, '2', '2706', 'viparspectra 600w led review', '26', '31', '150', 'https://growace.com/products/viparspectra-600w-dimmable-series-va1200-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(592, '2', '2710', 'led veg lights', '13', '13', '150', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '0', '1.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(593, '2', '2711', 'led veg lights', '13', '13', '150', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '0', '1.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(594, '2', '2712', 'tiresias mist', '25', '12', '150', 'https://growace.com/products/tiresias-mist-1oz-bottle', '0', '0.15', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(595, '2', '2714', 'grow tent hydroponic system', '12', '12', '100', 'https://growace.com/products/2x4ft-led-soil-complete-indoor-grow-tent-system', '7', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(596, '2', '2715', 'grow tent hydroponic system', '12', '12', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '7', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(597, '2', '2721', '110 220v adapter', '27', '29', '150', 'https://growace.com/products/110v-to-220v-plug-adapter', '10', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(598, '2', '2733', '30 gallon fabric pots', '25', '14', '100', 'https://growace.com/products/30-gallon-prune-pots-fabric-grow-pots', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(599, '2', '2740', 'spectrum grow lights', '32', '32', '450', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '27', '1.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(600, '2', '2742', 'cordless wall light', '26', '26', '100', 'https://growace.com/products/cordless-green-led-wall-light-switch-pack-of-12', '4', '1.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(601, '2', '2744', 'co2 grow bags', '27', '28', '150', 'https://growace.com/products/ez-co2-homegrown-co2', '3', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(602, '2', '2750', 'air pot 3 gallon', '25', '25', '100', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(603, '2', '2760', 'mechanical light timer', '27', '23', '150', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '28', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(604, '2', '2764', 'where to buy fox farm ocean forest soil', '30', '30', '250', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '3', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(605, '2', '2767', 'large led grow lights', '12', '12', '100', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '38', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(606, '2', '2768', 'large led grow lights', '12', '12', '100', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '38', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(607, '2', '2769', '10 gallon fabric pots', '32', '44', '450', 'https://growace.com/products/yield-lab-fabric-10-gallon-growing-pots-5-pack', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(608, '2', '2789', 'ocean forest fox farm', '27', '10', '150', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '1', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(609, '2', '2795', '15 gallon fabric pot', '28', '28', '150', 'https://growace.com/products/yield-lab-fabric-15-gallon-growing-pots-5-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(610, '2', '2799', 'light hanger', '24', '12', '150', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(611, '2', '2810', 'mini grow light', '22', '18', '100', 'https://growace.com/products/crecer-lighting-panthrx-mini-led-grow-light-system', '14', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(612, '2', '2811', 'tarp zipper', '30', '34', '400', 'https://growace.com/products/6-5-39-tarp-zipper', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(613, '2', '2815', 'centurion pro', '31', '23', '350', 'https://growace.com/products/centurion-pro-mini-trimmer', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(614, '2', '2818', 'ppm tester', '31', '31', '450', 'https://growace.com/products/prestige-ppm-meter', '1', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(615, '2', '2820', '8\" duct fan', '29', '17', '100', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(616, '2', '2823', 'carbon fiber filter', '26', '26', '100', 'https://growace.com/products/phat-charcoal-fiber-odor-filter-8', '3', '1.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(617, '2', '2825', 'trim tray', '35', '35', '1000', 'https://growace.com/products/trim-tray-200-micron-tray-top-black', '1', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(618, '2', '2829', 'hlg scorpion', '21', '21', '300', 'https://growace.com/products/horticulture-lighting-group-600w-scorpion-r-spec-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(619, '2', '2832', 'clip on fan for grow tent', '27', '27', '100', 'https://growace.com/products/6-desk-clip-fan', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(620, '2', '2834', 'king led lights', '31', '34', '300', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '3', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(621, '2', '2845', '220 v plug', '26', '26', '250', 'https://growace.com/products/110v-to-220v-plug-adapter', '9', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(622, '2', '2847', 'dyna gro foliage pro', '33', '33', '450', 'https://growace.com/products/dyna-gro-foiliage-pro-9-3-6', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(623, '2', '2855', '60\" x 80\"', '19', '36', '100', 'https://growace.com/products/yield-lab-60-x-48-x-80-2-in-1-full-cycle-reflective-grow-tent', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(624, '2', '2857', 'uva bar', '29', '28', '400', 'https://growace.com/products/horticulture-lighting-group-hlg-30-uva-supplement-led-bar-light', '14', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(625, '2', '2858', 'black dog grow light', '30', '28', '200', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(626, '2', '2871', 'optic grow light', '31', '37', '250', 'https://growace.com/products/optic-led-grow-light-optic-8p-120-degree-led-grow-light-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(627, '2', '2875', 'black dog grow lights', '27', '33', '100', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '1', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(628, '2', '2876', 'y duct', '27', '15', '100', 'https://growace.com/products/8x8x8-y-duct-connector', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(629, '2', '2877', '200 gallon fabric pots', '27', '31', '100', 'https://growace.com/products/200-gallon-prune-pots-fabric-grow-pots', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(630, '2', '2879', 'quiet in line fans', '32', '28', '300', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '0', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(631, '2', '2881', '2x2 grow tent kit', '31', '33', '250', 'https://growace.com/products/gorilla-lite-line-indoor-grow-tent-high-cfm-kit', '1', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(632, '2', '2882', '100 micron', '25', '20', '300', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '4', '0.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(633, '2', '2883', 'pro nutrients', '31', '31', '250', 'https://growace.com/products/lotus-nutrients-pro-series-cal-mag-15oz', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(634, '2', '2884', 'sunblaster grow lights', '33', '33', '400', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(635, '2', '2890', 'drip systems hydroponics', '31', '31', '200', 'https://growace.com/products/10-pot-hydroponic-versagrow-system', '4', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(636, '2', '2891', '2x4 trellis net', '28', '20', '100', 'https://growace.com/products/gorilla-grow-tent-grow-room-net-trellis', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(637, '2', '2899', 'snow storm ultra', '33', '23', '450', 'https://growace.com/products/snow-storm-ultra-0-0-3', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(638, '2', '2906', '5 gallon air pot', '28', '28', '100', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(639, '2', '2908', '2x4 grow tent ventilation setup', '28', '28', '100', 'https://growace.com/products/2x4ft-hid-soil-complete-indoor-grow-tent-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(640, '2', '2913', 'metal wall mount fan', '28', '30', '100', 'https://growace.com/products/active-air-heavy-duty-16-metal-wall-mount-fan', '0', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(641, '2', '2917', 'rosin tech go', '30', '11', '200', 'https://growace.com/products/rosin-tech-go-heat-press', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(642, '2', '2928', 'air pots 3 gallon', '28', '27', '100', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(643, '2', '2944', 'co2 bag', '32', '32', '500', 'https://growace.com/products/ez-co2-homegrown-co2', '4', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(644, '2', '2952', 'thunder trimmer', '30', '30', '150', 'https://growace.com/products/thundervak-trimmer', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(645, '2', '2953', 'ocean forest soil ingredients', '28', '23', '100', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '3', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(646, '2', '2956', 'spectrum kit', '28', '28', '100', 'https://growace.com/products/s180-advance-spectrum-max-led-grow-light-kit', '24', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(647, '2', '2962', 'black dog led lights', '34', '35', '500', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '6', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(648, '2', '2964', 'ufo led', '30', '25', '200', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '8', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(649, '2', '2965', 'smart grow light', '31', '31', '200', 'https://growace.com/products/advanced-spectrum-hy-smart-controller-for-led-de-and-cmh-light-systems', '11', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(650, '2', '2967', 'green trees hydroponics', '23', '8', '300', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '8', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(651, '2', '2968', 'green trees hydroponics', '23', '23', '300', 'https://growace.com/products/greentree-hydroponics-multi-flow-12-site-ebb-and-flow-hydroponic-system', '8', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(652, '2', '2970', 'spider farmer sf 2000', '43', '43', '2600', 'https://growace.com/products/spider-farmer-sf2000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(653, '2', '2974', 'g8 led', '33', '38', '450', 'https://growace.com/products/dorm-grow-680w-g8led-c3-enhanced-full-spectrum-grow-light', '1', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(654, '2', '2976', 'sunblaster led', '33', '52', '250', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(655, '2', '2979', 'max fan', '34', '34', '900', 'https://growace.com/products/max-fan-10in-1019-cfm', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(656, '2', '2989', 'lighting tent kits', '31', '31', '150', 'https://growace.com/products/78x78-led-hydro-complete-indoor-grow-tent-system', '5', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(657, '2', '2993', 'alpha dragon', '33', '30', '700', 'https://growace.com/products/scynceled-dragon-alpha-led-grow-light', '1', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(658, '2', '2995', 'gorilla tent 10x10', '31', '31', '150', 'https://growace.com/products/10-x10-gorilla-grow-tent', '0', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(659, '2', '2997', 'led spectrum', '32', '32', '400', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '16', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(660, '2', '3001', 'butterfly screw', '38', '37', '3200', 'https://growace.com/products/50-s-s-duct-clamp-w-butterfly-screw', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(661, '2', '3012', '4x4 led grow light', '35', '35', '400', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(662, '2', '3019', 'programable light timers', '31', '29', '150', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '4', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(663, '2', '3025', 'greenhouse replacement cover', '40', '38', '1100', 'https://growace.com/products/grow1-greenhouse-replacement-cover', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(664, '2', '3028', '4000k led light', '30', '57', '100', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-5', '8', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(665, '2', '3032', 'air cooled reflector', '27', '27', '200', 'https://growace.com/products/triple-x2-double-ended-air-cooled-reflector-8', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(666, '2', '3033', 'mechanical outlet timer', '32', '33', '200', 'https://growace.com/products/120v-dual-outlet-mechanical-timer', '14', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(667, '2', '3034', 'inline duct booster fans', '34', '33', '300', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '5', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(668, '2', '3039', 'rockwool 60', '31', '28', '150', 'https://growace.com/products/platinium-no-pots-w-rockwool-hydrostone-60-series', '7', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(669, '2', '3045', 'grow bar', '36', '26', '450', 'https://growace.com/products/kind-x-series-led-grow-light-bar', '1', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(670, '2', '3047', 'led grow light cob', '30', '18', '100', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(671, '2', '3054', 'led wand', '31', '31', '350', 'https://growace.com/products/mint-wand-4-led-bloom', '3', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(672, '2', '3060', 'ligh timer', '33', '42', '150', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '15', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(673, '2', '3061', 'black dog led grow lights', '28', '28', '200', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '1', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(674, '2', '3067', 'scorpion light', '30', '34', '250', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(675, '2', '3071', 'perlite 4 cubic feet', '34', '34', '200', 'https://growace.com/products/perlite-3-4-cu-ft-bags', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(676, '2', '3077', '10 gallon bag', '31', '47', '100', 'https://growace.com/products/10-gallon-bubble-bags-5-bag-set', '1', '1.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(677, '2', '3078', 'duct muffler', '33', '14', '150', 'https://growace.com/products/6-inline-fan-noise-muffler-air-duct-silencer', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(678, '2', '3081', 'hlg 600 rspec review', '32', '32', '150', 'https://growace.com/products/horticulture-lighting-group-600-v2-rspec-full-spectrum-led-grow-light', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(679, '2', '3082', 'surge protectors with timers', '33', '31', '150', 'https://growace.com/products/120v-8-way-power-strip-w-timer', '0', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(680, '2', '3092', 'trim bin near me', '31', '31', '100', 'https://growace.com/products/trim-bin-filter', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(681, '2', '3107', 'rosin tech big smash rosin press', '34', '41', '200', 'https://growace.com/products/rosin-tech-big-smash-hydraulic-heat-press', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(682, '2', '3118', 'carbon fan', '33', '33', '150', 'https://growace.com/products/yield-lab-6-inch-440-cfm-charcoal-filter-and-duct-fan-combo-kit', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(683, '2', '3125', 'ufo led light', '35', '34', '300', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '8', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(684, '2', '3127', 'grow tent oscillating fan', '36', '49', '350', 'https://growace.com/products/monkey-fan-oscillating-20w', '3', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(685, '2', '3129', 'timer 24 hours', '33', '40', '350', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '3', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(686, '2', '3131', 'sunblaster grow light', '37', '37', '400', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(687, '2', '3133', 'mini led grow lights', '31', '14', '100', 'https://growace.com/products/crecer-lighting-panthrx-mini-led-grow-light-system', '12', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(688, '2', '3138', 'gorilla x3', '32', '39', '100', 'https://growace.com/products/shorty-gorilla-grow-tent-3-x-3-with-9-extension-kit', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(689, '2', '3139', 'hydroponic air stone', '33', '38', '150', 'https://growace.com/products/aquavitatm-4-x-2-cylinder-air-stone', '1', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(690, '2', '3142', 'metal halide lamp 400w', '32', '29', '100', 'https://growace.com/products/hortilux-blue-daylight-super-metal-halide-mh-lamp-400w', '1', '3.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(691, '2', '3145', 'olivia\'s cloning gel', '31', '29', '100', 'https://growace.com/products/olivia-s-cloning-gel-8-oz', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(692, '2', '3151', 'gorilla grow tent 3x3', '35', '35', '200', 'https://growace.com/products/shorty-gorilla-grow-tent-3-x-3-with-9-extension-kit', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(693, '2', '3154', 'grow bucket kit', '32', '33', '100', 'https://growace.com/products/grow1-deep-water-culture-dwc-4-bucket-reservoir-complete-kit', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(694, '2', '3157', '3 gallon pump sprayer', '34', '21', '200', 'https://growace.com/products/gro1-3-gallon-pump-sprayer', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(695, '2', '3160', 'seed starting kit with light', '40', '40', '700', 'https://growace.com/products/yield-lab-seed-and-clone-starter-kit-with-24w-all-blue-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(696, '2', '3161', 'next light mega', '37', '39', '700', 'https://growace.com/products/nextlight-640w-mega-pro-led-grow-light', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(697, '2', '3162', 'led ufo light', '37', '37', '350', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '7', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(698, '2', '3163', '10 of 120000', '36', '36', '200', 'https://growace.com/products/kwikool-10-ton-a-c-120-000-btu', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(699, '2', '3168', '24 x 60', '38', '35', '2800', 'https://growace.com/products/yield-lab-two-door-48x24x60-reflective-grow-tent', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(700, '2', '3174', 'purple maxxx', '34', '12', '150', 'https://growace.com/products/purple-maxx-0-0-3', '0', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(701, '2', '3175', 'hlg 600 r spec', '32', '32', '100', 'https://growace.com/products/horticulture-lighting-group-hlg-600-v2-rspec-full-spectrum-qb-led-grow-light', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(702, '2', '3176', '14 gauge power cord', '33', '33', '100', 'https://growace.com/products/14-gauge-240v-power-cord-15', '7', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(703, '2', '3183', '200 gallon grow bags', '34', '28', '150', 'https://growace.com/products/200-gallon-prune-pots-fabric-grow-pots-3-bag-set', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(704, '2', '3189', 'black dog lights', '32', '32', '100', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(705, '2', '3193', 'spider farmer sf-2000', '40', '39', '600', 'https://growace.com/products/spider-farmer-sf2000-led-grow-light-system', '11', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(706, '2', '3199', '2 way humidity control', '39', '33', '450', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(707, '2', '3200', 'nextlight mega', '39', '38', '600', 'https://growace.com/products/nextlight-640w-mega-pro-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(708, '2', '3206', 'rosin press pneumatic', '36', '36', '200', 'https://growace.com/products/bubble-magic-5-x5-pneumatic-heat-press-1000psi', '5', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(709, '2', '3209', '2ft fluorescent light', '33', '33', '150', 'https://growace.com/products/doublelux-2ft-16-bulb-t5-fluorescent-light', '1', '2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(710, '2', '3224', 'light relay', '34', '35', '500', 'https://growace.com/products/yield-lab-4-outlet-120v-240v-grow-light-relay-controller', '4', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(711, '2', '3239', 'autopilot timer', '34', '44', '100', 'https://growace.com/products/autopilot-revolve-f20-repeat-cycle-and-light-combo-timer', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(712, '2', '3242', 'co2 burner', '42', '39', '1100', 'https://growace.com/products/ltl-10-burner-propane-co2-generator-high-altitude', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(713, '2', '3244', '240v timers', '38', '38', '300', 'https://growace.com/products/240v-single-outlet-mechanical-timer', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(714, '2', '3245', 'mini grow', '32', '32', '100', 'https://growace.com/products/crecer-lighting-panthrx-mini-led-grow-light-system', '2', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(715, '2', '3246', 'hanging herb drying rack', '36', '45', '200', 'https://growace.com/products/yield-lab-2ft-herbal-hanging-dry-net-without-clips', '9', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(716, '2', '3248', 'germination kit', '36', '36', '300', 'https://growace.com/products/yield-lab-20-75-x-10-germination-kit-with-seedling-heat-mat-temperature-controller-humidity-dome-and-propagation-tray', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(717, '2', '3250', 'light hanging kit', '34', '30', '200', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(718, '2', '3257', 'hlg 100 v2', '37', '23', '200', 'https://growace.com/products/horticulture-lighting-group-100-v2-qb192-quantum-board-led-kit', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(719, '2', '3258', 'purple maxx', '38', '27', '350', 'https://growace.com/products/purple-maxx-0-0-3', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(720, '2', '3260', '50 lb co2 tank', '40', '20', '600', 'https://growace.com/products/active-air-50-lb-co2-tank', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(721, '2', '3262', 'triminator rosin press', '36', '36', '200', 'https://growace.com/products/triminator-trp-rosin-heat-press', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(722, '2', '3266', '5 gallon pots', '39', '37', '700', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(723, '2', '3269', 'spectrum led', '34', '34', '200', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '20', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(724, '2', '3283', 'air stone hydroponics', '36', '28', '150', 'https://growace.com/products/aquavitatm-4-x-2-cylinder-air-stone', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(725, '2', '3289', 'advance led', '34', '34', '100', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '23', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(726, '2', '3291', 'carbon charcoal filter', '35', '37', '100', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '24', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(727, '2', '3292', '6in inline fan', '37', '33', '200', 'https://growace.com/products/yield-lab-6-inch-440-cfm-air-duct-fan-vent-system', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(728, '2', '3293', 'dyna gro neem oil', '40', '38', '600', 'https://growace.com/products/dyna-gro-pure-neem-oil-1-gal', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(729, '2', '3302', 'gorilla grow tent 5x9', '39', '39', '300', 'https://growace.com/products/5-x-9-gorilla-grow-tent', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(730, '2', '3303', 'flora grow nutrients', '36', '38', '150', 'https://growace.com/products/gh-floraseries-performance-pack', '9', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(731, '2', '3304', 'grow bags for sale', '35', '34', '200', 'https://growace.com/products/2-gallon-pvc-grow-bags-10-pack', '10', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(732, '2', '3305', 'active aqua chiller', '38', '38', '350', 'https://growace.com/products/active-aqua-chiller-with-power-boost', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(733, '2', '3306', 'cloning gel', '43', '25', '1000', 'https://growace.com/products/x-nutrients-mx-clone-gel-4-oz', '6', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(734, '2', '3317', '100 gallon fabric pot', '39', '39', '250', 'https://growace.com/products/100-gallon-prune-pots-fabric-grow-pots-3-bag-set', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(735, '2', '3319', 'mesh trellis', '36', '30', '150', 'https://growace.com/products/yield-lab-5ft-x-15ft-60-in-x-180-in-soft-mesh-trellis-netting', '3', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(736, '2', '3321', 'cfm 400', '37', '37', '150', 'https://growace.com/products/active-air-6-inline-duct-fan-400-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(737, '2', '3322', 'pneumatic rosin press', '35', '27', '100', 'https://growace.com/products/bubble-magic-5-x5-pneumatic-heat-press-1000psi', '4', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(738, '2', '3327', '50 gallon grow bags', '40', '59', '300', 'https://growace.com/products/2-gallon-pvc-grow-bags-10-pack', '1', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(739, '2', '3328', 'hydroponic tree', '35', '38', '100', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '2', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(740, '2', '3333', 'perlite 4 cu ft', '36', '77', '150', 'https://growace.com/products/perlite-2-4-cu-ft-bags', '2', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(741, '2', '3335', 'cloning kit', '36', '46', '200', 'https://growace.com/products/pro-series-complete-clone-and-rooting-package', '3', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(742, '2', '3336', 't5 strip light', '35', '22', '100', 'https://growace.com/products/lightech-t5-strip-2-24w', '1', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(743, '2', '3342', 'lights timer', '37', '37', '250', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(744, '2', '3344', '4x8 gorilla grow tent', '39', '39', '250', 'https://growace.com/products/lite-line-gorilla-grow-tent-4-x-8-no-extension-kit', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(745, '2', '3345', 'perpetual grow', '36', '33', '150', 'https://growace.com/products/4x5ft-complete-perpetual-led-soil-indoor-grow-tent-system', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(746, '2', '3349', 'hydrologic water filter', '36', '36', '100', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '1', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(747, '2', '3351', 'garden hose water filter', '45', '53', '800', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '3', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(748, '2', '3357', 'seedling starter kit with light', '44', '31', '700', 'https://growace.com/products/yield-lab-seed-and-clone-starter-kit-with-24w-all-blue-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(749, '2', '3372', 'mini rosin press', '33', '40', '150', 'https://growace.com/products/nugsmasher-mini-rosin-press', '8', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(750, '2', '3374', 'advance led lights', '43', '43', '500', 'https://growace.com/products/advance-spectrum-240w-sun-series-4-bar-full-spectrum-led-grow-light', '2', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(751, '2', '3378', 'dwc roots', '37', '37', '100', 'https://growace.com/products/root-spa-5-gal-4-dwc-bucket-system', '4', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(752, '2', '3383', 'hydroponic water reservoir', '36', '28', '100', 'https://growace.com/products/autopot-flexitank-collapsible-hydroponic-water-reservoir-60-gallons', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(753, '2', '3387', 'boveda 62 humidity packs', '36', '38', '100', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', '0.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(754, '2', '3395', '5 gallon bag', '40', '40', '250', 'https://growace.com/products/5-gallon-bubble-magic-extraction-bags-set-of-5', '1', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(755, '2', '3397', 'rockwool cube', '37', '37', '200', 'https://growace.com/products/6-x-6-x-6-cultilene-rockwool-cubes', '6', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18');
INSERT INTO `excel_data` (`id`, `excel_name_id`, `hash_tag`, `keyword`, `position`, `position_history`, `volumn`, `url`, `difficult`, `cpc`, `status`, `created_at`, `updated_at`) VALUES
(756, '2', '3399', 'superthrive vitamin solution', '38', '31', '150', 'https://growace.com/products/super-thrive-vitamin-solution', '2', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(757, '2', '3405', 'dynagro neem oil', '40', '28', '200', 'https://growace.com/products/dyna-gro-pure-neem-oil-1-gal', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(758, '2', '3406', '80+48', '31', '27', '150', 'https://growace.com/products/yield-lab-48-x-36-x-80-2-in-1-full-cycle-reflective-grow-tent', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(759, '2', '3409', 'co2 generator propane', '37', '26', '100', 'https://growace.com/products/ltl-10-burner-propane-co2-generator-high-altitude', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(760, '2', '3431', 'nugsmasher mini 2 ton manual rosin press', '47', '46', '900', 'https://growace.com/products/nugsmasher-mini-rosin-press', '4', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(761, '2', '3433', 'active aqua air pump', '44', '44', '450', 'https://growace.com/products/active-aqua-dual-diaphragm-air-pump', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(762, '2', '3435', 'uvb led', '42', '21', '250', 'https://growace.com/products/california-light-works-solarxtreme-500-uvb-led-grow-light', '0', '1.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(763, '2', '3436', 'food grade tubing', '39', '39', '250', 'https://growace.com/products/1-4-x-1000-clear-food-grade-poly-tubing', '2', '1.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(764, '2', '3443', 'in line duct booster fan', '37', '27', '100', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '6', '1.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(765, '2', '3445', '48 x 60', '32', '32', '200', 'https://growace.com/products/yield-lab-two-door-48x24x60-reflective-grow-tent', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(766, '2', '3449', 'boveda 2 way humidity control', '39', '33', '150', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(767, '2', '3458', 'dimmer ballast', '42', '42', '300', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '1', '1.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(768, '2', '3461', 'hlg 650r review', '39', '39', '150', 'https://growace.com/products/horticulture-lighting-group-hlg-650-v2-rspec-full-spectrum-led-grow-light', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(769, '2', '3467', '62 humidity packs', '40', '35', '150', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(770, '2', '3473', 'light hood', '35', '35', '150', 'https://growace.com/products/yield-lab-1000w-hps-mh-cool-hood-reflector-grow-light-kit', '4', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(771, '2', '3478', 'rockwell cubes', '36', '36', '200', 'https://growace.com/products/4-x-4-x-4-cultilene-rockwool-cubes', '7', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(772, '2', '3483', 'digital outlet timers', '44', '31', '400', 'https://growace.com/products/120v-dual-outlet-digital-timer', '4', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(773, '2', '3493', '45 gallon pots', '39', '18', '100', 'https://growace.com/products/prunex-pot-45-gallon', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(774, '2', '3506', 'garden hose quick disconnect', '39', '39', '150', 'https://growace.com/products/hydrologic-quick-disconnect-1-2-x-garden-hose-adapter', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(775, '2', '3517', 'charcoal filter air purifier', '39', '39', '100', 'https://growace.com/products/12-x30-purifier-activated-charcoal-filter', '4', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(776, '2', '3520', 'grow tent clip fan', '40', '40', '150', 'https://growace.com/products/6-desk-clip-fan', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(777, '2', '3521', 'root starter', '47', '40', '1000', 'https://growace.com/products/speedy-root-50-cell-starter-tray-w-media', '1', '0.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(778, '2', '3526', 'clip on fans', '55', '55', '3400', 'https://growace.com/products/6-desk-clip-fan', '1', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(779, '2', '3530', 'eva dry edv 1100', '40', '46', '100', 'https://growace.com/products/eva-dry-edv-1100-petite-mini-dehumidifier', '0', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(780, '2', '3533', '5 gallon sprayer', '41', '41', '250', 'https://growace.com/products/gro1-5-gallon-battery-powered-sprayer', '0', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(781, '2', '3535', 'squat pots', '42', '37', '200', 'https://growace.com/products/5-gal-squat-thermoformed-pot-3-pack', '0', '0.06', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(782, '2', '3541', 'propane co2 generator', '39', '39', '150', 'https://growace.com/products/ltl-10-burner-propane-co2-generator-high-altitude', '2', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(783, '2', '3546', 'rockwool grow cubes', '41', '54', '400', 'https://growace.com/products/4-x-4-x-4-cultilene-rockwool-cubes', '7', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(784, '2', '3555', '48 x 48', '33', '15', '500', 'https://growace.com/products/yield-lab-48x48x78-reflective-grow-tent', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(785, '2', '3562', 'duct blower', '39', '56', '200', 'https://growace.com/products/yield-lab-4-inch-pro-series-fan-with-speed-controller-190cfm', '3', '1.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(786, '2', '3576', 'electronic light timer', '46', '43', '400', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '24', '1.1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(787, '2', '3583', 'hlg quantum boards', '41', '41', '100', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '6', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(788, '2', '3584', '62 humidity pack', '40', '39', '100', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', '0.35', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(789, '2', '3587', 'perpetual grow room design', '41', '41', '100', 'https://growace.com/products/4x5ft-complete-perpetual-led-soil-indoor-grow-tent-system', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(790, '2', '3592', 'killer tea', '32', '32', '150', 'https://growace.com/products/killer-tea', '0', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(791, '2', '3593', 'indoor greenhouse kit with light', '42', '42', '150', 'https://growace.com/products/8x4-led-hydro-complete-indoor-grow-tent-system', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(792, '2', '3596', 'hydroponic lighting system', '41', '66', '100', 'https://growace.com/products/8x4-led-hydro-complete-indoor-grow-tent-system', '7', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(793, '2', '3597', 'how to rosin tech', '41', '41', '100', 'https://growace.com/products/rosin-tech-all-in-one-rosin-tech-heat-press', '3', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(794, '2', '3598', 'dry trimmer', '43', '43', '350', 'https://growace.com/products/trimit-dry-5000-dry-trimmer', '1', '1', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(795, '2', '3614', 'clip fans for grow tent', '42', '44', '150', 'https://growace.com/products/6-desk-clip-fan', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(796, '2', '3618', 'hydroponics air stones', '44', '45', '150', 'https://growace.com/products/aquavitatm-4-x-2-cylinder-air-stone', '2', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(797, '2', '3623', 'rope ratchet', '51', '68', '1400', 'https://growace.com/products/1-4-rop-ratchet-single-item', '0', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(798, '2', '3629', 'air stones hydroponics', '44', '45', '300', 'https://growace.com/products/aquavitatm-4-x-2-cylinder-air-stone', '1', '0.25', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(799, '2', '3641', '10x20 tray', '43', '43', '150', 'https://growace.com/products/yield-lab-10-x-20-inch-propagation-tray-5-pack', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(800, '2', '3651', '100 gallon reservoirs', '43', '43', '150', 'https://growace.com/products/grow1-collapsible-reservoir-265-gallon', '0', '1.2', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(801, '2', '3654', 'harvest more trim bin', '41', '41', '100', 'https://growace.com/products/trim-bin-complete-set', '2', '0.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(802, '2', '3660', 'aquaponics kit', '51', '53', '700', 'https://growace.com/products/aquabox-complete-aquaponics-kit', '8', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(803, '2', '3661', 't5 4ft fixture', '42', '57', '100', 'https://growace.com/products/lightech-4ft-4-bulb-t5-fluorescent-light-grow-bulbs', '2', '4.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(804, '2', '3664', 'convert 220 to 110 adapter', '43', '80', '150', 'https://growace.com/products/110v-to-220v-plug-adapter', '13', '0.6', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(805, '2', '3665', 'boveda 62 packs', '42', '42', '100', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(806, '2', '3667', 'hydroponic controller', '42', '42', '100', 'https://growace.com/products/greentree-hydroponics-multi-flow-analog-controller-module', '3', '1.4', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(807, '2', '3669', 'nugsmasher mini review', '45', '47', '200', 'https://growace.com/products/nugsmasher-mini-rosin-press', '5', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(808, '2', '3671', 'battery pruning shears', '47', '22', '300', 'https://growace.com/products/grow1-20v-dc-electronic-cordless-pruning-shears-1-cutting-diameter-w-2-batteries-charger', '0', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(809, '2', '3674', 'pure pressure rosin press', '49', '49', '500', 'https://growace.com/products/pure-pressure-longs-peak-rosin-press', '2', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(810, '2', '3675', 'quilted duffle bag', '49', '49', '700', 'https://growace.com/products/awol-daily-quilted-duffle-bag-green', '1', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(811, '2', '3688', 'hps lamp', '40', '41', '200', 'https://growace.com/products/phantom-pro-double-ended-high-pressure-sodium-hps-lamp-1000w', '13', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(812, '2', '3689', '62% humidity packs', '44', '44', '150', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(813, '2', '3697', 'led grow light spectrum chart', '42', '42', '150', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '20', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(814, '2', '3704', 'full spectrum leds', '43', '43', '100', 'https://growace.com/products/advance-spectrum-400w-sun-series-4-bar-full-spectrum-led-grow-light', '16', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(815, '2', '3707', 'ufo light led', '44', '44', '100', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '9', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(816, '2', '3708', 'rosinbomb rocket', '50', '38', '500', 'https://growace.com/products/rosinbomb-rocket-electric-heat-press', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(817, '2', '3713', 'outlet timers', '45', '45', '350', 'https://growace.com/products/120v-dual-outlet-digital-timer', '12', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(818, '2', '3719', 'lab timer', '45', '47', '250', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '4', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(819, '2', '3720', 'rosin tech yields', '47', '29', '250', 'https://growace.com/products/rosin-tech-precision-rosin-press', '4', '1.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(820, '2', '3726', '4x4 greenhouse', '49', '46', '350', 'https://growace.com/products/4x4ft-led-soil-complete-indoor-grow-tent-system', '3', '0.45', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(821, '2', '3734', 'light hanger pro', '48', '40', '250', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '0', '0.3', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(822, '2', '3738', '90 micron bags', '44', '44', '100', 'https://growace.com/products/bubble-magic-rosin-90-micron-large-bag-10pcs', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(823, '2', '3743', 'battery powered backpack fogger', '45', '45', '150', 'https://growace.com/products/grow1-electric-backpack-fogger-ulv-atomizer-4-gallon', '1', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(824, '2', '3745', '24 x 60 x 60', '33', '33', '100', 'https://growace.com/products/yield-lab-two-door-48x24x60-reflective-grow-tent', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(825, '2', '3753', 'hydroponics trees', '45', '43', '150', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '3', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(826, '2', '3757', 'garden water filter', '46', '50', '150', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '3', '0.8', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(827, '2', '3763', 'herbal rack', '48', '40', '200', 'https://growace.com/products/yield-lab-2ft-herbal-hanging-dry-net-without-clips', '12', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(828, '2', '3766', 'spectrum light', '51', '44', '1900', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '39', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(829, '2', '3767', 'band ufo', '48', '51', '400', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '18', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(830, '2', '3772', '1400 x 10', '44', '39', '100', 'https://growace.com/products/active-air-carbon-filter-10-x-39-1400-cfm', '0', NULL, 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(831, '2', '3782', 'heating mat thermostat', '47', '43', '200', 'https://growace.com/products/yield-lab-heat-mat-temperature-controller', '2', '0.7', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(832, '2', '3784', 'commercial humidifier', '51', '51', '400', 'https://growace.com/products/active-air-commercial-humidifier-200-pint', '6', '2.5', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(833, '2', '3785', 'viparspectra led review', '45', '53', '100', 'https://growace.com/products/viparspectra-240w-vs-series-vs2000-led-grow-light', '0', '0.9', 1, '2021-11-11 09:03:18', '2021-11-11 09:03:18'),
(834, '2', '3788', 'hose water filter', '56', '64', '1500', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '4', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(835, '2', '3790', 'grow tent 10x10', '45', '17', '100', 'https://growace.com/products/10-x10-gorilla-grow-tent', '2', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(836, '2', '3795', 'greenhouse tape', '46', '45', '150', 'https://growace.com/products/greenhouse-tape-2-75-x-25m', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(837, '2', '3820', 'panda film', '21', '17', '2200', 'https://growace.com/products/40-x100-5-5mil-panda-film', '0', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(838, '2', '3822', '6 inch clip on fan', '48', '54', '200', 'https://growace.com/products/6-desk-clip-fan', '0', '0.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(839, '2', '3828', 'dry trimming', '51', '51', '350', 'https://growace.com/products/bubble-magic-dry-trimming-bag', '11', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(840, '2', '3829', 'humidity control packs', '55', '64', '900', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '4', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(841, '2', '3839', 'eva-dry edv-1100 petite dehumidifier', '49', '40', '200', 'https://growace.com/products/eva-dry-edv-1100-petite-mini-dehumidifier', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(842, '2', '3840', 'water filter for garden hose', '51', '52', '250', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '4', '0.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(843, '2', '3841', '600 watt high pressure sodium ballast', '47', '47', '100', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(844, '2', '3849', '1000 digital ballast', '50', '45', '200', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(845, '2', '3851', 'led full spectrum', '43', '43', '100', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '12', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(846, '2', '3853', 'badboy t5', '48', '48', '150', 'https://growace.com/products/quantum-t5-432w-4-8-tube-fixture-no-lamps', '0', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(847, '2', '3855', 'mylar glasses', '46', '47', '100', 'https://growace.com/products/sunbounce-reflective-2-mil-reflective-mylar-film-48-in-x-50-ft', '0', '0.15', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(848, '2', '3860', 'sun led light', '49', '49', '150', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '26', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(849, '2', '3861', 'kind k5', '46', '48', '100', 'https://growace.com/products/kind-led-k5-series-xl1000-wifi-indoor-led-grow-lights', '0', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(850, '2', '3865', '65 gallon grow bags', '46', '25', '100', 'https://growace.com/products/65-gallon-prune-pots', '0', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(851, '2', '3866', 'thrive vitamin', '46', '43', '100', 'https://growace.com/products/super-thrive-vitamin-solution', '30', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(852, '2', '3888', 'cloning gel for plants', '52', '52', '300', 'https://growace.com/products/x-nutrients-mx-clone-gel-4-oz', '5', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(853, '2', '3889', 'metal halide 400w', '52', '38', '350', 'https://growace.com/products/hortilux-blue-daylight-super-metal-halide-mh-lamp-400w', '0', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(854, '2', '3898', 'tall white pot', '48', '48', '150', 'https://growace.com/products/active-aqua-12-x-12-square-white-pot-12-tall-case-of-24', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(855, '2', '3908', 'dimming ballasts', '47', '87', '100', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '1.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(856, '2', '3910', 'clearance led grow lights', '48', '48', '150', 'https://growace.com/products/horticulture-lighting-group-hlg-550-v2-bspec-full-spectrum-led-grow-light', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(857, '2', '3914', '110v plug', '49', '49', '800', 'https://growace.com/products/110v-to-220v-plug-adapter-1', '4', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(858, '2', '3919', 'bubble screen', '53', '53', '700', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '2', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(859, '2', '3920', '5x9 gorilla grow tent', '49', '49', '150', 'https://growace.com/products/5-x-9-gorilla-grow-tent', '0', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(860, '2', '3923', 'fox farm ocean forest ph', '47', '42', '100', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '0', '0.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(861, '2', '3930', 'active carbon air filter', '50', '34', '400', 'https://growace.com/products/active-air-carbon-filter-10-x-39-1400-cfm', '12', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(862, '2', '3940', '30 gallon grow bags', '53', '53', '350', 'https://growace.com/products/30-gallon-prune-pots-fabric-grow-pots-3-bag-set', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(863, '2', '3945', '2x2 grow tent', '59', '59', '1400', 'https://growace.com/products/gorilla-lite-line-indoor-grow-tent-high-cfm-kit', '2', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(864, '2', '3947', '1/4 float valve', '49', '53', '150', 'https://growace.com/products/hydrologic-float-valve-1-4', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(865, '2', '3960', 'eva dry edv1100', '48', '46', '100', 'https://growace.com/products/eva-dry-edv-1100-petite-mini-dehumidifier', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(866, '2', '3964', '110v plug adapter', '38', '21', '100', 'https://growace.com/products/110v-to-220v-plug-adapter', '6', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(867, '2', '3966', 'boveda 62%', '48', '67', '100', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(868, '2', '3973', 'gentle cuts', '51', '51', '200', 'https://growace.com/products/centurion-gentle-cut-bucker-triple-gentle-cut', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(869, '2', '3986', 'pure pressure press', '50', '50', '150', 'https://growace.com/products/pure-pressure-longs-peak-rosin-press', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(870, '2', '3991', 'dyna-gro pro-tekt', '52', '31', '250', 'https://growace.com/products/dyna-gro-pro-tekt', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(871, '2', '3993', 'diy led grow light kits', '54', '46', '300', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '1', '1.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(872, '2', '3996', '1000w hps ballasts', '51', '51', '150', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '1.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(873, '2', '3997', '220 volt plug adapter', '48', '48', '150', 'https://growace.com/products/110v-to-220v-plug-adapter', '8', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(874, '2', '3998', 'spectrum 6', '51', '51', '150', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '2', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(875, '2', '3999', 'eva dry edv 1100 petite dehumidifier', '51', '39', '150', 'https://growace.com/products/eva-dry-edv-1100-petite-mini-dehumidifier', '0', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(876, '2', '4007', 'clip on fans for grow tents', '49', '49', '100', 'https://growace.com/products/6-desk-clip-fan', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(877, '2', '4012', 'hydroponic reservoir', '54', '57', '300', 'https://growace.com/products/autopot-flexitank-collapsible-hydroponic-water-reservoir-60-gallons', '5', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(878, '2', '4018', '30 gallon pot', '49', '30', '150', 'https://growace.com/products/prunex-pot-30-gallon', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(879, '2', '4034', 'spider grow', '46', '46', '100', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '30', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(880, '2', '4039', '10 gallon pots', '48', '48', '150', 'https://growace.com/products/yield-lab-fabric-10-gallon-growing-pots-5-pack', '0', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(881, '2', '4044', 'pro tekt', '54', '45', '450', 'https://growace.com/products/dyna-gro-pro-tekt', '0', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(882, '2', '4047', 'roots nutrients', '58', '40', '600', 'https://growace.com/products/humboldt-roots-humboldt-nutrients', '4', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(883, '2', '4048', 'the babymaker', '53', '53', '200', 'https://growace.com/products/onedeal-babymaker-xl-clone-tent-4-x1-1-3-x6-1-2', '22', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(884, '2', '4051', 'timer power', '56', '59', '400', 'https://growace.com/products/120v-8-way-power-strip-w-timer', '0', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(885, '2', '4054', 'stepped drill bit', '55', '38', '450', 'https://growace.com/products/unibit-step-drill-1-4-1-3-8', '6', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(886, '2', '4059', 'co2 air tank', '55', '55', '300', 'https://growace.com/products/active-air-50-lb-co2-tank', '7', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(887, '2', '4062', 'large hole punch', '52', '52', '350', 'https://growace.com/products/1-4-hole-punch-large', '3', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(888, '2', '4070', '400w metal halide', '51', '51', '300', 'https://growace.com/products/hortilux-blue-daylight-super-metal-halide-mh-lamp-400w', '0', '3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(889, '2', '4071', '240 extension cord', '55', '52', '500', 'https://growace.com/products/grow1-240v-extension-cord-14-gauge-15', '0', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(890, '2', '4073', 'quest dehumidifier 225', '59', '57', '700', 'https://growace.com/products/quest-dual-225-overhead-commercial-dehumidifier-230-volt', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(891, '2', '4074', 'viparspectra reef light', '52', '52', '150', 'https://growace.com/products/viparspectra-203w-aquarium-light-timer-control-series-t300-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(892, '2', '4075', '100 mesh screen', '53', '64', '250', 'https://growace.com/products/bubble-magic-100-micron-extraction-mesh-screen-12-x12-10-sheet-pack', '5', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(893, '2', '4077', 'magic rosin', '53', '53', '200', 'https://growace.com/products/bubble-magic-rosin-160-micron-large-bag-10pcs', '0', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(894, '2', '4083', 'backpack fogger', '60', '50', '1400', 'https://growace.com/products/grow1-electric-backpack-fogger-ulv-atomizer-4-gallon', '2', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(895, '2', '4088', '5 gal pot', '46', '20', '100', 'https://growace.com/products/5-gal-squat-thermoformed-pot-3-pack', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(896, '2', '4091', 'lighting innovations', '58', '58', '700', 'https://growace.com/products/dutch-lighting-innovations-joule-series-1000w-de-fixture-120-240v', '19', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(897, '2', '4093', 'love temp control', '54', '54', '150', 'https://growace.com/products/ltl-digital-temperature-controller-cooling', '0', '1.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(898, '2', '4097', 'humidifier commercial', '54', '54', '200', 'https://growace.com/products/active-air-commercial-humidifier-200-pint', '9', '3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(899, '2', '4101', '3 gallon planter pot', '54', '60', '200', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '1', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(900, '2', '4102', 'lab filter', '51', '27', '100', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '9', '1.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(901, '2', '4103', '48 x 36', '51', '51', '700', 'https://growace.com/products/yield-lab-48-x-36-x-80-2-in-1-full-cycle-reflective-grow-tent', '4', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(902, '2', '4105', 'perlite bag', '54', '49', '150', 'https://growace.com/products/perlite-3-4-cu-ft-bags', '1', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(903, '2', '4111', 'neem oil for sale', '52', '52', '250', 'https://growace.com/products/dyna-gro-pure-neem-oil-1-gal', '3', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(904, '2', '4114', 'trim trays', '52', '52', '100', 'https://growace.com/products/trim-tray-200-micron-tray-top-black', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(905, '2', '4127', 'quest dual overhead dehumidifier', '55', '55', '200', 'https://growace.com/products/quest-dual-225-overhead-commercial-dehumidifier-230-volt', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(906, '2', '4131', 't8 grow lights', '58', '49', '500', 'https://growace.com/products/lightech-15w-2-t8-led-grow-light-2', '3', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(907, '2', '4133', 'activated charcoal filter', '57', '47', '500', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '39', '1.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(908, '2', '4142', 'electric timers', '63', '54', '1400', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '17', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(909, '2', '4146', 'aquaponics kits', '59', '59', '500', 'https://growace.com/products/aquabox-complete-aquaponics-kit', '5', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(910, '2', '4148', '10x10 grow room', '60', '64', '600', 'https://growace.com/products/onedeal-grow-tent-10-x-10-x-6-5', '1', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(911, '2', '4149', 'what is a uvb light', '61', '66', '700', 'https://growace.com/products/california-light-works-solarsystemr-uvb', '13', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(912, '2', '4161', '3000ml to gallons', '46', '35', '200', 'https://growace.com/products/3000ml-measuring-cup', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(913, '2', '4163', 'booster fans', '55', '55', '200', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '4', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(914, '2', '4167', 'prune pouch', '56', '56', '200', 'https://growace.com/products/39-25-4-pouch-hanging-prune-pot', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(915, '2', '4177', '1000 watt hps ballasts', '58', '58', '250', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(916, '2', '4184', 'spectrum lights', '49', '49', '150', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '30', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(917, '2', '4191', 'bubble hash washing machine', '50', '58', '150', 'https://growace.com/products/bubble-magic-5-gallon-washing-machine-new-version', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(918, '2', '4212', 'duct connector', '57', '39', '600', 'https://growace.com/products/8x8x8-y-duct-connector', '3', '1.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(919, '2', '4218', 'adjustable saw horses', '66', '66', '1400', 'https://growace.com/products/adjustable-saw-horses', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(920, '2', '4223', 'dyna gro protekt', '54', '46', '150', 'https://growace.com/products/dyna-gro-pro-tekt', '0', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(921, '2', '4242', '12 ton rosin press', '55', '57', '100', 'https://growace.com/products/eztrim-pro-12-ton-rosin-press', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(922, '2', '4244', '1700 x 12', '51', '28', '350', 'https://growace.com/products/phat-filter-12-x-39-1700-cfm', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(923, '2', '4246', 'spectrum hydroponics', '60', '60', '300', 'https://growace.com/products/s180-advance-spectrum-max-led-grow-light-kit', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(924, '2', '4266', 'hydroponic air pump', '62', '60', '500', 'https://growace.com/products/aquavitatm-3l-min-air-pump-2-outlet', '2', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(925, '2', '4268', 'bubble bags near me', '58', '58', '200', 'https://growace.com/products/bubble-magic-all-mesh-extraction-bags-20-gallon-5-bag-kit', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(926, '2', '4276', 'black poly tubing', '55', '55', '100', 'https://growace.com/products/1-2-x-50-black-poly-tubing', '0', '2.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(927, '2', '4288', '26 gallon water tank', '58', '58', '150', 'https://growace.com/products/grow1-collapsible-reservoir-26-gallon', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(928, '2', '4296', 'scrog growing', '61', '59', '300', 'https://growace.com/products/scrog-kit-19-x25', '28', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(929, '2', '4298', 'catalytic carbon filter', '60', '60', '200', 'https://growace.com/products/hydrologic-big-boy-w-upgraded-kdf85-catalytic-carbon-filter', '0', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(930, '2', '4307', 'rosin heat presses', '63', '63', '450', 'https://growace.com/products/rosin-tech-smash-manual-rosin-heat-press', '10', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(931, '2', '4309', 'pro cloning', '60', '54', '200', 'https://growace.com/products/pro-series-complete-clone-and-rooting-package', '22', '0.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(932, '2', '4326', 'led spider light', '58', '58', '150', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(933, '2', '4332', 'fox farm ocean forest for sale near me', '59', '59', '150', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '3', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(934, '2', '4340', '10x10 gorilla grow tent', '59', '45', '150', 'https://growace.com/products/onedeal-grow-tent-10-x-10-x-6-5', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(935, '2', '4344', 'heat mat thermostat', '66', '55', '1400', 'https://growace.com/products/yield-lab-heat-mat-temperature-controller', '4', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(936, '2', '4346', '1000 watt hps ballast', '57', '57', '100', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '0', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(937, '2', '4355', 'spectrum king sk602', '60', '60', '150', 'https://growace.com/products/spectrum-king-656w-sk-603-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(938, '2', '4364', 'spider farmer sf 2000 yield', '59', '53', '150', 'https://growace.com/products/spider-farmer-sf2000-led-grow-light-system', '12', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(939, '2', '4378', '5 gallon planter', '67', '67', '900', 'https://growace.com/products/5-gal-squat-thermoformed-pot-3-pack', '1', '0.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(940, '2', '4391', 'pedestal stand fan', '61', '61', '200', 'https://growace.com/products/26-f5-industrial-oscillating-pedestal-stand-fan', '9', '3.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(941, '2', '4396', '6 inch duct', '58', '58', '150', 'https://growace.com/products/6-inline-fan-noise-muffler-air-duct-silencer', '0', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(942, '2', '4406', 'boveda packs, 62', '59', '48', '100', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(943, '2', '4409', 'can fan intake filter', '59', '59', '100', 'https://growace.com/products/phat-hepa-intake-filter-12', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(944, '2', '4411', '4 gallon backpack sprayer', '67', '82', '900', 'https://growace.com/products/gro1-4-gallon-backpack-sprayer', '4', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(945, '2', '4415', 'bubble now machine', '59', '51', '100', 'https://growace.com/products/bubble-magic-5-gallon-washing-machine-new-version', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(946, '2', '4420', 'rechargeable grow light', '62', '54', '200', 'https://growace.com/products/green-led-rechargeable-work-light-1', '10', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(947, '2', '4431', 'hlg diablo 650r', '62', '67', '150', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '6', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(948, '2', '4433', 'gorilla grow tent 5 x 9', '60', '60', '100', 'https://growace.com/products/5-x-9-gorilla-grow-tent', '0', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(949, '2', '4435', 'boveda humidity control', '63', '69', '250', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '2', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(950, '2', '4436', 'root pruning pots', '60', '60', '100', 'https://growace.com/products/18-inch-root-pruning-pot', '8', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(951, '2', '4438', '8x8 grow tent', '66', '44', '900', 'https://growace.com/products/gorilla-grow-tent-lite-line-1-extension-kits-8x8', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(952, '2', '4440', 'mylar film', '69', '21', '1100', 'https://growace.com/products/sunbounce-reflective-2-mil-reflective-mylar-film-48-in-x-50-ft', '11', '1.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(953, '2', '4456', 'reverse osmosis replacement membrane', '61', '56', '100', 'https://growace.com/products/hydrologic-stealth-reverse-osmosis-replacement-membrane', '4', '2.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(954, '2', '4462', 'prism led lights', '64', '64', '200', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '3', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(955, '2', '4475', 'battery sprayers', '66', '72', '350', 'https://growace.com/products/gro1-5-gallon-battery-powered-sprayer', '4', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(956, '2', '4478', '3 gallon pot', '69', '46', '1400', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(957, '2', '4482', 'rosinbomb rocket review', '61', '61', '100', 'https://growace.com/products/rosinbomb-rocket-electric-heat-press', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(958, '2', '4484', '3 gallon plant pots', '60', '69', '100', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(959, '2', '4485', '125 watt cfl', '62', '58', '150', 'https://growace.com/products/agrobrite-compact-fluorescent-lamp-warm-125w-2700k', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(960, '2', '4492', 'back draft damper', '61', '61', '250', 'https://growace.com/products/6-backdraft-damper', '2', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(961, '2', '4518', 'charcoal filters for air vents', '63', '61', '150', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '0', '3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(962, '2', '4536', 'grow humidifier', '65', '65', '200', 'https://growace.com/products/dropair-humidifier', '1', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(963, '2', '4537', 'water filter for hose', '71', '71', '1000', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '1', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(964, '2', '4559', 'titanium shear', '63', '63', '100', 'https://growace.com/products/piranha-pruner-bonsai-shear-40mm-titanium-blade', '0', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(965, '2', '4567', 'spider farm', '80', '80', '10000', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '11', '0.07', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(966, '2', '4569', 'hydroponics air pump', '58', '50', '100', 'https://growace.com/products/aquavitatm-9l-min-air-pump-4-outlet', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(967, '2', '4573', 'dual co2 regulator', '67', '67', '250', 'https://growace.com/products/co2-regulator-dual', '2', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(968, '2', '4575', 'dimmable ballasts', '69', '69', '350', 'https://growace.com/products/yield-lab-1000w-digital-dimming-ballast', '1', '1.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(969, '2', '4581', 'magic bucket', '63', '63', '100', 'https://growace.com/products/bubble-magic-shaker-bucket', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(970, '2', '4586', '110v adapter', '60', '30', '100', 'https://growace.com/products/110v-to-220v-plug-adapter', '4', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(971, '2', '4590', 'fox farms ocean forest', '13', '33', '2700', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(972, '2', '4595', 'how to use trellis netting', '65', '66', '150', 'https://growace.com/products/grow1-5-x60-trellis-netting-3-5-x3-5-squares', '2', '0.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(973, '2', '4599', 'mechanical plug in timer', '66', '66', '150', 'https://growace.com/products/120v-dual-outlet-mechanical-timer', '24', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(974, '2', '4612', 'quest 225 dehumidifier', '70', '70', '350', 'https://growace.com/products/quest-dual-225-overhead-commercial-dehumidifier-230-volt', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(975, '2', '4629', 'r-spec', '59', '51', '200', 'https://growace.com/products/horticulture-lighting-group-600w-scorpion-r-spec-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(976, '2', '4631', 'lighting timer', '64', '69', '250', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '13', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(977, '2', '4633', '6in air filter', '68', '68', '150', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(978, '2', '4636', 'lite or light', '74', '74', '2000', 'https://growace.com/products/b-lite-720w-premium-1940e-led-grow-light', '5', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(979, '2', '4644', '8 inch duct vent', '66', '66', '100', 'https://growace.com/products/8x8x8-y-duct-connector', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(980, '2', '4658', 'bubble hash bags for sale', '67', '78', '150', 'https://growace.com/products/32-gallon-bubble-bags-8-bag-set', '5', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(981, '2', '4665', '3 gallon square pots', '68', '68', '150', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '0', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(982, '2', '4676', '4 inch filter', '69', '69', '200', 'https://growace.com/products/yield-lab-4-inch-190-cfm-charcoal-filter-and-duct-fan-combo-kit', '4', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(983, '2', '4677', '220vac plug', '69', '69', '200', 'https://growace.com/products/110v-to-220v-plug-adapter', '10', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(984, '2', '4678', 'led strip grow light', '70', '70', '250', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '6', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(985, '2', '4679', 'aqua vita', '68', '38', '400', 'https://growace.com/products/aquavitatm-792-water-pump', '9', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(986, '2', '4691', 'uvb light', '48', '48', '6700', 'https://growace.com/products/california-light-works-solarsystemr-uvb', '3', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(987, '2', '4693', 'hps hood', '57', '57', '100', 'https://growace.com/products/yield-lab-professional-series-1000w-air-cool-hood-double-ended-complete-grow-light-kit', '2', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(988, '2', '4697', 'foil ducting tape', '70', '74', '150', 'https://growace.com/products/3-x150-39-mylar-duct-tape', '3', '1.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(989, '2', '4699', 'bho glass extraction tube', '70', '71', '200', 'https://growace.com/products/glass-concentrate-extraction-tube-18-inches-l', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(990, '2', '4722', 'combo meter', '68', '20', '100', 'https://growace.com/products/hm-ec-tds-temp-combo-meter', '1', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(991, '2', '4744', 'growers choice', '34', '34', '6500', 'https://growace.com/products/grower-s-choice-digital-lighting-master-controller', '24', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(992, '2', '4748', 'mylar material', '71', '71', '500', 'https://growace.com/products/sunbounce-reflective-2-mil-reflective-mylar-film-48-in-x-50-ft', '31', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(993, '2', '4759', 'hydroponic light', '67', '53', '150', 'https://growace.com/products/gro1-light-mover', '8', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(994, '2', '4761', 'activated charcoal air filters', '71', '71', '200', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '11', '2.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(995, '2', '4763', 'maximum cfm for 6 inch duct', '69', '92', '100', 'https://growace.com/products/yield-lab-6-inch-440-cfm-duct-inline-fan-with-6-carbon-filter-ducting-and-clamps', '5', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(996, '2', '4772', '10 inline duct fan', '69', '69', '100', 'https://growace.com/products/active-air-6-inline-duct-fan-400-cfm', '0', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(997, '2', '4773', 'aero star', '72', '72', '700', 'https://growace.com/products/platinium-pots-w-aeroponic-tops-aerostar-100-series', '10', '4.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(998, '2', '4791', 'booster fan', '75', '75', '700', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '7', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(999, '2', '4798', '15 gallon plant pot', '77', '72', '500', 'https://growace.com/products/yield-lab-fabric-15-gallon-growing-pots-5-pack', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1000, '2', '4801', 'hydro stone', '69', '69', '300', 'https://growace.com/products/platinium-no-pots-w-rockwool-hydrostone-100-series', '2', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1001, '2', '4802', '2x2 tent', '70', '70', '100', 'https://growace.com/products/gorilla-lite-line-indoor-grow-tent-high-cfm-kit', '2', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1002, '2', '4804', 'ufo led lighting', '72', '72', '150', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '9', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1003, '2', '4810', 'prism lens', '82', '82', '2200', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '29', '1.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1004, '2', '4819', 'air pots 10 gallon', '72', '72', '150', 'https://growace.com/products/yield-lab-fabric-10-gallon-growing-pots-5-pack', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1005, '2', '4836', 'how to use bubble bags', '72', '72', '150', 'https://growace.com/products/yield-lab-5-gallon-bubble-extraction-bags-3-bag-set', '7', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1006, '2', '4851', 'grow cubes', '84', '73', '2900', 'https://growace.com/products/4-x-4-x-4-cultilene-rockwool-cubes', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1007, '2', '4864', 'hlg 600r', '79', '65', '600', 'https://growace.com/products/horticulture-lighting-group-hlg-30-uva-supplement-led-bar-light', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1008, '2', '4869', '3 gallon plant pot', '69', '69', '100', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '4', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1009, '2', '4870', 'uvb lights', '74', '74', '300', 'https://growace.com/products/california-light-works-solarsystemr-uvb', '8', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1010, '2', '4888', 'plant dolly', '82', '80', '1800', 'https://growace.com/products/24-plant-dolly', '0', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1011, '2', '4891', 'activated charcoal air filter', '72', '72', '100', 'https://growace.com/products/12-x30-purifier-activated-charcoal-filter', '11', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19');
INSERT INTO `excel_data` (`id`, `excel_name_id`, `hash_tag`, `keyword`, `position`, `position_history`, `volumn`, `url`, `difficult`, `cpc`, `status`, `created_at`, `updated_at`) VALUES
(1012, '2', '4894', '20 lb co2 tank', '77', '81', '500', 'https://growace.com/products/active-air-20-lb-co2-tank', '3', '0.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1013, '2', '4896', 'cordless pruning shears', '81', '81', '450', 'https://growace.com/products/grow1-20v-dc-electronic-cordless-pruning-shears-1-cutting-diameter-w-2-batteries-charger', '1', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1014, '2', '4899', 'plant starter kit', '81', '81', '800', 'https://growace.com/products/no-hassle-harvest-starter-kit-package', '5', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1015, '2', '4903', '4 backdraft damper', '72', '71', '100', 'https://growace.com/products/4-backdraft-damper', '1', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1016, '2', '4906', 'foxfarm ocean forest soil near me', '78', '78', '350', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1017, '2', '4910', '220 adapter', '77', '52', '900', 'https://growace.com/products/110v-to-220v-plug-adapter', '7', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1018, '2', '4913', 'hydroponic reservoirs', '78', '70', '350', 'https://growace.com/products/autopot-flexitank-collapsible-hydroponic-water-reservoir-60-gallons', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1019, '2', '4915', 'foxfarm ocean forest', '14', '8', '1800', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '2', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1020, '2', '4916', 'hydroponics reservoir', '78', '78', '350', 'https://growace.com/products/aircube-poptank-ultra-heavy-duty-collapsible-reservoir-60-gallon', '3', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1021, '2', '4919', '8 inch inline fan', '72', '27', '250', 'https://growace.com/products/active-air-8-inline-duct-fan-720-cfm', '0', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1022, '2', '4920', 'multi flow', '71', '71', '150', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '4', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1023, '2', '4921', 'micron bag', '71', '71', '200', 'https://growace.com/products/bubble-magic-shaker-bag-73-micron', '1', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1024, '2', '4927', 'were to buy perlite', '78', '82', '250', 'https://growace.com/products/perlite-2-4-cu-ft-bags', '3', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1025, '2', '4938', 'grow light spectrum chart', '73', '73', '250', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '22', '3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1026, '2', '4939', '3 gallon bags', '75', '64', '150', 'https://growace.com/products/3-gallon-pvc-grow-bags-10-pack', '0', '2.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1027, '2', '4946', 'ratchet rope', '77', '91', '250', 'https://growace.com/products/1-4-rop-ratchet-single-item', '0', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1028, '2', '4952', '4 gallon backpack sprayers', '76', '76', '150', 'https://growace.com/products/gro1-4-gallon-backpack-sprayer', '4', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1029, '2', '4955', 'duct connectors', '75', '75', '150', 'https://growace.com/products/8x8x8-y-duct-connector', '5', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1030, '2', '4965', 'led greenhouse lighting', '77', '70', '200', 'https://growace.com/products/greenhouse-expandable-string-lights-14awg-w-12w-led-6500k-grow-led-bulbs', '23', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1031, '2', '4969', '20 co2 tank', '77', '79', '150', 'https://growace.com/products/active-air-20-lb-co2-tank', '3', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1032, '2', '4985', 'herb drying rack', '82', '78', '1300', 'https://growace.com/products/yield-lab-2ft-herbal-hanging-dry-net-without-clips', '10', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1033, '2', '4994', 'active aqua water chiller', '77', '22', '150', 'https://growace.com/products/active-aqua-chiller-1-hp', '0', '1.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1034, '2', '4996', 'air pump for hydroponics', '79', '67', '300', 'https://growace.com/products/aquavitatm-9l-min-air-pump-4-outlet', '1', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1035, '2', '5004', 'black diamond led grow light', '66', '66', '150', 'https://growace.com/products/ltc-cool-diamond-led-grow-light', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1036, '2', '5009', '3/4 rubber grommet', '77', '60', '200', 'https://growace.com/products/3-4-top-hat-rubber-grommet-25-pieces-per-pack', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1037, '2', '5010', 'active 8', '80', '80', '700', 'https://growace.com/products/active-air-carbon-filter-8-x-39-950-cfm', '18', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1038, '2', '5013', '30 gallon nursery pots', '80', '74', '250', 'https://growace.com/products/30-gallon-prune-pots-fabric-grow-pots', '1', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1039, '2', '5035', 'filter for garden hose', '77', '73', '100', 'https://growace.com/products/hydrologic-grogreen-water-filter-for-garden-hose', '4', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1040, '2', '5041', '600 watts ballast', '83', '95', '350', 'https://growace.com/products/yield-lab-600w-digital-dimming-ballast', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1041, '2', '5049', 'water pressure guage', '79', '79', '300', 'https://growace.com/products/2-230-psi-water-pressure-gauge', '3', '1.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1042, '2', '5050', 'trimmer scissors', '77', '89', '100', 'https://growace.com/products/piranha-pruner-trimming-scissors-curved-titanium-blade', '2', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1043, '2', '5062', 'hoop house greenhouse', '86', '86', '1300', 'https://growace.com/products/grow1-heavy-duty-greenhouse-hoop-house', '27', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1044, '2', '5075', 'air carbon', '85', '85', '900', 'https://growace.com/products/active-air-carbon-filter-8-x-39-950-cfm', '7', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1045, '2', '5079', 'growers choice', '34', '34', '6500', 'https://growace.com/products/grower-s-choice-roi-e720-horticulture-led-grow-light', '24', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1046, '2', '5090', 'grow lights for greenhouse', '84', '50', '400', 'https://growace.com/products/greenhouse-expandable-string-lights-14awg-w-12w-led-6500k-grow-led-bulbs', '3', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1047, '2', '5092', '1 gallon bags', '81', '81', '200', 'https://growace.com/products/1-gallon-pvc-grow-bags-10-pack', '0', '1.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1048, '2', '5097', 'led light hangers', '79', '79', '100', 'https://growace.com/products/adjustable-grow-light-hanging-kit-2-pairs', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1049, '2', '5109', '4 gallon back pack sprayer', '84', '73', '350', 'https://growace.com/products/gro1-4-gallon-backpack-sprayer', '1', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1050, '2', '5127', 'ace potting soil', '83', '92', '300', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '0', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1051, '2', '5136', 'c02 regulator', '81', '81', '300', 'https://growace.com/products/co2-regulator-dual', '6', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1052, '2', '5138', 'scrog grow', '81', '63', '250', 'https://growace.com/products/scrog-kit-19-x25', '18', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1053, '2', '5140', 'lil helper', '78', '78', '150', 'https://growace.com/products/spectrum-king-mother-s-lil-helper-140w-v2-led-grow-light-system', '5', '0.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1054, '2', '5146', 'green house film', '79', '79', '100', 'https://growace.com/products/greenhouse-film-6mil-24-x100', '21', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1055, '2', '5149', 'duct silencer', '87', '43', '500', 'https://growace.com/products/6-inline-fan-noise-muffler-air-duct-silencer', '4', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1056, '2', '5164', 'hydroponic air pumps', '84', '84', '250', 'https://growace.com/products/aquavitatm-9l-min-air-pump-4-outlet', '1', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1057, '2', '5169', '220 to 120 adapter', '86', '93', '400', 'https://growace.com/products/110v-to-220v-plug-adapter', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1058, '2', '5171', 'green light for grow room', '70', '70', '100', 'https://growace.com/products/gro1-green-led-light-bulb-w-remote', '0', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1059, '2', '5172', 'best bubble bags', '80', '80', '100', 'https://growace.com/products/bubble-magic-all-mesh-extraction-bags-20-gallon-5-bag-kit', '6', '0.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1060, '2', '5176', 'indoor greenhouse lights', '80', '80', '100', 'https://growace.com/products/14-watt-advance-spectrum-led-grow-light-panel', '26', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1061, '2', '5186', 'full spectrum light', '92', '66', '2400', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '24', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1062, '2', '5191', 'natural g10', '83', '70', '200', 'https://growace.com/products/gravitation-g10', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1063, '2', '5194', 'flood trays', '85', '85', '250', 'https://growace.com/products/telescopic-flood-tray-brush', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1064, '2', '5210', 'verde humboldt nutrients', '72', '72', '150', 'https://growace.com/products/verde-humboldt-nutrients', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1065, '2', '5225', 'ufo led lights', '83', '93', '400', 'https://growace.com/products/225-watt-advance-spectrum-max-3w-chip-modular-led-grow-light-u-f-o-kit', '9', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1066, '2', '5226', 'led prism', '83', '79', '100', 'https://growace.com/products/sunblaster-12w-prism-lens-led-strip-light-6400k', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1067, '2', '5228', 'sun led', '86', '86', '250', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '16', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1068, '2', '5233', 'aquarium timers', '88', '89', '350', 'https://growace.com/products/viparspectra-203w-aquarium-light-timer-control-series-t300-led-grow-light', '2', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1069, '2', '5235', 'full light spectrum', '79', '79', '100', 'https://growace.com/products/advance-spectrum-900w-sun-series-8-bar-full-spectrum-led-grow-light', '26', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1070, '2', '5236', 'system 6', '81', '84', '200', 'https://growace.com/products/aircube-6-site-ebb-and-flow-hydroponic-system', '11', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1071, '2', '5239', 'closet case', '84', '58', '300', 'https://growace.com/products/spectrum-king-closet-case-140w-v2-led-grow-light-system', '2', '8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1072, '2', '5247', '4\" backdraft damper', '85', '85', '150', 'https://growace.com/products/6-backdraft-damper', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1073, '2', '5251', 'trimmer pots', '89', '89', '400', 'https://growace.com/products/16-metal-top-bowl-leaf-trimmer', '1', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1074, '2', '5262', 'heatmat thermostat', '88', '75', '250', 'https://growace.com/products/yield-lab-heat-mat-temperature-controller', '1', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1075, '2', '5272', 'quantum board led kit', '75', '82', '150', 'https://growace.com/products/horticulture-lighting-group-135-watt-v2-quantum-board-led-kit', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1076, '2', '5281', 'tent led lights', '86', '86', '150', 'https://growace.com/products/78x78-led-hydro-complete-indoor-grow-tent-system', '0', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1077, '2', '5290', 'mh lamps', '88', '64', '250', 'https://growace.com/products/hortilux-blue-daylight-super-metal-halide-mh-lamp-400w', '10', '2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1078, '2', '5292', '220 watt', '84', '81', '100', 'https://growace.com/products/mint-led-400-led-panel-220-watt', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1079, '2', '5294', 'glass bho extractor', '84', '84', '100', 'https://growace.com/products/glass-concentrate-extraction-tube-18-inches-l', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1080, '2', '5298', 'activated charcoal for filters', '86', '86', '150', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '39', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1081, '2', '5303', '240v relay', '84', '95', '150', 'https://growace.com/products/yield-lab-4-outlet-120v-240v-grow-light-relay-controller', '0', '1.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1082, '2', '5310', 'charcoal air purifier', '94', '94', '1300', 'https://growace.com/products/yield-lab-6-inch-purifier-activated-charcoal-filter', '4', '3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1083, '2', '5313', 'hydroponics air pumps', '91', '76', '400', 'https://growace.com/products/aquavitatm-9l-min-air-pump-4-outlet', '2', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1084, '2', '5314', '1/4 poly tubing', '85', '63', '250', 'https://growace.com/products/1-4-x-1000-clear-food-grade-poly-tubing', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1085, '2', '5326', 'hydroponic trees', '92', '92', '300', 'https://growace.com/products/greentree-hydroponics-multi-flow-6-site-ebb-and-flow-hydroponic-system', '2', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1086, '2', '5332', 'bubble bag', '89', '89', '600', 'https://growace.com/products/5-gallon-bubble-magic-extraction-bags-set-of-5', '2', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1087, '2', '5333', '1/2 hp water chiller', '86', '76', '100', 'https://growace.com/products/active-aqua-chiller-1-2-hp', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1088, '2', '5343', '2 gallon bags', '85', '85', '350', 'https://growace.com/products/2-gallon-pvc-grow-bags-10-pack', '2', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1089, '2', '5346', 'bullet trimmer', '86', '41', '100', 'https://growace.com/products/centurion-silver-bullet-wet-trimmer', '0', '0.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1090, '2', '5347', 'viparspectra 900w', '87', '87', '150', 'https://growace.com/products/viparspectra-390w-tc900-timer-control-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1091, '2', '5356', '10\" duct', '88', '68', '150', 'https://growace.com/products/10-x10-x10-t-duct-connector', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1092, '2', '5368', 'clip on hat light', '91', '91', '250', 'https://growace.com/products/grow1-green-cob-clip-hat-light', '1', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1093, '2', '5377', 'uvb led lights', '85', '93', '100', 'https://growace.com/products/california-light-works-solarsystemr-uvb', '5', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1094, '2', '5396', 'bubble hash bags', '50', '58', '1400', 'https://growace.com/products/32-gallon-bubble-bags-8-bag-set', '5', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1095, '2', '5407', 'gro glass', '89', '89', '100', 'https://growace.com/products/gro1-gruve-hps-glasses', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1096, '2', '5409', '3 gallon planting pots', '91', '91', '200', 'https://growace.com/products/yield-lab-fabric-3-gallon-growing-pots-5-pack', '3', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1097, '2', '5426', 'deep water culture guide', '90', '90', '100', 'https://growace.com/products/grow1-deep-water-culture-dwc-4-bucket-reservoir-complete-kit', '10', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1098, '2', '5432', 'olivia\'s cloning solution', '90', '90', '150', 'https://growace.com/products/olivia-s-cloning-gel-8-oz', '0', '0.25', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1099, '2', '5433', 'nitrate gloves', '89', '89', '300', 'https://growace.com/products/industrial-blue-nitrile-gloves-100-pack', '26', '9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1100, '2', '5440', 'sturdy greenhouse', '94', '94', '250', 'https://growace.com/products/grow1-heavy-duty-greenhouse-hoop-house', '27', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1101, '2', '5443', '6in duct', '91', '91', '150', 'https://growace.com/products/yield-lab-6-inch-440-cfm-duct-inline-fan-with-6-carbon-filter-ducting-and-clamps', '1', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1102, '2', '5460', 'eva-dry e-333 renewable mini dehumidifier', '90', '90', '150', 'https://growace.com/products/eva-dry-e-333-mini-dehumidifier', '5', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1103, '2', '5469', 'flood tray', '96', '60', '400', 'https://growace.com/products/telescopic-flood-tray-brush', '5', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1104, '2', '5475', 'scope cmh', '8', '13', '200', 'https://growace.com/products/gro1-led-slim-scope-100x', '0', '0.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1105, '2', '5480', 'black magic 1.5 cu. ft. potting soil', '99', '99', '500', 'https://growace.com/products/foxfam-ocean-forest-potting-soil-1-5-cu-ft', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1106, '2', '5481', '220 to 110 adapter', '28', '30', '4700', 'https://growace.com/products/110v-to-220v-plug-adapter-1', '12', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1107, '2', '5486', 'humboldt nutrients', '10', '10', '900', 'https://growace.com/products/master-a-humboldt-nutrients', '0', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1108, '2', '5494', 'rope ratchets', '92', '92', '100', 'https://growace.com/products/rope-ratchet-light-hangers-2-pack', '0', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1109, '2', '5498', 'nugsmasher mini', '18', '22', '4300', 'https://growace.com/products/nugsmasher-mini-rosin-press', '5', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1110, '2', '5499', '400 watt hps grow light kit', '84', '81', '150', 'https://growace.com/products/yield-lab-400w-hps-mh-wing-reflector-grow-light-kit', '1', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1111, '2', '5502', '400 cfm', '88', '88', '100', 'https://growace.com/products/active-air-6-inline-duct-fan-400-cfm', '0', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1112, '2', '5510', 'advanced platinum series grow light', '94', '94', '150', 'https://growace.com/products/advance-spectrum-680w-sun-series-8-bar-full-spectrum-led-grow-light', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1113, '2', '5511', 'scorpion diablo light', '82', '82', '150', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1114, '2', '5537', 'nitrile glove case', '98', '98', '250', 'https://growace.com/products/x3-industrial-blue-nitrile-gloves-case-quantity-case-of-2000', '7', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1115, '2', '5540', 'spider farmer 4000', '98', '99', '2600', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1116, '2', '5568', 'neem oil gallon', '95', '95', '100', 'https://growace.com/products/dyna-gro-pure-neem-oil-1-gal', '3', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1117, '2', '5570', '1/10 hp water chiller', '95', '44', '100', 'https://growace.com/products/active-aqua-chiller-1-10-hp', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1118, '2', '5573', 'water presure gage', '97', '95', '150', 'https://growace.com/products/2-230-psi-water-pressure-gauge', '3', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1119, '2', '5575', 'hanging net', '95', '95', '200', 'https://growace.com/products/yield-lab-3-herbal-hanging-dry-net-with-clips', '0', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1120, '2', '5580', 'spider farmer sf 4000', '99', '99', '2400', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1121, '2', '5591', 'humidity pack', '100', '98', '600', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '9', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1122, '2', '5618', 'phantom led grow lights', '88', '88', '200', 'https://growace.com/products/phantom-440w-pheno-100-277v-mp-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1123, '2', '5626', 'sf 4000', '100', '100', '1700', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '4', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1124, '2', '5641', 'cal-mag nutrients', '99', '99', '100', 'https://growace.com/products/lotus-nutrients-pro-series-cal-mag-15oz', '13', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1125, '2', '5646', 'de hps', '91', '91', '150', 'https://growace.com/products/b-lite-1000w-premium-de-hps-fixture', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1126, '2', '5647', 'spider farmer sf4000', '99', '99', '700', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1127, '2', '5650', 'where can i buy perlite', '99', '99', '100', 'https://growace.com/products/perlite-2-4-cu-ft-bags', '4', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1128, '2', '5652', '6x6 grow tent', '92', '75', '500', 'https://growace.com/products/mammoth-tent-classic200-6-6x6-6x6-6', '1', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1129, '2', '5654', 'quantum board led', '98', '98', '700', 'https://growace.com/products/horticulture-lighting-group-260-watt-v2-quantum-board-led-kit', '3', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1130, '2', '5655', '450 x 20', '90', '18', '100', 'https://growace.com/products/phat-filter-6-x-20-450-cfm', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1131, '2', '5660', 'phantom grow lights', '96', '96', '350', 'https://growace.com/products/phantom-440w-pheno-100-277v-mp-led-grow-light', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1132, '2', '5662', 'spider farmer sf-4000', '97', '97', '300', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1133, '2', '5667', 'growers choice 630w cmh', '93', '96', '100', 'https://growace.com/products/grower-s-choice-630w-ns-cmh-horticulture-lighting-fixture-no-bulb', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1134, '2', '5668', 'iponic 624', '92', '72', '100', 'https://growace.com/products/iponic-624-environmental-control', '0', '0.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1135, '2', '5672', 'spider farmer sf-4000 led grow light', '99', '101', '350', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1136, '2', '5677', 'crystal burst', '98', '20', '400', 'https://growace.com/products/crystal-burst-0-15-15', '0', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1137, '2', '5680', 'roi-e680 led grow light', '100', '100', '200', 'https://growace.com/products/grower-s-choice-roi-e680-horticultural-lighting-fixture', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1138, '2', '5687', 'bubble magic 20 gallon', '99', '99', '200', 'https://growace.com/products/20-gallon-bubble-magic-extraction-machine', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1139, '2', '5690', 'active air carbon filter', '98', '98', '100', 'https://growace.com/products/active-air-carbon-filter-6-x-16-400-cfm', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1140, '2', '5693', 'bubble magic bags', '97', '39', '100', 'https://growace.com/products/5-gallon-bubble-magic-extraction-bags-set-of-5', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1141, '2', '5705', 'earth juice ph up', '98', '98', '100', 'https://growace.com/products/earth-juice-crystal-ph-down-7-8-lbs', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1142, '2', '5707', 'cool tube', '96', '96', '100', 'https://growace.com/products/ga-optimal-400w-hps-cool-tube-reflector-digital-grow-light-kit', '1', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1143, '2', '5717', 'hlg 650r led', '100', '100', '100', 'https://growace.com/products/horticulture-lighting-group-hlg-650-v2-rspec-full-spectrum-led-grow-light', '9', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1144, '2', '5720', 'complete hydroponic grow system', '100', '100', '100', 'https://growace.com/products/78x78-led-hydro-complete-indoor-grow-tent-system', '12', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1145, '2', '5736', 'boveda 62', '34', '46', '900', 'https://growace.com/products/boveda-62-rh-2-way-humidity-control-large-67-gram-12-pack', '0', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1146, '2', '5739', 'spider farmer 4000 review', '101', '101', '100', 'https://growace.com/products/spider-farmer-sf4000-led-grow-light-system', '2', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1147, '2', '5745', 'hlg quantum board', '12', '19', '500', 'https://growace.com/products/horticulture-lighting-group-65-v2-4000k-qb120-quantum-board-led-kit', '4', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1148, '2', '5746', '240v extension cord', '41', '44', '1900', 'https://growace.com/products/grow1-240v-extension-cord-14-gauge-15', '1', '0.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1149, '2', '5747', 'timber grow lights', '15', '18', '1000', 'https://growace.com/products/timber-grow-light-model-3vl-led-grow-light-system', '5', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1150, '2', '5748', 'spectrum diablo 3', '36', '37', '150', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1151, '2', '5750', 'diablo 3 spectrum', '36', '34', '350', 'https://growace.com/products/horticulture-lighting-group-650w-scorpion-diablo-full-spectrum-led-grow-light', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1152, '2', '5751', 'rosin tech', '73', '73', '1200', 'https://growace.com/products/rosin-tech-pro-pneumatic-heat-press', '12', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1153, '2', '5753', 'hlg 550', '17', '11', '1200', 'https://growace.com/products/horticulture-lighting-group-hlg-550-v2-bspec-full-spectrum-led-grow-light', '3', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1154, '2', '5755', 'cob led grow light', '37', '19', '1100', 'https://growace.com/products/king-cob-480-watt-professional-series-high-coverage-cob-led-grow-light', '4', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1155, '2', '5764', 'quest dehumidifier', '50', '50', '5600', 'https://growace.com/products/quest-dual-225-overhead-commercial-dehumidifier-230-volt', '1', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1156, '2', '5768', 'duct booster fan', '70', '73', '2800', 'https://growace.com/products/yield-lab-4-booster-in-line-duct-fan', '5', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1157, '2', '5769', 'hlg led', '14', '12', '1700', 'https://growace.com/products/horticulture-lighting-group-hlg-30-uva-supplement-led-bar-light', '11', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1158, '2', '5772', 'rockwool cubes', '36', '37', '4500', 'https://growace.com/products/4-x-4-x-4-cultilene-rockwool-cubes', '7', '0.45', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1159, '2', '5773', 'full cycle', '53', '64', '2800', 'https://growace.com/products/yield-lab-60-x-48-x-80-2-in-1-full-cycle-reflective-grow-tent', '38', '1.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1160, '2', '5775', 'carbon air filter', '70', '70', '2700', 'https://growace.com/products/active-air-carbon-filter-10-x-39-1400-cfm', '6', '1.9', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1161, '2', '5776', 'electric timer', '96', '96', '2300', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '15', '1.4', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1162, '2', '5779', 'mini dehumidifier', '82', '82', '2300', 'https://growace.com/products/eva-dry-e-333-mini-dehumidifier', '12', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1163, '2', '5787', 'mylar tape', '68', '64', '1300', 'https://growace.com/products/3-x150-39-mylar-duct-tape', '0', '1.3', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1164, '2', '5791', 'water pressure gauge', '81', '81', '8400', 'https://growace.com/products/2-230-psi-water-pressure-gauge', '5', '1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1165, '2', '5794', 'king wing', '33', '34', '10000', 'https://growace.com/products/king-wing-de-reflector', '2', '0.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1166, '2', '5797', 'rosin tech press', '65', '65', '600', 'https://growace.com/products/rosin-tech-smash-manual-rosin-heat-press', '11', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1167, '2', '5798', 'master controller', '42', '46', '7300', 'https://growace.com/products/grower-s-choice-digital-lighting-master-controller', '12', '5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1168, '2', '5807', 'garden cloche', '63', '63', '3600', 'https://growace.com/products/yield-lab-garden-cloche-dome', '3', '0.6', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1169, '2', '5809', '110 to 220 adapter', '53', '37', '1100', 'https://growace.com/products/110v-to-220v-plug-adapter', '11', '0.5', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1170, '2', '5812', 'hood tube', '40', '22', '500', 'https://growace.com/products/yield-lab-air-cool-tube-hood-reflector', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1171, '2', '5815', 'blackdog led', '39', '32', '450', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '5', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1172, '2', '5817', '24 hour timer', '48', '48', '2900', 'https://growace.com/products/24-hour-programmable-electric-timer-control', '22', '1.1', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1173, '2', '5819', '5 gallon pot', '75', '56', '3100', 'https://growace.com/products/yield-lab-fabric-5-gallon-growing-pots-5-pack', '0', '0.35', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1174, '2', '5822', 'cmh scope', '38', '43', '400', 'https://growace.com/products/gro1-led-slim-scope-100x', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1175, '2', '5823', 'black dog led', '66', '66', '2500', 'https://growace.com/products/black-dog-phytomax-2-200-led-grow-light', '6', '0.7', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1176, '2', '5828', 'cmh the scope', '50', '33', '500', 'https://growace.com/products/gro1-led-slim-scope-100x', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1177, '2', '5831', 'v2 lighting', '51', '51', '150', 'https://growace.com/products/horticulture-lighting-group-260-watt-v2-quantum-board-led-kit', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1178, '2', '5834', 'tube 4 ace', '50', '58', '600', 'https://growace.com/products/agrobrite-t5-216w-4-4-tube-fixture-with-lamps', '0', NULL, 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1179, '2', '5837', 'growing naturals', '80', '80', '100', 'https://growace.com/products/grow-natural-humboldt-nutrients', '0', '0.8', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19'),
(1180, '2', '5840', 'scope cmh', '97', '71', '200', 'https://growace.com/products/gro1-led-slim-scope-100x', '0', '0.2', 1, '2021-11-11 09:03:19', '2021-11-11 09:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `excel_names`
--

CREATE TABLE `excel_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uploaded_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `excel_names`
--

INSERT INTO `excel_names` (`id`, `uploaded_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021-11-11 14:57:42', 1, NULL, NULL),
(2, '2021-11-11 15:03:18', 1, NULL, NULL);

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
(44, '2021_11_06_164341_create_sorting_tests_table', 25),
(45, '2021_11_11_125837_create_excel_names_table', 26),
(47, '2021_11_11_130242_create_excel_data_table', 27);

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
(35, 'Ariful Sikder', 'arif@wakeupict.com', '1111', '', 'Moderator', NULL, '$2y$10$WS45d/5q3ZJt8w2/Z56MdegnUSDKA5ocpiIgbgEfVhV5NC0cvuIja', NULL, '2021-10-21 03:45:59', '2021-10-31 03:36:22');

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
-- Indexes for table `excel_data`
--
ALTER TABLE `excel_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excel_names`
--
ALTER TABLE `excel_names`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
-- AUTO_INCREMENT for table `excel_data`
--
ALTER TABLE `excel_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1181;

--
-- AUTO_INCREMENT for table `excel_names`
--
ALTER TABLE `excel_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
