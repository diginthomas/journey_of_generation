<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\BlogController;


Route::post('quotes',[QuoteController::class,'index']);
Route::post('blogs',[BlogController::class,'index']);

Route::post('login',[LoginController::class,'index']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('blogs/like',[BlogController::class,'likeBlog']);

});
