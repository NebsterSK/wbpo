<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Payment
 */
class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payer_name' => $this->payer_name,
            'payer_email' => $this->payer_email,
            'payer_address' => $this->payer_address,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'provider' => $this->provider,
        ];
    }
}
