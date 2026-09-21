-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 11:40 AM
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
  `student_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `course_id`, `batch_id`, `student_name`, `gander`, `fathers_name`, `mothers_name`, `nationality`, `national_id_no`, `present_address`, `permanent_address`, `personal_call_no`, `email`, `religion`, `occupation`, `age`, `educational_qualification`, `result`, `passing_year`, `student_photo`, `status`, `created_at`, `updated_at`) VALUES
(5, 6, 1, 'Ariful sikder', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '21321312312', '<p>Present Address</p>', '<p>Permanent Address</p>', '017847000000', 'arif@wakeupict.com', 'Religion', 'Occupation', '2000-02-14', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/1711518970735891.jpg', 1, '2021-09-21 03:18:49', '2021-10-03 09:16:52'),
(6, 1, 1, 'x', 'male', 'x', 'x', 'x', '1313213213', '<p>x</p>', '<p>x</p>', '017847000000', 'rimon@gmail.com', 'x', 'x', '2011-10-13', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/1712513117126917.jpg', 1, '2021-10-02 07:02:56', '2021-10-03 09:16:45'),
(7, 4, 1, 'Rimon Khan', 'male', 'Fathars name', 'Mothars name', 'Bangladesh', '1313213213', '<p>Address update</p>', '<p>Address Permanent</p>', '017222222222', 'rimon@gmail.com', 'Religion', 'Occupation', '1979-06-25', 'Masters', 'Result 5.00', '2021', 'public/uploads/student/images/1712606787029408.jpg', 1, '2021-10-03 07:51:46', '2021-10-03 09:07:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
