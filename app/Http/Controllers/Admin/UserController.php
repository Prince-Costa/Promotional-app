<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        if (!auth()->user()->can('user.view')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        $users = User::join('roles', 'roles.id', '=', 'users.role_id')
                        ->select('users.*', 'roles.name as role_name')
                        ->get();

        return view('admin.users.index',compact('roles', 'users'));
    }


    public function store(Request $r) {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the input data
        $validatedData = $r->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id', // Ensure the role exists
        ]);

        // Create the user and hash the password (using email as password for now)
        $validatedData['password'] = Hash::make($r->email);

        // Create the user
        $user = User::create($validatedData);

        // Assign the role to the user
        $role = Role::find($r->role_id);
        if ($role) {
            $user->assignRole($role->name);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User Added and Role Assigned Successfully!');
    }


    public function edit($id){
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::find($id);

        return response()->json(['status'=>'success', 'user'=> $user]);
    }


    public function update(Request $r, $id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $userData = $r->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'role_id' => 'required|exists:roles,id', // Ensure the role exists
        ]);

        // Find the user and update their details
        $user = User::findOrFail($id);
        $user->update($userData);

        // Find the new role by ID
        $role = Role::find($r->role_id);

        if ($role) {
            // Sync the user's roles (removes existing roles and assigns the new one)
            $user->syncRoles($role->name);
        }

        // Set a success message and return a JSON response
        session()->flash('success', 'User Updated Successfully!');
        return response()->json(['status' => 'success', 'message' => 'User Updated Successfully!']);
    }



    public function destroy($id)
    {
        if (!auth()->user()->can('user.delete')) {
            abort(403, 'Unauthorized action.');
        }

        // Find the permission by ID
        $user = User::find($id);

        // Check if the permission exists
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404); // Return a 404 response if not found
        }

        // Delete the permission
        $user->delete();

        session()->flash('success', 'User deleted successfully!');

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully.'
        ]);
    }
}
