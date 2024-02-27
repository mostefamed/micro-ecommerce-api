<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model;

use Assert\Assertion;

final class Money implements ValueObject
{
    private ?string $currency;
    private float $amount;

    private function __construct(float $amount, ?string $currency = null)
    {
        try {
            Assertion::float($amount);
            Assertion::length($currency, 3);
        } catch (\Exception $e) {
            throw Exception\InvalidMoney::reason($e->getMessage());
        }

        $this->currency = $currency;
        $this->amount = round($amount, 2);
    }

    public static function fromFloat(float $amount, ?string $currency = null): self
    {
        return new self($amount, $currency);
    }

    public function toString(): string
    {
        return (string) $this->amount;
    }

    public function sameValueAs(ValueObject $object): bool
    {
        return get_class($this) === get_class($object) && $this->amount === $object->amount && $this->currency === $object->currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
