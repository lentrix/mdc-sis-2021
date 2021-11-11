<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\SubjectClass;
use App\Models\Teacher;
use App\Models\Term;
use App\Models\Venue;
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

        return view('classes.edit', [
            'class'=>$class,
            'teachers' => Teacher::orderBy('name')->pluck('name','id'),
            'terms' => Term::getActive()->pluck('name','id'),
            'venues' => Venue::orderBy('name')->pluck('name','id')
        ]);
    }

    public function update(Request $request, SubjectClass $class) {
        $request->validate([
            'course_id' => 'numeric|required',
            'teacher_id' => 'numeric|required',
            'pay_units' => 'numeric|required',
            'credit_units' => 'numeric|required',
            'term_id' => 'numeric|required',
        ]);

        $class->update($request->all());

        return redirect('/classes/' . $class->id)->with('Info','Subject class has been updated');
    }

    public function addSched(SubjectClass $class, Request $request) {
        $request->validate([
            'start' => 'string|required',
            'end' => 'string|required',
            'venue_id' => 'numeric|required',
            'days' => 'required',
        ]);

        $conflict = Schedule::checkVenueConflict($request->start, $request->end, $request->days, $request->venue_id);
        if($conflict) return back()->with('Error','The schedule is in conflict with ' . $conflict->summary)->withInput();

        $conflict = Schedule::checkSelfConflict($request->start, $request->end, $request->days, $class->id);
        if($conflict) return back()->with('Error','This schedule is in conflict with another schedule from this class: ' . $conflict->summary)->withInput();

        $conflict = Schedule::checkSelfConflict($request->start, $request->end, $request->days, $class->teacher_id);
        if($conflict) return back()->with('Error','This schedule is in conflict with on of the teacher\'s existing schedules: ' . $conflict->summary)->withInput();

        Schedule::create([
            'start' => $request->start,
            'end' => $request->end,
            'venue_id' => $request->venue_id,
            'day' => implode(",", $request->days),
            'subject_class_id' => $class->id
        ]);

        return redirect('/classes/' . $class->id . "/edit")->with('Info','A schedule has been added for this class');
    }
}
