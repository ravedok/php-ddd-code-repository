<?php

namespace Ravedok\Apps\Catalog\Controller\Products;

use Ramsey\Uuid\Uuid;
use Ravedok\Catalog\Products\Application\Create\CreateProductCommand;
use Ravedok\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsPostController extends AbstractController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    #[Route('/products', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $content = $request->toArray();

        $id = $content['id'] ?? Uuid::uuid4()->toString();
        $name = $content['name'];

        $command = new CreateProductCommand($id, $name);

        $this->commandBus->dispatch($command);

        return new Response(null, Response::HTTP_CREATED);
    }
}
