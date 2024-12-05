<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Send mail.
    public function sendMail(Request $request)
    {
        $message = $request->message;

        Mail::to('lucas.moons@student.ehb.be')->send(
            new MailSent($request->all()));

        return redirect('/contact')->with('success', 'Message sent successfully!');
    }
}
