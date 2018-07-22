# texy-docker

Docker image for Texy! markup to XHTML converter service.

Usage
=====

Run
---

    docker run --rm -it -p 8022:80 texy-service:1.0.0-php-apache

Build
-----

    docker build --tag texy-service::1.0.0-php-apache --file src/dockerize-way2/Dockerfile .

There are a few ways to Dockerize this, as I was experimenting which way to take.
The way used corresponds to the tag part after version.
