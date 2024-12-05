<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function inbox()
    {
        $messages = \App\Models\Message::with(['sender', 'parentMessage', 'replies']) // Load relationships
            ->where(function ($query) {
                // Get all messages received by the user
                $query->where('receiver_id', auth()->id());
            })
            ->orWhere(function ($query) {
                // Get all messages sent by the user that have replies
                $query->where('sender_id', auth()->id())
                      ->whereHas('replies'); // Include only sent messages with replies
            })
            ->orderBy('created_at', 'desc') // Order messages by the latest
            ->get();
    
        return view('inbox', compact('messages'));
    }
    


    
    public function reply(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:500',
            'reply_to_id' => 'nullable|exists:messages,id',
        ]);

        // Create the reply message
        \App\Models\Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'reply_to_id' => $request->reply_to_id, // Ensure this is set
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }




    public function send(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required',
        ]);

        Message::create($request->all());

        return redirect()->route('inbox', auth()->id())->with('success', 'Message sent successfully!');
    }

    public function compose($receiver_id)
    {
        $receiver = \App\Models\User::findOrFail($receiver_id);
        return view('compose', compact('receiver'));
    }
}

