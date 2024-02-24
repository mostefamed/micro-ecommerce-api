<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Application\Action\Category;

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\ScrollingStyle\Sliding;
use Mostefa\TechnicalTest\Domain\Model\Category\CategoryCollection;
use Mostefa\TechnicalTest\Domain\Model\Category\Query\GetAllCategories;
use Prooph\ServiceBus\QueryBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Categories implements RequestHandlerInterface
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly \Mostefa\TechnicalTest\Domain\Model\Category\Service\Categories $categories)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $categories = $categoriesToBeDisplayed = [];
        ['page' => $page, 'limit' => $limit] = ($this->categories)($request->getQueryParams());

        $this->queryBus->dispatch(new GetAllCategories($page, $limit))
            ->then(
                function ($result) use (&$categories) {
                    $categories = $result;
                }
            );
        $categoriesCollection = new CategoryCollection($categories);
        $paginator = new Paginator($categoriesCollection);
        Paginator::setDefaultScrollingStyle(new Sliding());
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($limit);

        foreach ($paginator as $product) {
            $categoriesToBeDisplayed[] = $product;
        }

        return new JsonResponse(['metadata' => $paginator->getPages(), 'data' => $categoriesToBeDisplayed]);
    }
}
