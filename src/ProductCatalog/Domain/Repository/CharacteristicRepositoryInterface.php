<?php

namespace App\ProductCatalog\Domain\Repository;

use App\ProductCatalog\Domain\Aggregate\Product\Entity\Characteristic;

interface CharacteristicRepositoryInterface
{
    public function add(Characteristic $characteristic): void;
}
