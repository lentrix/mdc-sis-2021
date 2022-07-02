<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Program;
use App\Models\SubjectClass;
use App\Models\Term;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct() {
        $this->middleware('role:registrar,head');
    }

    public function create() {
        $programList = Program::orderBy('full_name')->pluck('full_name','id');
        $departmentList = Department::orderBy('accronym')->pluck('name','id');
        $coursesList = Course::orderBy('description')->pluck('description','id')->toArray();

        return view('courses.create',[
            'programList' => $programList,
            'departmentList' => $departmentList,
            'coursesList' => $coursesList
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'credit' => 'numeric|required',
            'department_id' => 'numeric|required'
        ]);

        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'credit' => $request->credit,
            'department_id' => $request->department_id,
            'requisite_course' => $request->requisite_course,
            'program_id' => $request->program_id,
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect('/courses/' . $course->id)->with('Info','This new course has been created');
    }

    public function show(Course $course) {
        $programList = Program::orderBy('full_name')->pluck('full_name','id')->toArray();
        $departmentList = Department::orderBy('name')->pluck('name','id')->toArray();
        $coursesList = Course::orderBy('name')->pluck('name','id')->toArray();

        $offerings = SubjectClass::whereIn('term_id', Term::getActive()->select('id')->get())
                        ->where('course_id', $course->id)->get();

        return view('courses.view',[
            'course'=>$course,
            'coursesList' => $coursesList,
            'departmentList' => $departmentList,
            'programList' => $programList,
            'offerings' => $offerings
        ]);
    }

    public function search(Request $request) {
        $courses = Course::with('department');

        $hasSearch = false;

        if($request->name) {
            $courses->where('name','like',"%$request->name%");
            $hasSearch = true;
        }
        if($request->description) {
            $courses->where('description','like',"%$request->description%");
            $hasSearch=true;
        }

        if($hasSearch) {
            $courses->orderBy('name');
        }else {
            $courses->orderBy('updated_at','desc')->limit(10);
        }

        return view('courses.search',[
            'courses' => $courses->get(),
            'hasSearch' => $hasSearch
        ]);
    }

    public function update(Course $course, Request $request) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'credit' => 'numeric|required',
            'department_id' => 'numeric|required'
        ]);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'credit' => $request->credit,
            'department_id' => $request->department_id,
            'requisite_course' => $request->requisite_course,
            'program_id' => $request->program_id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect('/courses/' . $course->id)->with('Info', 'This course has been updated');
    }
}
