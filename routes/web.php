<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
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

    Route::get('/user-mgt/{user}', [UserManagementController::class, 'show']);
    Route::get('/user-mgt', [UserManagementController::class, 'index']);
    Route::post('/user-mgt/roles', [UserManagementController::class, 'addRole']);
    Route::post('/user-mgt/permissions', [UserManagementController::class, 'addPermission']);
    Route::post('/user-mgt/users', [UserManagementController::class, 'addUser']);
    Route::put('/user-mgt/users/{user}', [UserManagementController::class, 'updateUser']);
    Route::patch('/user-mgt/users/{user}', [UserManagementController::class, 'changePassword']);
    Route::post('/user-mgt/toggle-activation/{user}', [UserManagementController::class, 'toggleUserActivation']);

    Route::get('/roles', [RolesController::class, 'index']);
    Route::post('/roles', [RolesController::class, 'store']);
    Route::put('/roles', [RolesController::class, 'update']);
    Route::delete('/roles', [RolesController::class, 'destroy']);

    Route::get('/permissions', [PermissionsController::class, 'index']);
    Route::post('/permissions', [PermissionsController::class, 'store']);
    Route::put('/permissions', [PermissionsController::class, 'update']);
    Route::delete('/permissions', [PermissionsController::class, 'destroy']);
});
