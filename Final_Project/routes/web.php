<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/',[PageController::class,'home'])->name('home');
Route::middleware('auth')->group(function():void {
    Route::get('/dashboard',[PageController::class,'dashboard'])->name('dashboard');
    Route::patch('products/{product}/archive',[ProductController::class,'archive'])->name('products.archive');
    Route::patch('products/{product}/restore',[ProductController::class,'restore'])->name('products.restore');
    Route::resource('products',ProductController::class)->except(['destroy']);
    Route::resource('customers',CustomerController::class);
    Route::resource('users',UserController::class);
    Route::get('/sales/create',[SalesController::class,'create'])->name('sales.create');
    Route::post('/sales',[SalesController::class,'store'])->name('sales.store');
    Route::get('/sales',[SalesController::class,'index'])->name('sales.index');
    Route::get('/sales/{sale}',[SalesController::class,'show'])->name('sales.show');
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
