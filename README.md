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

    docker pull ondrazizka/texy-service:latest
    docker run --rm -it -p 8022:80 ondrazizka/texy-service:latest
    

Build
-----

    git clone <this repo>
    cd texy-docker/
    docker build --tag texy-service:1.0.0-php-apache --file src/dockerize-way2/Dockerfile .
    docker run --rm -it -p 8022:80 texy-service:1.0.0-php-apache

There are a few ways to Dockerize this, as I was experimenting which way to take.
The way used corresponds to the tag part after version.

Sources
-------

See https://github.com/OndraZizka/texy-docker


<script type='text/javascript' src='https://www.openhub.net/p/jtexy/widgets/project_factoids_stats?format=js'></script>
