#!/bin/bash -e

php bin/console security:check

if [ "${CODEANALYSE=true}" = "true" ] ; then
    phpcs --standard=PSR1,PSR2 src -s;
   bin/phpunit --coverage-clover=coverage.xml;
else
   bin/phpunit;
fi