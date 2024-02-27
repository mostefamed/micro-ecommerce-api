<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category;

interface CategoryRepository
{
    public function save(Category $category): ?string;

    public function get(CategoryName $categoryName);

    public function findOneByName(CategoryName $categoryName): ?array;

    public function findAll(): ?array;
}
