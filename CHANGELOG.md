# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.0.0]
### Added
- `nochso/html-compress-twig` dependency
- `google/recaptcha` dependency
- `symfony/console` dependency
- `composer.lock`
- `package-lock.json`
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
- `.gitignore`
- `deploy.sh`
- `README.md`
- [`Setup.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Composer/Setup.php)
- [`additional-settings.dist.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/additional-settings.dist.php)
- [`settings.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/settings.php)
- [`localisation.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/config/localisation.php) to use less code
- all `user-show-` routes required `name` parameter
- `user/show.html.twig` to use less code
- Docker database name
- `gulpfile.js`
- `locale/en-US.php`
- `locale/de-DE.php`
- DataTable init call
- `imhhfs_file_extension.file_type` to `imhhfs_file_extension.file_type_id`
- `imhhfs_file.extension` to `imhhfs_file.file_extension_id`
- `user-show` route to be like domain.com/{name}
- default database host `127.0.0.1` to `localhost`
- Font Awesome 5.4 to Font Awesome 5.8
- Bootstrap 4.1 to Bootstrap 4.3
- jQuery 3.3 to jQuery 3.4
- del 4.0 to del 4.1
- gulp 3.9 to gulp 4.0
- gulp-clean-css 3.10 to gulp-clean-css 4.0
- gulp-imagemin 4.1 to gulp-imagemin 5.0

### Fixed
- `langswitch.js`
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
- Upgrade from [Gulp Templating 3.0](https://github.com/InsanityMeetsHH/gulp-templating/tree/3.0.0) to [Gulp Templating 3.1](https://github.com/InsanityMeetsHH/gulp-templating/tree/3.1.0)
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
