-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 10:55 AM
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

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`stu_lrn`, `section_code`, `semester`, `school_year`, `date_enroll`, `enroll_status`, `current_school`, `school_id`, `school_address`, `school_type`, `requirements_submit`) VALUES
('114403203289', 'SECTION-1847', '1st Semester', '2024-2025', '2024-11-03', 'ENROLLED', 'LEGAZPI CITY', NULL, 'LEGAZPI', 'PUBLIC', 'SF9, SF10, PSA Birth Certificate'),
('114483293271', 'SECTION-3371', '1st Semester', '2024-2025', '2024-11-03', 'ENROLLED', 'LEGAZPI HIGH SCHOOL', NULL, 'LEGAZPI', 'PUBLIC', 'SF9, SF10'),
('114497326715', 'SECTION-3371', '1st Semester', '2024-2025', '2024-11-03', 'ENROLLED', 'QWEQW', NULL, 'QWEWQ', 'PUBLIC', 'SF9, SF10'),
('114498343414', 'SECTION-1847', '1st Semester', '2024-2025', '2024-11-03', 'ENROLLED', 'DASDAS', NULL, 'ASDAS', 'PUBLIC', 'SF9');

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
('PRIN-2346', 'ANTHONY', 'DADO', 'DAEN', '9329392932', 'MALE', 'anthony@gmail.com', 'BRGY.58 BURAGUIS', 'USER-1436');

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
(1, 'COMPUTER SYSTEMS INSTITUTE, INC.', 'F. IMPERIAL ST., BRGY. 36 - CAPANTAWAN, LEGAZPI CITY');

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
('SECTION-1847', 'STRAND-2745', 'GRADE-11', 'ST.PAUL', '24-032411-5896', '2024-11-03'),
('SECTION-2971', 'STRAND-2745', 'GRADE-12', 'FIREFOX', '24-252011-1122', '2024-11-03'),
('SECTION-3371', 'STRAND-2745', 'GRADE-12', 'OPERA', '24-095-4031', '2024-11-03'),
('SECTION-3747', 'STRAND-2745', 'GRADE-12', 'EDGE', '24-785-3713', '2024-11-03'),
('SECTION-4873', 'STRAND-3453', 'GRADE-12', 'ENERGY', '24-032411-6451', '2024-11-03'),
('SECTION-5833', 'STRAND-3453', 'GRADE-11', 'ST.PADRE PIO', '24-032411-1206', '2024-11-03'),
('SECTION-6133', 'STRAND-2745', 'GRADE-11', 'ST.JOHN', '24-032411-7529', '2024-11-03'),
('SECTION-6295', 'STRAND-9457', 'GRADE-11', 'ST.JUDE', '24-032411-4108', '2024-11-03'),
('SECTION-6537', 'STRAND-2745', 'GRADE-12', 'ST.BENEDICT', '24-032411-1172', '2024-11-03'),
('SECTION-6737', 'STRAND-2745', 'GRADE-11', 'ST.GREGORY', '24-032411-9968', '2024-11-03'),
('SECTION-6965', 'STRAND-2745', 'GRADE-11', 'ST.PHILIP', '24-032411-9030', '2024-11-03'),
('SECTION-8583', 'STRAND-6675', 'GRADE-11', 'ST.THERESE', '24-032411-7367', '2024-11-03'),
('SECTION-9127', 'STRAND-2745', 'GRADE-12', 'GENESIS', '24-032411-2022', '2024-11-03'),
('SECTION-9227', 'STRAND-2745', 'GRADE-12', 'CHROME', '24-032411-2684', '2024-11-03'),
('SECTION-9994', 'STRAND-7781', 'GRADE-11', 'ST.CLAIRE', '24-032411-7324', '2024-11-03');

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

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_lrn`, `stu_fname`, `stu_mname`, `stu_lname`, `stu_address`, `stu_contact`, `stu_gender`, `stu_email`, `stu_dob`, `stu_pob`, `father_name`, `mother_name`, `parent_contact`, `id`) VALUES
('114403203289', 'ALIKON', 'JACK', 'POTSAS', 'DARAGA', '9329392932', 'FEMALE', 'alikon@gmail.com', '2000-11-28', 'LEGAZPI', 'TEST', 'TEST', '9329392932', 'USER-8636'),
('114422222222', 'JINKY', 'BALBE', 'JAQUIE', 'BURAUGIS', '9239293929', 'FEMALE', 'JINKY25@GMAIL.COM', '2024-10-24', 'LEGAZPI', 'MALIKONS JAQUIE', 'JACKKIEEE JAQUIE', '9392392932', 'USER-2931'),
('114432325251', 'JOHN RAY', 'BALDO', 'GUMAWADOD', 'LEGAZPI', '9329391239', 'MALE', 'jonhray@gmail.com', '2015-09-02', 'SAMPLE', 'ASDASDAS', 'ASDAS', '9329392932', 'USER-1316'),
('114455667788', 'DARIUS', 'VALDEZ', 'GAMOZA', 'LEGAZPI CITY', '9239239293', 'MALE', 'darius@gmail.com', '2024-11-03', 'LEGAZPI CITY', 'GAMOZA SALVE', 'GAMOZA CRISTAL', '9329329392', 'USER-3616'),
('114482392392', 'CALOY', 'HALBE', 'SMITH', 'LEGAZPI CITY', '9392392939', 'FEMALE', 'caloysmith24@gmail.com', '2024-12-02', 'BURAGUIS', 'JUAN BALDO SMITH', 'GLINDA SMITH', '9392932939', 'USER-9991'),
('114483293271', 'JOHN', 'BELBIS', 'UYALS', 'PAWA', '9329392932', 'MALE', 'leon@gmail.com', '2002-10-03', 'BITANO', 'SAMPLE', 'SAMNPLE', '9392932939', 'USER-9986'),
('114492392932', 'SAMPLE', 'SAMPLE', 'SAMPLE', 'SAMPLE', '9329139123', 'MALE', 'sample@gmail.com', '2022-11-30', 'SAMPLE', 'SAMPLE', 'SAMPLE', '9342939239', 'USER-8341'),
('114497326715', 'GEORGE', 'JAKIB', 'HALBES', 'BITANO LEGAZPI CITY', '9239239293', 'MALE', 'GEORGEHALBES@GMAIL.COM', '2001-10-05', 'BRTTH LEGAZPI', 'JONNY HALBES', 'KRISTINE HALBES', '9329392932', 'USER-1322'),
('114497427472', 'LESTER', '', 'SAPULA', 'BITANO', '9329392932', 'MALE', 'lester@gmail.com', '2002-07-04', 'BITANO', 'ASDAS', 'DASDSA', '9329329932', 'USER-9261'),
('114498343414', 'DWAYNE', 'HILBE', 'TUWEZA', 'BURAGUIS LEGAZPI CITY', '9123421321', 'MALE', 'dwaynetuweza@gmail.com', '2024-10-16', 'Buraguis Legazpi City', 'JOHN BALDES TUIZA', 'CRISTINE BALDES TUIZA', '9123123123', 'USER-3431'),
('114499887766', 'MARVIN', '', 'TAUZON', 'BURAGUIS', '9329392392', 'MALE', 'marvin@gmail.com', '2024-11-10', 'Legazpi City', 'PAPA TAUZON', 'MAMA TAUZON', '9412949194', 'USER-6346');

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
  `sub_gradelvl` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_code`, `sub_title`, `sub_type`, `sub_time`, `sub_semester`, `strand_code`, `sub_gradelvl`, `teacher_id`) VALUES
