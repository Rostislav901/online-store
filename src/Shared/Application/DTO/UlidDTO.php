<?php

namespace App\Shared\Application\DTO;

use Symfony\Component\Validator\Constraints\Ulid;

class UlidDTO
{
    #[Ulid]
    public string $ulid;
}
