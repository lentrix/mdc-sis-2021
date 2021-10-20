<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $roles = [];
        foreach(Role::orderBy('role')->get() as $role) {
            $roles[$role->id] = $role->role;
        }

        $permissions = [];
        foreach(Permission::orderBy('permission')->get() as $perm) {
            $permissions[$perm->id] = $perm->permission;
        }

        return view('users.mgt.show', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function addRole(Request $request) {
        $request->validate([
            'user_id' => 'numeric|required',
            'role' => 'numeric|required'
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role);

        if($user->is($role->role)) {
            return back()->with('Info','This user already have ' . $role->role . " role.");
        }

        UserRole::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role
        ]);

        return redirect('/user-mgt/' . $user->id)->with('Info','A role has been added to this user');
    }

    public function addPermission(Request $request) {
        $request->validate([
            'user_id' => 'numeric|required',
            'permission' => 'numeric|required',
        ]);

        $user = User::findOrFail($request->user_id);
        $permission = Permission::findOrFail($request->permission);

        if($user->may($permission->permission)) {
            return back()->with('Info','This user is already permitted to ' . $permission->permission);
        }

        UserPermission::create([
            'user_id' => $user->id,
            'permission_id' => $request->permission
        ]);

        return redirect('/user-mgt/' . $user->id)->with('Info','An additional permission has been given to this user');
    }

    public function addUser(Request $request) {
        $request->validate([
            'user' => 'string|required',
            'lname' => 'string|required',
            'fname' => 'string|required',
            'email' => 'email|required',
        ]);

        $rndStr = Str::random(5);

        User::create([
            'user' => $request->user,
            'lname' => $request->lname,
            'fname' => $request->fname,
            'email' => $request->email,
            'password' => bcrypt($rndStr)
        ]);

        return redirect('/user-mgt')->with('Info','A new user has been created with a temporary password of <strong>' . $rndStr . '</strong>');
    }

    public function updateUser(User $user, Request $request) {
        $request->validate([
            'user' => 'string|required',
            'lname' => 'string|required',
            'fname' => 'string|required',
            'email' => 'email|required',
        ]);

        $user->update($request->all());

        return redirect('/user-mgt/' . $user->id)->with('Info','This user has been updated');
    }

    public function changePassword(User $user, Request $request) {

        $request->validate([
            'password' => 'string|required|confirmed'
        ]);

        $user->update(['password'=>bcrypt($request->password)]);

        return redirect('/user-mgt/' . $user->id)->with('Info','This user\'s password has been updated.');
    }

    public function toggleUserActivation(User $user) {

        $user->active = !$user->active;
        $user->save();

        $activation = $user->active ? "ACTIVATED" : "DEACTIVATED";

        return redirect('/user-mgt/' . $user->id)->with('Info',"User $user->user has been $activation");
    }

}
