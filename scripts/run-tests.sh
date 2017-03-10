#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

./scripts/codesniff.sh
./scripts/db-rebuild.sh
./bin/console ca:c --env=test
./bin/phpunit