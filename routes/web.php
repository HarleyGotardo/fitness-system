<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersPageController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExerciseCounterController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user_name = Auth::user();
    return Inertia::render('Dashboard', [
        'user_name' => $user_name->name,
        'user_role' => $user_name->role,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users Routes
    Route::get('/users', [UsersPageController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersPageController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersPageController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UsersPageController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UsersPageController::class, 'edit'])->name('users.edit');

    // Admin Routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Exercises Routes
    Route::get('/exercises', [ExercisesController::class, 'index'])->name('exercises.index');
    Route::get('/exercises/create', [ExercisesController::class, 'create'])->name('exercises.create');
    Route::post('/exercises', [ExercisesController::class, 'store'])->name('exercises.store');
    Route::delete('/exercises/{id}', [ExercisesController::class, 'destroy'])->name('exercises.destroy');
    Route::get('/exercises/{id}', [ExercisesController::class, 'show'])->name('exercises.show');

    // Exercise Counter Routes
    Route::get('/exercises/{exercise_id}/add_to_counter/{user_id}', [ExerciseCounterController::class, 'add_to_counter'])->name('exercises.add_to_counter');
});

require __DIR__.'/auth.php';