<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model;

interface Entity
{
    public function sameIdentityAs(Entity $other): bool;
}
