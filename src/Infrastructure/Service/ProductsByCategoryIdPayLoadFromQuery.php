<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Infrastructure\Service;

use Assert\Assert;
use Mostefa\TechnicalTest\Domain\Model\Product\Service\ProductsByCategoryIdPayLoad;

final class ProductsByCategoryIdPayLoadFromQuery implements ProductsByCategoryIdPayLoad
{
    private array $queryParametersDefaultConfig;

    public function __construct(array $queryParametersDefaultConfig)
    {
        $this->queryParametersDefaultConfig = $queryParametersDefaultConfig;
    }

    public function __invoke(array $attributes): array
    {
        $lazyAssertion = Assert::lazy();
        $lazyAssertion
            ->that($attributes, 'categoryId')->keyExists('categoryId')
            ->that($attributes['categoryId'], 'categoryId')->notEmpty()
            ->that($attributes['categoryId'], 'categoryId')->string();

        $lazyAssertion->verifyNow();

        // Pagination
        $page = (isset($attributes['page']) && intval($attributes['page']) > 0)
            ? intval($attributes['page'])
            : $this->queryParametersDefaultConfig['page'];

        $limit = (isset($attributes['limit']) && intval($attributes['limit']) > 0)
            ? intval($attributes['limit'])
            : $this->queryParametersDefaultConfig['limit'];

        return [
                'categoryId' => $attributes['categoryId'],
                'page' => $page,
                'limit' => $limit,
        ];
    }
}
