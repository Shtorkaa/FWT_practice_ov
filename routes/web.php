<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo', [PageController::class, 'index'])->name('todo')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/task', [TaskController::class, 'create'])->name('task.create');
    Route::patch('/task', [TaskController::class, 'edit'])->name('task.edit');
    Route::delete('/task', [TaskController::class, 'delete'])->name('task.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
