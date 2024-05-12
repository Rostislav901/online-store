<?php

namespace App\Basket\Domain\Redis;

interface RedisServiceInterface
{
    public function setData(mixed $data): void;

    public function getData(): ?string;
}
