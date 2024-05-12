<?php

namespace App\ProductCatalog\Domain\VO;

use App\Shared\Domain\VO\UlidTrait;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
class DiscountUlid
{
    use UlidTrait;
}
