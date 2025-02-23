/*
 Navicat Premium Data Transfer

 Source Server         : bagus
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : internet

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 14/01/2024 12:37:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_jenis_kelamin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jenis_kelamin`;
CREATE TABLE `tbl_jenis_kelamin`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_jenis_kelamin
-- ----------------------------
INSERT INTO `tbl_jenis_kelamin` VALUES (1, 'Laki-Laki');
INSERT INTO `tbl_jenis_kelamin` VALUES (2, 'Perempuan');

-- ----------------------------
-- Table structure for tbl_layanan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_layanan`;
CREATE TABLE `tbl_layanan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `harga` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_layanan
-- ----------------------------
INSERT INTO `tbl_layanan` VALUES (1, 'Basic', '100000', 'hanya support 1 device saja', NULL, NULL);
INSERT INTO `tbl_layanan` VALUES (2, 'rumahan xl', '125000', 'sewa stb nambah 25 rb', NULL, NULL);
INSERT INTO `tbl_layanan` VALUES (3, 'rumahan telkomsel', '175000', 'sewa stb nambah 25 rb', NULL, NULL);

-- ----------------------------
-- Table structure for tbl_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pelanggan`;
CREATE TABLE `tbl_pelanggan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodecust` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tgl_psb` date NULL DEFAULT NULL,
  `jenis_kelamin` int NULL DEFAULT NULL,
  `layanan` int NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pelanggan
-- ----------------------------
INSERT INTO `tbl_pelanggan` VALUES (1, 'Ru 0001', 'Rumiyanti', 'Zamhuri No 27', '62859106757182', '2023-12-19', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (3, 'Ru 0002', 'Dewantyo', 'Royal Park Juanda', '62859106567125', '2023-12-24', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (9, 'Ru 0003', 'Bpk Kris', 'Royal Park Juanda', '62859106945190', '2023-12-26', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (11, 'Ru 0004', 'Bu Ula', 'Royal Park Juanda', '62859106945190', '2023-12-26', 2, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (12, 'Ru 0005', 'Pak Suheriyanto', 'Wiguna 1 Surabaya', '62859106634671', '2023-12-27', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (13, 'Ru 0006', 'Pak Surrahman', 'Alam Singgasana S/27 Cerme ', '62859106718094', '2023-12-31', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (14, 'Ru 0007', 'Pak Cahyo', 'PCI belimbing blok BA', '', '2023-12-02', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (15, 'Ru 0008', 'Syafiq indrive', 'madura', '62859106689613', '2023-12-03', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (16, 'Ru 0009', 'Achmad Z', 'Madura', '62859106501210', '2023-12-03', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (17, 'Ru 0010', 'Dina', 'Lidah Kulon', '62859106543301', '2023-12-28', 2, 2, '', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (18, 'Ru 0011', 'Pisang Arjuna ', 'Jl Arjuna Surabaya', '62859106807221', '2023-12-03', 1, 2, 'AKTIF', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (19, 'Ru 0012', 'Irfan Nur Rifai', 'Wonoayu, Sidoarjo', '62859106513029', '2023-12-06', 1, 2, '', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (20, 'Ru 0013', 'Irfan PATRA', 'Perum Patra Cerme ', '', '2023-12-05', 1, 2, '', NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (21, 'Ru 0014', 'Kuswanto', 'Jl Pulo Sari Kodam', '', '2023-12-06', 1, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (22, 'Ru 0015', 'Dimas ', 'Jl Manukan ', '', '2023-12-06', 1, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (23, 'Ru 0016', 'Bu Titin Royal Park', 'Royal Park Juanda', '62859106636786', '2023-12-07', 2, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (24, 'Ru 0017', 'Pak Sifaul Hadi', 'Royal Park Juanda', '62859106597387', '2023-12-07', 1, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (25, 'Ru 0018', 'Bu Listi ', 'Royal Park Juanda', '62859106662155', '2023-12-07', 2, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (26, 'Ru 0019', 'Bu Narti', 'Royal Park Juanda', '62859106560350', '2023-12-07', 2, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (27, 'Ru 0020', 'Pak Made', 'Rungkut Asri TImur', '62859106858477', '2023-12-07', 1, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (28, 'Ru 0021', 'Bu Rina', 'Perintis Kebomas ', '62859106804073', '2023-12-10', 2, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (29, 'Ru 0022', 'Bu Uswatun', 'Sunan Prapen Giri', '62859106738299', '2023-12-10', 2, 2, NULL, NULL, NULL);
INSERT INTO `tbl_pelanggan` VALUES (30, 'Ru 0023', 'Rosyid', 'Karang Rejo ', '6282142534054', '2023-12-10', 1, 3, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'dimas', 'dimas@gmail.com', NULL, '$2y$10$618dPOjcFBhSJ4HQ/OCFGOLGQeu36KmJLne3LQU3eLz9I9AQOhJCW', NULL, '2023-03-03 02:02:23', '2023-07-01 14:44:28');
INSERT INTO `users` VALUES (2, 'guest', 'guest@gmail.com', NULL, '$2y$10$ZLAajLh9ZoWWsGOEuOilb.7NQFqO71TYq6GSosv6gCM5OTtQMZABC', NULL, '2023-03-03 02:05:41', '2023-03-03 02:05:41');
INSERT INTO `users` VALUES (7, 'admin', 'admin@gmail.com', NULL, '$2y$10$7SeDx0iO9x8q6udfiGsIHOjoKATMIIoJsCs/qTc6VRLUWtK3m2jaq', NULL, '2023-03-03 07:59:41', '2023-03-03 07:59:41');
INSERT INTO `users` VALUES (10, 'User', 'user@gmail.com', NULL, '$2y$10$feQw8YHD/TTovyrM7.x4puLU.5ULUdTE8SXzQuqoPWPJe31YwNgl.', NULL, '2023-07-01 13:37:03', '2023-07-01 13:37:03');

SET FOREIGN_KEY_CHECKS = 1;
