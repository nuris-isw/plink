<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinkController; // Tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Auth Google
Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

// Dashboard & Manajemen Link (Auth Only)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Tambahkan 2 rute ini agar form di dashboard bisa berfungsi
    Route::post('/dashboard/links', [DashboardController::class, 'storeLink'])->name('links.store');
    Route::delete('/dashboard/links/{link}', [DashboardController::class, 'destroyLink'])->name('links.destroy');
});

// Profile (Auth Only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Manajemen User (Admin Only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';

// RUTE REDIRECT (WAJIB di paling bawah)
// Ini untuk menangani domain.id/slug
Route::get('/{slug}', [LinkController::class, 'redirect'])->name('links.redirect');