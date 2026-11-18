<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/about', [AboutController::class, 'show'])->name('about');
Route::get('/dashboard', fn () => view('dashboard'))->middleware('auth')->name('dashboard');
Route::resource('tasks', TaskController::class)->except('index')->middleware('auth');
require __DIR__.'/auth.php';
