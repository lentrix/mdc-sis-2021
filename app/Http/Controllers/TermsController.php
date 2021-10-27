<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{

    public function __construct() {
        $this->middleware('role:admin')->except(['index','show']);
    }

    public function index() {
        $terms = Term::orderBy('start','desc')->get();

        return view('terms.index',['terms'=>$terms]);
    }

    public function show(Term $term) {
        return view('terms.show',['term'=>$term]);
    }

    public function update(Term $term, Request $request) {
        $request->validate([
            'accronym' => 'string|required',
            'name' => 'string|required',
            'type' => 'string|required',
            'enrol_start' => 'string|required',
            'enrol_end' => 'string|required',
            'start' => 'string|required',
            'end' => 'string|required',
        ]);

        $term->update($request->all());

        return redirect('/terms/' . $term->id)->with('Info','Term details have been updated.');
    }
}
