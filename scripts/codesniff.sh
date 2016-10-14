#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

echo "autoclean"

vendor/bin/phpcbf --standard=PSR1,PSR2 -s src;
vendor/bin/phpcbf --standard=PSR1,PSR2 -s tests;

echo "check src and tests directory"

vendor/bin/phpcs --standard=PSR1,PSR2 -s src;
vendor/bin/phpcs --standard=PSR1,PSR2 -s tests;