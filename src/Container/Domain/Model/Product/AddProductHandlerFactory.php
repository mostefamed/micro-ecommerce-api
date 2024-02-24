<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Domain\Model\Product;

use Mostefa\TechnicalTest\Domain\Model\Product\Handler\AddProductHandler;
use Mostefa\TechnicalTest\Domain\Model\Product\ProductRepository;
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
