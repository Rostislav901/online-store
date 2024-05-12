<?php

namespace App\User\Infrastructure\Service;

use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindAboutMeInfo\FindAboutMeInfoQuery;
use App\User\Application\UseCase\Query\User\FindAboutMeInfo\FindAboutMeInfoQueryResult;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQuery;
use App\User\Application\UseCase\Query\User\FindUserByName\FindUserByNameQueryResult;
use App\User\Infrastructure\Adapter\Product\ProductAdapter;
use App\User\Infrastructure\Recommendation\RecommendationService;

class UserQueryService
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly RecommendationService $recommendationService,
        private readonly UserFetcherInterface $userFetcher,
        private readonly ProductAdapter $productAdapter)
    {
    }

    public function getUserinfoByName(string $name): UserResponseDTO
    {
        $query = new FindUserByNameQuery($name);
        /**
         * @var FindUserByNameQueryResult $result
         */
        $result = $this->queryBus->execute($query);
        $dto = $result->DTO;

        if ('true' == $_ENV['MICRO']) {
            $count = $this->recommendationService->
            getRecommendationProductCountByUserUlid($result->getUserUld())->count;
        } else {
            $count = $this->productAdapter->getProductCountDataByUserUlid($result->getUserUld())->getCount();
        }

        $dto->setProductCount($count);

        return $dto;
    }

    public function getUserAboutMeData(): FindAboutMeInfoQueryResult
    {
        if ('true' == $_ENV['MICRO']) {
            $count = $this->recommendationService->
            getRecommendationProductCountByUserUlid($this->userFetcher->getUserAuth()->getUlid())->count;
        } else {
            $count = $this->productAdapter->getProductCountDataByUserUlid($this->userFetcher->getUserAuth()->getUlid())->getCount();
        }

        $query = new FindAboutMeInfoQuery();
        /**
         * @var FindAboutMeInfoQueryResult $result;
         */
        $result = $this->queryBus->execute($query);
        $result->setProductCount($count);

        return $result;
    }
}
