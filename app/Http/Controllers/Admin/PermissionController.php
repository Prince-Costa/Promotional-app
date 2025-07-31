<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('permission.view')) {
            abort(403, 'Unauthorized action.');
        }

        $permissions = Permission::all();
        return view('admin.role-and-permission.permissions.index', compact('permissions'));
    }


    public function create(){

    }

    public function store(Request $r){
        if (!auth()->user()->can('permission.create')) {
            abort(403, 'Unauthorized action.');
        }

        $r->validate([
            'name' => 'required || unique:permissions,name'
        ]);

        Permission::create(['name' => $r->name]);

        return redirect()->back()->with('success', 'Permission Added Successfully');
    }

    public function edit($id){
        if (!auth()->user()->can('permission.update')) {
            abort(403, 'Unauthorized action.');
        }

        $permission = Permission::find($id);

        return response()->json(['status'=>'success', 'permission'=> $permission]);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('permission.update')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the permission and update it
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        session()->flash('success', 'Permission updated successfully!');

        return response()->json(['status' => 'success', 'message' => 'Permission updated successfully!']);
    }


    public function destroy($id)
    {
        if (!auth()->user()->can('permission.delete')) {
            abort(403, 'Unauthorized action.');
        }

        // Find the permission by ID
        $permission = Permission::find($id);

        // Check if the permission exists
        if (!$permission) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission not found.'
            ], 404); // Return a 404 response if not found
        }

        // Delete the permission
        $permission->delete();

        session()->flash('success', 'Permission deleted successfully!');
        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Permission deleted successfully.'
        ]);
    }
}
