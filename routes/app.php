<?php

use App\Http\Controllers\Harga\HargaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Kendaraan\JenisMobilController;
use App\Http\Controllers\Kendaraan\MobilController;
use App\Http\Controllers\Kendaraan\PemilikController;
use App\Http\Controllers\Kendaraan\SupirController;
use App\Http\Controllers\KursiMobilController;
use App\Http\Controllers\KustomerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {

   Route::prefix('kendaraan')->group(function () {
      Route::resource('mobil', MobilController::class);
      Route::resource('pemilik', PemilikController::class);
      Route::resource('supir', SupirController::class);
      Route::resource('jenis-mobil', JenisMobilController::class);
   });

   Route::resource('harga', HargaController::class);
   Route::resource('lokasi', LokasiController::class);
   Route::resource('jadwal', JadwalController::class);
   Route::resource('kustomer', KustomerController::class);
   Route::resource('rekening', RekeningController::class);

   Route::get('review/index', [ReviewController::class, 'index'])->name('review.index');
   Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');

   Route::controller(PesananController::class)->group(function () {
      Route::resource('pesanan', PesananController::class);
      Route::put('pesanan/update/verifikasi', 'updateVerifikasiPembayaran')->name('pesanan.pembayaran.verifikasi');
      Route::put('pesanan/update/status_pesanan', 'updateStatusPesanan')->name('pesanan.status');
      Route::get('pesanan/detail/{id_pesanan}', 'detail')->name('pesanan.detail');
   });

});

Route::prefix('admin')->group(function () {
   Route::controller(KursiMobilController::class)->group(function () {
      Route::get('kursi_mobil/{mobil_id}', 'index')->name('kursi_mobil.index');
      Route::get('kursi_mobil/edit/{kursi_mobil_id}', 'edit')->name('kursi_mobil.edit');
      Route::post('kursi_mobil/store', 'store')->name('kursi_mobil.store');
      Route::post('kursi_mobil/update/kolom', 'updateKolom')->name('kursi_mobil.update.kolom');
      Route::delete('kursi_mobil/destroy/{kursi_mobil_id}', 'destroy')->name('kursi_mobil.destroy');
   });
  
});




