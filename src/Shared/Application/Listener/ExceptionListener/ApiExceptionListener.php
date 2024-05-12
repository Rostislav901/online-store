<?php

declare(strict_types=1);

namespace App\Shared\Application\Listener\ExceptionListener;

use App\Shared\Application\DTO\ErrorDebugDetails;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\EventHandler\ExceptionHandler\ExceptionMapping;
use App\Shared\Application\EventHandler\ExceptionHandler\ExceptionMappingResolver;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ApiExceptionListener
{
    public function __construct(
        private readonly ExceptionMappingResolver $resolver,
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer,
        private readonly bool $isDebug)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        if ($this->isSecurityException($throwable)) {
            return;
        }
        $mapping = $this->resolver->resolve($throwable::class);
        if (null === $mapping) {
            $mapping = ExceptionMapping::fromCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($mapping->getCode() >= Response::HTTP_INTERNAL_SERVER_ERROR || $mapping->isLoggable()) {
            $this->logger->error($throwable->getMessage(), [
                'trace' => $throwable->getTraceAsString(),
                'previous' => null !== $throwable->getPrevious() ? $throwable->getPrevious()->getMessage() : '',
            ]);
        }

        $message = $mapping->isHidden() && !$this->isDebug
            ? Response::$statusTexts[$mapping->getCode()]
            : $throwable->getMessage();

        $details = $this->isDebug ? new ErrorDebugDetails($throwable->getTraceAsString()) : null;
        $data = $this->serializer->serialize(new ErrorResponse($message, $details), JsonEncoder::FORMAT);

        $event->setResponse(new JsonResponse($data, $mapping->getCode(), [], true));
    }

    private function isSecurityException(\Throwable $throwable): bool
    {
        return $throwable instanceof AuthenticationException || $throwable instanceof AccessDeniedException;
    }
}
