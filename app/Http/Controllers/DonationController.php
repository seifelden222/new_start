<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Models\CharityCase;
use App\Models\Donation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function store(StoreDonationRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        if ($user->balance < $validated['amount']) {
            return response()->json(['error' => 'رصيدك غير كافٍ، يرجى شحن المحفظة أولاً'], 422);
        }

        $donation = DB::transaction(function () use ($user, $validated): Donation {
            $user->decrement('balance', $validated['amount']);

            $donation = Donation::create([
                'user_id' => $user->id,
                'charity_case_id' => $validated['charity_case_id'],
                'amount' => $validated['amount'],
                'payment_method' => 'wallet',
                'status' => 'مقبول',
            ]);

            CharityCase::query()
                ->whereKey($validated['charity_case_id'])
                ->increment('collected_amount', $validated['amount']);

            return $donation;
        });

        return response()->json([
            'balance' => $user->fresh()->balance,
            'donation_id' => $donation->id,
            'message' => 'تم تنفيذ التبرع وخصم المبلغ من رصيدك بنجاح.',
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
