<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('auth.registrationForm');
Route::post('/register', [UserController::class, 'register'])->name('auth.register');
