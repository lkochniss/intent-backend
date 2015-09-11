#!/bin/bash

clear
app/console ca:c --env=test
bin/phpunit -c app