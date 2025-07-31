-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table rigglo_tech.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.clients: ~5 rows (approximately)
DELETE FROM `clients`;
INSERT INTO `clients` (`id`, `name`, `email`, `url`, `phone`, `address`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Algorithm', NULL, 'https://evisionint.com/', NULL, 'USA', 'client/1737548377_Algorithm.png', '2025-01-22 06:19:37', '2025-01-23 01:56:27'),
	(2, 'E-Vishoin', NULL, 'https://evisionint.com/', NULL, NULL, 'client/1737548404_e-vision-logo.png', '2025-01-22 06:20:04', '2025-01-23 01:56:38'),
	(3, 'Gorjon', NULL, NULL, NULL, NULL, 'client/1737548436_gorjon.png', '2025-01-22 06:20:36', '2025-01-22 06:20:36'),
	(4, 'Prowriterz', NULL, 'https://prowriterz.com', NULL, NULL, 'client/1737548473_Prowriterz.png', '2025-01-22 06:21:13', '2025-01-23 01:57:16'),
	(5, 'Julie Rivas', 'wutufyzilo@mailinator.com', 'https://hti-blend.com/products-list?category_id=51', '+1 (286) 306-5772', 'Deleniti voluptatem', 'client/1737618574_gorjon.png', '2025-01-22 06:22:11', '2025-01-23 01:53:50');

-- Dumping structure for table rigglo_tech.client_reviews
CREATE TABLE IF NOT EXISTS `client_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_reviews_client_id_foreign` (`client_id`),
  CONSTRAINT `client_reviews_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.client_reviews: ~2 rows (approximately)
DELETE FROM `client_reviews`;
INSERT INTO `client_reviews` (`id`, `name`, `client_id`, `review`, `rating`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Krish', 1, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó', 5, 'client-review/1738055444_Screenshot 2025-01-28 150059.png', '2025-01-28 03:10:44', '2025-01-28 03:10:44'),
	(2, 'Jesica', 5, 'una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original.', 5, 'client-review/1738055929_Screenshot 2025-01-28 150126.png', '2025-01-28 03:18:49', '2025-01-28 03:18:49'),
	(3, 'Lorence', 4, 'Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 5, 'client-review/1738055962_Screenshot_2025-01-23_154836-removebg-preview.png', '2025-01-28 03:19:22', '2025-01-28 03:19:22');

-- Dumping structure for table rigglo_tech.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.contact_messages: ~0 rows (approximately)
DELETE FROM `contact_messages`;

-- Dumping structure for table rigglo_tech.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table rigglo_tech.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.migrations: ~19 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_10_21_155742_create_permission_tables', 2),
	(8, '2014_10_12_000000_create_users_table', 3),
	(13, '2024_10_23_163542_create_parkings_table', 4),
	(27, '2024_10_29_113408_create_settings_table', 6),
	(28, '2024_10_29_113419_create_ranks_table', 6),
	(29, '2024_10_29_113427_create_departments_table', 6),
	(31, '2024_10_26_011238_create_drivers_table', 7),
	(32, '2024_10_26_012649_create_vehicles_table', 7),
	(34, '2025_01_08_041546_create_arams_table', 8),
	(36, '2024_11_03_051102_create_bio_datas_table', 9),
	(37, '2025_01_08_131747_create_events_table', 10),
	(39, '2025_01_21_073407_create_services_table', 11),
	(40, '2025_01_22_111144_create_roles_table', 11),
	(43, '2025_01_22_111157_create_clients_table', 12),
	(45, '2025_01_23_112707_create_staff_table', 13),
	(50, '2025_01_24_090817_create_portfolio_tags_table', 14),
	(51, '2025_01_24_090823_create_portfolios_table', 14),
	(52, '2025_01_28_082604_create_client_reviews_table', 15),
	(53, '2025_01_28_101124_create_contact_messages_table', 16),
	(54, '2025_01_30_122950_create_packages_table', 17);

-- Dumping structure for table rigglo_tech.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`) USING BTREE,
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.model_has_permissions: ~0 rows (approximately)
DELETE FROM `model_has_permissions`;

