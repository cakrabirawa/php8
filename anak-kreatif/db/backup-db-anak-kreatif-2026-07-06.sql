-- AnakKreatif Database Backup
-- Host: localhost
-- Generation Time: 2026-07-06 04:38:49
-- ------------------------------------------------------
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `anak_kreatif`
--
CREATE DATABASE IF NOT EXISTS `anak_kreatif` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `anak_kreatif`;


-- --------------------------------------------------------

-- Table structure for table `access_logs`
--

DROP TABLE IF EXISTS `access_logs`;
CREATE TABLE `access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `access_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- Dumping data for table `access_logs`

INSERT INTO `access_logs` VALUES("1","beranda","::1","US","2026-07-06 03:28:13");
INSERT INTO `access_logs` VALUES("2","beranda","::1","US","2026-07-06 03:28:26");
INSERT INTO `access_logs` VALUES("3","beranda","::1","US","2026-07-06 03:35:49");
INSERT INTO `access_logs` VALUES("4","beranda","::1","US","2026-07-06 03:51:04");
INSERT INTO `access_logs` VALUES("5","toko","::1","US","2026-07-06 03:58:29");
INSERT INTO `access_logs` VALUES("6","kelas","::1","US","2026-07-06 03:58:33");
INSERT INTO `access_logs` VALUES("7","beranda","::1","US","2026-07-06 04:24:34");
INSERT INTO `access_logs` VALUES("8","beranda","::1","US","2026-07-06 04:24:55");
INSERT INTO `access_logs` VALUES("9","beranda","::1","US","2026-07-06 04:27:12");
INSERT INTO `access_logs` VALUES("10","beranda","::1","US","2026-07-06 04:27:44");
INSERT INTO `access_logs` VALUES("11","beranda","::1","US","2026-07-06 04:30:02");
INSERT INTO `access_logs` VALUES("12","beranda","::1","US","2026-07-06 04:30:28");
INSERT INTO `access_logs` VALUES("13","beranda","::1","US","2026-07-06 04:32:40");
INSERT INTO `access_logs` VALUES("14","beranda","::1","US","2026-07-06 04:34:38");
INSERT INTO `access_logs` VALUES("15","beranda","::1","US","2026-07-06 04:37:21");
INSERT INTO `access_logs` VALUES("16","beranda","::1","US","2026-07-06 04:39:18");
INSERT INTO `access_logs` VALUES("17","beranda","::1","US","2026-07-06 04:41:35");
INSERT INTO `access_logs` VALUES("18","beranda","::1","US","2026-07-06 04:44:08");
INSERT INTO `access_logs` VALUES("19","beranda","::1","US","2026-07-06 04:46:02");
INSERT INTO `access_logs` VALUES("20","beranda","::1","US","2026-07-06 04:48:46");
INSERT INTO `access_logs` VALUES("21","beranda","::1","US","2026-07-06 04:56:06");
INSERT INTO `access_logs` VALUES("22","beranda","::1","US","2026-07-06 04:58:12");
INSERT INTO `access_logs` VALUES("23","beranda","::1","US","2026-07-06 05:02:12");
INSERT INTO `access_logs` VALUES("24","beranda","::1","US","2026-07-06 05:03:03");
INSERT INTO `access_logs` VALUES("25","beranda","::1","US","2026-07-06 05:03:14");
INSERT INTO `access_logs` VALUES("26","beranda","::1","US","2026-07-06 05:05:34");
INSERT INTO `access_logs` VALUES("27","beranda","::1","US","2026-07-06 05:06:04");
INSERT INTO `access_logs` VALUES("28","beranda","::1","US","2026-07-06 05:06:20");
INSERT INTO `access_logs` VALUES("29","beranda","::1","US","2026-07-06 05:06:23");
INSERT INTO `access_logs` VALUES("30","beranda","::1","US","2026-07-06 05:06:48");
INSERT INTO `access_logs` VALUES("31","beranda","::1","US","2026-07-06 05:07:04");
INSERT INTO `access_logs` VALUES("32","beranda","::1","US","2026-07-06 05:07:16");
INSERT INTO `access_logs` VALUES("33","beranda","::1","US","2026-07-06 05:08:53");
INSERT INTO `access_logs` VALUES("34","toko","::1","US","2026-07-06 05:09:12");
INSERT INTO `access_logs` VALUES("35","toko","::1","US","2026-07-06 05:09:55");
INSERT INTO `access_logs` VALUES("36","toko","::1","US","2026-07-06 05:10:01");
INSERT INTO `access_logs` VALUES("37","toko","::1","US","2026-07-06 05:10:21");
INSERT INTO `access_logs` VALUES("38","toko","::1","US","2026-07-06 05:11:55");
INSERT INTO `access_logs` VALUES("39","beranda","::1","US","2026-07-06 05:11:59");
INSERT INTO `access_logs` VALUES("40","beranda","::1","US","2026-07-06 05:12:00");
INSERT INTO `access_logs` VALUES("41","beranda","::1","US","2026-07-06 05:13:48");
INSERT INTO `access_logs` VALUES("42","beranda","::1","US","2026-07-06 05:14:53");
INSERT INTO `access_logs` VALUES("43","beranda","::1","US","2026-07-06 05:15:38");
INSERT INTO `access_logs` VALUES("44","beranda","::1","US","2026-07-06 05:15:58");
INSERT INTO `access_logs` VALUES("45","beranda","::1","US","2026-07-06 05:16:00");
INSERT INTO `access_logs` VALUES("46","beranda","::1","US","2026-07-06 05:16:09");
INSERT INTO `access_logs` VALUES("47","beranda","::1","US","2026-07-06 05:16:27");
INSERT INTO `access_logs` VALUES("48","beranda","::1","US","2026-07-06 05:16:32");
INSERT INTO `access_logs` VALUES("49","beranda","::1","US","2026-07-06 05:16:37");
INSERT INTO `access_logs` VALUES("50","beranda","::1","US","2026-07-06 05:16:50");
INSERT INTO `access_logs` VALUES("51","beranda","::1","US","2026-07-06 05:16:52");
INSERT INTO `access_logs` VALUES("52","beranda","::1","US","2026-07-06 05:16:59");
INSERT INTO `access_logs` VALUES("53","beranda","::1","US","2026-07-06 05:17:20");
INSERT INTO `access_logs` VALUES("54","beranda","::1","US","2026-07-06 05:19:16");
INSERT INTO `access_logs` VALUES("55","beranda","::1","US","2026-07-06 05:19:30");
INSERT INTO `access_logs` VALUES("56","beranda","::1","US","2026-07-06 05:19:33");
INSERT INTO `access_logs` VALUES("57","beranda","::1","US","2026-07-06 05:19:47");
INSERT INTO `access_logs` VALUES("58","beranda","::1","US","2026-07-06 05:20:17");
INSERT INTO `access_logs` VALUES("59","toko","::1","US","2026-07-06 05:20:35");
INSERT INTO `access_logs` VALUES("60","toko","::1","US","2026-07-06 05:20:37");
INSERT INTO `access_logs` VALUES("61","toko","::1","US","2026-07-06 05:20:39");
INSERT INTO `access_logs` VALUES("62","toko","::1","US","2026-07-06 05:20:40");
INSERT INTO `access_logs` VALUES("63","toko","::1","US","2026-07-06 05:20:41");
INSERT INTO `access_logs` VALUES("64","kelas","::1","US","2026-07-06 05:20:42");
INSERT INTO `access_logs` VALUES("65","beranda","::1","US","2026-07-06 05:20:48");
INSERT INTO `access_logs` VALUES("66","beranda","::1","US","2026-07-06 05:21:18");
INSERT INTO `access_logs` VALUES("67","beranda","::1","US","2026-07-06 05:21:34");
INSERT INTO `access_logs` VALUES("68","beranda","::1","US","2026-07-06 05:21:40");
INSERT INTO `access_logs` VALUES("69","beranda","::1","US","2026-07-06 05:21:53");
INSERT INTO `access_logs` VALUES("70","beranda","::1","US","2026-07-06 05:22:00");
INSERT INTO `access_logs` VALUES("71","beranda","::1","US","2026-07-06 05:22:09");
INSERT INTO `access_logs` VALUES("72","beranda","::1","US","2026-07-06 05:22:16");
INSERT INTO `access_logs` VALUES("73","beranda","::1","US","2026-07-06 05:22:37");
INSERT INTO `access_logs` VALUES("74","beranda","::1","US","2026-07-06 05:23:41");
INSERT INTO `access_logs` VALUES("75","beranda","::1","US","2026-07-06 05:23:57");
INSERT INTO `access_logs` VALUES("76","beranda","::1","US","2026-07-06 05:25:11");
INSERT INTO `access_logs` VALUES("77","beranda","::1","US","2026-07-06 05:25:29");
INSERT INTO `access_logs` VALUES("78","beranda","::1","US","2026-07-06 05:25:53");
INSERT INTO `access_logs` VALUES("79","beranda","::1","US","2026-07-06 05:26:02");
INSERT INTO `access_logs` VALUES("80","beranda","::1","US","2026-07-06 05:26:23");
INSERT INTO `access_logs` VALUES("81","beranda","::1","US","2026-07-06 05:26:35");
INSERT INTO `access_logs` VALUES("82","beranda","::1","US","2026-07-06 05:26:43");
INSERT INTO `access_logs` VALUES("83","beranda","::1","US","2026-07-06 05:27:06");
INSERT INTO `access_logs` VALUES("84","beranda","::1","US","2026-07-06 05:27:13");
INSERT INTO `access_logs` VALUES("85","beranda","::1","US","2026-07-06 05:28:37");
INSERT INTO `access_logs` VALUES("86","beranda","::1","US","2026-07-06 05:29:05");
INSERT INTO `access_logs` VALUES("87","beranda","::1","US","2026-07-06 05:29:27");
INSERT INTO `access_logs` VALUES("88","beranda","::1","US","2026-07-06 05:29:33");
INSERT INTO `access_logs` VALUES("89","beranda","::1","US","2026-07-06 05:30:08");
INSERT INTO `access_logs` VALUES("90","beranda","::1","US","2026-07-06 05:30:36");
INSERT INTO `access_logs` VALUES("91","beranda","::1","US","2026-07-06 05:30:49");
INSERT INTO `access_logs` VALUES("92","beranda","::1","US","2026-07-06 05:30:56");
INSERT INTO `access_logs` VALUES("93","beranda","::1","US","2026-07-06 05:31:08");
INSERT INTO `access_logs` VALUES("94","beranda","::1","US","2026-07-06 05:31:27");
INSERT INTO `access_logs` VALUES("95","beranda","::1","US","2026-07-06 05:31:31");
INSERT INTO `access_logs` VALUES("96","beranda","::1","US","2026-07-06 05:31:42");
INSERT INTO `access_logs` VALUES("97","beranda","::1","US","2026-07-06 05:32:03");
INSERT INTO `access_logs` VALUES("98","beranda","::1","US","2026-07-06 05:32:18");
INSERT INTO `access_logs` VALUES("99","beranda","::1","US","2026-07-06 05:32:19");
INSERT INTO `access_logs` VALUES("100","beranda","::1","US","2026-07-06 05:32:53");
INSERT INTO `access_logs` VALUES("101","beranda","::1","US","2026-07-06 05:33:22");
INSERT INTO `access_logs` VALUES("102","beranda","::1","US","2026-07-06 05:33:27");
INSERT INTO `access_logs` VALUES("103","beranda","::1","US","2026-07-06 05:33:31");
INSERT INTO `access_logs` VALUES("104","beranda","::1","US","2026-07-06 05:33:37");
INSERT INTO `access_logs` VALUES("105","beranda","::1","US","2026-07-06 05:33:42");
INSERT INTO `access_logs` VALUES("106","beranda","::1","US","2026-07-06 05:34:08");
INSERT INTO `access_logs` VALUES("107","beranda","::1","US","2026-07-06 05:34:15");
INSERT INTO `access_logs` VALUES("108","beranda","::1","US","2026-07-06 05:34:22");
INSERT INTO `access_logs` VALUES("109","beranda","::1","US","2026-07-06 05:34:32");
INSERT INTO `access_logs` VALUES("110","beranda","::1","US","2026-07-06 05:34:40");
INSERT INTO `access_logs` VALUES("111","beranda","::1","US","2026-07-06 05:34:50");
INSERT INTO `access_logs` VALUES("112","beranda","::1","US","2026-07-06 05:34:55");
INSERT INTO `access_logs` VALUES("113","beranda","::1","US","2026-07-06 05:35:02");
INSERT INTO `access_logs` VALUES("114","beranda","::1","US","2026-07-06 05:35:23");
INSERT INTO `access_logs` VALUES("115","beranda","::1","US","2026-07-06 05:35:31");
INSERT INTO `access_logs` VALUES("116","beranda","::1","US","2026-07-06 05:38:54");
INSERT INTO `access_logs` VALUES("117","beranda","::1","US","2026-07-06 05:39:13");
INSERT INTO `access_logs` VALUES("118","beranda","::1","US","2026-07-06 05:42:46");
INSERT INTO `access_logs` VALUES("119","beranda","::1","US","2026-07-06 05:43:06");
INSERT INTO `access_logs` VALUES("120","beranda","::1","US","2026-07-06 05:43:15");
INSERT INTO `access_logs` VALUES("121","beranda","::1","US","2026-07-06 05:43:24");
INSERT INTO `access_logs` VALUES("122","beranda","::1","US","2026-07-06 05:43:38");
INSERT INTO `access_logs` VALUES("123","beranda","::1","US","2026-07-06 05:43:53");
INSERT INTO `access_logs` VALUES("124","beranda","::1","US","2026-07-06 05:44:01");
INSERT INTO `access_logs` VALUES("125","beranda","::1","US","2026-07-06 05:44:32");
INSERT INTO `access_logs` VALUES("126","beranda","::1","US","2026-07-06 05:44:36");
INSERT INTO `access_logs` VALUES("127","beranda","::1","US","2026-07-06 05:44:40");
INSERT INTO `access_logs` VALUES("128","beranda","::1","US","2026-07-06 05:44:50");
INSERT INTO `access_logs` VALUES("129","beranda","::1","US","2026-07-06 05:44:56");
INSERT INTO `access_logs` VALUES("130","beranda","::1","US","2026-07-06 05:45:16");
INSERT INTO `access_logs` VALUES("131","beranda","::1","US","2026-07-06 05:45:33");
INSERT INTO `access_logs` VALUES("132","beranda","::1","US","2026-07-06 07:39:40");
INSERT INTO `access_logs` VALUES("133","beranda","::1","US","2026-07-06 07:45:45");
INSERT INTO `access_logs` VALUES("134","beranda","::1","US","2026-07-06 07:52:19");
INSERT INTO `access_logs` VALUES("135","beranda","::1","US","2026-07-06 07:53:00");
INSERT INTO `access_logs` VALUES("136","beranda","::1","US","2026-07-06 07:53:02");
INSERT INTO `access_logs` VALUES("137","beranda","::1","US","2026-07-06 08:00:20");
INSERT INTO `access_logs` VALUES("138","beranda","::1","US","2026-07-06 08:12:15");
INSERT INTO `access_logs` VALUES("139","toko","::1","US","2026-07-06 08:12:17");
INSERT INTO `access_logs` VALUES("140","toko","::1","US","2026-07-06 08:12:21");
INSERT INTO `access_logs` VALUES("141","kelas","::1","US","2026-07-06 08:12:23");
INSERT INTO `access_logs` VALUES("142","beranda","::1","US","2026-07-06 08:12:24");
INSERT INTO `access_logs` VALUES("143","beranda","::1","US","2026-07-06 08:15:13");
INSERT INTO `access_logs` VALUES("144","beranda","::1","US","2026-07-06 08:48:19");
INSERT INTO `access_logs` VALUES("145","kelas","::1","US","2026-07-06 08:48:44");
INSERT INTO `access_logs` VALUES("146","toko","::1","US","2026-07-06 08:48:46");
INSERT INTO `access_logs` VALUES("147","toko","::1","US","2026-07-06 08:48:47");
INSERT INTO `access_logs` VALUES("148","toko","::1","US","2026-07-06 08:48:48");
INSERT INTO `access_logs` VALUES("149","toko","::1","US","2026-07-06 08:48:48");
INSERT INTO `access_logs` VALUES("150","toko","::1","US","2026-07-06 08:48:49");
INSERT INTO `access_logs` VALUES("151","toko","::1","US","2026-07-06 08:48:49");
INSERT INTO `access_logs` VALUES("152","kelas","::1","US","2026-07-06 08:48:50");
INSERT INTO `access_logs` VALUES("153","kelas","::1","US","2026-07-06 09:16:22");
INSERT INTO `access_logs` VALUES("154","kelas","::1","US","2026-07-06 09:19:01");
INSERT INTO `access_logs` VALUES("155","admin/assets","::1","US","2026-07-06 09:19:53");
INSERT INTO `access_logs` VALUES("156","admin/assets","::1","US","2026-07-06 09:20:28");
INSERT INTO `access_logs` VALUES("157","admin/assets","::1","US","2026-07-06 09:20:30");
INSERT INTO `access_logs` VALUES("158","admin/assets","::1","US","2026-07-06 09:20:35");
INSERT INTO `access_logs` VALUES("159","admin/assets","::1","US","2026-07-06 09:21:22");
INSERT INTO `access_logs` VALUES("160","admin/assets","::1","US","2026-07-06 09:23:04");
INSERT INTO `access_logs` VALUES("161","admin/assets","::1","US","2026-07-06 09:23:47");
INSERT INTO `access_logs` VALUES("162","admin/assets","::1","US","2026-07-06 09:24:24");
INSERT INTO `access_logs` VALUES("163","admin/assets","::1","US","2026-07-06 09:24:30");
INSERT INTO `access_logs` VALUES("164","admin/assets","::1","US","2026-07-06 09:25:25");
INSERT INTO `access_logs` VALUES("165","admin/assets","::1","US","2026-07-06 09:26:19");
INSERT INTO `access_logs` VALUES("166","admin/assets","::1","US","2026-07-06 09:26:43");
INSERT INTO `access_logs` VALUES("167","admin/assets","::1","US","2026-07-06 09:27:33");
INSERT INTO `access_logs` VALUES("168","admin/assets","::1","US","2026-07-06 09:27:53");
INSERT INTO `access_logs` VALUES("169","admin/assets","::1","US","2026-07-06 09:28:42");
INSERT INTO `access_logs` VALUES("170","admin/assets","::1","US","2026-07-06 09:28:47");
INSERT INTO `access_logs` VALUES("171","admin/assets","::1","US","2026-07-06 09:28:50");
INSERT INTO `access_logs` VALUES("172","admin/assets","::1","US","2026-07-06 09:28:53");
INSERT INTO `access_logs` VALUES("173","admin/assets","::1","US","2026-07-06 09:28:57");
INSERT INTO `access_logs` VALUES("174","admin/assets","::1","US","2026-07-06 09:28:59");
INSERT INTO `access_logs` VALUES("175","admin/assets","::1","US","2026-07-06 09:29:05");
INSERT INTO `access_logs` VALUES("176","admin/assets","::1","US","2026-07-06 09:29:06");
INSERT INTO `access_logs` VALUES("177","admin/assets","::1","US","2026-07-06 09:29:08");
INSERT INTO `access_logs` VALUES("178","admin/assets","::1","US","2026-07-06 09:29:10");
INSERT INTO `access_logs` VALUES("179","admin/assets","::1","US","2026-07-06 09:29:11");
INSERT INTO `access_logs` VALUES("180","admin/assets","::1","US","2026-07-06 09:29:25");
INSERT INTO `access_logs` VALUES("181","admin/assets","::1","US","2026-07-06 09:30:21");
INSERT INTO `access_logs` VALUES("182","admin/assets","::1","US","2026-07-06 09:31:25");
INSERT INTO `access_logs` VALUES("183","admin/assets","::1","US","2026-07-06 09:32:22");
INSERT INTO `access_logs` VALUES("184","admin/assets","::1","US","2026-07-06 09:34:01");
INSERT INTO `access_logs` VALUES("185","admin/assets","::1","US","2026-07-06 09:34:41");
INSERT INTO `access_logs` VALUES("186","admin/assets","::1","US","2026-07-06 09:35:27");
INSERT INTO `access_logs` VALUES("187","admin/assets","::1","US","2026-07-06 09:37:04");
INSERT INTO `access_logs` VALUES("188","admin/assets","::1","US","2026-07-06 09:38:38");
INSERT INTO `access_logs` VALUES("189","admin/assets","::1","US","2026-07-06 09:40:38");
INSERT INTO `access_logs` VALUES("190","admin/assets","::1","US","2026-07-06 09:41:48");
INSERT INTO `access_logs` VALUES("191","admin/assets","::1","US","2026-07-06 09:42:47");
INSERT INTO `access_logs` VALUES("192","admin/assets","::1","US","2026-07-06 09:43:48");
INSERT INTO `access_logs` VALUES("193","admin/assets","::1","US","2026-07-06 09:43:49");
INSERT INTO `access_logs` VALUES("194","admin/assets","::1","US","2026-07-06 09:47:08");
INSERT INTO `access_logs` VALUES("195","admin/assets","::1","US","2026-07-06 09:47:15");
INSERT INTO `access_logs` VALUES("196","admin/assets","::1","US","2026-07-06 09:47:16");
INSERT INTO `access_logs` VALUES("197","admin/assets","::1","US","2026-07-06 09:47:19");
INSERT INTO `access_logs` VALUES("198","admin/assets","::1","US","2026-07-06 09:47:21");
INSERT INTO `access_logs` VALUES("199","admin/assets","::1","US","2026-07-06 09:47:25");
INSERT INTO `access_logs` VALUES("200","admin/assets","::1","US","2026-07-06 09:48:44");
INSERT INTO `access_logs` VALUES("201","admin/assets","::1","US","2026-07-06 09:48:55");
INSERT INTO `access_logs` VALUES("202","admin/assets","::1","US","2026-07-06 09:52:41");
INSERT INTO `access_logs` VALUES("203","admin/assets","::1","US","2026-07-06 10:03:03");
INSERT INTO `access_logs` VALUES("204","admin/assets","::1","US","2026-07-06 10:03:07");
INSERT INTO `access_logs` VALUES("205","admin/assets","::1","US","2026-07-06 10:09:50");
INSERT INTO `access_logs` VALUES("206","admin/assets","::1","US","2026-07-06 10:12:15");
INSERT INTO `access_logs` VALUES("207","admin/assets","::1","US","2026-07-06 10:12:18");
INSERT INTO `access_logs` VALUES("208","admin/assets","::1","US","2026-07-06 10:14:56");
INSERT INTO `access_logs` VALUES("209","admin/assets","::1","US","2026-07-06 10:22:23");
INSERT INTO `access_logs` VALUES("210","admin/assets","::1","US","2026-07-06 10:22:25");
INSERT INTO `access_logs` VALUES("211","admin/assets","::1","US","2026-07-06 10:24:13");
INSERT INTO `access_logs` VALUES("212","admin/assets","::1","US","2026-07-06 10:25:10");
INSERT INTO `access_logs` VALUES("213","admin/assets","::1","US","2026-07-06 10:26:15");
INSERT INTO `access_logs` VALUES("214","admin/assets","::1","US","2026-07-06 10:27:09");
INSERT INTO `access_logs` VALUES("215","admin/assets","::1","US","2026-07-06 10:32:15");
INSERT INTO `access_logs` VALUES("216","admin/assets","::1","US","2026-07-06 10:33:15");
INSERT INTO `access_logs` VALUES("217","admin/assets","::1","US","2026-07-06 10:33:23");
INSERT INTO `access_logs` VALUES("218","admin/assets","::1","US","2026-07-06 10:33:37");
INSERT INTO `access_logs` VALUES("219","admin/assets","::1","US","2026-07-06 10:33:50");
INSERT INTO `access_logs` VALUES("220","admin/assets","::1","US","2026-07-06 10:33:58");
INSERT INTO `access_logs` VALUES("221","admin/assets","::1","US","2026-07-06 10:34:36");
INSERT INTO `access_logs` VALUES("222","admin/assets","::1","US","2026-07-06 10:34:38");
INSERT INTO `access_logs` VALUES("223","admin/assets","::1","US","2026-07-06 10:34:44");
INSERT INTO `access_logs` VALUES("224","admin/assets","::1","US","2026-07-06 10:35:38");
INSERT INTO `access_logs` VALUES("225","admin/assets","::1","US","2026-07-06 10:35:44");
INSERT INTO `access_logs` VALUES("226","admin/assets","::1","US","2026-07-06 10:36:26");
INSERT INTO `access_logs` VALUES("227","admin/assets","::1","US","2026-07-06 10:36:34");
INSERT INTO `access_logs` VALUES("228","admin/assets","::1","US","2026-07-06 10:37:18");
INSERT INTO `access_logs` VALUES("229","admin/assets","::1","US","2026-07-06 10:38:43");
INSERT INTO `access_logs` VALUES("230","admin/assets","::1","US","2026-07-06 10:38:53");
INSERT INTO `access_logs` VALUES("231","admin/assets","::1","US","2026-07-06 10:39:06");
INSERT INTO `access_logs` VALUES("232","admin/assets","::1","US","2026-07-06 10:39:40");
INSERT INTO `access_logs` VALUES("233","admin/assets","::1","US","2026-07-06 10:41:02");
INSERT INTO `access_logs` VALUES("234","admin/assets","::1","US","2026-07-06 10:41:56");
INSERT INTO `access_logs` VALUES("235","admin/assets","::1","US","2026-07-06 10:45:32");
INSERT INTO `access_logs` VALUES("236","admin/assets","::1","US","2026-07-06 10:45:53");
INSERT INTO `access_logs` VALUES("237","admin/assets","::1","US","2026-07-06 10:46:46");
INSERT INTO `access_logs` VALUES("238","admin/assets","::1","US","2026-07-06 10:48:03");
INSERT INTO `access_logs` VALUES("239","admin/assets","::1","US","2026-07-06 10:48:09");
INSERT INTO `access_logs` VALUES("240","admin/assets","::1","US","2026-07-06 10:48:59");
INSERT INTO `access_logs` VALUES("241","admin/assets","::1","US","2026-07-06 10:49:59");
INSERT INTO `access_logs` VALUES("242","admin/assets","::1","US","2026-07-06 10:50:07");
INSERT INTO `access_logs` VALUES("243","admin/assets","::1","US","2026-07-06 10:50:50");
INSERT INTO `access_logs` VALUES("244","admin/assets","::1","US","2026-07-06 10:51:07");
INSERT INTO `access_logs` VALUES("245","admin/assets","::1","US","2026-07-06 10:51:13");
INSERT INTO `access_logs` VALUES("246","admin/assets","::1","US","2026-07-06 10:52:31");
INSERT INTO `access_logs` VALUES("247","admin/assets","::1","US","2026-07-06 10:52:49");
INSERT INTO `access_logs` VALUES("248","admin/assets","::1","US","2026-07-06 10:52:55");
INSERT INTO `access_logs` VALUES("249","admin/assets","::1","US","2026-07-06 10:54:41");
INSERT INTO `access_logs` VALUES("250","admin/assets","::1","US","2026-07-06 10:54:51");
INSERT INTO `access_logs` VALUES("251","admin/assets","::1","US","2026-07-06 10:55:02");
INSERT INTO `access_logs` VALUES("252","admin/assets","::1","US","2026-07-06 10:56:07");
INSERT INTO `access_logs` VALUES("253","admin/assets","::1","US","2026-07-06 10:56:17");
INSERT INTO `access_logs` VALUES("254","admin/assets","::1","US","2026-07-06 10:57:17");
INSERT INTO `access_logs` VALUES("255","admin/assets","::1","US","2026-07-06 10:57:27");
INSERT INTO `access_logs` VALUES("256","admin/assets","::1","US","2026-07-06 10:58:23");
INSERT INTO `access_logs` VALUES("257","admin/assets","::1","US","2026-07-06 10:58:33");
INSERT INTO `access_logs` VALUES("258","admin/assets","::1","US","2026-07-06 10:58:41");
INSERT INTO `access_logs` VALUES("259","admin/assets","::1","US","2026-07-06 10:59:43");
INSERT INTO `access_logs` VALUES("260","admin/assets","::1","US","2026-07-06 10:59:50");
INSERT INTO `access_logs` VALUES("261","admin/assets","::1","US","2026-07-06 11:01:52");
INSERT INTO `access_logs` VALUES("262","admin/assets","::1","US","2026-07-06 11:02:52");
INSERT INTO `access_logs` VALUES("263","admin/assets","::1","US","2026-07-06 11:03:06");
INSERT INTO `access_logs` VALUES("264","admin/assets","::1","US","2026-07-06 11:03:40");
INSERT INTO `access_logs` VALUES("265","beranda","::1","US","2026-07-06 11:03:46");
INSERT INTO `access_logs` VALUES("266","beranda","::1","US","2026-07-06 11:03:54");
INSERT INTO `access_logs` VALUES("267","beranda","::1","US","2026-07-06 11:05:05");
INSERT INTO `access_logs` VALUES("268","beranda","::1","US","2026-07-06 11:05:06");
INSERT INTO `access_logs` VALUES("269","beranda","::1","US","2026-07-06 11:05:08");
INSERT INTO `access_logs` VALUES("270","beranda","::1","US","2026-07-06 11:06:38");
INSERT INTO `access_logs` VALUES("271","beranda","::1","US","2026-07-06 11:07:09");
INSERT INTO `access_logs` VALUES("272","beranda","::1","US","2026-07-06 11:07:18");
INSERT INTO `access_logs` VALUES("273","beranda","::1","US","2026-07-06 11:08:01");
INSERT INTO `access_logs` VALUES("274","beranda","::1","US","2026-07-06 11:09:05");
INSERT INTO `access_logs` VALUES("275","kelas","::1","US","2026-07-06 11:09:15");
INSERT INTO `access_logs` VALUES("276","toko","::1","US","2026-07-06 11:09:16");
INSERT INTO `access_logs` VALUES("277","beranda","::1","US","2026-07-06 11:09:17");
INSERT INTO `access_logs` VALUES("278","toko","::1","US","2026-07-06 11:09:17");
INSERT INTO `access_logs` VALUES("279","beranda","::1","US","2026-07-06 11:09:19");
INSERT INTO `access_logs` VALUES("280","admin/assets","::1","US","2026-07-06 11:22:33");

