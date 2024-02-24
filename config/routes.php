<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', Mostefa\TechnicalTest\Application\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', Mostefa\TechnicalTest\Application\Handler\PingHandler::class, 'api.ping');

    $app->post('/categories', [
        Mostefa\TechnicalTest\Middleware\HttpResponse::class,
        Mostefa\TechnicalTest\Middleware\JsonPayload::class,
        Mostefa\TechnicalTest\Middleware\JsonError::class,
        Prooph\HttpMiddleware\CommandMiddleware::class,
    ], 'add-category')
        ->setOptions([
            'values' => [
                'prooph_command_name' => Mostefa\TechnicalTest\Domain\Model\Category\Command\AddCategory::class,
                'route_purpose' => 'add-category',
            ],
        ]);

    $app->get('/categories', [
        Mostefa\TechnicalTest\Middleware\HttpResponse::class,
        Mostefa\TechnicalTest\Middleware\JsonError::class,
        Mostefa\TechnicalTest\Application\Action\Category\Categories::class,
    ], 'get-categories');

    $app->post('/products', [
        Mostefa\TechnicalTest\Middleware\HttpResponse::class,
        Mostefa\TechnicalTest\Middleware\JsonPayload::class,
        Mostefa\TechnicalTest\Middleware\JsonError::class,
        Prooph\HttpMiddleware\CommandMiddleware::class,
    ], 'add-product')
        ->setOptions([
            'values' => [
                'prooph_command_name' => Mostefa\TechnicalTest\Domain\Model\Product\Command\AddProduct::class,
                'route_purpose' => 'add-product',
            ],
        ]);

    $app->get('/categories/{categoryId}/products', [
        Mostefa\TechnicalTest\Middleware\HttpResponse::class,
        Mostefa\TechnicalTest\Middleware\JsonError::class,
        Mostefa\TechnicalTest\Application\Action\Product\ProductsByCategoryId::class,
        ], 'get-products-by-categoryId');
};
