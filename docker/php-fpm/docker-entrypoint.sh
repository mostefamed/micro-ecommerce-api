#!/bin/sh

echo "copy config/development.config.php.dist file:"
cp config/development.config.php.dist config/development.config.php

echo "copy config/autoload/development.local.php.dist file:"
cp config/autoload/development.local.php.dist config/autoload/development.local.php

echo "copy config/autoload/doctrine.local.php.dist file:"
cp config/autoload/doctrine.local.php.dist config/autoload/doctrine.local.php

echo "copy config/autoload/local.php.dist file:"
cp config/autoload/local.php.dist config/autoload/local.php

echo "Running install project dependencies:"
composer install --no-progress --prefer-dist --optimize-autoloader

echo "starting php-fpm:"
exec "$@"