<?php

namespace App\Http\Controllers;

use App\Models\CharityCase;
use App\Models\Donation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'charity_case_id' => ['required', 'exists:charity_cases,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if ($user->balance < $request->amount) {
            return response()->json(['error' => 'رصيدك غير كافٍ، يرجى شحن المحفظة أولاً'], 422);
        }

        $user->decrement('balance', $request->amount);

        $donation = Donation::create([
            'user_id' => $user->id,
            'charity_case_id' => $request->charity_case_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'مقبول',
        ]);

        // Update collected amount on the case
        CharityCase::find($request->charity_case_id)->increment('collected_amount', $request->amount);

        return response()->json([
            'balance' => $user->fresh()->balance,
            'donation_id' => $donation->id,
        ]);
    }

    public function updateStatus(Request $request, Donation $donation): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:معلق,مقبول,مكتمل,مرفوض'],
        ]);

        $donation->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطلب');
    }
}
