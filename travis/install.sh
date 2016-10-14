#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

if [ "${CODEANALYSIS}" = "true" ] ; then
    pip install --user codecov;
    phpenv rehash
fi

composer install -n
