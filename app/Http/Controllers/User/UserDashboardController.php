<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        $donations = $user->donations()->with('charityCase')->latest()->get();
        $totalDonated = $user->totalDonated();
        $helpedCount = $user->donations()->where('status', 'مقبول')->distinct('charity_case_id')->count('charity_case_id');

        // Weekly donations for chart (last 7 days)
        $weeklyData = collect(range(6, 0))->map(function ($daysAgo) use ($user) {
            return $user->donations()
                ->where('status', 'مقبول')
                ->whereDate('created_at', now()->subDays($daysAgo))
                ->sum('amount');
        })->values();

        return view('user.userdashboard', compact('user', 'donations', 'totalDonated', 'helpedCount', 'weeklyData'));
    }

    public function myDonations(): \Illuminate\View\View
    {
        $user = Auth::user();
        $donations = $user->donations()->with('charityCase')->latest()->paginate(10);
        $totalDonated = $user->totalDonated();

        return view('user.mydonate', compact('donations', 'totalDonated'));
    }

    public function myCases(): \Illuminate\View\View
    {
        $user = Auth::user();
        $cases = $user->donations()
            ->with('charityCase')
            ->where('status', 'مقبول')
            ->whereNotNull('charity_case_id')
            ->get()
            ->pluck('charityCase')
            ->unique('id')
            ->filter();

        return view('user.mycases', compact('cases'));
    }
}
