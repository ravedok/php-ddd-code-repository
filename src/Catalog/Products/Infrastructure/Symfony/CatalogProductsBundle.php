<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Infrastructure\Symfony;

use Ravedok\Catalog\Products\Infrastructure\Symfony\DependencyInjection\CatalogProductsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class CatalogProductsBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new CatalogProductsExtension();
    }
}
