# File Sharing - InsanityMeetsHH

This git is for [fs.imhh.me](http://fs.insanitymeetshh.net). Take a look at [screenshots](https://github.com/InsanityMeetsHH/file-sharing/tree/master/screenshots).

This application based on [InsanityMeetsHH/Slim-Skeleton](https://github.com/InsanityMeetsHH/Slim-Skeleton) and [InsanityMeetsHH/gulp-skeleton](https://github.com/InsanityMeetsHH/gulp-Skeleton).

## Required
* [Node.js](http://nodejs.org/en/download/)
* [npm](http://www.npmjs.com/get-npm) `$ npm i npm@latest -g`
* [gulp-cli](https://www.npmjs.com/package/gulp-cli) `$ npm i gulp-cli@latest -g`
* PHP >= 5.5.9
* MySQL 5 (pdo_mysql)
* [Docker](https://www.docker.com/) ([for installation with Docker](https://github.com/InsanityMeetsHH/file-sharing#installation-with-docker))

## Installation with [Composer](https://getcomposer.org/download/1.10.1/composer.phar) (Recommended)

```bash
$ php composer.phar create-project insanitymeetshh/file-sharing [app-name]
$ cd [app-name]
$ npm i
$ gulp build
```

## Project Commands
|               | Description                                                                                                                |
|---------------|----------------------------------------------------------------------------------------------------------------------------|
| gulp          | watch files and start [BrowserSync](https://www.npmjs.com/package/browser-sync)                                            |
| gulp build    | executes following tasks: cleanUp, scss, scssLint, js, jsLint, json, img, font, svg                                        |
| gulp lintAll  | executes following tasks: scssLint, jsLint                                                                                 |
| gulp cleanUp  | clean up public folder                                                                                                     |
| gulp font     | copy font files                                                                                                            |
| gulp img      | copy and compress images                                                                                                   |
| gulp js       | uglify, minify and concat js files                                                                                         |
| gulp jsLint   | checks js follows [lint rules](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/app/js-lint.json)     |
| gulp json     | copy and minify json files                                                                                                 |
| gulp scss     | compile, minify and concat scss files                                                                                      |
| gulp scssLint | checks scss follows [lint rules](https://github.com/InsanityMeetsHH/file-sharing/blob/master/gulpfiles/app/scss-lint.json) |
| gulp svg      | copy and compress svg files                                                                                                |
| gulp watch    | watch scss, js, json, img, font and svg files                                                                              |

## Installation with [Docker](https://www.docker.com/)
This steps works with Windows, macOS and Linux. 
* Get project via `$ git clone https://github.com/InsanityMeetsHH/file-sharing.git` or [zip download](https://github.com/InsanityMeetsHH/file-sharing/archive/master.zip)
* Open a command prompt on your OS (if not already open) and navigate to the project folder
* `$ npm i`
* `$ gulp build`
* Add `"platform": {"php": "7.4.2"}` to `"config"` in [`composer.json`](https://github.com/InsanityMeetsHH/file-sharing/blob/master/composer.json#L46)
* `$ cp config\additional-settings.dist.php config\additional-settings.php`
* Download [`composer.phar`](https://getcomposer.org/download/1.10.1/composer.phar) if not already done
* `$ php composer.phar install`
* `$ docker-compose build`
* `$ docker-compose up -d`
* `$ docker inspect file-sharing-db` search for `IPAddress` from `DIRNAME_default` (at the bottom) and set IP (e.g. 172.20.0.2 often by me) as Doctrine `host` in `config\additional-settings.php`
* Open [localhost:3050](http://localhost:3050) for website or [localhost:9999](http://localhost:9999) for database gui
* Adminer login: user = root, pass = rootdockerpw, host = IP from `IPAddress`
* If you want to remove a container `$ docker rm [container-name] -f` e.g. `$ docker rm file-sharing-db -f`
* If you want to remove a volume `$ docker volume rm [volume-name]` e.g. `$ docker volume rm DIRNAME_db_data` (first remove matching container)
* If you want to remove all container `$ docker rm file-sharing-db file-sharing-webserver file-sharing-adminer -f`
* If you want to remove all volumes `$ docker volume prune` (first remove all container)

## Sources
* [DataTables Translations](https://datatables.net/plug-ins/i18n/)