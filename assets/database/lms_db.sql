-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 10:31 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `stu_lrn` varchar(12) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'STUDENT LRN',
  `section_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'SECTION NAME',
  `semester` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'set semester',
  `school_year` varchar(30) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'set school year',
  `date_enroll` date DEFAULT NULL,
  `enroll_status` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `current_school` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `school_id` mediumint UNSIGNED DEFAULT NULL,
  `school_address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `school_type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `requirements_submit` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principal_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `email`, `address`, `id`) VALUES
('PRIN-2451', 'Anthony', 'Dado', 'Daen', '9247282819', 'MALE', 'anthony@gmail.com', 'buraguis', 'USER-2551');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `ID` int NOT NULL,
  `SCHOOL_NAME` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `SCHOOL_ADDRESS` varchar(150) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`ID`, `SCHOOL_NAME`, `SCHOOL_ADDRESS`) VALUES
(1, 'COMPUTER SYSTEM INSTITUTE, INC.', 'F. IMPERIAL ST., BRGY. 36 - CAPANTAWAN, LEGAZPI CITY');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `strand_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `grade_lvl` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `section_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_code`, `strand_code`, `grade_lvl`, `section_name`, `teacher_id`, `date_created`) VALUES
('SECTION-3577', 'STRAND-5688', 'GRADE-12', 'ST.PADRE PIO', 'TEACHER-5651', '2024-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_name`, `status`) VALUES
('1st Semester', 'Active'),
('2nd Semester', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `strand`
--

CREATE TABLE `strand` (
  `strand_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `strand_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `strand_desc` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strand`
--

INSERT INTO `strand` (`strand_code`, `strand_name`, `strand_desc`) VALUES
('STRAND-2745', 'GAS', 'General Academic Strand'),
('STRAND-3453', 'STEM', 'Science, Technology, Engineering, and Mathematics'),
('STRAND-5688', 'ABM', 'Accountancy, Business, and Management'),
('STRAND-6675', 'CP', 'Computer Programming'),
('STRAND-7781', 'HUMSS', 'Humanities and Social Sciences'),
('STRAND-9457', 'CSS', 'Computer System Servicing');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_lrn` varchar(12) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'STUDENT LRN',
  `stu_fname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_mname` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stu_lname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_contact` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_gender` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_pob` varchar(70) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Place of birth',
  `father_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parent name',
  `mother_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parent Name',
  `parent_contact` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PRIMARY KEY',
  `sub_title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'SUBJECT NAME',
  `sub_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_time` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_semester` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `strand_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_code`, `sub_title`, `sub_type`, `sub_time`, `sub_semester`, `strand_code`, `teacher_id`) VALUES
('SUB-6691', 'FILIPINO', 'SPECIALIZED SUBJECT', '--:-- --', '1st Semester', 'STRAND-3453', 'TEACHER-5651');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `school_year` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sy`
--

INSERT INTO `sy` (`school_year`, `status`) VALUES
('2024-2025', 'Active'),
('2025-2026', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Primary key',
  `teacher_fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_mname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_contact` bigint DEFAULT NULL,
  `teacher_gender` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_dob` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` date NOT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_fname`, `teacher_mname`, `teacher_lname`, `teacher_contact`, `teacher_gender`, `teacher_dob`, `status`, `teacher_address`, `date_added`, `id`) VALUES
('TEACHER-5651', 'SELVA', 'MARQUEZ', 'ABAD', 9923293929, 'MALE', '2024-05-01', 'FULL TIME', 'ALBAY', '2024-10-24', 'USER-2996'),
('TEACHER-7938', 'MARY ANN', '', 'AJERO', 9392932939, 'FEMALE', '2024-10-24', 'FULL TIME', 'DARAGA', '2024-10-24', 'USER-6861');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_num` int NOT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_num`, `id`, `username`, `password`, `role`, `date_added`) VALUES
(36, 'USER-2551', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ADMIN', '2024-10-24 04:24:38'),
(35, 'USER-2996', 'silvana', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-10-24 03:25:31'),
(34, 'USER-6861', 'ajero', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-10-24 03:17:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`stu_lrn`,`section_code`),
  ADD KEY `section_code` (`section_code`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principal_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_code`),
  ADD KEY `strand_code` (`strand_code`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `strand`
--
ALTER TABLE `strand`
  ADD PRIMARY KEY (`strand_code`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_lrn`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_code`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `strand_code` (`strand_code`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_num` (`user_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_num` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`stu_lrn`) REFERENCES `student` (`stu_lrn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`section_code`) REFERENCES `section` (`section_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `principal`
--
ALTER TABLE `principal`
  ADD CONSTRAINT `principal_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`strand_code`) REFERENCES `strand` (`strand_code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`strand_code`) REFERENCES `strand` (`strand_code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
