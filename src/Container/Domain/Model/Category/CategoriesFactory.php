<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Domain\Model\Category;

use Mostefa\TechnicalTest\Infrastructure\Service\CategoriesFromQuery;
use Psr\Container\ContainerInterface;

class CategoriesFactory
{
    public function __invoke(ContainerInterface $container): CategoriesFromQuery
    {
        return new CategoriesFromQuery($container->get('config')['defaultParameters']['productsByCategoryId']['query']);
    }
}
