<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Category\Exception;

use Fig\Http\Message\StatusCodeInterface;

final class CategoryNotFound extends \InvalidArgumentException
{
    public static function withName(string $categoryName): CategoryNotFound
    {
        return new self(sprintf('Category with name %s cannot be found.', $categoryName), StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
