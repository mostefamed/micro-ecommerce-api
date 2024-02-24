<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Category\Query;

class GetAllCategories
{
    public function __construct(private readonly int $page, private readonly int $limit)
    {
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
