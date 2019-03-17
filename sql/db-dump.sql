-- MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `imhhfs_file`;
CREATE TABLE `imhhfs_file` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'File name in upload folder',
  `file_extension_id` int(11) DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Size in bytes',
  `file_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_included` tinyint(1) NOT NULL COMMENT '1 if note is related to a file',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F2FAB98593CB796C` (`file_id`),
  KEY `IDX_F2FAB985A76ED395` (`user_id`),
  KEY `IDX_F2FAB985AB8C6E61` (`file_extension_id`),
  CONSTRAINT `FK_F2FAB98593CB796C` FOREIGN KEY (`file_id`) REFERENCES `imhhfs_file` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_F2FAB985A76ED395` FOREIGN KEY (`user_id`) REFERENCES `imhhfs_user` (`id`),
  CONSTRAINT `FK_F2FAB985AB8C6E61` FOREIGN KEY (`file_extension_id`) REFERENCES `imhhfs_file_extension` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `imhhfs_file_extension`;
CREATE TABLE `imhhfs_file_extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AB8A0B9B5E237E06` (`name`),
  KEY `IDX_AB8A0B9B9E2A35A8` (`file_type_id`),
  CONSTRAINT `FK_AB8A0B9B9E2A35A8` FOREIGN KEY (`file_type_id`) REFERENCES `imhhfs_file_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_file_extension` (`id`, `file_type_id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	1,	'.jpg',	0,	0,	now(),	now()),
(2,	1,	'.jpeg',	0,	0,	now(),	now()),
(3,	1,	'.gif',	0,	0,	now(),	now()),
(4,	1,	'.svg',	0,	0,	now(),	now()),
(5,	1,	'.png',	0,	0,	now(),	now()),
(6,	1,	'.ico',	0,	0,	now(),	now()),
(7,	2,	'.mp4',	0,	0,	now(),	now()),
(8,	2,	'.webm',	0,	0,	now(),	now()),
(9,	2,	'.ogg',	0,	0,	now(),	now()),
(10,	2,	'.avi',	0,	0,	now(),	now()),
(11,	2,	'.mov',	0,	1,	now(),	now()),
(12,	2,	'.movie',	1,	0,	now(),	now()),
(13,	2,	'.mpe',	0,	1,	now(),	now()),
(14,	2,	'.mpeg',	1,	0,	now(),	now()),
(15,	2,	'.mpg',	0,	1,	now(),	now()),
(16,	2,	'.qt',	0,	1,	now(),	now()),
(17,	2,	'.wmv',	0,	1,	now(),	now()),
(18,	3,	'.midi',	0,	0,	now(),	now()),
(19,	3,	'.mp2',	0,	1,	now(),	now()),
(20,	3,	'.mp3',	0,	0,	now(),	now()),
(21,	3,	'.mpga',	1,	0,	now(),	now()),
(22,	3,	'.wav',	0,	0,	now(),	now()),
(23,	4,	'.css',	0,	1,	now(),	now()),
(24,	4,	'.htm',	0,	1,	now(),	now()),
(25,	4,	'.html',	1,	0,	now(),	now()),
(26,	4,	'.rtf',	0,	1,	now(),	now()),
(27,	4,	'.rtx',	0,	1,	now(),	now()),
(28,	4,	'.sgm',	0,	1,	now(),	now()),
(29,	4,	'.sgml',	1,	0,	now(),	now()),
(30,	4,	'.xml',	0,	1,	now(),	now()),
(31,	4,	'.txt',	0,	0,	now(),	now()),
(32,	5,	'.tar',	0,	1,	now(),	now()),
(33,	5,	'.tcl',	0,	1,	now(),	now()),
(34,	5,	'.pdf',	0,	0,	now(),	now()),
(35,	5,	'.zip',	0,	0,	now(),	now()),
(36,	5,	'.rar',	0,	0,	now(),	now()),
(37,	5,	'.xls',	0,	0,	now(),	now()),
(38,	5,	'.doc',	0,	0,	now(),	now()),
(39,	5,	'.ppt',	0,	0,	now(),	now()),
(40,	5,	'.xlsx',	0,	0,	now(),	now()),
(41,	5,	'.pptx',	0,	0,	now(),	now());

DROP TABLE IF EXISTS `imhhfs_file_type`;
CREATE TABLE `imhhfs_file_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_565E6CF95E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_file_type` (`id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'image',	0,	0,	now(),	now()),
(2,	'video',	0,	0,	now(),	now()),
(3,	'audio',	0,	0,	now(),	now()),
(4,	'text',	0,	0,	now(),	now()),
(5,	'other',	0,	0,	now(),	now());

DROP TABLE IF EXISTS `imhhfs_recovery_code`;
CREATE TABLE `imhhfs_recovery_code` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Encoded recovery code',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
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
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_290C05FF5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_role` (`id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'guest',	0,	0,	now(),	now()),
(2,	'member',	0,	0,	now(),	now()),
(3,	'admin',	0,	0,	now(),	now()),
(4,	'superadmin',	0,	0,	now(),	now());

DROP TABLE IF EXISTS `imhhfs_user`;
CREATE TABLE `imhhfs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Encoded password',
  `two_factor` tinyint(1) NOT NULL COMMENT '1 if 2FA is enabled',
  `two_factor_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Secret for 2FA validation and authenticator app',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3F659DC5E237E06` (`name`),
  KEY `IDX_F3F659DCD60322AC` (`role_id`),
  CONSTRAINT `FK_F3F659DCD60322AC` FOREIGN KEY (`role_id`) REFERENCES `imhhfs_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `imhhfs_user` (`id`, `role_id`, `name`, `pass`, `two_factor`, `two_factor_secret`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	4,	'user',	'$2y$11$eVVKcwwsb1UP7RSvdea21OWGJM3cYLBKSoPlAowBa0uQHjkguRB.K',	0,	'',	0,	0,	now(),	now());
