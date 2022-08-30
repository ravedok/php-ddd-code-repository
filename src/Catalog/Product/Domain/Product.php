<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Product\Domain;

use Ravedok\Catalog\Product\Domain\ProductId;

final class Product
{
    public function __construct(private ProductId $id, private ProductName $name)
    {
        
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
