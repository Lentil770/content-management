<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryIndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReadingsIndexController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\VideoIndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);


Route::get('login', LoginController::class . '@index')->name('login');
Route::get('login/{provider}', LoginController::class . '@redirectToProvider')->name('login.provider');
Route::get('google/callback', LoginController::class . '@handleProviderCallback');

// routes user needs to be logged in for
Route::group(['middleware' => 'auth'], function () {

    // setup view permissions once live
    // Route::group(['middleware' => 'can:reading-view'], function () {
        Route::resource('readings', ReadingsIndexController::class);
        
        Route::get('/upload/{uploadType}', [UploadController::class, 'index']);
        Route::post('/upload/readings', [UploadController::class, 'uploadReadings'])->name('upload.readings');
        Route::post('/upload/library', [UploadController::class, 'uploadLibrary'])->name('upload.library');
        Route::post('/upload/videos', [UploadController::class, 'uploadVideos'])->name('upload.videos');
    // });

    Route::resource('videos', VideoIndexController::class);

    Route::resource('library', LibraryIndexController::class);
    
    // misc internal routes
    Route::get('/backupdb', [HomeController::class, 'backupdb']);

    Route::get('/', [HomeController::class, 'index']);
    
    Route::redirect('/home', '/');
}); 
