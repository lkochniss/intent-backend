#!/bin/bash

echo "close open symfony-worker"
docker stop symfony-worker

docker rm -f symfony-worker 2> /dev/null
docker rm -f symfony-volume 2> /dev/null

echo "init project volume"
docker run -v $PWD/project:/project --name=symfony-volume busybox /bin/true

echo "start container"
docker run \
    --volumes-from=symfony-volume \
    --name=symfony-worker \
    -w=/project \
    -d \
    -p 8080:80 symfony-worker

#docker run --volumes-from=symfony-volume -v ${HOME}:${HOME} -v /etc/passwd:/etc/passwd:ro -v /etc/group:/etc/group:ro -u $(id -u):$(id -g) --name=symfony-worker -w=/project -d -p 8080:80 symfony-worker

echo "check container status"
sleep 2
docker ps
