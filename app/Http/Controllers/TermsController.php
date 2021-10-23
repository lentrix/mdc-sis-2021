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
}
