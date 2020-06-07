# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.7.0]
### Added
- [`npm-postinstall.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/npm-postinstall.js)
- lintAll task in [`gulpfile.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile.js)

### Changed
- [`data-table.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/data-table.js)
- [`_datatables.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_datatables.scss)
- pagination style in [`_variables.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/_variables.scss)
- [`gulpfile.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile.js)
- [`README.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/README.md)
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
- [`gulpfiles/app/lint.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/app/lint.js)

### Changed
- [`js-lint.json`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/app/js-lint.json)
- [`scripts.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/scripts.js)
- [`_page.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_page.scss)
- [`user/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show.html.twig)
- [`gulpfile.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile.js)
- [`README.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/README.md)

### Fixed
- non spinning fa-sync-alt

## [3.5.0] - 2020-03-09
Please see [`UPGRADE.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/UPGRADE.md#upgrade-from-340-to-350)!

### Added
- rotated-flipped to [`fontawesome.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/lib/fontawesome.scss)
- [`_error-animation.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_error-animation.scss)
- [`version-3.5.0-migration.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/version-3.5.0-migration.sql)
- [`UploadLimit.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/UploadLimit.php) Entity
- [`UserRepository::getDiskUsage()`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Repository/UserRepository.php)
- [`partials/error-animation.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/error-animation.html.twig)
- upload limit feature
- save table state feature
- reopen tab feature
- `@return` in PHPDoc for all entities
- SVG icons from [Fontawesome.com](https://fontawesome.com) for error animation

### Changed
- [`data-table.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/data-table.js)
- [`process-location-hash.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/process-location-hash.js)
- [`scripts.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/scripts.js)
- [`styles.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/styles.scss)
- [`data-model-adminer.png`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model-adminer.png)
- [`data-model.dia`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model.dia)
- [`data-model-dia.png`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model-dia.png)
- [`db-dump.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/db-dump.sql)
- [`FileController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php)
- [`partials/file-table.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/file-table.html.twig)
- [`partials/folder-table.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/folder-table.html.twig)
- [`user/show-all.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show-all.html.twig)
- [`user/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show.html.twig)
- all error pages

### Fixed
- file extension on download in [`FileController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php)
- application crash on download, if file name has some forbidden special chars

## [3.4.0] - 2020-02-29
### Added
- [`upload-file-form.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/upload-file-form.js)
- [`data-model-dia.png`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model-dia.png)
- [`data-model.dia`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model.dia)
- [`FileExtension::uniqueFilesQuantity()`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/FileExtension.php)
- [`gulp-if`](https://www.npmjs.com/package/gulp-if) module
- `nullable=false` to the most of `@ORM\JoinColumn`
- ability to save notes without clicking file included button

### Changed
- [`create-folder.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/create-folder.js)
- [`scripts.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/scripts.js)
- [`_timeline.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_timeline.scss)
- [`npm-postinstall.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/php/npm-postinstall.php)
- [`db-dump.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/db-dump.sql)
- [`Setup.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Composer/Setup.php)
- [`UserController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- [`.gitignore`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/.gitignore)
- [`docker-compose.yml`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/docker-compose.yml)
- [`gulpfile.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile.js)
- js files to ES6
- php translation files
- margins and paddings of headline in some twig templates
- vanilla-lazyload 8.17.0 to vanilla-lazyload 12.4.0

### Removed
- `data-model.png` and replaced by [`data-model-adminer.png`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model-adminer.png)
- gulpfile-config.dist.json and replaced with [`src/app/gulpfile.dist.json`](https://github.com/InsanityMeetsHH/gulp-templating/blob/master/src/app/gulpfile.dist.json)
- gulp-uglify and replaced with gulp-uglify-es

### Fixed
- `Undefined index REQUEST_SCHEME` in [`LanguageExtension.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/LanguageExtension.php)
- column Files always "0" in [`user/show-all.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show-all.html.twig)

## [3.3.0] - 2020-02-16
Please see [`UPGRADE.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/UPGRADE.md#upgrade-from-320-to-330)!

### Added
- [`create-folder.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/create-folder.js)
- [`data-table.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/data-table.js)
- [`process-location-hash.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/process-location-hash.js)
- [`update-folder.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/update-folder.js)
- [`_fontawesome.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_fontawesome.scss)
- [`version-3.3.0-migration.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/version-3.2.0-migration.sql)
- [`FolderController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FolderController.php)
- [`Access.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/Access.php) Entity
- [`FileFolderJoin.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/FileFolderJoin.php) Entity
- [`Folder.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/Folder.php) Entity
- [`BaseJoin.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/MappedSuperclass/BaseJoin.php) MappedSuperclass
- [`AccessRepository.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Repository/AccessRepository.php)
- [`FolderRepository.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Repository/FolderRepository.php)
- [`UserRepository.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Repository/UserRepository.php)
- [`folder/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/folder/show.html.twig)
- [`file-table.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/file-table.html.twig)
- [`folder-table.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/folder-table.html.twig)
- [`modal-update-folder.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/modal-update-folder.html.twig)
- [`modal-create-folder.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/modal-create-folder.html.twig)
- [string-format-js](https://www.npmjs.com/package/string-format-js) 1.0.0

### Changed
- `File::$access` is now a foreign key and Access Entity
- [`additional-settings.dist.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/additional-settings.dist.php)
- [`settings.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/settings.php)
- [`update-file.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/update-file.js)
- [`scripts.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/scripts.js)
- [`bootstrap.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/lib/bootstrap.scss)
- [`_general.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_general.scss)
- [`_modal.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_modal.scss)
- [`_page.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_page.scss)
- [`_variables.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/_variables.scss)
- [`styles.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/styles.scss)
- [`db-dump.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/db-dump.sql)
- [`ApiController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/ApiController.php)
- [`FileController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php)
- [`FileExtensionController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileExtensionController.php)
- [`PageController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/PageController.php)
- [`UserController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- [`Base.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/MappedSuperclass/Base.php) MappedSuperclass
- [`file/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/file/show.html.twig)
- [`file-extension/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/file-extension/show.html.twig)
- [`layout.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/layouts/layout.html.twig)
- [`alert.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/alert.html.twig) to dismissible
- [`modal-update-file.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/modal-update-file.html.twig)
- [`user/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show.html.twig)
- [`user/two-factor.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/two-factor.html.twig)
- [`Dockerfile`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/Dockerfile) to php 7.4.2
- [`README.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/README.md)
- [`UPGRADE.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/UPGRADE.md)
- [`gulpfile.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile.js)
- all entities
- all translation files
- all route files
- all [screenshots](https://github.com/InsanityMeetsHH/file-sharing/tree/master/screenshots)
- @fortawesome/fontawesome-free 5.12.0 to @fortawesome/fontawesome-free 5.12.1
- gulp-imagemin 7.0.0 to gulp-imagemin 7.1.0

### Removed
- datatables 1.10.18 and replaced by datatables.net 1.10.20
- `acl_resources['delete_*']` and replaced by `acl_resources['remove_*']`
- `acl_resources['edit_*']` and replaced by `acl_resources['update_*']`
- `edit-file.js` and replaced by [`update-file.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/update-file.js)
- `modal-edit-file.html.twig` and replaced by [`modal-update-file.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/modal-update-file.html.twig)

## [3.2.0] - 2020-01-19
Please see [`UPGRADE.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/UPGRADE.md#upgrade-from-310-to-320)!

### Added
- 3 access states for files (public, shareable and private).
- [`version-3.2.0-migration.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/version-3.2.0-migration.sql)
- [`uploads.ini`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/uploads.ini) and use it in [`docker-compose.yml`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/docker-compose.yml)
- [`modal-edit-file.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/modal-edit-file.html.twig)
- [`ApiController.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/ApiController.php)
- [screenshots](https://github.com/InsanityMeetsHH/file-sharing/tree/master/screenshots)

### Changed
- [`composer.json`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/composer.json) minimum php version from 5.5.0 to 5.5.9. (Because of `symfony/console`)
- [`db-dump.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/db-dump.sql)
- [`Dockerfile`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/Dockerfile)
- [`user/show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show.html.twig)
- [`UPGRADE.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/UPGRADE.md)
- Docker installation steps
- translation files
- route files
- gulp-imagemin 6.2.0 to gulp-imagemin 7.0.0

### Removed
- `modal.html.twig` and replaced by [`modal-cookie-policy.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/partials/modal-cookie-policy.html.twig)
- `db-model.png` and replaced by [`data-model-dia.png`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/screenshots/data-model-dia.png)

### Fixed
- wrong database name in [`docker-compose.yml`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/docker-compose.yml)

## [3.1.0] - 2020-01-04
### Added
- system overview and system logs page
- Bootstrap position utility
- [`GeneralUtility::getUploadMaxFilesize()`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Utility/GeneralUtility.php)
- `FILE_SHARING_VERSION` in [`public/index.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/public/index.php)
- translations
- `"type": "project"` in [`composer.json`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/composer.json)

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
- [`composer.lock`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/composer.lock)
- [`package-lock.json`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/package-lock.json)
- `lang` attribute to langswitch
- `{% htmlcompress %}...{% endhtmlcompress %}` to [`templates/layouts/layout.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/layouts/layout.html.twig)
- `<header>`, `<main>` and `<footer>` html tag to [`templates/layouts/layout.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/layouts/layout.html.twig)
- register form
- settings for user validation
- settings for active pages
- user validation function
- role selection, remove user and hide user to `user/show-all.html.twig`
- confirm window if a record should be removed
- Cookie policy modal text and table
- database model ([`db-model.png`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/db-model.png))
- [`gulpfile-config.dist.json`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile-config.dist.json)
- `postinstall` script in [`npm-postinstall.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/php/npm-postinstall.php)
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
- [`.gitignore`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/.gitignore)
- [`deploy.sh`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/deploy.sh)
- [`README.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/README.md)
- [`Setup.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Composer/Setup.php)
- [`additional-settings.dist.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/additional-settings.dist.php)
- [`settings.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/settings.php)
- [`localisation.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/localisation.php) to use less code
- all `user-show-` routes required `name` parameter
- [`show.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/show.html.twig) to use less code
- [`enable-two-factor.html.twig`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/templates/user/enable-two-factor.html.twig)
- Docker database name
- `gulpfile.js`[`gulpfile.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfile.js)
- [`en-US.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/locale/en-US.php)
- [`de-DE.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/locale/de-DE.php)
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
- [`langswitch.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/langswitch.js)
- switch button hover
- file extension deleted and hidden flags in [`db-dump.sql`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/sql/db-dump.sql)

### Removed
- `user-create` route and replaced by `user-register`
- `user-save` route and replaced by `user-register-save`
- Font Awesome JS/SVG Framework from build process
- redundantly error message in FileController
- `new \mysqli` and replaced by `new \PDO` in [Setup.php](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Composer/Setup.php)

## [2.3.1] - 2018-10-22
### Fixed
- DataTables arrows different from Windows to macOS
- `$_SESSION['currentRole']` is not set in some cases

## [2.3.0] - 2018-10-21
### Added
- [DataTables](https://datatables.net/) with [Bootstrap 4](https://datatables.net/examples/styling/bootstrap4.html) styling

## [2.2.2] - 2018-10-16
### Added
- Spinner to form submit button (visible after click)
- Disable form submit button on click
- Continuous integration update
- Inactive PHP 5.5 image to [`Dockerfile`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/Dockerfile)

### Changed
- [`README.md`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/README.md)

### Fixed
- [`FileExtension.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/FileExtension.php) constants for PHP 5.5 compatibility

## [2.2.1] - 2018-10-16
### Added
- Translations
- [Remove files](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php) from webspace if user gets removed
- [Error message](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php) if file is not on disk

### Changed
- Definition of the `$currentRole` simplified in [`AclRepositoryContainer.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Container/AclRepositoryContainer.php)

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
- `cascade={"persist", "remove"}` to [`File::$file`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/File.php)
- `onDelete="SET NULL"` to [`File::$file`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/File.php)
- Styling for file show headline

### Changed
- Translations
- File extension from `active` to `hidden` system
- SQL files

### Fixed
- Remove user redirect
- Reset database [script](https://github.com/InsanityMeetsHH/Slim-Skeleton/blob/master/src/Composer/Setup.php)
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
- [`FileExtension.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/FileExtension.php)
- Twig filter `file_size` in [`FileExtension`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/FileExtension.php)

### Changed
- `$settings` to `$this->settings` in [`FileController`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php)
- Margins in forms
- Templates with new `file_size` twig filter
- [`File::$size`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/File.php) from `integer` to `string`

## [2.1.0] - 2018-10-10
### Added
- `hidden` in [`Base.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/MappedSuperclass/Base.php)
- [`UserController::toggleHiddenAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- [`UserController::removeAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- [`User::getPublicFiles`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/User.php)
- `cascade={"persist", "remove"}` to [`User::$recoveryCodes`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/User.php)
- `cascade={"persist", "remove"}` to [`User::$files`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/User.php)
- `currentUser` in [`GeneralExtension.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/GeneralExtension.php)
- Cookie policy modal
- Table to user files (if user is "guest")
- ACL resources `edit_file_other` and `delete_file_other`
- Translations

### Changed
- [`UserController::logoutAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- [`UserController::updateRoleAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- [`UserController::showAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php)
- `FileController::togglePublicAction` is now [`FileController::toggleHiddenAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php)
- SQL files

### Removed
- `config/routes-de-DE.php`
- `config/routes-en-US.php`
- `public` in [`File.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/File.php)

## [2.0.0] - 2018-10-10
### Added
- Upgrade from [Slim Skeleton Fork 4.3](https://github.com/InsanityMeetsHH/Slim-Skeleton/tree/4.3.0) to [Slim Skeleton Fork 5.0.5](https://github.com/InsanityMeetsHH/Slim-Skeleton/tree/5.0.5)
- Upgrade from [Gulp Templating 3.0](https://github.com/InsanityMeetsHH/file-sharing/tree/3.0.0) to [Gulp Templating 3.1](https://github.com/InsanityMeetsHH/file-sharing/tree/3.1.0)
- [`cookieconsent.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/cookieconsent.js)
- [`cookieconsent.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/plugin/cookieconsent.scss)
- [`_switch.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/module/_switch.scss)
- File note field
- Boostrap [`tables.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/lib/bootstrap.scss)
- Table to user files and all users overview
- Translations
- [`cookieconsent.js`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/js/module/cookieconsent.js)

### Changed
- Mobile behavior of the whole site
- `User::getFilesIncludedFalse()` to `User::getUniqueFiles()`

### Removed
- `plugin/slick.scss`
- `module/_slider.scss`
- `HomepageTest.php`
