<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('frontcms.view')) {
            abort(403, 'Unauthorized action.');
        }

        $pages = Page::where('status', 1)->get();

        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('frontcms.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('frontcms.create')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $pageData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $pageData['slug'] = Str::slug($request->slug); // Ensuring a proper slug format

        // Handle logo upload if present
        if ($request->hasFile('image')) {
            $featureImage = $request->file('image');
            $featureImageName = time() . '_' . $featureImage->getClientOriginalName();

            // Store the new logo and update the path in the database
            $featureImagePath = $featureImage->storeAs('page_images', $featureImageName, 'public');
            $pageData['image']  = $featureImagePath;
        }

        // Store the page
        Page::create($pageData);

        return redirect()->route('page.index')->with('success', 'Page created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        if (!auth()->user()->can('frontcms.view')) {
            abort(403, 'Unauthorized action.');
        }

        $page = Page::where('slug', $slug)->firstOrFail();

        return view('admin.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('frontcms.update')) {
            abort(403, 'Unauthorized action.');
        }

        $page = Page::findOrFail($id);

        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('frontcms.update')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $pageData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $id,
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $pageData['slug'] = Str::slug($request->slug); // Ensuring a proper slug format

        $page = Page::findOrFail($id);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $featureImage = $request->file('image');
            $featureImageName = time() . '_' . $featureImage->getClientOriginalName();

            // Store the new image and update the path in the database
            $featureImagePath = $featureImage->storeAs('page_images', $featureImageName, 'public');
            $pageData['image'] = $featureImagePath;

            // Delete the old image if exists
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
        }

        // Update the page
        $page->update($pageData);

        return redirect()->route('page.index')->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('frontcms.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $page = Page::findOrFail($id);

        // Delete the image if exists
        if ($page->image) {
            Storage::disk('public')->delete($page->image);
        }

        // Delete the page
        $page->delete();

        session()->flash('success','Page Removed Successfully');

        return response()->json(['status' => 'success']);
    }
}
