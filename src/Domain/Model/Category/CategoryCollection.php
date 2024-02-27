<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category;

use Laminas\Paginator\Adapter\AdapterInterface;

class CategoryCollection implements AdapterInterface
{
    public function __construct(protected array $categories)
    {
    }

    public function count(): int
    {
        return count($this->categories);
    }

    public function getItems($offset, $itemCountPerPage): array
    {
        return array_slice($this->categories, $offset, $itemCountPerPage);
    }
}
