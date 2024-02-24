<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product\Service;

interface ProductsByCategoryIdPayLoad
{
    public function __invoke(array $attributes): array;
}
