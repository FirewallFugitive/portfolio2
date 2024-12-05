<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class MailSent extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $email;
    public $name;

    public function __construct($data)
    {
        $this->message = $data['messages'];
        $this->email = $data['email'];
        $this->name = $data['name'];
    }

    /**
     * Get the message envelope.
     */
    public function build(){
        return $this->subject('Message from ' . $this->email)
            ->view('mail')
            ->with([
                'messages' => $this->message,
                'email' => $this->email,
                'name' => $this->name
            ]);
    }
}



