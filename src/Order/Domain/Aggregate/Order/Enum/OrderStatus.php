<?php

namespace App\Order\Domain\Aggregate\Order\Enum;

enum OrderStatus: string
{
    case IN_PROGRESS_STATUS = 'IN_PROGRESS';
    case PAID_STATUS = 'PAID';
    case SHIPPED_STATUS = 'SHIPPED';
    case COMPLETED_STATUS = 'COMPLETED';
    case CANCELLED_STATUS = 'CANCELLED';
}
