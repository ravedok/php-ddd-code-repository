<?php

declare(strict_types=1);

namespace Ravedok\Tests\Catalog\Product\Domain;

use Faker\Factory;
use Ravedok\Catalog\Product\Domain\ProductName;

final class ProductNameMother
{
    public static function create(?string $name = null): ProductName
    {        
        $name = $name ?: Factory::create()->realTextBetween(5, 30);
        
        return new ProductName($name);
    }
}
