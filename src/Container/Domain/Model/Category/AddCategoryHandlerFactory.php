<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Domain\Model\Category;

use Mostefa\TechnicalTest\Domain\Model\Category\CategoryRepository;
use Mostefa\TechnicalTest\Domain\Model\Category\Handler\AddCategoryHandler;
use Psr\Container\ContainerInterface;

class AddCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): AddCategoryHandler
    {
        return new AddCategoryHandler(
            $container->get(CategoryRepository::class)
        );
    }
}
