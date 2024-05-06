<?php

namespace App\Modules\Billing\Services;

use App\Modules\Billing\Dtos\ProccessDocumentInput;
use App\Modules\Billing\Models\Billing;

interface BillingServiceInterface
{
    public function getLastBillings(): array;

    public function proccessDocument(ProccessDocumentInput $input): Billing;
}
