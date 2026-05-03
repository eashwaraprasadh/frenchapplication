<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function show()
    {
        return view('pages.contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request)
    {
        // 1. Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'course' => 'nullable|string',
            'message' => 'required|string',
        ]);

        // 2. Process the data (e.g., save to database or send email)
        // Here is an example of how you might send an email:
        /*
        Mail::send('emails.contact', ['data' => $validatedData], function ($m) use ($validatedData) {
            $m->to('admissions@tslanguageschool.com', 'Admissions')->subject('New Contact Form Submission');
            $m->replyTo($validatedData['email'], $validatedData['name']);
        });
        */

        // Example saving to database if you had a Contact model:
        // Contact::create($validatedData);

        // 3. Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Thank you for your message! Our admissions team will get back to you shortly.');
    }
}
