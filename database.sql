-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.1.38-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- launchwares için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `launchwares` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `launchwares`;

-- tablo yapısı dökülüyor launchwares.bans
CREATE TABLE IF NOT EXISTS `bans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `server_slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.bans: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `bans` DISABLE KEYS */;
INSERT INTO `bans` (`id`, `uid`, `server_slug`, `until`, `reason`, `created_at`, `updated_at`) VALUES
	(2, 1234, 'iq0kp5wQtorT', '2019-07-15 19:32:18', 'dsfsdaf', '2020-07-14 19:32:18', '2020-07-14 19:32:18'),
	(3, 1234, 'iq0kp5wQtorT', '2020-07-14 21:51:06', 'saf', '2020-07-14 20:53:22', '2020-07-14 21:51:06'),
	(4, 1235, 'iq0kp5wQtorT', '2020-07-24 02:07:44', 'sa as', '2020-07-24 02:03:01', '2020-07-24 02:07:44');
/*!40000 ALTER TABLE `bans` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.cheats
CREATE TABLE IF NOT EXISTS `cheats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.cheats: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `cheats` DISABLE KEYS */;
INSERT INTO `cheats` (`id`, `name`) VALUES
	(0, 'cheatengine'),
	(1, 'sdkjbfjhkdsgfs'),
	(2, '3dviewer');
/*!40000 ALTER TABLE `cheats` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.detections
CREATE TABLE IF NOT EXISTS `detections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cheat_id` int(11) NOT NULL,
  `player_id` bigint(20) NOT NULL,
  `server_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `screenshot_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.detections: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `detections` DISABLE KEYS */;
INSERT INTO `detections` (`id`, `cheat_id`, `player_id`, `server_id`, `is_active`, `created_at`, `updated_at`, `screenshot_path`) VALUES
	(2, 3, 308663175564492810, 1, 1, '2020-09-23 03:16:01', '2020-09-23 03:16:01', NULL),
	(3, 3, 308663175564492810, 1, 1, '2020-09-23 03:21:29', '2020-09-23 03:21:29', 'http://127.0.0.1:8000/storage/images/rsVPZB1dxQFw3squYidtGCVKxsUnltbwEvnvhQIx.png'),
	(4, 2, 308663175564492810, 1, 1, '2020-09-23 03:35:44', '2020-09-23 03:35:44', NULL);
/*!40000 ALTER TABLE `detections` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.failed_jobs: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.launchers
CREATE TABLE IF NOT EXISTS `launchers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_suspended` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `launchers_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.launchers: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `launchers` DISABLE KEYS */;
INSERT INTO `launchers` (`id`, `token`, `version`, `is_suspended`, `maintenance`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'VeqAILPuKD4WbyH3fGsIu3zkiKaYbrxo', '1.0.0.8', 0, 0, 1, '2020-07-14 19:12:51', '2020-09-06 02:41:00'),
	(2, 'Tx9lEqlulDgitBb9vyxSFcrvf6Wh5Wtg', '1', 0, 0, 2, '2020-07-28 16:28:45', '2020-07-28 16:28:45');
