<?php

namespace App\ProductCatalog\Application\DTO\Review;

use App\ProductCatalog\Domain\Aggregate\Review\Entity\Review;

class ReviewDTOTransformer
{
    /**
     * @param Review[] $entityList
     *
     * @return ReviewResponseDTO[]
     */
    public function fromEntityListToDTOList(array $entityList): array
    {
        $dtoList = [];

        if ([] !== $entityList) {
            foreach ($entityList as $item) {
                $dtoList[] = $this->fromEntityToDTO($item);
            }
        }

        return $dtoList;
    }

    public function fromEntityToDTO(Review $entity): ReviewResponseDTO
    {
        return new ReviewResponseDTO(
            text: $entity->getText(),
            rating: $entity->getRating(),
            author: $entity->getUserUlid()->getUlid(),
            dateCreated: $entity->getCreatedAt()->getTimestamp()
        );
    }
}
