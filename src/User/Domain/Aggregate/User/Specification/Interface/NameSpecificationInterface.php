<?php

namespace App\User\Domain\Aggregate\User\Specification\Interface;

interface NameSpecificationInterface
{
    public function nameIsValidName(string $name): void;

    public function nameIsUnique(string $name): void;

    public function nameSatisfy(string $name): void;
}