-- --------------------------------------------------------

-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_filename` varchar(255) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unique_filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- Dumping data for table `assets`

INSERT INTO `assets` VALUES("11","preview.png","1001196","image/jpeg","2026-07-06 10:50:49","asset-6a4b2619517a35.49678492.png");
INSERT INTO `assets` VALUES("14","ap.png","46313","image/png","2026-07-06 10:55:00","asset-6a4b2714824be0.59541920.png");
INSERT INTO `assets` VALUES("15","img-not-found-2.png","40073","image/png","2026-07-06 10:56:16","asset-6a4b2760395a62.56111569.png");
INSERT INTO `assets` VALUES("16","loading.gif","838679","image/gif","2026-07-06 10:57:25","asset-6a4b27a5ebf406.47693559.gif");
INSERT INTO `assets` VALUES("17","login.gif","169001","image/gif","2026-07-06 10:58:40","asset-6a4b27f038fb64.63388080.gif");
INSERT INTO `assets` VALUES("18","149071.png","2933","image/png","2026-07-06 10:59:49","asset-6a4b28356f2c74.73209657.png");
INSERT INTO `assets` VALUES("19","WhatsApp Image 2026-06-30 at 07.59.45.jpeg","87384","image/jpeg","2026-07-06 11:03:05","asset-6a4b28f96c2488.06186369.jpeg");

-- --------------------------------------------------------

-- Table structure for table `kategori_produk`
--

DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE `kategori_produk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- Dumping data for table `kategori_produk`

