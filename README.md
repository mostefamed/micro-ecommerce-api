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

## How to test ?

> BasePath: /
>   * POST   /categories                      => Add a new category
>  ```bash
>     {
>        "name": "furniture"
>     }
>   ```


>   * GET    /categories                      => Get all the categories (pagination available, limit and page query params)
>   * Example: GET /categories
>  ```bash
> {
>    "metadata": {
>        "pageCount": 1,
>        "itemCountPerPage": 2,
>        "first": 1,
>        "current": 1,
>        "last": 1,
>        "pagesInRange": {
>            "1": 1
>        },
>        "firstPageInRange": 1,
>        "lastPageInRange": 1,
>        "currentItemCount": 2,
>        "totalItemCount": 2,
>        "firstItemNumber": 1,
>        "lastItemNumber": 2
>    },
>    "data": [
>        {
>            "_id": {
>                "$oid": "65ddb87b03f4b5c8d209ffb2"
>            },
>            "categoryId": "ef80597c-afbc-4fc0-960b-500300a21cc1",
>            "categoryName": "canapés"
>        },
>        {
>            "_id": {
>                "$oid": "65de18fa03f4b5c8d209ffb3"
>            },
>            "categoryId": "fb37389c-61b0-49b9-aae4-ba6dcde0e090",
>            "categoryName": "furniture"
>        }
>    ]
> }

 

>   * POST   /products                        => Add a new product
>  ```bash
>
>  {
>     "name": "Sofa",
>     "quantity": 11,
>     "amount": 198.99,
>     "currency": "EUR",
>     "categoriesMembership": [
>        "fb37389c-61b0-49b9-aae4-ba6dcde0e090"
>     ]
> }
>   ```


>   * GET   /categories/:categoryId/products                       => Get the products that belong to the categoryId (pagination available, limit and page query params)
>   * Example: GET /categories/fb37389c-61b0-49b9-aae4-ba6dcde0e090/products
>
>  ```bash
> {
>    "metadata": {
>        "pageCount": 1,
>        "itemCountPerPage": 20,
>        "first": 1,
>        "current": 1,
>        "last": 1,
>        "pagesInRange": {
>            "1": 1
>        },
>        "firstPageInRange": 1,
>        "lastPageInRange": 1,
>        "currentItemCount": 1,
>        "totalItemCount": 1,
>        "firstItemNumber": 1,
>        "lastItemNumber": 1
>    },
>    "data": [
>        {
>            "_id": {
>                "$oid": "65de194403f4b5c8d209ffb4"
>            },
>            "productId": "6b07a2fe-6941-43e0-af28-1040c7a30128",
>            "productName": "Sofa",
>            "productPrice": {
>                "price": {
>                    "currency": "EUR",
>                    "amount": 198.99
>                }
>            },
>            "quantity": 11,
>            "categoriesMembership": [
>                "fb37389c-61b0-49b9-aae4-ba6dcde0e090"
>            ]
>        }
>    ]
> }