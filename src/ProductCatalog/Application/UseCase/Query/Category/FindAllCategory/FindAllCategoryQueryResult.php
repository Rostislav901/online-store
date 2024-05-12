<?php

namespace App\ProductCatalog\Application\UseCase\Query\Category\FindAllCategory;

use App\ProductCatalog\Application\DTO\Category\CategoryDTO;
use App\Shared\Application\Query\QueryInterface;

class FindAllCategoryQueryResult implements QueryInterface
{
    /**
     * @param CategoryDTO[] $categories
     */
    public function __construct(public array $categories)
    {
    }
}
