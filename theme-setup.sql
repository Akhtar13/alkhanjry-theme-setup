-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` bigint(20) unsigned DEFAULT NULL,
  `country_code` bigint(20) unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `mobile_no`, `country_code`, `image`, `public_id`, `status`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'admin@gmail.com',	'$2a$12$pmifxfX57KHoboRE.vlJtOKEI2MeULNWrJBpIyNUjj6QbZ2TqE8zO',	NULL,	NULL,	'https://res.cloudinary.com/dhfh14apo/image/upload/v1657280504/lufo7oihjisuo4zpuncx.png',	'h2ychwra9ddzmckldlnk',	'active',	'2022-10-21 12:13:22',	'2023-10-20 22:57:56');

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `description` longtext,
  `image` varchar(191) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `event_type` enum('online','offline') DEFAULT NULL,
  `total_days` int(11) DEFAULT NULL,
  `event_url` varchar(191) DEFAULT NULL,
  `address` longtext,
  `question` longtext,
  `public_id` varchar(191) DEFAULT NULL,
  `ticket_goal` decimal(10,2) unsigned DEFAULT '0.00',
  `status` enum('active','inActive') DEFAULT 'active',
  `event_order_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `events` (`id`, `title`, `description`, `image`, `start_date`, `end_date`, `start_time`, `end_time`, `amount`, `event_type`, `total_days`, `event_url`, `address`, `question`, `public_id`, `ticket_goal`, `status`, `event_order_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Giving Hope Gala',	'Join us for an unforgettable evening of compassion and giving at the \"Giving Hope Gala.\" This exclusive gala is not just an event; it\'s a promise of hope, unity, and positive change.\r\n\r\nAbout the Gala:\r\n\r\nThe Giving Hope Gala is a celebration of the indomitable spirit of humanity coming together to make a difference. With every ticket purchased, every donation made, and every act of kindness, you are becoming an integral part of something greater than yourself.',	'https://res.cloudinary.com/drnaphq6o/image/upload/v1697872579/pollm2joolvmpevmdjcu.png',	'2023-10-21',	'2023-10-24',	'00:00:00',	'17:00:00',	1000.00,	'online',	4,	'http://127.0.0.1:8000/admin/event/create',	NULL,	'Are You Come Today ?',	'icna-app/fwv9lm6wm9lnsraw9q12',	100.00,	'active',	1,	'2023-10-21 01:46:21',	'2024-02-20 23:21:19',	NULL),
(2,	'NEw two',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0.00,	'active',	NULL,	'2024-02-20 23:21:11',	'2024-02-20 23:21:47',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL,
  `state_id` bigint(20) unsigned DEFAULT NULL,
  `city_id` bigint(20) unsigned DEFAULT NULL,
  `image` bigint(20) unsigned DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notification` tinyint(4) NOT NULL DEFAULT '1',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `donor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `country_id` (`country_id`),
  KEY `state_id` (`state_id`),
  KEY `city_id` (`city_id`),
  KEY `image` (`image`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_ibfk_4` FOREIGN KEY (`image`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2024-02-21 04:52:15
