/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
