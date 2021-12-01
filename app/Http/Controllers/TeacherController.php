<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function __construct() {
        $this->middleware('role:admin')->except(['search', 'show']);
    }

    public function create() {
        return view('teachers.create',[
            'usersList' => User::orderBy('user')->pluck('user','id')->toArray(),
            'departmentsList' => Department::orderBy('name')->pluck('name','id')->toArray()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'numeric|required',
            'name' => 'string|required',
            'specialization' => 'string|required',
            'department_id' => 'numeric|required'
        ]);

        try {
            $teacher = Teacher::create($request->all());

            UserRole::create([
                'user_id' => $request->user_id,
                'role_id' => Role::where('role','teacher')->first()->id
            ]);

            return redirect('/teachers/' . $teacher->id);
        }catch(QueryException $ex) {
            return back()->with('Error',"The user you selected may already have a teacher account.");
        }
    }

    public function show(Teacher $teacher) {
        return view('teachers.view',[
            'teacher' => $teacher,
            'usersList' => User::orderBy('user')->pluck('user','id')->toArray(),
            'departmentsList' => Department::orderBy('name')->pluck('name','id')->toArray()
        ]);
    }

    public function update(Teacher $teacher, Request $request) {
        $request->validate([
            'user_id' => 'numeric|required',
            'name' => 'string|required',
            'specialization' => 'string|required',
            'department_id' => 'numeric|required'
        ]);

        try {
            $teacher->update($request->all());

            return redirect("/teachers/$teacher->id")->with('Info','This teacher\'s record has been updated');
        }catch(QueryException $ex) {
            dd($ex);
            return back()->with('Error', "The user you selected may already have a teacher account.");
        }
    }

    public function search(Request $request) {
        $hasSearch = false;

        $teachers = Teacher::with('department');

        if($request->name) {
            $teachers->where('name','like',"%$request->name%")->orderBy('name');
            $hasSearch=true;
        }

        if($request->specialization) {
            $teachers->where('specialization','like',"%$request->specialization%")->orderBy('name');
            $hasSearch=true;
        }

        if(!$hasSearch) {
            $teachers->orderBy('updated_at','desc')->limit(20);
        }

        return view('teachers.search',[
            'teachers'=>$teachers->get(),
            'hasSearch'=>$hasSearch
        ]);
    }
}
