#!/bin/bash -e

php bin/console security:check

if [ "${CODESNIFF}" = "true" ] ; then
    phpcs --standard=PSR1,PSR2 src -s;
fi

#if [ "${CODECOV}" = "true" ] ; then
#    php ./vendor/bin/phpunit --coverage-clover=coverage.xml;
#else
#    php ./vendor/bin/phpunit;
#fi