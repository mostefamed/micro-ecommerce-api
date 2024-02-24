<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Application\Action;

use Mostefa\TechnicalTest\Application\Action\Category\Categories;
use Prooph\ServiceBus\QueryBus;
use Psr\Container\ContainerInterface;

class CategoriesFactory
{
    public function __invoke(ContainerInterface $container): Categories
    {
        return new Categories(
            $container->get(QueryBus::class),
            $container->get(\Mostefa\TechnicalTest\Domain\Model\Category\Service\Categories::class)
        );
    }
}
