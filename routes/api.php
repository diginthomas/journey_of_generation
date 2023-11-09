<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\SocialLoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::group(['middleware' => 'auth:sanctum'], function () {
//
// });
//
// Route::middleware('auth:sanctum')->group(function () {
//
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login/{provider}',[SocialLoginController::class,'redirectToProvider']);
Route::get('login/{provider}/callback',[SocialLoginController::class,'handleCallBack']);

Route::get('quotes',[QuoteController::class,'index']);
