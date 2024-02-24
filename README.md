# REST API to handle a micro e-commerce website 

The goal of this project is to provide a REST API which would allow to an application mobile or a full frontend website to be able to display a mini e-commerce site. 

This API will permit also to carry out some backoffice type tasks in order to be able to be supplied with data.


**Stack**
The source code is based on Mezzio skeleton application (former zend-expressive).
The project is under Docker. Three containers will be created: web, php-fpm and database (see docker folder)

Mezzio provide a minimalist PSR-15 middleware framework for PHP with routing, DI
container, optional templating, and optional error handling capabilities.


## Getting Started

Start your application by installing dependencies:

```bash
$ make up
```

You can then browse to http://localhost:8080.


Stop your application:

```bash
$ make down
```

> ### Routes
> BasePath: /
>   * POST   /categories                      => Add a new category
>   * GET    /categories                      => Get all the categories
>   * POST   /products                        => Add a new product
>   * GET    /categories/:categoryId/products => Get the products that belong to the categoryId 


## Application Development Mode Tool

This skeleton comes with [laminas-development-mode](https://github.com/laminas/laminas-development-mode). 
It provides a composer script to allow you to enable and disable development mode.

### To enable development mode

**Note:** Do NOT run development mode on your production server!

```bash
$ composer development-enable
```

**Note:** Enabling development mode will also clear your configuration cache, to 
allow safely updating dependencies and ensuring any new configuration is picked 
up by your application.

### To disable development mode

```bash
$ composer development-disable
```

### Development mode status

```bash
$ composer development-status
```

## Configuration caching

By default, the skeleton will create a configuration cache in
`data/config-cache.php`. When in development mode, the configuration cache is
disabled, and switching in and out of development mode will remove the
configuration cache.

You may need to clear the configuration cache in production when deploying if
you deploy to the same directory. You may do so using the following:

```bash
$ composer clear-config-cache
```