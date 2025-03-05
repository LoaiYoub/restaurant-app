<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Send email
        Mail::to(config('mail.from.address'))->send(new ContactFormMail($validated));

        return redirect()
            ->route('contact')
            ->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
