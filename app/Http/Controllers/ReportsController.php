<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Enrol;
use App\Models\Program;
use App\Models\Section;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function enrollmentList() {

        $enrols = null;

        $collegeDepts = Department::where('accronym','College')->first()->getHierarchyList();
        $gsDept = Department::where('accronym','GS')->first();

        $deptIds = $collegeDepts . $gsDept->id;

        $enrols = DB::table('enrols')->whereIn('program_id', Program::whereIn('department_id', explode(",", $deptIds))->get('id'))
                ->join('programs', 'programs.id','enrols.program_id')
                ->join('students', 'students.id', 'enrols.student_id')
                ->orderBy('programs.short_name')
                ->orderBy('enrols.level')
                ->orderBy('students.last_name')
                ->orderBy('students.first_name')
                ->select('enrols.id as id', 'id_number', 'last_name', 'first_name', 'middle_name', 'programs.short_name', 'level', 'students.sex')
                ->get();

        $file = fopen("reports/enrolment_list.csv", 'w');

        fputcsv($file, ['#','ID Number','Last Name','First Name','Middle Name', 'Course & Year','Gender','Subjects','Units']);

        foreach($enrols as $idx=>$enrol) {
            $summary = Enrol::findOrFail($enrol->id)->subjectSummary();
            fputcsv($file, [
                $idx+1,
                $enrol->id_number,
                $enrol->last_name,
                $enrol->first_name,
                $enrol->middle_name,
                $enrol->short_name . "-" . substr($enrol->level,1,1),
                $enrol->sex,
                implode(",",$summary['subjects']),
                $summary['totalUnits'],
            ]);
        }
        fclose($file);

        return view('reports.enrollment-list');
    }

    public function promotionalReport() {
        $enrols = null;

        $collegeDepts = Department::where('accronym','College')->first()->getHierarchyList();
        $gsDept = Department::where('accronym','GS')->first();

        $deptIds = $collegeDepts . $gsDept->id;

        $enrols = DB::table('enrols')->whereIn('program_id', Program::whereIn('department_id', explode(",", $deptIds))->get('id'))
                ->join('programs', 'programs.id','enrols.program_id')
                ->join('students', 'students.id', 'enrols.student_id')
                ->orderBy('programs.short_name')
                ->orderBy('enrols.level')
                ->orderBy('students.last_name')
                ->orderBy('students.first_name')
                ->select('enrols.id as id', 'id_number', 'last_name', 'first_name', 'middle_name', 'programs.short_name', 'level', 'students.sex')
                ->get();

        $file = fopen("reports/promotional_report.csv", 'w');

        fputcsv($file, ['#','ID Number','Last Name','First Name','Middle Name','Course & Year','Gender','Subject','MG','FG','Units']);

        foreach($enrols as $idx=>$enrolItem) {
            $enrol = Enrol::findOrFail($enrolItem->id);
            $first = true;
            foreach($enrol->enrolSubjects as $enrolSubject) {
                if($first) {
                    fputcsv($file, [
                        $idx+1,
                        $enrol->student->id_number,
                        $enrol->student->last_name,
                        $enrol->student->first_name,
                        $enrol->student->middle_name,
                        $enrol->program->short_name . "-" . substr($enrol->level,1,1),
                        $enrol->student->sex,
                        $enrolSubject->subjectClass->course->name,
                        $enrolSubject->g1,
                        $enrolSubject->rating,
                        $this->evaluateUnit($enrolSubject->rating, $enrolSubject->subjectClass->credit_units)
                    ]);
                }else {
                    fputcsv($file,[
                        "","","","","","","",
                        $enrolSubject->subjectClass->course->name,
                        $enrolSubject->g1,
                        $enrolSubject->rating,
                        $this->evaluateUnit($enrolSubject->rating, $enrolSubject->subjectClass->credit_units)
                    ]);
                }
                $first=false;
            }
        }
        fclose($file);

        return view('reports.promotional-report');
    }

    private function evaluateUnit($rating, $units) {
        if(is_numeric($rating)) {
            if($rating > 3.0) {
                return 0;
            }else {
                return $units;
            }
        }else {
            return '-';
        }
    }
}
