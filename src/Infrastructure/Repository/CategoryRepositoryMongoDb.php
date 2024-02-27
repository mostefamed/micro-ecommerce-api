<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Infrastructure\Repository;

use Mostefa\MicroEcommerce\Domain\Model\Category\Category;
use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryName;
use Mostefa\MicroEcommerce\Domain\Model\Category\CategoryRepository;

final class CategoryRepositoryMongoDb implements CategoryRepository
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
        $this->collection->createIndex(['categoryName' => 1], ['unique' => true]);
    }

    public function save(Category $category): ?string
    {
        return $this->collection->insertOne($category->toArray())->getInsertedId()->__toString() ?? null;
    }

    public function get(CategoryName $categoryName): ?array
    {
        return $this->findOneByName($categoryName);
    }

    public function findOneByName(CategoryName $categoryName): ?array
    {
        return $this->collection->findOne(['name' => $categoryName->toString()]);
    }

    public function findAll(): ?array
    {
        return $this->collection->find()->toArray() ?? null;
    }
}
