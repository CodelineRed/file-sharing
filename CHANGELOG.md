# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [4.1.0]
### Added
- [`docker/adminer.css`](https://github.com/CodelineRed/file-sharing/blob/main/docker/adminer.css)
- [`docker/Adminer.Dockerfile`](https://github.com/CodelineRed/file-sharing/blob/main/docker/Adminer.Dockerfile)

### Changed
- [`lib/bootstrap.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/lib/bootstrap.scss)
- [`module/_cookieconsent.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_cookieconsent.scss)
- [`module/_general.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_general.scss)
- [`module/_modal.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_modal.scss)
- [`module/_navigation_.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_navigation.scss)
- [`module/_page.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_page.scss)
- [`module/_switch.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_switch.scss)
- [`scss/_variables.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/_variables.scss)
- [`scss/styles.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/styles.scss)
- [`locale/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/locale/de-DE.php)
- [`locale/en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/locale/en-US.php)
- [`file-extension/create.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/file-extension/create.html.twig)
- [`template/layout`](https://github.com/CodelineRed/file-sharing/blob/main/template/layout)
- [`partial/langswitch.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/partial/langswitch.html.twig)
- [`partial/modal-create-folder.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/partial/modal-create-folder.html.twig)
- [`partial/navigation.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/partial/navigation.html.twig)
- [`user/enable-two-factor.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/user/enable-two-factor.html.twig)
- [`user/login.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/user/login.html.twig)
- [`user/register.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/user/register.html.twig)
- [`user/settings.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/user/settings.html.twig)
- [`user/two-factor.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/user/two-factor.html.twig)
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- [`docker-compose.yml`](https://github.com/CodelineRed/file-sharing/blob/main/docker-compose.yml)
- @fortawesome/fontawesome-free 6.2.1 to 6.4.2
- bootstrap 5.2.3 to 5.3.1
- browser-sync 2.27.10 to 2.29.3
- datatables.net 1.13.1 to 1.13.6
- datatables.net-bs5 1.13.1 to 1.13.6
- jquery 3.6.1 to 3.7.1
- sass 1.56.1 to 1.64.2

### Removed
- unnecessary composer from [`docker-compose.yml`](https://github.com/CodelineRed/file-sharing/blob/main/docker-compose.yml)
- `config/uploads.ini` and replaced with [`docker/php.ini`](https://github.com/CodelineRed/file-sharing/blob/main/docker/php.ini)
- `Dockfile` and replaced with [`docker/Webserver.Dockfile`](https://github.com/CodelineRed/file-sharing/blob/main/docker/Webserver.Dockfile)
- branch master an replaced with [`main`](https://github.com/CodelineRed/file-sharing/blob/main)

## [4.0.0] - 2022-12-09
### Added
- `'htmlcompress' => true,` at `renderer` in [`config/settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/settings.php)
- [`module/bootstrap.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/bootstrap.js)
- validation in [`module/create-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/create-folder.js)
- backslash recognition in [`module/two-factor.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/two-factor.js)
- validation and placeholder in [`module/update-file.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-file.js)
- validation and placeholder in [`module/update-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-folder.js)
- textarea and placeholder style in [`module/_modal.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_modal.scss)
- redirect in [`public/.htaccess`](https://github.com/CodelineRed/file-sharing/blob/main/public/.htaccess)
- [`sql/upload_limit-records.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/upload_limit-records.sql)
- note handling at `updateFileAction()` in [`Controller/ApiController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/ApiController.php)
- note handling at `getFileAction()` in [`Controller/ApiController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/ApiController.php)
- return type at all setter in [`MappedSuperclass/Base.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/MappedSuperclass/Base.php)
- return type at all setter in [`MappedSuperclass/BaseJoin.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/MappedSuperclass/BaseJoin.php)
- [`MappedSuperclass/BaseUuid.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/MappedSuperclass/BaseUuid.php)
- `$settings['renderer']['htmlcompress']` in [`src/dependencies.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/dependencies.php)
- note textarea in [`partial/modal-update-file.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/partial/modal-update-file.html.twig)
- `partial/modal-create-folder.html.twig` in [`folder/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/template/folder/show.html.twig)
- `platform` in [`composer.json`](https://github.com/CodelineRed/file-sharing/blob/main/composer.json)
- doctrine/annotations 1.13
- ramsey/uuid-doctrine 1.8
- symfony/cache 6.0
- datatables.net-bs5 1.13.1
- sass 1.56.1

### Changed
- bools to lowercase and `dbname` in [`config/additional-settings.dist.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php)
- bools to lowercase in [`config/settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/settings.php)
- `proxy` in [`app/gulpfile.dist.json`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/gulpfile.dist.json)
- BS4 to BS5 syntax in [`module/cookieconsent.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/cookieconsent.js)
- access button template in [`module/create-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/create-folder.js)
- access button and folder button template in [`module/update-file.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-file.js)
- access button template in [`module/update-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-folder.js)
- BS4 to BS5 syntax in [`js/scripts.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/scripts.js)
- BS4 to BS5 syntax in [`lib/bootstrap.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/lib/bootstrap.scss)
- FA5 to FA6 syntax in [`lib/fontawesome.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/lib/fontawesome.scss)
- button background color in [`module/_cookieconsent.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_cookieconsent.scss)
- button group input style in [`module/_general.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_general.scss)
- hierarchy in [`module/_switch.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_switch.scss)
- font family in [`module/_timeline.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_timeline.scss)
- BS4 to BS5 syntax in [`plugin/datatables.bootstrap.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/plugin/datatables.bootstrap.scss)
- various in [`scss/_variables.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/_variables.scss)
- [`locale/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/locale/de-DE.php)
- [`locale/en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/locale/en-US.php)
- nickname in [`public/.htaccess`](https://github.com/CodelineRed/file-sharing/blob/main/public/.htaccess)
- `imhhfs_*` to `fs_*` in [`sql/*.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql)
- [`Composer/Setup.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Composer/Setup.php)
- [`Controller/ApiController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/ApiController.php)
- `imhhfs_*` to `fs_*` in [`Entity/*.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity)
- `extends Base` to `extends BaseUuid` in [`Entity/File.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php)
- `extends Base` to `extends BaseUuid` in [`Entity/Folder.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/Folder.php)
- `extends Base` to `extends BaseUuid` in [`Entity/RecoveryCode.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/RecoveryCode.php)
- `localeQualityAsc()` for php 8.0 in [`Utility/LanguageUtility.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Utility/LanguageUtility.php)
- `templates` to [`template`](https://github.com/CodelineRed/file-sharing/blob/main/template)
- `templates/layouts` to [`template/layout`](https://github.com/CodelineRed/file-sharing/blob/main/template/layout)
- `templates/partials` to [`template/partial`](https://github.com/CodelineRed/file-sharing/blob/main/template/partial)
- BS4 to BS5 syntax in all twig files
- [`.gitignore`](https://github.com/CodelineRed/file-sharing/blob/main/.gitignore)
- `php:7.4.2` to `php:8.0` in [`Dockerfile`](https://github.com/CodelineRed/file-sharing/blob/main/Dockerfile)
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- [`deploy.sh`](https://github.com/CodelineRed/file-sharing/blob/main/deploy.sh)
- ports and database name in [`docker-compose.yml`](https://github.com/CodelineRed/file-sharing/blob/main/docker-compose.yml)
- nickname and `datatables.net-bs4` to `datatables.net-bs5` in [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- doctrine/orm 2.5 to 2.13
- monolog/monolog 1.17 to 1.27
- slim/slim 3.1 to 3.12
- slim/twig-view 2.3 to 2.5
- symfony/console 3.0|4.0 to 6.0
- @fortawesome/fontawesome-free 5.15.2 to 6.2.1
- bootstrap 4.6.0 to 5.2.3
- browser-sync 2.26.14 to 2.27.10
- datatables.net 1.10.23 to 1.13.1
- del 6.0.0 to 6.1.1
- gulp-autoprefixer 7.0.1 to 8.0.0
- gulp-sass 4.1.0 to 5.1.0
- gulp-uglify-es 2.0.0 to 3.0.0
- jquery 3.5.1 to 3.6.1

### Fixed
- typo in [`routes/xx-XX.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/xx-XX.php)
- undefined index in [`Controller/ErrorController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/ErrorController.php)
- return type at `getFile()` and `setFile()` in [`Entity/File.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php)
- return type at `getCurrentUser()` and `encryptPassword()` in [`Utility/GeneralUtility.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Utility/GeneralUtility.php)

### Removed
- `$id` in [`Entity/File.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php)
- `$id` in [`Entity/Folder.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/Folder.php)
- `$id` in [`Entity/RecoveryCode.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/RecoveryCode.php)
- unused `findAll()` in [`Repository/UserRepository.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Repository/UserRepository.php)
- `composer.lock`
- `package-lock.json`
- datatables.net-bs4

## [3.10.0] - 2022-11-13
### Added
- `findAccessibleFiles()` in [`FolderRepository.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Repository/FolderRepository.php)

### Changed
- `showAction()` in [`FolderController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FolderController.php)

### Fixed
- files was not editable in [`folder/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/folder/show.html.twig)
- favicon path in [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)

## [3.9.1] - 2021-02-28
### Changed
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)

## [3.9.0] - 2021-02-27
### Changed
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- [`.htaccess`](https://github.com/CodelineRed/file-sharing/blob/main/public/.htaccess)
- [`.gitignore`](https://github.com/CodelineRed/file-sharing/blob/main/.gitignore)
- @fortawesome/fontawesome-free 5.15.1 to 5.15.2
- bootstrap 4.5.3 to 4.6.0
- browser-sync 2.26.12 to 2.26.14
- datatables.net 1.10.22 to 1.10.23
- datatables.net-bs4 1.10.22 to 1.10.23
- gulp-favicons 2.4.0 to 3.0.0
- gulp-sourcemaps 2.6.5 to 3.0.0

### Fixed
- user-settings link in [`navigation.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/navigation.html.twig)

## [3.8.0] - 2020-10-17
### Added
- user settings page
- `FILE_SHARING_TIMESTAMP` in [`public/index.php`](https://github.com/CodelineRed/file-sharing/blob/main/public/index.php)
- [`module/two-factor.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/two-factor.js)
- [`module/_two-factor.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_two-factor.scss)
- favicon task in [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- [`favicon.png`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/img/favicon.png)
- 2 screenshots
- gulp-favicons 2.4.0

### Changed
- [`scripts.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/scripts.js)
- order in cleanUp task and how to remove files from js/css folder in [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- favicon html in [`layout.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/layouts/layout.html.twig)
- [`user/enable-two-factor.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/enable-two-factor.html.twig)
- [`user/two-factor.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/two-factor.html.twig)
- order of dependencies and devDependencies in [`package.json`](https://github.com/CodelineRed/file-sharing/blob/main/package.json)
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- @fortawesome/fontawesome-free 5.13.0 to 5.15.1
- bootstrap 4.5.0 to 4.5.3
- browser-sync 2.26.7 to 2.26.12
- datatables.net 1.10.21 to 1.10.22
- datatables.net-bs4 1.10.21 to 1.10.22
- del 5.1.0 to 6.0.0

### Deprecated
- [`user/create.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/create.html.twig)

### Fixed
- superadmin could see the "Create Folder" button for third party accounts
- dropdown menu position
- user registration with upload limit
- sql files
- headline in [`user/recovery-codes.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/recovery-codes.html.twig)

### Removed
- options from [`GeneralUtility::encryptPassword()`](https://github.com/CodelineRed/file-sharing/blob/main/src/Utility/GeneralUtility.php) because "Use of the 'salt' option to password_hash is deprecated"
- `gulpfiles/img/favicons` folder
- browserSyncInit() config in [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js) and moved in [`gulpfile.json`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/gulpfile.dist.json)

## [3.7.0] - 2020-05-30
### Added
- [`npm-postinstall.js`](https://github.com/CodelineRed/file-sharing/blob/main/npm-postinstall.js)
- lintAll task in [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)

### Changed
- [`data-table.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/data-table.js)
- [`_datatables.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_datatables.scss)
- pagination style in [`_variables.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/_variables.scss)
- [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- gulp-clean-css 4.2.0 to 4.3.0
- gulp-sass 4.0.2 to 4.1.0
- fontawesome 5.12.1 to 5.13.0
- bootstrap 4.4.1 to 4.5.0
- datatables.net 1.10.20 to 1.10.21
- datatables.net-bs4 1.10.20 to 1.10.21
- jquery 3.4.1 to 3.5.1

### Fixed
- create folder button in "Edit File" modal

### Removed
- `npm-postinstall.php`

## [3.6.0] - 2020-03-15
### Added
- [`gulpfiles/app/lint.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/lint.js)

### Changed
- [`js-lint.json`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/js-lint.json)
- [`scripts.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/scripts.js)
- [`_page.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_page.scss)
- [`user/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show.html.twig)
- [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)

### Fixed
- non spinning fa-sync-alt

## [3.5.0] - 2020-03-09
Please see [`UPGRADE.md`](https://github.com/CodelineRed/file-sharing/blob/main/UPGRADE.md#upgrade-from-340-to-350)!

### Added
- rotated-flipped to [`fontawesome.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/lib/fontawesome.scss)
- [`_error-animation.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_error-animation.scss)
- [`version-3.5.0-migration.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/version-3.5.0-migration.sql)
- [`UploadLimit.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/UploadLimit.php) Entity
- [`UserRepository::getDiskUsage()`](https://github.com/CodelineRed/file-sharing/blob/main/src/Repository/UserRepository.php)
- [`partials/error-animation.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/error-animation.html.twig)
- upload limit feature
- save table state feature
- reopen tab feature
- `@return` in PHPDoc for all entities
- SVG icons from [Fontawesome.com](https://fontawesome.com) for error animation

### Changed
- [`data-table.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/data-table.js)
- [`process-location-hash.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/process-location-hash.js)
- [`scripts.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/scripts.js)
- [`styles.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/styles.scss)
- [`data-model-adminer.png`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model-adminer.png)
- [`data-model.dia`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model.dia)
- [`data-model-dia.png`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model-dia.png)
- [`db-dump.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/db-dump.sql)
- [`FileController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileController.php)
- [`partials/file-table.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/file-table.html.twig)
- [`partials/folder-table.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/folder-table.html.twig)
- [`user/show-all.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show-all.html.twig)
- [`user/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show.html.twig)
- all error pages

### Fixed
- file extension on download in [`FileController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileController.php)
- application crash on download, if file name has some forbidden special chars

## [3.4.0] - 2020-02-29
### Added
- [`upload-file-form.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/upload-file-form.js)
- [`data-model-dia.png`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model-dia.png)
- [`data-model.dia`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model.dia)
- [`FileExtension::uniqueFilesQuantity()`](https://github.com/CodelineRed/file-sharing/blob/main/src/Twig/FileExtension.php)
- [`gulp-if`](https://www.npmjs.com/package/gulp-if) module
- `nullable=false` to the most of `@ORM\JoinColumn`
- ability to save notes without clicking file included button

### Changed
- [`create-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/create-folder.js)
- [`scripts.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/scripts.js)
- [`_timeline.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_timeline.scss)
- [`npm-postinstall.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/php/npm-postinstall.php)
- [`db-dump.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/db-dump.sql)
- [`Setup.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Composer/Setup.php)
- [`UserController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- [`.gitignore`](https://github.com/CodelineRed/file-sharing/blob/main/.gitignore)
- [`docker-compose.yml`](https://github.com/CodelineRed/file-sharing/blob/main/docker-compose.yml)
- [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- js files to ES6
- php translation files
- margins and paddings of headline in some twig templates
- vanilla-lazyload 8.17.0 to vanilla-lazyload 12.4.0

### Removed
- `data-model.png` and replaced by [`data-model-adminer.png`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model-adminer.png)
- gulpfile-config.dist.json and replaced with [`src/app/gulpfile.dist.json`](https://github.com/CodelineRed/gulp-templating/blob/main/src/app/gulpfile.dist.json)
- gulp-uglify and replaced with gulp-uglify-es

### Fixed
- `Undefined index REQUEST_SCHEME` in [`LanguageExtension.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Twig/LanguageExtension.php)
- column Files always "0" in [`user/show-all.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show-all.html.twig)

## [3.3.0] - 2020-02-16
Please see [`UPGRADE.md`](https://github.com/CodelineRed/file-sharing/blob/main/UPGRADE.md#upgrade-from-320-to-330)!

### Added
- [`create-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/create-folder.js)
- [`data-table.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/data-table.js)
- [`process-location-hash.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/process-location-hash.js)
- [`update-folder.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-folder.js)
- [`_fontawesome.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_fontawesome.scss)
- [`version-3.3.0-migration.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/version-3.2.0-migration.sql)
- [`FolderController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FolderController.php)
- [`Access.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/Access.php) Entity
- [`FileFolderJoin.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/FileFolderJoin.php) Entity
- [`Folder.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/Folder.php) Entity
- [`BaseJoin.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/MappedSuperclass/BaseJoin.php) MappedSuperclass
- [`AccessRepository.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Repository/AccessRepository.php)
- [`FolderRepository.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Repository/FolderRepository.php)
- [`UserRepository.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Repository/UserRepository.php)
- [`folder/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/folder/show.html.twig)
- [`file-table.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/file-table.html.twig)
- [`folder-table.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/folder-table.html.twig)
- [`modal-update-folder.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/modal-update-folder.html.twig)
- [`modal-create-folder.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/modal-create-folder.html.twig)
- [string-format-js](https://www.npmjs.com/package/string-format-js) 1.0.0

### Changed
- `File::$access` is now a foreign key and Access Entity
- [`additional-settings.dist.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php)
- [`settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/settings.php)
- [`update-file.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-file.js)
- [`scripts.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/scripts.js)
- [`bootstrap.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/lib/bootstrap.scss)
- [`_general.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_general.scss)
- [`_modal.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_modal.scss)
- [`_page.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_page.scss)
- [`_variables.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/_variables.scss)
- [`styles.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/styles.scss)
- [`db-dump.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/db-dump.sql)
- [`ApiController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/ApiController.php)
- [`FileController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileController.php)
- [`FileExtensionController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileExtensionController.php)
- [`PageController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/PageController.php)
- [`UserController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- [`Base.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/MappedSuperclass/Base.php) MappedSuperclass
- [`file/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/file/show.html.twig)
- [`file-extension/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/file-extension/show.html.twig)
- [`layout.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/layouts/layout.html.twig)
- [`alert.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/alert.html.twig) to dismissible
- [`modal-update-file.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/modal-update-file.html.twig)
- [`user/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show.html.twig)
- [`user/two-factor.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/two-factor.html.twig)
- [`Dockerfile`](https://github.com/CodelineRed/file-sharing/blob/main/Dockerfile) to php 7.4.2
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- [`UPGRADE.md`](https://github.com/CodelineRed/file-sharing/blob/main/UPGRADE.md)
- [`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- all entities
- all translation files
- all route files
- all [screenshots](https://github.com/CodelineRed/file-sharing/tree/main/screenshots)
- @fortawesome/fontawesome-free 5.12.0 to @fortawesome/fontawesome-free 5.12.1
- gulp-imagemin 7.0.0 to gulp-imagemin 7.1.0

### Removed
- datatables 1.10.18 and replaced by datatables.net 1.10.20
- `acl_resources['delete_*']` and replaced by `acl_resources['remove_*']`
- `acl_resources['edit_*']` and replaced by `acl_resources['update_*']`
- `edit-file.js` and replaced by [`update-file.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/update-file.js)
- `modal-edit-file.html.twig` and replaced by [`modal-update-file.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/modal-update-file.html.twig)

## [3.2.0] - 2020-01-19
Please see [`UPGRADE.md`](https://github.com/CodelineRed/file-sharing/blob/main/UPGRADE.md#upgrade-from-310-to-320)!

### Added
- 3 access states for files (public, shareable and private).
- [`version-3.2.0-migration.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/version-3.2.0-migration.sql)
- [`uploads.ini`](https://github.com/CodelineRed/file-sharing/blob/main/config/uploads.ini) and use it in [`docker-compose.yml`](https://github.com/CodelineRed/file-sharing/blob/main/docker-compose.yml)
- [`modal-edit-file.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/modal-edit-file.html.twig)
- [`ApiController.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/ApiController.php)
- [screenshots](https://github.com/CodelineRed/file-sharing/tree/main/screenshots)

### Changed
- [`composer.json`](https://github.com/CodelineRed/file-sharing/blob/main/composer.json) minimum php version from 5.5.0 to 5.5.9. (Because of `symfony/console`)
- [`db-dump.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/db-dump.sql)
- [`Dockerfile`](https://github.com/CodelineRed/file-sharing/blob/main/Dockerfile)
- [`user/show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show.html.twig)
- [`UPGRADE.md`](https://github.com/CodelineRed/file-sharing/blob/main/UPGRADE.md)
- Docker installation steps
- translation files
- route files
- gulp-imagemin 6.2.0 to gulp-imagemin 7.0.0

### Removed
- `modal.html.twig` and replaced by [`modal-cookie-policy.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/modal-cookie-policy.html.twig)
- `db-model.png` and replaced by [`data-model-dia.png`](https://github.com/CodelineRed/file-sharing/blob/main/screenshots/data-model-dia.png)

### Fixed
- wrong database name in [`docker-compose.yml`](https://github.com/CodelineRed/file-sharing/blob/main/docker-compose.yml)

## [3.1.0] - 2020-01-04
### Added
- system overview and system logs page
- Bootstrap position utility
- [`GeneralUtility::getUploadMaxFilesize()`](https://github.com/CodelineRed/file-sharing/blob/main/src/Utility/GeneralUtility.php)
- `FILE_SHARING_VERSION` in [`public/index.php`](https://github.com/CodelineRed/file-sharing/blob/main/public/index.php)
- translations
- `"type": "project"` in [`composer.json`](https://github.com/CodelineRed/file-sharing/blob/main/composer.json)

### Changed
- jquery 3.3.1 to jquery 3.4.1
- del 4.1.0 to del 5.1.0
- browser-sync 2.26.3 to browser-sync 2.26.7
- gulp 4.0.1 to gulp 4.0.2
- gulp-clean-css 4.1 to gulp-clean-css 4.2
- gulp-imagemin 5.0.3 to gulp-imagemin 6.2.0
- @fortawesome/fontawesome-free 5.8.1 to @fortawesome/fontawesome-free 5.12.0
- cookieconsent 3.1.0 to cookieconsent 3.1.1

## [3.0.0] - 2019-04-23
### Added
- `nochso/html-compress-twig` dependency
- `google/recaptcha` dependency
- `symfony/console` dependency
- [`composer.lock`](https://github.com/CodelineRed/file-sharing/blob/main/composer.lock)
- [`package-lock.json`](https://github.com/CodelineRed/file-sharing/blob/main/package-lock.json)
- `lang` attribute to langswitch
- `{% htmlcompress %}...{% endhtmlcompress %}` to [`templates/layouts/layout.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/layouts/layout.html.twig)
- `<header>`, `<main>` and `<footer>` html tag to [`templates/layouts/layout.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/layouts/layout.html.twig)
- register form
- settings for user validation
- settings for active pages
- user validation function
- role selection, remove user and hide user to `user/show-all.html.twig`
- confirm window if a record should be removed
- Cookie policy modal text and table
- database model ([`db-model.png`](https://github.com/CodelineRed/file-sharing/blob/main/db-model.png))
- [`gulpfile-config.dist.json`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile-config.dist.json)
- `postinstall` script in [`npm-postinstall.php`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/php/npm-postinstall.php)
- database column comments
- cookiesAllowed JavaScript variable
- construction partial
- Bootstrap dropdown, nav, display and float
- CI for twig templates
- pseudo headlines for error templates
- condition for reCAPTCHA in layout.html.twig, register.html.twig and UserController
- responsive font size
- prevention of duplicated note file names
- burger navigation
- pdf viewer

### Changed
- [`.gitignore`](https://github.com/CodelineRed/file-sharing/blob/main/.gitignore)
- [`deploy.sh`](https://github.com/CodelineRed/file-sharing/blob/main/deploy.sh)
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)
- [`Setup.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Composer/Setup.php)
- [`additional-settings.dist.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php)
- [`settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/settings.php)
- [`localisation.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/localisation.php) to use less code
- all `user-show-` routes required `name` parameter
- [`show.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/show.html.twig) to use less code
- [`enable-two-factor.html.twig`](https://github.com/CodelineRed/file-sharing/blob/main/templates/user/enable-two-factor.html.twig)
- Docker database name
- `gulpfile.js`[`gulpfile.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfile.js)
- [`en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/locale/en-US.php)
- [`de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/locale/de-DE.php)
- DataTable init call
- `imhhfs_file_extension.file_type` to `imhhfs_file_extension.file_type_id`
- `imhhfs_file.extension` to `imhhfs_file.file_extension_id`
- `user-show` route to be like domain.com/{name}
- default database host `127.0.0.1` to `localhost`
- Font Awesome 5.4 to Font Awesome 5.8
- Bootstrap 4.1 to Bootstrap 4.3
- del 4.0 to del 4.1
- gulp 3.9 to gulp 4.0
- gulp-clean-css 3.10 to gulp-clean-css 4.1
- gulp-imagemin 4.1 to gulp-imagemin 5.0

### Fixed
- [`langswitch.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/langswitch.js)
- switch button hover
- file extension deleted and hidden flags in [`db-dump.sql`](https://github.com/CodelineRed/file-sharing/blob/main/sql/db-dump.sql)

### Removed
- `user-create` route and replaced by `user-register`
- `user-save` route and replaced by `user-register-save`
- Font Awesome JS/SVG Framework from build process
- redundantly error message in FileController
- `new \mysqli` and replaced by `new \PDO` in [Setup.php](https://github.com/CodelineRed/file-sharing/blob/main/src/Composer/Setup.php)

## [2.3.1] - 2018-10-22
### Fixed
- DataTables arrows different from Windows to macOS
- `$_SESSION['currentRole']` is not set in some cases

## [2.3.0] - 2018-10-21
### Added
- [DataTables](https://datatables.net) with [Bootstrap 4](https://datatables.net/examples/styling/bootstrap4.html) styling

## [2.2.2] - 2018-10-16
### Added
- Spinner to form submit button (visible after click)
- Disable form submit button on click
- Continuous integration update
- Inactive PHP 5.5 image to [`Dockerfile`](https://github.com/CodelineRed/file-sharing/blob/main/Dockerfile)

### Changed
- [`README.md`](https://github.com/CodelineRed/file-sharing/blob/main/README.md)

### Fixed
- [`FileExtension.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Twig/FileExtension.php) constants for PHP 5.5 compatibility

## [2.2.1] - 2018-10-16
### Added
- Translations
- [Remove files](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php) from webspace if user gets removed
- [Error message](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileController.php) if file is not on disk

### Changed
- Definition of the `$currentRole` simplified in [`AclRepositoryContainer.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Container/AclRepositoryContainer.php)

### Fixed
- Translation output on recovery code page
- Cut-off font on the file show page

## [2.2.0] - 2018-10-15
### Added
- Translations
- Raw filter to flash message text
- Links in some alerts
- Lock / unlock icon to file show view
- Show selected file for upload in file upload field
- Comments
- `cascade={"persist", "remove"}` to [`File::$file`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php)
- `onDelete="SET NULL"` to [`File::$file`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php)
- Styling for file show headline

### Changed
- Translations
- File extension from `active` to `hidden` system
- SQL files

### Fixed
- Remove user redirect
- Reset database [script](https://github.com/CodelineRed/file-sharing/blob/main/src/Composer/Setup.php)
- User lock / unlock tooltips

### Removed
- File extension `active`
- Show file icon in tables
- Child file remove logic

## [2.1.2] - 2018-10-11
### Added
- Files are hidden after upload
- Skip CLI colors on windows operating system

### Changed
- Bottom margin for 2FA forms

### Fixed
- German typo

## [2.1.1] - 2018-10-11
### Added
- Access on hidden files for `superadmin`
- Access on hidden users for `superadmin`
- Redirect to same user page where "click" happened
- `nowrap` CSS class to table values
- [`FileExtension.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Twig/FileExtension.php)
- Twig filter `file_size` in [`FileExtension`](https://github.com/CodelineRed/file-sharing/blob/main/src/Twig/FileExtension.php)

### Changed
- `$settings` to `$this->settings` in [`FileController`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileController.php)
- Margins in forms
- Templates with new `file_size` twig filter
- [`File::$size`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php) from `integer` to `string`

## [2.1.0] - 2018-10-10
### Added
- `hidden` in [`Base.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/MappedSuperclass/Base.php)
- [`UserController::toggleHiddenAction`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- [`UserController::removeAction`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- [`User::getPublicFiles`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/User.php)
- `cascade={"persist", "remove"}` to [`User::$recoveryCodes`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/User.php)
- `cascade={"persist", "remove"}` to [`User::$files`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/User.php)
- `currentUser` in [`GeneralExtension.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Twig/GeneralExtension.php)
- Cookie policy modal
- Table to user files (if user is "guest")
- ACL resources `edit_file_other` and `delete_file_other`
- Translations

### Changed
- [`UserController::logoutAction`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- [`UserController::updateRoleAction`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- [`UserController::showAction`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php)
- `FileController::togglePublicAction` is now [`FileController::toggleHiddenAction`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/FileController.php)
- SQL files

### Removed
- `config/routes-de-DE.php`
- `config/routes-en-US.php`
- `public` in [`File.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/Entity/File.php)

## [2.0.0] - 2018-10-10
### Added
- Upgrade from [Slim Skeleton Fork 4.3](https://github.com/CodelineRed/file-sharing/tree/4.3.0) to [Slim Skeleton Fork 5.0.5](https://github.com/CodelineRed/file-sharing/tree/5.0.5)
- Upgrade from [Gulp Templating 3.0](https://github.com/CodelineRed/file-sharing/tree/3.0.0) to [Gulp Templating 3.1](https://github.com/CodelineRed/file-sharing/tree/3.1.0)
- [`cookieconsent.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/cookieconsent.js)
- [`cookieconsent.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/plugin/cookieconsent.scss)
- [`_switch.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/module/_switch.scss)
- File note field
- Boostrap [`tables.scss`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/scss/lib/bootstrap.scss)
- Table to user files and all users overview
- Translations
- [`cookieconsent.js`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/js/module/cookieconsent.js)

### Changed
- Mobile behavior of the whole site
- `User::getFilesIncludedFalse()` to `User::getUniqueFiles()`

### Removed
- `plugin/slick.scss`
- `module/_slider.scss`
- `HomepageTest.php`
