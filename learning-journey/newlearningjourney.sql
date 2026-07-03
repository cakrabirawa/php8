-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 10:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newlearningjourney`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checklist_templates`
--

CREATE TABLE `checklist_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `week` int(10) UNSIGNED NOT NULL,
  `template_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`template_json`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checklist_templates`
--

INSERT INTO `checklist_templates` (`id`, `month`, `week`, `template_json`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{\r\n    \"title\": \"INTRODUCTION\",\r\n    \"items\": [\r\n      {\"id\": \"m1w1_i1\", \"text\": \"Fasilitas kerja (meja kerja, alat kerja, dan lain-lain)\"},\r\n      {\"id\": \"m1w1_i2\", \"text\": \"ID Card (Pengajuan ke PA/diberikan kalau sudah ada)\"},\r\n      {\"id\": \"m1w1_i3\", \"text\": \"Pengenalan lingkungan kerja melalui office tour, struktur organisasi store, & perkenalan dengan rekan kerja\"},\r\n      {\"id\": \"m1w1_i4\", \"text\": \"Prolog mengenai karyawan akan melakukan EOB\"}\r\n    ],\r\n    \"mandatory_tasks\": [\r\n      {\"id\": \"m1w1_t1\", \"text\": \"Mengakses New Employee Orientation Training (NEO-T) di Koginisi\"},\r\n      {\"id\": \"m1w1_t2\", \"text\": \"Mempelajari struktur organisasi GoRP, Peraturan Perusahaan, dan Jobdesc (checklist)\"},\r\n      {\"id\": \"m1w1_t3\", \"text\": \"Melakukan observasi dinamika kerja\"},\r\n      {\"id\": \"m1w1_t4\", \"text\": \"Mempelajari Gramedia Daily\'s Store dan mengerjakan post test\"}\r\n    ]\r\n  }', '2025-12-05 08:40:48', '2025-12-05 08:40:48'),
(2, 1, 2, '{\r\n    \"title\": \"Mentoring 1\",\r\n    \"items\": [\r\n      {\"id\": \"m1w2_i1\", \"text\": \"Penjelasan struktur organisasi GoRP\"},\r\n      {\"id\": \"m1w2_i2\", \"text\": \"Penjelasan peraturan perusahaan\"},\r\n      {\"id\": \"m1w2_i3\", \"text\": \"Penjelasan lebih detail tentang nilai Kompas Gramedia (5C)\"},\r\n      {\"id\": \"m1w2_i4\", \"text\": \"Penjelasan tentang KPI, Matriks Kerja, SOP, ruang lingkup kerja\"},\r\n      {\"id\": \"m1w2_i5\", \"text\": \"Penjelasan detail peran dan tanggung jawab SS secara detail\"}\r\n    ],\r\n    \"mandatory_tasks\": [\r\n      {\"id\": \"m1w2_t1\", \"text\": \"Mempelajari Microsoft Power BI\"},\r\n      {\"id\": \"m1w2_t2\", \"text\": \"Mempelajari produk-produk internal & eksternal Gramedia secara umum\"},\r\n      {\"id\": \"m1w2_t3\", \"text\": \"Mempelajari Organization Structure, Gramedia Management System, Business Retail Concept\"}\r\n    ]\r\n  }', '2025-12-05 08:41:00', '2025-12-05 08:41:00'),
(3, 1, 3, '{\r\n    \"title\": \"Activity Checking with Buddy\",\r\n    \"items\": [],\r\n    \"mandatory_tasks\": [\r\n      {\"id\": \"m1w3_t1\", \"text\": \"Mempelajari Supervisory Skill dan/atau Agile Leadership in Retail\"},\r\n      {\"id\": \"m1w3_t2\", \"text\": \"Mempelajari Team Management\"},\r\n      {\"id\": \"m1w3_t3\", \"text\": \"Mempelajari Coaching & Counselling\"}\r\n    ]\r\n  }', '2025-12-05 08:41:11', '2025-12-05 08:41:11'),
(4, 1, 4, '{\r\n    \"title\": \"Mentoring 2\",\r\n    \"items\": [\r\n      {\"id\": \"m1w4_i1\", \"text\": \"Review dinamika/pengalaman kerja selama 1 bulan\"},\r\n      {\"id\": \"m1w4_i2\", \"text\": \"Sharing tantangan dan peluang yang akan dihadapi\"},\r\n      {\"id\": \"m1w4_i3\", \"text\": \"Follow up hasil pembelajaran Microsoft Power BI dan product knowledge\"},\r\n      {\"id\": \"m1w4_i4\", \"text\": \"Arahan untuk mempelajari materi learning sesuai checklist EOB\"}\r\n    ],\r\n    \"mandatory_tasks\": [\r\n      {\"id\": \"m1w4_t1\", \"text\": \"Mempelajari Problem Solving & Decision Making\"},\r\n      {\"id\": \"m1w4_t2\", \"text\": \"Mempelajari Retail Salesmanship\"},\r\n      {\"id\": \"m1w4_t3\", \"text\": \"Mempelajari Customer Service & Loyalty, Standar Sikap Pelayanan, Grooming and Professional Appearance\"}\r\n    ]\r\n  }', '2025-12-05 08:41:21', '2025-12-05 08:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contract_type` enum('Permanent','Contract') NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `birthday` date DEFAULT NULL,
  `initial_employment_date` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `permanent_date` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `name`, `contract_type`, `region_id`, `store_id`, `section_id`, `job_id`, `birthday`, `initial_employment_date`, `joining_date`, `permanent_date`, `updated_at`) VALUES
