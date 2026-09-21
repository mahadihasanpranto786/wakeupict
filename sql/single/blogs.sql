-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 07:31 PM
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
  `active_blog` int(20) NOT NULL DEFAULT 0,
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
(10, 4, 'Nazmul Kadir', 'আরিফ', '20 Sep, 2021', '<p><a href=\"https://www.facebook.com/nazmulkadir.pabna?__cft__%5b0%5d=AZUr7t2bqwds_6j7z2zFSY5CBwHQqH5nnqGbz-JnxOoF4F-Z_gjEX9BnJK9YTrxfVsM4Ta9A_dOq5HttjxrJGtYSdjGIaq-LyiScRiHfv_lwuCEF-Ytm07LCbJVQX_md6abeJmCeJZAD4xxLuknXV38Y&amp;__tn__=-%5dK-R\">Nazmul Kadir</a> , one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', 'Nazmul Kadir', '1', 'public/uploads/blog/images/1711435640839282.jpg', 'nazmul kadir', 1, 1, '2021-09-20 09:36:54', '2021-09-26 09:02:05', 'nazmul-kadir'),
(11, 4, 'Md.Lotiful Azad', '', '4 Sep, 2021', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate. For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', 'Certificate', '1', 'public/uploads/blog/images/1709975349465187.jpg', '', 1, 1, '2021-09-04 00:46:12', '2021-09-22 08:07:41', 'md.lotiful-azad'),
(12, 3, 'Microsoft Office', '', '4 Sep, 2021', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', 'Basic Computer', '1', 'public/uploads/blog/images/1709977970062088.png', '', 1, 1, '2021-09-04 01:27:51', '2021-09-22 08:07:47', 'microsoft-office'),
(13, 5, 'Graphic design', '', '4 Sep, 2021', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709981392457096.jpg', '', 1, 1, '2021-09-04 02:22:16', '2021-09-22 08:07:38', 'graphic-design'),
(14, 7, 'Jute Mills Project', '', '4 Sep, 2021', '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.&nbsp;</p>', 'Jute Mills Project', '1', 'public/uploads/blog/images/1709981632078271.png', '', 1, 1, '2021-09-04 02:26:04', '2021-09-22 08:07:31', 'jute-mills-project'),
(15, 7, 'Car Management Project', '', '4 Sep, 2021', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p>', 'Car Management Project', '1', 'public/uploads/blog/images/1709981828528950.jpg', '', 1, 1, '2021-09-04 02:29:11', '2021-09-22 08:07:29', 'car-management-project'),
(16, 5, 'Logo Design', '', '4 Sep, 2021', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p>', 'Logo Design', '1', 'public/uploads/blog/images/1709981997906463.jpg', '', 1, 1, '2021-09-04 02:31:53', '2021-09-22 08:07:36', 'logo-design'),
(17, 8, 'Our Location', '', '4 Sep, 2021', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 'Our New Location', '1', 'public/uploads/blog/images/1709982203715550.png', '', 1, 1, '2021-09-04 02:35:09', '2021-09-22 08:07:20', 'our-location'),
(32, 9, 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', 'HR Sharna', '20 Sep, 2021', '<p>ক্যারিয়ার হিসেবে, ওয়েব ডেভেলপমেন্ট বাংলাদেশের একটি অত্যন্ত সম্ভাবনাময় একটি &nbsp;ক্ষেত্র। আজকাল, ওয়েবসাইট এবং অ্যাপের দৌরাত্মে কারণে ওয়েব ডেভেলপারদের চাহিদা খুব বেশি এবং এটি বাড়ছে। আবার, এই ক্ষেত্রে আয় বেশ ভাল। অনেকের কাছেই অজানা এরকম সম্ভাবনাময় একটি ফিল্ডের ক্যারিয়ারের সত্যিকারের রূপটা ঠিক কেমন তা ।</p>', 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', '1', 'public/uploads/blog/images/1711428499363215.jpg', 'ওয়েব ডেভেলপমেন্ট ক্যারিয়ার', 1, 1, '2021-09-20 07:43:24', '2021-09-22 08:13:09', 'web-development-career');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
