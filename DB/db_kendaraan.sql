-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.18-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sidiproj_kendaraan.auth_acl
DROP TABLE IF EXISTS `auth_acl`;
CREATE TABLE IF NOT EXISTS `auth_acl` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ai`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_acl_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `auth_acl_actions` (`action_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_acl: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_acl_actions
DROP TABLE IF EXISTS `auth_acl_actions`;
CREATE TABLE IF NOT EXISTS `auth_acl_actions` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `action_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `auth_acl_actions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `auth_acl_categories` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_acl_actions: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl_actions` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_acl_categories
DROP TABLE IF EXISTS `auth_acl_categories`;
CREATE TABLE IF NOT EXISTS `auth_acl_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `category_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_code` (`category_code`),
  UNIQUE KEY `category_desc` (`category_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_acl_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl_categories` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_ci_sessions
DROP TABLE IF EXISTS `auth_ci_sessions`;
CREATE TABLE IF NOT EXISTS `auth_ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_ci_sessions: 0 rows
/*!40000 ALTER TABLE `auth_ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_ci_sessions` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_denied_access
DROP TABLE IF EXISTS `auth_denied_access`;
CREATE TABLE IF NOT EXISTS `auth_denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_denied_access: 0 rows
/*!40000 ALTER TABLE `auth_denied_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_denied_access` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_ips_on_hold
DROP TABLE IF EXISTS `auth_ips_on_hold`;
CREATE TABLE IF NOT EXISTS `auth_ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_ips_on_hold: 0 rows
/*!40000 ALTER TABLE `auth_ips_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_ips_on_hold` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_login_errors
DROP TABLE IF EXISTS `auth_login_errors`;
CREATE TABLE IF NOT EXISTS `auth_login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=347 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_login_errors: 1 rows
/*!40000 ALTER TABLE `auth_login_errors` DISABLE KEYS */;
INSERT INTO `auth_login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES
	(346, 'umum@gmail.com', '::1', '2017-12-03 15:49:10');
/*!40000 ALTER TABLE `auth_login_errors` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_sessions
DROP TABLE IF EXISTS `auth_sessions`;
CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_sessions: 23 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
	('55b15e1b6d7a0503d35f2ee3ea2edb67db6f13e4', 1, '2017-11-05 11:51:02', '2017-11-06 00:16:28', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('bd57242242bb445bb7558e3095399167771b227d', 1, '2017-11-06 01:36:46', '2017-11-06 08:50:58', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('e6ed8ee127d9c6ed03409965a9e54d50adccdd42', 1, '2017-11-20 03:08:12', '2017-11-20 14:49:05', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('d7a30c031b4760f31799322df2f8d5184a8b8135', 1, '2017-11-21 00:11:12', '2017-11-21 16:00:00', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('1908c5f28f47a51a90b41fa52fbfd6268a1edab0', 1, '2017-11-21 12:48:13', '2017-11-21 21:22:20', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('d70de3e8e2c424bde6fa545a4030fda36386d790', 1, '2017-11-22 01:35:49', '2017-11-22 08:35:49', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('478bd177157de0bb25a98ce80a00ce27cc9ab087', 4, '2017-11-23 01:36:21', '2017-11-23 08:36:21', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('713655fab4a93851748ae7b44060692e9e056806', 1, '2017-11-26 06:17:09', '2017-11-26 13:17:10', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('17194d45251fd22e96a50bd31850aa57c3b5f0c2', 1, '2017-11-28 07:54:17', '2017-11-28 14:54:17', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('5a5eef42927f2850f7260f064fcbd0bd6aba237a', 1, '2017-11-28 09:24:38', '2017-11-28 18:51:49', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('5ce3a7d5a203c4d550e04a951d09552136b822bd', 1, '2017-11-29 00:22:41', '2017-11-29 13:20:23', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('3484089f5c23f69074ba0a732173d162a01a738e', 1, '2017-11-29 08:26:27', '2017-11-29 19:04:55', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('onbna1jgev9m0ksedku3217jtd6dk3oh', 1, '2017-11-30 13:56:25', '2017-11-30 13:56:25', '117.102.94.186', 'Chrome 62.0.3202.94 on Windows 10'),
	('9c9icuo9f7toa4s8hboeh0kjg9gh21gg', 1, '2017-11-30 13:53:56', '2017-11-30 14:03:47', '27.50.30.158', 'Chrome 62.0.3202.94 on Windows 10'),
	('vqoigqtk54lp3j0mlco2vs2ipkeuf7b3', 1, '2017-12-02 20:53:38', '2017-12-02 21:36:38', '118.136.107.119', 'Chrome 62.0.3202.94 on Windows 10'),
	('l3e12gq2q9bo9chrmn1sd9e100iji04d', 4, '2017-12-02 21:33:49', '2017-12-02 21:33:49', '118.136.107.119', 'Firefox 58.0 on Windows 10'),
	('n7pa7bm74c5rhs5u1cff4tidhvdma0or', 4, '2017-12-02 21:34:15', '2017-12-02 21:34:15', '118.136.107.119', 'Firefox 58.0 on Windows 10'),
	('5qb52s0cjemudggojvls6mp8n371drq0', 4, '2017-12-02 21:35:04', '2017-12-02 21:35:04', '118.136.107.119', 'Firefox 58.0 on Windows 10'),
	('69mjhg0qli5oc7h9bgbvdg7eam2a1tur', 1, '2017-12-02 21:48:34', '2017-12-02 21:48:34', '118.136.107.119', 'Chrome 62.0.3202.94 on Windows 10'),
	('d6ktvkroq5jfbr9ebb77lnudksg4o6kr', 1, '2017-12-03 07:10:08', '2017-12-03 09:36:49', '118.136.107.119', 'Chrome 62.0.3202.94 on Windows 10'),
	('pseg347stmd8tscv8scp919doqj74nh8', 1, '2017-12-03 12:50:02', '2017-12-03 14:14:59', '139.0.180.21', 'Chrome 62.0.3202.94 on Windows 7'),
	('f1c9dckn2s4alc6rg1eoll21c096lmgp', 1, '2017-12-03 17:30:49', '2017-12-03 17:47:00', '61.94.189.110', 'Chrome 62.0.3202.94 on Windows 10'),
	('357bd1e65dd8bffaf0155507defd1a2b7e68539d', 1, '2017-12-03 13:12:30', '2017-12-03 22:49:06', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('c79f0dd83cec180957e90b93ee3da76f20db0065', 4, '2017-12-03 15:49:14', '2017-12-03 22:49:14', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('f8f3c3133b306455d6725d256d0aba3e5308628d', 4, '2017-12-03 15:50:04', '2017-12-03 22:50:04', '::1', 'Chrome 62.0.3202.94 on Windows 10'),
	('e3fb488bcee5771127bd353a96f3f56ab4d1a6a7', 1, '2017-12-03 16:00:02', '2017-12-03 23:07:05', '::1', 'Chrome 62.0.3202.94 on Windows 10');
/*!40000 ALTER TABLE `auth_sessions` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_username_or_email_on_hold
DROP TABLE IF EXISTS `auth_username_or_email_on_hold`;
CREATE TABLE IF NOT EXISTS `auth_username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_username_or_email_on_hold: 0 rows
/*!40000 ALTER TABLE `auth_username_or_email_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_username_or_email_on_hold` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.auth_users
DROP TABLE IF EXISTS `auth_users`;
CREATE TABLE IF NOT EXISTS `auth_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `biro` varchar(255) NOT NULL,
  `usertelpno` varchar(255) NOT NULL,
  `auth_level` tinyint(3) unsigned NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.auth_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `auth_users` DISABLE KEYS */;
INSERT INTO `auth_users` (`user_id`, `username`, `email`, `nickname`, `fullname`, `biro`, `usertelpno`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
	(1, 'admin', 'admin@email.com', 'Admin', 'Administrator', 'Administrator', '123', 1, '0', '$2y$11$eAiQVPLDrbemhQrkb0qt1.Ac3Nhb1pmdgOBbPbgstYIngb1m9NACO', NULL, NULL, NULL, '2017-12-03 16:00:02', '2017-10-28 08:06:14', '2017-12-03 23:00:02'),
	(4, 'umum', 'umum@gmail.com', 'Biro Umum', 'Biro Umum', 'Biro Umum', '', 2, '0', '$2y$11$C2i38HBlpQFuZzyVSc2OHegPxZHSjm5wJ3/7Io8DvoW9XgRrQNTUW', NULL, NULL, NULL, '2017-12-03 15:59:41', '2017-11-19 00:00:00', '2017-12-03 22:59:41'),
	(5, 'jaya', 'jaya@email.com', 'jaya', 'jaya', 'Jay', '123', 2, '0', '$2y$11$zMW3Ix2oekhnyWtZVnUSIuTcBVdcWJzw9R/iTvFC/NGyu.Bw19LJy', NULL, NULL, NULL, NULL, '2017-12-03 00:00:00', '2017-12-03 22:57:38');
/*!40000 ALTER TABLE `auth_users` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.ms_jenis
DROP TABLE IF EXISTS `ms_jenis`;
CREATE TABLE IF NOT EXISTS `ms_jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.ms_jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `ms_jenis` DISABLE KEYS */;
INSERT INTO `ms_jenis` (`id_jenis`, `jenis`) VALUES
	(1, 'Mobil'),
	(2, 'Motor');
/*!40000 ALTER TABLE `ms_jenis` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.ms_jenis_perawatan
DROP TABLE IF EXISTS `ms_jenis_perawatan`;
CREATE TABLE IF NOT EXISTS `ms_jenis_perawatan` (
  `id_jenis_perawatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `perawatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_perawatan`),
  KEY `FK_ms_jenis_perawatan_ms_jenis_perawatan_group` (`id_group`),
  CONSTRAINT `FK_ms_jenis_perawatan_ms_jenis_perawatan_group` FOREIGN KEY (`id_group`) REFERENCES `ms_jenis_perawatan_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.ms_jenis_perawatan: ~42 rows (approximately)
/*!40000 ALTER TABLE `ms_jenis_perawatan` DISABLE KEYS */;
INSERT INTO `ms_jenis_perawatan` (`id_jenis_perawatan`, `id_group`, `perawatan`) VALUES
	(1, 1, 'Oli Mesin'),
	(2, 1, 'Oli Gardan'),
	(3, 1, 'Oli Verseneling'),
	(4, 1, 'Tune Up'),
	(6, 1, 'Service Rem'),
	(7, 2, 'Ganti aki'),
	(8, 2, 'Ganti ban'),
	(9, 2, 'Filter oli'),
	(10, 2, 'Tune up'),
	(11, 2, 'Filter air'),
	(12, 2, 'Busi'),
	(13, 2, 'Engine conditioner'),
	(14, 2, 'water pump'),
	(15, 2, 'Sporing + balancing'),
	(16, 2, 'fuel filter'),
	(17, 2, 'Minyak power stering'),
	(18, 2, 'Van belt'),
	(19, 2, 'Laher stelan van belt stensioner'),
	(20, 2, 'Angin nitrogen'),
	(21, 2, 'Knalpot'),
	(22, 2, 'Ball joint Atas'),
	(23, 2, 'Ball joint bawah'),
	(24, 2, 'Tierrod'),
	(25, 2, 'Rockend'),
	(26, 2, 'Tongkat verseneling'),
	(27, 2, 'Plat kopling, laher dan dekrop'),
	(28, 2, 'Radiator'),
	(29, 2, 'Service AC'),
	(30, 2, 'Oli compressor'),
	(31, 2, 'Radiator collant'),
	(32, 2, 'Freon + vacum'),
	(33, 2, 'Power window'),
	(34, 2, 'Bohlam/lampu'),
	(35, 2, 'Wiperblade'),
	(36, 2, 'Jasa service'),
	(37, 2, 'Parfume'),
	(38, 2, 'Semir ban'),
	(39, 2, 'Car wash amway'),
	(40, 2, 'Silicon glaze body'),
	(41, 2, 'Kain majun'),
	(42, 2, 'Karpet'),
	(43, 2, 'Penggunaan Bahan Bakar');
/*!40000 ALTER TABLE `ms_jenis_perawatan` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.ms_jenis_perawatan_group
DROP TABLE IF EXISTS `ms_jenis_perawatan_group`;
CREATE TABLE IF NOT EXISTS `ms_jenis_perawatan_group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(50) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.ms_jenis_perawatan_group: ~2 rows (approximately)
/*!40000 ALTER TABLE `ms_jenis_perawatan_group` DISABLE KEYS */;
INSERT INTO `ms_jenis_perawatan_group` (`id_group`, `group`) VALUES
	(1, 'utama'),
	(2, 'lain-lain');
/*!40000 ALTER TABLE `ms_jenis_perawatan_group` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.ms_kendaraan
DROP TABLE IF EXISTS `ms_kendaraan`;
CREATE TABLE IF NOT EXISTS `ms_kendaraan` (
  `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `tahun_pembuatan` int(11) NOT NULL,
  `nama_kendaraan` varchar(255) NOT NULL,
  `platno` varchar(50) NOT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `bahan_bakar` varchar(50) DEFAULT NULL,
  `no_mesin` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `no_stnk` varchar(50) DEFAULT NULL,
  `masa_berlaku_stnk` date DEFAULT NULL,
  `catatan` text,
  `id_foto_kendaraan` int(11) DEFAULT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateupdate` date DEFAULT NULL,
  `userinput` varchar(50) NOT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kendaraan`),
  UNIQUE KEY `platno` (`platno`),
  KEY `FK_ms_kendaraan_ms_jenis` (`id_jenis`),
  KEY `FK_ms_kendaraan_ms_merk` (`id_merk`),
  CONSTRAINT `FK_ms_kendaraan_ms_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `ms_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ms_kendaraan_ms_merk` FOREIGN KEY (`id_merk`) REFERENCES `ms_merk` (`id_merk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.ms_kendaraan: ~9 rows (approximately)
/*!40000 ALTER TABLE `ms_kendaraan` DISABLE KEYS */;
INSERT INTO `ms_kendaraan` (`id_kendaraan`, `id_jenis`, `id_merk`, `tahun_pembuatan`, `nama_kendaraan`, `platno`, `warna`, `bahan_bakar`, `no_mesin`, `no_rangka`, `no_stnk`, `masa_berlaku_stnk`, `catatan`, `id_foto_kendaraan`, `dateinput`, `dateupdate`, `userinput`, `userupdate`) VALUES
	(3, 1, 5, 0, 'KIJANG INNOVA G', 'B 1740 PQN', 'HITAM METALIK', 'BENSIN', '1TR6783787', 'MHFXW42G892142441', '1146325/MJ/2014', '2019-12-05', 'Mobil Operasional', 15, '2017-12-03 07:14:36', NULL, '1', NULL),
	(4, 1, 5, 0, 'KIJANG INOVA G AT', 'B 1639 VQ', 'SILVER METALIK', 'BENSIN', '1TR6245689', 'MHFXW42G162065861', 'D9360745G', '2016-04-11', 'Kabag Kepegawaian', 16, '2017-12-03 07:16:33', NULL, '1', NULL),
	(5, 1, 3, 0, 'K 2700', 'B 7306 IO', 'SILVER METALIK', 'SOLAR', 'J2474676', 'MJJSD211274K00204', '1056009/MJ/2012', '2017-12-26', 'Mobil Operasional', 17, '2017-12-03 08:34:14', NULL, '1', NULL),
	(6, 1, 5, 0, 'KIJANH INNOVA G', 'B 8245 WU', 'HIJAU METALIK', 'BENSIN', '1TR6293637', 'MHFXW42G762072717', '2171387/MJ/2011', '2016-11-15', 'Mobil Biro Umum', 18, '2017-12-03 08:37:52', NULL, '1', NULL),
	(7, 1, 1, 0, 'CIVIC FB2 1.8 AT', 'B 1590 PQA', 'HITAM METALIK', 'BENSIN', 'R18712300040', 'MRHFB2620DP330033', '2659472/MJ/2012', '2018-03-28', 'Mobil Kepala Biro', 19, '2017-12-03 08:42:12', NULL, '1', NULL),
	(8, 1, 1, 0, 'CIVIC FB2 1.8 AT', 'B 1589 PQA', 'HITAM METALIK', 'BENSIN', 'R18Z12300045', 'MRHFB2620DP330038', '2659471/MJ/2012', '2018-03-28', 'Mobil Kepala Biro', 20, '2017-12-03 08:44:51', NULL, '1', NULL),
	(9, 1, 1, 0, 'CIVIC FB2 1.8 AT', 'B 1588 PQA', 'HITAM METALIK', 'BENSIN', 'R18Z12300056', 'MRHFB2620DP330040', '2659470/MJ/2012', '2018-03-28', 'Mobil Kepala Biro', 21, '2017-12-03 08:46:37', NULL, '1', NULL),
	(10, 2, 1, 0, 'GL PRO III', 'B 6104 PDQ', 'HITAM', 'BENSIN', 'KEHLE1174506', 'MH1KEHL146K175985', '11592583/MJ/2016', '2021-03-27', 'Operasional', 22, '2017-12-03 08:53:14', '2017-12-03', '1', '1'),
	(11, 2, 1, 0, 'Mega Pro', 'B 6099 PDQ', 'HITAM', 'BENSIN', 'KEHLE1174508', 'MH1KEHL136K175993', '0225403/MJ/2011', '2016-03-27', 'Operasional', 23, '2017-12-03 08:54:38', NULL, '1', NULL);
/*!40000 ALTER TABLE `ms_kendaraan` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.ms_merk
DROP TABLE IF EXISTS `ms_merk`;
CREATE TABLE IF NOT EXISTS `ms_merk` (
  `id_merk` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(50) NOT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.ms_merk: ~6 rows (approximately)
/*!40000 ALTER TABLE `ms_merk` DISABLE KEYS */;
INSERT INTO `ms_merk` (`id_merk`, `merk`) VALUES
	(1, 'Honda'),
	(2, 'Suzuki'),
	(3, 'Kia'),
	(4, 'Daihatsu'),
	(5, 'Toyota'),
	(6, 'Mitsubishi');
/*!40000 ALTER TABLE `ms_merk` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.ms_tipe
DROP TABLE IF EXISTS `ms_tipe`;
CREATE TABLE IF NOT EXISTS `ms_tipe` (
  `id_tipe` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) DEFAULT NULL,
  `tipe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipe`),
  KEY `FK_ms_tipe_ms_jenis` (`id_jenis`),
  CONSTRAINT `FK_ms_tipe_ms_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `ms_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.ms_tipe: ~0 rows (approximately)
/*!40000 ALTER TABLE `ms_tipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_tipe` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_attach
DROP TABLE IF EXISTS `sys_attach`;
CREATE TABLE IF NOT EXISTS `sys_attach` (
  `attachid` bigint(20) NOT NULL AUTO_INCREMENT,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`attachid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_attach: ~17 rows (approximately)
/*!40000 ALTER TABLE `sys_attach` DISABLE KEYS */;
INSERT INTO `sys_attach` (`attachid`, `dateinput`, `userinput`) VALUES
	(4, '2017-11-20 14:50:24', '1'),
	(5, '2017-11-21 07:15:13', '1'),
	(6, '2017-11-21 07:17:27', '1'),
	(10, '2017-11-21 20:45:59', '1'),
	(11, '2017-11-21 21:07:06', '1'),
	(12, '2017-11-21 21:13:43', '1'),
	(14, '2017-11-29 17:46:10', '1'),
	(15, '2017-12-03 07:14:36', '1'),
	(16, '2017-12-03 07:16:33', '1'),
	(17, '2017-12-03 08:34:14', '1'),
	(18, '2017-12-03 08:37:52', '1'),
	(19, '2017-12-03 08:42:12', '1'),
	(20, '2017-12-03 08:44:51', '1'),
	(21, '2017-12-03 08:46:37', '1'),
	(22, '2017-12-03 08:52:55', '1'),
	(23, '2017-12-03 08:54:38', '1'),
	(24, '2017-12-03 09:06:43', '1'),
	(25, '2017-12-03 21:37:56', '1');
/*!40000 ALTER TABLE `sys_attach` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_attach_dtl
DROP TABLE IF EXISTS `sys_attach_dtl`;
CREATE TABLE IF NOT EXISTS `sys_attach_dtl` (
  `recid` bigint(20) NOT NULL AUTO_INCREMENT,
  `attachid` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `filesize` float NOT NULL,
  `tumbnail` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`recid`),
  KEY `sys_attach_dtl_2_sys_attach_FK` (`attachid`),
  CONSTRAINT `sys_attach_dtl_2_sys_attach_FK` FOREIGN KEY (`attachid`) REFERENCES `sys_attach` (`attachid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_attach_dtl: ~15 rows (approximately)
/*!40000 ALTER TABLE `sys_attach_dtl` DISABLE KEYS */;
INSERT INTO `sys_attach_dtl` (`recid`, `attachid`, `title`, `description`, `filename`, `filetype`, `filesize`, `tumbnail`, `remarks`) VALUES
	(7, 4, 'Foto Kendaraan', 'Foto Kendaraan', 'error1.jpg', '', 0, NULL, NULL),
	(8, 5, 'Foto Kendaraan', 'Foto Kendaraan', 'Mobil-Terbaik-di-Indonesia.jpg', '', 0, NULL, NULL),
	(26, 14, 'Berkas Pendukung', 'Berkas Pendukung', '57054-200.png', '', 0, NULL, NULL),
	(27, 14, 'Berkas Pendukung', 'Berkas Pendukung', 'more-icons-76604.png', '', 0, NULL, NULL),
	(28, 6, 'Foto Kendaraan', 'Foto Kendaraan', 'Harga_Mobil_Honda.jpg', '', 0, NULL, NULL),
	(29, 15, 'Foto Kendaraan', 'Foto Kendaraan', 'Toyota_bekas.jpg', '', 0, NULL, NULL),
	(30, 16, 'Foto Kendaraan', 'Foto Kendaraan', 'Kijang+innova+vs+bekas.jpg', '', 0, NULL, NULL),
	(31, 17, 'Foto Kendaraan', 'Foto Kendaraan', 'travello.jpg', '', 0, NULL, NULL),
	(32, 18, 'Foto Kendaraan', 'Foto Kendaraan', 'innova_hijau_metalik.jpg', '', 0, NULL, NULL),
	(33, 19, 'Foto Kendaraan', 'Foto Kendaraan', 'civiv.jpg', '', 0, NULL, NULL),
	(34, 20, 'Foto Kendaraan', 'Foto Kendaraan', 'civic.jpg', '', 0, NULL, NULL),
	(35, 21, 'Foto Kendaraan', 'Foto Kendaraan', 'civic1.jpg', '', 0, NULL, NULL),
	(37, 22, 'Foto Kendaraan', 'Foto Kendaraan', '287711406_1_644x461_megapro-2006-orisinil-terawat-mesin-halus-tangki-utuh-pajak-baru-mojokerto-kota.jpg', '', 0, NULL, NULL),
	(38, 23, 'Foto Kendaraan', 'Foto Kendaraan', '287711406_1_644x461_megapro-2006-orisinil-terawat-mesin-halus-tangki-utuh-pajak-baru-mojokerto-kota1.jpg', '', 0, NULL, NULL),
	(39, 24, 'Berkas Pendukung', 'Berkas Pendukung', 'IMG_23371.JPG', '', 0, NULL, NULL),
	(40, 25, 'Berkas Pendukung', 'Berkas Pendukung', 'IMG_23371.JPG', '', 0, NULL, NULL);
/*!40000 ALTER TABLE `sys_attach_dtl` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_globalvar
DROP TABLE IF EXISTS `sys_globalvar`;
CREATE TABLE IF NOT EXISTS `sys_globalvar` (
  `varid` bigint(20) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `val_int` int(10) DEFAULT NULL,
  `val_float` decimal(30,2) DEFAULT NULL,
  `val_varchar` varchar(500) DEFAULT NULL,
  `val_date` date DEFAULT NULL,
  `val_datetime` datetime DEFAULT NULL,
  `val_text` longtext,
  `val_datefrom` date DEFAULT NULL,
  `val_dateto` date DEFAULT NULL,
  `developername` varchar(255) DEFAULT NULL,
  `guide` longtext,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`varid`),
  UNIQUE KEY `varname` (`varname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_globalvar: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_globalvar` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_globalvar` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_log_type
DROP TABLE IF EXISTS `sys_log_type`;
CREATE TABLE IF NOT EXISTS `sys_log_type` (
  `logtypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `used_user_rating` tinyint(1) DEFAULT '0',
  `used_user_rating_weight` decimal(30,2) DEFAULT '0.00',
  PRIMARY KEY (`logtypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_log_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_log_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log_type` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_privilege
DROP TABLE IF EXISTS `sys_privilege`;
CREATE TABLE IF NOT EXISTS `sys_privilege` (
  `privilegeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `roleid` bigint(20) NOT NULL,
  `sitemapid` bigint(20) NOT NULL,
  `dateinput` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`privilegeid`),
  KEY `sys_privilege_2_sys_sitemap_fk` (`sitemapid`),
  KEY `sys_privilege_2_sys_role_fk` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_role_fk` FOREIGN KEY (`roleid`) REFERENCES `sys_role` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_sitemap_fk` FOREIGN KEY (`sitemapid`) REFERENCES `sys_sitemap` (`sitemapid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_privilege: ~13 rows (approximately)
/*!40000 ALTER TABLE `sys_privilege` DISABLE KEYS */;
INSERT INTO `sys_privilege` (`privilegeid`, `roleid`, `sitemapid`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(9, 1, 1, '2017-11-05 18:35:24', '1', NULL, NULL),
	(10, 1, 2, '2017-11-05 18:35:59', '1', NULL, NULL),
	(11, 1, 3, '2017-11-05 18:36:16', '1', NULL, NULL),
	(12, 2, 1, '2017-11-05 18:36:35', '1', NULL, NULL),
	(15, 1, 4, '2017-11-23 07:28:01', '1', NULL, NULL),
	(16, 1, 5, '2017-11-23 07:28:25', '1', NULL, NULL),
	(18, 1, 6, '2017-11-28 16:24:17', '1', '2017-11-28 16:24:19', NULL),
	(19, 1, 7, '2017-11-28 18:15:43', '1', NULL, NULL),
	(20, 1, 8, '2017-11-28 18:15:57', '1', NULL, NULL),
	(21, 1, 9, '2017-11-29 12:39:30', '1', NULL, NULL),
	(22, 1, 10, '2017-12-03 20:50:27', '1', NULL, NULL),
	(23, 1, 11, '2017-12-03 22:46:51', '1', NULL, NULL),
	(24, 2, 6, '2017-12-03 22:50:26', '1', NULL, NULL),
	(25, 1, 12, '2017-12-03 23:06:30', '1', NULL, NULL);
/*!40000 ALTER TABLE `sys_privilege` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_role
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE IF NOT EXISTS `sys_role` (
  `roleid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `sys_role` DISABLE KEYS */;
INSERT INTO `sys_role` (`roleid`, `name`, `displayname`, `description`) VALUES
	(1, 'admin', 'Administrator', 'Administrator'),
	(2, 'biasa', 'User Biasa', 'User Biasa');
/*!40000 ALTER TABLE `sys_role` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.sys_sitemap
DROP TABLE IF EXISTS `sys_sitemap`;
CREATE TABLE IF NOT EXISTS `sys_sitemap` (
  `sitemapid` bigint(20) NOT NULL AUTO_INCREMENT,
  `sitemapid_parent` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `titlebar` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sortno` bigint(20) NOT NULL DEFAULT '999',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sitemapid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.sys_sitemap: ~10 rows (approximately)
/*!40000 ALTER TABLE `sys_sitemap` DISABLE KEYS */;
INSERT INTO `sys_sitemap` (`sitemapid`, `sitemapid_parent`, `name`, `displayname`, `titlebar`, `url`, `sortno`, `is_active`, `icon`) VALUES
	(1, 0, 'admin_dashboard', 'Dashboard', 'Dashboard', 'page', 1, 1, '<i class="fa fa-dashboard"></i>'),
	(2, 4, 'admin_master_kendaraan', 'Master Kendaraan', 'Master Kendaraan', 'ms_kendaraan', 2, 1, '<i class="fa fa-car"></i>'),
	(3, 0, 'admin_perawatan_kendaraan', 'Perawatan Kendaraan', 'Perawatan Kendaraan', 't_perawatan', 10, 1, '<i class="fa fa-gears"></i>'),
	(4, 0, 'admin_administrasi', 'Administrasi', 'Administrasi', NULL, 20, 1, '<i class="fa fa-keyboard-o"></i>'),
	(5, 4, 'admin_jenis_perawatan', 'Jenis Perawatan', 'Jenis Perawatan', 'Ms_jenis_perawatan', 10, 1, '<i class="fa fa-exchange"></i>'),
	(6, 0, 'user_keluhan', 'Keluhan', 'Keluhan', 't_keluhan', 5, 1, '<i class="fa fa-frown-o"></i>'),
	(7, 0, 'admin_laporan', 'Laporan', 'Laporan', NULL, 15, 1, '<i class="fa fa-list-alt"></i>'),
	(8, 7, 'admin_laporan_spk', 'SPK', 'SPK', 't_spk', 1, 1, '<i class="fa fa-file-text"></i>'),
	(9, 4, 'admin_alokasi_anggaran', 'Alokasi Anggaran', 'Alokasi Anggaran', 't_alokasi_anggaran', 5, 1, '<i class="fa fa-money"></i>'),
	(10, 7, 'admin_laporan_alokasi', 'Alokasi Anggaran', 'Alokasi Anggaran', 'laporan_alokasi', 10, 1, '<i class="fa fa-bank"></i>'),
	(11, 4, 'admin_user', 'User', 'User', 'Sys_user', 10, 1, '<i class="fa fa-users"></i>'),
	(12, 7, 'admin_laporan_tahunan', 'Laporan Tahunan', 'Laporan Tahunan', 'laporan_tahunan', 20, 1, '<i class="fa fa-calendar"></i>');
/*!40000 ALTER TABLE `sys_sitemap` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.t_alokasi_anggaran
DROP TABLE IF EXISTS `t_alokasi_anggaran`;
CREATE TABLE IF NOT EXISTS `t_alokasi_anggaran` (
  `id_alokasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NOT NULL,
  `tahun_anggaran` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_alokasi`),
  KEY `FK_t_alokasi_anggaran_ms_kendaraan` (`id_kendaraan`),
  CONSTRAINT `FK_t_alokasi_anggaran_ms_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `ms_kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.t_alokasi_anggaran: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_alokasi_anggaran` DISABLE KEYS */;
INSERT INTO `t_alokasi_anggaran` (`id_alokasi`, `id_kendaraan`, `tahun_anggaran`, `jumlah`) VALUES
	(2, 4, 2017, 30000000),
	(3, 3, 2017, 30000000),
	(4, 11, 2017, 10000000);
/*!40000 ALTER TABLE `t_alokasi_anggaran` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.t_jenis_perawatan_dtl
DROP TABLE IF EXISTS `t_jenis_perawatan_dtl`;
CREATE TABLE IF NOT EXISTS `t_jenis_perawatan_dtl` (
  `recid` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_perawatan_hdr` int(11) NOT NULL,
  `id_jenis_perawatan` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `catatan` text,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`recid`),
  KEY `FK_t_jenis_perawatan_dtl_t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`),
  KEY `FK_t_jenis_perawatan_dtl_ms_jenis_perawatan` (`id_jenis_perawatan`),
  CONSTRAINT `FK_t_jenis_perawatan_dtl_ms_jenis_perawatan` FOREIGN KEY (`id_jenis_perawatan`) REFERENCES `ms_jenis_perawatan` (`id_jenis_perawatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_jenis_perawatan_dtl_t_jenis_perawatan_hdr` FOREIGN KEY (`id_jenis_perawatan_hdr`) REFERENCES `t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.t_jenis_perawatan_dtl: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_jenis_perawatan_dtl` DISABLE KEYS */;
INSERT INTO `t_jenis_perawatan_dtl` (`recid`, `id_jenis_perawatan_hdr`, `id_jenis_perawatan`, `status`, `catatan`, `harga`, `jumlah`, `dateinput`, `userinput`) VALUES
	(78, 22, 1, 'Y', '', 100000, 0, '2017-12-03 21:10:15', '1'),
	(79, 22, 8, 'Y', '', 200000, 0, '2017-12-03 21:10:15', '1'),
	(80, 22, 36, 'Y', '', 200000, 0, '2017-12-03 21:10:15', '1'),
	(81, 23, 1, 'Y', '', 220000, 0, '2017-12-03 21:37:56', '1'),
	(82, 23, 6, 'Y', '', 450000, 1, '2017-12-03 21:37:56', '1'),
	(83, 23, 8, 'Y', 'balancing', 150000, 1, '2017-12-03 21:37:56', '1');
/*!40000 ALTER TABLE `t_jenis_perawatan_dtl` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.t_jenis_perawatan_hdr
DROP TABLE IF EXISTS `t_jenis_perawatan_hdr`;
CREATE TABLE IF NOT EXISTS `t_jenis_perawatan_hdr` (
  `id_jenis_perawatan_hdr` int(11) NOT NULL AUTO_INCREMENT,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis_perawatan_hdr`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.t_jenis_perawatan_hdr: ~1 rows (approximately)
/*!40000 ALTER TABLE `t_jenis_perawatan_hdr` DISABLE KEYS */;
INSERT INTO `t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`, `dateinput`, `userinput`) VALUES
	(22, '2017-12-03 21:10:15', '1'),
	(23, '2017-12-03 21:37:56', '1');
/*!40000 ALTER TABLE `t_jenis_perawatan_hdr` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.t_keluhan
DROP TABLE IF EXISTS `t_keluhan`;
CREATE TABLE IF NOT EXISTS `t_keluhan` (
  `id_keluhan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `id_berkas` bigint(20) DEFAULT NULL,
  `no_keluhan` varchar(50) NOT NULL,
  `pengguna` varchar(255) NOT NULL,
  `pemohon` varchar(50) NOT NULL,
  `keluhan` text NOT NULL,
  `userinput` varchar(50) NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userupdate` varchar(50) NOT NULL,
  `dateupdate` date NOT NULL,
  PRIMARY KEY (`id_keluhan`),
  KEY `FK_t_keluhan_ms_kendaraan` (`id_kendaraan`),
  KEY `FK_t_keluhan_auth_users` (`user_id`),
  KEY `FK_t_keluhan_sys_attach` (`id_berkas`),
  CONSTRAINT `FK_t_keluhan_auth_users` FOREIGN KEY (`user_id`) REFERENCES `auth_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_keluhan_ms_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `ms_kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_keluhan_sys_attach` FOREIGN KEY (`id_berkas`) REFERENCES `sys_attach` (`attachid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.t_keluhan: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_keluhan` DISABLE KEYS */;
INSERT INTO `t_keluhan` (`id_keluhan`, `id_kendaraan`, `user_id`, `id_berkas`, `no_keluhan`, `pengguna`, `pemohon`, `keluhan`, `userinput`, `dateinput`, `userupdate`, `dateupdate`) VALUES
	(6, 3, 1, NULL, 'KY/K/2017120308085558', 'Operasional Biro Umum', 'Abay', '<p>- Ganti Rem</p>\n\n<p>- Ganti Oli</p>\n\n<p>- Check Ban</p>\n\n<p>&nbsp;</p>\n', '1', '2017-12-03 08:56:41', '1', '2017-12-03'),
	(7, 11, 1, NULL, 'KY/K/2017120309090835', 'Bagian Keuangan', 'Babe', '<ol>\n	<li>service</li>\n	<li>ganti oli</li>\n	<li>ganti ban</li>\n</ol>\n', '1', '2017-12-03 09:09:21', '', '0000-00-00'),
	(8, 9, 4, NULL, 'KY/K/2017120303035308', 'Biro Umum', 'Biro Umum', '<ol>\n	<li>Rem Blong</li>\n</ol>\n', '4', '2017-12-03 22:53:26', '', '0000-00-00');
/*!40000 ALTER TABLE `t_keluhan` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.t_perawatan
DROP TABLE IF EXISTS `t_perawatan`;
CREATE TABLE IF NOT EXISTS `t_perawatan` (
  `id_perawatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_jenis_perawatan_hdr` int(11) DEFAULT NULL,
  `id_berkas_pendukung` bigint(20) DEFAULT NULL,
  `biro` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kilometer` int(11) NOT NULL,
  `lain_lain` text,
  `pengemudi` varchar(50) DEFAULT NULL,
  `pemakai` varchar(50) DEFAULT NULL,
  `masa_berlaku` date NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateupdate` date DEFAULT NULL,
  `userinput` varchar(50) NOT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_perawatan`),
  KEY `FK_t_perawatan_ms_kendaraan` (`id_kendaraan`),
  KEY `FK_t_perawatan_t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`),
  KEY `FK_t_perawatan_sys_attach` (`id_berkas_pendukung`),
  KEY `FK_t_perawatan_t_spk` (`id_spk`),
  CONSTRAINT `FK_t_perawatan_ms_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `ms_kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_perawatan_sys_attach` FOREIGN KEY (`id_berkas_pendukung`) REFERENCES `sys_attach` (`attachid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_perawatan_t_jenis_perawatan_hdr` FOREIGN KEY (`id_jenis_perawatan_hdr`) REFERENCES `t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_perawatan_t_spk` FOREIGN KEY (`id_spk`) REFERENCES `t_spk` (`id_spk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.t_perawatan: ~1 rows (approximately)
/*!40000 ALTER TABLE `t_perawatan` DISABLE KEYS */;
INSERT INTO `t_perawatan` (`id_perawatan`, `id_kendaraan`, `id_spk`, `id_jenis_perawatan_hdr`, `id_berkas_pendukung`, `biro`, `tanggal`, `kilometer`, `lain_lain`, `pengemudi`, `pemakai`, `masa_berlaku`, `dateinput`, `dateupdate`, `userinput`, `userupdate`) VALUES
	(12, 3, 5, 23, 25, 'Operasional Biro Umum', '2017-12-04', 45000, NULL, 'Abay', 'Biro Umum', '2018-02-28', '2017-12-03 21:37:56', NULL, '1', NULL);
/*!40000 ALTER TABLE `t_perawatan` ENABLE KEYS */;

-- Dumping structure for table sidiproj_kendaraan.t_spk
DROP TABLE IF EXISTS `t_spk`;
CREATE TABLE IF NOT EXISTS `t_spk` (
  `id_spk` int(11) NOT NULL AUTO_INCREMENT,
  `id_keluhan` int(11) NOT NULL,
  `no_spk` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `perawatan` text NOT NULL,
  `m_nama` varchar(255) NOT NULL,
  `m_jabatan` varchar(255) NOT NULL,
  `m_nip` varchar(255) NOT NULL,
  `m_hp` varchar(255) NOT NULL,
  `tembusan` text,
  `userinput` varchar(50) NOT NULL,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userupdate` varchar(50) NOT NULL,
  `dateupdate` date NOT NULL,
  PRIMARY KEY (`id_spk`),
  KEY `FK_t_spk_t_keluhan` (`id_keluhan`),
  CONSTRAINT `FK_t_spk_t_keluhan` FOREIGN KEY (`id_keluhan`) REFERENCES `t_keluhan` (`id_keluhan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table sidiproj_kendaraan.t_spk: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_spk` DISABLE KEYS */;
INSERT INTO `t_spk` (`id_spk`, `id_keluhan`, `no_spk`, `tanggal`, `kepada`, `alamat`, `perawatan`, `m_nama`, `m_jabatan`, `m_nip`, `m_hp`, `tembusan`, `userinput`, `dateinput`, `userupdate`, `dateupdate`) VALUES
	(5, 6, '02/03/30303-AL/2017', '2017-12-04', 'Bengkel Rekanan KY', 'Jl. Menteng Raya No 24 D/E Jakarta 10450', '<ol>\n	<li>Ganti Rem</li>\n	<li>Ganti Oli</li>\n	<li>Check Ban</li>\n</ol>\n', 'Christy Michiko', 'Kasubag Rumah Tangga', '19800519 200812 2 001', '08089', '1. Sekjen<br>\r\n2. PPK', '1', '2017-12-03 08:59:26', '1', '2017-12-03'),
	(8, 7, '10/223/utyt/2017', '2017-12-05', 'Bengkel Rekanan KY', 'Jl. Menteng Raya No 24 D/E Jakarta 10450', '<ol>\n	<li>service</li>\n	<li>ganti oli</li>\n	<li>ganti ban</li>\n</ol>\n', 'Christy Michiko', 'Kasubag Rumah Tangga', '19800519 200812 2 001', '0811187832', '<ol>\n	<li>Sekjen</li>\n	<li>PPK</li>\n</ol>\n', '1', '2017-12-03 22:30:45', '1', '2017-12-03');
/*!40000 ALTER TABLE `t_spk` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


--- view1
create or replace view t_spk_view as
select		x.id_spk, x.id_keluhan, x.no_spk, x.tanggal,
				x.kepada, x.alamat, x.perawatan,
				x.tembusan, x.m_nama, x.m_jabatan, x.m_nip, x.m_hp,
				x.userinput, x.dateinput,
				x.userupdate, x.dateupdate,
				y.no_keluhan, y.pengguna, y.pemohon, y.id_kendaraan,
				k.platno, k.nama_kendaraan
from			t_spk x
left join	t_keluhan y on y.id_keluhan = x.id_keluhan
left join	ms_kendaraan k on k.id_kendaraan = y.id_kendaraan
;
create or replace view t_perawatan_view as
select		x.id_perawatan, x.id_kendaraan, x.id_jenis_perawatan_hdr,
				x.biro, x.tanggal, x.kilometer, x.lain_lain,
				x.pengemudi, x.pemakai, x.masa_berlaku, 
				x.dateinput, x.dateupdate, x.userinput, x.userupdate,
				k.nama_kendaraan, k.platno,
				j.jenis,
				concat(right(x.tanggal,2), '-', 
				mid(x.tanggal,6,2), '-' ,
				left(x.tanggal,4)) as tanggal_char,
				
				concat(right(x.masa_berlaku,2), '-', 
				mid(x.masa_berlaku,6,2), '-' ,
				left(x.masa_berlaku,4)) as masa_berlaku_char,
				if( x.masa_berlaku < date(now()), 'Exipred', 'Valid' ) as masa_berlaku_status,
				left(x.tanggal,4) as tahun,
				x.id_berkas_pendukung,
				x.id_spk
from			t_perawatan x
left join	ms_kendaraan k on k.id_kendaraan = x.id_kendaraan
left join	ms_jenis j on k.id_jenis = j.id_jenis
;
create or replace view t_perawatan_berlaku_max_view as
select		x.id_kendaraan, max(x.masa_berlaku) as masa_berlaku_max
from			t_perawatan x
group by		x.id_kendaraan
;
create or replace view t_keluhan_view as
select		x.id_keluhan, x.id_kendaraan, x.user_id, x.id_berkas,
				x.no_keluhan, x.pengguna, x.pemohon, x.keluhan, x.userinput,
				x.dateinput, x.userupdate, x.dateupdate,
				concat(right(x.dateinput,2), '-', 
				mid(x.dateinput,6,2), '-' ,
				left(x.dateinput,4)) as dateinput_char,
				y.id_spk, p.id_perawatan,
				if(p.id_perawatan is not null, 'Close', 'Open') as status_keluhan
from			t_keluhan x
left join	t_spk y on y.id_keluhan = x.id_keluhan
left join	t_perawatan p on p.id_spk = y.id_spk
;
create or replace view t_jenis_perawatan_dtl_view as
select		x.recid, x.id_jenis_perawatan_hdr, x.id_jenis_perawatan,
				x.`status`, x.catatan, x.harga, x.jumlah, y.perawatan
from			t_jenis_perawatan_dtl x
left join	ms_jenis_perawatan y on y.id_jenis_perawatan =  x.id_jenis_perawatan
;
create or replace view t_jenis_perawatan_dtl_sum_view as
select		y.id_kendaraan, year(y.tanggal) as tahun,
				sum(x.harga) as total
from			t_jenis_perawatan_dtl x
left join	t_perawatan y on y.id_jenis_perawatan_hdr = x.id_jenis_perawatan_hdr
group by		y.id_kendaraan, year(y.tanggal)
;
create or replace view t_alokasi_anggaran_view as
select		x.id_alokasi, x.id_kendaraan, x.tahun_anggaran, x.jumlah,
				y.id_merk, y.nama_kendaraan, y.platno, m.merk
from			t_alokasi_anggaran x
left join	ms_kendaraan y on y.id_kendaraan = x.id_kendaraan
left join	ms_merk m  on m.id_merk = y.id_merk
;
create or replace view sys_privilege_view as 
select		x.sitemapid, x.roleid, x.dateinput, x.dateupdate, x.userinput, x.userupdate,
			y.sitemapid_parent, y.name, y.url, y.sortno, y.is_active, y.icon, y.displayname,
            z.name as role_name
from		sys_privilege x
left join	sys_sitemap y on x.sitemapid = y.sitemapid
left join	sys_role z  on z.roleid = x.roleid
;
create or replace view sys_attach_dtl_view as
select		x.recid, x.attachid, x.title,
				x.description, x.filename, x.filetype,
				x.filesize, x.tumbnail, x.remarks,
				round((x.filesize),0) as filesize_kb
from			sys_attach_dtl x
;
create or replace  view ms_jenis_perawatan_view as
select		x.id_jenis_perawatan, x.id_group, x.perawatan,
				y.`group`
from			ms_jenis_perawatan x
left join	ms_jenis_perawatan_group y on y.id_group = x.id_group
;
create or replace view ms_kendaraan_view as
select		x.id_kendaraan, x.id_jenis, x.id_merk, x.tahun_pembuatan,
				x.nama_kendaraan, x.platno, x.warna, x.bahan_bakar,
				x.no_mesin, x.no_rangka, x.no_stnk, x.masa_berlaku_stnk,
				x.catatan, x.id_foto_kendaraan, x.dateinput, x.dateupdate,
				x.userinput, x.userupdate,
				j.jenis, m.merk,
				concat(right(x.masa_berlaku_stnk,2), '-', 
				mid(x.masa_berlaku_stnk,6,2), '-' ,
				left(x.masa_berlaku_stnk,4)) as masa_berlaku_stnk_char,
				sd.filename as gambar,
				sd.recid as gambarid,
				if( x.masa_berlaku_stnk < date(now()), 'Expired', 'Valid' ) as status_stnk,
				if( mx.masa_berlaku_max < date(now()), 'Expired', 'Valid' ) as status_perawatan
from			ms_kendaraan x
left join	ms_jenis j on j.id_jenis =  x.id_jenis
left join	ms_merk m on m.id_merk = x.id_merk
left join	sys_attach_dtl sd on sd.attachid = x.id_foto_kendaraan
left join	t_perawatan_berlaku_max_view mx on mx.id_kendaraan = x.id_kendaraan
;
create or replace view t_alokasi_anggaran_sum_view as
select		x.id_kendaraan, x.tahun_anggaran, x.jumlah,
				ifnull(y.total,0) as total,
				x.jumlah - ifnull(y.total,0) as selisih,
				round(((ifnull(y.total,0) / x.jumlah) * 100)) as persentase
from			t_alokasi_anggaran x
left join	t_jenis_perawatan_dtl_sum_view  y on y.id_kendaraan = x.id_kendaraan
				and y.tahun = x.tahun_anggaran
;
