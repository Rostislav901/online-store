<?php

namespace App\User\Application\DTO;

use App\User\Domain\Aggregate\User\Entity\User;

class UserDTOTransformer
{
    public function fromEntityToDTO(User $entity): UserResponseDTO
    {
        return new UserResponseDTO(
            name: $entity->getName()->getName(),
            registrationDate: $entity->getCreatedAt()->getTimestamp(), );
    }
}
