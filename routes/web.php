<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Customer\DashboardCustomerController;
use App\Http\Controllers\Mua\DashboardMuaController;
use App\Http\Controllers\Mua\LayananMuaController;
use App\Http\Controllers\Wo\AkunWoController;
use App\Http\Controllers\Wo\DashboardWoController;
use App\Http\Controllers\Wo\LayananController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('home');
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    });
Route::prefix('wo')
    ->middleware(['auth', 'wo'])
    ->group(function () {
        Route::get('/dashboard', [DashboardWoController::class, 'index'])->name('wo.dashboard');

        Route::resource('layanan-wo', LayananController::class);
        Route::resource('akun-wo', AkunWoController::class);
    });

Route::prefix('mua')
    ->middleware(['auth', 'mua'])
    ->group(function () {
        Route::get('/dashboard', [DashboardMuaController::class, 'index'])->name('mua.dashboard');

        Route::resource('layanan-mua', LayananMuaController::class);
    });

Route::prefix('customer')
    ->middleware(['auth', 'customer'])
    ->group(function () {
        Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');
    });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
