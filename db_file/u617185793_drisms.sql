-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 11:00 PM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u617185793_drisms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `attachment_for` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `type` enum('Head Quarters','Branch') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Head Quarters',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `school_id`, `postal_code`, `name`, `email`, `address`, `phone`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'DATS TECHNICAL DRIVING SCHOOL', 'renrenkim12345@gmail.com', 'Cagayan de Oro City', '09066624939', 'Head Quarters', '2021-12-20 09:07:31', '2021-12-20 09:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Theory','Practical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Theory',
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `type`, `course_id`, `student_id`, `school_id`, `created_at`, `updated_at`) VALUES
(11, 'Theory', 1, 103, 1, '2022-06-27 17:54:32', '2022-06-27 17:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `communications`
--

CREATE TABLE `communications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('sms','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `messages` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `communication_user_school_branches`
--

CREATE TABLE `communication_user_school_branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_sender_id` int(11) DEFAULT NULL,
  `comm_id` int(11) DEFAULT NULL,
  `user_receiver_id` int(11) DEFAULT NULL,
  `school_receiver_id` int(11) DEFAULT NULL,
  `branch_receiver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `status` enum('Available','Unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `price`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2000.00, 'Theoretical Driving Course', 'Available', '2021-12-20 09:07:02', '2021-12-20 09:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `courses_enrolled`
--

CREATE TABLE `courses_enrolled` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `total_theory` int(11) DEFAULT NULL,
  `total_practical` int(11) DEFAULT NULL,
  `completed_theory` int(11) DEFAULT NULL,
  `completed_practical` int(11) DEFAULT NULL,
  `completed_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Complete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_instructor`
--

CREATE TABLE `course_instructor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sc_id` int(11) DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `sc_id`, `day`, `created_at`, `updated_at`) VALUES
(41, 65, 'Monday', '2022-06-30 02:19:12', '2022-06-30 02:19:12'),
(42, 66, 'Monday, Wednesday, Friday', '2022-07-04 07:21:52', '2022-07-04 07:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `fleet_schedule_id` int(11) DEFAULT NULL,
  `student_course_id` int(11) DEFAULT NULL,
  `classes` enum('theoretical','practical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'theoretical',
  `demonstrates_sensivity_to_students` int(11) DEFAULT NULL,
  `keeps_accurate_records_of_students` int(11) DEFAULT NULL,
  `demonstrates_mastery_subject_matter` int(11) DEFAULT NULL,
  `creates_teaching_strategies` int(11) DEFAULT NULL,
  `enhances_student_self_esteem` int(11) DEFAULT NULL,
  `encourage_students` int(11) DEFAULT NULL,
  `designs_and_implements_learning_conditions` int(11) DEFAULT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_comment_use` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet`
--

CREATE TABLE `fleet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `car_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `make` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `model_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fleet`
--

INSERT INTO `fleet` (`id`, `car_no`, `car_plate`, `make`, `model`, `model_year`, `created_at`, `updated_at`) VALUES
(1, '1', 'XYY 344', 'Honda', 'Brio', '2020', '2021-12-20 09:10:01', '2021-12-20 09:10:01'),
(2, '2', 'QWE 355', '12', 'Honda Brio', '2020', '2022-01-09 13:38:17', '2022-01-09 13:38:17'),
(3, '3', 'YVT 344', 'Honda', 'Brio', '2020', '2022-01-16 12:45:49', '2022-01-16 12:45:49'),
(4, '4', 'XCU 532', 'Honda', 'Brio', '2020', '2022-01-17 00:24:51', '2022-01-17 00:24:51'),
(5, '6', 'DFG 456', 'Honda', 'Brio', '2020', '2022-01-21 07:55:50', '2022-01-21 07:55:50'),
(6, '1', 'KDU 985', 'Mitsubishi', 'Pajero', '1990', '2022-06-16 09:20:58', '2022-06-16 09:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `fleet_schedules`
--

CREATE TABLE `fleet_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Practical Driving Course',
  `price` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3000.00',
  `instructor_id` int(11) NOT NULL DEFAULT 3000,
  `student_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `fleet_id` int(11) DEFAULT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `duration` int(11) DEFAULT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `status` enum('completed','inprogress') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inprogress',
  `evaluation` enum('pass','failed','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `driver_license_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `control_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `date_issue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fleet_schedules`
--

INSERT INTO `fleet_schedules` (`id`, `course_name`, `price`, `instructor_id`, `student_id`, `school_id`, `fleet_id`, `time_start`, `time_end`, `start`, `end`, `day`, `duration`, `period`, `status`, `evaluation`, `driver_license_no`, `control_no`, `date_issue`, `created_at`, `updated_at`) VALUES
(16, 'Practical Driving Course', '3000.00', 88, NULL, NULL, 6, '09:00', '22:13', NULL, NULL, 'Monday, Wednesday, Friday', 3, 'Hours', 'inprogress', 'pending', 'pending', 'pending', 'pending', '2022-06-30 02:14:04', '2022-06-30 02:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, '34nudqdXO2.png', 1, NULL, '2021-12-18 06:27:27', '2021-12-19 08:45:01'),
(2, 'WAIUkGKU1w.png', 2, NULL, '2021-12-19 02:03:48', '2021-12-19 02:03:48'),
(3, 'etUQq84ZiX.png', 3, NULL, '2021-12-19 02:06:09', '2021-12-19 02:06:09'),
(4, 'kzXnBxCagw.png', 4, NULL, '2021-12-19 02:33:49', '2021-12-19 02:33:49'),
(5, 'r8yxenfSdt.png', NULL, 1, '2021-12-20 01:07:02', '2021-12-20 01:07:02'),
(6, 'dipuVLL7mb.png', NULL, 2, '2021-12-20 02:19:52', '2021-12-20 02:24:18'),
(7, '0nRKq3ajRu.png', 5, NULL, '2021-12-20 17:06:13', '2021-12-20 17:06:13'),
(8, 'xwTFzA0VNz.png', 6, NULL, '2021-12-27 03:30:30', '2021-12-27 03:30:30'),
(9, 'FLUHbtQJOT.png', 7, NULL, '2022-01-04 04:55:32', '2022-01-04 04:55:32'),
(10, 'nIpwn1o7gB.png', 8, NULL, '2022-01-06 20:30:19', '2022-01-06 20:30:19'),
(11, 'OidjQPmw4A.png', 9, NULL, '2022-01-10 17:22:10', '2022-01-10 17:22:10'),
(12, 'U7FBrbJBCB.png', 10, NULL, '2022-01-10 17:27:26', '2022-01-10 17:27:26'),
(13, 'V0syfgcBwg.png', 11, NULL, '2022-01-16 04:41:25', '2022-01-16 04:41:25'),
(14, 'LEmSidXoE5.png', 12, NULL, '2022-01-16 04:59:04', '2022-01-16 04:59:04'),
(15, 'YfwkORLOvT.png', 13, NULL, '2022-01-16 05:00:32', '2022-01-16 05:00:32'),
(16, 'huzxWc0KbP.png', 14, NULL, '2022-01-20 23:35:31', '2022-02-03 09:37:46'),
(17, 'IlNd1UKG63.png', 15, NULL, '2022-01-20 23:39:41', '2022-01-20 23:39:41'),
(18, 'bYPLop8phy.png', 16, NULL, '2022-01-25 03:51:46', '2022-01-25 03:51:46'),
(19, 'JPbZ1zyaDF.png', 17, NULL, '2022-02-01 18:23:37', '2022-02-01 18:23:37'),
(20, 'BQNdClhoyo.png', 18, NULL, '2022-02-02 17:53:44', '2022-02-03 08:30:51'),
(21, 'ylw5LgnOAx.png', 19, NULL, '2022-02-03 08:47:19', '2022-02-03 08:47:19'),
(22, 'YZA7Xup1nR.png', 20, NULL, '2022-02-03 10:09:05', '2022-02-03 10:09:05'),
(23, 'D46wfDnFx6.png', 21, NULL, '2022-02-08 10:29:45', '2022-02-08 10:30:00'),
(24, 'k7E3CmerDU.png', 22, NULL, '2022-02-08 10:32:08', '2022-02-08 10:32:08'),
(25, '7EbTsh8gpr.png', 23, NULL, '2022-02-08 10:36:41', '2022-02-08 10:36:41'),
(26, 'uROPmF1UD7.png', 24, NULL, '2022-02-08 10:40:33', '2022-02-08 10:40:33'),
(27, 'Tmw2ixNiJy.png', 25, NULL, '2022-02-08 10:47:57', '2022-02-08 10:47:57'),
(28, 'R1lWbsG3Ax.png', 26, NULL, '2022-02-09 22:37:16', '2022-02-09 22:37:16'),
(29, 'o80sCetl9d.png', 27, NULL, '2022-02-10 00:16:25', '2022-02-10 00:16:25'),
(30, 'eotgbnuPQ4.png', 28, NULL, '2022-02-10 01:10:33', '2022-02-10 01:10:33'),
(31, 'woZKRPBTZP.png', 29, NULL, '2022-05-22 07:32:48', '2022-05-22 07:32:48'),
(32, 'jkera3Nu89.png', 30, NULL, '2022-05-22 07:35:29', '2022-05-22 07:35:29'),
(33, 'fP80GLvBYe.png', 31, NULL, '2022-05-22 07:51:12', '2022-05-22 07:51:12'),
(34, 'BZACMFbigz.png', 32, NULL, '2022-05-29 05:07:56', '2022-05-29 05:07:56'),
(52, 'qqGxQdnduE.png', 51, NULL, '2022-05-29 07:23:29', '2022-05-29 07:23:29'),
(53, 'AdljI6DJUE.png', 52, NULL, '2022-05-29 07:44:28', '2022-05-29 07:44:28'),
(69, '3U9MGNH89b.png', 76, NULL, '2022-05-30 22:15:51', '2022-05-30 22:15:51'),
(70, 'x9M7xYOmRD.png', 79, NULL, '2022-06-08 21:54:13', '2022-06-08 21:54:13'),
(71, 'qaFob9lvoO.png', 80, NULL, '2022-06-11 19:20:42', '2022-06-11 19:27:48'),
(72, 'NQphccBaTZ.png', 81, NULL, '2022-06-13 03:28:03', '2022-06-13 03:31:06'),
(73, 'hq2SNoIDxX.png', 82, NULL, '2022-06-13 03:44:46', '2022-06-13 03:44:46'),
(74, 'sRyV59c7T7.png', 83, NULL, '2022-06-13 04:34:41', '2022-06-13 04:37:10'),
(75, 'JVaLQwYTAA.png', 84, NULL, '2022-06-13 04:41:46', '2022-06-13 04:41:46'),
(76, 'YM2WVx9HiB.png', 85, NULL, '2022-06-13 17:11:38', '2022-06-13 17:11:38'),
(77, 'XTsxGFOaxa.png', 86, NULL, '2022-06-13 17:41:02', '2022-06-30 03:20:37'),
(78, 'ympiw5o2XV.png', 87, NULL, '2022-06-13 17:42:17', '2022-06-14 04:31:13'),
(79, 'LG2SLBWmiD.png', 88, NULL, '2022-06-13 17:55:35', '2022-06-13 19:37:40'),
(80, 'vrSIfURGfP.png', 89, NULL, '2022-06-13 19:43:25', '2022-06-13 19:43:25'),
(81, 'JgvYB9Sm9u.png', 90, NULL, '2022-06-13 22:05:14', '2022-06-13 22:05:14'),
(82, '7ebEFrAi83.png', 91, NULL, '2022-06-14 09:12:14', '2022-06-14 09:12:14'),
(83, 'NHFQi6TK7e.png', 92, NULL, '2022-06-14 09:14:21', '2022-06-14 09:14:21'),
(84, 'Cil30YrZdS.png', 93, NULL, '2022-06-14 16:15:03', '2022-06-14 16:15:03'),
(85, '7RUYzV5TnY.png', 94, NULL, '2022-06-16 00:20:25', '2022-06-16 00:20:25'),
(86, 'nqX0ZuSMlj.png', 95, NULL, '2022-06-16 00:22:36', '2022-06-16 00:22:36'),
(87, '0voT6M5rg5.png', 96, NULL, '2022-06-16 01:05:39', '2022-06-16 01:05:39'),
(88, 'r8cdDpgLkQ.png', 97, NULL, '2022-06-16 01:30:20', '2022-06-16 01:30:20'),
(89, 'L7wGljgFsB.png', 98, NULL, '2022-06-17 07:48:03', '2022-06-17 07:48:03'),
(90, 'bQr8nZyTNT.png', 99, NULL, '2022-06-17 07:56:27', '2022-06-17 07:56:27'),
(91, 'Tohs3LkFA0.png', 100, NULL, '2022-06-18 13:38:44', '2022-06-18 13:38:44'),
(92, 'V0JjwJmIn3.png', 101, NULL, '2022-06-18 13:39:07', '2022-06-18 14:31:56'),
(93, 'mZ8YGN2X2H.png', 102, NULL, '2022-06-19 07:02:51', '2022-06-19 07:02:51'),
(94, 'aKbUZmckIK.png', 103, NULL, '2022-06-19 07:24:22', '2022-06-19 07:24:22'),
(95, 'YHfoGh1BR5.png', 104, NULL, '2022-06-19 08:07:38', '2022-06-19 08:07:38'),
(96, 'HuNa8HhB6W.png', 105, NULL, '2022-06-19 12:25:33', '2022-06-19 12:25:33'),
(97, 'HZx5ZeI35n.png', 107, NULL, '2022-06-21 05:09:13', '2022-06-21 05:09:13'),
(98, 'MZFcq3RPTL.png', 108, NULL, '2022-06-21 05:22:42', '2022-06-21 05:22:42'),
(99, 'y5BLbBODYz.png', 109, NULL, '2022-06-21 10:05:19', '2022-06-21 10:05:19'),
(100, 'boRVV0jRTg.png', 110, NULL, '2022-06-21 10:05:38', '2022-06-21 10:05:38'),
(101, 'gxJN3LLswr.png', 111, NULL, '2022-06-21 14:46:33', '2022-06-21 14:46:33'),
(102, 'LRelSRC3pr.png', 112, NULL, '2022-06-21 15:10:14', '2022-06-21 15:10:14'),
(103, 'OgHeye73eh.png', 113, NULL, '2022-06-21 15:19:11', '2022-06-21 15:19:11'),
(104, '6MC7hYyPB8.png', 114, NULL, '2022-06-21 15:23:05', '2022-06-21 15:23:05'),
(105, 'xG8CpsFBRo.png', 115, NULL, '2022-06-21 15:47:23', '2022-06-21 15:47:23'),
(106, 'QZMYIaj3tU.png', 116, NULL, '2022-06-21 16:23:53', '2022-06-21 16:23:53'),
(107, 'Zur2JlvdUT.png', 117, NULL, '2022-06-21 16:57:39', '2022-06-21 16:57:39'),
(108, 'sdgIdtARkJ.png', 118, NULL, '2022-06-21 17:46:58', '2022-06-21 17:46:58'),
(109, 'EbTUcZCdnI.png', 119, NULL, '2022-06-21 18:09:46', '2022-06-21 18:09:46'),
(110, 'HsyuqqaDit.png', 120, NULL, '2022-06-21 19:21:07', '2022-06-21 19:21:07'),
(111, 'dBQZFg3n7M.png', 121, NULL, '2022-06-21 19:34:33', '2022-06-21 19:34:33'),
(112, '49NFOW9CuW.png', 122, NULL, '2022-06-21 19:56:56', '2022-06-21 19:56:56'),
(113, 'zjuyrpHPjl.png', 123, NULL, '2022-06-21 19:58:55', '2022-06-21 19:58:55'),
(114, 'SPtqFXMQHt.png', 124, NULL, '2022-06-21 20:03:10', '2022-06-21 20:03:10'),
(115, 'PxGkkj2qwS.png', 125, NULL, '2022-06-21 23:47:57', '2022-06-21 23:47:57'),
(116, 'SUUtbMko0P.png', 126, NULL, '2022-06-24 21:35:31', '2022-06-24 21:35:31'),
(117, '1eCZOemtJx.png', 127, NULL, '2022-06-24 21:37:30', '2022-06-24 21:37:30'),
(118, 'm8GSiCa9oW.png', 128, NULL, '2022-06-26 07:03:15', '2022-06-26 07:03:15'),
(119, 'C9E9BkhXT5.png', 129, NULL, '2022-06-26 17:31:45', '2022-06-26 17:31:45'),
(120, 'U8qqAJAxad.png', 130, NULL, '2022-06-27 11:50:41', '2022-06-27 11:50:41'),
(121, 'dYj1wywHes.png', 131, NULL, '2022-06-27 11:53:40', '2022-06-27 11:53:40'),
(122, 'gTdgFJn0DG.png', 132, NULL, '2022-06-27 12:31:39', '2022-06-27 12:31:39'),
(123, 'lDdPyQTesj.png', 133, NULL, '2022-06-27 12:51:34', '2022-06-27 12:51:34'),
(124, 'hBO09l5csa.png', 134, NULL, '2022-06-27 13:43:33', '2022-06-27 13:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assisted_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `or_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Theoretical Driving Course',
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `assisted_by`, `or_num`, `course_name`, `course_id`, `user_id`, `amount`, `method`, `created_at`, `updated_at`) VALUES
(9, 'DRISMS ADMIN', '1569296629', 'Theoretical Driving Course', 1, 103, 2000.00, 'Cash', '2022-06-27 17:55:00', '2022-06-27 17:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_practicals`
--

CREATE TABLE `invoice_practicals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assisted_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `or_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Practical Driving Course',
  `user_id` int(11) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(3, '2021_11_05_080706_create_schools_table', 1),
(4, '2021_11_05_081215_create_schedules_table', 1),
(5, '2021_11_05_081315_create_payments_table', 1),
(6, '2021_11_05_081344_create_notifications_table', 1),
(7, '2021_11_05_081445_create_invoices_table', 1),
(8, '2021_11_05_081527_create_fleet_table', 1),
(9, '2021_11_05_081647_create_courses_enrolled_table', 1),
(10, '2021_11_05_081734_create_courses_table', 1),
(11, '2021_11_05_081949_create_branches_table', 1),
(12, '2021_11_05_082024_create_attachments_table', 1),
(13, '2021_11_06_142429_create_course_instructor_table', 1),
(14, '2021_11_08_233849_create_images_table', 1),
(15, '2021_11_14_133528_create_communications_table', 1),
(16, '2021_11_14_140245_create_communication_user_school_branches_table', 1),
(17, '2021_11_16_074418_create_sms_gateways_table', 1),
(18, '2021_11_20_044659_create_student_course_table', 1),
(19, '2021_11_20_044758_create_school_course_table', 1),
(20, '2021_11_22_151533_create_classes', 1),
(21, '2021_11_25_015326_create_days_table', 1),
(22, '2021_11_28_165359_create_permissions_table', 1),
(23, '2021_12_01_105625_create_fleet_schedules_table', 1),
(24, '2021_12_14_040530_create_evaluation_table', 1),
(25, '2022_06_27_154906_create_invoice_practicals_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `status` enum('active','not active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `type` enum('newaccount','payment','delete','message','calendar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'newaccount',
  `class` enum('personal','school','branch','system') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `image_id`, `user_id`, `school_id`, `branch_id`, `status`, `type`, `class`, `message`, `created_at`, `updated_at`) VALUES
(78, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Online job can be really effective if you use this Robot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-28 23:39:04', '2022-06-28 23:39:04'),
(79, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Online job can be really effective if you use this Robot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-28 23:39:09', '2022-06-28 23:39:09'),
(80, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Online job can be really effective if you use this Robot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-28 23:39:14', '2022-06-28 23:39:14'),
(81, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Online job can be really effective if you use this Robot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-28 23:39:18', '2022-06-28 23:39:18'),
(82, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Online job can be really effective if you use this Robot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-28 23:39:23', '2022-06-28 23:39:23'),
(83, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> The huge income without investments is available, now! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 01:59:49', '2022-06-29 01:59:49'),
(84, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> The huge income without investments is available, now! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 01:59:53', '2022-06-29 01:59:53'),
(85, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> The huge income without investments is available, now! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 01:59:57', '2022-06-29 01:59:57'),
(86, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> The huge income without investments is available, now! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 02:00:01', '2022-06-29 02:00:01'),
(87, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> The huge income without investments is available, now! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 02:00:06', '2022-06-29 02:00:06'),
(88, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Additional income is now available for anyone all around the world. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 04:17:54', '2022-06-29 04:17:54'),
(89, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Additional income is now available for anyone all around the world. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 04:17:58', '2022-06-29 04:17:58'),
(90, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Additional income is now available for anyone all around the world. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 04:18:03', '2022-06-29 04:18:03'),
(91, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Additional income is now available for anyone all around the world. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 04:18:07', '2022-06-29 04:18:07'),
(92, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Additional income is now available for anyone all around the world. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 04:18:11', '2022-06-29 04:18:11'),
(93, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> No need to work anymore while you have the Robot launched! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 06:37:41', '2022-06-29 06:37:41'),
(94, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> No need to work anymore while you have the Robot launched! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 06:37:46', '2022-06-29 06:37:46'),
(95, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> No need to work anymore while you have the Robot launched! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 06:37:51', '2022-06-29 06:37:51'),
(96, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> No need to work anymore while you have the Robot launched! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 06:37:56', '2022-06-29 06:37:56'),
(97, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> No need to work anymore while you have the Robot launched! https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 06:38:00', '2022-06-29 06:38:00'),
(98, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> We know how to become rich and do you? https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 09:18:17', '2022-06-29 09:18:17'),
(99, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> We know how to become rich and do you? https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 09:18:21', '2022-06-29 09:18:21'),
(100, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> We know how to become rich and do you? https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 09:18:26', '2022-06-29 09:18:26'),
(101, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> We know how to become rich and do you? https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 09:18:30', '2022-06-29 09:18:30'),
(102, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> We know how to become rich and do you? https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 09:18:35', '2022-06-29 09:18:35'),
(103, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Everyone can earn as much as he wants suing this Bot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 11:38:11', '2022-06-29 11:38:11'),
(104, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Everyone can earn as much as he wants suing this Bot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 11:38:15', '2022-06-29 11:38:15'),
(105, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Everyone can earn as much as he wants suing this Bot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 11:38:20', '2022-06-29 11:38:20'),
(106, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Everyone can earn as much as he wants suing this Bot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 11:38:24', '2022-06-29 11:38:24'),
(107, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Everyone can earn as much as he wants suing this Bot. https://Num.startupers.se/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJenJen</small> ', '2022-06-29 11:38:28', '2022-06-29 11:38:28'),
(108, NULL, NULL, NULL, NULL, 'active', 'newaccount', 'personal', 'New Fleet Schedule added for <strong>DRISMS ADMIN</strong>.', '2022-06-30 02:14:04', '2022-06-30 02:14:04'),
(109, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Making money is very easy if you use the financial Robot. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-03 19:38:44', '2022-07-03 19:38:44'),
(110, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Try out the best financial robot in the Internet. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-03 21:52:42', '2022-07-03 21:52:42'),
(111, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Make dollars just sitting home. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 00:06:45', '2022-07-04 00:06:45'),
(112, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Try out the automatic robot to keep earning all day long. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 02:24:26', '2022-07-04 02:24:26'),
(113, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Attention! Financial robot may bring you millions! https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 04:44:28', '2022-07-04 04:44:28'),
(114, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Let the Robot bring you money while you rest. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 07:01:49', '2022-07-04 07:01:49'),
(115, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Make money in the internet using this Bot. It really works! https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 09:17:43', '2022-07-04 09:17:43'),
(116, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Financial robot is your success formula is found. Learn more about it. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 11:24:09', '2022-07-04 11:24:09'),
(117, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Have no money? It’s easy to earn them online here. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 13:28:28', '2022-07-04 13:28:28'),
(118, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Your computer can bring you additional income if you use this Robot. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 15:37:33', '2022-07-04 15:37:33'),
(119, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Find out about the fastest way for a financial independence. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 17:43:25', '2022-07-04 17:43:25'),
(120, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Make money online, staying at home this cold winter. https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 19:52:32', '2022-07-04 19:52:32'),
(121, NULL, 1, NULL, NULL, 'active', 'message', 'personal', '<br /> Attention! Here you can earn money online! https://Num.dkworld.de/gotodate/go <br/><small>Type: email </small><br/><small>Sender: CrytoJen</small> ', '2022-07-04 22:07:34', '2022-07-04 22:07:34');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `invoice` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `scheduling` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `students` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `instructor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `fleet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read_only',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `staff_id`, `scheduling`, `students`, `instructor`, `fleet`, `branch`, `invoice`, `course`, `school`, `created_at`, `updated_at`) VALUES
(1, 2, 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', '2021-12-16 15:41:07', '2021-12-16 15:41:07'),
(3, 4, 'read_write_delete', 'read_write_delete', 'read_write_delete', 'read_write_delete', 'read_write_delete', 'read_write_delete', 'read_write_delete', 'read_write_delete', '2021-12-19 10:33:49', '2022-02-10 05:26:37'),
(4, 28, 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', '2022-02-10 09:10:33', '2022-02-10 09:10:33'),
(5, 81, 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', '2022-06-13 11:28:03', '2022-06-13 11:28:03'),
(6, 89, 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', '2022-06-14 03:43:25', '2022-06-14 03:43:25'),
(7, 92, 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', '2022-06-14 17:14:21', '2022-06-14 17:14:21'),
(8, 99, 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', 'read_only', '2022-06-17 15:56:27', '2022-06-17 15:56:27'),
(9, 105, 'read_only', 'read_write', 'read_only', 'read_only', 'read_only', 'read_write', 'read_write', 'read_write', '2022-06-19 20:25:33', '2022-06-24 20:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `fleet_id` int(11) DEFAULT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `class_type` enum('Practical','Theory') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Practical',
  `status` enum('New','Completed','Missed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `status` enum('Active','Suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `payment_reminder` enum('On','Off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On',
  `class_reminder` enum('On','Off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On',
  `multi_booking` enum('Enabled','Disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enabled',
  `class_sms_notification` enum('Enabled','Disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `email`, `phone`, `address`, `currency`, `timezone`, `status`, `payment_reminder`, `class_reminder`, `multi_booking`, `class_sms_notification`, `created_at`, `updated_at`) VALUES
(1, 'DATS TECHNICAL DRIVING SCHOOL', 'renrenkim12345@gmail.com', '09066624939', 'Cagayan de Oro City', 'unknown', 'unknown', 'Active', 'On', 'On', 'Enabled', 'Enabled', '2021-12-20 09:06:28', '2021-12-20 09:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `school_course`
--

CREATE TABLE `school_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_course`
--

INSERT INTO `school_course` (`id`, `instructor_id`, `course_id`, `branch_id`, `school_id`, `time_start`, `time_end`, `start`, `end`, `duration`, `period`, `created_at`, `updated_at`) VALUES
(65, 88, 1, 1, 1, '09:00', '12:00', NULL, NULL, 3, 'Hours', '2022-06-30 02:19:12', '2022-06-30 02:19:12'),
(66, 88, 1, 1, 1, '13:00', '16:00', NULL, NULL, 3, 'Hours', '2022-07-04 07:21:52', '2022-07-04 07:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateways`
--

CREATE TABLE `sms_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `mobile_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_gateways`
--

INSERT INTO `sms_gateways` (`id`, `user_id`, `api_key`, `mobile_ip`, `created_at`, `updated_at`) VALUES
(1, 1, '11e87495', 'http://192.168.1.19:8082', '2021-12-20 09:20:06', '2022-01-27 00:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `driving_lto_requirement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theoretical_driving_course` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `practical_driving_course_mv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_transmission_mv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `automatic_transmission_mv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `practical_driving_course_mc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_transmission_mc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `automatic_transmission_mc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others_mc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `where_did_you_know_school_` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weigth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_mother` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_father` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_notify_in_case_of_emergency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_pob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y_e` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'more than a months',
  `orno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('completed','inprogress') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inprogress',
  `evaluation` enum('pass','failed','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `school_course_id`, `student_id`, `school_id`, `branch_id`, `driving_lto_requirement`, `theoretical_driving_course`, `practical_driving_course_mv`, `manual_transmission_mv`, `automatic_transmission_mv`, `practical_driving_course_mc`, `manual_transmission_mc`, `automatic_transmission_mc`, `others_mc`, `where_did_you_know_school_`, `civil_status`, `pob`, `height`, `weigth`, `blood_type`, `name_of_mother`, `name_of_father`, `person_notify_in_case_of_emergency`, `guardian_address`, `guardian_number`, `guardian_pob`, `guardian_relation`, `y_e`, `orno`, `amount_paid`, `status`, `evaluation`, `created_at`, `updated_at`) VALUES
(11, 25, 103, 1, 1, NULL, '15 Hours Theoretical Driving Course', '8 Hours Practical Driving Course (MV)', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'more than a months', NULL, NULL, 'inprogress', 'pending', '2022-06-27 17:54:32', '2022-06-27 17:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Male',
  `dob` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `role` enum('Admin','Staff','Superadmin','Instructor','Student') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Student',
  `positions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `enrollment_status` int(11) DEFAULT NULL,
  `status` enum('Active','Suspended','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `gender`, `dob`, `phone`, `address`, `password`, `token`, `role`, `positions`, `enrollment_status`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'DRISMS', 'ADMIN', 'admin', 'renrenkim12345@gmail.com', 'Female', '2000-06-14', '09066624939', 'Cagayan de Oro City', '$2y$10$33B5BqYXQiv2WcxcW2Lsz.rr5AG3PyW.4U2AFIxQdx34tuoYJrL8.', 'unknown', 'Admin', 'unknown', NULL, 'Active', NULL, NULL, '2021-12-18 14:27:27', '2022-01-27 00:40:37'),
(2, 'Jane', 'Doe', 'student', 'jaycelelloren28@gmail.com', 'Female', '1999-04-15', '09675702028', 'Cagayan de Oro City', '$2y$10$RPSaI/wgrVMDQ0cF9N7K6uQ7fxCRf/el28H0PQwqEjFm5MtXQYEZO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2021-12-19 10:03:48', '2022-01-24 12:08:01'),
(3, 'John', 'Doe', 'instructor', 'sanghae.r12@gmail.com', 'Male', '1995-07-01', '09682095315', 'Cagayan de Oro City', '$2y$10$/Zb4AfohzDn/AY7waWyg8.F4l4nRTpy1CvzpphXijRBpDLSKXOdYq', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2021-12-19 10:06:09', '2021-12-19 10:06:09'),
(4, 'Stef', 'phany', 'staff', 'jaycelelloren5@gmail.com', 'Female', '1996-08-26', '09675702028', 'Cagayan de Oro City', '$2y$10$6ISiGUs/m.0WWcXDr/See.wbbHINiWTbhErzCnK/86qMKYa77XwWO', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2021-12-19 10:33:49', '2021-12-19 10:33:49'),
(5, 'nbvv778899', 'mnnjn0o00', 'lhynshel', 'mseder@ustp.edu.ph', 'Female', '1978-12-06', '9778355502', 'qewewe', '$2y$10$Ekw25/cTCunroURp4XQBUuvrGQmR1RhUTgIzwHL6e6i..li8Q0uDa', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2021-12-21 01:06:13', '2021-12-21 01:20:51'),
(6, 'Katheryn', 'Winnick', 'kath', 'katheryn@gmail.com', 'Female', '1990-01-27', '09341454620', 'Canada Ontario', '$2y$10$a5SlnxC6OBUsP.XgX6yaHOJMQyUYtLA5Y9Xf2eYSytOwRP4lrhmH2', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2021-12-27 11:30:30', '2021-12-27 11:30:30'),
(7, 'Kyungsoo', 'Do', 'kyungsoo', 'qaaron9@gmail.com', 'Male', '1993-01-12', '09172863749', 'Cagayan de Oro City', '$2y$10$7whn9ZNF46gsbUR8IH7reubj0rCLEZQDcpVHSn.wJzqmckzOMQ7Yi', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-04 12:55:32', '2022-01-07 04:23:51'),
(8, 'Ethan', 'Winters', 'ethanwinters', 'ethanwinters@gmail.com', 'Male', '1993-03-17', '+639687356483', 'Cagayan de Oro City', '$2y$10$N/x9FrTgfLkFNiVlj4ZW8uQd3U8TUu0ir7p9JXz8QyHqrWjdMBKJG', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-07 04:30:19', '2022-01-16 12:48:50'),
(9, 'Jennifer', 'Smith', 'smith', 'jennSmith@gmail.com', 'Female', '1995-09-15', '09566596137', 'Cagayan de Oro City', '$2y$10$wLm.dNAnEZD98yKzqBdL/eLYlo6ewUgwFVMa/xuH3xNbnt0JlsilO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-11 01:22:10', '2022-01-11 02:45:58'),
(10, 'Camilo', 'Madrigal', 'instructor2', 'ricks@gmail.com', 'Male', '1995-08-17', '09066624939', 'Cagayan de Oro City', '$2y$10$BOVT185kJDCFo..Ee6X0fOwFSDZBlWNpCRtGQFIFj/LkPldZGYlpy', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-11 01:27:26', '2022-01-11 01:27:26'),
(11, 'James', 'Winstone', 'instructor3', 'anthonytismo@gmail.com', 'Male', '1995-08-07', '09358792719', 'Cagayan de Oro City', '$2y$10$SzX8QefSmoujFDJVBuP5Qub3Gwgan/Or72jk4FKCsbacSDUJ1ysea', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-16 12:41:25', '2022-01-16 12:41:25'),
(12, 'Thristan', 'Wayne', 'instructor4', 'wayne@gmail.com', 'Male', '1993-09-16', '09064351157', 'Cagayan de Oro City', '$2y$10$Qg9EaSCtmZTbHzD9pneud.lEYg2Yd5/M/QzSBB0GFE8aB4X99Lbx.', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-16 12:59:04', '2022-01-16 12:59:04'),
(13, 'Samantha', 'Hernandez', 'student4', 'samantha@gmail.com', 'Female', '1996-04-17', '09871652349', 'Cagayan de Oro City', '$2y$10$dkkViDovi0t4xQlyv21W.eh/lo1eW2imNbhnKFbNwVrMMQU7D7St.', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-16 13:00:32', '2022-01-17 00:30:36'),
(14, 'Francisco', 'Pandan', 'junpandan', 'jun_pandan2000@yahoo.com', 'Male', '1968-10-16', '09173087970', 'Lumbia, Cagayan de Oro City', '$2y$10$a2U6nk1/bGhCbXdv6JKcKeF/v1Ri7zAK.UKbhCSoTnkZhHhcqKwa.', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, 'mNYqjXrXMIE6RR3Gbeum65dOEVB9U9IlZpFoALI7RQ8K2Wv815TsYIyFrOft', '2022-01-21 07:35:31', '2022-01-21 07:35:31'),
(15, 'Cris benjard', 'Golinsao', 'benjard', 'jardbencris@gmail.com', 'Male', '1992-12-20', '09351986933', 'Talakag, Bukidnon', '$2y$10$Q8Zf7.ONJpsauQ7W9.hv1e.c9vLZ3K/QMJLTJEzb1c1Fv0RaaX9r6', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-21 07:39:41', '2022-01-21 14:34:19'),
(16, 'Trisha', 'Moon', 'student5', 'trish@gmail.com', 'Female', '1998-09-16', '09675220070', 'Cagayan de Oro City', '$2y$10$rvrutaueQVDyZ9/5FkOH1uwyWqLY3EeN8GYVvj5wdbin.RQn1fh5y', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-01-25 11:51:46', '2022-01-25 11:52:12'),
(17, 'Mia', 'Delos Santos', 'student6', 'student5@gmail.com', 'Female', '1997-09-05', '09782653491', 'Cagayan de Oro City', '$2y$10$UVXK3DD3JX29bKdWu6ZES.ocaNhtjkyYN8bFQegMEewEts2eprf1W', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-02 02:23:37', '2022-02-02 02:23:56'),
(18, 'Reyn', 'May', 'Student7', 'reynmay@gmail.com', 'Female', '1998-02-03', '09686624939', 'Cagayan de Oro City', '$2y$10$ECX1syxgAgFjjrTTCt4NTeA8XhrEWrutoiusa/Bsvu05pE/Tqu65y', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-03 01:53:44', '2022-02-03 02:05:38'),
(19, 'Kia', 'Venice', 'student8', 'kiavenice@gmail.com', 'Female', '1999-09-25', '09675702027', 'Cagayan de Oro City', '$2y$10$.UcjlO.v.LsOadjBdetOYe8eCkzgnqp1fziAjAfo53b0ICmFVCNma', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-03 16:47:19', '2022-02-03 16:51:08'),
(20, 'Karina', 'Monroe', 'student9', 'karinamonroe@gmail.com', 'Female', '1997-08-14', '+639872387872', 'Cagayan de Oro City', '$2y$10$uuw4lbXd9efJyQzsmnftcO5hhxuyg.Yo7Epsq2Ru/mcIONbbLVvyW', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-03 18:09:05', '2022-02-04 07:22:16'),
(21, 'Anthony', 'Tismo', 'anthonytismo', 'anthonytismo2@gmail.com', 'Male', '1999-06-21', '09264351157', 'Cagayan de Oro City', '$2y$10$x.wi.Oi7Rsx0OSPZgRcH8uKEcUbwtuxYHq2bLx/VR9fPJ0lx5Us2.', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, 'BK9yLuTwKo8ZdPoNkX2gtyIwO6kc9HF7XXljLZSAXwU0mSdkAU6wZLsC5rYr', '2022-02-08 18:29:45', '2022-06-14 12:54:50'),
(22, 'Joel Roy', 'Cambal', 'cambal', 'joel_Roy@gmail.com', 'Male', '1999-11-18', '09263782973', 'Paranaque', '$2y$10$fghyyaPAai3j5XZW02QUTuOPeyqKwPsH5QCcpvMjuNaSExwoZU.RW', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-08 18:32:08', '2022-02-08 18:32:08'),
(23, 'Maria', 'Bucag', 'yangbucag', 'mariabucagduhaylungsod@gmail.com', 'Female', '1995-12-28', '09269654320', 'Cagayan de Oro City', '$2y$10$MIjSL/XFNPGWlAfATUhMM.ld3iCuF9DEnjas1W2uji1IByh6Fm47G', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-08 18:36:41', '2022-02-08 18:36:41'),
(24, 'Albert Lloyd', 'Tismo', 'albert', 'albertlloydtismo@gmail.com', 'Male', '2005-12-09', '09682983748', 'Cagayan de Oro City', '$2y$10$yioDIhaqfILDJo.clGNLxe/KvO/zHhD05o2qBt.4.MErednqT0bJO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-08 18:40:33', '2022-02-10 06:51:02'),
(25, 'Andrea May', 'Santos', 'may_andrea', 'andrea23@gmail.com', 'Female', '1999-08-26', '09065382732', 'Cagayan de Oro City', '$2y$10$.oCMyhj61HyCwSf31wmLKeCdJW5WW.o6XG2YEITEOB2nWKzKVlMsm', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-08 18:47:57', '2022-02-08 18:47:57'),
(26, 'Aaron Joshua', 'Quipanes', 'AaronQuipanes', 'aaronjoshuaq@gmail.com', 'Male', '1999-11-09', '09751450769', '8th st. Nazareth CDO', '$2y$10$zN1ruSyC/n7HW8p6KacnbOb0xBtBAHTlWUQ9W2lH0C7jdy.fdL/B6', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-10 06:37:16', '2022-02-10 06:37:16'),
(27, 'Reneelyn', 'Duhaylungsod', 'renren12', 'renren@gmail.com', 'Female', '2000-06-15', '09783625384', 'Cagayan de Oro City', '$2y$10$MIPTIXotO4UOjxwLzV1HDu5xMiq2uzwYeGh8wxVnpkGPNpZchQjlW', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-10 08:16:25', '2022-02-10 08:17:00'),
(28, 'Angela', 'Kim', 'angela', 'angela@gmail.com', 'Female', '1995-08-17', '09872635472', 'Cagayan de Oro City', '$2y$10$OUihduCABi/6O49otymPYOoFrxqtkvWQXlwDNp.ZIv6d5j57il3vq', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2022-02-10 09:10:33', '2022-02-10 09:10:33'),
(29, 'Trisha', 'Leyn', 'trisha', 'trisha@gmail.com', 'Female', '1998-09-16', '09264351157', 'Cagayan de Oro City', '$2y$10$1RleNp1nR/jMV05zv10BrO7tL9soT7mdyrSRH.f2MWNl2suqPtaH2', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-22 15:32:48', '2022-05-22 15:32:48'),
(30, 'xcvx', 'xcvx', 'student10', 'weq@gmail.com', 'Female', '1998-09-07', '+639687356483', 'Cagayan de Oro City', '$2y$10$7bNbRu8LW3JTdcniOU5KheAE6JDCpsTciYuj2VqMx77EzgkD.YSCO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-22 15:35:29', '2022-05-22 15:35:29'),
(31, 'Honey', 'May', 'Student11', 'honey@gmail.com', 'Female', '1998-05-22', '09827483828', 'Cagayan de Oro City', '$2y$10$6gkVg7QJleL0L29VtOhD3.o/f9/sXcRgMwosGudiY8eG79kFj4rqW', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-22 15:51:12', '2022-05-22 15:51:12'),
(32, 'jap', 'pan', 'japan@gmail.com', 'japan@gmail.com', 'Male', '1993-01-14', '09265321825', 'Buru-un', '$2y$10$OSkRYf1RayttfOYsoJIIDu6WRu1d1KY9ZElZ.AdrN4aUEjPH5QI46', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-29 13:07:56', '2022-05-29 13:07:56'),
(51, 'US', 'A', 'usa@gmail.com', 'usa@gmail.com', 'Male', '1993-01-22', '09265321825', 'Buru-un', '$2y$10$YXV2k5.vpWnbjiFpKsuuWeCc8Lz9AD8NK0K9tIbODQA5bwCmG0XuS', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-29 15:23:29', '2022-05-29 15:23:29'),
(52, 'U', 'N', 'un@gmail.com', 'un@gmail.com', 'Male', '1997-01-29', '09265321825', 'Buru-un', '$2y$10$/R3pBjf1VN8w/klD6a7CvO9z6CYpG6IeTzgAFyjdADa47goJMi72e', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-29 15:44:28', '2022-05-29 15:44:28'),
(75, 'dsa', 'dasd', 'dsa', 'dsa@gmail.com', 'Male', '1995-12-31', '09265321825', 'Buru-un', '$2y$10$It2R1tM.q5iGGxV35ZKYK.0Ah/GskWFJDrvtaykl4UfGlb67qXAfq', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-31 06:13:45', '2022-05-31 06:13:45'),
(76, 'raf', 'fe', 'raf123', 'raf@gmail.com', 'Female', '1998-12-02', '09265321825', 'Buru-un', '$2y$10$m1JVcp5gGt2IPtnvrqpT3OT4fu/wuhNgsYgb.NAt6.BEK4C7qcc02', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-05-31 06:15:51', '2022-05-31 06:15:51'),
(79, 'Kian', 'James', 'student12', 'student12@gmail.com', 'Male', '2000-07-14', '09782653811', 'Cagayan de Oro City', '$2y$10$cNO6MsF1HjuDtajRKQ1e1.iQxj1u0V67hkbLM7WidWOVYYWjXkuDq', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-09 05:54:13', '2022-06-09 05:54:13'),
(80, 'laevad', 'laevad', 'djaldave', 'djaldave@gmail.com', 'Male', '1999-10-21', '09365622282', 'add', '$2y$10$njlOoTFVj0vCUPjD7UNqROTJCJtcC8woo8Kd.yzP0CoXSpDcCVt4G', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, '2b1Fs2wYb3LJFC0ahFuUHegi2OtdIS1M0vzCm1GP5xc7TBrOspLNBEtmGBh0', '2022-06-12 03:20:42', '2022-06-14 06:02:15'),
(81, 'Casey', 'Ageas', 'CaseyAgeas', 'caseyageas11@gmail.com', 'Female', '2000-01-10', '(+63) 9058936645', 'Barra,Opol', '$2y$10$ucKIIWi88gWl.lD3kXMvR.2Wa5WxK8KSyQWU4ndFxE9qG0Qjic2uu', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-13 11:28:03', '2022-06-13 11:28:03'),
(82, 'KC', 'Ageas', 'KC99', 'brittania99ryuk@gmail.com', 'Female', '1997-06-09', '09761052079', 'Barra, Opol', '$2y$10$YHxB0iRU5UP.0x7J9lhdnuSkT9ndsQEQDZh/uzco6oku256fdD3HS', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-13 11:44:46', '2022-06-13 11:44:47'),
(83, 'Kay', 'Cee', 'KayCee', 'BryantK0220@gmail.com', 'Female', '2000-02-14', '09776448010', 'CDO', '$2y$10$bgO5SqJID19a2QTIDPGfke54/M4o/h3uwsswjER12Ws2BrKdENbPi', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-13 12:34:41', '2022-06-13 12:34:41'),
(84, 'Cassy', 'Ageas', 'Cee', 'kayxcee99@gmail.com', 'Female', '1990-08-22', '09150187319', 'CDO', '$2y$10$3RrmZ7UjHUdlZHQskLiJ4eSFDd9SSM14Q9tv7XCzK/ENeyU58/blC', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-13 12:41:46', '2022-06-13 12:41:46'),
(85, 'testing', 'user', 'davidking', 'aldavegwapro@gmail.com', 'Male', '1999-10-27', '09365622282', 'user', '$2y$10$mDxHTAscRMSUC7/G3EX5XOB5LMk/pRbzRNgAWFj/AF4bR6sxiTUHu', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 01:11:38', '2022-06-14 01:11:38'),
(86, 'first test', 'last test', 'Aaron', 'test@12.1', 'Female', '1999-11-02', '09365622282', 'cdo', '$2y$10$a83Mt2mPBx2ohpjPDYJtSefRmlHu500a/D9Apq1bTjBlk54C9fhoC', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 01:41:02', '2022-06-19 03:46:34'),
(87, 'Jaycel', 'Elloren', 'JaycelElloren', 'jaycelelloren@gmail.com', 'Female', '1999-01-28', '09675702028', 'Talisayan', '$2y$10$P4OnyrHCxx8pxu2raxGyiuopl528pRHJjx8EnXpgryjdNLiqm7SrW', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 01:42:17', '2022-06-14 01:42:17'),
(88, 'Tracker', 'Chou', 'Chou', 'oswaldquipanes@yahoo.com', 'Male', '1988-06-19', '09552614901', 'Nevermore', '$2y$10$Z1OtqwQAhv0eal/6IkCyzOhD1mWVdmUTCxll577.5uLAjUg0WDxnG', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 01:55:35', '2022-06-14 01:55:35'),
(89, 'Tiger', 'Energy', 'Tiger', 'Tiger.energy@gmail.com', 'Male', '1985-01-01', '09758486865', 'Nameless Kingdom', '$2y$10$NMrhaGIYbfqBgyhpE4NQmeV1vIeSOTTutX.N7GW.Ep3RpX3Ux7DLO', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 03:43:25', '2022-06-14 03:43:25'),
(90, 'dave', 'dave', 'user1', '1@1.1', 'Male', '1999-10-27', '09365622282', 'dave', '$2y$10$oRr93.izQM0i5y2PLLs6cuTMb4ZMt4dFkEfldIdynV.tybOG09tPW', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 06:05:13', '2022-06-14 06:05:13'),
(91, 'Stuart', 'Cortez', 'staff01', 'hamavuxi@mailinator.com', 'Male', '1990-11-23', '09365622282', 'Quidem et qui alias', '$2y$10$gKjDqEETlh8Lx7ftRQKnwu/7joC6gEZZ/1/Shx9auvePPC7qIpKEO', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 17:12:14', '2022-06-14 17:12:14'),
(92, 'Rose', 'Britt', 'staff02', 'fovicowyvu@mailinator.com', 'Female', '2005-10-24', '09365622282', 'Magnam id omnis even', '$2y$10$ulIq1jCuY/W2SE9j62gY0O1RW1GuYlZC2QxTC2nAF9fo3IsXvGItm', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-14 17:14:21', '2022-06-14 17:14:21'),
(93, 'dave', 'Hewitt', 'user-0', 'bofem@mailinator.com', 'Male', '1999-10-27', '+1 (106) 284-2148', 'Anim aut quo aliquam', '$2y$10$3uMP2TddPD1oHC1CMk5L4erq8J4dNEiF6P4qc/O/C5U94K.8PKTg.', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-15 00:15:03', '2022-06-15 00:15:03'),
(94, 'Ren', 'Jen', 'renjen', 'duhaylungsod.reneelyn@gmail.com', 'Female', '2000-12-08', '09066624939', 'Cdo', '$2y$10$sepsqIzdiSsb3YD9hLt9C.XlpS5J.TBJlNPFqZoPRaefPk/lsFUke', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-16 08:20:25', '2022-06-16 08:20:25'),
(95, 'Jc Vanny Mill', 'Saledaien', 'jcvannymill', 'jcvannymill.saledaien@ustp.edu.ph', 'Female', '1994-01-11', '09176770112', 'Zone 3, Quirino St., Agusan, CDO', '$2y$10$/R0llbm4Vci1i5aAmLt1SuCrjBunBuXQSar8y3VN7dXhOr2mKLuBO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-16 08:22:36', '2022-06-16 08:22:36'),
(96, 'Jc Vanny Mill', 'Saledaien', 'jcvannymills', 'jc.saledaien@metaview.bike', 'Female', '1994-01-11', '09176770112', 'Zone 3, Quirino St., Agusan, CDO', '$2y$10$y9vNBvL/maKwWupXOHzP6u7U7nYIpL4RzCs8CaN2CxFFI1ifVYpYu', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-16 09:05:39', '2022-06-16 09:05:39'),
(97, 'Juan', 'De la Cruz', 'juandelacruz', 'van.saledaien@gmail.com', 'Female', '1996-12-07', '09358792719', 'Cdo', '$2y$10$If4rO0z9B9CA7FWxXaDL5.v98HgWlgGPffyFttHXjeJnQuLHUx.du', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-16 09:30:20', '2022-06-18 23:59:01'),
(98, 'Ferdinand', 'Love', 'puser4', 'nyroguxuqa@mailinator.com', 'Female', '2016-01-16', '+1 (226) 794-6136', 'Omnis et magni lorem', '$2y$10$UM5BcvPZj8qXzII2RkFt4.wb1kblrBT9fJxDmv2959mnUAQjpexXa', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-17 15:48:03', '2022-06-17 15:48:03'),
(99, 'Bertha', 'Rhodes', 'suser', 'huhiwe@mailinator.com', 'Female', '1990-01-12', '+1 (761) 634-4832', 'Cupidatat vero aut q', '$2y$10$ZVt13L/ZAjGCstmDhKzDPuxoPr.AntlrkwpIqT0HUlVZCm3ozNZCS', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-17 15:56:27', '2022-06-17 15:56:27'),
(100, 'Graiden', 'Castaneda', 'sajag', 'lafocypej@mailinator.com', 'Male', '1982-12-18', '+1 (399) 349-7107', 'Aspernatur ipsum mo', '$2y$10$8rPa0BmREOO3AVE5TAC3QebKHpSGo8UNr.mhSo8fRSoZ74zdk3v8K', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-18 21:38:44', '2022-06-18 21:38:44'),
(101, 'Keaton', 'Alston', 'testing0', 'jipeseno@mailinator.com', 'Female', '2008-03-05', '+1 (921) 343-6521', 'Rerum do doloremque', '$2y$10$fo/GcaMmJMdNBxxTGguuWu6MAM5b/2puobqwAXdKagREPIbgmbZjy', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-18 21:39:07', '2022-06-18 23:19:15'),
(102, 'Idona', 'Ayala', 'mavob', 'hygoc@mailinator.com', 'Female', '1999-05-11', '+1 (852) 987-3975', 'Aut est sunt quidem', '$2y$10$jGo9I0HZ.QodZuQz1nwMoeRPQyQd9sC6HeanUq1tp0nTUL7u3qSeO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-19 15:02:51', '2022-06-19 15:02:51'),
(103, 'Abra', 'Mcneil', 'test0', 'sicufuke@mailinator.com', 'Female', '1976-09-24', '+1 (945) 854-4542', 'Ea quis quo eos odi', '$2y$10$Gx2Gn7v0lZbiyvmT0UGY3.OXneKzsArbpfdVafA/X89ZUw25vhONW', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-19 15:24:22', '2022-06-27 17:54:32'),
(104, 'Tatum', 'Reyes', 'test1', 'xona@mailinator.com', 'Male', '2016-04-09', '+1 (503) 908-2646', 'Commodi mollitia est', '$2y$10$Ca0qTDjH2rfAS/VXe9StteoCRmTS9wymquESpynqrS4wCSLOExE5i', 'unknown', 'Instructor', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-19 16:07:38', '2022-06-19 16:07:38'),
(105, 'Arthur', 'Montgomery', 'test2', 'mifumufa@mailinator.com', 'Male', '2015-08-23', '+1 (977) 123-3349', 'Harum accusamus ea f', '$2y$10$iTX4ObsY6u6Dsm7Go26yuOtIisb19NRUeBbya2Vbg7OOYYI4URJFi', 'unknown', 'Staff', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-19 20:25:33', '2022-06-19 20:25:33'),
(106, 'Rama', 'Wilkins', 'test0_0', 'xaqofi@mailinator.com', 'Male', '1976-04-15', '+1 (271) 678-3903', 'Voluptate et officia', '$2y$10$KdNEyBqufRjC9.BEA73aMOt8YJMf004knfKchKkev3COPw3k2ewRe', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-20 04:48:18', '2022-06-20 04:48:18'),
(107, 'Brynn', 'Nguyen', 'q1', 'lycygyka@mailinator.com', 'Male', '1993-03-07', '+1 (245) 933-3038', 'Commodi eu ut illo m', '$2y$10$we.GLqVNfsoUigtbJxlOEeXAGB4d6Rjz/tVVjbWA3TA0Qc7pYiMbe', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 05:09:13', '2022-06-21 05:11:06'),
(108, 'Ruby', 'Suarez', 'q2', 'venyma@mailinator.com', 'Male', '1993-07-31', '+1 (376) 364-8318', 'Qui officia laborum', '$2y$10$9pqqKf3Kc5mcwWMiTbE1AOFUow5N6bg/Pk1akjVQ4HhBnhcO9yLIK', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 05:22:42', '2022-06-21 05:22:42'),
(109, 'Sasha', 'Haley', 'cyducamuke', 'licaneb@mailinator.com', 'Male', '2015-12-28', '+1 (995) 358-3362', 'Ad unde dignissimos', '$2y$10$0fi1SeXaTe2GeBSagvJZPu/JuWvfxWt/7q.guFBhehezTahN7le2G', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 10:05:19', '2022-06-21 10:05:19'),
(110, 'Raven', 'Hancock', 'q4', 'dihate@mailinator.com', 'Male', '1989-01-21', '+1 (417) 813-8884', 'Ratione quis dolores', '$2y$10$8D.F8dTR5dW6zmKaLyjN8uztU3AE8CfrahOku/iJMEsSDm5ET2Wda', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 10:05:38', '2022-06-21 10:05:38'),
(111, 'Amir', 'Dotson', 'a1', 'rysese@mailinator.com', 'Male', '1994-12-10', '+1 (313) 714-1046', 'Accusamus nihil mole', '$2y$10$q3bpNrAX9K0qnfKj6pm9ouGMdwne61yMl8qJJBy32A8JM.UYg7upa', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 14:46:33', '2022-06-21 14:51:21'),
(112, 'Alyssa', 'Nash', 'a2', 'nibekil@mailinator.com', 'Male', '1985-09-08', '+1 (805) 949-8752', 'Ullamco labore volup', '$2y$10$3Pz2.WJE0s.xwLzLGO1/NehFD6GpOmB.X.fEXXBpYpWAwdqEYRpAC', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 15:10:14', '2022-06-21 15:10:14'),
(113, 'Oscar', 'Beck', 'b0', 'fujowyme@mailinator.com', 'Female', '1970-06-14', '+1 (579) 163-4834', 'Maiores rerum fuga', '$2y$10$Au0GplXmZgYSubpE4DIH0.JN6LzOeSyRVXGaVsBXHvNh/TQavHEZa', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 15:19:11', '2022-06-21 15:19:11'),
(114, 'Teegan', 'Patton', 'b1', 'suwece@mailinator.com', 'Female', '2003-12-24', '+1 (469) 965-4828', 'Sunt aut Nam magni N', '$2y$10$7K7pedg1OB2qZmoc4BE.0.WVmXw/XZ2HpMfP4H1WFWPENIoG2FNSG', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 15:23:05', '2022-06-21 15:23:05'),
(115, 'Larissa', 'Crane', 'c1', 'kuro@mailinator.com', 'Male', '1989-05-04', '+1 (653) 306-9575', 'Aut veniam dolore v', '$2y$10$48xet4DASE.4jFaOmOTfCO/jkMNGr27b8Z0bigLg78IZ8TFtVWlWK', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 15:47:23', '2022-06-21 15:47:34'),
(116, 'Shaine', 'Compton', 'v1', 'mahegaxo@mailinator.com', 'Female', '1976-12-08', '+1 (365) 618-6146', 'Possimus numquam no', '$2y$10$qW/GgKQyWZ09JxfC9axTuejfQYxbTBhdGbo00RsL1UA/d6j/54Fc.', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 16:23:53', '2022-06-21 16:24:04'),
(117, 'Denise', 'Fernandez', 's123', 'tovifyhup@mailinator.com', 'Male', '1999-05-11', '+1 (765) 553-5494', 'Ut non consequatur i', '$2y$10$ikW6bNQ6xTyTlYwBQcvioOyn.4RfU40n7Ktm7vMHdDIZqPZBJ7WBm', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 16:57:39', '2022-06-21 17:09:40'),
(118, 'Conan', 'Flores', 'as1', 'cyhyn@mailinator.com', 'Male', '1980-02-21', '+1 (654) 818-8655', 'Vitae maiores porro', '$2y$10$Rl0eTu1/ZLTGz0TTIq4RRu.1oyRt2bj1aAdrW3BOWZ96TCunA0q5S', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 17:46:58', '2022-06-21 17:50:43'),
(119, 'Graham', 'Henson', 'as2', 'lisuki@mailinator.com', 'Female', '2015-05-02', '+1 (142) 559-8067', 'Eos ea ducimus magn', '$2y$10$peoJJFvsd/c7K9kA6.2dSuYSLSzFS6jyPY.4/Ex/txioW.XrLYhNC', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 18:09:46', '2022-06-21 18:21:17'),
(120, 'Theodore', 'Navarro', 'as3', 'sukesuk@mailinator.com', 'Female', '1978-10-25', '+1 (616) 404-6004', 'Sequi doloribus culp', '$2y$10$Jyy4DV9Ohi8rL4w3TxY.pO8xgyfrcSlPQp87tUR1a48dtMt2wUu0e', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 19:21:07', '2022-06-21 19:33:48'),
(121, 'Kenyon', 'Hansen', 'as4', 'soladum@mailinator.com', 'Female', '1999-08-01', '+1 (671) 502-6822', 'In praesentium culpa', '$2y$10$29n5l/zQBSrBkk5.3KWDYelIZ57a042K3CImidFPh.2ek3oJU2b4S', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 19:34:33', '2022-06-21 19:55:13'),
(122, 'Nevada', 'Donaldson', 'as5', 'vivyde@mailinator.com', 'Female', '2013-03-26', '+1 (482) 775-1536', 'Minima provident di', '$2y$10$tBabCwlSQbrAFltirneO8uZw7vtBOV.ruCL25.nJGUYT/BdCyByRS', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 19:56:56', '2022-06-21 19:58:30'),
(123, 'Bethany', 'Lopez', 'as6', 'kirom@mailinator.com', 'Male', '1978-10-17', '+1 (689) 629-4495', 'Dolore in dolores au', '$2y$10$uZG8FZlAnrAO4UHcbkAJ7uJA4DC8GuSWsVYGyADGmFRynbyqauLIi', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 19:58:55', '2022-06-21 20:02:42'),
(124, 'Channing', 'Morgan', 'aw1', 'gefyge@mailinator.com', 'Male', '1992-03-02', '+1 (909) 934-1851', 'Occaecat est in eni', '$2y$10$Tfkdlx3uC4Q2xY3Kuhn.jO1HZbwzK4KK4JGluDt/NaTSEstOAyWfO', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-21 20:03:10', '2022-06-21 20:09:20'),
(125, 'Beau', 'Floyd', 'ds123', 'fusikib@mailinator.com', 'Female', '1989-11-01', '+1 (865) 524-1098', 'Necessitatibus alias', '$2y$10$q2UVYuA8u2CsBZeoCCPotOedSVe2t11pIvo2ELkSppk1JQ6ou/ORC', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-21 23:47:57', '2022-06-21 23:48:51'),
(126, 'Elizabeth', 'Mathis', 'x1', 'soka@mailinator.com', 'Female', '1976-11-02', '+1 (977) 103-4353', 'Aliquip quia similiq', '$2y$10$dVRlX3ySUw3qLwSTkY1EMu2LN56YisJrXT4EkhbFCDCLVNe26hAgK', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-24 21:35:31', '2022-06-24 21:36:21'),
(127, 'Julie', 'Patrick', 'x2', 'ryhehehi@mailinator.com', 'Female', '2001-07-16', '+1 (254) 333-4286', 'Dolor aliqua Sed ul', '$2y$10$cbMJbSlqrZdynb88k8yoLehZ4Cm1SnDF91TkfGds2p4QB9jI7Aq0K', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-24 21:37:30', '2022-06-24 21:38:07'),
(128, 'Amy', 'Olson', 'x3', 'degevuqa@mailinator.com', 'Female', '1996-08-22', '+1 (969) 644-6693', 'In vel qui cupiditat', '$2y$10$I8SKpP2hFaqSySQBpqn3buDFh4iYH//8pv7usuXli9zAstXjvTPCS', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-26 07:03:15', '2022-06-26 07:06:16'),
(129, 'Kerry', 'Quinn', 'x4', 'kuzuz@mailinator.com', 'Male', '1973-07-24', '+1 (462) 779-4277', 'Accusamus omnis quo', '$2y$10$b6VdOyTAMXVpTLbaB8XQvOQyy3hL4NFGWJSHuJb/fm3D69BnzKILe', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-26 17:31:45', '2022-06-26 17:32:42'),
(130, 'Alfonso', 'Wilkinson', 'zx1', 'negu@mailinator.com', 'Male', '2008-09-16', '+1 (677) 658-9109', 'Error et veniam sap', '$2y$10$MhV.UcJcNVKw5df3hGmHheIfzT7mY6nTzOSXs7.PHnNfqpyXoJ9h6', 'unknown', 'Student', 'unknown', NULL, 'Active', NULL, NULL, '2022-06-27 11:50:41', '2022-06-27 11:50:41'),
(131, 'Genevieve', 'Hester', 'xz1', 'betak@mailinator.com', 'Male', '1993-06-21', '+1 (843) 702-6293', 'Illum sed est aut a', '$2y$10$TRyuRHK33l25OdbWg8Nh.uw3X3/ND7fdIHVgwGk0eCC5FbFHsSJk6', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-27 11:53:40', '2022-06-27 11:56:47'),
(132, 'Uma', 'Marshall', 'xz2', 'kerusik@mailinator.com', 'Female', '1972-11-06', '+1 (473) 166-9545', 'Laboriosam ut autem', '$2y$10$GBVhGUGyZ8XgPSC0VUJMGuhYztn9qEcmRcVyBfGcbOgIqIAiUxqbG', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-27 12:31:39', '2022-06-27 12:32:00'),
(133, 'Sierra', 'Hicks', 'xz3', 'jivysu@mailinator.com', 'Male', '2010-02-22', '+1 (738) 253-7594', 'Odit ipsum et quo es', '$2y$10$yC9/b9pj60i0tWf5TtP3f.ylE6VyTxXnf44nm.cNEj1NWXPzoxPcC', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-27 12:51:34', '2022-06-27 13:00:10'),
(134, 'Christian', 'Fitzpatrick', 'xz4', 'lufa@mailinator.com', 'Female', '1993-03-08', '+1 (364) 646-4852', 'Nulla necessitatibus', '$2y$10$q/iIJIkIYrrRYvhtRs6Cp.wedVOki6Frwsv1hLzx8e.AI8iLYGEVu', 'unknown', 'Student', 'unknown', 1, 'Active', NULL, NULL, '2022-06-27 13:43:33', '2022-06-27 13:52:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_email_unique` (`email`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communications`
--
ALTER TABLE `communications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communication_user_school_branches`
--
ALTER TABLE `communication_user_school_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_enrolled`
--
ALTER TABLE `courses_enrolled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fleet`
--
ALTER TABLE `fleet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fleet_schedules`
--
ALTER TABLE `fleet_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_user_id_index` (`user_id`),
  ADD KEY `images_course_id_index` (`course_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_practicals`
--
ALTER TABLE `invoice_practicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_email_unique` (`email`);

--
-- Indexes for table `school_course`
--
ALTER TABLE `school_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_gateways`
--
ALTER TABLE `sms_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `communications`
--
ALTER TABLE `communications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `communication_user_school_branches`
--
ALTER TABLE `communication_user_school_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses_enrolled`
--
ALTER TABLE `courses_enrolled`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_instructor`
--
ALTER TABLE `course_instructor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fleet`
--
ALTER TABLE `fleet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fleet_schedules`
--
ALTER TABLE `fleet_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_practicals`
--
ALTER TABLE `invoice_practicals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_course`
--
ALTER TABLE `school_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `sms_gateways`
--
ALTER TABLE `sms_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
