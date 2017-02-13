#!/bin/bash -e

pushd "$(dirname $0)" > /dev/null

cd ..

echo $DB_NAME

sed -e "s/\$DB_HOST/$DB_HOST/" \
    -e "s/\$DB_PORT/$DB_PORT/" \
    -e "s/\$DB_NAME/$DB_NAME/" \
    -e "s/\$BRANCH_NAME/$BRANCH_NAME/" \
    -e "s/\$DB_USER/$DB_USER/" \
    -e "s/\$DB_PASS/$DB_PASS/" \
    -e "s/\$LOCALE/$LOCALE/" \
    -e "s/\$SECRET/$SECRET/" \
    -e "s/\$SESSION/$SESSION/" \
    app/config/parameters.yml.dist > app/config/parameters.yml
