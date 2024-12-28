<?php

use App\Livewire\Staff\Panel\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ModeratorMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Staff\CreateTopicController;
use App\Http\Controllers\Staff\Panel\PanelController;
use App\Http\Controllers\Staff\CreateCategoryController;
use App\Http\Controllers\Staff\CategorySettingsController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile/{username}', [ProfileController::class, 'index'])->name('profile');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('/{slug}/topics', [TopicsController::class, 'index'])->name('category.topics');
Route::get('/{c_slug}/topic/{t_slug}', [TopicController::class, 'index'])->name('category.topic');


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
    Route::get('/{slug}/create-topic', [CreateTopicController::class, 'index'])->name('category.topics.create');
    Route::post('/create-topic', [CreateTopicController::class, 'store'])->name('category.topics.store');
    Route::post('/send-message', SendMessageController::class)->name('message.send');     
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');   
});


Route::middleware([AuthMiddleware::class, ModeratorMiddleware::class])->group(function () {
    Route::get('/create-category', [CreateCategoryController::class, 'index'])->name('category.create');
    Route::post('/create-category', [CreateCategoryController::class, 'store'])->name('category.store');
    Route::get('/{slug}/settings', [CategorySettingsController::class, 'index'])->name('category.settings');
    Route::put('/{slug}/settings', [CategorySettingsController::class, 'store'])->name('category.settings.store');
    Route::delete('/{slug}/clear', [CategorySettingsController::class, 'clear'])->name('category.clear');
    Route::delete('/{slug}/delete', [CategorySettingsController::class, 'delete'])->name('category.delete');
    Route::get('/panel', [PanelController::class, 'index'])->name('panel');
    Route::get('/admin/statistics/users', [PanelController::class, 'getRegistrationStats'])->name('admin.statistics.users');
    Route::get('/panel/users', Users::class)->name('panel.users');
});


Route::view('/privacy-policy', 'privacy-policy');
Route::view('/terms-of-service', 'terms-of-service');