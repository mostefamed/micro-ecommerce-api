<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Product\Exception;

final class InvalidProductName extends \InvalidArgumentException
{
    public static function reason(string $msg): InvalidProductName
    {
        return new self('Invalid product name because '.$msg);
    }
}
