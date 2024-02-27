<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Infrastructure\Repository;

use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryCollection;
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
