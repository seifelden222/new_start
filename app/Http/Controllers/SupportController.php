<?php

namespace App\Http\Controllers;

use App\Models\CharityCase;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function services(): View
    {
        $featuredCases = CharityCase::query()
            ->whereIn('status', ['نشطة', 'عاجلة'])
            ->latest()
            ->limit(6)
            ->get();

        return view('donation', [
            'featuredCases' => $featuredCases,
            'selectedCaseId' => request()->integer('case') ?: null,
            'paymentMethods' => [
                [
                    'value' => 'cash',
                    'label' => 'كاش',
                    'description' => 'اشحن رصيدك نقدًا عبر المنصة، ثم نفّذ التبرع مباشرة من رصيد حسابك الحالي.',
                ],
                [
                    'value' => 'instapay',
                    'label' => 'إنستا باي',
                    'description' => 'حوّل رصيدك عبر InstaPay ثم استخدم المبلغ المضاف داخل حسابك لإتمام التبرع.',
                ],
            ],
        ]);
    }

    public function cases(): View
    {
        $cases = CharityCase::query()
            ->whereIn('status', ['نشطة', 'عاجلة'])
            ->latest()
            ->get();

        return view('cases.index', [
            'cases' => $cases,
            'urgentCasesCount' => $cases->where('status', 'عاجلة')->count(),
        ]);
    }

    public function urgentCases(): View
    {
        $urgentCases = CharityCase::query()
            ->where('status', 'عاجلة')
            ->latest()
            ->get();

        return view('cases.urgent', [
            'urgentCases' => $urgentCases,
        ]);
    }

    public function showCase(CharityCase $charityCase): View
    {
        return view('cases.show', [
            'charityCase' => $charityCase,
        ]);
    }
}
