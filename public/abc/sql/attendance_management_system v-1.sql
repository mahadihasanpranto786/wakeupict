-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 07:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attandence`
--

CREATE TABLE `attandence` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_time` date NOT NULL,
  `status` varchar(250) NOT NULL,
  `date_time_mod` datetime NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attandence`
--

INSERT INTO `attandence` (`id`, `member_id`, `date_time`, `status`, `date_time_mod`, `remarks`) VALUES
(20, 1, '2021-07-13', 'Coffee', '2021-07-13 16:25:17', 'First Coffee'),
(21, 2, '2021-07-13', 'Coffee', '2021-07-13 16:29:55', ''),
(23, 22, '2021-07-13', 'Coffee', '2021-07-13 16:34:28', ''),
(24, 16, '2021-07-13', 'Coffee', '2021-07-13 16:37:20', 'First Coffee !!!'),
(25, 17, '2021-07-13', 'Coffee', '2021-07-13 16:37:31', ''),
(26, 15, '2021-07-13', 'Coffee', '2021-07-13 16:37:42', '1cup khailam'),
(27, 13, '2021-07-13', 'Coffee', '2021-07-13 16:39:34', 'First Coffee !!!'),
(28, 19, '2021-07-13', 'Coffee', '2021-07-13 16:39:52', 'My First Free Coffee from Office'),
(29, 21, '2021-07-13', 'Coffee', '2021-07-13 16:41:37', ''),
(30, 23, '2021-07-13', 'Coffee', '2021-07-13 16:42:22', ''),
(31, 25, '2021-07-13', 'Coffee', '2021-07-13 16:47:30', 'osthir lagsa'),
(32, 26, '2021-07-13', 'Coffee', '2021-07-13 16:49:05', ''),
(33, 15, '2021-07-13', 'Break (In)', '2021-07-13 16:51:14', '4:20 e gechilam kintu systme toiri hoiche pore'),
(34, 15, '2021-07-13', 'Break (Out)', '2021-07-13 16:51:47', 'aschi 4:30 e '),
(35, 1, '2021-07-13', 'Coffee', '2021-07-13 19:26:05', '2nd coffee'),
(36, 15, '2021-07-13', 'Coffee', '2021-07-13 19:32:34', 'arek cup khassi'),
(37, 25, '2021-07-13', 'Enter', '2021-07-13 19:32:40', ''),
(38, 25, '2021-07-13', 'Coffee', '2021-07-13 19:34:53', '2nd cup'),
(39, 2, '2021-07-13', 'Coffee', '2021-07-13 20:27:50', '2nd cup'),
(40, 16, '2021-07-13', 'Leave', '2021-07-13 20:29:22', ''),
(41, 25, '2021-07-13', 'Leave', '2021-07-13 21:05:23', ''),
(42, 2, '2021-07-13', 'Leave', '2021-07-13 22:05:27', ''),
(43, 15, '2021-07-13', 'Leave', '2021-07-13 22:05:57', 'Ektu pore jabo agei dilam arkiðŸ˜†ðŸ˜†'),
(44, 22, '2021-07-13', 'Leave', '2021-07-13 22:06:11', ''),
(45, 13, '2021-07-13', 'Leave', '2021-07-13 22:07:28', ''),
(46, 2, '2021-07-14', 'Enter', '2021-07-14 09:07:59', ''),
(49, 14, '2021-07-14', 'Enter', '2021-07-14 09:33:01', ''),
(50, 13, '2021-07-14', 'Enter', '2021-07-14 09:36:03', ''),
(51, 2, '2021-07-14', 'Coffee', '2021-07-14 09:40:56', ''),
(52, 13, '2021-07-14', 'Coffee', '2021-07-14 09:41:18', ''),
(53, 14, '2021-07-14', 'Coffee', '2021-07-14 09:46:27', ''),
(54, 15, '2021-07-14', 'Enter', '2021-07-14 10:06:47', 'Aslam '),
(55, 16, '2021-07-14', 'Enter', '2021-07-14 10:26:19', ''),
(56, 1, '2021-07-14', 'Enter', '2021-07-14 11:22:46', ''),
(57, 1, '2021-07-14', 'Coffee', '2021-07-14 11:22:57', ''),
(58, 26, '2021-07-14', 'Enter', '2021-07-14 11:57:44', ''),
(59, 16, '2021-07-14', 'Break (In)', '2021-07-14 13:38:58', ''),
(60, 2, '2021-07-14', 'Break (In)', '2021-07-14 13:39:01', ''),
(61, 13, '2021-07-14', 'Leave', '2021-07-14 13:39:27', ''),
(62, 15, '2021-07-14', 'Leave', '2021-07-14 13:39:46', ''),
(63, 15, '2021-07-14', 'Enter', '2021-07-14 13:50:37', 'ager bar gesilam na ..but leav entry korchi sorry'),
(64, 15, '2021-07-14', 'Coffee', '2021-07-14 13:57:30', 'ajker 1st cofee'),
(65, 26, '2021-07-14', 'Coffee', '2021-07-14 13:58:26', ''),
(66, 21, '2021-07-14', 'Enter', '2021-07-14 14:20:13', ''),
(67, 18, '2021-07-14', 'Break (In)', '2021-07-14 14:34:35', 'lunch'),
(68, 16, '2021-07-14', 'Break (Out)', '2021-07-14 14:42:53', ''),
(69, 23, '2021-07-14', 'Enter', '2021-07-14 14:43:10', 'I was start my work at 10 am.'),
(70, 22, '2021-07-14', 'Enter', '2021-07-14 14:43:31', ''),
(71, 2, '2021-07-14', 'Break (Out)', '2021-07-14 15:00:28', ''),
(72, 13, '2021-07-14', 'Break (Out)', '2021-07-14 14:55:22', 'Ami Kinto 2:55 te Aschi'),
(79, 1, '2021-07-14', 'Coffee', '2021-07-14 16:11:42', ''),
(80, 2, '2021-07-14', 'Coffee', '2021-07-14 16:17:44', ''),
(81, 18, '2021-07-14', 'Break End', '2021-07-14 17:29:53', ''),
(82, 1, '2021-07-14', 'Coffee', '2021-07-14 21:14:21', ''),
(83, 18, '2021-07-14', 'Coffee', '2021-07-14 21:23:17', ''),
(84, 13, '2021-07-14', 'Leave', '2021-07-14 22:25:05', ''),
(85, 2, '2021-07-14', 'Leave', '2021-07-14 22:27:28', ''),
(86, 15, '2021-07-14', 'Leave', '2021-07-14 22:27:53', '+1hour'),
(87, 2, '2021-07-15', 'Enter', '2021-07-15 09:07:15', ''),
(88, 2, '2021-07-15', 'Coffee', '2021-07-15 09:30:38', ''),
(89, 15, '2021-07-15', 'Enter', '2021-07-15 09:37:00', 'aslam'),
(90, 14, '2021-07-15', 'Enter', '2021-07-15 09:50:36', ''),
(91, 13, '2021-07-15', 'Enter', '2021-07-15 09:52:53', ''),
(93, 27, '2021-07-15', 'Enter', '2021-07-15 10:06:28', ''),
(94, 16, '2021-07-15', 'Enter', '2021-07-15 10:21:25', ''),
(95, 18, '2021-07-15', 'Enter', '2021-07-15 10:29:42', ''),
(96, 18, '2021-07-15', 'Coffee', '2021-07-15 10:53:38', ''),
(97, 14, '2021-07-15', 'Coffee', '2021-07-15 10:56:56', '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1= paid; \r\n2= Unpaid;\r\n3= General;',
  `cell` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1= Employee;\r\n2= Clients;\r\n3= Students;\r\n4= Marketing;\r\n5=OP',
  `total_invest` decimal(10,0) NOT NULL,
  `total_withdrow` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `designation`, `type`, `cell`, `address`, `image`, `password`, `user_type`, `total_invest`, `total_withdrow`) VALUES
(1, 'Engr Shuvro Hosain', 'Lead Software Engineer', 1, '01674514499', 'Vobanipur', 'NULL', '123456', 1, '0', '0'),
(2, 'Sajib Sarker Riddho', 'Jr. Full Stack Developer', 1, '1', 'Collegepara', 'NULL', '1', 1, '0', '0'),
(13, 'Mahadi Hasan', 'Jr. Web Developer', 2, '01796297458', 'Rajbari', '', '96297458', 1, '0', '0'),
(14, 'L.A Kajol', 'Digital Inference ', 2, '01731917797', 'Boroluxmipur, Rajbari', '', '01731917797', 1, '0', '0'),
(15, 'AB Siddique', 'Jr. Full Stack Developer', 1, '01780805503', 'Collegepara', '', '01780805503', 1, '0', '0'),
(16, 'Rimon Hoshen', 'Jr. Web Developer', 2, '01966313878', 'Collegepara', '', '01966313878', 1, '0', '0'),
(17, 'Sohan Hosen', 'Jr. Backend Developer', 2, '01729520527', 'Collegepara', '', '01729520527', 1, '0', '0'),
(18, 'Murad Hasan Khan', 'Full Stack Developer', 1, '01710016092', 'Beradanga', '', '01710016092', 1, '0', '0'),
(19, 'Ariful Sikder', 'Jr. Lavavel Developer', 2, '01784703000', 'Luxmikol', '', '1234', 1, '0', '0'),
(21, 'Asma Aktar', 'Graphic Designer', 2, '01782449697', 'Char Narayanpur', '', 'urmi', 1, '0', '0'),
(22, 'Rezaul Karim', 'Jr. Frontend Developer', 2, '01708199284', 'Rajbari', '', '01708199284', 1, '0', '0'),
(23, 'Shaharima Afroj', 'Graphic Designer', 2, '01775883307', 'Rajbari', '', 'Srabon', 1, '0', '0'),
(24, 'Pritom Das', 'Jr. MERN Stack Developer', 2, '01782946078', 'Bhabanipur', '', '01782946078', 1, '0', '0'),
(25, 'Nazmul Kadir', 'Digital Influencer', 2, '01770785385', 'Rajbari', '', '01770785385', 1, '0', '0'),
(26, 'Sharna Islam', 'Digital Influencer', 2, '01790695133', 'Rajbari', '', '01790', 1, '0', '0'),
(27, 'Raihan Khan', 'Jr. Web Developer', 2, '01961930719', 'Rajbari', '', '21345', 1, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attandence`
--
ALTER TABLE `attandence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attandence`
--
ALTER TABLE `attandence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
