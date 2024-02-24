<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Domain\Model\Product;

use Mostefa\TechnicalTest\Domain\Model\Product\Handler\GetProductsByCategoryIdHandler;
use Mostefa\TechnicalTest\Domain\Model\Product\ProductRepository;
use Psr\Container\ContainerInterface;

class GetProductsByCategoryIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetProductsByCategoryIdHandler
    {
        return new GetProductsByCategoryIdHandler($container->get(ProductRepository::class));
    }
}
