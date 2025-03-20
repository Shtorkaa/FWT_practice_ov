<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->name('todo.')->prefix('todo')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::POST('/search', [TaskController::class, 'search'])->name('search');
});

Route::middleware('auth')->name('task.')->prefix('task')->group(function () {
    Route::post('/', [TaskController::class, 'create'])->name('create');
    Route::patch('/{task}', [TaskController::class, 'edit'])->name('edit');
    Route::delete('/{task}', [TaskController::class, 'delete'])->name('delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
