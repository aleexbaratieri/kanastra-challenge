<?php

namespace App\Modules\Billing\Repositories;

use App\Modules\Billing\Dtos\ProccessDocumentInput;
use App\Modules\Billing\Enums\BillingStatus;
use App\Modules\Billing\Models\Billing;

class BillingRepository implements BillingRepositoryInterface
{
    public function __construct(private readonly Billing $entity)
    {
    }

    /**
     * @return array<Billing>
     */
    public function getLastBillings(): array
    {
        return $this->entity->limit(10)->get()->toArray();
    }

    public function createBilling(ProccessDocumentInput $billing): Billing
    {
        return $this->entity->create($billing->data());
    }

    public function updateStatus(Billing $billing, BillingStatus $status): void
    {
        $billing->status = $status;
        $billing->save();
    }
}
