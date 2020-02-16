-- Upgrade from 3.1.0 to 3.2.0
UPDATE imhhfs_file SET access = 0 WHERE hidden = 1;
UPDATE imhhfs_file SET access = 2 WHERE hidden = 0;
UPDATE imhhfs_file SET hidden = 0 WHERE 1;
