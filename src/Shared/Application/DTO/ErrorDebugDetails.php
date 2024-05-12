<?php

namespace App\Shared\Application\DTO;

class ErrorDebugDetails
{
    public function __construct(private readonly string $trace)
    {
    }

    public function getTrace(): string
    {
        return $this->trace;
    }
}
