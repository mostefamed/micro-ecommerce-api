<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', Mostefa\MicroEcommerce\Application\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', Mostefa\MicroEcommerce\Application\Handler\PingHandler::class, 'api.ping');

    $app->post('/categories', [
        Mostefa\MicroEcommerce\Middleware\HttpResponse::class,
        Mostefa\MicroEcommerce\Middleware\JsonPayload::class,
        Mostefa\MicroEcommerce\Middleware\JsonError::class,
        Prooph\HttpMiddleware\CommandMiddleware::class,
    ], 'add-category')
        ->setOptions([
            'values' => [
                'prooph_command_name' => Mostefa\MicroEcommerce\Domain\Model\Category\Command\AddCategory::class,
                'route_purpose' => 'add-category',
            ],
        ]);

    $app->get('/categories', [
        Mostefa\MicroEcommerce\Middleware\HttpResponse::class,
        Mostefa\MicroEcommerce\Middleware\JsonError::class,
        Mostefa\MicroEcommerce\Application\Action\Category\Categories::class,
    ], 'get-categories');

    $app->post('/products', [
        Mostefa\MicroEcommerce\Middleware\HttpResponse::class,
        Mostefa\MicroEcommerce\Middleware\JsonPayload::class,
        Mostefa\MicroEcommerce\Middleware\JsonError::class,
        Prooph\HttpMiddleware\CommandMiddleware::class,
    ], 'add-product')
        ->setOptions([
            'values' => [
                'prooph_command_name' => Mostefa\MicroEcommerce\Domain\Model\Product\Command\AddProduct::class,
                'route_purpose' => 'add-product',
            ],
        ]);

    $app->get('/categories/{categoryId}/products', [
        Mostefa\MicroEcommerce\Middleware\HttpResponse::class,
        Mostefa\MicroEcommerce\Middleware\JsonError::class,
        Mostefa\MicroEcommerce\Application\Action\Product\ProductsByCategoryId::class,
        ], 'get-products-by-categoryId');
};
