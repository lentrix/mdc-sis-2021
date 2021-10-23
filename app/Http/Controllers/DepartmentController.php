<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::whereNull('parent_id')->orderBy('accronym')->get();
        return view('departments.index',[
            'departments'=>$departments
        ]);
    }

    public function show(Department $department) {
        return view('departments.show',[
            'department' => $department
        ]);
    }
}
