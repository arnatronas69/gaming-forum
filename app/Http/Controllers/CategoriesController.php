<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Genert\BBCode\BBCode;

class CategoriesController extends Controller
{
    public function index()
{
    $categories = Category::all();
    return view('categories.index', compact('categories'));
}
public function show(Category $category)
{
    $bbcode = new BBCode();

    $threads = $category->threads()->paginate(10);

    foreach ($threads as $thread) {
        if ($thread->user->bbcode) {
            $thread->user->bbcode = $bbcode->convertToHtml($thread->user->bbcode);
        }
    }

    return view('categories.show', compact('category', 'threads'));
}
}