INSERT INTO `kategori_produk` VALUES("1","parenting","1","1","2026-06-19 03:33:19");
INSERT INTO `kategori_produk` VALUES("2","anak","2","1","2026-06-19 03:33:32");
INSERT INTO `kategori_produk` VALUES("3","aa","3","1","2026-06-19 03:46:58");
INSERT INTO `kategori_produk` VALUES("4","bb","4","1","2026-06-19 03:47:02");
INSERT INTO `kategori_produk` VALUES("5","cc 1","5","1","2026-06-19 03:47:04");
INSERT INTO `kategori_produk` VALUES("6","Computer","6","1","2026-06-19 03:47:07");

-- --------------------------------------------------------

-- Table structure for table `kelas_menulis`
--

DROP TABLE IF EXISTS `kelas_menulis`;
CREATE TABLE `kelas_menulis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) NOT NULL,
  `mentor` varchar(100) NOT NULL,
  `harga_kelas` int(11) NOT NULL,
  `jadwal` varchar(100) NOT NULL,
  `kuota` int(11) DEFAULT 15,
  `deskripsi_kelas` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Dumping data for table `kelas_menulis`

INSERT INTO `kelas_menulis` VALUES("1","bolot","Om Toni","150000","Sabtu, 09.00 - 11.00 WIB","15","Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 02:16:50");
INSERT INTO `kelas_menulis` VALUES("2","Menulis Dongeng Pertama Si Kecil","Kak Nadia","200000","Minggu, 14.00 - 16.00 WIB","10","Pendampingan intensif menyusun alur cerita fabel dari awal hingga selesai cetak.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 02:16:50");
INSERT INTO `kelas_menulis` VALUES("3","Test Nama Kelas","Butet","2000000","17 Juni 2026","10","Sekarang sistem login admin Anda sudah berhasil dikonfigurasi menggunakan enkripsi MD5 yang lebih simpel untuk kebutuhan pengembangan Anda. Langkah penyesuaian apa lagi yang ingin Anda lakukan pada proyek web AnakKreatif ini?","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 03:06:41");
INSERT INTO `kelas_menulis` VALUES("4","Dasar: Membangun Karakter Cerita (Salinan)","Om Toni","150000","Sabtu, 09.00 - 11.00 WIB","15","Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 03:34:54");
INSERT INTO `kelas_menulis` VALUES("5","Menulis Dongeng Pertama Si Kecil (Salinan)","Kak Nadia","200000","Minggu, 14.00 - 16.00 WIB","10","Pendampingan intensif menyusun alur cerita fabel dari awal hingga selesai cetak.","https://images.unsplash.com/photo-1773332585754-f1436987743b?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 03:34:55");
INSERT INTO `kelas_menulis` VALUES("6","Dasar: Membangun Karakter Cerita (Salinan) (Salinan)","Om Toni","150000","Sabtu, 09.00 - 11.00 WIB","15","Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 03:34:57");
INSERT INTO `kelas_menulis` VALUES("7","Kelas 31","aa 1","22","aa","22","aa asd asd asd","6a4895ce6877e.png","2026-07-04 19:10:38");

-- --------------------------------------------------------

-- Table structure for table `klasifikasi_produk`
--

DROP TABLE IF EXISTS `klasifikasi_produk`;
CREATE TABLE `klasifikasi_produk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- Dumping data for table `klasifikasi_produk`

