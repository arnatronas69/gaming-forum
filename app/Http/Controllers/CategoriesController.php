<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
{
    $threads = $category->threads()->paginate(10);
    return view('categories.show', compact('category', 'threads'));
}
}
