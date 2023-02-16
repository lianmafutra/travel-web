<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\LokasiController;
use App\Http\Controllers\API\PesananController;
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
Route::get('pesanan/detail/bayar', [PesananController::class, 'detailPesanan']);
// Route::post('notif/send', [NotifController::class, 'send']);
Route::middleware(['auth:api'])->group(function () {
   Route::get('lokasi', [LokasiController::class, 'getLokasi']);
   Route::get('user/detail', [UserController::class, 'getUserDetail']);
   Route::post('jadwal/lokasi', [JadwalController::class, 'getJadwalByLokasi']);
   Route::get('jadwal/{id}', [JadwalController::class, 'getJadwalDetail']);
   Route::post('pesanan/review', [PesananController::class, 'kirimReview']);
   Route::get('pesanan/mobil/{id}/review', [PesananController::class, 'listReviewByMobil']);
 


 

});

