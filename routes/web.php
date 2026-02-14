<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MessageController::class, 'dashboard'])->name('dashboard');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('message.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('message.store');
    Route::get('/messages/{slug}/preview', [MessageController::class, 'preview'])->name('message.preview');
});

// Public Message View
Route::get('/m/{slug}', [MessageController::class, 'show'])->name('message.show');
