#FROM nyanpass/php5.5:5.5.38-alpine
FROM php:8.0-alpine
RUN docker-php-ext-install pdo_mysql
