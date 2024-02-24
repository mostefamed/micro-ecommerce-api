<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            Application\Handler\PingHandler::class => Application\Handler\PingHandler::class,
            \Mezzio\Helper\ServerUrlHelper::class => \Mezzio\Helper\ServerUrlHelper::class,
            \Mezzio\Router\RouterInterface::class => \Mezzio\Router\AuraRouter::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application\Handler\HomePageHandler::class => Container\Application\Handler\HomePageHandlerFactory::class,

            // Action
            Application\Action\Category\Categories::class => Container\Application\Action\CategoriesFactory::class,
            Application\Action\Product\ProductsByCategoryId::class => Container\Application\Action\ProductsByCategoryIdFactory::class,

            // Model
            Domain\Model\Category\Handler\AddCategoryHandler::class => Container\Domain\Model\Category\AddCategoryHandlerFactory::class,
            Domain\Model\Product\Handler\AddProductHandler::class => Container\Domain\Model\Product\AddProductHandlerFactory::class,

            // Query
            Domain\Model\Category\Handler\GetAllCategoriesHandler::class => Container\Domain\Model\Category\GetAllCategoriesHandlerFactory::class,
            Domain\Model\Product\Handler\GetProductsByCategoryIdHandler::class => Container\Domain\Model\Product\GetProductsByCategoryIdHandlerFactory::class,

            // Repository
            Domain\Model\Category\CategoryRepository::class => Container\Infrastructure\Repository\CategoryRepositoryFactory::class,
            Domain\Model\Product\ProductRepository::class => Container\Infrastructure\Repository\ProductRepositoryFactory::class,

            // Service
            Domain\Model\Category\Service\Categories::class => Container\Domain\Model\Category\CategoriesFactory::class,
            Domain\Model\Product\Service\ProductsByCategoryIdPayLoad::class => Container\Domain\Model\Product\ProductsByCategoryIdPayLoadFactory::class,
        ],
    ],

    'templates' => [
        'paths' => [
                'application' => [__DIR__.'/../../templates/application'],
                'error' => [__DIR__.'/../../templates/error'],
                'layout' => [__DIR__.'/../../templates/layout'],
            ],
    ],
];