-- Dumping structure for table rigglo_tech.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`) USING BTREE,
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.model_has_roles: ~3 rows (approximately)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 4);

-- Dumping structure for table rigglo_tech.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.packages: ~4 rows (approximately)
DELETE FROM `packages`;
INSERT INTO `packages` (`id`, `title`, `price`, `details`, `service_id`, `created_at`, `updated_at`) VALUES
	(1, 'IRON', '30', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">Control Panel: cPanel</li>\r\n    <li style="margin-bottom: 0px;">Number of Websites: 1</li><li style="margin-bottom: 0px;"> Disk: 1GB, Memory: 2GB</li>\r\n    <li style="margin-bottom: 0px;">CPU Cores: 2 vCPU</li>\r\n    <li style="margin-bottom: 0px;">Bandwidth: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Email Accounts: 5</li><li style="margin-bottom: 0px;">Attachment Size: 100MB</li>\r\n    <li style="margin-bottom: 0px;">Databases: 5</li>\r\n    <li style="margin-bottom: 0px;">Backups: Daily</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificates: Free</li>\r\n    <li style="margin-bottom: 0px;">Email &amp; Ticket Support: 24/7</li>\r\n   </ul>', 4, '2025-01-31 05:07:07', '2025-02-03 02:19:50'),
	(2, 'BRONZE', '50', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">Control Panel: cPanel</li>\r\n    <li style="margin-bottom: 0px;">Number of Websites: 1</li>\r\n    <li style="margin-bottom: 0px;">Disk: 2GB, Memory: 2GB</li>\r\n    <li style="margin-bottom: 0px;">CPU Cores: 2 vCPU</li>\r\n    <li style="margin-bottom: 0px;">Bandwidth: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Email Accounts: 10</li>\r\n    <li style="margin-bottom: 0px;">Attachment Size: 100MB</li>\r\n    <li style="margin-bottom: 0px;">Databases: 10</li>\r\n    <li style="margin-bottom: 0px;">Backups: Daily</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificates: Free</li>\r\n    <li style="margin-bottom: 0px;">Email &amp; Ticket Support: 24/7</li>\r\n</ul>', 4, '2025-01-31 05:29:25', '2025-02-03 02:19:09'),
	(4, 'SILVER', '80', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">Control Panel: cPanel</li>\r\n    <li style="margin-bottom: 0px;">Number of Websites: 1</li>\r\n    <li style="margin-bottom: 0px;">Disk: 5GB, Memory: 2GB</li>\r\n    <li style="margin-bottom: 0px;">CPU Cores: 2 vCPU</li>\r\n    <li style="margin-bottom: 0px;">Bandwidth: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Email Accounts: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Attachment Size: 100MB</li>\r\n    <li style="margin-bottom: 0px;">Databases: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Backups: Daily</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificates: Free</li>\r\n    <li style="margin-bottom: 0px;">Email &amp; Ticket Support: 24/7</li>\r\n</ul>', 4, '2025-01-31 05:34:30', '2025-02-03 02:22:48'),
	(5, 'GOLD', '150', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">Control Panel: cPanel</li>\r\n    <li style="margin-bottom: 0px;">Number of Websites: 1</li>\r\n    <li style="margin-bottom: 0px;">Disk: 10GB, Memory: 2GB</li>\r\n    <li style="margin-bottom: 0px;">CPU Cores: 2 vCPU</li>\r\n    <li style="margin-bottom: 0px;">Bandwidth: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Email Accounts: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Attachment Size: 100MB</li>\r\n    <li style="margin-bottom: 0px;">Databases: Unlimited</li>\r\n    <li style="margin-bottom: 0px;">Backups: Daily</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificates: Free</li>\r\n    <li style="margin-bottom: 0px;">Email &amp; Ticket Support: 24/7</li>\r\n</ul>', 4, '2025-01-31 05:35:23', '2025-02-03 02:23:44'),
	(6, 'One', '250', '<ul style="list-style: none; padding: 0; text-align:center;">\r\n    <li style="margin-bottom: 0px;">1 Page of Content (Landing Page)</li>\r\n    <li style="margin-bottom: 0px;">Basic WordPress Theme</li>\r\n    <li style="margin-bottom: 0px;">Fully Responsive Design</li>\r\n    <li style="margin-bottom: 0px;">Design Revisions</li>\r\n    <li style="margin-bottom: 0px;">Social Media Profiles Integration</li>\r\n    <li style="margin-bottom: 0px;">Technical Maintenance/Support(1st year)</li>\r\n    <li style="margin-bottom: 0px;">Website Backups</li>\r\n    <li style="margin-bottom: 0px;">Website Indexing</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificate</li>\r\n    <li style="margin-bottom: 0px;">Logo Design</li>\r\n</ul>', 3, '2025-02-03 03:06:18', '2025-02-03 04:57:14'),
	(7, 'Light', '350', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">3 Pages of Content</li>\r\n    <li style="margin-bottom: 0px;">Premium Theme of WordPress / HTML</li>\r\n    <li style="margin-bottom: 0px;">Fully Responsive Design</li>\r\n    <li style="margin-bottom: 0px;">Design Revisions</li>\r\n    <li style="margin-bottom: 0px;">Social Media Profiles Integration</li>\r\n    <li style="margin-bottom: 0px;">Technical Maintenance/Support(1st year)</li>\r\n    <li style="margin-bottom: 0px;">Website Backups</li>\r\n    <li style="margin-bottom: 0px;">Website Indexing</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificate</li>\r\n    <li style="margin-bottom: 0px;">Logo Design</li>\r\n</ul>', 3, '2025-02-03 03:08:53', '2025-02-03 04:57:26'),
	(8, 'Pro', '500', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">5 Pages of Content</li>\r\n    <li style="margin-bottom: 0px;">Premium Theme of WordPress / HTML</li>\r\n    <li style="margin-bottom: 0px;">Fully Responsive Design</li>\r\n    <li style="margin-bottom: 0px;">Design Revisions</li>\r\n    <li style="margin-bottom: 0px;">Social Media Profiles Integration</li>\r\n    <li style="margin-bottom: 0px;">Technical Maintenance/Support(1st year)</li>\r\n    <li style="margin-bottom: 0px;">Website Backups</li>\r\n    <li style="margin-bottom: 0px;">Website Indexing</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificate</li>\r\n    <li style="margin-bottom: 0px;">Logo Design</li>\r\n</ul>', 3, '2025-02-03 03:09:54', '2025-02-03 04:57:41'),
	(9, 'Ultra', '--', '<ul style="list-style: none; padding: 0; text-align: center;">\r\n    <li style="margin-bottom: 0px;">5+ Pages of Content</li>\r\n    <li style="margin-bottom: 0px;">Premium Theme of WordPress / HTML</li>\r\n    <li style="margin-bottom: 0px;">Fully Responsive Design</li>\r\n    <li style="margin-bottom: 0px;">Design Revisions</li>\r\n    <li style="margin-bottom: 0px;">Social Media Profiles Integration</li>\r\n    <li style="margin-bottom: 0px;">Technical Maintenance/Support(1st year)</li>\r\n    <li style="margin-bottom: 0px;">Website Backups</li>\r\n    <li style="margin-bottom: 0px;">Website Indexing</li>\r\n    <li style="margin-bottom: 0px;">SSL Certificate</li>\r\n    <li style="margin-bottom: 0px;">Logo Design</li>\r\n    <li style="margin-bottom: 0px;">Payment Gateway Integration</li>\r\n</ul>\r\n<p style="text-align: center; font-weight: bold;"><a href="#contact">Contact Us</a></p>', 3, '2025-02-03 03:12:26', '2025-02-03 04:58:23');

-- Dumping structure for table rigglo_tech.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table rigglo_tech.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.permissions: ~31 rows (approximately)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(8, 'role.create', 'web', '2024-10-22 01:27:02', '2024-10-22 01:27:02'),
	(9, 'role.view', 'web', '2024-10-22 01:27:09', '2024-10-22 01:27:09'),
	(10, 'role.update', 'web', '2024-10-22 01:27:18', '2024-10-22 01:27:18'),
	(11, 'role.delete', 'web', '2024-10-22 01:27:24', '2024-10-22 01:27:24'),
	(12, 'permission.view', 'web', '2024-10-22 23:05:26', '2024-10-22 23:05:26'),
	(13, 'permission.create', 'web', '2024-10-22 23:05:38', '2024-10-22 23:05:38'),
	(14, 'permission.update', 'web', '2024-10-22 23:05:48', '2024-10-22 23:05:48'),
	(15, 'permission.delete', 'web', '2024-10-22 23:05:57', '2024-10-22 23:05:57'),
	(16, 'user.view', 'web', '2024-10-22 23:06:12', '2024-10-22 23:06:12'),
	(17, 'user.create', 'web', '2024-10-22 23:06:18', '2024-10-22 23:06:18'),
	(18, 'user.update', 'web', '2024-10-22 23:06:25', '2024-10-22 23:06:25'),
	(19, 'user.delete', 'web', '2024-10-22 23:06:38', '2024-10-22 23:06:38'),
	(28, 'setting.view', 'web', '2024-11-05 00:14:35', '2024-11-05 00:14:35'),
	(29, 'setting.create', 'web', '2024-11-05 00:14:49', '2024-11-05 00:14:49'),
	(30, 'setting.update', 'web', '2024-11-05 00:14:55', '2024-11-05 00:14:55'),
	(31, 'setting.delete', 'web', '2024-11-05 00:15:05', '2024-11-05 00:15:05'),
	(36, 'user_profile.view', 'web', '2024-11-05 00:25:21', '2024-11-05 00:25:21'),
	(37, 'user_profile.update', 'web', '2024-11-05 00:25:31', '2024-11-05 00:25:31'),
	(38, 'service.create', 'web', '2025-01-22 05:03:09', '2025-01-22 05:03:09'),
	(39, 'service.view', 'web', '2025-01-22 05:03:16', '2025-01-22 05:03:16'),
	(40, 'service.update', 'web', '2025-01-22 05:03:23', '2025-01-22 05:03:23'),
	(41, 'service.delete', 'web', '2025-01-22 05:03:31', '2025-01-22 05:03:31'),
	(42, 'client.create', 'web', '2025-01-22 06:10:15', '2025-01-22 06:10:15'),
	(43, 'client.view', 'web', '2025-01-22 06:10:25', '2025-01-22 06:10:25'),
	(44, 'client.update', 'web', '2025-01-22 06:10:30', '2025-01-22 06:10:30'),
	(45, 'client.delete', 'web', '2025-01-22 06:10:38', '2025-01-22 06:10:38'),
	(46, 'staff.create', 'web', '2025-01-24 04:44:12', '2025-01-24 04:44:12'),
	(47, 'staff.view', 'web', '2025-01-24 04:44:22', '2025-01-24 04:44:22'),
	(48, 'staff.update', 'web', '2025-01-24 04:44:29', '2025-01-24 04:44:29'),
	(49, 'staff.delete', 'web', '2025-01-24 04:44:35', '2025-01-24 04:44:35'),
	(50, 'portfolio.create', 'web', '2025-01-24 04:49:59', '2025-01-24 04:49:59'),
	(51, 'portfolio.view', 'web', '2025-01-24 04:50:05', '2025-01-24 04:50:05'),
	(52, 'portfolio.update', 'web', '2025-01-24 04:50:11', '2025-01-24 04:50:11'),
	(53, 'portfolio.delete', 'web', '2025-01-24 04:50:17', '2025-01-24 04:50:17'),
	(54, 'message.view', 'web', '2025-01-28 05:18:19', '2025-01-28 05:18:19'),
	(55, 'message.create', 'web', '2025-01-28 05:18:28', '2025-01-28 05:18:28'),
	(56, 'message.update', 'web', '2025-01-28 05:18:34', '2025-01-28 05:18:34'),
	(57, 'message.delete', 'web', '2025-01-28 05:18:40', '2025-01-28 05:18:40');

-- Dumping structure for table rigglo_tech.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`) USING BTREE,
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table rigglo_tech.portfolios
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_tag_id` tinyint NOT NULL,
  `service_id` tinyint NOT NULL,
  `client_id` tinyint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.portfolios: ~4 rows (approximately)
DELETE FROM `portfolios`;
INSERT INTO `portfolios` (`id`, `title`, `portfolio_tag_id`, `service_id`, `client_id`, `body`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Demo 1e', 2, 4, 5, '<span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">ec Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consectetur neque ut odio faucibus, non mattis urna condimentum. Sed pharetra libero non magna malesuada dignissim. Donec pharetra nulla urna, ac elementum libero malesuada rutrum. Nullam eu dignissim nulla. Integer vitae ullamcorper ex. Pellentesque nec rhoncus enim, ut bibendum dolor. Aliquam efficitur turpis eget nibh maximus facilisis. Sed tellus purus, hendrerit sit amet lacinia eu, euismod non leo. In interdum lacus vitae risus efficitur ultricies. Vestibulum eleifend lectus nec ligula hendrerit sodales. Aenean ultrices vehicula mauris, nec auctor ex eleifend ultrices. Nunc pellentesque varius lacinia. Pellentesque turpis ipsum, fringilla eget massa sit amet, fermentum viverra tellus. Mauris id nibh pellentesque, facilisis nunc bibendum, porta arcu. Integer maximus scelerisque faucibus. Ut suscipit eget nisl eget congue.&nbsp;</span>', 'portfolios/1737970588_e-commerce.png', '2025-01-27 02:16:57', '2025-01-27 03:36:28'),
	(2, 'Demo 2', 1, 3, 2, '<span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Vivamus et auctor quam. In hendrerit urna vitae velit laoreet, at finibus libero cursus. Integer sit amet sollicitudin libero, non commodo nunc. Proin non lacinia nulla. Fusce in eros et tellus ullamcorper auctor. Suspendisse erat massa, pharetra vestibulum molestie quis, sagittis et odio. Nulla eu condimentum neque.</span>', 'portfolios/1737966173_1716836418662.png', '2025-01-27 02:22:53', '2025-01-27 02:22:53'),
	(3, 'App 1', 2, 5, 2, '<span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Aliquam id quam vel sapien eleifend venenatis. Aliquam et nunc dictum, blandit urna non, porttitor urna. Mauris feugiat dolor vel consectetur blandit. Nullam eget viverra massa. Quisque sollicitudin libero nec turpis aliquet, tristique dapibus mauris blandit. Nulla accumsan nibh id nibh hendrerit vehicula in nec neque. Curabitur vehicula massa lectus, sit amet dignissim nulla ultrices at. Proin tincidunt diam at libero dapibus, at sodales risus egestas. Mauris consectetur maximus nisl ut fermentum. Maecenas ac massa elementum, rhoncus est at, pulvinar nisl.</span>', 'portfolios/1737966332_Screenshot 2025-01-27 142521.png', '2025-01-27 02:25:32', '2025-01-27 02:25:32'),
	(4, 'App 2', 2, 5, 3, '<p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Aliquam id quam vel sapien eleifend venenatis. Aliquam et nunc dictum, blandit urna non, porttitor urna. Mauris feugiat dolor vel consectetur blandit. Nullam eget viverra massa. Quisque sollicitudin libero nec turpis aliquet, tristique dapibus mauris blandit. Nulla accumsan nibh id nibh hendrerit vehicula in nec neque. Curabitur vehicula massa lectus, sit amet dignissim nulla ultrices at. Proin tincidunt diam at libero dapibus, at sodales risus egestas. Mauris consectetur maximus nisl ut fermentum. Maecenas ac massa elementum, rhoncus est at, pulvinar nisl.</span></p>', 'portfolios/1737966396_Screenshot 2025-01-27 142626.png', '2025-01-27 02:26:36', '2025-01-27 02:26:36'),
	(5, 'Graphic Design 1', 3, 2, 3, '<p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);">Aliquam id quam vel sapien eleifend venenatis. Aliquam et nunc dictum, blandit urna non, porttitor urna. Mauris feugiat dolor vel consectetur blandit. Nullam eget viverra massa. Quisque sollicitudin libero nec turpis aliquet, tristique dapibus mauris blandit. Nulla accumsan nibh id nibh hendrerit vehicula in nec neque. Curabitur vehicula massa lectus, sit amet dignissim nulla ultrices at. Proin tincidunt diam at libero dapibus, at sodales risus egestas. Mauris consectetur maximus nisl ut fermentum. Maecenas ac massa elementum, rhoncus est at, pulvinar nisl.</span></p>', 'portfolios/1737966483_Screenshot 2025-01-27 142752.png', '2025-01-27 02:28:03', '2025-01-27 02:28:03');

-- Dumping structure for table rigglo_tech.portfolio_tags
CREATE TABLE IF NOT EXISTS `portfolio_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.portfolio_tags: ~2 rows (approximately)
DELETE FROM `portfolio_tags`;
INSERT INTO `portfolio_tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Web_Site', '2025-01-27 02:16:36', '2025-01-27 03:12:38'),
	(2, 'Apps', '2025-01-27 02:16:40', '2025-01-27 02:16:40'),
	(3, 'Banner', '2025-01-27 02:26:50', '2025-01-27 02:26:50');

-- Dumping structure for table rigglo_tech.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.roles: ~4 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'web', '2024-10-21 21:59:33', '2024-10-21 23:10:28'),
	(2, 'Admin', 'web', '2024-10-21 21:59:42', '2024-10-21 22:02:56'),
	(3, 'User', 'web', '2024-10-23 01:55:51', '2024-10-23 01:55:51'),
	(4, 'PA', 'web', '2025-01-13 12:39:48', '2025-01-13 12:39:48');

-- Dumping structure for table rigglo_tech.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.role_has_permissions: ~70 rows (approximately)
DELETE FROM `role_has_permissions`;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(9, 2),
	(12, 2),
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(28, 2),
	(29, 2),
	(30, 2),
	(31, 2),
	(36, 2),
	(37, 2),
	(38, 2),
	(39, 2),
	(40, 2),
	(41, 2),
	(42, 2),
	(43, 2),
	(44, 2),
	(45, 2),
	(46, 2),
	(47, 2),
	(48, 2),
	(49, 2),
	(50, 2),
	(51, 2),
	(52, 2),
	(53, 2),
	(54, 2),
	(55, 2),
	(56, 2),
	(57, 2);

-- Dumping structure for table rigglo_tech.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.services: ~7 rows (approximately)
DELETE FROM `services`;
INSERT INTO `services` (`id`, `title`, `body`, `feature_image`, `created_at`, `updated_at`) VALUES
	(2, 'Digital Marketing', 'Rigglo Technologies LTD specializes in formulating effective digital marketing strategies to enhance brand visibility and drive targeted traffic. Their expertise spans search engine optimization (SEO), pay-per-click (PPC) advertising, social media marketing, content marketing, and more. By leveraging data-driven insights and industry best practices, they help businesses maximize their online presence and achieve their marketing goals.', 'service/1737456940_Digital_Marketing.jpg', '2025-01-21 04:41:49', '2025-01-21 04:55:40'),
	(3, 'Website Design and Development', 'Rigglo Technologies LTD creates visually captivating and user-friendly websites that leave a lasting impression. They combine creativity with technical expertise to design responsive and intuitive websites that align with their clients\' brand identity and objectives. Their websites are built using the latest web development technologies and standards, ensuring optimal performance across devices and browsers.', 'service/1737457574_web-design-and-development.jpg', '2025-01-21 05:06:14', '2025-01-21 05:06:14'),
	(4, 'Domain and Hosting Services', '&nbsp;Rigglo Technologies LTD understands the importance of reliable domain and hosting services for maintaining a strong online presence. They offer secure and scalable hosting solutions, along with domain registration and management services, to ensure seamless website performance and uninterrupted online operations. With their robust infrastructure and proactive support, clients can trust their digital assets are in capable hands.', 'service/1737458100_1673289791281.png', '2025-01-21 05:15:00', '2025-01-21 05:15:00'),
	(5, 'Software and Web Application Development', 'Rigglo Technologies LTD excels in developing customized software and web applications tailored to the unique requirements of businesses. Their experienced team follows an agile development approach, leveraging the latest technologies and industry best practices to build scalable and robust solutions. From enterprise software to mobile apps and e-commerce platforms, they deliver high-quality products that enhance operational efficiency and drive business growth.', 'service/1737458191_Web-app-development-2.jpg', '2025-01-21 05:16:31', '2025-01-21 05:16:31'),
	(6, 'E-commerce Solutions', 'Rigglo Technologies LTD helps businesses establish and optimize their online stores. They provide end-to-end e-commerce solutions, including platform selection, customization, payment gateway integration, inventory management, and security implementation. By creating seamless and secure shopping experiences, they empower businesses to capitalize on the growing e-commerce market.', 'service/1737458481_e-commerce.png', '2025-01-21 05:21:21', '2025-01-21 05:21:21'),
	(7, 'Digital Consultancy', '&nbsp;Rigglo Technologies LTD offers expert consultancy services to guide businesses in making informed decisions regarding their digital strategies. Their team provides insights and recommendations on various aspects such as technology adoption, user experience optimization, digital transformation, and cybersecurity. Through strategic planning and tailored advice, they assist businesses in leveraging digital solutions to achieve their goals.', 'service/1737458548_digital-consultancy-side.jpg', '2025-01-21 05:22:28', '2025-01-21 05:22:28'),
	(8, 'Business Process Outsourcing (BPO)', '<div><span style="background-color: var(--mdb-card-bg); font-size: var(--mdb-body-font-size); font-weight: var(--mdb-body-font-weight); text-align: var(--mdb-body-text-align);">In addition to their extensive digital services, Rigglo Technologies LTD also provides reliable and efficient Business Process Outsourcing (BPO) solutions. Recognizing the increasing demand for streamlined business operations, they offer comprehensive BPO services that enable businesses to focus on their core competencies while entrusting non-core processes to a trusted partner.</span></div><div><br></div><div>Rigglo Technologies LTD\'s BPO services cover a wide range of functions, allowing businesses to outsource tasks and processes that can be efficiently handled by their experienced team. This includes areas such as customer support, data entry and management, content moderation, back-office operations, virtual assistance, and more.</div><div><br></div><div>With a dedicated team of skilled professionals, Rigglo Technologies LTD ensures the seamless execution of outsourced processes, adhering to industry best practices and stringent quality standards. They leverage advanced technologies and tools to optimize workflows, improve efficiency, and enhance productivity.</div><div><br></div><div>By partnering with Rigglo Technologies LTD for BPO services, businesses can benefit from cost savings, as they eliminate the need for in-house resources and infrastructure. This allows organizations to allocate their resources more strategically and focus on core business activities.</div><div><br></div><div>Moreover, Rigglo Technologies LTD understands the importance of data security and confidentiality. They employ robust security measures to safeguard sensitive information, ensuring compliance with data protection regulations and industry standards. Clients can have peace of mind knowing that their data is handled with the utmost care and confidentiality.</div><div><br></div><div>Rigglo Technologies LTD takes a collaborative approach to BPO, working closely with clients to understand their unique requirements and tailor solutions accordingly. Their team becomes an extension of the client\'s business, seamlessly integrating with their processes and providing consistent support.</div><div><br></div><div>Overall, Rigglo Technologies LTD\'s BPO services enable businesses to streamline their operations, increase efficiency, and focus on their core competencies. With their expertise, advanced technologies, and commitment to excellence, they deliver reliable and cost-effective solutions that drive business growth and success.</div>', 'service/1737458789_1716836418662.png', '2025-01-21 05:26:29', '2025-01-21 05:26:29');

-- Dumping structure for table rigglo_tech.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Mt Management System CMH',
  `site_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `enable_user_registration` tinyint(1) NOT NULL DEFAULT '1',
  `enable_footer` tinyint(1) NOT NULL DEFAULT '0',
  `enable_developer_info` tinyint(1) NOT NULL DEFAULT '0',
  `front_cover_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_sec_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_sec_one` longtext COLLATE utf8mb4_unicode_ci,
  `about_sec_two` longtext COLLATE utf8mb4_unicode_ci,
  `about_img_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_img_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active_twitter` tinyint DEFAULT NULL,
  `is_active_fb` tinyint DEFAULT NULL,
  `is_active_linkedin` tinyint DEFAULT NULL,
  `is_active_instagram` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.settings: ~1 rows (approximately)
