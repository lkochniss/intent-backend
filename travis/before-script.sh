#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

cp app/config/parameters.yml.dist app/config/parameters.yml
php bin/console ca:c --env=test
