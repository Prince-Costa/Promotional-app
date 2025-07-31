<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioTag;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;

class PortfolioTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('portfolio.view')) {
            abort(403, 'Unauthorized action.');
        }

        $tags = PortfolioTag::all();
        return view('admin.portfolio-tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!auth()->user()->can('portfolio.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PortfolioTag::create($request->all());

        return redirect()->route('portfolio_tags.index')
            ->with('success', 'Portfolio Tag created successfully.');
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
        if (!auth()->user()->can('portfolio.update')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolioTag = PortfolioTag::findOrFail($id);

        return response()->json(['status' => 'success', 'portfolioTag' => $portfolioTag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('portfolio.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $portfolioTag = PortfolioTag::findOrFail($id);
        $portfolioTag->update($request->all());

        session()->flash('success', 'Portfolio Tag updated successfully');

        return response()->json(['status' => 'success', 'message' => 'Portfolio Tag updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('portfolio.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolioTag = PortfolioTag::findOrFail($id);

        $portfolioTag->delete();
        
        session()->flash('success', 'Portfolio Tag deleted successfully');
        return response()->json(['status' => 'success', 'message' => 'Portfolio Tag deleted successfully']);
    }
}
