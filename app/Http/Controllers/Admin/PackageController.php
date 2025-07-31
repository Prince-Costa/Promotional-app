<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('package.view')) {
            abort(403, 'Unauthorized action.');
        }

        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('package.create')) {
            abort(403, 'Unauthorized action.');
        }

        $services = Service::all();
        return view('admin.package.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!auth()->user()->can('package.create')) {
            abort(403, 'Unauthorized action.');
        }

        $packageData = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'details' => 'required',
            'service_id' => 'required',
            'tag' => 'nullable|string|max:255',
        ]);

        Package::create($packageData);

        return redirect()->route('packages.index')->with('success', 'Package created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('package.update')) {
            abort(403, 'Unauthorized action.');
        }

        $package = Package::findOrFail($id);
        $services = Service::all();

        return view('admin.package.edit', compact('package', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('package.update')) {
            abort(403, 'Unauthorized action.');
        }

        $packageData = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'details' => 'required',
            'service_id' => 'required',
            'tag' => 'nullable|string|max:255',
        ]);

        $package = Package::findOrFail($id);
        $package->update($packageData);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('package.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $package = Package::findOrFail($id);
        $package->delete();

        session()->flash('success', 'Package deleted successfully');
        return response()->json(['status' => 'success']);
    }
}
