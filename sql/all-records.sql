INSERT INTO `imhhfs_role` (`id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1, 'guest', 0, 0, now(), now()),
(2, 'member', 0, 0, now(), now()),
(3, 'admin', 0, 0, now(), now()),
(4, 'superadmin', 0, 0, now(), now());

INSERT INTO `imhhfs_user` (`id`, `role_id`, `name`, `pass`, `deleted`, `hidden`, `two_factor`, `two_factor_secret`, `updated_at`, `created_at`) VALUES
(1, 2, 'user', '$2y$11$eVVKcwwsb1UP7RSvdea21OWGJM3cYLBKSoPlAowBa0uQHjkguRB.K', 0, 0, 0, '', now(), now());

INSERT INTO `imhhfs_file_type` (`id`, `name`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(1, 'image', 0, 0, now(), now()),
(2, 'video', 0, 0, now(), now()),
(3, 'audio', 0, 0, now(), now()),
(4, 'text', 0, 0, now(), now()),
(5, 'other', 0, 0, now(), now());

INSERT INTO `imhhfs_file_extension` (`id`, `name`, `active`, `file_type`, `deleted`, `hidden`, `updated_at`, `created_at`) VALUES
(NULL, '.jpg', 1, 1, 0, 0, now(), now()),
(NULL, '.jpeg', 1, 1, 0, 0, now(), now()),
(NULL, '.gif', 1, 1, 0, 0, now(), now()),
(NULL, '.svg', 1, 1, 0, 0, now(), now()),
(NULL, '.png', 1, 1, 0, 0, now(), now()),
(NULL, '.ico', 1, 1, 0, 0, now(), now()),
(NULL, '.mp4', 1, 2, 0, 0, now(), now()),
(NULL, '.webm', 1, 2, 0, 0, now(), now()),
(NULL, '.ogg', 1, 2, 0, 0, now(), now()),
(NULL, '.avi', 1, 2, 0, 0, now(), now()),
(NULL, '.mov', 0, 2, 0, 0, now(), now()),
(NULL, '.movie', 0, 2, 0, 0, now(), now()),
(NULL, '.mpe', 0, 2, 0, 0, now(), now()),
(NULL, '.mpeg', 0, 2, 0, 0, now(), now()),
(NULL, '.mpg', 0, 2, 0, 0, now(), now()),
(NULL, '.qt', 0, 2, 0, 0, now(), now()),
(NULL, '.wmv', 0, 2, 0, 0, now(), now()),
(NULL, '.midi', 1, 3, 0, 0, now(), now()),
(NULL, '.mp2', 0, 3, 0, 0, now(), now()),
(NULL, '.mp3', 1, 3, 0, 0, now(), now()),
(NULL, '.mpga', 0, 3, 0, 0, now(), now()),
(NULL, '.wav', 1, 3, 0, 0, now(), now()),
(NULL, '.css', 0, 4, 0, 0, now(), now()),
(NULL, '.htm', 0, 4, 0, 0, now(), now()),
(NULL, '.html', 0, 4, 0, 0, now(), now()),
(NULL, '.rtf', 0, 4, 0, 0, now(), now()),
(NULL, '.rtx', 0, 4, 0, 0, now(), now()),
(NULL, '.sgm', 0, 4, 0, 0, now(), now()),
(NULL, '.sgml', 0, 4, 0, 0, now(), now()),
(NULL, '.xml', 0, 4, 0, 0, now(), now()),
(NULL, '.txt', 1, 4, 0, 0, now(), now()),
(NULL, '.tar', 0, 5, 0, 0, now(), now()),
(NULL, '.tcl', 0, 5, 0, 0, now(), now()),
(NULL, '.pdf', 1, 5, 0, 0, now(), now()),
(NULL, '.zip', 1, 5, 0, 0, now(), now()),
(NULL, '.rar', 1, 5, 0, 0, now(), now()),
(NULL, '.xls', 1, 5, 0, 0, now(), now()),
(NULL, '.doc', 1, 5, 0, 0, now(), now()),
(NULL, '.ppt', 1, 5, 0, 0, now(), now()),
(NULL, '.xlsx', 1, 5, 0, 0, now(), now()),
(NULL, '.pptx', 1, 5, 0, 0, now(), now());