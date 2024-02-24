<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Infrastructure\Repository;

use Mostefa\TechnicalTest\Infrastructure\Repository\CategoryRepositoryMongoDb;
use Psr\Container\ContainerInterface;

class CategoryRepositoryFactory
{
    public function __invoke(ContainerInterface $container): CategoryRepositoryMongoDb
    {
        $config = $container->get('config');
        $mongoDbConfig = $config['em']['mongodb']['categoryMongoDb'];

        return new CategoryRepositoryMongoDb($mongoDbConfig);
    }
}
