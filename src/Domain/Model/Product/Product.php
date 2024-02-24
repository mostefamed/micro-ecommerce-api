<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Domain\Model\Product;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Mostefa\TechnicalTest\Domain\Model\Entity;

final class Product implements Entity
{
    /** @JMS\Type("string") */
    private string $productId;

    /** @JMS\Type("string") */
    private string $productName;

    /** @JMS\Type("Mostefa\TechnicalTest\Domain\Model\Category\ProductPrice") */
    /** @JMS\Exclude() */
    private ProductPrice $productPrice;

    /** @JMS\Type("string") */
    private int $quantity;

    /** @JMS\Type("array") */
    private array $categoriesMembership;

    public static function fromData(string $id, string $name, ProductPrice $price, int $quantity, array $categoriesMembership): Product
    {
        return new self($id, $name, $price, $quantity, $categoriesMembership);
    }

    private function __construct(string $id, string $name, ProductPrice $price, int $quantity, array $categoriesMembership)
    {
        $this->productName = $name;
        $this->productId = $id;
        $this->productPrice = $price;
        $this->quantity = $quantity;
        $this->categoriesMembership = $categoriesMembership;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function name(): string
    {
        return $this->productName;
    }

    /**
     * @JMS\VirtualProperty()
     */
    public function price(): string
    {
        return $this->productPrice->toString();
    }

    /**
     * @JMS\VirtualProperty()
     */
    public function currency(): string
    {
        return $this->productPrice->getCurrency();
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function categoriesMembership(): array
    {
        return $this->categoriesMembership;
    }

    public function toArray()
    {
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
        $context = new SerializationContext();
        $context->setSerializeNull(true);
        $objSerialized = $serializer->serialize($this, 'json', $context);

        return json_decode($objSerialized, true);
    }

    public function sameIdentityAs(Entity $other): bool
    {
        return get_class($this) === get_class($other)
            && ProductName::fromString($this->productName)->sameValueAs(ProductName::fromString($other->productName));
    }
}
