<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\StockBahanController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PegawaiController;

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

Auth::routes();

Route::get('/', function (){
    return redirect('/dashboard');
});

Route::get('/test', function () {
    return view('pdf.laporan');
});

// Route untuk mengarah ke halaman dari controller
Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
    
        Route::prefix('transaksi')->group(function () {
            Route::get('/', function() {
                return redirect('/dashboard');
            });
    
            Route::get('penjualan', [PenjualanController::class, 'index'])->name('page-penjualan');
            Route::get('pembelian', [PembelianController::class, 'index'])->name('page-pembelian');
        });

        Route::middleware(['owner'])->group(function () {
            Route::get('/laporan', [LaporanController::class, 'index']);
            Route::get('/activity', [UserActivityController::class, 'index']);
            Route::get('/pegawai', [PegawaiController::class, 'index']);
        });

        Route::get('/stock', [StockBahanController::class, 'index']);
        Route::get('/settings', [SettingsController::class, 'index']);
    });

    // Route yang mengarah fungsi dari controller
    Route::get('/income/{type}/{value}', [HomeController::class, 'income']);
    Route::get('/spending/{type}/{value}', [HomeController::class, 'spending']);
    Route::get('/history/{year}', [HomeController::class, 'history']);

    Route::middleware(['owner'])->group(function () {
        
        Route::prefix('activity')->group(function () {
            Route::get('/', [UserActivityController::class, 'data'])->name('data-activity');
            Route::get('/show/{id}', [UserActivityController::class, 'show'])->name('get-activity');
            Route::delete('/delete', [UserActivityController::class, 'delete'])->name('delete-activity');
        });

        Route::prefix('laporan')->group(function () {
            Route::post('/', [LaporanController::class, 'downloadReport'])->name('download-report');
        });

    });

    Route::prefix('transaksi')->group(function () {
        Route::prefix('penjualan')->group(function () {
            Route::get('/', [PenjualanController::class, 'data'])->name('data-jual');
            Route::post('/', [PenjualanController::class, 'create'])->name('create-jual');
            Route::get('/show/{id}', [PenjualanController::class, 'show'])->name('show-jual');
            Route::put('/update/{id}', [PenjualanController::class, 'update'])->name('update-jual');
            Route::delete('/delete/{id}', [PenjualanController::class, 'delete'])->name('delete-jual');
            Route::get('/search', [PenjualanController::class, 'search'])->name('search-jual');
        });
    
        Route::prefix('pembelian')->group(function () {
            Route::get('/', [PembelianController::class, 'data'])->name('data-beli');
            Route::post('/', [PembelianController::class, 'create'])->name('create-beli');
            Route::get('/show/{id}', [PembelianController::class, 'show'])->name('show-beli');
            Route::put('/update/{id}', [PembelianController::class, 'update'])->name('update-beli');
            Route::delete('/delete/{id}', [PembelianController::class, 'delete'])->name('delete-beli');
            Route::get('/search', [PembelianController::class, 'search'])->name('search-beli');
        });

    });
    
    Route::prefix('stock')->group(function () {
        Route::get('/', [StockBahanController::class, 'data'])->name('data-stock');
        Route::post('/', [StockBahanController::class, 'create'])->name('create-stock');
        Route::get('/show/{id}', [StockBahanController::class, 'show'])->name('show-stock');
        Route::put('/update/{id}', [StockBahanController::class, 'update'])->name('update-stock');
        Route::delete('/delete/{id}', [StockBahanController::class, 'delete'])->name('delete-stock');
    }); 
    
    Route::prefix('settings')->group(function () {
        Route::put('/name/{id}', [SettingsController::class, 'changeName'])->name('change-name');
        Route::put('/password/{id}', [SettingsController::class, 'changePassword'])->name('change-password');
        Route::put('/email/{id}', [SettingsController::class, 'changeEmail'])->name('change-email');
    });
});




