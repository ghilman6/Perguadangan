/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:3306
 Source Schema         : gudang

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 27/09/2021 08:08:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ref_armada
-- ----------------------------
DROP TABLE IF EXISTS `ref_armada`;
CREATE TABLE `ref_armada` (
  `id_armada` int(11) NOT NULL AUTO_INCREMENT,
  `kd_armada` varchar(255) DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `berat` double DEFAULT NULL,
  `id_armada_jenis` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_armada`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_armada
-- ----------------------------
BEGIN;
INSERT INTO `ref_armada` VALUES (1, 'TR001', 1000, 120, 2, 1, NULL, NULL, 77);
INSERT INTO `ref_armada` VALUES (2, 'TR02', 50, 55, 1, 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_armada_jenis
-- ----------------------------
DROP TABLE IF EXISTS `ref_armada_jenis`;
CREATE TABLE `ref_armada_jenis` (
  `id_armada_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nm_armada_jenis` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime(6) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_armada_jenis`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_armada_jenis
-- ----------------------------
BEGIN;
INSERT INTO `ref_armada_jenis` VALUES (1, 'Blind Van', 1, NULL, NULL, 77);
INSERT INTO `ref_armada_jenis` VALUES (2, 'CDD', 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_barang
-- ----------------------------
DROP TABLE IF EXISTS `ref_barang`;
CREATE TABLE `ref_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(255) DEFAULT NULL,
  `nm_barang` varchar(255) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_barang
-- ----------------------------
BEGIN;
INSERT INTO `ref_barang` VALUES (1, NULL, 'Sabun', NULL, NULL, 1, 1, '2021-09-22 10:34:34', NULL);
INSERT INTO `ref_barang` VALUES (2, NULL, 'Daihatsu', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (3, NULL, 'Golden Dragon', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (4, NULL, 'Hino', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (5, NULL, 'Hyundai', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (6, NULL, 'INOBUS', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (7, NULL, 'Isuzu', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (8, NULL, 'Kinglong', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (9, NULL, 'Mercedes Benz', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (10, NULL, 'Mitsubishi', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (11, NULL, 'Nissan', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (12, NULL, 'Toyota', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (13, NULL, 'Yutoong', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (14, NULL, 'ZhongTong', NULL, NULL, 1, 1, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (15, NULL, '<h1>test</h1>', NULL, NULL, 2, NULL, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (16, NULL, 'AAI BUS', NULL, NULL, 1, NULL, '2021-09-09 05:11:06', NULL);
INSERT INTO `ref_barang` VALUES (17, 'BK1231', 'Molto', 2, 1, 1, NULL, NULL, 77);
INSERT INTO `ref_barang` VALUES (18, 'GK001', 'Rinso', 1, 2, 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_bu
-- ----------------------------
DROP TABLE IF EXISTS `ref_bu`;
CREATE TABLE `ref_bu` (
  `id_bu` int(11) NOT NULL AUTO_INCREMENT,
  `kd_bu` varchar(255) DEFAULT NULL,
  `id_divre` int(11) DEFAULT NULL,
  `nm_bu` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_bu
-- ----------------------------
BEGIN;
INSERT INTO `ref_bu` VALUES (1, 'D1.001', 1, 'Banda Aceh', 'Banda Aceh', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (2, 'D1.002', 1, 'Bandar Lampung', 'Bandar Lampung', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (3, 'D1.003', 1, 'Bandara Soekarno Hatta', 'Jakarta', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (4, 'D1.004', 1, 'Bandung', 'Bandung', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (5, 'D1.005', 1, 'Batam', 'Batam', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (6, 'D1.006', 1, 'Bengkulu', 'Bengkulu', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (7, 'D1.007', 1, 'Bogor', 'Bogor', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (8, 'D1.008', 1, 'Jakarta', 'Jakarta', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (9, 'D1.009', 1, 'Jambi', 'Jambi', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (10, 'D1.010', 1, 'Medan', 'Medan', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (11, 'D1.011', 1, 'Padang', 'Padang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (12, 'D1.012', 1, 'Palembang', 'Palembang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (13, 'D1.013', 1, 'Pangkal Pinang', 'Pangkal Pinang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (14, 'D1.014', 1, 'Pekanbaru', 'Pekanbaru', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (15, 'D1.015', 1, 'Serang', 'Serang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (16, 'D1.016', 1, 'Koridor 1 & 8', NULL, 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (17, 'D1.017', 1, 'Logistik', NULL, 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (18, 'D2.001', 2, 'Banjarmasin', 'Banjarmasin', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (19, 'D2.002', 2, 'Cilacap', 'Cilacap', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (20, 'D2.003', 2, 'Palangkaraya', 'Palangkaraya', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (21, 'D2.004', 2, 'Pontianak', 'Pontianak', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (22, 'D2.005', 2, 'Purwokerto', 'Purwokerto', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (23, 'D2.006', 2, 'Purworejo', 'Purworejo', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (24, 'D2.007', 2, 'Samarinda', 'Samarinda', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (25, 'D2.008', 2, 'Semarang', 'Semarang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (26, 'D2.009', 2, 'Surakarta', 'Surakarta', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (27, 'D2.010', 2, 'Tanjung Selor', 'Tanjung Selor', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (28, 'D2.011', 2, 'Yogyakarta', 'Yogyakarta', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (29, 'D3.001', 3, 'Banyuwangi', 'Banyuwangi', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (30, 'D3.002', 3, 'Denpasar', 'Denpasar', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (31, 'D3.003', 3, 'Ende', 'Ende', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (32, 'D3.004', 3, 'Jember', 'Jember', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (33, 'D3.005', 3, 'Kefamenanu', 'Kefamenanu', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (34, 'D3.006', 3, 'Kendari', 'Kendari', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (35, 'D3.007', 3, 'Kupang', 'Kupang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (36, 'D3.008', 3, 'Makassar', 'Makassar', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (37, 'D3.009', 3, 'Malang', 'Malang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (38, 'D3.010', 3, 'Mamuju', 'Mamuju', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (39, 'D3.011', 3, 'Mataram', 'Mataram', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (40, 'D3.012', 3, 'Palu', 'Palu', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (41, 'D3.013', 3, 'Pamekasan', 'Pamekasan', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (42, 'D3.014', 3, 'Ponorogo', 'Ponorogo', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (43, 'D3.015', 3, 'Surabaya', 'Surabaya', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (44, 'D3.016', 3, 'Waingapu', 'Waingapu', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (45, 'D4.001', 4, 'Ambon', 'Ambon', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (46, 'D4.002', 4, 'Biak', 'Biak', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (47, 'D3.017', 3, 'Gorontalo', 'Gorontalo', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (48, 'D4.004', 4, 'Halmahera', 'Halmahera', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (49, 'D4.005', 4, 'Jayapura', 'Jayapura', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (50, 'D3.018', 3, 'Manado', 'Manado', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (51, 'D4.007', 4, 'Manokwari', 'Manokwari', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (52, 'D4.008', 4, 'Merauke', 'Merauke', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (53, 'D4.009', 4, 'Mimika', 'Mimika', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (54, 'D4.010', 4, 'Nabire', 'Nabire', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (55, 'D4.011', 4, 'Namlea', 'Namlea', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (56, 'D4.012', 4, 'Sarmi', 'Sarmi', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (57, 'D4.013', 4, 'Serui', 'Serui', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (58, 'D4.014', 4, 'Sorong', 'Sorong', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (59, 'D4.015', 4, 'Sorong Selatan', 'Sorong Selatan', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (60, 'D0.001', 5, 'Kantor Pusat', 'Kantor Pusat', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (61, 'D1', 1, 'Divre 1', 'Jakarta', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (62, 'D2', 2, 'Divre 2', 'Semarang', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (63, 'D3', 3, 'Divre 3', 'Surabaya', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (64, 'D4', 4, 'Divre 4', 'Jayapura', 1, 77, NULL);
INSERT INTO `ref_bu` VALUES (65, 'D1.018', 1, 'Koridor 11', 'Koridor 11', 1, 77, NULL);
COMMIT;

-- ----------------------------
-- Table structure for ref_bu_access
-- ----------------------------
DROP TABLE IF EXISTS `ref_bu_access`;
CREATE TABLE `ref_bu_access` (
  `id_bu_access` int(11) NOT NULL AUTO_INCREMENT,
  `id_bu` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `active` tinyint(11) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bu_access`) USING BTREE,
  UNIQUE KEY `uq_bu_access` (`id_bu`,`id_user`,`id_perusahaan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_bu_access
-- ----------------------------
BEGIN;
INSERT INTO `ref_bu_access` VALUES (8, 1, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (9, 2, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (10, 3, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (11, 4, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (12, 5, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (13, 6, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (14, 7, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (15, 8, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (16, 9, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (17, 10, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (18, 11, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (19, 12, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (20, 13, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (21, 14, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (22, 15, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (23, 16, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (24, 17, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (25, 18, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (26, 19, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (27, 20, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (28, 21, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (29, 22, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (30, 23, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (31, 24, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (32, 25, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (33, 26, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (34, 27, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (35, 28, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (36, 29, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (37, 30, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (38, 31, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (39, 32, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (40, 33, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (41, 34, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (42, 35, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (43, 36, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (44, 37, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (45, 38, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (46, 39, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (47, 40, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (48, 41, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (49, 42, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (50, 43, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (51, 44, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (52, 45, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (53, 46, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (54, 47, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (55, 48, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (56, 49, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (57, 50, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (58, 51, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (59, 52, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (60, 53, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (61, 54, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (62, 55, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (63, 56, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (64, 57, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (65, 58, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (66, 59, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (67, 60, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (68, 61, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (69, 62, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (70, 63, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (71, 64, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (72, 65, 1, 1, 77);
INSERT INTO `ref_bu_access` VALUES (191, 1, 6, 1, 77);
INSERT INTO `ref_bu_access` VALUES (192, 2, 7, 1, 77);
INSERT INTO `ref_bu_access` VALUES (193, 3, 8, 1, 77);
INSERT INTO `ref_bu_access` VALUES (194, 4, 9, 1, 77);
INSERT INTO `ref_bu_access` VALUES (195, 5, 10, 1, 77);
INSERT INTO `ref_bu_access` VALUES (196, 6, 11, 1, 77);
INSERT INTO `ref_bu_access` VALUES (197, 7, 12, 1, 77);
INSERT INTO `ref_bu_access` VALUES (198, 8, 13, 1, 77);
INSERT INTO `ref_bu_access` VALUES (199, 9, 14, 1, 77);
INSERT INTO `ref_bu_access` VALUES (200, 10, 15, 1, 77);
INSERT INTO `ref_bu_access` VALUES (201, 11, 16, 1, 77);
INSERT INTO `ref_bu_access` VALUES (202, 12, 17, 1, 77);
INSERT INTO `ref_bu_access` VALUES (203, 13, 18, 1, 77);
INSERT INTO `ref_bu_access` VALUES (204, 14, 19, 1, 77);
INSERT INTO `ref_bu_access` VALUES (205, 15, 20, 1, 77);
INSERT INTO `ref_bu_access` VALUES (206, 16, 21, 1, 77);
INSERT INTO `ref_bu_access` VALUES (207, 17, 22, 1, 77);
INSERT INTO `ref_bu_access` VALUES (208, 18, 23, 1, 77);
INSERT INTO `ref_bu_access` VALUES (209, 19, 24, 1, 77);
INSERT INTO `ref_bu_access` VALUES (210, 20, 25, 1, 77);
INSERT INTO `ref_bu_access` VALUES (211, 21, 26, 1, 77);
INSERT INTO `ref_bu_access` VALUES (212, 22, 27, 1, 77);
INSERT INTO `ref_bu_access` VALUES (213, 23, 28, 1, 77);
INSERT INTO `ref_bu_access` VALUES (214, 24, 29, 1, 77);
INSERT INTO `ref_bu_access` VALUES (215, 25, 30, 1, 77);
INSERT INTO `ref_bu_access` VALUES (216, 26, 31, 1, 77);
INSERT INTO `ref_bu_access` VALUES (217, 27, 32, 1, 77);
INSERT INTO `ref_bu_access` VALUES (218, 28, 33, 1, 77);
INSERT INTO `ref_bu_access` VALUES (219, 29, 34, 1, 77);
INSERT INTO `ref_bu_access` VALUES (220, 30, 35, 1, 77);
INSERT INTO `ref_bu_access` VALUES (221, 31, 36, 1, 77);
INSERT INTO `ref_bu_access` VALUES (222, 32, 37, 1, 77);
INSERT INTO `ref_bu_access` VALUES (223, 33, 38, 1, 77);
INSERT INTO `ref_bu_access` VALUES (224, 34, 39, 1, 77);
INSERT INTO `ref_bu_access` VALUES (225, 35, 40, 1, 77);
INSERT INTO `ref_bu_access` VALUES (226, 36, 41, 1, 77);
INSERT INTO `ref_bu_access` VALUES (227, 37, 42, 1, 77);
INSERT INTO `ref_bu_access` VALUES (228, 38, 43, 1, 77);
INSERT INTO `ref_bu_access` VALUES (229, 39, 44, 1, 77);
INSERT INTO `ref_bu_access` VALUES (230, 40, 45, 1, 77);
INSERT INTO `ref_bu_access` VALUES (231, 41, 46, 1, 77);
INSERT INTO `ref_bu_access` VALUES (232, 42, 47, 1, 77);
INSERT INTO `ref_bu_access` VALUES (233, 43, 48, 1, 77);
INSERT INTO `ref_bu_access` VALUES (234, 44, 49, 1, 77);
INSERT INTO `ref_bu_access` VALUES (235, 45, 50, 1, 77);
INSERT INTO `ref_bu_access` VALUES (236, 46, 51, 1, 77);
INSERT INTO `ref_bu_access` VALUES (237, 47, 52, 1, 77);
INSERT INTO `ref_bu_access` VALUES (238, 48, 53, 1, 77);
INSERT INTO `ref_bu_access` VALUES (239, 49, 54, 1, 77);
INSERT INTO `ref_bu_access` VALUES (240, 50, 55, 1, 77);
INSERT INTO `ref_bu_access` VALUES (241, 51, 56, 1, 77);
INSERT INTO `ref_bu_access` VALUES (242, 52, 57, 1, 77);
INSERT INTO `ref_bu_access` VALUES (243, 53, 58, 1, 77);
INSERT INTO `ref_bu_access` VALUES (244, 54, 59, 1, 77);
INSERT INTO `ref_bu_access` VALUES (245, 55, 60, 1, 77);
INSERT INTO `ref_bu_access` VALUES (246, 56, 61, 1, 77);
INSERT INTO `ref_bu_access` VALUES (247, 57, 62, 1, 77);
INSERT INTO `ref_bu_access` VALUES (248, 58, 63, 1, 77);
INSERT INTO `ref_bu_access` VALUES (249, 59, 64, 1, 77);
INSERT INTO `ref_bu_access` VALUES (250, 1, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (251, 2, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (252, 3, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (253, 4, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (254, 5, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (255, 6, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (256, 7, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (257, 8, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (258, 9, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (259, 10, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (260, 11, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (261, 12, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (262, 13, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (263, 14, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (264, 15, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (265, 16, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (266, 17, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (267, 18, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (268, 19, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (269, 20, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (270, 21, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (271, 22, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (272, 23, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (273, 24, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (274, 25, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (275, 26, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (276, 27, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (277, 28, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (278, 29, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (279, 30, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (280, 31, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (281, 32, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (282, 33, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (283, 34, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (284, 35, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (285, 36, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (286, 37, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (287, 38, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (288, 39, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (289, 40, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (290, 41, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (291, 42, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (292, 43, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (293, 44, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (294, 45, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (295, 46, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (296, 47, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (297, 48, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (298, 49, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (299, 50, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (300, 51, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (301, 52, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (302, 53, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (303, 54, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (304, 55, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (305, 56, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (306, 57, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (307, 58, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (308, 59, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (309, 60, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (310, 61, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (311, 62, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (312, 63, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (313, 64, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (314, 65, 2, 1, 77);
INSERT INTO `ref_bu_access` VALUES (316, 1, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (317, 2, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (318, 3, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (319, 4, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (320, 5, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (321, 6, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (322, 7, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (323, 8, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (324, 9, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (325, 10, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (326, 11, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (327, 12, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (328, 13, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (329, 14, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (330, 15, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (331, 16, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (332, 17, 88, 1, 77);
INSERT INTO `ref_bu_access` VALUES (333, 18, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (334, 19, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (335, 20, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (336, 21, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (337, 22, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (338, 23, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (339, 24, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (340, 25, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (341, 26, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (342, 27, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (343, 28, 89, 1, 77);
INSERT INTO `ref_bu_access` VALUES (344, 29, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (345, 30, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (346, 31, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (347, 32, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (348, 33, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (349, 34, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (350, 35, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (351, 36, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (352, 37, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (353, 38, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (354, 39, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (355, 40, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (356, 41, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (357, 42, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (358, 43, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (359, 44, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (360, 45, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (361, 46, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (362, 47, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (363, 48, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (364, 49, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (365, 50, 90, 1, 77);
INSERT INTO `ref_bu_access` VALUES (366, 51, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (367, 52, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (368, 53, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (369, 54, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (370, 55, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (371, 56, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (372, 57, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (373, 58, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (374, 59, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (375, 60, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (376, 61, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (377, 62, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (378, 63, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (379, 64, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (380, 65, 91, 1, 77);
INSERT INTO `ref_bu_access` VALUES (381, 3, 65, 1, 77);
INSERT INTO `ref_bu_access` VALUES (382, 3, 77, 1, 77);
INSERT INTO `ref_bu_access` VALUES (383, 3, 80, 1, 77);
INSERT INTO `ref_bu_access` VALUES (384, 3, 81, 1, 77);
INSERT INTO `ref_bu_access` VALUES (385, 3, 102, 1, 77);
INSERT INTO `ref_bu_access` VALUES (387, 1, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (388, 2, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (389, 3, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (390, 4, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (391, 5, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (392, 6, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (393, 7, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (394, 8, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (395, 9, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (396, 10, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (397, 11, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (398, 12, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (399, 13, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (400, 14, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (401, 15, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (402, 16, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (403, 17, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (404, 18, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (405, 19, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (406, 20, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (407, 21, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (408, 22, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (409, 23, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (410, 24, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (411, 25, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (412, 26, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (413, 27, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (414, 28, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (415, 29, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (416, 30, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (417, 31, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (418, 32, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (419, 33, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (420, 34, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (421, 35, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (422, 36, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (423, 37, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (424, 38, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (425, 39, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (426, 40, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (427, 41, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (428, 42, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (429, 43, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (430, 44, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (431, 45, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (432, 46, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (433, 47, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (434, 48, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (435, 49, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (436, 50, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (437, 51, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (438, 52, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (439, 53, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (440, 54, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (441, 55, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (442, 56, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (443, 57, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (444, 58, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (445, 59, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (446, 60, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (447, 61, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (448, 62, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (449, 63, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (450, 64, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (452, 65, 82, 1, 77);
INSERT INTO `ref_bu_access` VALUES (453, 3, 94, 1, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_divre
-- ----------------------------
DROP TABLE IF EXISTS `ref_divre`;
CREATE TABLE `ref_divre` (
  `id_divre` int(11) NOT NULL AUTO_INCREMENT,
  `nm_divre` varchar(255) DEFAULT NULL,
  `kd_divre` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_divre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_divre
-- ----------------------------
BEGIN;
INSERT INTO `ref_divre` VALUES (1, 'Divre I', '', 1, 77);
INSERT INTO `ref_divre` VALUES (2, 'Divre II', '', 1, 77);
INSERT INTO `ref_divre` VALUES (3, 'Divre III', '', 1, 77);
INSERT INTO `ref_divre` VALUES (4, 'Divre IV', '', 1, 77);
INSERT INTO `ref_divre` VALUES (5, 'PUSAT', '', 1, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_kategori
-- ----------------------------
DROP TABLE IF EXISTS `ref_kategori`;
CREATE TABLE `ref_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_kategori
-- ----------------------------
BEGIN;
INSERT INTO `ref_kategori` VALUES (1, 'Kebersihan', 1, NULL, NULL, 77);
INSERT INTO `ref_kategori` VALUES (2, 'Elektronik', 1, NULL, NULL, 77);
INSERT INTO `ref_kategori` VALUES (3, 'Sabun', 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_level
-- ----------------------------
DROP TABLE IF EXISTS `ref_level`;
CREATE TABLE `ref_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nm_level` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1.active\n2.deactive',
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT '0',
  PRIMARY KEY (`id_level`) USING BTREE,
  KEY `fk_id_user_ref_level_idx` (`cuser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_level
-- ----------------------------
BEGIN;
INSERT INTO `ref_level` VALUES (1, 'Super Admin', 1, '2021-09-02 18:13:31', 1, 77);
INSERT INTO `ref_level` VALUES (13, 'User', 1, '2021-09-26 13:25:18', NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_lokasi
-- ----------------------------
DROP TABLE IF EXISTS `ref_lokasi`;
CREATE TABLE `ref_lokasi` (
  `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
  `kd_lokasi` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_lokasi
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ref_menu_details
-- ----------------------------
DROP TABLE IF EXISTS `ref_menu_details`;
CREATE TABLE `ref_menu_details` (
  `id_menu_details` int(11) NOT NULL AUTO_INCREMENT,
  `kd_menu_details` varchar(10) DEFAULT NULL,
  `nm_menu_details` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1. active\n2. deactive\n',
  `position` tinyint(2) DEFAULT NULL,
  `id_menu_groups` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_details`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_menu_details
-- ----------------------------
BEGIN;
INSERT INTO `ref_menu_details` VALUES (1, 'S01', 'Level', 'level', 1, 1, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (2, 'S02', 'User', 'user', 1, 2, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (3, 'S03', 'Bussines Unit', 'bu', 1, 3, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (4, 'S04', 'Divre', 'divre', 1, 4, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (5, 'M01', 'Armada', 'armada', 1, 2, 2, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (9, 'S05', 'Menu Detail', 'menu_details', 1, 5, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (10, 'S06', 'Menu Group', 'menu_groups', 1, 6, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_details` VALUES (11, 'M03', 'Barang', 'barang', 1, 1, 2, '2021-09-22 09:55:25', 1);
INSERT INTO `ref_menu_details` VALUES (12, 'M04', 'Satuan', 'satuan', 1, 2, 2, '2021-09-22 09:55:53', 1);
INSERT INTO `ref_menu_details` VALUES (13, 'M05', 'Merek', 'merek', 1, 1, 2, '2021-09-22 10:29:05', 1);
INSERT INTO `ref_menu_details` VALUES (14, 'M06', 'Kategori', 'kategori', 1, 3, 2, '2021-09-22 14:37:01', 1);
INSERT INTO `ref_menu_details` VALUES (15, 'M08', 'Toko', 'toko', 1, 4, 2, '2021-09-22 14:37:14', 1);
INSERT INTO `ref_menu_details` VALUES (16, 'M02', 'Jenis Armada', 'armada_jenis', 1, 1, 2, '2021-09-26 18:13:44', 1);
INSERT INTO `ref_menu_details` VALUES (17, 'G02', 'Barang Keluar', 'keluar', 1, 1, 3, '2021-09-26 18:14:34', 1);
INSERT INTO `ref_menu_details` VALUES (18, 'G01', 'Barang Masuk', 'masuk', 1, 1, 3, '2021-09-26 19:22:46', 1);
INSERT INTO `ref_menu_details` VALUES (19, 'G03', 'Pengiriman', 'pengiriman', 1, 1, 3, '2021-09-26 19:22:48', 1);
INSERT INTO `ref_menu_details` VALUES (20, 'G04', 'Stok', 'Stok', 1, 1, 3, '2021-09-26 19:23:31', 1);
INSERT INTO `ref_menu_details` VALUES (21, 'M07', 'Supplier', 'supplier', 1, 1, 2, '2021-09-26 19:23:49', 1);
INSERT INTO `ref_menu_details` VALUES (22, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-26 19:24:00', 1);
COMMIT;

-- ----------------------------
-- Table structure for ref_menu_details_access
-- ----------------------------
DROP TABLE IF EXISTS `ref_menu_details_access`;
CREATE TABLE `ref_menu_details_access` (
  `id_menu_details_access` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_menu_details` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1. active\n2. deactive\n',
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT '0',
  PRIMARY KEY (`id_menu_details_access`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1322 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_menu_details_access
-- ----------------------------
BEGIN;
INSERT INTO `ref_menu_details_access` VALUES (1, 1, 1, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (2, 1, 2, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (3, 1, 3, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (4, 1, 4, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (5, 1, 5, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (9, 1, 9, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (10, 1, 10, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (11, 1, 11, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (12, 1, 12, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (13, 1, 13, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (14, 1, 14, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (15, 1, 15, 1, '2021-09-02 18:13:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1293, 13, 1, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1294, 13, 2, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1295, 13, 3, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1296, 13, 4, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1297, 13, 5, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1301, 13, 9, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1302, 13, 10, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1303, 13, 11, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1304, 13, 12, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1305, 13, 13, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1306, 13, 14, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1307, 13, 15, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1308, 1, 16, 1, '2021-09-26 18:13:44', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1309, 13, 16, 0, '2021-09-26 18:13:44', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1310, 1, 17, 1, '2021-09-26 18:14:34', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1311, 13, 17, 0, '2021-09-26 18:14:34', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1312, 1, 18, 1, '2021-09-26 19:22:46', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1313, 13, 18, 0, '2021-09-26 19:22:46', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1314, 1, 19, 1, '2021-09-26 19:22:48', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1315, 13, 19, 0, '2021-09-26 19:22:48', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1316, 1, 20, 1, '2021-09-26 19:23:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1317, 13, 20, 0, '2021-09-26 19:23:31', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1318, 1, 21, 1, '2021-09-26 19:23:49', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1319, 13, 21, 0, '2021-09-26 19:23:49', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1320, 1, 22, 0, '2021-09-26 19:24:00', NULL, 77);
INSERT INTO `ref_menu_details_access` VALUES (1321, 13, 22, 0, '2021-09-26 19:24:00', NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_menu_groups
-- ----------------------------
DROP TABLE IF EXISTS `ref_menu_groups`;
CREATE TABLE `ref_menu_groups` (
  `id_menu_groups` int(11) NOT NULL AUTO_INCREMENT,
  `nm_menu_groups` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1.active\n2. deactive',
  `position` tinyint(2) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_groups`) USING BTREE,
  KEY `fk_id_user_ref_menu_groups_idx` (`cuser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_menu_groups
-- ----------------------------
BEGIN;
INSERT INTO `ref_menu_groups` VALUES (1, 'Settings', 'fa fa-wrench', 1, 4, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_groups` VALUES (2, 'Master', 'fa fa-database', 1, 2, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_menu_groups` VALUES (3, 'Gudang', 'fa fa-truck', 1, 1, '2021-09-22 09:54:57', NULL);
COMMIT;

-- ----------------------------
-- Table structure for ref_menu_groups_access
-- ----------------------------
DROP TABLE IF EXISTS `ref_menu_groups_access`;
CREATE TABLE `ref_menu_groups_access` (
  `id_menu_groups_access` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu_groups` int(11) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1. Active\n2. Deactive',
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT '0',
  PRIMARY KEY (`id_menu_groups_access`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_menu_groups_access
-- ----------------------------
BEGIN;
INSERT INTO `ref_menu_groups_access` VALUES (1, 1, 1, 1, '2021-09-02 18:13:31', 1, 77);
INSERT INTO `ref_menu_groups_access` VALUES (2, 2, 1, 1, '2021-09-02 18:13:31', 1, 77);
INSERT INTO `ref_menu_groups_access` VALUES (3, 3, 1, 1, '2021-09-02 18:13:31', 1, 77);
INSERT INTO `ref_menu_groups_access` VALUES (253, 3, 13, 1, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_groups_access` VALUES (254, 1, 13, 0, '2021-09-26 13:25:18', NULL, 77);
INSERT INTO `ref_menu_groups_access` VALUES (255, 2, 13, 1, '2021-09-26 13:25:18', NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_merek
-- ----------------------------
DROP TABLE IF EXISTS `ref_merek`;
CREATE TABLE `ref_merek` (
  `id_merek` int(11) NOT NULL AUTO_INCREMENT,
  `nm_merek` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_merek`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_merek
-- ----------------------------
BEGIN;
INSERT INTO `ref_merek` VALUES (1, 'Beijing', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (2, 'Daihatsu', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (3, 'Golden Dragon', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (4, 'Hino', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (5, 'Hyundai', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (6, 'INOBUS', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (7, 'Isuzu', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (8, 'Kinglong', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (9, 'Mercedes Benz', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (10, 'Mitsubishi', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (11, 'Nissan', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (12, 'Toyota', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (13, 'Yutoong', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (14, 'ZhongTong', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (15, '<h1>test</h1>', 2, NULL, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_merek` VALUES (16, 'AAI BUS', 1, NULL, '2021-09-09 05:11:06', 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `ref_perusahaan`;
CREATE TABLE `ref_perusahaan` (
  `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_perusahaan` varchar(45) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(15) DEFAULT NULL,
  `jenis` tinyint(1) DEFAULT NULL COMMENT '1. Pusat 2. Subcon',
  `active` tinyint(1) DEFAULT NULL COMMENT '1. Active\n2. Deactive',
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fifo` tinyint(1) DEFAULT '0' COMMENT '0. deactive 1.active',
  `fefo` tinyint(1) DEFAULT '0' COMMENT '0. deactive 1.active',
  `best` tinyint(1) DEFAULT '0' COMMENT '0. deactive 1.active',
  `alloc` varchar(1) DEFAULT 'F' COMMENT 'F FIFO E FEFO B Best Fit',
  `language` varchar(50) DEFAULT 'english' COMMENT 'english / indonesian',
  PRIMARY KEY (`id_perusahaan`) USING BTREE,
  KEY `fk_id_user_ref_perusahaan_idx` (`cuser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_perusahaan
-- ----------------------------
BEGIN;
INSERT INTO `ref_perusahaan` VALUES (77, 'DAMRI', 'DKI Jakarta', '', 1, 1, '2021-09-02 18:13:31', 2, '32eaa902bd56712f93c0ee514b47b59c.png', 1, 1, 0, 'F', 'indonesian');
COMMIT;

-- ----------------------------
-- Table structure for ref_satuan
-- ----------------------------
DROP TABLE IF EXISTS `ref_satuan`;
CREATE TABLE `ref_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_satuan` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_satuan
-- ----------------------------
BEGIN;
INSERT INTO `ref_satuan` VALUES (1, 'Pcs', 1, NULL, NULL, 77);
INSERT INTO `ref_satuan` VALUES (2, 'Liter', 1, NULL, NULL, 77);
INSERT INTO `ref_satuan` VALUES (3, 'Set', 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_supplier
-- ----------------------------
DROP TABLE IF EXISTS `ref_supplier`;
CREATE TABLE `ref_supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(255) DEFAULT NULL,
  `alamat_supplier` text,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_supplier
-- ----------------------------
BEGIN;
INSERT INTO `ref_supplier` VALUES (1, 'PT Alfaria', 'Jakarta', 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_toko
-- ----------------------------
DROP TABLE IF EXISTS `ref_toko`;
CREATE TABLE `ref_toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nm_toko` varchar(255) DEFAULT NULL,
  `alamat_toko` text,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_toko`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_toko
-- ----------------------------
BEGIN;
INSERT INTO `ref_toko` VALUES (1, 'Murah', 'Bandung', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (2, 'Maju Jaya', 'Subang', 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (3, 'Golden Dragon', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (4, 'Hino', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (5, 'Hyundai', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (6, 'INOBUS', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (7, 'Isuzu', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (8, 'Kinglong', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (9, 'Mercedes Benz', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (10, 'Mitsubishi', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (11, 'Nissan', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (12, 'Toyota', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (13, 'Yutoong', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (14, 'ZhongTong', NULL, 1, 1, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (15, '<h1>test</h1>', NULL, 2, NULL, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (16, 'AAI BUS', NULL, 1, NULL, '2021-09-09 05:11:06', 77);
INSERT INTO `ref_toko` VALUES (17, 'Udin', 'fg', 1, NULL, NULL, 77);
COMMIT;

-- ----------------------------
-- Table structure for ref_user
-- ----------------------------
DROP TABLE IF EXISTS `ref_user`;
CREATE TABLE `ref_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT '0',
  `id_level` int(11) DEFAULT NULL,
  `id_bu` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL COMMENT '1. Active\n2. Deactive\n',
  `cdate` datetime DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `fk_username` (`username`) USING BTREE,
  KEY `fk_id_perusahaan_ref_user_idx` (`id_perusahaan`) USING BTREE,
  KEY `fk_id_level_ref_level_idx` (`id_level`) USING BTREE,
  KEY `fk_id_user_ref_user` (`cuser`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=763 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ref_user
-- ----------------------------
BEGIN;
INSERT INTO `ref_user` VALUES (1, 'Ilham', 'admin1', 'e10adc3949ba59abbe56e057f20f883e', 77, 1, 60, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_user` VALUES (2, 'noe', 'noe', '986c9baaf20157cbf32b21c0314b3e2a', 77, 1, 17, 1, '2021-09-02 18:13:31', 1);
INSERT INTO `ref_user` VALUES (761, 'user', 'user', 'd41d8cd98f00b204e9800998ecf8427e', 77, 13, 1, 1, '2021-09-27 07:36:27', 2);
INSERT INTO `ref_user` VALUES (762, 'ad', 'adi', '827ccb0eea8a706c4c34a16891f84e7b', 77, 13, 2, 1, '2021-09-27 07:45:49', 2);
COMMIT;

-- ----------------------------
-- Table structure for tr_keluar
-- ----------------------------
DROP TABLE IF EXISTS `tr_keluar`;
CREATE TABLE `tr_keluar` (
  `id_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `kd_keluar` varchar(255) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_keluar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_keluar
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tr_keluar_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_keluar_detail`;
CREATE TABLE `tr_keluar_detail` (
  `id_keluar_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `kd_barang` varchar(255) DEFAULT NULL,
  `nm_barang` varchar(255) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `nm_satuan` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_keluar_detail`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_keluar_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tr_masuk
-- ----------------------------
DROP TABLE IF EXISTS `tr_masuk`;
CREATE TABLE `tr_masuk` (
  `id_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `kd_masuk` varchar(255) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_masuk`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_masuk
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tr_masuk_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_masuk_detail`;
CREATE TABLE `tr_masuk_detail` (
  `id_masuk_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `kd_barang` varchar(255) DEFAULT NULL,
  `nm_barang` varchar(255) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `nm_satuan` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_masuk_detail`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_masuk_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tr_pengiriman
-- ----------------------------
DROP TABLE IF EXISTS `tr_pengiriman`;
CREATE TABLE `tr_pengiriman` (
  `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT,
  `id_toko` int(11) DEFAULT NULL,
  `nm_toko` varchar(255) DEFAULT NULL,
  `alamat_toko` text,
  `id_armada` int(11) DEFAULT NULL,
  `kd_armada` varchar(255) DEFAULT NULL,
  `id_armada_jenis` int(11) DEFAULT NULL,
  `tgl_pengiriman` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_pengiriman
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tr_pengiriman_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_pengiriman_detail`;
CREATE TABLE `tr_pengiriman_detail` (
  `id_pengiriman_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_keluar` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman_detail`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_pengiriman_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tr_stok
-- ----------------------------
DROP TABLE IF EXISTS `tr_stok`;
CREATE TABLE `tr_stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `nm_barang` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `id_masuk` int(11) DEFAULT NULL,
  `id_masuk_detail` int(11) DEFAULT NULL,
  `kd_lokasi` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `cuser` int(11) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stok`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tr_stok
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Procedure structure for fill_date_dimension
-- ----------------------------
DROP PROCEDURE IF EXISTS `fill_date_dimension`;
delimiter ;;
CREATE PROCEDURE `fill_date_dimension`(IN startdate DATE,IN stopdate DATE)
BEGIN
    DECLARE currentdate DATE;
    SET currentdate = startdate;
    WHILE currentdate < stopdate DO
        INSERT INTO time_dimension VALUES (
                        YEAR(currentdate)*10000+MONTH(currentdate)*100 + DAY(currentdate),
                        currentdate,
                        YEAR(currentdate),
                        MONTH(currentdate),
                        DAY(currentdate),
                        QUARTER(currentdate),
                        WEEKOFYEAR(currentdate),
                        DATE_FORMAT(currentdate,'%W'),
                        DATE_FORMAT(currentdate,'%M'),
                        'f',
                        CASE DAYOFWEEK(currentdate) WHEN 1 THEN 't' WHEN 7 then 't' ELSE 'f' END,
                        NULL);
        SET currentdate = ADDDATE(currentdate,INTERVAL 1 DAY);
    END WHILE;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_insert_level
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_insert_level`;
delimiter ;;
CREATE PROCEDURE `p_insert_level`(IN p_id_level int, IN p_id_perusahaan int)
BEGIN
 DECLARE done INT DEFAULT FALSE;
 DECLARE a_id_menu_details INT;

 DECLARE cur1 CURSOR FOR SELECT id_menu_details FROM ref_menu_details ;

 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
 	
 OPEN cur1;
 read_loop: LOOP
 FETCH cur1 INTO a_id_menu_details;
 		
 IF done THEN
 LEAVE read_loop;
 END IF;
 		
 INSERT INTO ref_menu_details_access (id_level, id_menu_details, active, id_perusahaan) VALUES (p_id_level, a_id_menu_details, 0, p_id_perusahaan);
	
 END LOOP;
 CLOSE cur1;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_insert_level_group
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_insert_level_group`;
delimiter ;;
CREATE PROCEDURE `p_insert_level_group`(IN p_id_level int, IN p_id_perusahaan int)
BEGIN
 DECLARE done INT DEFAULT FALSE;
 DECLARE a_id_menu_groups INT;

 DECLARE cur1 CURSOR FOR SELECT id_menu_groups FROM ref_menu_groups ;

 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
 	
 OPEN cur1;
 read_loop: LOOP
 FETCH cur1 INTO a_id_menu_groups;
 		
 IF done THEN
 LEAVE read_loop;
 END IF;
 		
 INSERT INTO ref_menu_groups_access (id_level, id_menu_groups, active, id_perusahaan) VALUES (p_id_level, a_id_menu_groups, 0, p_id_perusahaan);
	
 END LOOP;
 CLOSE cur1;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_menudetails
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_menudetails`;
delimiter ;;
CREATE PROCEDURE `p_menudetails`(IN p_id_menu_details int, IN p_cuser int)
BEGIN
 DECLARE done INT DEFAULT FALSE;
 DECLARE a_id_level, a_id_perusahaan INT;
 

 DECLARE cur1 CURSOR FOR SELECT id_level, id_perusahaan FROM ref_level  ;

 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
 	
 OPEN cur1;
 read_loop: LOOP
 FETCH cur1 INTO a_id_level, a_id_perusahaan;
 		
 IF done THEN
 LEAVE read_loop;
 END IF;
 		
 INSERT INTO ref_menu_details_access (id_level, id_menu_details, active, cdate, cuser, id_perusahaan) VALUES (a_id_level, p_id_menu_details, 0, CURRENT_TIMESTAMP(), p_cuser, a_id_perusahaan);
	
 END LOOP;
 CLOSE cur1;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_menugroup
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_menugroup`;
delimiter ;;
CREATE PROCEDURE `p_menugroup`(IN p_id_menu_groups int, IN p_cuser int)
BEGIN
 DECLARE done INT DEFAULT FALSE;
 DECLARE a_id_level, a_id_perusahaan INT;
 

 DECLARE cur1 CURSOR FOR SELECT id_level, id_perusahaan FROM ref_level   ;

 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
 	
 OPEN cur1;
 read_loop: LOOP
 FETCH cur1 INTO a_id_level, a_id_perusahaan;
 		
 IF done THEN
 LEAVE read_loop;
 END IF;
 		
 INSERT INTO ref_menu_groups_access (id_level, id_menu_groups, active, cdate, cuser, id_perusahaan) VALUES (a_id_level, p_id_menu_groups , 0, CURRENT_TIMESTAMP(), p_cuser, a_id_perusahaan);
	
 END LOOP;
 CLOSE cur1;

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_level
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_level_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_level_BEFORE_INSERT` BEFORE INSERT ON `ref_level` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_level
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_level_after_inser`;
delimiter ;;
CREATE TRIGGER `ref_level_after_inser` AFTER INSERT ON `ref_level` FOR EACH ROW begin
call p_insert_level(new.id_level, new.id_perusahaan);
call p_insert_level_group(new.id_level, new.id_perusahaan);
end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_level
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_level_before_delete`;
delimiter ;;
CREATE TRIGGER `ref_level_before_delete` BEFORE DELETE ON `ref_level` FOR EACH ROW begin

delete from ref_menu_groups_access where id_level = old.id_level;
delete from ref_menu_details_access where id_level = old.id_level;
end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_details
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_menu_details_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_menu_details_BEFORE_INSERT` BEFORE INSERT ON `ref_menu_details` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_details
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_menudetail_after_insert`;
delimiter ;;
CREATE TRIGGER `ref_menudetail_after_insert` AFTER INSERT ON `ref_menu_details` FOR EACH ROW begin

call p_menudetails(new.id_menu_details, new.cuser);

end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_details
-- ----------------------------
DROP TRIGGER IF EXISTS `before_delete_ref_menudetails`;
delimiter ;;
CREATE TRIGGER `before_delete_ref_menudetails` BEFORE DELETE ON `ref_menu_details` FOR EACH ROW begin
delete from ref_menu_details_access where id_menu_details = old.id_menu_details ;
end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_details_access
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_menu_details_access_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_menu_details_access_BEFORE_INSERT` BEFORE INSERT ON `ref_menu_details_access` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_groups
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_menu_groups_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_menu_groups_BEFORE_INSERT` BEFORE INSERT ON `ref_menu_groups` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_groups
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_menugroup_after_insert`;
delimiter ;;
CREATE TRIGGER `ref_menugroup_after_insert` AFTER INSERT ON `ref_menu_groups` FOR EACH ROW begin

call p_menugroup(new.id_menu_groups, new.cuser);

end
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_menu_groups_access
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_menu_groups_access_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_menu_groups_access_BEFORE_INSERT` BEFORE INSERT ON `ref_menu_groups_access` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_merek
-- ----------------------------
DROP TRIGGER IF EXISTS `berfore_insert_merek`;
delimiter ;;
CREATE TRIGGER `berfore_insert_merek` BEFORE INSERT ON `ref_merek` FOR EACH ROW BEGIN
set new.cdate = DATE_FORMAT(current_timestamp(), "%Y-%m-%d %H:%i:%s");
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_merek
-- ----------------------------
DROP TRIGGER IF EXISTS `before_update_merek`;
delimiter ;;
CREATE TRIGGER `before_update_merek` BEFORE UPDATE ON `ref_merek` FOR EACH ROW BEGIN
set new.cdate = DATE_FORMAT(current_timestamp(), "%Y-%m-%d %H:%i:%s");
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_perusahaan
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_perusahaan_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_perusahaan_BEFORE_INSERT` BEFORE INSERT ON `ref_perusahaan` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table ref_user
-- ----------------------------
DROP TRIGGER IF EXISTS `ref_user_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `ref_user_BEFORE_INSERT` BEFORE INSERT ON `ref_user` FOR EACH ROW BEGIN
set new.cdate = current_timestamp();
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
