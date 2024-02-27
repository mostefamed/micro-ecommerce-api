<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Application\Action;

use Mostefa\MicroEcommerce\Application\Action\Category\Categories;
use Prooph\ServiceBus\QueryBus;
use Psr\Container\ContainerInterface;

class CategoriesFactory
{
    public function __invoke(ContainerInterface $container): Categories
    {
        return new Categories(
            $container->get(QueryBus::class),
            $container->get(\Mostefa\MicroEcommerce\Domain\Model\Category\Service\Categories::class)
        );
    }
}
