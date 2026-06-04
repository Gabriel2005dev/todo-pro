<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     return auth()->check()
        ? redirect()->route('tasks.index')
        : redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('/dashboard', '/tasks')->name('dashboard');

     Route::resource('tasks', TaskController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])
        ->name('tasks.toggle');

    Route::patch('/tasks/{task}/inline-update', [TaskController::class, 'inlineUpdate'])
        ->name('tasks.inline-update');

    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('users', AdminUserController::class)
                  ->only(['index', 'store', 'update', 'destroy']);
        });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])
        ->name('profile.avatar.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';