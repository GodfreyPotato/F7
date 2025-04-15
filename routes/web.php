<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('registration', [UserController::class, 'showRegistrationForm'])->name('auth.registrationForm');
Route::post('registration',[UserController::class, 'register'])->name('auth.register');
