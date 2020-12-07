-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 06:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgdit`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_info`
--

CREATE TABLE `batch_info` (
  `batch_id` int(11) DEFAULT NULL,
  `batch_time` varchar(20) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `course_synonym` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `result_details`
--

CREATE TABLE `result_details` (
  `std_sl` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `attendance` int(11) DEFAULT NULL,
  `quiz` int(11) DEFAULT NULL,
  `class_test` int(11) DEFAULT NULL,
  `lab` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `final` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session_info`
--

CREATE TABLE `session_info` (
  `session_id` int(11) DEFAULT NULL,
  `session` varchar(10) DEFAULT NULL,
  `session_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `std_roll` int(11) DEFAULT NULL,
  `reg_no` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `present_address` varchar(200) DEFAULT NULL,
  `permanent_address` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` varchar(3) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nid` int(20) DEFAULT NULL,
  `emailid` varchar(60) DEFAULT NULL,
  `contact_no` varchar(17) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `std_sl` int(11) NOT NULL,
  `academic_session` varchar(10) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `subject_code` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_info`
--

CREATE TABLE `testimonial_info` (
  `std_sl` int(11) DEFAULT NULL,
  `apply_date` date DEFAULT NULL,
  `is_granted` varchar(1) DEFAULT NULL,
  `grant_date` date DEFAULT NULL,
  `granted_by` varchar(30) DEFAULT NULL,
  `is_issued` varchar(1) DEFAULT NULL,
  `issued_by` varchar(30) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `is_duplicate` varchar(1) DEFAULT NULL,
  `no_of_duplicate` int(11) DEFAULT NULL,
  `tmsl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `sl_no` int(11) NOT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `passwd` varchar(1000) DEFAULT NULL,
  `user_type` varchar(15) DEFAULT NULL,
  `std_sl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `result_details`
--
ALTER TABLE `result_details`
  ADD KEY `std_sl_fk` (`std_sl`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`std_sl`),
  ADD KEY `course_id_fk` (`course_id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`subject_code`),
  ADD KEY `course_subject_fk` (`course_id`);

--
-- Indexes for table `testimonial_info`
--
ALTER TABLE `testimonial_info`
  ADD PRIMARY KEY (`tmsl`),
  ADD KEY `student_id_fk` (`std_sl`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`sl_no`),
  ADD KEY `student_user_fk` (`std_sl`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `result_details`
--
ALTER TABLE `result_details`
  ADD CONSTRAINT `std_sl_fk` FOREIGN KEY (`std_sl`) REFERENCES `student_info` (`std_sl`);

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `course_id_fk` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`);

--
-- Constraints for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD CONSTRAINT `course_subject_fk` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`);

--
-- Constraints for table `testimonial_info`
--
ALTER TABLE `testimonial_info`
  ADD CONSTRAINT `student_id_fk` FOREIGN KEY (`std_sl`) REFERENCES `student_info` (`std_sl`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `student_user_fk` FOREIGN KEY (`std_sl`) REFERENCES `student_info` (`std_sl`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
