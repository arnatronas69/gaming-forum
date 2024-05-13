<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::where('to_id', auth()->id())->get();

        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $message = new Message($request->all());
        $message->from_id = auth()->id();
        $message->save();

        return redirect()->route('messages.index');
    }

    public function storeReply(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $reply = new Message;
        $reply->from_id = auth()->id();
        $reply->to_id = $message->from_id;
        $reply->title = 'Re: ' . $message->title;
        $reply->content = $request->content;
        $reply->save();

        return redirect()->route('messages.index');
    }

    public function reply(Message $message)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('messages.reply', compact('message', 'users'));
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index');
    }
}
