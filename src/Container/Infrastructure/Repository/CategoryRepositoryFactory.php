<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Infrastructure\Repository;

use Mostefa\MicroEcommerce\Infrastructure\Repository\CategoryRepositoryMongoDb;
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
