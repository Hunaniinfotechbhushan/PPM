<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LinkedinSocialiteController;



Route::group(['middleware' => 'admin','middleware' => 'auth','prefix' => 'admin'], function(){
    // Route::get('/', [App\Http\Controllers\backend\AdminController::class, 'index'])->name('admin');

    Route::resource('new-signup', backend\NewSignUpController::class);
    Route::post('change-password', [App\Http\Controllers\backend\ProfileController::class, 'changePassword'])->name('change-password');
    Route::resource('profile', App\Http\Controllers\backend\ProfileController::class);

});



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/sitemap.xml',[App\Exp\Components\Sitemap\Controllers\SitemapController::class, 'index'])->name('sitemap.index');
