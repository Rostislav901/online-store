<?php

namespace App\User\Domain\Aggregate\User\VO;

use App\User\Domain\Aggregate\User\Specification\Interface\NameSpecificationInterface;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
class Name
{
    public readonly string $name;

    public function __construct(string $name, private readonly NameSpecificationInterface $nameSpecification)
    {
        $this->name = $this->validName($name);
    }

    public function validName(string $name): string
    {
        $this->nameSpecification->nameSatisfy($name);

        return $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
