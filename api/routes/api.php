<?php

use App\Modules\Billing\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Route;

Route::get('billings', [BillingController::class, 'index']);
Route::post('billings/proccess-document', [BillingController::class, 'proccessDocument']);
