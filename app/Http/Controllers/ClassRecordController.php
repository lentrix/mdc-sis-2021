<?php

namespace App\Http\Controllers;

use App\Models\ClassRecord;
use App\Models\ScoreColumn;
use App\Models\SubjectClass;
use Illuminate\Http\Request;

class ClassRecordController extends Controller
{
    public function createClassRecord(SubjectClass $subjectClass) {

        if($subjectClass->classRecord) {
            return back()->with('Error','This subject class already have a Class Record.');
        }

        $classRecord = ClassRecord::create([
            'subject_class_id' => $subjectClass->id,
            'remarks' => '-'
        ]);

        return redirect('/teacher-classes/' . $subjectClass->id . '/class-record')->with('Info','New class record has been created.');
    }

    public function showClassRecord(SubjectClass $subjectClass) {
        $gradingPeriods = [];

        foreach($subjectClass->term->periods as $period){
            $gradingPeriods[$period->id] = $period->name;
        }

        return view('teachers.class-record.show',[
            'subjectClass' => $subjectClass,
            'gradingPeriods' => $gradingPeriods
        ]);
    }

    public function addColumn(Request $request, SubjectClass $subjectClass) {
        $request->validate([
            'period_id' => 'numeric|required',
            'name' => 'string|required',
            'weight' => 'numeric|required',
            'total' => 'numeric|required'
        ]);


        ScoreColumn::create([
            'class_record_id' => $subjectClass->classRecord->id,
            'period_id' => $request->period_id,
            'name' => $request->name,
            'weight' => $request->weight,
            'total' => $request->total,
        ]);

        return redirect('/teacher-classes/' . $subjectClass->id . '/class-record')->with('Info','A score column has been added.');
    }
}
