<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function dashboard()
    {
        $messages = Auth::user()->messages()->latest()->get();
        return view('dashboard', compact('messages'));
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message_text' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message_text' => $request->message_text,
        ]);

        return redirect()->route('message.preview', $message->share_slug)
            ->with('success', 'Message created successfully!');
    }

    public function preview($slug)
    {
        $message = Message::where('share_slug', $slug)->firstOrFail();
        $isOwner = Auth::check() && Auth::id() === $message->user_id;
        
        return view('messages.show', compact('message', 'isOwner'));
    }

    public function show($slug)
    {
        $message = Message::where('share_slug', $slug)->firstOrFail();
        return view('messages.show', ['message' => $message, 'isOwner' => false]);
    }
}
