<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Infrastructure\Repository;

use Mostefa\TechnicalTest\Domain\Model\Category\CategoryCollection;
use Psr\Container\ContainerInterface;

class CategoryCollectionFactory
{
    public function __invoke(ContainerInterface $container): CategoryCollection
    {
        return new CategoryRepository(
            $container->get('doctrine.connection.default')
        );
    }
}
