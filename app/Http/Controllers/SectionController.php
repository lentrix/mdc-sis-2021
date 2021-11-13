<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request) {
        $sections = Section::whereIn('term_id', Term::getActive()->select('id')->get())
            ->orderBy('department_id');

        if($request->deparment) {
            $sections->where('department_id', $request->department);
        }

        return view('sections.index',[
            'sections' => $sections->get(),
            'department_id' => $request->department_id,
            'departmentList' => Department::orderBy('accronym')->pluck('name','id'),
            'termsList' => Term::getEnrolling()->pluck('name','id'),
            'programsList' => Program::orderBy('full_name')->pluck('full_name','id'),
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
            'departmentList' => Department::orderBy('accronym')->pluck('name','id'),
            'termsList' => Term::getEnrolling()->pluck('name','id'),
            'programsList' => Program::orderBy('full_name')->pluck('full_name','id'),
            'teachersList' => Teacher::orderBy('name')->pluck('name','id')
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

        return redirect('/sections/' . $section->id)->with('Info','This section has been updated');
    }
}
