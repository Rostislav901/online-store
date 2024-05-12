<?php

namespace App\Order\Application\UseCase\Query\FindAllOrder;

use App\Order\Application\DTO\Order\OrderDTOTransformer;
use App\Order\Domain\Repository\OrderRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;

class FindAllOrderQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderDTOTransformer $transformer,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function __invoke(FindAllOrderQuery $query): FindAllOrderQueryResult
    {
        $allOrderEntity = $this->orderRepository->findAllOrder($this->userFetcher->getUserAuth()->getUlid());
        $orderDtoArray = $this->transformer->fromOrderListEntityToShortDTOList($allOrderEntity);

        return new FindAllOrderQueryResult($orderDtoArray);
    }
}