INSERT INTO `klasifikasi_produk` VALUES("1","Books","1","1","2026-06-19 03:41:20");
INSERT INTO `klasifikasi_produk` VALUES("2","Non Books","2","1","2026-06-19 03:41:20");
INSERT INTO `klasifikasi_produk` VALUES("3","Digital","3","1","2026-06-19 03:41:20");
INSERT INTO `klasifikasi_produk` VALUES("10","Cards","10","1","2026-07-04 03:57:19");
INSERT INTO `klasifikasi_produk` VALUES("11","Contoh","11","1","2026-07-04 04:09:26");

-- --------------------------------------------------------

-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `key_name` varchar(50) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- Dumping data for table `pengaturan`

INSERT INTO `pengaturan` VALUES("5","admin_paging");
INSERT INTO `pengaturan` VALUES("admin_paging","10");
INSERT INTO `pengaturan` VALUES("admin_theme","light");
INSERT INTO `pengaturan` VALUES("footer_text","© 2026 AnakKreatif. Dikembangkan secara Native dengan Struktur SEO. Native PHP");
INSERT INTO `pengaturan` VALUES("hero_gradient_end","#ffffff");
INSERT INTO `pengaturan` VALUES("hero_gradient_start","#ff006f");
INSERT INTO `pengaturan` VALUES("hero_subtitle","Temukan kurasi buku cerita anak terbaik serta program pelatihan menulis interaktif yang dirancang khusus mematangkan kreativitas anak usia 7-12 tahun. Oke Deh");
INSERT INTO `pengaturan` VALUES("hero_title","Tumbuhkan Imajinasi Si Kecil Lewat Buku, Kata dan Tulisan");
INSERT INTO `pengaturan` VALUES("home_video_limit","4");
INSERT INTO `pengaturan` VALUES("Kreatif Mania","site_title");
INSERT INTO `pengaturan` VALUES("site_tagline","Ruang tumbuh kembang imajinasi dan bakat menulis literasi anak sejak dini. Native PHP");
INSERT INTO `pengaturan` VALUES("site_title","Anak Kreatif 3");
INSERT INTO `pengaturan` VALUES("video_section_subtitle","Dokumentasi keseruan kelas menulis dan ulasan buku anak-anak. OK");
INSERT INTO `pengaturan` VALUES("video_section_title","Video Kegiatan Kreatif");

