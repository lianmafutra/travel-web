<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\LokasiController;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;

use Illuminate\Support\Facades\Route;

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

Route::post('user/register', [AuthController::class, 'register']);
Route::post('user/login', [AuthController::class, 'login'])->name('login');
Route::put('user/password/lupa', [AuthController::class, 'lupaPassword']);
Route::get('jadwal/kursi/{id_jadwal}', [JadwalController::class, 'showKursi']);
Route::get('pesanan/detail/bayar', [PesananController::class, 'bayar']);
Route::post('pesanan/detail/upload_bukti', [PesananController::class, 'uploadBukti']);
Route::get('pesanan/detail/konfirmasi', [PesananController::class, 'konfirmasi']);
Route::get('pesanan/detail/verifikasi', [PesananController::class, 'detailVerifikasi']);

// Route::post('notif/send', [NotifController::class, 'send']);
Route::middleware(['auth:api'])->group(function () {
   
   Route::get('lokasi', [LokasiController::class, 'getLokasi']);
   Route::get('user/detail', [UserController::class, 'getUserDetail']);
   Route::post('user/password/update', [AuthController::class, 'updatePassword']);
   Route::post('user/profil/update', [UserController::class, 'updateProfil']);
   Route::post('user/profil/foto/update', [UserController::class, 'updateFoto']);
   Route::post('user/token/fcm', [UserController::class, 'storeTokenFCM']);

   Route::post('jadwal/lokasi', [JadwalController::class, 'getJadwalByLokasi']);
   Route::get('jadwal/{id}', [JadwalController::class, 'getJadwalDetail']);

   Route::post('pesanan/review', [ReviewController::class, 'kirimReview']);
   Route::get('pesanan/detail/{kode_pesanan}', [PesananController::class, 'detail']);
   Route::get('pesanan/mobil/{id}/review', [ReviewController::class, 'listReviewByMobil']);

   Route::post('user/pesanan', [PesananController::class, 'buatPesanan']);
   Route::post('user/pesanan/batalkan', [PesananController::class, 'batalkanPesanan']);
   Route::get('user/pesanan/list', [PesananController::class, 'listPesananByUser']);

   Route::get('pesanan/notif/count', [PesananController::class, 'getNotifCount']);


 
 


 

});

