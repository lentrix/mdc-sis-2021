<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function create() {
        $programList = Program::orderBy('full_name')->pluck('full_name','id')->toArray();
        $departmentList = Department::orderBy('name')->pluck('name','id')->toArray();
        $coursesList = Course::orderBy('name')->pluck('name','id')->toArray();

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

        $course = Course::create($request->all());

        return redirect('/courses/' . $course->id)->with('Info','This new course has been created');
    }

    public function show(Course $course) {
        $programList = Program::orderBy('full_name')->pluck('full_name','id')->toArray();
        $departmentList = Department::orderBy('name')->pluck('name','id')->toArray();
        $coursesList = Course::orderBy('name')->pluck('name','id')->toArray();

        return view('courses.view',[
            'course'=>$course,
            'coursesList' => $coursesList,
            'departmentList' => $departmentList,
            'programList' => $programList
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

        $course->update($request->all());

        return redirect('/courses/' . $course->id)->with('Info', 'This course has been updated');
    }
}
