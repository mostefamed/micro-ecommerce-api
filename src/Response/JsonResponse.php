<?php

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Response;

use Laminas\Diactoros\Response\JsonResponse as LaminasJsonResponse;
use Prooph\HttpMiddleware\Response\ResponseStrategy;
use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;

final class JsonResponse implements ResponseStrategy
{
    public function fromPromise(PromiseInterface $promise): ResponseInterface
    {
        $json = null;
        $promise->then(function ($data) use (&$json) {
            $json = $data;
        });

        return new LaminasJsonResponse($json);
    }

    public function withStatus(int $statusCode): ResponseInterface
    {
        return new LaminasJsonResponse([], $statusCode);
    }
}
