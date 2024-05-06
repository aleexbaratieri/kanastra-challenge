<?php

namespace App\Modules\Billing\Dtos;

use App\Modules\Billing\Enums\BillingStatus;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

class ProccessDocumentInput
{
    public string $name;
    public ?string $description;
    public UploadedFile $document;
    private  BillingStatus $status;
    public string $storageDocumentPath;

    public function __construct(mixed $data)
    {
        $this->name = $data['name'];
        $this->description = isset($data['description']) ? $data['description'] : null;
        $this->document = $data['document'];
        $this->status = BillingStatus::PENDING;
        $this->storageDocumentPath = 'billings/' . Uuid::uuid4() . '.csv';
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'document' => $this->document,
            'status' => $this->status,
            'storage_document_path' => $this->storageDocumentPath,
        ];
    }
}
