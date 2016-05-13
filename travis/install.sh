#!/bin/bash -e

if [ "${CODECOV}" = "true" ] ; then
    pip install --user codecov;
fi

if [ "${CODESNIFF}" = "true" ] ; then
    pyrus install pear/PHP_CodeSniffer
fi

composer install -n
