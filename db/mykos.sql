/*
SQLyog Professional v10.42 
MySQL - 8.0.30 : Database - mykos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mykos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `mykos`;

/*Table structure for table `jenis_kelamin` */

DROP TABLE IF EXISTS `jenis_kelamin`;

CREATE TABLE `jenis_kelamin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `jenis_kelamin` */

insert  into `jenis_kelamin`(`id`,`jenis_kelamin`) values (1,'Laki-Laki'),(2,'Perempuan');

/*Table structure for table `tbl_categories` */

DROP TABLE IF EXISTS `tbl_categories`;

CREATE TABLE `tbl_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tbl_categories` */

/*Table structure for table `tbl_kos` */

DROP TABLE IF EXISTS `tbl_kos`;

CREATE TABLE `tbl_kos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kos` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `id_category` int DEFAULT NULL,
  `keterangan` text,
  `image` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tbl_kos` */

/*Table structure for table `tbl_payments` */

DROP TABLE IF EXISTS `tbl_payments`;

CREATE TABLE `tbl_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_payment` varchar(30) DEFAULT NULL,
  `nama_payment` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tbl_payments` */

insert  into `tbl_payments`(`id`,`kode_payment`,`nama_payment`,`status`,`created_at`,`updated_at`) values (1,'PAY001','Cash',1,NULL,NULL);

/*Table structure for table `tbl_pelanggan` */

DROP TABLE IF EXISTS `tbl_pelanggan`;

CREATE TABLE `tbl_pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodecust` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `jenis_kelamin` int DEFAULT NULL,
  `layanan` int DEFAULT NULL,
  `id_kos` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_pelanggan` */

insert  into `tbl_pelanggan`(`id`,`kodecust`,`nama_pelanggan`,`alamat`,`no_telp`,`tgl_masuk`,`jenis_kelamin`,`layanan`,`id_kos`,`status`,`created_at`,`updated_at`) values (1,'Ru 0001','Rumiyanti','Zamhuri No 27','62859106757182','2023-12-19',1,2,NULL,'1',NULL,NULL),(3,'Ru 0002','Dewantyo','Royal Park Juanda','62859106567125','2023-12-24',1,2,NULL,'1',NULL,NULL),(9,'Ru 0003','Bpk Kris','Royal Park Juanda','62859106945190','2023-12-26',1,2,NULL,'1',NULL,NULL),(11,'Ru 0004','Bu Ula','Royal Park Juanda','62859106945190','2023-12-26',2,2,NULL,'1',NULL,NULL),(12,'Ru 0005','Pak Suheriyanto','Wiguna 1 Surabaya','62859106634671','2023-12-27',1,2,NULL,'1',NULL,NULL),(13,'Ru 0006','Pak Surrahman','Alam Singgasana S/27 Cerme ','62859106718094','2023-12-31',1,2,NULL,'1',NULL,NULL),(14,'Ru 0007','Pak Cahyo','PCI belimbing blok BA','','2023-12-02',1,2,NULL,'1',NULL,NULL),(15,'Ru 0008','Syafiq indrive','madura','62859106689613','2023-12-03',1,2,NULL,'1',NULL,NULL),(16,'Ru 0009','Achmad Z','Madura','62859106501210','2023-12-03',1,2,NULL,'1',NULL,NULL),(17,'Ru 0010','Dina','Lidah Kulon','62859106543301','2023-12-28',2,2,NULL,'1',NULL,NULL),(18,'Ru 0011','Pisang Arjuna ','Jl Arjuna Surabaya','62859106807221','2023-12-03',1,2,NULL,'1',NULL,NULL),(19,'Ru 0012','Irfan Nur Rifai','Wonoayu, Sidoarjo','62859106513029','2023-12-06',1,2,NULL,'1',NULL,NULL),(20,'Ru 0013','Irfan PATRA','Perum Patra Cerme ','','2023-12-05',1,2,NULL,'1',NULL,NULL),(21,'Ru 0014','Kuswanto','Jl Pulo Sari Kodam','','2023-12-06',1,2,NULL,'1',NULL,NULL),(22,'Ru 0015','Dimas ','Jl Manukan ','','2023-12-06',1,2,NULL,'1',NULL,NULL),(23,'Ru 0016','Bu Titin Royal Park','Royal Park Juanda','62859106636786','2023-12-07',2,2,NULL,'1',NULL,NULL),(24,'Ru 0017','Pak Sifaul Hadi','Royal Park Juanda','62859106597387','2023-12-07',1,2,NULL,'1',NULL,NULL),(25,'Ru 0018','Bu Listi ','Royal Park Juanda','62859106662155','2023-12-07',2,2,NULL,'1',NULL,NULL),(26,'Ru 0019','Bu Narti','Royal Park Juanda','62859106560350','2023-12-07',2,2,NULL,'1',NULL,NULL),(27,'Ru 0020','Pak Made','Rungkut Asri TImur','62859106858477','2023-12-07',1,2,NULL,'1',NULL,NULL),(28,'Ru 0021','Bu Rina','Perintis Kebomas ','62859106804073','2023-12-10',2,2,NULL,'1',NULL,NULL),(29,'Ru 0022','Bu Uswatun','Sunan Prapen Giri','62859106738299','2023-12-10',2,2,NULL,'1',NULL,NULL),(30,'Ru 0023','Rosyid','Karang Rejo ','6282142534054','2023-12-10',1,3,NULL,'1',NULL,NULL);

/*Table structure for table `tbl_status` */

DROP TABLE IF EXISTS `tbl_status`;

CREATE TABLE `tbl_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tbl_status` */

insert  into `tbl_status`(`id`,`status`) values (1,'AKTIF'),(2,'TIDAK AKTIF');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (7,'admin','admin@gmail.com',NULL,'$2y$10$7SeDx0iO9x8q6udfiGsIHOjoKATMIIoJsCs/qTc6VRLUWtK3m2jaq',NULL,'2023-03-03 07:59:41','2023-03-03 07:59:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
