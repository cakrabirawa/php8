-- AnakKreatif Database Backup
-- Host: localhost
-- Generation Time: 2026-07-05 16:02:07
-- ------------------------------------------------------
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- --------------------------------------------------------

-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `access_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


-- Dumping data for table `access_logs`

INSERT INTO `access_logs` VALUES("1","beranda","::1","US","2026-07-05 20:28:13");
INSERT INTO `access_logs` VALUES("2","beranda","::1","US","2026-07-05 20:28:26");
INSERT INTO `access_logs` VALUES("3","beranda","::1","US","2026-07-05 20:35:49");
INSERT INTO `access_logs` VALUES("4","beranda","::1","US","2026-07-05 20:51:04");
INSERT INTO `access_logs` VALUES("5","toko","::1","US","2026-07-05 20:58:29");
INSERT INTO `access_logs` VALUES("6","kelas","::1","US","2026-07-05 20:58:33");
INSERT INTO `access_logs` VALUES("7","beranda","::1","US","2026-07-05 21:24:34");
INSERT INTO `access_logs` VALUES("8","beranda","::1","US","2026-07-05 21:24:55");
INSERT INTO `access_logs` VALUES("9","beranda","::1","US","2026-07-05 21:27:12");
INSERT INTO `access_logs` VALUES("10","beranda","::1","US","2026-07-05 21:27:44");
INSERT INTO `access_logs` VALUES("11","beranda","::1","US","2026-07-05 21:30:02");
INSERT INTO `access_logs` VALUES("12","beranda","::1","US","2026-07-05 21:30:28");
INSERT INTO `access_logs` VALUES("13","beranda","::1","US","2026-07-05 21:32:40");
INSERT INTO `access_logs` VALUES("14","beranda","::1","US","2026-07-05 21:34:38");
INSERT INTO `access_logs` VALUES("15","beranda","::1","US","2026-07-05 21:37:21");
INSERT INTO `access_logs` VALUES("16","beranda","::1","US","2026-07-05 21:39:18");
INSERT INTO `access_logs` VALUES("17","beranda","::1","US","2026-07-05 21:41:35");
INSERT INTO `access_logs` VALUES("18","beranda","::1","US","2026-07-05 21:44:08");
INSERT INTO `access_logs` VALUES("19","beranda","::1","US","2026-07-05 21:46:02");
INSERT INTO `access_logs` VALUES("20","beranda","::1","US","2026-07-05 21:48:46");
INSERT INTO `access_logs` VALUES("21","beranda","::1","US","2026-07-05 21:56:06");
INSERT INTO `access_logs` VALUES("22","beranda","::1","US","2026-07-05 21:58:12");
INSERT INTO `access_logs` VALUES("23","beranda","::1","US","2026-07-05 22:02:12");
INSERT INTO `access_logs` VALUES("24","beranda","::1","US","2026-07-05 22:03:03");
INSERT INTO `access_logs` VALUES("25","beranda","::1","US","2026-07-05 22:03:14");
INSERT INTO `access_logs` VALUES("26","beranda","::1","US","2026-07-05 22:05:34");
INSERT INTO `access_logs` VALUES("27","beranda","::1","US","2026-07-05 22:06:04");
INSERT INTO `access_logs` VALUES("28","beranda","::1","US","2026-07-05 22:06:20");
INSERT INTO `access_logs` VALUES("29","beranda","::1","US","2026-07-05 22:06:23");
INSERT INTO `access_logs` VALUES("30","beranda","::1","US","2026-07-05 22:06:48");
INSERT INTO `access_logs` VALUES("31","beranda","::1","US","2026-07-05 22:07:04");
INSERT INTO `access_logs` VALUES("32","beranda","::1","US","2026-07-05 22:07:16");
INSERT INTO `access_logs` VALUES("33","beranda","::1","US","2026-07-05 22:08:53");
INSERT INTO `access_logs` VALUES("34","toko","::1","US","2026-07-05 22:09:12");
INSERT INTO `access_logs` VALUES("35","toko","::1","US","2026-07-05 22:09:55");
INSERT INTO `access_logs` VALUES("36","toko","::1","US","2026-07-05 22:10:01");
INSERT INTO `access_logs` VALUES("37","toko","::1","US","2026-07-05 22:10:21");
INSERT INTO `access_logs` VALUES("38","toko","::1","US","2026-07-05 22:11:55");
INSERT INTO `access_logs` VALUES("39","beranda","::1","US","2026-07-05 22:11:59");
INSERT INTO `access_logs` VALUES("40","beranda","::1","US","2026-07-05 22:12:00");
INSERT INTO `access_logs` VALUES("41","beranda","::1","US","2026-07-05 22:13:48");
INSERT INTO `access_logs` VALUES("42","beranda","::1","US","2026-07-05 22:14:53");
INSERT INTO `access_logs` VALUES("43","beranda","::1","US","2026-07-05 22:15:38");
INSERT INTO `access_logs` VALUES("44","beranda","::1","US","2026-07-05 22:15:58");
INSERT INTO `access_logs` VALUES("45","beranda","::1","US","2026-07-05 22:16:00");
INSERT INTO `access_logs` VALUES("46","beranda","::1","US","2026-07-05 22:16:09");
INSERT INTO `access_logs` VALUES("47","beranda","::1","US","2026-07-05 22:16:27");
INSERT INTO `access_logs` VALUES("48","beranda","::1","US","2026-07-05 22:16:32");
INSERT INTO `access_logs` VALUES("49","beranda","::1","US","2026-07-05 22:16:37");
INSERT INTO `access_logs` VALUES("50","beranda","::1","US","2026-07-05 22:16:50");
INSERT INTO `access_logs` VALUES("51","beranda","::1","US","2026-07-05 22:16:52");
INSERT INTO `access_logs` VALUES("52","beranda","::1","US","2026-07-05 22:16:59");
INSERT INTO `access_logs` VALUES("53","beranda","::1","US","2026-07-05 22:17:20");
INSERT INTO `access_logs` VALUES("54","beranda","::1","US","2026-07-05 22:19:16");
INSERT INTO `access_logs` VALUES("55","beranda","::1","US","2026-07-05 22:19:30");
INSERT INTO `access_logs` VALUES("56","beranda","::1","US","2026-07-05 22:19:33");
INSERT INTO `access_logs` VALUES("57","beranda","::1","US","2026-07-05 22:19:47");
INSERT INTO `access_logs` VALUES("58","beranda","::1","US","2026-07-05 22:20:17");
INSERT INTO `access_logs` VALUES("59","toko","::1","US","2026-07-05 22:20:35");
INSERT INTO `access_logs` VALUES("60","toko","::1","US","2026-07-05 22:20:37");
INSERT INTO `access_logs` VALUES("61","toko","::1","US","2026-07-05 22:20:39");
INSERT INTO `access_logs` VALUES("62","toko","::1","US","2026-07-05 22:20:40");
INSERT INTO `access_logs` VALUES("63","toko","::1","US","2026-07-05 22:20:41");
INSERT INTO `access_logs` VALUES("64","kelas","::1","US","2026-07-05 22:20:42");
INSERT INTO `access_logs` VALUES("65","beranda","::1","US","2026-07-05 22:20:48");
INSERT INTO `access_logs` VALUES("66","beranda","::1","US","2026-07-05 22:21:18");
INSERT INTO `access_logs` VALUES("67","beranda","::1","US","2026-07-05 22:21:34");
INSERT INTO `access_logs` VALUES("68","beranda","::1","US","2026-07-05 22:21:40");
INSERT INTO `access_logs` VALUES("69","beranda","::1","US","2026-07-05 22:21:53");
INSERT INTO `access_logs` VALUES("70","beranda","::1","US","2026-07-05 22:22:00");
INSERT INTO `access_logs` VALUES("71","beranda","::1","US","2026-07-05 22:22:09");
INSERT INTO `access_logs` VALUES("72","beranda","::1","US","2026-07-05 22:22:16");
INSERT INTO `access_logs` VALUES("73","beranda","::1","US","2026-07-05 22:22:37");
INSERT INTO `access_logs` VALUES("74","beranda","::1","US","2026-07-05 22:23:41");
INSERT INTO `access_logs` VALUES("75","beranda","::1","US","2026-07-05 22:23:57");
INSERT INTO `access_logs` VALUES("76","beranda","::1","US","2026-07-05 22:25:11");
INSERT INTO `access_logs` VALUES("77","beranda","::1","US","2026-07-05 22:25:29");
INSERT INTO `access_logs` VALUES("78","beranda","::1","US","2026-07-05 22:25:53");
INSERT INTO `access_logs` VALUES("79","beranda","::1","US","2026-07-05 22:26:02");
INSERT INTO `access_logs` VALUES("80","beranda","::1","US","2026-07-05 22:26:23");
INSERT INTO `access_logs` VALUES("81","beranda","::1","US","2026-07-05 22:26:35");
INSERT INTO `access_logs` VALUES("82","beranda","::1","US","2026-07-05 22:26:43");
INSERT INTO `access_logs` VALUES("83","beranda","::1","US","2026-07-05 22:27:06");
INSERT INTO `access_logs` VALUES("84","beranda","::1","US","2026-07-05 22:27:13");
INSERT INTO `access_logs` VALUES("85","beranda","::1","US","2026-07-05 22:28:37");
INSERT INTO `access_logs` VALUES("86","beranda","::1","US","2026-07-05 22:29:05");
INSERT INTO `access_logs` VALUES("87","beranda","::1","US","2026-07-05 22:29:27");
INSERT INTO `access_logs` VALUES("88","beranda","::1","US","2026-07-05 22:29:33");
INSERT INTO `access_logs` VALUES("89","beranda","::1","US","2026-07-05 22:30:08");
INSERT INTO `access_logs` VALUES("90","beranda","::1","US","2026-07-05 22:30:36");
INSERT INTO `access_logs` VALUES("91","beranda","::1","US","2026-07-05 22:30:49");
INSERT INTO `access_logs` VALUES("92","beranda","::1","US","2026-07-05 22:30:56");
INSERT INTO `access_logs` VALUES("93","beranda","::1","US","2026-07-05 22:31:08");
INSERT INTO `access_logs` VALUES("94","beranda","::1","US","2026-07-05 22:31:27");
INSERT INTO `access_logs` VALUES("95","beranda","::1","US","2026-07-05 22:31:31");
INSERT INTO `access_logs` VALUES("96","beranda","::1","US","2026-07-05 22:31:42");
INSERT INTO `access_logs` VALUES("97","beranda","::1","US","2026-07-05 22:32:03");
INSERT INTO `access_logs` VALUES("98","beranda","::1","US","2026-07-05 22:32:18");
INSERT INTO `access_logs` VALUES("99","beranda","::1","US","2026-07-05 22:32:19");
INSERT INTO `access_logs` VALUES("100","beranda","::1","US","2026-07-05 22:32:53");
INSERT INTO `access_logs` VALUES("101","beranda","::1","US","2026-07-05 22:33:22");
INSERT INTO `access_logs` VALUES("102","beranda","::1","US","2026-07-05 22:33:27");
INSERT INTO `access_logs` VALUES("103","beranda","::1","US","2026-07-05 22:33:31");
INSERT INTO `access_logs` VALUES("104","beranda","::1","US","2026-07-05 22:33:37");
INSERT INTO `access_logs` VALUES("105","beranda","::1","US","2026-07-05 22:33:42");
INSERT INTO `access_logs` VALUES("106","beranda","::1","US","2026-07-05 22:34:08");
INSERT INTO `access_logs` VALUES("107","beranda","::1","US","2026-07-05 22:34:15");
INSERT INTO `access_logs` VALUES("108","beranda","::1","US","2026-07-05 22:34:22");
INSERT INTO `access_logs` VALUES("109","beranda","::1","US","2026-07-05 22:34:32");
INSERT INTO `access_logs` VALUES("110","beranda","::1","US","2026-07-05 22:34:40");
INSERT INTO `access_logs` VALUES("111","beranda","::1","US","2026-07-05 22:34:50");
INSERT INTO `access_logs` VALUES("112","beranda","::1","US","2026-07-05 22:34:55");
INSERT INTO `access_logs` VALUES("113","beranda","::1","US","2026-07-05 22:35:02");
INSERT INTO `access_logs` VALUES("114","beranda","::1","US","2026-07-05 22:35:23");
INSERT INTO `access_logs` VALUES("115","beranda","::1","US","2026-07-05 22:35:31");
INSERT INTO `access_logs` VALUES("116","beranda","::1","US","2026-07-05 22:38:54");
INSERT INTO `access_logs` VALUES("117","beranda","::1","US","2026-07-05 22:39:13");
INSERT INTO `access_logs` VALUES("118","beranda","::1","US","2026-07-05 22:42:46");
INSERT INTO `access_logs` VALUES("119","beranda","::1","US","2026-07-05 22:43:06");
INSERT INTO `access_logs` VALUES("120","beranda","::1","US","2026-07-05 22:43:15");
INSERT INTO `access_logs` VALUES("121","beranda","::1","US","2026-07-05 22:43:24");
INSERT INTO `access_logs` VALUES("122","beranda","::1","US","2026-07-05 22:43:38");
INSERT INTO `access_logs` VALUES("123","beranda","::1","US","2026-07-05 22:43:53");
INSERT INTO `access_logs` VALUES("124","beranda","::1","US","2026-07-05 22:44:01");
INSERT INTO `access_logs` VALUES("125","beranda","::1","US","2026-07-05 22:44:32");
INSERT INTO `access_logs` VALUES("126","beranda","::1","US","2026-07-05 22:44:36");
INSERT INTO `access_logs` VALUES("127","beranda","::1","US","2026-07-05 22:44:40");
INSERT INTO `access_logs` VALUES("128","beranda","::1","US","2026-07-05 22:44:50");
INSERT INTO `access_logs` VALUES("129","beranda","::1","US","2026-07-05 22:44:56");
INSERT INTO `access_logs` VALUES("130","beranda","::1","US","2026-07-05 22:45:16");
INSERT INTO `access_logs` VALUES("131","beranda","::1","US","2026-07-05 22:45:33");

-- --------------------------------------------------------

-- Table structure for table `kategori_produk`
--

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

INSERT INTO `kategori_produk` VALUES("1","parenting","1","1","2026-06-18 20:33:19");
INSERT INTO `kategori_produk` VALUES("2","anak","2","1","2026-06-18 20:33:32");
INSERT INTO `kategori_produk` VALUES("3","aa","3","1","2026-06-18 20:46:58");
INSERT INTO `kategori_produk` VALUES("4","bb","4","1","2026-06-18 20:47:02");
INSERT INTO `kategori_produk` VALUES("5","cc 1","5","1","2026-06-18 20:47:04");
INSERT INTO `kategori_produk` VALUES("6","Computer","6","1","2026-06-18 20:47:07");

-- --------------------------------------------------------

-- Table structure for table `kelas_menulis`
--

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

INSERT INTO `kelas_menulis` VALUES("1","bolot","Om Toni","150000","Sabtu, 09.00 - 11.00 WIB","15","Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 19:16:50");
INSERT INTO `kelas_menulis` VALUES("2","Menulis Dongeng Pertama Si Kecil","Kak Nadia","200000","Minggu, 14.00 - 16.00 WIB","10","Pendampingan intensif menyusun alur cerita fabel dari awal hingga selesai cetak.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 19:16:50");
INSERT INTO `kelas_menulis` VALUES("3","Test Nama Kelas","Butet","2000000","17 Juni 2026","10","Sekarang sistem login admin Anda sudah berhasil dikonfigurasi menggunakan enkripsi MD5 yang lebih simpel untuk kebutuhan pengembangan Anda. Langkah penyesuaian apa lagi yang ingin Anda lakukan pada proyek web AnakKreatif ini?","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:06:41");
INSERT INTO `kelas_menulis` VALUES("4","Dasar: Membangun Karakter Cerita (Salinan)","Om Toni","150000","Sabtu, 09.00 - 11.00 WIB","15","Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:54");
INSERT INTO `kelas_menulis` VALUES("5","Menulis Dongeng Pertama Si Kecil (Salinan)","Kak Nadia","200000","Minggu, 14.00 - 16.00 WIB","10","Pendampingan intensif menyusun alur cerita fabel dari awal hingga selesai cetak.","https://images.unsplash.com/photo-1773332585754-f1436987743b?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:55");
INSERT INTO `kelas_menulis` VALUES("6","Dasar: Membangun Karakter Cerita (Salinan) (Salinan)","Om Toni","150000","Sabtu, 09.00 - 11.00 WIB","15","Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:57");
INSERT INTO `kelas_menulis` VALUES("7","Kelas 111","aa 1","22","aa","22","aa asd asd asd","6a4895ce6877e.png","2026-07-04 12:10:38");

-- --------------------------------------------------------

-- Table structure for table `klasifikasi_produk`
--

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

INSERT INTO `klasifikasi_produk` VALUES("1","Books","1","1","2026-06-18 20:41:20");
INSERT INTO `klasifikasi_produk` VALUES("2","Non Books","2","1","2026-06-18 20:41:20");
INSERT INTO `klasifikasi_produk` VALUES("3","Digital","3","1","2026-06-18 20:41:20");
INSERT INTO `klasifikasi_produk` VALUES("10","Cards","10","1","2026-07-03 20:57:19");
INSERT INTO `klasifikasi_produk` VALUES("11","Contoh","11","1","2026-07-03 21:09:26");

-- --------------------------------------------------------

-- Table structure for table `pengaturan`
--

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
INSERT INTO `pengaturan` VALUES("hero_gradient_start","#ff00d0");
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

<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("1","Petualangan di Pulau Kata","Kak Ahmad","65000","12","Buku cerita interaktif yang mengajak anak belajar merangkai kata secara menyenangkan.","https://images.unsplash.com/photo-1780228725486-cfd6f7a651e8?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 19:16:50","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("2","Rahasia Sang Penjelajah Cilik","Bunda Maya","72000","8","Kisah fabel tentang keberanian mengeksplorasi bakat menulis dan menggambar diri sendiri.","https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 19:16:50","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("3","Membangun perusahaan raksasa","ado","200000","100","Dramatic Coastal Townscape of Positano, Amalfi Coast\r\n\r\nPublished 5 days ago\r\nSONY, ILCE-7RM3\r\nFree to use under the Unsplash License","https://images.unsplash.com/photo-1781147049036-385ae99b9aaa?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:05:06","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("4","Membangun Perusahaan AI","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:30:19","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("5","Membangun Perusahaan AI (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:07","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("6","Membangun Perusahaan AI (Salinan) (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:18","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("7","Membangun Perusahaan AI (Salinan) (Salinan) (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:19","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("8","Membangun Perusahaan AI (Salinan) (Salinan) (Salinan) (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:20","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("9","Membangun Perusahaan AI (Salinan) (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:22","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("10","Membangun Perusahaan AI (Salinan) (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:23","","");
<br />
<b>Deprecated</b>:  mysqli_real_escape_string(): Passing null to parameter #2 ($string) of type string is deprecated in <b>D:\projects\php8\anak-kreatif\admin\backup-db.php</b> on line <b>74</b><br />
INSERT INTO `produk_buku` VALUES("11","Membangun Perusahaan AI (Salinan) (Salinan)","Edwar Rinaldo","400000","100","Membangun Perusahaan AI","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:24","1","");
INSERT INTO `produk_buku` VALUES("12","Pembangunan Tol Bocimi Cibadak-Sukabumi Barat Rampung 2027","Edwar Rinaldo","400000","100","Jakarta - Kementerian Pekerjaan Umum (PU) mengevaluasi Tol Bogor-Ciawi-Sukabumi di kilometer (km) 72 akibat hujan deras pada Mei 2026. Hal ini disampaikan Kepala Badan Pengatur Jalan Tol (BPJT), Wilan Oktavian dalam Kunjungan Kerja Spesifik Komisi V DPR RI ke Jalan Tol Ciawi-Sukabumi Seksi 3 yang dilaksanakan pada Jumat (12/6).\r\nKemudian, pembangunan Tol Ciawi-Sukabumi Seksi 3 yang menghubungkan Cibadak hingga Sukabumi Barat juga dipercepat. Saat ini progres konstruksinya telah mencapai 81,49% dan ditargetkan selesai pada 2027.\r\n\r\n\"Pengamanan lereng menjadi aspek yang sangat penting dan krusial dalam pembangunan Jalan Tol Ciawi-Sukabumi Seksi 3. Oleh karena itu, Badan Pengatur Jalan Tol melakukan evaluasi menyeluruh terhadap seluruh lokasi timbunan dan galian untuk memastikan penerapan kemiringan lereng sesuai standar teknis agar lebih aman dan nyaman digunakan oleh masyarakat,\" jelas Wilan dalam keterangan tertulis, Selasa (16/6/2026).\r\n\r\nBaca artikel detikfinance, \"Pembangunan Tol Bocimi Cibadak-Sukabumi Barat Rampung 2027\" selengkapnya https://finance.detik.com/infrastruktur/d-8534028/pembangunan-tol-bocimi-cibadak-sukabumi-barat-rampung-2027.\r\n\r\nDownload Apps Detikcom Sekarang https://apps.detik.com/detik/","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","2026-06-16 20:34:25","2","1");
INSERT INTO `produk_buku` VALUES("13","Buku 1222","Jonathan","22","22","aa","6a4895bd3d0cd.png","2026-07-04 12:10:21","3","11");

-- --------------------------------------------------------

-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_slider` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Dumping data for table `sliders`

