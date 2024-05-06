<?php

namespace App\Modules\Billing\Http\Controllers;

use App\Helpers\ParseCsvToArr;
use App\Modules\Billing\Services\BillingServiceInterface;
use App\Http\Controllers\Controller;
use App\Modules\Billing\Dtos\ProccessDocumentInput;
use App\Modules\Billing\Http\Requests\ProcessDocumentsRequest;

class BillingController extends Controller
{
    public function __construct(private readonly BillingServiceInterface $service)
    {
    }

    public function index()
    {
        return $this->service->getLastBillings();
    }

    public function proccessDocument(ProcessDocumentsRequest $request)
    {
        $input = new ProccessDocumentInput($request->validated());

        return $this->service->proccessDocument($input);
    }
}
