-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2021 at 04:33 PM
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `templete_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `blog_title`, `update_time`, `short_description`, `footer_title`, `templete_name`, `blog_image`, `status`, `created_at`, `updated_at`, `slug_title`) VALUES
(5, 3, 'ফ্রী Microsoft Office Program course', '2 Sep, 2021', '<p>যার ইনভাইট কার্যক্রম আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তাকে প্রথম বিজয়ী হিসেবে নির্ধারণ করা হবে। এবং দ্বিতীয় বিজয়ী কে লটারির মাধ্যমে নির্ধারণ করা হবে। আপনার সকল কার্যক্রম আমাদের IT Expert টিম দ্বারা মনিটরিং করা হবে সুতরাং উপরিউক্ত কোন একটি শর্তাবলী ও যদি কেউ বাদ রাখে তাহলে সে প্রতিযোগী হিসেবে গন্য হবে না।</p>', 'প্রতিযোগিতায় অংশগ্রহণের সময়সীমা ২৫ শে সেপ্টেম্বর পর্যন্ত।', '1', 'public/uploads/blog/images/1709785732805480.jpg', 1, '2021-09-02 04:32:20', '2021-09-02 04:35:31', 'test-1'),
(6, 4, 'Digital Influencers', '2 Sep, 2021', '<p><a href=\"https://www.facebook.com/sharnaislam.zenia?__cft__%5b0%5d=AZWGB8XGattP-prmDXhd8punrujJHl_NrMXx3zZ1Qy6R9QXZwpzBIFByqv_dxz52-L0gVKEGWmnHMn61B7iusOgjTSDPIFzzCbaGaJ12ZYcyaWRxKWAae7VlYQQ9J-kl2lddPdgjU1t4IKWEhfgIWtA4&amp;__tn__=-%5dK-R\">Sharna Islam Zenia</a> , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool.</p>', 'Digital Influencers', '1', 'public/uploads/blog/images/1709786428600101.jpg', 1, '2021-09-02 04:43:23', NULL, 'test-2'),
(7, 5, 'How to improve your graphic', '2 Sep, 2021', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709786782107086.png', 1, '2021-09-02 04:49:00', '2021-09-11 02:25:23', 'test-11'),
(9, 6, '______বিশেষ ঘোষণা______', '4 Sep, 2021', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে। আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১। লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে। আমাদের ওয়েবসাইটের ঠিকানা : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0t8aQBIW2uiaU-e99ghHGbEJ1bzjMjWApeVO0aWzT5gf675BqhemBZrdA\">www.wakeupict.com</a></p>', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', '1', 'public/uploads/blog/images/1709972456887809.jpg', 1, '2021-09-04 06:00:14', '2021-09-04 06:32:32', 'test-3'),
(10, 4, 'Nazmul Kobir', '4 Sep, 2021', '<p><a href=\"https://www.facebook.com/nazmulkadir0?__cft__%5b0%5d=AZV2l__FcnBINdS7BLYVoFFwl4qvYg13mL4m6OCoHQ7b6kqn1ZcDaofSgtq9V8_VEQsvZat6t5fpIXKByGDjSwASZsy4LlYJDYvSs5WKWgOkQEkHAOske3zodnj9-ZPXjMEc3Aazfob5h4UZNEG-cX8b&amp;__tn__=-%5dK-R\"><strong>Nazmul Kadir</strong></a><strong> </strong>, one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', 'Certificate', '1', 'public/uploads/blog/images/1709974649958454.png', 1, '2021-09-04 06:35:05', NULL, 'test-4'),
(11, 4, 'Md.Lotiful Azad', '4 Sep, 2021', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate. For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', 'Certificate', '1', 'public/uploads/blog/images/1709975349465187.jpg', 1, '2021-09-04 06:46:12', NULL, 'test-5'),
(12, 3, 'Microsoft Office', '4 Sep, 2021', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', 'Basic Computer', '1', 'public/uploads/blog/images/1709977970062088.png', 1, '2021-09-04 07:27:51', NULL, 'test-6'),
(13, 5, 'Graphic design', '4 Sep, 2021', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709981392457096.jpg', 1, '2021-09-04 08:22:16', NULL, 'test-7'),
(14, 7, 'Jute Mills Project', '4 Sep, 2021', '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.&nbsp;</p>', 'Jute Mills Project', '1', 'public/uploads/blog/images/1709981632078271.png', 1, '2021-09-04 08:26:04', NULL, 'test-8'),
(15, 7, 'Car Management Project', '4 Sep, 2021', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p>', 'Car Management Project', '1', 'public/uploads/blog/images/1709981828528950.jpg', 1, '2021-09-04 08:29:11', NULL, 'test-9'),
(16, 5, 'Logo Design', '4 Sep, 2021', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p>', 'Logo Design', '1', 'public/uploads/blog/images/1709981997906463.jpg', 1, '2021-09-04 08:31:53', NULL, 'test-10'),
(17, 8, 'Our Location', '4 Sep, 2021', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 'Our New Location', '1', 'public/uploads/blog/images/1709982203715550.png', 1, '2021-09-04 08:35:09', NULL, 'test-first');

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
(3, 'Basic Computer', 'Basic Computer', 1, '2021-09-02 04:26:25', NULL),
(4, 'Certificate', '<p>Certification</p>', 1, '2021-09-02 04:39:51', '2021-09-02 04:44:46'),
(5, 'Graphic design', 'Graphic design', 1, '2021-09-02 04:47:38', NULL),
(6, 'Free Development Course', 'Free Development Course', 1, '2021-09-04 05:57:46', NULL),
(7, 'Our Projects', 'Our Projects', 1, '2021-09-04 08:23:53', NULL),
(8, 'Our Location', 'Our Location', 1, '2021-09-04 08:34:11', NULL);

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

INSERT INTO `blog_contents` (`id`, `blog_id`, `title`, `templete_name`, `content_design`, `file_type`, `file`, `short_description`, `order`, `status`, `created_at`, `updated_at`) VALUES
(5, 5, 'Microsoft Office Program course', '1', 'Left side', 'Image', 'public/uploads/blog/images/1709786100069671.jpg', '<p>1. আমাদের ফেসবুক+লিংকডিন পেজ টি লাইক এবং ফলো করুন।</p><p>2. আমাদের ফেসবুক পেজ এ কমপক্ষে ১০০ জনকে ইনভাইট করুন।</p><p>3. আমাদের অফার পোস্ট এর কমেন্টে কমপক্ষে ২০ জন কে মেনশন করুন।</p><p>4. আমাদের ফেসবুকের অফার পোস্ট টি আপনার ফেসবুক প্রোফাইলে শেয়ার করুন ।</p><p>5. ইনভাইট করার সময় কমপক্ষে ১০০ জনকে সিলেক্ট করে স্ক্রীনশট সহ আপনার ফেসবুক</p><p>6. প্রোফাইল লিংক টি আমাদের পেজ এ ম্যাসেজ করুন।</p><p>7. যার ইনভাইট এর মাধ্যমে আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তার বিজয়ী হওয়ার সম্ভাবনা বেশী থাকবে।</p>', '1', 1, '2021-09-02 04:38:10', NULL),
(6, 6, 'Sharna Islam Zenia', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709786634527725.jpg', '<p><a href=\"https://www.facebook.com/sharnaislam.zenia?__cft__%5b0%5d=AZWGB8XGattP-prmDXhd8punrujJHl_NrMXx3zZ1Qy6R9QXZwpzBIFByqv_dxz52-L0gVKEGWmnHMn61B7iusOgjTSDPIFzzCbaGaJ12ZYcyaWRxKWAae7VlYQQ9J-kl2lddPdgjU1t4IKWEhfgIWtA4&amp;__tn__=-%5dK-R\">Sharna Islam Zenia</a> , one of our Digital Influencers, has successfully Communication Secrets certification from 10minuteschool.</p><p>Communication also plays an essential role in human life and professional life. Employee communication is vital to a company’s health and strength. Without it, managers will not be able to manage their managed staff properly. The success of a business depends on the effective implementation of an employee communication strategy.</p>', '2', 1, '2021-09-02 04:46:40', NULL),
(7, 7, 'Graphic design', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709786875072225.png', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', '1', 1, '2021-09-02 04:50:29', NULL),
(8, 9, 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', '1', 'Left side', 'Image', 'public/uploads/blog/images/1709972494163392.jpg', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে।</p><p>আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১।</p><p>লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে।</p><p>আমাদের ওয়েবসাইটের ঠিকানা : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0t8aQBIW2uiaU-e99ghHGbEJ1bzjMjWApeVO0aWzT5gf675BqhemBZrdA\">www.wakeupict.com</a></p>', '1', 1, '2021-09-04 06:00:49', '2021-09-04 06:32:15'),
(9, 10, 'Nazmul Kadir , one of our Digital Influencers', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709974702100420.png', '<p><a href=\"https://www.facebook.com/nazmulkadir0?__cft__%5b0%5d=AZV2l__FcnBINdS7BLYVoFFwl4qvYg13mL4m6OCoHQ7b6kqn1ZcDaofSgtq9V8_VEQsvZat6t5fpIXKByGDjSwASZsy4LlYJDYvSs5WKWgOkQEkHAOske3zodnj9-ZPXjMEc3Aazfob5h4UZNEG-cX8b&amp;__tn__=-%5dK-R\"><strong>Nazmul Kadir</strong></a> , one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', '1', 1, '2021-09-04 06:35:55', '2021-09-11 03:23:41'),
(10, 11, 'Md.Lotiful Azad', '1', 'Left side', 'Image', 'public/uploads/blog/images/1709975382529591.jpg', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google.</p><p>He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate.</p><p>For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', '1', 1, '2021-09-04 06:46:44', NULL),
(11, 12, 'Microsoft Office', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709978052985640.png', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', '2', 1, '2021-09-04 07:29:11', NULL),
(12, 13, 'WakeUpIct', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709981450447830.jpg', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', '2', 1, '2021-09-04 08:23:11', NULL),
(13, 14, 'Rajbari Jute Mills Projects', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709981683648684.png', '<p>&nbsp;</p><p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software. Recently they visit the Rajbari Jute Mill for collecting their Requirements and understand the environment of the Rajbari Jute mill. According to the Team Lead, They are playing to launch their first version of this Software end of this year. We are so thrilled about the journey ahead.</p>', '1', 1, '2021-09-04 08:26:53', NULL),
(14, 15, 'Car Management Project', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709981851934164.jpg', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p><p>Special thanks go to Folly Edem the Co-Organizer of GDG LOME for his interest in WAKEUPICT for build this project with modern technology.</p><p>Finally, we complete the project and deploy it on the server.</p>', '1', 1, '2021-09-04 08:29:33', NULL),
(15, 16, 'Cloud80', '1', 'Right side', 'Image', 'public/uploads/blog/images/1709982062615369.jpg', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p><p>They desire a logo for their company. Our Two Graphic Designers <a href=\"https://www.facebook.com/shaharimaafroj.sraboni.5?__cft__%5b0%5d=AZVXBESv4fiXNLd9HWK0-e3KO3gBEo8R0NWW04Tm8OtiL0CmtyRlsRcvLjcZ-hYgWJazoEbnsEsNnM2yOctsSSw1PPyGh8RzaA9QF8_JSn9TcyFi6zGrhjpa4Vs6JBAYyM4IblmSDRn0MvcNCqLd9S_R&amp;__tn__=-%5dK-R\">Shaharima Afroj Sraboni</a> and Asma Urmi do magnificent work on this project and develop very quality content based on client desire.</p>', '1', 1, '2021-09-04 08:32:55', NULL),
(16, 17, 'স্থান পরিবর্তন:', '1', 'Left side', 'Image', 'public/uploads/blog/images/1709982248715676.png', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', '1', 1, '2021-09-04 08:35:52', NULL);

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
(1, 'গ্রাফিক ডিজাইন', '৫,০০০/-', '<p>এই কোর্সে আমরা গ্রাফিক ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>Photoshop Tools and Uses and Shortcuts. &nbsp;File Management. &nbsp;Layer and History. &nbsp;Smart Object. &nbsp;Pattern. &nbsp;Custom Shape. &nbsp;Action Basic. &nbsp;Clipping Mask.</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যেখানে নিজের দক্ষতা (Skill) ও শিল্প (Art) ব্যবহার করে কোন ছবি, লেখা অথবা শব্দের সমন্বয়ে একটি অর্থবোধক শব্দ ছবি তৈরি করা। এই ছবি বিভিন্ন এডভেটাইজ, ম্যাগাজিন, বই, ওয়েবসাইট, লোগো &amp; টি শার্ট সাজানোর জন্য বিভিন্নভাবে ব্যবহার করা যেতে পারে। এই ছবিটা বানানোর জন্য আমাদের কিছু বিষয় সম্পর্কিত জ্ঞান এবং টুলস সম্পর্কিত জ্ঞান থাকা আবশ্যক।&nbsp;</p><p>&nbsp;</p><p>গ্রাফিক্স ডিজাইন জন্য দুইটি সফটওইয়ার ব্যবহার করা হয়। যেমনঃ Adobe Photoshop এবং Adobe Illustrator. এই সফটওয়ার দুইটি সম্পর্কে প্রাথমিক ধারণাসহ এর বিভিন্ন টুলস সম্পর্কে আলোচনা করব। যে টুলস গুলো রয়েছে, Photoshop Tools and Uses and shortcuts, File Management, Layer add History, Smart object, Pattern, Custom Shapes, Action Basic and এবং Cliping Mask ইত্যাদি। বেসিক গ্রাফিক্স ডিজাইন কোর্সে আমরা গ্রাফিক্স ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব।</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যার মাধ্যমে নিজের সৃজনশীলতা ব্যবহার করে ছবি বা নকশার মাধ্যমে নিজের প্রতিভাকে প্রকাশ করা যায়। বেসিক শিখলে আমরা ছবি এডিটিং,ব্যানার তৈরি , PSD ডিজাইন, Website Template Design করতে পারব। তাই আমরা যদি Graphics Design বেসিক কোর্সটি সম্পূর্ন করতে পারি তাহলে আমরা উল্লেখিত কাজগুলো করতে পারব।</p>', '<p>যেহেতু Adobe Photoshop এবং Adobe Illustrator ব্যতিক্রম Software। উল্লেখিত বেসিক গ্রাফিক্স ডিজাইন কোর্স অর্থাৎ Adobe Photoshop ও Adobe Illastrator শিখে আমরা যে সকল কাজের মাধ্যমে উপার্জন করতে পারব তার মধ্যে অন্যতম হলোঃ ১। স্টডিওতে ছবি এডিটিং ২। ছবির ব্যাকগ্রাউন্ড রিমুভ ইত্যাদি Graphics Design বেসিক কোর্সটি একজন Professional Graphics Designer হওয়ার পথটি সংকচন করে দেয়। এবং ভবিষ্যতে আমরা ফটোগ্রাফি ভিডিও এডিটিং , Animation, ভিজুয়্যাল ইফেক্টস সহ অনেক কিছু পেষা হিসাবে নিতে পারব। এবং একজন বেসিক গ্রাফিক্স ডিজাইন কোর্স হিসাবে Online জগতে বিভিন্ন মার্কেটপ্লেসে কাজ করে অর্থ উপার্জন করতে পারব। অবশ্যই Graphics Designer হতে হলে আমাদের অ্যাডভান্স গ্রাফিক্স ডিজাইন কোর্স শিকতে হবে।</p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">Graphic Design শিখে আমরা লোগো ডিজাইন, ব্যানার তৈরি, ভিডিও এডিটং এর কাজ বিভিন্ন national ও maltinational কোম্পানি, চলোচিত্র নির্মান কোম্পানি ইত্যাদিতে কাজ চাকরি করে অনেক টাকা উপার্জনের সুজগ আছে।</span></p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1710236792329709.png', 1, '2021-09-07 04:01:44', '2021-09-07 04:01:44', 'test-1'),
(2, 'ডিজিটাল মার্কেটিং', '৬,০০০/-', '<p>মার্কেটিং এর কনসেপ্টগুলো ডিজিটাল প্ল্যাটফর্মে এক্সিকিউট করাই ডিজিটাল মার্কেটিং। আমাদের এই কোর্সের ডিজিটাল মার্কেটিং এর বিস্তারিত বিষয়গুলো নিয়ে আলোচনা করা হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;Market Research<br>&nbsp;Data Analytics<br>&nbsp;Organic Marketing<br>&nbsp;Paid Marketing<br>&nbsp;CPA Marketing<br>&nbsp;Blog Marketing<br>&nbsp;1. Google Add Ward<br>&nbsp;2. Added Different<br>&nbsp;Marketplace Add Management</p>', '<p>বর্তমান সময়ে বিজ্ঞাপনের সকল মাধ্যমগুলোর মধ্যে বর্তমান সময়ের বহুল পরিচিত এবং সবথেকে জনপ্রিয় মাধ্যম হচ্ছে&nbsp; ডিজিটাল মার্কেটিং । যেখানে অডিয়েন্স আছে কোন পণ্য বা সেবার বিজ্ঞাপন সাধারণত সাধারণভাবে সেখানেই হয়। আমরা প্রতিনিয়ত যে সব ওয়েবসাইট ব্যবহার করছি সেখানে আমরা কোন পণ্য বা সেবার বিজ্ঞাপন দিয়ে খুব সহজেই কাস্টমার দিতে পারি। মার্কেটিং এর যাবতীয় কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগ করার জন্য যা জরুরী তা এখানে দেখানো হবে।</p>', '<p>পেশা বা ফ্রিল্যান্সার হিসেবে বর্তমান সময়ে ডিজিটাল মার্কেটিং এর প্রচুর চাহিদা রয়েছে। এছাড়া নিজের ব্যবসা সম্প্রসারণ করার জন্য ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা অপরিসীম। ব্যক্তিগত অথবা ব্যবসা যে প্রয়োজনে হোক ডিজিটাল মার্কেটিং এর পরিধি ক্রমশ বর্ধমান।</p>', '<p>যুগের সাথে তাল মিলিয়ে ব্যবসায়ের সমপ্রসারণ এর ক্ষেত্রে ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা আকাশচুম্বী। ডিজিটাল মার্কেটিং এর বাজার প্রতিনিয়ত পরিবর্তন হচ্ছে। ট্রেডিশনাল মার্কেটিং এর কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগের মাধ্যমে দ্রুত সময়ে বেশি সংখ্যক অডিয়েন্সের কাছে পৌঁছানো সম্ভব হচ্ছে । সুদূর ভবিষ্যতে ডিজিটাল মার্কেটিং এর চাহিদা আরো বেশি হবে।</p>', '<p>বর্তমান সময়ে দেশের মার্কেটিং এর প্রচুর চাহিদা রয়েছে। মার্কেটিং এর যাবতীয় টেকনিক ডিজিটাল উপায় প্রয়োগ করে সহজেই সম্ভব অডিয়েন্সের কাছে পৌঁছানো। এই কোর্স&nbsp;মার্কেট রিসার্চ, ডাটা এনালাইসিস, অর্গানিক মার্কেটিং, সিপিএ মার্কেটিং, গুগল এডওয়ার্ড, মার্কেটপ্লেস এবং ব্যবস্থাপনা নিয়ে আলোচনা করা হয়েছে । এই কোর্সটি সম্পন্ন করার পর বিভিন্ন মার্কেটপ্লেসে ফ্রিল্যান্সিং সহ চাকরির ক্ষেত্রে সহায়ক হবে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1710236846980857.png', 1, '2021-09-07 04:02:36', '2021-09-07 04:02:36', 'test-2'),
(3, 'ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', '৫,০০০/-', '<p>আমাদের এই কোর্সে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে দুইটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>HTML<br>CSS<br>PSD To HTML<br>Responsive Design<br>Bootstrap<br>2 Live Projects</p>', '<p>ওয়েব&nbsp;ডিজাইন হল একটি ওয়েবসাইটের ব্যাহিক রুপ যা আমরা দেখতে পাই বা দৃশ্য মান হয় । আর ওয়েব ডেভেলপমেন্ট হল ভেতরের সাইট যা আমরা দেখতে পাইনা । যেমন উদাহরণ সরুপ একটি গাড়ীর কথা চিন্তা করি । গাড়ির দরজা, জানালা, সিট ব্যাহিক সবকিছুই ওয়েব ডিজাইন এর মধ্যে পরে । আর গাড়ীর ভেতরের যেই মেকানিজম কাজ করে অর্থাৎ গাড়ীর ইঞ্জিন যে ভবে কাজ করে সেটা ওয়েব ডেভেলপমেন্টের মধ্যে পরে । মূল কথা এই যে, ওয়েব ডেভে লপমেন্ট একটি ওয়েবসাইটের প্রান সঞ্চারন করে। অনেকে মনে করে ওয়েব ডিজাইনে HTML, CSS নিয়ে কাজ করতে হয়, ধারনাটি ভুল। ওয়েব ডিজাই রা মূলত ফটোশপ, ইলাস্টেটর বিভিন্ন ওয়েব ফ্রেম দিয়ে ইউজার ইন্টারফেস একটি স্কেচ তৈরি করেন। একজন ওয়েব ডেভেলপার তিন ধরনের হতে পারে ফন্টইন্ড ওয়েব ডেভেলপার, ব্যকইন্ড ওয়েব ডেভেলপার এবং ফুলস্টাক ওয়েব ডেভেলপার। ফন্টইন্ড ডেভেলপার ওয়েবসাইটের ব্যহিক অংশ তৌরি করেন। ব্যকইন্ড ডেভেলপার ওয়েবসাইটের ভেতরের সারভার সাইটে কাজ করেন আর&nbsp; ফুলস্টাক ডেভেলপার ওয়েবসাইটের ফন্টইন্ড এবং ব্যকইন্ড&nbsp; দুই অংশেই কাজ করেন। এই সকল কাজই ডেভেলপমেন্টের পরিচিতি। ওয়েব ডেভেলপার যখন ওয়েব ডিজাইনার থেকে ইউজার ইন্টারফেস এর স্কেচ পাবে তখন ডেভেলপার কোড ইডিটর যেমন-নোটপ্যাড, সাবলাইম, ভিজুয়্যাল স্টডিও কোড এর মাধ্যমে কোডিং করে&nbsp; সেই ওয়েবসাইটের রুপ, প্রান প্রদান করবে। এইভাবেই একটি ওয়েব সাইট তার পূরনতা পাবে।</p>', '<p>যদি আমার চিন্তা এমন থাকে যে আমি ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখে&nbsp;কিভাবে&nbsp;সহজে&nbsp;আয়&nbsp;করবো’&nbsp; বা&nbsp;‘এটা&nbsp;শিখে&nbsp;কত&nbsp;টাকা&nbsp;আয়&nbsp;করবো&nbsp;’&nbsp;বা কীভাবে রাতা রাত্রি টাকা আয় করবো এই সকল চিন্তা যদি আমার থাকে তাহলে আমার জন্য় ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট নয় । আমার চিন্তা এমন থাকতে হবে যে,&nbsp;কোন&nbsp;কাজটা&nbsp;আমি&nbsp;শিখবো,&nbsp;&nbsp;‘আমি&nbsp;কোন&nbsp;কাজটা&nbsp;পারবো’।&nbsp;ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট সাধারনত শেখার জন্য়ে দরকার প্রচুর ধর্য এবং ডেডিকেশন ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ করে টাকা ইনকাম করার কোন লিমিট নেই আপনি যত বেশি কাজ&nbsp; করবেন যত বেশি দক্ষ্য হবেন আপনার&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট মাধমে টাকা ইনকা্মের পরিমান ততো বেশি বারবে ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ আপনার জানা থাকলে আপনি যেকোন যায়গায় বসে আপনি ক্লায়েন্ট এর কাজ করে দিতে পারবেন এর জন্য আপনার শুধু দরকার একটি লেপটপ আর নেট কানেকশন তাহলে আপনি খুব সহজেই কাজ সম্পাদন করতে পারবেন।&nbsp;ওয়েব&nbsp;ডেভেলপমেন্ট শিখে আপনি যদি HTML, CSS, PHP এর মধেই সিমাবদ্ধ থেকেন তাহলে আপনার কাজ করতে অসুবিধা হবে&nbsp; । আসলে প্রগ্রামিং এর কাজ এমন যে প্রতিনিয়ত আপডেট হতে থাকে তাই আপনাকে নতুনত্ব শিখতে হবে । সর্বশেষ বলতে চাই যে আপনি কাজ &nbsp;শিখে যাওয়ার পর আপনি অন্য যেকোনো পেশা থেকে এখানেই ভালো আয় করতে পারবেন আপনার কাজের অভাব হবে না।</p>', '<p>আজকাল বিভিন্ন ধরনের কাজ অনলাইন নির্ভর হয়ে পরেছে, যেই কারনে সারা বিশে প্রতিনিয়ত তৈরি হচ্ছে লক্ষ্য লক্ষ্য ওয়েবসাইট। কিন্তু সেই ওয়েবসাইট বানানোর জন্য তেমন দক্ষ্য ওয়েব ডেভেলপার নেই। এই জন্যে একজন দক্ষ্য ওয়েব ডেভেলপারে চাহিদা বাপ্যক। যার কারনে একজন দক্ষ্য ওয়েব ডেভেলপার এর ভবিষ্যৎ উজ্জ্বল । এই কাজ শিখা থাকলে ঘরে বসেই বিভিন্ন ওয়েবসাইট কাজ করতে পারবে যেমন-&nbsp; Upwork, Fiver, Freelancer, Theme-forest এ কাজ করে অনেক টাকাইন কাম করতে পারবে।</p>', '<p>বর্তমান সময়ে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর ব্যাপক চাহিদা রয়েছে। বাংলাদেশের অনেক প্রতিষ্ঠান রয়েছে যারা দক্ষতার ওপর ভিত্তি করে ওয়েব ডিজাইনার অথবা ডেভেলপার নিয়োগ দিয়ে থাকে। ওয়েব ডিজাইন এবং ডেভেলপমেন্ট কোর্স শেষ করার পর বিভিন্ন মার্কেটপ্লেসে কাজ করা সহ বিভিন্ন প্রতিষ্ঠান ডিজাইনার অথবা অথবা ডেভেলপার হিসেবে চাকরি করার সুযোগ রয়েছে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1710236833144120.png', 1, '2021-09-07 04:02:22', '2021-09-07 04:02:22', 'test-3'),
(4, 'অ্যাডভান্স গ্রাফিক ডিজাইন', '৫,০০০/-', '<p>এই করছে আমরা গ্রাফিক ডিজাইনের অ্যাডভান্স ফিচার এবং কাজ সম্পর্কে জানব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য অবশ্যই বেসিক গ্রাফিক ডিজাইন সম্পর্কে ধারণা থাকতে হবে।</p>', '<p>এখানে আপনারা যা শিখবেন:</p><p>&nbsp;Business Card Design<br>&nbsp;Logo Concept Realization<br>&nbsp;Web Banner Design<br>&nbsp;Flyer Design<br>&nbsp;Book Cover Design<br>&nbsp;Facebook Cover Design<br>&nbsp;T-shirt Design</p>', '<p>অ্যাডভান্সড গ্রাফিক ডিজাইন কোর্স এমন লোকদের জন্য ডিজাইন করা হয়েছে যারা গ্রাফিক ডিজাইনের সাথে পরিচিত এবং সরঞ্জাম এবং এর ব্যবহার সম্পর্কে জানেন। গ্রাফিক ডিজাইনারগণ মিডিয়া এবং ওয়েব ডিজাইন, প্যাকেজিং, চিত্রণ, অ্যানিমেশন এবং অন্যান্য ক্ষেত্রে তাদের নকশা দক্ষতা কাজে লাগান। ধারণাটি তৈরিতে সহায়ক এবং দক্ষতার সাথে প্রকল্পের সংখ্যা অন্তর্ভুক্ত করার দক্ষতাগুলি হাইলাইট করার জন্য স্তরটি উন্নত।</p>', '<p>ক্যারিয়ারের সম্ভাবনা, ফ্রিল্যান্সের সুযোগ, আর্থিক লাভ, শিল্প ও নকশার প্রতি ভালবাসা বা পয়েন্ট তৈরির জন্য অ্যাডভান্স গ্রাফিক ডিজাইন| লোগো, ব্র্যান্ডিং, ওয়েবসাইটগুলি, মুদ্রণ ইত্যাদিতে শিল্পীদের নিজের কাজ করার জন্য প্রচুর জায়গা রয়েছে যা অ্যাডভান্স গ্রাফিক ডিজাইন এর মাধ্যমে জানতে ও শিখতে পারবে। অনেকগুলি সুযোগের সাথে সম্ভাবনাগুলি ভাল, যে কোনও গ্রাফিক ডিজাইনারের সর্বদা কাজ থাকে। নিজেকে এমনভাবে প্রকাশ করা যা সত্যই আপনার নিজস্ব- গ্রাফিক ডিজাইন দিয়ে আপনাকে আপনার ক্লায়েন্টের প্রয়োজনের সাথে কাজ করার সময় আপনাকে নিজের স্থান তৈরি করতে দেয়। একজন গ্রাফিক ডিজাইনার হিসাবে আপনি নিজের রাউন্ডগুলিকে আলাদা আলাদা আর্ট স্টুডিওগুলি তৈরি করবেন এবং অনেকগুলি সৃজনশীল সাদৃশ্যযুক্ত লোকের সাথে সাক্ষাত করতে পারবেন।</p>', '<p>দিন দিন বিশ্ব আরও ডিজিটাল হয়ে উঠছে। একটি ভাল দৃষ্টিভঙ্গি দ্বারা তৈরি বিজ্ঞাপনটি এমন কোনও ধারণাগুলি প্রকাশ করতে পারে যা কখনই শব্দ দিয়ে প্রকাশ করা যায় না গ্রাফিক ডিজাইনে ক্যারিয়ারের সুযোগটি সারা বিশ্ব জুড়ে দাবি করছে। গ্রাফিক ডিজাইনের দুটি দুর্দান্ত সুযোগ হল ফ্রিল্যান্সিং এবং আউটসোর্সিং। গ্রাফিক ডিজাইনের কোর্সটি বিভিন্ন ক্রিয়েটিভ ক্যারিয়ারের বিভিন্ন প্যালেটকে অন্তর্ভুক্ত করার জন্য আপনার বিকল্পগুলি প্রসারিত করে যা বিজ্ঞাপন সংস্থাগুলি এবং শিল্প নকশা সংস্থাগুলির মতো উচ্চ সৃজনশীল সংস্থায় নেতৃত্বের অবস্থানগুলিতে প্রসারিত করতে পারে। পাশাপাশি আমরা প্রশিক্ষণের জন্য সাহায্য করি। আপনি Google বা Naukri, shine, Glassdoor প্রকৃতপক্ষে ইত্যাদির মতো কোনও ওয়েবসাইটের পরামর্শের মাধ্যমে অনুসন্ধান করে গ্রাফিক ডিজাইনার কাজগুলি সম্পর্কে জানতে পারেন। বিগ এমএনসি সংস্থাগুলি থেকে স্টার্টআপসে অভিজ্ঞ কর্মরত পেশাদারদের জন্য রয়েছে প্রচুর পরিমাণে জব ওপেনিং।</p>', '<p>১. ফ্রিল্যান্সিংঃ ফ্রিল্যান্সার হিসাবে পরিচালনা করা, আপনার নিজের ব্যবসায়ের মালিকানা সৃজনশীল আত্মার জন্য বিশেষত স্বাধীনতা এর অনেক<br>সুবিধা রয়েছে তবে আপনি আরও অর্থোপার্জন করতে পারেন।</p><p>&nbsp;</p><p>২. নিয়োগঃ যদি আপনার ব্যক্তিত্বের ধরণ (অনুশাসিত?) – বা পরিস্থিতি অবিচ্ছিন্ন আয়ের প্রয়োজন হয় তবে আপনাকে কোথাও কোথাও চাকরি নিতে হতে পারে।<br>বিজ্ঞাপন সংস্থাগুলি আপনাকে কাজে নিবে যদি আপনি প্রকৃতপক্ষে ভাল হন এবং দ্রুত এবং অবিরত সময়সীমার পরে সময়সীমা পরিচালনা করতে সক্ষম হন।<br>সংবাদপত্র এবং ছোট মুদ্রণের দোকানগুলিতেও নিয়মিতভাবে গ্রাফিক শিল্পী প্রয়োজন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1710236812319725.png', 1, '2021-09-07 04:02:03', '2021-09-07 04:02:03', 'test-4'),
(5, 'সোশ্যাল মিডিয়া মার্কেটিং', '৬,০০০/-', '<p>সোশ্যাল মিডিয়া মার্কেটিং হল কোন পণ্য বা সেবার প্রচারে উদ্দেশ্যে সোশ্যাল মিডিয়া যেমন ফেইসবুক, টুইটার বা অন্য কোন সোশ্যাল ওয়েবসাইট ব্যবহার করা।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;Instagram<br>&nbsp;Facebook<br>&nbsp;Twitter<br>&nbsp;Pinterest<br>&nbsp;YouTube Marketing<br>&nbsp;LinkedIn Marketing<br>&nbsp;App Marketing<br>&nbsp;Pure Content Marketing</p>', '<p>সোশ্যাল মিডিয়া মার্কেটিং এমন একটি পদ্ধতি যেখানে বিভিন্ন সামাজিক মাধ্যম যেমন ফেসবুক ,ইউটিউব, ইনস্টাগ্রাম, লিঙ্কডিন ইত্যাদি প্লাটফর্ম এর একটিভ মানুষকে টার্গেট&nbsp; করে নিজের পন্যের বা ব্যাবসার প্রচার প্রচারনা চালানো যায় ।এই মার্কেটিং ব্যাবস্থা ইন্টারনেটভিত্তিক হওয়ার কারনে এবং সামাজিক যোগাযোগ মাধ্যমগুলোর জনপ্রিয়তার কারনে সহজেই সকলের কাছে দ্রুততার সাথে প্রচার চালানো যায় । সোশ্যাল মিডিয়া ব্যাবহার করে যেকোনো ব্রান্ড ,জিনিস বা সার্ভিস বিশ্বের যেকোনো যায়গায় ইন্টারটের মাধ্যমে প্রচার করা যায় বলে মার্কেটিং এর জন্য এই প্রক্রিয়া সেরা ।</p>', '<p>আমাদের এই কোর্সটি করলে আপনি পাবেন সারাজীবন এর জন্য সাপোর্ট যেকোনো সময় যেকোনো প্রশ্ন করলে রেসপন্স পাবেন এই কোর্স এর মাধ্যমে আপনি বড় বড় সামাজিক মাধ্যমগুলো সম্পর্কে বিস্তারিত জানতে পারবেন কোর্স শেষ করে মার্কেটপ্লেসে কাজ পাওয়ার নিশ্চিত সুবিধা ।</p>', '<p>&nbsp;মানুষ বৃদ্ধির সাথে সাথে দিনে দিনে মানুষের প্রয়োজন ও বৃদ্ধি পাচ্ছে । সেই সাথে বৃদ্ধি পাচ্চে সামাজিক যোগাযোগ মাধ্যম গুলোর জনপ্রিয়তা এবং ব্যাবহার । এত অধিক মানুষের কাছে সহজেই নিজের ব্যাবসা ,পন্য কিংবা সার্ভিস পৌছানোর জন্য সোশ্যাল মিডিয়া মার্কেটিং এর বিকল্প নেই ।সহজেই কম সময়ে কম খরচে ঘরে বসেই বেশি ট্রাফিক পাওয়ার কারনে দিনে দিনে এর চাহিদা এবং জনপ্রিয়তা বেড়েই চলছে ।ভবিষ্যতেও সোশ্যাল মিডিয়া মার্কেটিং এর চাহিদা অধিক হারে বৃদ্ধি পাবে এ ব্যাপারে সন্দেহ নেই ।</p>', '<p>এই কোর্সটি সম্পূর্ণ করার পর আপনি সহজেই যেকোনো ব্যবসা বা পন্যের প্রমোশন করতে পারবেন বিনা খরচেই বা অনেক কম খরচেই অধিক পরিমান বিজ্ঞাপন প্রচার করতে পারবেন নির্দিষ্ট টার্গেট অনুযায়ী সহজেই প্রচার প্রচারনা করতে পারবেন যা যথেষ্ট সুবিধাজনক। সহজেই আপনার প্রমোশন গ্রো আপ করবে এবং অধিক ট্রাফিক পাবেন আপনি চাইলে মার্কেটপ্লেসে যেমন আপওয়ার্ক,ফ্রিল্যান্সার,ফাইভার এ অন্যের প্রডাক্ট প্রচার করে অধিক উপার্জন করতে পারবেন আর এই সব কাজগুলো আপনি সহজেই ঘরে বসেই করতে পারবেন ।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1710236762031147.png', 1, '2021-09-07 04:01:15', '2021-09-07 04:01:15', 'test-5'),
(6, 'অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', '৭,৫০০/-', '<p>আমাদের এই কোর্সে অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে তিনটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর প্রাথমিক ধারণা থাকতে হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;CSS Framework (Bootstrap)<br>&nbsp;PSD To HTML<br>&nbsp;JavaScript Library (jQuery)<br>&nbsp;PHP Framework (Laravel)<br>&nbsp;3 Live Projects<br>&nbsp;Freelancing</p>', '<p>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো কোনো টেমপ্লেটকে আরও সুন্দর ভাবে সাজানো। এক্ষেত্রে HTML, CSS , CSS এর ফ্রেমওয়ার্ক Bootstrap,JavaScript এর ফ্রেমওয়ার্ক jQuery ব্যবহার করে টেমপ্লেট ডিজাইন করা হয়। ডিজাইন এর ফ্রেমওয়ার্কগুলো ব্যবহার করে টেমপ্লেট এর কোথায়, কীভাবে তথ্যগুলো দেখানো হবে সেটা নির্ধারণ করাই হলো এডভান্স ওয়েব ডিজাইনারের কাজ।<br>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো সমৃদ্ধ-বৈশিষ্টযুক্ত ওয়েবসাইট এবং ওয়েব পোর্টাল তৈরি করা। সাধারণত এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্টে জাভাস্ক্রিপ্ট, পিএইসপি, সিএমএস এবং তাদের ফ্রেমওয়ার্কগুলি ব্যবহার করা হয়। বিভিন্ন ধরনের ম্যানেজমেন্ট সফটওয়ার তৈরি করা হয়। এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখতে হলে অবশ্যই HTML, CSS, JavaScript, jQuery, PHP বেসিক জ্ঞান থাকতে হবে। এরপর ডেভেলপমেন্ট করতে হলে PHP ফ্রেমওয়ার্ক Laravel শিখতে হবে। একজন ওয়েব ডিজাইনারের ডিজাইনকৃত ওয়েব টেমপ্লেট এর প্রতিটি স্ট্যাটিক উপকরণকে PHP ফ্রেমওয়ার্ক (Laravel) দিয়ে ফাংশনাল এবং ডাইনামিক করাকেই এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট বলে। একজন ভালো ওয়েব ডেভেলপার হতে হলে অবশ্যই আপনাকে HTML, CSS, JavaScript,jQuery, Bootstrap, PHP(Laravel), MySQL সম্পর্কে অনেক জ্ঞান থাকতে হবে।</p>', '<p>বর্তমানে বেকারত্ব দূর করার সহজ উপায় হলো ফ্রিল্যান্সিং করা এবং ফ্রিল্যান্সিং করে বাংলাদেশসহ বিশ্বের অনেক দেশ আজ অনেকটাই বেকারত্ব দূর করতে পারছে। এক্ষেত্রে আমাদের দেশ ও পিছিয়ে নেই। আমাদের এই কোর্স এ এডভান্স ওয়েব পেজ ডিজাইন এন্ড ডেভেলপমেন্ট সম্পর্কে বিশদ শেখানো হবে। এই কোর্সে আমরা CSS Framework(Bootstrap), PSD To HTML, JavaScript Library(jQuery), PHP Framework(Laravel), 3 Live Projects and Freelancing সম্পর্কে বিস্তারিত শেখাবো। আপনি কোডিং এর এডভান্স ফ্রেমওয়ার্কগুলো শেখার পর ৩ টি লাইভ প্রোজেক্ট পাচ্ছেন যার মাধ্যমে আপনি জানতে পারবেন কীভাবে লাইভ প্রোজেক্ট বা ক্লাইন্টের কাজ করতে হয়। আপনাকে শেখানো হবে ফ্রিল্যান্সিং যাকে মুক্ত পেশাও বলে। এই পার্ট থেকে আপনাকে শেখানো হবে কীভাবে ক্লাইন্ট এর কাজ করা যায় এবং ফ্রিল্যান্সিং করে অর্থ উপার্জন করা যায়।</p>', '<p>বর্তমান যুগ হলো টেকনোলজির যুগ। দিন দিন অনেক অনেক কোম্পানী প্রতিষ্ঠিত হচ্ছে এবং বর্তমানে প্রায় সব কোম্পানী বা বড় বড় দোকানের তাদের মার্কেটিং এর জন্য ওয়েবসাইট দরকার হয়। এবং দিন দিন এটা বেড়েই চলেছে এবং অনেকেই অর্থ উপার্জন করছে। ভবিষ্যতে এর চাহিদা বেড়েই যাবে। এই পেশায় প্রাথমিক পর্যায়ে ১০ থেকে ২০ হাজার টাকা বেতনে কোম্পানীর কাজ করা যায় এবং ৩ থেকে ৫ বছর পরে আপনি একজন ইঞ্জিনিয়ার না হয়েও একজন ইঞ্জিনিয়ারের সমতুল্য বেতনে অর্থাৎ ৮০ হাজার থেকে এক লাখ টাকা পর্যন্ত বেতনে চাকরি করতে পারবেন। বাইরের ক্লাইন্টের কাজ করেও নিজের ভবিষ্যত উজ্জ্বল করতে পারবেন।</p>', '<p>কোর্স শেষে আপনি বিভিন্ন মার্কেট প্লেসে কাজ করে অর্থ উপার্জন করতে পারবেন। পাশাপাশি বিভিন্ন কোম্পানির কাজও করে দিতে পারেন। অনলাইন মার্কেটপ্লেসগুলোর মধ্যে রয়েছ, upwork.com, freelancer.com, fiverr.com ইত্যাদি। এসব মার্কেটপ্লেসে ওয়েব পেইজ ডিজাইনার এন্ড ওয়েব ডেভেলপারদের ব্যাপক চাহিদা রয়েছে। কাজ অনুযায়ী আপনি প্রতি ঘন্টায় ২ থেকে ১০০ ডলার ইনকাম বা আয় করতে পারবেন। এছাড়াও আপনি আপনার তৈরি করা ওয়েবসাইট বিভিন্ন কোম্পানির কাছে বিক্রি করতে পারবেন। তাছাড়া themeforest.net এবং codecanyon.net এই দুই মার্কেটপ্লেসেও বিক্রি করে আয় করতে পারেন। বিদেশী কোম্পানীসহ আমাদের দেশে বিভিন্ন সফটওয়ার কোম্পানীতে Web Designer and Web Developer হিসেবে জব করতে পারবেন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1710236722282643.png', 1, '2021-09-07 04:00:37', '2021-09-07 04:00:37', 'test-6');

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
  `course_order` int(255) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_items`
