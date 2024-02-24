<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Infrastructure\Repository;

use Mostefa\TechnicalTest\Infrastructure\Repository\ProductRepositoryMongoDb;
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
