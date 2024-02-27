<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce;

return [
    'prooph' => [
        'middleware' => [
            'query' => [
                'response_strategy' => Response\JsonResponse::class,
                'message_factory' => \Prooph\Common\Messaging\FQCNMessageFactory::class,
            ],
            'command' => [
                'response_strategy' => Response\JsonResponse::class,
                'message_factory' => \Prooph\Common\Messaging\FQCNMessageFactory::class,
            ],
            'message' => [
                'response_strategy' => Response\JsonResponse::class,
                'message_factory' => \Prooph\Common\Messaging\FQCNMessageFactory::class,
            ],
        ],
        'service_bus' => [
            'command_bus' => [
                'router' => [
                    'routes' => [
                        Domain\Model\Category\Command\AddCategory::class => Domain\Model\Category\Handler\AddCategoryHandler::class,
                        Domain\Model\Product\Command\AddProduct::class => Domain\Model\Product\Handler\AddProductHandler::class,
                    ],
                ],
            ],
            'query_bus' => [
                'router' => [
                    'routes' => [
                        Domain\Model\Category\Query\GetAllCategories::class => Domain\Model\Category\Handler\GetAllCategoriesHandler::class,
                        Domain\Model\Product\Query\GetProductsByCategoryId::class => Domain\Model\Product\Handler\GetProductsByCategoryIdHandler::class,
                    ],
                ],
            ],
        ],
    ],
];
