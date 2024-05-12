<?php

namespace App\Basket\Infrastructure\Redis;

use App\Basket\Domain\Redis\RedisBasketInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use Predis\ClientInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter as MainAdapter;

class RedisBasket implements RedisBasketInterface
{
    private readonly Key $item;

    private readonly MainAdapter $adapter;
    private readonly ClientInterface $redis;

    public function __construct(private readonly UserFetcherInterface $fetcher)
    {
        $this->redis = MainAdapter::createConnection($_ENV['REDIS_URL']);

        $this->adapter = new MainAdapter($this->redis);

        $ulid = $this->fetcher->getUserAuth()->getUlid();

        $this->item = new Key($ulid, $this->adapter->getItem($ulid));
    }

    public function item(): Key
    {
        return $this->item;
    }

    public function setData(mixed $data): void
    {
        $this->item->setData($data);
    }

    public function getData(): ?string
    {
        return $this->adapter->get($this->item->keyToString(), fn () => null);
    }

    public function saveChanges(): bool
    {
        return $this->adapter->save($this->item->getCacheItem());
    }
}
