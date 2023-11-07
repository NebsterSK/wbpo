<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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

    public function store(PaymentStoreRequest $request): PaymentResource|JsonResponse
    {
        $validated = $request->validated();

        try {
            $payment = Payment::create($validated);
        } catch (Throwable $throwable) {
            Log::error('Payment not created', [
                'exception_message' => $throwable->getMessage(),
                'exception_file' => $throwable->getFile(),
                'exception_line' => $throwable->getLine(),
            ]);

            return response()->json([
                'message' => 'Payment could not be created.',
                'details' => 'A bunch of highly skilled gnomes were dispatched to fix the problem. Please try again later.',
            ], Response::HTTP_BAD_REQUEST);
        }

        return new PaymentResource($payment);
    }
}
