-- MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


DROP TABLE IF EXISTS `fs_access`;
CREATE TABLE `fs_access` (
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

INSERT INTO `fs_access` (`id`, `name`, `icon`, `button`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'private',	'lock',	'success',	0,	0,	now(),	now()),
(2,	'shareable',	'link',	'warning',	0,	0,	now(),	now()),
(3,	'public',	'eye',	'danger',	0,	0,	now(),	now());


DROP TABLE IF EXISTS `fs_file`;
CREATE TABLE `fs_file` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_extension_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'File name in upload folder',
  `mime_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Size in bytes',
  `file_included` tinyint(1) NOT NULL COMMENT '1 if note is related to a file',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F2FAB98593CB796C` (`file_id`),
  KEY `IDX_F2FAB985A76ED395` (`user_id`),
  KEY `IDX_F2FAB985AB8C6E61` (`file_extension_id`),
  KEY `IDX_F2FAB9854FEA67CF` (`access_id`),
  CONSTRAINT `FK_F2FAB9854FEA67CF` FOREIGN KEY (`access_id`) REFERENCES `fs_access` (`id`),
  CONSTRAINT `FK_F2FAB98593CB796C` FOREIGN KEY (`file_id`) REFERENCES `fs_file` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_F2FAB985A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fs_user` (`id`),
  CONSTRAINT `FK_F2FAB985AB8C6E61` FOREIGN KEY (`file_extension_id`) REFERENCES `fs_file_extension` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `fs_file_extension`;
CREATE TABLE `fs_file_extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AB8A0B9B5E237E06` (`name`),
  KEY `IDX_AB8A0B9B9E2A35A8` (`file_type_id`),
  CONSTRAINT `FK_AB8A0B9B9E2A35A8` FOREIGN KEY (`file_type_id`) REFERENCES `fs_file_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `fs_file_extension` (`id`, `file_type_id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
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
(12,	2,	'.movie',	0,	1,	now(),	now()),
(13,	2,	'.mpe',	0,	1,	now(),	now()),
(14,	2,	'.mpeg',	0,	1,	now(),	now()),
(15,	2,	'.mpg',	0,	1,	now(),	now()),
(16,	2,	'.qt',	0,	1,	now(),	now()),
(17,	2,	'.wmv',	0,	1,	now(),	now()),
(18,	3,	'.midi',	0,	0,	now(),	now()),
(19,	3,	'.mp2',	0,	1,	now(),	now()),
(20,	3,	'.mp3',	0,	0,	now(),	now()),
(21,	3,	'.mpga',	0,	1,	now(),	now()),
(22,	3,	'.wav',	0,	0,	now(),	now()),
(23,	4,	'.css',	0,	1,	now(),	now()),
(24,	4,	'.htm',	0,	1,	now(),	now()),
(25,	4,	'.html',	0,	1,	now(),	now()),
(26,	4,	'.rtf',	0,	1,	now(),	now()),
(27,	4,	'.rtx',	0,	1,	now(),	now()),
(28,	4,	'.sgm',	0,	1,	now(),	now()),
(29,	4,	'.sgml',	0,	1,	now(),	now()),
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


DROP TABLE IF EXISTS `fs_file_folder_join`;
CREATE TABLE `fs_file_folder_join` (
  `file_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`file_id`,`folder_id`),
  KEY `IDX_C8FE38693CB796C` (`file_id`),
  KEY `IDX_C8FE386162CB942` (`folder_id`),
  CONSTRAINT `FK_C8FE386162CB942` FOREIGN KEY (`folder_id`) REFERENCES `fs_folder` (`id`),
  CONSTRAINT `FK_C8FE38693CB796C` FOREIGN KEY (`file_id`) REFERENCES `fs_file` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `fs_file_type`;
CREATE TABLE `fs_file_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_565E6CF95E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `fs_file_type` (`id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'image',	0,	0,	now(),	now()),
(2,	'video',	0,	0,	now(),	now()),
(3,	'audio',	0,	0,	now(),	now()),
(4,	'text',	0,	0,	now(),	now()),
(5,	'other',	0,	0,	now(),	now());


DROP TABLE IF EXISTS `fs_folder`;
CREATE TABLE `fs_folder` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  KEY `IDX_9D939746A76ED395` (`user_id`),
  KEY `IDX_9D9397464FEA67CF` (`access_id`),
  CONSTRAINT `FK_9D9397464FEA67CF` FOREIGN KEY (`access_id`) REFERENCES `fs_access` (`id`),
  CONSTRAINT `FK_9D939746A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fs_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `fs_recovery_code`;
CREATE TABLE `fs_recovery_code` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Encoded recovery code',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  KEY `IDX_CE329A70A76ED395` (`user_id`),
  CONSTRAINT `FK_CE329A70A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fs_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `fs_role`;
CREATE TABLE `fs_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_290C05FF5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `fs_role` (`id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	'guest',	0,	0,	now(),	now()),
(2,	'member',	0,	0,	now(),	now()),
(3,	'admin',	0,	0,	now(),	now()),
(4,	'superadmin',	0,	0,	now(),	now());


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


DROP TABLE IF EXISTS `fs_user`;
CREATE TABLE `fs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `upload_limit_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Encoded password',
  `two_factor` tinyint(1) NOT NULL COMMENT '1 if 2FA is enabled',
  `two_factor_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Secret for 2FA validation and authenticator app',
  `deleted` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  `created_at` datetime NOT NULL COMMENT 'Date and time in UTC',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3F659DC5E237E06` (`name`),
  KEY `IDX_F3F659DCD60322AC` (`role_id`),
  KEY `IDX_F3F659DCE62AB99F` (`upload_limit_id`),
  CONSTRAINT `FK_F3F659DCD60322AC` FOREIGN KEY (`role_id`) REFERENCES `fs_role` (`id`),
  CONSTRAINT `FK_F3F659DCE62AB99F` FOREIGN KEY (`upload_limit_id`) REFERENCES `fs_upload_limit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- login: user / password
INSERT INTO `fs_user` (`id`, `role_id`, `upload_limit_id`, `name`, `pass`, `two_factor`, `two_factor_secret`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1,	4,	1,	'user',	'$2y$11$eVVKcwwsb1UP7RSvdea21OWGJM3cYLBKSoPlAowBa0uQHjkguRB.K',	0,	'',	0,	0,	now(),	now());
