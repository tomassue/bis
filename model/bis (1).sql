-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 06:25 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tblofficials_chairmanships`
--

CREATE TABLE `tblofficials_chairmanships` (
  `id_officials_chairmanship` int(11) NOT NULL,
  `id_officials` int(11) NOT NULL,
  `id_chairmanship` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id_payments` int(11) NOT NULL,
  `amounts` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_org`
--

CREATE TABLE `tbl_org` (
  `id_org` int(11) NOT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, 'staff', 'Marie Mae', 'Kump', 'Bullhorse', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', 'staff', '29072023153402falling-down-muichiro-tokito-kimetsu-no-yaiba-demon-slayer-2500x1775-wallpx.com.jpg', 'Active', '2021-05-03 02:32:18', '2023-07-29 07:34:02'),
(11, 'admin', 'Rustom', 'Calapis', 'Abella', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'administrator', '13022023093336head.jpg', 'Active', '2021-05-03 02:33:03', '2023-02-13 01:33:36');

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
  MODIFY `id_blotter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblblotter_schedule`
--
ALTER TABLE `tblblotter_schedule`
  MODIFY `id_blotter_schedule` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblblotter_schedule_archive`
--
ALTER TABLE `tblblotter_schedule_archive`
  MODIFY `id_blotter_schedule_archive` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblbrgy_info`
--
ALTER TABLE `tblbrgy_info`
  MODIFY `id_brgy_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblchairmanship`
--
ALTER TABLE `tblchairmanship`
  MODIFY `id_chairmanship` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblofficials`
--
ALTER TABLE `tblofficials`
  MODIFY `id_officials` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblofficials_chairmanships`
--
ALTER TABLE `tblofficials_chairmanships`
  MODIFY `id_officials_chairmanship` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id_payments` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpermit`
--
ALTER TABLE `tblpermit`
  MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_purok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblresident2`
--
ALTER TABLE `tblresident2`
  MODIFY `id_resident` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cert_appearance`
--
ALTER TABLE `tbl_cert_appearance`
  MODIFY `id_cert_appearance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_household`
--
ALTER TABLE `tbl_household`
  MODIFY `id_household` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_nature_of_case`
--
ALTER TABLE `tbl_nature_of_case`
  MODIFY `noc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_org`
--
ALTER TABLE `tbl_org`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_special_permit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_support`
--
ALTER TABLE `tbl_support`
  MODIFY `id_support` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_user_logs`
--
ALTER TABLE `tbl_user_logs`
  MODIFY `id_user_logs` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