(1, '77491', 'ANGESTI LINTANG-PRISTIRA', 'Permanent', 1, 1, 1, 1, '1998-03-21', '2022-04-01', '2022-03-21', '2024-10-01', NULL),
(2, '85830', 'GUSTAV STEVANUS RAGA ADOE', 'Contract', 1, 1, 1, 1, '1998-08-13', '2024-02-01', '2024-01-15', NULL, NULL),
(3, '73544', 'MUHAMAD JARKASIH', 'Permanent', 1, 1, 1, 1, '1993-07-23', '2021-04-01', '2021-03-17', '2023-04-01', NULL),
(4, '84576', 'BAYU MURDANTYO', 'Contract', 1, 1, 1, 1, '2000-12-29', '2023-11-01', '2023-10-20', NULL, NULL),
(5, '3765', 'SUMARDI', 'Permanent', 1, 1, 1, 1, '1972-12-27', '2000-01-01', '2000-01-01', '2000-01-01', NULL),
(6, '90009', 'JAYA RIKSA', 'Contract', 1, 2, 1, 1, '2001-05-08', '2025-04-01', '2025-04-05', NULL, NULL),
(7, '86852', 'RAMA AULIA BAGASKORO', 'Contract', 1, 2, 1, 1, '1998-01-17', '2024-05-01', '2024-04-29', NULL, NULL),
(8, '7623', 'HENDRO PRANOTO', 'Permanent', 1, 2, 1, 1, '1982-09-04', '2005-10-01', '2005-10-01', '2009-02-01', NULL),
(9, '4115', 'OMI HERNITA', 'Permanent', 1, 3, 1, 1, '1977-10-07', '1997-07-03', '1997-07-03', '2001-01-01', NULL),
(10, '2783', 'ANNA MEGAWATI TAMPUBOLON', 'Permanent', 1, 3, 1, 1, '1972-07-02', '1993-11-01', '1993-11-01', '1996-04-01', NULL),
(11, '85891', 'RIFALDI APININO', 'Contract', 1, 3, 1, 1, '1998-12-22', '2024-02-01', '2024-01-22', NULL, NULL),
(12, '8870', 'JOANNES CHRYSOSTOMUS WAHYU KRISMANTO', 'Permanent', 1, 3, 1, 1, '1981-05-02', '2008-02-01', '2008-02-01', '2010-04-01', NULL),
(13, '88445', 'SAMUEL KRISNA SURYA HANGGARA', 'Contract', 1, 4, 1, 1, '2000-10-03', '2024-11-01', '2024-11-04', NULL, NULL),
(14, '29023', 'YOLANDA GRESSITA', 'Permanent', 1, 4, 1, 1, '1992-08-09', '2015-04-01', '2015-04-01', '2016-07-01', NULL),
(15, '3359', 'ANUGRAH NURDIANTO', 'Permanent', 1, 4, 1, 1, '1972-10-20', '1995-03-15', '1995-03-15', '1997-08-01', NULL),
(16, '37236', 'YUSWENDAR ARLI', 'Permanent', 1, 5, 1, 1, '1993-07-08', '2016-04-01', '2016-04-01', '2019-04-01', NULL),
(17, '90844', 'ZEFANYA LINTANG LITANI', 'Contract', 1, 5, 1, 1, '2001-01-28', '2025-08-01', '2025-07-15', NULL, NULL),
(18, '3915', 'DADANG SUKANDAR', 'Permanent', 1, 5, 1, 1, '1974-02-28', '1996-05-01', '1996-05-01', '2000-06-01', NULL),
(19, '5919', 'PAULUS KRISTIADI', 'Permanent', 1, 5, 1, 1, '1978-09-07', '2004-12-01', '2004-12-01', '2006-07-01', NULL),
(20, '89652', 'NATASYA', 'Contract', 1, 6, 1, 1, '2002-01-30', '2025-03-01', '2025-02-24', NULL, NULL),
(21, '91068', 'ROBERTO GALLANT NARENDRA', 'Contract', 1, 6, 1, 1, '2000-01-28', '2025-09-01', '2025-08-20', NULL, NULL),
(22, '4773', 'TRIMAN', 'Permanent', 1, 6, 1, 1, '1978-06-19', '1999-06-01', '1999-06-01', '2002-07-01', NULL),
(23, '87853', 'MUHAMMAD ARVIANDI HAKIM', 'Contract', 1, 6, 1, 1, '1998-07-30', '2024-09-01', '2024-09-10', NULL, NULL),
(24, '2168', 'SLAMET', 'Permanent', 1, 6, 1, 1, '1972-05-20', '1991-12-05', '1991-12-05', '1994-04-01', NULL),
(25, '5770', 'NARULI KURNIA ISMAWAN', 'Permanent', 1, 7, 1, 1, '1980-12-04', '2003-10-01', '2003-10-01', '2006-01-01', NULL),
(26, '90248', 'DIMAS ASTRAPRAJA', 'Contract', 1, 7, 1, 1, '1992-06-23', '2025-05-01', '2025-05-01', NULL, NULL),
(27, '5968', 'LILIS SOLIHAT', 'Permanent', 1, 7, 1, 1, '1982-06-01', '2004-03-01', '2004-03-01', '2006-09-01', NULL),
(28, '2679', 'WIDYA KURNIA', 'Permanent', 1, 7, 1, 1, '1969-04-06', '1993-08-16', '1993-08-16', '1996-01-01', NULL),
(29, '8525', 'YOSI NOVIANTO', 'Permanent', 1, 7, 1, 1, '1984-11-03', '2007-10-01', '2007-10-01', '2009-11-01', NULL),
(30, '83822', 'ARDA NOVRIZAL HAQ', 'Contract', 1, 7, 1, 1, '2000-11-30', '2023-09-01', '2023-08-14', NULL, NULL),
(31, '28879', 'IDA LESTARI NAINGGOLAN', 'Permanent', 1, 7, 1, 1, '1991-02-27', '2015-03-01', '2015-03-01', '2016-07-01', NULL),
(32, '90521', 'TYOLANA DESTA WULANDARI', 'Contract', 1, 8, 1, 1, '1999-12-24', '2025-06-01', '2025-06-03', NULL, NULL),
(33, '88436', 'YEREMIA IMMANUEL CHRISTIAN', 'Contract', 1, 8, 1, 1, '1999-07-01', '2024-11-01', '2024-10-08', NULL, NULL),
(34, '88247', 'MUHAMMAD REZA REZKIA', 'Contract', 1, 8, 1, 1, '2001-04-23', '2024-10-01', '2024-09-27', NULL, NULL),
(35, '100414', 'JANUARDY YOGA PRATAMA', 'Contract', 1, 9, 1, 1, '2002-01-15', '2025-10-01', '2025-09-23', NULL, NULL),
(36, '100443', 'LAILA RAMADANNI', 'Contract', 1, 9, 1, 1, '1999-01-12', '2025-10-01', '2025-10-01', NULL, NULL),
(37, '37846', 'YOSUA SOMNAIKUBUN', 'Permanent', 1, 9, 1, 1, '1994-04-10', '2016-06-01', '2016-06-01', '2017-04-01', NULL),
(38, '52474', 'MEINY WINRI', 'Permanent', 1, 9, 1, 1, '1994-08-21', '2017-11-01', '2017-11-01', '2019-09-01', NULL),
(39, '21725', 'DADAN SUJONO', 'Permanent', 1, 9, 1, 1, '1991-03-08', '2013-08-01', '2013-08-01', '2015-11-01', NULL),
(40, '25489', 'NONINCE MERANI', 'Permanent', 1, 9, 1, 1, '1995-10-25', '2014-10-01', '2014-10-01', '2016-10-01', NULL),
(41, '14870', 'EFIANA NINGSIH', 'Permanent', 1, 10, 1, 1, '1992-01-06', '2011-06-01', '2011-06-01', '2013-06-01', NULL),
(42, '89698', 'LA ODE MUHAMMAD ILHAM SETIAWAN', 'Contract', 1, 10, 1, 1, '2002-08-20', '2025-03-01', '2025-02-26', NULL, NULL),
(43, '6417', 'IRVAN FADLY', 'Permanent', 1, 10, 1, 1, '1982-08-16', '2006-06-15', '2006-06-15', '2008-07-01', NULL),
(44, '7842', 'WAODE NELI SULISTIAWATI', 'Permanent', 1, 10, 1, 1, '1982-05-11', '2007-01-01', '2007-01-01', '2009-11-01', NULL),
(45, '75071', 'TRIMAN', 'Permanent', 1, 10, 1, 1, '1995-09-12', '2021-08-01', '2021-07-26', '2024-01-01', NULL),
(46, '5362', 'YONA ANNEKE REMELIA HATTU', 'Permanent', 1, 11, 1, 1, '1977-02-22', '2001-09-01', '2001-09-01', '2004-07-01', NULL),
(47, '3308', 'JAHUDA UNTUNG DOEMA', 'Permanent', 1, 11, 1, 1, '1970-01-04', '1995-01-19', '1995-01-19', '1997-06-01', NULL),
(48, '6466', 'IMELDA MARIA DEDE TENA', 'Permanent', 1, 11, 1, 1, '1983-12-19', '2006-08-01', '2006-08-01', '2008-08-01', NULL),
(49, '82252', 'GABRIELA JULIANTI', 'Contract', 1, 12, 1, 1, '2000-06-12', '2023-03-01', '2023-03-01', NULL, NULL),
(50, '1916', 'DAMIANUS SAKIJAN', 'Permanent', 1, 12, 1, 1, '1968-11-03', '1990-11-01', '1990-11-01', '1993-02-01', NULL),
(51, '100531', 'SOFYAN HIDAYATULLOH', 'Contract', 1, 13, 1, 1, '2000-07-18', '2025-11-01', '2025-10-13', NULL, NULL),
(52, '2569', 'PANDE PUTU DAMENDRA', 'Permanent', 1, 13, 1, 1, '1972-04-11', '1993-05-01', '1993-05-01', '1995-09-01', NULL),
(53, '84908', 'NI KETUT WINTARI', 'Contract', 1, 13, 1, 1, '2001-04-29', '2023-11-01', '2023-11-08', NULL, NULL),
(54, '88836', 'RIVA PRASETYO', 'Contract', 1, 13, 1, 1, '2001-09-26', '2024-12-01', '2024-11-18', NULL, NULL),
(55, '11849', 'YASINTA LIA ICE', 'Permanent', 1, 14, 1, 1, '1985-06-19', '2009-12-01', '2009-12-01', '2012-02-01', NULL),
(56, '84699', 'RIKARDUS WEO', 'Contract', 1, 14, 1, 1, '2000-04-04', '2023-11-01', '2023-11-05', NULL, NULL),
(57, '3772', 'BONAVENTURA JELUNDU', 'Permanent', 1, 14, 1, 1, '1970-07-23', '2000-01-01', '2000-01-01', '2000-01-01', NULL),
(58, '88638', 'MICHAEL GIVEN GERARD TANGKILISAN', 'Contract', 1, 15, 1, 1, '2002-04-16', '2024-11-01', '2024-01-25', NULL, NULL),
(59, '88885', 'SYAMSIR', 'Contract', 1, 15, 1, 1, '2001-06-06', '2024-12-01', '2024-11-25', NULL, NULL),
(60, '70821', 'MUHAMMAD HADI RAFIDIN', 'Permanent', 1, 15, 1, 1, '1995-10-12', '2020-03-01', '2020-03-10', '2022-04-01', NULL),
(61, '84841', 'RAMSY MADYAN MUNDE', 'Contract', 1, 15, 1, 1, '1999-12-22', '2023-11-01', '2023-11-04', NULL, NULL),
(62, '4758', 'ERI DARMAWAN', 'Permanent', 1, 16, 1, 1, '1978-08-27', '1999-11-01', '1999-11-01', '2002-06-01', NULL),
(63, '25360', 'RATIH SOFIA KATUNANDYAR', 'Permanent', 1, 16, 1, 1, '1986-02-16', '2014-09-01', '2014-09-01', '2015-09-01', NULL),
(64, '86561', 'RAHMAT PUJI RAHARJO', 'Contract', 1, 16, 1, 1, '1998-04-21', '2024-04-01', '2024-03-21', NULL, NULL),
(65, '90603', 'FRANSISKUS MARIO ANINDITO', 'Contract', 1, 17, 1, 1, '2000-10-04', '2025-07-01', '2025-06-16', NULL, NULL),
(66, '4926', 'LULUK DEKIYANTO', 'Permanent', 1, 17, 1, 1, '1980-04-15', '1999-10-01', '1999-10-01', '2002-11-01', NULL),
(67, '2607', 'WASILAH', 'Permanent', 1, 17, 1, 1, '1970-12-13', '1993-07-01', '1993-07-01', '1995-10-01', NULL),
(68, '87040', 'MOHAMMAD IRHAM BAGUS WIRAWAN', 'Contract', 1, 17, 1, 1, '1999-02-20', '2024-06-01', '2024-05-21', NULL, NULL),
(69, '90074', 'MATTHEW AMOS TAMPUBOLON', 'Contract', 1, 18, 1, 1, '2001-10-28', '2025-05-01', '2025-04-17', NULL, NULL),
(70, '100550', 'ANGELA MERICI SINAGA', 'Contract', 1, 18, 1, 1, '2003-01-27', '2025-11-01', '2025-10-15', NULL, NULL),
(71, '90593', 'RAYHAN AZKIA', 'Contract', 1, 19, 1, 1, '2001-12-20', '2025-07-01', '2025-06-16', NULL, NULL),
(72, '100560', 'DEDIN JUNAEDIN', 'Contract', 1, 19, 1, 1, '2003-04-12', '2025-11-01', '2025-10-21', NULL, NULL),
(73, '90694', 'THEODORA ADINDA DELANAIRA', 'Contract', 2, 20, 1, 1, '2000-01-09', '2025-07-01', '2025-07-01', NULL, NULL),
(74, '8692', 'NALURI IMAYANTI', 'Permanent', 2, 20, 1, 1, '1985-08-21', '2007-12-01', '2007-12-01', '2009-11-01', NULL),
(75, '7739', 'APRITA WATI', 'Permanent', 2, 20, 1, 1, '1988-04-05', '2006-10-01', '2006-10-01', '2009-11-01', NULL),
(76, '8248', 'AGUS TRIYANTO', 'Permanent', 2, 20, 1, 1, '1986-08-01', '2007-07-01', '2007-07-01', '2010-04-01', NULL),
(77, '86884', 'VIRGIAWAN RAMADHAN INPUT LISTANTO', 'Contract', 2, 21, 1, 1, '1997-12-31', '2024-05-01', '2024-05-02', NULL, NULL),
(78, '2370', 'NOVALINDA', 'Permanent', 2, 21, 1, 1, '1968-11-26', '1993-02-01', '1993-02-01', '1995-02-01', NULL),
(79, '6260', 'SUHERI', 'Permanent', 2, 21, 1, 1, '1982-08-24', '2005-07-01', '2005-07-01', '2008-02-01', NULL),
(80, '54035', 'BEATRICE JASANDDES A', 'Permanent', 2, 22, 1, 1, '1990-08-27', '2018-02-01', '2018-01-15', '2020-02-01', NULL),
(81, '86192', 'YOPI ISKANDAR NURULLOH', 'Contract', 2, 22, 1, 1, '1998-06-04', '2024-03-01', '2024-03-01', NULL, NULL),
(82, '85611', 'LISDIANA FADILA', 'Contract', 2, 22, 1, 1, '1999-10-08', '2024-01-01', '2023-12-27', NULL, NULL),
(83, '54186', 'ARYUDI ADHA', 'Permanent', 2, 22, 1, 1, '1994-05-20', '2018-02-01', '2018-01-25', '2020-02-01', NULL),
(84, '23274', 'BAKRI', 'Permanent', 2, 23, 1, 1, '1987-09-09', '2014-02-01', '2014-02-01', '2016-02-01', NULL),
(85, '89472', 'NURUL AZISAH KAMIL', 'Contract', 2, 23, 1, 1, '2000-05-27', '2025-02-01', '2025-02-01', NULL, NULL),
(86, '89362', 'AMIN SYAM', 'Contract', 2, 24, 1, 1, '2001-01-07', '2025-02-01', '2025-01-20', NULL, NULL),
(87, '25514', 'MARDA', 'Permanent', 2, 24, 1, 1, '1991-03-01', '2014-10-01', '2014-10-01', '2016-10-01', NULL),
(88, '3273', 'IRYANTI', 'Permanent', 2, 24, 1, 1, '1973-01-13', '1995-02-01', '1995-02-01', '1997-05-01', NULL),
(89, '85573', 'YUDA YASRAH ARAFAT', 'Contract', 2, 24, 1, 1, '1999-06-11', '2024-01-01', '2022-11-21', NULL, NULL),
(90, '16248', 'A MUHAMMAD NURHARNIN', 'Permanent', 2, 25, 1, 1, '1988-02-08', '2012-03-01', '2012-03-01', '2014-09-01', NULL),
(91, '90772', 'NURMISUARI SALIHU', 'Contract', 2, 25, 1, 1, '2001-09-27', '2025-07-01', '2025-07-07', NULL, NULL),
(92, '5757', 'NATALIUS', 'Permanent', 2, 25, 1, 1, '1978-12-27', '2003-02-01', '2003-02-01', '2005-12-01', NULL),
(93, '3368', 'NASARUDDIN NURDIN', 'Permanent', 2, 25, 1, 1, '1970-06-04', '1995-03-01', '1995-03-01', '1997-08-01', NULL),
(94, '12587', 'TRISMEIGAWATI TASMAN', 'Permanent', 2, 26, 1, 1, '1987-05-03', '2010-04-01', '2010-04-01', '2012-10-01', NULL),
(95, '5400', 'ALOSIUS MISSA', 'Permanent', 2, 26, 1, 1, '1977-04-29', '2001-10-01', '2001-10-01', '2004-08-01', NULL),
(96, '86814', 'ALBER MEIWAN PUTRA GEA', 'Contract', 2, 26, 1, 1, '1999-05-07', '2024-05-01', '2024-04-24', NULL, NULL),
(97, '34686', 'VIVID', 'Permanent', 2, 26, 1, 1, '1991-07-03', '2016-03-01', '2016-03-01', '2017-01-01', NULL),
(98, '85872', 'MIRANDA YASMINE', 'Contract', 2, 27, 1, 1, '1999-05-14', '2024-02-01', '2024-01-16', NULL, NULL),
(99, '90769', 'RAIZHA RAYHANANTA PRAYOGA', 'Contract', 2, 27, 1, 1, '2002-06-27', '2025-07-01', '2025-07-04', NULL, NULL),
(100, '1764', 'SITI KURNIAWATI', 'Permanent', 2, 27, 1, 1, '1969-03-23', '1990-02-15', '1990-02-15', '1992-06-01', NULL),
(101, '5180', 'ARI NURVIANTO', 'Permanent', 2, 27, 1, 1, '1977-01-28', '2001-03-01', '2001-03-01', '2003-10-01', NULL),
(102, '89145', 'ADI KUSMORO', 'Contract', 2, 28, 1, 1, '1999-10-25', '2025-01-01', '2024-12-23', NULL, NULL),
(103, '86528', 'ANDRIYONO IRAWAN', 'Contract', 2, 28, 1, 1, '1997-07-06', '2024-05-01', '2024-04-16', NULL, NULL),
(104, '8207', 'DIMAS PRASETYO', 'Permanent', 2, 28, 1, 1, '1984-02-08', '2007-06-15', '2007-06-15', '2009-02-01', NULL),
(105, '100490', 'RAIHAN SETYOAJI ALAMSYAH', 'Contract', 2, 29, 1, 1, '2001-07-12', '2025-10-01', '2025-10-06', NULL, NULL),
(106, '88674', 'THERESIA ADINDA KUSUMA ASTUTI', 'Contract', 2, 29, 1, 1, '2000-07-06', '2024-11-01', '2024-11-04', NULL, NULL),
(107, '2094', 'YULIUS BACHTIAR', 'Permanent', 2, 29, 1, 1, '1970-10-21', '1991-07-15', '1991-07-15', '1993-12-01', NULL),
(108, '3957', 'AGUSTINUS NGATINO', 'Permanent', 2, 29, 1, 1, '1972-08-10', '1997-02-01', '1997-02-01', '2000-07-01', NULL),
(109, '100416', 'RAUF ANWAR', 'Contract', 2, 30, 1, 1, '2000-09-19', '2025-10-01', '2025-09-29', NULL, NULL),
(110, '54568', 'RIKSAN WALI', 'Permanent', 2, 30, 1, 1, '1991-07-14', '2018-03-01', '2018-02-12', '2020-03-01', NULL),
(111, '15139', 'JACOB FRITS TAHAPARY', 'Permanent', 2, 30, 1, 1, '1984-07-28', '2011-08-01', '2011-08-01', '2013-08-01', NULL),
(112, '13764', 'ABDUL SAMAD', 'Permanent', 2, 31, 1, 1, '1987-07-15', '2010-11-01', '2010-11-01', '2013-03-01', NULL),
(113, '84307', 'ARIP PRIYADI', 'Contract', 2, 31, 1, 1, '1996-07-23', '2023-10-01', '2022-12-30', NULL, NULL),
(114, '7819', 'SUPRIYADI', 'Permanent', 2, 31, 1, 1, '1984-06-10', '2006-12-01', '2006-12-01', '2009-11-01', NULL),
(115, '89530', 'DONI RIVALDO', 'Contract', 2, 31, 1, 1, '2002-07-14', '2025-02-01', '2025-02-03', NULL, NULL),
(116, '88917', 'ASTRID MILENIA PUSPARINI', 'Contract', 2, 31, 1, 1, '2000-01-13', '2024-12-01', '2024-11-25', NULL, NULL),
(117, '82259', 'ODILIA LINTANG KINAYUNGAN DJAWOTO', 'Permanent', 2, 31, 1, 1, '2000-05-21', '2023-03-01', '2023-03-01', '2025-08-01', NULL),
(118, '23152', 'RIFQI JAMALI', 'Permanent', 2, 31, 1, 1, '1988-01-12', '2014-01-01', '2014-01-01', '2015-10-01', NULL),
(119, '86537', 'SARBJIT', 'Contract', 2, 31, 1, 1, '1999-01-30', '2024-04-01', '2024-03-18', NULL, NULL),
(120, '90596', 'DIKI CHANDRA', 'Contract', 2, 32, 1, 1, '2000-09-21', '2025-07-01', '2025-06-16', NULL, NULL),
(121, '37199', 'INTAN ADHEVA PUTRI', 'Permanent', 2, 32, 1, 1, '1991-06-16', '2016-04-01', '2016-04-01', '2018-04-01', NULL),
(122, '2505', 'YACOBUS MARJAKA', 'Permanent', 2, 32, 1, 1, '1970-06-25', '1993-02-01', '1993-02-01', '1995-06-01', NULL),
(123, '89364', 'BENEDIKTUS ADI KURNIAWAN', 'Contract', 2, 33, 1, 1, '2001-01-24', '2025-02-01', '2025-02-03', NULL, NULL),
(124, '100629', 'ALBERTO SINAGA', 'Contract', 2, 33, 1, 1, '2000-07-11', '2025-11-01', '2025-11-03', NULL, NULL),
(125, '90751', 'DEVANO ARYA FAHREIZY', 'Contract', 2, 33, 1, 1, '2002-09-03', '2025-07-01', '2025-07-01', NULL, NULL),
(126, '90482', 'ANDHIKA BUDY PERMANA', 'Contract', 2, 34, 1, 1, '1999-01-03', '2025-06-01', '2025-06-02', NULL, NULL),
(127, '14492', 'HALIMAH HASAN ST', 'Permanent', 2, 34, 1, 1, '1984-07-30', '2011-03-01', '2011-03-01', '2013-03-01', NULL),
(128, '88730', 'R ALIF ELMAND BOMANTARA', '', 2, 34, 1, 1, '2003-03-01', '2024-11-01', '2024-11-02', NULL, NULL),
(129, '87376', 'DEDE FARID ZAKARIA', 'Contract', 3, 35, 1, 1, '1998-04-13', '2024-07-01', '2024-06-21', NULL, NULL),
(130, '79743', 'ADELINA MELATI SUKMA', 'Permanent', 3, 35, 1, 1, '1998-03-16', '2022-09-01', '2022-09-01', '2025-03-01', NULL),
(131, '4927', 'NURUL AIEN', 'Permanent', 3, 36, 1, 1, '1980-11-23', '2000-06-01', '2000-06-01', '2002-11-01', NULL),
(132, '74200', 'TAUFIKURRAHMAN', 'Permanent', 3, 36, 1, 1, '1980-08-01', '2021-05-01', '2021-04-19', '2025-05-01', NULL),
(133, '2556', 'PURA SABARA', 'Permanent', 3, 36, 1, 1, '1969-11-24', '1993-05-17', '1993-05-17', '1995-08-01', NULL),
(134, '7662', 'ELLYA FAKHRIANI', 'Permanent', 3, 36, 1, 1, '1981-12-20', '2006-06-01', '2006-06-01', '2009-02-01', NULL),
(135, '89916', 'ADELIA SEPTIANINGRUM MARPAUNG', 'Contract', 3, 37, 1, 1, '2001-09-27', '2025-04-01', '2025-03-22', NULL, NULL),
(136, '7663', 'INDRA LESMANA', 'Permanent', 3, 37, 1, 1, '1982-08-07', '2006-06-01', '2006-06-01', '2009-02-01', NULL),
(137, '2555', 'I WAYAN BAGIADA', 'Permanent', 3, 37, 1, 1, '1972-01-21', '1993-04-15', '1993-04-15', '1995-08-01', NULL),
(138, '91080', 'GREGORIUS BAGAS VITA PAMUNGKAS', 'Contract', 3, 38, 1, 1, '2001-09-18', '2025-09-01', '2025-09-01', NULL, NULL),
(139, '80667', 'MEKY DWI CHRISTYANTO', 'Permanent', 3, 38, 1, 1, '1995-05-01', '2022-11-01', '2020-12-01', '2025-05-01', NULL),
(140, '89703', 'TRI HASTOMO', 'Contract', 3, 39, 1, 1, '2001-05-25', '2025-03-01', '2025-03-01', NULL, NULL),
(141, '37807', 'ANNISA ASRI SEPTIANTY', 'Permanent', 3, 39, 1, 1, '1996-09-22', '2016-05-01', '2016-05-01', '2019-05-01', NULL),
(142, '4192', 'THOMAS DEDI SUPRIADI', 'Permanent', 3, 39, 1, 1, '1976-11-27', '1997-10-01', '1997-10-01', '2001-03-01', NULL),
(143, '2720', 'MARIFAH', 'Permanent', 3, 39, 1, 1, '1970-02-02', '1993-10-20', '1993-10-20', '1996-02-01', NULL),
(144, '33895', 'FAGIL RACHMAN DARMAWAN PUTRA', 'Permanent', 3, 40, 1, 1, '1993-05-18', '2016-01-01', '2016-01-01', '2017-01-01', NULL),
(145, '26326', 'DEDI WAHYUDI', 'Permanent', 3, 40, 1, 1, '1987-08-10', '2014-12-01', '2014-12-01', '2016-07-01', NULL),
(146, '53886', 'IQBAL ALDITIO', 'Permanent', 3, 40, 1, 1, '1994-03-17', '2018-01-01', '2018-01-08', '2019-05-01', NULL),
(147, '17866', 'KURNIAWAN SUKMA PERMANA', 'Permanent', 3, 41, 1, 1, '1988-07-31', '2012-11-01', '2012-11-01', '2013-12-01', NULL),
(148, '13430', 'TIKA APRILIANA PRASETYOWATI', 'Permanent', 3, 41, 1, 1, '1990-04-21', '2010-09-01', '2010-09-01', '2012-12-01', NULL),
(149, '20183', 'LIDYA PERMATASARI', 'Permanent', 3, 41, 1, 1, '1995-04-12', '2013-03-01', '2013-03-01', '2015-09-01', NULL),
(150, '90883', 'MUHAMMAD ADITYA', 'Contract', 3, 42, 1, 1, '2003-07-17', '2025-08-01', '2025-07-21', NULL, NULL),
(151, '82895', 'NEDYA ANGGRAINI', 'Contract', 3, 42, 1, 1, '1999-08-23', '2023-05-01', '2023-05-08', NULL, NULL),
(152, '100533', 'INTAN SYIFFA FRATIKA', 'Contract', 3, 43, 1, 1, '2002-04-15', '2025-11-01', '2025-10-13', NULL, NULL),
(153, '100534', 'AZHAR SATRIA GHOZALI', 'Contract', 3, 43, 1, 1, '2000-05-11', '2025-11-01', '2025-10-11', NULL, NULL),
(154, '90550', 'AJI PAMUNGKAS', 'Contract', 3, 44, 1, 1, '1999-03-29', '2025-06-01', '2025-06-09', NULL, NULL),
(155, '100376', 'AMANDA DOROTHEA SANTOSA', 'Contract', 3, 44, 1, 1, '2003-05-05', '2025-10-01', '2025-09-22', NULL, NULL),
(156, '100511', 'ANDI SURYO NUGROHO', 'Contract', 3, 44, 1, 1, '2000-07-06', '2025-10-01', '2025-10-07', NULL, NULL),
(157, '87677', 'YOHANES DRAJAT BAGUS KUSUMA', 'Contract', 3, 45, 1, 1, '1997-01-31', '2024-08-01', '2024-07-29', NULL, NULL),
(158, '8094', 'HELMI ZULFADLI', 'Permanent', 3, 45, 1, 1, '1984-12-01', '2007-05-01', '2007-05-01', '2010-03-01', NULL),
(159, '8043', 'KRISNA PRASETYA', 'Permanent', 3, 45, 1, 1, '1984-04-04', '2007-04-01', '2007-04-01', '2009-02-01', NULL),
(160, '85928', 'UMI HANDAYANI', 'Contract', 3, 46, 1, 1, '1999-09-02', '2024-02-01', '2024-01-24', NULL, NULL),
(161, '1125', 'DYAH PERTIWI PURNAMANINGRUM', 'Permanent', 3, 46, 1, 1, '1967-01-20', '1988-06-15', '1988-06-15', '1989-10-01', NULL),
(162, '84700', 'IMAM SULAIMAN SYAH', 'Contract', 3, 46, 1, 1, '1997-05-01', '2023-11-01', '2023-11-01', NULL, NULL),
(163, '1252', 'SUNARKO', 'Permanent', 3, 47, 1, 1, '1966-11-22', '1989-06-01', '1989-06-01', '1990-06-01', NULL),
(164, '27886', 'LEONARD DANARO HARIYANTO', 'Permanent', 3, 47, 1, 1, '1989-11-08', '2015-01-01', '2015-01-01', '2016-01-01', NULL),
(165, '90079', 'MANUEL BENEDICTH IVAN SURYONINGMAS', 'Contract', 3, 47, 1, 1, '2000-10-16', '2025-05-01', '2025-04-21', NULL, NULL),
(166, '5458', 'PETRUS SARJITA', 'Permanent', 3, 47, 1, 1, '1982-11-19', '2002-05-01', '2002-05-01', '2004-11-01', NULL),
(167, '5364', 'TRIYO SUSANTO', 'Permanent', 3, 47, 1, 1, '1975-10-25', '2001-10-06', '2001-10-06', '2004-07-01', NULL),
(168, '2045', 'CH PURWANTININGSIH', 'Permanent', 3, 47, 1, 1, '1967-06-22', '1991-05-01', '1991-05-01', '1993-09-01', NULL),
(169, '89841', 'RIO BUDI HENDRAWAN', 'Contract', 3, 48, 1, 1, '2001-02-06', '2025-04-01', '2025-03-12', NULL, NULL),
(170, '4844', 'FRANSISCUS SUGIHARTO SAPT', 'Permanent', 3, 48, 1, 1, '1978-01-25', '1999-11-01', '1999-11-01', '2002-08-01', NULL),
(171, '2941', 'FERENA CHRISTINE LOLANG', 'Permanent', 3, 48, 1, 1, '1968-01-26', '1994-04-01', '1994-04-01', '1996-10-01', NULL),
(172, '37818', 'GUNTUR BAYU SAPUTRA', 'Permanent', 3, 49, 1, 1, '1993-09-09', '2016-06-01', '2016-06-01', '2018-06-01', NULL),
(173, '6285', 'NOVIA ANGGRAINY', 'Permanent', 3, 49, 1, 1, '1982-06-13', '2005-10-01', '2005-10-01', '2008-02-01', NULL),
(174, '31555', 'JOKO NUR ARIPPIN', 'Permanent', 3, 49, 1, 1, '1991-04-12', '2015-07-01', '2015-07-01', '2017-07-01', NULL),
(175, '2874', 'HERIBERTUS JUMARI', 'Permanent', 3, 49, 1, 1, '1971-06-03', '1994-03-01', '1994-03-01', '1996-07-01', NULL),
(176, '33322', 'HADI PRAYITNO', 'Permanent', 3, 49, 1, 1, '1991-11-13', '2015-12-01', '2015-12-01', '2016-12-01', NULL),
(177, '2680', 'MUKTI DARMA', 'Permanent', 3, 50, 1, 1, '1972-10-06', '1993-09-15', '1993-09-15', '1996-01-01', NULL),
(178, '5950', 'HARIYANI', 'Permanent', 3, 50, 1, 1, '1985-01-10', '2003-10-01', '2003-10-01', '2006-08-01', NULL),
(179, '5417', 'BAMBANG SETYO CAHYONO', 'Permanent', 3, 50, 1, 1, '1977-01-17', '2002-12-01', '2002-12-01', '2004-09-01', NULL),
(180, '8085', 'MUHLISIN', 'Permanent', 3, 51, 1, 1, '1988-01-25', '2007-05-01', '2007-05-01', '2010-03-01', NULL),
(181, '6313', 'JOKO NUGROHO', 'Permanent', 3, 51, 1, 1, '1981-12-30', '2006-02-01', '2006-02-01', '2008-03-01', NULL),
(182, '24542', 'WIWID MULYANI', 'Permanent', 3, 51, 1, 1, '1993-10-11', '2014-06-01', '2014-06-01', '2016-05-01', NULL),
(183, '89594', 'GEREIDO JOSA NAZARETA', 'Contract', 3, 52, 1, 1, '1998-08-23', '2025-03-01', '2025-02-12', NULL, NULL),
(184, '31408', 'ALDILLA RIZKY PRITAWARDHANI', 'Permanent', 3, 52, 1, 1, '1992-01-12', '2015-07-01', '2015-07-01', '2017-07-01', NULL),
(185, '76322', 'TONI EFENDI', 'Permanent', 3, 52, 1, 1, '1995-05-16', '2021-12-01', '2021-12-06', '2025-01-01', NULL),
(186, '6421', 'MARTA YOSEVA UNA ASRINI', 'Permanent', 3, 52, 1, 1, '1979-11-19', '2006-06-01', '2006-06-01', '2008-07-01', NULL),
(187, '89593', 'RIFQI NUGRAHA', 'Contract', 3, 53, 1, 1, '2000-10-06', '2025-03-01', '2025-02-12', NULL, NULL),
(188, '53496', 'MONIKA SEPTIANA ARUNI', 'Permanent', 3, 53, 1, 1, '1991-09-12', '2017-12-01', '2017-12-06', '2020-01-01', NULL),
(189, '2998', 'EMMANUEL EKO KURNIAWAN', 'Permanent', 3, 53, 1, 1, '1971-08-30', '1994-05-23', '1994-05-23', '1996-11-01', NULL),
(190, '89954', 'IGNATIUS PROMOVENDI DWIWANJANA PUTRA', 'Contract', 3, 54, 1, 1, '1999-03-11', '2025-04-01', '2025-03-27', NULL, NULL),
(191, '6154', 'PIA MARIA LENI MULYATI', 'Permanent', 3, 54, 1, 1, '1980-05-01', '2006-04-15', '2006-04-15', '2007-09-01', NULL),
(192, '88639', 'VICO TRI CAHYA RAMADHAN', '', 3, 54, 1, 1, '1999-12-28', '2024-11-01', '2024-11-06', NULL, NULL),
(193, '89099', 'MUHAMMAD UMAR BAHUSIN', 'Contract', 3, 55, 1, 1, '2001-09-11', '2025-01-01', '2024-12-16', NULL, NULL),
(194, '90833', 'DIAN TRI WIBOWO', 'Contract', 3, 55, 1, 1, '2000-10-17', '2025-08-01', '2025-07-10', NULL, NULL),
(195, '82034', 'ALBERTUS ABI GALIH PRATAMA', 'Contract', 3, 55, 1, 1, '1992-05-26', '2023-02-01', '2023-02-09', NULL, NULL),
(196, '2514', 'WIWIN KURNIASIH', 'Permanent', 3, 55, 1, 1, '1974-02-15', '1992-09-17', '1992-09-17', '1995-06-01', NULL),
(197, '6102', 'ITA INDARWATI', 'Permanent', 3, 55, 1, 1, '1981-10-25', '2006-02-01', '2006-02-01', '2007-06-01', NULL),
(198, '51448', 'ADHI LAKSMANA VIJAYA', 'Permanent', 3, 55, 1, 1, '1993-04-10', '2017-09-01', '2017-09-04', '2019-10-01', NULL),
(199, '23217', 'YUDIT MAHARGYANINGTYAS', 'Permanent', 3, 55, 1, 1, '1987-02-08', '2014-01-01', '2014-01-01', '2015-02-01', NULL),
(200, '7521', 'NYAYAN SOVIA RIYANTO', 'Permanent', 4, 56, 1, 1, '1981-10-01', '2007-11-01', '2007-11-01', '2010-03-01', NULL),
(201, '90077', 'ROBERT SEPTYANUS RAGA ADOE', 'Contract', 4, 56, 1, 1, '2001-09-13', '2025-05-01', '2025-04-17', NULL, NULL),
(202, '3526', 'DWI ENDANG PAMULARSIH SE', 'Permanent', 4, 56, 1, 1, '1972-01-24', '1997-02-01', '1997-02-01', '1998-01-01', NULL),
(203, '87369', 'DEANE MARGARETHA SAGALA', 'Contract', 4, 56, 1, 1, '1997-04-17', '2024-07-01', '2024-06-24', NULL, NULL),
(204, '90146', 'MUHAMMAD ANNAS FERDHIYANTO', 'Contract', 4, 57, 1, 1, '1999-07-20', '2025-05-01', '2025-04-21', NULL, NULL),
(205, '5775', 'SULAMIT SIMANJUNTAK', 'Permanent', 4, 57, 1, 1, '1981-10-15', '2003-10-01', '2003-10-01', '2006-01-01', NULL),
(206, '8687', 'TATY ENDANG SIMANULLANG', 'Permanent', 4, 57, 1, 1, '1981-08-13', '2007-12-01', '2007-12-01', '2010-06-01', NULL),
(207, '82112', 'I GUSTI NGURAH DWI PALGUNAWAN', 'Permanent', 4, 57, 1, 1, '1997-02-11', '2023-03-01', '2023-02-16', '2025-09-01', NULL),
(208, '25028', 'AGATA SRI KRISDIYATI', 'Permanent', 4, 58, 1, 1, '1992-02-18', '2014-07-01', '2014-07-01', '2016-01-01', NULL),
(209, '37121', 'VALENCIA ALWI', 'Permanent', 4, 58, 1, 1, '1991-04-19', '2016-04-01', '2016-04-01', '2017-04-01', NULL),
(210, '2761', 'ROCHILI', 'Permanent', 4, 58, 1, 1, '1972-03-18', '1993-11-16', '1993-11-16', '1996-03-01', NULL),
(211, '100422', 'HANIF FADHILAH', 'Contract', 4, 58, 1, 1, '2002-07-18', '2025-10-01', '2025-09-18', NULL, NULL),
(212, '88373', 'RONGGO TANTRI YOGYANTO', 'Contract', 4, 58, 1, 1, '1995-06-17', '2024-10-01', '2024-10-07', NULL, NULL),
(213, '3498', 'AMBRIZAL', 'Permanent', 4, 58, 1, 1, '1970-07-31', '1995-08-01', '1995-08-01', '1997-12-01', NULL),
(214, '86447', 'SETIYOWATI', 'Contract', 4, 58, 1, 1, '2000-04-10', '2024-04-01', '2024-03-12', NULL, NULL),
(215, '90266', 'AL DIO NDARU AL FARHAN', 'Contract', 4, 59, 1, 1, '2001-02-07', '2025-05-01', '2025-05-07', NULL, NULL),
(216, '100372', 'FAHRI FADILLAH', 'Contract', 4, 59, 1, 1, '2001-03-21', '2025-10-01', '2025-09-15', NULL, NULL),
(217, '2057', 'KANISIUS JEBATUNG', 'Permanent', 4, 59, 1, 1, '1967-05-18', '1991-06-15', '1991-06-15', '1993-10-01', NULL),
(218, '82893', 'HAIRUL UMAMI', 'Contract', 4, 60, 1, 1, '1998-12-08', '2023-06-01', '2023-06-01', NULL, NULL),
(219, '6217', 'ELISABETH RETNO HERIASTUTI', 'Permanent', 4, 60, 1, 1, '1980-08-06', '2006-01-16', '2006-01-16', '2007-12-01', NULL),
(220, '90263', 'RAHMAD FAHRI', 'Contract', 4, 61, 1, 1, '2001-01-14', '2025-05-01', '2025-05-05', NULL, NULL),
(221, '90551', 'CANDRA RAHMANSYAH', 'Contract', 4, 61, 1, 1, '2001-01-20', '2025-06-01', '2025-06-09', NULL, NULL),
(222, '90755', 'JONATHAN ARIO DEWANGGA', 'Contract', 4, 61, 1, 1, '2002-07-04', '2025-07-01', '2025-07-01', NULL, NULL),
(223, '90341', 'GAMALIEL RAHMAT P', 'Contract', 4, 62, 1, 1, '2000-04-17', '2025-06-01', '2025-05-13', NULL, NULL),
(224, '88838', 'SAYYIDAH AFINA SALSABILA NST', 'Contract', 4, 62, 1, 1, '2002-07-30', '2024-12-01', '2024-11-18', NULL, NULL),
(225, '89799', 'RISA FITRIANI', 'Contract', 4, 63, 1, 1, '2000-01-03', '2025-03-01', '2025-03-07', NULL, NULL),
(226, '32007', 'JULIHANSYAH', 'Permanent', 4, 63, 1, 1, '1992-07-18', '2015-08-01', '2015-08-01', '2016-08-01', NULL),
(227, '5238', 'FREDERICUS IRAWAN BUDIRAHARJO', 'Permanent', 4, 63, 1, 1, '1974-10-14', '2002-10-02', '2002-10-02', '2004-02-01', NULL),
(228, '28829', 'GAME SUPRIADI JUKSON L', 'Permanent', 4, 63, 1, 1, '1994-07-19', '2015-04-01', '2015-04-01', '2017-04-01', NULL),
(229, '6311', 'WIDI SUSANTO', 'Permanent', 4, 64, 1, 1, '1986-10-03', '2005-12-01', '2005-12-01', '2008-03-01', NULL),
(230, '87829', 'ANDRI IRWANTO', 'Contract', 4, 64, 1, 1, '1998-12-30', '2024-08-01', '2024-08-08', NULL, NULL),
(231, '82257', 'NATALIA MARBUN', 'Permanent', 4, 64, 1, 1, '1997-12-25', '2023-03-01', '2023-03-01', '2025-03-01', NULL),
(232, '8211', 'BERNARDUS TRI SANTOSO', 'Permanent', 4, 65, 1, 1, '1978-08-12', '2007-06-15', '2007-06-15', '2009-02-01', NULL),
(233, '85067', 'MOCH IQBAL ALGHIFARI', 'Contract', 4, 65, 1, 1, '1998-12-03', '2023-12-01', '2023-11-27', NULL, NULL),
(234, '86538', 'AFIFAH NURAWALIA', 'Contract', 4, 65, 1, 1, '2000-09-07', '2024-04-01', '2024-03-19', NULL, NULL),
(235, '84251', 'ANDREAS ANTON PRIYAMBODO', 'Contract', 4, 65, 1, 1, '1998-11-11', '2023-10-01', '2023-09-30', NULL, NULL),
(236, '5803', 'MARIANO KLAUDIUS CASA ULU WANGGE', 'Permanent', 4, 65, 1, 1, '1982-07-07', '2002-08-01', '2002-08-01', '2006-02-01', NULL),
(237, '3176', 'DEDY REYNOLD', 'Permanent', 4, 66, 1, 1, '1975-09-09', '1994-06-13', '1994-06-13', '1997-02-01', NULL),
(238, '82482', 'RANI TISIA PUTRI', 'Permanent', 4, 66, 1, 1, '1997-01-18', '2023-05-01', '2023-04-15', '2025-05-01', NULL),
(239, '3179', 'P RUDI HENDARTO', 'Permanent', 4, 66, 1, 1, '1970-06-22', '1994-06-13', '1994-06-13', '1997-02-01', NULL),
(240, '88820', 'MEGA AYU LESTARI', 'Contract', 4, 67, 1, 1, '1999-05-13', '2024-12-01', '2024-11-18', NULL, NULL),
(241, '88629', 'HILALUDIN AKBAR', 'Contract', 4, 67, 1, 1, '2001-07-13', '2024-11-01', '2024-10-28', NULL, NULL),
(242, '22317', 'JOSWA SAHAT M SILALAHI', 'Permanent', 4, 67, 1, 1, '1987-09-12', '2013-10-01', '2013-10-01', '2015-10-01', NULL),
(243, '3207', 'NYOMAN KERTI', 'Permanent', 4, 67, 1, 1, '1973-11-10', '1994-06-13', '1994-06-13', '1997-03-01', NULL),
(244, '68616', 'MARTIN SIREGAR', 'Permanent', 4, 68, 1, 1, '1990-04-22', '2019-11-01', '2019-11-01', '2023-11-01', NULL),
(245, '5398', 'AFRINALDI', 'Permanent', 4, 68, 1, 1, '1978-04-27', '2001-08-01', '2001-08-01', '2004-08-01', NULL),
(246, '2850', 'SISILIA LIDIYAWATI', 'Permanent', 4, 68, 1, 1, '1970-11-18', '1994-02-15', '1994-02-15', '1996-06-01', NULL),
(247, '5652', 'DONNY RESTUADI', 'Permanent', 4, 68, 1, 1, '1981-04-16', '2003-05-01', '2003-05-01', '2005-06-01', NULL),
(248, '87036', 'YEREMIA HENRY PUJIANTORO', 'Contract', 4, 69, 1, 1, '1999-05-30', '2024-07-01', '2024-06-17', NULL, NULL),
(249, '86802', 'AMANDA PUTRI PRASETYA', 'Contract', 4, 69, 1, 1, '2003-03-05', '2024-05-01', '2024-04-22', NULL, NULL),
(250, '89706', 'HADIID AL FATTAH', 'Contract', 4, 70, 1, 1, '1998-02-15', '2025-03-01', '2025-03-03', NULL, NULL),
(251, '5201', 'YULIATI', 'Permanent', 4, 70, 1, 1, '1977-07-01', '2001-05-15', '2001-05-15', '2003-12-01', NULL),
(252, '6422', 'TIURMA CHRISTINA', 'Permanent', 4, 70, 1, 1, '1982-01-27', '2006-05-15', '2006-05-15', '2008-07-01', NULL),
(253, '31092', 'FERDY FIRMANSYAH', 'Permanent', 4, 71, 1, 1, '1990-07-06', '2015-06-01', '2015-06-01', '2017-05-01', NULL),
(254, '5202', 'RITA MUSFIA', 'Permanent', 4, 71, 1, 1, '1976-01-28', '2001-05-15', '2001-05-15', '2003-12-01', NULL),
(255, '9404', 'SRI HARTATI SILABAN', 'Permanent', 4, 72, 1, 1, '1984-08-31', '2008-07-01', '2008-07-01', '2010-10-01', NULL),
(256, '7653', 'ANDRY MURYADI', 'Permanent', 4, 72, 1, 1, '1981-05-18', '2006-06-01', '2006-06-01', '2009-02-01', NULL),
(257, '86951', 'HANDA PUTRA MAIZA', 'Contract', 4, 72, 1, 1, '1997-02-24', '2024-05-01', '2024-05-08', NULL, NULL),
(258, '90145', 'ROSA MELIANA TAMPUBOLON', 'Contract', 4, 73, 1, 1, '2000-07-22', '2025-05-01', '2025-04-21', NULL, NULL),
(259, '87283', 'MOHAMMAD RAFIADI', 'Contract', 4, 73, 1, 1, '1997-06-24', '2024-06-01', '2024-06-03', NULL, NULL),
(260, '1829', 'WIJIARTI', 'Permanent', 4, 73, 1, 1, '1971-12-19', '1991-11-01', '1991-11-01', '1992-11-01', NULL),
(261, '39581', 'FERRY FERDIAN', 'Permanent', 4, 73, 1, 1, '1989-12-08', '2016-10-17', '2016-10-17', '2018-11-01', NULL),
(262, '2075', 'IGNATIUS SUBROTO', 'Permanent', 4, 74, 1, 1, '1970-07-28', '1991-07-14', '1991-07-14', '1993-11-01', NULL),
(263, '42922', 'EKO PUTRA PAMBAGYO', 'Permanent', 4, 74, 1, 1, '1994-12-28', '2017-05-01', '2017-04-17', '2019-05-01', NULL),
(264, '81373', 'GETFI FEBSINTA', 'Contract', 4, 74, 1, 1, '1999-02-24', '2023-01-01', '2021-12-27', NULL, NULL),
(265, '90188', 'FEBRIYANA PRATAMA', 'Contract', 4, 75, 1, 1, '1999-02-22', '2025-05-01', '2025-04-28', NULL, NULL),
(266, '90609', 'SITI HUMAEROH', 'Contract', 4, 75, 1, 1, '2002-11-24', '2025-07-01', '2025-06-20', NULL, NULL),
(267, '89832', 'ALIEF ARDILES', 'Contract', 5, 76, 1, 1, '2002-04-29', '2025-04-01', '2025-03-14', NULL, NULL),
(268, '100530', 'MAYLANI ANGELINA SIMANUNGKALIT', 'Contract', 5, 76, 1, 1, '2002-05-12', '2025-11-01', '2025-10-11', NULL, NULL),
(269, '84912', 'NAUFAL DAANI ALHADI ASRI', 'Contract', 5, 76, 1, 1, '1998-11-19', '2023-11-01', '2023-11-09', NULL, NULL),
(270, '4885', 'VENTRI YUNITA', 'Permanent', 5, 76, 1, 1, '1973-06-24', '2000-08-01', '2000-08-01', '2002-10-01', NULL),
(271, '90788', 'SAMUELI ZEGA', 'Contract', 5, 77, 1, 1, '2002-02-27', '2025-07-01', '2025-07-07', NULL, NULL),
(272, '91086', 'MUH IQBAL KHAEDAR', 'Contract', 5, 77, 1, 1, '2001-04-22', '2025-09-01', '2025-09-01', NULL, NULL),
(273, '33787', 'NASIR RABA', 'Permanent', 5, 77, 1, 1, '1992-05-11', '2016-01-01', '2016-01-01', '2019-01-01', NULL),
(274, '7695', 'YADI', 'Permanent', 5, 78, 1, 1, '1988-06-03', '2006-09-01', '2006-09-01', '2009-11-01', NULL),
(275, '90143', 'NURCHOLIS AJI', 'Contract', 5, 78, 1, 1, '1999-06-03', '2025-05-01', '2025-04-21', NULL, NULL),
(276, '5998', 'SRI SARTIKA', 'Permanent', 5, 78, 1, 1, '1982-09-18', '2004-06-01', '2004-06-01', '2006-11-01', NULL),
(277, '90927', 'FARIZ OKY MAHENDRA', 'Contract', 5, 79, 1, 1, '2001-12-03', '2025-08-01', '2025-07-29', NULL, NULL),
(278, '100568', 'TAUFIQ HIDAYAT', 'Contract', 5, 79, 1, 1, '2002-05-15', '2025-11-01', '2025-11-01', NULL, NULL),
(279, '13885', 'FITRIYANI N', 'Permanent', 5, 79, 1, 1, '1987-05-27', '2010-11-01', '2010-11-01', '2012-11-01', NULL),
(280, '9568', 'LISYA FELANI', 'Permanent', 5, 79, 1, 1, '1985-02-08', '2008-08-01', '2008-08-01', '2010-07-01', NULL),
(281, '90766', 'FITHROTURROHMAH', 'Contract', 5, 80, 1, 1, '2001-08-29', '2025-07-01', '2025-07-04', NULL, NULL),
(282, '90767', 'RIFQY DWIANDRA WIBOWO', 'Contract', 5, 80, 1, 1, '2002-07-12', '2025-07-01', '2025-07-04', NULL, NULL),
(283, '88592', 'ALVEN', 'Contract', 5, 80, 1, 1, '2003-09-09', '2024-11-01', '2024-10-28', NULL, NULL),
(284, '82659', 'ILHAM AMIRUL HUDA', 'Contract', 5, 80, 1, 1, '1997-12-07', '2023-05-01', '2023-05-01', NULL, NULL),
(285, '90327', 'HIJRAN MAHJURA', 'Contract', 5, 81, 1, 1, '2001-03-04', '2025-06-01', '2025-05-09', NULL, NULL),
(286, '90328', 'MUHAMAD INDRA BHAKTI', 'Contract', 5, 81, 1, 1, '2000-06-08', '2025-06-01', '2025-05-10', NULL, NULL),
(287, '2072', 'SUGINO', 'Permanent', 5, 81, 1, 1, '1967-12-10', '1991-07-15', '1991-07-15', '1993-11-01', NULL),
(288, '89772', 'LEONARDUS ANDREW PRAMONO', 'Contract', 5, 82, 1, 1, '2000-11-06', '2025-03-01', '2025-03-05', NULL, NULL),
(289, '4772', 'AJI BUDIANTO', 'Permanent', 5, 82, 1, 1, '1979-11-07', '2000-01-03', '2000-01-03', '2002-07-01', NULL),
(290, '86750', 'REBEKKA RISANTY SIMBOLON', 'Contract', 5, 82, 1, 1, '1998-09-06', '2024-05-01', '2024-04-08', NULL, NULL),
(291, '4144', 'DEDI', 'Permanent', 5, 82, 1, 1, '1975-05-12', '1997-07-03', '1997-07-03', '2001-02-01', NULL),
(292, '8543', 'EDISON', 'Permanent', 5, 83, 1, 1, '1982-11-05', '2007-11-01', '2007-11-01', '2010-04-01', NULL),
(293, '1855', 'AKHMAD FAUZUDIN', 'Permanent', 5, 83, 1, 1, '1970-03-20', '1990-08-27', '1990-08-27', '1992-12-01', NULL),
(294, '7635', 'RAHMAT WIDAYAT', 'Permanent', 5, 83, 1, 1, '1984-06-18', '2006-04-01', '2006-04-01', '2009-02-01', NULL),
(295, '8606', 'ERNA ARYA RAFTIA', 'Permanent', 5, 83, 1, 1, '1987-03-03', '2007-12-01', '2007-12-01', '2010-07-01', NULL),
(296, '8158', 'SEPTRIAN', 'Permanent', 5, 83, 1, 1, '1987-09-19', '2007-06-01', '2007-06-01', '2010-06-01', NULL),
(297, '2848', 'NURBIANTO', 'Permanent', 5, 83, 1, 1, '1967-10-28', '1994-02-16', '1994-02-16', '1996-06-01', NULL),
(298, '89141', 'BRENDA LIEONY', 'Contract', 5, 85, 1, 1, '2000-02-21', '2025-01-01', '2024-12-19', NULL, NULL),
(299, '90385', 'AUDRI PUTRI RISPANI', 'Contract', 5, 85, 1, 1, '2001-05-04', '2025-06-01', '2025-05-26', NULL, NULL),
(300, '87231', 'ULLANG EGA FAZERI', 'Contract', 5, 85, 1, 1, '1998-10-18', '2024-06-01', '2024-06-10', NULL, NULL),
(301, '1854', 'SUMERI', 'Permanent', 5, 85, 1, 1, '1969-12-01', '1990-08-27', '1990-08-27', '1992-12-01', NULL),
(302, '1847', 'LEONARDUS WIDIYONO', 'Permanent', 5, 86, 1, 1, '1971-07-05', '1990-08-27', '1990-08-27', '1992-12-01', NULL),
(303, '88920', 'ANCE ROMAULI HUTAPEA', 'Contract', 5, 86, 1, 1, '2001-02-10', '2024-12-01', '2024-11-28', NULL, NULL),
(304, '87358', 'LISA MARLINI', 'Contract', 5, 86, 1, 1, '1998-03-03', '2024-07-01', '2024-06-24', NULL, NULL),
(305, '87079', 'ELBA HANDAYANI', 'Contract', 5, 86, 1, 1, '2000-04-23', '2024-06-01', '2024-06-01', NULL, NULL),
(306, '90137', 'INTAN CAHYANI RATNAJUITA', 'Contract', 5, 87, 1, 1, '2002-03-06', '2025-05-01', '2025-04-19', NULL, NULL),
(307, '90394', 'TOMY ADITYA WIGUNA', 'Contract', 5, 87, 1, 1, '2001-05-08', '2025-06-01', '2025-05-28', NULL, NULL),
(308, '89218', 'VARELZA GERALDO', 'Contract', 5, 88, 1, 1, '2000-08-07', '2025-01-01', '2024-12-27', NULL, NULL),
(309, '77628', 'DANANG SURYONO', 'Permanent', 5, 88, 1, 1, '1996-06-07', '2022-04-01', '2022-04-01', '2024-10-01', NULL),
(310, '68656', 'RASYIDA', 'Permanent', 5, 88, 1, 1, '1988-10-19', '2019-11-01', '2019-11-01', '2023-05-01', NULL),
(311, '71543', 'MUTIARA LARASATI PERMONO', 'Permanent', 5, 88, 1, 1, '1994-11-07', '2020-11-01', '2020-11-01', '2022-11-01', NULL),
(312, '2766', 'SITI SANGIDAH', 'Permanent', 5, 88, 1, 1, '1974-04-27', '1993-11-16', '1993-11-16', '1996-03-01', NULL),
(313, '89471', 'RIVALDI NADILLAH', 'Contract', 5, 89, 1, 1, '1997-07-29', '2025-02-01', '2025-02-03', NULL, NULL),
(314, '89716', 'VENNERANDA ALEYINDRI MONA', 'Contract', 5, 89, 1, 1, '2002-11-03', '2025-03-01', '2025-03-01', NULL, NULL),
(315, '90381', 'ANTONIUS HARPEN', 'Contract', 5, 89, 1, 1, '1999-05-02', '2025-06-01', '2025-05-23', NULL, NULL),
(316, '90413', 'FARHAN MAULANA NUGROHO', 'Contract', 5, 89, 1, 1, '2000-07-01', '2025-06-01', '2025-06-02', NULL, NULL),
(317, '7797', 'SUSANA DEWI', 'Permanent', 5, 89, 1, 1, '1982-08-03', '2006-12-01', '2006-12-01', '2009-11-01', NULL),
(318, '89774', 'RIZSKY SAPOETRA', 'Contract', 5, 90, 1, 1, '2001-07-15', '2025-03-01', '2025-03-05', NULL, NULL),
(319, '100532', 'RAMADHANI', 'Contract', 5, 90, 1, 1, '2000-11-16', '2025-11-01', '2025-10-13', NULL, NULL),
(320, '86059', 'NADIA DWI SUSANTI', 'Contract', 5, 90, 1, 1, '1997-11-13', '2024-02-01', '2024-02-05', NULL, NULL),
(321, '89329', 'ACHMAD DANDY', 'Contract', 5, 91, 1, 1, '1999-09-02', '2025-02-01', '2025-01-13', NULL, NULL),
(322, '88168', 'DHERIS MAHENDRA', 'Contract', 5, 91, 1, 1, '2001-10-13', '2024-10-01', '2024-09-09', NULL, NULL),
(323, '89842', 'GILANG FIRZA ASYRAFA', 'Contract', 5, 92, 1, 1, '1999-04-14', '2025-04-01', '2025-03-14', NULL, NULL),
(324, '73540', 'M MIRZA', 'Contract', 5, 92, 1, 1, '1985-03-29', '2021-04-01', '2021-04-01', NULL, NULL),
(325, '42105', 'SELFIAH ARSITAH', 'Permanent', 5, 92, 1, 1, '1992-09-12', '2017-03-01', '2017-02-16', '2019-04-01', NULL),
(326, '7989', 'GREGORIUS JOSEPANG', 'Permanent', 5, 93, 1, 1, '1983-06-07', '2007-03-01', '2007-03-01', '2009-11-01', NULL),
(327, '7991', 'HADI ISTANTO', 'Permanent', 5, 93, 1, 1, '1985-11-09', '2007-03-01', '2007-03-01', '2009-11-01', NULL),
(328, '88626', 'DICHO ALFALAH', 'Contract', 6, 94, 1, 1, '2000-02-21', '2024-11-01', '2023-01-07', NULL, NULL),
(329, '52964', 'FAHMI REZA JAMIL', 'Permanent', 6, 94, 1, 1, '1990-05-15', '2017-12-01', '2017-11-17', '2019-12-01', NULL),
(330, '52723', 'ISTI PURWANTO', 'Permanent', 6, 94, 1, 1, '1994-05-24', '2017-11-01', '2017-11-06', '2019-12-01', NULL),
(331, '5305', 'NOFI AMELIA', 'Permanent', 6, 94, 1, 1, '1978-08-03', '2002-11-15', '2002-11-15', '2004-05-01', NULL),
(332, '86787', 'ALFI RISKY RAHMANDA', 'Contract', 6, 94, 1, 1, '2002-02-13', '2024-05-01', '2024-04-20', NULL, NULL),
(333, '1938', 'DEDI SETIADI', 'Permanent', 6, 95, 1, 1, '1969-03-25', '1990-12-01', '1990-12-01', '1993-03-01', NULL),
(334, '88432', 'MICHELLE ANGEL', 'Contract', 6, 95, 1, 1, '2002-03-08', '2024-11-01', '2024-10-11', NULL, NULL),
(335, '88433', 'YOLISTIA MAHARANI ISMAIL PUTRI', 'Contract', 6, 95, 1, 1, '2000-10-03', '2024-11-01', '2024-10-11', NULL, NULL),
(336, '1969', 'TARCICIUS SUTARJONO', 'Permanent', 6, 96, 1, 1, '1969-08-07', '1991-02-01', '1991-02-01', '1993-05-01', NULL),
(337, '3120', 'ADIS HADIAT', 'Permanent', 6, 96, 1, 1, '1972-09-13', '1994-12-17', '1994-12-17', '1997-01-01', NULL),
(338, '7640', 'MARIA FRIDA LIZA NOVA', 'Permanent', 6, 96, 1, 1, '1983-05-26', '2006-04-01', '2006-04-01', '2009-11-01', NULL),
(339, '5616', 'MILA MARLIANI', 'Permanent', 6, 97, 1, 1, '1978-01-13', '2001-11-01', '2001-11-01', '2005-05-01', NULL),
(340, '87610', 'AULIA NATHANIA ANDRIANI', 'Contract', 6, 97, 1, 1, '2002-08-26', '2024-08-01', '2024-07-17', NULL, NULL),
(341, '91218', 'YUSTINUS SUKMA NARENDRO', 'Contract', 6, 97, 1, 1, '2000-11-01', '2025-09-01', '2025-09-08', NULL, NULL),
(342, '78447', 'PRIMA AJI SAPUTRA', 'Contract', 6, 97, 1, 1, '1999-05-24', '2022-06-01', '2022-06-04', NULL, NULL),
(343, '83615', 'ANGELINE NINDA JESICA', 'Permanent', 6, 97, 1, 1, '2001-06-01', '2023-08-01', '2023-07-24', '2025-09-01', NULL),
(344, '4703', 'ELAN SUHERLAN', 'Permanent', 6, 97, 1, 1, '1979-04-04', '1999-06-01', '1999-06-01', '2002-04-01', NULL),
(345, '1455', 'YB TRIYANTO', 'Permanent', 6, 97, 1, 1, '1969-09-27', '1989-01-01', '1989-01-01', '1991-04-01', NULL),
(346, '100510', 'ADINDA EINE AZALIA', 'Contract', 6, 98, 1, 1, '2002-06-12', '2025-10-01', '2025-10-09', NULL, NULL),
(347, '5494', 'TINA NELLY SIMAMORA', 'Permanent', 6, 98, 1, 1, '1979-02-26', '2001-11-01', '2001-11-01', '2004-12-01', NULL),
(348, '88755', 'GEGER YUNIAR', '', 6, 98, 1, 1, '2001-06-16', '2024-11-01', '2024-11-02', NULL, NULL),
(349, '36971', 'ANDREAS HANSEN', 'Permanent', 6, 99, 1, 1, '1991-03-14', '2016-04-01', '2016-04-01', '2018-04-01', NULL),
(350, '90185', 'ZEPHANYA YEHUDA LEUNISSEN', 'Contract', 6, 99, 1, 1, '2001-08-15', '2025-05-01', '2025-05-05', NULL, NULL),
(351, '87662', 'NISRINA NURFELITA SARI', 'Contract', 6, 99, 1, 1, '1999-08-01', '2024-08-01', '2024-08-07', NULL, NULL),
(352, '87617', 'PUTU GOVINDA PARAMITA', 'Contract', 6, 100, 1, 1, '2002-12-12', '2024-08-01', '2024-07-18', NULL, NULL),
(353, '86231', 'APRILDO PANJAITAN', 'Contract', 6, 100, 1, 1, '1999-04-25', '2024-03-01', '2024-02-22', NULL, NULL),
(354, '6003', 'DORKAS DESIMA', 'Permanent', 6, 100, 1, 1, '1977-12-14', '2005-11-21', '2005-11-21', '2006-12-01', NULL),
(355, '90888', 'SUGENG DWY WIRA UTAMA', 'Contract', 6, 101, 1, 1, '2003-01-07', '2025-08-01', '2025-08-08', NULL, NULL),
(356, '3830', 'WIWIT WIDYASTUTI', 'Permanent', 6, 101, 1, 1, '1976-04-07', '1996-09-01', '1996-09-01', '2000-03-01', NULL),
(357, '89327', 'RAYHAN FAWWAZ KENANDI', 'Contract', 6, 102, 1, 1, '1998-10-06', '2025-02-01', '2025-01-22', NULL, NULL),
(358, '87365', 'LULU ARSYLIA', 'Contract', 6, 102, 1, 1, '2001-03-29', '2024-07-01', '2024-06-24', NULL, NULL),
(359, '89179', 'DESHINTA PUTRI DEWANTI', 'Contract', 6, 102, 1, 1, '1999-12-20', '2025-02-01', '2025-01-20', NULL, NULL),
(360, '82765', 'ANISA NURCHOTIMAH', 'Contract', 6, 103, 1, 1, '2000-04-22', '2023-05-01', '2023-04-24', NULL, NULL),
(361, '1463', 'CAHYONO DARMADI', 'Permanent', 6, 103, 1, 1, '1967-02-07', '1988-12-19', '1988-12-19', '1991-04-01', NULL),
(362, '90599', 'IGLO MONTANA DHARMAWAN', 'Contract', 6, 104, 1, 1, '2003-01-07', '2025-07-01', '2025-06-16', NULL, NULL),
(363, '83258', 'YAGA TIAKA HALOMOAN ARITSI', 'Contract', 6, 104, 1, 1, '1997-10-18', '2023-07-01', '2023-06-12', NULL, NULL),
(364, '6235', 'GILANG NOVTU ANDANA', 'Permanent', 6, 104, 1, 1, '1982-11-30', '2004-10-01', '2004-10-01', '2008-01-01', NULL),
(365, '80204', 'HELENA DISIA NADIA TARINA', 'Contract', 6, 104, 1, 1, '1999-08-12', '2022-10-01', '2022-10-10', NULL, NULL),
(366, '89143', 'ANGGUN PRAMUDITA', 'Contract', 6, 105, 1, 1, '2002-05-17', '2025-01-01', '2024-12-27', NULL, NULL),
(367, '89409', 'FEBRIANI YUSNIKANA', 'Contract', 6, 105, 1, 1, '2001-02-06', '2025-02-01', '2025-02-01', NULL, NULL),
(368, '90075', 'EBENHAEZER ELKANA SINAMOHINA', 'Contract', 6, 105, 1, 1, '2003-03-18', '2025-05-01', '2025-04-14', NULL, NULL),
(369, '90610', 'SEVILA DELIAYANA', 'Contract', 6, 105, 1, 1, '2001-02-05', '2025-07-01', '2025-06-20', NULL, NULL),
(370, '88074', 'AJENG SYAFA KAULIKA', 'Contract', 6, 106, 1, 1, '2001-01-16', '2024-09-01', '2024-08-26', NULL, NULL),
(371, '87860', 'ANDREAS APRIAL PARDAMEAN SIMARMATA', 'Contract', 6, 106, 1, 1, '2001-04-12', '2024-09-01', '2024-08-12', NULL, NULL),
(372, '90334', 'AGUNG MUHAMMAD YUSUF', 'Contract', 6, 107, 1, 1, '2000-11-15', '2025-06-01', '2025-05-07', NULL, NULL),
(373, '100558', 'JIM JOHANNES PANGERAPAN', 'Contract', 6, 107, 1, 1, '2002-01-21', '2025-11-01', '2025-10-18', NULL, NULL),
(374, '85506', 'SITI PATIMAH SAIDAH', 'Contract', 6, 108, 1, 1, '2000-02-17', '2024-01-01', '2023-12-16', NULL, NULL),
(375, '77829', 'RAMA TIYANA', 'Permanent', 6, 108, 1, 1, '1998-01-27', '2022-04-01', '2022-04-05', '2025-05-01', NULL),
(376, '86749', 'HASNA KHOIRUNNISA CAHYADINATA', 'Contract', 6, 108, 1, 1, '2002-02-25', '2024-05-01', '2024-04-08', NULL, NULL),
(377, '41447', 'RIYANA', 'Permanent', 6, 109, 1, 1, '1994-07-27', '2017-01-01', '2017-01-01', '2017-01-01', NULL),
(378, '84223', 'FAISAL WAHYU', 'Contract', 6, 109, 1, 1, '1998-02-03', '2023-10-01', '2023-09-21', NULL, NULL),
(379, '100535', 'MARKUS LEO NARDO', 'Contract', 6, 109, 1, 1, '1999-02-12', '2025-11-01', '2025-10-13', NULL, NULL),
(380, '5802', 'WILI SETIYONO', 'Permanent', 6, 110, 1, 1, '1978-07-31', '2003-04-01', '2003-04-01', '2006-02-01', NULL),
(381, '91153', 'MICHELLE APRILIA HERAWAN', 'Contract', 6, 110, 1, 1, '2002-04-11', '2025-09-01', '2025-09-01', NULL, NULL),
(382, '91154', 'DIO PRASETIO', 'Contract', 6, 110, 1, 1, '2002-05-22', '2025-09-01', '2025-09-01', NULL, NULL),
(383, '1303', 'PRIDADI', 'Permanent', 6, 110, 1, 1, '1966-02-08', '1988-06-16', '1988-06-16', '1990-10-01', NULL),
(384, '83259', 'CHRITOFORUS DEVAN DWICAHYO', 'Contract', 6, 110, 1, 1, '1996-04-08', '2023-07-01', '2023-06-12', NULL, NULL),
(385, '38546', 'RANDI APRIANSYAH RAMADHAN', 'Permanent', 6, 110, 1, 1, '1989-04-26', '2016-08-01', '2016-08-01', '2017-09-01', NULL),
(386, '89912', 'NANDA FAKHIRA SANI', 'Contract', 6, 111, 1, 1, '2001-08-01', '2025-04-01', '2025-03-19', NULL, NULL),
(387, '90104', 'FARHAN AONILLAH', 'Contract', 6, 111, 1, 1, '2001-01-02', '2025-05-01', '2025-04-17', NULL, NULL),
(388, '37469', 'ULFI FATCHIYATUL JANNAH', 'Permanent', 6, 112, 1, 1, '1991-02-04', '2016-04-15', '2016-04-15', '2019-05-01', NULL),
(389, '90488', 'MUHAMMAD MUKHLASIN FATANI', 'Contract', 6, 112, 1, 1, '1998-07-03', '2025-06-01', '2025-06-04', NULL, NULL),
(390, '89595', 'JESSICA SILALAHI', 'Contract', 6, 113, 1, 1, '1999-04-22', '2025-03-01', '2025-02-15', NULL, NULL),
(391, '90624', 'MEGA LAURA LUBIS', 'Contract', 6, 113, 1, 1, '1999-07-02', '2025-07-01', '2025-07-01', NULL, NULL),
(392, '100415', 'ALEX SALENCO MANIK', 'Contract', 6, 113, 1, 1, '1999-09-14', '2025-11-01', '2025-11-01', NULL, NULL),
(393, '85507', 'FEBRUARI KURNIA WARUWU', 'Contract', 6, 113, 1, 1, '1997-02-15', '2024-01-01', '2023-12-18', NULL, NULL),
(394, '39484', 'MANGARISSAN SIDABUTAR', 'Permanent', 6, 113, 1, 1, '1991-05-30', '2016-10-10', '2016-10-10', '2017-11-01', NULL),
(395, '86941', 'PARIS MAVEL MORATA PURBA', 'Contract', 6, 113, 1, 1, '1999-06-13', '2024-05-01', '2024-05-07', NULL, NULL),
(396, '1992', 'BONI BONAVENTURA REVON CA', 'Permanent', 6, 113, 1, 1, '1971-07-14', '1990-12-07', '1990-12-07', '1993-06-01', NULL),
(397, '2785', 'IRAWATI', 'Permanent', 6, 113, 1, 1, '1974-06-29', '1993-11-01', '1993-11-01', '1996-04-01', NULL),
(398, '86184', 'DHAMIRA ANGGI MANDIRA LUBIS', 'Contract', 6, 114, 1, 1, '1998-09-16', '2024-03-01', '2024-02-19', NULL, NULL),
(399, '1991', 'MARJONO', 'Permanent', 6, 114, 1, 1, '1973-12-11', '1990-10-07', '1990-10-07', '1993-06-01', NULL),
(400, '54056', 'REZA SAPUTRA RAMBE', 'Permanent', 6, 115, 1, 1, '1994-09-13', '2018-02-01', '2018-01-16', '2020-02-01', NULL),
(401, '10489', 'ELISNA RISTAULI RAJAGUKGUK', 'Permanent', 6, 115, 1, 1, '1985-01-16', '2009-03-01', '2009-03-01', '2011-08-01', NULL),
(402, '3558', 'YENTI RUMONDANG HUTAHURUK', 'Permanent', 6, 115, 1, 1, '1970-02-26', '1995-10-09', '1995-10-09', '1999-03-01', NULL),
(403, '89963', 'GITA LARASATI NUGROHO', 'Contract', 6, 116, 1, 1, '2001-06-11', '2025-04-01', '2025-04-04', NULL, NULL),
(404, '81485', 'REZA ILHAM FAKHRI', 'Contract', 6, 116, 1, 1, '1999-05-24', '2023-01-01', '2023-01-02', NULL, NULL),
(405, '88779', 'WINNI MULYANI SONJAYA', '', 6, 117, 1, 1, '2000-10-13', '2024-11-01', '2024-11-06', NULL, NULL),
(406, '87124', 'ANGGIA FEBIANKA', 'Contract', 6, 117, 1, 1, '2001-02-25', '2024-06-01', '2024-05-30', NULL, NULL),
(407, '90862', 'FADHLI SYAMSI', 'Contract', 6, 118, 1, 1, '2002-09-01', '2025-08-01', '2025-07-15', NULL, NULL),
(408, '21991', 'SEVINA SETIADHARMA', 'Permanent', 6, 118, 1, 1, '1989-11-13', '2013-09-01', '2013-09-01', '2015-06-01', NULL),
(409, '28307', 'ELTRIS AGUSTINO', 'Permanent', 6, 118, 1, 1, '1989-08-02', '2015-02-01', '2015-02-01', '2016-09-01', NULL),
(410, '90520', 'ERICHA LINGGA PARAWANGSA', 'Contract', 7, 119, 1, 1, '2000-05-24', '2025-06-01', '2025-06-09', NULL, NULL),
(411, '87887', 'DEWA MADE BAGUS BHIMA SURYAJAYA', 'Contract', 7, 119, 1, 1, '2000-10-23', '2024-09-01', '2024-08-13', NULL, NULL),
(412, '4847', 'ANASTASIA MARIA FATIMA ESL', 'Permanent', 7, 119, 1, 1, '1978-03-27', '2000-02-01', '2000-02-01', '2002-08-01', NULL),
(413, '4779', 'NI NYOMAN DEWI YUNIARTI', 'Permanent', 7, 119, 1, 1, '1978-06-05', '1999-01-01', '1999-01-01', '2002-07-01', NULL),
(414, '89047', 'ANISA PUTRI NUR HIDAYAH', 'Contract', 7, 120, 1, 1, '1999-05-06', '2024-12-01', '2024-12-02', NULL, NULL),
(415, '90277', 'KHALIFAH ALIF SYAFRI', 'Contract', 7, 120, 1, 1, '1998-02-28', '2025-06-01', '2025-05-12', NULL, NULL),
(416, '2410', 'NI MADE ADI HARINATAL', 'Permanent', 7, 120, 1, 1, '1972-12-25', '1992-09-21', '1992-09-21', '1995-03-01', NULL),
(417, '40438', 'DEDI KURNIAWAN', 'Permanent', 7, 120, 1, 1, '1991-07-18', '2016-11-23', '2016-11-23', '2018-12-01', NULL),
(418, '40210', 'KADEK AYU CAHYA MANIK', 'Permanent', 7, 121, 1, 1, '1995-12-17', '2016-11-10', '2016-11-10', '2019-12-01', NULL),
(419, '86692', 'LUKMANUL HAKIM', 'Contract', 7, 121, 1, 1, '1999-05-04', '2024-04-01', '2024-04-05', NULL, NULL),
(420, '3246', 'SARTO', 'Permanent', 7, 121, 1, 1, '1972-11-17', '1994-10-01', '1994-10-01', '1997-04-01', NULL);
INSERT INTO `employees` (`id`, `employee_id`, `name`, `contract_type`, `region_id`, `store_id`, `section_id`, `job_id`, `birthday`, `initial_employment_date`, `joining_date`, `permanent_date`, `updated_at`) VALUES
(421, '90598', 'STEVANUS SELAMET MULYONO', 'Contract', 7, 122, 1, 1, '2000-09-22', '2025-07-01', '2025-06-10', NULL, NULL),
(422, '87663', 'NI WAYAN EKAYANI', 'Contract', 7, 122, 1, 1, '2001-04-05', '2024-08-01', '2024-07-25', NULL, NULL),
(423, '83881', 'JEHAN FAHMI RIDWAN', 'Permanent', 7, 122, 1, 1, '1998-02-25', '2023-09-01', '2023-08-21', '2025-09-01', NULL),
(424, '2345', 'I KETUT SUMEYASA', 'Permanent', 7, 122, 1, 1, '1970-12-01', '1992-09-01', '1992-09-01', '1995-01-01', NULL),
(425, '90268', 'ALDI WAHYU NUGROHO', 'Contract', 7, 123, 1, 1, '1999-01-04', '2025-05-01', '2025-05-06', NULL, NULL),
(426, '90269', 'BAGUS SATRIO NUGROHO', 'Contract', 7, 123, 1, 1, '1999-12-09', '2025-05-01', '2025-05-06', NULL, NULL),
(427, '22585', 'YEYEN S HUYO', 'Permanent', 7, 124, 1, 1, '1991-06-07', '2013-11-01', '2013-11-01', '2015-11-01', NULL),
(428, '82433', 'WIRANTO NALOLE', 'Contract', 7, 124, 1, 1, '1997-08-17', '2023-04-01', '2023-03-18', NULL, NULL),
(429, '22751', 'ARIANON SUMBEANG', 'Permanent', 7, 124, 1, 1, '1987-01-25', '2013-11-01', '2013-11-01', '2015-10-01', NULL),
(430, '2171', 'FARID MAGHFUR', 'Permanent', 7, 125, 1, 1, '1972-10-07', '1991-12-01', '1991-12-01', '1994-04-01', NULL),
(431, '6185', 'TITIN WANDANSARI', 'Permanent', 7, 125, 1, 1, '1983-08-20', '2006-11-01', '2006-11-01', '2007-11-01', NULL),
(432, '12693', 'MEINITA SUCIATI', 'Permanent', 7, 125, 1, 1, '1987-05-17', '2010-05-01', '2010-05-01', '2012-06-01', NULL),
(433, '5752', 'HAFID ROSIDI', 'Permanent', 7, 125, 1, 1, '1981-07-13', '2002-10-01', '2002-10-01', '2005-12-01', NULL),
(434, '12960', 'CHITRA NEGARI PUTRI DIYANAWATI', 'Permanent', 7, 126, 1, 1, '1988-07-17', '2010-06-01', '2010-06-01', '2012-06-01', NULL),
(435, '13415', 'KUSUMA TRIWARDHANA', 'Permanent', 7, 126, 1, 1, '1986-10-27', '2010-09-01', '2010-09-01', '2012-09-01', NULL),
(436, '16513', 'RAHMA BINTARIATI', 'Permanent', 7, 126, 1, 1, '1990-06-07', '2012-05-01', '2012-05-01', '2014-08-01', NULL),
(437, '8153', 'EKO YUDHO PRASETYO', 'Permanent', 7, 127, 1, 1, '1984-04-30', '2007-06-01', '2007-06-01', '2010-04-01', NULL),
(438, '90148', 'SETYAWAN TRIADITAMA', 'Contract', 7, 127, 1, 1, '2000-09-07', '2025-05-01', '2025-04-21', NULL, NULL),
(439, '2405', 'ISNANIK', 'Permanent', 7, 127, 1, 1, '1971-02-24', '1992-12-01', '1992-12-01', '1995-03-01', NULL),
(440, '1340', 'MOH WAHYUDI', 'Permanent', 7, 127, 1, 1, '1967-03-05', '1987-02-06', '1987-02-06', '1991-01-01', NULL),
(441, '6278', 'SURYONO', 'Permanent', 7, 127, 1, 1, '1984-01-14', '2005-06-01', '2005-06-01', '2008-02-01', NULL),
(442, '90928', 'BERNICKE KARTIKA PUTRI', 'Contract', 7, 128, 1, 1, '2002-03-21', '2025-08-01', '2025-08-01', NULL, NULL),
(443, '8508', 'DWI ANDRI SEPTIADI', 'Permanent', 7, 128, 1, 1, '1984-09-20', '2007-10-01', '2007-10-01', '2010-04-01', NULL),
(444, '2407', 'MARIUS PURWITO', 'Permanent', 7, 128, 1, 1, '1970-01-19', '1992-12-01', '1992-12-01', '1995-03-01', NULL),
(445, '5921', 'ERNA KUSUMAWATI', 'Permanent', 7, 128, 1, 1, '1981-03-14', '2004-02-01', '2004-02-01', '2006-07-01', NULL),
(446, '90105', 'DWI WIRANTI', 'Contract', 7, 129, 1, 1, '1999-06-17', '2025-05-01', '2025-05-01', NULL, NULL),
(447, '90113', 'MUHAMMAD HILMAN MAULANA', 'Contract', 7, 129, 1, 1, '2002-01-25', '2025-05-01', '2025-05-01', NULL, NULL),
(448, '6307', 'RIONALDI WILLIAM MASSIE', 'Permanent', 7, 130, 1, 1, '1985-01-08', '2005-08-01', '2005-08-01', '2008-03-01', NULL),
(449, '4705', 'SUKRIADI KAI', 'Permanent', 7, 130, 1, 1, '1967-01-26', '2000-01-01', '2000-01-01', '2002-04-01', NULL),
(450, '8820', 'JEANE LIENNA FITHRIA MAMANGKEY', 'Permanent', 7, 130, 1, 1, '1983-01-15', '2008-01-01', '2008-01-01', '2010-10-01', NULL),
(451, '73770', 'YEDIJA RANI KLARION MANOPPO', 'Permanent', 7, 130, 1, 1, '1983-12-06', '2021-04-01', '2021-04-04', '2023-11-01', NULL),
(452, '37303', 'BRAMWELL A KASAEDJA', 'Permanent', 7, 130, 1, 1, '1991-04-05', '2016-04-01', '2016-04-01', '2018-10-01', NULL),
(453, '85859', 'PRAYUDA MANOSO', 'Contract', 7, 130, 1, 1, '1999-07-14', '2024-02-01', '2024-02-01', NULL, NULL),
(454, '89908', 'ARENS KRISTIAMOS PAPARANG', 'Contract', 7, 131, 1, 1, '2000-01-18', '2025-04-01', '2025-04-01', NULL, NULL),
(455, '18448', 'SINTYA CHRISTY', 'Permanent', 7, 131, 1, 1, '1993-12-29', '2012-12-01', '2012-12-01', '2014-10-01', NULL),
(456, '33850', 'CHREVITA JOULINA EVANCE', 'Permanent', 7, 131, 1, 1, '1992-11-01', '2016-01-01', '2016-01-01', '2017-10-01', NULL),
(457, '34362', 'SUPIYAH PUTERI RAMDHANI', 'Permanent', 7, 132, 1, 1, '1994-03-06', '2016-02-01', '2016-02-01', '2018-02-01', NULL),
(458, '90418', 'MOHAMAD MUJADID MAHMUD', 'Contract', 7, 132, 1, 1, '1998-11-13', '2025-06-01', '2025-06-01', NULL, NULL),
(459, '2936', 'SITI NURANI', 'Permanent', 7, 133, 1, 1, '1970-08-27', '1994-06-01', '1994-06-01', '1996-09-01', NULL),
(460, '2403', 'DYAH LANTIK ROSTINANTI', 'Permanent', 7, 133, 1, 1, '1971-03-14', '1992-12-01', '1992-12-01', '1995-03-01', NULL),
(461, '6096', 'SARI WIJAYANTI', 'Permanent', 7, 133, 1, 1, '1978-05-23', '2003-12-19', '2003-12-19', '2007-04-01', NULL),
(462, '12615', 'ALEK WIDI PRASETYA', 'Permanent', 7, 133, 1, 1, '1987-03-19', '2010-04-01', '2010-04-01', '2012-08-01', NULL),
(463, '100616', 'AUDREY GIVTA ENAQY', 'Contract', 7, 134, 1, 1, '2000-11-06', '2025-11-01', '2025-11-03', NULL, NULL),
(464, '6384', 'KHAIRUDDIN', 'Permanent', 7, 134, 1, 1, '1981-03-21', '2005-07-04', '2005-07-04', '2008-06-01', NULL),
(465, '84995', 'MUHAMMAD RHEZA NOOR FAHMI', 'Contract', 7, 134, 1, 1, '1994-12-05', '2023-12-01', '2023-11-17', NULL, NULL),
(466, '1725', 'NATALIA CHRISMIATI', 'Permanent', 7, 134, 1, 1, '1968-01-25', '1989-03-06', '1989-03-06', '1992-03-01', NULL),
(467, '31152', 'FAULINA KURNIATI', 'Permanent', 7, 135, 1, 1, '1992-07-11', '2015-06-01', '2015-06-01', '2017-06-01', NULL),
(468, '2815', 'EKO NUGROHO', 'Permanent', 7, 135, 1, 1, '1968-03-02', '1994-06-01', '1994-06-01', '1996-05-01', NULL),
(469, '73573', 'FAHRIZAL ADI KURNIA', 'Permanent', 7, 135, 1, 1, '1984-06-16', '2021-04-01', '2021-04-01', '2023-04-01', NULL),
(470, '7650', 'SHELVI TYA NURANI', 'Permanent', 7, 135, 1, 1, '1983-09-27', '2006-05-01', '2006-05-01', '2009-11-01', NULL),
(471, '90601', 'GEMILANG WAHYU BIMANTARA', 'Contract', 7, 136, 1, 1, '2001-06-24', '2025-07-01', '2025-06-16', NULL, NULL),
(472, '40487', 'LUKI CECYLIA ANDINI', 'Permanent', 7, 136, 1, 1, '1995-03-07', '2016-11-28', '2016-11-28', '2018-11-01', NULL),
(473, '18499', 'RIDO ARIAWAN', 'Permanent', 7, 136, 1, 1, '1988-08-10', '2012-12-01', '2012-12-01', '2013-12-01', NULL),
(474, '1731', 'PRIYO SISWANTO', 'Permanent', 7, 136, 1, 1, '1966-07-31', '1989-03-13', '1989-03-13', '1992-03-01', NULL),
(475, '7644', 'CHOLIQ HIDAYATULLAH', 'Permanent', 7, 137, 1, 1, '1983-08-29', '2006-05-01', '2006-05-01', '2009-02-01', NULL),
(476, '88847', 'MUHAMMAD ALVIN JUANDA', 'Contract', 7, 137, 1, 1, '1999-12-31', '2024-12-01', '2024-11-18', NULL, NULL),
(477, '90459', 'VITA AULIA SARI', 'Contract', 7, 137, 1, 1, '2000-04-12', '2025-06-01', '2025-06-02', NULL, NULL),
(478, '2372', 'SUDIRO', 'Permanent', 7, 137, 1, 1, '1973-10-11', '1992-10-01', '1992-10-01', '1995-02-01', NULL),
(479, '31086', 'M SYAHYUDI AZIZ', 'Permanent', 7, 137, 1, 1, '1988-03-29', '2015-06-01', '2015-06-01', '2017-03-01', NULL),
(480, '34653', 'SETIA NINGRUM INDAH PERTIWI', 'Permanent', 7, 137, 1, 1, '1993-02-10', '2016-03-01', '2016-03-01', '2018-03-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees_tmp`
--

CREATE TABLE `employees_tmp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contract_type` enum('Permanent','Contract') NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `store_name_temp` varchar(255) NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `birthday` date DEFAULT NULL,
  `initial_employment_date` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `permanent_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees_tmp`
--

INSERT INTO `employees_tmp` (`id`, `employee_id`, `name`, `contract_type`, `region_id`, `store_name_temp`, `section_id`, `job_id`, `birthday`, `initial_employment_date`, `joining_date`, `permanent_date`, `created_at`, `updated_at`) VALUES
(1, '77491', 'ANGESTI LINTANG-PRISTIRA', 'Permanent', 1, 'Gramedia Bogor Botani Dept', 1, 1, '1998-03-21', '2022-04-01', '2022-03-21', '2024-10-01', NULL, NULL),
(2, '85830', 'GUSTAV STEVANUS RAGA ADOE', 'Contract', 1, 'Gramedia Bogor Botani Dept', 1, 1, '1998-08-13', '2024-02-01', '2024-01-15', '0000-00-00', NULL, NULL),
(3, '73544', 'MUHAMAD JARKASIH', 'Permanent', 1, 'Gramedia Bogor Botani Dept', 1, 1, '1993-07-23', '2021-04-01', '2021-03-17', '2023-04-01', NULL, NULL),
(4, '84576', 'BAYU MURDANTYO', 'Contract', 1, 'Gramedia Bogor Botani Dept', 1, 1, '2000-12-29', '2023-11-01', '2023-10-20', '0000-00-00', NULL, NULL),
(5, '3765', 'SUMARDI', 'Permanent', 1, 'Gramedia Bogor Botani Dept', 1, 1, '1972-12-27', '2000-01-01', '2000-01-01', '2000-01-01', NULL, NULL),
(6, '90009', 'JAYA RIKSA', 'Contract', 1, 'Gramedia Bogor Pajajaran Dept', 1, 1, '2001-05-08', '2025-04-01', '2025-04-05', '0000-00-00', NULL, NULL),
(7, '86852', 'RAMA AULIA BAGASKORO', 'Contract', 1, 'Gramedia Bogor Pajajaran Dept', 1, 1, '1998-01-17', '2024-05-01', '2024-04-29', '0000-00-00', NULL, NULL),
(8, '7623', 'HENDRO PRANOTO', 'Permanent', 1, 'Gramedia Bogor Pajajaran Dept', 1, 1, '1982-09-04', '2005-10-01', '2005-10-01', '2009-02-01', NULL, NULL),
(9, '4115', 'OMI HERNITA', 'Permanent', 1, 'Gramedia Cibinong City Mall Dept', 1, 1, '1977-10-07', '1997-07-03', '1997-07-03', '2001-01-01', NULL, NULL),
(10, '2783', 'ANNA MEGAWATI TAMPUBOLON', 'Permanent', 1, 'Gramedia Cibinong City Mall Dept', 1, 1, '1972-07-02', '1993-11-01', '1993-11-01', '1996-04-01', NULL, NULL),
(11, '85891', 'RIFALDI APININO', 'Contract', 1, 'Gramedia Cibinong City Mall Dept', 1, 1, '1998-12-22', '2024-02-01', '2024-01-22', '0000-00-00', NULL, NULL),
(12, '8870', 'JOANNES CHRYSOSTOMUS WAHYU KRISMANTO', 'Permanent', 1, 'Gramedia Cibinong City Mall Dept', 1, 1, '1981-05-02', '2008-02-01', '2008-02-01', '2010-04-01', NULL, NULL),
(13, '88445', 'SAMUEL KRISNA SURYA HANGGARA', 'Contract', 1, 'Gramedia Cijantung Dept', 1, 1, '2000-10-03', '2024-11-01', '2024-11-04', '0000-00-00', NULL, NULL),
(14, '29023', 'YOLANDA GRESSITA', 'Permanent', 1, 'Gramedia Cijantung Dept', 1, 1, '1992-08-09', '2015-04-01', '2015-04-01', '2016-07-01', NULL, NULL),
(15, '3359', 'ANUGRAH NURDIANTO', 'Permanent', 1, 'Gramedia Cijantung Dept', 1, 1, '1972-10-20', '1995-03-15', '1995-03-15', '1997-08-01', NULL, NULL),
(16, '37236', 'YUSWENDAR ARLI', 'Permanent', 1, 'Gramedia Cileungsi Dept', 1, 1, '1993-07-08', '2016-04-01', '2016-04-01', '2019-04-01', NULL, NULL),
(17, '90844', 'ZEFANYA LINTANG LITANI', 'Contract', 1, 'Gramedia Cileungsi Dept', 1, 1, '2001-01-28', '2025-08-01', '2025-07-15', '0000-00-00', NULL, NULL),
(18, '3915', 'DADANG SUKANDAR', 'Permanent', 1, 'Gramedia Cileungsi Dept', 1, 1, '1974-02-28', '1996-05-01', '1996-05-01', '2000-06-01', NULL, NULL),
(19, '5919', 'PAULUS KRISTIADI', 'Permanent', 1, 'Gramedia Cileungsi Dept', 1, 1, '1978-09-07', '2004-12-01', '2004-12-01', '2006-07-01', NULL, NULL),
(20, '89652', 'NATASYA', 'Contract', 1, 'Gramedia Citra Grand Cibubur Dept', 1, 1, '2002-01-30', '2025-03-01', '2025-02-24', '0000-00-00', NULL, NULL),
(21, '91068', 'ROBERTO GALLANT NARENDRA', 'Contract', 1, 'Gramedia Citra Grand Cibubur Dept', 1, 1, '2000-01-28', '2025-09-01', '2025-08-20', '0000-00-00', NULL, NULL),
(22, '4773', 'TRIMAN', 'Permanent', 1, 'Gramedia Citra Grand Cibubur Dept', 1, 1, '1978-06-19', '1999-06-01', '1999-06-01', '2002-07-01', NULL, NULL),
(23, '87853', 'MUHAMMAD ARVIANDI HAKIM', 'Contract', 1, 'Gramedia Citra Grand Cibubur Dept', 1, 1, '1998-07-30', '2024-09-01', '2024-09-10', '0000-00-00', NULL, NULL),
(24, '2168', 'SLAMET', 'Permanent', 1, 'Gramedia Citra Grand Cibubur Dept', 1, 1, '1972-05-20', '1991-12-05', '1991-12-05', '1994-04-01', NULL, NULL),
(25, '5770', 'NARULI KURNIA ISMAWAN', 'Permanent', 1, 'Gramedia Depok Dept', 1, 1, '1980-12-04', '2003-10-01', '2003-10-01', '2006-01-01', NULL, NULL),
(26, '90248', 'DIMAS ASTRAPRAJA', 'Contract', 1, 'Gramedia Depok Dept', 1, 1, '1992-06-23', '2025-05-01', '2025-05-01', '0000-00-00', NULL, NULL),
(27, '5968', 'LILIS SOLIHAT', 'Permanent', 1, 'Gramedia Depok Dept', 1, 1, '1982-06-01', '2004-03-01', '2004-03-01', '2006-09-01', NULL, NULL),
(28, '2679', 'WIDYA KURNIA', 'Permanent', 1, 'Gramedia Depok Dept', 1, 1, '1969-04-06', '1993-08-16', '1993-08-16', '1996-01-01', NULL, NULL),
(29, '8525', 'YOSI NOVIANTO', 'Permanent', 1, 'Gramedia Depok Dept', 1, 1, '1984-11-03', '2007-10-01', '2007-10-01', '2009-11-01', NULL, NULL),
(30, '83822', 'ARDA NOVRIZAL HAQ', 'Contract', 1, 'Gramedia Depok Dept', 1, 1, '2000-11-30', '2023-09-01', '2023-08-14', '0000-00-00', NULL, NULL),
(31, '28879', 'IDA LESTARI NAINGGOLAN', 'Permanent', 1, 'Gramedia Depok Dept', 1, 1, '1991-02-27', '2015-03-01', '2015-03-01', '2016-07-01', NULL, NULL),
(32, '90521', 'TYOLANA DESTA WULANDARI', 'Contract', 1, 'Gramedia Depok The Park Sawangan Dept', 1, 1, '1999-12-24', '2025-06-01', '2025-06-03', '0000-00-00', NULL, NULL),
(33, '88436', 'YEREMIA IMMANUEL CHRISTIAN', 'Contract', 1, 'Gramedia Depok The Park Sawangan Dept', 1, 1, '1999-07-01', '2024-11-01', '2024-10-08', '0000-00-00', NULL, NULL),
(34, '88247', 'MUHAMMAD REZA REZKIA', 'Contract', 1, 'Gramedia Depok The Park Sawangan Dept', 1, 1, '2001-04-23', '2024-10-01', '2024-09-27', '0000-00-00', NULL, NULL),
(35, '100414', 'JANUARDY YOGA PRATAMA', 'Contract', 1, 'Gramedia Jayapura Dept', 1, 1, '2002-01-15', '2025-10-01', '2025-09-23', '0000-00-00', NULL, NULL),
(36, '100443', 'LAILA RAMADANNI', 'Contract', 1, 'Gramedia Jayapura Dept', 1, 1, '1999-01-12', '2025-10-01', '2025-10-01', '0000-00-00', NULL, NULL),
(37, '37846', 'YOSUA SOMNAIKUBUN', 'Permanent', 1, 'Gramedia Jayapura Dept', 1, 1, '1994-04-10', '2016-06-01', '2016-06-01', '2017-04-01', NULL, NULL),
(38, '52474', 'MEINY WINRI', 'Permanent', 1, 'Gramedia Jayapura Dept', 1, 1, '1994-08-21', '2017-11-01', '2017-11-01', '2019-09-01', NULL, NULL),
(39, '21725', 'DADAN SUJONO', 'Permanent', 1, 'Gramedia Jayapura Dept', 1, 1, '1991-03-08', '2013-08-01', '2013-08-01', '2015-11-01', NULL, NULL),
(40, '25489', 'NONINCE MERANI', 'Permanent', 1, 'Gramedia Jayapura Dept', 1, 1, '1995-10-25', '2014-10-01', '2014-10-01', '2016-10-01', NULL, NULL),
(41, '14870', 'EFIANA NINGSIH', 'Permanent', 1, 'Gramedia Kendari Lippo Dept', 1, 1, '1992-01-06', '2011-06-01', '2011-06-01', '2013-06-01', NULL, NULL),
(42, '89698', 'LA ODE MUHAMMAD ILHAM SETIAWAN', 'Contract', 1, 'Gramedia Kendari Lippo Dept', 1, 1, '2002-08-20', '2025-03-01', '2025-02-26', '0000-00-00', NULL, NULL),
(43, '6417', 'IRVAN FADLY', 'Permanent', 1, 'Gramedia Kendari Lippo Dept', 1, 1, '1982-08-16', '2006-06-15', '2006-06-15', '2008-07-01', NULL, NULL),
(44, '7842', 'WAODE NELI SULISTIAWATI', 'Permanent', 1, 'Gramedia Kendari Lippo Dept', 1, 1, '1982-05-11', '2007-01-01', '2007-01-01', '2009-11-01', NULL, NULL),
(45, '75071', 'TRIMAN', 'Permanent', 1, 'Gramedia Kendari Lippo Dept', 1, 1, '1995-09-12', '2021-08-01', '2021-07-26', '2024-01-01', NULL, NULL),
(46, '5362', 'YONA ANNEKE REMELIA HATTU', 'Permanent', 1, 'Gramedia Kupang Dept', 1, 1, '1977-02-22', '2001-09-01', '2001-09-01', '2004-07-01', NULL, NULL),
(47, '3308', 'JAHUDA UNTUNG DOEMA', 'Permanent', 1, 'Gramedia Kupang Dept', 1, 1, '1970-01-04', '1995-01-19', '1995-01-19', '1997-06-01', NULL, NULL),
(48, '6466', 'IMELDA MARIA DEDE TENA', 'Permanent', 1, 'Gramedia Kupang Dept', 1, 1, '1983-12-19', '2006-08-01', '2006-08-01', '2008-08-01', NULL, NULL),
(49, '82252', 'GABRIELA JULIANTI', 'Contract', 1, 'Gramedia Living World Cibubur Dept', 1, 1, '2000-06-12', '2023-03-01', '2023-03-01', '0000-00-00', NULL, NULL),
(50, '1916', 'DAMIANUS SAKIJAN', 'Permanent', 1, 'Gramedia Living World Cibubur Dept', 1, 1, '1968-11-03', '1990-11-01', '1990-11-01', '1993-02-01', NULL, NULL),
(51, '100531', 'SOFYAN HIDAYATULLOH', 'Contract', 1, 'Gramedia Mataram Dept', 1, 1, '2000-07-18', '2025-11-01', '2025-10-13', '0000-00-00', NULL, NULL),
(52, '2569', 'PANDE PUTU DAMENDRA', 'Permanent', 1, 'Gramedia Mataram Dept', 1, 1, '1972-04-11', '1993-05-01', '1993-05-01', '1995-09-01', NULL, NULL),
(53, '84908', 'NI KETUT WINTARI', 'Contract', 1, 'Gramedia Mataram Dept', 1, 1, '2001-04-29', '2023-11-01', '2023-11-08', '0000-00-00', NULL, NULL),
(54, '88836', 'RIVA PRASETYO', 'Contract', 1, 'Gramedia Mataram Dept', 1, 1, '2001-09-26', '2024-12-01', '2024-11-18', '0000-00-00', NULL, NULL),
(55, '11849', 'YASINTA LIA ICE', 'Permanent', 1, 'Gramedia Maumere Dept', 1, 1, '1985-06-19', '2009-12-01', '2009-12-01', '2012-02-01', NULL, NULL),
(56, '84699', 'RIKARDUS WEO', 'Contract', 1, 'Gramedia Maumere Dept', 1, 1, '2000-04-04', '2023-11-01', '2023-11-05', '0000-00-00', NULL, NULL),
(57, '3772', 'BONAVENTURA JELUNDU', 'Permanent', 1, 'Gramedia Maumere Dept', 1, 1, '1970-07-23', '2000-01-01', '2000-01-01', '2000-01-01', NULL, NULL),
(58, '88638', 'MICHAEL GIVEN GERARD TANGKILISAN', 'Contract', 1, 'Gramedia Palu Dept', 1, 1, '2002-04-16', '2024-11-01', '2024-01-25', '0000-00-00', NULL, NULL),
(59, '88885', 'SYAMSIR', 'Contract', 1, 'Gramedia Palu Dept', 1, 1, '2001-06-06', '2024-12-01', '2024-11-25', '0000-00-00', NULL, NULL),
(60, '70821', 'MUHAMMAD HADI RAFIDIN', 'Permanent', 1, 'Gramedia Palu Dept', 1, 1, '1995-10-12', '2020-03-01', '2020-03-10', '2022-04-01', NULL, NULL),
(61, '84841', 'RAMSY MADYAN MUNDE', 'Contract', 1, 'Gramedia Palu Dept', 1, 1, '1999-12-22', '2023-11-01', '2023-11-04', '0000-00-00', NULL, NULL),
(62, '4758', 'ERI DARMAWAN', 'Permanent', 1, 'Gramedia Pejaten Dept', 1, 1, '1978-08-27', '1999-11-01', '1999-11-01', '2002-06-01', NULL, NULL),
(63, '25360', 'RATIH SOFIA KATUNANDYAR', 'Permanent', 1, 'Gramedia Pejaten Dept', 1, 1, '1986-02-16', '2014-09-01', '2014-09-01', '2015-09-01', NULL, NULL),
(64, '86561', 'RAHMAT PUJI RAHARJO', 'Contract', 1, 'Gramedia Pejaten Dept', 1, 1, '1998-04-21', '2024-04-01', '2024-03-21', '0000-00-00', NULL, NULL),
(65, '90603', 'FRANSISKUS MARIO ANINDITO', 'Contract', 1, 'Gramedia Pondok Gede Dept', 1, 1, '2000-10-04', '2025-07-01', '2025-06-16', '0000-00-00', NULL, NULL),
(66, '4926', 'LULUK DEKIYANTO', 'Permanent', 1, 'Gramedia Pondok Gede Dept', 1, 1, '1980-04-15', '1999-10-01', '1999-10-01', '2002-11-01', NULL, NULL),
(67, '2607', 'WASILAH', 'Permanent', 1, 'Gramedia Pondok Gede Dept', 1, 1, '1970-12-13', '1993-07-01', '1993-07-01', '1995-10-01', NULL, NULL),
(68, '87040', 'MOHAMMAD IRHAM BAGUS WIRAWAN', 'Contract', 1, 'Gramedia Pondok Gede Dept', 1, 1, '1999-02-20', '2024-06-01', '2024-05-21', '0000-00-00', NULL, NULL),
(69, '90074', 'MATTHEW AMOS TAMPUBOLON', 'Contract', 1, 'Gramedia Sorong Dept', 1, 1, '2001-10-28', '2025-05-01', '2025-04-17', '0000-00-00', NULL, NULL),
(70, '100550', 'ANGELA MERICI SINAGA', 'Contract', 1, 'Gramedia Sorong Dept', 1, 1, '2003-01-27', '2025-11-01', '2025-10-15', '0000-00-00', NULL, NULL),
(71, '90593', 'RAYHAN AZKIA', 'Contract', 1, 'Gramedia Sukabumi Dept', 1, 1, '2001-12-20', '2025-07-01', '2025-06-16', '0000-00-00', NULL, NULL),
(72, '100560', 'DEDIN JUNAEDIN', 'Contract', 1, 'Gramedia Sukabumi Dept', 1, 1, '2003-04-12', '2025-11-01', '2025-10-21', '0000-00-00', NULL, NULL),
(73, '90694', 'THEODORA ADINDA DELANAIRA', 'Contract', 2, 'Gramedia Central Park Dept', 1, 1, '2000-01-09', '2025-07-01', '2025-07-01', '0000-00-00', NULL, NULL),
(74, '8692', 'NALURI IMAYANTI', 'Permanent', 2, 'Gramedia Central Park Dept', 1, 1, '1985-08-21', '2007-12-01', '2007-12-01', '2009-11-01', NULL, NULL),
(75, '7739', 'APRITA WATI', 'Permanent', 2, 'Gramedia Central Park Dept', 1, 1, '1988-04-05', '2006-10-01', '2006-10-01', '2009-11-01', NULL, NULL),
(76, '8248', 'AGUS TRIYANTO', 'Permanent', 2, 'Gramedia Central Park Dept', 1, 1, '1986-08-01', '2007-07-01', '2007-07-01', '2010-04-01', NULL, NULL),
(77, '86884', 'VIRGIAWAN RAMADHAN INPUT LISTANTO', 'Contract', 2, 'Gramedia Gajah Mada Dept', 1, 1, '1997-12-31', '2024-05-01', '2024-05-02', '0000-00-00', NULL, NULL),
(78, '2370', 'NOVALINDA', 'Permanent', 2, 'Gramedia Gajah Mada Dept', 1, 1, '1968-11-26', '1993-02-01', '1993-02-01', '1995-02-01', NULL, NULL),
(79, '6260', 'SUHERI', 'Permanent', 2, 'Gramedia Gajah Mada Dept', 1, 1, '1982-08-24', '2005-07-01', '2005-07-01', '2008-02-01', NULL, NULL),
(80, '54035', 'BEATRICE JASANDDES A', 'Permanent', 2, 'Gramedia Grand Indonesia Dept', 1, 1, '1990-08-27', '2018-02-01', '2018-01-15', '2020-02-01', NULL, NULL),
(81, '86192', 'YOPI ISKANDAR NURULLOH', 'Contract', 2, 'Gramedia Grand Indonesia Dept', 1, 1, '1998-06-04', '2024-03-01', '2024-03-01', '0000-00-00', NULL, NULL),
(82, '85611', 'LISDIANA FADILA', 'Contract', 2, 'Gramedia Grand Indonesia Dept', 1, 1, '1999-10-08', '2024-01-01', '2023-12-27', '0000-00-00', NULL, NULL),
(83, '54186', 'ARYUDI ADHA', 'Permanent', 2, 'Gramedia Grand Indonesia Dept', 1, 1, '1994-05-20', '2018-02-01', '2018-01-25', '2020-02-01', NULL, NULL),
(84, '23274', 'BAKRI', 'Permanent', 2, 'Gramedia Makassar Nipah Park Dept', 1, 1, '1987-09-09', '2014-02-01', '2014-02-01', '2016-02-01', NULL, NULL),
(85, '89472', 'NURUL AZISAH KAMIL', 'Contract', 2, 'Gramedia Makassar Nipah Park Dept', 1, 1, '2000-05-27', '2025-02-01', '2025-02-01', '0000-00-00', NULL, NULL),
(86, '89362', 'AMIN SYAM', 'Contract', 2, 'Gramedia Makassar Panakkukang Dept', 1, 1, '2001-01-07', '2025-02-01', '2025-01-20', '0000-00-00', NULL, NULL),
(87, '25514', 'MARDA', 'Permanent', 2, 'Gramedia Makassar Panakkukang Dept', 1, 1, '1991-03-01', '2014-10-01', '2014-10-01', '2016-10-01', NULL, NULL),
(88, '3273', 'IRYANTI', 'Permanent', 2, 'Gramedia Makassar Panakkukang Dept', 1, 1, '1973-01-13', '1995-02-01', '1995-02-01', '1997-05-01', NULL, NULL),
(89, '85573', 'YUDA YASRAH ARAFAT', 'Contract', 2, 'Gramedia Makassar Panakkukang Dept', 1, 1, '1999-06-11', '2024-01-01', '2022-11-21', '0000-00-00', NULL, NULL),
(90, '16248', 'A MUHAMMAD NURHARNIN', 'Permanent', 2, 'Gramedia Makassar Pettarani Dept', 1, 1, '1988-02-08', '2012-03-01', '2012-03-01', '2014-09-01', NULL, NULL),
(91, '90772', 'NURMISUARI SALIHU', 'Contract', 2, 'Gramedia Makassar Pettarani Dept', 1, 1, '2001-09-27', '2025-07-01', '2025-07-07', '0000-00-00', NULL, NULL),
(92, '5757', 'NATALIUS', 'Permanent', 2, 'Gramedia Makassar Pettarani Dept', 1, 1, '1978-12-27', '2003-02-01', '2003-02-01', '2005-12-01', NULL, NULL),
(93, '3368', 'NASARUDDIN NURDIN', 'Permanent', 2, 'Gramedia Makassar Pettarani Dept', 1, 1, '1970-06-04', '1995-03-01', '1995-03-01', '1997-08-01', NULL, NULL),
(94, '12587', 'TRISMEIGAWATI TASMAN', 'Permanent', 2, 'Gramedia Makassar Ratu Indah Dept', 1, 1, '1987-05-03', '2010-04-01', '2010-04-01', '2012-10-01', NULL, NULL),
(95, '5400', 'ALOSIUS MISSA', 'Permanent', 2, 'Gramedia Makassar Ratu Indah Dept', 1, 1, '1977-04-29', '2001-10-01', '2001-10-01', '2004-08-01', NULL, NULL),
(96, '86814', 'ALBER MEIWAN PUTRA GEA', 'Contract', 2, 'Gramedia Makassar Ratu Indah Dept', 1, 1, '1999-05-07', '2024-05-01', '2024-04-24', '0000-00-00', NULL, NULL),
(97, '34686', 'VIVID', 'Permanent', 2, 'Gramedia Makassar Ratu Indah Dept', 1, 1, '1991-07-03', '2016-03-01', '2016-03-01', '2017-01-01', NULL, NULL),
(98, '85872', 'MIRANDA YASMINE', 'Contract', 2, 'Gramedia Mal Artha Gading Dept', 1, 1, '1999-05-14', '2024-02-01', '2024-01-16', '0000-00-00', NULL, NULL),
(99, '90769', 'RAIZHA RAYHANANTA PRAYOGA', 'Contract', 2, 'Gramedia Mal Artha Gading Dept', 1, 1, '2002-06-27', '2025-07-01', '2025-07-04', '0000-00-00', NULL, NULL),
(100, '1764', 'SITI KURNIAWATI', 'Permanent', 2, 'Gramedia Mal Artha Gading Dept', 1, 1, '1969-03-23', '1990-02-15', '1990-02-15', '1992-06-01', NULL, NULL),
(101, '5180', 'ARI NURVIANTO', 'Permanent', 2, 'Gramedia Mal Artha Gading Dept', 1, 1, '1977-01-28', '2001-03-01', '2001-03-01', '2003-10-01', NULL, NULL),
(102, '89145', 'ADI KUSMORO', 'Contract', 2, 'Gramedia Mal Ciputra Dept', 1, 1, '1999-10-25', '2025-01-01', '2024-12-23', '0000-00-00', NULL, NULL),
(103, '86528', 'ANDRIYONO IRAWAN', 'Contract', 2, 'Gramedia Mal Ciputra Dept', 1, 1, '1997-07-06', '2024-05-01', '2024-04-16', '0000-00-00', NULL, NULL),
(104, '8207', 'DIMAS PRASETYO', 'Permanent', 2, 'Gramedia Mal Ciputra Dept', 1, 1, '1984-02-08', '2007-06-15', '2007-06-15', '2009-02-01', NULL, NULL),
(105, '100490', 'RAIHAN SETYOAJI ALAMSYAH', 'Contract', 2, 'Gramedia Mal Kelapa Gading Dept', 1, 1, '2001-07-12', '2025-10-01', '2025-10-06', '0000-00-00', NULL, NULL),
(106, '88674', 'THERESIA ADINDA KUSUMA ASTUTI', 'Contract', 2, 'Gramedia Mal Kelapa Gading Dept', 1, 1, '2000-07-06', '2024-11-01', '2024-11-04', '0000-00-00', NULL, NULL),
(107, '2094', 'YULIUS BACHTIAR', 'Permanent', 2, 'Gramedia Mal Kelapa Gading Dept', 1, 1, '1970-10-21', '1991-07-15', '1991-07-15', '1993-12-01', NULL, NULL),
(108, '3957', 'AGUSTINUS NGATINO', 'Permanent', 2, 'Gramedia Mal Kelapa Gading Dept', 1, 1, '1972-08-10', '1997-02-01', '1997-02-01', '2000-07-01', NULL, NULL),
(109, '100416', 'RAUF ANWAR', 'Contract', 2, 'Gramedia Maluku City Mall Dept', 1, 1, '2000-09-19', '2025-10-01', '2025-09-29', '0000-00-00', NULL, NULL),
(110, '54568', 'RIKSAN WALI', 'Permanent', 2, 'Gramedia Maluku City Mall Dept', 1, 1, '1991-07-14', '2018-03-01', '2018-02-12', '2020-03-01', NULL, NULL),
(111, '15139', 'JACOB FRITS TAHAPARY', 'Permanent', 2, 'Gramedia Maluku City Mall Dept', 1, 1, '1984-07-28', '2011-08-01', '2011-08-01', '2013-08-01', NULL, NULL),
(112, '13764', 'ABDUL SAMAD', 'Permanent', 2, 'Gramedia Matraman Dept', 1, 1, '1987-07-15', '2010-11-01', '2010-11-01', '2013-03-01', NULL, NULL),
(113, '84307', 'ARIP PRIYADI', 'Contract', 2, 'Gramedia Matraman Dept', 1, 1, '1996-07-23', '2023-10-01', '2022-12-30', '0000-00-00', NULL, NULL),
(114, '7819', 'SUPRIYADI', 'Permanent', 2, 'Gramedia Matraman Dept', 1, 1, '1984-06-10', '2006-12-01', '2006-12-01', '2009-11-01', NULL, NULL),
(115, '89530', 'DONI RIVALDO', 'Contract', 2, 'Gramedia Matraman Dept', 1, 1, '2002-07-14', '2025-02-01', '2025-02-03', '0000-00-00', NULL, NULL),
(116, '88917', 'ASTRID MILENIA PUSPARINI', 'Contract', 2, 'Gramedia Matraman Dept', 1, 1, '2000-01-13', '2024-12-01', '2024-11-25', '0000-00-00', NULL, NULL),
(117, '82259', 'ODILIA LINTANG KINAYUNGAN DJAWOTO', 'Permanent', 2, 'Gramedia Matraman Dept', 1, 1, '2000-05-21', '2023-03-01', '2023-03-01', '2025-08-01', NULL, NULL),
(118, '23152', 'RIFQI JAMALI', 'Permanent', 2, 'Gramedia Matraman Dept', 1, 1, '1988-01-12', '2014-01-01', '2014-01-01', '2015-10-01', NULL, NULL),
(119, '86537', 'SARBJIT', 'Contract', 2, 'Gramedia Matraman Dept', 1, 1, '1999-01-30', '2024-04-01', '2024-03-18', '0000-00-00', NULL, NULL),
(120, '90596', 'DIKI CHANDRA', 'Contract', 2, 'Gramedia Pintu Air Dept', 1, 1, '2000-09-21', '2025-07-01', '2025-06-16', '0000-00-00', NULL, NULL),
(121, '37199', 'INTAN ADHEVA PUTRI', 'Permanent', 2, 'Gramedia Pintu Air Dept', 1, 1, '1991-06-16', '2016-04-01', '2016-04-01', '2018-04-01', NULL, NULL),
(122, '2505', 'YACOBUS MARJAKA', 'Permanent', 2, 'Gramedia Pintu Air Dept', 1, 1, '1970-06-25', '1993-02-01', '1993-02-01', '1995-06-01', NULL, NULL),
(123, '89364', 'BENEDIKTUS ADI KURNIAWAN', 'Contract', 2, 'Gramedia Pluit Emporium Dept', 1, 1, '2001-01-24', '2025-02-01', '2025-02-03', '0000-00-00', NULL, NULL),
(124, '100629', 'ALBERTO SINAGA', 'Contract', 2, 'Gramedia Pluit Emporium Dept', 1, 1, '2000-07-11', '2025-11-01', '2025-11-03', '0000-00-00', NULL, NULL),
(125, '90751', 'DEVANO ARYA FAHREIZY', 'Contract', 2, 'Gramedia Pluit Emporium Dept', 1, 1, '2002-09-03', '2025-07-01', '2025-07-01', '0000-00-00', NULL, NULL),
(126, '90482', 'ANDHIKA BUDY PERMANA', 'Contract', 2, 'Gramedia Ternate Dept', 1, 1, '1999-01-03', '2025-06-01', '2025-06-02', '0000-00-00', NULL, NULL),
(127, '14492', 'HALIMAH HASAN ST', 'Permanent', 2, 'Gramedia Ternate Dept', 1, 1, '1984-07-30', '2011-03-01', '2011-03-01', '2013-03-01', NULL, NULL),
(128, '88730', 'R ALIF ELMAND BOMANTARA', '', 2, 'Gramedia Ternate Dept', 1, 1, '2003-03-01', '2024-11-01', '2024-11-02', '0000-00-00', NULL, NULL),
(129, '87376', 'DEDE FARID ZAKARIA', 'Contract', 3, 'Gramedia Banjarbaru QMall Dept', 1, 1, '1998-04-13', '2024-07-01', '2024-06-21', '0000-00-00', NULL, NULL),
(130, '79743', 'ADELINA MELATI SUKMA', 'Permanent', 3, 'Gramedia Banjarbaru QMall Dept', 1, 1, '1998-03-16', '2022-09-01', '2022-09-01', '2025-03-01', NULL, NULL),
(131, '4927', 'NURUL AIEN', 'Permanent', 3, 'Gramedia Banjarmasin Duta Mall Dept', 1, 1, '1980-11-23', '2000-06-01', '2000-06-01', '2002-11-01', NULL, NULL),
(132, '74200', 'TAUFIKURRAHMAN', 'Permanent', 3, 'Gramedia Banjarmasin Duta Mall Dept', 1, 1, '1980-08-01', '2021-05-01', '2021-04-19', '2025-05-01', NULL, NULL),
(133, '2556', 'PURA SABARA', 'Permanent', 3, 'Gramedia Banjarmasin Duta Mall Dept', 1, 1, '1969-11-24', '1993-05-17', '1993-05-17', '1995-08-01', NULL, NULL),
(134, '7662', 'ELLYA FAKHRIANI', 'Permanent', 3, 'Gramedia Banjarmasin Duta Mall Dept', 1, 1, '1981-12-20', '2006-06-01', '2006-06-01', '2009-02-01', NULL, NULL),
(135, '89916', 'ADELIA SEPTIANINGRUM MARPAUNG', 'Contract', 3, 'Gramedia Banjarmasin Veteran Dept', 1, 1, '2001-09-27', '2025-04-01', '2025-03-22', '0000-00-00', NULL, NULL),
(136, '7663', 'INDRA LESMANA', 'Permanent', 3, 'Gramedia Banjarmasin Veteran Dept', 1, 1, '1982-08-07', '2006-06-01', '2006-06-01', '2009-02-01', NULL, NULL),
(137, '2555', 'I WAYAN BAGIADA', 'Permanent', 3, 'Gramedia Banjarmasin Veteran Dept', 1, 1, '1972-01-21', '1993-04-15', '1993-04-15', '1995-08-01', NULL, NULL),
(138, '91080', 'GREGORIUS BAGAS VITA PAMUNGKAS', 'Contract', 3, 'Gramedia Cilacap Dept', 1, 1, '2001-09-18', '2025-09-01', '2025-09-01', '0000-00-00', NULL, NULL),
(139, '80667', 'MEKY DWI CHRISTYANTO', 'Permanent', 3, 'Gramedia Cilacap Dept', 1, 1, '1995-05-01', '2022-11-01', '2020-12-01', '2025-05-01', NULL, NULL),
(140, '89703', 'TRI HASTOMO', 'Contract', 3, 'Gramedia Cirebon Cipto Dept', 1, 1, '2001-05-25', '2025-03-01', '2025-03-01', '0000-00-00', NULL, NULL),
(141, '37807', 'ANNISA ASRI SEPTIANTY', 'Permanent', 3, 'Gramedia Cirebon Cipto Dept', 1, 1, '1996-09-22', '2016-05-01', '2016-05-01', '2019-05-01', NULL, NULL),
(142, '4192', 'THOMAS DEDI SUPRIADI', 'Permanent', 3, 'Gramedia Cirebon Cipto Dept', 1, 1, '1976-11-27', '1997-10-01', '1997-10-01', '2001-03-01', NULL, NULL),
(143, '2720', 'MARIFAH', 'Permanent', 3, 'Gramedia Cirebon Cipto Dept', 1, 1, '1970-02-02', '1993-10-20', '1993-10-20', '1996-02-01', NULL, NULL),
(144, '33895', 'FAGIL RACHMAN DARMAWAN PUTRA', 'Permanent', 3, 'Gramedia Cirebon Dept', 1, 1, '1993-05-18', '2016-01-01', '2016-01-01', '2017-01-01', NULL, NULL),
(145, '26326', 'DEDI WAHYUDI', 'Permanent', 3, 'Gramedia Cirebon Dept', 1, 1, '1987-08-10', '2014-12-01', '2014-12-01', '2016-07-01', NULL, NULL),
(146, '53886', 'IQBAL ALDITIO', 'Permanent', 3, 'Gramedia Cirebon Dept', 1, 1, '1994-03-17', '2018-01-01', '2018-01-08', '2019-05-01', NULL, NULL),
(147, '17866', 'KURNIAWAN SUKMA PERMANA', 'Permanent', 3, 'Gramedia Madiun Dept', 1, 1, '1988-07-31', '2012-11-01', '2012-11-01', '2013-12-01', NULL, NULL),
(148, '13430', 'TIKA APRILIANA PRASETYOWATI', 'Permanent', 3, 'Gramedia Madiun Dept', 1, 1, '1990-04-21', '2010-09-01', '2010-09-01', '2012-12-01', NULL, NULL),
(149, '20183', 'LIDYA PERMATASARI', 'Permanent', 3, 'Gramedia Madiun Dept', 1, 1, '1995-04-12', '2013-03-01', '2013-03-01', '2015-09-01', NULL, NULL),
(150, '90883', 'MUHAMMAD ADITYA', 'Contract', 3, 'Gramedia Palangka Raya Duta Mall Dept', 1, 1, '2003-07-17', '2025-08-01', '2025-07-21', '0000-00-00', NULL, NULL),
(151, '82895', 'NEDYA ANGGRAINI', 'Contract', 3, 'Gramedia Palangka Raya Duta Mall Dept', 1, 1, '1999-08-23', '2023-05-01', '2023-05-08', '0000-00-00', NULL, NULL),
(152, '100533', 'INTAN SYIFFA FRATIKA', 'Contract', 3, 'Gramedia Purbalingga Dept', 1, 1, '2002-04-15', '2025-11-01', '2025-10-13', '0000-00-00', NULL, NULL),
(153, '100534', 'AZHAR SATRIA GHOZALI', 'Contract', 3, 'Gramedia Purbalingga Dept', 1, 1, '2000-05-11', '2025-11-01', '2025-10-11', '0000-00-00', NULL, NULL),
(154, '90550', 'AJI PAMUNGKAS', 'Contract', 3, 'Gramedia Purwokerto Gelora Indah Dept', 1, 1, '1999-03-29', '2025-06-01', '2025-06-09', '0000-00-00', NULL, NULL),
(155, '100376', 'AMANDA DOROTHEA SANTOSA', 'Contract', 3, 'Gramedia Purwokerto Gelora Indah Dept', 1, 1, '2003-05-05', '2025-10-01', '2025-09-22', '0000-00-00', NULL, NULL),
(156, '100511', 'ANDI SURYO NUGROHO', 'Contract', 3, 'Gramedia Purwokerto Gelora Indah Dept', 1, 1, '2000-07-06', '2025-10-01', '2025-10-07', '0000-00-00', NULL, NULL),
(157, '87677', 'YOHANES DRAJAT BAGUS KUSUMA', 'Contract', 3, 'Gramedia Purwokerto Rita Mall Dept', 1, 1, '1997-01-31', '2024-08-01', '2024-07-29', '0000-00-00', NULL, NULL),
(158, '8094', 'HELMI ZULFADLI', 'Permanent', 3, 'Gramedia Purwokerto Rita Mall Dept', 1, 1, '1984-12-01', '2007-05-01', '2007-05-01', '2010-03-01', NULL, NULL),
(159, '8043', 'KRISNA PRASETYA', 'Permanent', 3, 'Gramedia Purwokerto Rita Mall Dept', 1, 1, '1984-04-04', '2007-04-01', '2007-04-01', '2009-02-01', NULL, NULL),
(160, '85928', 'UMI HANDAYANI', 'Contract', 3, 'Gramedia Semarang Majapahit Dept', 1, 1, '1999-09-02', '2024-02-01', '2024-01-24', '0000-00-00', NULL, NULL),
(161, '1125', 'DYAH PERTIWI PURNAMANINGRUM', 'Permanent', 3, 'Gramedia Semarang Majapahit Dept', 1, 1, '1967-01-20', '1988-06-15', '1988-06-15', '1989-10-01', NULL, NULL),
(162, '84700', 'IMAM SULAIMAN SYAH', 'Contract', 3, 'Gramedia Semarang Majapahit Dept', 1, 1, '1997-05-01', '2023-11-01', '2023-11-01', '0000-00-00', NULL, NULL),
(163, '1252', 'SUNARKO', 'Permanent', 3, 'Gramedia Semarang Pandanaran Dept', 1, 1, '1966-11-22', '1989-06-01', '1989-06-01', '1990-06-01', NULL, NULL),
(164, '27886', 'LEONARD DANARO HARIYANTO', 'Permanent', 3, 'Gramedia Semarang Pandanaran Dept', 1, 1, '1989-11-08', '2015-01-01', '2015-01-01', '2016-01-01', NULL, NULL),
(165, '90079', 'MANUEL BENEDICTH IVAN SURYONINGMAS', 'Contract', 3, 'Gramedia Semarang Pandanaran Dept', 1, 1, '2000-10-16', '2025-05-01', '2025-04-21', '0000-00-00', NULL, NULL),
(166, '5458', 'PETRUS SARJITA', 'Permanent', 3, 'Gramedia Semarang Pandanaran Dept', 1, 1, '1982-11-19', '2002-05-01', '2002-05-01', '2004-11-01', NULL, NULL),
(167, '5364', 'TRIYO SUSANTO', 'Permanent', 3, 'Gramedia Semarang Pandanaran Dept', 1, 1, '1975-10-25', '2001-10-06', '2001-10-06', '2004-07-01', NULL, NULL),
(168, '2045', 'CH PURWANTININGSIH', 'Permanent', 3, 'Gramedia Semarang Pandanaran Dept', 1, 1, '1967-06-22', '1991-05-01', '1991-05-01', '1993-09-01', NULL, NULL),
(169, '89841', 'RIO BUDI HENDRAWAN', 'Contract', 3, 'Gramedia Semarang Setiabudi Dept', 1, 1, '2001-02-06', '2025-04-01', '2025-03-12', '0000-00-00', NULL, NULL),
(170, '4844', 'FRANSISCUS SUGIHARTO SAPT', 'Permanent', 3, 'Gramedia Semarang Setiabudi Dept', 1, 1, '1978-01-25', '1999-11-01', '1999-11-01', '2002-08-01', NULL, NULL),
(171, '2941', 'FERENA CHRISTINE LOLANG', 'Permanent', 3, 'Gramedia Semarang Setiabudi Dept', 1, 1, '1968-01-26', '1994-04-01', '1994-04-01', '1996-10-01', NULL, NULL),
(172, '37818', 'GUNTUR BAYU SAPUTRA', 'Permanent', 3, 'Gramedia Solo Slamet Riyadi Dept', 1, 1, '1993-09-09', '2016-06-01', '2016-06-01', '2018-06-01', NULL, NULL),
(173, '6285', 'NOVIA ANGGRAINY', 'Permanent', 3, 'Gramedia Solo Slamet Riyadi Dept', 1, 1, '1982-06-13', '2005-10-01', '2005-10-01', '2008-02-01', NULL, NULL),
(174, '31555', 'JOKO NUR ARIPPIN', 'Permanent', 3, 'Gramedia Solo Slamet Riyadi Dept', 1, 1, '1991-04-12', '2015-07-01', '2015-07-01', '2017-07-01', NULL, NULL),
(175, '2874', 'HERIBERTUS JUMARI', 'Permanent', 3, 'Gramedia Solo Slamet Riyadi Dept', 1, 1, '1971-06-03', '1994-03-01', '1994-03-01', '1996-07-01', NULL, NULL),
(176, '33322', 'HADI PRAYITNO', 'Permanent', 3, 'Gramedia Solo Slamet Riyadi Dept', 1, 1, '1991-11-13', '2015-12-01', '2015-12-01', '2016-12-01', NULL, NULL),
(177, '2680', 'MUKTI DARMA', 'Permanent', 3, 'Gramedia Solo Square Dept', 1, 1, '1972-10-06', '1993-09-15', '1993-09-15', '1996-01-01', NULL, NULL),
(178, '5950', 'HARIYANI', 'Permanent', 3, 'Gramedia Solo Square Dept', 1, 1, '1985-01-10', '2003-10-01', '2003-10-01', '2006-08-01', NULL, NULL),
(179, '5417', 'BAMBANG SETYO CAHYONO', 'Permanent', 3, 'Gramedia Solo Square Dept', 1, 1, '1977-01-17', '2002-12-01', '2002-12-01', '2004-09-01', NULL, NULL),
(180, '8085', 'MUHLISIN', 'Permanent', 3, 'Gramedia Tegal Rita Mall Dept', 1, 1, '1988-01-25', '2007-05-01', '2007-05-01', '2010-03-01', NULL, NULL),
(181, '6313', 'JOKO NUGROHO', 'Permanent', 3, 'Gramedia Tegal Rita Mall Dept', 1, 1, '1981-12-30', '2006-02-01', '2006-02-01', '2008-03-01', NULL, NULL),
(182, '24542', 'WIWID MULYANI', 'Permanent', 3, 'Gramedia Tegal Rita Mall Dept', 1, 1, '1993-10-11', '2014-06-01', '2014-06-01', '2016-05-01', NULL, NULL),
(183, '89594', 'GEREIDO JOSA NAZARETA', 'Contract', 3, 'Gramedia Yogyakarta City Mall Dept', 1, 1, '1998-08-23', '2025-03-01', '2025-02-12', '0000-00-00', NULL, NULL),
(184, '31408', 'ALDILLA RIZKY PRITAWARDHANI', 'Permanent', 3, 'Gramedia Yogyakarta City Mall Dept', 1, 1, '1992-01-12', '2015-07-01', '2015-07-01', '2017-07-01', NULL, NULL),
(185, '76322', 'TONI EFENDI', 'Permanent', 3, 'Gramedia Yogyakarta City Mall Dept', 1, 1, '1995-05-16', '2021-12-01', '2021-12-06', '2025-01-01', NULL, NULL),
(186, '6421', 'MARTA YOSEVA UNA ASRINI', 'Permanent', 3, 'Gramedia Yogyakarta City Mall Dept', 1, 1, '1979-11-19', '2006-06-01', '2006-06-01', '2008-07-01', NULL, NULL),
(187, '89593', 'RIFQI NUGRAHA', 'Contract', 3, 'Gramedia Yogyakarta Malioboro Mall Dept', 1, 1, '2000-10-06', '2025-03-01', '2025-02-12', '0000-00-00', NULL, NULL),
(188, '53496', 'MONIKA SEPTIANA ARUNI', 'Permanent', 3, 'Gramedia Yogyakarta Malioboro Mall Dept', 1, 1, '1991-09-12', '2017-12-01', '2017-12-06', '2020-01-01', NULL, NULL),
(189, '2998', 'EMMANUEL EKO KURNIAWAN', 'Permanent', 3, 'Gramedia Yogyakarta Malioboro Mall Dept', 1, 1, '1971-08-30', '1994-05-23', '1994-05-23', '1996-11-01', NULL, NULL),
(190, '89954', 'IGNATIUS PROMOVENDI DWIWANJANA PUTRA', 'Contract', 3, 'Gramedia Yogyakarta Pakuwon Dept', 1, 1, '1999-03-11', '2025-04-01', '2025-03-27', '0000-00-00', NULL, NULL),
(191, '6154', 'PIA MARIA LENI MULYATI', 'Permanent', 3, 'Gramedia Yogyakarta Pakuwon Dept', 1, 1, '1980-05-01', '2006-04-15', '2006-04-15', '2007-09-01', NULL, NULL),
(192, '88639', 'VICO TRI CAHYA RAMADHAN', '', 3, 'Gramedia Yogyakarta Pakuwon Dept', 1, 1, '1999-12-28', '2024-11-01', '2024-11-06', '0000-00-00', NULL, NULL),
(193, '89099', 'MUHAMMAD UMAR BAHUSIN', 'Contract', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '2001-09-11', '2025-01-01', '2024-12-16', '0000-00-00', NULL, NULL),
(194, '90833', 'DIAN TRI WIBOWO', 'Contract', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '2000-10-17', '2025-08-01', '2025-07-10', '0000-00-00', NULL, NULL),
(195, '82034', 'ALBERTUS ABI GALIH PRATAMA', 'Contract', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '1992-05-26', '2023-02-01', '2023-02-09', '0000-00-00', NULL, NULL),
(196, '2514', 'WIWIN KURNIASIH', 'Permanent', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '1974-02-15', '1992-09-17', '1992-09-17', '1995-06-01', NULL, NULL),
(197, '6102', 'ITA INDARWATI', 'Permanent', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '1981-10-25', '2006-02-01', '2006-02-01', '2007-06-01', NULL, NULL),
(198, '51448', 'ADHI LAKSMANA VIJAYA', 'Permanent', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '1993-04-10', '2017-09-01', '2017-09-04', '2019-10-01', NULL, NULL),
(199, '23217', 'YUDIT MAHARGYANINGTYAS', 'Permanent', 3, 'Gramedia Yogyakarta Sudirman Dept', 1, 1, '1987-02-08', '2014-01-01', '2014-01-01', '2015-02-01', NULL, NULL),
(200, '7521', 'NYAYAN SOVIA RIYANTO', 'Permanent', 4, 'Gramedia AEON Mall Dept', 1, 1, '1981-10-01', '2007-11-01', '2007-11-01', '2010-03-01', NULL, NULL),
(201, '90077', 'ROBERT SEPTYANUS RAGA ADOE', 'Contract', 4, 'Gramedia AEON Mall Dept', 1, 1, '2001-09-13', '2025-05-01', '2025-04-17', '0000-00-00', NULL, NULL),
(202, '3526', 'DWI ENDANG PAMULARSIH SE', 'Permanent', 4, 'Gramedia AEON Mall Dept', 1, 1, '1972-01-24', '1997-02-01', '1997-02-01', '1998-01-01', NULL, NULL),
(203, '87369', 'DEANE MARGARETHA SAGALA', 'Contract', 4, 'Gramedia AEON Mall Dept', 1, 1, '1997-04-17', '2024-07-01', '2024-06-24', '0000-00-00', NULL, NULL),
(204, '90146', 'MUHAMMAD ANNAS FERDHIYANTO', 'Contract', 4, 'Gramedia Batam City Square Dept', 1, 1, '1999-07-20', '2025-05-01', '2025-04-21', '0000-00-00', NULL, NULL),
(205, '5775', 'SULAMIT SIMANJUNTAK', 'Permanent', 4, 'Gramedia Batam City Square Dept', 1, 1, '1981-10-15', '2003-10-01', '2003-10-01', '2006-01-01', NULL, NULL),
(206, '8687', 'TATY ENDANG SIMANULLANG', 'Permanent', 4, 'Gramedia Batam City Square Dept', 1, 1, '1981-08-13', '2007-12-01', '2007-12-01', '2010-06-01', NULL, NULL),
(207, '82112', 'I GUSTI NGURAH DWI PALGUNAWAN', 'Permanent', 4, 'Gramedia Batam City Square Dept', 1, 1, '1997-02-11', '2023-03-01', '2023-02-16', '2025-09-01', NULL, NULL),
(208, '25028', 'AGATA SRI KRISDIYATI', 'Permanent', 4, 'Gramedia BSD City Dept', 1, 1, '1992-02-18', '2014-07-01', '2014-07-01', '2016-01-01', NULL, NULL),
(209, '37121', 'VALENCIA ALWI', 'Permanent', 4, 'Gramedia BSD City Dept', 1, 1, '1991-04-19', '2016-04-01', '2016-04-01', '2017-04-01', NULL, NULL),
(210, '2761', 'ROCHILI', 'Permanent', 4, 'Gramedia BSD City Dept', 1, 1, '1972-03-18', '1993-11-16', '1993-11-16', '1996-03-01', NULL, NULL),
(211, '100422', 'HANIF FADHILAH', 'Contract', 4, 'Gramedia BSD City Dept', 1, 1, '2002-07-18', '2025-10-01', '2025-09-18', '0000-00-00', NULL, NULL),
(212, '88373', 'RONGGO TANTRI YOGYANTO', 'Contract', 4, 'Gramedia BSD City Dept', 1, 1, '1995-06-17', '2024-10-01', '2024-10-07', '0000-00-00', NULL, NULL),
(213, '3498', 'AMBRIZAL', 'Permanent', 4, 'Gramedia BSD City Dept', 1, 1, '1970-07-31', '1995-08-01', '1995-08-01', '1997-12-01', NULL, NULL),
(214, '86447', 'SETIYOWATI', 'Contract', 4, 'Gramedia BSD City Dept', 1, 1, '2000-04-10', '2024-04-01', '2024-03-12', '0000-00-00', NULL, NULL),
(215, '90266', 'AL DIO NDARU AL FARHAN', 'Contract', 4, 'Gramedia Cikupa Dept', 1, 1, '2001-02-07', '2025-05-01', '2025-05-07', '0000-00-00', NULL, NULL),
(216, '100372', 'FAHRI FADILLAH', 'Contract', 4, 'Gramedia Cikupa Dept', 1, 1, '2001-03-21', '2025-10-01', '2025-09-15', '0000-00-00', NULL, NULL),
(217, '2057', 'KANISIUS JEBATUNG', 'Permanent', 4, 'Gramedia Cikupa Dept', 1, 1, '1967-05-18', '1991-06-15', '1991-06-15', '1993-10-01', NULL, NULL),
(218, '82893', 'HAIRUL UMAMI', 'Contract', 4, 'Gramedia Cilegon Dept', 1, 1, '1998-12-08', '2023-06-01', '2023-06-01', '0000-00-00', NULL, NULL),
(219, '6217', 'ELISABETH RETNO HERIASTUTI', 'Permanent', 4, 'Gramedia Cilegon Dept', 1, 1, '1980-08-06', '2006-01-16', '2006-01-16', '2007-12-01', NULL, NULL),
(220, '90263', 'RAHMAD FAHRI', 'Contract', 4, 'Gramedia Daan Mogot Dept', 1, 1, '2001-01-14', '2025-05-01', '2025-05-05', '0000-00-00', NULL, NULL),
(221, '90551', 'CANDRA RAHMANSYAH', 'Contract', 4, 'Gramedia Daan Mogot Dept', 1, 1, '2001-01-20', '2025-06-01', '2025-06-09', '0000-00-00', NULL, NULL),
(222, '90755', 'JONATHAN ARIO DEWANGGA', 'Contract', 4, 'Gramedia Daan Mogot Dept', 1, 1, '2002-07-04', '2025-07-01', '2025-07-01', '0000-00-00', NULL, NULL),
(223, '90341', 'GAMALIEL RAHMAT P', 'Contract', 4, 'Gramedia Dumai Citimall Dept', 1, 1, '2000-04-17', '2025-06-01', '2025-05-13', '0000-00-00', NULL, NULL),
(224, '88838', 'SAYYIDAH AFINA SALSABILA NST', 'Contract', 4, 'Gramedia Dumai Citimall Dept', 1, 1, '2002-07-30', '2024-12-01', '2024-11-18', '0000-00-00', NULL, NULL),
(225, '89799', 'RISA FITRIANI', 'Contract', 4, 'Gramedia Gading Serpong Dept', 1, 1, '2000-01-03', '2025-03-01', '2025-03-07', '0000-00-00', NULL, NULL),
(226, '32007', 'JULIHANSYAH', 'Permanent', 4, 'Gramedia Gading Serpong Dept', 1, 1, '1992-07-18', '2015-08-01', '2015-08-01', '2016-08-01', NULL, NULL),
(227, '5238', 'FREDERICUS IRAWAN BUDIRAHARJO', 'Permanent', 4, 'Gramedia Gading Serpong Dept', 1, 1, '1974-10-14', '2002-10-02', '2002-10-02', '2004-02-01', NULL, NULL),
(228, '28829', 'GAME SUPRIADI JUKSON L', 'Permanent', 4, 'Gramedia Gading Serpong Dept', 1, 1, '1994-07-19', '2015-04-01', '2015-04-01', '2017-04-01', NULL, NULL),
(229, '6311', 'WIDI SUSANTO', 'Permanent', 4, 'Gramedia Grand Batam Dept', 1, 1, '1986-10-03', '2005-12-01', '2005-12-01', '2008-03-01', NULL, NULL),
(230, '87829', 'ANDRI IRWANTO', 'Contract', 4, 'Gramedia Grand Batam Dept', 1, 1, '1998-12-30', '2024-08-01', '2024-08-08', '0000-00-00', NULL, NULL),
(231, '82257', 'NATALIA MARBUN', 'Permanent', 4, 'Gramedia Grand Batam Dept', 1, 1, '1997-12-25', '2023-03-01', '2023-03-01', '2025-03-01', NULL, NULL),
(232, '8211', 'BERNARDUS TRI SANTOSO', 'Permanent', 4, 'Gramedia Karawaci Dept', 1, 1, '1978-08-12', '2007-06-15', '2007-06-15', '2009-02-01', NULL, NULL),
(233, '85067', 'MOCH IQBAL ALGHIFARI', 'Contract', 4, 'Gramedia Karawaci Dept', 1, 1, '1998-12-03', '2023-12-01', '2023-11-27', '0000-00-00', NULL, NULL),
(234, '86538', 'AFIFAH NURAWALIA', 'Contract', 4, 'Gramedia Karawaci Dept', 1, 1, '2000-09-07', '2024-04-01', '2024-03-19', '0000-00-00', NULL, NULL),
(235, '84251', 'ANDREAS ANTON PRIYAMBODO', 'Contract', 4, 'Gramedia Karawaci Dept', 1, 1, '1998-11-11', '2023-10-01', '2023-09-30', '0000-00-00', NULL, NULL),
(236, '5803', 'MARIANO KLAUDIUS CASA ULU WANGGE', 'Permanent', 4, 'Gramedia Karawaci Dept', 1, 1, '1982-07-07', '2002-08-01', '2002-08-01', '2006-02-01', NULL, NULL),
(237, '3176', 'DEDY REYNOLD', 'Permanent', 4, 'Gramedia Lampung Boemi Kedaton Dept', 1, 1, '1975-09-09', '1994-06-13', '1994-06-13', '1997-02-01', NULL, NULL),
(238, '82482', 'RANI TISIA PUTRI', 'Permanent', 4, 'Gramedia Lampung Boemi Kedaton Dept', 1, 1, '1997-01-18', '2023-05-01', '2023-04-15', '2025-05-01', NULL, NULL),
(239, '3179', 'P RUDI HENDARTO', 'Permanent', 4, 'Gramedia Lampung Boemi Kedaton Dept', 1, 1, '1970-06-22', '1994-06-13', '1994-06-13', '1997-02-01', NULL, NULL),
(240, '88820', 'MEGA AYU LESTARI', 'Contract', 4, 'Gramedia Lampung Dept', 1, 1, '1999-05-13', '2024-12-01', '2024-11-18', '0000-00-00', NULL, NULL),
(241, '88629', 'HILALUDIN AKBAR', 'Contract', 4, 'Gramedia Lampung Dept', 1, 1, '2001-07-13', '2024-11-01', '2024-10-28', '0000-00-00', NULL, NULL),
(242, '22317', 'JOSWA SAHAT M SILALAHI', 'Permanent', 4, 'Gramedia Lampung Dept', 1, 1, '1987-09-12', '2013-10-01', '2013-10-01', '2015-10-01', NULL, NULL),
(243, '3207', 'NYOMAN KERTI', 'Permanent', 4, 'Gramedia Lampung Dept', 1, 1, '1973-11-10', '1994-06-13', '1994-06-13', '1997-03-01', NULL, NULL),
(244, '68616', 'MARTIN SIREGAR', 'Permanent', 4, 'Gramedia Padang Dept', 1, 1, '1990-04-22', '2019-11-01', '2019-11-01', '2023-11-01', NULL, NULL),
(245, '5398', 'AFRINALDI', 'Permanent', 4, 'Gramedia Padang Dept', 1, 1, '1978-04-27', '2001-08-01', '2001-08-01', '2004-08-01', NULL, NULL),
(246, '2850', 'SISILIA LIDIYAWATI', 'Permanent', 4, 'Gramedia Padang Dept', 1, 1, '1970-11-18', '1994-02-15', '1994-02-15', '1996-06-01', NULL, NULL),
(247, '5652', 'DONNY RESTUADI', 'Permanent', 4, 'Gramedia Padang Dept', 1, 1, '1981-04-16', '2003-05-01', '2003-05-01', '2005-06-01', NULL, NULL),
(248, '87036', 'YEREMIA HENRY PUJIANTORO', 'Contract', 4, 'Gramedia Pamulang Siliwangi Dept', 1, 1, '1999-05-30', '2024-07-01', '2024-06-17', '0000-00-00', NULL, NULL),
(249, '86802', 'AMANDA PUTRI PRASETYA', 'Contract', 4, 'Gramedia Pamulang Siliwangi Dept', 1, 1, '2003-03-05', '2024-05-01', '2024-04-22', '0000-00-00', NULL, NULL),
(250, '89706', 'HADIID AL FATTAH', 'Contract', 4, 'Gramedia Pekanbaru Jend Sudirman Dept', 1, 1, '1998-02-15', '2025-03-01', '2025-03-03', '0000-00-00', NULL, NULL),
(251, '5201', 'YULIATI', 'Permanent', 4, 'Gramedia Pekanbaru Jend Sudirman Dept', 1, 1, '1977-07-01', '2001-05-15', '2001-05-15', '2003-12-01', NULL, NULL),
(252, '6422', 'TIURMA CHRISTINA', 'Permanent', 4, 'Gramedia Pekanbaru Jend Sudirman Dept', 1, 1, '1982-01-27', '2006-05-15', '2006-05-15', '2008-07-01', NULL, NULL),
(253, '31092', 'FERDY FIRMANSYAH', 'Permanent', 4, 'Gramedia Pekanbaru Mal SKA Dept', 1, 1, '1990-07-06', '2015-06-01', '2015-06-01', '2017-05-01', NULL, NULL),
(254, '5202', 'RITA MUSFIA', 'Permanent', 4, 'Gramedia Pekanbaru Mal SKA Dept', 1, 1, '1976-01-28', '2001-05-15', '2001-05-15', '2003-12-01', NULL, NULL),
(255, '9404', 'SRI HARTATI SILABAN', 'Permanent', 4, 'Gramedia Pekanbaru Mall Dept', 1, 1, '1984-08-31', '2008-07-01', '2008-07-01', '2010-10-01', NULL, NULL),
(256, '7653', 'ANDRY MURYADI', 'Permanent', 4, 'Gramedia Pekanbaru Mall Dept', 1, 1, '1981-05-18', '2006-06-01', '2006-06-01', '2009-02-01', NULL, NULL),
(257, '86951', 'HANDA PUTRA MAIZA', 'Contract', 4, 'Gramedia Pekanbaru Mall Dept', 1, 1, '1997-02-24', '2024-05-01', '2024-05-08', '0000-00-00', NULL, NULL),
(258, '90145', 'ROSA MELIANA TAMPUBOLON', 'Contract', 4, 'Gramedia Puri Indah Dept', 1, 1, '2000-07-22', '2025-05-01', '2025-04-21', '0000-00-00', NULL, NULL),
(259, '87283', 'MOHAMMAD RAFIADI', 'Contract', 4, 'Gramedia Puri Indah Dept', 1, 1, '1997-06-24', '2024-06-01', '2024-06-03', '0000-00-00', NULL, NULL),
(260, '1829', 'WIJIARTI', 'Permanent', 4, 'Gramedia Puri Indah Dept', 1, 1, '1971-12-19', '1991-11-01', '1991-11-01', '1992-11-01', NULL, NULL),
(261, '39581', 'FERRY FERDIAN', 'Permanent', 4, 'Gramedia Puri Indah Dept', 1, 1, '1989-12-08', '2016-10-17', '2016-10-17', '2018-11-01', NULL, NULL),
(262, '2075', 'IGNATIUS SUBROTO', 'Permanent', 4, 'Gramedia Puri Lippo Mall Dept', 1, 1, '1970-07-28', '1991-07-14', '1991-07-14', '1993-11-01', NULL, NULL),
(263, '42922', 'EKO PUTRA PAMBAGYO', 'Permanent', 4, 'Gramedia Puri Lippo Mall Dept', 1, 1, '1994-12-28', '2017-05-01', '2017-04-17', '2019-05-01', NULL, NULL),
(264, '81373', 'GETFI FEBSINTA', 'Contract', 4, 'Gramedia Puri Lippo Mall Dept', 1, 1, '1999-02-24', '2023-01-01', '2021-12-27', '0000-00-00', NULL, NULL),
(265, '90188', 'FEBRIYANA PRATAMA', 'Contract', 4, 'Gramedia Serang Dept', 1, 1, '1999-02-22', '2025-05-01', '2025-04-28', '0000-00-00', NULL, NULL),
(266, '90609', 'SITI HUMAEROH', 'Contract', 4, 'Gramedia Serang Dept', 1, 1, '2002-11-24', '2025-07-01', '2025-06-20', '0000-00-00', NULL, NULL),
(267, '89832', 'ALIEF ARDILES', 'Contract', 5, 'Gramedia Balikpapan Dept', 1, 1, '2002-04-29', '2025-04-01', '2025-03-14', '0000-00-00', NULL, NULL),
(268, '100530', 'MAYLANI ANGELINA SIMANUNGKALIT', 'Contract', 5, 'Gramedia Balikpapan Dept', 1, 1, '2002-05-12', '2025-11-01', '2025-10-11', '0000-00-00', NULL, NULL),
(269, '84912', 'NAUFAL DAANI ALHADI ASRI', 'Contract', 5, 'Gramedia Balikpapan Dept', 1, 1, '1998-11-19', '2023-11-01', '2023-11-09', '0000-00-00', NULL, NULL),
(270, '4885', 'VENTRI YUNITA', 'Permanent', 5, 'Gramedia Balikpapan Dept', 1, 1, '1973-06-24', '2000-08-01', '2000-08-01', '2002-10-01', NULL, NULL),
(271, '90788', 'SAMUELI ZEGA', 'Contract', 5, 'Gramedia Balikpapan MT Haryono Dept', 1, 1, '2002-02-27', '2025-07-01', '2025-07-07', '0000-00-00', NULL, NULL),
(272, '91086', 'MUH IQBAL KHAEDAR', 'Contract', 5, 'Gramedia Balikpapan MT Haryono Dept', 1, 1, '2001-04-22', '2025-09-01', '2025-09-01', '0000-00-00', NULL, NULL),
(273, '33787', 'NASIR RABA', 'Permanent', 5, 'Gramedia Balikpapan MT Haryono Dept', 1, 1, '1992-05-11', '2016-01-01', '2016-01-01', '2019-01-01', NULL, NULL),
(274, '7695', 'YADI', 'Permanent', 5, 'Gramedia Bangka Dept', 1, 1, '1988-06-03', '2006-09-01', '2006-09-01', '2009-11-01', NULL, NULL),
(275, '90143', 'NURCHOLIS AJI', 'Contract', 5, 'Gramedia Bangka Dept', 1, 1, '1999-06-03', '2025-05-01', '2025-04-21', '0000-00-00', NULL, NULL),
(276, '5998', 'SRI SARTIKA', 'Permanent', 5, 'Gramedia Bangka Dept', 1, 1, '1982-09-18', '2004-06-01', '2004-06-01', '2006-11-01', NULL, NULL),
(277, '90927', 'FARIZ OKY MAHENDRA', 'Contract', 5, 'Gramedia Bengkulu Meranti Dept', 1, 1, '2001-12-03', '2025-08-01', '2025-07-29', '0000-00-00', NULL, NULL),
(278, '100568', 'TAUFIQ HIDAYAT', 'Contract', 5, 'Gramedia Bengkulu Meranti Dept', 1, 1, '2002-05-15', '2025-11-01', '2025-11-01', '0000-00-00', NULL, NULL),
(279, '13885', 'FITRIYANI N', 'Permanent', 5, 'Gramedia Bengkulu Meranti Dept', 1, 1, '1987-05-27', '2010-11-01', '2010-11-01', '2012-11-01', NULL, NULL),
(280, '9568', 'LISYA FELANI', 'Permanent', 5, 'Gramedia Bengkulu Meranti Dept', 1, 1, '1985-02-08', '2008-08-01', '2008-08-01', '2010-07-01', NULL, NULL),
(281, '90766', 'FITHROTURROHMAH', 'Contract', 5, 'Gramedia Bintaro Emerald Dept', 1, 1, '2001-08-29', '2025-07-01', '2025-07-04', '0000-00-00', NULL, NULL),
(282, '90767', 'RIFQY DWIANDRA WIBOWO', 'Contract', 5, 'Gramedia Bintaro Emerald Dept', 1, 1, '2002-07-12', '2025-07-01', '2025-07-04', '0000-00-00', NULL, NULL),
(283, '88592', 'ALVEN', 'Contract', 5, 'Gramedia Bintaro Emerald Dept', 1, 1, '2003-09-09', '2024-11-01', '2024-10-28', '0000-00-00', NULL, NULL),
(284, '82659', 'ILHAM AMIRUL HUDA', 'Contract', 5, 'Gramedia Bintaro Emerald Dept', 1, 1, '1997-12-07', '2023-05-01', '2023-05-01', '0000-00-00', NULL, NULL),
(285, '90327', 'HIJRAN MAHJURA', 'Contract', 5, 'Gramedia Bintaro Plaza Dept', 1, 1, '2001-03-04', '2025-06-01', '2025-05-09', '0000-00-00', NULL, NULL),
(286, '90328', 'MUHAMAD INDRA BHAKTI', 'Contract', 5, 'Gramedia Bintaro Plaza Dept', 1, 1, '2000-06-08', '2025-06-01', '2025-05-10', '0000-00-00', NULL, NULL),
(287, '2072', 'SUGINO', 'Permanent', 5, 'Gramedia Bintaro Plaza Dept', 1, 1, '1967-12-10', '1991-07-15', '1991-07-15', '1993-11-01', NULL, NULL),
(288, '89772', 'LEONARDUS ANDREW PRAMONO', 'Contract', 5, 'Gramedia Gandaria City Dept', 1, 1, '2000-11-06', '2025-03-01', '2025-03-05', '0000-00-00', NULL, NULL),
(289, '4772', 'AJI BUDIANTO', 'Permanent', 5, 'Gramedia Gandaria City Dept', 1, 1, '1979-11-07', '2000-01-03', '2000-01-03', '2002-07-01', NULL, NULL),
(290, '86750', 'REBEKKA RISANTY SIMBOLON', 'Contract', 5, 'Gramedia Gandaria City Dept', 1, 1, '1998-09-06', '2024-05-01', '2024-04-08', '0000-00-00', NULL, NULL),
(291, '4144', 'DEDI', 'Permanent', 5, 'Gramedia Gandaria City Dept', 1, 1, '1975-05-12', '1997-07-03', '1997-07-03', '2001-02-01', NULL, NULL),
(292, '8543', 'EDISON', 'Permanent', 5, 'Gramedia Jambi Dept', 1, 1, '1982-11-05', '2007-11-01', '2007-11-01', '2010-04-01', NULL, NULL),
(293, '1855', 'AKHMAD FAUZUDIN', 'Permanent', 5, 'Gramedia Jambi Dept', 1, 1, '1970-03-20', '1990-08-27', '1990-08-27', '1992-12-01', NULL, NULL),
(294, '7635', 'RAHMAT WIDAYAT', 'Permanent', 5, 'Gramedia Jambi Dept', 1, 1, '1984-06-18', '2006-04-01', '2006-04-01', '2009-02-01', NULL, NULL),
(295, '8606', 'ERNA ARYA RAFTIA', 'Permanent', 5, 'Gramedia Jambi Dept', 1, 1, '1987-03-03', '2007-12-01', '2007-12-01', '2010-07-01', NULL, NULL),
(296, '8158', 'SEPTRIAN', 'Permanent', 5, 'Gramedia Jambi Dept', 1, 1, '1987-09-19', '2007-06-01', '2007-06-01', '2010-06-01', NULL, NULL),
(297, '2848', 'NURBIANTO', 'Permanent', 5, 'Gramedia Jambi Dept', 1, 1, '1967-10-28', '1994-02-16', '1994-02-16', '1996-06-01', NULL, NULL),
(298, '89141', 'BRENDA LIEONY', 'Contract', 5, 'Gramedia Palembang Atmo Dept', 1, 1, '2000-02-21', '2025-01-01', '2024-12-19', '0000-00-00', NULL, NULL),
(299, '90385', 'AUDRI PUTRI RISPANI', 'Contract', 5, 'Gramedia Palembang Atmo Dept', 1, 1, '2001-05-04', '2025-06-01', '2025-05-26', '0000-00-00', NULL, NULL),
(300, '87231', 'ULLANG EGA FAZERI', 'Contract', 5, 'Gramedia Palembang Atmo Dept', 1, 1, '1998-10-18', '2024-06-01', '2024-06-10', '0000-00-00', NULL, NULL),
(301, '1854', 'SUMERI', 'Permanent', 5, 'Gramedia Palembang Atmo Dept', 1, 1, '1969-12-01', '1990-08-27', '1990-08-27', '1992-12-01', NULL, NULL),
(302, '1847', 'LEONARDUS WIDIYONO', 'Permanent', 5, 'Gramedia Palembang Burlian Dept', 1, 1, '1971-07-05', '1990-08-27', '1990-08-27', '1992-12-01', NULL, NULL),
(303, '88920', 'ANCE ROMAULI HUTAPEA', 'Contract', 5, 'Gramedia Palembang Burlian Dept', 1, 1, '2001-02-10', '2024-12-01', '2024-11-28', '0000-00-00', NULL, NULL),
(304, '87358', 'LISA MARLINI', 'Contract', 5, 'Gramedia Palembang Burlian Dept', 1, 1, '1998-03-03', '2024-07-01', '2024-06-24', '0000-00-00', NULL, NULL),
(305, '87079', 'ELBA HANDAYANI', 'Contract', 5, 'Gramedia Palembang Burlian Dept', 1, 1, '2000-04-23', '2024-06-01', '2024-06-01', '0000-00-00', NULL, NULL),
(306, '90137', 'INTAN CAHYANI RATNAJUITA', 'Contract', 5, 'Gramedia Pangkalan Bun Dept', 1, 1, '2002-03-06', '2025-05-01', '2025-04-19', '0000-00-00', NULL, NULL),
(307, '90394', 'TOMY ADITYA WIGUNA', 'Contract', 5, 'Gramedia Pangkalan Bun Dept', 1, 1, '2001-05-08', '2025-06-01', '2025-05-28', '0000-00-00', NULL, NULL),
(308, '89218', 'VARELZA GERALDO', 'Contract', 5, 'Gramedia Pondok Indah Mall Dept', 1, 1, '2000-08-07', '2025-01-01', '2024-12-27', '0000-00-00', NULL, NULL),
(309, '77628', 'DANANG SURYONO', 'Permanent', 5, 'Gramedia Pondok Indah Mall Dept', 1, 1, '1996-06-07', '2022-04-01', '2022-04-01', '2024-10-01', NULL, NULL),
(310, '68656', 'RASYIDA', 'Permanent', 5, 'Gramedia Pondok Indah Mall Dept', 1, 1, '1988-10-19', '2019-11-01', '2019-11-01', '2023-05-01', NULL, NULL),
(311, '71543', 'MUTIARA LARASATI PERMONO', 'Permanent', 5, 'Gramedia Pondok Indah Mall Dept', 1, 1, '1994-11-07', '2020-11-01', '2020-11-01', '2022-11-01', NULL, NULL),
(312, '2766', 'SITI SANGIDAH', 'Permanent', 5, 'Gramedia Pondok Indah Mall Dept', 1, 1, '1974-04-27', '1993-11-16', '1993-11-16', '1996-03-01', NULL, NULL),
(313, '89471', 'RIVALDI NADILLAH', 'Contract', 5, 'Gramedia Pontianak Dept', 1, 1, '1997-07-29', '2025-02-01', '2025-02-03', '0000-00-00', NULL, NULL),
(314, '89716', 'VENNERANDA ALEYINDRI MONA', 'Contract', 5, 'Gramedia Pontianak Dept', 1, 1, '2002-11-03', '2025-03-01', '2025-03-01', '0000-00-00', NULL, NULL),
(315, '90381', 'ANTONIUS HARPEN', 'Contract', 5, 'Gramedia Pontianak Dept', 1, 1, '1999-05-02', '2025-06-01', '2025-05-23', '0000-00-00', NULL, NULL),
(316, '90413', 'FARHAN MAULANA NUGROHO', 'Contract', 5, 'Gramedia Pontianak Dept', 1, 1, '2000-07-01', '2025-06-01', '2025-06-02', '0000-00-00', NULL, NULL),
(317, '7797', 'SUSANA DEWI', 'Permanent', 5, 'Gramedia Pontianak Dept', 1, 1, '1982-08-03', '2006-12-01', '2006-12-01', '2009-11-01', NULL, NULL),
(318, '89774', 'RIZSKY SAPOETRA', 'Contract', 5, 'Gramedia Pontianak GAIA Dept', 1, 1, '2001-07-15', '2025-03-01', '2025-03-05', '0000-00-00', NULL, NULL),
(319, '100532', 'RAMADHANI', 'Contract', 5, 'Gramedia Pontianak GAIA Dept', 1, 1, '2000-11-16', '2025-11-01', '2025-10-13', '0000-00-00', NULL, NULL),
(320, '86059', 'NADIA DWI SUSANTI', 'Contract', 5, 'Gramedia Pontianak GAIA Dept', 1, 1, '1997-11-13', '2024-02-01', '2024-02-05', '0000-00-00', NULL, NULL),
(321, '89329', 'ACHMAD DANDY', 'Contract', 5, 'Gramedia Samarinda Big Mall Dept', 1, 1, '1999-09-02', '2025-02-01', '2025-01-13', '0000-00-00', NULL, NULL);
INSERT INTO `employees_tmp` (`id`, `employee_id`, `name`, `contract_type`, `region_id`, `store_name_temp`, `section_id`, `job_id`, `birthday`, `initial_employment_date`, `joining_date`, `permanent_date`, `created_at`, `updated_at`) VALUES
(322, '88168', 'DHERIS MAHENDRA', 'Contract', 5, 'Gramedia Samarinda Big Mall Dept', 1, 1, '2001-10-13', '2024-10-01', '2024-09-09', '0000-00-00', NULL, NULL),
(323, '89842', 'GILANG FIRZA ASYRAFA', 'Contract', 5, 'Gramedia Samarinda Dept', 1, 1, '1999-04-14', '2025-04-01', '2025-03-14', '0000-00-00', NULL, NULL),
(324, '73540', 'M MIRZA', 'Contract', 5, 'Gramedia Samarinda Dept', 1, 1, '1985-03-29', '2021-04-01', '2021-04-01', '0000-00-00', NULL, NULL),
(325, '42105', 'SELFIAH ARSITAH', 'Permanent', 5, 'Gramedia Samarinda Dept', 1, 1, '1992-09-12', '2017-03-01', '2017-02-16', '2019-04-01', NULL, NULL),
(326, '7989', 'GREGORIUS JOSEPANG', 'Permanent', 5, 'Gramedia Tarakan Dept', 1, 1, '1983-06-07', '2007-03-01', '2007-03-01', '2009-11-01', NULL, NULL),
(327, '7991', 'HADI ISTANTO', 'Permanent', 5, 'Gramedia Tarakan Dept', 1, 1, '1985-11-09', '2007-03-01', '2007-03-01', '2009-11-01', NULL, NULL),
(328, '88626', 'DICHO ALFALAH', 'Contract', 6, 'Gramedia Aceh Dept', 1, 1, '2000-02-21', '2024-11-01', '2023-01-07', '0000-00-00', NULL, NULL),
(329, '52964', 'FAHMI REZA JAMIL', 'Permanent', 6, 'Gramedia Aceh Dept', 1, 1, '1990-05-15', '2017-12-01', '2017-11-17', '2019-12-01', NULL, NULL),
(330, '52723', 'ISTI PURWANTO', 'Permanent', 6, 'Gramedia Aceh Dept', 1, 1, '1994-05-24', '2017-11-01', '2017-11-06', '2019-12-01', NULL, NULL),
(331, '5305', 'NOFI AMELIA', 'Permanent', 6, 'Gramedia Aceh Dept', 1, 1, '1978-08-03', '2002-11-15', '2002-11-15', '2004-05-01', NULL, NULL),
(332, '86787', 'ALFI RISKY RAHMANDA', 'Contract', 6, 'Gramedia Aceh Dept', 1, 1, '2002-02-13', '2024-05-01', '2024-04-20', '0000-00-00', NULL, NULL),
(333, '1938', 'DEDI SETIADI', 'Permanent', 6, 'Gramedia Bandung Buah Batu Dept', 1, 1, '1969-03-25', '1990-12-01', '1990-12-01', '1993-03-01', NULL, NULL),
(334, '88432', 'MICHELLE ANGEL', 'Contract', 6, 'Gramedia Bandung Buah Batu Dept', 1, 1, '2002-03-08', '2024-11-01', '2024-10-11', '0000-00-00', NULL, NULL),
(335, '88433', 'YOLISTIA MAHARANI ISMAIL PUTRI', 'Contract', 6, 'Gramedia Bandung Buah Batu Dept', 1, 1, '2000-10-03', '2024-11-01', '2024-10-11', '0000-00-00', NULL, NULL),
(336, '1969', 'TARCICIUS SUTARJONO', 'Permanent', 6, 'Gramedia Bandung Festival Citylink Dept', 1, 1, '1969-08-07', '1991-02-01', '1991-02-01', '1993-05-01', NULL, NULL),
(337, '3120', 'ADIS HADIAT', 'Permanent', 6, 'Gramedia Bandung Festival Citylink Dept', 1, 1, '1972-09-13', '1994-12-17', '1994-12-17', '1997-01-01', NULL, NULL),
(338, '7640', 'MARIA FRIDA LIZA NOVA', 'Permanent', 6, 'Gramedia Bandung Festival Citylink Dept', 1, 1, '1983-05-26', '2006-04-01', '2006-04-01', '2009-11-01', NULL, NULL),
(339, '5616', 'MILA MARLIANI', 'Permanent', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '1978-01-13', '2001-11-01', '2001-11-01', '2005-05-01', NULL, NULL),
(340, '87610', 'AULIA NATHANIA ANDRIANI', 'Contract', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '2002-08-26', '2024-08-01', '2024-07-17', '0000-00-00', NULL, NULL),
(341, '91218', 'YUSTINUS SUKMA NARENDRO', 'Contract', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '2000-11-01', '2025-09-01', '2025-09-08', '0000-00-00', NULL, NULL),
(342, '78447', 'PRIMA AJI SAPUTRA', 'Contract', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '1999-05-24', '2022-06-01', '2022-06-04', '0000-00-00', NULL, NULL),
(343, '83615', 'ANGELINE NINDA JESICA', 'Permanent', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '2001-06-01', '2023-08-01', '2023-07-24', '2025-09-01', NULL, NULL),
(344, '4703', 'ELAN SUHERLAN', 'Permanent', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '1979-04-04', '1999-06-01', '1999-06-01', '2002-04-01', NULL, NULL),
(345, '1455', 'YB TRIYANTO', 'Permanent', 6, 'Gramedia Bandung Merdeka Dept', 1, 1, '1969-09-27', '1989-01-01', '1989-01-01', '1991-04-01', NULL, NULL),
(346, '100510', 'ADINDA EINE AZALIA', 'Contract', 6, 'Gramedia Bandung Paris Van Java Dept', 1, 1, '2002-06-12', '2025-10-01', '2025-10-09', '0000-00-00', NULL, NULL),
(347, '5494', 'TINA NELLY SIMAMORA', 'Permanent', 6, 'Gramedia Bandung Paris Van Java Dept', 1, 1, '1979-02-26', '2001-11-01', '2001-11-01', '2004-12-01', NULL, NULL),
(348, '88755', 'GEGER YUNIAR', '', 6, 'Gramedia Bandung Paris Van Java Dept', 1, 1, '2001-06-16', '2024-11-01', '2024-11-02', '0000-00-00', NULL, NULL),
(349, '36971', 'ANDREAS HANSEN', 'Permanent', 6, 'Gramedia Bandung Summarecon Dept', 1, 1, '1991-03-14', '2016-04-01', '2016-04-01', '2018-04-01', NULL, NULL),
(350, '90185', 'ZEPHANYA YEHUDA LEUNISSEN', 'Contract', 6, 'Gramedia Bandung Summarecon Dept', 1, 1, '2001-08-15', '2025-05-01', '2025-05-05', '0000-00-00', NULL, NULL),
(351, '87662', 'NISRINA NURFELITA SARI', 'Contract', 6, 'Gramedia Bandung Summarecon Dept', 1, 1, '1999-08-01', '2024-08-01', '2024-08-07', '0000-00-00', NULL, NULL),
(352, '87617', 'PUTU GOVINDA PARAMITA', 'Contract', 6, 'Gramedia Bandung Trans Studio Mall Dept', 1, 1, '2002-12-12', '2024-08-01', '2024-07-18', '0000-00-00', NULL, NULL),
(353, '86231', 'APRILDO PANJAITAN', 'Contract', 6, 'Gramedia Bandung Trans Studio Mall Dept', 1, 1, '1999-04-25', '2024-03-01', '2024-02-22', '0000-00-00', NULL, NULL),
(354, '6003', 'DORKAS DESIMA', 'Permanent', 6, 'Gramedia Bandung Trans Studio Mall Dept', 1, 1, '1977-12-14', '2005-11-21', '2005-11-21', '2006-12-01', NULL, NULL),
(355, '90888', 'SUGENG DWY WIRA UTAMA', 'Contract', 6, 'Gramedia Bandung WR Supratman Dept', 1, 1, '2003-01-07', '2025-08-01', '2025-08-08', '0000-00-00', NULL, NULL),
(356, '3830', 'WIWIT WIDYASTUTI', 'Permanent', 6, 'Gramedia Bandung WR Supratman Dept', 1, 1, '1976-04-07', '1996-09-01', '1996-09-01', '2000-03-01', NULL, NULL),
(357, '89327', 'RAYHAN FAWWAZ KENANDI', 'Contract', 6, 'Gramedia Bekasi LW Grand Wisata Dept', 1, 1, '1998-10-06', '2025-02-01', '2025-01-22', '0000-00-00', NULL, NULL),
(358, '87365', 'LULU ARSYLIA', 'Contract', 6, 'Gramedia Bekasi LW Grand Wisata Dept', 1, 1, '2001-03-29', '2024-07-01', '2024-06-24', '0000-00-00', NULL, NULL),
(359, '89179', 'DESHINTA PUTRI DEWANTI', 'Contract', 6, 'Gramedia Bekasi LW Grand Wisata Dept', 1, 1, '1999-12-20', '2025-02-01', '2025-01-20', '0000-00-00', NULL, NULL),
(360, '82765', 'ANISA NURCHOTIMAH', 'Contract', 6, 'Gramedia Bekasi Mega Dept', 1, 1, '2000-04-22', '2023-05-01', '2023-04-24', '0000-00-00', NULL, NULL),
(361, '1463', 'CAHYONO DARMADI', 'Permanent', 6, 'Gramedia Bekasi Mega Dept', 1, 1, '1967-02-07', '1988-12-19', '1988-12-19', '1991-04-01', NULL, NULL),
(362, '90599', 'IGLO MONTANA DHARMAWAN', 'Contract', 6, 'Gramedia Bekasi MM Dept', 1, 1, '2003-01-07', '2025-07-01', '2025-06-16', '0000-00-00', NULL, NULL),
(363, '83258', 'YAGA TIAKA HALOMOAN ARITSI', 'Contract', 6, 'Gramedia Bekasi MM Dept', 1, 1, '1997-10-18', '2023-07-01', '2023-06-12', '0000-00-00', NULL, NULL),
(364, '6235', 'GILANG NOVTU ANDANA', 'Permanent', 6, 'Gramedia Bekasi MM Dept', 1, 1, '1982-11-30', '2004-10-01', '2004-10-01', '2008-01-01', NULL, NULL),
(365, '80204', 'HELENA DISIA NADIA TARINA', 'Contract', 6, 'Gramedia Bekasi MM Dept', 1, 1, '1999-08-12', '2022-10-01', '2022-10-10', '0000-00-00', NULL, NULL),
(366, '89143', 'ANGGUN PRAMUDITA', 'Contract', 6, 'Gramedia CBD Karawang Dept', 1, 1, '2002-05-17', '2025-01-01', '2024-12-27', '0000-00-00', NULL, NULL),
(367, '89409', 'FEBRIANI YUSNIKANA', 'Contract', 6, 'Gramedia CBD Karawang Dept', 1, 1, '2001-02-06', '2025-02-01', '2025-02-01', '0000-00-00', NULL, NULL),
(368, '90075', 'EBENHAEZER ELKANA SINAMOHINA', 'Contract', 6, 'Gramedia CBD Karawang Dept', 1, 1, '2003-03-18', '2025-05-01', '2025-04-14', '0000-00-00', NULL, NULL),
(369, '90610', 'SEVILA DELIAYANA', 'Contract', 6, 'Gramedia CBD Karawang Dept', 1, 1, '2001-02-05', '2025-07-01', '2025-06-20', '0000-00-00', NULL, NULL),
(370, '88074', 'AJENG SYAFA KAULIKA', 'Contract', 6, 'Gramedia Cikarang Pollux Dept', 1, 1, '2001-01-16', '2024-09-01', '2024-08-26', '0000-00-00', NULL, NULL),
(371, '87860', 'ANDREAS APRIAL PARDAMEAN SIMARMATA', 'Contract', 6, 'Gramedia Cikarang Pollux Dept', 1, 1, '2001-04-12', '2024-09-01', '2024-08-12', '0000-00-00', NULL, NULL),
(372, '90334', 'AGUNG MUHAMMAD YUSUF', 'Contract', 6, 'Gramedia Cimahi Dept', 1, 1, '2000-11-15', '2025-06-01', '2025-05-07', '0000-00-00', NULL, NULL),
(373, '100558', 'JIM JOHANNES PANGERAPAN', 'Contract', 6, 'Gramedia Cimahi Dept', 1, 1, '2002-01-21', '2025-11-01', '2025-10-18', '0000-00-00', NULL, NULL),
(374, '85506', 'SITI PATIMAH SAIDAH', 'Contract', 6, 'Gramedia Garut Dept', 1, 1, '2000-02-17', '2024-01-01', '2023-12-16', '0000-00-00', NULL, NULL),
(375, '77829', 'RAMA TIYANA', 'Permanent', 6, 'Gramedia Garut Dept', 1, 1, '1998-01-27', '2022-04-01', '2022-04-05', '2025-05-01', NULL, NULL),
(376, '86749', 'HASNA KHOIRUNNISA CAHYADINATA', 'Contract', 6, 'Gramedia Garut Dept', 1, 1, '2002-02-25', '2024-05-01', '2024-04-08', '0000-00-00', NULL, NULL),
(377, '41447', 'RIYANA', 'Permanent', 6, 'Gramedia Grand Bekasi Dept', 1, 1, '1994-07-27', '2017-01-01', '2017-01-01', '2017-01-01', NULL, NULL),
(378, '84223', 'FAISAL WAHYU', 'Contract', 6, 'Gramedia Grand Bekasi Dept', 1, 1, '1998-02-03', '2023-10-01', '2023-09-21', '0000-00-00', NULL, NULL),
(379, '100535', 'MARKUS LEO NARDO', 'Contract', 6, 'Gramedia Grand Bekasi Dept', 1, 1, '1999-02-12', '2025-11-01', '2025-10-13', '0000-00-00', NULL, NULL),
(380, '5802', 'WILI SETIYONO', 'Permanent', 6, 'Gramedia Harapan Indah Dept', 1, 1, '1978-07-31', '2003-04-01', '2003-04-01', '2006-02-01', NULL, NULL),
(381, '91153', 'MICHELLE APRILIA HERAWAN', 'Contract', 6, 'Gramedia Harapan Indah Dept', 1, 1, '2002-04-11', '2025-09-01', '2025-09-01', '0000-00-00', NULL, NULL),
(382, '91154', 'DIO PRASETIO', 'Contract', 6, 'Gramedia Harapan Indah Dept', 1, 1, '2002-05-22', '2025-09-01', '2025-09-01', '0000-00-00', NULL, NULL),
(383, '1303', 'PRIDADI', 'Permanent', 6, 'Gramedia Harapan Indah Dept', 1, 1, '1966-02-08', '1988-06-16', '1988-06-16', '1990-10-01', NULL, NULL),
(384, '83259', 'CHRITOFORUS DEVAN DWICAHYO', 'Contract', 6, 'Gramedia Harapan Indah Dept', 1, 1, '1996-04-08', '2023-07-01', '2023-06-12', '0000-00-00', NULL, NULL),
(385, '38546', 'RANDI APRIANSYAH RAMADHAN', 'Permanent', 6, 'Gramedia Harapan Indah Dept', 1, 1, '1989-04-26', '2016-08-01', '2016-08-01', '2017-09-01', NULL, NULL),
(386, '89912', 'NANDA FAKHIRA SANI', 'Contract', 6, 'Gramedia Indramayu Gatot Subroto Dept', 1, 1, '2001-08-01', '2025-04-01', '2025-03-19', '0000-00-00', NULL, NULL),
(387, '90104', 'FARHAN AONILLAH', 'Contract', 6, 'Gramedia Indramayu Gatot Subroto Dept', 1, 1, '2001-01-02', '2025-05-01', '2025-04-17', '0000-00-00', NULL, NULL),
(388, '37469', 'ULFI FATCHIYATUL JANNAH', 'Permanent', 6, 'Gramedia Karawang Resinda Park Dept', 1, 1, '1991-02-04', '2016-04-15', '2016-04-15', '2019-05-01', NULL, NULL),
(389, '90488', 'MUHAMMAD MUKHLASIN FATANI', 'Contract', 6, 'Gramedia Karawang Resinda Park Dept', 1, 1, '1998-07-03', '2025-06-01', '2025-06-04', '0000-00-00', NULL, NULL),
(390, '89595', 'JESSICA SILALAHI', 'Contract', 6, 'Gramedia Medan Gama Dept', 1, 1, '1999-04-22', '2025-03-01', '2025-02-15', '0000-00-00', NULL, NULL),
(391, '90624', 'MEGA LAURA LUBIS', 'Contract', 6, 'Gramedia Medan Gama Dept', 1, 1, '1999-07-02', '2025-07-01', '2025-07-01', '0000-00-00', NULL, NULL),
(392, '100415', 'ALEX SALENCO MANIK', 'Contract', 6, 'Gramedia Medan Gama Dept', 1, 1, '1999-09-14', '2025-11-01', '2025-11-01', '0000-00-00', NULL, NULL),
(393, '85507', 'FEBRUARI KURNIA WARUWU', 'Contract', 6, 'Gramedia Medan Gama Dept', 1, 1, '1997-02-15', '2024-01-01', '2023-12-18', '0000-00-00', NULL, NULL),
(394, '39484', 'MANGARISSAN SIDABUTAR', 'Permanent', 6, 'Gramedia Medan Gama Dept', 1, 1, '1991-05-30', '2016-10-10', '2016-10-10', '2017-11-01', NULL, NULL),
(395, '86941', 'PARIS MAVEL MORATA PURBA', 'Contract', 6, 'Gramedia Medan Gama Dept', 1, 1, '1999-06-13', '2024-05-01', '2024-05-07', '0000-00-00', NULL, NULL),
(396, '1992', 'BONI BONAVENTURA REVON CA', 'Permanent', 6, 'Gramedia Medan Gama Dept', 1, 1, '1971-07-14', '1990-12-07', '1990-12-07', '1993-06-01', NULL, NULL),
(397, '2785', 'IRAWATI', 'Permanent', 6, 'Gramedia Medan Gama Dept', 1, 1, '1974-06-29', '1993-11-01', '1993-11-01', '1996-04-01', NULL, NULL),
(398, '86184', 'DHAMIRA ANGGI MANDIRA LUBIS', 'Contract', 6, 'Gramedia Medan Manhattan Dept', 1, 1, '1998-09-16', '2024-03-01', '2024-02-19', '0000-00-00', NULL, NULL),
(399, '1991', 'MARJONO', 'Permanent', 6, 'Gramedia Medan Manhattan Dept', 1, 1, '1973-12-11', '1990-10-07', '1990-10-07', '1993-06-01', NULL, NULL),
(400, '54056', 'REZA SAPUTRA RAMBE', 'Permanent', 6, 'Gramedia Medan Sun Plaza Dept', 1, 1, '1994-09-13', '2018-02-01', '2018-01-16', '2020-02-01', NULL, NULL),
(401, '10489', 'ELISNA RISTAULI RAJAGUKGUK', 'Permanent', 6, 'Gramedia Medan Sun Plaza Dept', 1, 1, '1985-01-16', '2009-03-01', '2009-03-01', '2011-08-01', NULL, NULL),
(402, '3558', 'YENTI RUMONDANG HUTAHURUK', 'Permanent', 6, 'Gramedia Medan Sun Plaza Dept', 1, 1, '1970-02-26', '1995-10-09', '1995-10-09', '1999-03-01', NULL, NULL),
(403, '89963', 'GITA LARASATI NUGROHO', 'Contract', 6, 'Gramedia Purwakarta Dept', 1, 1, '2001-06-11', '2025-04-01', '2025-04-04', '0000-00-00', NULL, NULL),
(404, '81485', 'REZA ILHAM FAKHRI', 'Contract', 6, 'Gramedia Purwakarta Dept', 1, 1, '1999-05-24', '2023-01-01', '2023-01-02', '0000-00-00', NULL, NULL),
(405, '88779', 'WINNI MULYANI SONJAYA', '', 6, 'Gramedia Subang Otto Iskandardinata Dept', 1, 1, '2000-10-13', '2024-11-01', '2024-11-06', '0000-00-00', NULL, NULL),
(406, '87124', 'ANGGIA FEBIANKA', 'Contract', 6, 'Gramedia Subang Otto Iskandardinata Dept', 1, 1, '2001-02-25', '2024-06-01', '2024-05-30', '0000-00-00', NULL, NULL),
(407, '90862', 'FADHLI SYAMSI', 'Contract', 6, 'Gramedia Tasikmalaya Dept', 1, 1, '2002-09-01', '2025-08-01', '2025-07-15', '0000-00-00', NULL, NULL),
(408, '21991', 'SEVINA SETIADHARMA', 'Permanent', 6, 'Gramedia Tasikmalaya Dept', 1, 1, '1989-11-13', '2013-09-01', '2013-09-01', '2015-06-01', NULL, NULL),
(409, '28307', 'ELTRIS AGUSTINO', 'Permanent', 6, 'Gramedia Tasikmalaya Dept', 1, 1, '1989-08-02', '2015-02-01', '2015-02-01', '2016-09-01', NULL, NULL),
(410, '90520', 'ERICHA LINGGA PARAWANGSA', 'Contract', 7, 'Gramedia Bali Duta Plaza Dept', 1, 1, '2000-05-24', '2025-06-01', '2025-06-09', '0000-00-00', NULL, NULL),
(411, '87887', 'DEWA MADE BAGUS BHIMA SURYAJAYA', 'Contract', 7, 'Gramedia Bali Duta Plaza Dept', 1, 1, '2000-10-23', '2024-09-01', '2024-08-13', '0000-00-00', NULL, NULL),
(412, '4847', 'ANASTASIA MARIA FATIMA ESL', 'Permanent', 7, 'Gramedia Bali Duta Plaza Dept', 1, 1, '1978-03-27', '2000-02-01', '2000-02-01', '2002-08-01', NULL, NULL),
(413, '4779', 'NI NYOMAN DEWI YUNIARTI', 'Permanent', 7, 'Gramedia Bali Duta Plaza Dept', 1, 1, '1978-06-05', '1999-01-01', '1999-01-01', '2002-07-01', NULL, NULL),
(414, '89047', 'ANISA PUTRI NUR HIDAYAH', 'Contract', 7, 'Gramedia Bali Galeria Mall Dept', 1, 1, '1999-05-06', '2024-12-01', '2024-12-02', '0000-00-00', NULL, NULL),
(415, '90277', 'KHALIFAH ALIF SYAFRI', 'Contract', 7, 'Gramedia Bali Galeria Mall Dept', 1, 1, '1998-02-28', '2025-06-01', '2025-05-12', '0000-00-00', NULL, NULL),
(416, '2410', 'NI MADE ADI HARINATAL', 'Permanent', 7, 'Gramedia Bali Galeria Mall Dept', 1, 1, '1972-12-25', '1992-09-21', '1992-09-21', '1995-03-01', NULL, NULL),
(417, '40438', 'DEDI KURNIAWAN', 'Permanent', 7, 'Gramedia Bali Galeria Mall Dept', 1, 1, '1991-07-18', '2016-11-23', '2016-11-23', '2018-12-01', NULL, NULL),
(418, '40210', 'KADEK AYU CAHYA MANIK', 'Permanent', 7, 'Gramedia Bali Gatot Subroto Dept', 1, 1, '1995-12-17', '2016-11-10', '2016-11-10', '2019-12-01', NULL, NULL),
(419, '86692', 'LUKMANUL HAKIM', 'Contract', 7, 'Gramedia Bali Gatot Subroto Dept', 1, 1, '1999-05-04', '2024-04-01', '2024-04-05', '0000-00-00', NULL, NULL),
(420, '3246', 'SARTO', 'Permanent', 7, 'Gramedia Bali Gatot Subroto Dept', 1, 1, '1972-11-17', '1994-10-01', '1994-10-01', '1997-04-01', NULL, NULL),
(421, '90598', 'STEVANUS SELAMET MULYONO', 'Contract', 7, 'Gramedia Bali Teuku Umar Dept', 1, 1, '2000-09-22', '2025-07-01', '2025-06-10', '0000-00-00', NULL, NULL),
(422, '87663', 'NI WAYAN EKAYANI', 'Contract', 7, 'Gramedia Bali Teuku Umar Dept', 1, 1, '2001-04-05', '2024-08-01', '2024-07-25', '0000-00-00', NULL, NULL),
(423, '83881', 'JEHAN FAHMI RIDWAN', 'Permanent', 7, 'Gramedia Bali Teuku Umar Dept', 1, 1, '1998-02-25', '2023-09-01', '2023-08-21', '2025-09-01', NULL, NULL),
(424, '2345', 'I KETUT SUMEYASA', 'Permanent', 7, 'Gramedia Bali Teuku Umar Dept', 1, 1, '1970-12-01', '1992-09-01', '1992-09-01', '1995-01-01', NULL, NULL),
(425, '90268', 'ALDI WAHYU NUGROHO', 'Contract', 7, 'Gramedia Bojonegoro Dept', 1, 1, '1999-01-04', '2025-05-01', '2025-05-06', '0000-00-00', NULL, NULL),
(426, '90269', 'BAGUS SATRIO NUGROHO', 'Contract', 7, 'Gramedia Bojonegoro Dept', 1, 1, '1999-12-09', '2025-05-01', '2025-05-06', '0000-00-00', NULL, NULL),
(427, '22585', 'YEYEN S HUYO', 'Permanent', 7, 'Gramedia Gorontalo Dept', 1, 1, '1991-06-07', '2013-11-01', '2013-11-01', '2015-11-01', NULL, NULL),
(428, '82433', 'WIRANTO NALOLE', 'Contract', 7, 'Gramedia Gorontalo Dept', 1, 1, '1997-08-17', '2023-04-01', '2023-03-18', '0000-00-00', NULL, NULL),
(429, '22751', 'ARIANON SUMBEANG', 'Permanent', 7, 'Gramedia Gorontalo Dept', 1, 1, '1987-01-25', '2013-11-01', '2013-11-01', '2015-10-01', NULL, NULL),
(430, '2171', 'FARID MAGHFUR', 'Permanent', 7, 'Gramedia Jember Dept', 1, 1, '1972-10-07', '1991-12-01', '1991-12-01', '1994-04-01', NULL, NULL),
(431, '6185', 'TITIN WANDANSARI', 'Permanent', 7, 'Gramedia Jember Dept', 1, 1, '1983-08-20', '2006-11-01', '2006-11-01', '2007-11-01', NULL, NULL),
(432, '12693', 'MEINITA SUCIATI', 'Permanent', 7, 'Gramedia Jember Dept', 1, 1, '1987-05-17', '2010-05-01', '2010-05-01', '2012-06-01', NULL, NULL),
(433, '5752', 'HAFID ROSIDI', 'Permanent', 7, 'Gramedia Jember Dept', 1, 1, '1981-07-13', '2002-10-01', '2002-10-01', '2005-12-01', NULL, NULL),
(434, '12960', 'CHITRA NEGARI PUTRI DIYANAWATI', 'Permanent', 7, 'Gramedia Kediri Dept', 1, 1, '1988-07-17', '2010-06-01', '2010-06-01', '2012-06-01', NULL, NULL),
(435, '13415', 'KUSUMA TRIWARDHANA', 'Permanent', 7, 'Gramedia Kediri Dept', 1, 1, '1986-10-27', '2010-09-01', '2010-09-01', '2012-09-01', NULL, NULL),
(436, '16513', 'RAHMA BINTARIATI', 'Permanent', 7, 'Gramedia Kediri Dept', 1, 1, '1990-06-07', '2012-05-01', '2012-05-01', '2014-08-01', NULL, NULL),
(437, '8153', 'EKO YUDHO PRASETYO', 'Permanent', 7, 'Gramedia Malang Basuki Rahmad Dept', 1, 1, '1984-04-30', '2007-06-01', '2007-06-01', '2010-04-01', NULL, NULL),
(438, '90148', 'SETYAWAN TRIADITAMA', 'Contract', 7, 'Gramedia Malang Basuki Rahmad Dept', 1, 1, '2000-09-07', '2025-05-01', '2025-04-21', '0000-00-00', NULL, NULL),
(439, '2405', 'ISNANIK', 'Permanent', 7, 'Gramedia Malang Basuki Rahmad Dept', 1, 1, '1971-02-24', '1992-12-01', '1992-12-01', '1995-03-01', NULL, NULL),
(440, '1340', 'MOH WAHYUDI', 'Permanent', 7, 'Gramedia Malang Basuki Rahmad Dept', 1, 1, '1967-03-05', '1987-02-06', '1987-02-06', '1991-01-01', NULL, NULL),
(441, '6278', 'SURYONO', 'Permanent', 7, 'Gramedia Malang Basuki Rahmad Dept', 1, 1, '1984-01-14', '2005-06-01', '2005-06-01', '2008-02-01', NULL, NULL),
(442, '90928', 'BERNICKE KARTIKA PUTRI', 'Contract', 7, 'Gramedia Malang Olympic Garden Dept', 1, 1, '2002-03-21', '2025-08-01', '2025-08-01', '0000-00-00', NULL, NULL),
(443, '8508', 'DWI ANDRI SEPTIADI', 'Permanent', 7, 'Gramedia Malang Olympic Garden Dept', 1, 1, '1984-09-20', '2007-10-01', '2007-10-01', '2010-04-01', NULL, NULL),
(444, '2407', 'MARIUS PURWITO', 'Permanent', 7, 'Gramedia Malang Olympic Garden Dept', 1, 1, '1970-01-19', '1992-12-01', '1992-12-01', '1995-03-01', NULL, NULL),
(445, '5921', 'ERNA KUSUMAWATI', 'Permanent', 7, 'Gramedia Malang Olympic Garden Dept', 1, 1, '1981-03-14', '2004-02-01', '2004-02-01', '2006-07-01', NULL, NULL),
(446, '90105', 'DWI WIRANTI', 'Contract', 7, 'Gramedia Malang Tlogomas Dept', 1, 1, '1999-06-17', '2025-05-01', '2025-05-01', '0000-00-00', NULL, NULL),
(447, '90113', 'MUHAMMAD HILMAN MAULANA', 'Contract', 7, 'Gramedia Malang Tlogomas Dept', 1, 1, '2002-01-25', '2025-05-01', '2025-05-01', '0000-00-00', NULL, NULL),
(448, '6307', 'RIONALDI WILLIAM MASSIE', 'Permanent', 7, 'Gramedia Manado Samratulangi Dept', 1, 1, '1985-01-08', '2005-08-01', '2005-08-01', '2008-03-01', NULL, NULL),
(449, '4705', 'SUKRIADI KAI', 'Permanent', 7, 'Gramedia Manado Samratulangi Dept', 1, 1, '1967-01-26', '2000-01-01', '2000-01-01', '2002-04-01', NULL, NULL),
(450, '8820', 'JEANE LIENNA FITHRIA MAMANGKEY', 'Permanent', 7, 'Gramedia Manado Samratulangi Dept', 1, 1, '1983-01-15', '2008-01-01', '2008-01-01', '2010-10-01', NULL, NULL),
(451, '73770', 'YEDIJA RANI KLARION MANOPPO', 'Permanent', 7, 'Gramedia Manado Samratulangi Dept', 1, 1, '1983-12-06', '2021-04-01', '2021-04-04', '2023-11-01', NULL, NULL),
(452, '37303', 'BRAMWELL A KASAEDJA', 'Permanent', 7, 'Gramedia Manado Samratulangi Dept', 1, 1, '1991-04-05', '2016-04-01', '2016-04-01', '2018-10-01', NULL, NULL),
(453, '85859', 'PRAYUDA MANOSO', 'Contract', 7, 'Gramedia Manado Samratulangi Dept', 1, 1, '1999-07-14', '2024-02-01', '2024-02-01', '0000-00-00', NULL, NULL),
(454, '89908', 'ARENS KRISTIAMOS PAPARANG', 'Contract', 7, 'Gramedia Manado Town Square Dept', 1, 1, '2000-01-18', '2025-04-01', '2025-04-01', '0000-00-00', NULL, NULL),
(455, '18448', 'SINTYA CHRISTY', 'Permanent', 7, 'Gramedia Manado Town Square Dept', 1, 1, '1993-12-29', '2012-12-01', '2012-12-01', '2014-10-01', NULL, NULL),
(456, '33850', 'CHREVITA JOULINA EVANCE', 'Permanent', 7, 'Gramedia Manado Town Square Dept', 1, 1, '1992-11-01', '2016-01-01', '2016-01-01', '2017-10-01', NULL, NULL),
(457, '34362', 'SUPIYAH PUTERI RAMDHANI', 'Permanent', 7, 'Gramedia Sidoarjo Pahlawan Dept', 1, 1, '1994-03-06', '2016-02-01', '2016-02-01', '2018-02-01', NULL, NULL),
(458, '90418', 'MOHAMAD MUJADID MAHMUD', 'Contract', 7, 'Gramedia Sidoarjo Pahlawan Dept', 1, 1, '1998-11-13', '2025-06-01', '2025-06-01', '0000-00-00', NULL, NULL),
(459, '2936', 'SITI NURANI', 'Permanent', 7, 'Gramedia Surabaya Expo Dept', 1, 1, '1970-08-27', '1994-06-01', '1994-06-01', '1996-09-01', NULL, NULL),
(460, '2403', 'DYAH LANTIK ROSTINANTI', 'Permanent', 7, 'Gramedia Surabaya Expo Dept', 1, 1, '1971-03-14', '1992-12-01', '1992-12-01', '1995-03-01', NULL, NULL),
(461, '6096', 'SARI WIJAYANTI', 'Permanent', 7, 'Gramedia Surabaya Expo Dept', 1, 1, '1978-05-23', '2003-12-19', '2003-12-19', '2007-04-01', NULL, NULL),
(462, '12615', 'ALEK WIDI PRASETYA', 'Permanent', 7, 'Gramedia Surabaya Expo Dept', 1, 1, '1987-03-19', '2010-04-01', '2010-04-01', '2012-08-01', NULL, NULL),
(463, '100616', 'AUDREY GIVTA ENAQY', 'Contract', 7, 'Gramedia Surabaya Mal Pakuwon Dept', 1, 1, '2000-11-06', '2025-11-01', '2025-11-03', '0000-00-00', NULL, NULL),
(464, '6384', 'KHAIRUDDIN', 'Permanent', 7, 'Gramedia Surabaya Mal Pakuwon Dept', 1, 1, '1981-03-21', '2005-07-04', '2005-07-04', '2008-06-01', NULL, NULL),
(465, '84995', 'MUHAMMAD RHEZA NOOR FAHMI', 'Contract', 7, 'Gramedia Surabaya Mal Pakuwon Dept', 1, 1, '1994-12-05', '2023-12-01', '2023-11-17', '0000-00-00', NULL, NULL),
(466, '1725', 'NATALIA CHRISMIATI', 'Permanent', 7, 'Gramedia Surabaya Mal Pakuwon Dept', 1, 1, '1968-01-25', '1989-03-06', '1989-03-06', '1992-03-01', NULL, NULL),
(467, '31152', 'FAULINA KURNIATI', 'Permanent', 7, 'Gramedia Surabaya Manyar Dept', 1, 1, '1992-07-11', '2015-06-01', '2015-06-01', '2017-06-01', NULL, NULL),
(468, '2815', 'EKO NUGROHO', 'Permanent', 7, 'Gramedia Surabaya Manyar Dept', 1, 1, '1968-03-02', '1994-06-01', '1994-06-01', '1996-05-01', NULL, NULL),
(469, '73573', 'FAHRIZAL ADI KURNIA', 'Permanent', 7, 'Gramedia Surabaya Manyar Dept', 1, 1, '1984-06-16', '2021-04-01', '2021-04-01', '2023-04-01', NULL, NULL),
(470, '7650', 'SHELVI TYA NURANI', 'Permanent', 7, 'Gramedia Surabaya Manyar Dept', 1, 1, '1983-09-27', '2006-05-01', '2006-05-01', '2009-11-01', NULL, NULL),
(471, '90601', 'GEMILANG WAHYU BIMANTARA', 'Contract', 7, 'Gramedia Surabaya Royal Plaza Dept', 1, 1, '2001-06-24', '2025-07-01', '2025-06-16', '0000-00-00', NULL, NULL),
(472, '40487', 'LUKI CECYLIA ANDINI', 'Permanent', 7, 'Gramedia Surabaya Royal Plaza Dept', 1, 1, '1995-03-07', '2016-11-28', '2016-11-28', '2018-11-01', NULL, NULL),
(473, '18499', 'RIDO ARIAWAN', 'Permanent', 7, 'Gramedia Surabaya Royal Plaza Dept', 1, 1, '1988-08-10', '2012-12-01', '2012-12-01', '2013-12-01', NULL, NULL),
(474, '1731', 'PRIYO SISWANTO', 'Permanent', 7, 'Gramedia Surabaya Royal Plaza Dept', 1, 1, '1966-07-31', '1989-03-13', '1989-03-13', '1992-03-01', NULL, NULL),
(475, '7644', 'CHOLIQ HIDAYATULLAH', 'Permanent', 7, 'Gramedia Surabaya Tunjungan Plaza Dept', 1, 1, '1983-08-29', '2006-05-01', '2006-05-01', '2009-02-01', NULL, NULL),
(476, '88847', 'MUHAMMAD ALVIN JUANDA', 'Contract', 7, 'Gramedia Surabaya Tunjungan Plaza Dept', 1, 1, '1999-12-31', '2024-12-01', '2024-11-18', '0000-00-00', NULL, NULL),
(477, '90459', 'VITA AULIA SARI', 'Contract', 7, 'Gramedia Surabaya Tunjungan Plaza Dept', 1, 1, '2000-04-12', '2025-06-01', '2025-06-02', '0000-00-00', NULL, NULL),
(478, '2372', 'SUDIRO', 'Permanent', 7, 'Gramedia Surabaya Tunjungan Plaza Dept', 1, 1, '1973-10-11', '1992-10-01', '1992-10-01', '1995-02-01', NULL, NULL),
(479, '31086', 'M SYAHYUDI AZIZ', 'Permanent', 7, 'Gramedia Surabaya Tunjungan Plaza Dept', 1, 1, '1988-03-29', '2015-06-01', '2015-06-01', '2017-03-01', NULL, NULL),
(480, '34653', 'SETIA NINGRUM INDAH PERTIWI', 'Permanent', 7, 'Gramedia Surabaya Tunjungan Plaza Dept', 1, 1, '1993-02-10', '2016-03-01', '2016-03-01', '2018-03-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `introductions`
--

CREATE TABLE `introductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `fgd_analytic_score` tinyint(4) DEFAULT NULL,
  `fgd_analytic_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fgd_business_score` tinyint(4) DEFAULT NULL,
  `fgd_business_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fgd_leadership_score` tinyint(4) DEFAULT NULL,
  `fgd_leadership_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interview_analytic_score` tinyint(4) DEFAULT NULL,
  `interview_analytic_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interview_business_score` tinyint(4) DEFAULT NULL,
  `interview_business_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interview_leadership_score` tinyint(4) DEFAULT NULL,
  `interview_leadership_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fgd_note` text DEFAULT NULL,
  `interview_note` text DEFAULT NULL,
  `mcu` varchar(255) DEFAULT NULL,
  `psikotes` varchar(255) DEFAULT NULL,
  `rekomendasi` text DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `introductions`
--

INSERT INTO `introductions` (`id`, `nik`, `fgd_analytic_score`, `fgd_analytic_level_id`, `fgd_business_score`, `fgd_business_level_id`, `fgd_leadership_score`, `fgd_leadership_level_id`, `interview_analytic_score`, `interview_analytic_level_id`, `interview_business_score`, `interview_business_level_id`, `interview_leadership_score`, `interview_leadership_level_id`, `fgd_note`, `interview_note`, `mcu`, `psikotes`, `rekomendasi`, `pic`, `created_at`, `updated_at`) VALUES
(1, '80667', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(2, '73540', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(3, '74200', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(4, '75482', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(5, '81272', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(6, '81373', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(7, '77829', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(8, '78447', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(9, '80204', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(10, '80252', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(11, '85573', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(12, '84307', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(13, '81485', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(14, '88626', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(15, '82034', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(16, '82112', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(17, '82252', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Ngelead diskusi, ada analisa dan strategi', 'sudah ada dasar2 leadership karena sebagai SOA store beberapa kali menjadi pic event', '', '', '', 'VW\r', NULL, NULL),
(18, '82259', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(19, '82365', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(20, '82433', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(21, '82665', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(22, '82482', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(23, '82671', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(24, '82765', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(25, '82659', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(26, '82895', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(27, '82893', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(28, '83258', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(29, '83259', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(30, '83615', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(31, '83822', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(32, '83881', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(33, '83914', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(34, '84223', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(35, '84251', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(36, '84433', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(37, '84432', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(38, '84576', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(39, '84630', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(40, '84646', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(41, '84700', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(42, '84841', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(43, '84699', 0, 0, 0, 0, 0, 0, 2, 2, 1, 1, 1, 1, 'tidak FGD kandidat satu2nya', 'perlu dikembangkan ddi perencanaan strategi & leadership', 'https://drive.google.com/open?id=1fnDRWPeJjcnpN6cMzIUly00lKEOHGZ1h&usp=drive_fs', 'https://drive.google.com/open?id=1yGwC5NBJHk691jjlYwn1K8vSBU3hkCPK&usp=drive_fs', '', 'VW\r', NULL, NULL),
(44, '84908', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(45, '84912', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(46, '84995', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(47, '85067', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(48, '85506', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(49, '85507', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(50, '85611', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(51, '85830', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'aktif dalam diskusi, ada analisa dan strategi', 'leadership perlu dikembangkan di tempat kerja, masih fresh graduate', 'https://drive.google.com/open?id=1VdZ58wVwPrBnHQpkO8w4IYLt_nkp1WQ5&usp=drive_fs', 'https://drive.google.com/open?id=11z-gCMikXI86qACqE2yLGZhBegKNDGiz&usp=drive_fs', '', 'VW\r', NULL, NULL),
(52, '85872', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(53, '85891', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan dari pengalamannya di Decathlon', 'sudah bergerak di dunia literasi dan banyak masukan untuk pengembangan di Gramedia', 'https://drive.google.com/open?id=1D7zCwLDGrLuZ_P6C73oNFcP0w3iMZ6j-&usp=drive_fs', 'https://drive.google.com/open?id=1VwbM9CDWr9_DZyTB-46tOGXkqXWIJQ1u&usp=drive_fs', '', 'VW\r', NULL, NULL),
(54, '85928', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(55, '88638', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan dari pengalamannya di Decathlon', 'sudah ada dasar2 leadership karena sebagai SOA store beberapa kali menjadi pic event', '', 'https://drive.google.com/open?id=1YTlE5oVpTyi2BrNUVTvPv3_xYVwivFOo&usp=drive_fs', '', 'VW\r', NULL, NULL),
(56, '85859', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(57, '86059', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(58, '86184', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan dari pengalamannya di Decathlon', 'sudah ada dasar2 leadership karena sebagai SOA store beberapa kali menjadi pic event', '', 'https://drive.google.com/open?id=140O0LgGpSs4-kJ4lvj6VHkzCvIItH1Uf&usp=drive_fs', '', 'VW\r', NULL, NULL),
(59, '86231', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan dari pengalamannya di Decathlon', '', 'https://drive.google.com/open?id=1Zaw9lkYay91-syrGuUqMoKkrY4kaZahq&usp=drive_fs', 'https://drive.google.com/open?id=140O0LgGpSs4-kJ4lvj6VHkzCvIItH1Uf&usp=drive_fs', '', 'VW\r', NULL, NULL),
(60, '86192', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'aktif dalam diskusi, ada analisa dan strategi', 'leadership perlu dikembangkan di tempat kerja, masih fresh graduate', 'https://drive.google.com/open?id=1ykO1LKqDatkqZjsBIzJUSI8sgBdhULps&usp=drive_fs', 'https://drive.google.com/open?id=1RFTsQMbEaQ7ANw7EA7TkUFAM9vFdD6YA&usp=drive_fs', '', 'VW\r', NULL, NULL),
(61, '86446', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(62, '86447', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(63, '86537', 0, 0, 0, 0, 0, 0, 2, 2, 2, 2, 2, 2, 'tidak FGD karena kandidatnya 1', 'kemampuan analisa, perencanaan strategi dan leadership sudah terbentuk saat jadi SS Medan dan tempat kerja berikutnya', 'https://drive.google.com/open?id=1XRNpCjySvh-8ft2_09ZrEN6SlqLJX-lO&usp=drive_fs', 'https://drive.google.com/open?id=1jG68SpYQYhJ6hvu0ffx4OMj5wPlUz7wi&usp=drive_fs', '', 'VW\r', NULL, NULL),
(64, '86538', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(65, '86561', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(66, '86692', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(67, '86750', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(68, '86749', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'ngelad diskusi, ok di analisa dan strategi perencanaan dari pengalamannya di Decathlon', 'ada kemampuan analisa dan strategi yg dibutuhkan di SS, leadership sudah ada dasar2', '', 'https://drive.google.com/open?id=1uxsGduPyKsSo7NfqRRhS7bH-R1tG3Ooz&usp=drive_fs', '', 'VW\r', NULL, NULL),
(69, '86528', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'aktif dalam diskusi, ada analisa dan strategi', 'ada kemampuan analisa dan strategi, leadership perlu dikembangkan di tempat kerja, pengalaman sebelumnya sebagai SOA dan checker', 'https://drive.google.com/open?id=1PCQmLgY9bzq7-pJsICAWouALCoEX7Wc1&usp=drive_fs', 'https://drive.google.com/open?id=1QEYJYkntZSIaDS95VgP01f94LQUHuNx6&usp=drive_fs', '', 'VW\r', NULL, NULL),
(70, '86787', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(71, '86802', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(72, '86814', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(73, '86852', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(74, '86884', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan dari pengalamannya di Decathlon', 'punya kemampuan analisa, perencanaan strategi dan leadership dr pengalaman selama Decathlon', 'https://drive.google.com/open?id=1fr9BM3M0T2e5m5E3yrccn-oUe7fi8jXR&usp=drive_fs', 'https://drive.google.com/open?id=1MZwV_NZPX10VeEeLQHBf0HaqeooF_14O&usp=drive_fs', '', 'VW\r', NULL, NULL),
(75, '86941', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership', 'https://drive.google.com/open?id=1X9rMQXr1ixaQhxOPnP6_lptwrf20feh0&usp=drive_fs', 'https://drive.google.com/open?id=1fiRHgM9g1HLgVW1mfeDhM1HZyjejFL7d&usp=drive_fs', '', 'VW\r', NULL, NULL),
(76, '86951', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(77, '87040', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(78, '87124', 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1, 'aktif dan ikut ngelead dalam diskusi, analisa dan strategi ok', 'ada kemampuan analisa, leadership dan perencanaan strategi perlu dikembangkan lebih lanjut', 'https://drive.google.com/open?id=1mOvLnJkcov5ixNvjCa8WbfDWeIDEfgEs&usp=drive_fs', 'https://drive.google.com/open?id=1ejaJPtUGF-4bqUryKIjtoP97YC-FHDJm&usp=drive_fs', '', 'VW\r', NULL, NULL),
(79, '87079', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(80, '87283', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(81, '87229', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(82, '87231', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(83, '87036', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(84, '87376', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(85, '87369', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(86, '87358', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(87, '87365', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'aktif dalam diskusi, analisa dan strategi ok', 'ada kemampuan analisa dan strategi, leadership perlu dikembangkan lebih lanjut, masih freshgraduate', 'https://drive.google.com/open?id=1uLEPsYsCXI60NysF-H9lDsb9Bk-4WysY&usp=drive_fs', 'https://drive.google.com/open?id=1pVMn1s8Lnwetv2Owg5bJpSeudQY6MrDo&usp=drive_fs', '', 'VW\r', NULL, NULL),
(88, '87499', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(89, '87610', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi dan bisnis keluarga', 'https://drive.google.com/open?id=1QLRQRGnyV-MyTsrwwyBoHrzLQveauAMf&usp=drive_fs', 'https://drive.google.com/open?id=10gx_D5RTNiJ43-mjHQR53_3LWFbcXkeD&usp=drive_fs', '', 'VW\r', NULL, NULL),
(90, '87617', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'Saat FGD cukup berpartisipasi hanya jalannya dikusi cenderung didominasi salah 1 peserta lain', '', 'https://drive.google.com/file/d/1cEd_54V7YIKIiUfkSg6dK6LDihOgbFJc/view?usp=drive_link', 'https://drive.google.com/file/d/1DKk9jeJu5JHenaOOJNdsiHMTdvzujPzD/view?usp=drive_link', 'Akses materi-materi terkait leadership di Kognisi untuk semakin meningkatkan kemampuan leadershipnya', 'VW\r', NULL, NULL),
(91, '87627', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelad diskusi, ok di analisa dan strategi perencanaan', 'ada kemampuan analisa, perencanaan dan dasar2 leadership', 'https://drive.google.com/open?id=1ja6cfeZoJO7-qZZpvxr90RRUE030_pi9&usp=drive_fs', 'https://drive.google.com/open?id=1cpo9EYmg7aYAUSl98A8tqj5hLp9r6W1d&usp=drive_fs', '', 'VW\r', NULL, NULL),
(92, '87663', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(93, '87677', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', '', '', '', '', '\r', NULL, NULL),
(94, '87662', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 'Dengan background pengalamannya di dekoruma, Nisrina aktif memberikan untuk penyelesaian kasus, ide untuk pengembangan store G, hanya kurang aktif mengarahkan jalannya diskusi karena ada peserta lain yg lebih aktif mengarahkan', 'Berdasarkan pengalamannya di Dekoruma, Nisrina memaparkan pengalamannya dalam memimpin tim, analisa dan perencanaan untuk memastikan target2 di dekoruma dapat tercapai', 'https://drive.google.com/file/d/1n5KH06IkKDP4AtR2XnuEGgz79UhQJ8R-/view?usp=drive_link', 'https://drive.google.com/file/d/139rjLIk6tbRhspxsRw5MNk_qRQZvwTSE/view?usp=drive_link', 'Memanfaatkan pengetahuan, skill yaang dipelajari selama di Dekoruma dan diterapkan di store, khususnya bagaimana menggerakkan tim dalam mencapai target2', 'VW\r', NULL, NULL),
(95, '87829', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', '', '', '', '', '\r', NULL, NULL),
(96, '87860', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', 'Meskipun masih relatif fresh graduate, nampak analisa, strategi dan leadershipnya didapat dr pengalaman organisasi dan bisnis keluarga', 'https://drive.google.com/open?id=1MtwHqAfrGKbqgy_2D6vqpYrjxJWETVEW&usp=drive_fs', 'https://drive.google.com/open?id=1lOSFVzrSCV_5HVPEdz28R0ZHL0Ks6Vuh&usp=drive_fs', '', 'VW\r', NULL, NULL),
(97, '87887', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(98, '88074', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'aktif dalam diskusi, ikut ngelead jalannya diskusi', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi', 'https://drive.google.com/open?id=1lzViHebWnAtkMS-MeF6A6AZ9kRhTQWXh&usp=drive_fs', 'https://drive.google.com/open?id=1_m9xFuJ5oU24Hc_NZrZHWFOH9wg_NKaN&usp=drive_fs', '', 'VW\r', NULL, NULL),
(99, '88168', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(100, '87853', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(101, '88218', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelead diskusi, analisa dan strategi ok', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi dan di organisasi NGO', 'https://drive.google.com/open?id=1dwRlOTFPpuujGfw_9o4f--QjZlKv5hd1&usp=drive_fs', 'https://drive.google.com/open?id=1oVu9_BRl6W1VfQufSbUNV3jpl1oGAMwz&usp=drive_fs', '', 'VW\r', NULL, NULL),
(102, '88247', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelead diskusi, analisa dan strategi ok', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi', 'https://drive.google.com/open?id=1yrT_VyCi9Ibwr8qG_2UuUOxlqvhaZ7oU&usp=drive_fs', 'https://drive.google.com/open?id=1xgCILkiEkXHYwj-bCkf6Sa9AQoRG6Rsk&usp=drive_fs', '', 'VW\r', NULL, NULL),
(103, '88271', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(104, '88401', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(105, '88373', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(106, '88402', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(107, '88436', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'aktif dalam diskusi, ikut ngelead jalannya diskusi', 'punya kemampuan analisa, perencanaan strategi, leadership perlu dikembangkan', 'https://drive.google.com/open?id=1Fn8qarpyCz9u8gymDro5lFtO15ns1WJy&usp=drive_fs', 'https://drive.google.com/open?id=19AkOvpQ_hgBpXgnyFuPGDfU_dqvmX31T&usp=drive_fs', '', 'VW\r', NULL, NULL),
(108, '88432', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'aktif dalam diskusi, ikut ngelead jalannya diskusi, analisa dan strategi ok', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi', 'https://drive.google.com/open?id=1SDs2SF07VG98T5a16Lopm6Eh2zxy-hE5&usp=drive_fs', 'https://drive.google.com/open?id=1PV1tSpU_A0N4S0L4Ylp7Ncp4vBpmY6pa&usp=drive_fs', '', 'VW\r', NULL, NULL),
(109, '88433', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Ngelead diskusi, analisa dan strategi ok', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi', 'https://drive.google.com/open?id=1CeEUT9Df_EruGdNgnx5dqfoX0H498_9C&usp=drive_fs', 'https://drive.google.com/open?id=1lhKU5DmESe6d0ugh-_qMCEv8m8ONWAuz&usp=drive_fs', '', 'VW\r', NULL, NULL),
(110, '88456', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(111, '88546', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(112, '88629', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(113, '88592', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(114, '88730', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelead diskusi, ada analisa dan strategi dari pengalaman magang di Gramedia', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari pengalaman magang di Gramedia CP selama ikut magang dr kampus', 'https://drive.google.com/open?id=1vvL778vaG-h4Hbjm1U2QLZFVpfFBm2QJ&usp=drive_fs', 'https://drive.google.com/open?id=1psGsg_Ohk6Rlr5Cv6sJCQ4fsFfPfguLb&usp=drive_fs', '', 'VW\r', NULL, NULL),
(115, '88755', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, '', 'punya kemampuan analisa dan perencanaan strategi, leadership perlu diasah di lapangan', 'https://drive.google.com/open?id=1PIkONHDGAD-9Occx13E7KJB15jJ3su7M&usp=drive_fs', 'https://drive.google.com/open?id=1E8EUIWu9NxFQE_a9QPEbyXifh0SGxx2M&usp=drive_fs', '', 'VW\r', NULL, NULL),
(116, '88445', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'aktif dalam diskusi dan ikut ngelead diskusi, analisa dan strategi ok', 'punya kemampuan analisa, perencanaan strategi dan dasar2 leadership dari kegiatan organisasi', 'https://drive.google.com/open?id=1GSXj4UjmMXysCEc-NAhJ5qSQebXyY3hh&usp=drive_fs', 'https://drive.google.com/open?id=18_9os6AKffHtxN0Yk56HI5-8_3I9Ud5a&usp=drive_fs', '', 'VW\r', NULL, NULL),
(117, '88674', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, '', 'punya kemampuan analisa dan perencanaan strategi, leadership perlu diasah di lapangan', '', 'https://drive.google.com/open?id=17NCwxInH-twvOMfUfkC8r7z-aQjXyk6-&usp=drive_fs', '', 'VW\r', NULL, NULL),
(118, '88639', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(119, '88779', 0, 0, 0, 0, 0, 0, 2, 2, 2, 2, 1, 1, 'tidak FGD karena kandidat sendirian', 'ada dasar2 analisa dan strategi dr pengalaman sebagai SOA Gramedia, perlu dikembangkan leadershipnya', 'https://drive.google.com/open?id=1qXVa3Ab_Z0q17Tax-FIbS3dbRlmTLd3Z&usp=drive_fs', 'https://drive.google.com/open?id=1Tso5v4yD7-jJPDrZuZ6Ok8XvvKhH_hy1&usp=drive_fs', 'dikembangkan di leadership karena background dari SOA', 'VW\r', NULL, NULL),
(120, '88836', 2, 2, 2, 2, 2, 2, 0, 0, 0, 0, 0, 0, '', '', 'https://drive.google.com/open?id=13njGhu69XeeJGCFO7lTn9-x3rsbY9HM5&usp=drive_fs', 'https://drive.google.com/open?id=1bq1V3JfNcC9fNewkBaAxFkLZofLlR2H-&usp=drive_fs', '', 'VW\r', NULL, NULL),
(121, '88838', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(122, '88820', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(123, '88847', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(124, '88885', 0, 0, 0, 0, 0, 0, 2, 2, 2, 2, 1, 1, 'tidak FGD karena seleksi sendiri', 'perlu dikembangkan di leadership', 'https://drive.google.com/open?id=1R0pRW3TdBvNKpWzWPVqw6gTLY9z_0VcI&usp=drive_fs', 'https://drive.google.com/open?id=1iVvgEQ5mWXh2ncYopa7HNqaDuUmywWlx&usp=drive_fs', '', '\r', NULL, NULL),
(125, '88917', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ikut ngelead diskusi', 'perlu diperkuat di pengetahuan retail', '', '', '', 'VW\r', NULL, NULL),
(126, '88920', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(127, '89047', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(128, '89099', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(129, '89141', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(130, '89145', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(131, '89218', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(132, '89143', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelead diskusi', 'dari pengalaman organisasi nampak kemampuan di analisa, strategi dan leadershipnya', 'https://drive.google.com/open?id=1yyr7dWUjxM5xvv0R6K0bQ1LzA_I3U8dB&usp=drive_fs', 'https://drive.google.com/open?id=1b4g7tz5UComr8oquoWd23TcaSNZUSZik&usp=drive_fs', 'sudah ada dasar2 soft competency yg dibutuhkan, diperkuat di retailnya', 'VW\r', NULL, NULL),
(133, '89329', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Cukup aktif dalam diskusi, menyampaikan pendapat yang relevan meskipun masih terbatas dari sisi kedalaman analisis. Mampu bekerja sama dalam tim dan menunjukkan potensi memimpin dalam dinamika kelompok.', 'Jawaban cukup relevan namun masih umum. Perlu pendalaman dalam menyusun strategi dan pengambilan keputusan. Potensi kolaboratif terlihat, namun belum menunjukkan inisiatif sebagai pemimpin.\r\nAda pengalaman di f&b, terlihat minat dalam membaca buku (pernah publish buku sendiri).', 'https://drive.google.com/open?id=1xTq3ZqITsr2boH_cVFMizRVKKOLEaMOf&usp=drive_fs', 'https://drive.google.com/open?id=1ZdfA2WnXpj-fyJfzGIF0hZ2maKGL1h9y&usp=drive_fs', 'Mengikuti pelatihan Excel Mastery untuk mengasah analisis data', 'RA\r', NULL, NULL),
(134, '89362', 3, 3, 2, 2, 2, 2, 3, 3, 2, 2, 2, 2, 'Cenderung bisa lead dan maintain diskusi dengan baik, memberikan jawaban yang cukup relevan dengan topik yang dibahas', 'Cukup komunikatif, potential untuk leader walaupun belum memiliki pengalaman retail, punya kemauan untuk belajar', 'https://drive.google.com/file/d/1QipmcHlDPtKmJGq-HG_wJMHPVrTYLez8/view?usp=drive_link', 'https://drive.google.com/file/d/1AEW9yG3FCFNTD8V0aP2hrBcOrKj6D_6n/view?usp=drive_link', 'Dilibatkan dalam pelatihan kepemimpinan dan decision-making', 'RA\r', NULL, NULL),
(135, '89179', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD aktif berpartisipasi dan ikut ngelead jalannya diskusi', 'dari pengalaman di tempat kerja sebelumnya nampak kemampuan di analisa, strategi, leadership perlu dikembangkan lagi', 'https://drive.google.com/file/d/1f1IqFb2BpVwMyPKBiBbqA9KwfVHhYELf/view?usp=drive_link', 'https://drive.google.com/open?id=1U5WNb8cXuT0l92oRDl6nWoLoejM1fPrn&usp=drive_fs', 'Motivasi tinggi, ada kemampuan analisa, perlu coaching di leadership', 'VW\r', NULL, NULL),
(136, '89327', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD aktif berpartisipasi', 'Punya pengalaman sebagai konsultan untuk pengembangan bisnis', 'https://drive.google.com/file/d/1qGv-4KmO_ic-06K3ylvSM2X5cfpehTyt/view?usp=drive_link', 'https://drive.google.com/file/d/1CJo87Y-1EiDZYU8MNuvvEkrTSeeUI_DQ/view?usp=drive_link', 'ada pengalaman sebagai konsultan pengembangan bisanisa kafe, perlu dikembangkan leadership yg efektif di retail dan ide untuk pengebangan bisnis di toko', 'VW\r', NULL, NULL),
(137, '89472', 3, 3, 3, 3, 2, 2, 3, 3, 3, 3, 2, 3, 'Komunikatif dan memiliki pemahaman yang tinggi terkait proses bisnis, cenderung memimpin jalannya diskusi', 'Proaktif ketika tanya jawab, elaboratif, mau belajar dan menunjukan ketertarikan dengan posisi, nilai plus karena sudah memahami proses bisnis toko Gramedia', 'https://drive.google.com/file/d/1m88QiUSJaekLhZl8l3aH2TY9XtJp4diU/view?usp=drive_link', 'https://drive.google.com/file/d/1XJm9AQRt7gvb-P7uuFHAw-Eu-QWUNKH8/view?usp=drive_link', '', 'RA\r', NULL, NULL),
(138, '89409', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', 'Ok daam analisa, punya ide2 untuk pengembangan store ke depan dan punya leadership', 'https://drive.google.com/file/d/1kSZ6aqNyeWo3rr1-mv0iNaYaIwzLOdqA/view?usp=drive_link', 'https://drive.google.com/file/d/1Vik24CgJsCsXkL4R0rJGfg8h8-JvlH-d/view?usp=drive_link', 'Leadershipnya nampak saat interview dan FGD, tinggal diarahkan. Kemampuan analisa dan business planning ok', 'VW\r', NULL, NULL),
(139, '89530', 3, 3, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Memimpin jalannya diskusi, memberikan arahan yang jelas, tidak ragu memberikan pendapat dan masukan', 'Elaboratif dalam menjawab, tertarik dengan retail, punya pengalaman memimpin tim di dalam project intern dan freelance, kemauan belajar yang tinggi', 'https://drive.google.com/file/d/1aJk4y817ZhXJZZWD_9pLHeny8z_3YOgZ/view?usp=drive_link', 'https://drive.google.com/file/d/1UZT6e0IFrf3W6dWs9f05HLIfp-Iuck47/view?usp=drive_link', '', 'RA\r', NULL, NULL),
(140, '89364', 2, 2, 2, 2, 3, 3, 2, 2, 3, 3, 3, 3, 'Memberikan arahan dan aktif dalam diskusi, pendapat relevan dengan pertanyaan', 'Pengalaman sebagai trainee di Astra, terbiasa dengan sales b2c, memberikan penjelasan yang relevan, berpengalaman untuk memimpin tim', 'https://drive.google.com/open?id=1Apst3w35jToTRDtOPloBW62PbJo4wQgx&usp=drive_fs', 'https://drive.google.com/open?id=1LJhVDnyzHR2KkATrPE9Tv5YsHQE2YD-C&usp=drive_fs', '', 'RA\r', NULL, NULL),
(141, '89471', 3, 3, 2, 2, 3, 3, 3, 3, 2, 2, 3, 3, 'Aktif menyampaikan pendapat, mampu mengarahkan diskusi, analisis masalah cukup baik', 'Memiliki pengalaman organisasi yang kuat, komunikatif, dan terbiasa bekerja dalam tim', 'https://drive.google.com/file/d/1bo0V1PDvITyHKdLaYuuLuW9dcpNJ3hmT/view?usp=drive_link', 'https://drive.google.com/file/d/1-D59SKBOyTvOENa20RaIxbHfLRvu-Sw9/view?usp=drive_link', '', 'RA\r', NULL, NULL),
(142, '89594', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(143, '89593', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(144, '89595', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', 'Banyak inisiatif yang dilakukan selama di toko. Target oriented. Paham target2 penjualan di toko. Menjadi best active selling SOA', 'https://drive.google.com/file/d/1_C7mpWBiy3XotWfIQqaNC6hR5nlNamwf/view?usp=drive_link', 'https://drive.google.com/file/d/1dqJdXEH30vgnrcrYX9kHgfsHLKZ9Nmap/view?usp=drive_link', 'Kemampuan analisa, business planning & leadershipnya ok dr pengalaman sebagai SOA. Tegas dan keinginan mencapai target tinggi. Dicoaching untuk proses yg lebih efektif di posisi SS', 'VW\r', NULL, NULL),
(145, '89652', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'Saat FGD cukup aktif berpartisipasi dan memberikan masukan ke tim', 'ada kemampuan analisa dan ide untuk pengembangan bisnis Gramedia, leadership perlu dikembangkan di lapangan', 'https://drive.google.com/open?id=1mrsnuB34fVVCkmvkbvXB1PvtUoIm3IjC&usp=drive_fs', 'https://drive.google.com/file/d/1-z9JBYAdWGEr7qgs0xnfOYl9kS5-pNlX/view?usp=drive_link', 'Lebih dikembangkan leadershipnya di toko', 'VW\r', NULL, NULL),
(146, '89698', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'Saat FGD aktif berpartisipasi dan ikut ngelead jalannya diskusi', 'ada kemampuan analisa dan ide untuk pengembangan bisnis Gramedia, leadership perlu dikembangkan di toko', 'https://drive.google.com/open?id=12bnaKw2aP322BqHuXYqyO2dZevhhLPRN&usp=drive_fs', 'https://drive.google.com/file/d/12qV6-VYAnLGb1XJhyD-7lIlLM_e508Bv/view?usp=drive_link', '', 'VW\r', NULL, NULL),
(147, '89703', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'SL\r', NULL, NULL),
(148, '89706', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'SL\r', NULL, NULL),
(149, '89716', 3, 3, 2, 2, 3, 3, 3, 3, 2, 2, 3, 3, 'Dominan dalam diskusi namun tetap memberi ruang bagi peserta lain, menyampaikan ide dengan struktur jelas', 'Pernah memimpin proyek kampus (KKN) untuk pengembangan literasi di daerahnya, pengalaman di bidang layanan pelanggan, percaya diri dan mampu menjelaskan pengalaman dengan baik', 'https://drive.google.com/file/d/1KGWn4NLbPiYCmBClGxmfZ6fQiyW6-3Tm/view?usp=drive_link', 'https://drive.google.com/file/d/1VUVvGJfKD--pp_QTHYAYuAtgfLPPV89X/view?usp=drive_link', '', 'RA\r', NULL, NULL),
(150, '89710', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD aktif berpartisipasi dalam diskusi', 'Pengalaman sebagai guru les musik, ada leadership, punya kemampuan analisa dan ada masukan untuk pengembangan toko Gramedia', 'https://drive.google.com/file/d/1nQSK59ELL1yeacY4rRavzeCZrpp6kzAC/view?usp=drive_link', 'https://drive.google.com/file/d/1oWAUQeugErFO_vcUX9hOakCr-gssSg9d/view?usp=drive_link', 'Ada pengalaman mengajar musik, ada komptensi di leadership dan analisa, business planning di retail perlu dikembangkan', 'VW\r', NULL, NULL),
(151, '89772', 2, 2, 2, 2, 3, 3, 3, 3, 2, 2, 3, 3, 'Memberikan arahan dan aktif dalam diskusi, pendapat relevan dengan pertanyaan', 'Pengalaman handle event dan WO, memberikan jawaban yang relevan', 'https://drive.google.com/open?id=1BL7YKOeMRkjjhf1DxB3G3Z2Z2uCX_jj0&usp=drive_fs', 'https://drive.google.com/open?id=1BTeihlWju453c3_DKtXgZZya5H9p076B&usp=drive_fs', 'Perlu banyak belajar mengenai data dan perkembangan ritel', 'RA\r', NULL, NULL),
(152, '89774', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Cukup aktif dalam diskusi, menunjukkan sikap kerja sama namun kontribusi masih terbatas, pendapat belum terlalu menonjol', 'Memiliki pengalaman sebagai crew toko dan leader, mampu menjelaskan peran kepemimpinan dengan baik, namun masih perlu penguatan dalam aspek kolaborasi.', 'https://drive.google.com/file/d/1AJrVW3stHytnDp9yXljLacZtNYc-xrh0/view?usp=drive_link', 'https://drive.google.com/file/d/1Y3tv8E7sQJkBznrY7tB1fA0_7XlnJd-k/view?usp=drive_link', 'Leadership training', 'RA\r', NULL, NULL),
(153, '89800', 2, 2, 2, 2, 2, 2, 3, 3, 2, 2, 2, 2, 'Kritis dan aktif, memberikan pendapat yang relevan', 'Terlihat percaya diri dan nyaman selama wawancara, elaboratif dalam menyampaikan jawaban', 'https://drive.google.com/file/d/1oX-IcG6qC6b5cefL8-iIcjBuuQRhW6h2/view?usp=drive_link', 'https://drive.google.com/file/d/1b4GXLBoxGgiW80OXXzbMqHxpKXcBvi_H/view?usp=drive_link', 'Komunikasi aktif dan pelatihan untuk kemampuan asertif', 'RA\r', NULL, NULL),
(154, '89799', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'SL\r', NULL, NULL),
(155, '89841', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'Saat FGD aktif berpartisipasi dan ikut ngelead jalannya diskusi', 'Pengalaman kerja di F&B. Perlu diasah di leadershipnya', '', '', 'Perlu coaching di leadership dan knowledge di retail untuk optimalisasi kinerja', 'SL/VW\r', NULL, NULL),
(156, '89832', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Memberikan pendapat yang relevan dengan studi kasus dan berinisiatif memimpin jalannya diskusi. Terlihat percaya diri dan aktif dalam menyampaikan ide.', 'Kemampuan analitis, perencanaan bisnis, dan kepemimpinan masih pada tahap dasar. Perlu penguatan dalam menyusun strategi dan pengambilan keputusan, namun menunjukkan potensi kerja sama tim yang baik.', 'https://drive.google.com/open?id=1zlsvQ_8Jiko4_8vYLSNh47BBvT1ymMr5&usp=drive_fs', 'https://drive.google.com/open?id=1N9FWKEJf3OhgroKFpbB6FTxpJzub8hRb&usp=drive_fs', 'Pelatihan softskill untuk penjualan dan product knowledge, leadership juga perlu dilatih', 'RA\r', NULL, NULL),
(157, '89842', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 'Cukup aktif dalam diskusi, menunjukkan sikap kerja sama namun kontribusi masih terbatas, pendapat belum terlalu menonjol.', 'Pengalaman kerja di bagian kreatif dan marketing CRM, mampu menjawab pertanyaan dengan lugas, namun masih perlu pengembangan komunikasi dan pengetahuan di bidang ritel', 'https://drive.google.com/open?id=1mJTyo_wQaCWFzdVPmN6CUY_tQfpJWXEH&usp=drive_fs', 'https://drive.google.com/open?id=1wAw2ZwgfSJugvxOviXHQ9s04P7ffEW-Z&usp=drive_fs', 'Leadership sudah cukup terlihat namun perlu menjaga konsistensi dan upskilling melalui pelatihan yang relevan, analisis data juga perlu dipertajam', 'RA\r', NULL, NULL),
(158, '89912', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(159, '89916', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', '', 'https://drive.google.com/file/d/1qrUQMHVmWayTin9B-nvgOBuzfzCC9zmb/view?usp=drive_link', 'https://drive.google.com/file/d/1PrrXRvH8-ZO4USWo1ppf_rvT12aslPoj/view?usp=drive_link', 'Kemampuan analisa, business planning & leadershipnya ok. Tegas Dicoaching untuk proses yg lebih efektif di posisi SS', 'VW\r', NULL, NULL),
(160, '89954', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'SL/VW\r', NULL, NULL),
(161, '89908', 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 2, 2, 'Memberikan pendapat secukupnya. Pendapat yang disampaikan tidak mendalam, dengan kemampuan analisis, perencanaan, dan kepemimpinan yang masih dalam tahap pengembangan.', 'Penjelasan seadanya, membutuhkan beberapa kali probing untuk mendapatkan jawaban yang relevan, terlihat adanya kemauan untuk memimpin. Cukup paham dengan operasional retail.', 'https://drive.google.com/open?id=1LkWcN_93J7KhmBNuS2QmQUtillNZwhWY&usp=drive_fs', 'https://drive.google.com/open?id=1RJmOEjuLyk_gy2hr9AMjGHNYgmz_7DJN&usp=drive_fs', 'Perlu diikutkan dalam pelatihan leadership, strategic planning, dan analisis data.', 'RA\r', NULL, NULL),
(162, '89963', 0, 0, 0, 0, 0, 0, 2, 2, 1, 1, 2, 2, 'Tidak ikut FGD karena hanya 1 kandidat, kebutuhan urgent', 'Perlu dikembangkan di leadershipnya', 'https://drive.google.com/file/d/1S0rtHBU8SADD6BtuzCO6yBzET9hbdLu7/view?usp=drive_link', 'https://drive.google.com/file/d/1RsLt7VwBC7GsIW382WkzsFyUWdkkNkA7/view?usp=drive_link', 'Perlu dikembangkan di leadershipnya', 'VW\r', NULL, NULL),
(163, '90009', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'Saat FGD aktif berpartisipasi', 'Dr hasil interview belum nampak kesempatan ybs untuk ngelead tim selama di SOA (event dll)', 'https://drive.google.com/file/d/1sl72jDFGlMawV1AHzfLX506zlgc-TNw-/view?usp=drive_link', 'https://drive.google.com/file/d/1p0yWBPOPbo747jWsYg3AeII1p08oc4xo/view?usp=drive_link', 'Perlu dikembangkan di leadershipnya', 'VW\r', NULL, NULL),
(164, '90061', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD aktif berpartisipasi', 'Masih freshgraduate. Inisiatif2nya dilakukan saat di organisasi kampus', 'https://drive.google.com/file/d/1LXO3CFWbST9zs1WG6-M2bIFvI3IxMCeA/view?usp=drive_link', 'https://drive.google.com/file/d/106Greu5Vsx3_6v-EDtqlgnabtZ5DDoYu/view?usp=drive_link', '', 'VW\r', NULL, NULL),
(165, '90075', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', 'Masih freshgraduate. Inisiatif2nya dilakukan saat di kampus', 'https://drive.google.com/file/d/1rMGrdekt4UNjLUg0TjO78yf1qnrFZEEy/view?usp=drive_link', 'https://drive.google.com/file/d/1WspFf2eimCvY1Hpzx-_deYR4opw8X5L0/view?usp=drive_link', 'Fresh graduate, hanya dari proses seleksi sudah nampak leadershipnya. dicoaching lebih lanjut di tempat kerja', 'VW\r', NULL, NULL),
(166, '90104', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Cukup aktif dalam berpendapat dan memahami ritel', 'Dapat memberikan insight untuk perkembangan new store, mampu memberikan gambaran kondisi pasar & customer di area baru, memiliki kemauan utk berkembang dan keluar dari domisili', 'https://drive.google.com/file/d/13309IY1HFIL_2Ha3ejgnd-ukAWGIBw3W/view?usp=sharing', 'https://drive.google.com/file/d/1mT07S752YGm1n4Ha_LCHmNl71fXy2RoA/view?usp=sharing', 'Kemampuan analisa cukup memadai utk dapat diasah sesuai kebutuhan bisnis, komunikasi baik, motivasi tinggi untuk berkembang', 'DTA\r', NULL, NULL),
(167, '90074', 0, 0, 0, 0, 0, 0, 2, 2, 1, 1, 2, 2, 'Tidak ikut FGD karena hanya 1 kandidat, kebutuhan urgent', 'Pengalaman sebagai pembimbing BK saat di sekolah, punya kemampuan analisa masalah dan mengarahkan anak2 didik di sekolah terkait karir', 'https://drive.google.com/file/d/1bJhMB1pM9xi1OtURfbgoHg4yuCJ9Q7Zw/view?usp=drive_link', 'https://drive.google.com/file/d/1vsmDksihbjdFgbFbPRGi0N-IQpGnFb_I/view?usp=drive_link', 'coaching leadership yang lebih efektif dan di analisa terkait retail', 'VW\r', NULL, NULL),
(168, '90077', 2, 2, 2, 2, 3, 3, 2, 2, 2, 2, 2, 2, 'Beberapa kali memberikan insight untuk improvement toko, cukup aktif bertukar pikiran, namun masih terlihat kurang percaya diri.', 'Pembawaan tenang, masih perlu diasah untuk leadership dan analisis data', 'https://drive.google.com/open?id=1qi7nK2JauLbSZbVKzfWWQgoybPxHHqHA&usp=drive_fs', 'https://drive.google.com/open?id=180uhoTFfL9ReFasKqFI98q9QwMsgZVJF&usp=drive_fs', 'Leadership training dan mentoring, analisis data', 'RA\r', NULL, NULL),
(169, '90137', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', 'Memiliki ide2 untuk pengembangan yg bisa dilakukan di toko Pangkalan Bun dan membuka pasar', 'https://drive.google.com/open?id=1qkQbJbsJaadZoF9RBiAkeBS_nEn4cPlY&usp=drive_fs', 'https://drive.google.com/open?id=1aDzH5WvBdYjdBcdFAqmeXeUdqyXkM6xO&usp=drive_fs', '', 'VW\r', NULL, NULL),
(170, '90079', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD aktif berpartisipasi', 'Pengalaman dr kegiatan di organisasi kampus', 'https://drive.google.com/open?id=1U3Ge10OOeqFiaSDn51PHgeMSegb1XQMb&usp=drive_fs', 'https://drive.google.com/open?id=1MbNFs-t42MmMeCPaURxxzKNRn3QAepYa&usp=drive_fs', '', 'VW\r', NULL, NULL),
(171, '90146', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Berpartisipasi dalam diskusi namun kontribusi masih terbatas. Menunjukkan sikap kooperatif sebagai anggota tim.', 'Jawaban yang diberikan masih cukup umum dan belum mendalam. Perlu peningkatan dalam aspek analisis dan perencanaan. Menunjukkan potensi kerja sama tim, namun belum terlihat inisiatif kepemimpinan.', 'https://drive.google.com/open?id=1cie3eiGCxhiuJmorMbEaZlqRgaEgWINT&usp=drive_fs', 'https://drive.google.com/open?id=1MKl1iCWRH6wWmRI18SHhPrV0_GMFpLMM&usp=drive_fs', 'Pelatihan komunikasi efektif, terutama dalam menyampaikan ide secara terstruktur kepada tim. Evaluasi berkala terhadap partisipasi aktif dalam diskusi dan kerja tim', 'RA\r', NULL, NULL),
(172, '90143', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Kontribusi aktif dalam sesi diskusi. Menunjukkan sikap kooperatif.', 'Respon yang relevan dengan pengalamannya. Potensi menjadi leader, namun perlu diasah dalam hal komunikasi.', 'https://drive.google.com/open?id=1p3Kdk3fsUbBgf0YTgM-L5TJL7lBiFrqx&usp=drive_fs', 'https://drive.google.com/open?id=1OIJLGWU0CV55AAP7jEp-eOP4Ur0S7RHr&usp=drive_fs', 'Pelatihan active listening, analisis data, leadership', 'RA\r', NULL, NULL),
(173, '90148', 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif memberikan pendapat, memberi kesempatan untuk orang lain untuk berperan dan bertukar pikiran. Masih perlu belajar dan memahami industri retail.', 'Komunikasi aktif, pengalaman lebih banyak di dunia pendidikan namun potensial untuk menjadi talent.', 'https://drive.google.com/open?id=1apmI36o_flSFOEf5oi8s_jNOKS1x1AWL&usp=drive_fs', 'https://drive.google.com/open?id=1y4ZxdgXf8AT6aguOX2f77WhBEAbHP6jh&usp=drive_fs', 'Retail knowledge, leadership, analisis data', 'RA\r', NULL, NULL),
(174, '90145', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif dalam bertukar pikiran, memberikan jawaban yang relevan dengan topik yang dibahas. Analisis dan kepemimpinan masih bisa dikembangkan lebih lanjut.', 'Ada pengalaman handle customer, punya usaha online shop (kenal dengan distributor), punya kemauan untuk belajar handle customer dalam skala yang besar', 'https://drive.google.com/open?id=12IheNKTnpVhoWOwiaDnnapiNXs89w2OF&usp=drive_fs', 'https://drive.google.com/open?id=1KdXiNnTlKy3OlZdxfzejmOs9esQq4r2c&usp=drive_fs', 'Leadership, analisis data', 'RA\r', NULL, NULL),
(175, '90188', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Komunikasi aktif, kolaborasi dengan anggota tim lain cukup OK', 'Menunjukkan motivasi kerja yang baik dan pengalaman relevan, perlu ditingkatkan kepercayaan diri saat menjawab pertanyaan.', 'https://drive.google.com/open?id=17u6MQ__3OsuoD9czIpSdzCu65Q7aXOaG&usp=drive_fs', 'https://drive.google.com/open?id=1WlGz4d5RCQT8e4fiz-3wQm20rQlQekwQ&usp=drive_fs', '', 'RA\r', NULL, NULL),
(176, '90113', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '', 'Pengalaman sebagai SOA, punya masukan2 untuk pengembangan Gramedia Tlogomas. Punya potensi untuk pengembangan B2B dan networking. Dari pengalaman di sanggar tari punya potensi di leadership', 'https://drive.google.com/open?id=14Z8s0Vo4iTymC7xXzX0qznm87UHdfGsX&usp=drive_fs', 'https://drive.google.com/open?id=12mfr5Y1lD-TqVqt5ZAlSr2nr5uq7Oc9v&usp=drive_fs', 'Pengembangan networking lewat tugas B2B', 'VW\r', NULL, NULL),
(177, '90105', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', 'Pengalaman kerja saat di SOA Gramedia dan di perusahaan berikutnya. Terbiasa kerja dengan sistem target, target oriented, ada pengalaman mengarahkan anggota tim dalam achieve target dan strategi mencapai target penjualan.', 'https://drive.google.com/open?id=16tKhgtokOhnEIgkvVWQtbHCUkHyk1l91&usp=drive_fs', 'https://drive.google.com/open?id=162-spGmgRyiZBAmRAyMPVuIpCS7aMx2d&usp=drive_fs', 'perlu coaching leadership yang efektif ke team', 'VW\r', NULL, NULL),
(178, '90185', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Saat FGD ngelead jalannya diskusi dan aktif berpartisipasi', 'Fresh graduate, pengalaman dr organisasi di kampus dan intern', 'https://drive.google.com/open?id=1vNqpWTZ16DrXGp05oJAj_oCQsos797i2&usp=drive_fs', 'https://drive.google.com/open?id=10ix3zHSbkxso151FHHOvRK0BjwBh-x89&usp=drive_fs', 'sudah ada dasar2 di soft competencynya, diperkuat di technical skill yang dibutuhkan di retail', 'VW\r', NULL, NULL),
(179, '90263', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif dan baik dalam berkomunikasi', 'Penjelasan baik, komunikatif dan berpengalaman di toko retail', 'https://drive.google.com/file/d/1wQxYz2wRIsdPqoE4KcBw8ejJIiKwakN2/view?usp=sharing', 'https://drive.google.com/file/d/1OpGuxJzMoJ6_CAUTpF9gsv1sElduqBPR/view?usp=sharing', '', 'BILL\r', NULL, NULL),
(180, '90268', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Berpartisipasi dalam diskusi dengan kontribusi cukup, namun analisis, perencanaan, dan kepemimpinan masih pada tahap dasar. Menunjukkan kerja sama yang baik sebagai anggota tim.', 'Memiliki pemahaman tugas yang cukup baik, komunikatif namun perlu pendalaman soal rencana pengembangan diri.', 'https://drive.google.com/open?id=16K28ZtuL-bjmj4eT1PWo8BoT1MeJ4PdH&usp=drive_fs', 'https://drive.google.com/open?id=1XpsMUdY7fxoln-xqtRMYzCsxIyqJKlly&usp=drive_fs', '', 'RA\r', NULL, NULL),
(181, '90269', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Sikap kooperatif dalam FGD, kontribusi relatif seimbang namun belum menonjol.', 'Sikap positif dan kooperatif, namun jawaban masih umum; perlu memperkuat penjelasan terkait pencapaian sebelumnya.', 'https://drive.google.com/open?id=17YxLpM1c4Vk3k4JugmZyiveiZvTYne8K&usp=drive_fs', 'https://drive.google.com/open?id=1t-JkrrY32-s_n2wlW0plpi2X2PKNQVCw&usp=drive_fs', '', 'RA\r', NULL, NULL),
(182, '90266', 2, 2, 3, 3, 2, 2, 2, 2, 3, 3, 2, 2, 'Menunjukkan kemampuan perencanaan bisnis yang lebih baik dibanding aspek lain. Mampu mengambil peran memimpin diskusi, analisis dan kepemimpinan masih dapat ditingkatkan.', 'Memiliki pengalaman dan pemikiran yang matang di bidang business planning serta percaya diri memimpin tim.', 'https://drive.google.com/open?id=13DtkKsgIDOqCdXOjuKwJi024jv-WrM7z&usp=drive_fs', 'https://drive.google.com/open?id=1UvwT-ohU1sS7YWmU6YlHBBD3I_5JfIEU&usp=drive_fs', '', 'RA\r', NULL, NULL),
(183, '90334', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'BILL\r', NULL, NULL),
(184, '90332', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'DET\r', NULL, NULL),
(185, '90327', 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif sebagai anggota tim, namun kontribusi analisis dan perencanaan masih terbatas.', 'Menunjukkan sikap yang sopan dan mudah diajak bekerja sama, namun perlu penguatan dalam menyampaikan gagasan secara terstruktur.', 'https://drive.google.com/open?id=18ij57jGq68LzB2XcLlP5ssgBBeFw_xGV&usp=drive_fs', 'https://drive.google.com/open?id=19zbOkvzocoMAHQokSC37cUigCvWuoUyB&usp=drive_fs', 'Potensi berkembang jika dilatih dalam penyusunan ide dan strategi.', 'RA\r', NULL, NULL),
(186, '90328', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Menunjukkan partisipasi stabil dalam FGD. Perlu pengembangan dalam aspek kepemimpinan dan pengambilan keputusan.', 'Memiliki motivasi belajar yang baik dan pengalaman dasar yang relevan, perlu ditingkatkan kemampuan menganalisis situasi kerja.', 'https://drive.google.com/open?id=1ogIFgjNDNVdzEs_ZYpuDlmmVuVOQCQqO&usp=drive_fs', 'https://drive.google.com/open?id=1wocChnHzK0SnRUDjJ1x7OXT4r6yNKRt9&usp=drive_fs', '', 'RA\r', NULL, NULL),
(187, '90277', 2, 2, 3, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Mampu menyampaikan perencanaan bisnis dengan cukup baik. Perlu peningkatan kemampuan analisis dan peran kepemimpinan agar lebih menonjol.', 'Memiliki kemampuan yang stabil di semua aspek, namun perlu lebih proaktif dalam memberikan ide dan usulan untuk pengembangan tim.', 'https://drive.google.com/open?id=1fDjLL7VNoBJ0aS76lxkmFFOYDpVltdRW&usp=drive_fs', 'https://drive.google.com/open?id=1C5zsjCK1mOW7PTMlodPuX_qwWbhAriGW&usp=drive_fs', '', 'RA\r', NULL, NULL),
(188, '90341', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Komunikatif dan memberikan ide-ide pengembangan', 'Pegalaman di sosmed dan agency. cara menyampaikan ide jelas dan runut', 'https://drive.google.com/file/d/1IqfQDfKOUKQ4bxraPMLzVZ2aeStStR7N/view?usp=sharing', 'https://drive.google.com/file/d/1If1MU6qKJqczfIlvt6lIK9CpsVFdcZE6/view?usp=sharing', '', 'BILL\r', NULL, NULL),
(189, '90381', 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 'Cenderung bekerja sendiri dalam diskusi, analisis cukup, kontribusi analisis dan perencanaan masih bisa dikembangkan.', 'Sudah menunjukkan kerja sama yang baik sebagai anggota tim, tetapi masih perlu mengasah kemampuan analisis untuk pengambilan keputusan.', 'https://drive.google.com/open?id=1HeSA85rQjNdVZM5y8b0oWwcw83kEM98R&usp=drive_fs', 'https://drive.google.com/open?id=17DqFJis-_EFOvg4fwlXzuzjN-yHN7i_O&usp=drive_fs', 'Disarankan dilatih untuk lebih berkolaborasi dengan tim.', 'RA\r', NULL, NULL),
(190, '90384', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Berpartisipasi sebagai anggota tim dengan kontribusi rata-rata. Perlu penguatan pada kedalaman analisis dan inisiatif memimpin.', 'Memiliki dasar yang baik dalam analisis dan perencanaan, disarankan untuk lebih percaya diri dalam mengemukakan pendapat saat diskusi.', 'https://drive.google.com/open?id=1nqVILDJHUDVgs7YV3ZODo96lKD1iNytt&usp=drive_fs', 'https://drive.google.com/open?id=1A6xuUU2t07T55SgktqhWl7pHKOv4wHcN&usp=drive_fs', '', 'RA\r', NULL, NULL),
(191, '90385', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Kontribusi cukup OK, namun analisis dan perencanaan masih dasar. Berperan sebagai anggota tim yang kooperatif.', 'Menunjukkan potensi untuk berkembang, perlu diarahkan untuk meningkatkan keberanian dalam memimpin dan menyampaikan pandangan.', 'https://drive.google.com/file/d/1zF2tZ93PrzhBkG1NEm9LuqEWi5XkkfMK/view?usp=drive_link', 'https://drive.google.com/file/d/1JGFy4_LkVGaGTkkEXoP2PI9rGPEQ3DhZ/view?usp=drive_link', '', 'RA\r', NULL, NULL),
(192, '90394', 0, 0, 0, 0, 0, 0, 2, 2, 2, 2, 1, 1, 'tidak FGD karena seleksi sendirian', 'Perlu dikembangkan di leadershipnya', 'https://drive.google.com/open?id=1LXY51O2sPV09PnyL0Qi_1zcgXAHsaYO5&usp=drive_fs', 'https://drive.google.com/open?id=19ArhpNB-YpleSTevrAb1dLFo0VFVPv96&usp=drive_fs', 'Lebih dikembangkan di leadershipnya', 'VW\r', NULL, NULL),
(193, '90418', 2, 2, 3, 3, 2, 2, 2, 2, 2, 2, 2, 2, 'Menunjukkan kemampuan business planning yang baik, berpotensi memimpin diskusi. Perlu penguatan pada analisis dan kepemimpinan agar lebih konsisten.', 'Stabil dalam kemampuan teknis dan perencanaan, disarankan untuk meningkatkan kemampuan mempengaruhi anggota tim lain dalam mencapai tujuan bersama.', 'https://drive.google.com/open?id=1iVr98tNvZnQ4hrTx3l26UltUjebdVwJ9&usp=drive_fs', 'https://drive.google.com/open?id=1r9cevdka0rVdIg9CKtQgXm79hHOMeaJ-&usp=drive_fs', '', 'RA\r', NULL, NULL),
(194, '90482', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'Cenderung bekerja sendiri, kontribusi kepemimpinan rendah. Perlu dilatih kolaborasi tim dan keberanian menyampaikan pendapat.', 'Cenderung bekerja sendiri dan kurang kolaboratif (1), perlu pembinaan dalam kerja sama tim dan komunikasi agar lebih efektif dalam memimpin.', 'https://drive.google.com/open?id=1NczufjU_yddPhJWabfMgXvGhcqLhJ68o&usp=drive_fs', 'https://drive.google.com/open?id=1GHWv4nA0FHxuqHADIf9Zh0bcCQwNcisV&usp=drive_fs', '', 'RA\r', NULL, NULL),
(195, '90413', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Partisipasi rata-rata sebagai anggota tim, kontribusi relevan namun tidak menonjol. Potensi masih perlu dikembangkan.', 'Sudah bekerja baik dalam tim namun masih perlu melatih kemampuan memimpin saat diperlukan.', 'https://drive.google.com/open?id=1rd9Szb8qUDoQjAIVLiEbfh9ynoVBVEsG&usp=drive_fs', 'https://drive.google.com/open?id=1s17uUqxF01GBYWwS3XQVZiWROrwZjOZK&usp=drive_fs', '', 'RA\r', NULL, NULL);
INSERT INTO `introductions` (`id`, `nik`, `fgd_analytic_score`, `fgd_analytic_level_id`, `fgd_business_score`, `fgd_business_level_id`, `fgd_leadership_score`, `fgd_leadership_level_id`, `interview_analytic_score`, `interview_analytic_level_id`, `interview_business_score`, `interview_business_level_id`, `interview_leadership_score`, `interview_leadership_level_id`, `fgd_note`, `interview_note`, `mcu`, `psikotes`, `rekomendasi`, `pic`, `created_at`, `updated_at`) VALUES
(196, '90459', 2, 2, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 'Aktif mendukung jalannya diskusi, memberikan kontribusi sederhana. Analisis dan kepemimpinan masih perlu penguatan.', 'Memiliki kecenderungan bekerja sendiri (1), perlu dorongan untuk lebih aktif berinteraksi dan berkolaborasi dengan tim.', 'https://drive.google.com/open?id=1uL2_U-q3XXy3Ka7rvfiav00CRA7zTkzC&usp=drive_fs', 'https://drive.google.com/open?id=16l84QB1E72k5vV1JpD2UgWQYApv92jle&usp=drive_fs', '', 'RA\r', NULL, NULL),
(197, '90521', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Memimpin jalannya diskusi dan memberikan ide-ide terkait kolaborasi', 'Komunikasi oke, memiliki pengalaman di sales dan penjualan B2B', 'https://drive.google.com/file/d/18khK_9UfLiOXxlZhbkRHe5goQqWbj3Kf/view?usp=sharing', 'https://drive.google.com/file/d/1XzgD8t7zHUgS4gAFmhPUrX0W38GA5iCE/view?usp=sharing', '', 'BILL\r', NULL, NULL),
(198, '90488', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Ngelead FGD', 'Sudah pengalaman di retail, sudah nampak dr sisi leadership, analisa dan strategi', 'https://drive.google.com/open?id=1XhIxDWFISCLJvPVZ6kUkKCkKpbbaqjRE&usp=drive_fs', 'https://drive.google.com/open?id=1KfuqxT5SpcjZp8rZUbECBOzKF0NYxLn1&usp=drive_fs', 'Lebih banyak belajar technicak skill yg dibutuhkan sebagai SS Gramedia', 'VW\r', NULL, NULL),
(199, '90551', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Komunikatif dan memimpin jalannya diskusi', 'Memiliki pengalaman di Marketing dan marketplace. Komunikasinya oke', 'https://drive.google.com/file/d/1kjlhksh4-pQlZwnk_9ORPJGMR-Gdnyee/view?usp=drive_link', 'https://drive.google.com/file/d/1BfX1sbNKMsj8j6EgwGH5-fHjJlC8xCSP/view?usp=drive_link', '', 'BILL\r', NULL, NULL),
(200, '90550', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif dan berkomunikasi dengan baik', 'Punya pengalaman di Marketing, melakukan UpSelling dan penjualan serta pelayanan sebagai Customer Service.', 'https://drive.google.com/file/d/1IN8FV7OzZobyqT0TOIrm59DEX-eeWcLj/view?usp=sharing', 'https://drive.google.com/file/d/1Tl4dGRyW43KFY4J-93RptCjqJTJjIF2t/view?usp=sharing', '', 'BILL\r', NULL, NULL),
(201, '90520', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 'Cukup kooperatif dalam FGD, pendapat masih terbatas. Perlu dilatih dalam menyusun ide lebih terstruktur.', 'Memiliki potensi kepemimpinan yang cukup baik, disarankan untuk melatih kemampuan membuat keputusan yang lebih cepat dan tepat.', 'https://drive.google.com/open?id=1eEJEAYScYR0UDFTOC15dzzShc0DDj_4I&usp=drive_fs', 'https://drive.google.com/open?id=1Cus-xnqybkv6vpMUjU5rFBkEAU1z7_YH&usp=drive_fs', '', 'RA\r', NULL, NULL),
(202, '90598', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'DTA\r', NULL, NULL),
(203, '90603', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'Cukup aktif dalam diskusi', 'Bisa analisa dan strategi, leadership perlu dikembangkan lagi. pengalaman di organisasi yg bisa dikembangkan untuk dasar leadership', 'https://drive.google.com/open?id=1F2sMLU4vffmoHF-LddjsLE-5sLqw38wn&usp=drive_fs', 'https://drive.google.com/open?id=10IjOS1nvT6dyxa4M-c9RbcAQ20Fraqsu&usp=drive_fs', 'Coaching di leadershipnya', 'VW\r', NULL, NULL),
(204, '90593', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif saat diskusi cukup membantu ngelead', 'background dari IT kuat di analisa', 'https://drive.google.com/open?id=1E9PZIykUrm7rH2E7wkV4hS8NJ9tJdUFE&usp=drive_fs', 'https://drive.google.com/open?id=1QYUrkFvCBftjlfsBTyKdM4w8opNlP5Z0&usp=drive_fs', '', 'VW\r', NULL, NULL),
(205, '90596', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Kontribusi minimal dalam analisis dan perencanaan, perlu meningkatkan inisiatif dan partisipasi aktif.', 'Konsisten bekerja dengan baik, namun masih perlu mengasah kemampuan analisis untuk meningkatkan kualitas pengambilan keputusan.', '', '', '', 'RA\r', NULL, NULL),
(206, '90599', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'Aktif saat diskusi cukup membantu ngelead', 'leadership perlu dikembangkan lagi', 'https://drive.google.com/open?id=1He54vr6GW28VNm_dLoLdtBEvUwi22ajN&usp=drive_fs', 'https://drive.google.com/open?id=18m2XQn23WhmntnyEIDpzHtI_UWKTmcR-&usp=drive_fs', 'coaching di leadershipnya', 'VW\r', NULL, NULL),
(207, '90601', 2, 2, 2, 2, 3, 3, 2, 2, 2, 2, 3, 3, 'Mampu memimpin diskusi dan menyusun perencanaan dengan baik, analisis masih perlu penguatan.', 'Menunjukkan potensi sebagai pemimpin (3), perlu diarahkan agar lebih konsisten dalam mengelola tim dan mengembangkan anggota.', 'https://drive.google.com/open?id=100iqdz6Sr93VB_Xx0FYrnaKI4N8pyaeX&usp=drive_fs', 'https://drive.google.com/open?id=1EeEKvDTxj8tlD3bhMFss7SWs1d3WXlug&usp=drive_fs', '', 'RA\r', NULL, NULL),
(208, '90609', 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 2, 2, 'Berperan sebagai anggota tim, partisipasi cukup namun tidak menonjol, perlu dilatih lebih aktif dan berani berpendapat.', 'Aktif dalam bekerja sama namun masih perlu percaya diri dalam memimpin diskusi atau mengambil keputusan.', 'https://drive.google.com/open?id=1jsDIsB_gUnGaMU5eaxWMdkk6dxJC_He3&usp=drive_fs', 'https://drive.google.com/open?id=1BHPa6cu8t1cZgaYymOEGbIXMC1vsnssi&usp=drive_fs', '', 'RA\r', NULL, NULL),
(209, '90610', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 'cukup aktif saat diskusi', 'sudah pengalaman di retail dan ada ide2 yg bisa diterapkan di toko, leadership perlu dikembangkan lagi', 'https://drive.google.com/open?id=1840UHYUUy0B1GREbRNSyFE5aHX3aNCUf&usp=drive_fs', 'https://drive.google.com/open?id=1hqioJOZLEGkf8JTX8w5l2UG06qngyf0c&usp=drive_fs', 'coaching di leadership', 'VW\r', NULL, NULL),
(210, '90755', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif memberi masukan selama jalannya FGD', 'masih freshgraduate, punya kemampuan analisa,punya ide dan strategi pengembangan bisnis di toko. leadership perlu dikembangkan di toko', 'https://drive.google.com/file/d/108dLxrHe0BwRQFJENQy-nBwc99FC37xr/view?usp=drive_link', 'https://drive.google.com/file/d/1W_6U4hySb0MYMP4i_td5KqhMTiBiz04n/view?usp=drive_link', 'Potensial untuk dikembangkan meski masih freshgraduate. Keinginan belajarnya tinggi. Belajar operasional di store, pemahaman KPI yg jadi target dan bagaimana ngelead tim', 'VW\r', NULL, NULL),
(211, '90694', 2, 2, 3, 3, 2, 2, 2, 2, 2, 2, 3, 3, 'Memiliki kemampuan business planning yang baik dan berani memimpin, perlu peningkatan konsistensi pada aspek lain.', 'Memiliki kemampuan perencanaan bisnis yang baik dan potensi kepemimpinan (3), disarankan meningkatkan konsistensi dan ketegasan saat mengarahkan tim.', 'https://drive.google.com/open?id=1OcYIhBiy1JPFENYzt1_GxPcZxXuL9hsR&usp=drive_fs', 'https://drive.google.com/open?id=1xB2PBsj69oMh9IMIhK0-JpBFOH8OkY0l&usp=drive_fs', '', 'RA\r', NULL, NULL),
(212, '90751', 2, 2, 1, 1, 3, 3, 2, 2, 2, 2, 2, 2, 'Lebih suka bekerja sendiri namun punya potensi memimpin jika diarahkan, perlu pembinaan kolaborasi dan komunikasi.', 'Memiliki kemampuan analitis yang cukup baik, dapat bekerja sama dalam tim, disarankan untuk lebih percaya diri dalam menyampaikan ide.', 'https://drive.google.com/open?id=1risKl4R-ozbYybEAgEBuheMM_si-B5lS&usp=drive_fs', 'https://drive.google.com/open?id=12s6OKlbVItB7TEcE5WrJuV5zrz4z7iCt&usp=drive_fs', 'Ikut pelatihan presentation skill untuk meningkatkan kepercayaan diri. Dilibatkan dalam diskusi tim untuk lebih aktif menyampaikan pandangan.', 'RA\r', NULL, NULL),
(213, '90624', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'ngelead diskusi', 'dari pengalaman kerja sebelumnya membentuk kemampuan di analisa, strategi dan leadershipnya', 'https://drive.google.com/open?id=1utPVyqfNKBQhubkuL32kPcqiUOvCbhh1&usp=drive_fs', 'https://drive.google.com/open?id=1xR_48620zWwTFhr55IUr6U2M20g_5T4l&usp=drive_fs', 'Sudah ada dasar2 soft competency yg dibutuhkan, diperkuat di technical skill retail', 'VW\r', NULL, NULL),
(214, '90769', 3, 3, 2, 2, 2, 2, 2, 2, 3, 3, 2, 2, 'Memiliki kemampuan analitis yang baik dan mampu memimpin diskusi, namun masih perlu mengasah komunikasi agar lebih inklusif pada anggota tim.', 'Menunjukkan potensi sebagai pemimpin (3) pada aspek perencanaan bisnis, disarankan untuk mengasah kemampuan komunikasi agar dapat mengarahkan tim lebih efektif.', 'https://drive.google.com/open?id=1Dx7zIw3QmAbGfJelkGSI_Pb3u9K_gGeM&usp=drive_fs', 'https://drive.google.com/open?id=1xTq6mRvlb4OhjX3jlnTim5-I-ve8GQ34&usp=drive_fs', 'Mendapat coaching kepemimpinan dan komunikasi antar tim.\r\n', 'RA\r', NULL, NULL),
(215, '90767', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Partisipasi baik sebagai anggota tim, namun kontribusi ide masih terbatas; perlu dilatih untuk lebih proaktif dalam analisis dan perencanaan.', 'Stabil dalam kemampuan analisis dan perencanaan, namun masih perlu meningkatkan keaktifan dalam memberikan inisiatif di tim.', 'https://drive.google.com/open?id=1MZ6-Nox86DGk-TLJCXJX2rnlz2As0Bqq&usp=drive_fs', 'https://drive.google.com/open?id=1tI2NASGlOcJskvdn7TTnGMlWmLzJvD4s&usp=drive_fs', 'Mengikuti pelatihan critical thinking untuk memperkuat kontribusi dalam pengambilan keputusan.', 'RA\r', NULL, NULL),
(216, '90766', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Kooperatif dan mendukung jalannya diskusi, namun perlu penguatan dalam mengemukakan pendapat dan menyusun solusi yang terstruktur.', 'Cukup baik dalam bekerja sama, perlu lebih percaya diri dalam memberikan pendapat dan memimpin saat diperlukan.', 'https://drive.google.com/open?id=1mpVx_ziPh6FUsYkJuXYWPjlnqy5msCrZ&usp=drive_fs', 'https://drive.google.com/open?id=1HZluRWpcJqcKEefUNDP3Wd87c0vhcPCK&usp=drive_fs', 'Ikut workshop tentang komunikasi asertif.', 'RA\r', NULL, NULL),
(217, '90772', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Aktif sebagai anggota tim namun kontribusi masih umum; perlu ditingkatkan kemampuan analisis dan keberanian untuk mengambil inisiatif.', 'Memiliki potensi yang baik dalam bekerja sama, disarankan untuk mengembangkan kemampuan dalam berpikir strategis.', 'https://drive.google.com/open?id=1gGRE5PRiHvrbifbn1dyHLkvKn1qem9UA&usp=drive_fs', 'https://drive.google.com/open?id=1xsDlazSEBfnOMR2aQYIV2SohmR-wddgK&usp=drive_fs', 'Mengikuti pelatihan perencanaan bisnis dasar.', 'RA\r', NULL, NULL),
(218, '90788', 2, 2, 3, 3, 2, 2, 3, 3, 2, 2, 2, 2, 'Menunjukkan kemampuan business planning yang cukup baik dan berani memimpin, namun perlu meningkatkan keterampilan mendengarkan anggota tim.', 'Menunjukkan potensi kepemimpinan (3) terutama dalam analitis, disarankan untuk terus mengasah kemampuan kolaborasi agar kepemimpinannya semakin solid.', 'https://drive.google.com/open?id=1gFN2al3G2XL4CvrKE8Wjn9ZnHsXeodq4&usp=drive_fs', 'https://drive.google.com/open?id=1W-n84ROHlH-TZqEpsZ6I_IB8ZMr03r_i&usp=drive_fs', 'Mengikuti pelatihan 3ship & collaborative management.', 'RA\r', NULL, NULL),
(219, '87724', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 'selama FGD Reni aktif memberi masukan ke peserta lain, terkait penyelesaian kasus, ide-ide pengembangan buat store, dan ikut aktif mengarahkan jalannya diskusi', 'Reni dapat memaparkan target-target dan strategi pencapaian yg harus dicapai selama membantu mengelola bisnis keluarga di bidang marketplace penjualan tas. Di leadership tidak terlalu tampak karena sifatnya bisnis keluarga', 'https://drive.google.com/file/d/11NIK2OJFUPKYN1MAL5mPc3K3KxPn70Uf/view?usp=sharing', 'https://drive.google.com/file/d/11UoGXa5Z2hIZxcyPCDLFQO6qsx_SvPtU/view?usp=drive_link', 'Akses materi2 terkait leadership, supervisory skill dan soft/technical competency lain di Kognisi\r\n\r\nMelakukan diskusi dengan Store Manager untuk pengembangan pribadi', 'VW\r', NULL, NULL),
(220, '90844', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'selama FGD Lintang aktif memberi masukan ke peserta lain, terkait penyelesaian kasus, dan ikut aktif mengarahkan jalannya diskusi', 'Lintang aktif dalam berbagai kegiatan organisasi dan yg melatihnya mengembangkan analisa dan strategi. Punya ide2 untuk pengembangan di Toko Gramedia', 'https://drive.google.com/file/d/1K36YycQbE4gj8mWKb9QGU97IBRlbqKsh/view?usp=drive_link', 'https://drive.google.com/file/d/1lia9p892QYRBWMCgm5ulrqdAkoyiT9tX/view?usp=drive_link', 'Coaching supaya menguasai operasional store', 'VW\r', NULL, NULL),
(221, '90883', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(222, '4844', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(223, '90833', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(224, '6311', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(225, '90835', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(226, '6306', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(227, '90927', 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, '', '', 'https://drive.google.com/open?id=1gTFTNgROtKTRV6OPpvKzPuIzEI1I-CIg&usp=drive_fs', 'https://drive.google.com/open?id=1orSgDBj_Z_Kj3l-IUc_AecfhLgZYlEBY&usp=drive_fs', '', 'RA\r', NULL, NULL),
(228, '90888', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 'Wira aktif dalam jalannya FGD dan memberikan ide ke peserta lain, ikut bantu ngelead jalannya diskusi', 'Wira aktif secara pribadi sebagai KOL Tiktok dan mengelola KOL di perusahaan2 sebelumnya. Punya ide2 untuk pengembangan digital marketing Gramedia', 'https://drive.google.com/file/d/1nUWj49SpfGBK9gPTzLJNW9aciTn_iN3V/view?usp=drive_link', 'https://drive.google.com/file/d/1qZYlbppNFEi413wc3XqsT32-eSPAi0S-/view?usp=drive_link', 'Coaching operasional toko', 'VW\r', NULL, NULL),
(229, '91007', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(230, '90862', 0, 0, 0, 0, 0, 0, 2, 2, 2, 2, 2, 2, 'tidak FGD, kandidat satu2nya', 'dengan bekal pengalaman sebagai SOA Fadhli punya gambaran apa yang perlu dilakukan sebagai SS ', 'https://drive.google.com/file/d/1dZAtavDdaTELHogGct5dmLRoiMMAezBU/view?usp=drive_link', 'https://drive.google.com/file/d/1Rrb8zL8_SKIBq3rNASRn3t35gn3Eo0sn/view?usp=sharing', '', 'VW\r', NULL, NULL),
(231, '1340', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '\r', NULL, NULL),
(232, '90928', 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 23:29:45'),
(239, '12587', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 20:05:13', '2025-12-04 20:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `section_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sales Superintendent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lone Ranger', '2025-12-03 06:06:53', '2025-12-03 06:06:53'),
(2, 'Team Player', '2025-12-03 06:06:53', '2025-12-03 06:06:53'),
(3, 'Team Leader', '2025-12-03 06:06:53', '2025-12-03 06:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_27_022035_create_employees_table', 1),
(5, '2025_11_27_022036_create_positions_table', 1),
(6, '2025_11_27_022036_create_stores_table', 1),
(7, '2025_11_27_022037_create_employee_details_table', 1),
(8, '2025_11_27_064400_create_regions_table', 2),
(9, '2025_11_27_064404_create_sections_table', 2),
(10, '2025_11_27_064405_create_jobs_table', 3),
(11, '2025_11_27_064406_create_stores_table', 3),
(12, '2025_11_27_064407_create_employees_table', 3),
(13, '2025_12_01_075053_add_role_to_users_table', 4),
(14, '2025_12_04_084807_add_unique_to_nik_in_introductions_table', 5),
(15, '2025_12_05_070811_create_checklist_templates_table', 6),
(16, '2025_12_05_070836_create_onboarding_checklists_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `onboarding_checklists`
--

CREATE TABLE `onboarding_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `week` int(10) UNSIGNED NOT NULL,
  `checklist_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`checklist_json`)),
  `notes_store_manager` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `notes_hr` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `onboarding_checklists`
--

INSERT INTO `onboarding_checklists` (`id`, `employee_id`, `month`, `week`, `checklist_json`, `notes_store_manager`, `status`, `notes_hr`, `created_at`, `updated_at`) VALUES
(2, '85830', 1, 2, '{\r\n        \"week\": 2,\r\n        \"title\": \"Mentoring 1\",\r\n        \"items\": [\r\n            { \"id\": \"m1w2_i1\", \"text\": \"Penjelasan struktur organisasi GoRP\", \"checked\": true },\r\n            { \"id\": \"m1w2_i2\", \"text\": \"Penjelasan peraturan perusahaan\", \"checked\": false },\r\n            { \"id\": \"m1w2_i3\", \"text\": \"Penjelasan nilai Kompas Gramedia (5C)\", \"checked\": true }\r\n        ],\r\n        \"mandatory_tasks\": [\r\n            { \"id\": \"m1w2_t1\", \"text\": \"Mempelajari Microsoft Power BI\", \"checked\": true },\r\n            { \"id\": \"m1w2_t2\", \"text\": \"Mempelajari produk internal & eksternal\", \"checked\": false }\r\n        ]\r\n    }', 'Butuh pendampingan terkait materi 5C.', 'pending', 'Good progress so far.', '2025-12-05 09:52:43', '2025-12-08 02:11:52'),
(4, '84576', 1, 4, '{\r\n        \"week\": 4,\r\n        \"title\": \"Mentoring 2\",\r\n        \"items\": [\r\n            { \"id\": \"m1w4_i1\", \"text\": \"Review dinamika kerja bulan pertama\", \"checked\": false },\r\n            { \"id\": \"m1w4_i2\", \"text\": \"Sharing tantangan & peluang\", \"checked\": false }\r\n        ],\r\n        \"mandatory_tasks\": [\r\n            { \"id\": \"m1w4_t1\", \"text\": \"Mempelajari Problem Solving\", \"checked\": true },\r\n            { \"id\": \"m1w4_t2\", \"text\": \"Mempelajari Retail Salesmanship\", \"checked\": true },\r\n            { \"id\": \"m1w4_t3\", \"text\": \"Mempelajari Customer Service & Loyalty\", \"checked\": false }\r\n        ]\r\n    }', 'Masih kurang percaya diri dalam salesmanship.', 'pending', 'Tindak lanjuti materi service.', '2025-12-05 09:52:43', '2025-12-05 09:52:43'),
(6, '90009', 2, 2, '{\r\n        \"week\": 2,\r\n        \"title\": \"Deep Dive Learning\",\r\n        \"items\": [\r\n            { \"id\": \"m2w2_i1\", \"text\": \"Diskusi materi dengan supervisor\", \"checked\": true },\r\n            { \"id\": \"m2w2_i2\", \"text\": \"Review penugasan bulan sebelumnya\", \"checked\": true }\r\n        ],\r\n        \"mandatory_tasks\": [\r\n            { \"id\": \"m2w2_t1\", \"text\": \"Mengerjakan latihan modul operational\", \"checked\": false }\r\n        ]\r\n    }', NULL, 'pending', 'Bagus, sudah memahami hampir seluruh materi.', '2025-12-05 09:52:43', '2025-12-05 09:52:43'),
(10, '77491', 1, 1, '{ \"week\":1, \"title\":\"INTRODUCTION\", \"items\":[ {\"id\":\"m1w1_i1\",\"text\":\"Fasilitas kerja (meja kerja, alat kerja, dan lain-lain)\",\"checked\":true}, {\"id\":\"m1w1_i2\",\"text\":\"ID Card (Pengajuan ke PA/diberikan kalau sudah ada)\",\"checked\":true}, {\"id\":\"m1w1_i3\",\"text\":\"Pengenalan lingkungan kerja melalui office tour, struktur organisasi store, & perkenalan dengan rekan kerja\",\"checked\":true}, {\"id\":\"m1w1_i4\",\"text\":\"Prolog mengenai karyawan akan melakukan EOB\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w1_t1\",\"text\":\"Mengakses New Employee Orientation Training (NEO-T) di Koginisi\",\"checked\":false}, {\"id\":\"m1w1_t2\",\"text\":\"Mempelajari struktur organisasi GoRP, Peraturan Perusahaan, dan Jobdesc (checklist)\",\"checked\":false}, {\"id\":\"m1w1_t3\",\"text\":\"Melakukan observasi dinamika kerja\",\"checked\":true}, {\"id\":\"m1w1_t4\",\"text\":\"Mempelajari Gramedia Daily\'s Store dan mengerjakan post test\",\"checked\":true} ] }', NULL, 'approved', NULL, '2025-12-08 09:47:20', '2025-12-08 03:53:29'),
(11, '77491', 1, 2, '{ \"week\":2, \"title\":\"Mentoring 1\", \"items\":[ {\"id\":\"m1w2_i1\",\"text\":\"Penjelasan struktur organisasi GoRP\",\"checked\":false}, {\"id\":\"m1w2_i2\",\"text\":\"Penjelasan peraturan perusahaan\",\"checked\":false}, {\"id\":\"m1w2_i3\",\"text\":\"Penjelasan lebih detail tentang nilai Kompas Gramedia (5C)\",\"checked\":false}, {\"id\":\"m1w2_i4\",\"text\":\"Penjelasan tentang KPI, Matriks Kerja, SOP, ruang lingkup kerja\",\"checked\":false}, {\"id\":\"m1w2_i5\",\"text\":\"Penjelasan detail peran dan tanggung jawab SS secara detail\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w2_t1\",\"text\":\"Mempelajari Microsoft Power BI\",\"checked\":false}, {\"id\":\"m1w2_t2\",\"text\":\"Mempelajari produk-produk internal & eksternal Gramedia secara umum\",\"checked\":false}, {\"id\":\"m1w2_t3\",\"text\":\"Mempelajari Organization Structure, Gramedia Management System, Business Retail Concept\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:47:20', '2025-12-08 03:53:29'),
(12, '77491', 1, 3, '{ \"week\":3, \"title\":\"Activity Checking with Buddy\", \"items\":[], \"mandatory_tasks\":[ {\"id\":\"m1w3_t1\",\"text\":\"Mempelajari Supervisory Skill dan/atau Agile Leadership in Retail\",\"checked\":false}, {\"id\":\"m1w3_t2\",\"text\":\"Mempelajari Team Management\",\"checked\":false}, {\"id\":\"m1w3_t3\",\"text\":\"Mempelajari Coaching & Counselling\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:47:20', '2025-12-08 03:53:29'),
(13, '77491', 1, 4, '{ \"week\":4, \"title\":\"Mentoring 2\", \"items\":[ {\"id\":\"m1w4_i1\",\"text\":\"Review dinamika/pengalaman kerja selama 1 bulan\",\"checked\":false}, {\"id\":\"m1w4_i2\",\"text\":\"Sharing tantangan dan peluang yang akan dihadapi\",\"checked\":false}, {\"id\":\"m1w4_i3\",\"text\":\"Follow up hasil pembelajaran Microsoft Power BI dan product knowledge\",\"checked\":false}, {\"id\":\"m1w4_i4\",\"text\":\"Arahan untuk mempelajari materi learning sesuai checklist EOB\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w4_t1\",\"text\":\"Mempelajari Problem Solving & Decision Making\",\"checked\":false}, {\"id\":\"m1w4_t2\",\"text\":\"Mempelajari Retail Salesmanship\",\"checked\":false}, {\"id\":\"m1w4_t3\",\"text\":\"Mempelajari Customer Service & Loyalty, Standar Sikap Pelayanan, Grooming and Professional Appearance\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:47:20', '2025-12-08 03:53:29'),
(14, '3765', 1, 1, '{ \"week\":1, \"title\":\"INTRODUCTION\", \"items\":[ {\"id\":\"m1w1_i1\",\"text\":\"Fasilitas kerja (meja kerja, alat kerja, dan lain-lain)\",\"checked\":false}, {\"id\":\"m1w1_i2\",\"text\":\"ID Card (Pengajuan ke PA/diberikan kalau sudah ada)\",\"checked\":false}, {\"id\":\"m1w1_i3\",\"text\":\"Pengenalan lingkungan kerja melalui office tour, struktur organisasi store, & perkenalan dengan rekan kerja\",\"checked\":false}, {\"id\":\"m1w1_i4\",\"text\":\"Prolog mengenai karyawan akan melakukan EOB\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w1_t1\",\"text\":\"Mengakses New Employee Orientation Training (NEO-T) di Koginisi\",\"checked\":false}, {\"id\":\"m1w1_t2\",\"text\":\"Mempelajari struktur organisasi GoRP, Peraturan Perusahaan, dan Jobdesc (checklist)\",\"checked\":false}, {\"id\":\"m1w1_t3\",\"text\":\"Melakukan observasi dinamika kerja\",\"checked\":false}, {\"id\":\"m1w1_t4\",\"text\":\"Mempelajari Gramedia Daily\'s Store dan mengerjakan post test\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:48:38', '2025-12-08 02:54:20'),
(15, '3765', 1, 2, '{ \"week\":2, \"title\":\"Mentoring 1\", \"items\":[ {\"id\":\"m1w2_i1\",\"text\":\"Penjelasan struktur organisasi GoRP\",\"checked\":false}, {\"id\":\"m1w2_i2\",\"text\":\"Penjelasan peraturan perusahaan\",\"checked\":false}, {\"id\":\"m1w2_i3\",\"text\":\"Penjelasan lebih detail tentang nilai Kompas Gramedia (5C)\",\"checked\":false}, {\"id\":\"m1w2_i4\",\"text\":\"Penjelasan tentang KPI, Matriks Kerja, SOP, ruang lingkup kerja\",\"checked\":false}, {\"id\":\"m1w2_i5\",\"text\":\"Penjelasan detail peran dan tanggung jawab SS secara detail\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w2_t1\",\"text\":\"Mempelajari Microsoft Power BI\",\"checked\":false}, {\"id\":\"m1w2_t2\",\"text\":\"Mempelajari produk-produk internal & eksternal Gramedia secara umum\",\"checked\":false}, {\"id\":\"m1w2_t3\",\"text\":\"Mempelajari Organization Structure, Gramedia Management System, Business Retail Concept\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:48:38', '2025-12-08 02:54:20'),
(16, '3765', 1, 3, '{ \"week\":3, \"title\":\"Activity Checking with Buddy\", \"items\":[], \"mandatory_tasks\":[ {\"id\":\"m1w3_t1\",\"text\":\"Mempelajari Supervisory Skill dan/atau Agile Leadership in Retail\",\"checked\":false}, {\"id\":\"m1w3_t2\",\"text\":\"Mempelajari Team Management\",\"checked\":false}, {\"id\":\"m1w3_t3\",\"text\":\"Mempelajari Coaching & Counselling\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:48:38', '2025-12-08 02:54:20'),
(17, '3765', 1, 4, '{ \"week\":4, \"title\":\"Mentoring 2\", \"items\":[ {\"id\":\"m1w4_i1\",\"text\":\"Review dinamika/pengalaman kerja selama 1 bulan\",\"checked\":false}, {\"id\":\"m1w4_i2\",\"text\":\"Sharing tantangan dan peluang yang akan dihadapi\",\"checked\":false}, {\"id\":\"m1w4_i3\",\"text\":\"Follow up hasil pembelajaran Microsoft Power BI dan product knowledge\",\"checked\":false}, {\"id\":\"m1w4_i4\",\"text\":\"Arahan untuk mempelajari materi learning sesuai checklist EOB\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w4_t1\",\"text\":\"Mempelajari Problem Solving & Decision Making\",\"checked\":false}, {\"id\":\"m1w4_t2\",\"text\":\"Mempelajari Retail Salesmanship\",\"checked\":false}, {\"id\":\"m1w4_t3\",\"text\":\"Mempelajari Customer Service & Loyalty, Standar Sikap Pelayanan, Grooming and Professional Appearance\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:48:38', '2025-12-08 02:54:20'),
(18, '73544', 1, 1, '{ \"week\":1, \"title\":\"INTRODUCTION\", \"items\":[ {\"id\":\"m1w1_i1\",\"text\":\"Fasilitas kerja (meja kerja, alat kerja, dan lain-lain)\",\"checked\":false}, {\"id\":\"m1w1_i2\",\"text\":\"ID Card (Pengajuan ke PA/diberikan kalau sudah ada)\",\"checked\":false}, {\"id\":\"m1w1_i3\",\"text\":\"Pengenalan lingkungan kerja melalui office tour, struktur organisasi store, & perkenalan dengan rekan kerja\",\"checked\":false}, {\"id\":\"m1w1_i4\",\"text\":\"Prolog mengenai karyawan akan melakukan EOB\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w1_t1\",\"text\":\"Mengakses New Employee Orientation Training (NEO-T) di Koginisi\",\"checked\":false}, {\"id\":\"m1w1_t2\",\"text\":\"Mempelajari struktur organisasi GoRP, Peraturan Perusahaan, dan Jobdesc (checklist)\",\"checked\":false}, {\"id\":\"m1w1_t3\",\"text\":\"Melakukan observasi dinamika kerja\",\"checked\":false}, {\"id\":\"m1w1_t4\",\"text\":\"Mempelajari Gramedia Daily\'s Store dan mengerjakan post test\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:49:49', '2025-12-08 03:38:18'),
(19, '73544', 1, 2, '{ \"week\":2, \"title\":\"Mentoring 1\", \"items\":[ {\"id\":\"m1w2_i1\",\"text\":\"Penjelasan struktur organisasi GoRP\",\"checked\":false}, {\"id\":\"m1w2_i2\",\"text\":\"Penjelasan peraturan perusahaan\",\"checked\":false}, {\"id\":\"m1w2_i3\",\"text\":\"Penjelasan lebih detail tentang nilai Kompas Gramedia (5C)\",\"checked\":false}, {\"id\":\"m1w2_i4\",\"text\":\"Penjelasan tentang KPI, Matriks Kerja, SOP, ruang lingkup kerja\",\"checked\":false}, {\"id\":\"m1w2_i5\",\"text\":\"Penjelasan detail peran dan tanggung jawab SS secara detail\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w2_t1\",\"text\":\"Mempelajari Microsoft Power BI\",\"checked\":false}, {\"id\":\"m1w2_t2\",\"text\":\"Mempelajari produk-produk internal & eksternal Gramedia secara umum\",\"checked\":false}, {\"id\":\"m1w2_t3\",\"text\":\"Mempelajari Organization Structure, Gramedia Management System, Business Retail Concept\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:49:49', '2025-12-08 03:38:18'),
(20, '73544', 1, 3, '{ \"week\":3, \"title\":\"Activity Checking with Buddy\", \"items\":[], \"mandatory_tasks\":[ {\"id\":\"m1w3_t1\",\"text\":\"Mempelajari Supervisory Skill dan/atau Agile Leadership in Retail\",\"checked\":false}, {\"id\":\"m1w3_t2\",\"text\":\"Mempelajari Team Management\",\"checked\":false}, {\"id\":\"m1w3_t3\",\"text\":\"Mempelajari Coaching & Counselling\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:49:49', '2025-12-08 03:38:18'),
(21, '73544', 1, 4, '{ \"week\":4, \"title\":\"Mentoring 2\", \"items\":[ {\"id\":\"m1w4_i1\",\"text\":\"Review dinamika/pengalaman kerja selama 1 bulan\",\"checked\":false}, {\"id\":\"m1w4_i2\",\"text\":\"Sharing tantangan dan peluang yang akan dihadapi\",\"checked\":false}, {\"id\":\"m1w4_i3\",\"text\":\"Follow up hasil pembelajaran Microsoft Power BI dan product knowledge\",\"checked\":false}, {\"id\":\"m1w4_i4\",\"text\":\"Arahan untuk mempelajari materi learning sesuai checklist EOB\",\"checked\":false} ], \"mandatory_tasks\":[ {\"id\":\"m1w4_t1\",\"text\":\"Mempelajari Problem Solving & Decision Making\",\"checked\":false}, {\"id\":\"m1w4_t2\",\"text\":\"Mempelajari Retail Salesmanship\",\"checked\":false}, {\"id\":\"m1w4_t3\",\"text\":\"Mempelajari Customer Service & Loyalty, Standar Sikap Pelayanan, Grooming and Professional Appearance\",\"checked\":false} ] }', NULL, 'approved', NULL, '2025-12-08 09:49:49', '2025-12-08 03:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@hr.com', '$2y$12$J1CuFI5.IrngnkLGlkdZWed2bk4WmQOs0EzGND4TX2lJh5uXhUyfW', '2025-12-01 01:11:50'),
('syamilchalifah123@gmail.com', '$2y$12$Rezqe3l8k1zqw0YuqMAKzeweBIKqEgMLUabJ6ce6joimPc7cRFVeO', '2025-12-08 01:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Regional A Division', NULL, NULL),
(2, 'Regional B Division', NULL, NULL),
(3, 'Regional C Division', NULL, NULL),
(4, 'Regional D Division', NULL, NULL),
(5, 'Regional E Division', NULL, NULL),
(6, 'Regional F Division', NULL, NULL),
(7, 'Regional G Division', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sales Section', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rA0F1NbURa3BrUnS3DZ0USrBYqHmYI3ptZNEoqRw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMWdqb3FrUlc2ZUs4MFRqUjRnTTYwTVBETGw3eWtQUVNpT3VFYmFBaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jaGVja2xpc3QiO3M6NToicm91dGUiO3M6MjE6ImFkbWluLmNoZWNrbGlzdC5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1765191209);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `region_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gramedia Bogor Botani Dept\r', NULL, NULL),
(2, 1, 'Gramedia Bogor Pajajaran Dept\r', NULL, NULL),
(3, 1, 'Gramedia Cibinong City Mall Dept\r', NULL, NULL),
(4, 1, 'Gramedia Cijantung Dept\r', NULL, NULL),
(5, 1, 'Gramedia Cileungsi Dept\r', NULL, NULL),
(6, 1, 'Gramedia Citra Grand Cibubur Dept\r', NULL, NULL),
(7, 1, 'Gramedia Depok Dept\r', NULL, NULL),
(8, 1, 'Gramedia Depok The Park Sawangan Dept\r', NULL, NULL),
(9, 1, 'Gramedia Jayapura Dept\r', NULL, NULL),
(10, 1, 'Gramedia Kendari Lippo Dept\r', NULL, NULL),
(11, 1, 'Gramedia Kupang Dept\r', NULL, NULL),
(12, 1, 'Gramedia Living World Cibubur Dept\r', NULL, NULL),
(13, 1, 'Gramedia Mataram Dept\r', NULL, NULL),
(14, 1, 'Gramedia Maumere Dept\r', NULL, NULL),
(15, 1, 'Gramedia Palu Dept\r', NULL, NULL),
(16, 1, 'Gramedia Pejaten Dept\r', NULL, NULL),
(17, 1, 'Gramedia Pondok Gede Dept\r', NULL, NULL),
(18, 1, 'Gramedia Sorong Dept\r', NULL, NULL),
(19, 1, 'Gramedia Sukabumi Dept\r', NULL, NULL),
(20, 2, 'Gramedia Central Park Dept\r', NULL, NULL),
(21, 2, 'Gramedia Gajah Mada Dept\r', NULL, NULL),
(22, 2, 'Gramedia Grand Indonesia Dept\r', NULL, NULL),
(23, 2, 'Gramedia Makassar Nipah Park Dept\r', NULL, NULL),
(24, 2, 'Gramedia Makassar Panakkukang Dept\r', NULL, NULL),
(25, 2, 'Gramedia Makassar Pettarani Dept\r', NULL, NULL),
(26, 2, 'Gramedia Makassar Ratu Indah Dept\r', NULL, NULL),
(27, 2, 'Gramedia Mal Artha Gading Dept\r', NULL, NULL),
(28, 2, 'Gramedia Mal Ciputra Dept\r', NULL, NULL),
(29, 2, 'Gramedia Mal Kelapa Gading Dept\r', NULL, NULL),
(30, 2, 'Gramedia Maluku City Mall Dept\r', NULL, NULL),
(31, 2, 'Gramedia Matraman Dept\r', NULL, NULL),
(32, 2, 'Gramedia Pintu Air Dept\r', NULL, NULL),
(33, 2, 'Gramedia Pluit Emporium Dept\r', NULL, NULL),
(34, 2, 'Gramedia Ternate Dept\r', NULL, NULL),
(35, 3, 'Gramedia Banjarbaru QMall Dept\r', NULL, NULL),
(36, 3, 'Gramedia Banjarmasin Duta Mall Dept\r', NULL, NULL),
(37, 3, 'Gramedia Banjarmasin Veteran Dept\r', NULL, NULL),
(38, 3, 'Gramedia Cilacap Dept\r', NULL, NULL),
(39, 3, 'Gramedia Cirebon Cipto Dept\r', NULL, NULL),
(40, 3, 'Gramedia Cirebon Dept\r', NULL, NULL),
(41, 3, 'Gramedia Madiun Dept\r', NULL, NULL),
(42, 3, 'Gramedia Palangka Raya Duta Mall Dept\r', NULL, NULL),
(43, 3, 'Gramedia Purbalingga Dept\r', NULL, NULL),
(44, 3, 'Gramedia Purwokerto Gelora Indah Dept\r', NULL, NULL),
(45, 3, 'Gramedia Purwokerto Rita Mall Dept\r', NULL, NULL),
(46, 3, 'Gramedia Semarang Majapahit Dept\r', NULL, NULL),
(47, 3, 'Gramedia Semarang Pandanaran Dept\r', NULL, NULL),
(48, 3, 'Gramedia Semarang Setiabudi Dept\r', NULL, NULL),
(49, 3, 'Gramedia Solo Slamet Riyadi Dept\r', NULL, NULL),
(50, 3, 'Gramedia Solo Square Dept\r', NULL, NULL),
(51, 3, 'Gramedia Tegal Rita Mall Dept\r', NULL, NULL),
(52, 3, 'Gramedia Yogyakarta City Mall Dept\r', NULL, NULL),
(53, 3, 'Gramedia Yogyakarta Malioboro Mall Dept\r', NULL, NULL),
(54, 3, 'Gramedia Yogyakarta Pakuwon Dept\r', NULL, NULL),
(55, 3, 'Gramedia Yogyakarta Sudirman Dept\r', NULL, NULL),
(56, 4, 'Gramedia AEON Mall Dept\r', NULL, NULL),
(57, 4, 'Gramedia Batam City Square Dept\r', NULL, NULL),
(58, 4, 'Gramedia BSD City Dept\r', NULL, NULL),
(59, 4, 'Gramedia Cikupa Dept\r', NULL, NULL),
(60, 4, 'Gramedia Cilegon Dept\r', NULL, NULL),
(61, 4, 'Gramedia Daan Mogot Dept\r', NULL, NULL),
(62, 4, 'Gramedia Dumai Citimall Dept\r', NULL, NULL),
(63, 4, 'Gramedia Gading Serpong Dept\r', NULL, NULL),
(64, 4, 'Gramedia Grand Batam Dept\r', NULL, NULL),
(65, 4, 'Gramedia Karawaci Dept\r', NULL, NULL),
(66, 4, 'Gramedia Lampung Boemi Kedaton Dept\r', NULL, NULL),
(67, 4, 'Gramedia Lampung Dept\r', NULL, NULL),
(68, 4, 'Gramedia Padang Dept\r', NULL, NULL),
(69, 4, 'Gramedia Pamulang Siliwangi Dept\r', NULL, NULL),
(70, 4, 'Gramedia Pekanbaru Jend Sudirman Dept\r', NULL, NULL),
(71, 4, 'Gramedia Pekanbaru Mal SKA Dept\r', NULL, NULL),
(72, 4, 'Gramedia Pekanbaru Mall Dept\r', NULL, NULL),
(73, 4, 'Gramedia Puri Indah Dept\r', NULL, NULL),
(74, 4, 'Gramedia Puri Lippo Mall Dept\r', NULL, NULL),
(75, 4, 'Gramedia Serang Dept\r', NULL, NULL),
(76, 5, 'Gramedia Balikpapan Dept\r', NULL, NULL),
(77, 5, 'Gramedia Balikpapan MT Haryono Dept\r', NULL, NULL),
(78, 5, 'Gramedia Bangka Dept\r', NULL, NULL),
(79, 5, 'Gramedia Bengkulu Meranti Dept\r', NULL, NULL),
(80, 5, 'Gramedia Bintaro Emerald Dept\r', NULL, NULL),
(81, 5, 'Gramedia Bintaro Plaza Dept\r', NULL, NULL),
(82, 5, 'Gramedia Gandaria City Dept\r', NULL, NULL),
(83, 5, 'Gramedia Jambi Dept\r', NULL, NULL),
(84, 5, 'Gramedia Melawai Dept\r', NULL, NULL),
(85, 5, 'Gramedia Palembang Atmo Dept\r', NULL, NULL),
(86, 5, 'Gramedia Palembang Burlian Dept\r', NULL, NULL),
(87, 5, 'Gramedia Pangkalan Bun Dept\r', NULL, NULL),
(88, 5, 'Gramedia Pondok Indah Mall Dept\r', NULL, NULL),
(89, 5, 'Gramedia Pontianak Dept\r', NULL, NULL),
(90, 5, 'Gramedia Pontianak GAIA Dept\r', NULL, NULL),
(91, 5, 'Gramedia Samarinda Big Mall Dept\r', NULL, NULL),
(92, 5, 'Gramedia Samarinda Dept\r', NULL, NULL),
(93, 5, 'Gramedia Tarakan Dept\r', NULL, NULL),
(94, 6, 'Gramedia Aceh Dept\r', NULL, NULL),
(95, 6, 'Gramedia Bandung Buah Batu Dept\r', NULL, NULL),
(96, 6, 'Gramedia Bandung Festival Citylink Dept\r', NULL, NULL),
(97, 6, 'Gramedia Bandung Merdeka Dept\r', NULL, NULL),
(98, 6, 'Gramedia Bandung Paris Van Java Dept\r', NULL, NULL),
(99, 6, 'Gramedia Bandung Summarecon Dept\r', NULL, NULL),
(100, 6, 'Gramedia Bandung Trans Studio Mall Dept\r', NULL, NULL),
(101, 6, 'Gramedia Bandung WR Supratman Dept\r', NULL, NULL),
(102, 6, 'Gramedia Bekasi LW Grand Wisata Dept\r', NULL, NULL),
(103, 6, 'Gramedia Bekasi Mega Dept\r', NULL, NULL),
(104, 6, 'Gramedia Bekasi MM Dept\r', NULL, NULL),
(105, 6, 'Gramedia CBD Karawang Dept\r', NULL, NULL),
(106, 6, 'Gramedia Cikarang Pollux Dept\r', NULL, NULL),
(107, 6, 'Gramedia Cimahi Dept\r', NULL, NULL),
(108, 6, 'Gramedia Garut Dept\r', NULL, NULL),
(109, 6, 'Gramedia Grand Bekasi Dept\r', NULL, NULL),
(110, 6, 'Gramedia Harapan Indah Dept\r', NULL, NULL),
(111, 6, 'Gramedia Indramayu Gatot Subroto Dept\r', NULL, NULL),
(112, 6, 'Gramedia Karawang Resinda Park Dept\r', NULL, NULL),
(113, 6, 'Gramedia Medan Gama Dept\r', NULL, NULL),
(114, 6, 'Gramedia Medan Manhattan Dept\r', NULL, NULL),
(115, 6, 'Gramedia Medan Sun Plaza Dept\r', NULL, NULL),
(116, 6, 'Gramedia Purwakarta Dept\r', NULL, NULL),
(117, 6, 'Gramedia Subang Otto Iskandardinata Dept\r', NULL, NULL),
(118, 6, 'Gramedia Tasikmalaya Dept\r', NULL, NULL),
(119, 7, 'Gramedia Bali Duta Plaza Dept\r', NULL, NULL),
(120, 7, 'Gramedia Bali Galeria Mall Dept\r', NULL, NULL),
(121, 7, 'Gramedia Bali Gatot Subroto Dept\r', NULL, NULL),
(122, 7, 'Gramedia Bali Teuku Umar Dept\r', NULL, NULL),
(123, 7, 'Gramedia Bojonegoro Dept\r', NULL, NULL),
(124, 7, 'Gramedia Gorontalo Dept\r', NULL, NULL),
(125, 7, 'Gramedia Jember Dept\r', NULL, NULL),
(126, 7, 'Gramedia Kediri Dept\r', NULL, NULL),
(127, 7, 'Gramedia Malang Basuki Rahmad Dept\r', NULL, NULL),
(128, 7, 'Gramedia Malang Olympic Garden Dept\r', NULL, NULL),
(129, 7, 'Gramedia Malang Tlogomas Dept\r', NULL, NULL),
(130, 7, 'Gramedia Manado Samratulangi Dept\r', NULL, NULL),
(131, 7, 'Gramedia Manado Town Square Dept\r', NULL, NULL),
(132, 7, 'Gramedia Sidoarjo Pahlawan Dept\r', NULL, NULL),
(133, 7, 'Gramedia Surabaya Expo Dept\r', NULL, NULL),
(134, 7, 'Gramedia Surabaya Mal Pakuwon Dept\r', NULL, NULL),
(135, 7, 'Gramedia Surabaya Manyar Dept\r', NULL, NULL),
(136, 7, 'Gramedia Surabaya Royal Plaza Dept\r', NULL, NULL),
(137, 7, 'Gramedia Surabaya Tunjungan Plaza Dept\r', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','hr','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin HR', 'admin@hr.com', 'admin', '2025-12-01 07:35:26', '$2y$12$yDpiYZTAYHW10TTS4QMMpu4VC9u1IA3X/pyiCmQEPk42zC7pjcB.G', '5n3W7I2xYJUHgmZttMnwfw5sPtJxHNmrTwveOD7moxU7lzK8H52ysOm2BsNH', '2025-12-01 07:35:26', '2025-12-01 07:35:26'),
(2, 'Syamil Chalifah', 'syamilchalifah123@gmail.com', 'user', NULL, '$2y$12$Q2/pm8kUgMJI0oJSateYRurvN3vhbrsuHMWR0W6UeixubpmtjKPEC', NULL, '2025-12-08 01:17:06', '2025-12-08 01:17:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `checklist_templates`
--
ALTER TABLE `checklist_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  ADD KEY `employees_region_id_foreign` (`region_id`),
  ADD KEY `employees_section_id_foreign` (`section_id`),
  ADD KEY `employees_job_id_foreign` (`job_id`),
  ADD KEY `idx_store_id` (`store_id`);

--
-- Indexes for table `employees_tmp`
--
ALTER TABLE `employees_tmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_region_id_foreign` (`region_id`),
  ADD KEY `employees_section_id_foreign` (`section_id`),
  ADD KEY `employees_job_id_foreign` (`job_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `introductions`
--
ALTER TABLE `introductions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `introductions_nik_unique` (`nik`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_section_id_foreign` (`section_id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onboarding_checklists`
--
ALTER TABLE `onboarding_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_region_id_foreign` (`region_id`);

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
-- AUTO_INCREMENT for table `checklist_templates`
--
ALTER TABLE `checklist_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `employees_tmp`
--
ALTER TABLE `employees_tmp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `introductions`
--
ALTER TABLE `introductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `onboarding_checklists`
--
ALTER TABLE `onboarding_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
