#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

bin/console do:da:dr --force
bin/console do:da:cr
bin/console do:mi:mi -n
bin/console do:fi:lo --fixtures src/AppBundle/DataFixtures/ORM/dev/ -n