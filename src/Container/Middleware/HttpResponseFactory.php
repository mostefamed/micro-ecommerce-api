<?php
/**
 * Created by PhpStorm.
 * User: mmedjahed
 * Date: 2017-08-28
 * Time: 10:24.
 */

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Middleware;

use Mezzio\Helper\UrlHelper;
use Mostefa\TechnicalTest\Middleware\HttpResponse;
use Psr\Container\ContainerInterface;

final class HttpResponseFactory
{
    public function __invoke(ContainerInterface $container): HttpResponse
    {
        return new HttpResponse(
            $container->get(UrlHelper::class)
        );
    }
}
