<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Application\Create;

use Ravedok\Shared\Domain\Bus\Command\Command;

final class CreateProductCommand implements Command
{
    public function __construct(private readonly ?string $id, private readonly string $name)
    {
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