DELETE FROM `settings`;
INSERT INTO `settings` (`id`, `site_name`, `site_email`, `phone_number`, `address`, `is_maintenance_mode`, `enable_user_registration`, `enable_footer`, `enable_developer_info`, `front_cover_text`, `logo_path`, `favicon_path`, `banner`, `about_sec_title`, `about_sec_one`, `about_sec_two`, `about_img_one`, `about_img_two`, `created_at`, `updated_at`, `twitter_link`, `fb_link`, `linkedin_link`, `instagram_link`, `is_active_twitter`, `is_active_fb`, `is_active_linkedin`, `is_active_instagram`) VALUES
	(1, 'Rigglo Tech', 'contact@rigglotech.com', '+8801612340044', '126/A & 126/B, Room-2017/A-B, Lion Shopping Complex, Monipuripara, Tejgaon, Dhaka, Bangladesh', 0, 1, 1, 1, 'Technology for the next generation.', 'logos/1737361974_RiggloTechnologis.png', 'fav_icon/1737364848_RiggloTechFav.PNG', 'banners/1737366202_Rigglo-logo-IMAGE-BG.jpg', 'About Rigglo Technologies LTD', '<div>Rigglo Technologies LTD is a leading digital services company that specializes in providing comprehensive solutions for businesses in the realm of technology and online presence. With a strong focus on digital marketing, website design, domain and hosting services, as well as software and web app development, Rigglo Technologies LTD offers a wide range of services to cater to the diverse needs of its clients.</div>', '<div><span style="background-color: var(--mdb-card-bg); font-size: var(--mdb-body-font-size); font-weight: var(--mdb-body-font-weight); text-align: var(--mdb-body-text-align);">When it comes to digital marketing, Rigglo Technologies LTD excels in formulating effective strategies that help businesses reach their target audience, increase brand visibility, and drive meaningful engagement. Whether it\'s search engine optimization (SEO), pay-per-click (PPC) advertising, social media marketing, or content marketing, their team of experts leverages the latest trends and techniques to deliver measurable results.</span></div>', 'about/1737372382_RiggloTechFav.PNG', 'about/1737372382_Rigglo-logo-presentation_Layer 1.jpg', '2024-11-02 23:53:19', '2025-01-29 06:22:58', 'https://chat.deepseek.com/', 'https://chat.deepseek.com/', 'https://chat.deepseek.com/', 'https://chat.deepseek.com/', 1, 1, 1, 1);

