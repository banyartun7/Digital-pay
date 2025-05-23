<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\PageController;
use App\Http\Controllers\auth\AdminUserController;
use App\Http\Controllers\backend\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('home');  
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    Route::get('/update-password', [PageController::class, 'update_password'])->name('update_pass');
    Route::post('/update-password', [PageController::class, 'store_password'])->name('update-pass.store');
    Route::get('/wallet', [PageController::class, 'wallet'])->name('wallet');
    
    Route::get('/transfer', [PageController::class, 'transfer'])->name('transfer');
    Route::get('/transfer/confirm', [PageController::class, 'confirm_transfer'])->name('confirm_transfer');
    Route::post('/transfer/complete', [PageController::class, 'complete_transfer'])->name('complete');
    Route::get('/transfer/hash', [PageController::class, 'transfer_hash']);

    Route::get('/transaction', [PageController::class, 'transaction'])->name('transaction');
    Route::get('/transaction/detail', [PageController::class, 'transactionDetail'])->name('transaction.detail');

    Route::get('/verify', [PageController::class, 'toVerifyAccount'])->name('verify');
    Route::get('/transfer/confirm/password-check', [PageController::class, 'password_check']);

    Route::get('/receive-qr', [PageController::class, 'receiveQr'])->name('receive_qr');

    Route::get('/scan-pay', [PageController::class, 'scanPay'])->name('scan_pay');
    Route::get('/scan-pay-form', [PageController::class, 'scanPayForm'])->name('scan-pay-form');

    Route::get('/transfer/scan_confirm', [PageController::class, 'scanConfirmTransfer'])->name('scan_confirm_transfer');
    Route::post('/transfer/scan_complete', [PageController::class, 'scanComplete'])->name('scan-pay-complete');
});


//Admin auth
Route::get('/admin/login', [AdminUserController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminUserController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminUserController::class, 'logout'])->name('admin.logout');

//User auth
Auth::routes();

