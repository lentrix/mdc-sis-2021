<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index() {

        $key = request()->input('key');

        if($key && $key!='') {
            $label = "Search Results for \"$key\"";
            $users = User::where('user','like',"%$key%")
                    ->orWhere('lname','like',"%$key%")
                    ->orWhere('fname','like',"%$key%")
                    ->get();
        }else {
            $label = "Recent Users";
            $users = User::orderBy('updated_at','DESC')->limit(20)->get();
        }

        return view('users.mgt.index',[
            'users' => $users,
            'label' => $label
        ]);
    }

    public function show(User $user) {
        return view('users.mgt.show', [
            'user' => $user
        ]);
    }


}
