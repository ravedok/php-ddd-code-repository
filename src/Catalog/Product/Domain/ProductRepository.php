<?php

declare(strict_types=1);

namespace Ravedok\Catalog\Product\Domain;

interface ProductRepository
{
    public function save(): void;
}
