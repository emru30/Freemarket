<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PurchaseController;
use App\Http\Requests\RegisterRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemController::class, 'index'])->name('item.list');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.detail');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/email/verification-notification', function () {
    return redirect()->route('verification.send');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware('auth')->group(function () {
    Route::get('/sell', [SellController::class, 'create'])->name('item.sell');
    Route::post('/sell', [SellController::class, 'store'])->name('item.store');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'showPurchaseForm'])->name('item.purchase');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'processPurchase'])->name('purchase.process');

    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'showAddressChangeForm'])->name('purchase.address.change');
    Route::patch('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('purchase.address.update');

    Route::get('/mypage', [UserController::class, 'showProfile'])->name('mypage');
    Route::get('/mypage/profile', [UserController::class, 'editProfile'])->name('mypage.profile.edit');
    Route::patch('/mypage/profile', [UserController::class, 'updateProfile'])->name('mypage.profile.update');
});