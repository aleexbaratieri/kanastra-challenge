<?php

namespace App\Providers;

use App\Modules\Billing\Repositories\BillingRepository;
use App\Modules\Billing\Repositories\BillingRepositoryInterface;
use App\Modules\Billing\Services\BillingService;
use App\Modules\Billing\Services\BillingServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            BillingServiceInterface::class,
            BillingService::class,
        );

        $this->app->bind(
            BillingRepositoryInterface::class,
            BillingRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
