<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model;

interface ValueObject
{
    public function sameValueAs(ValueObject $object): bool;
}