--

INSERT INTO `course_items` (`id`, `course_id`, `item_title`, `course_order`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '6', 'সিএসএস ফ্রেমওয়ার্ক (বুটস্ট্রাপ)', 1, '<p>বুটস্ট্রাপ (Bootstrap) হলো একটি ফ্রি এবং ওপেন সোর্স CSS ফ্রেমওয়ার্ক যার মাধ্যমে খুব সহজেই ওয়েবসাইটে রেস্পোন্সিভ, মোবাইল ফ্রেন্ডলি করা যায়। এতে কিছু জাভাস্ক্রিপ্ট মিশ্রিত রয়েছে যা খুব সহজে ডিজাইনটিকে চমৎকার করে দেয়। বর্তমানে কাস্টম সিএসএস ব্যবহার না করে প্রায় সব ওয়েব পেইজকে Bootstrap এর সাহায্যে ডিজাইন করা যায়।</p>', '1', '2021-08-25 08:03:03', '2021-08-29 03:55:51'),
(3, '6', 'সিএসএস', 2, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">পূর্বে বলা হয়েছে html একটি Document এর গঠন বা স্ট্রাকচার। এই গঠনের Style বা রঙ করার জন্য যে ভাষা ব্যবহার করা হয় তাকে CSS বলে। CSS এর পূর্নরুপ হলো Cascading Style Sheets</span></p>', '1', '2021-08-26 03:19:35', '2021-09-06 06:03:47'),
(4, '5', '1', 1, '<p>sdfsdfdfds</p>', '1', '2021-08-26 04:20:37', NULL),
(5, '6', 'রেস্পন্সিভ ডিজাইন', 4, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">ওয়েব সাইডের বিভিন্ন সাইজ বা মাপ আছে ।যেমন আপনার মোবাইল আর কম্পিউটাররের পরিমাপ কখনোই এক নয়। তাই একটি ওয়েব সাইডকে ডেক্সটপ, ট্যাব, ট্যাবলেট, স্মার্টফোনের ব্রাউজারের জন্য আলাদা আলাদা পরিমাপে ব্যবহার উপযোগি করে গঠন করাই হলো Responsive Design।</span></p>', '1', '2021-08-26 06:01:12', '2021-09-06 06:04:37'),
(6, '5', 'social item', 2, '<p>socila item&nbsp;</p>', '1', '2021-08-26 06:02:05', NULL),
(7, '4', 'এইচটিএমএল (ক্লাস সংখ্যা: ৫)', 1, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">HTML হচ্ছে একটি Document এর গঠন বা স্ট্রাকচার। HTML এর পূর্নরুপ হলো Hyper Text Markup Language। এটি দিয়ে ব্রাউজারে তথ্য প্রদর্শন করা হয়। html ল্যাংগুয়েজটি ওয়েব পেজে লেখা, অডিও, ভিডিও, স্থির চিত্র ইত্যাদি ব্যবহারের জন্য কাজে আসে। ওয়েব পেজে সবচে বেশি html ব্যবহার করা হয়ে থাকে। Programming শেখার প্রাথমিক ধাপ হচ্ছে html ল্যাংগুয়েজ।</span></p>', '1', '2021-09-06 06:02:04', NULL),
(8, '6', 'জাভাস্ক্রিপ্ট', 5, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">জাভাস্ক্রিপ্ট হলো একটি ক্লাইন্ট সাইড ভাষা বা ল্যাংগুয়েজ। এবং এটি একটি ব্রাউজার স্ক্রিপ্টিং ল্যাঙ্গুয়েজ । ব্রাউজার স্ক্রিপ্টিং ল্যাংগুয়েজ হল প্রোগ্রামিং ল্যাঙ্গুয়েজের সংক্ষিপ্ত ও সহজ ফর্ম বা রুপ। জাভাস্ক্রিপ্টে দিয়ে অনেক ছোট প্রোগ্রাম বা অল্প কিছু প্রোগ্রাম দিয়ে অনেক বড় বড় কাজ করা যায়।</span></p>', '1', '2021-09-06 06:05:21', NULL),
(9, '6', 'পিএইচপি', 6, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">PHP দিয়ে ওয়েব Application করা হয়। মনে ক্রুন আপনার এমন একটি ওয়েবসাইড প্রয়োজন যেটি দিয়ে আপনি আপনার অনলাইন শিক্ষার্থীদের তথ্য আপনার ওয়েবসাইডের মাধ্যমে আপনার কাছে পেতে চাচ্ছেন। যে ল্যাঙ্গুয়েজে আপনার প্রয়োজন সেটি হচ্ছে PHP। পূর্বে PHP এর পূর্নরুপ ছিল Personal Home Page. এটি একটি Server Based Programming Language।</span></p>', '1', '2021-09-06 06:06:36', NULL),
(10, '6', '২টি লাইভ প্রজেক্ট', 7, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">এই কোর্স সে আপনারা দুইটি লাইভ প্রজেক্ট করবেন, কোথাও আটকে গেলে আমরা সমাধান করব।</span></p>', '1', '2021-09-06 06:07:22', NULL),
(11, '1', 'অ্যাডোব ইলাস্ট্রেটর', 1, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">অ্যাডোব ইলাস্ট্রেটর একটি সফটওয়ার যা কম্পিউটারে ব্যবহার করে অঙ্কন, চিত্র এবং শিল্পকর্ম তৈরি করা হয়। তবে ইলাস্ট্রেটর উচ্চ মানের শিল্পকর্ম তৈরিতে ব্যবহার করা হয়।</span></p>', '1', '2021-09-06 06:09:33', NULL),
(12, '1', 'এডোবি ফটোশপ', 2, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">অ্যাডোব ফটোশপ হলো এমন একটি সফটওয়ার যার মাধ্যমে নিজের সৃজনশীলতাকে কাজে লাগিয়ে কোনো ইমেজ এডিটিং করে নতুন রূপ দেয়া হয়। সাধারণত ফটোশপ বেসিক এ তার বেসিক টুলস গুলো ব্যবহার করে কাজ করা হয়।</span></p>', '1', '2021-09-06 06:10:22', NULL),
(13, '2', '1', 1, '<p>1</p>', '1', '2021-09-11 05:30:04', NULL),
(14, '2', '2', 2, '<p>2</p>', '1', '2021-09-11 05:30:14', NULL),
(15, '2', '3', 3, '<p>3</p>', '1', '2021-09-11 05:30:23', NULL),
(16, '2', '4', 4, '<p>4</p>', '1', '2021-09-11 05:30:29', NULL),
(17, '2', '5', 5, '<p>5</p>', '1', '2021-09-11 05:30:36', NULL),
(18, '2', '6', 6, '<p>6</p>', '1', '2021-09-11 05:31:26', NULL),
(19, '2', '7', 7, '<p>7</p>', '1', '2021-09-11 05:31:34', NULL),
(20, '2', '8', 8, '<p>8</p>', '1', '2021-09-11 05:31:40', NULL),
(21, '2', '9', 9, '<p>9</p>', '1', '2021-09-11 05:31:47', NULL),
(22, '2', '10', 10, '<p>10</p>', '1', '2021-09-11 05:31:58', NULL),
(23, '2', '11', 11, '<p>11</p>', '1', '2021-09-11 05:32:06', NULL);

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
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `slider_image`, `slider_alt`, `description`, `slider_active`, `status`, `created_at`, `updated_at`) VALUES
(4, 'public/uploads/slider_image/images/1710706159084214.png', 'image alt 2121', '<p>sd</p>', 1, 1, '2021-09-12 08:22:07', '2021-09-12 08:22:07'),
(5, 'public/uploads/slider_image/images/1710702316981138.png', 'sdfd', '<p>sdfsd</p>', 1, 1, '2021-09-12 07:21:03', NULL),
(6, 'public/uploads/slider_image/images/1710706171744160.png', 'sdf', '<p>sdfds</p>', 1, 1, '2021-09-12 08:22:19', '2021-09-12 08:22:19');

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
(26, '2021_09_12_093218_create_home_sliders_table', 11);

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
(1, 'Home', 'Home Page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-07 03:41:56', '2021-09-07 03:41:56'),
(2, 'About', 'About page', 'www.google.come', 'og locale about', 'og type about', 'og url about', 'og side name about', 'ms validate about', '<p>about description. about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;</p>', 'article publisher about', '19 Aug, 2021', 'public/uploads/SEO/images/1708522539636513.png', '324', '3423', 'twitter card about', 'twitter label 1 about', 'twitter data 1 about', 'google side varification about', '1', '2021-08-29 03:12:42', '2021-08-29 03:12:42'),
(3, 'Academic', 'Academic Trainings', NULL, NULL, NULL, NULL, NULL, NULL, '<p>academic trainings. academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;</p>', NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-02 04:19:49', '2021-09-02 04:19:49'),
(4, 'Services', 'Services', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-19 07:15:50', '2021-08-19 07:15:50'),
(5, 'Blog', 'Our Blogs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-02 04:21:26', '2021-09-02 04:21:26'),
(6, 'Contact', 'Contact Us', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2 Sep, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-02 04:23:07', '2021-09-02 04:23:07'),
(14, 'গ্রাফিক ডিজাইন', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2021-08-24 06:37:56'),
(15, 'ডিজিটাল মার্কেটিং', 'ডিজিটাল মার্কেটিং', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-24 07:35:15', '2021-08-24 07:35:15'),
(16, 'ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(17, 'অ্যাডভান্স গ্রাফিক ডিজাইন', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(18, 'সোশ্যাল মিডিয়া মার্কেটিং', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(19, 'অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(45, 'ফ্রী Microsoft Office Program course', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(46, 'Microsoft Office Program course', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(47, 'Digital Influencers', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(48, 'Sharna Islam Zenia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(49, 'Graphic design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(50, 'Graphic design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(52, '______বিশেষ ঘোষণা______', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(53, 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(54, 'Nazmul Kobir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(55, 'Nazmul Kadir , one of our Digital Influencers', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2021-09-11 03:23:41'),
(56, 'Md.Lotiful Azad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(57, 'Md.Lotiful Azad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(58, 'Microsoft Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(59, 'Microsoft Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(60, 'How to improve your graphic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2021-09-11 02:25:23'),
(61, 'WakeUpIct', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(62, 'Jute Mills Project', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(63, 'Rajbari Jute Mills Projects', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(64, 'Car Management Project', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(65, 'Car Management Project', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(66, 'Logo Design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(67, 'Cloud80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(68, 'Our Location', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(69, 'স্থান পরিবর্তন:', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL);

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
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
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `course_id`, `student_name`, `gander`, `fathers_name`, `mothers_name`, `nationality`, `national_id_no`, `present_address`, `permanent_address`, `personal_call_no`, `email`, `religion`, `occupation`, `age`, `educational_qualification`, `result`, `passing_year`, `student_photo`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'Sharna update', 'female', 'Fathars name', 'Mothars name', 'Bangladesh', '5345234234', '<p>Present Address</p>', '<p>Permanent Address</p>', '017847000000', 'email@email.com', 'Religion', 'Occupation', '22', 'Honers', 'Result 5.00', '2021', 'public/uploads/student/images/1710421893631354.png', 1, '2021-09-09 03:08:12', '2021-09-09 05:03:50'),
(3, 4, 'Ariful sikder', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '45234234', '444', '45645', '34534', 'rimon@gmail.com', '34534', '34534', '43534', 'Masters', '34534', '345', 'public/uploads/student/images/1710427616746372.png', 1, '2021-09-09 06:34:48', NULL);

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
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_contents`
--
ALTER TABLE `blog_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_fassilities`
--
ALTER TABLE `course_fassilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course_items`
--
ALTER TABLE `course_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `course_members`
--
ALTER TABLE `course_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
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
