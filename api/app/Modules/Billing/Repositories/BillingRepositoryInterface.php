<?php

namespace App\Modules\Billing\Repositories;

use App\Modules\Billing\Dtos\ProccessDocumentInput;
use App\Modules\Billing\Enums\BillingStatus;
use App\Modules\Billing\Models\Billing;

interface BillingRepositoryInterface
{
    /**
     * @return array<Billing>
     */
    public function getLastBillings(): array;

    public function createBilling(ProccessDocumentInput $billing): Billing;

    public function updateStatus(Billing $billing, BillingStatus $status): void;
}
