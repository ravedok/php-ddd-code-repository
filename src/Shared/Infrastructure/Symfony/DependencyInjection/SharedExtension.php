<?php

declare(strict_types=1);

namespace Ravedok\Shared\Infrastructure\Symfony\DependencyInjection;

use Ravedok\Shared\Domain\Bus\Command\CommandHandler;
use Ravedok\Shared\Domain\Bus\Event\EventHandler;
use Ravedok\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SharedExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../config'));
        $loader->load('messenger.yaml');
    }

    public function load(mixed $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../config')
        );

        $loader->load('services.yaml');

        $container->registerForAutoconfiguration(ApiController::class)
            ->addTag('ravedok.api_controller')
            ->addTag('controller.service_arguments')
            ->addMethodCall('setValidator', [new Reference(ValidatorInterface::class)])
            ->addMethodCall('setSerializer', [new Reference(SerializerInterface::class)])
        ;

        $container->registerForAutoconfiguration(CommandHandler::class)
            ->addTag('messenger.message_handler', [
                'bus' => 'messenger.bus.commands',
            ])
        ;

        $container->registerForAutoconfiguration(EventHandler::class)
            ->addTag('messenger.message_handler', [
                'bus' => 'messenger.bus.events',
            ])
        ;
    }
}
