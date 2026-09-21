<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirect /dashboard or route('dashboard') to admin posts
    Route::get('/dashboard', function () {
        return redirect()->route('admin.posts.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Public Blog Routes
Route::get('/', [PostController::class, 'index'])->name('blog.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('blog.show');

// Protected Admin Dashboard Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Post Management
    Route::get('/posts', [PostController::class, 'adminIndex'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Category & Tag Management
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
    Route::resource('tags', TagController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/auth.php';
