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

Route::get('/', [PageController::class, 'index']);
Route::get('/admin/login', [AdminUserController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminUserController::class, 'login'])->name('admin.login');
Route::resource('/admin', DashboardController::class);
Auth::routes();

