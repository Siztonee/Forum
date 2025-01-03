<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Staff\CreateTopicController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile/{username}', [ProfileController::class, 'index'])->name('profile');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('/{slug}/topics', [TopicsController::class, 'index'])->name('category.topics');
Route::get('/{c_slug}/topic/{t_slug}', [TopicController::class, 'index'])->name('category.topic');


require __DIR__ . '/guest.php';


Route::middleware([AuthMiddleware::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/{slug}/create-topic', [CreateTopicController::class, 'index'])->name('category.topics.create');
    Route::post('/create-topic', [CreateTopicController::class, 'store'])->name('category.topics.store');
    Route::post('/send-message', SendMessageController::class)->name('message.send');     
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');   
});


Route::view('/privacy-policy', 'privacy-policy');
Route::view('/terms-of-service', 'terms-of-service');


require __DIR__ . '/staff.php';

