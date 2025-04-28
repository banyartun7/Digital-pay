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
});


//Admin auth
Route::get('/admin/login', [AdminUserController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminUserController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminUserController::class, 'logout'])->name('admin.logout');

//User auth
Auth::routes();

