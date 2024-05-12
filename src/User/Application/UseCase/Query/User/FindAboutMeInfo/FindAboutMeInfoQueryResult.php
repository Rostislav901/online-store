<?php

namespace App\User\Application\UseCase\Query\User\FindAboutMeInfo;

class FindAboutMeInfoQueryResult
{
    public function __construct(
        public readonly string $name, public readonly string $email,
        public readonly string $phone, public readonly int $registrationDate,
        public int $productCount = 0)
    {
    }

    public function setProductCount(int $productCount): self
    {
        $this->productCount = $productCount;

        return $this;
    }
}
