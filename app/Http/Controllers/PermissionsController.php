<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index() {
        $permissions = Permission::orderBy('permission')->get();
        return view('roles-permissions.permissions',[
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'permission' => 'string|required',
            'description' => 'string|required'
        ]);

        Permission::create($request->only('permission','description'));

        return redirect('/permissions')->with('Info', 'A new permission has been added');
    }

    public function update(Request $request) {
        $request->validate([
            'permission' => 'string|required',
            'description' => 'string|required',
        ]);

        $permission = Permission::findOrFail($request->permission_id);

        $permission->update($request->only('permission','description'));

        return redirect('/permissions')->with('Info',"The permission $permission->permission has been updated.");
    }

    public function destroy(Request $request) {
        $permission = Permission::findOrFail($request->permission_id);

        $permissionName = $permission->permission;
        $permission->delete();

        return redirect('/permissions')->with('Info', "The role $permissionName has been deleted.");
    }
}
