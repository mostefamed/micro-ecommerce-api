<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Application\Action;

use Mostefa\MicroEcommerce\Application\Action\Product\ProductsByCategoryId;
use Mostefa\MicroEcommerce\Domain\Model\Product\Service\ProductsByCategoryIdPayLoad;
use Prooph\ServiceBus\QueryBus;
use Psr\Container\ContainerInterface;

class ProductsByCategoryIdFactory
{
    public function __invoke(ContainerInterface $container): ProductsByCategoryId
    {
        return new ProductsByCategoryId(
            $container->get(QueryBus::class),
            $container->get(ProductsByCategoryIdPayLoad::class)
        );
    }
}
