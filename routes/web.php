<?php

use App\Http\Controllers\Admin\AkunAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\TransaksiAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\AkunCustomerController;
use App\Http\Controllers\Customer\DashboardCustomerController;
use App\Http\Controllers\Customer\TransaksiCustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mua\AkunMuaController;
use App\Http\Controllers\Mua\DashboardMuaController;
use App\Http\Controllers\Mua\LayananMuaController;
use App\Http\Controllers\Mua\MuaJadwalController;
use App\Http\Controllers\Mua\TransaksiMuaController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Wo\AkunWoController;
use App\Http\Controllers\Wo\DashboardWoController;
use App\Http\Controllers\Wo\LayananController;
use App\Http\Controllers\Wo\TransaksiWoController;
use App\Http\Controllers\Wo\WoJadwalController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail-layanan/{slug}', [HomeController::class, 'detailLayanan'])->name('detail');
Route::get('/list-pesanan/{id}', [HomeController::class, 'listPesanan'])->name('list-pesanan');
Route::post('/cart/check-tanggal', [CartController::class, 'checkTanggal'])->name('check-tanggal');

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

        Route::get('/verifikasi', [DashboardAdminController::class, 'tablePengguna'])->name('admin.table-pengguna');
        Route::get('/verifikasi/show/pengguna/{id}', [DashboardAdminController::class, 'showVerifPenggua'])->name('admin.show-pengguna');
        Route::post('/verifikasi/pengguna', [DashboardAdminController::class, 'verifPengguna'])->name('admin.verif-pengguna');
        Route::post('/verifikasi/tolak/pengguna', [DashboardAdminController::class, 'tolakPengguna'])->name('admin.tolak-pengguna');

        Route::resource('kategori', KategoriController::class);
        Route::resource('transaksi-admin', TransaksiAdminController::class);
        Route::resource('akun-admin', AkunAdminController::class);
    });



Route::prefix('wo')
    ->middleware(['auth', 'wo'])
    ->group(function () {
        Route::get('/dashboard', [DashboardWoController::class, 'index'])->name('wo.dashboard');
        Route::put('/akun/handle-toko', [AkunWoController::class, 'handleToko'])->name('wo.handle-toko');
        Route::delete('/layanan-wo/delete-gallery/{id}', [LayananController::class, 'deleteGallery'])->name('delete-gallery-layanan');
        Route::get('/jadwal/show', [WoJadwalController::class, 'show'])->name('jadwal-wo-show');
        Route::delete('/jadwal/delete', [WoJadwalController::class, 'destroy'])->name('jadwal-wo-destroy');

        Route::resource('layanan-wo', LayananController::class);
        Route::resource('transaksi-wo', TransaksiWoController::class);
        Route::resource('jadwal-wo', WoJadwalController::class);
        Route::resource('akun-wo', AkunWoController::class);
    });

Route::prefix('mua')
    ->middleware(['auth', 'mua'])
    ->group(function () {
        Route::get('/dashboard', [DashboardMuaController::class, 'index'])->name('mua.dashboard');
        Route::put('/akun/handle-toko', [AkunMuaController::class, 'handleToko'])->name('mua.handle-toko');
        Route::delete('/layanan-mua/delete-gallery/{id}', [LayananController::class, 'deleteGallery'])->name('mua-delete-gallery-layanan');
        Route::get('/jadwal/show', [MuaJadwalController::class, 'show'])->name('jadwal-mua-show');
        Route::delete('/jadwal/delete', [MuaJadwalController::class, 'destroy'])->name('jadwal-mua-destroy');

        Route::resource('layanan-mua', LayananMuaController::class);
        Route::resource('transaksi-mua', TransaksiMuaController::class);
        Route::resource('jadwal-mua', MuaJadwalController::class);
        Route::resource('akun-mua', AkunMuaController::class);
    });

Route::prefix('customer')
    ->middleware(['auth', 'customer'])
    ->group(function () {
        Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');

        Route::get('/upgrade', [DashboardCustomerController::class, 'upgrade'])->name('customer.upgrade');
        Route::post('/akun/upgrade', [DashboardCustomerController::class, 'upgradeAkun'])->name('customer.upgrade-akun');
        Route::put('/transaksi/upload-pembayaran', [TransaksiCustomerController::class, 'uploadPembayaran'])->name('customer.upload-pembayaran');
        Route::get('transaksi-customer/detail/{id}', [TransaksiCustomerController::class, 'detailTransaksi'])->name('customer.detail-transaksi');

        Route::resource('transaksi-customer', TransaksiCustomerController::class);
        Route::resource('akun-customer', AkunCustomerController::class);
    });


// midtrans
Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');
Route::get('pembayaran/success', [CheckoutController::class, 'callback'])->name('pembayaran-success');
Route::post('pembayaran/success', [CheckoutController::class, 'callback']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('cart-add');
    Route::delete('/hapus/cart', [CartController::class, 'destroy'])->name('cart-delete');
    Route::get('/checkout/pembayaran/success', [TransactionsController::class, 'success'])->name('pembayaran');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    Route::get('/cart/get-tanggal-booking', [CartController::class, 'getTanggalBooking'])->name('get-tanggal-booking');
});

Auth::routes();
