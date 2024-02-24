<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product;

interface ProductRepository
{
    public function save(Product $product): ?string;

    public function get(ProductName $productName);

    public function findOneByName(ProductName $productName): ?array;

    public function findByCategoryId(string $categoryId): ?array;

    public function findAll(): ?array;
}
