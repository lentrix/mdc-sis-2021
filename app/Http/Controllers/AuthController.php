<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'user' => 'string|required',
            'password' => 'string|required',
        ]);

        $user = User::where('user', $request->user)->first();
        if(!$user->active) {
            return back()->with('Error','Sorry your user account is INACTIVE. Please contact the systems administrator to activate your account.');
        }

        $user = auth()->attempt($request->only('user','password'));

        if(!$user) {
            return back()->with('Error','Invalid user credentials');
        }

        return redirect('/dashboard');
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with('Info','You have been logged out.');
    }
}
