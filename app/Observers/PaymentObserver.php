<?php

namespace App\Observers;

use App\Enums\Status;
use App\Models\Payment;
use App\Notifications\PaymentCreatedNotification;
use App\Notifications\PaymentFailedNotification;
use App\Notifications\PaymentSucceededNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        // TODO: Dispatch payment processing job


        // TODO: Notify correct user. Obviously.
        Auth::user()->notify(new PaymentCreatedNotification($payment));

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
        switch ($payment->status) {
            case Status::Success->value:
                // TODO: Notify correct user. Obviously.
                Auth::user()->notify(new PaymentSucceededNotification($payment));

                Log::info('Payment succeeded', [
                    'id' => $payment->id,
                    'amount' => $payment->amount,
                    'currency' => $payment->currency,
                    'provider' => $payment->provider,
                ]);

                break;
            case Status::Fail->value:
                // TODO: Notify correct user. Obviously.
                Auth::user()->notify(new PaymentFailedNotification($payment));

                Log::info('Payment failed', [
                    'id' => $payment->id,
                    'amount' => $payment->amount,
                    'currency' => $payment->currency,
                    'provider' => $payment->provider,
                ]);


                break;
        }
    }
}
