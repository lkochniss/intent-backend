#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

php bin/console do:da:dr --force --if-exists
php bin/console do:da:cr
php bin/console do:mi:mi -n
php bin/console do:fi:lo --fixtures src/AppBundle/DataFixtures/ORM/dev/ -n
php bin/console ca:c --env=test
