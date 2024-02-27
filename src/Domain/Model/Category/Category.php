<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Category;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Mostefa\MicroEcommerce\Domain\Model\Entity;

final class Category implements Entity
{
    /** @JMS\Type("string") */
    private string $categoryId;

    /** @JMS\Type("string") */
    private string $categoryName;

    public static function fromData(string $id, string $name): Category
    {
        return new self([
            'name' => $name,
            'id' => $id,
        ]);
    }

    private function __construct(array $data)
    {
        $this->categoryName = $data['name'];
        $this->categoryId = $data['id'];
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function name(): string
    {
        return $this->categoryName;
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
            && CategoryName::fromString($this->categoryName)->sameValueAs(CategoryName::fromString($other->categoryName));
    }
}
