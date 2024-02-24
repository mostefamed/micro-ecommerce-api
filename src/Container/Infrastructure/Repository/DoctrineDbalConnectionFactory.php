<?php

declare(strict_types=1);

namespace Mostefa\TechnicalTest\Container\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresConfigId;
use Interop\Config\RequiresMandatoryOptions;
use Psr\Container\ContainerInterface;

class DoctrineDbalConnectionFactory implements RequiresConfigId, RequiresMandatoryOptions
{
    use ConfigurationTrait;

    public function __invoke(ContainerInterface $container): Connection
    {
        $options = $this->options($container->get('config'), 'default');

        return DriverManager::getConnection($options);
    }

    public function dimensions(): iterable
    {
        return ['doctrine', 'connection'];
    }

    public function mandatoryOptions(): iterable
    {
        return ['driverClass'];
    }
}
