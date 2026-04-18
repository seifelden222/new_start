<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::where('role', 'user')->count();
        $activeCases = CharityCase::whereIn('status', ['نشطة', 'عاجلة'])->count();
        $totalDonations = Donation::where('status', 'مقبول')->sum('amount');
        $pendingOrders = Donation::where('status', 'معلق')->count();

        // Monthly donations for chart (last 6 months)
        $monthlyData = collect(range(5, 0))->map(function ($monthsAgo) {
            return Donation::where('status', 'مقبول')
                ->whereYear('created_at', now()->subMonths($monthsAgo)->year)
                ->whereMonth('created_at', now()->subMonths($monthsAgo)->month)
                ->sum('amount');
        })->values();

        $monthlyLabels = collect(range(5, 0))->map(function ($monthsAgo) {
            return now()->subMonths($monthsAgo)->translatedFormat('M');
        })->values();

        // Case distribution by category
        $caseCategories = CharityCase::selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('admin.admindashboard', compact(
            'totalUsers', 'activeCases', 'totalDonations', 'pendingOrders',
            'monthlyData', 'monthlyLabels', 'caseCategories'
        ));
    }

    public function cases(): View
    {
        $cases = CharityCase::latest()->get();

        return view('admin.casemanage', compact('cases'));
    }

    public function donors(): View
    {
        $donors = User::where('role', 'user')
            ->withSum(['donations as total_donated' => fn ($q) => $q->where('status', 'مقبول')], 'amount')
            ->withCount(['donations as donations_count' => fn ($q) => $q->where('status', 'مقبول')])
            ->orderByDesc('total_donated')
            ->get();

        return view('admin.doners', compact('donors'));
    }

    public function orders(): View
    {
        $orders = Donation::with(['user', 'charityCase'])->latest()->paginate(20);

        return view('admin.orders', compact('orders'));
    }

    public function reports(): View
    {
        $totalDonations = Donation::where('status', 'مقبول')->sum('amount');
        $topDonors = User::where('role', 'user')
            ->withSum(['donations as total_donated' => fn ($q) => $q->where('status', 'مقبول')], 'amount')
            ->withCount(['donations as donations_count' => fn ($q) => $q->where('status', 'مقبول')])
            ->orderByDesc('total_donated')
            ->limit(10)
            ->get();

        $categoryData = CharityCase::selectRaw('category, sum(collected_amount) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('admin.reports', compact('totalDonations', 'topDonors', 'categoryData'));
    }
}
