<?php

use App\Http\Controllers\APIController;
use App\Models\Course;
use App\Models\SubjectClass;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/course-search/{text}", [APIController::class, 'courseSearch']);

Route::get('/offerings/{course}', [APIController::class, 'offeringsByCourse']);

Route::get('/sections/{department}', [APIController::class, 'sectionByDepartment']);

Route::get('/subject-classes/search/{key}', [APIController::class, 'searchSubjectClass']);
