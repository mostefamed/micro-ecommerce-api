<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model;

interface ValueObject
{
    public function sameValueAs(ValueObject $object): bool;
}
