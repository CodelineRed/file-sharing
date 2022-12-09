### Upgrade in general
```ssh
php doctrine orm:schema-tool:update --force
```
or if you use Docker
```ssh
docker exec -ti file-sharing-webserver php doctrine orm:schema-tool:update --force
```

### Upgrade from >=3.8 to 4.0
```bash
+++++ COMPOSER VERSION +++++
---- Open console and navigate to your project folder ----
---- Backup files from public/upload (not .gitkeep) ----
---- Backup config/addtional-settings.php ----
---- Backup database records with a GUI of your choice or CLI ----
$ mysqldump -u USER -p -h HOST DATABASE imhhfs_access imhhfs_role imhhfs_upload_limit imhhfs_user imhhfs_recovery_code imhhfs_file_type imhhfs_file_extension imhhfs_file imhhfs_folder imhhfs_file_folder_join --no-create-info --no-tablespaces > ./file_sharing.sql
---- Backup and open file_sharing.sql ----
---- Rename all "imhhfs_" to "fs_" and save file ----
$ rm -rf file-sharing
$ php composer create-project codelinered/file-sharing file-sharing "dev-production"
---- Insert public/upload backup ----
---- Insert config/addtional-settings.php backup ----
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import file_sharing.sql
```

```bash
+++++ GIT VERSION +++++
---- Open console and navigate to your file-sharing folder ----
---- Backup database records with a GUI of your choice or CLI ----
$ mysqldump -u USER -p -h HOST DATABASE imhhfs_access imhhfs_role imhhfs_upload_limit imhhfs_user imhhfs_recovery_code imhhfs_file_type imhhfs_file_extension imhhfs_file imhhfs_folder imhhfs_file_folder_join --no-create-info --no-tablespaces > ./file_sharing.sql
---- Backup and open file_sharing.sql ----
---- Rename all "imhhfs_" to "fs_" and save file ----
$ rm -rf vendor
$ rm composer.lock
$ git checkout production
$ git status
$ git pull
$ php composer install --no-dev
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import file_sharing.sql
```

Now you have `imhhfs_*` and `fs_*` tables in your database. You can remove `imhhfs_*` tables if you want to.

In [`gulpfile.json`](https://github.com/CodelineRed/file-sharing/blob/master/gulpfiles/app/gulpfile.dist.json)
`"proxy": "http://127.0.0.1:3050/"` to `"proxy": "http://127.0.0.1:7710/"`

### Upgrade from 3.7 to 3.8
[`gulpfile.json`](https://github.com/CodelineRed/file-sharing/blob/master/gulpfiles/app/gulpfile.dist.json) before
```json
{
    "localServer": "http://127.0.0.1:3050/",
    "sourcePath": "gulpfiles/",
    "publicPath": "public/",
    "env": "prod"
}
```
after
```json
{
    "browserSyncDocker": {
        "port": 3000,
        "ui": {
            "port": 3001
        },
        "proxy": "http://127.0.0.1:3050/"
    },
    "browserSyncConfig": "browserSyncDocker",
    "sourcePath": "gulpfiles/",
    "publicPath": "public/",
    "env": "prod"
}
```

### Upgrade from 3.4 to 3.5
```ssh
php doctrine dbal:import sql/version-3.5.0-migration.sql
php doctrine orm:schema-tool:update --force
```

### Upgrade from 3.2 to 3.3
```ssh
php doctrine dbal:import sql/version-3.3.0-migration.sql
php doctrine orm:schema-tool:update --force
```

### Upgrade from 3.1 to 3.2
```ssh
php doctrine dbal:import sql/version-3.2.0-migration.sql
php doctrine orm:schema-tool:update --force
```
