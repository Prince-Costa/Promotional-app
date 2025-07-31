<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{

    public function index()
    {
        if (!auth()->user()->can('client.view')) {
            abort(403, 'Unauthorized action.');
        }

        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }





    public function store(Request $request)
    {
        if (!auth()->user()->can('client.create')) {
            abort(403, 'Unauthorized action.');
        }
        $clientData = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new logo and update the path in the database
            $imagePath = $image->storeAs('client', $imageName, 'public');
            $clientData['image'] = $imagePath;
        }

        // Create the new client
        $client = Client::create($clientData);
        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }


    public function edit(string $id)
    {
        if (!auth()->user()->can('client.update')) {
            abort(403, 'Unauthorized action.');
        }

        $client = Client::findOrFail($id);

        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('client.update')) {
            abort(403, 'Unauthorized action.');
        }

        $client = Client::findOrFail($id);

        $clientData = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the new logo and update the path in the database
            $imagePath = $image->storeAs('client', $imageName, 'public');
            $clientData['image'] = $imagePath;

            // Delete the logo if present
            if ($client->image) {
                Storage::disk('public')->delete($client->image);
            }

        }

        // Find the client and update it

        $client->update($clientData);
        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('client.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $client = Client::findOrFail($id);

        // Delete the logo if present
        if ($client->image) {
            Storage::disk('public')->delete($client->image);
        }

        $client->delete();

        session()->flash('success', 'Role deleted successfully!');

        return response()->json(['status' => 'success']);
    }
}