('SUB-7153', 'SOFTWARE ENGINEERING', 'SPECIALIZED SUBJECT', '--:-- --', '1st Semester', 'STRAND-3453', 'GRADE-12', '24-095-4031'),
('SUB-7634', 'P.E', 'APPLIED SUBJECT', '--:-- --', '1st Semester', 'STRAND-2745', 'GRADE-11', '24-095-4031');

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
('24-032411-1172', 'DUMMY5', 'DUMMY5', 'DUMMY5', 9235230235, 'FEMALE', '2024-11-03', 'FULL TIME', 'DUMMY5', '2024-11-03', 'USER-3834'),
('24-032411-1206', 'DUMMY3', 'DUMMY3', 'DUMMY3', 9235221341, 'MALE', '2024-11-03', 'PART TIME', 'DUMMY3', '2024-11-03', 'USER-3396'),
('24-032411-2022', 'DUMMY11', 'DUMMY11', 'DUMMY11', 9242124124, 'MALE', '2024-11-03', 'FULL TIME', 'DUMMY11', '2024-11-03', 'USER-3496'),
('24-032411-2684', 'DUMMY13', 'DUMMY13', 'DUMMY13', 9123151251, 'FEMALE', '2024-11-03', 'FULL TIME', 'DUMMY13', '2024-11-03', 'USER-8664'),
('24-032411-4108', 'DUMMY9', 'DUMMY9', 'DUMMY9', 9320582492, 'FEMALE', '2024-11-03', 'FULL TIME', 'DUMMY9', '2024-11-03', 'USER-4392'),
('24-032411-5896', 'JOHN', 'BALDE', 'TRANDO', 9463463463, 'MALE', '2024-11-03', 'FULL TIME', 'DUMMY', '2024-11-03', 'USER-3969'),
('24-032411-6451', 'DUMMY7', 'DUMMY7', 'DUMMY7', 9392139129, 'FEMALE', '2024-11-03', 'FULL TIME', 'DUMMY7', '2024-11-03', 'USER-8619'),
('24-032411-7324', 'DUMMY8', 'DUMMY8', 'DUMMY8', 9855123412, 'MALE', '2024-11-03', 'PART TIME', 'DUMMY8', '2024-11-03', 'USER-3111'),
('24-032411-7367', 'DUMMY6', 'DUMMY6', 'DUMMY6', 9124123421, 'FEMALE', '2024-11-03', 'FULL TIME', 'DUMMY6', '2024-11-03', 'USER-4122'),
('24-032411-7529', 'DUMMY10', 'DUMMY10', 'DUMMY10', 9042747247, 'FEMALE', '2024-11-03', 'FULL TIME', 'DUMMY10', '2024-11-03', 'USER-6683'),
('24-032411-9030', 'DUMMY2', 'DUMMY2', 'DUMMY2', 9329392932, 'MALE', '2024-11-03', 'FULL TIME', 'DUMMY2', '2024-11-03', 'USER-6669'),
('24-032411-9968', 'DUMMY4', 'DUMMY4', 'DUMMY4', 9236590342, 'MALE', '2024-11-03', 'FULL TIME', 'DUMMY4', '2024-11-03', 'USER-3233'),
('24-095-4031', 'MARY ANN', '', 'AJERO', 9329392939, 'FEMALE', '1995-11-02', 'FULL TIME', 'DARAGA', '2024-10-29', 'USER-6216'),
('24-252011-1122', 'DUMMY12', 'DUMMY12', 'DUMMY12', 9329329392, 'MALE', '2020-11-25', 'FULL TIME', 'BRGY.58 BURAGUIS', '2024-11-03', 'USER-6486'),
('24-785-3713', 'ZAC', 'GAMBO', 'SALCEDA', 9329392932, 'MALE', '1990-11-01', 'PART TIME', 'BURAGUIS', '2024-10-29', 'USER-3196');

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
(69, 'USER-1316', '114432325251', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-11-04 06:56:15'),
(41, 'USER-1322', '114497326715', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-27 21:56:03'),
(40, 'USER-1436', 'csi@legazpi', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ADMIN', '2024-10-26 22:30:33'),
(37, 'USER-2931', '114422222222', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-24 04:41:21'),
(61, 'USER-3111', 'dummy8', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:23:47'),
(52, 'USER-3196', 'zac', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-10-29 22:57:57'),
(57, 'USER-3233', 'dummy4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:21:42'),
(56, 'USER-3396', 'dummy3', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'TEACHER', '2024-11-03 18:21:18'),
(39, 'USER-3431', '114498343414', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-26 21:36:50'),
(64, 'USER-3496', 'dummy11', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:41:26'),
(72, 'USER-3616', '114455667788', '51330c0985ecdbf0eb4af46ac0d39c589bec37af', 'STUDENT', '2024-11-06 04:55:03'),
(58, 'USER-3834', 'dummy5', 'c96f36c50461c0654e7219e8bc68df6e4c4e62d9', 'TEACHER', '2024-11-03 18:22:07'),
(54, 'USER-3969', 'dummy1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:20:27'),
(59, 'USER-4122', 'dummy6', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:22:28'),
(62, 'USER-4392', 'dummy9', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:24:08'),
(53, 'USER-6216', 'ajero', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-10-29 23:00:05'),
(73, 'USER-6346', '114499887766', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-11-06 15:50:17'),
(65, 'USER-6486', 'dummy12', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:41:50'),
(55, 'USER-6669', 'dummy2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:20:55'),
(63, 'USER-6683', 'dummy10', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:26:18'),
(71, 'USER-8341', '114492392932', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-11-04 06:59:43'),
(60, 'USER-8619', 'dummy7', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:23:22'),
(46, 'USER-8636', '114403203289', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-29 02:18:33'),
(66, 'USER-8664', 'dummy13', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-03 18:42:17'),
(68, 'USER-9261', '114497427472', 'csi-24-040207', 'STUDENT', '2024-11-04 06:41:01'),
(45, 'USER-9986', '114483293271', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-29 02:16:11'),
(38, 'USER-9991', '114482392392', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-24 04:47:41');

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
  MODIFY `user_num` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
