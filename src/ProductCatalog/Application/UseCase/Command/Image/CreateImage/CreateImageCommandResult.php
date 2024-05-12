<?php

namespace App\ProductCatalog\Application\UseCase\Command\Image\CreateImage;

use App\Shared\Application\Command\CommandInterface;

class CreateImageCommandResult implements CommandInterface
{
    public string $message = 'success';
}
