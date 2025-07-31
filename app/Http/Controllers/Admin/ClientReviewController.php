<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('client.view')) {
            abort(403, 'Unauthorized action.');
        }

        $clients = Client::all();
        $reviews = ClientReview::all();
        return view('admin.client-review.index', compact('clients','reviews'));
    }




    public function store(Request $request)
    {
        if (!auth()->user()->can('client.create')) {
            abort(403, 'Unauthorized action.');
        }

        $clientData = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'review' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'image' => 'nullable|image',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new logo and update the path in the database
            $imagePath = $image->storeAs('client-review', $imageName, 'public');
            $clientData['image'] = $imagePath;
        }

        ClientReview::create($clientData);

        return redirect()->route('client-review.index')->with('success', 'Client review created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->can('client.view')) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('client.update')) {
            abort(403, 'Unauthorized action.');
        }

        $review = ClientReview::findOrFail($id);
        $clients = Client::all();
        return view('admin.client-review.edit', compact('review', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('client.update')) {
            abort(403, 'Unauthorized action.');
        }

        $clientData = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'review' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'image' => 'nullable|image',
        ]);

        $review = ClientReview::findOrFail($id);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($review->image) {
                Storage::disk('public')->delete($review->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new image and update the path in the database
            $imagePath = $image->storeAs('client-review', $imageName, 'public');
            $clientData['image'] = $imagePath;
        }

        $review->update($clientData);

        return redirect()->route('client-review.index')->with('success', 'Client review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('client.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $review = ClientReview::findOrFail($id);

        // Delete the image if it exists
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }

        $review->delete();

        session()->flash('success','Review deleted successfully!');
        return response()->json(['status' => 'success']);
    }
}
