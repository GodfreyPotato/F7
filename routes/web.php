<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('auth.registrationForm');
Route::post('/register', [UserController::class, 'register'])->name('auth.register');


// Add these routes with the existing ones
Route::get('/login', [UserController::class, 'showLoginForm'])->name('auth.loginForm');
Route::post('/login', [UserController::class, 'login'])->name('auth.login');

//testing 
Route::get('/pdfPreview', [PdfController::class, 'index'])->name('pdfPreview');
Route::get('/pdfDownload', [PdfController::class, 'download'])->name('pdfDownload');



Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])
    ->name('password.request');

Route::post('/forgot-password', [UserController::class, 'forgotPassword'])
    ->name('password.email');

Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [UserController::class, 'resetPassword'])
    ->name('password.update');

Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');