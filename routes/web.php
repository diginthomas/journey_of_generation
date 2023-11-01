<?php


use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PicnicController;
use App\Http\Controllers\Admin\QuoteController;
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
        Route::get('picnic/edit/{id}','editPicnic')->name('editPicnic');
        Route::get('picnic/view/{id}','viewPicnic')->name('viewPicnic');
        Route::post('picnic/delete','deletePicnic')->name('deletePicnic');

    });
    
    Route::controller(QuoteController::class)->group(function(){
        Route::get('quote','index')->name('quote');
        Route::post('quote/list','quoteList')->name('quoteList');
        Route::post('quote/save','saveQuote')->name('saveQuote');
        Route::post('quote/edit','editQuote')->name('editQuote');
        route::post('quote/delete','deleteQuote')->name('deleteQuote');
    });

});
