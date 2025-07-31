<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('message.view')) {
            abort(403, 'Unauthorized action.');
        }

        $messages = ContactMessage::all();
        return view('admin.message.index', compact('messages'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('message.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $message = ContactMessage::findOrFail($id);

        $message->delete();



        session()->flash('success', 'Message deleted successfully');
        return response()->json(['status' => 'success', 'message' => 'Message deleted successfully']);
    }


    public function destroyMultiple(Request $request)
    {
        if (!auth()->user()->can('message.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $ids = $request->input('ids');
        ContactMessage::whereIn('id', $ids)->delete();

        session()->flash('success', 'Messages deleted successfully');
        return response()->json(['status' => 'success', 'message' => 'Messages deleted successfully']);
    }
}
