<?php
/**
 * Created by PhpStorm.
 * User: mmedjahed
 * Date: 2017-08-28
 * Time: 10:24.
 */

declare(strict_types=1);

namespace Mostefa\MicroEcommerce\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HttpResponse implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $routePurpose = $request->getAttribute('route_purpose', false);
        $contentType = trim($request->getHeaderLine('Content-Type'));

        try {
            $response = $handler->handle($request);

            switch ($routePurpose) {
                case 'add-category':
                    $categoryId = $response->getHeader('categoryId');
                    if (!empty($categoryId[0])) {
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

                            return new JsonResponse(null === $payload ? [] : $payload);
                        }
                    }
                    break;
            }

            return $response;
        } catch (\Throwable $e) {
            $trace = $e->getTraceAsString();

            do {
                $errorData = ['message' => $e->getMessage(), 'code' => $e->getCode()];

                if ($e instanceof \Assert\LazyAssertionException) {
                    $errorData['errors'] = [];
                    $assertionFailedExceptions = $e->getErrorExceptions();
                    foreach ($assertionFailedExceptions as $assertFailure) {
                        $errorData['errors'][] = ['message' => $assertFailure->getMessage(), 'propertyPath' => $assertFailure->getPropertyPath()];
                    }
                    $errorData['code'] = 400;
                } elseif ($e instanceof \Assert\InvalidArgumentException) {
                    $errorData['errors'] = [];
                    $errorData['errors'][] = ['message' => $e->getMessage(), 'propertyPath' => $e->getPropertyPath()];
                    $errorData['code'] = 400;
                } elseif ($e instanceof \InvalidArgumentException) {
                    $errorData['errors'] = [];
                    $errorData['errors'][] = ['message' => $e->getMessage()];
                    $errorData['code'] = 400;
                }
            } while ($e = $e->getPrevious());

            if ('dev' === getenv('TECH_TEST_ENV')) {
                $errorData['trace'] = $trace;
            }
            $errorData['code'] = ($errorData['code'] >= 100 && $errorData['code'] <= 599) ? $errorData['code'] : 500;

            return new JsonResponse($errorData, $errorData['code']);
        }
    }
}
