<?php

namespace App\Http\Controllers;

use App\Models\Enrol;
use App\Models\SubjectClass;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class PrintablesController extends Controller
{
    public function classList(SubjectClass $subjectClass) {
        $pdf = Pdf::loadView('pdf.class-list',[
            'subjectClass'=>$subjectClass
        ]);

        return $pdf->stream();
        // return view('pdf.class-list', ['subjectClass'=>$subjectClass]);
    }

    public function teachingLoad(Teacher $teacher) {
        $subjectClasses = SubjectClass::where('teacher_id', $teacher->id)
                ->whereIn('term_id', Term::getActive()->pluck('id'))->get();

        $pdf = Pdf::loadView('pdf.teaching-load', [
            'teacher' => $teacher,
            'subjectClasses'=>$subjectClasses,
            'now' => Carbon::now()->format('F d, Y g:i A')
        ]);

        return $pdf->stream();
    }

    public function studyLoad(Enrol $enrol) {
        $pdf = Pdf::loadView('pdf.study-load',[
            'enrol' => $enrol,
            'now' => Carbon::now()->format('F d, Y g:i A')
        ]);

        return $pdf->stream();
    }
}
