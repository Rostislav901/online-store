<?php

namespace App\Shared\Application\Messenger;

use App\Shared\Application\EventHandler\ExceptionHandler\ExceptionMappingResolver;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class CustomExceptionHandlerMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly ExceptionMappingResolver $resolver)
    {
    }

    /**
     * @throws \Throwable
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        try {
            return $stack->next()->handle($envelope, $stack);
        } catch (\Throwable $throwable) {
            $mapping = $this->resolver->resolve($throwable::class);

            if (null !== $mapping) {
                throw $throwable;
            }

            $previousException = $throwable->getPrevious();

            throw new $previousException($throwable->getMessage(), 0, $previousException);
        }
    }
}
