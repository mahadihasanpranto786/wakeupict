-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2021 at 05:26 PM
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
(7, 5, 'Graphic design', '2 Sep, 2021', '<p>How to improve your graphic design skills!</p><p>Here are ten practical and achievable ways to help you improve your graphic design skills:</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709786782107086.png', 1, '2021-09-02 04:49:00', '2021-09-02 07:40:52', 'test-11'),
(9, 6, '______বিশেষ ঘোষণা______', '4 Sep, 2021', '<p>ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ কোর্সে আবেদনের সময়সীমা বাড়ানো হয়েছে। আবেদনের সময়সীমা : ০১ সেপ্টেম্বর, ২০২১। লকডাউন পরিস্থিতি স্বাভাবিক হওয়ার কারনে খুব দ্রুত লিখিত (এমসিকিউ) পরীক্ষা নেওয়া হবে। পরীক্ষার তারিখ এবং সময় জানিয়ে দেওয়া হবে। আমাদের ওয়েবসাইটের ঠিকানা : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0t8aQBIW2uiaU-e99ghHGbEJ1bzjMjWApeVO0aWzT5gf675BqhemBZrdA\">www.wakeupict.com</a></p>', 'ফ্রি সফ্টওয়্যার ডেভেলপমেন্ট ইন্টার্নশীপ', '1', 'public/uploads/blog/images/1709972456887809.jpg', 1, '2021-09-04 06:00:14', '2021-09-04 06:32:32', 'test-3'),
(10, 4, 'Nazmul Kobir', '4 Sep, 2021', '<p><a href=\"https://www.facebook.com/nazmulkadir0?__cft__%5b0%5d=AZV2l__FcnBINdS7BLYVoFFwl4qvYg13mL4m6OCoHQ7b6kqn1ZcDaofSgtq9V8_VEQsvZat6t5fpIXKByGDjSwASZsy4LlYJDYvSs5WKWgOkQEkHAOske3zodnj9-ZPXjMEc3Aazfob5h4UZNEG-cX8b&amp;__tn__=-%5dK-R\"><strong>Nazmul Kadir</strong></a><strong> </strong>, one of our Digital Influencers, has successfully achieved SEO certification from HubSpot Academy. He completed the SEO course and all tasks which are pre-required to get the certification. Now he is more capable of optimizing a website to perform well in search engines.</p>', 'Certificate', '1', 'public/uploads/blog/images/1709974649958454.png', 1, '2021-09-04 06:35:05', NULL, 'test-4'),
(11, 4, 'Md.Lotiful Azad', '4 Sep, 2021', '<p><a href=\"https://www.facebook.com/kajol1771?__cft__%5b0%5d=AZVZNz_ScLyi0te6iO5lp-F8idTohcibnHXKkDIzm1FrAzy3EWfz2t8y161gljDMREPjhj_Kc3nKwFfTjaYDdAh0Nev6NIrItHHARcJe3p31DlG0T9D2nsZD2Y9Noa1e3_cGtYWsXaQRTK507SFPZqW-&amp;__tn__=-%5dK-R\">Md. Lotiful Azad</a> ,one of our Digital Influencers, he Successfully achieved The Fundamentals of Digital Marketing Certificate from Google. He completed the Fundamentals of Digital Marketing course and all the work required to get the certificate. For more details please visit : <a href=\"http://www.wakeupict.com/?fbclid=IwAR0WU-orprzs67wAF0DLp3J01pDAgnrPTJjfObB5-Z6W_1rfeY1SO31GkR0\">www.wakeupict.com</a></p>', 'Certificate', '1', 'public/uploads/blog/images/1709975349465187.jpg', 1, '2021-09-04 06:46:12', NULL, 'test-5'),
(12, 3, 'Microsoft Office', '4 Sep, 2021', '<p>করোনাকালীন সময়ে ঘরে বসে থেকে নিজের মূল্যবান সময় নষ্ট না করে আপনিও শিখে নিতে পারেন Microsoft Office(বেসিক কম্পিউটার ট্রেনিং কোর্স)। চাকুরী, ব্যবসা সব ক্ষেত্রে Microsoft Office এর গুরুত্ব এখন অপরিসীম।</p>', 'Basic Computer', '1', 'public/uploads/blog/images/1709977970062088.png', 1, '2021-09-04 07:27:51', NULL, 'test-6'),
(13, 5, 'Graphic design', '4 Sep, 2021', '<p>We are WakeUpIct, A prominent software firm at Rajbari. We provide quality software development for different kinds of business and freelancing training to crafting professionals in minimal time.</p>', 'Graphic design', '1', 'public/uploads/blog/images/1709981392457096.jpg', 1, '2021-09-04 08:22:16', NULL, 'test-7'),
(14, 7, 'Jute Mills Project', '4 Sep, 2021', '<p>Rajbari Jute Mill Enterprise Resource Planning (ERP) Software is one of the biggest projects of WakeUpICT. The software development team really work very hard for crafting this software.&nbsp;</p>', 'Jute Mills Project', '1', 'public/uploads/blog/images/1709981632078271.png', 1, '2021-09-04 08:26:04', NULL, 'test-8'),
(15, 7, 'Car Management Project', '4 Sep, 2021', '<p>Another successful deployment of our rent a car project on Franch. Dash-Car is a company that provides rent-a-car service at Franch.</p>', 'Car Management Project', '1', 'public/uploads/blog/images/1709981828528950.jpg', 1, '2021-09-04 08:29:11', NULL, 'test-9'),
(16, 5, 'Logo Design', '4 Sep, 2021', '<p>Cloud80 is a tech company based in the United States, they provide Salesforce development and implementation services.</p>', 'Logo Design', '1', 'public/uploads/blog/images/1709981997906463.jpg', 1, '2021-09-04 08:31:53', NULL, 'test-10'),
(17, 8, 'Our Location', '4 Sep, 2021', '<p>স্থান পরিবর্তন:<br>ওয়েক আপ আইসিটি একাডেমি, নান্নু টাওয়ার, ৩য় তলা, পান্না চত্বর, রাজবাড়ী</p>', 'Our New Location', '1', 'public/uploads/blog/images/1709982203715550.png', 1, '2021-09-04 08:35:09', NULL, 'test-first');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
