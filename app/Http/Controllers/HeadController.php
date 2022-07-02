<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Head;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    public function __construct() {
        $this->middleware('role:admin');
    }

    public function store(Department $department, Request $request) {
        $request->validate([
            'user_id'=>'required|numeric'
        ]);

        Head::create([
            'user_id' => $request->user_id,
            'department_id' => $department->id
        ]);
        return back()->with('Info','An user had been assigned as head.');
    }

    public function destroy(Head $head) {
        $dept = $head->department->accronym;
        $head->delete();
        return back()->with('Info','A user has been removed as department head of ' . $dept . ".");
    }
}
