-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2019 at 05:20 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TA_anotasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `image_anotated`
--

CREATE TABLE `image_anotated` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `image_anotated`
--

INSERT INTO `image_anotated` (`id`, `user_id`, `image_id`, `image`) VALUES
(2, 24, 31, '/TA/uploads/ano-adit-417'),
(3, 24, 32, '/TA/uploads/ano-adit-2'),
(4, 24, 33, '/TA/uploads/ano-adit-147'),
(5, 22, 34, '/TA/uploads/ano-tama-492'),
(6, 23, 34, '/TA/upload/ano-balablbala'),
(7, 8, 34, '/TA/uploads/ano-asdas'),
(9, 22, 33, '/TA/uploads/ano-tama-644'),
(10, 22, 33, '/TA/uploads/ano-tama-13'),
(11, 26, 35, '/TA/uploads/ano-azrul-614'),
(12, 27, 35, '/TA/uploads/ano-dimas-670'),
(13, 26, 35, '/TA/uploads/ano-azrul-150'),
(14, 26, 36, '/TA/uploads/ano-azrul-569'),
(15, 27, 36, '/TA/uploads/ano-dimas-753'),
(16, 26, 37, '/TA/uploads/ano-azrul-138'),
(17, 27, 37, '/TA/uploads/ano-dimas-565'),
(18, 28, 36, '/TA/uploads/ano-con-308'),
(19, 28, 36, '/TA/uploads/ano-con-556'),
(20, 26, 38, '/TA/uploads/ori-azrul-cek'),
(21, 27, 38, '/TA/uploads/ano-dimas-592'),
(22, 27, 38, '/TA/uploads/ano-dimas-665'),
(23, 26, 39, '/TA/uploads/ano-azrul-364'),
(24, 26, 40, '/TA/uploads/ano-azrul-237'),
(25, 26, 41, '/TA/uploads/ano-azrul-934');

-- --------------------------------------------------------

--
-- Table structure for table `image_original`
--

CREATE TABLE `image_original` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `image_original`
--

