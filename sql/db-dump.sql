-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `imhhfs_file`;
CREATE TABLE `imhhfs_file` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `extension` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `file_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_included` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F2FAB98593CB796C` (`file_id`),
  KEY `IDX_F2FAB985A76ED395` (`user_id`),
  KEY `IDX_F2FAB9859FB73D77` (`extension`),
  CONSTRAINT `FK_F2FAB98593CB796C` FOREIGN KEY (`file_id`) REFERENCES `imhhfs_file` (`id`),
  CONSTRAINT `FK_F2FAB9859FB73D77` FOREIGN KEY (`extension`) REFERENCES `imhhfs_file_extension` (`id`),
  CONSTRAINT `FK_F2FAB985A76ED395` FOREIGN KEY (`user_id`) REFERENCES `imhhfs_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `imhhfs_file_extension`;
CREATE TABLE `imhhfs_file_extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AB8A0B9B5E237E06` (`name`),
  KEY `IDX_AB8A0B9B5223F47` (`file_type`),
  CONSTRAINT `FK_AB8A0B9B5223F47` FOREIGN KEY (`file_type`) REFERENCES `imhhfs_file_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_file_extension` (`id`, `file_type`, `active`, `name`, `deleted`, `updated_at`, `created_at`) VALUES
(1,	1,	1,	'.jpg',	0,	now(),	now()),
(2,	1,	1,	'.jpeg',	0,	now(),	now()),
(3,	1,	1,	'.gif',	0,	now(),	now()),
(4,	1,	1,	'.svg',	0,	now(),	now()),
(5,	1,	1,	'.png',	0,	now(),	now()),
(6,	1,	1,	'.ico',	0,	now(),	now()),
(7,	2,	1,	'.mp4',	0,	now(),	now()),
(8,	2,	1,	'.webm',	0,	now(),	now()),
(9,	2,	1,	'.ogg',	0,	now(),	now()),
(10,	2,	1,	'.avi',	0,	now(),	now()),
(11,	2,	0,	'.mov',	0,	now(),	now()),
(12,	2,	0,	'.movie',	0,	now(),	now()),
(13,	2,	0,	'.mpe',	0,	now(),	now()),
(14,	2,	0,	'.mpeg',	0,	now(),	now()),
(15,	2,	0,	'.mpg',	0,	now(),	now()),
(16,	2,	0,	'.qt',	0,	now(),	now()),
(17,	2,	0,	'.wmv',	0,	now(),	now()),
(18,	3,	1,	'.midi',	0,	now(),	now()),
(19,	3,	0,	'.mp2',	0,	now(),	now()),
(20,	3,	1,	'.mp3',	0,	now(),	now()),
(21,	3,	0,	'.mpga',	0,	now(),	now()),
(22,	3,	1,	'.wav',	0,	now(),	now()),
(23,	4,	0,	'.css',	0,	now(),	now()),
(24,	4,	0,	'.htm',	0,	now(),	now()),
(25,	4,	0,	'.html',	0,	now(),	now()),
(26,	4,	0,	'.rtf',	0,	now(),	now()),
(27,	4,	0,	'.rtx',	0,	now(),	now()),
(28,	4,	0,	'.sgm',	0,	now(),	now()),
(29,	4,	0,	'.sgml',	0,	now(),	now()),
(30,	4,	0,	'.xml',	0,	now(),	now()),
(31,	4,	1,	'.txt',	0,	now(),	now()),
(32,	5,	0,	'.tar',	0,	now(),	now()),
(33,	5,	0,	'.tcl',	0,	now(),	now()),
(34,	5,	1,	'.pdf',	0,	now(),	now()),
(35,	5,	1,	'.zip',	0,	now(),	now()),
(36,	5,	1,	'.rar',	0,	now(),	now()),
(37,	5,	1,	'.xls',	0,	now(),	now()),
(38,	5,	1,	'.doc',	0,	now(),	now()),
(39,	5,	1,	'.ppt',	0,	now(),	now()),
(40,	5,	1,	'.xlsx',	0,	now(),	now()),
(41,	5,	1,	'.pptx',	0,	now(),	now());

DROP TABLE IF EXISTS `imhhfs_file_type`;
CREATE TABLE `imhhfs_file_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_565E6CF95E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_file_type` (`id`, `name`, `deleted`, `updated_at`, `created_at`) VALUES
(1,	'image',	0,	now(),	now()),
(2,	'video',	0,	now(),	now()),
(3,	'audio',	0,	now(),	now()),
(4,	'text',	0,	now(),	now()),
(5,	'other',	0,	now(),	now());

DROP TABLE IF EXISTS `imhhfs_recovery_code`;
CREATE TABLE `imhhfs_recovery_code` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CE329A70A76ED395` (`user_id`),
  CONSTRAINT `FK_CE329A70A76ED395` FOREIGN KEY (`user_id`) REFERENCES `imhhfs_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `imhhfs_role`;
CREATE TABLE `imhhfs_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_290C05FF5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_role` (`id`, `name`, `deleted`, `updated_at`, `created_at`) VALUES
(1,	'guest',	0,	now(),	now()),
(2,	'member',	0,	now(),	now()),
(3,	'admin',	0,	now(),	now()),
(4,	'superadmin',	0,	now(),	now());

DROP TABLE IF EXISTS `imhhfs_user`;
CREATE TABLE `imhhfs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `two_factor` tinyint(1) NOT NULL,
  `two_factor_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3F659DC5E237E06` (`name`),
  KEY `IDX_F3F659DCD60322AC` (`role_id`),
  CONSTRAINT `FK_F3F659DCD60322AC` FOREIGN KEY (`role_id`) REFERENCES `imhhfs_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_user` (`id`, `role_id`, `pass`, `two_factor`, `two_factor_secret`, `name`, `deleted`, `updated_at`, `created_at`) VALUES
(1,	4,	'$2y$11$eVVKcwwsb1UP7RSvdea21OWGJM3cYLBKSoPlAowBa0uQHjkguRB.K',	0,	'0',	'user',	0,	now(),	now());

-- 2018-10-02 14:32:09