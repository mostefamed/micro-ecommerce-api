<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Exception;

final class InvalidMoney extends \InvalidArgumentException
{
    public static function reason(string $msg): InvalidMoney
    {
        return new self('Invalid money because '.$msg);
    }
}
