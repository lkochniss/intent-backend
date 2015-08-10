#!/bin/bash

docker stop symfony-worker

docker rm -f symfony-worker 2> /dev/null
docker rm -f symfony-volume 2> /dev/null

docker run -v $PWD/project:/project --name=symfony-volume busybox /bin/true

docker run --volumes-from=symfony-volume --name=symfony-worker -w=/project -d -p 8080:80 symfony-worker

#docker run --name=symfony-worker -d -p 8080:80 symfony-worker
