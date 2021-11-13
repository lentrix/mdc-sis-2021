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
    public function __construct()
    {
        $this->middleware('role:registrar')->except(['index','show']);
    }

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
        if($conflict) return back()->with('Error','The schedule is in conflict with ' . $conflict->subjectClass->course->name . " " . $conflict->summary)->withInput();

        $conflict = Schedule::checkTeacherConflict($request->start, $request->end, $request->days, $class->teacher_id);
        if($conflict) return back()->with('Error','This schedule is in conflict with on of the teacher\'s existing schedules: ' . $conflict->subjectClass->course->name . " " . $conflict->summary)->withInput();

        $conflict = Schedule::checkSelfConflict($request->start, $request->end, $request->days, $class->id);
        if($conflict) return back()->with('Error','This schedule is in conflict with another schedule from this class: ' . $conflict->summary)->withInput();

        Schedule::create([
            'start' => $request->start,
            'end' => $request->end,
            'venue_id' => $request->venue_id,
            'day' => implode(",", $request->days),
            'subject_class_id' => $class->id
        ]);

        return redirect('/classes/' . $class->id . "/edit")->with('Info','A schedule has been added for this class');
    }

    public function create() {
        return view('classes.create',[
            'teachers' => Teacher::orderBy('name')->pluck('name','id'),
            'venues' => Venue::orderBy('name')->pluck('name','id'),
            'terms' => Term::getEnrolling()->pluck('name','id')
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'course_id' => 'numeric|required',
            'teacher_id' => 'numeric|required',
            'term_id' => 'numeric|required',
            'credit_units' => 'numeric|required',
            'pay_units' => 'numeric|required',
            'limit' => 'numeric|required',
            'venue_id' => 'numeric|required',
            'start' => 'string|required',
            'end' => 'string|required',
            'days' => 'array|required|min:1',
        ]);

        //check schedule availability

        $conflict = Schedule::checkVenueConflict($request->start, $request->end, $request->days, $request->venue_id);
        if($conflict) return back()->withInput()->with('Error',"The schedule is in conflict with " . $conflict->subjectClass->course->name . " " . $conflict->summary);

        $conflict = Schedule::checkTeacherConflict($request->start, $request->end, $request->days, $request->teacher_id);
        if($conflict) return back()->with('Error','This schedule is in conflict with one of the teacher\'s existing schedules: ' . $conflict->subjectClass->course->name . " " . $conflict->summary)->withInput();

        //create subject class
        $class = SubjectClass::create([
            'course_id' => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'term_id' => $request->term_id,
            'credit_units' => $request->credit_units,
            'pay_units' => $request->pay_units,
            'limit' => $request->limit,
            'venue_id' => $request->venue_id,
        ]);

        //create schedule
        if($class) {
            Schedule::create([
                'start' => $request->start,
                'end' => $request->end,
                'venue_id' => $request->venue_id,
                'day' => implode(",", $request->days),
                'subject_class_id' => $class->id
            ]);
        }

        return redirect('/classes/' . $class->id)->with('Info','New class created.');
    }

    public function removeSched(Request $request, SubjectClass $class) {

        $sched = Schedule::findOrFail($request->schedule_id);
        $sched->delete();

        return redirect('/classes/' . $class->id . "/edit")->with('Info','A schedule for this class has been removed');
    }
}
