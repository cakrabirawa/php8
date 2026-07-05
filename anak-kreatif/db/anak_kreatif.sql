/*
SQLyog Ultimate v13.1.1 (32 bit)
MySQL - 11.8.3-MariaDB : Database - anak_kreatif
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kelas_menulis` */

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `kelas_menulis` */

insert  into `kelas_menulis`(`id`,`nama_kelas`,`mentor`,`harga_kelas`,`jadwal`,`kuota`,`deskripsi_kelas`,`gambar`,`created_at`) values 
(1,'Dasar: Membangun Karakter Cerita','Om Toni',150000,'Sabtu, 09.00 - 11.00 WIB',15,'Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.','https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 19:16:50'),
(2,'Menulis Dongeng Pertama Si Kecil','Kak Nadia',200000,'Minggu, 14.00 - 16.00 WIB',10,'Pendampingan intensif menyusun alur cerita fabel dari awal hingga selesai cetak.','https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 19:16:50'),
(3,'Test Nama Kelas','Butet',2000000,'17 Juni 2026',10,'Sekarang sistem login admin Anda sudah berhasil dikonfigurasi menggunakan enkripsi MD5 yang lebih simpel untuk kebutuhan pengembangan Anda. Langkah penyesuaian apa lagi yang ingin Anda lakukan pada proyek web AnakKreatif ini?','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:06:41'),
(4,'Dasar: Membangun Karakter Cerita (Salinan)','Om Toni',150000,'Sabtu, 09.00 - 11.00 WIB',15,'Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.','https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:54'),
(5,'Menulis Dongeng Pertama Si Kecil (Salinan)','Kak Nadia',200000,'Minggu, 14.00 - 16.00 WIB',10,'Pendampingan intensif menyusun alur cerita fabel dari awal hingga selesai cetak.','https://images.unsplash.com/photo-1773332585754-f1436987743b?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:55'),
(6,'Dasar: Membangun Karakter Cerita (Salinan) (Salinan)','Om Toni',150000,'Sabtu, 09.00 - 11.00 WIB',15,'Belajar menciptakan karakter pahlawan unik dari imajinasi anak sendiri.','https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:57');

/*Table structure for table `produk_buku` */

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `produk_buku` */

insert  into `produk_buku`(`id`,`judul`,`penulis`,`harga`,`stok`,`deskripsi`,`gambar`,`created_at`) values 
(1,'Petualangan di Pulau Kata','Kak Ahmad',65000,12,'Buku cerita interaktif yang mengajak anak belajar merangkai kata secara menyenangkan.','https://images.unsplash.com/photo-1780228725486-cfd6f7a651e8?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 19:16:50'),
(2,'Rahasia Sang Penjelajah Cilik','Bunda Maya',72000,8,'Kisah fabel tentang keberanian mengeksplorasi bakat menulis dan menggambar diri sendiri.','https://images.unsplash.com/photo-1780689978409-05bfc1c95f58?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 19:16:50'),
(3,'Membangun perusahaan raksasa','ado',200000,100,'Dramatic Coastal Townscape of Positano, Amalfi Coast\r\n\r\nPublished 5 days ago\r\nSONY, ILCE-7RM3\r\nFree to use under the Unsplash License','https://images.unsplash.com/photo-1781147049036-385ae99b9aaa?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:05:06'),
(4,'Membangun Perusahaan AI','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:30:19'),
(5,'Membangun Perusahaan AI (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:07'),
(6,'Membangun Perusahaan AI (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:18'),
(7,'Membangun Perusahaan AI (Salinan) (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:19'),
(8,'Membangun Perusahaan AI (Salinan) (Salinan) (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:20'),
(9,'Membangun Perusahaan AI (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:22'),
(10,'Membangun Perusahaan AI (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:23'),
(11,'Membangun Perusahaan AI (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:24'),
(12,'Membangun Perusahaan AI (Salinan) (Salinan)','Edwar Rinaldo',400000,100,'Membangun Perusahaan AI','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','2026-06-16 20:34:25');

/*Table structure for table `sliders` */

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_slider` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `sliders` */

insert  into `sliders`(`id`,`judul_slider`,`gambar`,`is_active`,`created_at`) values 
(4,'Test','https://images.unsplash.com/photo-1780631347040-0c5df6053c2f?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',0,'2026-06-16 20:47:02'),
(5,'test 2','https://plus.unsplash.com/premium_photo-1780596641719-86e280a9c69e?q=80&w=1744&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',0,'2026-06-16 20:47:29'),
(6,'test 3','https://images.unsplash.com/photo-1780955420595-cf6a4cc9d1ec?q=80&w=1742&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,'2026-06-16 20:54:28'),
(7,'aaa','https://images.unsplash.com/photo-1632037410699-c1487d383d76?q=80&w=1794&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,'2026-06-16 21:02:31'),
(8,'aaa','https://plus.unsplash.com/premium_photo-1731933560224-43a0698d0b44?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',1,'2026-06-16 21:02:51'),
(9,'pp','6a31585ad5a0e.png',0,'2026-06-16 21:06:18');

/*Table structure for table `users_admin` */

DROP TABLE IF EXISTS `users_admin`;

CREATE TABLE `users_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `users_admin` */

insert  into `users_admin`(`id`,`username`,`password`,`nama_lengkap`) values 
(1,'admin','827ccb0eea8a706c4c34a16891f84e7b','Edwar Rinaldo'),
(3,'budi','827ccb0eea8a706c4c34a16891f84e7b','Budi Jongos');

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_video` varchar(255) NOT NULL,
  `tipe_sumber` enum('upload','youtube') NOT NULL,
  `tautan_video` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `videos` */

insert  into `videos`(`id`,`judul_video`,`tipe_sumber`,`tautan_video`,`created_at`) values 
(4,'BIGHERU - HILANG BAGANTI BURUAK BATUKA [OFFICIAL MUSIC VIDEO]','youtube','https://www.youtube.com/embed/tgxenRsQQdA?si=RKonW2Ct0Vr65Br3','2026-06-16 22:02:42'),
(5,'Halilintar Morgen - Nan Disayang Manyakiti (Official Music Video)','youtube','https://www.youtube.com/embed/FPRWRZfsads?si=htjunV8UD8xfzMeM','2026-06-16 22:21:17');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
