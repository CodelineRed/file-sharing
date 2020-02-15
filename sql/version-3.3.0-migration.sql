-- Upgrade from 3.2.0 to 3.3.0
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

UPDATE imhhfs_file SET hidden = 0 WHERE 1;
UPDATE imhhfs_file SET access = 3 WHERE access = 2;
UPDATE imhhfs_file SET access = 2 WHERE access = 1;
UPDATE imhhfs_file SET access = 1 WHERE access = 0;
ALTER TABLE `imhhfs_file` CHANGE `access` `access_id` int(11) NULL AFTER `file_extension_id`;

DROP TABLE IF EXISTS `imhhfs_access`;
CREATE TABLE `imhhfs_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Icon CSS class',
  `button` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Button CSS class',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7758B5DF5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_access` (`id`, `name`, `icon`, `button`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'private',	'lock',	'success',	0,	0,	'2020-02-03 13:56:16',	'2020-02-03 13:56:16'),
(2,	'shareable',	'link',	'warning',	0,	0,	'2020-02-03 13:56:44',	'2020-02-03 13:56:44'),
(3,	'public',	'eye',	'danger',	0,	0,	'2020-02-03 13:56:59',	'2020-02-03 13:56:59');
