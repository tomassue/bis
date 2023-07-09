-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 05:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter`
--

CREATE TABLE `tblblotter` (
  `id_blotter` int(11) NOT NULL,
  `noc_id` varchar(100) DEFAULT NULL,
  `noc_others` varchar(100) DEFAULT 'N/A',
  `comp_id` varchar(10) DEFAULT 'N/A',
  `comp_nameNotResident` varchar(255) DEFAULT 'N/A',
  `comp_addNotResident` varchar(255) DEFAULT 'N/A',
  `comp_cnumNotResident` varchar(255) DEFAULT 'N/A',
  `comp_what` text DEFAULT NULL,
  `comp_what2` text DEFAULT NULL,
  `resp_id` varchar(255) DEFAULT NULL,
  `blotter_status` varchar(50) DEFAULT 'Active',
  `created_at_blotter` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_blotter` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblblotter`
--

INSERT INTO `tblblotter` (`id_blotter`, `noc_id`, `noc_others`, `comp_id`, `comp_nameNotResident`, `comp_addNotResident`, `comp_cnumNotResident`, `comp_what`, `comp_what2`, `resp_id`, `blotter_status`, `created_at_blotter`, `updated_at_blotter`, `id_user`) VALUES
(8, '1', 'N/A', '1', 'N/A', 'N/A', 'N/A', 'try', 'try', '2', 'Forwarded to Lupon', '2023-04-22 07:59:25', '2023-05-05 16:17:00', '11'),
(9, 'Others', 'Testing Again', 'N/A', 'Shinobu', 'Zone 5 Upper, Iponan, CDO', '09094568876', 'try', 'try', '3', 'Forwarded to Lupon', '2023-04-22 08:00:39', '2023-05-05 15:51:52', '11'),
(10, '1', 'N/A', 'N/A', 'Muzan Kibutsuji', 'Swordsmith Village', '09097786675', 'wdefrew', 'fewfwe', '5', 'Settled', '2023-04-22 10:18:34', '2023-05-05 16:53:07', '11'),
(12, '1', 'N/A', '4', 'N/A', 'N/A', 'N/A', 'tryyytrdy', 'rtysysthstr', '10', 'Settled', '2023-05-05 07:18:54', '2023-05-07 08:18:12', '11'),
(13, '2', 'N/A', 'N/A', 'Tokito', 'Tokito', '09098764748', 'try', 'try', '10', 'Settled', '2023-05-05 07:26:15', '2023-05-07 08:18:07', '11'),
(14, 'Others', 'Sample', 'N/A', 'Shinobu', 'Swordsmith Village', '09098764748', 'fefefeter', 'ewgregreger', '1', 'Settled', '2023-05-06 01:04:47', '2023-05-06 01:09:47', '11'),
(15, 'Others', 'Sample', '16', 'N/A', 'N/A', 'N/A', 'Sample here', 'Sample here again...', '11', 'Active', '2023-06-08 09:46:10', '2023-06-08 09:46:10', '11');

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter_schedule`
--

