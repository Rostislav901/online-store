<?php

namespace App\ProductCatalog\Infrastructure\Service;

use App\ProductCatalog\Application\DTO\Product\ProductDTO;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid\FindProductByUlidQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUlid\FindProductByUlidQueryResult;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlidAndProductName\FindProductByUserUlidAndProductNameQuery;
use App\ProductCatalog\Application\UseCase\Query\Product\FindProductByUserUlidAndProductName\FindProductByUserUlidAndProductNameQueryResult;
use App\ProductCatalog\Infrastructure\Adapter\User\UserAdapter;
use App\ProductCatalog\Infrastructure\Recommendation\RecommendationService;
use App\Shared\Application\Query\QueryBusInterface;

class ProductUseCaseService
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly UserAdapter $userAdapter,
        private readonly RecommendationService $recommendationService)
    {
    }

    public function productByUlid(string $ulid): ProductDTO
    {
        $query = new FindProductByUlidQuery($ulid);
        /**
         * @var FindProductByUlidQueryResult $res
         */
        $res = $this->queryBus->execute($query);
        if ('true' == $_ENV['MICRO']) {
            $userData = $this->recommendationService->getRecommendationUserDataByUserUlid($res->user_ulid);
        } else {
            $userData = $this->userAdapter->getUserDataByUlid($res->user_ulid);
        }

        $productDto = $res->productDTO;
        $productDto->salesperson = $userData->name;

        return $productDto;
    }

    public function productByUsernameAndProductName(string $username, string $productName): ProductDTO
    {
        if ('true' == $_ENV['MICRO']) {
            $user_ulid = $this->recommendationService->getRecommendationUserUlidByUsername($username);
        } else {
            $user_ulid = $this->userAdapter->getUserUlidByUsername($username);
        }

        $query = new FindProductByUserUlidAndProductNameQuery($user_ulid, $productName);
        /**
         * @var FindProductByUserUlidAndProductNameQueryResult $res
         */
        $res = $this->queryBus->execute($query);

        $dto = $res->productDTO;

        $dto->salesperson = $username;

        return $dto;
    }
}
