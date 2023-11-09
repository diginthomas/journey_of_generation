<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PicnicController;


Route::post('quote/list',[QuoteController::class,'index']);

Route::post('blog/list',[BlogController::class,'index']);
Route::post('blog/view',[BlogController::class,'view']);

Route::post('picnic/list',[PicnicController::class,'index']);
Route::post('picnic/view',[PicnicController::class,'view']);

Route::post('login',[LoginController::class,'index']);

Route::middleware('validate.token:sanctum')->group(function(){
    Route::post('blog/like',[BlogController::class,'likeBlog']);
    Route::post('picnic/join',[PicnicController::class,'joinPicnic']);

});
