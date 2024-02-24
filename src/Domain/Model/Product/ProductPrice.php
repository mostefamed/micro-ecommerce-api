<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product;

use Assert\Assertion;
use Mostefa\TechnicalTest\Domain\Model\Exception\InvalidMoney;
use Mostefa\TechnicalTest\Domain\Model\Money;
use Mostefa\TechnicalTest\Domain\Model\ValueObject;

final class ProductPrice implements ValueObject
{
    private string|Money $price;

    public static function fromMoney(Money $money): self
    {
        return new self($money);
    }

    private function __construct(Money $money)
    {
        try {
            Assertion::numeric($money->getAmount());
            Assertion::string($money->getCurrency());
        } catch (\Exception $e) {
            throw InvalidMoney::reason($e->getMessage());
        }

        $this->price = $money;
    }

    public function toString(): string
    {
        return $this->price->toString();
    }

    public function getCurrency()
    {
        return $this->price->getCurrency();
    }

    public function sameValueAs(ValueObject $object): bool
    {
        return get_class($this) === get_class($object) && $this->price->toString() === $object->price->toString();
    }
}
