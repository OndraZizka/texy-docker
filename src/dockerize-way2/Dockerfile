## Inspired by https://bitpress.io/simple-approach-using-docker-with-php/

#FROM php:5.6
FROM php:7.1.8-apache
MAINTAINER Ondřej Žižka

COPY docker/src/php /srv/app/public
COPY docker/src/dockerize-way2/apache-vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app \
 && a2enmod rewrite


##  Usage:
##    docker build --tag texy-service:php-apache --file docker/src/dockerize-way2/Dockerfile .
##    docker run --rm -it -p 8022:80 texy-service:php-apache
##    firefox http://localhost:8022/TexyService.soap.php
