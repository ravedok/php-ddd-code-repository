<?php

declare(strict_types=1);

namespace Ravedok\Tests\Catalog\Product\Application\Create;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ravedok\Catalog\Products\Application\Create\CreateProductCommandHandler;
use Ravedok\Catalog\Products\Application\Create\ProductCreator;
use Ravedok\Catalog\Products\Domain\ProductRepository;
use Ravedok\Shared\Domain\Bus\Event\EventBus;

class CreateProductCommandHandlerTest extends TestCase
{
    public function testShouldCreateAValidProduct(): void
    {
        $command = CreateProductCommandMother::create();

        $productRepository = $this->productRepository();
        $productRepository->expects($this->once())->method('save');

        $eventBus = $this->eventBus();
        $eventBus->expects($this->once())->method('publish');

        $productCreator = new ProductCreator($productRepository, $eventBus);

        $handler = new CreateProductCommandHandler($productCreator);

        ($handler)($command);
    }

    /** @return ProductRepository&MockObject */
    private function productRepository(): ProductRepository|MockObject
    {
        $repository = $this->getMockBuilder(ProductRepository::class)
            ->getMock();

        return $repository;
    }

    /** @return EventBus&MockObject */
    private function eventBus(): EventBus|MockObject
    {
        $eventBus = $this->getMockBuilder(EventBus::class)
            ->getMock();

        return $eventBus;
    }
}
