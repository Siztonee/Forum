<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;


Route::middleware([GuestMiddleware::class])->group( function() {
    Route::get('/auth', [AuthController::class, 'index'])->name('auth');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/auth', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('auth/{provider}', [SocialAuthController::class, 'redirect'])->name('auth.social');
    Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback']);
});