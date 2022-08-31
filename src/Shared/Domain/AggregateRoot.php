<?php

declare(strict_types=1);

namespace Ravedok\Shared\Domain;

use Ravedok\Shared\Domain\Bus\Event\DomainEvent;

abstract class AggregateRoot
{
    /** @var DomainEvent[] */
    private array $domainEvents = [];

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

    /** @return DomainEvent[] */
    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;

        $this->domainEvents = [];

        return $domainEvents;
    }
}