CREATE TABLE `tblblotter_schedule` (
  `id_blotter_schedule` int(11) NOT NULL,
  `id_blotter` int(11) NOT NULL,
  `blotter_date` date NOT NULL,
  `blotter_time` time NOT NULL,
  `created_at_blotter_schedule` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_blotter_schedule` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblblotter_schedule`
--

INSERT INTO `tblblotter_schedule` (`id_blotter_schedule`, `id_blotter`, `blotter_date`, `blotter_time`, `created_at_blotter_schedule`, `updated_at_blotter_schedule`) VALUES
(29, 10, '2023-04-22', '14:20:00', '2023-04-22 10:18:34', '2023-04-22 10:18:34'),
(43, 9, '2023-04-22', '13:31:00', '2023-05-05 08:05:16', '2023-05-05 08:05:16'),
(48, 8, '2023-05-03', '13:30:00', '2023-05-05 08:33:59', '2023-05-05 08:33:59'),
(54, 13, '2023-05-05', '13:33:00', '2023-05-05 15:40:57', '2023-05-05 15:40:57'),
(56, 12, '2023-05-06', '13:33:00', '2023-05-05 16:53:52', '2023-05-05 16:53:52'),
(57, 14, '2023-05-06', '09:30:00', '2023-05-06 01:04:47', '2023-05-06 01:04:47'),
(59, 15, '2023-06-10', '10:00:00', '2023-06-08 09:46:52', '2023-06-08 09:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter_schedule_archive`
--

CREATE TABLE `tblblotter_schedule_archive` (
  `id_blotter_schedule_archive` int(11) NOT NULL,
  `id_blotter` int(11) NOT NULL,
  `archive_blotter_date` date NOT NULL,
  `archive_blotter_time` time NOT NULL,
  `created_at_blotter_schedule_archive` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at_blotter_schedule_archive` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at_blotter_schedule` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblblotter_schedule_archive`
--

INSERT INTO `tblblotter_schedule_archive` (`id_blotter_schedule_archive`, `id_blotter`, `archive_blotter_date`, `archive_blotter_time`, `created_at_blotter_schedule_archive`, `updated_at_blotter_schedule_archive`, `created_at_blotter_schedule`) VALUES
(3, 8, '2023-04-22', '12:00:00', '2023-04-22 07:59:25', '2023-04-22 07:59:25', '2023-04-27 08:40:51'),
(4, 8, '2023-04-22', '13:00:00', '2023-04-22 07:59:35', '2023-04-22 07:59:35', '2023-04-27 08:40:51'),
(5, 9, '2023-04-22', '12:00:00', '2023-04-22 08:00:39', '2023-04-22 08:00:39', '2023-04-27 08:40:51'),
(6, 9, '2023-04-22', '12:30:00', '2023-04-22 08:01:37', '2023-04-22 08:01:37', '2023-04-27 08:40:51'),
(7, 8, '2023-04-22', '13:30:00', '2023-04-22 07:59:56', '2023-04-22 07:59:56', '2023-04-27 08:40:51'),
(8, 8, '2023-04-22', '12:30:00', '2023-04-22 08:13:05', '2023-04-22 08:13:05', '2023-04-27 08:40:51'),
(9, 8, '2023-04-23', '12:30:00', '2023-04-22 08:39:38', '2023-04-22 08:39:38', '2023-04-27 08:40:51'),
(10, 8, '2023-04-22', '12:30:00', '2023-04-22 08:40:19', '2023-04-22 08:40:19', '2023-04-27 08:40:51'),
(11, 9, '2023-04-22', '13:30:00', '2023-04-22 08:10:13', '2023-04-22 08:10:13', '2023-04-27 08:40:51'),
(12, 9, '2023-04-22', '12:30:00', '2023-04-22 09:13:37', '2023-04-22 09:13:37', '2023-04-27 08:40:51'),
(13, 8, '2023-04-22', '13:30:00', '2023-04-22 08:42:26', '2023-04-22 08:42:26', '2023-04-27 08:40:51'),
(14, 8, '2023-04-22', '13:20:00', '2023-04-22 10:19:48', '2023-04-22 10:19:48', '2023-04-27 08:40:51'),
(15, 8, '2023-04-22', '13:30:00', '2023-04-22 10:20:20', '2023-04-22 10:20:20', '2023-04-27 08:40:51'),
(16, 13, '2023-05-05', '18:30:00', '2023-05-05 07:26:15', '2023-05-05 07:26:15', '2023-05-05 07:26:56'),
(17, 12, '2023-05-05', '16:56:00', '2023-05-05 07:18:54', '2023-05-05 07:18:54', '2023-05-05 07:37:07'),
(18, 13, '2023-05-05', '13:30:00', '2023-05-05 07:26:56', '2023-05-05 07:26:56', '2023-05-05 07:40:56'),
(19, 13, '2023-05-05', '13:35:00', '2023-05-05 07:40:56', '2023-05-05 07:40:56', '2023-05-05 07:46:33'),
(20, 13, '2023-05-05', '13:30:00', '2023-05-05 07:46:33', '2023-05-05 07:46:33', '2023-05-05 07:47:26'),
(21, 8, '2023-05-03', '09:00:00', '2023-04-27 08:38:46', '2023-04-27 08:38:46', '2023-05-05 07:48:15'),
(22, 13, '2023-05-05', '13:36:00', '2023-05-05 07:47:26', '2023-05-05 07:47:26', '2023-05-05 07:56:52'),
(23, 9, '2023-04-22', '13:30:00', '2023-04-22 10:13:25', '2023-04-22 10:13:25', '2023-05-05 08:05:16'),
(24, 13, '2023-05-05', '13:30:00', '2023-05-05 07:56:52', '2023-05-05 07:56:52', '2023-05-05 08:08:08'),
(25, 8, '2023-05-03', '13:30:00', '2023-05-05 07:48:15', '2023-05-05 07:48:15', '2023-05-05 08:08:41'),
(26, 13, '2023-05-05', '13:31:00', '2023-05-05 08:08:08', '2023-05-05 08:08:08', '2023-05-05 08:11:00'),
(27, 13, '2023-05-05', '13:30:00', '2023-05-05 08:11:00', '2023-05-05 08:11:00', '2023-05-05 08:32:48'),
(28, 8, '2023-05-03', '13:31:00', '2023-05-05 08:08:41', '2023-05-05 08:08:41', '2023-05-05 08:33:59'),
(29, 12, '2023-05-05', '13:30:00', '2023-05-05 07:37:07', '2023-05-05 07:37:07', '2023-05-05 08:35:04'),
(30, 13, '2023-05-05', '13:31:00', '2023-05-05 08:32:48', '2023-05-05 08:32:48', '2023-05-05 08:42:08'),
(31, 12, '2023-05-05', '13:31:00', '2023-05-05 08:35:04', '2023-05-05 08:35:04', '2023-05-05 08:45:40'),
(32, 13, '2023-05-05', '13:32:00', '2023-05-05 08:42:08', '2023-05-05 08:42:08', '2023-05-05 15:31:53'),
(33, 12, '2023-05-05', '13:32:00', '2023-05-05 08:45:40', '2023-05-05 08:45:40', '2023-05-05 15:39:53'),
(34, 13, '2023-05-05', '13:32:00', '2023-05-05 15:31:53', '2023-05-05 15:31:53', '2023-05-05 15:40:57'),
(35, 12, '2023-05-05', '13:33:00', '2023-05-05 15:39:53', '2023-05-05 15:39:53', '2023-05-05 16:13:15'),
(36, 12, '2023-05-05', '13:33:00', '2023-05-05 16:13:15', '2023-05-05 16:13:15', '2023-05-05 16:53:52'),
(37, 15, '2023-06-10', '09:00:00', '2023-06-08 09:46:10', '2023-06-08 09:46:10', '2023-06-08 09:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrgy_info`
--

CREATE TABLE `tblbrgy_info` (
  `id_brgy_info` int(11) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `dashboard_text` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbrgy_info`
--

INSERT INTO `tblbrgy_info` (`id_brgy_info`, `province`, `town`, `brgy_name`, `contact_number`, `dashboard_text`, `image`, `city_logo`, `brgy_logo`) VALUES
(1, 'Misamis Oriental', 'Cagayan de Oro', 'Barangay 25', '09124434562', 'Land of something\r\n', '08012023200651IMG_5300.jpg', '28122022062802download.jpg', '28122022062802LOGO.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblchairmanship`
--

CREATE TABLE `tblchairmanship` (
  `id_chairmanship` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblchairmanship`
--

INSERT INTO `tblchairmanship` (`id_chairmanship`, `title`) VALUES
(1, 'Committee on Infrastructure'),
(2, 'Committee on Education'),
(3, 'Committee on Health'),
(4, 'Committee on Agriculture'),
(5, 'Committee on Finance'),
(6, 'Committee on Peace and Order'),
(7, 'Committee on Tourism and Sports'),
(8, 'Committee on Senior Citizen');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials`
--

CREATE TABLE `tblofficials` (
  `id_officials` int(11) NOT NULL,
  `honorifics` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `id_position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `archive` int(5) DEFAULT NULL COMMENT '0-NO; 1-YES;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficials`
--

INSERT INTO `tblofficials` (`id_officials`, `honorifics`, `name`, `id_position`, `termstart`, `termend`, `status`, `archive`) VALUES
(1, 'Hon.', 'Reuben U. Pacalioga', '1', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(2, 'Ms.', 'Venus N. Ahmee', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(3, 'Hon.', 'Noel S. Ilogon', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(4, 'Hon.', 'Renan Noel B. Ilogon', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(5, 'Hon.', 'Glenn T. Inesin', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(6, 'Hon.', 'Democrito D. Elevado', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(7, 'Hon.', 'Alvin P. Garrote', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(8, 'Hon.', 'Pedro C. Sacal', '3', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(9, 'Hon.', 'Rey M. Galla', '4', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(10, 'Ms.', 'Mirra G. Gabata', '5', '2023-04-28', '2024-04-28', 'Incumbent', 0),
(11, 'Ms.', 'Maricris O. Mabao', '2', '2023-04-28', '2024-04-28', 'Incumbent', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials_chairmanships`
--

CREATE TABLE `tblofficials_chairmanships` (
  `id_officials_chairmanship` int(11) NOT NULL,
  `id_officials` int(11) NOT NULL,
  `id_chairmanship` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblofficials_chairmanships`
--

INSERT INTO `tblofficials_chairmanships` (`id_officials_chairmanship`, `id_officials`, `id_chairmanship`) VALUES
(13, 2, 2),
(14, 2, 8),
(21, 5, 1),
(22, 5, 2),
(23, 5, 4),
(24, 6, 1),
(25, 6, 2),
(26, 6, 5),
(30, 8, 1),
(31, 8, 8),
(50, 3, 2),
(51, 3, 5),
(52, 12, 1),
(53, 9, 6),
(54, 4, 1),
(55, 4, 2),
(56, 4, 5),
(66, 7, 3),
(67, 7, 5),
(68, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id_payments` int(11) NOT NULL,
  `amounts` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id_payments`, `amounts`) VALUES
(1, 55.00),
(2, 1025.00),
(3, 50.00),
(4, 600.00),
(5, 75.00),
(6, 56.00),
(7, 56.00),
(8, 56.00),
(9, 60.00);

-- --------------------------------------------------------

--
-- Table structure for table `tblpermit`
--

CREATE TABLE `tblpermit` (
  `id_permit` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpermit`
--

INSERT INTO `tblpermit` (`id_permit`, `name`, `location`, `applied`, `id_user`) VALUES
(1, 'Milk Shake', 'Infinity Castle', '2023-02-13', '11'),
(2, 'Jaime P. Ramen', 'Zone 06', '2023-03-17', '11'),
(3, 'Shinobu', 'Zone 07', '2023-05-05', '11');

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE `tblposition` (
  `id_position` int(11) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`id_position`, `position`, `order`) VALUES
(1, 'Barangay Chairman', 1),
(2, 'Barangay Kagawad', 2),
(3, 'SK Kagawad', 3),
(4, 'Barangay Treasurer', 4),
(5, 'Barangay Secretary', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblprecinct`
--

CREATE TABLE `tblprecinct` (
  `id_precinct` int(11) NOT NULL,
  `precinct` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpurok`
--

CREATE TABLE `tblpurok` (
  `id_purok` int(11) NOT NULL,
  `purok_name` varchar(255) DEFAULT NULL,
  `purok_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpurok`
--

INSERT INTO `tblpurok` (`id_purok`, `purok_name`, `purok_details`) VALUES
(1, 'Zone 01', 'Zone 01'),
(2, 'Zone 02', 'Zone 02');

-- --------------------------------------------------------

--
-- Table structure for table `tblresident2`
--

CREATE TABLE `tblresident2` (
  `id_resident` int(11) NOT NULL,
  `national_id` varchar(100) NOT NULL,
  `region` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `picture` text NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(20) NOT NULL,
  `civilstatus` varchar(20) NOT NULL,
  `residence_type` varchar(25) NOT NULL COMMENT 'new; co-occupant; tenant',
  `id_household` int(80) NOT NULL,
  `family_head` varchar(10) NOT NULL,
  `date_of_residence` date NOT NULL,
  `vstatus` varchar(10) NOT NULL,
  `identified_as` varchar(20) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `resident_type` int(20) NOT NULL DEFAULT 1 COMMENT '1 = Alive; 0 = Deceased',
  `id_org` varchar(100) NOT NULL,
  `pwd` varchar(5) NOT NULL,
  `indigent` varchar(5) NOT NULL,
  `remarks` text NOT NULL,
  `res_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresident2`
--

INSERT INTO `tblresident2` (`id_resident`, `national_id`, `region`, `city`, `province`, `barangay`, `citizenship`, `picture`, `firstname`, `middlename`, `lastname`, `ext`, `alias`, `birthplace`, `birthdate`, `sex`, `civilstatus`, `residence_type`, `id_household`, `family_head`, `date_of_residence`, `vstatus`, `identified_as`, `phone`, `email`, `occupation`, `resident_type`, `id_org`, `pwd`, `indigent`, `remarks`, `res_updated_at`, `id_user`) VALUES
(1, '1234-5678-9000', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '13022023090530unnamed.jpg', 'Tom', '', 'Abella', '', 'Tom', 'Bulua', '2001-01-29', 'Male', 'single', 'new', 4, 'yes', '2019-02-13', 'Yes', 'Confirmed', '09876543212', '', 'Student', 0, '1', 'No', 'Yes', '', '2023-05-03 15:20:03', 11),
(2, '0909-8765-3456', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '13022023090731uzui.jpg', 'Motsur', '', 'Calapis', 'IV', 'Mot', 'Bulua', '2001-01-01', 'Male', 'single', 'co-occupant', 1, 'no', '2023-02-13', 'No', '', '', '', 'Student', 1, 'none', 'Yes', 'Yes', '', '2023-03-13 04:57:23', 11),
(3, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '13022023090852tom.jpg', 'Tomas', '', 'Howland', '', 'Tom', 'Tacloban City', '2001-01-29', 'Female', 'single', 'tenant', 2, 'no', '2021-02-13', 'No', '', '', '', 'Student', 1, '1', 'No', 'No', '', '2023-02-14 16:29:23', 11),
(4, '1111-1111-1111-1111', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Japanese', 'person.png', 'Sample', 'Sample', 'Sample', '', 'Samp', 'Samps', '2019-03-13', 'Male', 'single', 'new', 1, 'yes', '2023-03-13', 'Yes', 'Confirmed', '', 'samp@mail.com', 'Student', 1, 'none', 'No', 'No', '', '2023-03-13 04:55:37', 11),
(5, '1223-3445-5677', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '170320231121111143202.jpg', 'Test', 'Testtwo', 'Red', 'Sr.', 'Tom', 'Japan', '2002-03-17', 'Male', 'married', 'tenant', 1, 'no', '2023-03-17', 'Yes', 'Unconfirmed', '', '', 'N/A', 1, 'none', 'No', 'No', '', '2023-03-17 03:21:11', 11),
(6, '1233-3221-1232-4422', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '2204202318291920201018_123908.jpg', 'James', '', 'Abella', '', 'Max', 'Jasaan', '2022-04-08', 'Male', 'single', 'co-occupant', 4, 'no', '2022-04-01', 'No', '', '', '', 'N/A', 1, 'none', 'No', 'No', '', '2023-07-04 06:42:02', 11),
(7, '1234-5678-9097-8876', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Weis', '', 'Wise', '', 'WEE', 'Japan', '2016-01-01', 'Male', 'single', 'co-occupant', 1, '', '2021-01-02', 'No', '', '', '', 'N/A', 1, 'none', 'No', 'No', '', '2023-05-02 01:15:20', 11),
(8, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'New', 'New', 'New', 'Sr.', 'News', 'Jasaan', '2020-01-03', 'Male', 'single', 'new', 4, 'no', '2023-05-03', 'No', '', '', '', 'N/A', 1, 'none', 'No', 'No', '', '2023-05-03 05:45:25', 11),
(9, '7866-6666-6666-3323', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'COOCCUPANT', 'COOCCUPANT', 'COOCCUPANT', '', 'COOCCUPANT', 'Japan', '2001-05-03', 'Male', 'widow/er', 'co-occupant', 1, 'no', '2023-03-09', 'No', '', '', '', 'N/A', 1, 'none', 'No', 'No', '', '2023-05-03 06:35:24', 11),
(10, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'TENANT', 'TENANT', 'TENANT', '', 'TENT', 'Samps', '2023-01-01', 'Male', 'married', 'tenant', 1, 'no', '2023-05-03', 'No', '', '', '', 'N/A', 1, 'none', 'No', 'No', '', '2023-06-06 18:24:10', 11),
(11, '1234-5678-7654', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Jane', '', 'Doe', '', 'Jin', 'Jasaan', '1987-05-08', 'Female', 'married', 'co-occupant', 4, '', '2023-05-01', 'No', '', '09876654342', '', 'House Wife', 1, 'none', 'No', 'No', '', '2023-05-08 01:54:22', 11),
(12, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'John', '', 'Doe', '', 'Jj', 'Jasaan', '1978-05-02', 'Male', 'married', 'co-occupant', 4, '', '2023-05-01', 'No', '', '', '', 'Professor', 1, 'none', 'No', 'No', '', '2023-05-08 01:58:56', 11),
(13, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Tom', '', 'Doe', '', 'Tomas', 'Jasaan', '2001-01-01', 'Male', 'single', 'co-occupant', 4, '', '2023-05-01', 'No', '', '', '', 'Student', 1, 'none', 'No', 'No', '', '2023-05-08 02:03:03', 11),
(14, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Halaka', '', 'Doe', '', 'Do', 'Jasaan', '2003-01-29', 'Female', 'single', 'co-occupant', 4, '', '2023-05-01', 'No', '', '', '', 'Student', 1, 'none', 'No', 'No', '', '2023-05-08 02:04:33', 11),
(15, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '10052023090643Screenshot_1.png', 'Lou', '', 'Wang', '', 'Boo', 'Jasaan', '1975-03-13', 'Male', 'married', 'new', 5, 'yes', '2002-05-10', 'Yes', 'Confirmed', '', '', 'Professor', 1, 'none', 'No', 'No', '', '2023-06-08 15:49:37', 11),
(16, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '10052023090532download.jpg', 'Marie', '', 'Wang', '', 'Lou', 'Bukidnon', '1978-02-08', 'Female', 'married', 'co-occupant', 5, 'no', '2002-05-10', 'Yes', 'Unconfirmed', '', '', 'House Wife', 1, 'none', 'No', 'No', '', '2023-06-08 15:48:56', 11),
(18, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '10052023091227Screenshot_3.png', 'Kala', '', 'Wang', '', 'Kal', 'Jasaan', '2001-01-01', 'Female', 'single', 'co-occupant', 5, 'no', '2002-05-10', 'No', '', '', '', 'Student', 1, 'none', 'No', 'No', '', '2023-05-10 01:12:27', 11),
(19, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '10052023091250Screenshot_4.png', 'Vey', '', 'Wang', '', 'Vey', 'Jasaan', '2013-01-01', 'Male', 'single', 'co-occupant', 5, 'no', '2002-05-10', 'No', '', '', '', 'Student', 1, 'none', 'No', 'No', '', '2023-05-10 01:12:50', 11),
(20, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Nee', '', 'Wang', '', 'Ne', 'Jasaan', '2001-01-02', 'Male', 'single', 'co-occupant', 5, 'no', '2023-05-02', 'Yes', '', '', '', 'Student', 1, 'none', 'No', 'No', '', '2023-05-13 00:20:25', 11),
(21, '0909-8765-4322', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Tanjiro', 'Kama', 'Doe', '', 'Jiro', 'Japan', '2001-01-29', 'Male', 'single', 'co-occupant', 4, '', '2023-05-17', 'Yes', 'Confirmed', '09764124567', 'tanjiro@gmail.com', 'Water Hashira / Sun Breathing Hashira', 1, '2', 'No', 'Yes', '', '2023-05-17 01:14:59', 11),
(22, '', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'Nimal', 'Ka', 'Doe', '', 'Mil', 'Jasaan', '2001-05-17', 'Female', 'single', 'co-occupant', 4, '', '2023-05-17', 'No', '', '', '', 'Water Hashira', 1, '2', 'No', 'No', '', '2023-05-17 01:19:02', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cert_appearance`
--

CREATE TABLE `tbl_cert_appearance` (
  `id_cert_appearance` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `venue` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cert_appearance`
--

INSERT INTO `tbl_cert_appearance` (`id_cert_appearance`, `name`, `venue`, `date`, `purpose`, `created_at`, `id_user`) VALUES
(1, 'RUSTOM C. ABELLA', 'SWORDSMITH VILLAGE', '2023-02-13', 'Meeting with the Hashira', '2023-02-13', '11'),
(2, 'Tom Abella', 'Barangay 25 Hall', '2023-03-17', 'Employment', '2023-03-17', '11'),
(3, 'Shinobu', 'Swordsmith Village', '2023-04-12', 'to kill Muzan Kibutsuji', '2023-05-02', '11'),
(4, 'Weise Weise', 'Entertainment Arc', '2023-05-02', 'Meeting with the hashira.', '2023-05-02', '11'),
(5, 'Sample Me', 'Cak', '2023-05-01', 'visit tempest city', '2023-05-02', '11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_household`
--

CREATE TABLE `tbl_household` (
  `id_household` int(11) NOT NULL,
  `household_number` int(100) NOT NULL,
  `house_no` int(100) NOT NULL COMMENT '(2.1)',
  `id_purok` varchar(50) NOT NULL,
  `household_street_name` varchar(100) NOT NULL COMMENT '(2.2)',
  `household_address` varchar(250) NOT NULL COMMENT '(2.3)',
  `household_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_household`
--

INSERT INTO `tbl_household` (`id_household`, `household_number`, `house_no`, `id_purok`, `household_street_name`, `household_address`, `household_type`) VALUES
(1, 1, 1, '1', 'Maagad St.', 'Abella\'s residence', 'residential'),
(2, 2, 2, '2', 'Pacana St.', 'Ella\'s Apartment', 'apartment'),
(3, 3, 23, '2', 'Laroka St.', 'scac', 'boarding house'),
(4, 5, 5, '2', 'Laroka St.', 'Doe Residence', 'residential'),
(5, 6, 6, '1', 'Muugad St.', 'Wang Residence', 'residential');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nature_of_case`
--

CREATE TABLE `tbl_nature_of_case` (
  `noc_id` int(11) NOT NULL,
  `noc_name` varchar(100) NOT NULL,
  `noc_details` varchar(255) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `noc_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nature_of_case`
--

INSERT INTO `tbl_nature_of_case` (`noc_id`, `noc_name`, `noc_details`, `id_user`, `noc_updated_at`) VALUES
(1, 'Light coercion', 'Light coercion', '11', '2023-02-13 00:36:04'),
(2, 'Physical Injury', 'Physical Injury', '11', '2023-02-13 00:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_org`
--

CREATE TABLE `tbl_org` (
  `id_org` int(11) NOT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_org`
--

INSERT INTO `tbl_org` (`id_org`, `org_name`, `details`) VALUES
(1, 'Senior Citizen', 'Senior Citizen'),
(2, 'SK', 'SK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_emergency_contact`
--

CREATE TABLE `tbl_p_emergency_contact` (
  `id_p_emergency_contact` int(11) NOT NULL,
  `emergency_name` varchar(255) NOT NULL,
  `emergency_relationship` varchar(255) NOT NULL,
  `emergency_bday` date NOT NULL,
  `emergency_cellphone` varchar(50) NOT NULL,
  `emergency_landline` varchar(255) NOT NULL,
  `family_num` varchar(255) NOT NULL,
  `emergency_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `emergency_updated-at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_emergency_contact`
--

INSERT INTO `tbl_p_emergency_contact` (`id_p_emergency_contact`, `emergency_name`, `emergency_relationship`, `emergency_bday`, `emergency_cellphone`, `emergency_landline`, `family_num`, `emergency_created_at`, `emergency_updated-at`) VALUES
(15, 'Tanjiro Kama Doe', 'Meek', '2002-05-16', '0988776654', '', '20230510219022000001', '2023-05-16 03:35:00', '2023-05-16 03:35:00'),
(16, 'Tanjiro Kama Doe', 'Brother', '2023-05-17', '09098876549', '', '20230510314056000001', '2023-05-17 06:38:32', '2023-05-17 06:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_family`
--

CREATE TABLE `tbl_p_family` (
  `family_num` varchar(255) NOT NULL,
  `id_household` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_family`
--

INSERT INTO `tbl_p_family` (`family_num`, `id_household`) VALUES
('20230510314056000001', 4),
('20230510219022000001', 5),
('20230609463304000001', 4),
('20230609578608000001', 4),
('20230510314056000001', 4),
('20230510219022000001', 5),
('20230609463304000001', 4),
('20230609578608000001', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_fam_members`
--

CREATE TABLE `tbl_p_fam_members` (
  `id_family` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `family_role` varchar(10) NOT NULL,
  `family_blood_type` varchar(5) NOT NULL,
  `family_num` varchar(255) NOT NULL,
  `fam_members_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fam_members_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_fam_members`
--

INSERT INTO `tbl_p_fam_members` (`id_family`, `id_resident`, `family_role`, `family_blood_type`, `family_num`, `fam_members_created_at`, `fam_members_updated_at`) VALUES
(26, 11, 'mother', 'O', '20230510314056000001', '2023-05-10 00:38:03', '2023-05-10 00:38:03'),
(30, 16, 'mother', 'O', '20230510219022000001', '2023-05-10 01:13:06', '2023-05-10 01:13:06'),
(31, 15, 'father', 'O', '20230510219022000001', '2023-05-10 01:13:28', '2023-05-10 01:13:28'),
(35, 12, 'father', 'O', '20230510314056000001', '2023-05-10 03:17:12', '2023-05-10 07:06:04'),
(108, 18, 'children', '', '20230510219022000001', '2023-05-16 03:34:08', '2023-05-16 03:34:08'),
(109, 19, 'children', '', '20230510219022000001', '2023-05-16 03:34:08', '2023-05-16 03:34:08'),
(114, 17, 'children', '', '20230510219022000001', '2023-05-16 12:34:58', '2023-05-16 12:34:58'),
(119, 13, 'children', '', '20230510314056000001', '2023-05-17 06:24:32', '2023-05-17 06:24:32'),
(121, 14, 'children', '', '20230510314056000001', '2023-05-17 06:26:30', '2023-05-17 06:26:30'),
(122, 21, 'children', '', '20230510314056000001', '2023-05-17 06:26:30', '2023-05-17 06:26:30'),
(125, 20, 'children', '', '20230510219022000001', '2023-05-20 03:26:22', '2023-05-20 03:26:22'),
(126, 22, 'children', '', '20230510314056000001', '2023-05-20 10:03:57', '2023-05-20 10:03:57'),
(127, 9, 'mother', 'O', '20230609463304000001', '2023-06-09 02:55:02', '2023-06-09 02:55:02'),
(128, 3, 'father', '', '20230609463304000001', '2023-06-09 04:09:22', '2023-06-09 04:09:22'),
(129, 5, 'mother', 'AB', '20230609578608000001', '2023-06-09 04:24:57', '2023-06-09 04:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_history_and_current_pregnancy_condition`
--

CREATE TABLE `tbl_p_history_and_current_pregnancy_condition` (
  `id_mother_h_c_pregnancy_condition` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `first_check_up_date` date NOT NULL,
  `p_weight` decimal(10,2) NOT NULL,
  `p_height` decimal(10,2) NOT NULL,
  `health_condition` decimal(10,2) NOT NULL COMMENT 'Body Mass Index',
  `last_mens_period_date` date NOT NULL,
  `expected_date_delivery` date NOT NULL,
  `delivered_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active; 1-archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_history_and_current_pregnancy_condition`
--

INSERT INTO `tbl_p_history_and_current_pregnancy_condition` (`id_mother_h_c_pregnancy_condition`, `id_resident`, `first_check_up_date`, `p_weight`, `p_height`, `health_condition`, `last_mens_period_date`, `expected_date_delivery`, `delivered_status`) VALUES
(7, 11, '2023-05-20', 43.40, 124.00, 56.20, '2023-02-14', '2023-11-21', 0),
(8, 16, '2023-05-20', 67.00, 126.00, 13.00, '2023-05-02', '2024-02-06', 0),
(9, 9, '2023-06-09', 45.00, 45.00, 0.00, '2023-02-09', '2023-11-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_immunization_record`
--

CREATE TABLE `tbl_p_immunization_record` (
  `id_immunization_record` int(11) NOT NULL,
  `id_mother_h_c_pregnancy_condition` int(11) NOT NULL,
  `tetanus_containing_vaccine` int(11) NOT NULL,
  `date_given` date NOT NULL,
  `when_to_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_immunization_record`
--

INSERT INTO `tbl_p_immunization_record` (`id_immunization_record`, `id_mother_h_c_pregnancy_condition`, `tetanus_containing_vaccine`, `date_given`, `when_to_return`) VALUES
(5, 8, 1, '2023-05-20', '0000-00-00'),
(6, 8, 2, '2023-06-28', '0000-00-00'),
(10, 7, 2, '2023-05-28', '0000-00-00'),
(11, 7, 1, '2023-04-28', '2023-05-28'),
(12, 7, 4, '2023-06-28', '0000-00-00'),
(13, 7, 3, '2023-06-01', '2023-08-28'),
(14, 7, 6, '2023-05-28', '0000-00-00'),
(15, 7, 5, '2023-09-28', '0000-00-00'),
(16, 8, 3, '2023-06-08', '2023-07-08'),
(17, 8, 4, '2023-06-10', '2023-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_medication_and_other_services`
--

CREATE TABLE `tbl_p_medication_and_other_services` (
  `id_med_other_services` int(11) NOT NULL,
  `med_or_services_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_medication_and_other_services`
--

INSERT INTO `tbl_p_medication_and_other_services` (`id_med_other_services`, `med_or_services_name`) VALUES
(1, 'Iron'),
(2, 'Folic Acid'),
(3, 'Calcium Carbonate'),
(4, 'Iodine'),
(5, 'Pagsusuri sa STI/HIV/AIDS'),
(6, 'Pagsusuri ng ngipin'),
(7, 'Pagsusuri ng Hepatitis B'),
(8, 'Pagpapatingin sa suso'),
(9, 'Pagsusuri ng plema (Kung may palatandaan ng tisis, ubo na mahigit sa 14 na araw)'),
(10, 'Hemoglobin Count'),
(11, 'Complete Blood Count'),
(12, 'Urinalysis'),
(13, 'Stool Examination'),
(14, 'Acetic Acid Wash');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_tetanus_vaccine`
--

CREATE TABLE `tbl_p_tetanus_vaccine` (
  `tetanus_containing_vaccine` int(11) NOT NULL,
  `tetanus_containing_vaccine_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_tetanus_vaccine`
--

INSERT INTO `tbl_p_tetanus_vaccine` (`tetanus_containing_vaccine`, `tetanus_containing_vaccine_detail`) VALUES
(1, '1st dose - as early as possible during pregnancy'),
(2, '2nd dose - at least 4 weeks after dose 1'),
(3, '3rd dose - at least 4 weeks after dose 2'),
(4, '4th dose - at least 1 year after dose 3'),
(5, '5th dose - at least 1 year after dose 4'),
(6, 'Fully Immunized (nakatanggap na ng 5 doses ng Tetanus-containing Vaccines)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_trimester`
--

CREATE TABLE `tbl_p_trimester` (
  `id_p_trimester` int(11) NOT NULL,
  `id_mother_h_c_pregnancy_condition` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `date_check_up_trimester` date NOT NULL,
  `weight_trimester` decimal(10,2) NOT NULL,
  `height_trimester` decimal(10,2) NOT NULL,
  `age_of_gestation` varchar(255) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `nutritional_status` varchar(100) NOT NULL,
  `examination_condition_pregnant_woman` varchar(255) NOT NULL,
  `advices_given` text NOT NULL,
  `birth_plan_changes` text NOT NULL,
  `teeth_examination` text NOT NULL,
  `laboratory_tests_done` text NOT NULL,
  `urinalysis` varchar(255) NOT NULL,
  `complete_blood_count` varchar(255) NOT NULL,
  `etiologic_tests` varchar(255) NOT NULL,
  `pap_smear` varchar(255) NOT NULL,
  `gestational_diabetes` varchar(255) NOT NULL,
  `bacteriuria` varchar(255) NOT NULL,
  `treatments` varchar(255) NOT NULL,
  `discussions_or_service_given` text NOT NULL,
  `date_of_return` date NOT NULL,
  `name_health_service_provider` varchar(255) NOT NULL,
  `hospital_referral` varchar(255) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_p_trimester`
--

INSERT INTO `tbl_p_trimester` (`id_p_trimester`, `id_mother_h_c_pregnancy_condition`, `month`, `date_check_up_trimester`, `weight_trimester`, `height_trimester`, `age_of_gestation`, `blood_pressure`, `nutritional_status`, `examination_condition_pregnant_woman`, `advices_given`, `birth_plan_changes`, `teeth_examination`, `laboratory_tests_done`, `urinalysis`, `complete_blood_count`, `etiologic_tests`, `pap_smear`, `gestational_diabetes`, `bacteriuria`, `treatments`, `discussions_or_service_given`, `date_of_return`, `name_health_service_provider`, `hospital_referral`, `notes`) VALUES
(4, 7, 2, '2023-06-08', 100.00, 100.00, 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', '2023-06-17', 'sample3', 'sample3', 'sample3'),
(5, 7, 3, '2023-06-12', 141.00, 141.00, 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', '2023-06-10', 'sample4', 'sample4', 'sample4'),
(6, 7, 4, '2023-06-08', 44.00, 44.00, '44', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', 'month 4', '2023-06-22', 'month 4', 'month 4', 'month 4'),
(7, 7, 5, '2023-07-05', 45.00, 45.00, '45', '45', '45', '45', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', 'month 5', '2023-08-05', 'month 5', 'month 5', 'month 5'),
(8, 7, 6, '2023-07-06', 46.00, 46.00, 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', 'Sample 6', '2023-08-06', 'Sample 6', 'Sample 6', 'Sample 6'),
(9, 7, 7, '2023-07-07', 47.00, 47.00, 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', 'sample 7', '2023-08-07', 'sample 7', 'sample 7', 'sample 7'),
(10, 7, 8, '2023-07-08', 48.00, 48.00, 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', 'month 8', '2023-08-08', 'month 8', 'month 8', 'month 8'),
(11, 7, 9, '2023-08-09', 49.00, 49.00, '49', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', 'month 9', '2023-08-09', 'month 9', 'month 9', 'month 9'),
(12, 8, 1, '2023-06-09', 1.00, 1.00, '1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', 'sample 1', '2023-07-01', 'sample 1', 'sample 1', 'sample 1'),
(13, 0, 9, '2023-06-09', 9.00, 9.00, '9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', 'sample 9', '2023-07-09', 'sample 9', 'sample 9', 'sample 9');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_special_permit`
--

CREATE TABLE `tbl_special_permit` (
  `id_special_permit` int(11) NOT NULL,
  `grantee` varchar(100) DEFAULT NULL,
  `representative` varchar(100) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `issued_date` date NOT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_special_permit`
--

INSERT INTO `tbl_special_permit` (`id_special_permit`, `grantee`, `representative`, `action`, `start_date`, `end_date`, `issued_date`, `id_user`) VALUES
(1, 'Choco Shake', 'Rustom Abella', 'to perform installation of  streamer /tarpaulin along CM Recto – Julio Pacana St. junction. The  installation will start from August 25, 2015 and will expire on September 25,  2015.', '2023-02-13', '2024-02-13', '2023-02-13', '11'),
(2, 'Abella Construction Corp', 'Rustom Abella', 'to install', '2023-03-17', '2023-03-24', '2023-03-17', '11'),
(3, 'Mismaler Corp', 'Tomas Abella', 'to function the everything', '2023-05-01', '2023-05-05', '2023-05-02', '11'),
(4, 'ABC Company', 'Tommy Abella', 'To function a kuan', '2023-06-08', '2023-07-08', '2023-06-08', '11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_support`
--

CREATE TABLE `tbl_support` (
  `id_support` int(11) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status_support` varchar(10) NOT NULL DEFAULT 'pending',
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_support`
--

INSERT INTO `tbl_support` (`id_support`, `id_user`, `number`, `subject`, `message`, `status_support`, `date`) VALUES
(1, '10', '', 'TRY lang', 'Dili ko access.', 'resolved', '2023-03-17 03:59:43'),
(2, '10', '09098766654', 'Naunsa kaman?', 'Naa kay problema nako?! Tubag!', 'pending', '2023-04-02 09:01:03'),
(3, '10', '0909876554', 'hello', 'nauns kaman', 'resolved', '2023-05-17 06:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `id_payments` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `transact_no` text NOT NULL,
  `date_transact` timestamp NOT NULL DEFAULT current_timestamp(),
  `details_transact` varchar(250) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `created_at_transact` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id_payments`, `id_user`, `transact_no`, `date_transact`, `details_transact`, `recipient_name`, `created_at_transact`) VALUES
(1, 11, '20230608883982000001', '2023-06-08 15:04:22', 'Barangay Clearance for Abella, Tom ', 'Tommy Abella', '2023-06-08 15:04:22'),
(0, 11, '20230608879757000001', '2023-06-08 15:06:09', 'Certificate of Indigency for Wang, Malou ', 'Tomass', '2023-06-08 15:06:09'),
(2, 11, '20230608005459000001', '2023-06-08 15:11:29', 'Special Permit for ABC Company. REPRESENTATIVE: Tommy Abella', 'Tomassue', '2023-06-08 15:11:29'),
(1, 11, '20230608883982000001', '2023-06-08 15:04:22', 'Barangay Clearance for Abella, Tom ', 'Tommy Abella', '2023-06-08 15:04:22'),
(0, 11, '20230608879757000001', '2023-06-08 15:06:09', 'Certificate of Indigency for Wang, Malou ', 'Tomass', '2023-06-08 15:06:09'),
(2, 11, '20230608005459000001', '2023-06-08 15:11:29', 'Special Permit for ABC Company. REPRESENTATIVE: Tommy Abella', 'Tomassue', '2023-06-08 15:11:29'),
(3, 11, '20230609295813000001', '2023-06-09 07:16:40', 'Barangay Clearance for Abella, Tom ', 'tom', '2023-06-09 07:16:40'),
(0, 11, '20230625161877000001', '2023-06-25 12:57:31', 'Construction Clearance for Jaime P. Ramen', 'LOL', '2023-06-25 12:57:31'),
(0, 11, '20230625705980000001', '2023-06-25 13:00:12', 'Construction Clearance for Milk Shake', 'LOLS', '2023-06-25 13:00:12'),
(4, 11, '20230625756261000001', '2023-06-25 13:03:21', 'Barangay Clearance for Wang, Lou ', 'TOMASS', '2023-06-25 13:03:21'),
(5, 11, '20230626978282000001', '2023-06-26 12:46:12', 'Barangay Clearance for Abella, Tom ', 'Tomas', '2023-06-26 12:46:12'),
(6, 10, '20230627427563000001', '2023-06-27 13:08:15', 'Barangay Clearance for Abella, Tom ', 'LOLA', '2023-06-27 13:08:15'),
(7, 11, '20230628485349000001', '2023-06-28 07:52:05', 'Barangay Clearance for Abella, Tom ', 'LOLs', '2023-06-28 07:52:05'),
(0, 11, '20230629791253000001', '2023-06-29 05:03:52', 'Certificate of Indigency for Abella, Tom ', 'Ngee', '2023-06-29 05:03:52'),
(8, 11, '20230705416438000001', '2023-07-05 06:13:28', 'Special Permit for Mismaler Corp. REPRESENTATIVE: Tomas Abella', 'Tomas', '2023-07-05 06:13:28'),
(9, 11, '20230709624993000001', '2023-07-09 15:21:05', 'Barangay Clearance for Abella, James ', 'Tomas', '2023-07-09 15:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(11) NOT NULL,
  `user_username` varchar(50) DEFAULT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_middlename` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `user_username`, `user_firstname`, `user_middlename`, `user_lastname`, `password`, `user_type`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(10, 'staff', 'Marie Mae', 'Kump', 'Bullhorse', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff', '03052021043218icon.png', 'Active', '2021-05-03 02:32:18', '2023-03-17 03:42:14'),
(11, 'admin', 'Rustom', 'Calapis', 'Abella', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'administrator', '13022023093336head.jpg', 'Active', '2021-05-03 02:33:03', '2023-02-13 01:33:36'),
(26, 'tom', 'Tom', '', 'Abella', '96835dd8bfa718bd6447ccc87af89ae1675daeca', 'staff', '13022023083722casual-sleeve2.jpg', 'Active', '2023-02-13 00:37:22', '2023-02-13 00:37:22'),
(27, 'mismaan', 'Mismaan', '', 'Lumaag', '79f02606e3aa2d095783c566037f1757fe0c808f', 'staff', 'person.png', 'Active', '2023-04-30 00:42:46', '2023-04-30 00:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_logs`
--

CREATE TABLE `tbl_user_logs` (
  `id_user_logs` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `details` varchar(100) NOT NULL,
  `id_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_logs`
--

INSERT INTO `tbl_user_logs` (`id_user_logs`, `date`, `details`, `id_user`) VALUES
(1, '2023-02-12 14:00:55', 'admin, has logged out.', '1'),
(2, '2023-02-12 22:36:38', 'admin, has logged in.', '11'),
(3, '2023-02-12 22:37:49', 'admin, has logged out.', '11'),
(4, '2023-02-12 22:37:52', 'admin, has logged in.', '11'),
(5, '2023-02-12 22:38:44', 'admin, has logged out.', '11'),
(6, '2023-02-12 22:38:49', 'admin, has logged in.', '11'),
(7, '2023-02-12 22:41:37', 'admin, has logged out.', '11'),
(8, '2023-02-12 22:41:44', 'admin, has logged in.', '11'),
(9, '2023-02-12 22:44:41', 'admin, has logged out.', '11'),
(10, '2023-02-13 00:28:33', 'admin, has logged in.', '11'),
(11, '2023-02-13 16:31:33', 'admin, has logged out.', '11'),
(12, '2023-02-13 16:31:38', 'admin, has logged in.', '11'),
(13, '2023-02-13 16:31:52', 'admin, has logged out.', '11'),
(14, '2023-02-14 14:26:14', 'admin, has logged in.', '11'),
(15, '2023-02-14 14:26:43', 'admin, has logged out.', '11'),
(16, '2023-02-14 14:26:46', 'admin, has logged in.', '11'),
(17, '2023-02-14 16:29:49', 'admin, has logged out.', '11'),
(18, '2023-02-14 18:19:54', 'admin, has logged in.', '11'),
(19, '2023-02-14 18:20:06', 'admin, has logged out.', '11'),
(20, '2023-02-14 18:46:32', 'admin, has logged in.', '11'),
(21, '2023-03-17 03:54:32', 'admin, has logged out.', '11'),
(22, '2023-03-17 03:54:40', 'staff, has logged in.', '10'),
(23, '2023-03-17 03:59:49', 'staff, has logged out.', '10'),
(24, '2023-03-17 03:59:55', 'admin, has logged in.', '11'),
(25, '2023-03-20 05:44:16', 'admin, has logged out.', '11'),
(26, '2023-03-27 03:22:26', 'admin, has logged in.', '11'),
(27, '2023-03-27 04:05:26', 'admin, has logged out.', '11'),
(28, '2023-03-28 06:27:20', 'admin, has logged in.', '11'),
(29, '2023-03-30 03:47:15', 'admin, has logged out.', '11'),
(30, '2023-03-30 03:47:18', 'admin, has logged in.', '11'),
(31, '2023-04-02 07:48:15', 'admin, has logged in.', '11'),
(32, '2023-04-02 08:45:18', 'admin, has logged in.', '11'),
(33, '2023-04-02 09:00:35', 'admin, has logged out.', '11'),
(34, '2023-04-02 09:00:39', 'staff, has logged in.', '10'),
(35, '2023-04-02 09:01:06', 'staff, has logged out.', '10'),
(36, '2023-04-02 09:01:10', 'admin, has logged in.', '11'),
(37, '2023-04-02 09:52:14', 'admin, has logged out.', '11'),
(38, '2023-04-02 09:52:16', 'admin, has logged in.', '11'),
(39, '2023-04-02 14:46:13', 'admin, has logged out.', '11'),
(40, '2023-04-03 02:06:17', 'admin, has logged in.', '11'),
(41, '2023-04-03 05:59:58', 'admin, has logged out.', '11'),
(42, '2023-04-03 06:00:02', 'staff, has logged in.', '10'),
(43, '2023-04-03 06:09:15', 'staff, has logged out.', '10'),
(44, '2023-04-03 06:09:18', 'admin, has logged in.', '11'),
(45, '2023-04-03 06:09:43', 'admin, has logged out.', '11'),
(46, '2023-04-03 06:10:03', 'staff, has logged in.', '10'),
(47, '2023-04-03 06:15:14', 'staff, has logged out.', '10'),
(48, '2023-04-03 06:15:18', 'admin, has logged in.', '11'),
(49, '2023-04-03 06:20:14', 'admin, has logged out.', '11'),
(50, '2023-04-03 06:20:18', 'staff, has logged in.', '10'),
(51, '2023-04-03 06:33:30', 'staff, has logged out.', '10'),
(52, '2023-04-03 06:33:34', 'admin, has logged in.', '11'),
(53, '2023-04-03 09:09:57', 'admin, has logged out.', '11'),
(54, '2023-04-03 15:43:00', 'admin, has logged in.', '11'),
(55, '2023-04-03 16:20:02', 'admin, has logged out.', '11'),
(56, '2023-04-03 16:20:04', 'admin, has logged in.', '11'),
(57, '2023-04-03 16:21:33', 'admin, has logged out.', '11'),
(58, '2023-04-04 00:25:16', 'admin, has logged in.', '11'),
(59, '2023-04-04 03:47:20', 'admin, has logged out.', '11'),
(60, '2023-04-04 03:48:04', 'staff, has logged in.', '10'),
(61, '2023-04-04 03:48:11', 'staff, has logged out.', '10'),
(62, '2023-04-04 03:48:17', 'admin, has logged in.', '11'),
(63, '2023-04-12 15:25:24', 'admin, has logged in.', '11'),
(64, '2023-04-26 07:54:46', 'admin, has logged in.', '11'),
(65, '2023-04-28 01:10:51', 'admin, has logged out.', '11'),
(66, '2023-04-28 01:12:34', 'admin, has logged in.', '11'),
(67, '2023-04-28 06:06:56', 'admin, has logged out.', '11'),
(68, '2023-04-28 06:07:00', 'staff, has logged in.', '10'),
(69, '2023-04-28 06:21:08', 'staff, has logged out.', '10'),
(70, '2023-04-28 06:21:11', 'admin, has logged in.', '11'),
(71, '2023-04-29 11:46:43', 'admin, has logged in.', '11'),
(72, '2023-04-30 00:42:50', 'admin, has logged out.', '11'),
(73, '2023-04-30 00:42:54', 'mismaan, has logged in.', '27'),
(74, '2023-04-30 00:50:04', 'mismaan, has logged out.', '27'),
(75, '2023-04-30 00:51:30', 'mismaan, has logged in.', '27'),
(76, '2023-04-30 00:52:06', 'mismaan, has logged out.', '27'),
(77, '2023-04-30 00:52:55', 'admin, has logged in.', '11'),
(78, '2023-05-01 03:25:50', 'admin, has logged out.', ''),
(79, '2023-05-01 03:25:54', 'admin, has logged in.', '11'),
(80, '2023-05-01 05:17:44', 'admin, has logged out.', ''),
(81, '2023-05-01 05:17:47', 'admin, has logged in.', '11'),
(82, '2023-05-01 07:55:51', 'admin, has logged out.', '1'),
(83, '2023-05-01 07:55:57', 'mismaan, has logged in.', '27'),
(84, '2023-05-01 07:57:03', 'mismaan, has logged out.', '27'),
(85, '2023-05-01 07:57:09', 'admin, has logged in.', '11'),
(86, '2023-05-01 10:06:56', 'admin, has logged out.', '11'),
(87, '2023-05-01 10:07:02', 'mismaan, has logged in.', '27'),
(88, '2023-05-01 10:08:42', 'mismaan, has logged out.', '27'),
(89, '2023-05-01 10:08:47', 'admin, has logged in.', '11'),
(90, '2023-05-01 11:36:45', 'admin, has logged in.', '11'),
(91, '2023-05-02 02:51:48', 'admin, has logged out.', '11'),
(92, '2023-05-02 02:52:48', 'admin, has logged in.', '11'),
(93, '2023-05-02 02:52:50', 'admin, has logged out.', '11'),
(94, '2023-05-03 01:08:08', 'admin, has logged in.', '11'),
(95, '2023-05-03 13:03:26', 'admin, has logged in.', '11'),
(96, '2023-05-03 15:27:25', 'admin, has logged out.', '11'),
(97, '2023-05-05 01:42:26', 'admin, has logged in.', '11'),
(98, '2023-05-05 08:04:05', 'admin, has logged in.', '11'),
(99, '2023-05-06 09:09:50', 'admin, has logged in.', '11'),
(100, '2023-05-09 00:43:52', 'admin, has logged in.', '11'),
(101, '2023-05-09 03:30:28', 'admin, has logged in.', '11'),
(102, '2023-05-10 07:16:59', 'admin, has logged out.', '11'),
(103, '2023-05-12 08:02:00', 'admin, has logged in.', '11'),
(104, '2023-05-12 09:05:59', 'admin, has logged out.', '11'),
(105, '2023-05-13 00:17:19', 'admin, has logged in.', '11'),
(106, '2023-05-14 00:57:24', 'admin, has logged in.', '11'),
(107, '2023-05-17 06:34:07', 'admin, has logged out.', '11'),
(108, '2023-05-17 06:34:16', 'staff, has logged in.', '10'),
(109, '2023-05-17 06:34:37', 'staff, has logged out.', '10'),
(110, '2023-05-17 06:34:42', 'admin, has logged in.', '11'),
(111, '2023-05-28 23:34:49', 'admin, has logged in.', '11'),
(112, '2023-06-09 04:36:29', 'admin, has logged out.', '11'),
(113, '2023-06-09 07:08:48', 'admin, has logged out.', '11'),
(114, '2023-06-09 07:08:58', 'admin, has logged in.', '11'),
(115, '2023-06-09 07:09:33', 'admin, has logged out.', '11'),
(116, '2023-06-09 07:14:57', 'admin, has logged in.', '11'),
(117, '2023-06-26 12:31:48', 'admin, has logged in.', '11'),
(118, '2023-06-26 12:32:21', 'admin, has logged out.', '11'),
(119, '2023-06-26 12:33:21', 'admin, has logged in.', '11'),
(120, '2023-06-26 12:34:15', 'admin, has logged out.', '11'),
(121, '2023-06-27 13:06:08', 'admin, has logged out.', '11'),
(122, '2023-06-27 13:06:50', 'staff, has logged in.', '10'),
(123, '2023-06-27 13:08:23', 'staff, has logged out.', '10'),
(124, '2023-06-27 13:08:27', 'admin, has logged in.', '11'),
(125, '2023-06-27 13:31:50', 'admin, has logged out.', '11'),
(126, '2023-06-27 13:37:50', 'staff, has logged in.', '10'),
(127, '2023-06-27 13:41:11', 'staff, has logged out.', '10'),
(128, '2023-06-27 13:41:17', 'admin, has logged in.', '11'),
(129, '2023-06-29 05:40:12', 'admin, has logged out.', '11'),
(130, '2023-06-29 05:41:23', 'admin, has logged in.', '11'),
(131, '2023-06-29 05:41:24', 'admin, has logged in.', '11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblblotter`
--
ALTER TABLE `tblblotter`
  ADD PRIMARY KEY (`id_blotter`),
  ADD KEY `noc` (`noc_id`),
  ADD KEY `comp_name` (`comp_id`),
  ADD KEY `resp_name` (`resp_id`);

--
-- Indexes for table `tblblotter_schedule`
--
ALTER TABLE `tblblotter_schedule`
  ADD PRIMARY KEY (`id_blotter_schedule`);

--
-- Indexes for table `tblblotter_schedule_archive`
--
ALTER TABLE `tblblotter_schedule_archive`
  ADD PRIMARY KEY (`id_blotter_schedule_archive`);

--
-- Indexes for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  ADD PRIMARY KEY (`id_brgy_info`);

--
-- Indexes for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  ADD PRIMARY KEY (`id_chairmanship`);

--
-- Indexes for table `tblofficials`
--
ALTER TABLE `tblofficials`
  ADD PRIMARY KEY (`id_officials`),
  ADD KEY `position` (`id_position`);

--
-- Indexes for table `tblofficials_chairmanships`
--
ALTER TABLE `tblofficials_chairmanships`
  ADD PRIMARY KEY (`id_officials_chairmanship`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`id_payments`);

--
-- Indexes for table `tblpermit`
--
ALTER TABLE `tblpermit`
  ADD PRIMARY KEY (`id_permit`),
  ADD KEY `username` (`id_user`);

--
-- Indexes for table `tblposition`
--
ALTER TABLE `tblposition`
  ADD PRIMARY KEY (`id_position`);

--
-- Indexes for table `tblprecinct`
--
ALTER TABLE `tblprecinct`
  ADD PRIMARY KEY (`id_precinct`);

--
-- Indexes for table `tblpurok`
--
ALTER TABLE `tblpurok`
  ADD PRIMARY KEY (`id_purok`);

--
-- Indexes for table `tblresident2`
--
ALTER TABLE `tblresident2`
  ADD PRIMARY KEY (`id_resident`),
  ADD KEY `householdnumber` (`id_household`),
  ADD KEY `organization` (`id_org`),
  ADD KEY `username` (`id_user`);

--
-- Indexes for table `tbl_cert_appearance`
--
ALTER TABLE `tbl_cert_appearance`
  ADD PRIMARY KEY (`id_cert_appearance`),
  ADD KEY `username` (`id_user`);

--
-- Indexes for table `tbl_household`
--
ALTER TABLE `tbl_household`
  ADD PRIMARY KEY (`id_household`),
  ADD UNIQUE KEY `household_number` (`household_number`),
  ADD KEY `household_purok` (`id_purok`),
  ADD KEY `household_number_2` (`household_number`);

--
-- Indexes for table `tbl_nature_of_case`
--
ALTER TABLE `tbl_nature_of_case`
  ADD PRIMARY KEY (`noc_id`),
  ADD KEY `noc_username` (`id_user`);

--
-- Indexes for table `tbl_org`
--
ALTER TABLE `tbl_org`
  ADD PRIMARY KEY (`id_org`);

--
-- Indexes for table `tbl_p_emergency_contact`
--
ALTER TABLE `tbl_p_emergency_contact`
  ADD PRIMARY KEY (`id_p_emergency_contact`);

--
-- Indexes for table `tbl_p_fam_members`
--
ALTER TABLE `tbl_p_fam_members`
  ADD PRIMARY KEY (`id_family`);

--
-- Indexes for table `tbl_p_history_and_current_pregnancy_condition`
--
ALTER TABLE `tbl_p_history_and_current_pregnancy_condition`
  ADD PRIMARY KEY (`id_mother_h_c_pregnancy_condition`);

--
-- Indexes for table `tbl_p_immunization_record`
--
ALTER TABLE `tbl_p_immunization_record`
  ADD PRIMARY KEY (`id_immunization_record`);

--
-- Indexes for table `tbl_p_medication_and_other_services`
--
ALTER TABLE `tbl_p_medication_and_other_services`
  ADD PRIMARY KEY (`id_med_other_services`);

--
-- Indexes for table `tbl_p_tetanus_vaccine`
--
ALTER TABLE `tbl_p_tetanus_vaccine`
  ADD PRIMARY KEY (`tetanus_containing_vaccine`);

--
-- Indexes for table `tbl_p_trimester`
--
ALTER TABLE `tbl_p_trimester`
  ADD PRIMARY KEY (`id_p_trimester`);

--
-- Indexes for table `tbl_special_permit`
--
ALTER TABLE `tbl_special_permit`
  ADD PRIMARY KEY (`id_special_permit`),
  ADD KEY `username` (`id_user`);

--
-- Indexes for table `tbl_support`
--
ALTER TABLE `tbl_support`
  ADD PRIMARY KEY (`id_support`),
  ADD KEY `username` (`id_user`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  ADD PRIMARY KEY (`id_user_logs`),
  ADD KEY `username` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblblotter`
--
ALTER TABLE `tblblotter`
  MODIFY `id_blotter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblblotter_schedule`
--
ALTER TABLE `tblblotter_schedule`
  MODIFY `id_blotter_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tblblotter_schedule_archive`
--
ALTER TABLE `tblblotter_schedule_archive`
  MODIFY `id_blotter_schedule_archive` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  MODIFY `id_brgy_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  MODIFY `id_chairmanship` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `id_officials` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblofficials_chairmanships`
--
ALTER TABLE `tblofficials_chairmanships`
  MODIFY `id_officials_chairmanship` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id_payments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblposition`
--
ALTER TABLE `tblposition`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblprecinct`
--
ALTER TABLE `tblprecinct`
  MODIFY `id_precinct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpurok`
--
ALTER TABLE `tblpurok`
  MODIFY `id_purok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblresident2`
--
ALTER TABLE `tblresident2`
  MODIFY `id_resident` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_cert_appearance`
--
ALTER TABLE `tbl_cert_appearance`
  MODIFY `id_cert_appearance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_household`
--
ALTER TABLE `tbl_household`
  MODIFY `id_household` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_nature_of_case`
--
ALTER TABLE `tbl_nature_of_case`
  MODIFY `noc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_org`
--
ALTER TABLE `tbl_org`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_p_emergency_contact`
--
ALTER TABLE `tbl_p_emergency_contact`
  MODIFY `id_p_emergency_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_p_fam_members`
--
ALTER TABLE `tbl_p_fam_members`
  MODIFY `id_family` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tbl_p_history_and_current_pregnancy_condition`
--
ALTER TABLE `tbl_p_history_and_current_pregnancy_condition`
  MODIFY `id_mother_h_c_pregnancy_condition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_p_immunization_record`
--
ALTER TABLE `tbl_p_immunization_record`
  MODIFY `id_immunization_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_p_medication_and_other_services`
--
ALTER TABLE `tbl_p_medication_and_other_services`
  MODIFY `id_med_other_services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_p_tetanus_vaccine`
--
ALTER TABLE `tbl_p_tetanus_vaccine`
  MODIFY `tetanus_containing_vaccine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_p_trimester`
--
ALTER TABLE `tbl_p_trimester`
  MODIFY `id_p_trimester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_special_permit`
--
ALTER TABLE `tbl_special_permit`
  MODIFY `id_special_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_support`
--
ALTER TABLE `tbl_support`
  MODIFY `id_support` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  MODIFY `id_user_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
