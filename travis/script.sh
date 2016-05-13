#!/bin/bash -e

php bin/console security:check

#if [ "${CODECOV}" = "true" ] ; then
#   bin/phpunit --coverage-clover=coverage.xml;
#else
#   bin/phpunit;
#fi