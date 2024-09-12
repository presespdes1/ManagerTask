<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/project', [UserController::class, 'projects'])->name('projects');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create.form');
    Route::get('/project/update/{id}', [ProjectController::class, 'updatePage'])->name('project.update.form');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/project/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::delete('/project/{id}', [ProjectController::class, 'delete'])->name('projects.delete');

    Route::get('/project/{id}/tasks', [TaskController::class, 'tasksByProjectId'])->name('project.tasks');
    Route::get('/project/task/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::delete('/project/task/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::put('/project/task/update/', [TaskController::class, 'update'])->name('task.update');
    Route::post('/project/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/project/task/{id}/update/', [TaskController::class, 'updatePage'])->name('task.update.form');
    Route::get('/project/{id}/task/create/', [TaskController::class, 'create'])->name('task.create.form');




});

require __DIR__.'/auth.php';
