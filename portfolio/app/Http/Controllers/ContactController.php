<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    // Send mail.
    public function sendMail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'messages' => 'required|string',
        ]);
    
        $contactMessage = ContactMessage::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['messages'],
        ]);

        Mail::to('lucas.moons@student.ehb.be')->send(
            new MailSent($request->all()));

        return redirect('/contact')->with('success', 'Message sent successfully!');
    }
}
