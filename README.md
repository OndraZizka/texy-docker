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
    docker run --rm -t -p 8022:80 ondrazizka/texy-service:latest
    
Don't run with `-it` or Apache will stop now and then with:
> [mpm_prefork:notice] [pid 1] AH00170: caught SIGWINCH, shutting down gracefully
    

Build
-----

    git clone <this repo>
    cd texy-docker/
    docker build --tag texy-service:1.0.0-php-apache --file src/dockerize-way2/Dockerfile .
    docker run --rm -t -p 8022:80 texy-service:1.0.0-php-apache

There are a few ways to Dockerize this, as I was experimenting which way to take.
The way used corresponds to the tag part after version.

Sources
-------

See https://github.com/OndraZizka/texy-docker

<!--
[![Project Stats](https://www.openhub.net/p/texy-docker/widgets/project_thin_badge.gif)](https://www.openhub.net/p/texy-docker)
-->