-- Dumping structure for table rigglo_tech.staffs
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rigglo_tech.staffs: ~2 rows (approximately)
DELETE FROM `staffs`;
INSERT INTO `staffs` (`id`, `name`, `phone`, `email`, `designation`, `address`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Patricia Barber', '+1 (644) 526-8731', 'magilafujo@mailinator.com', 'Laborum Labore prov', 'Fuga Ipsum culpa in', 'staff/1737704808_Man-Transparent.png', '2025-01-24 01:23:39', '2025-01-24 02:37:34'),
	(3, 'Jemima Herring', '+1 (485) 239-8056', 'lydux@mailinator.com', 'Magnam iste culpa si', 'Ex dolore aut corpor', 'staff/1737707822_IMG_20220222_174557-removebg-preview.png', '2025-01-24 02:37:02', '2025-01-24 02:37:02'),
	(4, 'Leonard Perez', '+1 (401) 642-7269', 'pyjo@mailinator.com', 'Commodo voluptates d', 'Recusandae Et in ea', 'staff/1737707839_Screenshot_2025-01-23_154836-removebg-preview.png', '2025-01-24 02:37:19', '2025-01-24 02:37:19');

-- Dumping structure for table rigglo_tech.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table rigglo_tech.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `role_id`, `email`, `phone`, `address`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Supper Admin', 1, 'pavel@rigglotech.com', '01612061212', 'BD', NULL, NULL, '$2y$10$4xItox2YOdx7zURDJc.eROWM1UGB4iVnQCZP55cJsAuz40dwXNici', NULL, '2024-10-22 05:02:05', '2025-01-29 03:00:38'),
	(3, 'Admin', 2, 'princecosta8@gmail.com', '01882565483', 'Ea est quia voluptat', NULL, NULL, '$2y$10$WaU.uR5AFFZOxacCe3nppOww5nv5pRQjsDGxcHLsoZ84WmGK0fGem', NULL, '2024-10-23 12:35:18', '2024-11-05 00:28:55'),
	(4, 'Gso-2', 1, 'cmhdhaka@gmail.com', '01769014506', NULL, NULL, NULL, '$2y$10$f/cU6PgUSR/j0xVy4oeaseCrAPL9dxcSkWxD3DBlsA0LZhFDJk6aS', NULL, '2024-11-05 07:47:50', '2024-11-05 07:49:40');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
