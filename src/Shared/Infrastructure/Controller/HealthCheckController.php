<?php

namespace App\Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: '/health/check', methods: ['POST'])]
class HealthCheckController
{
    public function __invoke(): Response
    {
        return new JsonResponse('nice');
    }
}
