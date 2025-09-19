<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsersController::class, 'index']);
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
