<?php

namespace App\Basket\Domain\Redis;

interface RedisBasketInterface
{
    public function item(): RedisKeyInterface;

    public function setData(mixed $data): void;

    public function getData(): ?string;

    public function saveChanges(): bool;
}
