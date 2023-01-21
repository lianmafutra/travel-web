<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  
   return view('welcome');
})->name('index');

Auth::routes([
   'register'  => false,
   'reset'     => false,
   'confirm'   => false
]);

Route::middleware(['auth'])->get('/home', [DashboardController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {
   Route::get('/', [DashboardController::class, 'index'])->name('admin');
   Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

 
  

   Route::controller(UserController::class)->group(function () {
      Route::get('user', 'index')->middleware(['permission:read user'])->name('user.index');
      Route::get('user/profile', 'profile')->name('profile.index');
      Route::put('user/profile/foto', 'ubah_foto')->name('profile.foto.ubah');
      Route::post('user', 'store')->middleware(['permission:create user'])->name('user.store');
      Route::post('user/show', 'show')->middleware(['permission:read user'])->name('user.show');
      Route::put('user', 'update')->middleware(['permission:update user'])->name('user.update');
      Route::delete('user', 'destroy')->middleware(['permission:delete user'])->name('user.destroy');
   });

   Route::controller(RoleController::class)->group(function () {
      Route::get('role', 'index')->middleware(['permission:read role'])->name('role.index');
      Route::post('role', 'store')->middleware(['permission:create role'])->name('role.store');
      Route::post('role/show', 'show')->middleware(['permission:read role'])->name('role.show');
      Route::put('role', 'update')->middleware(['permission:update role'])->name('role.update');
      Route::delete('role', 'destroy')->middleware(['permission:delete role'])->name('role.destroy');
   });

   Route::controller(PermissionController::class)->group(function () {
      Route::get('permission', 'index')->middleware(['permission:read permission'])->name('permission.index');
      Route::post('permission', 'store')->middleware(['permission:create permission'])->name('permission.store');
      Route::post('permission/show', 'show')->middleware(['permission:read permission'])->name('permission.show');
      Route::put('permission', 'update')->middleware(['permission:update permission'])->name('permission.update');
      Route::delete('permission', 'destroy')->middleware(['permission:delete permission'])->name('permission.destroy');
      Route::get('permission/reload', 'reloadPermission')->middleware(['permission:create permission'])->name('permission.reload');
   });


   Route::controller(SettingController::class)->group(function () {
      Route::get('setting', 'index')->middleware(['permission:read setting'])->name('setting.index');
      Route::post('setting', 'store')->middleware(['permission:create setting'])->name('setting.store');
      Route::post('setting/show', 'show')->middleware(['permission:read setting'])->name('setting.show');
      Route::put('setting', 'update')->middleware(['permission:update setting'])->name('setting.update');
      Route::delete('setting', 'destroy')->middleware(['permission:delete setting'])->name('setting.destroy');
   });

   Route::controller(AuthController::class)->group(function () {
      Route::put('password-ubah', 'ubahPassword')->name('password.ubah');
   });




});
