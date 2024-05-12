<?php

namespace App\Basket\Application\UseCase\Command\CreateBasket;

use App\Basket\Domain\Redis\RedisServiceInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class CreateBasketCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly RedisServiceInterface $redisService,
        private readonly SerializerInterface $serializer)
    {
    }

    public function __invoke(CreateBasketCommand $command): CreateBasketCommandResult
    {
        $products = $command->container;
        $jsonProducts = $this->serializer->serialize($products, JsonEncoder::FORMAT);
        $this->redisService->setData($jsonProducts);

        return new CreateBasketCommandResult();
    }
}
