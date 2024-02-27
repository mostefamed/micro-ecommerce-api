<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Infrastructure\Repository;

use Mostefa\MicroEcommerce\Infrastructure\Repository\ProductRepositoryMongoDb;
use Psr\Container\ContainerInterface;

class ProductRepositoryFactory
{
    public function __invoke(ContainerInterface $container): ProductRepositoryMongoDb
    {
        $config = $container->get('config');
        $mongoDbConfig = $config['em']['mongodb']['productMongoDb'];

        return new ProductRepositoryMongoDb($mongoDbConfig);
    }
}
