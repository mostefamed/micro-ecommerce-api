<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category\Service;

interface Categories
{
    public function __invoke(array $attributes): array;
}
