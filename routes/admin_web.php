<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\WalletController;
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
Route::prefix('admin')->name('admin.')->middleware('auth:admin_user')->group(function () {
  Route::resource('/', DashboardController::class);  
  Route::resource('admin-user', AdminController::class);

  Route::resource('user', UserController::class);

  Route::get('wallet', [WalletController::class, 'index'])->name('wallet.index');
});


