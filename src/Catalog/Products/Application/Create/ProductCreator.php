<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Products\Application\Create;

use Ravedok\Catalog\Products\Domain\Product;
use Ravedok\Catalog\Products\Domain\ProductId;
use Ravedok\Catalog\Products\Domain\ProductName;
use Ravedok\Catalog\Products\Domain\ProductRepository;
use Ravedok\Shared\Domain\Bus\Event\EventBus;

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
