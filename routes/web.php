<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataPenjualanController;
use App\Http\Controllers\DataPembelianController;
use App\Http\Controllers\StockBahanController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\LaporanController;

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

Route::prefix('dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('transaksi')->group(function () {
        Route::get('/', function() {
            return redirect('/dashboard');
        });

        Route::get('penjualan', [DataPenjualanController::class, 'index']);
        Route::get('pembelian', [DataPembelianController::class, 'index']);
    });

    Route::get('/stock', [StockBahanController::class, 'index']);
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/activity', [UserActivityController::class, 'index']);

});

// Route::prefix('stock')->group(function () {
       
        
// });

// Route::prefix('laporan')->group(function () {
    
// });

// Route::prefix('activity')->group(function () {
   
// });

Route::prefix('laporan')->group(function () {
    Route::post('/', [LaporanController::class, 'FunctionName'])->name('download-laporan');
});

