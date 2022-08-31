<?php

namespace Ravedok\Shared\Infrastructure\Bus\Event;

use Ravedok\Shared\Domain\Bus\Event\EventBus;
use Ravedok\Shared\Domain\Bus\Event\DomainEvent;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyEventBus implements EventBus
{
    public function __construct(private MessageBusInterface $bus)
    {
       
    }

    public function publish(DomainEvent ...$events): void 
    { 
        foreach ($events as $event) {
            $this->bus->dispatch($event);
        }
    }
}
