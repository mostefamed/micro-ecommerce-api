<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Product\Exception;

use Fig\Http\Message\StatusCodeInterface;

final class ProductNotFound extends \InvalidArgumentException
{
    public static function withName(string $productName): ProductNotFound
    {
        return new self(sprintf('Product with name %s cannot be found.', $productName), StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
