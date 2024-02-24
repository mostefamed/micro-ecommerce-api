<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use Laminas\ZendFrameworkBridge\ConfigPostProcessor;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    Mezzio\Plates\ConfigProvider::class,
    Laminas\InputFilter\ConfigProvider::class,
    Laminas\Filter\ConfigProvider::class,
    Laminas\Paginator\ConfigProvider::class,
    Mezzio\Tooling\ConfigProvider::class,
    Laminas\Diactoros\ConfigProvider::class,
    Mezzio\Router\AuraRouter\ConfigProvider::class,
    Mezzio\Twig\ConfigProvider::class,
    Laminas\HttpHandlerRunner\ConfigProvider::class,
    Mezzio\Router\LaminasRouter\ConfigProvider::class,
    Laminas\Router\ConfigProvider::class,
    Laminas\Validator\ConfigProvider::class,
    // Include cache configuration
    new ArrayProvider($cacheConfig),

    Mezzio\Helper\ConfigProvider::class,
    Mezzio\ConfigProvider::class,
    Mezzio\Router\ConfigProvider::class,

    // Swoole config to overwrite some services (if installed)
    class_exists(Mezzio\Swoole\ConfigProvider::class)
        ? Mezzio\Swoole\ConfigProvider::class
        : function () { return []; },

    // Default App module config
   // App\ConfigProvider::class,

    // Load application config in a pre-defined order in such a way that local settings
    // overwrite global settings. (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new PhpFileProvider(realpath(__DIR__).'/autoload/{{,*.}global,{,*.}local}.php'),

    // Load development config if it exists
    new PhpFileProvider(realpath(__DIR__).'/development.config.php'),
], $cacheConfig['config_cache_path'], [ConfigPostProcessor::class]);

// echo '<pre>';print_r($aggregator->getMergedConfig());die('TEST');
return $aggregator->getMergedConfig();
