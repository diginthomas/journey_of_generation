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

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('editProfile');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('updateProfile');
    Route::post('profile/change/password', [ProfileController::class, 'changePassword'])->name('changePassword');

    Route::get('picnic',[PicnicController::class,'index'])->name('picnic');
    Route::post('picnic\list',[PicnicController::class,'picnicList'])->name('picnicList');
    Route::get('picnic\add',[PicnicController::class,'addPicnic'])->name('addPicnic');
    Route::post('picnic\save',[PicnicController::class,'savePicnic'])->name('savePicnic');
    Route::get('picnic\update\{picnic_id}',[PicnicController::class,'editPicnic'])->name('editPicnic');
    Route::get('picnic\view\{picnic_id',[PicnicController::class,'viewPicnic'])->name('viewPicnic');

});
