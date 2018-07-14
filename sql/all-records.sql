INSERT INTO `imhhfs_role` (`id`, `name`, `deleted`, `updated_at`, `created_at`) VALUES
(1, 'guest', 0, now(), now()),
(2, 'member', 0, now(), now()),
(3, 'admin', 0, now(), now()),
(4, 'superadmin', 0, now(), now());

INSERT INTO `imhhfs_user` (`id`, `role_id`, `name`, `pass`, `two_factor`, `two_factor_secret`, `deleted`, `updated_at`, `created_at`) VALUES
(1, 2, 'user', '$2y$11$eVVKcwwsb1UP7RSvdea21OWGJM3cYLBKSoPlAowBa0uQHjkguRB.K', 0, 0, '', now(), now());

INSERT INTO `imhhfs_file_type` (`id`, `name`, `deleted`, `updated_at`, `created_at`) VALUES
(1, 'image', 0, now(), now()),
(2, 'video', 0, now(), now()),
(3, 'audio', 0, now(), now()),
(4, 'text', 0, now(), now()),
(5, 'other', 0, now(), now());

INSERT INTO `imhhfs_file_extension` (`id`, `name`, `active`, `file_type`, `deleted`, `updated_at`, `created_at`) VALUES
(1, '.jpg', 1, 1, 0, now(), now()),
(2, '.jpeg', 1, 1, 0, now(), now()),
(3, '.gif', 1, 1, 0, now(), now()),
(4, '.svg', 1, 1, 0, now(), now()),
(5, '.png', 1, 1, 0, now(), now()),
(6, '.ico', 1, 1, 0, now(), now()),
(7, '.txt', 1, 4, 0, now(), now()),
(8, '.pdf', 1, 5, 0, now(), now()),
(9, '.zip', 1, 5, 0, now(), now()),
(10, '.rar', 1, 5, 0, now(), now()),
(11, '.xls', 1, 5, 0, now(), now()),
(12, '.doc', 1, 5, 0, now(), now()),
(13, '.ppt', 1, 5, 0, now(), now()),
(14, '.xlsx', 1, 5, 0, now(), now()),
(15, '.pptx', 1, 5, 0, now(), now());