<?php

namespace App\Modules\Billing\Services;

use App\Modules\Billing\Dtos\ProccessDocumentInput;
use App\Modules\Billing\Jobs\ProccessBillingDocumentJob;
use App\Modules\Billing\Models\Billing;
use App\Modules\Billing\Repositories\BillingRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class BillingService implements BillingServiceInterface
{
    public function __construct(private readonly BillingRepositoryInterface $repo)
    {
    }

    public function getLastBillings(): array
    {
        return $this->repo->getLastBillings();
    }

    public function proccessDocument(ProccessDocumentInput $input): Billing
    {
        try {

            Storage::put($input->storageDocumentPath, file_get_contents($input->document->getRealPath()));
            $billing = $this->repo->createBilling($input);
            dispatch(new ProccessBillingDocumentJob($billing));
            return $billing;
        } catch (\Exception $err) {

            throw $err;
        }
    }
}
