-- Upgrade from 3.4.0 to 3.5.0
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

ALTER TABLE `fs_user` ADD `upload_limit_id` int(11) NOT NULL AFTER `role_id`;
UPDATE fs_user SET upload_limit_id = 1 WHERE upload_limit_id = 0;

DROP TABLE IF EXISTS `fs_upload_limit`;
CREATE TABLE `fs_upload_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Size in bytes',
  `files` int(11) NOT NULL COMMENT 'Max File quantity',
  `folders` int(11) NOT NULL COMMENT 'Max Folder quantity',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_512E45B65E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `fs_upload_limit` (`id`, `name`, `size`, `files`, `folders`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'general',	'104857600',	250,	250,	0,	0,	now(),	now());
