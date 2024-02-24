#!/bin/sh

echo "Running install project dependencies:"
composer install --no-progress --prefer-dist --optimize-autoloader
echo "starting php-fpm:"
exec "$@"