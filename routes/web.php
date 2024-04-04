<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/threads', [ThreadController::class, 'store']);

Route::resource('threads', ThreadController::class);
Route::resource('threads.posts', PostController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});