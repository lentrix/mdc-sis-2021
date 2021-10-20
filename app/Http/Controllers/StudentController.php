<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct() {
        $this->middleware('role:registrar');
    }

    public function create() {
        return view('students.create');
    }

    public function store(Request $request) {
        $request->validate([
            'id_numer' => 'numeric|required|unique',
            'last_name' => 'string|required',
            'first_name' => 'string|required',
            'sex' => 'string|required',
            'birth_date' => 'date|required',
        ]);

        $stud = Student::create($request->all());

        if(!$stud) {
            return back()->with('Error','There was a serious problem. Unable to create the student.');
        }

        return redirect('/students/' . $stud->id)->with('Info','New student record has been created.');
    }
}
