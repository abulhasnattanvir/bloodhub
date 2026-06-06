<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessages;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = \App\Models\ContactSetting::first();
        return view('frontend.contact', compact('contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        ContactMessages::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Red success message
        return redirect()->back()->with('success', 'Your message has been sent successfully! We will contact you soon.');
    }
}