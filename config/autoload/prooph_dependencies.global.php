<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce;

use Laminas\ServiceManager\Factory\InvokableFactory;

/*
 * The services configuration is used to set up a Laminas\ServiceManager
 * which is used as Inversion of Controller container in our application
 * Please refer to the official documentation:
 * http://framework.zend.com/manual/current/en/modules/zend.service-manager.html
 */
return [
    'dependencies' => [
        'invokables' => [
            \Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy::class => \Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy::class,
        ],
        'factories' => [
            \Prooph\Common\Messaging\NoOpMessageConverter::class => InvokableFactory::class,
            \Prooph\Common\Messaging\FQCNMessageFactory::class => InvokableFactory::class,
            Response\JsonResponse::class => InvokableFactory::class,

            // prooph/psr7-middleware set up
            \Prooph\HttpMiddleware\CommandMiddleware::class => \Prooph\HttpMiddleware\Container\CommandMiddlewareFactory::class,

            \Prooph\HttpMiddleware\QueryMiddleware::class => \Prooph\HttpMiddleware\Container\QueryMiddlewareFactory::class,
            \Prooph\HttpMiddleware\MessageMiddleware::class => \Prooph\HttpMiddleware\Container\MessageMiddlewareFactory::class,

            // prooph/service-bus set up
            \Prooph\ServiceBus\CommandBus::class => \Prooph\ServiceBus\Container\CommandBusFactory::class,
            \Prooph\ServiceBus\QueryBus::class => \Prooph\ServiceBus\Container\QueryBusFactory::class,
        ],
    ],
];
