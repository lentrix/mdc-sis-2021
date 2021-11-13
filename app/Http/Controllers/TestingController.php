<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index() {
        return Program::whereIn('department_id', Department::headedBy(auth()->user())->select('id')->get() )->get();
        // return Department::headedBy(auth()->user())->select('id')->get();
    }
}
