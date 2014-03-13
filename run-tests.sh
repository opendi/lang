#!/bin/sh

# export XDEBUG_CONFIG="remote_connect_back=0 idekey=XDEBUG_ECLIPSE remote_host=10.0.2.2"
# export PHP_IDE_CONFIG="serverName=localhost"

if [ -z "$1" ]
then
   vendor/bin/phpunit --bootstrap tests/bootstrap.php --stderr tests
else
   vendor/bin/phpunit --bootstrap tests/bootstrap.php --stderr --coverage-html target/reports tests
fi