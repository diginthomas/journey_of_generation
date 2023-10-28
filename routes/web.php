<?php

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
 use App\Http\Controllers\Admin\LoginController;
 use App\Http\Controllers\Admin\DashboardController;
 use App\Http\Controllers\Admin\ProfileController;


Route::get('/',[LoginController::class,'index'] )->name('login');
Route::post('login',[LoginController::class,'authenticate'])->name('authenticate');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashBoard');
    Route::get('logout', [LoginController::class,'logout'])->name('logout');

    Route::controller(ProfileController::class)->group(function(){
      Route::get('profile', 'index')->name('profile');
      Route::get('profile/edit', 'edit')->name('editProfile');
      Route::post('profile/update', 'update')->name('updateProfile');
      Route::post('profile/change/password', 'changePassword')->name('changePassword');
    });

});
