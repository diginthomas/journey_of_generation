<?php


use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PicnicController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SeniorController;
use App\Http\Controllers\Admin\VolunteerController;
use App\http\Controllers\Admin\WalkGoalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth')->group(function () {

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::group(['controller' => DashboardController::class], function(){
        Route::get('dashboard', 'index')->name('dashBoard');
        Route::post('dashboard/latest/picnic', 'getPicnic')->name('getLatestPicnic');
    });

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
        Route::post('picnic/view/members','viewPicnicMembers')->name('viewPicnicMembers');
     });

     Route::controller(QuoteController::class)->group(function(){
        Route::get('quote','index')->name('quote');
        Route::post('quote/list','quoteList')->name('quoteList');
        Route::post('quote/save','saveQuote')->name('saveQuote');
        Route::post('quote/edit','editQuote')->name('editQuote');
        route::post('quote/delete','deleteQuote')->name('deleteQuote');
    });
     Route::controller(BlogController::class)->group(function(){
        Route::get('blogs','index')->name('blogs');
        Route::post('blogs/data','blogsData')->name('blogsData');
        Route::get('blog/add','addBlog')->name('addBlog');
        Route::post('blog/save','saveBlog')->name('saveBlog');
        Route::get('blog/{id}/edit','editBlog')->name('editBlog');
        Route::get('blog/{id}/view','viewBlog')->name('viewBlog');
        Route::delete('blog/delete','deleteBlog')->name('deleteBlog');
     });
     Route::controller(SeniorController::class)->group(function(){
         Route::get('seniors','index')->name('seniors');
         Route::post('seniors/list','seniorList')->name('seniorList');

     });
     Route::controller(VolunteerController::class)->group(function(){
        Route::get('volunteers','index')->name('volunteers');
        Route::post('volunteers/list','volunteerList')->name('volunteerList');

    });
    Route::controller(WalkGoalController::class)->group(function(){
        Route::get('walk','index')->name('walk');
        Route::post('walk/list','walkList')->name('walkList');
    });


    });
