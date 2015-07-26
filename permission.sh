#!/bin/bash

rm -rf app/cache/*
rm -rf app/logs/*

#chmod -R 775 app/cache
#chmod -R 775 app/logs

#sudo chown -R www-data:www-data app/cache
#sudo chown -R www-data:www-data app/logs

#ls -al app/cache/
#ls -al app/logs/

HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs