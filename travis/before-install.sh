#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

rm composer.lock
composer self-update -q

if [ -n "GITHUB" ] ; then
    composer config github-oauth.github.com ${GITHUB};
else
    exit 1;
fi
