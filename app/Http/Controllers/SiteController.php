<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function login() {
        return view('pages.login');
    }

    public function dashboard() {
        return view('pages.dashboard');
    }
}
