<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/','Controller');

Route::get('/', [SiteController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware'=>'auth'], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard',[SiteController::class, 'dashboard']);
    Route::get('/users/profile', [UserController::class,'profile']);
    Route::post('/users/profile', [UserController::class,'update']);
    Route::get('/users/change-password', [UserController::class, 'changePasswordForm']);
    Route::post('/users/change-password', [UserController::class, 'changePassword']);
});
