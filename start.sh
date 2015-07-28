#!/bin/bash

docker stop symfony-worker

docker rm -f symfony-worker 2> /dev/null
docker rm -f symfony-volume 2> /dev/null

docker run -v $PWD:/intent-backend --name=symfony-volume busybox /bin/true

docker run --volumes-from=symfony-volume --name=symfony-worker -w=/intent-backend -d -p 8080:80 symfony-worker

#docker run -d -p 8080:80 symfony-worker

#docker exec symfony-worker bash ./script.sh