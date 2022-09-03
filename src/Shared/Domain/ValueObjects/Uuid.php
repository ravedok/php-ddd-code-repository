<?php

declare(strict_types=1);

namespace Ravedok\Shared\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

class Uuid implements Stringable
{
    protected string $value;

    final public function __construct(?string $value)
    {
        if (null === $value) {
            $value = $this->random()->value();
        }

        $this->ensureIsValidValue($value);

        $this->value = $value;
    }

    private function ensureIsValidValue(string $value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }

    public static function random(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
