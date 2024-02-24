<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product\Query;

final class GetProductsByCategoryId
{
    public function __construct(private readonly string $categoryId, private readonly int $page, private readonly int $limit)
    {
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}
