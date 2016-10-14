#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

php bin/console security:check

if [ "${CODEANALYSE=true}" = "true" ] ; then
   phpcs --standard=PSR1,PSR2 -s src;
   phpcs --standard=PSR1,PSR2 -s tests;
   bin/phpunit --coverage-clover=coverage.xml;
else
   bin/phpunit;
fi