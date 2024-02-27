<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category\Handler;

use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryRepository;
use Mostefa\MicroEcommerce\Domain\Model\Category\Query\GetAllCategories;
use React\Promise\Deferred;

class GetAllCategoriesHandler
{
    public function __construct(private readonly CategoryRepository $categoryRepository
    ) {
    }

    public function __invoke(GetAllCategories $query, ?Deferred $deferred = null)
    {
        $categories = $this->categoryRepository->findAll();
        if (null === $deferred) {
            return $categories;
        }
        $deferred->resolve($categories);
    }
}