-- --------------------------------------------------------

-- Table structure for table `produk_buku`
--

DROP TABLE IF EXISTS `produk_buku`;
CREATE TABLE `produk_buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT 0,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `kategori_id` int(10) unsigned DEFAULT NULL,
  `klasifikasi_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Dumping data for table `produk_buku`

INSERT INTO `produk_buku` VALUES("12","Pembangunan Tol Bocimi Cibadak-Sukabumi Barat Rampung 2027","Edwar Rinaldo","400000","100","Jakarta - Kementerian Pekerjaan Umum (PU) mengevaluasi Tol Bogor-Ciawi-Sukabumi di kilometer (km) 72 akibat hujan deras pada Mei 2026. Hal ini disampaikan Kepala Badan Pengatur Jalan Tol (BPJT), Wilan Oktavian dalam Kunjungan Kerja Spesifik Komisi V DPR RI ke Jalan Tol Ciawi-Sukabumi Seksi 3 yang dilaksanakan pada Jumat (12/6).\r\nKemudian, pembangunan Tol Ciawi-Sukabumi Seksi 3 yang menghubungkan Cibadak hingga Sukabumi Barat juga dipercepat. Saat ini progres konstruksinya telah mencapai 81,49% dan ditargetkan selesai pada 2027.\r\n\r\n\"Pengamanan lereng menjadi aspek yang sangat penting dan krusial dalam pembangunan Jalan Tol Ciawi-Sukabumi Seksi 3. Oleh karena itu, Badan Pengatur Jalan Tol melakukan evaluasi menyeluruh terhadap seluruh lokasi timbunan dan galian untuk memastikan penerapan kemiringan lereng sesuai standar teknis agar lebih aman dan nyaman digunakan oleh masyarakat,\" jelas Wilan dalam keterangan tertulis, Selasa (16/6/2026).\r\n\r\nBaca artikel detikfinance, \"Pembangunan Tol Bocimi Cibadak-Sukabumi Barat Rampung 2027\" selengkapnya https://finance.detik.com/infrastruktur/d-8534028/pembangunan-tol-bocimi-cibadak-sukabumi-barat-rampung-2027.\r\n\r\nDownload Apps Detikcom Sekarang https://apps.detik.com/detik/","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-17 03:34:25","2","1");
INSERT INTO `produk_buku` VALUES("13","Buku 7","Jonathan","22","22","aa","6a4895bd3d0cd.png","2026-07-04 19:10:21","3","11");

