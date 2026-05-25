<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\TransaksiTitipController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PengasuhController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\JadwalController;

Route::apiResource('anak', AnakController::class);
Route::apiResource('transaksi', TransaksiTitipController::class);
Route::apiResource('orangtua', OrangTuaController::class);
Route::apiResource('pengasuh', PengasuhController::class);
Route::apiResource('pembayaran', PembayaranController::class);
Route::apiResource('aktivitas', AktivitasController::class);
Route::apiResource('jadwal', JadwalController::class);