INSERT INTO `sliders` VALUES("4","Test","https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","0","2026-06-16 20:47:02");
INSERT INTO `sliders` VALUES("5","test 2","https://plus.unsplash.com/premium_photo-1780596641719-86e280a9c69e?q=80&w=1744&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-16 20:47:29");
INSERT INTO `sliders` VALUES("6","test 3","https://images.unsplash.com/photo-1780955420595-cf6a4cc9d1ec?q=80&w=1742&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-16 20:54:28");
INSERT INTO `sliders` VALUES("7","Gambar Pantai","https://images.unsplash.com/photo-1632037410699-c1487d383d76?q=80&w=1794&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-16 21:02:31");
INSERT INTO `sliders` VALUES("8","Gmbar Karang","https://plus.unsplash.com/premium_photo-1731933560224-43a0698d0b44?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D","1","2026-06-16 21:02:51");
INSERT INTO `sliders` VALUES("9","Gmbar Ustadz","6a31585ad5a0e.png","0","2026-06-16 21:06:18");

-- --------------------------------------------------------

-- Table structure for table `users_admin`
--

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

INSERT INTO `users_admin` VALUES("1","admin","$2y$12$husNwZx8IfckkcGykuQq8uW21c8biz92/cIQsp7NJfW3Epi5GmmXO","Edwar Rinaldo","6a48b7f97c938.png");
INSERT INTO `users_admin` VALUES("3","budi","$2y$10$t1bRpZbI4EXtEwm.I4nkAOnd.d9Kptn0/Chjc.qBPnV99dyOJdkPm","Budi Jongos","6a48b7e28eadc.png");
INSERT INTO `users_admin` VALUES("4","joko","$2y$12$MBj6.Uk6R5ier6L5z/DNQ.lSczmb/jZMfQXzqk6ASCxwmfR6EeE1y","joko","6a4a5b07e08e9.png");

-- --------------------------------------------------------

-- Table structure for table `videos`
--

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

INSERT INTO `videos` VALUES("4","BIGHERU - HILANG BAGANTI BURUAK BATUKA [OFFICIAL MUSIC VIDEO]","youtube","https://www.youtube.com/embed/tgxenRsQQdA?si=RKonW2Ct0Vr65Br3","1","2026-06-16 22:02:42");
INSERT INTO `videos` VALUES("5","Halilintar Morgen - Nan Disayang Manyakiti (Official Music Video)","youtube","https://www.youtube.com/embed/FPRWRZfsads?si=htjunV8UD8xfzMeM","1","2026-06-16 22:21:17");
INSERT INTO `videos` VALUES("6","aa 321","youtube","https://www.youtube.com/embed/CSKr9seKdgI?si=zEgTTwgYcr61DQFi","1","2026-07-04 12:25:06");
INSERT INTO `videos` VALUES("7","vv 123","youtube","https://www.youtube.com/embed/CSKr9seKdgI?si=zEgTTwgYcr61DQFi","1","2026-07-04 12:30:26");
