# ABMS : MySQL database backup
#
# Generated: Wednesday 26. July 2023
# Hostname: localhost
# Database: bis
# --------------------------------------------------------


#
# Delete any existing table `tbl_cert_appearance`
#

DROP TABLE IF EXISTS `tbl_cert_appearance`;


#
# Table structure of table `tbl_cert_appearance`
#



CREATE TABLE `tbl_cert_appearance` (
  `id_cert_appearance` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `venue` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `id_user` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cert_appearance`),
  KEY `username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_cert_appearance VALUES("1","Justin Biebers","Barangay 25 Hall","2023-07-15","Presentation","2023-07-12","11");



#
# Delete any existing table `tbl_household`
#

DROP TABLE IF EXISTS `tbl_household`;


#
# Table structure of table `tbl_household`
#



CREATE TABLE `tbl_household` (
  `id_household` int(11) NOT NULL AUTO_INCREMENT,
  `household_number` int(100) NOT NULL,
  `house_no` int(100) DEFAULT NULL COMMENT '(2.1)',
  `id_purok` varchar(50) NOT NULL,
  `household_street_name` varchar(100) NOT NULL COMMENT '(2.2)',
  `household_address` varchar(250) NOT NULL COMMENT '(2.3)',
  `household_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id_household`),
  UNIQUE KEY `household_number` (`household_number`),
  KEY `household_purok` (`id_purok`),
  KEY `household_number_2` (`household_number`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_household VALUES("1","1","1","2","Pacana St.","Sacal Residence","apartment");
INSERT INTO tbl_household VALUES("5","3","3","2","Pacana St.","wew","boarding house");
INSERT INTO tbl_household VALUES("6","2","2","1","34","wrewfe","residential");
INSERT INTO tbl_household VALUES("7","4","14","1","Alagad St.","Warren Apt.","residential");



#
# Delete any existing table `tbl_nature_of_case`
#

DROP TABLE IF EXISTS `tbl_nature_of_case`;


#
# Table structure of table `tbl_nature_of_case`
#



CREATE TABLE `tbl_nature_of_case` (
  `noc_id` int(11) NOT NULL AUTO_INCREMENT,
  `noc_name` varchar(100) NOT NULL,
  `noc_details` varchar(255) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `noc_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`noc_id`),
  KEY `noc_username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_nature_of_case VALUES("1","Unjust Vexation","","11","2023-07-11 16:36:13");
INSERT INTO tbl_nature_of_case VALUES("2","Hit and Run","","11","2023-07-11 16:41:43");
INSERT INTO tbl_nature_of_case VALUES("3","Covet","","11","2023-07-11 16:41:48");



#
# Delete any existing table `tbl_org`
#

DROP TABLE IF EXISTS `tbl_org`;


#
# Table structure of table `tbl_org`
#



CREATE TABLE `tbl_org` (
  `id_org` int(11) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`id_org`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_org VALUES("1","Senior Citizen","");
INSERT INTO tbl_org VALUES("2","SK","");



#
# Delete any existing table `tbl_p_emergency_contact`
#

DROP TABLE IF EXISTS `tbl_p_emergency_contact`;


#
# Table structure of table `tbl_p_emergency_contact`
#



CREATE TABLE `tbl_p_emergency_contact` (
  `id_p_emergency_contact` int(11) NOT NULL AUTO_INCREMENT,
  `emergency_name` varchar(255) NOT NULL,
  `emergency_relationship` varchar(255) NOT NULL,
  `emergency_bday` date NOT NULL,
  `emergency_cellphone` varchar(50) NOT NULL,
  `emergency_landline` varchar(255) NOT NULL,
  `family_num` varchar(255) NOT NULL,
  `emergency_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `emergency_updated-at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_p_emergency_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_fam_members`
#

DROP TABLE IF EXISTS `tbl_p_fam_members`;


#
# Table structure of table `tbl_p_fam_members`
#



CREATE TABLE `tbl_p_fam_members` (
  `id_family` int(11) NOT NULL AUTO_INCREMENT,
  `id_resident` int(11) NOT NULL,
  `family_role` varchar(10) NOT NULL,
  `family_blood_type` varchar(5) NOT NULL,
  `family_num` varchar(255) NOT NULL,
  `fam_members_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fam_members_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_family`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_family`
#

DROP TABLE IF EXISTS `tbl_p_family`;


#
# Table structure of table `tbl_p_family`
#



CREATE TABLE `tbl_p_family` (
  `family_num` varchar(255) NOT NULL,
  `id_household` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_history_and_current_pregnancy_condition`
#

DROP TABLE IF EXISTS `tbl_p_history_and_current_pregnancy_condition`;


#
# Table structure of table `tbl_p_history_and_current_pregnancy_condition`
#



CREATE TABLE `tbl_p_history_and_current_pregnancy_condition` (
  `id_mother_h_c_pregnancy_condition` int(11) NOT NULL AUTO_INCREMENT,
  `id_resident` int(11) NOT NULL,
  `first_check_up_date` date NOT NULL,
  `p_weight` decimal(10,2) NOT NULL,
  `p_height` decimal(10,2) NOT NULL,
  `health_condition` decimal(10,2) NOT NULL COMMENT 'Body Mass Index',
  `last_mens_period_date` date NOT NULL,
  `expected_date_delivery` date NOT NULL,
  `delivered_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active; 1-archived',
  PRIMARY KEY (`id_mother_h_c_pregnancy_condition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_immunization_record`
#

DROP TABLE IF EXISTS `tbl_p_immunization_record`;


#
# Table structure of table `tbl_p_immunization_record`
#



CREATE TABLE `tbl_p_immunization_record` (
  `id_immunization_record` int(11) NOT NULL AUTO_INCREMENT,
  `id_mother_h_c_pregnancy_condition` int(11) NOT NULL,
  `tetanus_containing_vaccine` int(11) NOT NULL,
  `date_given` date NOT NULL,
  `when_to_return` date DEFAULT NULL,
  PRIMARY KEY (`id_immunization_record`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_medication_and_other_services`
#

DROP TABLE IF EXISTS `tbl_p_medication_and_other_services`;


#
# Table structure of table `tbl_p_medication_and_other_services`
#



CREATE TABLE `tbl_p_medication_and_other_services` (
  `id_med_other_services` int(11) NOT NULL AUTO_INCREMENT,
  `med_or_services_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_med_other_services`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_tetanus_vaccine`
#

DROP TABLE IF EXISTS `tbl_p_tetanus_vaccine`;


#
# Table structure of table `tbl_p_tetanus_vaccine`
#



CREATE TABLE `tbl_p_tetanus_vaccine` (
  `tetanus_containing_vaccine` int(11) NOT NULL AUTO_INCREMENT,
  `tetanus_containing_vaccine_detail` varchar(255) NOT NULL,
  PRIMARY KEY (`tetanus_containing_vaccine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_p_trimester`
#

DROP TABLE IF EXISTS `tbl_p_trimester`;


#
# Table structure of table `tbl_p_trimester`
#



CREATE TABLE `tbl_p_trimester` (
  `id_p_trimester` int(11) NOT NULL AUTO_INCREMENT,
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
  `notes` text NOT NULL,
  PRIMARY KEY (`id_p_trimester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tbl_special_permit`
#

DROP TABLE IF EXISTS `tbl_special_permit`;


#
# Table structure of table `tbl_special_permit`
#



CREATE TABLE `tbl_special_permit` (
  `id_special_permit` int(11) NOT NULL AUTO_INCREMENT,
  `grantee` varchar(100) DEFAULT NULL,
  `representative` varchar(100) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `issued_date` date NOT NULL,
  `id_user` varchar(10) NOT NULL,
  PRIMARY KEY (`id_special_permit`),
  KEY `username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_special_permit VALUES("1","Mismaler Corp","Rustom Abella","to perform installation of streamer /tarpaulin along CM Recto – Julio Pacana St. junction.","2023-07-12","2023-08-12","2023-07-12","11");



#
# Delete any existing table `tbl_support`
#

DROP TABLE IF EXISTS `tbl_support`;


#
# Table structure of table `tbl_support`
#



CREATE TABLE `tbl_support` (
  `id_support` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(10) NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status_support` varchar(10) NOT NULL DEFAULT 'pending',
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_support`),
  KEY `username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_support VALUES("1","27","","TRY lang","Test","pending","2023-07-13 07:51:09");



#
# Delete any existing table `tbl_transactions`
#

DROP TABLE IF EXISTS `tbl_transactions`;


#
# Table structure of table `tbl_transactions`
#



CREATE TABLE `tbl_transactions` (
  `id_payments` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `transact_no` text NOT NULL,
  `date_transact` timestamp NOT NULL DEFAULT current_timestamp(),
  `details_transact` varchar(250) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `created_at_transact` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_transactions VALUES("1","11","20230711806874000001","2023-07-11 23:19:14","Barangay Clearance for Testing, James ","Tomas","2023-07-11 23:19:14");
INSERT INTO tbl_transactions VALUES("2","11","20230711964293000001","2023-07-11 23:19:52","Barangay Clearance for Testing, James ","James","2023-07-11 23:19:52");
INSERT INTO tbl_transactions VALUES("3","11","20230711942028000001","2023-07-11 23:32:07","Barangay Clearance for Testing, James ","Tomassue","2023-07-11 23:32:07");
INSERT INTO tbl_transactions VALUES("4","11","20230711884776000001","2023-07-11 23:43:19","Barangay Clearance for Testing, James Calapis","Tom Abella","2023-07-11 23:43:19");
INSERT INTO tbl_transactions VALUES("5","11","20230711162825000001","2023-07-11 23:43:41","Barangay Clearance for Testing, James Calapis","Tomas","2023-07-11 23:43:41");
INSERT INTO tbl_transactions VALUES("0","11","20230711532161000001","2023-07-11 23:56:02","Certificate of Indigency for James Calapis Testing, Jr.","Tomas","2023-07-11 23:56:02");
INSERT INTO tbl_transactions VALUES("0","11","20230711008001000001","2023-07-11 23:56:26","Certificate of Indigency for James Calapis Testing","Tomas","2023-07-11 23:56:26");
INSERT INTO tbl_transactions VALUES("0","11","20230712424282000001","2023-07-12 00:03:13","Certificate of Oneness for James Calapis Testing, Jr.","Tomassue","2023-07-12 00:03:13");
INSERT INTO tbl_transactions VALUES("0","11","20230712665246000001","2023-07-12 00:04:00","Certificate of Oneness for James Calapis Testing","Tom Abella","2023-07-12 00:04:00");
INSERT INTO tbl_transactions VALUES("0","11","20230712152356000001","2023-07-12 00:10:10","Certificate of Appearance for Justin Biebers","tom","2023-07-12 00:10:10");
INSERT INTO tbl_transactions VALUES("0","11","20230712645384000001","2023-07-12 00:19:28","Certificate of Appearance for Justin Biebers","Tom Abella","2023-07-12 00:19:28");
INSERT INTO tbl_transactions VALUES("0","11","20230712300079000001","2023-07-12 00:26:53","Construction Clearance for Coffee Ta Bai!","Tom Abella","2023-07-12 00:26:53");
INSERT INTO tbl_transactions VALUES("0","11","20230712204438000001","2023-07-12 00:46:50","Construction Clearance for Coffee Ta Bai!","Tomas","2023-07-12 00:46:50");
INSERT INTO tbl_transactions VALUES("6","11","20230712923135000001","2023-07-12 00:54:44","Special Permit for Mismaler Corp. REPRESENTATIVE: Rustom Abella","Tom Abella","2023-07-12 00:54:44");
INSERT INTO tbl_transactions VALUES("7","11","20230712239831000001","2023-07-12 00:56:33","Special Permit for Mismaler Corp. REPRESENTATIVE: Rustom Abella","Tomas","2023-07-12 00:56:33");
INSERT INTO tbl_transactions VALUES("8","11","20230712615006000001","2023-07-12 00:57:01","Barangay Clearance for James Calapis Testing, Jr.","Tomas","2023-07-12 00:57:01");
INSERT INTO tbl_transactions VALUES("9","26","20230712857922000001","2023-07-12 13:01:28","Barangay Clearance for James Calapis Testing, Sr.","James","2023-07-12 13:01:28");
INSERT INTO tbl_transactions VALUES("10","28","20230712230343000001","2023-07-12 16:23:36","Special Permit for Mismaler Corp. REPRESENTATIVE: Rustom Abella","Jims","2023-07-12 16:23:36");
INSERT INTO tbl_transactions VALUES("11","28","20230712578011000001","2023-07-12 16:24:19","Barangay Clearance for James Calapis Testing, Sr.","Jims Jims","2023-07-12 16:24:19");
INSERT INTO tbl_transactions VALUES("0","11","20230722512320000001","2023-07-22 12:31:02","Construction Clearance for Coffee Ta Bai!","Tomas","2023-07-22 12:31:02");
INSERT INTO tbl_transactions VALUES("0","11","20230722980607000001","2023-07-22 12:33:43","Construction Clearance for Coffee Ta Bai!","Tomas","2023-07-22 12:33:43");
INSERT INTO tbl_transactions VALUES("0","11","20230722204764000001","2023-07-22 12:34:28","Construction Clearance for Lodan","James","2023-07-22 12:34:28");
INSERT INTO tbl_transactions VALUES("0","11","20230722061022000001","2023-07-22 12:39:17","Construction Clearance for Lodan","Tom Abella","2023-07-22 12:39:17");
INSERT INTO tbl_transactions VALUES("0","11","20230722887215000001","2023-07-22 12:45:32","Construction Clearance for Lodan","James Maximus","2023-07-22 12:45:32");
INSERT INTO tbl_transactions VALUES("0","11","20230722811058000001","2023-07-22 12:49:19","Construction Clearance for Lodan","Tomas","2023-07-22 12:49:19");
INSERT INTO tbl_transactions VALUES("0","11","20230722690138000001","2023-07-22 12:58:45","Construction Clearance for Coffee Ta Bai!","Tom'as","2023-07-22 12:58:45");
INSERT INTO tbl_transactions VALUES("0","11","20230722554522000001","2023-07-22 13:00:34","Construction Clearance for Coffee Ta Bai!","Tom'Abella","2023-07-22 13:00:34");
INSERT INTO tbl_transactions VALUES("0","11","20230722816984000001","2023-07-22 13:02:08","Construction Clearance for Loda'n","Tomas","2023-07-22 13:02:08");
INSERT INTO tbl_transactions VALUES("0","11","20230722045165000001","2023-07-22 13:12:53","Construction Clearance for Loda'n","Tom Abella","2023-07-22 13:12:53");
INSERT INTO tbl_transactions VALUES("12","11","20230724228863000001","2023-07-24 23:12:30","Barangay Clearance for James Calapis Testing, Jr.","Yuno","2023-07-24 23:12:30");
INSERT INTO tbl_transactions VALUES("0","11","20230725927361000001","2023-07-25 11:02:02","Certificate of Indigency for James Calapis Testing, Jr.","James","2023-07-25 11:02:02");
INSERT INTO tbl_transactions VALUES("0","11","20230726066544000001","2023-07-26 12:01:45","Certificate of Oneness for James Calapis Testing, Jr.","Tom Abella","2023-07-26 12:01:45");



#
# Delete any existing table `tbl_user_logs`
#

DROP TABLE IF EXISTS `tbl_user_logs`;


#
# Table structure of table `tbl_user_logs`
#



CREATE TABLE `tbl_user_logs` (
  `id_user_logs` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `details` varchar(100) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user_logs`),
  KEY `username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_user_logs VALUES("1","2023-07-12 02:05:39","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("2","2023-07-12 02:05:41","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("3","2023-07-12 02:19:12","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("4","2023-07-12 13:00:06","tom, has logged in.","26");
INSERT INTO tbl_user_logs VALUES("5","2023-07-12 13:00:37","tom, has logged out.","26");
INSERT INTO tbl_user_logs VALUES("6","2023-07-12 13:00:41","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("7","2023-07-12 13:00:55","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("8","2023-07-12 13:00:59","tom, has logged in.","26");
INSERT INTO tbl_user_logs VALUES("9","2023-07-12 13:03:34","tom, has logged out.","26");
INSERT INTO tbl_user_logs VALUES("10","2023-07-12 13:03:39","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("11","2023-07-12 13:04:53","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("12","2023-07-12 16:21:42","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("13","2023-07-12 16:22:46","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("14","2023-07-12 16:22:51","jims, has logged in.","28");
INSERT INTO tbl_user_logs VALUES("15","2023-07-12 16:23:04","jims, has logged out.","28");
INSERT INTO tbl_user_logs VALUES("16","2023-07-12 16:23:11","jims, has logged in.","28");
INSERT INTO tbl_user_logs VALUES("17","2023-07-12 16:24:46","jims, has logged out.","28");
INSERT INTO tbl_user_logs VALUES("18","2023-07-12 16:24:55","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("19","2023-07-12 16:25:39","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("20","2023-07-12 16:25:51","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("21","2023-07-12 16:26:30","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("22","2023-07-12 16:26:33","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("23","2023-07-13 07:50:26","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("24","2023-07-13 07:50:33","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("25","2023-07-13 07:50:54","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("26","2023-07-13 07:51:00","mismaan, has logged in.","27");
INSERT INTO tbl_user_logs VALUES("27","2023-07-13 07:51:12","mismaan, has logged out.","27");
INSERT INTO tbl_user_logs VALUES("28","2023-07-13 07:51:16","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("29","2023-07-22 12:30:05","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("30","2023-07-22 12:30:08","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("31","2023-07-22 13:02:52","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("32","2023-07-22 13:02:55","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("33","2023-07-22 13:06:21","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("34","2023-07-22 13:06:33","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("35","2023-07-22 13:14:44","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("36","2023-07-22 13:14:47","admin, has logged in.","11");



#
# Delete any existing table `tbl_users`
#

DROP TABLE IF EXISTS `tbl_users`;


#
# Table structure of table `tbl_users`
#



CREATE TABLE `tbl_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) DEFAULT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_middlename` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_users VALUES("10","staff","Marie Mae","Kump","Bullhorse","6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611","staff","03052021043218icon.png","Active","2021-05-03 10:32:18","2023-03-17 11:42:14");
INSERT INTO tbl_users VALUES("11","admin","Rustom","Calapis","Abella","cbfdac6008f9cab4083784cbd1874f76618d2a97","administrator","13022023093336head.jpg","Active","2021-05-03 10:33:03","2023-02-13 09:33:36");
INSERT INTO tbl_users VALUES("26","tom","Tom","","Abella","2bc6038c3dfca09b2da23c8b6da8ba884dc2dcc2","staff","data:image/jpeg;base64,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","Active","2023-02-13 08:37:22","2023-07-09 23:29:57");
INSERT INTO tbl_users VALUES("27","mismaan","Mismaan","","Lumaag","79f02606e3aa2d095783c566037f1757fe0c808f","staff","person.png","Active","2023-04-30 08:42:46","2023-04-30 08:42:46");
INSERT INTO tbl_users VALUES("28","jims","jims","test","sample","c1c83adaf3130fd0eaea46b603ad9904a3396ed2","administrator","person.png","Inactive","2023-07-12 16:22:33","2023-07-13 07:50:51");



#
# Delete any existing table `tblblotter`
#

DROP TABLE IF EXISTS `tblblotter`;


#
# Table structure of table `tblblotter`
#



CREATE TABLE `tblblotter` (
  `id_blotter` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_blotter`),
  KEY `noc` (`noc_id`),
  KEY `comp_name` (`comp_id`),
  KEY `resp_name` (`resp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tblblotter VALUES("1","Others","Sample","1","N/A","N/A","N/A","wew","wew","2","Active","2023-07-12 01:12:38","2023-07-12 01:16:32","11");
INSERT INTO tblblotter VALUES("2","2","N/A","N/A","Muzan Kibutsuji","Zone 5 Upper, Iponan, CDO","09097786675","wow","wow","1","Active","2023-07-12 01:13:13","2023-07-12 01:13:13","11");
INSERT INTO tblblotter VALUES("3","3","N/A","2","N/A","N/A","N/A","pow","pow","1","Active","2023-07-12 01:15:38","2023-07-12 01:15:38","11");



#
# Delete any existing table `tblblotter_schedule`
#

DROP TABLE IF EXISTS `tblblotter_schedule`;


#
# Table structure of table `tblblotter_schedule`
#



CREATE TABLE `tblblotter_schedule` (
  `id_blotter_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_blotter` int(11) NOT NULL,
  `blotter_date` date NOT NULL,
  `blotter_time` time NOT NULL,
  `created_at_blotter_schedule` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_blotter_schedule` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_blotter_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblblotter_schedule VALUES("3","3","2023-07-15","09:00:00","2023-07-12 01:15:38","2023-07-12 01:15:38");
INSERT INTO tblblotter_schedule VALUES("6","1","2023-07-20","10:30:00","2023-07-12 01:17:12","2023-07-12 01:17:12");
INSERT INTO tblblotter_schedule VALUES("9","2","2023-07-15","10:00:00","2023-07-12 01:22:48","2023-07-12 01:22:48");



#
# Delete any existing table `tblblotter_schedule_archive`
#

DROP TABLE IF EXISTS `tblblotter_schedule_archive`;


#
# Table structure of table `tblblotter_schedule_archive`
#



CREATE TABLE `tblblotter_schedule_archive` (
  `id_blotter_schedule_archive` int(11) NOT NULL AUTO_INCREMENT,
  `id_blotter` int(11) NOT NULL,
  `archive_blotter_date` date NOT NULL,
  `archive_blotter_time` time NOT NULL,
  `created_at_blotter_schedule_archive` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at_blotter_schedule_archive` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at_blotter_schedule` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_blotter_schedule_archive`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblblotter_schedule_archive VALUES("1","1","2023-07-12","09:23:00","2023-07-12 01:12:38","2023-07-12 01:12:38","2023-07-12 01:16:39");
INSERT INTO tblblotter_schedule_archive VALUES("2","1","2023-07-19","09:23:00","2023-07-12 01:16:39","2023-07-12 01:16:39","2023-07-12 01:16:53");
INSERT INTO tblblotter_schedule_archive VALUES("3","1","2023-07-19","10:30:00","2023-07-12 01:16:53","2023-07-12 01:16:53","2023-07-12 01:17:12");
INSERT INTO tblblotter_schedule_archive VALUES("4","2","2023-07-14","10:00:00","2023-07-12 01:13:13","2023-07-12 01:13:13","2023-07-12 01:22:08");
INSERT INTO tblblotter_schedule_archive VALUES("5","2","2023-07-12","10:00:00","2023-07-12 01:22:08","2023-07-12 01:22:08","2023-07-12 01:22:36");
INSERT INTO tblblotter_schedule_archive VALUES("6","2","2023-07-05","10:00:00","2023-07-12 01:22:36","2023-07-12 01:22:36","2023-07-12 01:22:48");



#
# Delete any existing table `tblbrgy_info`
#

DROP TABLE IF EXISTS `tblbrgy_info`;


#
# Table structure of table `tblbrgy_info`
#



CREATE TABLE `tblbrgy_info` (
  `id_brgy_info` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `dashboard_text` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `city_logo` varchar(100) DEFAULT NULL,
  `brgy_logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_brgy_info`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblbrgy_info VALUES("1","Misamis Oriental","Cagayan de Oro","Barangay 25","09124434562","Land of something
","08012023200651IMG_5300.jpg","28122022062802download.jpg","28122022062802LOGO.png");



#
# Delete any existing table `tblchairmanship`
#

DROP TABLE IF EXISTS `tblchairmanship`;


#
# Table structure of table `tblchairmanship`
#



CREATE TABLE `tblchairmanship` (
  `id_chairmanship` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_chairmanship`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblchairmanship VALUES("1","Committee on Infrastructure");
INSERT INTO tblchairmanship VALUES("2","Committee on Education");
INSERT INTO tblchairmanship VALUES("3","Committee on Health");
INSERT INTO tblchairmanship VALUES("4","Committee on Agriculture");
INSERT INTO tblchairmanship VALUES("5","Committee on Finance");
INSERT INTO tblchairmanship VALUES("6","Committee on Peace and Order");
INSERT INTO tblchairmanship VALUES("7","Committee on Tourism and Sports");



#
# Delete any existing table `tblofficials`
#

DROP TABLE IF EXISTS `tblofficials`;


#
# Table structure of table `tblofficials`
#



CREATE TABLE `tblofficials` (
  `id_officials` int(11) NOT NULL AUTO_INCREMENT,
  `honorifics` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `id_position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `archive` int(5) DEFAULT NULL COMMENT '0-NO; 1-YES;',
  PRIMARY KEY (`id_officials`),
  KEY `position` (`id_position`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficials VALUES("1","Hon.","Reuben U. Pacalioga","1","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("2","Hon.","Venus N. Ahmee","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("3","Hon.","Noel S. Ilogon","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("4","Hon.","Renan Noel B. Ilogon","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("5","Hon.","Glenn T. Inesin","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("6","Hon.","Democrito D. Elevado","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("7","Hon.","Alvin P. Garrote","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("8","Hon.","Alvin P. Garrote","2","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("9","Hon.","Pedro C. Sacal","2","2023-07-11","0024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("10","Hon.","Rey M. Galla","3","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("11","Hon.","Mirra G. Gabata","4","2023-07-11","2024-07-11","Incumbent","0");
INSERT INTO tblofficials VALUES("12","Hon.","Maricris O. Mabao","5","2023-07-11","2024-07-11","Incumbent","0");



#
# Delete any existing table `tblofficials_chairmanships`
#

DROP TABLE IF EXISTS `tblofficials_chairmanships`;


#
# Table structure of table `tblofficials_chairmanships`
#



CREATE TABLE `tblofficials_chairmanships` (
  `id_officials_chairmanship` int(11) NOT NULL AUTO_INCREMENT,
  `id_officials` int(11) NOT NULL,
  `id_chairmanship` int(11) NOT NULL,
  PRIMARY KEY (`id_officials_chairmanship`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficials_chairmanships VALUES("19","9","1");
INSERT INTO tblofficials_chairmanships VALUES("20","9","4");
INSERT INTO tblofficials_chairmanships VALUES("21","8","1");



#
# Delete any existing table `tblpayments`
#

DROP TABLE IF EXISTS `tblpayments`;


#
# Table structure of table `tblpayments`
#



CREATE TABLE `tblpayments` (
  `id_payments` int(11) NOT NULL AUTO_INCREMENT,
  `amounts` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_payments`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpayments VALUES("1","50.00");
INSERT INTO tblpayments VALUES("2","50.00");
INSERT INTO tblpayments VALUES("3","50.00");
INSERT INTO tblpayments VALUES("4","50.00");
INSERT INTO tblpayments VALUES("5","50.00");
INSERT INTO tblpayments VALUES("6","3000.00");
INSERT INTO tblpayments VALUES("7","5000.00");
INSERT INTO tblpayments VALUES("8","50.00");
INSERT INTO tblpayments VALUES("9","50.00");
INSERT INTO tblpayments VALUES("10","3000.00");
INSERT INTO tblpayments VALUES("11","50.00");
INSERT INTO tblpayments VALUES("12","50.00");



#
# Delete any existing table `tblpermit`
#

DROP TABLE IF EXISTS `tblpermit`;


#
# Table structure of table `tblpermit`
#



CREATE TABLE `tblpermit` (
  `id_permit` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `applied` date DEFAULT NULL,
  `id_user` varchar(10) NOT NULL,
  PRIMARY KEY (`id_permit`),
  KEY `username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpermit VALUES("1","Coffee Ta Bai!","Zone 06","2023-07-13","11");
INSERT INTO tblpermit VALUES("2","Lod'an","Zone 07","2023-07-22","11");
INSERT INTO tblpermit VALUES("3","Lodan","Zone 08","2023-07-22","11");
INSERT INTO tblpermit VALUES("4","Loda'n","Zone 09","2023-07-22","11");



#
# Delete any existing table `tblposition`
#

DROP TABLE IF EXISTS `tblposition`;


#
# Table structure of table `tblposition`
#



CREATE TABLE `tblposition` (
  `id_position` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_position`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblposition VALUES("1","Barangay Chairman","1");
INSERT INTO tblposition VALUES("2","Barangay Kagawad","2");
INSERT INTO tblposition VALUES("3","SK Kagawad","3");
INSERT INTO tblposition VALUES("4","Barangay Treasurer","4");
INSERT INTO tblposition VALUES("5","Barangay Secretary","5");



#
# Delete any existing table `tblprecinct`
#

DROP TABLE IF EXISTS `tblprecinct`;


#
# Table structure of table `tblprecinct`
#



CREATE TABLE `tblprecinct` (
  `id_precinct` int(11) NOT NULL AUTO_INCREMENT,
  `precinct` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  PRIMARY KEY (`id_precinct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




#
# Delete any existing table `tblpurok`
#

DROP TABLE IF EXISTS `tblpurok`;


#
# Table structure of table `tblpurok`
#



CREATE TABLE `tblpurok` (
  `id_purok` int(11) NOT NULL AUTO_INCREMENT,
  `purok_name` varchar(255) DEFAULT NULL,
  `purok_details` text DEFAULT NULL,
  PRIMARY KEY (`id_purok`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpurok VALUES("1","Zone 1","wew");
INSERT INTO tblpurok VALUES("2","Zone 2","");
INSERT INTO tblpurok VALUES("3","Zone 3","");
INSERT INTO tblpurok VALUES("4","Zone 4","");



#
# Delete any existing table `tblresident2`
#

DROP TABLE IF EXISTS `tblresident2`;


#
# Table structure of table `tblresident2`
#



CREATE TABLE `tblresident2` (
  `id_resident` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_resident`),
  KEY `householdnumber` (`id_household`),
  KEY `organization` (`id_org`),
  KEY `username` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblresident2 VALUES("1","1111-1111-1111","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","11072023225255285882556_1445824979206719_2927059040504518943_n.png","James","Calapis","Testing","Sr.","James","Jasaan","2001-07-11","Male","single","new","7","no","2001-07-11","Yes","","","","Student","1","2","No","Yes","","2023-07-12 01:21:38","11");
INSERT INTO tblresident2 VALUES("2","2222-2222-2222","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","James","Calapis","Testing","Jr.","Jem","Jasaan","2005-01-11","Male","single","co-occupant","7","no","2001-07-11","Yes","Unconfirmed","","","Student","1","none","No","Yes","","2023-07-11 23:51:52","11");

