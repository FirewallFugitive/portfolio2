<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Send mail.
     */
    public function sendMail(Request $request)
    {
        $message = $request->message;

        try {
            Mail::to('lucasmoons@hotmail.com')->send(new MailSent($message));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send message. Please try again.');
        }

        return redirect('/contact')->with('success', 'Message sent successfully!');
    }
}
