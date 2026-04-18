<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\CharityCaseController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\WalletController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    /** @var User $user */
    $user = request()->user();

    return redirect()->route($user->dashboardRouteName());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::redirect('/profile', '/settings')->name('profile.edit');
    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}/avatar', [ProfileController::class, 'avatar'])->name('users.avatar');
});
// routes for the website pages
Route::view('/aboutus', 'aboutus')->name('aboutus');
Route::view('/contactus', 'contactus')->name('contactus');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/vocationaltraining', 'vocationaltraining')->name('vocationaltraining');
Route::redirect('/signup', '/register')->name('signup');

// user routes
Route::middleware('auth')->group(function () {
    Route::get('/userdashboard', [UserDashboardController::class, 'index'])->name('userdashboard');
    Route::get('/mycases', [UserDashboardController::class, 'myCases'])->name('mycases');
    Route::get('/mydonate', [UserDashboardController::class, 'myDonations'])->name('mydonate');
    Route::get('/donation', [SupportController::class, 'services'])->name('donation');
    Route::get('/caseslist', [SupportController::class, 'cases'])->name('caseslist');
    Route::get('/urgent-cases', [SupportController::class, 'urgentCases'])->name('cases.urgent');
    Route::get('/cases/{charityCase}', [SupportController::class, 'showCase'])->name('cases.show');
    Route::redirect('/case1', '/caseslist');
    Route::redirect('/case2', '/caseslist');
    Route::redirect('/case3', '/caseslist');
    Route::redirect('/case4', '/caseslist');
    Route::redirect('/case5', '/caseslist');
    Route::redirect('/case6', '/caseslist');
    Route::post('/wallet/charge', [WalletController::class, 'charge'])->name('wallet.charge');
    Route::post('/donate', [DonationController::class, 'store'])->name('donate');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admindashboard');
    Route::get('/casemanage', [AdminDashboardController::class, 'cases'])->name('casemanage');
    Route::get('/addcase', fn () => view('admin.addcase'))->name('addcase');
    Route::post('/cases', [CharityCaseController::class, 'store'])->name('cases.store');
    Route::put('/cases/{charityCase}', [CharityCaseController::class, 'update'])->name('cases.update');
    Route::delete('/cases/{charityCase}', [CharityCaseController::class, 'destroy'])->name('cases.destroy');
    Route::get('/donors', [AdminDashboardController::class, 'donors'])->name('donors');
    Route::redirect('/doners', '/admin/donors');
    Route::get('/orders', [AdminDashboardController::class, 'orders'])->name('orders');
    Route::patch('/orders/{donation}', [DonationController::class, 'updateStatus'])->name('orders.update');
    Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('reports');
});

require __DIR__.'/auth.php';
