-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table tamaapp.activity_pm
CREATE TABLE IF NOT EXISTS `activity_pm` (
  `id_activity` varchar(15) NOT NULL,
  `personel_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_activity`),
  KEY `personel_id` (`personel_id`),
  KEY `shift_id` (`shift_id`),
  CONSTRAINT `activity_pm_ibfk_1` FOREIGN KEY (`personel_id`) REFERENCES `personel` (`id_personel`) ON DELETE CASCADE,
  CONSTRAINT `activity_pm_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift_kerja` (`id_shift`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.activity_pm: ~1 rows (approximately)
INSERT INTO `activity_pm` (`id_activity`, `personel_id`, `shift_id`, `tanggal_kegiatan`, `created_at`) VALUES
	('ACT_150225979', 6, 3, '2025-02-15', '2025-02-15 02:00:41');

-- Dumping structure for table tamaapp.checklist
CREATE TABLE IF NOT EXISTS `checklist` (
  `id_checklist` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `kegiatan_1` varchar(255) NOT NULL,
  `status_1` enum('OK','NOT OK') NOT NULL,
  `kegiatan_2` varchar(255) NOT NULL,
  `status_2` enum('OK','NOT OK') NOT NULL,
  `kegiatan_3` varchar(255) NOT NULL,
  `status_3` enum('OK','NOT OK') NOT NULL,
  `catatan` text DEFAULT NULL,
  PRIMARY KEY (`id_checklist`),
  KEY `activity_id` (`activity_id`),
  KEY `device_id` (`device_id`),
  CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id_activity`) ON DELETE CASCADE,
  CONSTRAINT `checklist_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `ms_device_hidn` (`device_hidn_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.checklist: ~0 rows (approximately)

-- Dumping structure for table tamaapp.documentation
CREATE TABLE IF NOT EXISTS `documentation` (
  `id_documentation` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` varchar(15) NOT NULL,
  `laporan` enum('harian','mingguan','bulanan') NOT NULL,
  `area_id` int(11) NOT NULL,
  `group_device_id` int(11) NOT NULL,
  `sub_device_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_documentation`),
  KEY `area_id` (`area_id`),
  KEY `group_device_id` (`group_device_id`),
  KEY `sub_device_id` (`sub_device_id`),
  KEY `device_id` (`device_id`),
  CONSTRAINT `documentation_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `ms_area` (`area_id`),
  CONSTRAINT `documentation_ibfk_2` FOREIGN KEY (`group_device_id`) REFERENCES `ms_groupdevices` (`pek_unit_id`),
  CONSTRAINT `documentation_ibfk_3` FOREIGN KEY (`sub_device_id`) REFERENCES `ms_sub_device` (`sub_device_id`),
  CONSTRAINT `documentation_ibfk_4` FOREIGN KEY (`device_id`) REFERENCES `ms_device_hidn` (`device_hidn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.documentation: ~0 rows (approximately)

-- Dumping structure for table tamaapp.documentation_photos
CREATE TABLE IF NOT EXISTS `documentation_photos` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_documentation` int(11) NOT NULL,
  `foto_perangkat` varchar(255) NOT NULL,
  `foto_lokasi` varchar(255) NOT NULL,
  `foto_teknisi` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_photo`),
  KEY `id_documentation` (`id_documentation`),
  CONSTRAINT `documentation_photos_ibfk_1` FOREIGN KEY (`id_documentation`) REFERENCES `documentation` (`id_documentation`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.documentation_photos: ~0 rows (approximately)

-- Dumping structure for table tamaapp.kegiatan_ceklist
CREATE TABLE IF NOT EXISTS `kegiatan_ceklist` (
  `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kegiatan`),
  KEY `device_id` (`device_id`),
  CONSTRAINT `kegiatan_ceklist_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `ms_device_hidn` (`device_hidn_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.kegiatan_ceklist: ~6 rows (approximately)
INSERT INTO `kegiatan_ceklist` (`id_kegiatan`, `device_id`, `nama_kegiatan`) VALUES
	(1, 1, 'Cek Lampu Indikator'),
	(2, 1, 'Cek Koneksi Printer'),
	(3, 1, 'Cek Status Printer'),
	(4, 2, 'Cek Koneksi IP'),
	(5, 2, 'Cek Koneksi Proxy'),
	(6, 2, 'Cek Status Switch');

-- Dumping structure for table tamaapp.ms_account
CREATE TABLE IF NOT EXISTS `ms_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','management','spv','teknisi') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.ms_account: ~0 rows (approximately)
INSERT INTO `ms_account` (`id`, `username`, `password`, `role`, `created_at`) VALUES
	(1, 'admin', '$2y$10$jDlaKqUyUAuPjHeWMV0rBerlosMO38Y3ATQwIgLdG9Yx2/pISsu3u', 'admin', '2025-01-24 10:43:08'),
	(2, 'azra', '$2y$10$1fHspzTLEtjtYu6yyXYGrOyuEEj0yMjNTo2R6kXUhv1bt/29Nsmnq', 'admin', '2025-01-27 06:04:20');

-- Dumping structure for table tamaapp.ms_area
CREATE TABLE IF NOT EXISTS `ms_area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(300) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_area: ~19 rows (approximately)
INSERT INTO `ms_area` (`area_id`, `area_name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(48, 'TERMINAL 1', NULL, '2024-02-03 11:34:15', NULL, NULL),
	(49, 'TERMINAL 2', NULL, '2024-02-03 11:34:17', NULL, NULL),
	(50, 'TERMINAL 3', NULL, '2024-02-03 11:34:18', NULL, NULL),
	(51, 'NON TERMINAL', NULL, '2024-02-03 11:34:20', NULL, NULL),
	(52, 'STASIUN SKYTRAIN', NULL, '2024-02-03 11:34:14', NULL, NULL),
	(53, 'STASIUN IB', NULL, '2024-02-03 11:34:11', NULL, NULL),
	(54, 'TOD', NULL, '2024-02-03 11:34:08', NULL, NULL),
	(55, 'CARGO', NULL, '2024-02-03 11:33:31', NULL, NULL),
	(56, 'APRON', NULL, '2024-02-03 11:34:40', NULL, NULL),
	(57, 'PARIMETER', NULL, '2024-02-03 11:34:49', NULL, NULL),
	(58, 'LANDSIDE', NULL, '2024-02-03 11:34:55', NULL, NULL),
	(59, 'MAIN POWER STATION (MPS)', NULL, '2024-02-03 11:35:11', NULL, NULL),
	(60, 'PARKING', NULL, '2024-02-03 11:35:28', NULL, NULL),
	(61, 'POOL TAXI', NULL, '2024-02-03 11:35:51', NULL, NULL),
	(62, 'DKTNEW', NULL, '2024-02-03 11:36:00', NULL, NULL),
	(63, 'GEDUNG AOCC', NULL, '2024-02-03 11:36:12', NULL, NULL),
	(64, 'PERKANTORAN 601', NULL, '2024-02-03 11:36:38', NULL, NULL),
	(65, 'PERKANTORAN 600', NULL, '2024-02-03 16:43:57', NULL, NULL),
	(66, 'GEDUNG VVIP', NULL, '2024-02-03 16:44:07', NULL, NULL);

-- Dumping structure for table tamaapp.ms_device_hidn
CREATE TABLE IF NOT EXISTS `ms_device_hidn` (
  `device_hidn_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_hidn_name` varchar(300) DEFAULT NULL,
  `jum_device_hidn` varchar(300) DEFAULT NULL,
  `sub_device_name` varchar(300) DEFAULT NULL,
  `pek_unit_name` varchar(300) DEFAULT NULL,
  `sub_area_name` varchar(300) DEFAULT NULL,
  `area_name` varchar(300) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`device_hidn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_device_hidn: ~5 rows (approximately)
INSERT INTO `ms_device_hidn` (`device_hidn_id`, `device_hidn_name`, `jum_device_hidn`, `sub_device_name`, `pek_unit_name`, `sub_area_name`, `area_name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(1, 'Printer 1', '1', 'PRINTER-MPS-A4', 'SEWA PRINTER', 'PERKANTORAN 601', 'PERKANTORAN 601', NULL, '2024-02-05 16:49:20', NULL, NULL),
	(2, 'Printer 2', '1', 'PRINTER-MPS-A4', 'SEWA PRINTER', 'PERKANTORAN 601', 'PERKANTORAN 601', NULL, '2024-02-05 23:59:15', NULL, NULL),
	(3, 'Printer 3', '1', 'PRINTER-MPS-A4', 'SEWA PRINTER', 'DISTRIBUTION 601', 'PERKANTORAN 601', NULL, '2024-02-06 00:00:58', NULL, NULL),
	(4, 'Printer 4', '1', 'PRINTER-MPS-A4', 'SEWA PRINTER', 'PERKANTORAN 601', 'PERKANTORAN 601', NULL, '2024-02-06 00:02:45', NULL, NULL),
	(5, 'Printer 5', '1', 'PRINTER-MPS-A4', 'SEWA PRINTER', 'PERKANTORAN 601', 'PERKANTORAN 601', NULL, '2024-02-06 00:03:06', NULL, NULL);

-- Dumping structure for table tamaapp.ms_groupdevices
CREATE TABLE IF NOT EXISTS `ms_groupdevices` (
  `pek_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `pek_unit_name` varchar(300) DEFAULT NULL,
  `subunit_pek_name` varchar(300) DEFAULT NULL,
  `inisial_unit_kerja` varchar(300) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`pek_unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_groupdevices: ~36 rows (approximately)
INSERT INTO `ms_groupdevices` (`pek_unit_id`, `pek_unit_name`, `subunit_pek_name`, `inisial_unit_kerja`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(77, 'PERANGKAT IT NON PUBLIC SERVICE', 'OM IT NON PUBLIC APS', 'HIDN', NULL, NULL, NULL, NULL),
	(78, 'SEWA LAPTOP', 'OM LAPTOP APSD', 'HIDN', NULL, NULL, NULL, NULL),
	(79, 'SEWA PRINTER', 'OM PRINTER APS', 'HIDN', NULL, NULL, NULL, NULL),
	(80, 'IGCS', 'OM DATA NETWORK APS', 'HIDC', NULL, NULL, NULL, NULL),
	(81, 'DATA NETWORK', 'OM DATA NETWORK APS', 'HIDC', NULL, NULL, NULL, NULL),
	(82, 'CRASHBELL', 'OM DATA NETWORK APS', 'HIDC', NULL, NULL, NULL, NULL),
	(83, 'RADIO VHF AIR TO GROUND', 'OM DATA NETWORK APS', 'HIDC', NULL, NULL, NULL, NULL),
	(84, 'MONITOR FIDS', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(85, 'MINI PC', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(86, 'SSCI ISLAND F', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(87, 'FARM SERVER', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(88, 'MIDDLEWARE', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(89, 'APPS MCO', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(90, 'APPS SITA', 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(91, 'CCTV', 'OM CCTV APS', 'HISS', NULL, NULL, NULL, NULL),
	(92, 'PERALATAN CHECK-IN DAN CONVEYOR', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(93, 'PERALATAN AUTOMATIC XORTER ', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(94, 'PERALATAN DEPARTURE CAROUSEL ', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(95, 'PERALATAN CLAIM ARRIVAL', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(96, 'SERVER BHS', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(97, 'EXPLOSIVE CONTAINMENT ', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(98, 'PERALATAN X-RAY', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(99, 'WORKSTATION', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(100, 'MAINROOM', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(101, 'AVSECROOM', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(102, 'LTOC', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(103, 'AICC', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(104, 'TOC T1', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(105, 'TOC T2', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(106, 'TOC T3', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(107, 'PC MONITORING', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(108, 'VIDEO WALL DISPLAY', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(109, 'VIDEO WALL PROCESSOR', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(110, 'INTERACTIVE DIGITAL BOARD', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(111, 'SERVER', 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL),
	(112, 'SERVER HBS', 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL);

-- Dumping structure for table tamaapp.ms_subunit
CREATE TABLE IF NOT EXISTS `ms_subunit` (
  `subunit_id` int(11) NOT NULL AUTO_INCREMENT,
  `subunit_pek_name` varchar(300) DEFAULT NULL,
  `inisial_unit_kerja` varchar(300) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`subunit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_subunit: ~8 rows (approximately)
INSERT INTO `ms_subunit` (`subunit_id`, `subunit_pek_name`, `inisial_unit_kerja`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(60, 'OM IT NON PUBLIC APS', 'HIDN', NULL, NULL, NULL, NULL),
	(61, 'OM LAPTOP APSD', 'HIDN', NULL, NULL, NULL, NULL),
	(62, 'OM PRINTER APS', 'HIDN', NULL, NULL, NULL, NULL),
	(63, 'OM DATA NETWORK APS', 'HIDC', NULL, NULL, NULL, NULL),
	(64, 'OM FIDS APS', 'HIPS', NULL, NULL, NULL, NULL),
	(65, 'OM CCTV APS', 'HISS', NULL, NULL, NULL, NULL),
	(66, 'OM BHS T3', 'HIBS', NULL, NULL, NULL, NULL),
	(67, 'OM IT AOCC', 'HIDA', NULL, NULL, NULL, NULL);

-- Dumping structure for table tamaapp.ms_sub_area
CREATE TABLE IF NOT EXISTS `ms_sub_area` (
  `sub_area_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_area_name` varchar(300) DEFAULT NULL,
  `gr_area_name` varchar(300) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_sub_area: ~134 rows (approximately)
INSERT INTO `ms_sub_area` (`sub_area_id`, `sub_area_name`, `gr_area_name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(66, 'ISLAND A', 'TERMINAL 3', NULL, '2024-02-03 11:58:57', NULL, NULL),
	(67, 'ISLAND B', 'TERMINAL 3', NULL, '2024-02-03 11:59:32', NULL, NULL),
	(68, 'ISLAND C', 'TERMINAL 3', NULL, '2024-02-03 11:59:41', NULL, NULL),
	(69, 'ISLAND D', 'TERMINAL 3', NULL, '2024-02-03 11:59:48', NULL, NULL),
	(70, 'ISLAND E', 'TERMINAL 3', NULL, '2024-02-03 11:59:56', NULL, NULL),
	(71, 'ISLAND F', 'TERMINAL 3', NULL, '2024-02-03 12:00:03', NULL, NULL),
	(72, 'Screening', 'TERMINAL 3', NULL, '2024-02-03 12:00:19', NULL, NULL),
	(73, 'Makeup', 'TERMINAL 3', NULL, '2024-02-03 12:00:31', NULL, NULL),
	(74, 'Baggage Claim Arrival', 'TERMINAL 3', NULL, '2024-02-03 12:00:45', NULL, NULL),
	(75, 'Ruang Server BHS', 'TERMINAL 3', NULL, '2024-02-03 12:00:55', NULL, NULL),
	(76, 'TERMINAL 1', 'TERMINAL 1', NULL, '2024-02-03 12:01:27', NULL, NULL),
	(77, 'TERMINAL 2', 'TERMINAL 2', NULL, '2024-02-03 12:01:49', NULL, NULL),
	(78, 'TERMINAL 3', 'TERMINAL 3', NULL, '2024-02-03 12:01:57', NULL, NULL),
	(79, 'TERMINAL 1A', 'TERMINAL 1', NULL, '2024-02-03 12:02:11', NULL, NULL),
	(80, 'TERMINAL 1B', 'TERMINAL 1', NULL, '2024-02-03 12:02:20', NULL, NULL),
	(81, 'TERMINAL 2D', 'TERMINAL 2', NULL, '2024-02-03 12:02:32', NULL, NULL),
	(82, 'TERMINAL 2E', 'TERMINAL 2', NULL, '2024-02-03 12:02:49', NULL, NULL),
	(83, 'TERMINAL 2F', 'TERMINAL 2', NULL, '2024-02-03 12:02:57', NULL, NULL),
	(84, 'SKYTRAIN', 'STASIUN SKYTRAIN', NULL, '2024-02-03 12:04:24', NULL, NULL),
	(85, 'TOD', 'TOD', NULL, '2024-02-03 12:04:33', NULL, NULL),
	(86, 'STASIUN IB', 'STASIUN IB', NULL, '2024-02-03 12:04:44', NULL, NULL),
	(87, 'TERMINAL 3F', 'TERMINAL 3', NULL, '2024-02-03 12:05:23', NULL, NULL),
	(88, 'DATA CENTER T3', 'TERMINAL 3', NULL, '2024-02-03 12:05:40', NULL, NULL),
	(89, 'APRON TERMINAL 1 ', 'APRON', NULL, '2024-02-03 13:10:06', NULL, NULL),
	(90, 'APRON TERMINAL 2', 'APRON', NULL, '2024-02-03 13:10:15', NULL, NULL),
	(91, 'APRON TERMINAL 3', 'APRON', NULL, '2024-02-03 13:10:42', NULL, NULL),
	(92, 'PARIMETER SELATAN', 'PARIMETER', NULL, '2024-02-03 13:10:55', NULL, NULL),
	(93, 'PARIMETER UTARA', 'PARIMETER', NULL, '2024-02-03 13:11:09', NULL, NULL),
	(94, 'JALAN RAYA, OBVIT, PERKANTORAN', 'NON TERMINAL', NULL, '2024-02-03 13:11:23', NULL, NULL),
	(95, 'MPS 1,2 & 3', 'MAIN POWER STATION (MPS)', NULL, '2024-02-03 16:20:42', NULL, NULL),
	(96, 'PARKIR UMUM TERMINAL 1 ', 'PARKING', NULL, '2024-02-03 16:20:55', NULL, NULL),
	(97, 'PARKIR UMUM TERMINAL 2', 'PARKING', NULL, '2024-02-03 16:21:07', NULL, NULL),
	(98, 'STASIUN ANTARMODA & IB ', 'STASIUN IB', NULL, '2024-02-03 16:21:23', NULL, NULL),
	(99, 'STASIUN KALAYANG T1 & T2', 'STASIUN SKYTRAIN', NULL, '2024-02-03 16:21:34', NULL, NULL),
	(100, 'TAXI T1, T2 & T3', 'POOL TAXI', NULL, '2024-02-03 16:21:50', NULL, NULL),
	(101, 'PARKIR INAP', 'PARKING', NULL, '2024-02-03 16:22:06', NULL, NULL),
	(102, 'DKTNEW', 'DKTNEW', NULL, '2024-02-03 16:22:16', NULL, NULL),
	(103, 'MAIN ROOM', 'GEDUNG AOCC', NULL, '2024-02-03 16:22:38', NULL, NULL),
	(104, 'AVSEC ROOM', 'GEDUNG AOCC', NULL, '2024-02-03 16:22:52', NULL, NULL),
	(105, 'LTOC', 'GEDUNG AOCC', NULL, '2024-02-03 16:23:04', NULL, NULL),
	(106, 'AICC', 'GEDUNG AOCC', NULL, '2024-02-03 16:23:34', NULL, NULL),
	(107, 'TOC T1', 'TERMINAL 1', NULL, '2024-02-03 16:23:51', NULL, NULL),
	(108, 'TOC T2', 'TERMINAL 2', NULL, '2024-02-03 16:24:07', NULL, NULL),
	(109, 'TOC T3', 'TERMINAL 3', NULL, '2024-02-03 16:24:18', NULL, NULL),
	(111, 'RUANG SERVER FIS', 'PERKANTORAN 601', NULL, '2024-02-03 16:45:28', NULL, NULL),
	(112, 'RUANG SERVER IT', 'PERKANTORAN 601', NULL, '2024-02-03 16:45:40', NULL, NULL),
	(113, 'STDT', 'TERMINAL 3', NULL, '2024-02-03 16:45:52', NULL, NULL),
	(114, 'DISTRIBUTION 601', 'PERKANTORAN 601', NULL, '2024-02-03 16:46:10', NULL, NULL),
	(115, 'PERKANTORAN 601', 'PERKANTORAN 601', NULL, '2024-02-03 16:47:32', NULL, NULL),
	(116, 'PKPPK-UTAMA', 'NON TERMINAL', NULL, '2024-02-03 16:47:44', NULL, NULL),
	(117, 'PKPPK-SELATAN', 'NON TERMINAL', NULL, '2024-02-03 16:48:12', NULL, NULL),
	(118, 'PKPPK-UTARA', 'NON TERMINAL', NULL, '2024-02-03 16:48:32', NULL, NULL),
	(119, 'SPK RUNWAY 3', 'NON TERMINAL', NULL, '2024-02-03 16:48:46', NULL, NULL),
	(120, 'ATC TOWER', 'NON TERMINAL', NULL, '2024-02-03 16:49:09', NULL, NULL),
	(121, 'NON TERMINAL', 'NON TERMINAL', NULL, '2024-02-03 16:49:42', NULL, NULL),
	(122, 'PERKANTORAN 600', 'PERKANTORAN 600', NULL, '2024-02-03 16:50:01', NULL, NULL),
	(123, 'AMC T1', 'TERMINAL 1', NULL, '2024-02-03 16:50:15', NULL, NULL),
	(124, 'AMC T2', 'TERMINAL 2', NULL, '2024-02-03 16:50:26', NULL, NULL),
	(125, 'AMC T3', 'TERMINAL 3', NULL, '2024-02-03 16:50:35', NULL, NULL),
	(126, 'AMC TOWER T1', 'TERMINAL 1', NULL, '2024-02-03 16:50:50', NULL, NULL),
	(127, 'AMC TOWER T2', 'TERMINAL 2', NULL, '2024-02-03 16:50:56', NULL, NULL),
	(128, 'AMC TOWER T3', 'TERMINAL 3', NULL, '2024-02-03 16:51:11', NULL, NULL),
	(129, 'OIC T1', 'TERMINAL 1', NULL, '2024-02-03 16:51:31', NULL, NULL),
	(130, 'OIC T2', 'TERMINAL 2', NULL, '2024-02-03 16:51:37', NULL, NULL),
	(131, 'OIC T3', 'TERMINAL 3', NULL, '2024-02-03 16:51:47', NULL, NULL),
	(132, 'GEDUNG VVIP', 'GEDUNG VVIP', NULL, '2024-02-03 16:52:05', NULL, NULL),
	(133, 'GEDUNG 641', 'NON TERMINAL', NULL, '2024-02-04 14:17:51', NULL, NULL),
	(134, 'GEDUNG AME', 'NON TERMINAL', NULL, '2024-02-04 14:18:07', NULL, NULL),
	(135, 'DEPO KALAYANG', 'NON TERMINAL', NULL, '2024-02-04 14:18:37', NULL, NULL),
	(136, 'AKSESBILITAS M1', 'NON TERMINAL', NULL, '2024-02-04 14:19:05', NULL, NULL),
	(137, 'WORKSHOP BENGKEL', 'NON TERMINAL', NULL, '2024-02-04 14:20:05', NULL, NULL),
	(138, 'CONTROL ROOM', 'GEDUNG AOCC', NULL, '2024-02-04 14:20:37', NULL, NULL),
	(139, 'GUDANG M1', 'NON TERMINAL', NULL, '2024-02-04 14:21:10', NULL, NULL),
	(140, 'MAIN POWER STATION 2', 'MAIN POWER STATION (MPS)', NULL, '2024-02-04 14:21:37', NULL, NULL),
	(141, 'MAIN POWER STATION 3', 'MAIN POWER STATION (MPS)', NULL, '2024-02-04 14:21:49', NULL, NULL),
	(142, 'MAIN POWER STATION 1', 'MAIN POWER STATION (MPS)', NULL, '2024-02-04 14:22:27', NULL, NULL),
	(143, 'POOL TAXI', 'POOL TAXI', NULL, '2024-02-04 14:23:07', NULL, NULL),
	(144, 'GEDUNG PUMPING', 'NON TERMINAL', NULL, '2024-02-04 14:23:25', NULL, NULL),
	(145, 'GEDUNG RANWAY', 'NON TERMINAL', NULL, '2024-02-04 14:23:55', NULL, NULL),
	(146, 'PERKANTORAN PIER 1', 'TERMINAL 3', NULL, '2024-02-04 14:24:35', NULL, NULL),
	(147, 'GEDUNG SANITASI', 'NON TERMINAL', NULL, '2024-02-04 14:25:02', NULL, NULL),
	(148, 'TERMINAL DOMESTIK', 'TERMINAL 3', NULL, '2024-02-04 14:26:25', NULL, NULL),
	(149, 'TERMINAL INTERNASIONAL', 'TERMINAL 3', NULL, '2024-02-04 14:26:44', NULL, NULL),
	(150, 'TERMINAL 1 VIP', 'TERMINAL 1', NULL, '2024-02-04 14:30:32', NULL, NULL),
	(151, 'DIGITAL LOUGE T3', 'TERMINAL 3', NULL, '2024-02-04 14:33:03', NULL, NULL),
	(152, 'CITY FIRE', 'NON TERMINAL', NULL, '2024-02-04 14:34:06', NULL, NULL),
	(153, 'UBPK CARGO', 'CARGO', NULL, '2024-02-04 14:34:36', NULL, NULL),
	(154, 'PBK CARGO', 'CARGO', NULL, '2024-02-04 14:36:19', NULL, NULL),
	(155, 'PKPPK MAINTENANCE', 'NON TERMINAL', NULL, '2024-02-04 14:39:51', NULL, NULL),
	(156, 'GEDUNG AIRFIELD ENGINEERING', 'NON TERMINAL', NULL, '2024-02-04 14:40:29', NULL, NULL),
	(157, 'GEDUNG COMCEN', 'NON TERMINAL', NULL, '2024-02-04 14:41:02', NULL, NULL),
	(158, 'GEDUNG CIVIL', 'NON TERMINAL', NULL, '2024-02-04 14:42:03', NULL, NULL),
	(159, 'APRON TIMUR ', 'NON TERMINAL', NULL, '2024-02-04 14:42:55', NULL, NULL),
	(160, 'EGM', 'PERKANTORAN 601', NULL, '2024-02-04 15:24:14', NULL, NULL),
	(161, 'STAFF DEPUTY EGM OF FINANCE & HUMAN RESOURCE', 'PERKANTORAN 601', NULL, '2024-02-04 15:24:33', NULL, NULL),
	(162, 'TATA USAHA', 'PERKANTORAN 601', NULL, '2024-02-04 15:24:45', NULL, NULL),
	(163, 'KEPEGAWAIAN', 'PERKANTORAN 601', NULL, '2024-02-04 15:25:01', NULL, NULL),
	(164, 'INFRASTRUKTUR', 'PERKANTORAN 601', NULL, '2024-02-04 15:25:32', NULL, NULL),
	(165, 'LEGAL', 'PERKANTORAN 601', NULL, '2024-02-04 15:25:42', NULL, NULL),
	(166, 'KEUANGAN BAWAH', 'PERKANTORAN 601', NULL, '2024-02-04 15:25:57', NULL, NULL),
	(167, 'KEUANGAN ATAS/PENAGIHAN', 'PERKANTORAN 601', NULL, '2024-02-04 15:26:13', NULL, NULL),
	(168, 'PKBL', 'PERKANTORAN 601', NULL, '2024-02-04 15:26:24', NULL, NULL),
	(169, 'SEKARPURA', 'PERKANTORAN 601', NULL, '2024-02-04 15:26:38', NULL, NULL),
	(170, 'PROCUREMENT/PANPEL', 'PERKANTORAN 601', NULL, '2024-02-04 15:27:05', NULL, NULL),
	(171, 'DEPUTY OF AIRPORT SERVICE & FACILITY', 'PERKANTORAN 601', NULL, '2024-02-04 15:29:06', NULL, NULL),
	(172, 'BCOM', 'PERKANTORAN 601', NULL, '2024-02-04 15:29:16', NULL, NULL),
	(173, 'AIRPORT FACILITY', 'PERKANTORAN 601', NULL, '2024-02-04 15:29:32', NULL, NULL),
	(174, 'ASSET & LOGISTIK', 'PERKANTORAN 601', NULL, '2024-02-04 15:29:43', NULL, NULL),
	(175, 'DEPUTY OF AIRPORT OPERATION', 'PERKANTORAN 601', NULL, '2024-02-04 15:30:05', NULL, NULL),
	(176, 'AIRSIDE OPERATION & ARFF', 'PERKANTORAN 601', NULL, '2024-02-04 15:30:47', NULL, NULL),
	(177, 'DEPUTY OF AIRPORT MAINTENANCE', 'PERKANTORAN 601', NULL, '2024-02-04 15:31:05', NULL, NULL),
	(178, 'IT ATAS/HIT', 'PERKANTORAN 601', NULL, '2024-02-04 15:31:17', NULL, NULL),
	(179, 'IT NON PUBLIC', 'PERKANTORAN 601', NULL, '2024-02-04 15:31:31', NULL, NULL),
	(180, 'IT PUBLIC', 'PERKANTORAN 601', NULL, '2024-02-04 15:31:44', NULL, NULL),
	(181, 'DATA NETWORK', 'PERKANTORAN 601', NULL, '2024-02-04 15:31:55', NULL, NULL),
	(182, 'SSIT/CCTV', 'PERKANTORAN 601', NULL, '2024-02-04 15:32:07', NULL, NULL),
	(183, 'POSKO AVSEC 641', 'NON TERMINAL', NULL, '2024-02-04 15:32:21', NULL, NULL),
	(184, 'PERKANTORAN 1A', 'PERKANTORAN 601', NULL, '2024-02-04 15:32:38', NULL, NULL),
	(185, 'VIP 1B', 'TERMINAL 1', NULL, '2024-02-04 15:34:24', NULL, NULL),
	(186, 'VIP 1B', 'TERMINAL 1', NULL, '2024-02-04 15:34:24', NULL, NULL),
	(187, 'PERKANTORAN 1B', 'TERMINAL 1', NULL, '2024-02-04 15:35:09', NULL, NULL),
	(188, 'PERKANTORAN 2F', 'TERMINAL 2', NULL, '2024-02-04 15:35:25', NULL, NULL),
	(189, 'PERKANTORAN 2E', 'TERMINAL 2', NULL, '2024-02-04 15:37:03', NULL, NULL),
	(190, 'PERKANTORAN 2D', 'TERMINAL 2', NULL, '2024-02-04 15:37:14', NULL, NULL),
	(191, 'PERKANTORAN T3 DOMESTIK', 'TERMINAL 3', NULL, '2024-02-04 15:37:50', NULL, NULL),
	(192, 'PERKANTORAN T3 INTERNASIONAL', 'TERMINAL 3', NULL, '2024-02-04 15:38:22', NULL, NULL),
	(193, 'NORTH RUNWAY', 'NON TERMINAL', NULL, '2024-02-04 15:44:54', NULL, NULL),
	(194, 'SOUTH RUNWAY', 'NON TERMINAL', NULL, '2024-02-04 15:45:06', NULL, NULL),
	(195, 'WK PARIMETER', 'NON TERMINAL', NULL, '2024-02-04 15:47:09', NULL, NULL),
	(196, 'GEDUNG LANDSCAPE M1', 'NON TERMINAL', NULL, '2024-02-04 15:54:12', NULL, NULL),
	(197, 'GEDUNG SIPIL NON TERMINAL M1', 'NON TERMINAL', NULL, '2024-02-04 15:54:34', NULL, NULL),
	(198, 'CARGO AVSEC', 'CARGO', NULL, '2024-02-04 16:00:40', NULL, NULL),
	(199, 'GEDUNG ENVIRONMENT M1', 'NON TERMINAL', NULL, '2024-02-04 16:08:33', NULL, NULL),
	(200, 'CARGO', 'CARGO', NULL, '2024-02-06 01:25:05', NULL, NULL);

-- Dumping structure for table tamaapp.ms_sub_device
CREATE TABLE IF NOT EXISTS `ms_sub_device` (
  `sub_device_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_device_name` varchar(300) DEFAULT NULL,
  `pek_unit_name` varchar(300) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_sub_device: ~71 rows (approximately)
INSERT INTO `ms_sub_device` (`sub_device_id`, `sub_device_name`, `pek_unit_name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(202, 'ISLAND', 'PERALATAN CHECK-IN DAN CONVEYOR', NULL, '2024-02-05 14:07:11', NULL, NULL),
	(203, 'Screening', 'PERALATAN CHECK-IN DAN CONVEYOR', NULL, '2024-02-05 14:07:29', NULL, NULL),
	(204, 'Infeed Xorter', 'PERALATAN AUTOMATIC XORTER ', NULL, '2024-02-05 14:07:44', NULL, NULL),
	(205, 'Carier Xorter', 'PERALATAN AUTOMATIC XORTER ', NULL, '2024-02-05 14:07:57', NULL, NULL),
	(206, 'Early Bag Store (EBS)', 'PERALATAN AUTOMATIC XORTER ', NULL, '2024-02-05 14:08:10', NULL, NULL),
	(207, 'Carousel', 'PERALATAN DEPARTURE CAROUSEL ', NULL, '2024-02-05 14:08:31', NULL, NULL),
	(208, 'Lateral', 'PERALATAN DEPARTURE CAROUSEL ', NULL, '2024-02-05 14:08:46', NULL, NULL),
	(209, 'Claim', 'PERALATAN CLAIM ARRIVAL', NULL, '2024-02-05 14:08:58', NULL, NULL),
	(210, 'OOG', 'PERALATAN CLAIM ARRIVAL', NULL, '2024-02-05 14:09:07', NULL, NULL),
	(211, 'Server', 'SERVER BHS ', NULL, '2024-02-05 14:09:22', NULL, NULL),
	(212, 'Explosive Chamber', 'EXPLOSIVE CONTAINMENT ', NULL, '2024-02-05 14:09:40', NULL, NULL),
	(213, 'Conveyor', 'EXPLOSIVE CONTAINMENT ', NULL, '2024-02-05 14:09:50', NULL, NULL),
	(214, 'Remote Control', 'EXPLOSIVE CONTAINMENT ', NULL, '2024-02-05 14:10:03', NULL, NULL),
	(215, 'Panel System', 'EXPLOSIVE CONTAINMENT ', NULL, '2024-02-05 14:10:14', NULL, NULL),
	(216, 'MVXR5000', 'PERALATAN X-RAY', NULL, '2024-02-05 14:10:30', NULL, NULL),
	(217, 'RTT110', 'PERALATAN X-RAY', NULL, '2024-02-05 14:10:41', NULL, NULL),
	(218, 'Matrix Server MVXR', 'SERVER BHS ', NULL, '2024-02-05 14:10:51', NULL, NULL),
	(219, 'Matrix Server RTT', 'SERVER BHS ', NULL, '2024-02-05 14:11:02', NULL, NULL),
	(220, 'Workstation MVXR', 'WORKSTATION', NULL, '2024-02-05 14:11:15', NULL, NULL),
	(221, 'Workstation RTT', 'WORKSTATION', NULL, '2024-02-05 14:11:29', NULL, NULL),
	(222, 'APPS SITA ', 'APPS SITA', NULL, '2024-02-05 14:12:13', NULL, NULL),
	(223, 'APPS MCO', 'APPS MCO', NULL, '2024-02-05 14:12:24', NULL, NULL),
	(224, 'MINI PC', 'MINI PC', NULL, '2024-02-05 14:12:34', NULL, NULL),
	(225, 'MONITOR FIDS', 'MONITOR FIDS', NULL, '2024-02-05 14:12:50', NULL, NULL),
	(226, 'SSCI ISLAND F', 'SSCI ISLAND F', NULL, '2024-02-05 14:13:03', NULL, NULL),
	(227, 'FARM SERVER', 'FARM SERVER', NULL, '2024-02-05 14:13:15', NULL, NULL),
	(228, 'MIDDLEWARE', 'MIDDLEWARE', NULL, '2024-02-05 14:13:26', NULL, NULL),
	(229, 'CCTV', 'CCTV', NULL, '2024-02-05 14:21:40', NULL, NULL),
	(230, 'PC MONITORING', 'PC MONITORING', NULL, '2024-02-05 14:22:08', NULL, NULL),
	(231, 'VIDEO WALL DISPLAY', 'VIDEO WALL DISPLAY', NULL, '2024-02-05 14:22:24', NULL, NULL),
	(232, 'VIDEO WALL PROCESSOR', 'VIDEO WALL PROCESSOR', NULL, '2024-02-05 14:22:40', NULL, NULL),
	(233, 'INTERACTIVE DIGITAL BOARD', 'INTERACTIVE DIGITAL BOARD', NULL, '2024-02-05 14:23:01', NULL, NULL),
	(234, 'CORE SWITCH', 'DATA NETWORK', NULL, '2024-02-05 14:23:33', NULL, NULL),
	(235, 'ACCESS SWITCH', 'DATA NETWORK', NULL, '2024-02-05 14:23:46', NULL, NULL),
	(236, 'DISTRIBUTION SWITCH', 'DATA NETWORK', NULL, '2024-02-05 14:23:57', NULL, NULL),
	(237, 'FIREWALL', 'DATA NETWORK', NULL, '2024-02-05 14:24:08', NULL, NULL),
	(238, 'PROXY SERVER', 'DATA NETWORK', NULL, '2024-02-05 14:24:23', NULL, NULL),
	(239, 'DHCP SERVER', 'DATA NETWORK', NULL, '2024-02-05 14:24:39', NULL, NULL),
	(240, 'BANDWIDTH MANAGEMENT', 'DATA NETWORK', NULL, '2024-02-05 14:24:51', NULL, NULL),
	(241, 'RASPBERRY', 'CRASHBELL', NULL, '2024-02-05 14:26:14', NULL, NULL),
	(242, 'PUSH BUTTON', 'CRASHBELL', NULL, '2024-02-05 14:26:25', NULL, NULL),
	(243, 'AMPLIFIER', 'CRASHBELL', NULL, '2024-02-05 14:26:53', NULL, NULL),
	(244, 'ROUND BELL', 'CRASHBELL', NULL, '2024-02-05 14:27:10', NULL, NULL),
	(245, 'SPEAKER TOA', 'CRASHBELL', NULL, '2024-02-05 14:27:22', NULL, NULL),
	(246, 'BR', 'IGCS', NULL, '2024-02-05 14:27:33', NULL, NULL),
	(247, 'TSC ', 'IGCS', NULL, '2024-02-05 14:27:47', NULL, NULL),
	(248, 'PSU', 'IGCS', NULL, '2024-02-05 14:27:59', NULL, NULL),
	(249, 'ATCC', 'IGCS', NULL, '2024-02-05 14:28:15', NULL, NULL),
	(250, 'CAVITY FILTER', 'IGCS', NULL, '2024-02-05 14:28:28', NULL, NULL),
	(251, 'FAN', 'IGCS', NULL, '2024-02-05 14:28:41', NULL, NULL),
	(252, 'NMT', 'IGCS', NULL, '2024-02-05 14:28:51', NULL, NULL),
	(253, 'MSO', 'IGCS', NULL, '2024-02-05 14:29:26', NULL, NULL),
	(254, 'ZC', 'IGCS', NULL, '2024-02-05 14:29:36', NULL, NULL),
	(255, 'MTIG', 'IGCS', NULL, '2024-02-05 14:29:44', NULL, NULL),
	(256, 'DISPATCH CONSOLE', 'IGCS', NULL, '2024-02-05 14:30:01', NULL, NULL),
	(257, 'REPLAY STATION', 'IGCS', NULL, '2024-02-05 14:30:11', NULL, NULL),
	(258, 'R&S', 'RADIO VHF AIR TO GROUND', NULL, '2024-02-05 14:30:24', NULL, NULL),
	(259, 'DITTEL', 'RADIO VHF AIR TO GROUND', NULL, '2024-02-05 14:30:34', NULL, NULL),
	(260, 'ICOM', 'RADIO VHF AIR TO GROUND', NULL, '2024-02-05 14:30:45', NULL, NULL),
	(261, 'PRINTER-MPS-A4', 'SEWA PRINTER', NULL, '2024-02-05 14:31:17', NULL, NULL),
	(262, 'PRINTER-MPS-A3', 'SEWA PRINTER', NULL, '2024-02-05 14:31:27', NULL, NULL),
	(263, 'Switch Access', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:31:53', NULL, NULL),
	(264, 'Access Point', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:32:08', NULL, NULL),
	(265, 'E-MADING', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:32:22', NULL, NULL),
	(266, 'IT POSKO', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:32:31', NULL, NULL),
	(267, 'PERANGKAT RUANG RAPAT', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:32:42', NULL, NULL),
	(268, 'PERANGKAT IT', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:32:58', NULL, NULL),
	(269, 'INFRASTRUKTUR SERVER PERKANTORAN', 'PERANGKAT IT NON PUBLIC SERVICE', NULL, '2024-02-05 14:33:11', NULL, NULL),
	(270, 'LAPTOP KARYAWAN', 'SEWA LAPTOP', NULL, '2024-02-05 14:33:46', NULL, NULL),
	(271, 'LAPTOP DESIGN', 'SEWA LAPTOP', NULL, '2024-02-05 14:34:03', NULL, NULL),
	(272, 'PC CCTV', 'SEWA LAPTOP', NULL, '2024-02-05 14:34:17', NULL, NULL);

-- Dumping structure for table tamaapp.ms_unit_kerja
CREATE TABLE IF NOT EXISTS `ms_unit_kerja` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(50) DEFAULT NULL,
  `inisial_unit` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table tamaapp.ms_unit_kerja: ~6 rows (approximately)
INSERT INTO `ms_unit_kerja` (`unit_id`, `unit_name`, `inisial_unit`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(1, 'IT Non Public Service', 'HIDN', NULL, NULL, NULL, NULL),
	(2, 'Communication & Data Network', 'HIDC', NULL, NULL, NULL, NULL),
	(3, 'AOCC & TOC IT Support', 'HIDA', NULL, NULL, NULL, NULL),
	(4, 'Public Service Information Technology', 'HIPS', NULL, NULL, NULL, NULL),
	(5, 'Safety Security Information Technology', 'HISS', NULL, NULL, NULL, NULL),
	(16, 'Baggage Handling System', 'HIBS', NULL, NULL, NULL, NULL);

-- Dumping structure for table tamaapp.personel
CREATE TABLE IF NOT EXISTS `personel` (
  `id_personel` int(11) NOT NULL AUTO_INCREMENT,
  `shift_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_personel`),
  KEY `shift_id` (`shift_id`),
  CONSTRAINT `personel_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift_kerja` (`id_shift`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.personel: ~1 rows (approximately)
INSERT INTO `personel` (`id_personel`, `shift_id`, `created_at`) VALUES
	(6, 3, '2025-02-15 02:00:32');

-- Dumping structure for table tamaapp.personel_user
CREATE TABLE IF NOT EXISTS `personel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personel_id` (`personel_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `personel_user_ibfk_1` FOREIGN KEY (`personel_id`) REFERENCES `personel` (`id_personel`) ON DELETE CASCADE,
  CONSTRAINT `personel_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `ms_account` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.personel_user: ~2 rows (approximately)
INSERT INTO `personel_user` (`id`, `personel_id`, `user_id`) VALUES
	(4, 6, 1),
	(5, 6, 2);

-- Dumping structure for table tamaapp.shift_kerja
CREATE TABLE IF NOT EXISTS `shift_kerja` (
  `id_shift` int(11) NOT NULL AUTO_INCREMENT,
  `nama_shift` varchar(50) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  PRIMARY KEY (`id_shift`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table tamaapp.shift_kerja: ~1 rows (approximately)
INSERT INTO `shift_kerja` (`id_shift`, `nama_shift`, `jam_mulai`, `jam_selesai`) VALUES
	(3, 'Pagi', '07:00:00', '00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
