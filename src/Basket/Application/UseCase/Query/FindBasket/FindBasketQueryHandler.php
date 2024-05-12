<?php

namespace App\Basket\Application\UseCase\Query\FindBasket;

use App\Basket\Application\DTO\BasketProduct\BasketProductContainer;
use App\Basket\Application\Exception\BasketEmptyException;
use App\Basket\Domain\Redis\RedisServiceInterface;
use App\Shared\Application\Query\QueryHandlerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class FindBasketQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly RedisServiceInterface $redisService,
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function __invoke(FindBasketQuery $query): FindBasketQueryResult
    {
        $basketData = $this->redisService->getData();
        if (null === $basketData) {
            throw new BasketEmptyException();
        }
        $data = $this->serializer->deserialize($this->redisService->getData(),
            BasketProductContainer::class, JsonEncoder::FORMAT);

        return new FindBasketQueryResult($data->getProducts());
    }
}
