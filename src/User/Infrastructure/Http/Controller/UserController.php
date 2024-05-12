<?php

namespace App\User\Infrastructure\Http\Controller;

use App\Shared\Application\Attribute\RequestParams;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\DTO\UserNameDTO;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Application\UseCase\Query\User\FindAboutMeInfo\FindAboutMeInfoQueryResult;
use App\User\Infrastructure\Service\UserQueryService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserQueryService $userQueryService
    ) {
    }

    #[OA\Response(response: 200, description: 'Public userinfo', attachables: [new Model(type: UserResponseDTO::class)])]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'User not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/get/user/by-name/{username}', name: 'public-userinfo_route', methods: ['GET'])]
    public function userByName(#[RequestParams] UserNameDTO $nameDTO): Response
    {
        return $this->json($this->userQueryService->getUserinfoByName($nameDTO->getUsername()));
    }

    #[OA\Response(response: 200, description: 'Get info about authenticated user', attachables: [new Model(type: FindAboutMeInfoQueryResult::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Header(header: 'Authorization', description: 'Bearer {token}', required: true, schema: new OA\Schema(type: 'string'))]
    #[Route(path: '/api/v1/user/about-me', name: 'about-me_route', methods: ['GET'])]
    public function aboutMe(): Response
    {
        return $this->json($this->userQueryService->getUserAboutMeData());
    }
}
