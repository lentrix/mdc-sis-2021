<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Enrol;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only('dashboard');
    }

    public function login() {
        return view('pages.login');
    }

    public function dashboard() {
        $termIds = Term::getActive()->get('id');
        $enrols = Enrol::whereIn('term_id', $termIds);

        return view('pages.dashboard',[
            'studCount' => $enrols->count(),
            'collegeCount' => $this->deptCount(Department::where('accronym', 'College')->first()),
            'shsCount' => $this->deptCount(Department::where('accronym', 'SHS')->first()),
            'jhsCount' => $this->deptCount(Department::where('accronym', 'JHS')->first()),
            'elemCount' => $this->deptCount(Department::where('accronym', 'Elem')->first()),
        ]);
    }

    private function deptCount($dept) {
        return DB::table('enrols')->whereIn('term_id', Term::getActive()->get('id'))
            ->join('programs','programs.id','enrols.program_id')
            ->whereIn('programs.department_id', explode(",", $dept->getHierarchyList()))
            ->select('enrols.id')
            ->count();
    }
}
