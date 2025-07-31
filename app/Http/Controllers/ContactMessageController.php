<?php

namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactMessage = new ContactMessage();
        $contactMessage->name = $data['name'];
        $contactMessage->email = $data['email'];
        $contactMessage->subject = $data['subject'];
        $contactMessage->message = $data['message'];
        $contactMessage->save();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
