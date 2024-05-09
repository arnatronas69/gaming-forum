<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;

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