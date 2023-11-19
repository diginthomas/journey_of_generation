<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PicnicController;
use App\Http\Controllers\Api\SeniorController;
use App\Http\Controllers\Api\VolunteerController;

Route::post('quote/list',[QuoteController::class,'index']);

Route::post('blog/list',[BlogController::class,'index']);
Route::post('blog/view',[BlogController::class,'view']);

Route::post('picnic/list',[PicnicController::class,'index']);
Route::post('picnic/view',[PicnicController::class,'view']);

Route::post('login',[LoginController::class,'index']);

Route::middleware('validate.token:sanctum')->group(function(){
    Route::post('logout',[LoginController::class,'logout']);
    Route::post('blog/like',[BlogController::class,'likeBlog']);
    Route::post('picnic/join',[PicnicController::class,'joinPicnic']);

    Route::controller(SeniorController::class)->group(function(){
        Route::post('senior/assistance/request','requestAssistance');
    })->middleware('senior');

    Route::controller(VolunteerController::class)->group(function(){
        Route::post('volunteer/assistance/list','getAssistanceList');
        Route::post('volunteer/assistance/accept','acceptAssistanceRequest');
        Route::post('volunteer/assistance/reject','rejectAssistance');
    })->middleware('volunteer');

});
