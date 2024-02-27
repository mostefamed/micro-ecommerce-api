<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Product;

use Laminas\Paginator\Adapter\AdapterInterface;

class ProductsCollection implements AdapterInterface
{
    public function __construct(protected readonly array $products = [])
    {
    }

    public function count(): int
    {
        return count($this->products);
    }

    public function getItems($offset, $itemCountPerPage): array
    {
        return array_slice($this->products, $offset, $itemCountPerPage);
    }
}
