<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Domain\Model\Product;

use Mostefa\MicroEcommerce\Domain\Model\Product\Handler\GetProductsByCategoryIdHandler;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductRepository;
use Psr\Container\ContainerInterface;

class GetProductsByCategoryIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetProductsByCategoryIdHandler
    {
        return new GetProductsByCategoryIdHandler($container->get(ProductRepository::class));
    }
}
