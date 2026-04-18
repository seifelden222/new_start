<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Charge the authenticated user's wallet balance.
     */
    public function charge(Request $request): JsonResponse
    {
        $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
        ]);

        $user = Auth::user();
        $user->increment('balance', $request->amount);

        return response()->json([
            'balance' => $user->fresh()->balance,
        ]);
    }
}
