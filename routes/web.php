<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ModeratorMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\Other\UpdateLastSeen;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Staff\CreateCategoryController;


Route::middleware([UpdateLastSeen::class])->group(function () {

    
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/{username}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');


    Route::middleware([GuestMiddleware::class])->group( function() {
        Route::get('/auth', [AuthController::class, 'index'])->name('auth');
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/auth', [AuthController::class, 'store'])->name('auth.store');
        Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

        Route::get('auth/{provider}', [SocialAuthController::class, 'redirect'])->name('auth.social');
        Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback']);
    });


    Route::middleware([AuthMiddleware::class])->group(function () {
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

        Route::get('/privacy-policy', function () {
            return view('privacy-policy');
        });

        Route::get('/terms-of-service', function () {
            return view('terms-of-service');
        });

    });


    Route::middleware([ModeratorMiddleware::class])->group(function () {
        Route::get('/create-category', [CreateCategoryController::class, 'index'])->name('category.create');
        Route::post('/create-category', [CreateCategoryController::class, 'store'])->name('category.store');
    });

});
