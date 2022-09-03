<?php

declare(strict_types=1);

namespace Ravedok\Apps\Catalog\Controller\Products;

use Ravedok\Catalog\Products\Domain\ProductName;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateProductDto
{
    public function __construct(
        #[Assert\Uuid]
        private mixed $id = null,
        #[Assert\Type('string')]
        #[Assert\NotBlank]
        #[Assert\Length(min: ProductName::MIN_LENGTH, max: ProductName::MAX_LENGTH)]
        private mixed $name
    ) {
    }

    public function id(): ?string
    {
        if (null === $this->id) {
            return null;
        }

        return strval($this->id);
    }

    public function name(): string
    {
        return strval($this->name);
    }
}
