<?php


use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PicnicController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashBoard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(ProfileController::class)->group(function(){
        Route::get('profile', 'index')->name('profile');
        Route::get('profile/edit', 'edit')->name('editProfile');
        Route::post('profile/update', 'update')->name('updateProfile');
        Route::post('profile/change/password', 'changePassword')->name('changePassword');
      });

     Route::controller(PicnicController::class)->group(function(){
        Route::get('picnic','index')->name('picnic');
        Route::post('picnic/list','picnicList')->name('picnicList');
        Route::get('picnic/add','addPicnic')->name('addPicnic');
        Route::post('picnic/save','savePicnic')->name('savePicnic');
        Route::get('picnic/update/{picnic_id}','editPicnic')->name('editPicnic');
        Route::get('picnic/view/{picnic_id','viewPicnic')->name('viewPicnic');
     });

});
