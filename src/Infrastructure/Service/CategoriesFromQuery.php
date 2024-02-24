<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Infrastructure\Service;

use Mostefa\TechnicalTest\Domain\Model\Category\Service\Categories;

final class CategoriesFromQuery implements Categories
{
    private array $queryParametersDefaultConfig;

    public function __construct(array $queryParametersDefaultConfig)
    {
        $this->queryParametersDefaultConfig = $queryParametersDefaultConfig;
    }

    public function __invoke(array $attributes): array
    {
        // Pagination
        $page = (isset($attributes['page']) && intval($attributes['page']) > 0)
            ? intval($attributes['page'])
            : $this->queryParametersDefaultConfig['page'];

        $limit = (isset($attributes['limit']) && intval($attributes['limit']) > 0)
            ? intval($attributes['limit'])
            : $this->queryParametersDefaultConfig['limit'];

        return [
                'page' => $page,
                'limit' => $limit,
        ];
    }
}
