<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Domain\Model\Category;

use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryRepository;
use Mostefa\MicroEcommerce\Domain\Model\Category\Handler\GetAllCategoriesHandler;
use Psr\Container\ContainerInterface;

class GetAllCategoriesHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllCategoriesHandler
    {
        return new GetAllCategoriesHandler(
            $container->get(CategoryRepository::class)
        );
    }
}
