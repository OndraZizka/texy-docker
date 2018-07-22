## Inspired by https://semaphoreci.com/community/tutorials/dockerizing-a-php-application

FROM nimmis/apache-php5
MAINTAINER Ondřej Žižka

COPY src/apache-conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY src/php /var/www/public

EXPOSE 80
EXPOSE 443

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

##  Usage:
##    docker build --tag texy-service:nimmis-apache --file src/dockerize-way1/Dockerfile .
##    docker run -it -p 8022:80 texy-service:apache
##    firefox http://localhost:8022/TexyService.rest.php
