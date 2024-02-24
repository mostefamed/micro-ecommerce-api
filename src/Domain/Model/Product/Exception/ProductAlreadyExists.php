<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product\Exception;

use Mostefa\TechnicalTest\Domain\Model\Product\ProductName;

final class ProductAlreadyExists extends \InvalidArgumentException
{
    public static function withName(ProductName $productName): ProductAlreadyExists
    {
        return new self(sprintf('Product with name %s already exists.', $productName->toString()));
    }
}
