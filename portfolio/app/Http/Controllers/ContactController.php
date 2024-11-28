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

        try {
            Mail::to('lucasmoons@hotmail.com')->send(
                new MailSent($message, config('mail.from.address'), config('mail.from.name'))
            );
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send message. Please try again.');
        }

        return redirect('/contact')->with('success', 'Message sent successfully!');
    }
}
