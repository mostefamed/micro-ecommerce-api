<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Application\Action\Product;

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\ScrollingStyle\Sliding;
use Mostefa\TechnicalTest\Domain\Model\Product\ProductsCollection;
use Mostefa\TechnicalTest\Domain\Model\Product\Query\GetProductsByCategoryId;
use Mostefa\TechnicalTest\Domain\Model\Product\Service\ProductsByCategoryIdPayLoad;
use Prooph\ServiceBus\QueryBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProductsByCategoryId implements RequestHandlerInterface
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly ProductsByCategoryIdPayLoad $productsByCategoryIdPayLoad
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $productsToBeDisplayed = [];
        $attributes['categoryId'] = $request->getAttribute('categoryId', false);

        $attributes = array_merge($attributes, $request->getQueryParams());
        ['categoryId' => $categoryId,  'page' => $page, 'limit' => $limit] = ($this->productsByCategoryIdPayLoad)($attributes);

        $this->queryBus->dispatch(new GetProductsByCategoryId($categoryId, $page, $limit))
            ->then(
                function ($result) use (&$products) {
                    $products = $result;
                }
            );

        $productsCollection = new ProductsCollection($products);
        $paginator = new Paginator($productsCollection);
        Paginator::setDefaultScrollingStyle(new Sliding());
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($limit);

        foreach ($paginator as $product) {
            $productsToBeDisplayed[] = $product;
        }

        return new JsonResponse(['metadata' => $paginator->getPages(), 'data' => $productsToBeDisplayed]);
    }
}
