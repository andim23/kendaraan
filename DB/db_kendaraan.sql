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


-- Dumping database structure for db_kendaraan
CREATE DATABASE IF NOT EXISTS `db_kendaraan` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_kendaraan`;

-- Dumping structure for table db_kendaraan.auth_acl
CREATE TABLE IF NOT EXISTS `auth_acl` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ai`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_acl_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `auth_acl_actions` (`action_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_acl: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_acl_actions
CREATE TABLE IF NOT EXISTS `auth_acl_actions` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `action_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `auth_acl_actions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `auth_acl_categories` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_acl_actions: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl_actions` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_acl_categories
CREATE TABLE IF NOT EXISTS `auth_acl_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `category_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_code` (`category_code`),
  UNIQUE KEY `category_desc` (`category_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_acl_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_acl_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_acl_categories` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_ci_sessions
CREATE TABLE IF NOT EXISTS `auth_ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_ci_sessions: 0 rows
/*!40000 ALTER TABLE `auth_ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_ci_sessions` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_denied_access
CREATE TABLE IF NOT EXISTS `auth_denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_denied_access: 0 rows
/*!40000 ALTER TABLE `auth_denied_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_denied_access` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_ips_on_hold
CREATE TABLE IF NOT EXISTS `auth_ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_ips_on_hold: 0 rows
/*!40000 ALTER TABLE `auth_ips_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_ips_on_hold` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_login_errors
CREATE TABLE IF NOT EXISTS `auth_login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=343 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_login_errors: 0 rows
/*!40000 ALTER TABLE `auth_login_errors` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_login_errors` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_sessions
CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_sessions: 2 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
	('55b15e1b6d7a0503d35f2ee3ea2edb67db6f13e4', 1, '2017-11-05 11:51:02', '2017-11-06 00:16:28', '::1', 'Chrome 61.0.3163.100 on Windows 10'),
	('48cdeeee0a446c71c5170e1a6c855840f9589296', 1, '2017-11-06 01:36:46', '2017-11-06 08:36:46', '::1', 'Chrome 61.0.3163.100 on Windows 10');
/*!40000 ALTER TABLE `auth_sessions` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_username_or_email_on_hold
CREATE TABLE IF NOT EXISTS `auth_username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_username_or_email_on_hold: 0 rows
/*!40000 ALTER TABLE `auth_username_or_email_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_username_or_email_on_hold` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.auth_users
CREATE TABLE IF NOT EXISTS `auth_users` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.auth_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_users` DISABLE KEYS */;
INSERT INTO `auth_users` (`user_id`, `username`, `email`, `fullname`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
	(1, 'admin', 'admin@email.com', 'Administrator', 1, '0', '$2y$11$eAiQVPLDrbemhQrkb0qt1.Ac3Nhb1pmdgOBbPbgstYIngb1m9NACO', NULL, NULL, NULL, '2017-11-06 01:36:46', '2017-10-28 08:06:14', '2017-11-06 08:36:46');
/*!40000 ALTER TABLE `auth_users` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.ms_jenis
CREATE TABLE IF NOT EXISTS `ms_jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.ms_jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `ms_jenis` DISABLE KEYS */;
INSERT INTO `ms_jenis` (`id_jenis`, `jenis`) VALUES
	(1, 'Mobil'),
	(2, 'Motor');
/*!40000 ALTER TABLE `ms_jenis` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.ms_jenis_perawatan
CREATE TABLE IF NOT EXISTS `ms_jenis_perawatan` (
  `id_jenis_perawatan` int(11) NOT NULL AUTO_INCREMENT,
  `perawatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_perawatan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.ms_jenis_perawatan: ~6 rows (approximately)
/*!40000 ALTER TABLE `ms_jenis_perawatan` DISABLE KEYS */;
INSERT INTO `ms_jenis_perawatan` (`id_jenis_perawatan`, `perawatan`) VALUES
	(1, 'Oli Mesin'),
	(2, 'Oli Gardan'),
	(3, 'Oli Verseneling'),
	(4, 'Tune Up'),
	(5, 'Ganti Ban'),
	(6, 'Service Rem');
/*!40000 ALTER TABLE `ms_jenis_perawatan` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.ms_kendaraan
CREATE TABLE IF NOT EXISTS `ms_kendaraan` (
  `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.ms_kendaraan: ~1 rows (approximately)
/*!40000 ALTER TABLE `ms_kendaraan` DISABLE KEYS */;
INSERT INTO `ms_kendaraan` (`id_kendaraan`, `id_jenis`, `id_merk`, `nama_kendaraan`, `platno`, `warna`, `bahan_bakar`, `no_mesin`, `no_rangka`, `no_stnk`, `masa_berlaku_stnk`, `catatan`, `id_foto_kendaraan`, `dateinput`, `dateupdate`, `userinput`, `userupdate`) VALUES
	(1, 2, 1, 'Motor 1', '1234', 'hitam', 'bensin', '1234', '1234', '1234', '2017-11-23', 'g ada catatan', NULL, '2017-11-05 22:21:14', '2017-11-05', '1', '1');
/*!40000 ALTER TABLE `ms_kendaraan` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.ms_merk
CREATE TABLE IF NOT EXISTS `ms_merk` (
  `id_merk` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(50) NOT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.ms_merk: ~6 rows (approximately)
/*!40000 ALTER TABLE `ms_merk` DISABLE KEYS */;
INSERT INTO `ms_merk` (`id_merk`, `merk`) VALUES
	(1, 'Honda'),
	(2, 'Suzuki'),
	(3, 'Kia'),
	(4, 'Daihatsu'),
	(5, 'Toyota'),
	(6, 'Mitsubishi');
/*!40000 ALTER TABLE `ms_merk` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.ms_tipe
CREATE TABLE IF NOT EXISTS `ms_tipe` (
  `id_tipe` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) DEFAULT NULL,
  `tipe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipe`),
  KEY `FK_ms_tipe_ms_jenis` (`id_jenis`),
  CONSTRAINT `FK_ms_tipe_ms_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `ms_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.ms_tipe: ~0 rows (approximately)
/*!40000 ALTER TABLE `ms_tipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_tipe` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_attach
CREATE TABLE IF NOT EXISTS `sys_attach` (
  `attachid` bigint(20) NOT NULL AUTO_INCREMENT,
  `dateinput` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`attachid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_attach: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_attach` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_attach` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_attach_dtl
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_attach_dtl: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_attach_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_attach_dtl` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_globalvar
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
  `dateinput` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`varid`),
  UNIQUE KEY `varname` (`varname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_globalvar: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_globalvar` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_globalvar` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_log_type
CREATE TABLE IF NOT EXISTS `sys_log_type` (
  `logtypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `used_user_rating` tinyint(1) DEFAULT '0',
  `used_user_rating_weight` decimal(30,2) DEFAULT '0.00',
  PRIMARY KEY (`logtypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_log_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_log_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log_type` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_privilege
CREATE TABLE IF NOT EXISTS `sys_privilege` (
  `privilegeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `roleid` bigint(20) NOT NULL,
  `sitemapid` bigint(20) NOT NULL,
  `dateinput` datetime DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`privilegeid`),
  KEY `sys_privilege_2_sys_sitemap_fk` (`sitemapid`),
  KEY `sys_privilege_2_sys_role_fk` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_role_fk` FOREIGN KEY (`roleid`) REFERENCES `sys_role` (`roleid`),
  CONSTRAINT `sys_privilege_2_sys_sitemap_fk` FOREIGN KEY (`sitemapid`) REFERENCES `sys_sitemap` (`sitemapid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_privilege: ~5 rows (approximately)
/*!40000 ALTER TABLE `sys_privilege` DISABLE KEYS */;
INSERT INTO `sys_privilege` (`privilegeid`, `roleid`, `sitemapid`, `dateinput`, `userinput`, `dateupdate`, `userupdate`) VALUES
	(9, 1, 1, '2017-11-05 18:35:24', '1', NULL, NULL),
	(10, 1, 2, '2017-11-05 18:35:59', '1', NULL, NULL),
	(11, 1, 3, '2017-11-05 18:36:16', '1', NULL, NULL),
	(12, 2, 1, '2017-11-05 18:36:35', '1', NULL, NULL),
	(13, 2, 3, '2017-11-05 18:36:47', '1', NULL, NULL);
/*!40000 ALTER TABLE `sys_privilege` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_role
CREATE TABLE IF NOT EXISTS `sys_role` (
  `roleid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `sys_role` DISABLE KEYS */;
INSERT INTO `sys_role` (`roleid`, `name`, `displayname`, `description`) VALUES
	(1, 'admin', 'Admmin', 'Adminsitrator'),
	(2, 'user', 'User', 'User Biasa');
/*!40000 ALTER TABLE `sys_role` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_sitemap
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_sitemap: ~3 rows (approximately)
/*!40000 ALTER TABLE `sys_sitemap` DISABLE KEYS */;
INSERT INTO `sys_sitemap` (`sitemapid`, `sitemapid_parent`, `name`, `displayname`, `titlebar`, `url`, `sortno`, `is_active`, `icon`) VALUES
	(1, 0, 'admin_dashboard', 'Dashboard', 'Dashboard', 'page', 1, 1, NULL),
	(2, 0, 'admin_master_kendaraan', 'Master Kendaraan', 'Master Kendaraan', 'ms_kendaraan', 2, 1, NULL),
	(3, 0, 'admin_perawatan_kendaraan', 'Perawatan Kendaraan', 'Perawatan Kendaraan', 't_perawatan', 3, 1, NULL);
/*!40000 ALTER TABLE `sys_sitemap` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_user
CREATE TABLE IF NOT EXISTS `sys_user` (
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `usertelpno` varchar(50) DEFAULT NULL,
  `userphoto` varchar(255) DEFAULT NULL,
  `roleid` bigint(20) NOT NULL,
  `provid` bigint(20) DEFAULT NULL,
  `kabid` bigint(20) DEFAULT NULL,
  `dinasid` bigint(20) DEFAULT NULL,
  `idsatker` bigint(20) DEFAULT NULL,
  `dateinput` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `sys_user_UQ2` (`useremail`),
  UNIQUE KEY `sys_user_UQ1` (`username`),
  KEY `sys_user_2_sys_role_fk` (`roleid`),
  KEY `sys_user_2_ms_dinas_FK` (`dinasid`),
  CONSTRAINT `sys_user_2_ms_dinas_FK` FOREIGN KEY (`dinasid`) REFERENCES `ms_dinas` (`dinasid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `sys_user_2_sys_role_fk` FOREIGN KEY (`roleid`) REFERENCES `sys_role` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_user` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.sys_user_log
CREATE TABLE IF NOT EXISTS `sys_user_log` (
  `logid` bigint(20) NOT NULL AUTO_INCREMENT,
  `logtypeid` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `sitemapid` bigint(20) NOT NULL,
  `logdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(255) DEFAULT NULL,
  `freetext` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`logid`),
  KEY `sys_user_log_2_sys_sitemap_fk` (`sitemapid`),
  KEY `sys_user_log_2_sys_user_fk` (`userid`),
  KEY `sys_user_log_2_sys_log_type_FK` (`logtypeid`),
  CONSTRAINT `sys_user_log_2_sys_log_type_FK` FOREIGN KEY (`logtypeid`) REFERENCES `sys_log_type` (`logtypeid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `sys_user_log_2_sys_sitemap_fk` FOREIGN KEY (`sitemapid`) REFERENCES `sys_sitemap` (`sitemapid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sys_user_log_2_sys_user_fk` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.sys_user_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_user_log` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.t_jenis_perawatan_dtl
CREATE TABLE IF NOT EXISTS `t_jenis_perawatan_dtl` (
  `recid` int(11) NOT NULL AUTO_INCREMENT,
  `id_perawatan` int(11) NOT NULL,
  `id_jenis_perawatan_hdr` int(11) NOT NULL,
  `id_jenis_perawatan` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `catatan` int(11) NOT NULL,
  PRIMARY KEY (`recid`),
  KEY `FK_t_jenis_perawatan_t_perawatan` (`id_perawatan`),
  KEY `FK_t_jenis_perawatan_dtl_t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`),
  KEY `FK_t_jenis_perawatan_dtl_ms_jenis_perawatan` (`id_jenis_perawatan`),
  CONSTRAINT `FK_t_jenis_perawatan_dtl_ms_jenis_perawatan` FOREIGN KEY (`id_jenis_perawatan`) REFERENCES `ms_jenis_perawatan` (`id_jenis_perawatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_jenis_perawatan_dtl_t_jenis_perawatan_hdr` FOREIGN KEY (`id_jenis_perawatan_hdr`) REFERENCES `t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_jenis_perawatan_t_perawatan` FOREIGN KEY (`id_perawatan`) REFERENCES `t_perawatan` (`id_perawatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.t_jenis_perawatan_dtl: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_jenis_perawatan_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_jenis_perawatan_dtl` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.t_jenis_perawatan_hdr
CREATE TABLE IF NOT EXISTS `t_jenis_perawatan_hdr` (
  `id_jenis_perawatan_hdr` int(11) NOT NULL AUTO_INCREMENT,
  `dateinput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userinput` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis_perawatan_hdr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.t_jenis_perawatan_hdr: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_jenis_perawatan_hdr` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_jenis_perawatan_hdr` ENABLE KEYS */;

-- Dumping structure for table db_kendaraan.t_perawatan
CREATE TABLE IF NOT EXISTS `t_perawatan` (
  `id_perawatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NOT NULL,
  `id_jenis_perawatan_hdr` int(11) NOT NULL,
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
  CONSTRAINT `FK_t_perawatan_ms_kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `ms_kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_perawatan_t_jenis_perawatan_hdr` FOREIGN KEY (`id_jenis_perawatan_hdr`) REFERENCES `t_jenis_perawatan_hdr` (`id_jenis_perawatan_hdr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_kendaraan.t_perawatan: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_perawatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_perawatan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


-- view2
create or replace view sys_privilege_view as 
select		x.sitemapid, x.roleid, x.dateinput, x.dateupdate, x.userinput, x.userupdate,
			y.sitemapid_parent, y.name, y.url, y.sortno, y.is_active, y.icon, y.displayname,
            z.name as role_name
from		sys_privilege x
left join	sys_sitemap y on x.sitemapid = y.sitemapid
left join	sys_role z  on z.roleid = x.roleid;

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
				null as masa_berlaku_status
from			t_perawatan x
left join	ms_kendaraan k on k.id_kendaraan = x.id_kendaraan
left join	ms_jenis j on k.id_jenis = j.id_jenis
;

create or replace view ms_kendaraan_view as
select		x.id_kendaraan, x.id_jenis, x.id_merk, 
				x.nama_kendaraan, x.platno, x.warna, x.bahan_bakar,
				x.no_mesin, x.no_rangka, x.no_stnk, x.masa_berlaku_stnk,
				x.catatan, x.id_foto_kendaraan, x.dateinput, x.dateupdate,
				x.userinput, x.userupdate,
				j.jenis, m.merk,
				concat(right(x.masa_berlaku_stnk,2), '-', 
				mid(x.masa_berlaku_stnk,6,2), '-' ,
				left(x.masa_berlaku_stnk,4)) as masa_berlaku_stnk_char
from			ms_kendaraan x
left join	ms_jenis j on j.id_jenis =  x.id_jenis
left join	ms_merk m on m.id_merk = x.id_merk
;

create or replace view sys_attach_dtl_view as
select		x.recid, x.attachid, x.title,
				x.description, x.filename, x.filetype,
				x.filesize, x.tumbnail, x.remarks,
				round((x.filesize),0) as filesize_kb
from			sys_attach_dtl x
;


