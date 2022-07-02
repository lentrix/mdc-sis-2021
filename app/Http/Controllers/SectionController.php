<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Course;
use App\Models\Department;
use App\Models\Enrol;
use App\Models\EnrolSubject;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\SubjectClass;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:head')->except(['index','show']);
        $this->middleware('section-owner')->only('update','addSubjectClass','removeSubjectClass');
    }

    public function index(Request $request) {
        $sections = Section::whereIn('term_id', Term::getEnrolling()->select('id')->get())
            ->orderBy('department_id');

        if($request->deparment) {
            $sections->where('department_id', $request->department);
        }

        return view('sections.index',[
            'sections' => $sections->get(),
            'department_id' => $request->department_id,
            'departmentList' => Department::headedBy(auth()->user())->orderBy('accronym')->pluck('name','id'),
            'termsList' => Term::getEnrolling()->pluck('name','id'),
            'programsList' => Program::whereIn('department_id', Department::headedBy(auth()->user())->select('id')->get() )->orderBy('full_name')->pluck('full_name','id'),
            'teachersList' => Teacher::orderBy('name')->pluck('name','id')
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'department_id' => 'numeric|required',
            'term_id' => 'numeric|required',
            'program_id' => 'numeric|required',
            'teacher_id' => 'numeric|required',
            'level' => 'string|required',
            'name' => 'string|required',
        ]);

        $section = Section::create($request->all());

        return redirect('/sections/'.$section->id)->with('Info','New section created successfully');
    }

    public function show(Section $section) {

        return view('sections.show', [
            'section'=>$section,
            'departmentList' => Department::headedBy(auth()->user())->orderBy('accronym')->pluck('name','id'),
            'termsList' => Term::getEnrolling()->pluck('name','id'),
            'programsList' => Program::whereIn('department_id', Department::headedBy(auth()->user())->select('id')->get() )->orderBy('full_name')->pluck('full_name','id'),
            'teachersList' => Teacher::orderBy('name')->pluck('name','id'),
            'courses' => Course::whereHas('subjectClasses', function($q) {
                $q->whereIn('term_id', Term::getEnrolling()->select('id')->get());
            })->select('courses.id','courses.name','courses.description')->get()
        ]);
    }

    public function update(Section $section, Request $request) {
        $request->validate([
            'department_id' => 'numeric|required',
            'term_id' => 'numeric|required',
            'program_id' => 'numeric|required',
            'teacher_id' => 'numeric|required',
            'level' => 'string|required',
            'name' => 'string|required',
        ]);

        $section->update($request->all());

        //update enrols...
        Enrol::where('section_id', $section->id)
            ->update([
                'program_id' => $request->program_id,
                'level' => $request->level
            ]);

        return redirect('/sections/' . $section->id)->with('Info','This section has been updated');
    }

    public function addSubjectClass(Section $section, Request $request) {
        $request->validate([
            'subject_class_id' => 'numeric|required'
        ]);

        //check for section schedule conflict with class to be added.
        $subjectClass = SubjectClass::find($request->subject_class_id);
        if($conflict = Schedule::checkSectionConflict($section, $subjectClass)) {
            return back()->with('Error', 'The class you want to add is in coflict with ' . $conflict->subjectClass->course->name . " - " . $conflict->summary);
        }

        if($subjectClass->term_id!=$section->term_id) {
            return back()->with('Error', 'The class you added is not offered in the same term as the section.');
        }

        ClassSection::create([
            'subject_class_id' => $request->subject_class_id,
            'user_id' => $request->user()->id,
            'section_id' => $section->id
        ]);

        //add the subject class to each enrol belonging to this section
        foreach($section->enrols as $enrol) {
            EnrolSubject::create([
                'enrol_id' => $enrol->id,
                'subject_class_id' => $request->subject_class_id,
                'created_by' => auth()->user()->id
            ]);
        }

        return redirect('/sections/' . $section->id)->with('Info','Class has been added to this section');
    }

    public function removeSubjectClass(Section $section, Request $request) {
        $request->validate([
            'class_section_id' => 'numeric|required'
        ]);

        $classSection = ClassSection::findOrFail($request->class_section_id);

        $subjectClassId = $classSection->subjectClass->id;

        $classSection->delete();

        //Delete all enrol_classes having this class_id under this section
        EnrolSubject::where('subject_class_id', $subjectClassId)
            ->whereHas('enrol', function($query) use ($section) {
                $query->where('section_id', $section->id);
            })->delete();

        return redirect('/sections/' . $section->id)->with('Info','A class has been removed from this section');
    }
}
