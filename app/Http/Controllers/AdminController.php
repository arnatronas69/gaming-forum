<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thread;
use Parsedown;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('threads')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function editUser(User $user)
    {
        // Return a view with the user to edit
        return view('admin.users.users', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validate and update the user
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
    
        $user->update($validatedData);
    
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        // Delete the user
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }

    public function editThread(Thread $thread)
    {
        // Return a view with the thread to edit
        return view('admin.threads.edit', compact('thread'));
    }

    public function updateThread(Request $request, Thread $thread)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required|max:200',
        'body' => 'required',
    ]);

    // Update the thread and check if the operation was successful
    if($thread->update($validatedData)) {
        return redirect()->route('admin')->with('success', 'Thread updated successfully');
    } else {
        return back()->withInput()->withErrors(['update' => 'The update operation failed. Please try again.']);
    }
}

    public function deleteThread(Thread $thread)
    {
        // Delete the thread
        $thread->delete();

        return redirect()->route('admin')->with('success', 'Thread deleted successfully');
    }

    public function adminUpdate(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required|max:200', // Limit the title to 200 characters
            'body' => 'required|max:5000', // Limit the body to 5000 characters
        ]);
    
        // Check if the authenticated user is an admin
        if (!$request->user()->is_admin) {
            return response()->json(['error' => 'Only admins can edit posts.'], 403);
        }
    
        $thread->update([
            'title' => $request->title,
            'body' => Parsedown::instance()->text($request->body),
        ]);
    
        return redirect()->route('admin');
    }
}