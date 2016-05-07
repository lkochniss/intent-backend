#!/bin/bash

bin/console ca:c --env=test
bin/phpunit -c app