<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Enrol;
use App\Models\Program;
use App\Models\Section;
use App\Models\Term;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ReportsController extends Controller
{

    public function __construct() {
        $this->middleware('role:head,registrar');
    }

    public function studentList(Request $request) {

        $list = null;
        $heading = '';

        if(count($request->all())) {
            $list = Enrol::whereIn('term_id', Term::getActive()->get('id'));

            if($request->section_id) {
                $section = Section::find($request->section_id);
                $list->where('section_id', $request->section_id);
                $heading = "Section: " . $section->name;
            }

            if($request->department_id) {
                $department = Department::find($request->department_id);
                $list->whereHas('program', function($query) use ($request) {
                    $query->where('department_id', $request->department_id);
                });
                $heading = "Department: " . $department->accronym;
            }

            if($request->program_id) {
                $program = Program::find($request->program_id);
                $list->where('program_id', $request->program_id);
                if($program) {
                    $heading .= "Program: " . $program->short_name . " ";
                }
            }

            if($request->level) {
                $list->where('level', $request->level);
                $heading .= "Level: " . $request->level;
            }

            $list->join('students','students.id','enrols.student_id')
                ->orderBy('last_name')->orderBy('first_name');

            $heading .= " (" . $list->count() . " students)";

        }

        return view('reports.student-list',[
            'request' => $request,
            'heading' => $heading,
            'sectionList' => Section::whereIn('term_id', Term::getActive()->get('id'))->pluck('name','id'),
            'programList' => Program::orderBy('full_name')->pluck('full_name','id'),
            'departmentList' => Department::orderBy('name')->pluck('name','id'),
            'levelList' => config('mdc.levels'),
            'list' => $list ? $list->get() : null
        ]);
    }
}
