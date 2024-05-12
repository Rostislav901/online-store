<?php

namespace App\User\Infrastructure\Http\Controller;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Infrastructure\Bus\CommandBus;
use App\User\Application\DTO\UserRequestDTO;
use App\User\Application\UseCase\Command\User\CreateUser\CreateUserCommand;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[OA\Response(response: 200, description: 'Signs up a user',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'token', type: 'string'),
            new OA\Property(property: 'refresh_token', type: 'string')])
    )]
    #[OA\Response(response: 400, description: 'Validation Error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Name or phone or email already exist error', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 422, description: 'Email or phone or name not valid', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: UserRequestDTO::class)])]
    #[Route(path: '/api/v1/store/auth/users/singUp', name: 'singUp_route', methods: ['POST'])]
    public function singUp(#[RequestBody] UserRequestDTO $userDTO, CommandBus $bus): Response
    {
        $command = new CreateUserCommand($userDTO);

        /**
         * @var JWTAuthenticationSuccessResponse $result
         */
        $result = $bus->execute($command);

        return $result;
    }
}
