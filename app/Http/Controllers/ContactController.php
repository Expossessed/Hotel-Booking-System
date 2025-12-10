<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'nullable|string',
            'message' => 'required|string',
        ]);

        
        $data = [
    'name'         => $request->name,
    'email'        => $request->email,
    'subject'      => $request->subject ?? 'No subject',
    'user_message' => $request->message,
    ];

    Mail::send('email.contacts', $data, function($mail) use ($data) {
        $mail->to('vhenghie02@gmail.com') 
            ->subject('New Contact Message: ' . $data['subject']);
    });

        return back()->with('success', 'Your enquiry has been sent successfully!');
    }
}