<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
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
        return view('venues.show',[
            'venue' => $venue
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
