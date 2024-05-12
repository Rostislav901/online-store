<?php

namespace App\Order\Domain\Aggregate\Order\Enum;

enum PaymentType: string
{
    case CREDIT_CARD_TYPE = 'CREDIT CARD';
    case BANK_TRANSFER_TYPE = 'BANK TRANSFER';
    case CASH_ON_DELIVERY = 'CASH ON DELIVERY';
}
