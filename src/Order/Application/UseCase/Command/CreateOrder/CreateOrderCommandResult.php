<?php

namespace App\Order\Application\UseCase\Command\CreateOrder;

use App\Shared\Application\Command\CommandInterface;

class CreateOrderCommandResult implements CommandInterface
{
    public string $message = 'success';
}
