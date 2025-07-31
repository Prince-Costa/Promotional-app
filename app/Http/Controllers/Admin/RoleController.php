<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){

        if (!auth()->user()->can('role.view')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        return view('admin.role-and-permission.roles.index', compact('roles'));
    }

    public  function addPermissions($id){
        if (!auth()->user()->can('role.create')) {
            abort(403, 'Unauthorized action.');
        }

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id')->toArray();


        return view('admin.role-and-permission.add-role-permissions', compact('role', 'permissions','rolePermissions'));
    }

    public  function updatePermissions(Request $r, $id){
        if (!auth()->user()->can('role.create')) {
            abort(403, 'Unauthorized action.');
        }

        $r->validate([
            'permissions' => 'required'
        ]);


        $role = Role::findOrFail($id);
        $role->syncPermissions($r->permissions);

        return redirect()->back()->with('success', 'Permissions Updated Successfully!');
    }

    public function store(Request $r){
        if (!auth()->user()->can('role.create')) {
            abort(403, 'Unauthorized action.');
        }

        $r->validate([
            'name' => 'required || unique:roles,name'
        ]);

        Role::create(['name' => $r->name]);

        return redirect()->back()->with('success', 'Role Added Successfully');
    }

    public function edit($id){
        if (!auth()->user()->can('role.update')) {
            abort(403, 'Unauthorized action.');
        }

        $role = Role::find($id);

        return response()->json(['status'=>'success', 'permission'=> $role]);
    }

    public function update(Request $r, $id)
    {
        if (!auth()->user()->can('role.update')) {
            abort(403, 'Unauthorized action.');
        }
        // Validate the request
        $r->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the role and update it
        $permission = Role::findOrFail($id);
        $permission->name = $r->name;
        $permission->save();

        session()->flash('success', 'Role Updated Successfully!');
        return response()->json(['status' => 'success', 'message' => 'Role Updated Successfully!']);
    }


    public function destroy($id)
    {
        if (!auth()->user()->can('role.delete')) {
            abort(403, 'Unauthorized action.');
        }
        // Find the permission by ID
        $role = Role::find($id);

        // Check if the permission exists
        if (!$role) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found.'
            ], 404); // Return a 404 response if not found
        }

        // Delete the permission
        $role->delete();

        session()->flash('success', 'Role deleted successfully!');

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully.'
        ]);
    }
}
