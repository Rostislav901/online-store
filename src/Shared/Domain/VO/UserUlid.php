<?php

namespace App\Shared\Domain\VO;

use JetBrains\PhpStorm\Immutable;

#[Immutable]
class UserUlid
{
    use UlidTrait;
}
