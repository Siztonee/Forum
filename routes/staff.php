<?php

use App\Livewire\Staff\Panel\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\ModeratorMiddleware;
use App\Http\Controllers\Staff\Panel\PanelController;
use App\Http\Controllers\Staff\CreateCategoryController;
use App\Http\Controllers\Staff\CategorySettingsController;


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