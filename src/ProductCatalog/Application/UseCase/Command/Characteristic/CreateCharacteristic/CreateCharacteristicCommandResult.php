<?php

namespace App\ProductCatalog\Application\UseCase\Command\Characteristic\CreateCharacteristic;

use App\Shared\Application\Command\CommandInterface;

class CreateCharacteristicCommandResult implements CommandInterface
{
    public string $message = 'success';
}
