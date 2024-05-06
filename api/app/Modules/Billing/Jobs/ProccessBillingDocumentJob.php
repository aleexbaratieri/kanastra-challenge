<?php

namespace App\Modules\Billing\Jobs;

use finfo;
use App\Helpers\ParseCsvToArr;
use App\Modules\Billing\Enums\BillingStatus;
use App\Modules\Billing\Models\Billing;
use App\Modules\Billing\Models\BillingDocument;
use App\Modules\Billing\Repositories\BillingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProccessBillingDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Billing $billing;

    /**
     * Create a new job instance.
     */
    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    /**
     * Execute the job.
     */
    public function handle(BillingRepositoryInterface $repo): void
    {
        $repo->updateStatus($this->billing, BillingStatus::PROCESSING);

        $file_path = storage_path('app/' . $this->billing->storage_document_path);
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if (Storage::exists($this->billing->storage_document_path)) {
            $file = new UploadedFile(
                $file_path,
                $this->billing->storage_document_path,
                $finfo->file($file_path),
                0,
                false
            );

            $items = collect(ParseCsvToArr::parse($file));

            $items = $items->map(function ($item) {
                $item['id'] = Uuid::uuid4();
                $item['billing_id'] = $this->billing->id;
                return $item;
            });

            DB::beginTransaction();

            try {
                foreach ($items->chunk(8000) as $chunk) {
                    DB::table(BillingDocument::TABLE)->insert($chunk->toArray());
                }

                Log::info(count($items) . ' documents dispatched for the billing ' . $this->billing->id);
                Storage::delete($this->billing->storage_document_path);
                DB::commit();
                $repo->updateStatus($this->billing, BillingStatus::COMPLETED);
            } catch (\Exception $err) {
                Log::error($err);
                DB::rollBack();
                $repo->updateStatus($this->billing, BillingStatus::ERROR);
                //throw error for re-proccess job 
                throw $err;
            }
        }
    }
}
