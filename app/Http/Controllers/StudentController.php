<?php

namespace App\Http\Controllers;

use App\Models\EducationalBackground;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct() {
        $this->middleware('role:registrar')->only('create','store','update','addEducationalBackground','updateEducationalBackground');
        $this->middleware('role:head,registrar')->only('show','search');
    }

    public function create() {

        return view('students.create');
    }

    public function store(Request $request) {
        $request->validate([
            'id_number' => 'numeric|required|unique:students',
            'last_name' => 'string|required',
            'first_name' => 'string|required',
            'middle_name' => 'string|required',
            'sex' => 'string|required',
            'birth_date' => 'date|required',
        ]);

        $stud = Student::create($request->all());

        if(!$stud) {
            return back()->with('Error','There was a serious problem. Unable to create the student.');
        }

        return redirect('/students/' . $stud->id)->with('Info','New student record has been created.');
    }

    public function show(Student $student) {
        return view('students.show',[
            'student' => $student
        ]);
    }

    public function edit(Student $student) {
        return view('students.edit',[
            'student'=>$student
        ]);
    }

    public function update(Student $student, Request $request) {
        $request->validate([
            'id_number' => 'numeric|required',
            'last_name' => 'string|required',
            'first_name' => 'string|required',
            'middle_name' => 'string|required',
            'sex' => 'string|required',
            'birth_date' => 'date|required',
        ]);

        $student->update($request->all());

        return redirect('/students/' . $student->id)->with('Info','This student information has been updated');
    }

    public function addEducationalBackground(Student $student, Request $request) {
        $request->validate([
            'level' => 'string|required',
            'school' => 'string|required',
            'address' => 'string|required',
            'year' => 'numeric|required',
        ]);

        EducationalBackground::create([
            'student_id' => $student->id,
            'level' => $request->level,
            'degree' => $request->degree,
            'school' => $request->school,
            'address' => $request->address,
            'year' => $request->year,
            'remarks' => $request->remarks,
        ]);

        return redirect('/students/' . $student->id)->with('Info','A new educational background has been added');
    }

    public function updateEducationalBackground(Student $student, Request $request) {
        $request->validate([
            'level' => 'string|required',
            'school' => 'string|required',
            'address' => 'string|required',
            'year' => 'numeric|required',
        ]);

        $educationalBackground = EducationalBackground::findOrFail($request->id);

        $educationalBackground->update([
            'student_id' => $student->id,
            'level' => $request->level,
            'degree' => $request->degree,
            'school' => $request->school,
            'address' => $request->address,
            'year' => $request->year,
            'remarks' => $request->remarks,
        ]);

        return redirect('/students/' . $student->id)->with('Info','An entry in the educational background have been updated');
    }

    public function search(Request $request) {

        $students = Student::orderBy('updated_at','desc');

        if($request->last_name) {
            $students->where('last_name','like',"%$request->last_name%");
        }
        if($request->first_name) {
            $students->where('first_name','like',"%$request->first_name%");
        }
        if($request->middle_name) {
            $students->where('middle_name','like',"%$request->middle_name%");
        }

        return view('students.search',[
            'students' => $students->limit(100)->get()
        ]);
    }
}
