<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category\Exception;

final class InvalidCategoryName extends \InvalidArgumentException
{
    public static function reason(string $msg): InvalidCategoryName
    {
        return new self('Invalid category name because '.$msg);
    }
}
