<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [TaskController::class, 'index'])
        ->name('dashboard');

    Route::resource('tasks', TaskController::class);

    // TOGGLE STATUS
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])
        ->name('tasks.toggle');

    // INLINE UPDATE
    Route::patch('/tasks/{task}/inline-update', [TaskController::class, 'inlineUpdate'])
        ->name('tasks.inline-update');

    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('users', AdminUserController::class)
                ->except(['show']);
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