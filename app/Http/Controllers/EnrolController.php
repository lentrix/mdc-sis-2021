<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Enrol;
use App\Models\EnrolSubject;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Student;
use App\Models\SubjectClass;
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

    public function edit(Enrol $enrol) {
        if($enrol->section_id==null) {
            return view('enrols.edit', [
                'enrol' => $enrol,
                'programs' => Program::orderBy('short_name')->pluck('short_name','id'),
                'levels'=>config('mdc.levels'),
                'terms'=>Term::getActive()->pluck('name','id'),
                'sections' => Section::orderBy('name')->pluck('name','id')
            ]);
        }else {
            return view('enrols.detach-section', [
                'enrol' => $enrol,
            ]);
        }
    }

    public function update(Enrol $enrol, Request $request) {
        $request->validate([
            'program_id' => 'numeric|required',
            'level' => 'string|required',
            'term_id' => 'numeric|required',
        ]);

        $enrol->update($request->all());

        return redirect('/enrols/' . $enrol->id)->with('Info','Enrollment details updated.');
    }

    public function attachSection(Enrol $enrol, Request $request) {
        $section = Section::findOrFail($request->section_id);

        //remove all enrolled subjects from this enrollment
        EnrolSubject::where('enrol_id', $enrol->id)->delete();

        $enrol->update([
            'program_id' => $section->program_id,
            'level' => $section->level,
            'term_id' => $section->term_id,
            'section_id' => $section->id
        ]);

        //add enrolled subjects...
        foreach($section->classSections as $classSection) {
            EnrolSubject::create([
                'enrol_id' => $enrol->id,
                'subject_class_id' => $classSection->subject_class_id,
                'created_by' => auth()->user()->id
            ]);
        }

        return redirect('/enrols/' . $enrol->id)->with('Info','This enrollment has been attached to a section.');
    }

    public function detachSection(Enrol $enrol) {

        $sectionName = $enrol->section->name;

        //delete enrolled subjects
        EnrolSubject::where('enrol_id', $enrol->id)->delete();

        $enrol->update([
            'section_id'=>null
        ]);

        return redirect('/enrols/edit/' . $enrol->id)->with('Info','This enrollment has been detached from section ' . $sectionName);

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

    public function store(Request $request, Student $student) {
        $request->validate([
            'program_id' => 'numeric|required',
            'level' => 'string|required',
            'term_id' => 'numeric|required',
        ]);

        $prog = Program::findOrFail($request->program_id);

        if(!$prog->checkLevel($request->level)) {
            return back()->with('Error','The program and level combination does not seem to be correct. Please check and try again.')->withInput();
        }

        $user = auth()->user();

        $enrol = Enrol::create([
            'student_id' => $student->id,
            'program_id' => $prog->id,
            'level' => $request->level,
            'term_id' => $request->term_id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        return redirect('/enrols/edit/' . $enrol->id)->with('Info','A new enrollment has been made.');
    }

    public function addBySerial(Enrol $enrol, Request $request) {
        $errors = [];

        $serials = explode(",", $request->serials);

        foreach($serials as $serial) {
            $serial = trim($serial);

            $subjectClass = SubjectClass::find($serial);

            if(!$subjectClass) {
                $errors[] = "Serial# " . $serial . " is invalid.";
                continue;
            }

            if($error = $this->addClass($enrol, $subjectClass)) {
                $errors[] = $error;
            }
        }

        if(count($errors)>0) {
            $errorMessage = "<ul>";

            foreach($errors as $error) {
                $errorMessage .= "<li>" . $error . "</li>";
            }

            $errorMessage .= "</li>";
        }


        return redirect('/enrols/' . $enrol->id)->with('Error', 'Errors during insertion: ' . $errorMessage);
    }

    private function addClass(Enrol $enrol, SubjectClass $class) {

        if($sched = Schedule::checkEnrolConflict($enrol, $class)) {
            return "This class " . $class->course->name . " is in conflict with "
                . $sched->subjectClass->course->name . " "
                . $sched->summary;
        }

        if($class->section) {
            return "This class " . $class->course->name . " is assigned to a section.";
        }

        EnrolSubject::create([
            'enrol_id' => $enrol->id,
            'subject_class_id' => $class->id,
            'created_by' => auth()->user()->id
        ]);

        return false;
    }
}
