<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Page;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('frontcms.view')) {
            abort(403, 'Unauthorized action.');
        }

        $menuItems = MenuItem::with('parent')->orderBy('position')->get();
        $parenMenu = MenuItem::whereNull('parent_id')->where('type', 'dropdown')->get();
        $pages = Page::where('status', 1)->get();

        return view('admin.menu-item.index', compact('menuItems', 'parenMenu', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('frontcms.create')) {
            abort(403, 'Unauthorized action.');
        }

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'page_url' => 'required|string|max:255',
            'type' => 'required|in:single,dropdown',
            'parent_id' => 'nullable|exists:menu_items,id',
            'position' => 'nullable|integer|min:0',
        ]);

        // Ensure parent_id is null if menu type is dropdown
        if ($validatedData['type'] != 'single') {
            $validatedData['parent_id'] = null;
        }

        // Create a new menu item
        MenuItem::create($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Menu item added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('frontcms.view')) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('frontcms.update')) {
            abort(403, 'Unauthorized action.');
        }

        $menuItem = MenuItem::findOrFail($id);
        $menuItems = MenuItem::whereNull('parent_id')->where('type', 'dropdown')->where('id', '!=', $id)->get(); // Exclude current item from parent selection
        $pages = Page::where('status', 1)->get();
        return view('admin.menu-item.edit', compact('menuItem', 'menuItems', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('frontcms.update')) {
            abort(403, 'Unauthorized action.');
        }

        $menuItem = MenuItem::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'page_url' => 'required|string|max:255',
            'type' => 'required|in:single,dropdown',
            'parent_id' => 'nullable|exists:menu_items,id',
            'position' => 'nullable|integer|min:0',
        ]);

        // If menu type is "single", reset parent_id
        if ($validatedData['type'] === 'dropdown') {
            $validatedData['parent_id'] = null;
        }

        $menuItem->update($validatedData);

        return redirect()->route('menu-item.index')->with('success', 'Menu item updated successfully!');
    }


    public function destroy(string $id)
    {
        // Check permission
        if (!auth()->user()->can('frontcms.delete')) {
            abort(403, 'Unauthorized action.');
        }

        // Find the menu item by ID (adjust according to your model structure)
        $menuItem = MenuItem::findOrFail($id);

        // Check if the item has children (assuming there's a 'children' relationship on MenuItem)
        if ($menuItem->children()->count() > 0) {
            // If it's a parent, delete all child items
            $menuItem->children()->delete();
        }

        // Delete the parent menu item
        $menuItem->delete();

       session()->flash('success','Menu Items Removed Successfully');

        return response()->json(['status' => 'success']);
    }

}
