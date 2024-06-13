<?php

namespace App\User\Application\DTO;
class UserResponseDTO
{
    public string $name;
    public int $registrationDate;
    public int $productCount;

    public function __construct(string $name, int $registrationDate, int $productCount = 0)
    {
        $this->name = $name;
        $this->registrationDate = $registrationDate;
        $this->productCount = $productCount;
    }

    public function setProductCount(int $productCount): self
    {
        $this->productCount = $productCount;

        return $this;
    }
}
