#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

phpenv rehash
