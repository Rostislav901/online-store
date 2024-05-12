<?php

namespace App\Basket\Infrastructure\Redis;

use App\Basket\Domain\Redis\RedisKeyInterface;
use Symfony\Component\Cache\CacheItem;

class Key implements RedisKeyInterface
{
    public function __construct(private readonly string $key, private readonly CacheItem $cacheItem)
    {
    }

    public function setData(mixed $data): void
    {
        $this->cacheItem->set($data);
        $this->cacheItem->expiresAfter(3600);
    }

    public function keyToString(): string
    {
        return $this->key;
    }

    public function getCacheItem(): CacheItem
    {
        return $this->cacheItem;
    }
}
