<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Infrastructure\Repository;

use Mostefa\MicroEcommerce\Domain\Model\Product\Product;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductName;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductRepository;

final class ProductRepositoryMongoDb implements ProductRepository
{
    private \MongoDB\Client $client;

    private \MongoDB\Collection $collection;

    public function __construct(private readonly array $config)
    {
        $this->client = new \MongoDB\Client($this->config['uri'], []);
        $this->collection = $this->client->selectCollection($this->config['database'], $config['collection'], [
            'typeMap' => [
                'root' => 'array',
                'document' => 'array',
                'array' => 'array',
            ],
        ]);
        $this->collection->createIndex(['productName' => 1], ['unique' => true]);
    }

    public function save(Product $product): ?string
    {
        $productAsArray = $product->toArray();
        $insertOneResult = $this->collection->insertOne(
            $productAsArray
        );

        return $insertOneResult->getInsertedId()->__toString() ?? null;
    }

    public function get(ProductName $productName): ?array
    {
        return $this->findOneByName($productName);
    }

    public function findOneByName(ProductName $productName): ?array
    {
        return $this->collection->findOne(['productName' => $productName->toString()]);
    }

    public function findAll(): ?array
    {
        return $this->collection->find()->toArray() ?? null;
    }

    public function findByCategoryId(string $categoryId): ?array
    {
        $products = $this->collection->find(
            [
                'categoriesMembership' => ['$in' => [$categoryId]],
            ]
        );

        return $products->toArray() ?? null;
    }
}
