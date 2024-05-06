<?php

namespace App\Modules\Billing\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingDocument extends Model
{
    const TABLE = 'billing_documents';

    use HasFactory, HasUuids;

    protected $fillable = [
        'billing_id',
        'name',
        'government_id',
        'email',
        'debt_amount',
        'debt_due_date',
        'debt_id',
    ];

    protected function casts(): array
    {
        return [
            'debt_amount' => 'integer',
            'debt_due_date' => 'datetime',
        ];
    }

    public function billing(): BelongsTo
    {
        return $this->belongsTo(Billing::class, 'billing_id');
    }
}
