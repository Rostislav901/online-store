<?php

namespace App\Basket\Infrastructure\Redis;

use App\Basket\Domain\Redis\RedisBasketInterface;
use App\Basket\Domain\Redis\RedisServiceInterface;

class RedisService implements RedisServiceInterface
{
    public function __construct(private readonly RedisBasketInterface $redisAdapter)
    {
    }

    public function setData(mixed $data): void
    {
        $this->redisAdapter->setData($data);
        $this->redisAdapter->saveChanges();
    }

    public function getData(): ?string
    {
        return $this->redisAdapter->getData();
    }
}
