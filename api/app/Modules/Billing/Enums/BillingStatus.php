<?php

namespace App\Modules\Billing\Enums;

enum BillingStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case ERROR = 'error';
    case COMPLETED = 'completed';
}
