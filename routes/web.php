<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReportController;
use App\Models\barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     Route::get('barang', [BarangController::class, 'index']);



// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('barang', [BarangController::class, 'index']);
Route::get('/barang/form/', [BarangController::class, 'create']);
Route::post('/barang/form/', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/edit/{id}', [BarangController::class, 'edit']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);


Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/pembelian/form/', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/pembelian/form/', [PembelianController::class, 'store'])->name('pembelian.store');
Route::get('/pembelian/edit/{id}', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('/pembelian/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');



Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/form', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan/form', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');



Route::get('hutang', [HutangController::class, 'index']);
Route::get('/hutang/form/', [HutangController::class, 'create']);
Route::post('/hutang/form/', [HutangController::class, 'store'])->name('hutang.store');
Route::get('/hutang/edit/{id}', [HutangController::class, 'edit']);
Route::put('/hutang/{id}', [HutangController::class, 'update']);
Route::delete('/hutang/{id}', [HutangController::class, 'destroy']);


Route::get('report', [ReportController::class, 'index']);
Route::get('/report/cetak', [ReportController::class, 'cetak'])->name('report.cetak');
Route::get('/report/print', [ReportController::class, 'print'])->name('report.print');

Route::get('/report/sinkron', [App\Http\Controllers\ReportController::class, 'sinkron'])->name('report.sinkron');
