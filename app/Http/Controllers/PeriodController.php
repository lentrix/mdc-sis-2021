<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'start' => 'string|required',
            'end' => 'string|required',
        ]);

        Period::create($request->all());

        return redirect('/terms/' . $request->term_id)->with('Info','A new period for this term has been added');
    }

    public function update(Request $request) {
        $period = Period::findOrFail($request->period_id);

        $request->validate([
            'name' => 'string|required',
            'start' => 'string|required',
            'end' => 'string|required',
        ]);

        $period->update($request->only('name','start','end'));

        return redirect('/terms/' . $period->term_id)->with('Info','A period of this term has been updated');
    }

    public function destroy(Request $request) {
        $period = Period::findOrFail($request->period_id);

        $termId = $period->term_id;

        $period->delete();

        return redirect('/terms/' . $termId)->with('Info','A period of this term has been deleted');
    }
}
