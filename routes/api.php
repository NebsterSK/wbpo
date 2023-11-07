<?php

use App\Http\Controllers\Api\v1\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'abilities:api'])->prefix('v1')->name('v1.')->group(function () {
    Route::get('payments/signature', [PaymentController::class, 'signature'])->name('payments.signature');
    Route::resource('payments', PaymentController::class)->only(['index', 'store'])->names('payments');
});