-- --------------------------------------------------------

-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_slider` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Dumping data for table `sliders`

INSERT INTO `sliders` VALUES("4","Test","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","0","2026-06-17 03:47:02");
INSERT INTO `sliders` VALUES("5","test 2","https://plus.unsplash.com/premium_photo-1780596641719-86e280a9c69e?q=80&w=1744&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-17 03:47:29");
INSERT INTO `sliders` VALUES("6","test 3","https://images.unsplash.com/photo-1780955420595-cf6a4cc9d1ec?q=80&w=1742&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-17 03:54:28");
INSERT INTO `sliders` VALUES("7","Gambar Pantai","https://images.unsplash.com/photo-1632037410699-c1487d383d76?q=80&w=1794&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-17 04:02:31");
INSERT INTO `sliders` VALUES("8","Gmbar Karang","https://plus.unsplash.com/premium_photo-1731933560224-43a0698d0b44?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-17 04:02:51");
INSERT INTO `sliders` VALUES("9","Gmbar Ustadz","6a31585ad5a0e.png","0","2026-06-17 04:06:18");

-- --------------------------------------------------------

-- Table structure for table `users_admin`
--

DROP TABLE IF EXISTS `users_admin`;
CREATE TABLE `users_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Dumping data for table `users_admin`

INSERT INTO `users_admin` VALUES("1","admin","$2y$12$Tg4u9GRxZS.IOD1aqw33e.uLKVhD0KnMmIgFzU.7V3xkSdU.eIOaO","Edwar Rinaldo","avatar-1--6a4b2c577bb81.png");
INSERT INTO `users_admin` VALUES("3","budi","$2y$10$t1bRpZbI4EXtEwm.I4nkAOnd.d9Kptn0/Chjc.qBPnV99dyOJdkPm","Budi Jongos","6a48b7e28eadc.png");
INSERT INTO `users_admin` VALUES("4","joko","$2y$12$Y3tRF0dOUgWat/PMmCTzoOYz4MG94LchCYjHnJjbK.IUtEpJbtYz2","joko anwar","6a4a5b07e08e9.png");

-- --------------------------------------------------------

-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_video` varchar(255) NOT NULL,
  `tipe_sumber` enum('upload','youtube') NOT NULL,
  `tautan_video` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Dumping data for table `videos`

INSERT INTO `videos` VALUES("4","BIGHERU - HILANG BAGANTI BURUAK BATUKA [OFFICIAL MUSIC VIDEO]","youtube","https://www.youtube.com/embed/tgxenRsQQdA?si=RKonW2Ct0Vr65Br3","1","2026-06-17 05:02:42");
INSERT INTO `videos` VALUES("5","Halilintar Morgen - Nan Disayang Manyakiti (Official Music Video)","youtube","https://www.youtube.com/embed/FPRWRZfsads?si=htjunV8UD8xfzMeM","1","2026-06-17 05:21:17");
INSERT INTO `videos` VALUES("6","aa 321","youtube","https://www.youtube.com/embed/CSKr9seKdgI?si=zEgTTwgYcr61DQFi","1","2026-07-04 19:25:06");
INSERT INTO `videos` VALUES("7","vv 123","youtube","https://www.youtube.com/embed/CSKr9seKdgI?si=zEgTTwgYcr61DQFi","1","2026-07-04 19:30:26");
