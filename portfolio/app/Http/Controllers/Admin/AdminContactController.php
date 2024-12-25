<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\AdminReply;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::with('reply')->latest()->get();
        return view('admin.contact', compact('messages'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        AdminReply::create([
            'contact_message_id' => $id,
            'reply' => $request->reply,
        ]);

        return redirect()->route('admin.contact.index')->with('success', 'Antwoord succesvol opgeslagen.');
    }
}
