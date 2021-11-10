<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SubjectClass;
use App\Models\Term;
use Illuminate\Http\Request;

class SubjectClassController extends Controller
{
    public function index(Request $request) {

        $classes = SubjectClass::whereIn('term_id', Term::getActive()->select('id')->get());
        $key = "";

        if($request->key) {
            $key = $request->key;
            $classes->whereHas('course', function($query) use ($key) {
                $query->where('name','like', "%$key%")
                    ->orWhere('description','like',"%$key%");
            });
        }else {
            $classes->orderBy('updated_at','DESC');
        }

        return view('classes.index',[
            'classes' => $classes->limit(50)->with('course')->with('teacher')->with('schedules')->get(),
            'key' => $key
        ]);

    }

    public function show(SubjectClass $class) {
        return view('classes.show',[
            'class' => $class
        ]);
    }

    public function edit(SubjectClass $class) {

        $courseList =  Course::orderBy('name')->pluck('description','id');

        return view('classes.edit', [
            'class'=>$class,
            'courseList'=>$courseList,
        ]);
    }
}
