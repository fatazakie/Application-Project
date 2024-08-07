<?php

use App\Http\Controllers\BarangController;
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
Route::post('/barang/form/', [BarangController::class, 'store']);
Route::get('/barang/edit/{id}', [BarangController::class, 'edit']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);


Route::get('pembelian', [PembelianController::class, 'index']);
Route::get('/pembelian/form/', [PembelianController::class, 'create']);
Route::post('/pembelian/form/', [PembelianController::class, 'store']);
Route::get('/pembelian/edit/{id}', [PembelianController::class, 'edit']);
Route::put('/pembelian/{id}', [PembelianController::class, 'update']);
Route::delete('/pembelian/{id}', [PembelianController::class, 'destroy']);


Route::get('penjualan', [PenjualanController::class, 'index']);
Route::get('/penjualan/form/', [PenjualanController::class, 'create']);
Route::post('/penjualan/form/', [PenjualanController::class, 'store']);
Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit']);
Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);
Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']);


Route::get('report', [ReportController::class, 'index']);
Route::get('/report/form/', [ReportController::class, 'create']);
Route::post('/report/form/', [ReportController::class, 'store']);
Route::get('/report/edit/{id}', [ReportController::class, 'edit']);
Route::put('/report/{id}', [ReportController::class, 'update']);
Route::delete('/report/{id}', [ReportController::class, 'destroy']);


