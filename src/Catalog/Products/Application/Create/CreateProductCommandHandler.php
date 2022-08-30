<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Application\Create;

use Ravedok\Catalog\Products\Domain\ProductId;
use Ravedok\Catalog\Products\Domain\ProductName;

final class CreateProductCommandHandler
{
    public function __construct(private readonly ProductCreator $productCreator)
    {
        
    }

    public function __invoke(CreateProductCommand $command): void 
    {
        $id = new ProductId($command->id());
        $name = new ProductName($command->name());


        ($this->productCreator)($id, $name);
    }
}
