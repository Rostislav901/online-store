<?php

namespace App\ProductCatalog\Domain\Aggregate\Product\Enum;

enum Currency: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case CNY = 'CNY';
    case UAH = 'UAH';
}
