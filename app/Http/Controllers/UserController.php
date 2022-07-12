<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                return back()->withInput()->with('Error','The user name is already taken by someone else.');
            }
        }

        $user->update($request->only('user','lname','fname'));

        $picField = $request['pic-field'];

        $this->savePic($picField, $user);

        return redirect('/users/profile')->with('Info','Your user profile has been updated.');
    }

    public function changePasswordForm() {
        return view('users.change-password',[
            'user' => auth()->user()
        ]);
    }

    public function changePassword(Request $request) {
        $request->validate([
            'user_id' => 'numeric|required',
            'current_password'=>'string|required',
            'new_password' => 'string|required|confirmed'
        ]);

        $user = User::findOrFail($request->user_id);

        $check = Hash::check($request->current_password, $user->password);

        if(!$check) {
            return back()->with('Error','Your current password incorrect.');
        }

        $user->update(['password'=>bcrypt($request->new_password)]);

        return redirect('/users/profile')->with('Info','Your password has been changed.');
    }

    private function savePic($field, $user) {
        $folderPath = 'img/profile-pics/';

        if($field) {
            $image_parts = explode(";base64,", $field);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $user->id . '.jpg';

            try {
                $data = \imagecreatefromstring($image_base64);
                if(!$data) {
                    die("Fatal Error!");
                }

                imagejpeg($data, $file);
            }catch(\Exception $ex) {
                die($ex->getMessage());
            }
        }
    }
}
