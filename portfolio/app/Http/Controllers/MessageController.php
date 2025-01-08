<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function inbox()
    {
        $messages = \App\Models\Message::with('sender')
        ->where('receiver_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get()
        ->unique('sender_id');

        return view('inbox', compact('messages'));
    }
    
    public function chat($userId)
    {
        $currentUserId = auth()->id();

        $messages = Message::where(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $currentUserId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        $receiver = User::findOrFail($userId);

        return view('chat', compact('messages', 'receiver'));
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
            'reply_to_id' => $request->reply_to_id,
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }


    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);
    
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'time' => now()->format('h:i A'),
        ]);
    }


    public function compose($receiver_id)
    {
        $receiver = \App\Models\User::findOrFail($receiver_id);
        return view('compose', compact('receiver'));
    }
}

