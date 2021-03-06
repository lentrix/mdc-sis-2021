<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Section;
use App\Models\SubjectClass;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function offeringsByCourse(Course $course) {
        $subjectClasses = SubjectClass::whereIn('term_id', Term::getEnrolling()->select('id')->get())
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
    }

    public function courseSearch($text) {
        $courses = Course::where('name','like',"%$text%")
                ->orWhere('description','like',"%$text%")
                ->select('id','name','description')
                ->get();
        return response()->json($courses);
    }

    public function sectionByDepartment(Department $department) {
        $sections = Section::where('department_id', $department->id)
                ->with('program')->with('adviser')
                ->orderBy('name')->get();

        return response()->json($sections);
    }

    public function searchSubjectClass($key) {
        $subjectClasses = SubjectClass::whereIn('term_id', Term::getEnrolling()->select('id')->get())
            ->whereHas('course', function($query) use ($key) {
            $query->where('name','like',"%$key%")
                ->orWhere('description','like',"%$key%");
        })->get();

        return response()->json($subjectClasses);
    }

    public function singleUser(User $user) {
        return response()->json($user);
    }
}
