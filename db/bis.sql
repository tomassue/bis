-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 07:07 AM
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
(1, 'Others', 'Sample', '1', 'N/A', 'N/A', 'N/A', 'wew', 'wew', '2', 'Active', '2023-07-11 17:12:38', '2023-07-11 17:16:32', '11'),
(2, '2', 'N/A', 'N/A', 'Muzan Kibutsuji', 'Zone 5 Upper, Iponan, CDO', '09097786675', 'wow', 'wow', '1', 'Active', '2023-07-11 17:13:13', '2023-07-11 17:13:13', '11'),
(3, '3', 'N/A', '2', 'N/A', 'N/A', 'N/A', 'pow', 'pow', '1', 'Active', '2023-07-11 17:15:38', '2023-07-11 17:15:38', '11');

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
(3, 3, '2023-07-15', '09:00:00', '2023-07-11 17:15:38', '2023-07-11 17:15:38'),
(6, 1, '2023-07-20', '10:30:00', '2023-07-11 17:17:12', '2023-07-11 17:17:12'),
(9, 2, '2023-07-15', '10:00:00', '2023-07-11 17:22:48', '2023-07-11 17:22:48');

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
(1, 1, '2023-07-12', '09:23:00', '2023-07-11 17:12:38', '2023-07-11 17:12:38', '2023-07-11 17:16:39'),
(2, 1, '2023-07-19', '09:23:00', '2023-07-11 17:16:39', '2023-07-11 17:16:39', '2023-07-11 17:16:53'),
(3, 1, '2023-07-19', '10:30:00', '2023-07-11 17:16:53', '2023-07-11 17:16:53', '2023-07-11 17:17:12'),
(4, 2, '2023-07-14', '10:00:00', '2023-07-11 17:13:13', '2023-07-11 17:13:13', '2023-07-11 17:22:08'),
(5, 2, '2023-07-12', '10:00:00', '2023-07-11 17:22:08', '2023-07-11 17:22:08', '2023-07-11 17:22:36'),
(6, 2, '2023-07-05', '10:00:00', '2023-07-11 17:22:36', '2023-07-11 17:22:36', '2023-07-11 17:22:48');

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
(7, 'Committee on Tourism and Sports');

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
(1, 'Hon.', 'Reuben U. Pacalioga', '1', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(2, 'Hon.', 'Venus N. Ahmee', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(3, 'Hon.', 'Noel S. Ilogon', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(4, 'Hon.', 'Renan Noel B. Ilogon', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(5, 'Hon.', 'Glenn T. Inesin', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(6, 'Hon.', 'Democrito D. Elevado', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(7, 'Hon.', 'Alvin P. Garrote', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(8, 'Hon.', 'Alvin P. Garrote', '2', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(9, 'Hon.', 'Pedro C. Sacal', '2', '2023-07-11', '0024-07-11', 'Incumbent', 0),
(10, 'Hon.', 'Rey M. Galla', '3', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(11, 'Hon.', 'Mirra G. Gabata', '4', '2023-07-11', '2024-07-11', 'Incumbent', 0),
(12, 'Hon.', 'Maricris O. Mabao', '5', '2023-07-11', '2024-07-11', 'Incumbent', 0);

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
(19, 9, 1),
(20, 9, 4),
(21, 8, 1);

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
(1, 50.00),
(2, 50.00),
(3, 50.00),
(4, 50.00),
(5, 50.00),
(6, 3000.00),
(7, 5000.00),
(8, 50.00),
(9, 50.00),
(10, 3000.00),
(11, 50.00);

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
(1, 'Coffee Ta Bai!', 'Zone 06', '2023-07-13', '11'),
(2, 'Lod\'an', 'Zone 07', '2023-07-22', '11'),
(3, 'Lodan', 'Zone 08', '2023-07-22', '11'),
(4, 'Loda\'n', 'Zone 09', '2023-07-22', '11');

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
(1, 'Zone 1', 'wew'),
(2, 'Zone 2', ''),
(3, 'Zone 3', ''),
(4, 'Zone 4', '');

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
(1, '1111-1111-1111', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', '11072023225255285882556_1445824979206719_2927059040504518943_n.png', 'James', 'Calapis', 'Testing', 'Sr.', 'James', 'Jasaan', '2001-07-11', 'Male', 'single', 'new', 7, 'no', '2001-07-11', 'Yes', '', '', '', 'Student', 1, '2', 'No', 'Yes', '', '2023-07-11 17:21:38', 11),
(2, '2222-2222-2222', 'Region X', 'Cagayan de Oro', 'Misamis Oriental', 'Barangay 25', 'Filipino', 'person.png', 'James', 'Calapis', 'Testing', 'Jr.', 'Jem', 'Jasaan', '2005-01-11', 'Male', 'single', 'co-occupant', 7, 'no', '2001-07-11', 'Yes', 'Unconfirmed', '', '', 'Student', 1, 'none', 'No', 'Yes', '', '2023-07-11 15:51:52', 11);

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
(1, 'Justin Biebers', 'Barangay 25 Hall', '2023-07-15', 'Presentation', '2023-07-12', '11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_household`
--

CREATE TABLE `tbl_household` (
  `id_household` int(11) NOT NULL,
  `household_number` int(100) NOT NULL,
  `house_no` int(100) DEFAULT NULL COMMENT '(2.1)',
  `id_purok` varchar(50) NOT NULL,
  `household_street_name` varchar(100) NOT NULL COMMENT '(2.2)',
  `household_address` varchar(250) NOT NULL COMMENT '(2.3)',
  `household_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_household`
--

INSERT INTO `tbl_household` (`id_household`, `household_number`, `house_no`, `id_purok`, `household_street_name`, `household_address`, `household_type`) VALUES
(1, 1, 1, '2', 'Pacana St.', 'Sacal Residence', 'apartment'),
(5, 3, 3, '2', 'Pacana St.', 'wew', 'boarding house'),
(6, 2, 2, '1', '34', 'wrewfe', 'residential'),
(7, 4, 14, '1', 'Alagad St.', 'Warren Apt.', 'residential');

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
(1, 'Unjust Vexation', '', '11', '2023-07-11 08:36:13'),
(2, 'Hit and Run', '', '11', '2023-07-11 08:41:43'),
(3, 'Covet', '', '11', '2023-07-11 08:41:48');

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
(1, 'Senior Citizen', ''),
(2, 'SK', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_family`
--

CREATE TABLE `tbl_p_family` (
  `family_num` varchar(255) NOT NULL,
  `id_household` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_medication_and_other_services`
--

CREATE TABLE `tbl_p_medication_and_other_services` (
  `id_med_other_services` int(11) NOT NULL,
  `med_or_services_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_p_tetanus_vaccine`
--

CREATE TABLE `tbl_p_tetanus_vaccine` (
  `tetanus_containing_vaccine` int(11) NOT NULL,
  `tetanus_containing_vaccine_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Mismaler Corp', 'Rustom Abella', 'to perform installation of streamer /tarpaulin along CM Recto – Julio Pacana St. junction.', '2023-07-12', '2023-08-12', '2023-07-12', '11');

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
(1, '27', '', 'TRY lang', 'Test', 'pending', '2023-07-12 23:51:09');

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
(1, 11, '20230711806874000001', '2023-07-11 15:19:14', 'Barangay Clearance for Testing, James ', 'Tomas', '2023-07-11 15:19:14'),
(2, 11, '20230711964293000001', '2023-07-11 15:19:52', 'Barangay Clearance for Testing, James ', 'James', '2023-07-11 15:19:52'),
(3, 11, '20230711942028000001', '2023-07-11 15:32:07', 'Barangay Clearance for Testing, James ', 'Tomassue', '2023-07-11 15:32:07'),
(4, 11, '20230711884776000001', '2023-07-11 15:43:19', 'Barangay Clearance for Testing, James Calapis', 'Tom Abella', '2023-07-11 15:43:19'),
(5, 11, '20230711162825000001', '2023-07-11 15:43:41', 'Barangay Clearance for Testing, James Calapis', 'Tomas', '2023-07-11 15:43:41'),
(0, 11, '20230711532161000001', '2023-07-11 15:56:02', 'Certificate of Indigency for James Calapis Testing, Jr.', 'Tomas', '2023-07-11 15:56:02'),
(0, 11, '20230711008001000001', '2023-07-11 15:56:26', 'Certificate of Indigency for James Calapis Testing', 'Tomas', '2023-07-11 15:56:26'),
(0, 11, '20230712424282000001', '2023-07-11 16:03:13', 'Certificate of Oneness for James Calapis Testing, Jr.', 'Tomassue', '2023-07-11 16:03:13'),
(0, 11, '20230712665246000001', '2023-07-11 16:04:00', 'Certificate of Oneness for James Calapis Testing', 'Tom Abella', '2023-07-11 16:04:00'),
(0, 11, '20230712152356000001', '2023-07-11 16:10:10', 'Certificate of Appearance for Justin Biebers', 'tom', '2023-07-11 16:10:10'),
(0, 11, '20230712645384000001', '2023-07-11 16:19:28', 'Certificate of Appearance for Justin Biebers', 'Tom Abella', '2023-07-11 16:19:28'),
(0, 11, '20230712300079000001', '2023-07-11 16:26:53', 'Construction Clearance for Coffee Ta Bai!', 'Tom Abella', '2023-07-11 16:26:53'),
(0, 11, '20230712204438000001', '2023-07-11 16:46:50', 'Construction Clearance for Coffee Ta Bai!', 'Tomas', '2023-07-11 16:46:50'),
(6, 11, '20230712923135000001', '2023-07-11 16:54:44', 'Special Permit for Mismaler Corp. REPRESENTATIVE: Rustom Abella', 'Tom Abella', '2023-07-11 16:54:44'),
(7, 11, '20230712239831000001', '2023-07-11 16:56:33', 'Special Permit for Mismaler Corp. REPRESENTATIVE: Rustom Abella', 'Tomas', '2023-07-11 16:56:33'),
(8, 11, '20230712615006000001', '2023-07-11 16:57:01', 'Barangay Clearance for James Calapis Testing, Jr.', 'Tomas', '2023-07-11 16:57:01'),
(9, 26, '20230712857922000001', '2023-07-12 05:01:28', 'Barangay Clearance for James Calapis Testing, Sr.', 'James', '2023-07-12 05:01:28'),
(10, 28, '20230712230343000001', '2023-07-12 08:23:36', 'Special Permit for Mismaler Corp. REPRESENTATIVE: Rustom Abella', 'Jims', '2023-07-12 08:23:36'),
(11, 28, '20230712578011000001', '2023-07-12 08:24:19', 'Barangay Clearance for James Calapis Testing, Sr.', 'Jims Jims', '2023-07-12 08:24:19'),
(0, 11, '20230722512320000001', '2023-07-22 04:31:02', 'Construction Clearance for Coffee Ta Bai!', 'Tomas', '2023-07-22 04:31:02'),
(0, 11, '20230722980607000001', '2023-07-22 04:33:43', 'Construction Clearance for Coffee Ta Bai!', 'Tomas', '2023-07-22 04:33:43'),
(0, 11, '20230722204764000001', '2023-07-22 04:34:28', 'Construction Clearance for Lodan', 'James', '2023-07-22 04:34:28'),
(0, 11, '20230722061022000001', '2023-07-22 04:39:17', 'Construction Clearance for Lodan', 'Tom Abella', '2023-07-22 04:39:17'),
(0, 11, '20230722887215000001', '2023-07-22 04:45:32', 'Construction Clearance for Lodan', 'James Maximus', '2023-07-22 04:45:32'),
(0, 11, '20230722811058000001', '2023-07-22 04:49:19', 'Construction Clearance for Lodan', 'Tomas', '2023-07-22 04:49:19'),
(0, 11, '20230722690138000001', '2023-07-22 04:58:45', 'Construction Clearance for Coffee Ta Bai!', 'Tom\'as', '2023-07-22 04:58:45'),
(0, 11, '20230722554522000001', '2023-07-22 05:00:34', 'Construction Clearance for Coffee Ta Bai!', 'Tom\'Abella', '2023-07-22 05:00:34'),
(0, 11, '20230722816984000001', '2023-07-22 05:02:08', 'Construction Clearance for Loda\'n', 'Tomas', '2023-07-22 05:02:08');

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
(26, 'tom', 'Tom', '', 'Abella', '2bc6038c3dfca09b2da23c8b6da8ba884dc2dcc2', 'staff', 'data:image/jpeg;base64,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', 'Active', '2023-02-13 00:37:22', '2023-07-09 15:29:57'),
(27, 'mismaan', 'Mismaan', '', 'Lumaag', '79f02606e3aa2d095783c566037f1757fe0c808f', 'staff', 'person.png', 'Active', '2023-04-30 00:42:46', '2023-04-30 00:42:46'),
(28, 'jims', 'jims', 'test', 'sample', 'c1c83adaf3130fd0eaea46b603ad9904a3396ed2', 'administrator', 'person.png', 'Inactive', '2023-07-12 08:22:33', '2023-07-12 23:50:51');

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
(1, '2023-07-11 18:05:39', 'admin, has logged out.', '11'),
(2, '2023-07-11 18:05:41', 'admin, has logged in.', '11'),
(3, '2023-07-11 18:19:12', 'admin, has logged out.', '11'),
(4, '2023-07-12 05:00:06', 'tom, has logged in.', '26'),
(5, '2023-07-12 05:00:37', 'tom, has logged out.', '26'),
(6, '2023-07-12 05:00:41', 'admin, has logged in.', '11'),
(7, '2023-07-12 05:00:55', 'admin, has logged out.', '11'),
(8, '2023-07-12 05:00:59', 'tom, has logged in.', '26'),
(9, '2023-07-12 05:03:34', 'tom, has logged out.', '26'),
(10, '2023-07-12 05:03:39', 'admin, has logged in.', '11'),
(11, '2023-07-12 05:04:53', 'admin, has logged out.', '11'),
(12, '2023-07-12 08:21:42', 'admin, has logged in.', '11'),
(13, '2023-07-12 08:22:46', 'admin, has logged out.', '11'),
(14, '2023-07-12 08:22:51', 'jims, has logged in.', '28'),
(15, '2023-07-12 08:23:04', 'jims, has logged out.', '28'),
(16, '2023-07-12 08:23:11', 'jims, has logged in.', '28'),
(17, '2023-07-12 08:24:46', 'jims, has logged out.', '28'),
(18, '2023-07-12 08:24:55', 'admin, has logged in.', '11'),
(19, '2023-07-12 08:25:39', 'admin, has logged out.', '11'),
(20, '2023-07-12 08:25:51', 'admin, has logged in.', '11'),
(21, '2023-07-12 08:26:30', 'admin, has logged out.', '11'),
(22, '2023-07-12 08:26:33', 'admin, has logged in.', '11'),
(23, '2023-07-12 23:50:26', 'admin, has logged out.', '11'),
(24, '2023-07-12 23:50:33', 'admin, has logged in.', '11'),
(25, '2023-07-12 23:50:54', 'admin, has logged out.', '11'),
(26, '2023-07-12 23:51:00', 'mismaan, has logged in.', '27'),
(27, '2023-07-12 23:51:12', 'mismaan, has logged out.', '27'),
(28, '2023-07-12 23:51:16', 'admin, has logged in.', '11'),
(29, '2023-07-22 04:30:05', 'admin, has logged out.', '11'),
(30, '2023-07-22 04:30:08', 'admin, has logged in.', '11'),
(31, '2023-07-22 05:02:52', 'admin, has logged out.', '11'),
(32, '2023-07-22 05:02:55', 'staff, has logged in.', '10'),
(33, '2023-07-22 05:06:21', 'staff, has logged out.', '10'),
(34, '2023-07-22 05:06:33', 'admin, has logged in.', '11');

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
  MODIFY `id_blotter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblblotter_schedule`
--
ALTER TABLE `tblblotter_schedule`
  MODIFY `id_blotter_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblblotter_schedule_archive`
--
ALTER TABLE `tblblotter_schedule_archive`
  MODIFY `id_blotter_schedule_archive` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  MODIFY `id_brgy_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  MODIFY `id_chairmanship` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `id_officials` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblofficials_chairmanships`
--
ALTER TABLE `tblofficials_chairmanships`
  MODIFY `id_officials_chairmanship` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id_payments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_purok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblresident2`
--
ALTER TABLE `tblresident2`
  MODIFY `id_resident` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cert_appearance`
--
ALTER TABLE `tbl_cert_appearance`
  MODIFY `id_cert_appearance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_household`
--
ALTER TABLE `tbl_household`
  MODIFY `id_household` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_nature_of_case`
--
ALTER TABLE `tbl_nature_of_case`
  MODIFY `noc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_org`
--
ALTER TABLE `tbl_org`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_p_emergency_contact`
--
ALTER TABLE `tbl_p_emergency_contact`
  MODIFY `id_p_emergency_contact` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_p_fam_members`
--
ALTER TABLE `tbl_p_fam_members`
  MODIFY `id_family` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_p_history_and_current_pregnancy_condition`
--
ALTER TABLE `tbl_p_history_and_current_pregnancy_condition`
  MODIFY `id_mother_h_c_pregnancy_condition` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_p_immunization_record`
--
ALTER TABLE `tbl_p_immunization_record`
  MODIFY `id_immunization_record` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_p_medication_and_other_services`
--
ALTER TABLE `tbl_p_medication_and_other_services`
  MODIFY `id_med_other_services` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_p_tetanus_vaccine`
--
ALTER TABLE `tbl_p_tetanus_vaccine`
  MODIFY `tetanus_containing_vaccine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_p_trimester`
--
ALTER TABLE `tbl_p_trimester`
  MODIFY `id_p_trimester` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_special_permit`
--
ALTER TABLE `tbl_special_permit`
  MODIFY `id_special_permit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_support`
--
ALTER TABLE `tbl_support`
  MODIFY `id_support` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  MODIFY `id_user_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
