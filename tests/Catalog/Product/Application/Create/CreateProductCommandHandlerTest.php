<?php

declare(strict_types=1);

namespace Ravedok\Tests\Catalog\Product\Application\Create;

use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ravedok\Catalog\Product\Application\Create\CreateProductCommandHandler;
use Ravedok\Catalog\Product\Application\Create\ProductCreator;
use Ravedok\Catalog\Product\Domain\ProductRepository;
use Ravedok\Shared\Domain\Bus\Event\EventBus;

class CreateProductCommandHandlerTest extends TestCase
{
    public function test_should_create_a_valid_product(): void 
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

    private function productRepository(): ProductRepository | MockObject
    {
        $repository = $this->getMockBuilder(ProductRepository::class)            
            ->getMock();

        return $repository;
    }

    private function eventBus(): EventBus | MockObject
    {
        $eventBus = $this->getMockBuilder(EventBus::class)
            ->getMock();

        return $eventBus;
    }
}
