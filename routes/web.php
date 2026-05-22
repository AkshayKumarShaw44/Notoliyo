<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile & Settings
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Note actions requiring auth (creation, deletion, favoriting, sharing)
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::post('/notes/{id}/toggle-favorite', [NoteController::class, 'toggleFavorite'])->name('notes.favorite');
    Route::post('/notes/{id}/toggle-pin', [NoteController::class, 'togglePin'])->name('notes.pin');
    Route::post('/notes/{id}/share', [NoteController::class, 'toggleSharing'])->name('notes.share');
    Route::post('/notes/{id}/collaborators', [NoteController::class, 'inviteCollaborator'])->name('notes.collaborate');
    Route::post('/notes/{id}/collaborators/remove', [NoteController::class, 'removeCollaborator'])->name('notes.collaborate.remove');
});

// Note Editor & Update routes (Public/Guest access supported via token validation inside controller)
Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::post('/notes/{id}/update', [NoteController::class, 'update'])->name('notes.update');
Route::post('/notes/{id}/comments', [CommentController::class, 'store'])->name('notes.comments.store');
