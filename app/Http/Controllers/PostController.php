<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class PostController extends Controller
{
    public function index(Thread $thread)
{
    $posts = $thread->posts;
    return view('posts.index', compact('posts'));
}
}
