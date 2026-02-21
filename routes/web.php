<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('sections.home'));

Route::get('/register',  [RegisterController::class, 'create'])->name('register');
Route::post('/register',  [RegisterController::class, 'store']);

Route::get('/login',  [SessionController::class, 'create'])->name('login');
Route::post('/login',  [SessionController::class, 'store']);

Route::post('/logout',  [SessionController::class, 'destroy'])->name('logout');

Route::get('/users', [UserController::class, 'index'])->middleware('auth', 'can:is-admin');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth', 'can:update,user');
Route::put('/users/{user}/update', [UserController::class, 'update'])->middleware('auth', 'can:update,user');
