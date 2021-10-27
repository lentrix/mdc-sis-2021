<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function create() {
        $deptList = Department::list();
        return view('programs.create',[
            'deptList' => $deptList
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'short_name' => 'string|required',
            'full_name' => 'string|required',
            'department_id' => 'numeric|required',
            'program_head' => 'string'
        ]);

        $program = Program::create($request->all());

        return redirect('/programs/' . $program->id)->with('Info','A new program has been created');
    }

    public function show(Program $program) {
        return view('programs.show',[
            'program'=>$program,
            'deptList' => $deptList = Department::list()
        ]);
    }

    public function search(Request $request) {

        $programs = Program::orderBy('full_name')->with('department');

        if($request->short_name) {
            $programs->where('short_name','like',"%$request->short_name%");
        }
        if($request->full_name) {
            $programs->where('full_name','like',"%$request->full_name%");
        }

        return view('programs.search',[
            'programs' => $programs->get()
        ]);
    }

    public function update(Program $program, Request $request) {
        $request->validate([
            'short_name' => 'string|required',
            'full_name' => 'string|required',
            'department_id' => 'numeric|required',
            'program_head' => 'string'
        ]);

        $program->update($request->all());

        return redirect('/programs/' .$program->id)->with('Info','This program has been updated');
    }
}
