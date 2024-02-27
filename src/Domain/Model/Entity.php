<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model;

interface Entity
{
    public function sameIdentityAs(Entity $other): bool;
}
