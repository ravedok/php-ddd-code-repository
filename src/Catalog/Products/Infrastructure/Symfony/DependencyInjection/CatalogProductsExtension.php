<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Infrastructure\Symfony\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CatalogProductsExtension extends Extension
{
    public function load(mixed $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../config')
        );

        $loader->load('services.yaml');
    }
}
