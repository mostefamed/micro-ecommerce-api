<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Product;

use Mostefa\MicroEcommerce\Domain\Model\ValueObject;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ProductId implements ValueObject
{
    private UuidInterface $uuid;

    public static function generate(): ProductId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $categoryId): ProductId
    {
        return new self(Uuid::fromString($categoryId));
    }

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function sameValueAs(ValueObject $object): bool
    {
        return get_class($this) === get_class($object) && $this->uuid->equals($object->uuid);
    }
}
