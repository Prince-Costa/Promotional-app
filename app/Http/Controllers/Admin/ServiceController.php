<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('service.view')) {
            abort(403, 'Unauthorized action.');
        }

        $services = Service::all();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('service.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!auth()->user()->can('service.create')) {
            abort(403, 'Unauthorized action.');
        }

        $serviceData = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'feature_image' => 'required|image',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('feature_image')) {
            $featureImage = $request->file('feature_image');
            $featureImageName = time() . '_' . $featureImage->getClientOriginalName();

            // Store the new logo and update the path in the database
            $featureImagePath = $featureImage->storeAs('service', $featureImageName, 'public');
            $serviceData['feature_image'] = $featureImagePath;
        }

        Service::create($serviceData);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('service.view')) {
            abort(403, 'Unauthorized action.');
        }

        $service = Service::find($id);

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->can('service.update')) {
            abort(403, 'Unauthorized action.');
        }

        $service = Service::find($id);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->can('service.update')) {
            abort(403, 'Unauthorized action.');
        }

        $serviceData = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'feature_image' => 'nullable|image',
        ]);

        $service = Service::find($id);

        if (!$service) {
            return redirect()->back()->withErrors(['error' => 'Service not found.']);
        }

        // Handle logo upload if present
        if ($request->hasFile('feature_image')) {
            $featureImage = $request->file('feature_image');
            $featureImageName = time() . '_' . $featureImage->getClientOriginalName();

            // Delete the old logo if it exists
            if ($service->feature_image && Storage::disk('public')->exists($service->feature_image)) {
                Storage::disk('public')->delete($service->feature_image);
            }

            // Store the new logo and update the path in the database
            $featureImagePath = $featureImage->storeAs('service', $featureImageName, 'public');
            $serviceData['feature_image'] = $featureImagePath;
        }

        $service->update($serviceData);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('service.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $service = Service::find($id);
        $service->delete();

        session()->flash('success', 'Service deleted successfully!');

        return response()->json([
            'status' => 'success',
            'message' => 'Service deleted successfully.'
        ]);
    }
}
