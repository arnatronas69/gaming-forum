<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessagesController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/categories/{category}/threads', [ThreadController::class, 'store']);

Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{category}', [CategoriesController::class, 'show']);

Route::resource('threads', ThreadController::class);
Route::resource('threads.posts', PostController::class);

Route::get('/user/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::get('/user/profile/picture', [ProfileController::class, 'showUploadForm'])->name('user.profile.picture');
Route::post('/user/profile/picture', [ProfileController::class, 'storePicture'])->name('user.profile.picture.store');
Route::put('/user/profile/bbcode', [ProfileController::class, 'updateBBCode'])->name('profile.bbcode');
Route::get('/user/profile/bbcode', [ProfileController::class, 'showBBCodeForm'])->name('profile.bbcode.show');

Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
Route::get('/messages/create', [MessagesController::class, 'create'])->name('messages.create');
Route::post('/messages', [MessagesController::class, 'store'])->name('messages.store');
Route::post('/messages/{message}/reply', [MessagesController::class, 'storeReply'])->name('messages.reply.store');
Route::get('/messages/{message}/reply', [MessagesController::class, 'reply'])->name('messages.reply');
Route::delete('/messages/{message}', [MessagesController::class, 'destroy'])->name('messages.destroy');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/threads/{thread}/edit', [AdminController::class, 'editThread'])->name('admin.threads.edit');
    Route::put('/admin/threads/{thread}', [AdminController::class, 'adminUpdate'])->name('admin.threads.update');
    Route::delete('/admin/threads/{thread}', [AdminController::class, 'deleteThread'])->name('admin.threads.delete');

    // User routes
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});