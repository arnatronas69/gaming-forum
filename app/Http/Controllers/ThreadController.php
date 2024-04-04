<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index()
{
    $threads = Thread::all();
    return view('threads.index', compact('threads'));
    
}

public function store(Request $request)
{
    $thread = new Thread;
    $thread->title = $request->title;
    $thread->body = $request->body;
    $thread->user_id = auth()->id(); // Set the user_id to the ID of the currently authenticated user
    $thread->save();

    return redirect('/threads');
}

public function update(Request $request, $id)
{
    $thread = Thread::findOrFail($id);
    $thread->title = $request->title;
    $thread->body = $request->body;
    $thread->save();

    return redirect('/threads');
}
}