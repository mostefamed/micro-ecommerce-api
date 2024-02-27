<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category\Handler;

use Mostefa\MicroEcommerce\Domain\Model\Category\Category;
use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryRepository;
use Mostefa\MicroEcommerce\Domain\Model\Category\Command\AddCategory;
use Mostefa\MicroEcommerce\Domain\Model\Category\Exception\CategoryAlreadyExists;

class AddCategoryHandler
{
    public function __construct(private readonly CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(AddCategory $command): void
    {
        $categoryName = $command->name();
        $category = $this->categoryRepository->get($categoryName);

        if ($category) {
            throw CategoryAlreadyExists::withName($command->name());
        }

        $category = Category::fromData($command->id()->toString(), $command->name()->toString());
        $this->categoryRepository->save($category);
    }
}
