<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Enrol;
use App\Models\EnrolSubject;
use App\Models\Program;
use App\Models\Section;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;

class EnrolController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:registrar');
    }

    public function index(Request $request) {
        $enrols = Enrol::whereIn('term_id', Term::getActive()->select('id')->get());

        if(isset($request->key)) {
            $enrols->whereHas('student', function($query) use ($request) {
                $query->where('lname','like',"%$request->key%")
                    ->orWhere('fname','like',"%$request->key%")
                    ->orWhere('idnum','like',"%$request->key%");
            })->orderBy('lname')->orderBy('fname');
        }else {
            $enrols->orderBy('updated_at', 'DESC');
        }

        return view('enrols.index', [
            'enrols'=>$enrols->get()
        ]);

    }

    public function current(Student $student) {
        $current = null;
        if($current = $student->currentEnrollment()) {
            return view('enrols.show', [
                'enrol' => $current,
            ]);
        }

        return view('enrols.create',[
            'programs' => Program::orderBy('full_name')->pluck('full_name','id'),
            'terms' => Term::getActive()->pluck('name','id'),
            'departments' => Department::orderBy('name')->pluck('name','id'),
            'student' => $student
        ]);
    }

    public function history(Student $student) {
        $enrols = Enrol::where('student_id', $student->id)
                ->orderBy('created_at','DESC')->get();
        return view('enrols.history',[
            'enrols' => $enrols,
            'student' => $student
        ]);
    }

    public function enrolToSection(Student $student, Request $request) {
        $section = Section::findOrFail($request->section_id);

        $user = auth()->user();

        $enrol = Enrol::create([
            'student_id' => $student->id,
            'program_id' => $section->program_id,
            'term_id' => $section->term_id,
            'level' => $section->level,
            'section_id' => $section->id,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        //add classes based on classSections
        foreach($section->classSections as $classSection) {
            EnrolSubject::create([
                'enrol_id' => $enrol->id,
                'subject_class_id' => $classSection->subject_class_id,
                'created_by' => $user->id
            ]);
        }

        return redirect('/enrols/' . $enrol->id)->with('Info','The student has been enrolled successfully');
    }

    public function show(Enrol $enrol) {
        return view('enrols.show',[
            'enrol'=>$enrol
        ]);
    }

    public function search(Request $request) {
        $enrols = Enrol::whereIn('term_id', Term::getActive()->select('id')->get())
            ->with('student')
            ->with('program')
            ->orderBy('updated_at','DESC');

        $programs = Program::orderBy('short_name')->pluck('short_name', 'id');

        if($lname = $request?->last_name) {
            $enrols->whereHas('student', function($query) use ($lname) {
                $query->where('last_name','like',"%$lname%");
            });
        }

        if($fname = $request?->first_name) {
            $enrols->whereHas('student', function($query) use ($fname) {
                $query->where('first_name','like',"%$fname%");
            });
        }

        if($program_id = $request?->program_id) {
            $enrols->where('program_id', $program_id);
        }

        if($level = $request?->level) {
            $enrols->where('level', $level);
        }

        $enrols->limit(50);

        return view('enrols.search',[
            'enrols' => $enrols->get(),
            'request' => $request,
            'programs' => $programs,
            'levels' => config('mdc.levels')
        ]);
    }
}
