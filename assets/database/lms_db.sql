-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 02:29 PM
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
  `stu_lrn` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'STUDENT LRN',
  `section_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'SECTION NAME',
  `semester` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'set semester',
  `school_year` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'set school year',
  `date_enroll` date DEFAULT NULL,
  `enroll_status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `current_school` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `school_id` mediumint UNSIGNED DEFAULT NULL,
  `school_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `school_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `requirements_submit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`stu_lrn`, `section_code`, `semester`, `school_year`, `date_enroll`, `enroll_status`, `current_school`, `school_id`, `school_address`, `school_type`, `requirements_submit`) VALUES
('114423232323', 'SECTION-2387', '1st Semester', '2024-2025', '2024-12-30', 'Pending', 'CABANGAN HIGH SCHOOL', NULL, 'CABANGAN LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR'),
('114432325251', 'SECTION-2287', '1st Semester', '2024-2025', '2024-12-13', 'Enrolled', 'PAGASA NATIONAL HIGH SCHOOL', NULL, 'RAWIS LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114455013001', 'SECTION-2663', '1st Semester', '2024-2025', '2024-12-29', 'Enrolled', 'ARIMBAY HIGH SCHOLL', NULL, 'ARIMBAY LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114455667788', 'SECTION-2387', '1st Semester', '2024-2025', '2025-01-11', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'CABANGAN LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114482392392', 'SECTION-1859', '1st Semester', '2024-2025', '2024-12-20', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'CABANGAN LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114497427472', 'SECTION-1859', '1st Semester', '2024-2025', '2024-12-23', 'Pending', 'CABANGAN HIGH SCOLL', NULL, 'CABANGAN LEGAZPI VCITY', 'PUBLIC', 'SF9, SF10, PSA, LCR'),
('114498343414', 'SECTION-1859', '1st Semester', '2024-2025', '2025-01-12', 'Enrolled', 'ORO SITE HIGH SCHOOL', NULL, 'ORO SITE LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('124167743724', 'SECTION-1859', '1st Semester', '2024-2025', '2024-12-26', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'CABANGAN LEGAZPI', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('718412412421', 'SECTION-1859', '1st Semester', '2024-2025', '2025-01-06', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'CABANGAN LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT '1. Multiple choice, 2. Enumeration, 3. Essay, 4. True or False ',
  `exam_quarter` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_duration` int NOT NULL,
  `exam_title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_desc` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `exam_number` tinyint NOT NULL,
  `exam_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `sched_id`, `exam_type`, `exam_quarter`, `exam_duration`, `exam_title`, `exam_desc`, `exam_number`, `exam_date`) VALUES
('EXM-2202', 'SCHED-3005', '2,1,3', '1st', 2, 'asdas', 'asdas', 3, '2025-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `exam_enumeration`
--

CREATE TABLE `exam_enumeration` (
  `enum_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `enum_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enum_answer` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_enumeration`
--

INSERT INTO `exam_enumeration` (`enum_id`, `exam_id`, `enum_question`, `enum_answer`) VALUES
(19, 'EXM-2202', 'samnplke', '232, sdample .sad ');

-- --------------------------------------------------------

--
-- Table structure for table `exam_essay`
--

CREATE TABLE `exam_essay` (
  `essay_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `essay_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_essay`
--

INSERT INTO `exam_essay` (`essay_id`, `exam_id`, `essay_question`) VALUES
(5, 'EXM-2202', 'asdasdsa');

-- --------------------------------------------------------

--
-- Table structure for table `exam_multiple`
--

