<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category\Exception;

use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryName;

final class CategoryAlreadyExists extends \InvalidArgumentException
{
    public static function withName(CategoryName $categoryName): CategoryAlreadyExists
    {
        return new self(sprintf('Category with name %s already exists.', $categoryName->toString()));
    }
}
