<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Domain\Model\Product;

use Mostefa\MicroEcommerce\Domain\Model\Product\Handler\AddProductHandler;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductRepository;
use Psr\Container\ContainerInterface;

class AddProductHandlerFactory
{
    public function __invoke(ContainerInterface $container): AddProductHandler
    {
        return new AddProductHandler(
            $container->get(ProductRepository::class)
        );
    }
}
