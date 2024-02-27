<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category\Command;

use Assert\Assertion;
use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryId;
use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryName;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class AddCategory extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData(string $id, string $name): AddCategory
    {
        return new self([
            'name' => $name,
            'id' => $id,
        ]);
    }

    public function name(): CategoryName
    {
        return CategoryName::fromString($this->payload['name']);
    }

    public function id(): CategoryId
    {
        return CategoryId::fromString($this->payload['categoryId']);
    }

    protected function setPayload(array $payload): void
    {
        Assertion::keyExists($payload, 'name');
        Assertion::string($payload['name']);
        Assertion::keyExists($payload, 'categoryId');
        Assertion::string($payload['categoryId']);
        $this->payload = $payload;
    }
}
