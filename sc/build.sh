#!/usr/bin/env bash

if [ ! -f sc/build.sh ] ; then
    echo "Call from the project root dir."; exit 1;
fi

if [ "$1" == "" ] ; then
    echo "The first parameter has to be the micro version to release."; exit 1;
fi

V=$1;
PUSH="$2";
VERSION_FULL="1.0.$V-php7.1.8-apache-texy2.9.2";
REMOTE_TAG_FULL="ondrazizka/texy-service:$VERSION_FULL";


## Check if exists
FOUND=`docker images "$REMOTE_TAG_FULL" | grep "$VERSION_FULL"  | wc -l`;
if [ 0 != "$FOUND" -a "$PUSH" != "force" ] ; then
    echo "Version already exists: $REMOTE_TAG_FULL";
    if [ "$PUSH" == "" ] ; then exit 2; fi
else
    ## Build
    echo "Will build: $REMOTE_TAG_FULL";
    docker build --tag texy-service:php-apache --file src/dockerize-way2/Dockerfile .

    ## Tag latest
    docker tag texy-service:php-apache texy-service:latest

    ## Tag for pushing to DockerHub - latest and the version
    docker tag texy-service:php-apache ondrazizka/texy-service:latest
    docker tag texy-service:php-apache "$REMOTE_TAG_FULL"
fi

## Run...
echo "==== Now run the tests manually. ===="
docker run --rm -p 8022:80 texy-service:latest


## ... and test.


## And push.
if [ "$PUSH" != "" ] ; then
    docker push ondrazizka/texy-service:latest
    docker push "$REMOTE_TAG_FULL"
fi
