-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 12:17 PM
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
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `templete_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_title`, `update_time`, `short_description`, `footer_title`, `templete_name`, `blog_image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Blog', '31 Aug, 2021', '<p>short description</p>', 'Footer Title', 'templete name', 'public/uploads/blog/images/1709600815236863.png', 1, '2021-08-31 03:33:09', NULL);

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
(4, 3, 'Blog Content Title Name', 'Blog Content templete name', 'Left side', 'Image', 'public/uploads/blog/images/1709602897434668.png', 'এই কোর্সে আমরা গ্রাফিক ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।', '2', 1, '2021-08-31 04:06:14', NULL),
(5, 3, 'Right side', 'templete name Right side', 'Right side', 'Image', 'public/uploads/blog/images/1709603569647367.png', 'des', '3', 1, '2021-08-31 04:16:55', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_title`, `price`, `short_description`, `course_content`, `long_description`, `importents`, `future_of_this_course`, `possibilities_of_this_course`, `time_line`, `student_quantity`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'গ্রাফিক ডিজাইন', '৫,০০০/-', '<p>এই কোর্সে আমরা গ্রাফিক ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>Photoshop Tools and Uses and Shortcuts. &nbsp;File Management. &nbsp;Layer and History. &nbsp;Smart Object. &nbsp;Pattern. &nbsp;Custom Shape. &nbsp;Action Basic. &nbsp;Clipping Mask.</p><p>&nbsp;</p><p>&nbsp;</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যেখানে নিজের দক্ষতা (Skill) ও শিল্প (Art) ব্যবহার করে কোন ছবি, লেখা অথবা শব্দের সমন্বয়ে একটি অর্থবোধক শব্দ ছবি তৈরি করা। এই ছবি বিভিন্ন এডভেটাইজ, ম্যাগাজিন, বই, ওয়েবসাইট, লোগো &amp; টি শার্ট সাজানোর জন্য বিভিন্নভাবে ব্যবহার করা যেতে পারে। এই ছবিটা বানানোর জন্য আমাদের কিছু বিষয় সম্পর্কিত জ্ঞান এবং টুলস সম্পর্কিত জ্ঞান থাকা আবশ্যক।&nbsp;</p><p>&nbsp;</p><p>গ্রাফিক্স ডিজাইন জন্য দুইটি সফটওইয়ার ব্যবহার করা হয়। যেমনঃ Adobe Photoshop এবং Adobe Illustrator. এই সফটওয়ার দুইটি সম্পর্কে প্রাথমিক ধারণাসহ এর বিভিন্ন টুলস সম্পর্কে আলোচনা করব। যে টুলস গুলো রয়েছে, Photoshop Tools and Uses and shortcuts, File Management, Layer add History, Smart object, Pattern, Custom Shapes, Action Basic and এবং Cliping Mask ইত্যাদি। বেসিক গ্রাফিক্স ডিজাইন কোর্সে আমরা গ্রাফিক্স ডিজাইন কি শিখবো এবং গ্রাফিক ডিজাইন এর বেসিক টুলস সম্পর্কে আলোচনা করব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব।</p>', '<p>গ্রাফিক্স ডিজাইন হলো এমন একটি প্রক্রিয়া যার মাধ্যমে নিজের সৃজনশীলতা ব্যবহার করে ছবি বা নকশার মাধ্যমে নিজের প্রতিভাকে প্রকাশ করা যায়। বেসিক শিখলে আমরা ছবি এডিটিং,ব্যানার তৈরি , PSD ডিজাইন, Website Template Design করতে পারব। তাই আমরা যদি Graphics Design বেসিক কোর্সটি সম্পূর্ন করতে পারি তাহলে আমরা উল্লেখিত কাজগুলো করতে পারব।</p>', '<p>যেহেতু Adobe Photoshop এবং Adobe Illustrator ব্যতিক্রম Software। উল্লেখিত বেসিক গ্রাফিক্স ডিজাইন কোর্স অর্থাৎ Adobe Photoshop ও Adobe Illastrator শিখে আমরা যে সকল কাজের মাধ্যমে উপার্জন করতে পারব তার মধ্যে অন্যতম হলোঃ ১। স্টডিওতে ছবি এডিটিং ২। ছবির ব্যাকগ্রাউন্ড রিমুভ ইত্যাদি Graphics Design বেসিক কোর্সটি একজন Professional Graphics Designer হওয়ার পথটি সংকচন করে দেয়। এবং ভবিষ্যতে আমরা ফটোগ্রাফি ভিডিও এডিটিং , Animation, ভিজুয়্যাল ইফেক্টস সহ অনেক কিছু পেষা হিসাবে নিতে পারব। এবং একজন বেসিক গ্রাফিক্স ডিজাইন কোর্স হিসাবে Online জগতে বিভিন্ন মার্কেটপ্লেসে কাজ করে অর্থ উপার্জন করতে পারব। অবশ্যই Graphics Designer হতে হলে আমাদের অ্যাডভান্স গ্রাফিক্স ডিজাইন কোর্স শিকতে হবে।</p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(93,95,100);\">Graphic Design শিখে আমরা লোগো ডিজাইন, ব্যানার তৈরি, ভিডিও এডিটং এর কাজ বিভিন্ন national ও maltinational কোম্পানি, চলোচিত্র নির্মান কোম্পানি ইত্যাদিতে কাজ চাকরি করে অনেক টাকা উপার্জনের সুজগ আছে।</span></p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1709054215070219.png', 1, '2021-08-25 02:45:10', '2021-08-25 02:45:10'),
(2, 'ডিজিটাল মার্কেটিং', '৬,০০০/-', '<p>মার্কেটিং এর কনসেপ্টগুলো ডিজিটাল প্ল্যাটফর্মে এক্সিকিউট করাই ডিজিটাল মার্কেটিং। আমাদের এই কোর্সের ডিজিটাল মার্কেটিং এর বিস্তারিত বিষয়গুলো নিয়ে আলোচনা করা হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;Market Research<br>&nbsp;Data Analytics<br>&nbsp;Organic Marketing<br>&nbsp;Paid Marketing<br>&nbsp;CPA Marketing<br>&nbsp;Blog Marketing<br>&nbsp;1. Google Add Ward<br>&nbsp;2. Added Different<br>&nbsp;Marketplace Add Management</p>', '<p>বর্তমান সময়ে বিজ্ঞাপনের সকল মাধ্যমগুলোর মধ্যে বর্তমান সময়ের বহুল পরিচিত এবং সবথেকে জনপ্রিয় মাধ্যম হচ্ছে&nbsp; ডিজিটাল মার্কেটিং । যেখানে অডিয়েন্স আছে কোন পণ্য বা সেবার বিজ্ঞাপন সাধারণত সাধারণভাবে সেখানেই হয়। আমরা প্রতিনিয়ত যে সব ওয়েবসাইট ব্যবহার করছি সেখানে আমরা কোন পণ্য বা সেবার বিজ্ঞাপন দিয়ে খুব সহজেই কাস্টমার দিতে পারি। মার্কেটিং এর যাবতীয় কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগ করার জন্য যা জরুরী তা এখানে দেখানো হবে।</p>', '<p>পেশা বা ফ্রিল্যান্সার হিসেবে বর্তমান সময়ে ডিজিটাল মার্কেটিং এর প্রচুর চাহিদা রয়েছে। এছাড়া নিজের ব্যবসা সম্প্রসারণ করার জন্য ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা অপরিসীম। ব্যক্তিগত অথবা ব্যবসা যে প্রয়োজনে হোক ডিজিটাল মার্কেটিং এর পরিধি ক্রমশ বর্ধমান।</p>', '<p>যুগের সাথে তাল মিলিয়ে ব্যবসায়ের সমপ্রসারণ এর ক্ষেত্রে ডিজিটাল মার্কেটিং এর প্রয়োজনীয়তা আকাশচুম্বী। ডিজিটাল মার্কেটিং এর বাজার প্রতিনিয়ত পরিবর্তন হচ্ছে। ট্রেডিশনাল মার্কেটিং এর কনসেপ্ট ডিজিটাল প্লাটফর্মে প্রয়োগের মাধ্যমে দ্রুত সময়ে বেশি সংখ্যক অডিয়েন্সের কাছে পৌঁছানো সম্ভব হচ্ছে । সুদূর ভবিষ্যতে ডিজিটাল মার্কেটিং এর চাহিদা আরো বেশি হবে।</p>', '<p>বর্তমান সময়ে দেশের মার্কেটিং এর প্রচুর চাহিদা রয়েছে। মার্কেটিং এর যাবতীয় টেকনিক ডিজিটাল উপায় প্রয়োগ করে সহজেই সম্ভব অডিয়েন্সের কাছে পৌঁছানো। এই কোর্স&nbsp;মার্কেট রিসার্চ, ডাটা এনালাইসিস, অর্গানিক মার্কেটিং, সিপিএ মার্কেটিং, গুগল এডওয়ার্ড, মার্কেটপ্লেস এবং ব্যবস্থাপনা নিয়ে আলোচনা করা হয়েছে । এই কোর্সটি সম্পন্ন করার পর বিভিন্ন মার্কেটপ্লেসে ফ্রিল্যান্সিং সহ চাকরির ক্ষেত্রে সহায়ক হবে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1708982136635669.png', 1, '2021-08-24 07:39:31', '2021-08-24 07:39:31'),
(3, 'ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', '৫,০০০/-', '<p>আমাদের এই কোর্সে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে দুইটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য কোন পূর্ব অভিজ্ঞতার প্রয়োজন নেই।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>HTML<br>CSS<br>PSD To HTML<br>Responsive Design<br>Bootstrap<br>2 Live Projects</p>', '<p>ওয়েব&nbsp;ডিজাইন হল একটি ওয়েবসাইটের ব্যাহিক রুপ যা আমরা দেখতে পাই বা দৃশ্য মান হয় । আর ওয়েব ডেভেলপমেন্ট হল ভেতরের সাইট যা আমরা দেখতে পাইনা । যেমন উদাহরণ সরুপ একটি গাড়ীর কথা চিন্তা করি । গাড়ির দরজা, জানালা, সিট ব্যাহিক সবকিছুই ওয়েব ডিজাইন এর মধ্যে পরে । আর গাড়ীর ভেতরের যেই মেকানিজম কাজ করে অর্থাৎ গাড়ীর ইঞ্জিন যে ভবে কাজ করে সেটা ওয়েব ডেভেলপমেন্টের মধ্যে পরে । মূল কথা এই যে, ওয়েব ডেভে লপমেন্ট একটি ওয়েবসাইটের প্রান সঞ্চারন করে। অনেকে মনে করে ওয়েব ডিজাইনে HTML, CSS নিয়ে কাজ করতে হয়, ধারনাটি ভুল। ওয়েব ডিজাই রা মূলত ফটোশপ, ইলাস্টেটর বিভিন্ন ওয়েব ফ্রেম দিয়ে ইউজার ইন্টারফেস একটি স্কেচ তৈরি করেন। একজন ওয়েব ডেভেলপার তিন ধরনের হতে পারে ফন্টইন্ড ওয়েব ডেভেলপার, ব্যকইন্ড ওয়েব ডেভেলপার এবং ফুলস্টাক ওয়েব ডেভেলপার। ফন্টইন্ড ডেভেলপার ওয়েবসাইটের ব্যহিক অংশ তৌরি করেন। ব্যকইন্ড ডেভেলপার ওয়েবসাইটের ভেতরের সারভার সাইটে কাজ করেন আর&nbsp; ফুলস্টাক ডেভেলপার ওয়েবসাইটের ফন্টইন্ড এবং ব্যকইন্ড&nbsp; দুই অংশেই কাজ করেন। এই সকল কাজই ডেভেলপমেন্টের পরিচিতি। ওয়েব ডেভেলপার যখন ওয়েব ডিজাইনার থেকে ইউজার ইন্টারফেস এর স্কেচ পাবে তখন ডেভেলপার কোড ইডিটর যেমন-নোটপ্যাড, সাবলাইম, ভিজুয়্যাল স্টডিও কোড এর মাধ্যমে কোডিং করে&nbsp; সেই ওয়েবসাইটের রুপ, প্রান প্রদান করবে। এইভাবেই একটি ওয়েব সাইট তার পূরনতা পাবে।</p>', '<p>যদি আমার চিন্তা এমন থাকে যে আমি ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখে&nbsp;কিভাবে&nbsp;সহজে&nbsp;আয়&nbsp;করবো’&nbsp; বা&nbsp;‘এটা&nbsp;শিখে&nbsp;কত&nbsp;টাকা&nbsp;আয়&nbsp;করবো&nbsp;’&nbsp;বা কীভাবে রাতা রাত্রি টাকা আয় করবো এই সকল চিন্তা যদি আমার থাকে তাহলে আমার জন্য় ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট নয় । আমার চিন্তা এমন থাকতে হবে যে,&nbsp;কোন&nbsp;কাজটা&nbsp;আমি&nbsp;শিখবো,&nbsp;&nbsp;‘আমি&nbsp;কোন&nbsp;কাজটা&nbsp;পারবো’।&nbsp;ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট সাধারনত শেখার জন্য়ে দরকার প্রচুর ধর্য এবং ডেডিকেশন ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ করে টাকা ইনকাম করার কোন লিমিট নেই আপনি যত বেশি কাজ&nbsp; করবেন যত বেশি দক্ষ্য হবেন আপনার&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট মাধমে টাকা ইনকা্মের পরিমান ততো বেশি বারবে ।&nbsp;ওয়েব&nbsp;ডিজাইন ও ডেভেলপমেন্ট এর কাজ আপনার জানা থাকলে আপনি যেকোন যায়গায় বসে আপনি ক্লায়েন্ট এর কাজ করে দিতে পারবেন এর জন্য আপনার শুধু দরকার একটি লেপটপ আর নেট কানেকশন তাহলে আপনি খুব সহজেই কাজ সম্পাদন করতে পারবেন।&nbsp;ওয়েব&nbsp;ডেভেলপমেন্ট শিখে আপনি যদি HTML, CSS, PHP এর মধেই সিমাবদ্ধ থেকেন তাহলে আপনার কাজ করতে অসুবিধা হবে&nbsp; । আসলে প্রগ্রামিং এর কাজ এমন যে প্রতিনিয়ত আপডেট হতে থাকে তাই আপনাকে নতুনত্ব শিখতে হবে । সর্বশেষ বলতে চাই যে আপনি কাজ &nbsp;শিখে যাওয়ার পর আপনি অন্য যেকোনো পেশা থেকে এখানেই ভালো আয় করতে পারবেন আপনার কাজের অভাব হবে না।</p>', '<p>আজকাল বিভিন্ন ধরনের কাজ অনলাইন নির্ভর হয়ে পরেছে, যেই কারনে সারা বিশে প্রতিনিয়ত তৈরি হচ্ছে লক্ষ্য লক্ষ্য ওয়েবসাইট। কিন্তু সেই ওয়েবসাইট বানানোর জন্য তেমন দক্ষ্য ওয়েব ডেভেলপার নেই। এই জন্যে একজন দক্ষ্য ওয়েব ডেভেলপারে চাহিদা বাপ্যক। যার কারনে একজন দক্ষ্য ওয়েব ডেভেলপার এর ভবিষ্যৎ উজ্জ্বল । এই কাজ শিখা থাকলে ঘরে বসেই বিভিন্ন ওয়েবসাইট কাজ করতে পারবে যেমন-&nbsp; Upwork, Fiver, Freelancer, Theme-forest এ কাজ করে অনেক টাকাইন কাম করতে পারবে।</p>', '<p>বর্তমান সময়ে ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর ব্যাপক চাহিদা রয়েছে। বাংলাদেশের অনেক প্রতিষ্ঠান রয়েছে যারা দক্ষতার ওপর ভিত্তি করে ওয়েব ডিজাইনার অথবা ডেভেলপার নিয়োগ দিয়ে থাকে। ওয়েব ডিজাইন এবং ডেভেলপমেন্ট কোর্স শেষ করার পর বিভিন্ন মার্কেটপ্লেসে কাজ করা সহ বিভিন্ন প্রতিষ্ঠান ডিজাইনার অথবা অথবা ডেভেলপার হিসেবে চাকরি করার সুযোগ রয়েছে।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1708982701707670.png', 1, '2021-08-24 07:48:30', '2021-08-24 07:48:30'),
(4, 'অ্যাডভান্স গ্রাফিক ডিজাইন', '৫,০০০/-', '<p>এই করছে আমরা গ্রাফিক ডিজাইনের অ্যাডভান্স ফিচার এবং কাজ সম্পর্কে জানব। এই টুলস গুলো কিভাবে বাস্তব জীবনে ব্যবহৃত হয় সেই বিষয়ে জানব। এই কোর্স করার জন্য অবশ্যই বেসিক গ্রাফিক ডিজাইন সম্পর্কে ধারণা থাকতে হবে।</p>', '<p>এখানে আপনারা যা শিখবেন:</p><p>&nbsp;Business Card Design<br>&nbsp;Logo Concept Realization<br>&nbsp;Web Banner Design<br>&nbsp;Flyer Design<br>&nbsp;Book Cover Design<br>&nbsp;Facebook Cover Design<br>&nbsp;T-shirt Design</p>', '<p>অ্যাডভান্সড গ্রাফিক ডিজাইন কোর্স এমন লোকদের জন্য ডিজাইন করা হয়েছে যারা গ্রাফিক ডিজাইনের সাথে পরিচিত এবং সরঞ্জাম এবং এর ব্যবহার সম্পর্কে জানেন। গ্রাফিক ডিজাইনারগণ মিডিয়া এবং ওয়েব ডিজাইন, প্যাকেজিং, চিত্রণ, অ্যানিমেশন এবং অন্যান্য ক্ষেত্রে তাদের নকশা দক্ষতা কাজে লাগান। ধারণাটি তৈরিতে সহায়ক এবং দক্ষতার সাথে প্রকল্পের সংখ্যা অন্তর্ভুক্ত করার দক্ষতাগুলি হাইলাইট করার জন্য স্তরটি উন্নত।</p>', '<p>ক্যারিয়ারের সম্ভাবনা, ফ্রিল্যান্সের সুযোগ, আর্থিক লাভ, শিল্প ও নকশার প্রতি ভালবাসা বা পয়েন্ট তৈরির জন্য অ্যাডভান্স গ্রাফিক ডিজাইন| লোগো, ব্র্যান্ডিং, ওয়েবসাইটগুলি, মুদ্রণ ইত্যাদিতে শিল্পীদের নিজের কাজ করার জন্য প্রচুর জায়গা রয়েছে যা অ্যাডভান্স গ্রাফিক ডিজাইন এর মাধ্যমে জানতে ও শিখতে পারবে। অনেকগুলি সুযোগের সাথে সম্ভাবনাগুলি ভাল, যে কোনও গ্রাফিক ডিজাইনারের সর্বদা কাজ থাকে। নিজেকে এমনভাবে প্রকাশ করা যা সত্যই আপনার নিজস্ব- গ্রাফিক ডিজাইন দিয়ে আপনাকে আপনার ক্লায়েন্টের প্রয়োজনের সাথে কাজ করার সময় আপনাকে নিজের স্থান তৈরি করতে দেয়। একজন গ্রাফিক ডিজাইনার হিসাবে আপনি নিজের রাউন্ডগুলিকে আলাদা আলাদা আর্ট স্টুডিওগুলি তৈরি করবেন এবং অনেকগুলি সৃজনশীল সাদৃশ্যযুক্ত লোকের সাথে সাক্ষাত করতে পারবেন।</p>', '<p>দিন দিন বিশ্ব আরও ডিজিটাল হয়ে উঠছে। একটি ভাল দৃষ্টিভঙ্গি দ্বারা তৈরি বিজ্ঞাপনটি এমন কোনও ধারণাগুলি প্রকাশ করতে পারে যা কখনই শব্দ দিয়ে প্রকাশ করা যায় না গ্রাফিক ডিজাইনে ক্যারিয়ারের সুযোগটি সারা বিশ্ব জুড়ে দাবি করছে। গ্রাফিক ডিজাইনের দুটি দুর্দান্ত সুযোগ হল ফ্রিল্যান্সিং এবং আউটসোর্সিং। গ্রাফিক ডিজাইনের কোর্সটি বিভিন্ন ক্রিয়েটিভ ক্যারিয়ারের বিভিন্ন প্যালেটকে অন্তর্ভুক্ত করার জন্য আপনার বিকল্পগুলি প্রসারিত করে যা বিজ্ঞাপন সংস্থাগুলি এবং শিল্প নকশা সংস্থাগুলির মতো উচ্চ সৃজনশীল সংস্থায় নেতৃত্বের অবস্থানগুলিতে প্রসারিত করতে পারে। পাশাপাশি আমরা প্রশিক্ষণের জন্য সাহায্য করি। আপনি Google বা Naukri, shine, Glassdoor প্রকৃতপক্ষে ইত্যাদির মতো কোনও ওয়েবসাইটের পরামর্শের মাধ্যমে অনুসন্ধান করে গ্রাফিক ডিজাইনার কাজগুলি সম্পর্কে জানতে পারেন। বিগ এমএনসি সংস্থাগুলি থেকে স্টার্টআপসে অভিজ্ঞ কর্মরত পেশাদারদের জন্য রয়েছে প্রচুর পরিমাণে জব ওপেনিং।</p>', '<p>১. ফ্রিল্যান্সিংঃ ফ্রিল্যান্সার হিসাবে পরিচালনা করা, আপনার নিজের ব্যবসায়ের মালিকানা সৃজনশীল আত্মার জন্য বিশেষত স্বাধীনতা এর অনেক<br>সুবিধা রয়েছে তবে আপনি আরও অর্থোপার্জন করতে পারেন।</p><p>&nbsp;</p><p>২. নিয়োগঃ যদি আপনার ব্যক্তিত্বের ধরণ (অনুশাসিত?) – বা পরিস্থিতি অবিচ্ছিন্ন আয়ের প্রয়োজন হয় তবে আপনাকে কোথাও কোথাও চাকরি নিতে হতে পারে।<br>বিজ্ঞাপন সংস্থাগুলি আপনাকে কাজে নিবে যদি আপনি প্রকৃতপক্ষে ভাল হন এবং দ্রুত এবং অবিরত সময়সীমার পরে সময়সীমা পরিচালনা করতে সক্ষম হন।<br>সংবাদপত্র এবং ছোট মুদ্রণের দোকানগুলিতেও নিয়মিতভাবে গ্রাফিক শিল্পী প্রয়োজন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1709054158922051.png', 1, '2021-08-25 02:44:17', NULL),
(5, 'সোশ্যাল মিডিয়া মার্কেটিং', '৬,০০০/-', '<p>সোশ্যাল মিডিয়া মার্কেটিং হল কোন পণ্য বা সেবার প্রচারে উদ্দেশ্যে সোশ্যাল মিডিয়া যেমন ফেইসবুক, টুইটার বা অন্য কোন সোশ্যাল ওয়েবসাইট ব্যবহার করা।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;Instagram<br>&nbsp;Facebook<br>&nbsp;Twitter<br>&nbsp;Pinterest<br>&nbsp;YouTube Marketing<br>&nbsp;LinkedIn Marketing<br>&nbsp;App Marketing<br>&nbsp;Pure Content Marketing</p>', '<p>সোশ্যাল মিডিয়া মার্কেটিং এমন একটি পদ্ধতি যেখানে বিভিন্ন সামাজিক মাধ্যম যেমন ফেসবুক ,ইউটিউব, ইনস্টাগ্রাম, লিঙ্কডিন ইত্যাদি প্লাটফর্ম এর একটিভ মানুষকে টার্গেট&nbsp; করে নিজের পন্যের বা ব্যাবসার প্রচার প্রচারনা চালানো যায় ।এই মার্কেটিং ব্যাবস্থা ইন্টারনেটভিত্তিক হওয়ার কারনে এবং সামাজিক যোগাযোগ মাধ্যমগুলোর জনপ্রিয়তার কারনে সহজেই সকলের কাছে দ্রুততার সাথে প্রচার চালানো যায় । সোশ্যাল মিডিয়া ব্যাবহার করে যেকোনো ব্রান্ড ,জিনিস বা সার্ভিস বিশ্বের যেকোনো যায়গায় ইন্টারটের মাধ্যমে প্রচার করা যায় বলে মার্কেটিং এর জন্য এই প্রক্রিয়া সেরা ।</p>', '<p>আমাদের এই কোর্সটি করলে আপনি পাবেন সারাজীবন এর জন্য সাপোর্ট যেকোনো সময় যেকোনো প্রশ্ন করলে রেসপন্স পাবেন এই কোর্স এর মাধ্যমে আপনি বড় বড় সামাজিক মাধ্যমগুলো সম্পর্কে বিস্তারিত জানতে পারবেন কোর্স শেষ করে মার্কেটপ্লেসে কাজ পাওয়ার নিশ্চিত সুবিধা ।</p>', '<p>&nbsp;মানুষ বৃদ্ধির সাথে সাথে দিনে দিনে মানুষের প্রয়োজন ও বৃদ্ধি পাচ্ছে । সেই সাথে বৃদ্ধি পাচ্চে সামাজিক যোগাযোগ মাধ্যম গুলোর জনপ্রিয়তা এবং ব্যাবহার । এত অধিক মানুষের কাছে সহজেই নিজের ব্যাবসা ,পন্য কিংবা সার্ভিস পৌছানোর জন্য সোশ্যাল মিডিয়া মার্কেটিং এর বিকল্প নেই ।সহজেই কম সময়ে কম খরচে ঘরে বসেই বেশি ট্রাফিক পাওয়ার কারনে দিনে দিনে এর চাহিদা এবং জনপ্রিয়তা বেড়েই চলছে ।ভবিষ্যতেও সোশ্যাল মিডিয়া মার্কেটিং এর চাহিদা অধিক হারে বৃদ্ধি পাবে এ ব্যাপারে সন্দেহ নেই ।</p>', '<p>এই কোর্সটি সম্পূর্ণ করার পর আপনি সহজেই যেকোনো ব্যবসা বা পন্যের প্রমোশন করতে পারবেন বিনা খরচেই বা অনেক কম খরচেই অধিক পরিমান বিজ্ঞাপন প্রচার করতে পারবেন নির্দিষ্ট টার্গেট অনুযায়ী সহজেই প্রচার প্রচারনা করতে পারবেন যা যথেষ্ট সুবিধাজনক। সহজেই আপনার প্রমোশন গ্রো আপ করবে এবং অধিক ট্রাফিক পাবেন আপনি চাইলে মার্কেটপ্লেসে যেমন আপওয়ার্ক,ফ্রিল্যান্সার,ফাইভার এ অন্যের প্রডাক্ট প্রচার করে অধিক উপার্জন করতে পারবেন আর এই সব কাজগুলো আপনি সহজেই ঘরে বসেই করতে পারবেন ।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1709054582787206.png', 1, '2021-08-25 02:51:01', NULL),
(6, 'অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', '৭,৫০০/-', '<p>আমাদের এই কোর্সে অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট নিয়ে আলোচনা করা হবে এবং কোর্স শেষে তিনটি ওয়েবসাইট তৈরি করে দেখানো হবে। এই কোর্স করার জন্য ওয়েব ডিজাইন এবং ডেভেলপমেন্ট এর প্রাথমিক ধারণা থাকতে হবে।</p>', '<p><strong>এখানে আপনারা যা শিখবেন:</strong></p><p>&nbsp;CSS Framework (Bootstrap)<br>&nbsp;PSD To HTML<br>&nbsp;JavaScript Library (jQuery)<br>&nbsp;PHP Framework (Laravel)<br>&nbsp;3 Live Projects<br>&nbsp;Freelancing</p>', '<p>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো কোনো টেমপ্লেটকে আরও সুন্দর ভাবে সাজানো। এক্ষেত্রে HTML, CSS , CSS এর ফ্রেমওয়ার্ক Bootstrap,JavaScript এর ফ্রেমওয়ার্ক jQuery ব্যবহার করে টেমপ্লেট ডিজাইন করা হয়। ডিজাইন এর ফ্রেমওয়ার্কগুলো ব্যবহার করে টেমপ্লেট এর কোথায়, কীভাবে তথ্যগুলো দেখানো হবে সেটা নির্ধারণ করাই হলো এডভান্স ওয়েব ডিজাইনারের কাজ।<br>এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট হলো সমৃদ্ধ-বৈশিষ্টযুক্ত ওয়েবসাইট এবং ওয়েব পোর্টাল তৈরি করা। সাধারণত এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্টে জাভাস্ক্রিপ্ট, পিএইসপি, সিএমএস এবং তাদের ফ্রেমওয়ার্কগুলি ব্যবহার করা হয়। বিভিন্ন ধরনের ম্যানেজমেন্ট সফটওয়ার তৈরি করা হয়। এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট শিখতে হলে অবশ্যই HTML, CSS, JavaScript, jQuery, PHP বেসিক জ্ঞান থাকতে হবে। এরপর ডেভেলপমেন্ট করতে হলে PHP ফ্রেমওয়ার্ক Laravel শিখতে হবে। একজন ওয়েব ডিজাইনারের ডিজাইনকৃত ওয়েব টেমপ্লেট এর প্রতিটি স্ট্যাটিক উপকরণকে PHP ফ্রেমওয়ার্ক (Laravel) দিয়ে ফাংশনাল এবং ডাইনামিক করাকেই এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট বলে। একজন ভালো ওয়েব ডেভেলপার হতে হলে অবশ্যই আপনাকে HTML, CSS, JavaScript,jQuery, Bootstrap, PHP(Laravel), MySQL সম্পর্কে অনেক জ্ঞান থাকতে হবে।</p>', '<p>বর্তমানে বেকারত্ব দূর করার সহজ উপায় হলো ফ্রিল্যান্সিং করা এবং ফ্রিল্যান্সিং করে বাংলাদেশসহ বিশ্বের অনেক দেশ আজ অনেকটাই বেকারত্ব দূর করতে পারছে। এক্ষেত্রে আমাদের দেশ ও পিছিয়ে নেই। আমাদের এই কোর্স এ এডভান্স ওয়েব পেজ ডিজাইন এন্ড ডেভেলপমেন্ট সম্পর্কে বিশদ শেখানো হবে। এই কোর্সে আমরা CSS Framework(Bootstrap), PSD To HTML, JavaScript Library(jQuery), PHP Framework(Laravel), 3 Live Projects and Freelancing সম্পর্কে বিস্তারিত শেখাবো। আপনি কোডিং এর এডভান্স ফ্রেমওয়ার্কগুলো শেখার পর ৩ টি লাইভ প্রোজেক্ট পাচ্ছেন যার মাধ্যমে আপনি জানতে পারবেন কীভাবে লাইভ প্রোজেক্ট বা ক্লাইন্টের কাজ করতে হয়। আপনাকে শেখানো হবে ফ্রিল্যান্সিং যাকে মুক্ত পেশাও বলে। এই পার্ট থেকে আপনাকে শেখানো হবে কীভাবে ক্লাইন্ট এর কাজ করা যায় এবং ফ্রিল্যান্সিং করে অর্থ উপার্জন করা যায়।</p>', '<p>বর্তমান যুগ হলো টেকনোলজির যুগ। দিন দিন অনেক অনেক কোম্পানী প্রতিষ্ঠিত হচ্ছে এবং বর্তমানে প্রায় সব কোম্পানী বা বড় বড় দোকানের তাদের মার্কেটিং এর জন্য ওয়েবসাইট দরকার হয়। এবং দিন দিন এটা বেড়েই চলেছে এবং অনেকেই অর্থ উপার্জন করছে। ভবিষ্যতে এর চাহিদা বেড়েই যাবে। এই পেশায় প্রাথমিক পর্যায়ে ১০ থেকে ২০ হাজার টাকা বেতনে কোম্পানীর কাজ করা যায় এবং ৩ থেকে ৫ বছর পরে আপনি একজন ইঞ্জিনিয়ার না হয়েও একজন ইঞ্জিনিয়ারের সমতুল্য বেতনে অর্থাৎ ৮০ হাজার থেকে এক লাখ টাকা পর্যন্ত বেতনে চাকরি করতে পারবেন। বাইরের ক্লাইন্টের কাজ করেও নিজের ভবিষ্যত উজ্জ্বল করতে পারবেন।</p>', '<p>কোর্স শেষে আপনি বিভিন্ন মার্কেট প্লেসে কাজ করে অর্থ উপার্জন করতে পারবেন। পাশাপাশি বিভিন্ন কোম্পানির কাজও করে দিতে পারেন। অনলাইন মার্কেটপ্লেসগুলোর মধ্যে রয়েছ, upwork.com, freelancer.com, fiverr.com ইত্যাদি। এসব মার্কেটপ্লেসে ওয়েব পেইজ ডিজাইনার এন্ড ওয়েব ডেভেলপারদের ব্যাপক চাহিদা রয়েছে। কাজ অনুযায়ী আপনি প্রতি ঘন্টায় ২ থেকে ১০০ ডলার ইনকাম বা আয় করতে পারবেন। এছাড়াও আপনি আপনার তৈরি করা ওয়েবসাইট বিভিন্ন কোম্পানির কাছে বিক্রি করতে পারবেন। তাছাড়া themeforest.net এবং codecanyon.net এই দুই মার্কেটপ্লেসেও বিক্রি করে আয় করতে পারেন। বিদেশী কোম্পানীসহ আমাদের দেশে বিভিন্ন সফটওয়ার কোম্পানীতে Web Designer and Web Developer হিসেবে জব করতে পারবেন।</p>', '২ মাস', '২০ জন', 'public/uploads/course/images/1709055040721833.png', 1, '2021-08-28 03:32:41', '2021-08-28 03:32:41');

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
(7, 6, 'Software management system', 33, 1, '2021-08-28 04:33:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_items`
--

CREATE TABLE `course_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_items`
--

INSERT INTO `course_items` (`id`, `course_id`, `item_title`, `course_order`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '6', 'সিএসএস ফ্রেমওয়ার্ক (বুটস্ট্রাপ)', '1', '<p>বুটস্ট্রাপ (Bootstrap) হলো একটি ফ্রি এবং ওপেন সোর্স CSS ফ্রেমওয়ার্ক যার মাধ্যমে খুব সহজেই ওয়েবসাইটে রেস্পোন্সিভ, মোবাইল ফ্রেন্ডলি করা যায়। এতে কিছু জাভাস্ক্রিপ্ট মিশ্রিত রয়েছে যা খুব সহজে ডিজাইনটিকে চমৎকার করে দেয়। বর্তমানে কাস্টম সিএসএস ব্যবহার না করে প্রায় সব ওয়েব পেইজকে Bootstrap এর সাহায্যে ডিজাইন করা যায়।</p>', '1', '2021-08-25 08:03:03', '2021-08-29 03:55:51'),
(3, '6', 'Something.', '2', '<p>anythings</p>', '1', '2021-08-26 03:19:35', '2021-08-26 07:33:37'),
(4, '5', '1', '1', '<p>sdfsdfdfds</p>', '1', '2021-08-26 04:20:37', NULL),
(5, '6', 'ad', '4', '<p>vvvv</p>', '1', '2021-08-26 06:01:12', NULL),
(6, '5', 'social item', '2', '<p>socila item&nbsp;</p>', '1', '2021-08-26 06:02:05', NULL);

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
(17, '2021_08_25_090807_create_blogs_table', 6),
(18, '2021_08_29_152434_create_blog_contents_table', 6);

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
(2, 'About', 'About page', 'www.google.come', 'og locale about', 'og type about', 'og url about', 'og side name about', 'ms validate about', '<p>about description. about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;about description.&nbsp;</p>', 'article publisher about', '19 Aug, 2021', 'public/uploads/SEO/images/1708522539636513.png', '324', '3423', 'twitter card about', 'twitter label 1 about', 'twitter data 1 about', 'google side varification about', '1', '2021-08-29 03:12:42', '2021-08-29 03:12:42'),
(3, 'Academic', 'Academic Trainings', NULL, NULL, NULL, NULL, NULL, NULL, '<p>academic trainings. academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;academic trainings.&nbsp;</p>', NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-19 07:14:55', '2021-08-19 07:14:55'),
(4, 'Services', 'Services', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-19 07:15:50', '2021-08-19 07:15:50'),
(11, 'Microsoft Office', 'Microsoft office 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-24 02:54:51', '2021-08-24 02:54:51'),
(12, 'Laravel', 'Laravel ecommarce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-24 02:54:11', '2021-08-24 02:54:11'),
(13, 'Home', 'Home Page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-24 04:45:11', '2021-08-24 04:45:11'),
(14, 'গ্রাফিক ডিজাইন', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2021-08-24 06:37:56'),
(15, 'ডিজিটাল মার্কেটিং', 'ডিজিটাল মার্কেটিং', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24 Aug, 2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-08-24 07:35:15', '2021-08-24 07:35:15'),
(16, 'ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(17, 'অ্যাডভান্স গ্রাফিক ডিজাইন', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(18, 'সোশ্যাল মিডিয়া মার্কেটিং', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(19, 'অ্যাডভান্স ওয়েব ডিজাইন এবং ডেভেলপমেন্ট', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(23, 'Title', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(30, 'Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(31, 'Blog Content Title Name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(32, 'Right side', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL);

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
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_contents`
--
ALTER TABLE `blog_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_fassilities`
--
ALTER TABLE `course_fassilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_items`
--
ALTER TABLE `course_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_members`
--
ALTER TABLE `course_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
