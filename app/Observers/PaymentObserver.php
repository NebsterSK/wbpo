<?php

namespace App\Observers;

use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        // TODO: Send notification

        Log::info('Payment created', [
            'id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'provider' => $payment->provider,
        ]);
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        Log::info('Payment updated', [
            'id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'provider' => $payment->provider,
        ]);
    }
}
