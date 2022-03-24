<?php

namespace App\Http\Controllers;

use App\Models\SubjectClass;
use App\Models\Term;
use Illuminate\Http\Request;

class TeacherClassesController extends Controller
{
    public function index() {
        $teacher = auth()->user()->teacherAccount;
        $subjectClasses = SubjectClass::where('teacher_id', $teacher->id)
                ->whereIn('term_id', Term::getActive()->pluck('id'))->get();

        return view('teachers.subject-classes.index', [
            'teacher' => $teacher,
            'subjectClasses' => $subjectClasses
        ]);
    }

    public function show(SubjectClass $subjectClass) {
        $teacher = auth()->user()->teacherAccount;

        if($subjectClass->teacher_id!=$teacher->id) {
            return back()->with('Error','Sorry! You are not the teacher of the class you are trying to open.');
        }

        return view('teachers.subject-classes.show', [
            'subjectClass' => $subjectClass
        ]);
    }
}
