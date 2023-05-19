# ABMS : MySQL database backup
#
# Generated: Thursday 18. May 2023
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_cert_appearance VALUES("1","RUSTOM C. ABELLA","SWORDSMITH VILLAGE","2023-02-13","Meeting with the Hashira","2023-02-13","11");
INSERT INTO tbl_cert_appearance VALUES("2","Tom Abella","Barangay 25 Hall","2023-03-17","Employment","2023-03-17","11");
INSERT INTO tbl_cert_appearance VALUES("3","Shinobu","Swordsmith Village","2023-04-12","to kill Muzan Kibutsuji","2023-05-02","11");
INSERT INTO tbl_cert_appearance VALUES("4","Weise Weise","Entertainment Arc","2023-05-02","Meeting with the hashira.","2023-05-02","11");
INSERT INTO tbl_cert_appearance VALUES("5","Sample Me","Cak","2023-05-01","visit tempest city","2023-05-02","11");



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
  `house_no` int(100) NOT NULL COMMENT '(2.1)',
  `id_purok` varchar(50) NOT NULL,
  `household_street_name` varchar(100) NOT NULL COMMENT '(2.2)',
  `household_address` varchar(250) NOT NULL COMMENT '(2.3)',
  `household_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id_household`),
  UNIQUE KEY `household_number` (`household_number`),
  KEY `household_purok` (`id_purok`),
  KEY `household_number_2` (`household_number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_household VALUES("1","1","1","1","Maagad St.","Abella's residence","residential");
INSERT INTO tbl_household VALUES("2","2","2","2","Pacana St.","Ella's Apartment","apartment");
INSERT INTO tbl_household VALUES("3","3","23","2","Laroka St.","scac","boarding house");
INSERT INTO tbl_household VALUES("4","5","5","2","Laroka St.","Doe Residence","residential");
INSERT INTO tbl_household VALUES("5","6","6","1","Muugad St.","Wang Residence","residential");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_nature_of_case VALUES("1","Light coercion","Light coercion","11","2023-02-13 08:36:04");
INSERT INTO tbl_nature_of_case VALUES("2","Physical Injury","Physical Injury","11","2023-02-13 08:36:45");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_org VALUES("1","Senior Citizen","Senior Citizen");
INSERT INTO tbl_org VALUES("2","SK","SK");



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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_p_emergency_contact VALUES("15","Tanjiro Kama Doe","Meek","2002-05-16","0988776654","","20230510219022000001","2023-05-16 11:35:00","2023-05-16 11:35:00");
INSERT INTO tbl_p_emergency_contact VALUES("16","Tanjiro Kama Doe","Brother","2023-05-17","09098876549","","20230510314056000001","2023-05-17 14:38:32","2023-05-17 14:38:32");



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
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_p_fam_members VALUES("26","11","mother","O","20230510314056000001","2023-05-10 08:38:03","2023-05-10 08:38:03");
INSERT INTO tbl_p_fam_members VALUES("30","16","mother","O","20230510219022000001","2023-05-10 09:13:06","2023-05-10 09:13:06");
INSERT INTO tbl_p_fam_members VALUES("31","15","father","O","20230510219022000001","2023-05-10 09:13:28","2023-05-10 09:13:28");
INSERT INTO tbl_p_fam_members VALUES("35","12","father","O","20230510314056000001","2023-05-10 11:17:12","2023-05-10 15:06:04");
INSERT INTO tbl_p_fam_members VALUES("108","18","children","","20230510219022000001","2023-05-16 11:34:08","2023-05-16 11:34:08");
INSERT INTO tbl_p_fam_members VALUES("109","19","children","","20230510219022000001","2023-05-16 11:34:08","2023-05-16 11:34:08");
INSERT INTO tbl_p_fam_members VALUES("114","17","children","","20230510219022000001","2023-05-16 20:34:58","2023-05-16 20:34:58");
INSERT INTO tbl_p_fam_members VALUES("119","13","children","","20230510314056000001","2023-05-17 14:24:32","2023-05-17 14:24:32");
INSERT INTO tbl_p_fam_members VALUES("121","14","children","","20230510314056000001","2023-05-17 14:26:30","2023-05-17 14:26:30");
INSERT INTO tbl_p_fam_members VALUES("122","21","children","","20230510314056000001","2023-05-17 14:26:30","2023-05-17 14:26:30");
INSERT INTO tbl_p_fam_members VALUES("123","22","children","","20230510314056000001","2023-05-17 14:26:50","2023-05-17 14:26:50");
INSERT INTO tbl_p_fam_members VALUES("124","20","children","","20230510219022000001","2023-05-17 14:27:07","2023-05-17 14:27:07");



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

INSERT INTO tbl_p_family VALUES("20230510314056000001","4");
INSERT INTO tbl_p_family VALUES("20230510219022000001","5");



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
  `p_weight` decimal(6,2) NOT NULL,
  `p_height` decimal(6,2) NOT NULL,
  `health_condition` decimal(6,2) NOT NULL COMMENT 'Body Mass Index',
  `last_mens_period_date` date NOT NULL,
  `expected_date_delivery` date NOT NULL,
  `delivered_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active; 1-archived',
  PRIMARY KEY (`id_mother_h_c_pregnancy_condition`)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_special_permit VALUES("1","Choco Shake","Rustom Abella","to perform installation of  streamer /tarpaulin along CM Recto – Julio Pacana St. junction. The  installation will start from August 25, 2015 and will expire on September 25,  2015.","2023-02-13","2024-02-13","2023-02-13","11");
INSERT INTO tbl_special_permit VALUES("2","Abella Construction Corp","Rustom Abella","to install","2023-03-17","2023-03-24","2023-03-17","11");
INSERT INTO tbl_special_permit VALUES("3","Mismaler Corp","Tomas Abella","to function the everything","2023-05-01","2023-05-05","2023-05-02","11");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_support VALUES("1","10","","TRY lang","Dili ko access.","resolved","2023-03-17 11:59:43");
INSERT INTO tbl_support VALUES("2","10","09098766654","Naunsa kaman?","Naa kay problema nako?! Tubag!","pending","2023-04-02 17:01:03");
INSERT INTO tbl_support VALUES("3","10","0909876554","hello","nauns kaman","resolved","2023-05-17 14:34:33");



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
  `recipient_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_transactions VALUES("1","11","20230501977391000001","2023-05-01 17:58:03","Barangay Clearance for Red, Test Testtwo","James");
INSERT INTO tbl_transactions VALUES("0","11","20230501072475000001","2023-05-01 17:59:28","Barangay Clearance for Abella, James ","James Maximus");
INSERT INTO tbl_transactions VALUES("2","27","20230501981494000001","2023-05-01 18:07:53","Barangay Clearance for Calapis, Motsur with authorization letter","Max");
INSERT INTO tbl_transactions VALUES("0","27","20230501153564000001","2023-05-01 18:08:20","Barangay Clearance for Calapis, Motsur ","Max again");
INSERT INTO tbl_transactions VALUES("0","11","20230501763408000001","2023-05-01 19:37:26","Certificate of Oneness for Abella, Tom ","James Reid");
INSERT INTO tbl_transactions VALUES("3","11","20230501127189000001","2023-05-01 19:39:04","Barangay Clearance for Abella, Tom ","James Reid");
INSERT INTO tbl_transactions VALUES("0","11","20230501455863000001","2023-05-01 20:27:33","Certificate of Indigency for Abella, James with authorization letter","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230501324629000001","2023-05-01 22:13:11","Certificate of Oneness for RUSTOM C. ABELLA","James Reid");
INSERT INTO tbl_transactions VALUES("0","11","20230501793821000001","2023-05-01 22:16:14","Certificate of Oneness for Tom Abella","James Rid");
INSERT INTO tbl_transactions VALUES("0","11","20230501150875000001","2023-05-01 23:01:16","Certificate of Appearance for RUSTOM C. ABELLA","Sample");
INSERT INTO tbl_transactions VALUES("0","11","20230501571457000001","2023-05-01 23:41:53","Construction Clearance for Jaime P. Ramen","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230501388226000001","2023-05-01 23:42:16","Construction Clearance for Milk Shake","James Reid");
INSERT INTO tbl_transactions VALUES("0","11","20230502415356000001","2023-05-02 00:07:31","Certificate of Appearance for Tom Abella","Testing Ni");
INSERT INTO tbl_transactions VALUES("0","11","20230502815615000001","2023-05-02 00:11:53","Certificate of Appearance for Shinobu","Ngek");
INSERT INTO tbl_transactions VALUES("0","11","20230502484127000001","2023-05-02 00:14:46","Construction Clearance for Shinobu","James Reid");
INSERT INTO tbl_transactions VALUES("4","11","20230502499088000001","2023-05-02 00:28:03","Special Permit for Choco Shake. REPRESENTATIVE: Rustom Abella","Nadine Lustre");
INSERT INTO tbl_transactions VALUES("5","11","20230502759245000001","2023-05-02 00:31:15","Special Permit for Mismaler Corp. REPRESENTATIVE: Tomas Abella","Tomassue");
INSERT INTO tbl_transactions VALUES("6","11","20230502571627000001","2023-05-02 09:16:09","Barangay Clearance for Wise, Weis ","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502781133000001","2023-05-02 09:21:36","Certificate of Indigency for Wise, Weis ","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502897122000001","2023-05-02 09:24:22","Certificate of Oneness for Wise, Weis ","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502168865000001","2023-05-02 09:37:40","Certificate of Appearance for Weise Weise","James Maximus");
INSERT INTO tbl_transactions VALUES("0","11","20230502965388000001","2023-05-02 09:48:05","Certificate of Appearance for RUSTOM C. ABELLA","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502750550000001","2023-05-02 09:55:47","Certificate of Appearance for Sample Me","Sample Me");
INSERT INTO tbl_transactions VALUES("7","11","20230503865832000001","2023-05-03 14:40:17","Barangay Clearance for TENANT, TENANT TENANT","James Reading");
INSERT INTO tbl_transactions VALUES("1","11","20230501977391000001","2023-05-01 17:58:03","Barangay Clearance for Red, Test Testtwo","James");
INSERT INTO tbl_transactions VALUES("0","11","20230501072475000001","2023-05-01 17:59:28","Barangay Clearance for Abella, James ","James Maximus");
INSERT INTO tbl_transactions VALUES("2","27","20230501981494000001","2023-05-01 18:07:53","Barangay Clearance for Calapis, Motsur with authorization letter","Max");
INSERT INTO tbl_transactions VALUES("0","27","20230501153564000001","2023-05-01 18:08:20","Barangay Clearance for Calapis, Motsur ","Max again");
INSERT INTO tbl_transactions VALUES("0","11","20230501763408000001","2023-05-01 19:37:26","Certificate of Oneness for Abella, Tom ","James Reid");
INSERT INTO tbl_transactions VALUES("3","11","20230501127189000001","2023-05-01 19:39:04","Barangay Clearance for Abella, Tom ","James Reid");
INSERT INTO tbl_transactions VALUES("0","11","20230501455863000001","2023-05-01 20:27:33","Certificate of Indigency for Abella, James with authorization letter","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230501324629000001","2023-05-01 22:13:11","Certificate of Oneness for RUSTOM C. ABELLA","James Reid");
INSERT INTO tbl_transactions VALUES("0","11","20230501793821000001","2023-05-01 22:16:14","Certificate of Oneness for Tom Abella","James Rid");
INSERT INTO tbl_transactions VALUES("0","11","20230501150875000001","2023-05-01 23:01:16","Certificate of Appearance for RUSTOM C. ABELLA","Sample");
INSERT INTO tbl_transactions VALUES("0","11","20230501571457000001","2023-05-01 23:41:53","Construction Clearance for Jaime P. Ramen","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230501388226000001","2023-05-01 23:42:16","Construction Clearance for Milk Shake","James Reid");
INSERT INTO tbl_transactions VALUES("0","11","20230502415356000001","2023-05-02 00:07:31","Certificate of Appearance for Tom Abella","Testing Ni");
INSERT INTO tbl_transactions VALUES("0","11","20230502815615000001","2023-05-02 00:11:53","Certificate of Appearance for Shinobu","Ngek");
INSERT INTO tbl_transactions VALUES("0","11","20230502484127000001","2023-05-02 00:14:46","Construction Clearance for Shinobu","James Reid");
INSERT INTO tbl_transactions VALUES("4","11","20230502499088000001","2023-05-02 00:28:03","Special Permit for Choco Shake. REPRESENTATIVE: Rustom Abella","Nadine Lustre");
INSERT INTO tbl_transactions VALUES("5","11","20230502759245000001","2023-05-02 00:31:15","Special Permit for Mismaler Corp. REPRESENTATIVE: Tomas Abella","Tomassue");
INSERT INTO tbl_transactions VALUES("6","11","20230502571627000001","2023-05-02 09:16:09","Barangay Clearance for Wise, Weis ","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502781133000001","2023-05-02 09:21:36","Certificate of Indigency for Wise, Weis ","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502897122000001","2023-05-02 09:24:22","Certificate of Oneness for Wise, Weis ","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502168865000001","2023-05-02 09:37:40","Certificate of Appearance for Weise Weise","James Maximus");
INSERT INTO tbl_transactions VALUES("0","11","20230502965388000001","2023-05-02 09:48:05","Certificate of Appearance for RUSTOM C. ABELLA","Tom Abella");
INSERT INTO tbl_transactions VALUES("0","11","20230502750550000001","2023-05-02 09:55:47","Certificate of Appearance for Sample Me","Sample Me");
INSERT INTO tbl_transactions VALUES("7","11","20230503865832000001","2023-05-03 14:40:17","Barangay Clearance for TENANT, TENANT TENANT","James Reading");



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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_user_logs VALUES("1","2023-02-12 22:00:55","admin, has logged out.","1");
INSERT INTO tbl_user_logs VALUES("2","2023-02-13 06:36:38","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("3","2023-02-13 06:37:49","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("4","2023-02-13 06:37:52","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("5","2023-02-13 06:38:44","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("6","2023-02-13 06:38:49","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("7","2023-02-13 06:41:37","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("8","2023-02-13 06:41:44","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("9","2023-02-13 06:44:41","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("10","2023-02-13 08:28:33","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("11","2023-02-14 00:31:33","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("12","2023-02-14 00:31:38","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("13","2023-02-14 00:31:52","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("14","2023-02-14 22:26:14","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("15","2023-02-14 22:26:43","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("16","2023-02-14 22:26:46","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("17","2023-02-15 00:29:49","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("18","2023-02-15 02:19:54","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("19","2023-02-15 02:20:06","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("20","2023-02-15 02:46:32","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("21","2023-03-17 11:54:32","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("22","2023-03-17 11:54:40","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("23","2023-03-17 11:59:49","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("24","2023-03-17 11:59:55","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("25","2023-03-20 13:44:16","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("26","2023-03-27 11:22:26","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("27","2023-03-27 12:05:26","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("28","2023-03-28 14:27:20","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("29","2023-03-30 11:47:15","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("30","2023-03-30 11:47:18","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("31","2023-04-02 15:48:15","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("32","2023-04-02 16:45:18","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("33","2023-04-02 17:00:35","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("34","2023-04-02 17:00:39","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("35","2023-04-02 17:01:06","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("36","2023-04-02 17:01:10","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("37","2023-04-02 17:52:14","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("38","2023-04-02 17:52:16","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("39","2023-04-02 22:46:13","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("40","2023-04-03 10:06:17","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("41","2023-04-03 13:59:58","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("42","2023-04-03 14:00:02","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("43","2023-04-03 14:09:15","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("44","2023-04-03 14:09:18","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("45","2023-04-03 14:09:43","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("46","2023-04-03 14:10:03","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("47","2023-04-03 14:15:14","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("48","2023-04-03 14:15:18","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("49","2023-04-03 14:20:14","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("50","2023-04-03 14:20:18","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("51","2023-04-03 14:33:30","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("52","2023-04-03 14:33:34","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("53","2023-04-03 17:09:57","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("54","2023-04-03 23:43:00","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("55","2023-04-04 00:20:02","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("56","2023-04-04 00:20:04","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("57","2023-04-04 00:21:33","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("58","2023-04-04 08:25:16","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("59","2023-04-04 11:47:20","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("60","2023-04-04 11:48:04","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("61","2023-04-04 11:48:11","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("62","2023-04-04 11:48:17","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("63","2023-04-12 23:25:24","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("64","2023-04-26 15:54:46","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("65","2023-04-28 09:10:51","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("66","2023-04-28 09:12:34","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("67","2023-04-28 14:06:56","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("68","2023-04-28 14:07:00","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("69","2023-04-28 14:21:08","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("70","2023-04-28 14:21:11","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("71","2023-04-29 19:46:43","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("72","2023-04-30 08:42:50","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("73","2023-04-30 08:42:54","mismaan, has logged in.","27");
INSERT INTO tbl_user_logs VALUES("74","2023-04-30 08:50:04","mismaan, has logged out.","27");
INSERT INTO tbl_user_logs VALUES("75","2023-04-30 08:51:30","mismaan, has logged in.","27");
INSERT INTO tbl_user_logs VALUES("76","2023-04-30 08:52:06","mismaan, has logged out.","27");
INSERT INTO tbl_user_logs VALUES("77","2023-04-30 08:52:55","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("78","2023-05-01 11:25:50","admin, has logged out.","");
INSERT INTO tbl_user_logs VALUES("79","2023-05-01 11:25:54","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("80","2023-05-01 13:17:44","admin, has logged out.","");
INSERT INTO tbl_user_logs VALUES("81","2023-05-01 13:17:47","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("82","2023-05-01 15:55:51","admin, has logged out.","1");
INSERT INTO tbl_user_logs VALUES("83","2023-05-01 15:55:57","mismaan, has logged in.","27");
INSERT INTO tbl_user_logs VALUES("84","2023-05-01 15:57:03","mismaan, has logged out.","27");
INSERT INTO tbl_user_logs VALUES("85","2023-05-01 15:57:09","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("86","2023-05-01 18:06:56","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("87","2023-05-01 18:07:02","mismaan, has logged in.","27");
INSERT INTO tbl_user_logs VALUES("88","2023-05-01 18:08:42","mismaan, has logged out.","27");
INSERT INTO tbl_user_logs VALUES("89","2023-05-01 18:08:47","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("90","2023-05-01 19:36:45","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("91","2023-05-02 10:51:48","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("92","2023-05-02 10:52:48","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("93","2023-05-02 10:52:50","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("94","2023-05-03 09:08:08","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("95","2023-05-03 21:03:26","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("96","2023-05-03 23:27:25","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("97","2023-05-05 09:42:26","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("98","2023-05-05 16:04:05","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("99","2023-05-06 17:09:50","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("100","2023-05-09 08:43:52","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("101","2023-05-09 11:30:28","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("102","2023-05-10 15:16:59","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("103","2023-05-12 16:02:00","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("104","2023-05-12 17:05:59","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("105","2023-05-13 08:17:19","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("106","2023-05-14 08:57:24","admin, has logged in.","11");
INSERT INTO tbl_user_logs VALUES("107","2023-05-17 14:34:07","admin, has logged out.","11");
INSERT INTO tbl_user_logs VALUES("108","2023-05-17 14:34:16","staff, has logged in.","10");
INSERT INTO tbl_user_logs VALUES("109","2023-05-17 14:34:37","staff, has logged out.","10");
INSERT INTO tbl_user_logs VALUES("110","2023-05-17 14:34:42","admin, has logged in.","11");



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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_users VALUES("10","staff","Marie Mae","Kump","Bullhorse","6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611","staff","03052021043218icon.png","Active","2021-05-03 10:32:18","2023-03-17 11:42:14");
INSERT INTO tbl_users VALUES("11","admin","Rustom","Calapis","Abella","cbfdac6008f9cab4083784cbd1874f76618d2a97","administrator","13022023093336head.jpg","Active","2021-05-03 10:33:03","2023-02-13 09:33:36");
INSERT INTO tbl_users VALUES("26","tom","Tom","","Abella","96835dd8bfa718bd6447ccc87af89ae1675daeca","staff","13022023083722casual-sleeve2.jpg","Active","2023-02-13 08:37:22","2023-02-13 08:37:22");
INSERT INTO tbl_users VALUES("27","mismaan","Mismaan","","Lumaag","79f02606e3aa2d095783c566037f1757fe0c808f","staff","person.png","Active","2023-04-30 08:42:46","2023-04-30 08:42:46");



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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO tblblotter VALUES("8","1","N/A","1","N/A","N/A","N/A","try","try","2","Forwarded to Lupon","2023-04-22 15:59:25","2023-05-06 00:17:00","11");
INSERT INTO tblblotter VALUES("9","Others","Testing Again","N/A","Shinobu","Zone 5 Upper, Iponan, CDO","09094568876","try","try","3","Forwarded to Lupon","2023-04-22 16:00:39","2023-05-05 23:51:52","11");
INSERT INTO tblblotter VALUES("10","1","N/A","N/A","Muzan Kibutsuji","Swordsmith Village","09097786675","wdefrew","fewfwe","5","Settled","2023-04-22 18:18:34","2023-05-06 00:53:07","11");
INSERT INTO tblblotter VALUES("12","1","N/A","4","N/A","N/A","N/A","tryyytrdy","rtysysthstr","10","Settled","2023-05-05 15:18:54","2023-05-07 16:18:12","11");
INSERT INTO tblblotter VALUES("13","2","N/A","N/A","Tokito","Tokito","09098764748","try","try","10","Settled","2023-05-05 15:26:15","2023-05-07 16:18:07","11");
INSERT INTO tblblotter VALUES("14","Others","Sample","N/A","Shinobu","Swordsmith Village","09098764748","fefefeter","ewgregreger","1","Settled","2023-05-06 09:04:47","2023-05-06 09:09:47","11");



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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblblotter_schedule VALUES("29","10","2023-04-22","14:20:00","2023-04-22 18:18:34","2023-04-22 18:18:34");
INSERT INTO tblblotter_schedule VALUES("43","9","2023-04-22","13:31:00","2023-05-05 16:05:16","2023-05-05 16:05:16");
INSERT INTO tblblotter_schedule VALUES("48","8","2023-05-03","13:30:00","2023-05-05 16:33:59","2023-05-05 16:33:59");
INSERT INTO tblblotter_schedule VALUES("54","13","2023-05-05","13:33:00","2023-05-05 23:40:57","2023-05-05 23:40:57");
INSERT INTO tblblotter_schedule VALUES("56","12","2023-05-06","13:33:00","2023-05-06 00:53:52","2023-05-06 00:53:52");
INSERT INTO tblblotter_schedule VALUES("57","14","2023-05-06","09:30:00","2023-05-06 09:04:47","2023-05-06 09:04:47");



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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblblotter_schedule_archive VALUES("3","8","2023-04-22","12:00:00","2023-04-22 15:59:25","2023-04-22 15:59:25","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("4","8","2023-04-22","13:00:00","2023-04-22 15:59:35","2023-04-22 15:59:35","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("5","9","2023-04-22","12:00:00","2023-04-22 16:00:39","2023-04-22 16:00:39","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("6","9","2023-04-22","12:30:00","2023-04-22 16:01:37","2023-04-22 16:01:37","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("7","8","2023-04-22","13:30:00","2023-04-22 15:59:56","2023-04-22 15:59:56","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("8","8","2023-04-22","12:30:00","2023-04-22 16:13:05","2023-04-22 16:13:05","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("9","8","2023-04-23","12:30:00","2023-04-22 16:39:38","2023-04-22 16:39:38","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("10","8","2023-04-22","12:30:00","2023-04-22 16:40:19","2023-04-22 16:40:19","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("11","9","2023-04-22","13:30:00","2023-04-22 16:10:13","2023-04-22 16:10:13","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("12","9","2023-04-22","12:30:00","2023-04-22 17:13:37","2023-04-22 17:13:37","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("13","8","2023-04-22","13:30:00","2023-04-22 16:42:26","2023-04-22 16:42:26","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("14","8","2023-04-22","13:20:00","2023-04-22 18:19:48","2023-04-22 18:19:48","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("15","8","2023-04-22","13:30:00","2023-04-22 18:20:20","2023-04-22 18:20:20","2023-04-27 16:40:51");
INSERT INTO tblblotter_schedule_archive VALUES("16","13","2023-05-05","18:30:00","2023-05-05 15:26:15","2023-05-05 15:26:15","2023-05-05 15:26:56");
INSERT INTO tblblotter_schedule_archive VALUES("17","12","2023-05-05","16:56:00","2023-05-05 15:18:54","2023-05-05 15:18:54","2023-05-05 15:37:07");
INSERT INTO tblblotter_schedule_archive VALUES("18","13","2023-05-05","13:30:00","2023-05-05 15:26:56","2023-05-05 15:26:56","2023-05-05 15:40:56");
INSERT INTO tblblotter_schedule_archive VALUES("19","13","2023-05-05","13:35:00","2023-05-05 15:40:56","2023-05-05 15:40:56","2023-05-05 15:46:33");
INSERT INTO tblblotter_schedule_archive VALUES("20","13","2023-05-05","13:30:00","2023-05-05 15:46:33","2023-05-05 15:46:33","2023-05-05 15:47:26");
INSERT INTO tblblotter_schedule_archive VALUES("21","8","2023-05-03","09:00:00","2023-04-27 16:38:46","2023-04-27 16:38:46","2023-05-05 15:48:15");
INSERT INTO tblblotter_schedule_archive VALUES("22","13","2023-05-05","13:36:00","2023-05-05 15:47:26","2023-05-05 15:47:26","2023-05-05 15:56:52");
INSERT INTO tblblotter_schedule_archive VALUES("23","9","2023-04-22","13:30:00","2023-04-22 18:13:25","2023-04-22 18:13:25","2023-05-05 16:05:16");
INSERT INTO tblblotter_schedule_archive VALUES("24","13","2023-05-05","13:30:00","2023-05-05 15:56:52","2023-05-05 15:56:52","2023-05-05 16:08:08");
INSERT INTO tblblotter_schedule_archive VALUES("25","8","2023-05-03","13:30:00","2023-05-05 15:48:15","2023-05-05 15:48:15","2023-05-05 16:08:41");
INSERT INTO tblblotter_schedule_archive VALUES("26","13","2023-05-05","13:31:00","2023-05-05 16:08:08","2023-05-05 16:08:08","2023-05-05 16:11:00");
INSERT INTO tblblotter_schedule_archive VALUES("27","13","2023-05-05","13:30:00","2023-05-05 16:11:00","2023-05-05 16:11:00","2023-05-05 16:32:48");
INSERT INTO tblblotter_schedule_archive VALUES("28","8","2023-05-03","13:31:00","2023-05-05 16:08:41","2023-05-05 16:08:41","2023-05-05 16:33:59");
INSERT INTO tblblotter_schedule_archive VALUES("29","12","2023-05-05","13:30:00","2023-05-05 15:37:07","2023-05-05 15:37:07","2023-05-05 16:35:04");
INSERT INTO tblblotter_schedule_archive VALUES("30","13","2023-05-05","13:31:00","2023-05-05 16:32:48","2023-05-05 16:32:48","2023-05-05 16:42:08");
INSERT INTO tblblotter_schedule_archive VALUES("31","12","2023-05-05","13:31:00","2023-05-05 16:35:04","2023-05-05 16:35:04","2023-05-05 16:45:40");
INSERT INTO tblblotter_schedule_archive VALUES("32","13","2023-05-05","13:32:00","2023-05-05 16:42:08","2023-05-05 16:42:08","2023-05-05 23:31:53");
INSERT INTO tblblotter_schedule_archive VALUES("33","12","2023-05-05","13:32:00","2023-05-05 16:45:40","2023-05-05 16:45:40","2023-05-05 23:39:53");
INSERT INTO tblblotter_schedule_archive VALUES("34","13","2023-05-05","13:32:00","2023-05-05 23:31:53","2023-05-05 23:31:53","2023-05-05 23:40:57");
INSERT INTO tblblotter_schedule_archive VALUES("35","12","2023-05-05","13:33:00","2023-05-05 23:39:53","2023-05-05 23:39:53","2023-05-06 00:13:15");
INSERT INTO tblblotter_schedule_archive VALUES("36","12","2023-05-05","13:33:00","2023-05-06 00:13:15","2023-05-06 00:13:15","2023-05-06 00:53:52");



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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblchairmanship VALUES("1","Committee on Infrastructure");
INSERT INTO tblchairmanship VALUES("2","Committee on Education");
INSERT INTO tblchairmanship VALUES("3","Committee on Health");
INSERT INTO tblchairmanship VALUES("4","Committee on Agriculture");
INSERT INTO tblchairmanship VALUES("5","Committee on Finance");
INSERT INTO tblchairmanship VALUES("6","Committee on Peace and Order");
INSERT INTO tblchairmanship VALUES("7","Committee on Tourism and Sports");
INSERT INTO tblchairmanship VALUES("8","Committee on Senior Citizen");



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

INSERT INTO tblofficials VALUES("1","Hon.","Reuben U. Pacalioga","1","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("2","Ms.","Venus N. Ahmee","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("3","Hon.","Noel S. Ilogon","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("4","Hon.","Renan Noel B. Ilogon","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("5","Hon.","Glenn T. Inesin","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("6","Hon.","Democrito D. Elevado","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("7","Hon.","Alvin P. Garrote","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("8","Hon.","Pedro C. Sacal","3","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("9","Hon.","Rey M. Galla","4","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("10","Ms.","Mirra G. Gabata","5","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("11","Ms.","Maricris O. Mabao","2","2023-04-28","2024-04-28","Incumbent","0");
INSERT INTO tblofficials VALUES("12","Ms.","Shinobu","3","2023-04-28","2024-04-28","Incumbent","0");



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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficials_chairmanships VALUES("13","2","2");
INSERT INTO tblofficials_chairmanships VALUES("14","2","8");
INSERT INTO tblofficials_chairmanships VALUES("21","5","1");
INSERT INTO tblofficials_chairmanships VALUES("22","5","2");
INSERT INTO tblofficials_chairmanships VALUES("23","5","4");
INSERT INTO tblofficials_chairmanships VALUES("24","6","1");
INSERT INTO tblofficials_chairmanships VALUES("25","6","2");
INSERT INTO tblofficials_chairmanships VALUES("26","6","5");
INSERT INTO tblofficials_chairmanships VALUES("27","7","3");
INSERT INTO tblofficials_chairmanships VALUES("28","7","5");
INSERT INTO tblofficials_chairmanships VALUES("29","7","6");
INSERT INTO tblofficials_chairmanships VALUES("30","8","1");
INSERT INTO tblofficials_chairmanships VALUES("31","8","8");
INSERT INTO tblofficials_chairmanships VALUES("50","3","2");
INSERT INTO tblofficials_chairmanships VALUES("51","3","5");
INSERT INTO tblofficials_chairmanships VALUES("52","12","1");
INSERT INTO tblofficials_chairmanships VALUES("53","9","6");
INSERT INTO tblofficials_chairmanships VALUES("54","4","1");
INSERT INTO tblofficials_chairmanships VALUES("55","4","2");
INSERT INTO tblofficials_chairmanships VALUES("56","4","5");



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpayments VALUES("1","20000.00");
INSERT INTO tblpayments VALUES("2","60000.00");
INSERT INTO tblpayments VALUES("3","99999999.99");
INSERT INTO tblpayments VALUES("4","399.00");
INSERT INTO tblpayments VALUES("5","6969.00");
INSERT INTO tblpayments VALUES("6","22.00");
INSERT INTO tblpayments VALUES("7","25.00");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpermit VALUES("1","Milk Shake","Infinity Castle","2023-02-13","11");
INSERT INTO tblpermit VALUES("2","Jaime P. Ramen","Zone 06","2023-03-17","11");
INSERT INTO tblpermit VALUES("3","Shinobu","Zone 07","2023-05-05","11");



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
INSERT INTO tblposition VALUES("2","Barangay Secretary","5");
INSERT INTO tblposition VALUES("3","Barangay Kagawad","2");
INSERT INTO tblposition VALUES("4","SK Chairman","3");
INSERT INTO tblposition VALUES("5","Barangay Treasurer","4");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblpurok VALUES("1","Zone 01","Zone 01");
INSERT INTO tblpurok VALUES("2","Zone 02","Zone 02");



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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblresident2 VALUES("1","1234-5678-9000","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","13022023090530unnamed.jpg","Tom","","Abella","","Tom","Bulua","2001-01-29","Male","single","new","4","yes","2019-02-13","Yes","Confirmed","09876543212","","Student","0","1","No","Yes","","2023-05-03 23:20:03","11");
INSERT INTO tblresident2 VALUES("2","0909-8765-3456","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","13022023090731uzui.jpg","Motsur","","Calapis","IV","Mot","Bulua","2001-01-01","Male","single","co-occupant","1","no","2023-02-13","No","","","","Student","1","none","Yes","Yes","","2023-03-13 12:57:23","11");
INSERT INTO tblresident2 VALUES("3","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","13022023090852tom.jpg","Tomas","","Howland","","Tom","Tacloban City","2001-01-29","Female","single","tenant","2","no","2021-02-13","No","","","","Student","1","1","No","No","","2023-02-15 00:29:23","11");
INSERT INTO tblresident2 VALUES("4","1111-1111-1111-1111","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Japanese","person.png","Sample","Sample","Sample","","Samp","Samps","2019-03-13","Male","single","new","1","yes","2023-03-13","Yes","Confirmed","","samp@mail.com","Student","1","none","No","No","","2023-03-13 12:55:37","11");
INSERT INTO tblresident2 VALUES("5","1223-3445-5677","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","170320231121111143202.jpg","Test","Testtwo","Red","Sr.","Tom","Japan","2002-03-17","Male","married","tenant","1","no","2023-03-17","Yes","Unconfirmed","","","N/A","1","none","No","No","","2023-03-17 11:21:11","11");
INSERT INTO tblresident2 VALUES("6","1233-3221-1232-4422","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","2204202318291920201018_123908.jpg","James","","Abella","","Max","Jasaan","2022-04-08","Male","single","co-occupant","4","no","2023-04-01","No","","","","N/A","1","none","No","No","","2023-05-03 14:23:56","11");
INSERT INTO tblresident2 VALUES("7","1234-5678-9097-8876","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Weis","","Wise","","WEE","Japan","2016-01-01","Male","single","co-occupant","1","","2021-01-02","No","","","","N/A","1","none","No","No","","2023-05-02 09:15:20","11");
INSERT INTO tblresident2 VALUES("8","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","New","New","New","Sr.","News","Jasaan","2020-01-03","Male","single","new","4","no","2023-05-03","No","","","","N/A","1","none","No","No","","2023-05-03 13:45:25","11");
INSERT INTO tblresident2 VALUES("9","7866-6666-6666-3323","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","COOCCUPANT","COOCCUPANT","COOCCUPANT","","COOCCUPANT","Japan","2001-05-03","Male","widow/er","co-occupant","1","no","2023-03-09","No","","","","N/A","1","none","No","No","","2023-05-03 14:35:24","11");
INSERT INTO tblresident2 VALUES("10","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","TENANT","TENANT","TENANT","","TENANT","Samps","2023-01-01","Male","married","tenant","1","","2023-05-03","No","","","","N/A","1","none","No","No","","2023-05-03 14:39:01","11");
INSERT INTO tblresident2 VALUES("11","1234-5678-7654","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Jane","","Doe","","Jin","Jasaan","1987-05-08","Female","married","co-occupant","4","","2023-05-01","No","","09876654342","","House Wife","1","none","No","No","","2023-05-08 09:54:22","11");
INSERT INTO tblresident2 VALUES("12","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","John","","Doe","","Jj","Jasaan","1978-05-02","Male","married","co-occupant","4","","2023-05-01","No","","","","Professor","1","none","No","No","","2023-05-08 09:58:56","11");
INSERT INTO tblresident2 VALUES("13","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Tom","","Doe","","Tomas","Jasaan","2001-01-01","Male","single","co-occupant","4","","2023-05-01","No","","","","Student","1","none","No","No","","2023-05-08 10:03:03","11");
INSERT INTO tblresident2 VALUES("14","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Halaka","","Doe","","Do","Jasaan","2003-01-29","Female","single","co-occupant","4","","2023-05-01","No","","","","Student","1","none","No","No","","2023-05-08 10:04:33","11");
INSERT INTO tblresident2 VALUES("15","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","10052023090643Screenshot_1.png","Boo","","Wang","","Boo","Jasaan","1975-03-13","Male","married","new","5","yes","2002-05-10","Yes","Confirmed","","","Professor","1","none","No","No","","2023-05-10 09:06:43","11");
INSERT INTO tblresident2 VALUES("16","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","10052023090532download.jpg","Malou","","Wang","","Lou","Bukidnon","1978-02-08","Female","married","co-occupant","5","no","2002-05-10","Yes","Unconfirmed","","","House Wife","1","none","No","No","","2023-05-10 09:05:32","11");
INSERT INTO tblresident2 VALUES("17","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","10052023090706Screenshot_2.png","Duke","","Wang","","Duke","Buki\","2001-01-01","Male","single","co-occupant","5","no","2002-05-10","No","","","","Student","1","none","No","No","","2023-05-10 09:07:06","11");
INSERT INTO tblresident2 VALUES("18","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","10052023091227Screenshot_3.png","Kala","","Wang","","Kal","Jasaan","2001-01-01","Female","single","co-occupant","5","no","2002-05-10","No","","","","Student","1","none","No","No","","2023-05-10 09:12:27","11");
INSERT INTO tblresident2 VALUES("19","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","10052023091250Screenshot_4.png","Vey","","Wang","","Vey","Jasaan","2013-01-01","Male","single","co-occupant","5","no","2002-05-10","No","","","","Student","1","none","No","No","","2023-05-10 09:12:50","11");
INSERT INTO tblresident2 VALUES("20","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Nee","","Wang","","Ne","Jasaan","2001-01-02","Male","single","co-occupant","5","no","2023-05-02","Yes","","","","Student","1","none","No","No","","2023-05-13 08:20:25","11");
INSERT INTO tblresident2 VALUES("21","0909-8765-4322","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Tanjiro","Kama","Doe","","Jiro","Japan","2001-01-29","Male","single","co-occupant","4","","2023-05-17","Yes","Confirmed","09764124567","tanjiro@gmail.com","Water Hashira / Sun Breathing Hashira","1","2","No","Yes","","2023-05-17 09:14:59","11");
INSERT INTO tblresident2 VALUES("22","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","person.png","Nimal","Ka","Doe","","Mil","Jasaan","2001-05-17","Female","single","co-occupant","4","","2023-05-17","No","","","","Water Hashira","1","2","No","No","","2023-05-17 09:19:02","11");

