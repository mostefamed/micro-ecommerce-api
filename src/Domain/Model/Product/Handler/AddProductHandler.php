<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Domain\Model\Product\Handler;

use Mostefa\MicroEcommerce\Domain\Model\Product\Command\AddProduct;
use Mostefa\MicroEcommerce\Domain\Model\Product\Exception\ProductAlreadyExists;
use Mostefa\MicroEcommerce\Domain\Model\Product\Product;
use Mostefa\MicroEcommerce\Domain\Model\Product\ProductRepository;

class AddProductHandler
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function __invoke(AddProduct $command): void
    {
        $productName = $command->name();
        $product = $this->productRepository->get($productName);

        if ($product) {
            throw ProductAlreadyExists::withName($productName);
        }

        $id = $command->id()->toString();
        $name = $command->name()->toString();
        $price = $command->price();
        $quantity = $command->quantity();
        $categoriesMembership = $command->categoriesMembership();
        $product = Product::fromData($id, $name, $price, $quantity, $categoriesMembership);

        $this->productRepository->save($product);
    }
}
