<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('auth.registrationForm');
Route::post('/register', [UserController::class, 'register'])->name('auth.register');


// Add these routes with the existing ones
Route::get('/login', [UserController::class, 'showLoginForm'])->name('auth.loginForm');
Route::post('/login', [UserController::class, 'login'])->name('auth.login');
