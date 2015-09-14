#!/bin/bash

app/console ca:c --env=test
bin/phpunit -c app