CREATE TABLE `exam_multiple` (
  `mul_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `mul_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_a` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_b` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_c` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_d` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_correct` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_multiple`
--

INSERT INTO `exam_multiple` (`mul_id`, `exam_id`, `mul_question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `is_correct`) VALUES
(53, 'EXM-2202', 'whay is may name', 'anthony', 'asdas', 'ssdw', 'cc', 'anthony');

-- --------------------------------------------------------

--
-- Table structure for table `exam_tf`
--

CREATE TABLE `exam_tf` (
  `tf_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tf_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tf_answer` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `formatted_size` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `file_name`, `file_size`, `formatted_size`, `file_type`, `sched_id`, `date_uploaded`) VALUES
('MOD-7383', '../../faculty/module_uploaded/beluga.jpg', 16379, '16 KB', 'image/jpeg', 'SCHED-3005', '2025-01-14 02:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `module_answer`
--

CREATE TABLE `module_answer` (
  `answer_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `module_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `stu_lrn` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `formatted_size` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principal_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `email`, `address`, `image`, `id`) VALUES
('PR-7572', 'DANTE', '', 'ARINGO', '9392392932', 'MALE', 'aringo@gmail.com', 'BITANO LEGAZPI CITY', 'principal_6759b4aa238385.38662311.jpg', 'USER-4861');

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `registrar_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`registrar_id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `email`, `address`, `image`, `id`) VALUES
('REG-1891', 'MARICAR', 'CARREON', 'AYDALLA', '9329392392', 'FEMALE', 'registrar@gmail.com', 'MATANAG LEGAZPI CITY', '', 'USER-1875');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `section_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sched_day` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sched_from` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sched_to` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `teacher_id`, `section_code`, `sub_code`, `sched_day`, `sched_from`, `sched_to`, `created_at`) VALUES
('SCHED-0762', '24-209505-8181', 'SECTION-2663', 'SUB-3699', 'Friday', '08:00 AM', '10:00 AM', '2024-12-28 20:02:31'),
('SCHED-0950', '24-299710-4779', 'SECTION-2387', 'SUB-3375', 'Friday', '08:00 AM', '10:00 AM', '2024-12-30 20:21:44'),
('SCHED-1274', '24-279707-4937', 'SECTION-2287', 'SUB-7279', 'Monday', '07:30 AM', '10:30 AM', '2024-12-30 12:31:59'),
('SCHED-1393', '24-059310-4617', 'SECTION-1859', 'SUB-3164', 'Monday', '08:30 AM', '10:30 AM', '2024-12-28 19:31:30'),
('SCHED-3005', '24-299710-4779', 'SECTION-1859', 'SUB-3563', 'Monday', '03:00 PM', '05:20 PM', '2024-12-28 19:35:09'),
('SCHED-3238', '24-059310-4617', 'SECTION-1859', 'SUB-9527', 'Tuesday', '08:30 AM', '11:30 AM', '2024-12-28 19:24:12'),
('SCHED-8004', '24-199603-2911', 'SECTION-3943', 'SUB-7279', 'Monday', '07:20 AM', '09:11 AM', '2025-01-13 15:10:48'),
('SCHED-8714', '24-229809-8556', 'SECTION-3891', 'SUB-2557', 'Thursday', '07:30 AM', '09:30 AM', '2024-12-30 20:29:41'),
('SCHED-9034', '24-049512-1359', 'SECTION-1859', 'SUB-7279', 'Monday', '07:00 AM', '10:38 PM', '2024-12-30 10:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `ID` int NOT NULL,
  `SCHOOL_NAME` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SCHOOL_ADDRESS` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
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
  `section_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `strand_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `grade_lvl` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `section_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_code`, `strand_code`, `grade_lvl`, `section_name`, `teacher_id`, `date_created`) VALUES
('SECTION-1859', 'STRAND-9457', 'GRADE-11', 'ST.PHILIP', '24-049906-5894', '2024-12-13'),
('SECTION-2287', 'STRAND-5688', 'GRADE-11', 'ST.ANTHONY', '24-229809-8556', '2024-12-13'),
('SECTION-2387', 'STRAND-6675', 'GRADE-11', 'ST.THERESE', '24-299710-4779', '2024-12-30'),
('SECTION-2663', 'STRAND-9457', 'GRADE-11', 'ST.AGNES', '24-049512-1359', '2024-12-28'),
('SECTION-3891', 'STRAND-3453', 'GRADE-11', 'ST.PADRE PIO', '24-029805-2543', '2024-12-13'),
('SECTION-3943', 'STRAND-7781', 'GRADE-11', 'ST.CLAIRE', '24-199603-2911', '2024-12-13'),
('SECTION-9151', 'STRAND-2745', 'GRADE-11', 'ST.PAUL', '24-269711-1668', '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `strand_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `strand_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `strand_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strand`
--

INSERT INTO `strand` (`strand_code`, `strand_name`, `strand_desc`) VALUES
('STRAND-2745', 'GAS', 'GENERAL ACADEMIC STRAND'),
('STRAND-3453', 'STEM', 'SCIENCE, TECHNOLOGY, ENGINEERING, AND MATHEMATICS'),
('STRAND-5688', 'ABM', 'ACCOUNTANCY, BUSINESS, AND MANAGEMENT'),
('STRAND-6675', 'CP', 'COMPUTER PROGRAMMING'),
('STRAND-7781', 'HUMSS', 'HUMANITIES AND SOCIAL SCIENCES'),
('STRAND-9457', 'CSS', 'COMPUTER SYSTEM SERVICING');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_lrn` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'STUDENT LRN',
  `stu_fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stu_mname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stu_lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stu_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stu_contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stu_gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stu_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_pob` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Place of birth',
  `father_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parent name',
  `mother_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Parent Name',
  `parent_contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_lrn`, `stu_fname`, `stu_mname`, `stu_lname`, `stu_address`, `stu_contact`, `stu_gender`, `stu_email`, `stu_dob`, `stu_pob`, `father_name`, `mother_name`, `parent_contact`, `image`, `id`) VALUES
('113312312541', 'SHY', 'BARRIOS', 'BALBIN', 'CABANGAN', '9392932939', 'FEMALE', 'shy@gmail.com', '2004-02-11', 'CABANGAN LEGAZPI CITY', 'BALBIN, SAMUEL', 'BALBIN, ERICA', '9429492942', '', 'USER-6186'),
('114403203289', 'ALIKON', 'JACK', 'SABDAO', 'DARAGA', '9329392931', 'FEMALE', 'alikon@gmail.com', '2000-11-28', 'LEGAZPI', 'TEST', 'TESTS', '9329392932', '', 'USER-8636'),
('114422222222', 'JINKY', 'BALBE', 'JAQUIE', 'BURAUGIS', '9239293929', 'FEMALE', 'JINKY25@GMAIL.COM', '2024-10-24', 'LEGAZPI', 'MALIKONS JAQUIE', 'JACKKIEEE JAQUIE', '9392392932', '', 'USER-2931'),
('114423232323', 'DANIEL', 'DADO', 'DAEN', 'BURAGUIS LEGAZPI CITY', '9329392392', 'MALE', 'daniel@gmail.com', '2004-11-24', 'BURAGUIS', 'SIMEON DAEN', 'CRISTINA DAEN', '9329392392', '', 'USER-6462'),
('114423993283', 'RODRIGO', '', 'BALDEZ', 'BURAGUIS', '9392392932', 'MALE', 'RODRIGO@gmail.com', '2024-11-07', 'LEGAZPI ALBAY', 'SALBADOR BALDEZ', 'MARIZA BALDEZ', '9494848455', '', 'USER-6143'),
('114432325251', 'JAMES', 'BALDO', 'BALDES', 'LEGAZPI', '9329391239', 'MALE', 'jonhray@gmail.com', '2015-09-02', 'SAMPLE', 'BALDES RODRIGO', 'BALDES MARIA', '9329392932', '', 'USER-1316'),
('114455013001', 'POLO', 'BO', 'ASEJO', 'LEGAZPI CITY', '9329392939', 'MALE', 'polo@gmail.com', '2004-11-27', 'LEGAPZI', 'ASEJO, DARUIS', 'ASEJO , JULIANA', '9392932939', '', 'USER-1829'),
('114455667788', 'DARIUS', 'VALDEZ', 'GAMOZA', 'LEGAZPI CITY', '9239239293', 'MALE', 'darius@gmail.com', '2024-11-03', 'LEGAZPI CITY', 'GAMOZA SALVE', 'GAMOZA CRISTAL', '9329329392', '', 'USER-3616'),
('114475130060', 'GIAN MARK', 'TAULE', 'SALLAN', 'GOGON LEGAZPI CITY', '9323912391', 'MALE', 'gian@gmail.com', '2004-06-16', 'LEGAZPI CITY', 'SALLAN, BERNARD', 'SALLAN, SARAH', '9392392932', '', 'USER-8254'),
('114482392392', 'CALOY', 'HALBE', 'SMITH', 'LEGAZPI CITY', '9392392939', 'MALE', 'caloysmith24@gmail.com', '2024-12-02', 'Buraguis', 'JUAN BALDO SMITH', 'GLINDA SMITH', '9392932939', '', 'USER-9991'),
('114483293271', 'JOHN', 'BELBIS', 'UYALS', 'PAWA', '9329392932', 'MALE', 'leon@gmail.com', '2002-10-03', 'BITANO', 'SAMPLE', 'SAMNPLE', '9392932939', '', 'USER-9986'),
('114485140095', 'MAECHELLE', 'GAVERIA', 'ACOSTA', 'DARAGA', '9329392932', 'FEMALE', 'maechelle@gmail.com', '2003-11-29', 'Legazpi City', 'ACOSTA, HUELDOR', 'ACOSTA, MAE', '9329392939', '', 'USER-8853'),
('114486120037', 'SHYRIEN', 'NUNEZ', 'VIBAL', 'LEGAZPI CITY', '9329392392', 'FEMALE', 'shyrien@gmail.com', '2002-11-29', 'LEGAZPI CITY', 'VIBAL, MELCHOR', 'VIBAL. ESABELLA', '9329392932', '', 'USER-6627'),
('114497427472', 'LESTER', '', 'SAPULA', 'BITANO', '9329392932', 'MALE', 'lester@gmail.com', '2002-07-04', 'BITANO', 'ASDAS', 'DASDSA', '9329329932', '', 'USER-9261'),
('114498343414', 'DWAYNE ADRIAN', 'OSEñA', 'TUIZA', 'BURAGUIS LEGAZPI CITY', '9123421321', 'MALE', 'dwaynetuweza@gmail.com', '2024-10-16', 'Buraguis Legazpi City', 'JOHN BALDES TUIZA', 'CRISTINE BALDES TUIZA', '9123123123', 'student_6783d561d37be3.65803100.jpg', 'USER-3431'),
('114499887766', 'MARVIN', '', 'TAUZON', 'BURAGUIS', '9329392392', 'MALE', 'marvin@gmail.com', '2024-11-10', 'Legazpi City', 'PAPA TAUZON', 'MAMA TAUZON', '9412949194', '', 'USER-6346'),
('124167743724', 'ANTHONY NICOLE', 'DADO', 'DAEN', 'BURAGUIS LEGAZPI CITY', '9329392392', 'MALE', 'anthonydaen25@gmail.com', '2002-05-10', 'Legazpi City', 'DAEN, SIMEON LUNAS', 'DAEN, CRISTINA DADO', '9329329392', 'student_67545f4c50dfa9.77726496.jpg', 'USER-7881'),
('718412412421', 'MARCO', 'DADO', 'DAEN', 'BURAGUIS LEGAZPI CITY', '9329392392', 'MALE', 'marco@gmail.com', '2006-03-28', 'LEGAZPI CITY', 'DAEN, SIMEON', 'DAEN, CRISTINA', '9431924912', '', 'USER-0399');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PRIMARY KEY',
  `sub_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'SUBJECT NAME',
  `sub_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sub_time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_semester` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_code`, `sub_title`, `sub_type`, `sub_time`, `sub_semester`) VALUES
('SUB-1339', 'PRACTICAL RESEARCH 2', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-1374', 'KUMUNIKASYON AT PANANALIKSIK', 'CORE', '--:-- --', '1st Semester'),
('SUB-1668', 'TECH VOC 5 - DIAGNOSE COMPUTER SYSTEMS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-1783', 'PRACTICAL  RESEARCH 1', 'SPECIALIZED', '--:-- --', '2nd Semester'),
('SUB-1849', 'EMPOWERMENT TECHNOLOGIES', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-1921', 'CREATIVE NON-FICTION', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-2471', 'GENERAL MATHEMATICS', 'CORE', '--:-- --', '1st Semester'),
('SUB-2557', 'PRE-CALCULUS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-2689', 'BIOLOGY 2', 'SPECIALIZED', '--:-- --', '2nd Semester'),
('SUB-2971', 'GENERAL CHEMISTRY', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-2984', '21 CENTURY LITERATURE', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-3164', 'TECH VOC 1- PC OPERATIONS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-3375', 'EARTH AND LIFE SCIENCE', 'CORE', '--:-- --', '1st Semester'),
('SUB-3563', 'ENGLISH FOR ACADEMIC AND PROFESSIONAL', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-3699', 'TECH VOC 2 - INSTALL COMPUTER NETWORKS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-4117', 'BIOLOGY 1', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-4542', 'HUMANITIES 1 - CREATIVE WRITING', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-5185', 'TECH VOC 6-APPLY OOP LANGUAGE SKILLS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-5218', 'BUSINESS ETHICS AND SOCIAL RESPONSIBILITY', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-6568', 'INTRODUCTION TO THE PHIL', 'CORE', '--:-- --', '1st Semester'),
('SUB-6716', 'HUMANITIES 2- TRENDS, NETWORKING', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-7279', 'ORAL COMMUNICATION IN TEXT', 'CORE', '--:-- --', '1st Semester'),
('SUB-8742', 'PERSONAL DEVELOPMENT', 'CORE', '--:-- --', '1st Semester'),
('SUB-9527', 'TECH VOC 1- INSTALL COMPUTER SYSTEMS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-9691', 'READING AND WRITING SKILLS', 'CORE', '--:-- --', '2nd Semester'),
('SUB-9839', 'HOPE-2', 'CORE', '--:-- --', '1st Semester');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `school_year` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `teacher_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Primary key',
  `teacher_fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_mname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_contact` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_dob` date NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_fname`, `teacher_mname`, `teacher_lname`, `teacher_contact`, `teacher_gender`, `teacher_dob`, `status`, `teacher_address`, `image`, `id`) VALUES
('24-029805-2543', 'MARY ANN', '', 'AJERO', '9329392939', 'FEMALE', '1998-05-02', 'FULL TIME', 'DARAGA', '', 'USER-6162'),
('24-029810-1540', 'ARIEL', '', 'ABALETA', '9294929429', 'MALE', '1998-10-03', 'FULL TIME', 'LEGAZPI CITY', '', 'USER-8224'),
('24-049512-1359', 'PERLA', 'RELLETA', 'ALA', '9825328113', 'FEMALE', '1995-12-04', 'FULL TIME', 'BURAGUIS LEGAZPI CITY', NULL, 'USER-8185'),
('24-049906-5894', 'DESIREE', '', 'DIAZ', '9294929429', 'FEMALE', '1999-06-04', 'FULL TIME', 'LEGAZPI CITY', '', 'USER-6036'),
('24-059310-4617', 'NORBERTO', 'ATUN', 'LLAMOSO', '9392392939', 'MALE', '1993-10-05', 'FULL TIME', 'DARAGA', 'teacher_677e9f64ab20c5.97298213.jpg', 'USER-6486'),
('24-059711-7139', 'MERCY', '', 'MACASINAG', '9329392939', 'FEMALE', '1997-11-05', 'FULL TIME', 'LEGAZPI CITY', '', 'USER-3454'),
('24-199603-2911', 'DANTE', '', 'ARINGO', '9329392955', 'MALE', '1996-03-19', 'FULL TIME', 'BITANO LEGAZPI', '', 'USER-2686'),
('24-199612-2660', 'REGIE', '', 'AJERO', '9999221231', 'MALE', '1996-12-19', 'FULL TIME', 'DARAGA', NULL, 'USER-8393'),
('24-209505-8181', 'JEROME', '', 'DELFINO', '9392392939', 'MALE', '1995-05-20', 'FULL TIME', 'LEGAZPI CITY', 'teacher_676ec1436d69e7.16830829.png', 'USER-0607'),
('24-209912-3345', 'KATRIN', '', 'ÑUNEZ', '9991122442', 'FEMALE', '1999-12-20', 'FULL TIME', 'DARAGA', NULL, 'USER-9487'),
('24-229809-8556', 'HANILY', '', 'ASAYTUNO', '9329392939', 'FEMALE', '1998-09-22', 'FULL TIME', 'LEGAZPI CITY', '', 'USER-5858'),
('24-269711-1668', 'JONRO', '', 'BANGUSO', '9329392939', 'MALE', '1997-11-26', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-2866'),
('24-279707-4937', 'DARWIN', '', 'JACOB', '9123776562', 'MALE', '1997-07-27', 'FULL TIME', 'BITANO LEGAZPI CITY', NULL, 'USER-3384'),
('24-299211-8709', 'MERLANDY', 'MENDENILLA', 'LATUNA', '9329392932', 'MALE', '1992-11-29', 'FULL TIME', 'CABANGAN LEGAZPI CITY', '', 'USER-6429'),
('24-299710-4779', 'MYRA', '', 'MADARA', '9392932939', 'FEMALE', '1997-10-29', 'FULL TIME', 'LEGAZPI CITY', '', 'USER-3041'),
('24-299909-9301', 'JESELLE ANN', '', 'NAVAMO', '9329392939', 'FEMALE', '1999-09-29', 'FULL TIME', 'LEGAZPI CITY', '', 'USER-9953');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_num` int NOT NULL,
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_num`, `id`, `username`, `password`, `role`, `date_added`) VALUES
(122, 'USER-0399', '718412412421', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2025-01-06 20:13:20'),
(94, 'USER-0607', 'LMS-209505-5945', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-28 20:11:17'),
(69, 'USER-1316', '114432325253', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-11-04 06:56:15'),
(110, 'USER-1829', '114455013001', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-12-07 01:57:56'),
(114, 'USER-1875', 'registrar', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'REGISTRAR', '2024-12-11 21:22:43'),
(80, 'USER-2686', 'LMS-199603-6563', 'c25b7bba3ff6a54c12b48278a9a690637e5ba403', 'TEACHER', '2024-11-24 19:36:52'),
(112, 'USER-2866', 'LMS-269711-4463', '4976364fbd685104e2afe280f1578b770097402d', 'TEACHER', '2024-12-07 02:10:09'),
(37, 'USER-2931', '114412345672', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-24 04:41:21'),
(95, 'USER-3041', 'teacher1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-28 20:12:06'),
(121, 'USER-3384', 'LMS-279707-3418', 'e3575593947ea10529f41b106d7e71e2abc034f8', 'TEACHER', '2024-12-27 22:41:37'),
(39, 'USER-3431', '114498343414', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-26 21:36:50'),
(93, 'USER-3454', 'LMS-059711-1061', 'ac8134b0f4bccf09fd0d7ffa57e3962f5c498947', 'TEACHER', '2024-11-28 20:10:24'),
(72, 'USER-3616', '114455667788', '51330c0985ecdbf0eb4af46ac0d39c589bec37af', 'STUDENT', '2024-11-06 04:55:03'),
(84, 'USER-4861', 'principal', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'PRINCIPAL', '2024-11-26 23:42:32'),
(91, 'USER-5858', 'LMS-229809-5341', '8d73b567714515162d51584a9e127dfefd2e8321', 'TEACHER', '2024-11-28 20:07:33'),
(90, 'USER-6036', 'LMS-049906-2097', 'f414a45e016d0fa329dc38a8c4520589994e4e8f', 'TEACHER', '2024-11-28 20:06:57'),
(74, 'USER-6143', '114423993283', '37116f963deeb847884b81dec21972a7ae95dd14', 'STUDENT', '2024-11-24 17:21:22'),
(81, 'USER-6162', 'LMS-029805-1471', 'e8300544e297a2cc16f8ce5700d9e959d409238c', 'TEACHER', '2024-11-24 19:38:13'),
(116, 'USER-6186', '113312312541', '337f01184a3f26ab378b5a8b29c080198c7a7543', 'STUDENT', '2024-12-16 23:23:22'),
(73, 'USER-6346', '114499887766', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-11-06 15:50:17'),
(83, 'USER-6429', 'LMS-299211-3180', 'b74689565cd91566a7b3d8dde4c2b0ffe3ce486a', 'TEACHER', '2024-11-24 22:23:16'),
(77, 'USER-6462', '114423232323', '39bd71ceb3a7ee0febd8fce816505355acc46eb8', 'STUDENT', '2024-11-24 18:48:44'),
(82, 'USER-6486', 'LMS-059310-1695', '6c5bc6fb30aa22e9b6b70bf482a0f470e810d98d', 'TEACHER', '2024-11-24 22:21:53'),
(113, 'USER-6627', '114486120037', 'd35519a066831dc5506c8711aec94132b93bec6b', 'STUDENT', '2024-12-07 02:14:22'),
(107, 'USER-7881', 'nicolas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-12-07 01:02:17'),
(118, 'USER-8185', 'LMS-049512-6260', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-12-19 21:48:44'),
(88, 'USER-8224', 'LMS-029810-7901', '79f3e68c5909b763831a7e0b71ed38070f14e044', 'TEACHER', '2024-11-27 00:29:18'),
(115, 'USER-8254', '114475130060', '7a9f1c45dbade65d0590f3e33afef2711c253f6c', 'STUDENT', '2024-12-16 23:14:52'),
(98, 'USER-8363', 'LMS-290211-8547', 'd35519a066831dc5506c8711aec94132b93bec6b', 'TEACHER', '2024-11-30 16:42:32'),
(117, 'USER-8393', 'LMS-199612-8910', 'b6a0412c5545f9e71de0d185853c781d02f74f15', 'TEACHER', '2024-12-19 21:47:04'),
(46, 'USER-8636', '114403203289', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-10-29 02:18:33'),
(111, 'USER-8853', '114485140095', '400a660369b3fce52c68b9f61c0766361f9ce629', 'STUDENT', '2024-12-07 02:03:00'),
(68, 'USER-9261', '114497427472', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'STUDENT', '2024-11-04 06:41:01'),
(120, 'USER-9487', 'LMS-209912-1841', '7478d68cb5648a34811e524a3720fa0cc9958db4', 'TEACHER', '2024-12-27 20:20:31'),
(92, 'USER-9953', 'teacher', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TEACHER', '2024-11-28 20:08:38'),
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
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `fk_exam_sched` (`sched_id`);

--
-- Indexes for table `exam_enumeration`
--
ALTER TABLE `exam_enumeration`
  ADD PRIMARY KEY (`enum_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_essay`
--
ALTER TABLE `exam_essay`
  ADD PRIMARY KEY (`essay_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_multiple`
--
ALTER TABLE `exam_multiple`
  ADD PRIMARY KEY (`mul_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_tf`
--
ALTER TABLE `exam_tf`
  ADD PRIMARY KEY (`tf_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`),
  ADD KEY `fk_module_schedule` (`sched_id`);

--
-- Indexes for table `module_answer`
--
ALTER TABLE `module_answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_module` (`module_id`),
  ADD KEY `fk_student` (`stu_lrn`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principal_id`),
  ADD KEY `fk_users_id` (`id`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`registrar_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`),
  ADD KEY `fk_section` (`section_code`),
  ADD KEY `fk_subject` (`sub_code`),
  ADD KEY `fk_schedule_teacher` (`teacher_id`);

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
  ADD KEY `fk_teacher_section` (`teacher_id`);

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
  ADD PRIMARY KEY (`sub_code`);

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
-- AUTO_INCREMENT for table `exam_enumeration`
--
ALTER TABLE `exam_enumeration`
  MODIFY `enum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `exam_essay`
--
ALTER TABLE `exam_essay`
  MODIFY `essay_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_multiple`
--
ALTER TABLE `exam_multiple`
  MODIFY `mul_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `exam_tf`
--
ALTER TABLE `exam_tf`
  MODIFY `tf_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_num` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `fk_enroll_section` FOREIGN KEY (`section_code`) REFERENCES `section` (`section_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_enroll_student` FOREIGN KEY (`stu_lrn`) REFERENCES `student` (`stu_lrn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `fk_exam_sched` FOREIGN KEY (`sched_id`) REFERENCES `schedule` (`sched_id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_enumeration`
--
ALTER TABLE `exam_enumeration`
  ADD CONSTRAINT `exam_enumeration_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_essay`
--
ALTER TABLE `exam_essay`
  ADD CONSTRAINT `exam_essay_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_multiple`
--
ALTER TABLE `exam_multiple`
  ADD CONSTRAINT `exam_multiple_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_tf`
--
ALTER TABLE `exam_tf`
  ADD CONSTRAINT `exam_tf_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `fk_module_schedule` FOREIGN KEY (`sched_id`) REFERENCES `schedule` (`sched_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_answer`
--
ALTER TABLE `module_answer`
  ADD CONSTRAINT `fk_module` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`stu_lrn`) REFERENCES `student` (`stu_lrn`) ON DELETE CASCADE;

--
-- Constraints for table `principal`
--
ALTER TABLE `principal`
  ADD CONSTRAINT `fk_users_id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registrar`
--
ALTER TABLE `registrar`
  ADD CONSTRAINT `registrar_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_schedule_section` FOREIGN KEY (`section_code`) REFERENCES `section` (`section_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_schedule_subject` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_schedule_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `fk_teacher_section` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`strand_code`) REFERENCES `strand` (`strand_code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_users` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_teacher_users` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
