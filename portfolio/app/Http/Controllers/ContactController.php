<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Send mail.
    public function sendMail(Request $request)
    {
        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->messages,
        ]);

        Mail::to('lucas.moons@student.ehb.be')->send(
            new MailSent($request->all()));

        return redirect('/contact')->with('success', 'Message sent successfully!');
    }
}
