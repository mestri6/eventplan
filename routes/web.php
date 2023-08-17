<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Customer\DashboardCustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mua\AkunMuaController;
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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/detail-layanan/{slug}', [HomeController::class, 'detailLayanan'])->name('detail');

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/verifikasi', [DashboardAdminController::class, 'tablePengguna'])->name('admin.table-pengguna');
        Route::get('/verifikasi/show/pengguna/{id}', [DashboardAdminController::class, 'showVerifPenggua'])->name('admin.show-pengguna');
        Route::post('/verifikasi/pengguna', [DashboardAdminController::class, 'verifPengguna'])->name('admin.verif-pengguna');
        Route::post('/verifikasi/tolak/pengguna', [DashboardAdminController::class, 'tolakPengguna'])->name('admin.tolak-pengguna');


        Route::resource('kategori', KategoriController::class);
    });
Route::prefix('wo')
    ->middleware(['auth', 'wo'])
    ->group(function () {
        Route::get('/dashboard', [DashboardWoController::class, 'index'])->name('wo.dashboard');

        Route::delete('/layanan-wo/delete-gallery/{id}', [LayananController::class, 'deleteGallery'])->name('delete-gallery-layanan');

        Route::resource('layanan-wo', LayananController::class);
        Route::resource('akun-wo', AkunWoController::class);
    });

Route::prefix('mua')
    ->middleware(['auth', 'mua'])
    ->group(function () {
        Route::get('/dashboard', [DashboardMuaController::class, 'index'])->name('mua.dashboard');
        Route::delete('/layanan-mua/delete-gallery/{id}', [LayananController::class, 'deleteGallery'])->name('mua-delete-gallery-layanan');
        Route::resource('layanan-mua', LayananMuaController::class);
        Route::resource('akun-mua', AkunMuaController::class);
    });

Route::prefix('customer')
    ->middleware(['auth', 'customer'])
    ->group(function () {
        Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');

        Route::get('/upgrade', [DashboardCustomerController::class, 'upgrade'])->name('customer.upgrade');
        Route::post('/akun/upgrade', [DashboardCustomerController::class, 'upgradeAkun'])->name('customer.upgrade-akun');
    });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
