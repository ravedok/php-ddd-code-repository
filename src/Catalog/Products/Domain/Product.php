<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Domain;

use Ravedok\Shared\Domain\AggregateRoot;

final class Product extends AggregateRoot
{
    public function __construct(private readonly ProductId $id, private ProductName $name)
    {
        $this->record(ProductWasCreated::fromProduct($this));
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }
}
