<?php

use App\Http\Controllers\ProfileController;
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
Route::view('/donation', 'donation')->name('donation');
Route::view('/caseslist', 'caseslist')->name('caseslist');
Route::redirect('/signup', '/register')->name('signup');
Route::view('/case1', 'case1')->name('case1');
Route::view('/case2', 'case2')->name('case2');
Route::view('/case3', 'case3')->name('case3');
Route::view('/case4', 'case4')->name('case4');
Route::view('/case5', 'case5')->name('case5');
Route::view('/case6', 'case6')->name('case6');

// user routes
Route::middleware('auth')->group(function () {
    Route::get('/userdashboard', [\App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('userdashboard');
    Route::get('/mycases', [\App\Http\Controllers\User\UserDashboardController::class, 'myCases'])->name('mycases');
    Route::get('/mydonate', [\App\Http\Controllers\User\UserDashboardController::class, 'myDonations'])->name('mydonate');
    Route::post('/wallet/charge', [\App\Http\Controllers\WalletController::class, 'charge'])->name('wallet.charge');
    Route::post('/donate', [\App\Http\Controllers\DonationController::class, 'store'])->name('donate');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/admindashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admindashboard');
    Route::get('/casemanage', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'cases'])->name('casemanage');
    Route::get('/addcase', fn () => view('admin.addcase'))->name('addcase');
    Route::post('/cases', [\App\Http\Controllers\CharityCaseController::class, 'store'])->name('cases.store');
    Route::put('/cases/{charityCase}', [\App\Http\Controllers\CharityCaseController::class, 'update'])->name('cases.update');
    Route::delete('/cases/{charityCase}', [\App\Http\Controllers\CharityCaseController::class, 'destroy'])->name('cases.destroy');
    Route::get('/donors', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'donors'])->name('donors');
    Route::redirect('/doners', '/admin/donors');
    Route::get('/orders', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'orders'])->name('orders');
    Route::patch('/orders/{donation}', [\App\Http\Controllers\DonationController::class, 'updateStatus'])->name('orders.update');
    Route::get('/reports', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'reports'])->name('reports');
});

require __DIR__.'/auth.php';
