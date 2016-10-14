#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

php bin/console security:check

if [ "${CODEANALYSE}" = "true" ] ; then
   phpcs --standard=PSR1,PSR2 -s src;
   phpcs --standard=PSR1,PSR2 -s tests;
   vendor/bin/phpunit --coverage-clover=coverage.xml;
else
   vendor/bin/phpunit;
fi