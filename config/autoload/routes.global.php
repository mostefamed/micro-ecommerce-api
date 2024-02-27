<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce;

use Mezzio\Router;

return [
    'dependencies' => [
        'invokables' => [
            Router\RouterInterface::class => Router\AuraRouter::class,
        ],
        'factories' => [
        ],
    ],
];
