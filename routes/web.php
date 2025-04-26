<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// Add these routes with the existing ones


Route::middleware('auth')->group(function () {
    //testing 
    Route::get('/pdfPreview', [PdfController::class, 'index'])->name('pdfPreview');
    Route::get('/pdfDownload', [PdfController::class, 'download'])->name('pdfDownload');
    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');

    // Attendance routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/{user}', [AttendanceController::class, 'show'])->name('attendance.show');
});


Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])
        ->name('password.request');

    Route::post('/forgot-password', [UserController::class, 'forgotPassword'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [UserController::class, 'resetPassword'])
        ->name('password.update');

    Route::get('/login', [UserController::class, 'showLoginForm'])->name('auth.loginForm');
    Route::post('/login', [UserController::class, 'login'])->name('auth.login');

    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('auth.registrationForm');
    Route::post('/register', [UserController::class, 'register'])->name('auth.register');
});