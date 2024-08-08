<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


// task routes (todo)
Route::get('/todo', [TodoController::class,'index'])->name('todos.index');
Route::post('/todo', [TodoController::class,'store'])->name('todos');
Route::get('/todo/{id}/edit', [TodoController::class,'edit'])->name('todos.edit');
Route::put('/todo/{id}', [TodoController::class,'update'])->name('todos.update');
Route::delete('/todo/{id}', [TodoController::class,'delete'])->name('todos.delete');

// category routes
Route::get('/category', [CategoryController::class,'index'])->name('category.index');
Route::post('/category', [CategoryController::class,'store'])->name('category.store');
Route::get('/category/{id}/edit', [CategoryController::class,'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class,'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class,'delete'])->name('category.delete');