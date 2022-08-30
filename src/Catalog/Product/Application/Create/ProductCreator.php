<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Product\Application\Create;

use Ravedok\Catalog\Product\Domain\Product;
use Ravedok\Catalog\Product\Domain\ProductId;
use Ravedok\Shared\Domain\Bus\Event\EventBus;
use Ravedok\Catalog\Product\Domain\ProductName;
use Ravedok\Catalog\Product\Domain\ProductRepository;

final class ProductCreator
{
    public function __construct(private readonly ProductRepository $repository, private readonly EventBus $bus)
    {
        
    }

    public function __invoke(ProductId $id, ProductName $name): void 
    {
        $product = new Product($id, $name);

        $this->repository->save($product);

        $this->bus->publish(...$product->pullDomainEvents());
    }
}
