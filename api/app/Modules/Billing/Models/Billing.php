<?php

namespace App\Modules\Billing\Models;

use App\Modules\Billing\Enums\BillingStatus;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Billing extends Model
{
    use HasFactory, HasUuids;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    protected $fillable = [
        'name',
        'description',
        'storage_document_path',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => BillingStatus::class,
        ];
    }

    public function documents(): HasMany
    {
        return $this->hasMany(BillingDocument::class, 'billing_id');
    }
}