INSERT INTO `image_original` (`id`, `user_id`, `image`) VALUES
(2, 2, '/TA/uploads/Screen Shot 2019-02-01 at 04.19.16.jpg'),
(3, 2, '/TA/uploads/ori-awdawd'),
(4, 2, '/TA/uploads/ori-awdawd-'),
(5, 2, '/TA/uploads/ori-awdawd-'),
(6, 2, '/TA/uploads/ori-awdawd-2019/02/21 19:55:12'),
(7, 2, '/TA/uploads/ori-awdawd-2019/02/21 19:55:48'),
(8, 2, '/TA/uploads/ori-awdawd-2019/02/21 19:57:11'),
(9, 2, '/TA/uploads/ori-awdawd-2019-02-21 19:58:24'),
(10, 2, '/TA/uploads/b100ttd.jpg'),
(11, 2, '/TA/uploads/ori-awdawd-asasas'),
(12, 2, '/TA/uploads/ori-awdawd-'),
(13, 2, '/TA/uploads/ori-awdawd-799'),
(14, 2, '/TA/uploads/ori-awdawd-780'),
(15, 2, '/TA/uploads/ori-awdawd-574'),
(17, 2, '/TA/uploads/ori-awdawd-256'),
(18, 2, '/TA/uploads/ori-awdawd-241'),
(19, 2, '/TA/uploads/ori-awdawd-650'),
(20, 2, '/TA/uploads/ori-awdawd-600'),
(21, 2, '/TA/uploads/ori-awdawd-217'),
(23, 24, '/TA/uploads/ori-adit-87'),
(24, 24, '/TA/uploads/ori-adit-697'),
(25, 24, '/TA/uploads/ori-adit-97'),
(26, 24, '/TA/uploads/ori-adit-681'),
(27, 24, '/TA/uploads/ori-adit-167'),
(28, 24, '/TA/uploads/ori-adit-836'),
(29, 24, '/TA/uploads/ori-adit-661'),
(30, 24, '/TA/uploads/ori-adit-693'),
(31, 24, '/TA/uploads/ori-adit-305'),
(32, 24, '/TA/uploads/ori-adit-990'),
(33, 24, '/TA/uploads/ori-adit-265'),
(34, 22, '/TA/uploads/ori-tama-503'),
(35, 26, '/TA/uploads/ori-azrul-977'),
(36, 26, '/TA/uploads/ori-azrul-315'),
(37, 26, '/TA/uploads/ori-azrul-407'),
(38, 26, '/TA/uploads/ori-azrul-cek'),
(39, 26, '/TA/uploads/ori-azrul-129'),
(40, 26, '/TA/uploads/ori-azrul-362'),
(41, 26, '/TA/uploads/ori-azrul-718');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` varchar(255) COLLATE utf8_bin NOT NULL,
  `ahli` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `parent_id`, `nama`, `email`, `username`, `password`, `role`, `ahli`) VALUES
(1, 0, 'Aditya Pratama', 'adityapratama1@yahoo.co.id', 'root', 'root', 'SUPERADMIN', 1),
(2, 1, 'wafeg', 'adwadawd@djhwadh.com', 'awdawd', 'root', 'admin', 1),
(4, 0, 'awdjhjawhd', 'blalba@gmail.com', 'awjhtkjawhtkjhawjh', 'root', 'admin', 0),
(5, 0, 'acha', 'acha@gmail.com', 'acha', 'root', 'Doctor', 0),
(6, 0, 'timo', 'timo@gmail.com', 'timo', 'root', 'Expert', 0),
(7, 0, 'anggi', 'anggi@gmail.com', 'anggi', 'root', 'admin', 0),
(8, 0, 'aam', 'aam@gmail.com', 'aam', 'root', 'admin', 0),
(9, 0, 'lapita', 'lapita@gmail.com', 'lapita', 'root', 'admin', 0),
(10, 0, 'navila', 'navila@gmail.com', 'navila', 'root', 'admin', 0),
(11, 0, 'lap', 'lap@gmail.com', 'lap', 'root', 'ahli', 0),
(12, 0, 'hahdwhdwha', 'hahah@jawdjajwd.com', 'ahwhawhaw', 'hawdhawhd', 'hawdhawdh', 0),
(13, 0, 'lapi', 'lapita@gmail.com', 'lapi', 'root', 'Expert', 0),
(14, 0, 'adaw', 'qw@ijdiawj.com', 'kjwnd', 'qkwjnd', 'Expert', 0),
(15, 0, 'asdaw', 'ahwdhg@h.vo', 'awgdh', 'awdh`', '', 0),
(16, 0, 'awdaw', 'ahwdhg@h.vo', 'awdaw', 'awd', 'admin', 0),
(17, 0, 'aku', 'aku@gmal.com', 'akuu', 'root', 'Expert', 0),
(18, 0, 'awd', 'awd@wadaw.cl', 'awd@dwad.vm', 'awd', 'Expert', 0),
(19, 0, 'awdaw', 'dawd@waf.vm', 'wadaw', 'wdad', 'Expert', 0),
(20, 0, 'dawdw', 'dawdw@dawd.cm', 'wadwa1', 'dawdw', 'Student', 0),
(21, 0, 'rt', 'ww@s', 'w', 'w', 'Expert', 0),
(22, 8, 'rt', 'ww@s', 'tama', 'tama', 'Expert', 0),
(23, 8, 'wd', 'ww@s', 'wawd', 'awd', 'Expert', 0),
(24, 8, 'adit', 'adit@gm', 'adit', 'root', 'Expert', 0),
(25, 0, 'helmi', 'hel@go.id', 'helmi', 'root', 'admin', 0),
(26, 25, 'azrul', 'az@go.id', 'azrul', 'root', 'Expert', 0),
(27, 25, 'dimas', 'dim@go.id', 'dimas', 'root', 'Expert', 0),
(28, 25, 'con', 'con@go.id', 'con', 'root', 'Doctor', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image_anotated`
--
ALTER TABLE `image_anotated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_original` (`image_id`),
  ADD KEY `fk_anotated_user` (`user_id`);

--
-- Indexes for table `image_original`
--
ALTER TABLE `image_original`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image_anotated`
--
ALTER TABLE `image_anotated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `image_original`
--
ALTER TABLE `image_original`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_anotated`
--
ALTER TABLE `image_anotated`
  ADD CONSTRAINT `fk_anotated_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_original` FOREIGN KEY (`image_id`) REFERENCES `image_original` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_original`
--
ALTER TABLE `image_original`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
