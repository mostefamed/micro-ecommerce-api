<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category;

use Mostefa\MicroEcommerce\Domain\Model\ValueObject;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class CategoryId implements ValueObject
{
    private $categoryId;

    public static function generate(): CategoryId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $cartId): CategoryId
    {
        return new self(Uuid::fromString($cartId));
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
        return get_class($this) === get_class($object) && $this->categoryId === $object->categoryId;
    }
}
