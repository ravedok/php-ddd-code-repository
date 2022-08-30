<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Application\Create;

final class CreateProductCommand
{
    public function __construct(private readonly string $id,  private readonly string $name)
    {        
    }

    public function id(): string 
    {
        return $this->id;
    }

    public function name(): string 
    {
        return $this->name;
    }
}
