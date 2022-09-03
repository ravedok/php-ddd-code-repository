<?php

declare(strict_types=1);

namespace Ravedok\Shared\Infrastructure\Symfony;

use Ravedok\Shared\Infrastructure\Symfony\DependencyInjection\SharedExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class SharedBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new SharedExtension();
    }
}
