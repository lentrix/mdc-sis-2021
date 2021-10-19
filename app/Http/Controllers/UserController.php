<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile() {
        $user = auth()->user();
        return view('users.profile',[
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        $user = auth()->user();
        $request->validate([
            'user' => 'string|required',
            'lname' => 'string|required',
            'fname' => 'string|required',
        ]);

        //check user for duplicates
        if($request->user != $user->user) {
            $userWithUsername = User::where('user', $request->user)
                    ->where('id','<>', $user->id)->first();

            if($userWithUsername) {
                return back()->with('input')->with('Error','The user name is already taken by someone else.');
            }
        }

        $user->update($request->only('user','lname','fname'));

        return redirect('/users/profile')->with('Info','Your user profile has been updated.');
    }
}
