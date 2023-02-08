<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
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

// Route::post('notif/send', [NotifController::class, 'send']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
