<?php

namespace Ravedok\Shared\Infrastructure\Bus\Command;

use Ravedok\Shared\Domain\Bus\Command\Command;
use Ravedok\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus implements CommandBus
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}
