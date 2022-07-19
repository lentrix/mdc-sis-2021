<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Term;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{

    public function __construct() {
        $this->middleware('role:admin')->except('index', 'show');
    }

    public function index() {
        $venues = Venue::orderBy('name')->get();
        return view('venues.index',[
            'venues' => $venues
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'building' => 'string|required',
            'capacity' => 'numeric|required',
        ]);

        Venue::create($request->all());

        return redirect('/venues')->with('Info','A new venue has been created');
    }

    public function show(Venue $venue) {
        $scheds = Schedule::where('venue_id', $venue->id)
            ->join('subject_classes', 'schedules.subject_class_id','subject_classes.id')
            ->whereIn('term_id', Term::getActive()->get('id'));

        return view('venues.show',[
            'venue' => $venue,
            'scheds' => $scheds->get()
        ]);
    }

    public function update(Venue $venue, Request $request) {
        $request->validate([
            'name' => 'string|required',
            'building' => 'string|required',
            'capacity' => 'numeric|required',
        ]);

        $venue->update($request->all());

        return redirect('/venues/' . $venue->id)->with('Info','This venue has been updated');
    }
}
