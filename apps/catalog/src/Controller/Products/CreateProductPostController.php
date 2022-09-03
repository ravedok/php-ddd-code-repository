<?php

namespace Ravedok\Apps\Catalog\Controller\Products;

use Ravedok\Catalog\Products\Application\Create\CreateProductCommand;
use Ravedok\Shared\Domain\Bus\Command\CommandBus;
use Ravedok\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateProductPostController extends ApiController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    #[Route('/products', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        /** @var CreateProductDto */
        $dto = $this->getAndValidateDto($request, CreateProductDto::class);

        $command = new CreateProductCommand($dto->id(), $dto->name());

        $this->commandBus->dispatch($command);

        return new Response(null, Response::HTTP_CREATED);
    }
}
