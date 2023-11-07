<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $payments = Payment::get();

        return PaymentResource::collection($payments);
    }

    public function signature(): JsonResponse
    {
        return response()->json([
            'url' => URL::temporarySignedRoute('api.v1.payments.store', now()->addMinutes(config('custom.signedUrlsLifetime')), ['user' => Auth::user()->id]),
        ]);
    }

    public function store(PaymentStoreRequest $request): PaymentResource
    {
        $validated = $request->validated();

        $payment = Payment::create($validated);

        return new PaymentResource($payment);
    }
}
