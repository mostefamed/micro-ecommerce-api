<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Domain\Model\Product;

use Mostefa\TechnicalTest\Infrastructure\Service\ProductsByCategoryIdPayLoadFromQuery;
use Psr\Container\ContainerInterface;

class ProductsByCategoryIdPayLoadFactory
{
    public function __invoke(ContainerInterface $container): ProductsByCategoryIdPayLoadFromQuery
    {
        return new ProductsByCategoryIdPayLoadFromQuery($container->get('config')['defaultParameters']['productsByCategoryId']['query']);
    }
}
