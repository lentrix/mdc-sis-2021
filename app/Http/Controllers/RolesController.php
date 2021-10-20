<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct() {
        // $this->middleware('')
    }

    public function index() {
        $roles = Role::orderBy('role')->get();
        return view('roles-permissions.roles',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'role' => 'string|required',
            'description' => 'string|required',
        ]);

        Role::create($request->only('role','description'));

        return redirect('/roles')->with('Info','A new role has been added');
    }

    public function update(Request $request) {
        $request->validate([
            'role' => 'string|required',
            'description' => 'string|required',
        ]);

        $role = Role::findOrFail($request->role_id);

        $role->update($request->only('role','description'));

        return redirect('/roles')->with('Info',"The role $role->role has been updated.");
    }

    public function destroy(Request $request) {
        $role = Role::findOrFail($request->role_id);

        $roleName = $role->role;
        $role->delete();

        return redirect('/roles')->with('Info', "The role $roleName has been deleted.");
    }
}
