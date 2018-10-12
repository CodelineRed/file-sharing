# File Sharing - InsanityMeetsHH

This git is for [fs.imhh.me](http://fs.insanitymeetshh.net).

This application based on [Slim Skeleton Fork 5](https://github.com/InsanityMeetsHH/Slim-Skeleton/tree/5.x) and [Gulp Templating 3](https://github.com/InsanityMeetsHH/gulp-templating/tree/3.x).

## Required
* [Node.js](http://nodejs.org/en/download/)
* [npm](http://www.npmjs.com/get-npm) `$ npm i npm@latest -g`
* [gulp-cli](https://www.npmjs.com/package/gulp-cli) `$ npm i gulp-cli@latest -g`
* PHP => 5.5
* Database like MySQL
* [Docker](https://www.docker.com/) ([for installation with Docker](https://github.com/InsanityMeetsHH/Slim-Skeleton#installation-with-docker))

## Installation with [Composer](https://getcomposer.org/) (Recommended)

```bash
$ composer create-project insanitymeetshh/file-sharing [my-app-name]
```

## Installation with [Docker](https://www.docker.com/)
* Get skeleton via `$ git clone` or zip download
* Open a command prompt on your OS (if not already open) and navigate to the project folder
* `$ npm i`
* `$ gulp prod`
* `$ docker pull composer`
* `$ docker run --rm --env docker=true --interactive --tty --volume $PWD:/app composer update`
* `$ docker-compose build`
* `$ docker-compose up -d`
* `$ cp config\additional-settings.dist.php config\additional-settings.php`
* `$ docker inspect file-sharing-db | grep IPAddress` set ip as Doctrine `host` in `config\additional-settings.php`
* Open [localhost:8080](http://localhost:8080) for website or [localhost:9999](http://localhost:9999) for database gui
* If you want to remove a container `$ docker rm [container-name] -f` e.g. `$ docker rm file-sharing-db -f`
* If you want to remove a volume `$ docker volume rm [volume-name]` e.g. `$ docker volume rm imhh-fs_db_data` (first remove matching container)
* If you want to remove all container `$ docker rm $(docker ps -a -q) -f`
* If you want to remove all volumes `$ docker volume prune` (first remove all container)