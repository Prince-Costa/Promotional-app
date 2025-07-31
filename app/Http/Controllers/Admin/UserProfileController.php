<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index(){
        if (!auth()->user()->can('user_profile.view')) {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();

        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('user_profile.update')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:8', // Password is optional but must be at least 8 characters if provided
            'image' => 'nullable'
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user attributes
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        // Update the password only if it is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $image = $request->file('image');
        if ($image) {
            // Remove existing image if it exists
            if ($user->image) {
            Storage::disk('public')->delete($user->image);
            }

            // Store the new image
            $imagePath = $image->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        // Save the updated user data
        $user->save();

        // Optionally, you can return a response or redirect the user
        return redirect()->back()->with('success', 'User updated successfully');
    }
}
