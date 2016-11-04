#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

sed -e "s/\$DB_HOST/$DB_HOST/" \
    -e "s/\$DB_PORT/$DB_PORT/" \
    -e "s/\$DB_NAME/$DB_NAME/" \
    -e "s/\$DB_USER/$DB_USER/" \
    -e "s/\$DB_USER/$DB_USER/" \
    -e "s/\$MAIL_TRANS/$MAIL_TRANS/" \
    -e "s/\$MAIL_HOST/$MAIL_HOST/" \
    -e "s/\$MAIL_USER/$MAIL_USER/" \
    -e "s/\$MAIL_PASS/$MAIL_PASS/" \
    -e "s/\$LOCALE/$LOCALE/" \
    -e "s/\$SECRET/$SECRET/" \
    -e "s/\$SESSION/$SESSION/" \
    app/config/parameters.yml.dist > app/config/parameters.yml


php bin/console do:da:dr --force --if-exists
php bin/console do:da:cr
php bin/console do:mi:mi -n
php bin/console do:fi:lo --fixtures src/AppBundle/DataFixtures/ORM/dev/ -n
php bin/console ca:c --env=test
