<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Domain;

use Ravedok\Shared\Domain\Bus\Event\DomainEvent;

final class ProductWasCreated extends DomainEvent
{

    public function __construct(string $aggregateId, private string $productName)
    {
        parent::__construct($aggregateId);
    }

    public static function fromProduct(Product $product): self 
    {
        return new self(
            $product->id()->value(),
            $product->name()->value()
        );
    }

    public function eventName(): string { 
        return 'product.created';
    }   

    public function productName(): string 
    {
        return $this->productName;
    }
}
