<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('staff.view')) {
            abort(403, 'Unauthorized action.');
        }

        $staffs = Staff::all();
        return view('admin.staff.index', compact('staffs'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('staff.create')) {
            abort(403, 'Unauthorized action.');
        }

        $staffData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new image and update the path in the database
            $imagePath = $image->storeAs('staff', $imageName, 'public');
            $staffData['image'] = $imagePath;
        }

        // Create the new staff
        $staff = Staff::create($staffData);
        return redirect()->route('staffs.index')->with('success', 'Staff created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('staff.view')) {
            abort(403, 'Unauthorized action.');
        }

        $staff = Staff::findOrFail($id);
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('staff.update')) {
            abort(403, 'Unauthorized action.');
        }

        $staff = Staff::findOrFail($id);

        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!auth()->user()->can('staff.update')) {
            abort(403, 'Unauthorized action.');
        }

        $staff = Staff::findOrFail($id);

        $staffData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'designation' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        // Handle image upload if present

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new image and update the path in the database
            $imagePath = $image->storeAs('staff', $imageName, 'public');
            $staffData['image'] = $imagePath;

            // Delete the old image
            if ($staff->image) {
                Storage::disk('public')->delete($staff->image);
            }
        }

        // Update the staff
        $staff->update($staffData);
        return redirect()->route('staffs.index')->with('success', 'Staff updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('staff.delete')) {
            abort(403, 'Unauthorized action.');
        }
        
        $staff = Staff::findOrFail($id);

        // Delete the image if present
        if ($staff->image) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();
        session()->flash('success', 'Role deleted successfully!');
        return response()->json(['status' => 'success']);
    }
}
