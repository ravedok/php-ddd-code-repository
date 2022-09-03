<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Domain;

use InvalidArgumentException;
use Ravedok\Shared\Domain\ValueObjects\StringValueObject;

final class ProductName extends StringValueObject
{
    public const MIN_LENGTH = 5;
    public const MAX_LENGTH = 30;

    protected function ensureIsValidValue(string $value): void
    {
        if (strlen($value) < self::MIN_LENGTH) {
            throw new InvalidArgumentException(sprintf('<%s> cannot be more less <%s> characters.', static::class, self::MIN_LENGTH));
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(sprintf('<%s> cannot be more than <%s> characters.', static::class, self::MAX_LENGTH));
        }
    }
}
