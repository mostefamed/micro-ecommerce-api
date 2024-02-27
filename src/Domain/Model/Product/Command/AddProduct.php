<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Product\Command;

use Assert\Assertion;
use Mostefa\MicroEcommerce\Domain\Model\Money;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductId;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductName;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductPrice;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class AddProduct extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public function name(): ProductName
    {
        return ProductName::fromString($this->payload['name']);
    }

    public function id(): ProductId
    {
        return ProductId::fromString($this->payload['productId']);
    }

    public function price(): ProductPrice
    {
        $price = Money::fromFloat($this->payload['amount'], $this->payload['currency']);

        return ProductPrice::fromMoney($price);
    }

    public function quantity(): int
    {
        return $this->payload['quantity'];
    }

    public function categoriesMembership(): array
    {
        return $this->payload['categoriesMembership'];
    }

    protected function setPayload(array $payload): void
    {
        Assertion::keyExists($payload, 'name');
        Assertion::string($payload['name']);

        Assertion::keyExists($payload, 'productId');
        Assertion::string($payload['productId']);

        Assertion::keyExists($payload, 'quantity');
        Assertion::greaterOrEqualThan($payload['quantity'], 0);

        Assertion::keyExists($payload, 'amount');
        Assertion::numeric($payload['amount']);

        Assertion::keyExists($payload, 'currency');
        Assertion::string($payload['currency']);
        Assertion::length($payload['currency'], 3);

        Assertion::keyExists($payload, 'categoriesMembership');
        Assertion::isArray($payload['categoriesMembership']);
        Assertion::greaterThan(count($payload['categoriesMembership']), 0);

        $this->payload = $payload;
    }
}
