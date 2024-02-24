<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product\Handler;

use Mostefa\TechnicalTest\Domain\Model\Product\ProductRepository;
use Mostefa\TechnicalTest\Domain\Model\Product\Query\GetProductsByCategoryId;
use React\Promise\Deferred;

class GetProductsByCategoryIdHandler
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function __invoke(GetProductsByCategoryId $query, ?Deferred $deferred = null)
    {
        $products = $this->productRepository->findByCategoryId($query->categoryId());
        if (null === $deferred) {
            return $products;
        }
        $deferred->resolve($products);
    }
}
