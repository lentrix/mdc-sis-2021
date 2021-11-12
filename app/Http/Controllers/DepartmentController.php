<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::whereNull('parent_id')->orderBy('accronym')->get();
        return view('departments.index',[
            'departments'=>$departments,
            'departmentList' => Department::orderBy('accronym')->pluck('name','id'),
            'users' => User::getList()
        ]);
    }

    public function show(Department $department) {
        return view('departments.show',[
            'department' => $department,
            'departmentList' => Department::orderBy('accronym')->pluck('name','id'),
            'users' => User::getList()
        ]);
    }

    public function update(Department $department, Request $request) {
        $request->validate([
            'accronym' => 'string|required',
            'name' => 'string|required',
        ]);

        $department->update($request->all());

        return redirect('/departments/' . $department->id)->with('Info','Department is updated successfully');
    }

    public function store(Request $request) {
        $request->validate([
            'accronym' => 'string|required',
            'name' => 'string|required',
        ]);

        $dept = Department::create($request->all());

        return redirect('/departments/' . $dept->id)->with('Info','New department created successfully');
    }
}
