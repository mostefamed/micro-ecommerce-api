<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Container\Domain\Model\Category;

use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryRepository;
use Mostefa\MicroEcommerce\Domain\Model\Category\Handler\AddCategoryHandler;
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