/*!40000 ALTER TABLE `launchers` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.likes
CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `player_id` bigint(20) NOT NULL,
  `server_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.likes: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` (`id`, `post_id`, `player_id`, `server_id`, `created_at`, `updated_at`) VALUES
	(4, 6, 1234, 1, '2020-07-31 20:35:36', '2020-07-31 20:35:36'),
	(5, 6, 1235, 1, '2020-07-31 20:35:49', '2020-07-31 20:35:49'),
	(7, 30, 308663175564492810, 1, '2020-08-05 03:42:04', '2020-08-05 03:42:04'),
	(8, 33, 308663175564492810, 1, '2020-08-05 04:09:37', '2020-08-05 04:09:37');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `server_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.logs: ~8 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `server_id`, `type`, `value`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Game Login', 1, '2020-07-31 18:11:55', '2020-08-03 18:11:55'),
	(2, 1, 'Game Login', 1, '2020-07-31 18:12:43', '2020-08-03 18:12:43'),
	(3, 1, 'Game Login', 1, '2020-07-31 18:12:57', '2020-08-03 18:12:57'),
	(4, 1, 'Game Login', 1, '2020-07-30 18:12:57', '2020-07-30 18:12:57'),
	(5, 1, 'Game Login', 1, '2020-07-30 18:12:57', '2020-07-30 18:12:57'),
	(6, 1, 'Game Login', 1, '2020-07-30 18:12:57', '2020-07-30 18:12:57'),
	(7, 1, 'Game Login', 1, '2020-07-30 18:12:57', '2020-07-30 18:12:57'),
	(8, 1, 'Game Login', 1, '2020-08-03 20:36:09', '2020-08-03 20:36:09'),
	(9, 1, 'Game Login', 1, '2020-08-03 20:36:25', '2020-08-03 20:36:25'),
	(10, 1, 'Game Login', 1, '2020-08-03 20:37:13', '2020-08-03 20:37:13');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.migrations: ~19 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_05_11_135221_create_launchers_table', 1),
	(5, '2020_05_11_135456_create_players_table', 1),
	(6, '2020_05_11_135511_create_servers_table', 1),
	(7, '2020_05_11_135531_create_bans_table', 1),
	(8, '2020_05_11_135541_create_cheats_table', 1),
	(9, '2020_05_11_135629_create_detections_table', 1),
	(10, '2020_05_11_135645_create_posts_table', 1),
	(11, '2020_05_11_135703_create_rules_table', 1),
	(12, '2020_05_11_135735_create_updates_table', 1),
	(13, '2020_05_11_135747_create_reports_table', 1),
	(14, '2020_05_11_142238_create_report_cats_table', 1),
	(15, '2020_06_15_004434_add_rpc_to_servers_table', 1),
	(16, '2020_06_24_230251_add_launcher_to_players_table', 1),
	(17, '2020_07_15_194036_products_table', 2),
	(18, '2020_07_15_200853_add_product_fix', 3),
	(19, '2020_07_15_201515_product_keys', 4),
	(20, '2020_07_28_154551_add_theme_to_servers_table', 5),
	(21, '2020_07_28_161550_create_themes_table', 6),
	(22, '2020_07_31_010143_add_image_path_to_updates_table', 7),
	(23, '2020_07_31_012731_add_is_active_and_image_path_to_posts_table', 8),
	(24, '2020_07_31_192312_create_likes_table', 9),
	(25, '2020_08_03_180242_create_logs_table', 10),
	(26, '2020_08_03_205014_add_auto_whitelist_to_servers_table', 11),
	(27, '2020_09_23_023143_add_screenshot_path_to_detections_table', 12),
	(28, '2020_09_23_210845_add_discord_whitelist_to_servers_table', 13),
	(29, '2020_10_18_190125_create_permissions_table', 14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.password_resets: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.permissions: ~8 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`) VALUES
	(0, 'Kullanıcı'),
	(1, 'Tier 1'),
	(2, 'Tier 2'),
	(3, 'Tier 3'),
	(4, 'Tier 4'),
	(5, 'Rehber'),
	(6, 'Moderator'),
	(7, 'Kurucu');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.players
CREATE TABLE IF NOT EXISTS `players` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `launcher_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` bigint(20) NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whitelist` tinyint(1) NOT NULL DEFAULT '0',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `usertype` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `using_launcher` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `players_launcher_token_uid_unique` (`launcher_token`,`uid`),
  UNIQUE KEY `players_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.players: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` (`id`, `launcher_token`, `uid`, `api_token`, `whitelist`, `is_banned`, `usertype`, `ip`, `profile_photo`, `status`, `username`, `created_at`, `updated_at`, `using_launcher`) VALUES
	(2, 'VeqAILPuKD4WbyH3fGsIu3zkiKaYbrxo', 308663175564492810, 'N8hbD0GGMnkoSIW7RZyuJ3xxSWzg1aAPEPUcWeNuWcRysrQQoFfvxEWoi2jtasIO', 1, 0, 4, '127.0.0.1', 'https://launchwares.com/img/launchwares.png', 0, 'TORCHIZM', '2020-09-23 02:55:11', '2020-09-23 03:24:09', NULL),
	(3, 'VeqAILPuKD4WbyH3fGsIu3zkiKaYbrxo', 4565464, 'CNLSmfkviuUXaQ1Sgs4Y75BdjKspcPniykQFI5yepHUn2idHe0o6k8iFDephlEi2', 1, 0, 7, '127.0.0.1', 'https://launchwares.com/img/launchwares.png', 0, 'TORCHIZM', '2020-09-23 03:11:52', '2020-10-18 19:29:12', NULL);
/*!40000 ALTER TABLE `players` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `server_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.posts: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `content`, `author`, `server_id`, `created_at`, `updated_at`, `image_path`, `is_active`) VALUES
	(29, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:10:53', '2020-08-03 20:27:45', NULL, 1),
	(30, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:11:03', '2020-08-03 04:11:09', 'http://127.0.0.1:8000/storage/images/m5zNw9YwEhgciwVp7DhCrr5Fc2zh7whvWnxx5pgL.png', 1),
	(32, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:11:33', '2020-08-03 04:15:08', NULL, 1),
	(33, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline.', 308663175564492810, 1, '2020-08-05 03:43:52', '2020-08-05 03:44:22', 'http://127.0.0.1:8000/storage/images/fMHuK8bLLV1L9pUtw0zl8C1VHiscwSryxspLmYAZ.jpeg', 1),
	(34, 'Check this new game!', 308663175564492810, 1, '2020-08-05 03:44:07', '2020-08-05 03:44:20', 'http://127.0.0.1:8000/storage/images/grKDEsqcHbEdTOKyzdiExevuSeBgTZ6zK4yXVqFG.png', 1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.products: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `user`, `name`, `product_token`, `created_at`, `updated_at`) VALUES
	(1, 2, 'qwr', 'rge', '2020-07-15 20:24:48', '2020-07-15 20:24:48'),
	(2, 2, 'qweqwewqe', 'qwreqwrt', '2020-07-15 20:32:36', '2020-07-15 20:32:36');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.product_keys
CREATE TABLE IF NOT EXISTS `product_keys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_suspended` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_keys_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.product_keys: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `product_keys` DISABLE KEYS */;
INSERT INTO `product_keys` (`id`, `token`, `version`, `is_suspended`, `maintenance`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'VeqAILPuKD4WbyH3fGsIu3zkiKaYbrxo', '1', 0, 0, 2, '2020-07-14 19:12:51', '2020-07-14 19:12:59');
/*!40000 ALTER TABLE `product_keys` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.reports
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `target` bigint(20) NOT NULL,
  `server_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.reports: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.report_cats
CREATE TABLE IF NOT EXISTS `report_cats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.report_cats: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `report_cats` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_cats` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.rules
CREATE TABLE IF NOT EXISTS `rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.rules: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.servers
CREATE TABLE IF NOT EXISTS `servers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logo_path` text COLLATE utf8mb4_unicode_ci,
  `server_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_port` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teamspeak_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teamspeak_port` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teamspeak_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_launcher_req` tinyint(1) NOT NULL DEFAULT '1',
  `maintenance` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `launcher_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rpc_id` bigint(20) DEFAULT NULL,
  `rpc_largeimage_key` text COLLATE utf8mb4_unicode_ci,
  `rpc_largeimage_text` text COLLATE utf8mb4_unicode_ci,
  `rpc_smallimage_key` text COLLATE utf8mb4_unicode_ci,
  `rpc_smallimage_text` text COLLATE utf8mb4_unicode_ci,
  `max_players` int(11) DEFAULT NULL,
  `theme_index` int(11) DEFAULT '1',
  `auto_whitelist` tinyint(1) NOT NULL DEFAULT '0',
  `discord_whitelist` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `servers_slug_unique` (`slug`),
  UNIQUE KEY `servers_launcher_token_unique` (`launcher_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.servers: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` (`id`, `slug`, `name`, `description`, `logo_path`, `server_ip`, `server_port`, `teamspeak_ip`, `teamspeak_port`, `teamspeak_password`, `is_launcher_req`, `maintenance`, `user_id`, `launcher_token`, `created_at`, `updated_at`, `rpc_id`, `rpc_largeimage_key`, `rpc_largeimage_text`, `rpc_smallimage_key`, `rpc_smallimage_text`, `max_players`, `theme_index`, `auto_whitelist`, `discord_whitelist`) VALUES
	(1, 'iq0kp5wQtorT', 'Test Server', 'DÜNYANIN EN GÜZEL FİVEM SUNUCUSU!', 'logos/rgHEZrSSHRnyvrtCke73xUiPt6URM1S5qPrsWqMB.png', '127.0.0.1', '30120', '127.0.0.1', '9987', 'Çokgüçlüşifre123', 1, 0, 1, 'VeqAILPuKD4WbyH3fGsIu3zkiKaYbrxo', '2020-07-14 19:13:11', '2020-09-23 23:57:39', 679097759449612297, 'logo', 'Hayatını Yaşıyor!', 'discord', 'discord.gg/earjmax', 64, 0, 0, 0),
	(2, 'Qqbx4eiS4Ftf', 'sdgsdgs', 'afasfsa', 'logos/cz6LqVYqeSDBhaYeaAv78K81jwwDoknbqThrTiwR.png', '127.0.0.2', '30131', '127.0.0.3', '9987', 'sa as', 1, 1, 2, 'Tx9lEqlulDgitBb9vyxSFcrvf6Wh5Wtg', '2020-07-28 16:29:05', '2020-08-03 04:17:11', 622844267676827660, 'logo', 'test realtime', 'clogo', 'test2', 64, 0, 0, 0);
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.themes
CREATE TABLE IF NOT EXISTS `themes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.themes: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(0, 'Mor', '2020-08-05 06:40:02', '2020-08-05 06:40:07'),
	(1, 'Siyah', '2020-08-05 06:40:03', '2020-08-05 06:40:07'),
	(2, 'Mavi', '2020-08-05 06:40:04', '2020-08-05 06:40:08'),
	(3, 'Kırmızı', '2020-08-05 06:40:04', '2020-08-05 06:40:08'),
	(4, 'Turuncu', '2020-08-05 06:40:05', '2020-08-05 06:40:05');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.updates
CREATE TABLE IF NOT EXISTS `updates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `server_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.updates: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `updates` DISABLE KEYS */;
INSERT INTO `updates` (`id`, `title`, `content`, `author`, `server_id`, `created_at`, `updated_at`, `image_path`) VALUES
	(8, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and pea', 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:13:35', '2020-08-03 04:13:35', 'https://external-preview.redd.it/EMRNIjx12-h7uCgE9JTxQE66cO5ls-ITBPJECWTXit0.png?auto=webp&s=9538854791e7e935a05ca605554e758013275954'),
	(9, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and pea', 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:13:35', '2020-08-03 04:13:35', 'https://i.pinimg.com/564x/e2/6f/ba/e26fba8d9f2102d2dd8699c80b8ddc78.jpg'),
	(10, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and pea', 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:13:35', '2020-08-03 04:13:35', 'https://cdn.hipwallpaper.com/i/16/98/LBs85e.jpg'),
	(11, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and pea', 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:13:35', '2020-08-03 04:13:35', 'https://i.pinimg.com/originals/c2/24/50/c2245051be2e36408757aa1a4ff1dcf1.jpg'),
	(12, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and pea', 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:13:35', '2020-08-03 04:13:35', 'https://wallpapermemory.com/uploads/596/grand-theft-auto-v-gta-5-background-full-hd-1080p-195112.jpg'),
	(13, 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and pea', 'Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Multiline. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. The quick brown fox jumps over the lazy dog. War and peace. Keep going. Go on. For how long? Not long. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 308663175564492810, 1, '2020-08-03 04:13:35', '2020-08-03 04:13:35', 'https://www.wallpaperup.com/uploads/wallpapers/2014/01/18/231598/310f9e5fecc2f8ea618ee5724aebe373-700.jpg');
/*!40000 ALTER TABLE `updates` ENABLE KEYS */;

-- tablo yapısı dökülüyor launchwares.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `power` int(11) NOT NULL,
  `is_first` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- launchwares.users: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `power`, `is_first`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'İsmail KOÇ', 'ismailpvo1535@gmail.com', '$2y$10$t3UF8B517cVuM3VFNQWI.erhLsihI8gpbX4OOQbCBxn9Z1v/oN6pO', 4, 0, 'ZTLRwUJAth7v2IIWatMYKdWe4YIM2KD4Tq9UxyCqeJXF1mDwQ8feH2uuMclV', '2020-07-14 19:00:45', '2020-07-14 19:00:45'),
	(2, 'Test Developer', 'test@test.com', '$2y$10$Xf5CJfK7sXGs8zwGNUavMuAJ1meAnOOKhUBNoF5gEmeTg399szCBO', 0, 0, '9bBOfJJ6L63eK0WYUdOwNsZBqypAEh4gVMpM2N32P3w7Uvf1DZkUrfuAm3eh', '2020-07-14 19:00:45', '2020-07-15 19:21:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
