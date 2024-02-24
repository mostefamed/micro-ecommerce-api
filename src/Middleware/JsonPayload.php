<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Middleware;

use Mostefa\TechnicalTest\Domain\Model\Category\CategoryId;
use Mostefa\TechnicalTest\Domain\Model\Product\ProductId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JsonPayload implements MiddlewareInterface
{
    public const CATEGORY_IDENTIFIER_NAME = 'categoryId';
    public const PRODUCT_IDENTIFIER_NAME = 'productId';

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $payload = [];
        $categoryId = $productId = null;

        $contentType = trim($request->getHeaderLine('Content-Type'));

        if (str_starts_with($contentType, 'application/json')) {
            $payload = json_decode((string) $request->getBody(), true);

            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    throw new \RuntimeException('Invalid JSON, maximum stack depth exceeded.', 400);
                case JSON_ERROR_UTF8:
                    throw new \RuntimeException('Malformed UTF-8 characters, possibly incorrectly encoded.', 400);
                case JSON_ERROR_SYNTAX:
                case JSON_ERROR_CTRL_CHAR:
                case JSON_ERROR_STATE_MISMATCH:
                    throw new \RuntimeException('Invalid JSON.', 400);
            }

            $payload = null === $payload ? [] : $payload;
        }

        if ('POST' == $request->getMethod()) {
            $routePurpose = $request->getAttribute('route_purpose', false);
            switch ($routePurpose) {
                case 'add-category':
                    $categoryIdObject = CategoryId::generate();
                    $categoryId = $categoryIdObject->toString();
                    $payload[self::CATEGORY_IDENTIFIER_NAME] = $categoryId;
                    break;

                case 'add-product':
                    $productIdObject = ProductId::generate();
                    $productId = $productIdObject->toString();
                    $payload[self::PRODUCT_IDENTIFIER_NAME] = $productId;
                    break;
            }
        }

        $request = $request->withParsedBody(null === $payload ? [] : $payload);
        $response = $handler->handle($request);
        if (null !== $categoryId) {
            $response = $response->withHeader(self::CATEGORY_IDENTIFIER_NAME, $categoryId);
        }

        if (null !== $productId) {
            $response = $response->withHeader(self::PRODUCT_IDENTIFIER_NAME, $productId);
        }

        return $response;
    }
}
