<?php

namespace App\Http\Controllers;

use App\Models\SubjectClass;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

    public function grading(SubjectClass $subjectClass) {

        if(auth()->user()->id != $subjectClass->teacher->user_id) {
            return back()->with('Error','Sorry! You are not the teacher of the subject you are trying to open.');
        }

        if(!$subjectClass->grading_names) {
            $subjectClass->update([
                'grading_names' => $subjectClass->term->getGradingNames()
            ]);
        }

        return view('teachers.subject-classes.grading', ['subjectClass'=>$subjectClass,'now'=>Carbon::now()]);

    }

    public function setGrade(SubjectClass $subjectClass, Request $request, $col) {
        if(auth()->user()->id != $subjectClass->teacher->user_id) {
            return back()->with('Error','Sorry! You are not the teacher of the subject you are trying to open.');
        }

        $count = count($request->grade);

        for($i=0; $i<$count; $i++) {
            DB::table('enrol_subjects')
                ->where('id', $request->enrol_subject_id[$i])
                ->update([
                    'g' . $col => $request->grade[$i]
                ]);
        }

        $gradeName = explode(',',$subjectClass->grading_names);

        return redirect('/teacher-classes/' . $subjectClass->id . '/grading')->with('Info','The ' . $gradeName[$col-1] . " grades have been updated.");
    }
}
