<?php

declare(strict_types=1);

namespace Ravedok\Tests\Catalog\Product\Domain;

use Ravedok\Catalog\Products\Domain\ProductId;

final class ProductIdMother
{
    public static function create(?string $value = null): ProductId
    {
        return $value ? new ProductId($value) : ProductId::random();
    }
}
