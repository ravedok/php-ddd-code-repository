<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Infrastructure;

use Ravedok\Catalog\Products\Domain\Product;
use Ravedok\Catalog\Products\Domain\ProductRepository;

final class DoctrineProductRepository implements ProductRepository
{

    public function save(Product $product): void { }
}
