#!/bin/bash -e

php bin/console security:check

if [ "${CODESNIFF}" = "true" ] ; then
    php bin/phpcs --standard=PSR1,PSR2 src -s;
fi

#if [ "${CODECOV}" = "true" ] ; then
#    php bin/phpunit --coverage-clover=coverage.xml;
#else
#    php bin/phpunit;
#fi