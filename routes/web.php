<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TermsController;
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

    Route::get('/students/create', [StudentController::class, 'create']);
    Route::get('/students/search', [StudentController::class, 'search']);
    Route::post('/students', [StudentController::class,'store']);
    Route::get('/students/{student}', [StudentController::class,'show']);
    Route::put('/students/{student}', [StudentController::class,'update']);
    Route::get('/students/edit/{student}', [StudentController::class,'edit']);
    Route::post('/students/educational-backgrounds/{student}', [StudentController::class, 'addEducationalBackground']);
    Route::put('/students/educational-backgrounds/{student}', [StudentController::class, 'updateEducationalBackground']);

    Route::get('/departments',[DepartmentController::class,'index']);
    Route::get('/departments/{department}',[DepartmentController::class,'show']);

    Route::get('/terms',[TermsController::class,'index']);
    Route::get('/terms/{term}', [TermsController::class, 'show']);
    Route::put('/terms/{term}', [TermsController::class, 'update']);

    Route::post('/periods', [PeriodController::class, 'store']);
    Route::put('/periods', [PeriodController::class, 'update']);
    Route::delete('/periods', [PeriodController::class,'destroy']);

    Route::get('/programs/create', [ProgramController::class, 'create']);
    Route::get('/programs/search', [ProgramController::class, 'search']);
    Route::post('/programs', [ProgramController::class, 'store']);
    Route::get('/programs/{program}', [ProgramController::class, 'show']);
    Route::put('/programs/{program}', [ProgramController::class, 'update']);
    Route::delete('/programs/{program}',[ProgramController::class, 'destroy']);

    Route::get('/courses/create', [CourseController::class,'create']);
    Route::get('/courses/search', [CourseController::class, 'search']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);

    Route::get('/teachers/create', [TeacherController::class,'create']);
    Route::get('/teachers/search', [TeacherController::class, 'search']);
    Route::post('/teachers', [TeacherController::class, 'store']);
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update']);
});
