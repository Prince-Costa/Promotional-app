<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioTag;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('portfolio.view')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolios = Portfolio::all();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('portfolio.create')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolioTags = PortfolioTag::all();
        $services = Service::all();
        $clients = Client::all();

        return view('admin.portfolio.create', compact('portfolioTags', 'services','clients'));
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
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
            'client_id' => 'nullable|exists:clients,id',
            'portfolio_tag_id' => 'nullable|exists:portfolio_tags,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $portfolio = new Portfolio();
        $portfolio->title = $request->title;
        $portfolio->body = $request->body;
        $portfolio->service_id = $request->service_id;
        $portfolio->client_id = $request->client_id;
        $portfolio->portfolio_tag_id = $request->portfolio_tag_id;

         // Handle logo upload if present
         if ($request->hasFile('image')) {
            $featureImage = $request->file('image');
            $featureImageName = time() . '_' . $featureImage->getClientOriginalName();

            // Store the new logo and update the path in the database
            $featureImagePath = $featureImage->storeAs('portfolios', $featureImageName, 'public');
            $portfolio->image  = $featureImagePath;
        }

        $portfolio->save();


        return redirect()->route('portfolio.index')->with('success', 'Portfolio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('portfolio.view')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('portfolio.update')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolio = Portfolio::findOrFail($id);
        $portfolioTags = PortfolioTag::all();
        $services = Service::all();
        $clients = Client::all();

        return view('admin.portfolio.edit', compact('portfolio', 'portfolioTags', 'services','clients'));
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
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
            'client_id' => 'nullable|exists:clients,id',
            'portfolio_tag_id' => 'nullable|exists:portfolio_tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->title = $request->title;
        $portfolio->body = $request->body;
        $portfolio->service_id = $request->service_id;
        $portfolio->client_id = $request->client_id;
        $portfolio->portfolio_tag_id = $request->portfolio_tag_id;

         // Handle image upload if present
         if ($request->hasFile('image')) {
            // Remove the existing image file if it exists
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            $featureImage = $request->file('image');
            $featureImageName = time() . '_' . $featureImage->getClientOriginalName();

            // Store the new logo and update the path in the database
            $featureImagePath = $featureImage->storeAs('portfolios', $featureImageName, 'public');
            $portfolio->image  = $featureImagePath;
        }

        $portfolio->save();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('portfolio.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $portfolio = Portfolio::findOrFail($id);

        $portfolio->delete();

        session()->flash('success', 'Portfolio deleted successfully');
        return response()->json(['status' => 'success', 'message' => 'Portfolio deleted successfully']);
    }
}
