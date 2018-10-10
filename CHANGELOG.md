# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.1.1]
### Added
- Access on hidden files for `superadmin`
- Access on hidden users for `superadmin`
- Redirect to same user page where "click" happened
- `nowrap` CSS class to table values

### Changed
- `$settings` to `$this->settings` in [`FileController`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php)
- Margins in forms

## [2.1.0] - 2018-10-10
### Added
- `hidden` in [`Base.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/MappedSuperclass/Base.php)
- [`UserController::toggleHiddenAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php#L388)
- [`UserController::removeAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php#L412)
- [`User::getPublicFiles`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/User.php#L136)
- `cascade={"persist", "remove"}` to [`User::$recoveryCodes`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/User.php#L37)
- `cascade={"persist", "remove"}` to [`User::$files`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Entity/User.php#L53)
- `currentUser` in [`GeneralExtension.php`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Twig/GeneralExtension.php#L26)
- Cookie policy modal
- Table to user files (if user is "guest")
- ACL resources `edit_file_other` and `delete_file_other`
- Translations

### Changed
- [`UserController::logoutAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php#L221)
- [`UserController::updateRoleAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php#L151)
- [`UserController::showAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/UserController.php#L80)
- `FileController::togglePublicAction` is now [`FileController::toggleHiddenAction`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/src/Controller/FileController.php#L171)
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
- Boostrap [`tables.scss`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/scss/lib/bootstrap.scss#L10)
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
