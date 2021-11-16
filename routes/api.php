<?php

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

Route::get("/course-search/{text}", function($text) {
    $courses = Course::where('name','like',"%$text%")
            ->orWhere('description','like',"%$text%")
            ->select('id','name','description')
            ->get();
    return response()->json($courses);
});

Route::get('/offerings/{course}', function(Course $course) {
    $subjectClasses = SubjectClass::whereIn('term_id', Term::getActive()->select('id')->get())
            ->where('course_id', $course->id)
            ->with('course')
            ->with('schedules')
            ->with('teacher')
            ->get();

    $data = [];

    foreach($subjectClasses as $sc) {
        $data[] = [
            'id' => $sc->id,
            'name' => $sc->course->name,
            'description' => $sc->course->description,
            'schedule' => $sc->scheduleString,
            'teacher' => $sc->teacher->name
        ];
    }

    if(count($subjectClasses)==0) {
        return false;
    }

    return response()->json($data);
});
