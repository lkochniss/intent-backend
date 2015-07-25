#!/bin/bash

docker rm -f symfony-worker 2> /dev/null
docker rm -f symfony-volume 2> /dev/null

docker run -v $PWD:/intent-backend --name=symfony-volume busybox /bin/true

docker run --volumes-from=symfony-volume -d -p 8080:80 symfony-worker
