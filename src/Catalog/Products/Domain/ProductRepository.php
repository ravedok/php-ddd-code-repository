<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Domain;

interface ProductRepository
{
    public function save(Product $product): void;
}
