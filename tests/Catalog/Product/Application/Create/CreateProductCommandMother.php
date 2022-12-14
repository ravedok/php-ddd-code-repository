<?php

declare(strict_types=1);

namespace Ravedok\Tests\Catalog\Product\Application\Create;

use Ravedok\Catalog\Products\Application\Create\CreateProductCommand;
use Ravedok\Catalog\Products\Domain\ProductId;
use Ravedok\Catalog\Products\Domain\ProductName;
use Ravedok\Tests\Catalog\Product\Domain\ProductIdMother;
use Ravedok\Tests\Catalog\Product\Domain\ProductNameMother;

final class CreateProductCommandMother
{
    public static function create(
        ?ProductId $id = null,
        ?ProductName $name = null
    ): CreateProductCommand {
        return new CreateProductCommand(
            $id?->value() ?? ProductIdMother::create()->value(),
            $name?->value() ?? ProductNameMother::create()->value()
        );
    }
}
