# texy-docker

Docker image for Texy! markup to XHTML converter service.

What is Texy
============

Texy is a human-friendly markup language.
This is a ready-to-run service converting Texy markup to XHTML.


Usage
=====

Run
---

    docker run --rm -it -p 8022:80 ondrazizka/texy-service:latest


Build
-----

    git clone <this repo>
    cd texy-docker/
    docker build --tag texy-service:php-apache --file src/dockerize-way2/Dockerfile .
    docker tag texy-service:php-apache texy-service:latest
    docker tag texy-service:php-apache ondrazizka/texy-service:latest
    docker tag texy-service:php-apache ondrazizka/texy-service:1.0.$V-php7.1.8-apache-texy2.9.2
    docker run --rm -p 8022:80 texy-service:latest

    ... test

    docker push ondrazizka/texy-service:latest
    docker push ondrazizka/texy-service:1.0.$V-php7.1.8-apache-texy2.9.2

There are a few ways to Dockerize this, as I was experimenting which way to take.
The way used corresponds to the tag part after version.

Sources
-------

See https://github.com/OndraZizka/texy-docker

<!--
[![Project Stats](https://www.openhub.net/p/texy-docker/widgets/project_thin_badge.gif)](https://www.openhub.net/p/texy-docker)
-->
