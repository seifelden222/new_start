<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChargeWalletRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Charge the authenticated user's wallet balance.
     */
    public function charge(ChargeWalletRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        $user->increment('balance', $validated['amount']);

        return response()->json([
            'balance' => $user->fresh()->balance,
            'payment_method' => $validated['payment_method'],
        ]);
    }
}
