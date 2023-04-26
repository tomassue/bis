# ABMS : MySQL database backup
#
# Generated: Thursday 6. April 2023
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_cert_appearance VALUES("1","RUSTOM C. ABELLA","SWORDSMITH VILLAGE","2023-02-13","Meeting with the Hashira","2023-02-13","11");
INSERT INTO tbl_cert_appearance VALUES("2","Tom Abella","Barangay 25 Hall","2023-03-17","Employment","2023-03-17","11");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_household VALUES("1","1","1","1","Maagad St.","Abella's residence","residential");
INSERT INTO tbl_household VALUES("2","2","2","2","Pacana St.","Ella's Apartment","apartment");
INSERT INTO tbl_household VALUES("3","3","23","2","Laroka St.","scac","boarding house");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_org VALUES("1","Senior Citizen","Senior Citizen");
INSERT INTO tbl_org VALUES("2","SK","SK");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_special_permit VALUES("1","Choco Shake","Rustom Abella","to perform installation of  streamer /tarpaulin along CM Recto – Julio Pacana St. junction. The  installation will start from August 25, 2015 and will expire on September 25,  2015.","2023-02-13","2024-02-13","2023-02-13","11");
INSERT INTO tbl_special_permit VALUES("2","Abella Construction Corp","Rustom Abella","to install","2023-03-17","2023-03-24","2023-03-17","11");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_support VALUES("1","10","","TRY lang","Dili ko access.","pending","2023-03-17 11:59:43");
INSERT INTO tbl_support VALUES("2","10","09098766654","Naunsa kaman?","Naa kay problema nako?! Tubag!","pending","2023-04-02 17:01:03");



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
  `details_transact` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_transactions VALUES("1","11","20230213428594000001","2023-02-13 09:09:16","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("2","11","20230213093033000001","2023-02-13 09:13:49","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("3","11","20230213553865000001","2023-02-13 10:00:32","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("4","11","20230213696736000001","2023-02-13 10:45:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("5","11","20230213112724000001","2023-02-13 10:59:42","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("6","11","20230213124928000001","2023-02-13 11:08:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("1","11","20230213428594000001","2023-02-13 09:09:16","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("2","11","20230213093033000001","2023-02-13 09:13:49","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("3","11","20230213553865000001","2023-02-13 10:00:32","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("4","11","20230213696736000001","2023-02-13 10:45:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("5","11","20230213112724000001","2023-02-13 10:59:42","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("6","11","20230213124928000001","2023-02-13 11:08:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("1","11","20230213428594000001","2023-02-13 09:09:16","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("2","11","20230213093033000001","2023-02-13 09:13:49","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("3","11","20230213553865000001","2023-02-13 10:00:32","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("4","11","20230213696736000001","2023-02-13 10:45:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("5","11","20230213112724000001","2023-02-13 10:59:42","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("6","11","20230213124928000001","2023-02-13 11:08:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("1","11","20230213428594000001","2023-02-13 09:09:16","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("2","11","20230213093033000001","2023-02-13 09:13:49","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("3","11","20230213553865000001","2023-02-13 10:00:32","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("4","11","20230213696736000001","2023-02-13 10:45:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("5","11","20230213112724000001","2023-02-13 10:59:42","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("6","11","20230213124928000001","2023-02-13 11:08:24","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("7","11","20230317705289000001","2023-03-17 11:23:39","Barangay Clearance Payment");
INSERT INTO tbl_transactions VALUES("8","11","20230317722073000001","2023-03-17 11:31:08","Special Permit Payment");
INSERT INTO tbl_transactions VALUES("9","11","20230402761046000001","2023-04-02 15:00:16","Barangay Clearance Payment");



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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_users VALUES("10","staff","Marie Mae","Kump","Bullhorse","6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611","staff","03052021043218icon.png","Active","2021-05-03 10:32:18","2023-03-17 11:42:14");
INSERT INTO tbl_users VALUES("11","admin","Rustom","Calapis","Abella","cbfdac6008f9cab4083784cbd1874f76618d2a97","administrator","13022023093336head.jpg","Active","2021-05-03 10:33:03","2023-02-13 09:33:36");
INSERT INTO tbl_users VALUES("26","tom","Tom","","Abella","96835dd8bfa718bd6447ccc87af89ae1675daeca","staff","13022023083722casual-sleeve2.jpg","Active","2023-02-13 08:37:22","2023-02-13 08:37:22");



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
  `blotter_date` date DEFAULT NULL,
  `blotter_time` time DEFAULT NULL,
  `blotter_status` varchar(50) DEFAULT 'Active',
  `created_at_blotter` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_blotter` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_blotter`),
  KEY `noc` (`noc_id`),
  KEY `comp_name` (`comp_id`),
  KEY `resp_name` (`resp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO tblblotter VALUES("1","1","N/A","1","N/A","N/A","N/A","Naunsa man diay?","Unsaon man diay?","3","2023-02-15","09:00:00","Settled","2023-02-13 11:11:41","2023-04-02 15:47:31","11");
INSERT INTO tblblotter VALUES("2","1","N/A","N/A","Tanjiro Kamado","Japan","09098776542","Naunsa man diay?","Unsaon man diay?","2","2023-02-13","00:00:00","Settled","2023-02-13 11:12:47","2023-02-13 11:29:16","11");
INSERT INTO tblblotter VALUES("4","Others","Hit and Run","N/A","James Ried","Zone 06","09098765567","Naligsan","Ma priso","1","2023-02-13","23:37:00","Forwarded to Lupon","2023-02-13 11:37:29","2023-02-13 14:11:22","11");
INSERT INTO tblblotter VALUES("5","2","N/A","1","N/A","N/A","N/A","nvm","nmv","3","2023-02-13","21:00:00","Forwarded to Lupon","2023-02-13 11:56:08","2023-02-13 14:11:12","11");
INSERT INTO tblblotter VALUES("6","1","N/A","1","N/A","N/A","N/A","mo","mi","3","2023-02-13","14:06:00","Forwarded to Lupon","2023-02-13 14:06:57","2023-02-13 14:11:05","11");
INSERT INTO tblblotter VALUES("7","1","N/A","1","N/A","N/A","N/A","mo","mi","3","2023-02-13","14:06:00","Settled","2023-02-13 14:06:57","2023-02-13 14:10:56","11");
INSERT INTO tblblotter VALUES("8","Others","Hit and Run","1","N/A","N/A","N/A","nakaligis","nakasagasa","3","2023-02-18","09:00:00","Forwarded to Lupon","2023-02-13 14:18:13","2023-04-02 16:34:53","11");
INSERT INTO tblblotter VALUES("9","Others","Sample","1","N/A","N/A","N/A","rfgrdtgh","dgdhf","2","2023-03-18","11:46:00","Forwarded to Lupon","2023-03-17 11:47:48","2023-03-18 11:49:07","11");
INSERT INTO tblblotter VALUES("10","2","N/A","3","N/A","N/A","N/A","Teest","Test","2","2023-03-31","11:30:00","Active","2023-03-30 11:29:21","2023-03-30 11:29:21","11");
INSERT INTO tblblotter VALUES("11","Others","Sample lang","5","N/A","N/A","N/A","Ty","Ty","3","2023-04-03","18:00:00","Active","2023-04-02 15:49:07","2023-04-02 15:49:07","11");



#
# Delete any existing table `tblblotter_reschedule`
#

DROP TABLE IF EXISTS `tblblotter_reschedule`;


#
# Table structure of table `tblblotter_reschedule`
#



CREATE TABLE `tblblotter_reschedule` (
  `id_blotter_reschedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_blotter` int(11) NOT NULL,
  `reschedule_date` date NOT NULL,
  `reschedule_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_blotter_reschedule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblchairmanship VALUES("1","Committee on Infrastructure");
INSERT INTO tblchairmanship VALUES("2","Committee on Education");
INSERT INTO tblchairmanship VALUES("3","Committee on Health");
INSERT INTO tblchairmanship VALUES("4","Committee on Agriculture");
INSERT INTO tblchairmanship VALUES("5","Committee on Finance");
INSERT INTO tblchairmanship VALUES("6","Committee on Peace and Order");
INSERT INTO tblchairmanship VALUES("7","Committee on Tourism and Sports");
INSERT INTO tblchairmanship VALUES("8","Senior Citizen");



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
  `id_chairmanship` varchar(50) DEFAULT NULL,
  `id_position` varchar(50) DEFAULT NULL,
  `termstart` date DEFAULT NULL,
  `termend` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_officials`),
  KEY `chairmanship` (`id_chairmanship`),
  KEY `position` (`id_position`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblofficials VALUES("1","Hon.","Reuben U. Pacalioga","1","1","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("2","Hon.","Venus N. Ahmee","8","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("3","Hon.","Noel S. Ilogon","1","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("4","Hon.","Renan Noel B. Ilogon","3","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("5","Hon.","Glenn T. Inesin","4","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("6","Hon.","Democrito D. Elevado","4","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("7","Hon.","Democrito D. Elevado","4","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("8","Hon.","Alvin P. Garrote","5","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("9","Hon.","Pedro C. Sacal","6","3","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("10","Hon.","Rey M. Galla","7","4","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("11","Ms.","Mirra G. Gabatan","7","5","2023-02-13","2024-02-13","Incumbent");
INSERT INTO tblofficials VALUES("12","Ms.","Maricris O. Mabao","6","2","2023-02-13","2024-02-13","Incumbent");



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
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_payments`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpayments VALUES("1","50.00","Tom  Abella");
INSERT INTO tblpayments VALUES("2","60.00","Motsur  Calapis");
INSERT INTO tblpayments VALUES("3","1000.00","Choco Shake");
INSERT INTO tblpayments VALUES("4","50.00","Tom  Abella");
INSERT INTO tblpayments VALUES("5","1000.00","Choco Shake");
INSERT INTO tblpayments VALUES("6","40.00","Motsur  Calapis");
INSERT INTO tblpayments VALUES("7","50.00","Test Testtwo Red");
INSERT INTO tblpayments VALUES("8","1000.00","Abella Construction Corp");
INSERT INTO tblpayments VALUES("9","500.00","Motsur  Calapis");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblpermit VALUES("1","Milk Shake","Infinity Castle","2023-02-13","11");
INSERT INTO tblpermit VALUES("2","Jaime P. Ramen","Zone 06","2023-03-17","11");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO tblresident2 VALUES("1","1234-5678-9000","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","13022023090530unnamed.jpg","Tom","","Abella","","Tom","Bulua","2001-01-29","Male","single","new","1","yes","2019-02-13","Yes","Confirmed","09876543212","","Student","0","1","No","Yes","","2023-03-31 10:51:39","11");
INSERT INTO tblresident2 VALUES("2","0909-8765-3456","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","13022023090731uzui.jpg","Motsur","","Calapis","IV","Mot","Bulua","2001-01-01","Male","single","co-occupant","1","no","2023-02-13","No","","","","Student","1","none","Yes","Yes","","2023-03-13 12:57:23","11");
INSERT INTO tblresident2 VALUES("3","","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","13022023090852tom.jpg","Tomas","","Howland","","Tom","Tacloban City","2001-01-29","Female","single","tenant","2","no","2021-02-13","No","","","","Student","1","1","No","No","","2023-02-15 00:29:23","11");
INSERT INTO tblresident2 VALUES("4","1111-1111-1111-1111","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Japanese","person.png","Sample","Sample","Sample","","Samp","Samps","2019-03-13","Male","single","new","1","yes","2023-03-13","Yes","Confirmed","","samp@mail.com","Student","1","none","No","No","","2023-03-13 12:55:37","11");
INSERT INTO tblresident2 VALUES("5","1223-3445-5677","Region X","Cagayan de Oro","Misamis Oriental","Barangay 25","Filipino","170320231121111143202.jpg","Test","Testtwo","Red","Sr.","Tom","Japan","2002-03-17","Male","married","tenant","1","no","2023-03-17","Yes","Unconfirmed","","","N/A","1","none","No","No","","2023-03-17 11:21:11","11");

