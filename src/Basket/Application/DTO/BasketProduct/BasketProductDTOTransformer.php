<?php

namespace App\Basket\Application\DTO\BasketProduct;

class BasketProductDTOTransformer
{
    /**
     * @param BasketProductDTO[] $userData
     */
    public function inItemDTO(array $userData): array
    {
        $DTOs = [];
        foreach ($userData as $data) {
            $DTOs[] = (new BasketProductDTO($data['ulid'], $data['count']));
        }

        return $DTOs;
    }
}
