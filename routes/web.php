<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = request()->user();

    return redirect()->route($user->dashboardRouteName());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// routes for the website pages
Route::view('/aboutus', 'aboutus')->name('aboutus');
Route::view('/contactus', 'contactus')->name('contactus');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/vocationaltraining', 'vocationaltraining')->name('vocationaltraining');
Route::view('/donation', 'donation')->name('donation');
Route::view('/caseslist', 'caseslist')->name('caseslist');
Route::view('/case1', 'case1')->name('case1');
Route::view('/case2', 'case2')->name('case2');
Route::view('/case3', 'case3')->name('case3');
Route::view('/case4', 'case4')->name('case4');
Route::view('/case5', 'case5')->name('case5');
Route::view('/case6', 'case6')->name('case6');


// user routes
Route::middleware('auth')->group(function () {
    Route::view('/userdashboard', 'user.userdashboard')->name('userdashboard');
    Route::view('/mycases', 'user.mycases')->name('mycases');
    Route::view('/mydonate', 'user.mydonate')->name('mydonate');
    Route::view('/settings', 'user.settings')->name('settings');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::view('/admindashboard', 'admin.admindashboard')->name('admindashboard');
    Route::view('/addcase', 'admin.addcase')->name('addcase');
    Route::view('/casemanage', 'admin.casemanage')->name('casemanage');
    Route::view('/doners', 'admin.doners')->name('doners');
    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/reports', 'admin.reports')->name('reports');
});

require __DIR__ . '/auth.php';
