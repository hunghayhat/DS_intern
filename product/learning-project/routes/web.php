<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\MustBeLoggedIn;

Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');

// Middleware auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post related routes
    Route::get('/create-post', [PostController::class, 'showCreateForm']);
    Route::post('/create-post', [PostController::class, 'storeNewPost']);
    Route::get('/post/{post}', [PostController::class, 'showSinglePost']);
    Route::delete('/post/{post}', [PostController::class, 'delete']);
    Route::put('/post/{post}', [PostController::class, 'update']);
    Route::get('/post/{post}/edit', [PostController::class, 'edit']);

    // Profile related routes:
    Route::get('/profile/{user:username}', [UserController::class, 'profile']);
    Route::get('/profile/{user:username}/followers', [UserController::class, 'profileFollowers']);
    Route::get('/profile/{user:username}/following', [UserController::class, 'profileFollowing']);
    Route::get('/manage-avatar', [UserController::class, 'showAvatarForm']);
    Route::post('/manage-avatar', [UserController::class, 'storeAvatar']);
});

// Follow related routes
Route::post('create-follow/{user:username}', [FollowController::class, 'createFollow']);
Route::delete('remove-follow/{user:username}', [FollowController::class, 'removeFollow']);

// User related routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/admins-only', function () {
    return 'Only admins can do that';
})->middleware('can:visitAdminPages');

