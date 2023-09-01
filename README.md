# File Sharing - CodelineRed

This git is for [fs.codelinered.net](https://fs.codelinered.net). Take a look at [screenshots](https://github.com/CodelineRed/file-sharing/tree/main/screenshots).

This application based on [Slim Skeleton](https://github.com/CodelineRed/file-sharing) and [Gulp Skeleton](https://github.com/CodelineRed/gulp-Skeleton).

## Table of contents
- [Included Third Party Code](#included)
- Install Guides
    - [Install Production Build (Recommended)](#install-production-build-recommended)
    - [Install Main/ Develop Build](#install-main-develop-build)
    - [Install with Docker (optional)](#install-with-docker-optional)
- [Project Commands](#project-commands)
- [`gulpfile.json`](#gulpfilejson)
- [Path generation with Locale code and Generic locale code](#path-generation-with-locale-code-and-generic-locale-code)
- [How to create further localisations](#how-to-create-further-localisations)
- [How to switch between different url modes](#how-to-switch-between-different-url-modes)
    - [Mode 1](#mode-1)
    - [Mode 2](#mode-2)
    - [Mode 3](#mode-3-default)
- [ACL settings](#acl-settings)
- [Troubleshooting](#troubleshooting)
- [Links](#links)

## Included
- [Slim 3](https://www.slimframework.com)
- [Slim Twig View 2](https://github.com/slimphp/Twig-View)
- [Slim CSRF 0.8](https://github.com/slimphp/fs-Csrf)
- [Slim Flash 0.4](https://github.com/slimphp/fs-Flash)
- [Monolog 1](https://seldaek.github.io/monolog/)
- [Doctrine ORM 2](https://packagist.org/packages/doctrine/orm)
- [Geggleto ACL 1](https://github.com/geggleto/geggleto-acl)
- [Google Authenticator](https://github.com/PHPGangsta/GoogleAuthenticator)
- [Google reCAPTCHA 1](https://github.com/google/recaptcha)
- [HTML Compress Twig Extension](https://github.com/nochso/html-compress-twig)


## Install Production Build (Recommended)
### Required
- PHP 8.0
- MySQL 5.7 (pdo_mysql)

[Download zip](https://github.com/CodelineRed/file-sharing/archive/production.zip) if you don't have git or composer on your OS.
Open console on your OS and navigate to your project folder.
```bash
+++++ COMPOSER VERSION +++++
$ php composer create-project codelinered/file-sharing file-sharing "dev-production" --no-dev
$ cd file-sharing
$ php doctrine dbal:run-sql "CREATE DATABASE file_sharing"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

```bash
+++++ GIT VERSION +++++
$ git clone https://github.com/CodelineRed/file-sharing.git
$ cd file-sharing
$ git checkout production
$ (optional on unix)  rm -rf .git
$ (optional on win10) rmdir .git /s
$ (optional) cp config\additional-settings.dist.php config\additional-settings.php
$ ---- Open "config\additional-settings.php" and change everything you have to change ----
$ php composer insall --no-dev
$ php doctrine dbal:run-sql "CREATE DATABASE file_sharing"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

```bash
+++++ ZIP VERSION +++++
$ (unix) wget -O fs-prod.zip https://github.com/CodelineRed/file-sharing/archive/production.zip
$ (unix) unzip fs-prod.zip
$ (win10) curl -L -o fs-prod.zip https://github.com/CodelineRed/file-sharing/archive/production.zip
$ (win10) tar -xf fs-prod.zip
$ cd file-sharing-production
$ (optional) cp config\additional-settings.dist.php config\additional-settings.php
$ ---- Open "config\additional-settings.php" and change everything you have to change ----
$ php composer insall --no-dev
$ php doctrine dbal:run-sql "CREATE DATABASE file_sharing"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

| Login    | Website  |
|----------|----------|
| Username | user     |
| Password | password |

If you want to use Docker: [click here](#install-with-docker-optional)

## Install Main/ Develop Build
### Required
- [Node.js](http://nodejs.org/en/download/)
- [npm](http://www.npmjs.com/get-npm) `$ npm i npm@latest -g`
- [gulp-cli](https://www.npmjs.com/package/gulp-cli) `$ npm i gulp-cli@latest -g`
- PHP 8.0
- MySQL 5.7 (pdo_mysql)

[Download zip](https://github.com/CodelineRed/file-sharing/archive/main.zip) if you don't have git on your OS.
Open console on your OS and navigate to your project folder.
```bash
+++++ COMPOSER VERSION +++++
$ php composer create-project codelinered/file-sharing file-sharing
$ cd file-sharing
$ npm i
$ gulp build
$ php doctrine dbal:run-sql "CREATE DATABASE file_sharing"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

```bash
+++++ GIT VERSION +++++
$ git clone https://github.com/CodelineRed/file-sharing.git
$ cd file-sharing
$ npm i
$ gulp build
$ (optional on unix)  rm -rf .git
$ (optional on win10) rmdir .git /s
$ (optional) cp config\additional-settings.dist.php config\additional-settings.php
$ ---- Open "config\additional-settings.php" and change everything you have to change ----
$ php composer insall
$ php doctrine dbal:run-sql "CREATE DATABASE file_sharing"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

```bash
+++++ ZIP VERSION +++++
$ (unix) wget -O fs-main.zip https://github.com/CodelineRed/file-sharing/archive/main.zip
$ (unix) unzip fs-main.zip
$ (win10) curl -L -o fs-main.zip https://github.com/CodelineRed/file-sharing/archive/main.zip
$ (win10) tar -xf fs-main.zip
$ cd file-sharing-main
$ npm i
$ gulp build
$ (optional) cp config\additional-settings.dist.php config\additional-settings.php
$ ---- Open "config\additional-settings.php" and change everything you have to change ----
$ php composer insall
$ php doctrine dbal:run-sql "CREATE DATABASE file_sharing"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

| Login    | Website  |
|----------|----------|
| Username | user     |
| Password | password |

## Install with Docker (optional)
### Required
- [Docker](https://www.docker.com/)

Open console on your OS and navigate to the place where you want to install the project.
```bash
$ ---- Unix ----
$ systemctl docker start
$ docker run --rm --interactive --tty --volume $PWD:/app composer create-project --ignore-platform-reqs --no-dev codelinered/file-sharing file-sharing "dev-production"
$ cd file-sharing
$ cp -n config/additional-settings.dist.php config/additional-settings.php
$ docker run --rm --interactive --tty --volume $PWD:/app composer update --no-dev
$ ---- Windows ----
$ "c:\path\to\Docker Desktop.exe"
$ docker run --rm --interactive --tty --volume %cd%:/app composer create-project --ignore-platform-reqs --no-dev codelinered/file-sharing file-sharing "dev-production"
$ cd file-sharing
$ echo n | copy /-y config\additional-settings.dist.php config\additional-settings.php
$ docker run --rm --interactive --tty --volume %cd%:/app composer update --no-dev
$ --- All OS ----
$ docker-compose build
$ docker-compose up -d
```

| Login    | [Website](http://localhost:7710) | [Adminer](http://localhost:7712) |
|----------|----------------------------------|----------------------------------|
| Server   | -                                | database                         |
| Username | user                             | root                             |
| Password | password                         | rootdockerpw                     |
| Database | -                                | -                                |

## Project Commands
|               | Description                                                                                                                            |
|---------------|----------------------------------------------------------------------------------------------------------------------------------------|
| gulp          | watch files and start [BrowserSync](https://www.npmjs.com/package/browser-sync)                                                        |
| gulp build    | executes following tasks: cleanUp, favicon, font, img, js, jsLint, json, scss, scssLint, svg                                           |
| gulp lintAll  | executes following tasks: jsLint, scssLint                                                                                             |
| gulp cleanUp  | clean up public folder                                                                                                                 |
| gulp favicon  | generate favicons                                                                                                                      |
| gulp font     | copy font files                                                                                                                        |
| gulp img      | copy and compress images                                                                                                               |
| gulp js       | uglify, minify and concat js files                                                                                                     |
| gulp jsLint   | checks js follows [lint rules](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/js-lint.json)                 |
| gulp json     | copy and minify json files                                                                                                             |
| gulp scss     | compile, minify and concat scss files                                                                                                  |
| gulp scssLint | checks scss follows [lint rules](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/scss-lint.json)             |
| gulp svg      | copy and compress svg files                                                                                                            |
| gulp watch    | watch scss, js, json, img, font and svg files                                                                                          |

## [`gulpfile.json`](https://github.com/CodelineRed/file-sharing/blob/main/gulpfiles/app/gulpfile.dist.json)
|                     | Description                                                                                                                      |
|---------------------|----------------------------------------------------------------------------------------------------------------------------------|
| browserSyncConfig   | Required - Defines which config is used for [BrowserSync](https://www.npmjs.com/package/browser-sync) (default: browserSyncDocker) |
| sourcePath          | Required - Path to raw files (default: gulpfiles/)                                                                               |
| publicPath          | Required - Path to transpiled files (default: public/)                                                                           |
| env                 | Required - Environment dev, test or prod (default: prod)                                                                         |

## Path generation with Locale code and Generic locale code
- Mode 1 - example.com/de/ = `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_DISABLED,`
- Mode 2 - example.de = `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_ENABLED,`
- Mode 3 - example.com (de-DE session) = `'process' => \App\Utility\LanguageUtility::LOCALE_SESSION | \App\Utility\LanguageUtility::DOMAIN_DISABLED,` (default)

It depends on your configuration what will be returned.

|                     | Mode 1 | Mode 2 | Mode 3 |
|---------------------|--------|--------|--------|
| locale code         | de-DE  | de-DE  | xx-XX  |
| generic locale code | de-DE  | xx-XX  | xx-XX  |

|                     | Twig        | PHP                                   | Twig Example                            | PHP Example                                                                   |
|---------------------|-------------|---------------------------------------|-----------------------------------------|-------------------------------------------------------------------------------|
| locale code         | `{{ lc }}`  | `LanguageUtility::getLocale()`        | `{{ path_for('user-register-' ~ lc) }}` | `$this->router->pathFor('user-register-' . LanguageUtility::getLocale())`     |
| generic locale code | `{{ glc }}` | `LanguageUtility::getGenericLocale()` | `{{ path_for('user-login-' ~ glc) }}`   | `$this->router->pathFor('user-login-' . LanguageUtility::getGenericLocale())` |

## How to create further localisations
- Duplicate one existing file in folder [`locale/`](https://github.com/CodelineRed/file-sharing/tree/main/locale) (e.g. copy `de-DE.php` to `fr-FR.php`)
- (if you use Mode 1 or 2) Duplicate one existing file in folder [`config/routes/`](https://github.com/CodelineRed/file-sharing/tree/main/config/routes) (e.g. copy `de-DE.php` to `fr-FR.php`)
- (if you use Mode 1 or 2) Change route prefix from `/de/` to `/fr/` in `config/routes/fr-FR.php`
- You can also define paths like `/fr-be/` (`locale/fr-BE.php`/ `config/routes/fr-BE.php`) for example
- If you want to show language in langswitch, add `fr-FR` and domain in `locale => active` ([`config/additional-settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php#L56))
- (if you use Mode 1 or 2) Add case for `fr/` in [`src/localisation.php`](https://github.com/CodelineRed/file-sharing/blob/main/src/localisation.php#L47)

## How to switch between different url modes
### Mode 1
Example: example.com/de/
- EN is default language and DE is alternative language for this steps
- Got to `locale` in [`config/additional-settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php#L52)
- Set `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_DISABLED,`
- Set up english routes with or without `/en` prefix in [`config/routes/en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/en-US.php)
- Set up german routes with `/de` prefix in [`config/routes/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/de-DE.php)
- [`config/routes/xx-XX.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/xx-XX.php) can be leave untouched

### Mode 2
Example: de.example.com or example.de
- EN is default language and DE is alternative language for this steps
- Got to `locale` in [`config/additional-settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php#L52)
- Set `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_ENABLED,`
- Enter your domains in `active`
- Go to [`config/routes/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/de-DE.php)
- Remove `/de` prefix from every `route`
- Go to [`config/routes/xx-XX.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/xx-XX.php)
- Insert all routes where the config is equal between [`config/routes/en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/en-US.php) and [`config/routes/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/de-DE.php)
- Remove these equal routes in [`config/routes/en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/en-US.php) and [`config/routes/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/de-DE.php)

### Mode 3 (default)
Example: example.com
- EN is default language and DE is alternative language for this steps
- Got to `locale` in [`config/additional-settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/additional-settings.dist.php#L52)
- Set `'process' => \App\Utility\LanguageUtility::LOCALE_SESSION | \App\Utility\LanguageUtility::DOMAIN_DISABLED,`
- Set up all routes in [`config/routes/xx-XX.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/xx-XX.php)
- [`config/routes/en-US.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/en-US.php) can be leave untouched
- [`config/routes/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/de-DE.php) can be leave untouched

## ACL settings
With [Geggleto ACL](https://github.com/geggleto/geggleto-acl), routes are protected by role the current user has. By default every new route is not accessable until you give the route roles.
Routes are defined in the route files (e.g. [`config/routes/de-DE.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/routes/de-DE.php)).
Any other resource is defined in [`config/settings.php`](https://github.com/CodelineRed/file-sharing/blob/main/config/settings.php#L90).
Inside the Twig templates you can use ACL functions [`has_role`](https://github.com/CodelineRed/file-sharing/blob/main/templates/partials/navigation.html.twig#L23) and is_allowed.
Inside controllers you can also use this ACL functions and [many more](https://github.com/geggleto/geggleto-acl/blob/main/src/AclRepository.php) (e.g. [`isAllowed()`](https://github.com/CodelineRed/file-sharing/blob/main/src/Controller/UserController.php#L101)).

## Troubleshooting
In some cases you'll get the error message "Internal Server Error".

If this happened, go to [`public/.htaccess`](https://github.com/CodelineRed/file-sharing/blob/main/public/.htaccess) and enable `RewriteBase /`.

If project is in sub directory then `RewriteBase /project/public/`.

## Links
- [Slim Framework](https://www.slimframework.com/)
- [Twig](https://twig.symfony.com/)
- [Doctrine](https://www.doctrine-project.org/)
- [Slim 3 and Doctrine 2 Website](http://blog.sub85.com/slim-3-with-doctrine-2.html)
- [Slim 3 and Doctrine 2 Github](https://github.com/matthewfedak/slim-3-doctrine-2)
- [DataTables Translations](https://datatables.net/plug-ins/i18n/)
- [ESLint Rules](https://eslint.org/docs/rules/)
- [Sass Lint Rules](https://github.com/sasstools/sass-lint/tree/develop/docs/rules)