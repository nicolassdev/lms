-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 04:40 PM
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
('112040110002', 'SECTION-0626', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'RAWIS HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('112054130026', 'SECTION-6218', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'GOGON HIGH SCHOOL', NULL, 'GOGON', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('112059130014', 'SECTION-4733', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'DARAGA HIGH SCHOOL', NULL, 'DARAGA', 'PUBLIC', 'SF9, SF10, PSA, LCR'),
('112345434567', 'SECTION-4366', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'RAWIS HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('113468765456', 'SECTION-6899', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'OROSITE HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('113567898767', 'SECTION-7330', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'MALLIPOT HIGH SCHOOL', NULL, 'TABACO CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114456543456', 'SECTION-6899', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'OROSITE HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114456765456', 'SECTION-7330', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'GOGON HIGH SCHOOL', NULL, 'GOGON', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114456787654', 'SECTION-4366', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'GOGON HIGH SCHOOL', NULL, 'GOGON', 'PUBLIC', 'SF9, SF10, PSA'),
('114466765434', 'SECTION-1636', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'PADANG HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114467876789', 'SECTION-3408', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'OROSITE HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114467898767', 'SECTION-3408', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'STO DOMINGO HIGH SCHOOL', NULL, 'STO DOMINGO', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114468120036', 'SECTION-6218', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'CAPANTAWAN HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF10, PSA'),
('114476120059', 'SECTION-4733', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'CARMONA HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114477110014', 'SECTION-6218', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'PADANG HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF10, PSA'),
('114478130059', 'SECTION-2633', '1st Semester', '2024-2025', '2025-02-22', 'Enrolled', 'BACACAY HIGH SCHOOL', NULL, 'BACACAY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114478987656', 'SECTION-6899', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'RAWIS', NULL, 'LEGAZPI CITY', 'PRIVATE', 'SF9, SF10, PSA, LCR, GMCC'),
('114479140076', 'SECTION-1393', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'ORO SITE HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF10, LCR'),
('114480130031', 'SECTION-4651', '1st Semester', '2024-2025', '2025-02-22', 'Enrolled', 'ARIMBAY HIGH SCHOOL', NULL, 'ARIMBAY LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114485130065', 'SECTION-4733', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114485140062', 'SECTION-2633', '1st Semester', '2024-2025', '2025-02-22', 'Enrolled', 'BONGA NATIONAL HIGH SCHOOL', NULL, 'TABACO CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114485140095', 'SECTION-2633', '1st Semester', '2024-2025', '2025-02-22', 'Enrolled', 'ORO SITE HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114487130123', 'SECTION-1393', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'PAWA HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'PSA, LCR'),
('114488130003', 'SECTION-0626', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'ARIMBAY HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114488130054', 'SECTION-0626', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'ARIMBAY HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114490100021', 'SECTION-4651', '1st Semester', '2024-2025', '2025-02-22', 'Enrolled', 'RAWIS NATIONAL HIGH SCHOOL', NULL, 'RAWIS LEGASPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114490130160', 'SECTION-1393', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'GOGON HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114492130014', 'SECTION-4651', '1st Semester', '2024-2025', '2025-02-22', 'Enrolled', 'RAWIS NATIONAL HIGH SCHOOL', NULL, 'PADANG LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('114495130122', 'SECTION-4733', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('117754323456', 'SECTION-1636', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'CARMONA HIGH SCHOOL', NULL, 'CARMONA', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('123874758882', 'SECTION-7330', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'DARAGA ALABY', NULL, 'DARAGA', 'PRIVATE', 'SF9, SF10, PSA, LCR, GMCC'),
('128654345676', 'SECTION-3408', '1st Semester', '2024-2025', '2025-02-23', 'Pending', 'ARIMBAY HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF10, PSA, LCR'),
('145676543234', 'SECTION-4366', '1st Semester', '2024-2025', '2025-02-23', 'Enrolled', 'ARIMBAY HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC'),
('176545678765', 'SECTION-6899', '1st Semester', '2024-2025', '2025-03-06', 'Enrolled', 'CABANGAN HIGH SCHOOL', NULL, 'LEGAZPI CITY', 'PUBLIC', 'SF9, SF10, PSA, LCR, GMCC');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT '1: Multi, 2: Enumeration, 3: Essay, 4: True or False',
  `exam_quarter` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_duration` int NOT NULL,
  `exam_title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_items` tinyint NOT NULL,
  `exam_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `sched_id`, `exam_type`, `exam_quarter`, `exam_duration`, `exam_title`, `exam_items`, `exam_date`) VALUES
('EXM-0826', 'SCHED-6388', '1,1,1,1,1,1,1,1,1,1', '1st Quarter', 30, 'Tech Voc 6 Diagnose Computer  EXAMINATION', 10, '2025-02-27'),
('EXM-1285', 'SCHED-1913', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,', '1st Quarter', 60, 'Understanding Culture, Society, And Politics EXAMI', 30, '2025-02-27'),
('EXM-1843', 'SCHED-7588', '4,4,4,4,4,4,4,4,4,4,4,4,4,4,4', '1st Quarter', 40, 'BUSINESS MATHEMATICS', 15, '2025-03-14'),
('EXM-3680', 'SCHED-1955', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1st Quarter', 60, 'KUMUNIKASYON AT PANANALIKSIK', 20, '2025-03-07'),
('EXM-4999', 'SCHED-0936', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1st Quarter', 60, 'Empowerment Technology Examination', 20, '2025-03-14'),
('EXM-5515', 'SCHED-1860', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1st Quarter', 60, 'Earth and Life Science', 20, '2025-03-14'),
('EXM-7280', 'SCHED-9121', '4,4,4,4,4,1,1,1,1,1,1,1,1,1,1,3,3,3,2,2', '1st Quarter', 60, 'Disaster And Risk Reduction', 24, '2025-03-21'),
('EXM-7311', 'SCHED-8801', '4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4', '1st Quarter', 40, 'INRODUCTION TO PHIL HISTORY', 20, '2025-03-12'),
('EXM-8097', 'SCHED-0027', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1st Quarter', 60, 'Oral Communication Examination', 20, '2025-03-14'),
('EXM-9076', 'SCHED-2822', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1st Quarter', 60, 'General Chemistry Examination', 19, '2025-03-10'),
('EXM-9946', 'SCHED-1042', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1st Quarter', 60, 'PRACTICAL RESEARCH 2', 20, '2025-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `exam_enumeration`
--

CREATE TABLE `exam_enumeration` (
  `enum_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `enum_question` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enum_answer` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_enumeration`
--

INSERT INTO `exam_enumeration` (`enum_id`, `exam_id`, `enum_question`, `enum_answer`) VALUES
(1, 'EXM-7280', 'What are the two main measurable components of a hazard?', 'magnitude or intensity, likelihood or probability of occurrence '),
(2, 'EXM-7280', 'What technical features of a hazard must be reviewed in conducting a risk assessment process?  ', 'location, intensity, frequency, probability');

-- --------------------------------------------------------

--
-- Table structure for table `exam_essay`
--

CREATE TABLE `exam_essay` (
  `essay_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `essay_question` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_multiple`
--

CREATE TABLE `exam_multiple` (
  `mul_id` int NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `mul_question` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_a` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_b` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_c` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `choice_d` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_correct` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_multiple`
--

INSERT INTO `exam_multiple` (`mul_id`, `exam_id`, `mul_question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `is_correct`) VALUES
(1, 'EXM-1285', 'It is a hereditary endogamous social group in which a person\'s rank and his /her rights and obligation are ascribed or an the basis of his/her birth into a particular group.', 'Caste', 'Class', 'Estate', 'Slavery', 'Caste'),
(2, 'EXM-1285', 'It is the system by which in state or community is controlled as to put order.', 'Political', 'Constituents', 'Government ', 'System', 'Government '),
(3, 'EXM-1285', '______________ is the holistic \"science of man\" a science of a totality of human existence.', 'Anthropology', 'Sociology', 'Archaelogy', 'Etymology', 'Anthropology'),
(4, 'EXM-1285', '__________________ is the study of relationships among people.', 'Anthropology', 'Sociology', 'Archaeology', 'Etymology', 'Sociology'),
(5, 'EXM-1285', 'It deals with the systems of government and the analysis of political activity and political behavior.', 'Public Policy', 'Political Theory', 'International Relation', 'Political Science', 'Political Science'),
(6, 'EXM-1285', '______________ are conceptions or ideas people have about what is true in the government around them like what is life, how to value it, and how once belief on the value of life relate with his or her', 'Beliefs', 'Values', 'Language', 'Norms', 'Beliefs'),
(7, 'EXM-1285', '_____________ describe what is appropriate or inappropriate in a given society or what ought be.', 'Beliefs ', 'Values', 'Langauges', 'Norms', 'Values'),
(8, 'EXM-1285', 'It is a shared set of spoken and written sysmbols.', 'Beliefs', 'Values', 'Language', 'Norms', 'Language'),
(9, 'EXM-1285', '____________ are specific rules/standards to guide appropriate behavior.', 'Beliefs', 'Values', 'Langauge', 'Norms', 'Norms'),
(10, 'EXM-1285', 'Also known as customs, these are norms for everyday behavior that people follow for the sake of tradition and convenience.', 'Mores', 'Folkways', 'Taboos', 'Law', 'Folkways'),
(11, 'EXM-1285', 'A person or practitioner who studies Anthropology', 'Sociologist', 'Pyschologist', 'Anthropologist', 'Archaeologist', 'Anthropologist'),
(12, 'EXM-1285', 'An organized political community living under a single system of government.', 'State', 'Society', 'Government', 'Culture', 'State'),
(13, 'EXM-1285', 'A group of people involved in persistent , interpersonal relationships or a large social grouping sharing the same geographical or social territory typically subject to the same political authority an', 'State', 'Society', 'Government', 'Culture', 'Society'),
(14, 'EXM-1285', 'It refers to a system by which a society ranks categories of people in a hierarchy.', 'Social Stratification', 'Social Science', 'Social Change ', 'Social Climber', 'Social Stratification'),
(15, 'EXM-1285', 'It refers to an alteration in the social order of society.', 'Social Stratification', 'Social Science', 'Social Change', 'Social Climber', 'Social Change'),
(16, 'EXM-1285', 'The study of previous cultures of humans by analyzing various artifacts and fossils.', 'Archaeology', 'Paleontology', 'Paleozoology', 'Geology', 'Archaeology'),
(17, 'EXM-1285', 'It is something that is not present in natures but it formed through a process done by man.', 'Artifacts', 'Civilization', 'Democracy', 'Neolitic', 'Artifacts'),
(18, 'EXM-1285', 'It is a process wherein there are notable changes made to the culture of a society over several generations.', 'Neolithic Revolution', 'Industrial Society', 'Cultural Evolution', 'Biological Evolution', 'Cultural Evolution'),
(19, 'EXM-1285', 'A term is used to refer to the impact and development of farming to the lives of people.', 'Neolithic Revolution', 'Industrial society', 'Cultural Evolution', 'Biological Evolution', 'Neolithic Revolution'),
(20, 'EXM-1285', 'A species of hominid, They are  the modern humans.', 'Homo habilis', 'Homo sapiens sapiens', 'Homo sapiens', 'Homo erectus', 'Homo sapiens'),
(21, 'EXM-1285', 'It is the acceptance of cultural goals and means of attaining those goals.', 'Gossip', 'Enculturation', 'Deviance', 'Conformity', 'Conformity'),
(22, 'EXM-1285', 'The fact or state of diverging from usual or accepted standards. especially in social and sexual behavior.', 'Gossip', 'Enculturation', 'Deviance', 'Conformity', 'Deviance'),
(23, 'EXM-1285', 'It involves the rejection of both the cultural goals and the traditional means of achieving those goals.', 'Retreatism', 'Ritualism', 'Ostracism', 'Idealism', 'Ritualism'),
(24, 'EXM-1285', 'Being ignored by others  who are in one\'s presence.', 'Social Control', 'Social ostracism', 'Social Stratification', 'Social Change', 'Social ostracism'),
(25, 'EXM-1285', 'The importance, worth or usefulness of something.', 'Values', 'Status', 'Self', 'Role', 'Values'),
(26, 'EXM-1285', 'These are groups of people that has distributive task for a collective goal.', 'Groups ', 'Organizations', 'Society', 'Class', 'Organizations'),
(27, 'EXM-1285', 'These are large clusters of people who have a mutually shared purpose, often aiming to complete tasks', 'Out-Group ', 'Primary', 'Reference Group', 'Secondary Group', 'Secondary Group'),
(28, 'EXM-1285', 'These are used in order to guide our behavior and attitudes and help us to identify social norms.', 'Out-Group', 'Primary Group', 'Reference Group', 'Secondary Group', 'Reference Group'),
(29, 'EXM-1285', 'It is where a social group with which on individual does not identify to be a part of.', 'Out-Group', 'Primary Group', 'Referance Group', 'Secondary Group', 'Out-Group'),
(30, 'EXM-1285', 'It is a small social group whose members share personal and lasting relationships', 'Out-Group', 'Primary Group', 'Reference Group', 'Secondary Group', 'Primary Group'),
(31, 'EXM-0826', 'Which application would be the best choice if you wanted to manipulate a photograph?', 'Image editor', 'Word processor', 'Speadsheet', 'Web browser', 'Image editor'),
(32, 'EXM-0826', 'Which of the following statements best describes the nature of pages found by using a search with the inclusion operator? mountain+gorilla', 'Every page with keyword \"gorilla\" will be located.', 'Any page with a reference to either keyword \"mountain\" or keyword \"gorilla\" will be located.', 'Every page with keyword \"mountain\" will be located.', 'A page must referrence both keywords \"mountain\"and \"gorilla\"to be located.', 'A page must referrence both keywords \"mountain\"and'),
(33, 'EXM-0826', 'What are the four basic operations of the information processing cycle?', 'input, processing, output, storage', 'processing, communication, storage, data, creation', 'input, output, storage, communication', 'input, printing, storage, retrieval', 'input, processing, output, storage'),
(34, 'EXM-0826', 'Which of the following transmission media has the highest transfer rate?', 'Coaxial cable', 'Twisted pair', 'Fiber-optic cable', 'none of the above', 'Fiber-optic cable'),
(35, 'EXM-0826', 'An operating system that requires you to quit one programbefore starting a different program is referred to as a __________________ operating system', 'foreground', 'multitasking', 'single-tasking', 'background', 'single-tasking'),
(36, 'EXM-0826', 'The search utility program in Microsoft Windows helps you to locate a fie by which of the following methods?', 'Grouping the files by file and then manually scrolling through the list until you locate the one you need', 'Manually scrolling through the list of filenames until you locate the one you need', 'Specifying the name of the file and letting the software locate the file for you.', 'Arranging the files by date so you can locate the file by the date you think you created it.', 'Specifying the name of the file and letting the so'),
(37, 'EXM-0826', 'Which type of the Internet connection provides the slowest access speed?', 'DSI', 'Satelite', 'Dial-up', 'Cable', 'Dial-up'),
(38, 'EXM-0826', 'When an entire job category is made obsolete by advances in technology, this is called:', 'technological replacement', 'robotics', 'structural unemployment', 'automation', 'structural unemployment'),
(39, 'EXM-0826', 'Which Web search operators should be  used to find pages related to iguana lizards that are not in classifieds adds?', 'lizard+iguana+classified', 'iguana lizard classified', 'lizard-iguana-classified', 'lizard+iguana-classifed', 'lizard+iguana-classifed'),
(40, 'EXM-0826', 'What do you purchase when you buy a software program?', 'a box and a distributions medium, such as a CD-ROM', 'the right to use the software in accordance with publisher\'s software license', 'the unlimited rights to the program and its source code', 'a warranty that guarantees the software will do what you want it to do.', 'the right to use the software in accordance with p'),
(41, 'EXM-9076', 'Jane forgot her water bottle in the freezer and when she took it out, the water already hardens and turned to ice. Considering the kinetic molecular model, what should Jane do to turn her water back i', 'shake the bottle vigorously', 'put the bottle back in the freezer', 'put the bottle back but not in the freezer but in the refrigerator', 'place the bottle in an area with higher temperature than the refrigerator', 'shake the bottle vigorously'),
(42, 'EXM-9076', 'Which of the following statement best describes about intermolecular forces?', 'weak forces', 'influence the boiling and melting point', 'attraction between two polar molecules', 'forces that hold solids and liquid together', 'attraction between two polar molecules'),
(43, 'EXM-9076', 'What property of liquid that measure the fluid\'s resistance to flow?', 'Viscosity', 'Boiling Point', 'Vapor Pressure', 'Surface Tension', 'Viscosity'),
(44, 'EXM-9076', 'Which of the following refers to the pressure at which equilibrium occurs between the gaseous phase and the liquid phase of water molecules, in a closed container?', 'Vapor Pressure', 'Capillary Action', 'Surface Tension', 'Molar Heat of Vaporization', 'Vapor Pressure'),
(45, 'EXM-9076', 'What is Shapeless mean?', 'Amorphous', 'Anisotropic', 'Crystalline', 'Molecule', 'Amorphous'),
(46, 'EXM-9076', 'What will be the melting point of a point of a substance when the temperature of heat is being added and the substance is changing from a solid to a liquid?', 'Increases', 'Decreases', 'Cease to exist', 'Remains constant', 'Increases'),
(47, 'EXM-9076', 'A solution is prepared by mixing 20g of sodium chloride in 80g of water. What are the concentrations of the solute and the solvent in % by mass?', 'Solute: 80%, Solvent:20%', 'Solute: 20%, Solvent:80%', 'Solute: 90%, Solvent: 10%', 'Solute: 10%, Solvent:90%', 'Solute: 20%, Solvent:80%'),
(48, 'EXM-9076', 'What is the maximum number of moles of AlC13 that can be produced from 5.0 moles of aluminum and 6.0 moles of chlorine gas? 2Al(s) + 3Cl2(g)→ 2AIC13(s)', '2.0 mol', '4.0 mol', '5.0 mol', '6.0 mol', '5.0 mol'),
(49, 'EXM-9076', 'Supposed you have the number of moles of a reactant or product in a reaction and you want to calculate for the mass of another product or reactant, what process will you going to follow?', 'Mass to mole', 'Mole to mole', 'Mass to mass', 'Mole to mass', 'Mole to mass'),
(50, 'EXM-9076', 'Which of the following statement explained what changes and what stays the same when 1.00 L of a solution of NaCl is diluted to 1.80 L?', 'The number of moles changes abruptly.', 'The number of moles constitutes the whole solution.', 'The number of moles varies when diluted in a solution.', 'The number of moles always stays the same in a dilution.', 'The number of moles constitutes the whole solution'),
(51, 'EXM-9076', 'What is an osmotic pressure?', 'The process applied in the purification of water.', 'This is the pressure needed to prevent osmosis', 'It is the minimum pressure that should be applied to a certain solution.', 'The pressure applied to the less concentrated solution for the solvent to flow.', 'The process applied in the purification of water.'),
(52, 'EXM-9076', 'Solve the freezing point of the solution formed?', '0.142 OC', '0.152 OC', '-0.142 OC', '-0.152 0C', '-0.152 0C'),
(53, 'EXM-9076', 'Calculate the molality of a solution prepared from 29.22 grams of NaCl in 2.00kg of water.', '. 0.25 mol', '0.50 mol', '0.75 mol', '1.00 mol', '. 0.25 mol'),
(54, 'EXM-9076', 'A laboratory experiment where a solution of known concentration is reacted with a solution of unknown concentration to determine its molarity.', 'Neutralization', 'Recombination', 'Standardization', 'Titration', 'Titration'),
(55, 'EXM-9076', 'Given the hypothetical thermochemical equation: A+B+C+D AH = - 430 kJ. Which among the following statements is correct about this reaction?', 'The reaction is endothermic.', 'The equation may be written as A+B+430 kJC+D', 'The heat content of A and B is greater than the heat content of C and D', 'The heat content of C and D is greater than the heat content of A and B.', 'The reaction is endothermic.'),
(56, 'EXM-9076', 'The thermochemical equation showing the formation of ammonia, NH3 from its elements is: N2 (g) + 3H2(g)→2NH3 (g) AH--92kJ.  The equation shows that 92 kJ of heat is', 'lost to the surrounding when one mole of hydrogen is used up in the reaction.', '. absorbed from the surrounding when one mole of nitrogen reacts.', 'absorbed from the surrounding when one mole of ammonia is formed.', 'lost to the surrounding when 2 moles of ammonia is formed.', 'absorbed from the surrounding when one mole of amm'),
(57, 'EXM-9076', 'As the temperature of a reaction is increased, the rate of the reaction increases because the______________.', 'activation energy is lowered', 'reactant molecules collide less frequently', 'reactant molecules collide less frequently and with greater energy per collision', 'reactant molecules collide more frequently and with greater energy per Collision', 'reactant molecules collide less frequently and wit'),
(58, 'EXM-9076', 'Using the following data, which is the correct rate law of the sample reaction?', 'R=k[A][B][C]', 'R-k[A]+[B][C]', 'R-k[A][B][C]', 'R-k[A][B][C]', 'R-k[A]+[B][C]'),
(59, 'EXM-9076', 'If the activation energy in the forward direction of an elementary step is 52 kJ and the activation energy in the reverse direction is 74 kJ, what is the energy of reaction AE for this step?', '52 kJ', '22 kJ', '-22 kJ', '-52 kJ', '-22 kJ'),
(60, 'EXM-9946', 'Which of the following BEST describes quantitative research?', 'It is an activity of producing and proving a theorem', 'It is an activity concerned with finding new truths in education', 'It is an exploration associated with libraries, books, and journals', 'It is a systematic process for obtaining numerical information about the world.', 'It is a systematic process for obtaining numerical'),
(61, 'EXM-9946', 'Which of the following refers to the framework of research?', 'Quantitative Research', 'Quanlitative Research', 'Research Design', 'Variable', 'Research Design'),
(62, 'EXM-9946', 'Quantitative research exhibits certain characteristics that distinguished if from qualitative. What particular characteristics pertains to the data gathered are in form of numbers and statistics that ', 'Numerical', 'Objective', 'Replicable', 'Sample size', 'Numerical'),
(63, 'EXM-9946', 'Which of the following research designs is used in observing, documenting, and describing a phenomenon occurring in a natural setting without any manipulation or control?', 'Correlational', 'Descriptive', 'Developmental', 'Epidemiological', 'Developmental'),
(64, 'EXM-9946', 'Which of the following research design allows the researcher to examine the phenomenon with reference to time?', 'Correlational', 'Descriptive', 'Development', 'Epidemiological', 'Development'),
(65, 'EXM-9946', 'The use of quantitative research both has strengths and weakness, what makes thid research weak in terms of requiring a large number of respondents?', 'Much information is difficult to gather.', 'It will prodive more accurate findings', 'the expenses will be greater in reaching out to these people.', 'It does not consider the capacity of repondents to share  and claborate', 'It does not consider the capacity of repondents to'),
(66, 'EXM-9946', 'What kind of research is applicable to the sample study on the \"Comparison of Personal, Social, and Academic Variables Related to University Drop-out Rate and Persistence', 'Causal-comparative', 'Correctional', 'Descriptive', 'Experimental', 'Causal-comparative'),
(67, 'EXM-9946', 'The following are the strengths of quantitative research EXCEPT ', 'Quantitative Research allows you to reach a higher sample size', 'Quantitative Research uses randomized samples in collecting information', 'You can collect more information quickly when using quantitative research', 'Quantitative research requires a large sample which makes it difficult to gather data.', 'Quantitative research requires a large sample whic'),
(68, 'EXM-9946', 'Which of the following is NOT a weakness of Quantitative Research ', 'This method does not consider the meaning behind the social phenomenon.   ', 'There is no access to specific feedback in quantitative research. ', 'Quantitative research studies can be very expensive,  ', 'All of these', 'All of these'),
(69, 'EXM-9946', 'Which of the following is NOT TRUE about quantitative research?', 'Quantitative research directs you to focus on things through statistics', 'Quantitative research makes use of numerals in the interpretation of results.', 'The objective of quantitative research is to employ theories to test a phenomenon.', 'None of these', 'None of these'),
(70, 'EXM-9946', 'Which is NOT a characteristic of quantitative research?', 'Obiective observation ', 'Subjective observation', 'Clearly Defined Questions  ', 'Structured Research Instrument', 'Subjective observation'),
(71, 'EXM-9946', 'Which of the following explains why quantitative research is important?', '. It can influence crucial decisions affecting different organizations and individuals.', 'Problems are addressed systematically and decisions are assured to be sound', 'Used to validate, test, and challenge existing practices across fields.  ', 'All of the above.', 'All of the above.'),
(72, 'EXM-9946', 'If you desire to understand what it\'s like to live as a student vlogger, do you think a quantitative approach can be useful in doing this research?', 'Yes, because quantitative research focuses on facts or a series of information.', 'Yes, because quantitative research uses surveys and interviews to provide immediate answers that become useful from a data-centered approach, that is, it requires a large sample size.', 'No, because quantitative research studies can be very expensive.', 'No, because quantitative research does not consider the meaning behind the social phenomenon.', 'No, because quantitative research does not conside'),
(73, 'EXM-9946', 'There are generally two types of quantitative research, experimental and non-experimental. The following are examples of experimental research, EXCEPT', 'Correlational ', 'Descriptive  ', 'Epidemiological  ', 'Exploratory', 'Exploratory'),
(74, 'EXM-9946', 'Which of the following is not considered a descriptive research design?', ' Cohort', ' Comparative ', 'Exploratory  ', 'Univarient', ' Cohort'),
(75, 'EXM-9946', 'What research design would best suit studying the number of cases of senior citizens who suffered from COVID-19?', 'Correlational  ', 'Descriptive  ', 'Epidemiological ', 'Exploratory', 'Epidemiological '),
(76, 'EXM-9946', 'The design lets the researcher connect the present to the future and starts with the cause and arrives at the presumed effects is', 'Prospective Research Design  ', 'Cross-sectional design ', 'Retrospective Research Design. ', 'Cohort Design', 'Prospective Research Design  '),
(77, 'EXM-9946', 'A design where the researcher studies the current situation by seeking facts and figures from the past is', 'Prospective Research Design', 'Cross-sectional design', 'Retrospective Research Design', 'Cohort Design', 'Retrospective Research Design'),
(78, 'EXM-9946', 'In what specific field of study will the following research title be? TITLE: Managing Music Across Multiple Devices and Computers', ' Arts ', ' Science   ', 'Social Inquiry  ', 'Agriculture and Fisheries', ' Arts '),
(79, 'EXM-9946', 'In what field of study will research help when it was used to produce innovative teaching strategies?', ' Education  ', 'Humanities and Social Sciences (HUMSS)  ', 'Accounting, Business, and Management (ABM)  ', 'Science, Technology, Engineering, and Mathematics (STEM)', ' Education  '),
(80, 'EXM-8097', 'Which of the following elements of communication refers to the information or ideas conveyed by the speaker?', ' receiver', 'channel', 'context ', 'message', 'message'),
(81, 'EXM-8097', 'Which model depicts communication as liner?', 'Transaction Model', 'Inventive Model ', 'Shannon-Weaver Model', 'Schramm Model', 'Shannon-Weaver Model'),
(82, 'EXM-8097', 'Which function of communication is served when people\'s feelings are being invoked?', 'Information Dissemination  ', 'Control', 'Social Interaction', 'Emotional Expression ', 'Emotional Expression '),
(83, 'EXM-8097', 'Which barrier is characterized by a set of vocabulary in certain field?', 'International profession', 'Jargon', 'Emotional barrier', 'Specialized field of expertise ', 'Jargon'),
(84, 'EXM-8097', 'Which of the following refer to the use of simply yet precise and powerful words? ', 'vividness', 'clarity', 'brevity', 'apporpriateness', 'brevity'),
(85, 'EXM-8097', 'Which of the following statements shows positive regard to cultural differences?', 'I share relevant information about my culture, and make sure it is more than what others share about theirs. ', 'I do not think that my own culture is better than other.', 'I communicate for other to understand and appreciate my own culture ', 'i do not exert effort in learning about other\'s cultures.', 'I do not think that my own culture is better than '),
(86, 'EXM-8097', 'Which of the following best defines intercultural communication?', 'It happens when individuals negotiate, interact and create meaning while bringing in their varied cultural backgrounds.', 'It is a competition among people set to make their cultures known', 'It is an organized procedure where everyone speaks of his/her culture.  ', 'It happens when a specific culture is regarded as the best among the rest.', 'It happens when individuals negotiate, interact an'),
(87, 'EXM-8097', 'Which DMIS stage is shown in the statement, \"People of different cultures are not really unique. They are categorically the same.', 'acceptance ', 'defense   ', 'denial  ', 'minimization', 'minimization'),
(88, 'EXM-8097', 'Which of the following cannot be considered a characteristic of a competent intercultural communicator?', 'inclusive', ' polite  ', 'open-minded. ', 'idealistic', 'idealistic'),
(89, 'EXM-8097', 'Which of the following statements best shows INTEGRATION as a DMIS stage?', ' \"I hear you and I want to see how I can benefit from what you said.\"', '\"I can see nothing new in what we all presented.\"', '\"I don\'t think your suggestions will work. They don\'t serve any of our interests here.\"', ' \"Maybe I can make necessary adjustments in order to meet our objectives.\"', ' \"I hear you and I want to see how I can benefit f'),
(90, 'EXM-8097', ' In which speech style are jargon, lingo, and street slang usually used?', 'Intimate   ', 'formal  ', 'casual   ', 'covert', 'casual   '),
(91, 'EXM-8097', 'An indirect speech act occurs when...', 'there is no direct connection between the form of the utterance and the intended meaning.', 'there is a direct connection between the form of the utterance and the intended meaning.', 'there is no direct connection between the intention and the intended meaning.', 'there is a direct connection between the intention and the intended meaning.', 'there is no direct connection between the form of '),
(92, 'EXM-8097', 'This refers to the ability of a speaker to use linguistic knowledge to effectively communicate with others.', ' Interpersonal communication strategy', 'Communicative competence', 'Social interaction  ', 'Communicative ', 'Communicative competence'),
(93, 'EXM-8097', 'Which of the following statements show a commissive speech act?', '\"I want to cat some cake.\"', '\"She went out!\"', '\'I\'ll be here tomorow at 6pm\"', '\" I\'m sorry i was so angry at you yesterday.\"', '\'I\'ll be here tomorow at 6pm\"'),
(94, 'EXM-8097', 'Which of the following is NOT a speech context?', 'Intrapersonal communication.', 'Dyad Communication ', 'Long distance communication', 'Mass Communication', 'Long distance communication'),
(95, 'EXM-8097', 'Restriction in communication refers to any ___________ you may have as a speaker.', 'limitation', 'ideas', 'noises ', 'internal conflict', 'limitation'),
(96, 'EXM-8097', 'Which of the following is an example of a frozen speech style?', 'Panatang Makabayan  ', 'The President\'s SONA  ', 'A commencement speech  ', 'Opening remarks', 'Panatang Makabayan  '),
(97, 'EXM-8097', 'Who proposed the classification of illocutionary acts?', 'John Austin  ', ' John Searle', 'John Cena  ', 'Martin Joos', ' John Searle'),
(98, 'EXM-8097', 'Which statement reflects termination?', '\"Well then, I think we\'re good. See you!\" ', '\"I didn\'t know about that.\"', '\"So, have you heard about the forest fire in Davao?\"  ', '\"You\'re hired!\"', '\"Well then, I think we\'re good. See you!\" '),
(99, 'EXM-8097', 'An intrapersonal communication involves....', ' One speaker  ', 'Two speakers  ', 'A small group  ', 'A speaker and an audience', ' One speaker  '),
(100, 'EXM-5515', 'Which of the following is NOT a characteristic of Earth?', 'It is the third planet from the sun.', 'It is the only known planet that can support life.', 'It has blue waters, rocky and green land masses.', 'It has abundant carbon dioxide in the atmosphere.', 'It has abundant carbon dioxide in the atmosphere.'),
(101, 'EXM-5515', 'Which of the following is NOT a correct analogy about the Earth Systems?', 'Atmosphere; air', 'Lithosphere: land ', 'Biosphere:  human', 'Hydrosphere: water', 'Biosphere:  human'),
(102, 'EXM-5515', 'which layer produces the Earth\'s magnetic field?', 'Inner core', 'outer core', 'Mantle', 'Crust', 'outer core'),
(103, 'EXM-5515', 'A sample of mineral is being studied in the laboratory. Which of its property is readily manifested by sheer observation?', 'Color ', 'Hardness', 'Luster', 'Streak', 'Color '),
(104, 'EXM-5515', 'A certain mine is white in color After it is bombarded with ultraviolet light, its color changes into light red. What property of mineral is exemplified in the scenario? ', 'Color ', 'Fluorescence', 'Luster', 'Streak', 'Luster'),
(105, 'EXM-5515', 'The three groups of rock namely igneous, sedimentary, and metamorphic are classified by which of the following basis?', 'Color ', 'Grain size', 'Chemical Composition ', 'Texture and Composition ', 'Texture and Composition '),
(106, 'EXM-5515', 'Which layer of the Earth separates crust from core?  ', 'Magma layer ', 'Lithosphere', 'Mantle ', 'Continent', 'Mantle '),
(107, 'EXM-5515', 'What earth subsystem consists the parts of the planet in which all life exists?', 'Atmosphere ', 'Lithosphere', 'Hydrosphere', 'Biosphere', 'Biosphere'),
(108, 'EXM-5515', 'Which of the following describes the stabilizing effect of Earth\'s moon?', 'Prevents the poles from shifting unexpectedly.', 'Helps divert and vacuum up incoming debris and keep earth safe.', 'Enables the carbon-silicate cycle regulating temperature.', 'All of these', 'Prevents the poles from shifting unexpectedly.'),
(109, 'EXM-5515', 'Which of the following is a physical property of a mineral?', 'Specific gravity', 'Solubility in acid ', 'Taste ', 'Odor', 'Specific gravity'),
(110, 'EXM-5515', 'what are the three most abundant elements in the Earth\'s crust?', 'Silicon, Oxygen and Sodium', 'Silicon, Oxygen and Calcium ', 'Silicon, Oxygen and Iron', 'Silicon, Oxygen and Aluminum', 'Silicon, Oxygen and Aluminum'),
(111, 'EXM-5515', 'Which type of rock is Formed when heat and pressure are applied below the earth\'s surface?', 'Volcanic rocks ', 'Sedimentary rocks', 'Igneous rocks ', 'Metamorphic rocks', 'Metamorphic rocks'),
(112, 'EXM-5515', 'Earth\'s atmosphere is important to living things because _______________.', 'It contains dust', 'Its is very thin compared to earths size.', 'Provides all the gasses to support life ', 'Maintains a constant humidity ', 'Provides all the gasses to support life '),
(113, 'EXM-5515', 'Earth\'s atmosphere traps energy from sun, which _____________.', 'Allows water to exist as a liquid', 'allows solar radiation to penetrate to the surface ', 'allows ozone to form freely ', 'causes meteors to burn up', 'Allows water to exist as a liquid'),
(114, 'EXM-5515', 'What are the two most abundant gasses in the atmosphere?', 'Carbon dioxide and Oxygen ', 'Carbon dioxide and Nitrogen', 'Nitrogen and Oxygen ', 'Nitrogen and Argon', 'Nitrogen and Oxygen '),
(115, 'EXM-5515', 'What drive the earth\'s internal heat engine?', 'Radioactivity ', 'Solar Energy ', 'Volcanoes', 'Ocean tides ', 'Radioactivity '),
(116, 'EXM-5515', 'In what type of rock do most fossils appear?', 'Volcanic rocks ', 'Igneous rocks ', 'Metamorphic rocks ', 'Sedimentary rocks ', 'Sedimentary rocks '),
(117, 'EXM-5515', 'which of the following belongs to Terrestrial Planet?', 'Jupiter and Saturn ', 'Venus and Earth ', 'Earth and Saturn ', 'Earth only', 'Venus and Earth '),
(118, 'EXM-5515', 'What happens to the temperature when you move up to the thermosphere?', 'Decreases', 'Increases', 'Remains the same ', 'Fluctuating ', 'Increases'),
(119, 'EXM-5515', 'What constant process makes the water moves between Earth and its atmosphere?', 'Water Cycle ', 'Tornado', 'Weather ', 'Cryosphere ', 'Water Cycle '),
(120, 'EXM-7280', 'A serious disruption of the functioning community or a widespread human, material, economic, or environmental losses. ', 'vulnerability', 'disaster risk', 'disaster ', 'hazard ', 'disaster '),
(121, 'EXM-7280', 'It is the chance or likelihood of suffering harm and loss as result of a hazardous event.', 'vulnerability', 'disaster risk', 'disaster ', 'hazard ', 'disaster risk'),
(122, 'EXM-7280', 'its is a set of prevailing or consequential conditions, which adversely affect the community\'s ability to prevent, mitigate, prepare for and respond to hazardous events', 'vulnerability', 'disaster risk', 'disaster ', 'hazard ', 'vulnerability'),
(123, 'EXM-7280', 'It is a situation or occurrence with capacity to bring damages to lives, properties, and the environment.', 'Hazard  ', 'Capacity', 'Element at risk  ', 'Vulnerability', 'Hazard  '),
(124, 'EXM-7280', 'Which can\'t be prevented but can be anticipated generally?', 'Human-made hazards  ', 'Socionatural Hazards', 'Disasters  ', 'Natural Hazards', 'Natural Hazards'),
(125, 'EXM-7280', 'Which is not an Example of capacity', 'adequate income', 'savings', 'local knowledge ', 'isolation', 'isolation'),
(126, 'EXM-7280', 'Which is not a Volcanic hazard?', 'Carbon dioxide ash cloud ', 'Lapili', 'Mudflow', 'Turbulent', 'Mudflow'),
(127, 'EXM-7280', 'which is the possible cause of earthquake?', 'Tsunami', 'Landslide', 'Volcanic Eruption', 'Typhoon', 'Volcanic Eruption'),
(128, 'EXM-7280', 'Components of recovery are:', 'Prevention', 'Transfer and financing', 'Alert ', 'Rehabilitation and reconstruction', 'Rehabilitation and reconstruction'),
(129, 'EXM-7280', 'The Categories of natural hazards are', 'Hydro meteorological', 'Biological', 'Geological', 'All of the Above ', 'All of the Above '),
(150, 'EXM-4999', 'A web page that allows interaction from the user', 'Static ', 'Dynamic', 'Social', 'Comment', 'Dynamic'),
(151, 'EXM-4999', 'This is the operating system for blackberry phones.', 'Blackberry OS', 'Symbian ', 'Windows Mobile', 'iOS', 'Blackberry OS'),
(152, 'EXM-4999', 'Pinterest is a social media website that can be classified as', 'Bookmarking site', 'Media sharing', ' microblogging', 'blogs and forums', 'Bookmarking site'),
(153, 'EXM-4999', 'Currently, this is the fastest mobile network', '2G', '3G', '4G', '5G', '4G'),
(154, 'EXM-4999', 'This media is designed to help people who have visual and reading impairments', ' Assistive', 'Social', ' bookmark', 'accessibility', ' Assistive'),
(155, 'EXM-4999', 'This type of social media website focuses on short updates posted by the user.', 'Blogging ', 'Microblogging', 'social media', 'hash tagging', 'Microblogging'),
(156, 'EXM-4999', 'What is Netiquette?', 'The proper use of manners and etiquette on the Internet.', ' Using a net to catch fish', 'Being mean to other peopleon Facebook.', 'Using proper manners at thedinner table', 'The proper use of manners and etiquette on the Int'),
(157, 'EXM-4999', 'What harmful online program is used to record keystrokes done by users to steal passwords?', 'Adware', 'Spyware', 'Fear of spyware', 'Fear of losing important files', 'Spyware'),
(158, 'EXM-4999', 'It is the most Known and most used search engine.', 'Baidu', 'Yahoo', 'Google', 'Ask.com', 'Google'),
(159, 'EXM-4999', 'These are Software Systems designed to search information on the World Wide Web. ', 'Search', 'Search Tool', 'Search Engine', 'Search Application ', 'Search Tool'),
(160, 'EXM-4999', 'The skill refers to the ability to produce good and continuous searches .', 'Thinking Skill', 'Learning Skill', 'Research Skill', 'Production Skill', 'Production Skill'),
(161, 'EXM-4999', 'This is collectively organizing gathered data and ensuring tracking of specific information.', 'Critical Thinking', 'Data Organizing ', 'Research Presenting ', 'None of the above ', 'Research Presenting '),
(162, 'EXM-4999', 'What is the motion effect or movement that you can apply to a text and objects such as clip art, shapes, and picture?', 'Trasition ', 'Animaton', 'Artistic Effect ', 'Slide Show', 'Animaton'),
(163, 'EXM-4999', 'PowerPoint as best described as.', 'Presentation Software ', 'Database Software ', 'Drawing Software ', 'Desktop publishing software ', 'Presentation Software '),
(164, 'EXM-4999', 'Which of the following statements below describe the function of playback tab?', 'It give false information about your video.', 'The slideshow will end after clicking insert ', 'The slideshow will start after clicking playback', 'It provides option on how the movie will be played and displayed during the slideshow', 'It provides option on how the movie will be played'),
(165, 'EXM-4999', 'To adjust or edit the picture in slide, press right click then select ________.', 'Pictures', 'Change position', 'Format picture', 'Change picture', 'Change picture'),
(166, 'EXM-4999', 'How can you add video?', 'Click insert > choose in video folder > insert', 'Right click > video and choose locate folder then press okay', 'Click insert > video then choose if online view or Video on my PC > choose video folder > okay', 'Click insert > video then choose if online View or Video on my PC> choose video folder > insert', 'Click insert > video then choose if online View or'),
(167, 'EXM-4999', 'Juan wants to link the slide 1 to slide 3, what action will he do? ', 'Right click > hyperlink > place this link', ' Right click > link > place this hyperlink ', 'Right click > link > create new document ', 'Right click > link > place in this document ', 'Right click > link > place in this document '),
(168, 'EXM-4999', 'What specific application allows you to create slide presentation for lecture or topic that motivates and persuade the audience?', 'Outlook ', 'Presentation', 'Spreadsheet ', 'Word', 'Presentation'),
(169, 'EXM-4999', 'Which of the following buttons will you click to insert image?', 'Pictures', 'Videos', 'Audio', 'Online View', 'Pictures'),
(170, 'EXM-3680', 'Bakit mahalagang mahubog ang konsensiya ng tao?', 'Upang makilala nang tao ang katotohan ng kinakailangan niya upang magamit niya nang tama', 'Upang matiyak na hindi na magkakaroon ng pagtatalo sa pagitan ng tam at mali', 'Upang matiyak na palaging ang tamang konsensiya ang gagamitin sa lahat ng pagkakataon', 'Lahat ng nabanggit', 'Lahat ng nabanggit'),
(171, 'EXM-3680', 'Ang konsesnsiya ang batayan ng isip sa paghuhusga ng mabuti o masama. Ngunit ito pa rin aay subhetibo, personal, at agarang g moralidad ng tao. Ano ang itinuturing na pinakamataas na batayan ng kilos?', 'Ang Sampung Utos ng Diyos', 'Likas na batas moral', 'Bataas ng Diyos', 'Batas Positibo', 'Likas na batas moral'),
(172, 'EXM-3680', 'Hndi lamang masamang kitilin ang sariling buhay kundi masama ring kitilin ang buhay ng kaniyang kapuwa. Anong prinsipyo ng likas na batas moral ang batayan nito?', 'Gawin ang mabuti, iwasan ang masama', 'Kasama ng lahat ng may buhay, may kahiligan ang taong pangalagan ang kaniyang buhay', 'Kasama ng mga hayop, likas sa tao ang pagpaparami ng uri at papagaralin ang mga anak', 'Bilang rasyonal na nilalang, may likas na kahilingan ang tao na alamin ang katotohanan at mabuhay sa lipunan', 'Kasama ng lahat ng may buhay, may kahiligan ang taong pangalagan ang kaniyang buhay'),
(173, 'EXM-3680', 'Ano ang pinakamahalagang katangian ng isang mahusay na tagapagsalita?', 'Malakas ang boses', 'Maraming alam sa teknolohiya', 'Marunong makinig at gumalang sa opinyon ng iba', 'Palaging nagsasalita kahit hindi kailangan', 'Marunong makinig at gumalang sa opinyon ng iba'),
(174, 'EXM-3680', 'May kapatid kang nakapag-asawa ng kasapi ng ibang relihiyon. Nugnit nagpapamalas naman ng kabutihan sa inyo. Paano mo siya pakikisamahan?', 'Balewalain na lamang', 'Hindi na lang siya papansinin', 'Sabihin na sumasanib sa iyong relihiyon upang magkasundo kayo', 'Igagalang ang kanyang paniniwala at pakikisamahan na lang siya', 'Igagalang ang kanyang paniniwala at pakikisamahan na lang siya'),
(175, 'EXM-3680', 'Malinaw sa atin ang sinabi ng ating konsensiya: gawin mo ang mabuti, iwasan mo ang msasama. Ngunit hindi ito nagbibigay ng katiyakan na ang mabuti ang papipiliin ng tao. Ano ang sinasabi sa pahayag nato?', 'Sa kahat ng pagakakataon tama ang hatl ng atng konsensiya', 'May mga taong pinili ang masama dahil wla silang konsensiya', 'Maaring magkamali sa paghatol ang konsensiya kaya mahalang mahubog ito upang kumiling sa mabuti', 'Kumiilos ang ating konsensiya tuwing nakagagawa tayo ng maling pagpapasiya', 'Kumiilos ang ating konsensiya tuwing nakagagawa tayo ng maling pagpapasiya'),
(176, 'EXM-3680', 'Minsan, hindi maiiwasan ang mapilitang magsinunganling. Sa sitwasyon na Alam mong dapat sundin. Anong yugto ng konsensiya ang natutukoy sa ganitong sitwasyon?', 'Unang Yugto', 'Pangalawang Yugto', 'Ikatlong Yugto', 'Ikaapat na Yugto', 'Unang Yugto'),
(177, 'EXM-3680', 'Ang responsibilidad ay ang kakayahang tumugon sa tawag ng pangangailangan ayon sa sitwasyon. Ang pahayag ay:', 'Tama, dahil ang tunay na responsableng kalayaan ay ang pagtulong sa kapwa', 'Tama, dahil may kakayahan ang taong magbigay paliwanag sa kilos na ginawa.', 'Mali, dahil ang responsibilidad ay palaging kakambal ng kalayaa na ginagamit ng tao', 'Mali, dahi ang responsibilidad ay ang pagtanggap sa kahhinatnan ng kilos na ginawa', 'Mali, dahil ang responsibilidad ay palaging kakambal ng kalayaa na ginagamit ng tao'),
(178, 'EXM-3680', 'Ang konsensiya ay nangangahulugan ng paglilitis sa sarili. Ang ibig sabihin nito ay:', 'Bahala ang tao sa kakanyang kilos', 'Makakabubuti sa tao na kumilos nang tama', 'Obligasyon ng tao na kumilos nang maayos', 'Pag-aralan, unawain at hatulan ng sariling kilos', 'Pag-aralan, unawain at hatulan ng sariling kilos'),
(179, 'EXM-3680', 'Ang konsensya ay bumubulong na wari sinasabi sa atin. Ito ang mabuti, ang dapat mong gawin. Anong yugto ng konsensiya ang kinapapalooban nito?', 'Alamin at naisin ang mabuti', 'Pagsusuri ng sarili at pagnininlay', 'Paghatol para sa mabuting pasiya at kilos', 'Ang pagkilatis sa partikular na kabutihan sa isang sitwasyon', 'Paghatol para sa mabuting pasiya at kilos'),
(180, 'EXM-3680', 'Ano ang pangunahing layunin ng komunikasyon sa pagpapakatao?', 'Makipagdebate sa ibang taod', 'Magbigay ng tamang impormasyon', 'Makabuo ng mabuting ugnayan at paggalang sa kapwa', 'Maging popular sa social media', 'Makabuo ng mabuting ugnayan at paggalang sa kapwa'),
(181, 'EXM-3680', 'Ano ang mahalagang elemento ng mabisang komunikasyon?', 'Pagtatalo', 'Pakikinig', 'Pagbibigay ng opinyon lamang', 'Pagsasawalang-bahala', 'Pakikinig'),
(182, 'EXM-3680', 'Bakit mahalaga ang non-verbal communication sa pagpapakatao?', 'Dahil mas mabilis ito kaysa sa pagsasalita', 'Ito ay nagdadala ng damdamin at saloobin', 'Para sa pagpapakita ng kasinungalingan', 'Upang iwasan ang pakikipag-usap', 'Ito ay nagdadala ng damdamin at saloobin'),
(183, 'EXM-3680', 'Ano ang dapat isaalang-alang sa paggamit ng social media bilang kasangkapan ng komunikasyon?', 'Pagtatala ng lahat ng personal na impormasyon', 'Pagpapahayag ng galit sa publiko', 'Paggalang sa karapatan ng iba', 'Pagpapakalat ng pekeng balita', 'Paggalang sa karapatan ng iba'),
(184, 'EXM-3680', 'Alin sa mga sumusunod ang nagpapakita ng mabuting komunikasyon sa pagpapakatao?', 'Pagputol sa sinasabi ng kausap', 'Pagsigaw upang mapatunayan ang punto', 'Pakikinig nang may paggalang at pag-unawa', 'Pagbalewala sa opinyon ng iba', 'Pakikinig nang may paggalang at pag-unawa'),
(185, 'EXM-3680', 'Ano ang pangunahing tungkulin ng komunikasyon sa pagkakaunawaan?', 'Makipagtalo upang mapatunayan ang sariling opinyon', 'Magbigay ng impormasyon nang walang pakialam sa nararamdaman ng iba', 'Makapagpahayag ng damdamin nang may respeto', 'Pagpapatawa lamang', 'Makapagpahayag ng damdamin nang may respeto'),
(186, 'EXM-3680', 'Paano mo maipapakita ang responsableng komunikasyon sa social media?', 'Pag-share ng impormasyon nang hindi muna sinusuri', 'Pagpapahayag ng opinyon nang may paggalang', 'Pagmumura sa komento ng iba', 'Pagpapakalat ng tsismis', 'Pagpapahayag ng opinyon nang may paggalang'),
(187, 'EXM-3680', 'Ano ang kahulugan ng empatikong pakikinig?', 'Pakikinig habang nagte-text', 'Pakikinig na may pag-unawa at paggalang sa damdamin ng kausap', 'Pakikinig upang makahanap ng mali sa sinasabi ng iba', 'Pakikinig na may layuning sumagot agad', 'Pakikinig na may pag-unawa at paggalang sa damdamin ng kausap'),
(188, 'EXM-3680', 'Upang higit na mapaunlad ang paghubog ng konsensiya makakabuti na humingi ng paggabay sa sumusunod, maliban sa:', 'Mga magulang at nakakatanda', 'Mga taong nagpapahalaga ng moral', 'Sa mga kaibigan na nagpapahalaga ng sa iyong sarili', 'Sa diyos gamit ang kanyang mga salita at halimbawa', 'Sa mga kaibigan na nagpapahalaga ng sa iyong sarili'),
(189, 'EXM-3680', 'Alin sa mga sumusunod ang halimbawa ng positibong komunikasyon sa isang grupo?', 'Pagsasawalang-kibo sa opinyon ng iba', 'Paggalang sa opinyon ng bawat isa', 'Pagkakaroon ng matinding argumento', 'Pagpapahiya sa kasamahan', 'Paggalang sa opinyon ng bawat isa');

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

--
-- Dumping data for table `exam_tf`
--

INSERT INTO `exam_tf` (`tf_id`, `exam_id`, `tf_question`, `tf_answer`) VALUES
(1, 'EXM-7280', 'Earthquakes, hurricanes, and volcanos can be prevented.', 'true'),
(2, 'EXM-7280', 'The specific value of damage a community is willing to assume is called acceptable risk.', 'true'),
(3, 'EXM-7280', 'The lack of development can make countries less vulnerable and susceptible to risk.', 'false'),
(4, 'EXM-7280', ' In the institutional framework for disaster risk management, stakeholders are only at the national ', 'false'),
(5, 'EXM-7280', 'The severity of the drought does not depend on the degree of moisture deficiency.', 'false'),
(6, 'EXM-7311', 'Ferdinand Magellan was the first European to land in the Philippines in 1521.', 'true'),
(7, 'EXM-7311', 'The Philippines was named after King Philip II of Spain, not Ferdinand.', 'false'),
(8, 'EXM-7311', 'José Rizal was executed on December 30, 1896, not 1898.', 'false'),
(9, 'EXM-7311', 'Spanish colonization lasted for over 300 years, from 1565 to 1898.', 'true'),
(10, 'EXM-7311', ' Miguel López de Legazpi led the first successful Spanish expedition to the Philippines in 1565', 'true'),
(11, 'EXM-7311', 'The Philippine Revolution against Spain started in 1896, not 1898.', 'false'),
(12, 'EXM-7311', 'The Malolos Constitution, adopted in 1899, was the first republican constitution in Asia', 'true'),
(13, 'EXM-7311', 'The Katipunan was formed to oppose Spanish rule, not to support it.', 'false'),
(14, 'EXM-7311', 'Emilio Aguinaldo was the first president of the Philippine Republic.', 'true'),
(15, 'EXM-7311', ' Andres Bonifacio is known as the \"Father of the Philippine Revolution,\" not of independence.', 'false'),
(16, 'EXM-7311', 'The Battle of Manila Bay took place on May 1, 1898, during the Spanish-American War.', 'true'),
(17, 'EXM-7311', 'The Philippines was granted independence by the United States on July 4, 1946.', 'true'),
(18, 'EXM-7311', ' The Bataan Death March occurred in 1942 after the fall of Bataan during World War II.', 'true'),
(19, 'EXM-7311', 'The Treaty of Paris (1898) ceded the Philippines to the United States, not Spain', 'false'),
(20, 'EXM-7311', 'The Hukbalahap was a resistance group that fought against the Japanese during their occupation.', 'true'),
(21, 'EXM-7311', 'Noli Me Tangere was banned by the Spanish authorities for its criticism of Spanish rule.', 'true'),
(22, 'EXM-7311', 'Christianity, specifically Catholicism, was introduced by the Spanish in the 16th century.', 'true'),
(23, 'EXM-7311', 'The Japanese invaded the Philippines in December 1941 during World War II.', 'true'),
(24, 'EXM-7311', 'The Philippine-American War lasted from 1899 to 1902, and the Treaty of Paris (1898) only ended the ', 'false'),
(25, 'EXM-7311', 'The First Philippine Republic was declared on January 23, 1899, in Malolos, Bulacan.', 'true'),
(26, 'EXM-1843', 'The formula for simple interest is  𝐼 = 𝑃 × 𝑟 × 𝑡 I=P×r×t.', 'true'),
(27, 'EXM-1843', 'The revenue should be greater than total costs to make a profit, not just fixed costs. .', 'false'),
(28, 'EXM-1843', ' The break-even point occurs when total revenue equals total costs, not just fixed costs.', 'false'),
(29, 'EXM-1843', 'Depreciation refers to the decrease in the value of an asset over time.', 'false'),
(30, 'EXM-1843', ' The formula for net present value (NPV) is correct and calculates the present value of future cash ', 'true'),
(31, 'EXM-1843', ' In a standard cost system, actual costs are compared to expected or standard costs to calculate var', 'true'),
(32, 'EXM-1843', ' Compound interest involves earning interest on both the principal and the accumulated interest.', 'true'),
(33, 'EXM-1843', ' In the simple interest formula, time is typically expressed in years.', 'true'),
(34, 'EXM-1843', ' Working capital is calculated by subtracting current liabilities from current assets.', 'true'),
(35, 'EXM-1843', ' The total cost formula includes fixed costs and variable costs multiplied by the quantity.', 'true'),
(36, 'EXM-1843', ' Interest rates in financial formulas are generally expressed as decimals.', 'true'),
(37, 'EXM-1843', 'Depreciation for tax purposes can be calculated using different methods, including the straight-line', 'true'),
(38, 'EXM-1843', 'ROI is calculated by dividing net income by the total investment.', 'true'),
(39, 'EXM-1843', 'In  the markup pricing model, the markup is based on the cost price of the product.', 'true'),
(40, 'EXM-1843', 'The price-to-earnings ratio (P/E ratio) is calculated as the market price per share divided by earni', 'true');

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
  `sched_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `principal_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `email`, `address`, `image`, `id`) VALUES
('PR-7572', 'DANTE', '', 'ARINGO', '9392392932', 'MALE', 'aringo@gmail.com', 'BITANO LEGAZPI CITY', 'principal_6759b4aa238385.38662311.jpg', 'USER-4861');

-- --------------------------------------------------------

--
-- Table structure for table `quarterly`
--

CREATE TABLE `quarterly` (
  `quarterly_name` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quarterly`
--

INSERT INTO `quarterly` (`quarterly_name`, `status`) VALUES
('1st Quarter', 'Active'),
('2nd Quarter', 'Inactive'),
('3rd Quarter', 'Inactive'),
('4th Quarter', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `quiz_type` tinyint NOT NULL COMMENT '0 : Short Quiz, 1: Long Quiz',
  `quiz_quarter` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `quiz_duration` int NOT NULL,
  `quiz_title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `quiz_items` tinyint NOT NULL,
  `quiz_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `sched_id`, `quiz_type`, `quiz_quarter`, `quiz_duration`, `quiz_title`, `quiz_items`, `quiz_date`) VALUES
('QZ-0161', 'SCHED-1860', 0, '1st Quarter', 20, 'Earth and Life Science Quiz', 10, '2025-03-21'),
('QZ-0881', 'SCHED-0027', 0, '1st Quarter', 20, 'Oral Communication Quiz', 10, '2025-03-14'),
('QZ-2786', 'SCHED-8801', 0, '1st Quarter', 10, 'INTRODUCTION TO PHILIPPINE HISTORY', 10, '2025-03-10'),
('QZ-2814', 'SCHED-9121', 0, '1st Quarter', 20, 'Disaster And Risk Reduction Quiz', 15, '2025-03-22'),
('QZ-3811', 'SCHED-1955', 0, '1st Quarter', 20, 'Kumunikasyon sa Pagpapakatao', 10, '2025-03-18'),
('QZ-6179', 'SCHED-0936', 0, '1st Quarter', 20, 'EMPOWERMENT TECHNOLOGY SHORT QUIZ', 10, '2025-03-27'),
('QZ-6542', 'SCHED-1913', 0, '1st Quarter', 30, 'UNDERSTANDING CULTURE , SOCIETY AND POLITICS  SHOR', 10, '2025-02-26'),
('QZ-7147', 'SCHED-1042', 0, '1st Quarter', 20, 'Practical Research 2', 10, '2025-03-20'),
('QZ-7173', 'SCHED-6388', 0, '1st Quarter', 20, 'TECH VOC DIAGNOSE COMPUTER', 5, '2025-03-08'),
('QZ-7234', 'SCHED-2822', 0, '1st Quarter', 20, 'General Chemisrtry', 10, '2025-03-03'),
('QZ-7541', 'SCHED-7588', 0, '1st Quarter', 15, 'BUSINESS MATHEMATICS', 6, '2025-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_enumeration`
--

CREATE TABLE `quiz_enumeration` (
  `q_enum_id` int NOT NULL,
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `q_enum_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_enum_answer` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_enumeration`
--

INSERT INTO `quiz_enumeration` (`q_enum_id`, `quiz_id`, `q_enum_question`, `q_enum_answer`) VALUES
(1, 'QZ-7173', 'List at least three common symptoms of a computer having overheating issues.', 'computer shutting down unexpectedly\r\nfan noise becomes louder\r\ncomputer performance becomes slow or lags\r\nhigh cpu temperature in task manager or bios\r\nblue screen or system crashes'),
(2, 'QZ-7173', 'Enumerate four possible reasons why a computer might fail to boot up.', 'power supply failure\r\nfaulty hard drive or storage device\r\ncorrupted system files or os\r\nloose or disconnected cables (e.g., motherboard, ram, etc.)\r\nbios/uefi misconfiguration or corruption'),
(3, 'QZ-7541', 'List atleast four basic math operators used in arithmetic', 'addition,subtraction,division,multiplication,modulus, exponentation');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_essay`
--

CREATE TABLE `quiz_essay` (
  `q_essay_id` int NOT NULL,
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `q_essay_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_multiple`
--

CREATE TABLE `quiz_multiple` (
  `q_mul_id` int NOT NULL,
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `q_mul_question` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_choice_a` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_choice_b` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_choice_c` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_choice_d` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_correct` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_multiple`
--

INSERT INTO `quiz_multiple` (`q_mul_id`, `quiz_id`, `q_mul_question`, `q_choice_a`, `q_choice_b`, `q_choice_c`, `q_choice_d`, `is_correct`) VALUES
(1, 'QZ-6542', 'Among the concepts of Sociology, Anthropology and Political Science, which of the following is referred to as the study of human kind at all times and all places?', 'Sociology', 'Population', 'Anthropology', 'Social Organization', 'Anthropology'),
(2, 'QZ-6542', 'It is a study of relationship among people.', 'Anthropology', 'Sociology', 'Archaeology', 'Etymology', 'Sociology'),
(3, 'QZ-6542', 'It deals with the system of government and the analysis of political activity and political behavior.', 'Public Policy', 'Political Theory', 'International Relation', 'Political science', 'Political science'),
(4, 'QZ-6542', 'A group of people involved in persistent interpersonal relationship, or a large social grouping sharing the same geographical or social territory, typically subject to the same political authority and', 'Scale', 'Society', 'Government', 'Culture', 'Society'),
(5, 'QZ-6542', 'A person or practitioner who studies Anthropology.', 'Sociologist', 'Psychologist', 'Anthropologist', 'Archaelogist', 'Anthropologist'),
(6, 'QZ-6542', 'It encompasses all social aspects including our language, custom, values, norms, mores, education etc.', 'Society', 'Politics', 'Culture', 'Political Science', 'Culture'),
(7, 'QZ-6542', 'Karen used to tease her newly transferred Mangyan classmate of his kinky hair and tanned skin. What kind of cultural view Karen has?', 'cultural relativism', 'ethnocentrism', 'culture', 'society', 'ethnocentrism'),
(8, 'QZ-6542', 'What cultural terms refers to the perspective that promotes an individual culture as the most efficient and superior?', 'Cultural Relativism', 'Cultural Variation', 'Culture Stocks', 'Ethnocentrism', 'Cultural Relativism'),
(9, 'QZ-6542', 'What cultural concept underscores the idea that culture in every society should be understood and regarded on its own?', 'Cultural Relativism', 'Cultural Variation', 'Cultural Shock', 'Ethnocentrism', 'Cultural Relativism'),
(10, 'QZ-6542', 'It is the process by which people learn and adapt the ways and manners of other cultures.', 'Ethnocentrism', 'Enculturation', 'Socialization', 'Acculturation', 'Enculturation'),
(11, 'QZ-7234', 'Which of the following is the process in which reactants or products itself act as catalyst?', 'catalysis ', ' auto-catalysis  ', 'positive catalysis.  ', 'negative catalysis', ' auto-catalysis  '),
(12, 'QZ-7234', 'Which of the following does not apply the concept of entropy?', 'Black hair turning grey   ', 'Cooling of a hot flat iron', 'Straightening curly hair ', 'Drop of ink dispersing in water', 'Straightening curly hair '),
(13, 'QZ-7234', 'One rainy day, your mom prepared a hot coffee for you and you did not drink it within few minutes. After some time, the coffee cooled down. Based on your evaluation, which of the following clearly be ', 'The coffee loses its heat due to external forces acting on it.', 'The coffee directly absorbed coldness from the surrounding.', 'The coffee loses its heat as it releases heat into the environment.', 'The coffee became cold as the glass absorbed the cold from the surrounding.', 'The coffee loses its heat as it releases heat into'),
(14, 'QZ-7234', 'What is the characteristics of reaction if the calculated delta G is negative?', 'The reaction is spontaneous at high temperature. ', 'The reaction is nonspontaneous at high temperature. ', 'The reaction is always spontaneous at all temperature. ', 'The reaction is always nonspontaneous at all temperature.', 'The reaction is always spontaneous at all temperat'),
(15, 'QZ-7234', 'Evaluate the following statements. Select the option that does not follow the concept of chemical equilibrium', 'If a stress (changes in reaction conditions) is applied to a system in equilibrium, then the systems adjusts in order to reduce the cause of the stress applied.', 'a stress (changes in reaction conditions) is applied to a system in equilibrium, then the system adjusts in order to reduce the effect of the stress applied.', 'If a stress (changes in reaction conditions) is applied to a system in equilibrium, then the system adjusts in order to increase the cause of the stress applied.', 'If a stress (changes in reaction conditions) is applied to a system in equilibrium, then the system adjusts in order to increase the effect of the stress applied.', 'a stress (changes in reaction conditions) is appli'),
(16, 'QZ-7234', 'Water is said to be amphoteric compound. Which of the following best describes amphoteric?', ' It is a very good strong electrolyte. ', 'It can either donate or accept a proton.', 'A substance that has a high heat capacity.  ', 'The ability to dissolve many polar and ionic substances.', 'It can either donate or accept a proton.'),
(17, 'QZ-7234', 'Evaluate the pH of the hydronium ion concentration in a solution that has a 4.57 x 10-9 Μ.', '6.42  ', '6.79  ', ' 8,34 ', '8.56', ' 8,34 '),
(18, 'QZ-7234', 'On what concentration does the pH of the buffer depends upon?', ' salt  ', ' acid (H+) only ', 'conjugate base (-OH) only  ', 'acid (H-) and conjugate base (-OH)', 'acid (H-) and conjugate base (-OH)'),
(19, 'QZ-7234', 'For a generic equilibrium HA(aq) = H+(aq) + A-(aq), which of these statements is true?', 'The equilibrium constant for this reaction changes as the pH changes.', 'If you add the soluble salt KA to a solution of HA that is at equilibrium, the pH would increase.', 'If you add the soluble salt KA to a solution of HA that is at equilibrium, the concentration of A- would decrease.', '. If you add the soluble salt KA to a solution of HA that is at equilibrium, the concentration of HA would decrease.', 'If you add the soluble salt KA to a solution of HA'),
(20, 'QZ-7147', ' In the field of Science, Technology, Engineering, and Mathematics (STEM), why do medical  practitioners practice research?', 'To improve educational practices', ' Obtain significant information about disense trends and risk factors', 'Help provide designs that are creatively beautiful and give convenience and efficiency.', 'To guarantee sufficient distribution of products and decide whether there is a need to increase product distribution.', ' Obtain significant information about disense tren'),
(21, 'QZ-7147', ' In an experiment, which group does not receive intervention?', 'The treatment group  ', 'The participant group  ', 'The control groups  ', 'The experimental group', 'The control groups  '),
(22, 'QZ-7147', ' Which of the following statements is TRUE about the conduct of experimental research?', ' Intact groups are used.  ', 'Individual subjects are randomly assigned.  ', 'Groups are exposed to the presumed cause. ', 'There is no random assignment of individuals.', 'Individual subjects are randomly assigned.  '),
(23, 'QZ-7147', 'What is the difference between quasi-experimental research and experimental research?', 'Participants for groups are randomly selected in experimental, but not quasi experimental research.', 'Intact groups are used in experiments, while quasi-experimental randomly assigned individuals into groups.', 'The researcher controls the intervention in the experimental group, but not quasi-experimental research.', 'Only one dependent variable is used in quasi-experimental research, while multiple dependent variables can be used in quasi-experimental research.', 'Participants for groups are randomly selected in e'),
(24, 'QZ-7147', 'This variable must be measurable', 'Controlled variable', 'Dependent variable  ', 'Independent variable', ' None of these', 'Dependent variable  '),
(25, 'QZ-7147', 'In research entitled, \"The Impact of Smoking Bans on Smoking and Consumers Behavior\", which is the dependent variable in this study?', 'Smoking.  ', 'Smoking Bans', 'Consumer Behavior', 'Smoking and Consumer Behavior', 'Smoking Bans'),
(26, 'QZ-7147', 'Quantitative research only works if', 'you talk to the right people ', 'you talk to the right number of people  ', 'you ask the right question to a number of people  ', ' you ask the right questions and analyze the data you get right away', 'you ask the right question to a number of people  '),
(27, 'QZ-7147', 'Why should a researcher pick the right research design?', 'It is to make your research more presentable.', 'It prevents the smooth sailing of the various research operations.', 'It fiscilitates the smooth sailing of the various research operations. ', 'All of the above', 'It fiscilitates the smooth sailing of the various '),
(28, 'QZ-7147', 'What is the goal of all scientific endeavors?', 'To compare sources of knowledge  ', ' To explain, predict, and/or control phenomena  ', 'To entail recognition and definition of a problem  ', 'To collect different data and make some conclusion', ' To explain, predict, and/or control phenomena  '),
(29, 'QZ-7147', 'Which of the following research questions could be answered by using quantitative research methods?', 'What is the most popular social media platform used by Senior High School students?', 'How has the Covid-19 pandemic affected career choices among college students?', 'What are the factors affecting depressive behavior?  ', 'None of the above', 'None of the above'),
(30, 'QZ-0881', 'Intrapersonal communication is best defined as:', 'The relationship level of communication.', 'Interactions with a limited number of persons.', ' Communication designed to inform or persuade audience members.', 'Communication with the self', 'Communication with the self'),
(31, 'QZ-0881', 'Bill and Mara are trying to decide which color to paint their living room. As part of their decision , they discuss the merits of their choices and how well they will match the furniture and style of ', 'Interpersonal Communication', 'Intrapersonal Communication', 'Small group of Communication', 'Public Communication ', 'Interpersonal Communication'),
(32, 'QZ-0881', 'Sammy and Jo are considering moving in together. Sammy is unsure, so she sits down to make a list of the pros and cons of cohabitating with jo. This is an example of which form of communication?', 'Interpersonal Communication', 'Intrapersonal Communication', 'Small group of Communication', 'Public Communication ', 'Intrapersonal Communication'),
(33, 'QZ-0881', 'Edward is trying to generate a topic for a persuasive speech. As he draws on his experience, he is engaging in what type of communication?', 'Intrapersonal', 'Interpersonal', 'Public', 'Mass', 'Intrapersonal'),
(34, 'QZ-0881', 'Lius wants to book a railway ticket, so he goes to the booking counter and speak to the person sitting there. this an example of which form of communication?', 'Interpersonal Communication', 'Intrapersonal Communication', 'Mass Communication', 'Public Communication', 'Interpersonal Communication'),
(35, 'QZ-0881', 'A kindergarten teacher gave her class a \"show and tell\" assignment of bringing something to represent their religion. This is an example of which form of communication?', 'Interpersonal Communication', 'Intrapersonal Communication', 'Small Group Communication', 'Public Communication', 'Small Group Communication'),
(36, 'QZ-0881', 'A student journalist articulated his stand on current issues through the school\'s newspaper. This is an example of which form of communication.', 'Mass Communication', 'Intrapersonal Communication', 'Interpersonal Communication', 'Public Communication', 'Mass Communication'),
(37, 'QZ-0881', 'A dyad communication occurs.......', 'one speaker', 'two people', 'a small group ', 'a speaker and an audience ', 'two people'),
(38, 'QZ-0881', 'Which of the following is NOT a speech context?', 'Intrapersonal Communication', 'Dyad Communication', 'Long Distance Communication', 'Mass Communication', 'Long Distance Communication'),
(39, 'QZ-0881', 'In which speech style are jargon, lingo, and street slang usually used?', 'intimate ', 'formal', 'casual', 'consultative', 'casual'),
(40, 'QZ-6179', 'Reverse the layer, selection or path horizontally or vertically Shift + F. Warp Transform: Deform with different tools', ' Flip Tool    ', 'Erase Tool    ', ' Clone Tool    ', 'Smudge Tool', ' Flip Tool    '),
(41, 'QZ-6179', 'Adjust the zoom level. Measure: Measure distance and angle. Move: Move layers, selections, and other objects', ' Zoom Tools      ', 'Alignment        ', 'Crop    ', 'Scale Tool', ' Zoom Tools      '),
(42, 'QZ-6179', 'This uses several design elements to draw a viewer’s attention', 'Variety    ', 'Emphasis   ', 'Movement    ', 'Balance', 'Emphasis   '),
(43, 'QZ-6179', 'Used to represent information, statistical data, or knowledge in a graphical manner usually done in a creative way to attract the viewer’s attention.', 'PicMonkey         ', 'Photoshop   ', 'Infographics       ', ' PhotoMania', 'Infographics       '),
(44, 'QZ-6179', 'It is the art and practice of planning and projecting ideas   and experiences with visual and textual content', 'Graphic Design                 ', 'Graphics            ', 'Layout             ', ' Image Manipulation', 'Graphic Design                 '),
(45, 'QZ-6179', 'These are the repeating visual element on an image or layout to create unity in the layout or image. Rhythm is achieved when visual elements create a sense of organized movement.', 'Pattern        ', 'Repetition    ', ' Rhythm      ', 'al', 'Pattern        '),
(46, 'QZ-6179', 'The visual weight of objects, texture, colors, and space is evenly distributed on the screen', ' Movement      ', 'Balance    ', ' Emphasis    ', 'Proportion', 'Balance    '),
(47, 'QZ-6179', 'Visual elements create a sense of unity where they relate well with one another.  ', ' Balance    ', '  Shadow      ', ' Texture    ', '  Proportion', '  Proportion'),
(48, 'QZ-6179', 'Which of the following is not a benefit of using online platform?', ' Knowledge and information sharing ', 'Makes information available  ', 'Provides information needed by many people  ', 'Establish relation to each other', 'Establish relation to each other'),
(49, 'QZ-6179', 'This type of image file can display transparencies.  ', '.bmp      ', '.gif     ', '.jpg       ', '.png', '.png'),
(50, 'QZ-2786', 'Who was the first European to arrive in the Philippines?', 'Christopher Columbus', 'Vasco da Gama', 'Ferdinand Magellan', 'Marco Polo', 'Ferdinand Magellan'),
(51, 'QZ-2786', 'When did the Philippines officially become a Spanish colony? ', '1942', '1565', '1588', '1600', '1565'),
(52, 'QZ-2786', 'What was the primary goal of the Katipunan? ', 'To establish a monarchy', 'To promote Spanish culture', 'To fight for Philippine independence from Spain ', 'To form alliances with foreign powers', 'To fight for Philippine independence from Spain '),
(53, 'QZ-2786', 'Who is known as the \"Father of the Philippine Revolution\"? ', 'Jose Rizal', 'Apolinario Mabini', 'Andres Bonifacio', 'Emilio Aguinaldo', 'Andres Bonifacio'),
(54, 'QZ-2786', 'Where did the Philippine Declaration of Independence take place on June 12, 1898? ', 'Manila', 'Cavite', 'Cebu', 'Davao', 'Cavite'),
(55, 'QZ-2786', 'Which document officially ended the Philippine-American War? ', 'Treaty of Versailles ', 'Treaty of Paris (1898)', ' Philippine Organic Act', 'The Malolos Constitution', 'Treaty of Paris (1898)'),
(56, 'QZ-2786', 'Who was the leader of the Philippine forces during the Philippine-America ? ', 'Jose Rizal', 'Emilio Aguinaldo', 'Apolinario Mabini', 'Andres Bonifacio', 'Emilio Aguinaldo'),
(57, 'QZ-2786', 'What was the name of the Filipino nationalist group that fought against the Spanish colonial rule? a) Katipunan b) Hukbalahap c) Red Guards d) Maharlika', 'Katipunan', 'Hukbalahap', 'Red Guards', 'Maharlika', 'Katipunan'),
(58, 'QZ-2786', 'What is the main reason for José Rizal’s execution by the Sp to assassinate the Spanish governor-generaanish in 1896? ', 'He led an armed rebellion ', ' He was a threat to Spanish control due to his writings', 'He attempted', 'He collaborated with foreign powers', ' He was a threat to Spanish control due to his wri'),
(59, 'QZ-2786', 'Which of the following was the first constitution of the Philippines?', 'The Malolos Constitution', 'The Philippine Organic Act', 'The 1987 Constitution', 'The Spanish Colonial Charter', 'The Malolos Constitution');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_tf`
--

CREATE TABLE `quiz_tf` (
  `q_tf_id` int NOT NULL,
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `q_tf_question` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `q_tf_answer` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_tf`
--

INSERT INTO `quiz_tf` (`q_tf_id`, `quiz_id`, `q_tf_question`, `q_tf_answer`) VALUES
(1, 'QZ-0161', 'Minerals are classified as naturally occurring simply because they are formed by natten processes.', 'True'),
(2, 'QZ-0161', 'All minerals are inorganic.', 'True'),
(3, 'QZ-0161', 'Color is sometimes caused by the presence of trace elements or compounds within a mineral.', 'True'),
(4, 'QZ-0161', 'Hardness is a measure of how easily a mineral can be bent', 'False'),
(5, 'QZ-0161', 'Minerals are made in lab from natural materials.', 'False'),
(6, 'QZ-0161', 'Diamonds are so hard they cannot be broken.', 'False'),
(7, 'QZ-0161', 'Vitreous describes how a mineral appears to reflect light.', 'True'),
(8, 'QZ-0161', 'The earth revolves around the sun.', 'True'),
(9, 'QZ-0161', 'Tan\'s Scale of hardness is used to rate hardness of minerals.', 'False'),
(10, 'QZ-0161', 'Color alone is not a reliable characteristic to identify minerals.', 'True'),
(11, 'QZ-2814', 'Vulnerability is associated to the susceptibility of a community to the impact of hazards.', 'True'),
(12, 'QZ-2814', 'Landslides are not associated with earthquakes, hurricanes, floods and volcanoes.', 'False'),
(13, 'QZ-2814', 'Tsunami waves originate from undersea or coastal seismic activity and can be caused by earthquakes, ', 'True'),
(14, 'QZ-2814', 'The pyroclastic flows are the less important manifestation of volcanoes.', 'False'),
(15, 'QZ-2814', ' In recovery, communities and property owners, local government, sectoral ministries and private sec', 'True'),
(16, 'QZ-2814', 'A problem statement and the solution/decision are needed to start preparing a work plan.', 'True'),
(17, 'QZ-2814', 'The use of incentives as a means of encouraging the use of Disaster Risk Reduction measures is an Ac', 'True'),
(18, 'QZ-2814', 'Environmental measures that have the capacity to reduce the impact of natural hazards are designed t', 'True'),
(19, 'QZ-2814', 'A troubleshooting worksheet is used to minimize potential problems to a plan implementation.', 'True'),
(20, 'QZ-2814', 'You work in troubleshooting once you have problems during the implementation of the action plan, not', 'False'),
(21, 'QZ-2814', 'The purpose of evaluation is to monitor, evaluate and update the plan and document the results.', 'True'),
(22, 'QZ-2814', ' The lack of development can make countries less vulnerable and susceptible to risk.', 'False'),
(23, 'QZ-2814', 'Direct damage is all damage sustained by immovable assets.', 'True'),
(24, 'QZ-2814', 'Preparedness is a component of adverse event management; preparedness activities are undertaken imme', 'False'),
(25, 'QZ-2814', 'The storm surge is the less important phenomena associated with a hurricane.', 'False'),
(26, 'QZ-3811', 'Ang komunikasyon ay senyales o simbulo na ginagamit ng tao upang ipahayag ang kanyang saloobin.', 'True'),
(27, 'QZ-3811', 'Ayon kay Dr. Manuel Dy, ang tunay na komunikasyon sa pagitan ng mga tao ay tinatawag na \"diyalogo\".', 'True'),
(28, 'QZ-3811', 'Ang pakikipagdiyalogo ay pagkumpirma sa pagkatao ng taong ka diyalogo.', 'True'),
(29, 'QZ-3811', 'Ang diyalogo ay nararapat na sa pamilya nagsisimula at natututuhan.', 'True'),
(30, 'QZ-3811', 'Ang diyalogo ay ginagawa upang makamit ang isang layuning pansarili.', 'False'),
(31, 'QZ-3811', ' Ang pagmamahal ang pinakamabisang paraan ng komunikasyon.', 'True'),
(32, 'QZ-3811', 'Ang pagbabago ng ekspresyon ng mukha sa di-berbal ay tinatawag na OCULESICS.', 'False'),
(33, 'QZ-3811', 'Chronemics ang tawag sa komunikasyon na gumagamit ng oras at petsa.', 'True'),
(34, 'QZ-3811', ' Haptics ang tawag sa paghaplos, pagkurot at paghawak ng kamay sa paghahatid ng mensahe.', 'True'),
(35, 'QZ-3811', ' Ang komunikasyon ay epektibo kahit na hindi isinasaalang-alang ang damdamin ng kausap', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `registrar_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'User ID'
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
  `sched_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `section_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_day` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_from` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `sched_to` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `teacher_id`, `section_code`, `sub_code`, `sched_day`, `sched_from`, `sched_to`, `created_at`) VALUES
('SCHED-0027', '25-087506-9685', 'SECTION-1636', 'SUB-7279', 'Thursday', '09:35 AM', '11:30 AM', '2025-02-26 05:27:29'),
('SCHED-0936', '25-028905-5178', 'SECTION-2633', 'SUB-1849', 'Monday', '07:30 AM', '09:20 AM', '2025-02-26 05:34:01'),
('SCHED-1042', '25-087311-5405', 'SECTION-7330', 'SUB-1339', 'Wednesday', '09:30 AM', '11:30 AM', '2025-02-26 05:28:32'),
('SCHED-1860', '25-076604-7647', 'SECTION-4366', 'SUB-3375', 'Friday', '09:35 AM', '11:30 AM', '2025-02-26 05:29:20'),
('SCHED-1913', '25-047808-7735', 'SECTION-4733', 'SUB-2820', 'Tuesday', '07:30 AM', '09:20 AM', '2025-02-26 05:31:23'),
('SCHED-1955', '25-037606-6505', 'SECTION-6899', 'SUB-1374', 'Thursday', '07:30 AM', '09:20 AM', '2025-02-26 05:33:00'),
('SCHED-2822', '25-160207-5758', 'SECTION-1393', 'SUB-2971', 'Wednesday', '07:30 AM', '11:30 AM', '2025-02-26 05:24:07'),
('SCHED-6388', '25-317805-4016', 'SECTION-0626', 'SUB-1668', 'Tuesday', '01:00 PM', '05:00 PM', '2025-02-26 05:22:56'),
('SCHED-7588', '25-128005-3915', 'SECTION-6218', 'SUB-9424', 'Monday', '01:00 PM', '05:00 PM', '2025-02-26 05:25:30'),
('SCHED-8801', '25-097908-6299', 'SECTION-3408', 'SUB-6568', 'Tuesday', '09:35 AM', '11:30 AM', '2025-02-26 05:26:29'),
('SCHED-9121', '25-057602-9162', 'SECTION-4651', 'SUB-2184', 'Thursday', '01:00 PM', '02:50 PM', '2025-02-26 05:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int NOT NULL,
  `school_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `school_address` varchar(150) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `school_address`) VALUES
(1, 'COMPUTER SYSTEMS INSTITUTE, INC.', 'F. IMPERIAL ST., BRGY. 36 - CAPANTAWAN, LEGAZPI CITY');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `strand_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `grade_lvl` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `section_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `school_year` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_code`, `strand_code`, `grade_lvl`, `section_name`, `school_year`, `teacher_id`, `date_created`) VALUES
('SECTION-0626', 'STRAND-9457', 'GRADE-11', 'ST.JUDE', '2024-2025', '25-317805-4016', '2025-02-22'),
('SECTION-1393', 'STRAND-3453', 'GRADE-11', 'ST.PADREPIO', '2024-2025', '25-160207-5758', '2025-02-22'),
('SECTION-1636', 'STRAND-9457', 'GRADE-12', 'GENESIS', '2024-2025', '25-087506-9685', '2025-02-22'),
('SECTION-2633', 'STRAND-2745', 'GRADE-11', 'ST.PAUL', '2024-2025', '25-028905-5178', '2025-02-22'),
('SECTION-3408', 'STRAND-6675', 'GRADE-12', 'CODE', '2024-2025', '25-097908-6299', '2025-02-22'),
('SECTION-4366', 'STRAND-3453', 'GRADE-12', 'ENERGY', '2024-2025', '25-076604-7647', '2025-02-22'),
('SECTION-4651', 'STRAND-6675', 'GRADE-11', 'ST.THERESE', '2024-2025', '25-057602-9162', '2025-02-22'),
('SECTION-4733', 'STRAND-5688', 'GRADE-11', 'ST.MICHAEL', '2024-2025', '25-047808-7735', '2025-02-22'),
('SECTION-6218', 'STRAND-7781', 'GRADE-11', 'ST.CLAIR', '2024-2025', '25-128005-3915', '2025-02-22'),
('SECTION-6899', 'STRAND-7781', 'GRADE-12', 'EDGE', '2024-2025', '25-037606-6505', '2025-02-22'),
('SECTION-7330', 'STRAND-2745', 'GRADE-12', 'FIREFOX', '2024-2025', '25-087311-5405', '2025-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_name` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `stu_id` int COLLATE utf8mb4_general_ci NOT NULL,
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
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_lrn`, `stu_fname`, `stu_mname`, `stu_lname`, `stu_address`, `stu_contact`, `stu_gender`, `stu_email`, `stu_dob`, `stu_pob`, `father_name`, `mother_name`, `parent_contact`, `image`, `id`) VALUES
(1, '112040110002', 'SONNY', 'DELA CRUZ', 'ARAOJO', 'PIGCALE LEGAZPI CITY', '9978421545', 'MALE', 'soonyaraojo002@gmail.com', '2005-12-09', 'LELEGAZPI CITY', 'JEROME ARAOJO', 'FATIMA ARAOJO', '9954545415', '', 'USER-4736'),
(2, '112054130026', 'ANNIKA', 'BERTIZ', 'AMARANTO', 'STO DOMINGO LEGAZPI CITY', '9458525496', 'FEMALE', 'annikaamoranto@gmail.com', '2000-08-05', 'STO DOMINGO ALBAY', 'NILO AMORANTO', 'SALVACION AMORANTO', '9456576232', '', 'USER-6740'),
(3, '112059130014', 'DOMINIC', 'BATA', 'BORNASAL', 'SAN FERNANDO LEGAZPI CITY', '9945987564', 'MALE', 'dominicbata@gmail.com', '2000-02-12', 'LEGAZPI CITY', 'CRISTINA BORNASAL', 'CRISTOPER BORNASAL', '9457874221', '', 'USER-5605'),
(4, '112345434567', 'JOHN ADRIAN', '', 'ALAMARES', 'CARMONA CITY', '9876545678', 'MALE', 'andie@gmail.com', '2006-08-30', 'CARMONA', 'KARLO ALMARES', 'WINNIE ALMARES', '9767876787', '', 'USER-8841'),
(5, '113468765456', 'JOHN CARL', '', 'ACHA', 'GOGON CITY', '9775432343', 'MALE', 'john@gmail.com', '2005-12-19', 'GOGON', 'GINA ACHA', 'DADO ACHA', '9754334567', '', 'USER-5383'),
(6, '113567898767', 'ROHANN', '', 'AGUILAR', 'LEGAZPI CITY', '9655432123', 'MALE', 'rohan@gmail.com', '2008-12-05', 'LEGAZPI CITY', 'WLSON AGUILAR', 'MARRY AGUILAR', '9656777623', '', 'USER-2635'),
(7, '114456543456', 'JERMIN', '', 'BALDERAMA', 'CAPANTAWAN LEGAZPI CITY', '9765454323', 'MALE', 'jermin@gmail.com', '2006-07-03', 'Legazpi City', 'CELSO  BALDERAMA', 'ANDIE BALDERAMA', '9765633456', 'student_67ca22605f95b5.91473801.jpg', 'USER-2618'),
(8, '114456765456', 'WILT FRANCIS', '', 'APINADO', 'LEGAZPI CITY', '9655432123', 'MALE', 'wilt@gmail.com', '2003-04-11', 'LEGAZPI CITY', 'DANDY APINADO', 'JANISE APINADO', '9677765456', '', 'USER-8997'),
(9, '114456787654', 'ADRIAN', '', 'ABION', 'PADANG LEGAZPI CITY', '9876789876', 'MALE', 'adrian@gmail.com', '2005-04-16', 'PADANG', 'JEMMIE ABION', 'JADY ABION', '9876567678', '', 'USER-5648'),
(10, '114466765434', 'MARK', '', 'ALCERA', 'ARIMBAY', '9567876567', 'MALE', 'mark@gmail.com', '2004-06-26', 'ARIMBAY', 'ALEX ALCERA', 'ANNA ALCERA', '9345654568', '', 'USER-0079'),
(11, '114467876789', 'DENVER MATTHEW', '', 'ANDES', 'LEGAZPI', '9776546765', 'MALE', 'denver@gmail.com', '2009-03-07', 'LEGAZPI CITY', 'AMMY ANDES', 'DINDO ANDES', '9556776545', '', 'USER-9414'),
(12, '114467898767', 'EMMANUEL', '', 'ANONUEVO', 'RAWIS', '9553432343', 'MALE', 'emman@gmail.com', '2003-11-08', 'RAWIS', 'SANDY ANONUEVO', 'QUINNIE ANONUEVO', '9445676567', '', 'USER-0620'),
(13, '114468120036', 'SUNSHINE', 'GURAY', 'AJERO', 'BANQUEROHAN LEGAZPI CITY', '9912587864', 'FEMALE', 'sunshineajero@gmail.com', '2000-09-05', 'BANQUEROHAN LEGAZPI CITY', 'REYMUND AJERO', 'ROSE MAE AJERO', '9056578645', '', 'USER-0040'),
(14, '114476120059', 'AIVEN JEROME', 'DIANELA', 'MEDIAVILLO', 'DINAGAAN LEGAZPI CITY', '9945845678', 'MALE', 'jeromemediavillo12@gmail.com', '2003-12-05', 'LEGAZPI CITY', 'JAMES  MEDIAVILLO', 'SAMANTHA MEDIAVILLO', '9955867465', '', 'USER-9184'),
(15, '114477110014', 'ARYYN CLYDE', 'IBAÑEZ', 'ALEJO', 'VICTOTY VILLAGE LEGAZPI CITY', '9784454541', 'MALE', 'clydealejo@gmail.com', '2001-02-03', 'LEGAZPI CITY', 'SALVADOR ALEJO', 'ROISSANA ALEJO', '9915999454', '', 'USER-0161'),
(16, '114478130059', 'EUNICE JADE', 'PINEDA', 'AGRIPA', 'CABANGAN LEGAZPI', '9314255684', 'FEMALE', 'Eunice@gmail.com', '2005-11-08', 'CABANGAN LEGAZPI', 'JORDAN AGRIPA', 'JOEYNA AGRIPA', '9456754322', '', 'USER-5269'),
(17, '114478987656', 'PATRICK', '', 'ANTOLIN', 'DARAGA ALBAY', '9112345654', 'MALE', 'pat@gmail.com', '2011-06-12', 'DARAGA', 'ANNIE ANTOLIN', 'IAN ANTOLIN', '9778765456', '', 'USER-8192'),
(18, '114479140076', 'JOSEF FAUSTINE', 'NAPAY', 'AGUILAR', 'LAPU LAPU LEGAZPI CITY', '9978751545', 'MALE', 'napayaguilar@gmail.com', '2000-09-06', 'LEGAZPI CITY', 'CRISSANTO AGUILAR', 'LILY AGUILAR', '9978454545', '', 'USER-7677'),
(19, '114480130031', 'SANDRO', 'AVILLANO', 'ANONUEVO', 'ORO SITE LEGAZPI CITY', '9573996777', 'MALE', 'sandro@gmail.com', '2005-02-04', 'ORO SITE LEGAZPI CITY', 'LUIS ANONUEVO', 'JOY ANONUEVO', '9465778544', '', 'USER-7512'),
(20, '114485130065', 'ANDREA', 'AZURIN', 'ARMARIO', 'ARIMBAY LEGAZPI CITY', '9765443223', 'FEMALE', 'andrea@gmail.com', '2004-01-04', 'ARIMBAY LEGAZPI', 'PAUL ARMARIO', 'NIDA ARMARIO', '9665454748', '', 'USER-8691'),
(21, '114485140062', 'ALLYSA MAE', 'MANLANGIT', 'AGRAVANTE', 'ARIMBAY LEGAZPI CITY', '9293921391', 'FEMALE', 'Allysa@gmail.com', '2001-01-09', 'LEGAZPI CITY', 'MARK AGRAVANTE', 'MARRY AGRAVANTE', '9329139219', '', 'USER-4430'),
(22, '114485140095', 'MAECHELLE', 'GAVERIA', 'ACOSTA', 'ARIMBAY LEGAZPI CITY', '9293921391', 'FEMALE', 'maechelle@gmail.com', '2005-02-22', 'LEGAZPI CITY', 'SAMUEL ACOSTA', 'RACHEL ACOSTA', '9329139219', '', 'USER-8427'),
(23, '114487130123', 'FRANCINE', 'HERRERA', 'ARAO', 'RAWIS LEGAZPI CITY', '9787542415', 'FEMALE', 'francineherrera_12@gmail.com', '2005-02-01', 'LEGAZPI CITY', 'ARIEL ARAO', 'MARY JANE ARAO', '9094578454', '', 'USER-1093'),
(24, '114488130003', 'HECTOR', 'PULALES', 'ABELLANO', 'ARIMBAY LEGAZPI CITY', '9121133587', 'MALE', 'hectorabellano@gmail.com', '2012-02-07', 'LEGAZPI CITY', 'RAUL ABELLANO', 'TERESA ABELLANO', '9475589654', '', 'USER-6090'),
(25, '114488130054', 'MARK JOMARY', 'LITERAL', 'ALAURIN', 'ARIMBAY LEGAZPI CITY', '9558795245', 'MALE', 'markjomaryalaurin@gmail.com', '2014-09-08', 'LEGAZPI CITY', 'RAMOND ALAURIN', 'GINA ALAURIN', '9784546535', '', 'USER-1920'),
(26, '114490100021', 'ROMEO JR.', 'ECHEMANE', 'ARQUERO', 'RAWIS LEGASPI CITY', '9000756565', 'MALE', 'rome@gmail.com', '2009-06-04', 'RAWIS LEGAZPI CITY', 'LORENSO ARQUERO', 'LORENA ARQUERO', '9865735555', '', 'USER-2989'),
(27, '114490130160', 'JERICH', 'ARABACA', 'BAUTISTA', 'GOGON LEGAZPI CITY', '9755647157', 'FEMALE', 'jericharabaca007@gmail.com', '2004-09-06', 'LEGAZPI CITY', 'DENNNIS BAUTISTA', 'MARICHU BAUTISTA', '9785454545', '', 'USER-8982'),
(28, '114492130014', 'CASEY LOKE', 'DIO', 'BANEZ', 'PADANG LEGAZPI CITY', '9045753688', 'FEMALE', 'casey@gmail.com', '2006-12-07', 'PADANG', 'DENNIS BANEZ', 'CARLA BANEZ', '9646075065', '', 'USER-4894'),
(29, '114495130122', 'LIANNE', 'REBLANDO', 'ALCERA', 'CABANGAN LEGAZPI CITY', '9976876878', 'FEMALE', 'llannealcera@gmail.com', '2003-05-12', 'LEGAZPI CITY', 'ROBERT ALCERA', 'MARILOU ALCERA', '9168795898', '', 'USER-4782'),
(30, '117754323456', 'JOHN', '', 'ABRIQUE', 'GOGON', '9765678766', 'MALE', 'johh@gmail.com', '2008-04-06', 'GOGON', 'RICH ABRIQUE', 'FERNA ABRIQUE', '9567765456', '', 'USER-7354'),
(31, '123874758882', 'RYAN JAMES', 'AVILLANO', 'ABILA', 'ORO SITE LEGAZPI CITY', '9876545678', 'MALE', 'ryann@gmail.com', '2007-03-09', 'ORO SITE LEGAZPI CITY', 'LUIS ABILA', 'JOY ABILA', '9567653345', '', 'USER-3153'),
(32, '128654345676', 'VHON DIOVY', '', 'ACERON', 'DARAGA ALBAY', '9765434565', 'MALE', 'vhon@gmail.com', '2009-05-11', 'DARAGA', 'VINO ACERON', 'VIY ACERON', '9876787656', '', 'USER-1346'),
(33, '145676543234', 'CEDRICK', '', 'ABEJUELLA', 'CAPANTAWAN LEGAZPI CITY', '9765676789', 'MALE', 'cedrick@gmail.com', '2006-12-07', 'LEGAZPI CITY', 'CEASAR ABEJUELA', 'CASSEY ABEJUELA', '9678765678', '', 'USER-7308'),
(34, '176545678765', 'JOHN KIMUEL', '', 'ALVARADO', 'GOGON', '9331145678', 'MALE', 'kim@gmail.com', '2006-04-15', 'GOGON', 'RONA ALVARADO', 'RUEL ALVARADO', '9768764345', '', 'USER-7224');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `answer_id` int NOT NULL,
  `stu_lrn` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Set as Nullable',
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Set as Nullable',
  `question_id` int NOT NULL,
  `question_type` enum('multiple_choice','enumeration','essay','true_false') COLLATE utf8mb4_general_ci NOT NULL,
  `student_answer` text COLLATE utf8mb4_general_ci NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_scores`
--

CREATE TABLE `student_scores` (
  `score_id` int NOT NULL,
  `stu_lrn` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `exam_id` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Set as Nullable',
  `quiz_id` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Set as Nullable',
  `total_questions` int NOT NULL DEFAULT '0',
  `correct_answers` int NOT NULL DEFAULT '0',
  `equivalent_score` decimal(5,2) NOT NULL DEFAULT '0.00',
  `quarterly` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PRIMARY KEY',
  `sub_title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'SUBJECT NAME',
  `sub_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_time` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_semester` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
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
('SUB-2184', 'DISASTER & READINESS RISK REDUCTION', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-2471', 'GENERAL MATHEMATICS', 'CORE', '--:-- --', '1st Semester'),
('SUB-2557', 'PRE-CALCULUS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-2689', 'BIOLOGY 2', 'SPECIALIZED', '--:-- --', '2nd Semester'),
('SUB-2820', 'UNDERSTANDING CULTURE, SOCIETY AND POLITICS', 'APPLIED', '--:-- --', '1st Semester'),
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
('SUB-7686', 'FUNDAMENTALS OF ABM', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-8344', 'PERSONAL DEVELOPMENT/PANSARILING KAUNLARAN', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-8742', 'PERSONAL DEVELOPMENT', 'CORE', '--:-- --', '1st Semester'),
('SUB-8775', 'GENERAL PHYSICS', 'APPLIED', '--:-- --', '1st Semester'),
('SUB-9424', 'BUSINESS MATHEMATICS', 'CORE', '--:-- --', '1st Semester'),
('SUB-9527', 'TECH VOC 1- INSTALL COMPUTER SYSTEMS', 'SPECIALIZED', '--:-- --', '1st Semester'),
('SUB-9691', 'READING AND WRITING SKILLS', 'CORE', '--:-- --', '2nd Semester'),
('SUB-9839', 'HOPE-2', 'CORE', '--:-- --', '1st Semester');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE `sy` (
  `school_year` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `teacher_fname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_mname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teacher_lname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_contact` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_gender` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_dob` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_address` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_fname`, `teacher_mname`, `teacher_lname`, `teacher_contact`, `teacher_gender`, `teacher_dob`, `status`, `teacher_address`, `image`, `id`) VALUES
('25-028905-5178', 'CHRISTINE MAE', '', 'BARLIZO', '9450373758', 'FEMALE', '1989-05-02', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-8609'),
('25-037606-6505', 'REGIE', '', 'AJERO', '9055787972', 'MALE', '1976-06-03', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-0551'),
('25-047808-7735', 'MYRA', '', 'MADARA', '9073345707', 'FEMALE', '1978-08-04', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-4481'),
('25-057602-9162', 'ARIEL', '', 'ABALETA', '9707567845', 'MALE', '1976-02-05', 'FULL TIME', 'ARIMBAY LEGAZPI CITY', NULL, 'USER-6859'),
('25-076604-7647', 'JAYCEL', '', 'ESTRADA', '9701422636', 'FEMALE', '1966-04-07', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-1026'),
('25-087311-5405', 'PERLA', '', 'ALA', '9667402211', 'FEMALE', '1973-11-08', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-8749'),
('25-087506-9685', 'MARY ANN', '', 'AJERO', '9055787972', 'FEMALE', '1975-06-08', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-2913'),
('25-097908-6299', 'KATRIN', '', 'NUNEZ', '9579302020', 'FEMALE', '1979-08-09', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-3060'),
('25-128005-3915', 'MERCY', '', 'MACASINAG', '9663458754', 'FEMALE', '1980-05-12', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-4933'),
('25-160207-5758', 'JEROME', '', 'DELFINO', '9056065434', 'MALE', '2002-07-16', 'FULL TIME', 'TABACO CITY', NULL, 'USER-3055'),
('25-317805-4016', 'NORBERTO', '', 'LLAMOSO', '9646446723', 'MALE', '1978-05-31', 'FULL TIME', 'LEGAZPI CITY', NULL, 'USER-1733');

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
(149, 'USER-0040', '114468120036', 'c9cc9b714fd6eaf4f41735986a1b08643ec69936', 'STUDENT', '2025-02-22 23:51:01'),
(171, 'USER-0079', '114466765434', '7d596634fcb949a9f1ef8874c1490567a91ef4a3', 'STUDENT', '2025-02-23 20:52:12'),
(150, 'USER-0161', '114477110014', 'dd35f53eadf18d2a841841027d3507e074e1bfe2', 'STUDENT', '2025-02-22 23:54:41'),
(145, 'USER-0551', 'LMS-037606-9747', 'fa5199b741da4ef6724ff52280f57ac411f44ea7', 'TEACHER', '2025-02-22 18:40:10'),
(169, 'USER-0620', '114467898767', 'b12d7d7f20e7d8c9a6a65189e9fa8b04758d749a', 'STUDENT', '2025-02-23 20:47:55'),
(142, 'USER-1026', 'LMS-076604-3790', '7c294b2463c4f1c336f63c2bb48a6840a0ee2ae9', 'TEACHER', '2025-02-22 18:28:14'),
(154, 'USER-1093', '114487130123', '3051960173cd0fbe62f497893c8d6f937e79f819', 'STUDENT', '2025-02-23 00:13:08'),
(167, 'USER-1346', '128654345676', 'd938c1b759df596d90f1f83fdd734678d78a3e55', 'STUDENT', '2025-02-23 20:43:11'),
(136, 'USER-1733', 'LMS-317805-7705', '313a4b51766001c6d2c8b3ae1b822f59331b0651', 'TEACHER', '2025-02-22 18:17:39'),
(114, 'USER-1875', 'registrar', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'REGISTRAR', '2024-12-11 21:22:43'),
(147, 'USER-1920', '114488130054', 'f46766dc22d5ce4ccc07e4a144d71ae906ed3544', 'STUDENT', '2025-02-22 23:28:57'),
(163, 'USER-2618', '114456543456', '525484a25c735c6125f146c82f09dab1a9463df9', 'STUDENT', '2025-02-23 20:34:39'),
(159, 'USER-2635', '113567898767', '0c87b5568ec719c3d2350832ff040c5fd351cf3d', 'STUDENT', '2025-02-23 20:24:52'),
(144, 'USER-2913', 'LMS-087506-5225', 'a482fbcba4da0dcd41e8a2f6f203ce2e12406c22', 'TEACHER', '2025-02-22 18:30:14'),
(133, 'USER-2989', '114490100021', '0c3c4200566e196a5e82bcd6f569c7033393422d', 'STUDENT', '2025-02-22 17:32:03'),
(138, 'USER-3055', 'LMS-160207-5702', '80754d29575937672fdbc7434c7c74f8a435e2f3', 'TEACHER', '2025-02-22 18:20:05'),
(143, 'USER-3060', 'LMS-097908-9578', 'dc280f20a18b7f2da422ad05cf469615508cdc7b', 'TEACHER', '2025-02-22 18:29:24'),
(158, 'USER-3153', '123874758882', '8f47c4fe95104358c64c9ea1096e156f45ba5ece', 'STUDENT', '2025-02-23 20:22:52'),
(129, 'USER-4430', '114485140062', '10d0a66282d65c85532881b51a2e90fb07c64a5c', 'STUDENT', '2025-02-22 16:35:59'),
(139, 'USER-4481', 'LMS-047808-3945', '8f6b08642687dfcd0853cd22317ab6935eb49f6a', 'TEACHER', '2025-02-22 18:22:19'),
(156, 'USER-4736', '112040110002', 'cca83023518f5d8832d1485b935e72ec7b4c4905', 'STUDENT', '2025-02-23 00:22:32'),
(151, 'USER-4782', '114495130122', '0944a244ad7622f35d664ef9f23a851578d290fc', 'STUDENT', '2025-02-22 23:57:37'),
(84, 'USER-4861', 'principal', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'PRINCIPAL', '2024-11-26 23:42:32'),
(134, 'USER-4894', '114492130014', 'cd6a4e0709936c10f8352fb629935ab58f6fcf88', 'STUDENT', '2025-02-22 17:50:34'),
(137, 'USER-4933', 'LMS-128005-1238', '701cc5e3069bc097246e315e2d55dc6fec9f9405', 'TEACHER', '2025-02-22 18:19:04'),
(130, 'USER-5269', '114478130059', 'cfb18a29ef01ef6af18f9d260d711cfb05cb1aca', 'STUDENT', '2025-02-22 16:45:10'),
(161, 'USER-5383', '113468765456', '5299ddac903896b3d59fc2d6ac8f84ce2ee1cdf7', 'STUDENT', '2025-02-23 20:29:14'),
(152, 'USER-5605', '112059130014', '9a4b2fdd4c924243690fddd7a1560a42457dabde', 'STUDENT', '2025-02-23 00:05:21'),
(165, 'USER-5648', '114456787654', 'b842245b9e5242b61850511e53b84638d26600d5', 'STUDENT', '2025-02-23 20:38:34'),
(146, 'USER-6090', '114488130003', 'b132b51d464291be2f241d8f7384da1cc6d9e3dc', 'STUDENT', '2025-02-22 23:25:47'),
(148, 'USER-6740', '112054130026', '569a5291de072cd1c1210ea013a62000fcba66e7', 'STUDENT', '2025-02-22 23:33:31'),
(132, 'USER-6859', 'LMS-057602-1690', 'f481dcbee84997e0369e80a7b543ac4e59a87ebb', 'TEACHER', '2025-02-22 17:17:06'),
(172, 'USER-7224', '176545678765', '50b3debacd41295c3614bfd1b6b2de17f017f571', 'STUDENT', '2025-02-23 20:54:00'),
(164, 'USER-7308', '145676543234', 'cd6a4e0709936c10f8352fb629935ab58f6fcf88', 'STUDENT', '2025-02-23 20:36:48'),
(170, 'USER-7354', '117754323456', '15db249f4b2f3e233764a0adb3a1375effc881f5', 'STUDENT', '2025-02-23 20:50:39'),
(128, 'USER-7512', '114480130031', 'd057e5ae110e2e3dc644af2d999d8d763a9bac9c', 'STUDENT', '2025-02-22 16:29:54'),
(155, 'USER-7677', '114479140076', 'f63fc1159d76578348ead3bee68ff5ac6003b737', 'STUDENT', '2025-02-23 00:20:03'),
(162, 'USER-8192', '114478987656', '730c4300aa3d59503cd32bcd4b4bf6476389bf43', 'STUDENT', '2025-02-23 20:32:20'),
(127, 'USER-8427', '114485140095', '2fb5a7e4f8a223c713796d0fe9eacca6d8a29992', 'STUDENT', '2025-02-22 16:26:39'),
(135, 'USER-8609', 'LMS-028905-2029', '3d3921403dbd47371b6e128328cd83b34fccde68', 'TEACHER', '2025-02-22 18:16:30'),
(131, 'USER-8691', '114485130065', '0bd7bae0b2fd4997da17c81ef65655b9b27af646', 'STUDENT', '2025-02-22 16:50:53'),
(140, 'USER-8749', 'LMS-087311-4563', 'c3af75f6ab1f60252e44e24a7d98b0651878bcf8', 'TEACHER', '2025-02-22 18:25:11'),
(166, 'USER-8841', '112345434567', '9dfe29ecdc3b652ea6b18902093e3c0ee5e2005e', 'STUDENT', '2025-02-23 20:41:07'),
(157, 'USER-8982', '114490130160', 'bf4741e8fa74dbb3dc500a6671c0453be16d625f', 'STUDENT', '2025-02-23 00:25:56'),
(160, 'USER-8997', '114456765456', 'f6e08aeb56ce0d74bca70bd3c239995b170f1bb6', 'STUDENT', '2025-02-23 20:27:17'),
(153, 'USER-9184', '114476120059', '49ec1084007c7d88ebb05659ba1380d06008d592', 'STUDENT', '2025-02-23 00:09:30'),
(168, 'USER-9414', '114467876789', '6db7d726c71f67145f037a7c5bef4efccd0cc5ec', 'STUDENT', '2025-02-23 20:45:01');

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
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `fk_quiz_sched` (`sched_id`);

--
-- Indexes for table `quiz_enumeration`
--
ALTER TABLE `quiz_enumeration`
  ADD PRIMARY KEY (`q_enum_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_essay`
--
ALTER TABLE `quiz_essay`
  ADD PRIMARY KEY (`q_essay_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_multiple`
--
ALTER TABLE `quiz_multiple`
  ADD PRIMARY KEY (`q_mul_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_tf`
--
ALTER TABLE `quiz_tf`
  ADD PRIMARY KEY (`q_tf_id`),
  ADD KEY `quiz_id` (`quiz_id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `stu_id` (`stu_id`),
  ADD KEY `id` (`id`);


--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `stu_lrn` (`stu_lrn`) USING BTREE,
  ADD KEY `exam_id` (`exam_id`) USING BTREE,
  ADD KEY `quiz_id` (`quiz_id`) USING BTREE,
  ADD KEY `sub_code` (`sub_code`) USING BTREE;

--
-- Indexes for table `student_scores`
--
ALTER TABLE `student_scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `stu_lrn` (`stu_lrn`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `quiz_id` (`quiz_id`) USING BTREE,
  ADD KEY `sub_code` (`sub_code`) USING BTREE;

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
  MODIFY `enum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_essay`
--
ALTER TABLE `exam_essay`
  MODIFY `essay_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_multiple`
--
ALTER TABLE `exam_multiple`
  MODIFY `mul_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `exam_tf`
--
ALTER TABLE `exam_tf`
  MODIFY `tf_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `quiz_enumeration`
--
ALTER TABLE `quiz_enumeration`
  MODIFY `q_enum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_essay`
--
ALTER TABLE `quiz_essay`
  MODIFY `q_essay_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_multiple`
--
ALTER TABLE `quiz_multiple`
  MODIFY `q_mul_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `quiz_tf`
--
ALTER TABLE `quiz_tf`
  MODIFY `q_tf_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `answer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `student_scores`
--
ALTER TABLE `student_scores`
  MODIFY `score_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_num` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;


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
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `fk_quiz_sched` FOREIGN KEY (`sched_id`) REFERENCES `schedule` (`sched_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_enumeration`
--
ALTER TABLE `quiz_enumeration`
  ADD CONSTRAINT `quiz_enumeration_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_essay`
--
ALTER TABLE `quiz_essay`
  ADD CONSTRAINT `quiz_essay_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_multiple`
--
ALTER TABLE `quiz_multiple`
  ADD CONSTRAINT `quiz_multiple_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_tf`
--
ALTER TABLE `quiz_tf`
  ADD CONSTRAINT `quiz_tf_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE;

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
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `fk_student_answers_exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_answers_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_answers_student` FOREIGN KEY (`stu_lrn`) REFERENCES `student` (`stu_lrn`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_answers_subject` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE CASCADE;

--
-- Constraints for table `student_scores`
--
ALTER TABLE `student_scores`
  ADD CONSTRAINT `fk_student_scores_ibfk_3` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_scores_subject` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_scores_ibfk_1` FOREIGN KEY (`stu_lrn`) REFERENCES `student` (`stu_lrn`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_scores_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_teacher_users` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
