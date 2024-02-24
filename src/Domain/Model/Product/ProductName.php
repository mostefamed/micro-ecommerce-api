<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product;

use Assert\Assertion;
use Mostefa\TechnicalTest\Domain\Model\ValueObject;

final class ProductName implements ValueObject
{
    private string $name;

    public static function fromString(string $name): self
    {
        return new self($name);
    }

    private function __construct(string $name)
    {
        try {
            Assertion::notEmpty($name);
        } catch (\Exception $e) {
            throw Exception\InvalidProductName::reason($e->getMessage());
        }

        $this->name = $name;
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function sameValueAs(ValueObject $object): bool
    {
        return get_class($this) === get_class($object) && $this->name === $object->name;
    }
}
