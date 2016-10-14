#!/bin/bash -e

if [ "${CODEANALYSE}" = "true" ] ; then
    pip install --user codecov;
    pyrus install pear/PHP_CodeSniffer
    phpenv rehash
fi

composer install -n
