<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Domain;

use Ravedok\Shared\Domain\Bus\Event\DomainEvent;

final class ProductWasCreated extends DomainEvent
{
    public static function fromProduct(Product $product): self 
    {
        return new self($product->id()->value());
    }

    public function eventName(): string { 
        return 'product.created';
    }   
}
