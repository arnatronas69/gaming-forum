<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Category;
use Parsedown;

class ThreadController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('threads.index', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:200', // Limit the title to 200 characters
            'body' => 'required|max:5000', // Limit the body to 5000 characters
        ]);
        $thread = new Thread;
        $thread->title = $request->title;
        $thread->body = Parsedown::instance()->text($request->body);
        $thread->user_id = auth()->id(); // Set the user_id to the ID of the currently authenticated user
        $thread->category_id = $category->id;
        $thread->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200', // Limit the title to 200 characters
            'body' => 'required|max:5000', // Limit the body to 5000 characters
        ]);

        $thread = Thread::findOrFail($id);

        // Check if the authenticated user is the author of the thread
        if ($request->user()->cannot('update', $thread)) {
            return response()->json(['error' => 'You can only edit your own posts.'], 403);
        }

        $thread->title = $request->title;
        $thread->body = Parsedown::instance()->text($request->body);
        $thread->save();

        return redirect()->back();
    }

    public function categories()
    {
        $categories = Category::all();
        return view('threads.categories', compact('categories'));
    }
}