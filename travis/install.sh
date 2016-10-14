#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

if [ "${CODEANALYSE}" = "true" ] ; then
    pip install --user codecov;
    pyrus install pear/PHP_CodeSniffer
    phpenv rehash
fi

composer install -n
