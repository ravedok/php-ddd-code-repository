<?php

declare(strict_types=1);

namespace Ravedok\Shared\Domain\ValueObjects;

use Stringable;

abstract class StringValueObject implements Stringable
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValidValue($value);
    }

    public function equals(StringValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    protected function ensureIsValidValue(string $value): void
    {
    }
}
