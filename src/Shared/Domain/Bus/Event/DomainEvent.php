<?php

declare(strict_types=1);

namespace Ravedok\Shared\Domain\Bus\Event;

use DateTimeImmutable;
use DateTimeInterface;
use Ravedok\Shared\Domain\ValueObjects\Uuid;

abstract class DomainEvent
{
    private readonly string $eventId;
    private readonly string $ocurredOn;

    public function __construct(private readonly string $aggregateId, string $eventId = null, string $ocurredOn = null)
    {
        $this->eventId = $eventId ?: Uuid::random()->value();
        $this->ocurredOn = $ocurredOn ?: (new DateTimeImmutable())->format(DateTimeInterface::ATOM);
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function ocurredOn(): string
    {
        return $this->ocurredOn;
    }

    abstract public function eventName(): string;
}
