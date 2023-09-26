<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\PemasokController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PembelianController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserBarangsController;
use App\Http\Controllers\Api\ProdukBarangsController;
use App\Http\Controllers\Api\UserPenjualansController;
use App\Http\Controllers\Api\UserPembeliansController;
use App\Http\Controllers\Api\DetailPembelianController;
use App\Http\Controllers\Api\PemasokPembeliansController;
use App\Http\Controllers\Api\PelangganPenjualansController;
use App\Http\Controllers\Api\BarangDetailPenjualansController;
use App\Http\Controllers\Api\BarangDetailPembeliansController;
use App\Http\Controllers\Api\PembelianDetailPembeliansController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        // User Barangs
        Route::get('/users/{user}/barangs', [
            UserBarangsController::class,
            'index',
        ])->name('users.barangs.index');
        Route::post('/users/{user}/barangs', [
            UserBarangsController::class,
            'store',
        ])->name('users.barangs.store');

        // User Penjualans
        Route::get('/users/{user}/penjualans', [
            UserPenjualansController::class,
            'index',
        ])->name('users.penjualans.index');
        Route::post('/users/{user}/penjualans', [
            UserPenjualansController::class,
            'store',
        ])->name('users.penjualans.store');

        // User Pembelians
        Route::get('/users/{user}/pembelians', [
            UserPembeliansController::class,
            'index',
        ])->name('users.pembelians.index');
        Route::post('/users/{user}/pembelians', [
            UserPembeliansController::class,
            'store',
        ])->name('users.pembelians.store');

        Route::apiResource('barangs', BarangController::class);

        // Barang Detail Penjualans
        Route::get('/barangs/{barang}/detail-penjualans', [
            BarangDetailPenjualansController::class,
            'index',
        ])->name('barangs.detail-penjualans.index');
        Route::post('/barangs/{barang}/detail-penjualans', [
            BarangDetailPenjualansController::class,
            'store',
        ])->name('barangs.detail-penjualans.store');

        // Barang Detail Pembelians
        Route::get('/barangs/{barang}/detail-pembelians', [
            BarangDetailPembeliansController::class,
            'index',
        ])->name('barangs.detail-pembelians.index');
        Route::post('/barangs/{barang}/detail-pembelians', [
            BarangDetailPembeliansController::class,
            'store',
        ])->name('barangs.detail-pembelians.store');

        Route::apiResource('produks', ProdukController::class);

        // Produk Barangs
        Route::get('/produks/{produk}/barangs', [
            ProdukBarangsController::class,
            'index',
        ])->name('produks.barangs.index');
        Route::post('/produks/{produk}/barangs', [
            ProdukBarangsController::class,
            'store',
        ])->name('produks.barangs.store');

        Route::apiResource('pemasoks', PemasokController::class);

        // Pemasok Pembelians
        Route::get('/pemasoks/{pemasok}/pembelians', [
            PemasokPembeliansController::class,
            'index',
        ])->name('pemasoks.pembelians.index');
        Route::post('/pemasoks/{pemasok}/pembelians', [
            PemasokPembeliansController::class,
            'store',
        ])->name('pemasoks.pembelians.store');

        Route::apiResource('pelanggans', PelangganController::class);

        // Pelanggan Penjualans
        Route::get('/pelanggans/{pelanggan}/penjualans', [
            PelangganPenjualansController::class,
            'index',
        ])->name('pelanggans.penjualans.index');
        Route::post('/pelanggans/{pelanggan}/penjualans', [
            PelangganPenjualansController::class,
            'store',
        ])->name('pelanggans.penjualans.store');

        Route::apiResource('pembelians', PembelianController::class);

        // Pembelian Detail Pembelians
        Route::get('/pembelians/{pembelian}/detail-pembelians', [
            PembelianDetailPembeliansController::class,
            'index',
        ])->name('pembelians.detail-pembelians.index');
        Route::post('/pembelians/{pembelian}/detail-pembelians', [
            PembelianDetailPembeliansController::class,
            'store',
        ])->name('pembelians.detail-pembelians.store');

        Route::apiResource(
            'detail-pembelians',
            DetailPembelianController::class
        );
    });
