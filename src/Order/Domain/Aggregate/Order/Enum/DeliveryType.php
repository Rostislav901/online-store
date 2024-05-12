<?php

namespace App\Order\Domain\Aggregate\Order\Enum;

enum DeliveryType: string
{
    case COURIER_DELIVERY_TYPE = 'COURIER';
    case PICKUP_DELIVERY_TYPE = 'PICKUP';
    case MAIL_DELIVERY_TYPE = 'MAIL';
}
