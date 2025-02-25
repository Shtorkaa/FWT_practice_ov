<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo', [PageController::class, 'index'])->name('todo')->middleware('auth');

Route::POST('/addTask', [TaskController::class, 'addTask'])->name('addTask')->middleware('auth');
Route::POST('/editTask', [TaskController::class, 'editTask'])->name('editTask')->middleware('auth');
Route::POST('/deleteTask', [TaskController::class, 'deleteTask'])->name('deleteTask')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
