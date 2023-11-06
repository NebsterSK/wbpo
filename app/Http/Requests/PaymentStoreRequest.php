<?php

namespace App\Http\Requests;

use App\Enums\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payer_name' => [
                'required',
                'string',
                'max:255',
            ],
            'payer_email' => [
                'required',
                'email',
                'max:255',
            ],
            'payer_address' => [
                'required',
                'string',
                'max:255',
            ],
            'amount' => [
                'required',
                'decimal:0,2',
                'min:0.01',
            ],
            'currency' => [
                'required',
                Rule::in(Currency::toArray()),
            ],
            'provider' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'payer_name' => 'payer_name',
            'payer_email' => 'payer_email',
            'payer_address' => 'payer_address',
        ];
    }
}
